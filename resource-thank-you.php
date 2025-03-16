<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php
// Check if resource type is provided
$resource_type = isset($_GET['type']) ? $_GET['type'] : '';

// Set up resource details based on type
switch ($resource_type) {
    case 'conversion-framework':
        $resource_title = "The 7-Step Website Conversion Framework";
        $resource_icon = "trending_up";
        $resource_description = "Your guide to increasing website conversion rates";
        break;
    case 'seo-checklist':
        $resource_title = "SEO Checklist for Romanian Businesses";
        $resource_icon = "search";
        $resource_description = "21 actionable tips to improve your local search rankings";
        break;
    default:
        $resource_title = "Your Free Resource";
        $resource_icon = "download";
        $resource_description = "Thank you for your download";
}
?>

<?php $page_css = 'thank-you.css';?>
<title>Thank You for Your Download | Hreniuc Petrică</title>
<meta name="robots" content="noindex, nofollow">
</head>

<body data-context="thank-you">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<main class="thank-you-page">
    <div class="container">
        <div class="thank-you-container">
            <div class="thank-you-header">
                <div class="resource-icon">
                    <span class="material-symbols-outlined"><?php echo $resource_icon; ?></span>
                </div>
                <h1>Your Guide is on the Way!</h1>
                <p>Check your email inbox for <strong><?php echo $resource_title; ?></strong>.</p>
            </div>
            
            <div class="email-instructions">
                <h2>Next Steps</h2>
                <div class="steps-container">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3>Check Your Inbox</h3>
                            <p>I've just sent you an email with your <?php echo strtolower($resource_title); ?>. If you don't see it, please check your spam folder.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3>Download Your Guide</h3>
                            <p>Click the download link in the email to access your guide. Save it for future reference.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3>Implement the Strategies</h3>
                            <p>Apply the actionable tips from the guide to see real improvements in your website's performance.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bonus-content">
                <h2>Exclusive Bonus Tips</h2>
                
                <?php if ($resource_type == 'conversion-framework'): ?>
                <div class="bonus-tip">
                    <h3>Quick Win: The 5-Second Rule</h3>
                    <p>A visitor should understand what your website offers within 5 seconds of landing on your homepage. Test this by showing your site to someone for just 5 seconds, then asking them what your business does. If they can't answer clearly, your messaging needs simplification.</p>
                </div>
                <?php elseif ($resource_type == 'seo-checklist'): ?>
                <div class="bonus-tip">
                    <h3>Quick Win: Local Business Schema</h3>
                    <p>Implementing LocalBusiness schema markup on your website helps Romanian search engines understand your business location, hours, and services. This simple technical SEO improvement can significantly boost your visibility in local search results.</p>
                </div>
                <?php else: ?>
                <div class="bonus-tip">
                    <h3>Quick Win: Website Performance</h3>
                    <p>Optimizing your images can reduce page load time by up to 80%. Use modern formats like WebP and implement lazy loading to dramatically improve your website speed and user experience.</p>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="next-steps-cta">
                <h2>Ready to Take the Next Step?</h2>
                <p>Schedule a free strategy session to discuss how these strategies can be tailored specifically for your business:</p>
                <button onclick="window.location.href='webdev.php#booking-section'" class="cta-button">Book Your Free Strategy Session</button>
            </div>
        </div>
    </div>
</main>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
</body>
</html>