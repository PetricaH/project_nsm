<?php
/**
 * Setup Script
 * 
 * This script sets up the necessary directories and permissions for the website.
 * Run this script once after deploying the site to ensure all required directories exist.
 */

// Define the root path
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__FILE__));

// Define directories to create
$directories = [
    ROOT_PATH . '/static/resources',
    ROOT_PATH . '/logs',
    ROOT_PATH . '/includes/cache'
];

// Create directories if they don't exist
foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        if (mkdir($dir, 0755, true)) {
            echo "Created directory: {$dir}<br>";
        } else {
            echo "Failed to create directory: {$dir}<br>";
        }
    } else {
        echo "Directory already exists: {$dir}<br>";
    }
}

// Create .htaccess file to protect resources directory
$htaccess_content = <<<'EOT'
# Prevent direct access to PDF files
<FilesMatch "\.pdf$">
    Order deny,allow
    Deny from all
</FilesMatch>

# Disable directory listing
Options -Indexes

# Prevent access to all files except through download.php
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} \.pdf$
    RewriteRule .* - [F,L]
</IfModule>
EOT;

$htaccess_file = ROOT_PATH . '/static/resources/.htaccess';
if (!file_exists($htaccess_file)) {
    if (file_put_contents($htaccess_file, $htaccess_content)) {
        echo "Created .htaccess file for resources directory<br>";
    } else {
        echo "Failed to create .htaccess file for resources directory<br>";
    }
} else {
    echo ".htaccess file already exists for resources directory<br>";
}

// Create an empty log file if it doesn't exist
$log_file = ROOT_PATH . '/logs/email.log';
if (!file_exists($log_file)) {
    if (file_put_contents($log_file, "")) {
        echo "Created email log file<br>";
    } else {
        echo "Failed to create email log file<br>";
    }
} else {
    echo "Email log file already exists<br>";
}

// Set proper permissions
chmod(ROOT_PATH . '/logs', 0755);
chmod(ROOT_PATH . '/logs/email.log', 0644);
chmod(ROOT_PATH . '/static/resources', 0755);

echo "<br>Setup complete!";