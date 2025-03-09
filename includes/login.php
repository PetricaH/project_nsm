<?php
// Start session
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header('Location: admin-dashboard.php');
    exit;
}

// Database connection
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Process login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    $errors = [];
    
    // Validation
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    
    // If no validation errors, attempt login
    if (empty($errors)) {
        try {
            // Get user by username
            $stmt = $conn->prepare("
                SELECT user_id, username, password_hash, role, email 
                FROM users 
                WHERE username = ? OR email = ?
            ");
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password_hash'])) {
                // Check if user is admin
                if ($user['role'] !== 'admin') {
                    $errors[] = "You do not have administrative privileges.";
                } else {
                    // Set session variables
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['email'] = $user['email'];
                    
                    // Update last login time
                    $updateStmt = $conn->prepare("
                        UPDATE users 
                        SET last_login = NOW() 
                        WHERE user_id = ?
                    ");
                    $updateStmt->execute([$user['user_id']]);
                    
                    // Create "remember me" token if requested
                    if ($remember) {
                        // Generate tokens
                        $selector = bin2hex(random_bytes(8));
                        $validator = bin2hex(random_bytes(32));
                        
                        // Hash the validator for database storage
                        $hashedValidator = password_hash($validator, PASSWORD_DEFAULT);
                        
                        // Set expiry (30 days)
                        $expires = date('Y-m-d H:i:s', time() + 60 * 60 * 24 * 30);
                        
                        // Delete any existing tokens for this user
                        $deleteStmt = $conn->prepare("
                            DELETE FROM auth_tokens 
                            WHERE user_id = ?
                        ");
                        $deleteStmt->execute([$user['user_id']]);
                        
                        // Store new token in database
                        $insertStmt = $conn->prepare("
                            INSERT INTO auth_tokens (user_id, selector, hashed_validator, expires)
                            VALUES (?, ?, ?, ?)
                        ");
                        $insertStmt->execute([$user['user_id'], $selector, $hashedValidator, $expires]);
                        
                        // Set cookie with selector and validator
                        $cookieValue = $selector . ':' . $validator;
                        setcookie(
                            'remember_me',
                            $cookieValue,
                            time() + 60 * 60 * 24 * 30, // 30 days
                            '/',
                            '',
                            true, // Only send over HTTPS
                            true  // HTTP only
                        );
                    }
                    
                    // Log activity
                    logActivity(
                        $conn,
                        $user['user_id'],
                        'login',
                        'user',
                        $user['user_id'],
                        null
                    );
                    
                    // Redirect to dashboard
                    header('Location: admin-dashboard.php');
                    exit;
                }
            } else {
                $errors[] = "Invalid username or password.";
                // Add a small delay to prevent brute force attacks
                sleep(1);
            }
        } catch (PDOException $e) {
            $errors[] = "Login error. Please try again.";
            error_log("Login error: " . $e->getMessage());
        }
    }
}

// Check for "remember me" cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    list($selector, $validator) = explode(':', $_COOKIE['remember_me']);
    
    try {
        // Find token in database
        $stmt = $conn->prepare("
            SELECT t.*, u.username, u.role, u.email
            FROM auth_tokens t
            JOIN users u ON t.user_id = u.user_id
            WHERE t.selector = ? AND t.expires > NOW()
        ");
        $stmt->execute([$selector]);
        $token = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($token && password_verify($validator, $token['hashed_validator'])) {
            // Check if user is admin
            if ($token['role'] === 'admin') {
                // Set session variables
                $_SESSION['user_id'] = $token['user_id'];
                $_SESSION['username'] = $token['username'];
                $_SESSION['role'] = $token['role'];
                $_SESSION['email'] = $token['email'];
                
                // Update last login time
                $updateStmt = $conn->prepare("
                    UPDATE users 
                    SET last_login = NOW() 
                    WHERE user_id = ?
                ");
                $updateStmt->execute([$token['user_id']]);
                
                // Log activity
                logActivity(
                    $conn,
                    $token['user_id'],
                    'login',
                    'user',
                    $token['user_id'],
                    ['method' => 'remember_me']
                );
                
                // Redirect to dashboard
                header('Location: admin-dashboard.php');
                exit;
            }
        }
    } catch (PDOException $e) {
        // Just fail silently and continue to login page
        error_log("Remember me login error: " . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Hreniuc Petrică</title>
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="css/admin.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #0F1013;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-logo {
            font-size: 28px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        
        .login-subtitle {
            color: #AAAAAA;
            font-size: 16px;
        }
        
        .login-card {
            background-color: #1A1A1D;
            border: 1px solid #303035;
            padding: 40px;
            border-radius: 4px;
        }
        
        .login-card h2 {
            margin-bottom: 30px;
            font-size: 24px;
            text-align: center;
            font-weight: 500;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #AAAAAA;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid #303035;
            color: #FFFFFF;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #FFFFFF;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .form-check input {
            margin-right: 10px;
        }
        
        .form-check label {
            color: #AAAAAA;
            cursor: pointer;
        }
        
        .login-btn {
            width: 100%;
            padding: 14px;
            background-color: #FFFFFF;
            color: #0F1013;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .login-btn:hover {
            background-color: #F0F0F0;
        }
        
        .login-footer {
            margin-top: 20px;
            text-align: center;
        }
        
        .login-footer a {
            color: #AAAAAA;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .login-footer a:hover {
            color: #FFFFFF;
        }
        
        .alert {
            background-color: rgba(244, 67, 54, 0.1);
            border-left: 3px solid #F44336;
            color: #F44336;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert ul {
            padding-left: 20px;
            margin: 5px 0 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">Hreniuc Petrică</div>
            <div class="login-subtitle">Admin Dashboard</div>
        </div>
        
        <?php if (!empty($errors)): ?>
            <div class="alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <div class="login-card">
            <h2>Login</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($username ?? ''); ?>" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                
                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label for="remember">Remember me</label>
                </div>
                
                <button type="submit" class="login-btn">Log In</button>
            </form>
        </div>
        
        <div class="login-footer">
            <a href="index.php">Return to Website</a>
        </div>
    </div>
</body>
</html>