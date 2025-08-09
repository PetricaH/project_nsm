<?php
// Your OX App Suite SMTP Configuration
define('SMTP_HOST', 'poseidon.b2b-server.net');
define('SMTP_USERNAME', 'hello@notsomarketing.com'); // Your full email address
define('SMTP_PASSWORD', 'Ns5423#$@'); // Your email account password
define('SMTP_PORT', 465); // SSL port for OX App Suite
define('SMTP_SECURE', 'ssl'); // SSL encryption (not TLS for port 465)

// Email defaults
define('DEFAULT_FROM_EMAIL', 'hello@notsomarketing.com');
define('DEFAULT_FROM_NAME', 'Hreniuc Petrică');
define('DEFAULT_REPLY_TO', 'hello@notsomarketing.com');

// Security settings
define('SMTP_TIMEOUT', 30);
define('SMTP_DEBUG', 0); // Set to 2 for debugging, 0 for production

?>