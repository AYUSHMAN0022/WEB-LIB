<?php
require_once 'config/config.php';
require_once 'vendor/autoload.php';

echo "<h2>Google OAuth Configuration Test</h2>";

try {
    // Check if Google Client ID and Secret are set
    if (empty(GOOGLE_CLIENT_ID) || GOOGLE_CLIENT_ID === 'YOUR_GOOGLE_CLIENT_ID') {
        echo "<p style='color: red;'>✗ Google Client ID is not configured</p>";
        echo "<p>Please follow these steps:</p>";
        echo "<ol>";
        echo "<li>Go to <a href='https://console.cloud.google.com' target='_blank'>Google Cloud Console</a></li>";
        echo "<li>Create a new project or select an existing one</li>";
        echo "<li>Enable the Google+ API</li>";
        echo "<li>Go to Credentials</li>";
        echo "<li>Create OAuth 2.0 Client ID</li>";
        echo "<li>Add these authorized redirect URIs:";
        echo "<ul>";
        echo "<li>" . GOOGLE_REDIRECT_URI . "</li>";
        echo "</ul></li>";
        echo "<li>Copy the Client ID and Client Secret</li>";
        echo "<li>Update config/config.php with your credentials</li>";
        echo "</ol>";
    } else {
        echo "<p style='color: green;'>✓ Google Client ID is configured</p>";
    }

    if (empty(GOOGLE_CLIENT_SECRET) || GOOGLE_CLIENT_SECRET === 'YOUR_GOOGLE_CLIENT_SECRET') {
        echo "<p style='color: red;'>✗ Google Client Secret is not configured</p>";
    } else {
        echo "<p style='color: green;'>✓ Google Client Secret is configured</p>";
    }

    // Test Google Client setup
    try {
        $client = new Google_Client();
        $client->setClientId(GOOGLE_CLIENT_ID);
        $client->setClientSecret(GOOGLE_CLIENT_SECRET);
        $client->setRedirectUri(GOOGLE_REDIRECT_URI);
        $client->addScope('email');
        $client->addScope('profile');

        echo "<p style='color: green;'>✓ Google Client initialization successful</p>";
        
        // Display current configuration
        echo "<h3>Current Google OAuth Configuration:</h3>";
        echo "<pre>";
        echo "Redirect URI: " . GOOGLE_REDIRECT_URI . "\n";
        echo "Client ID: " . substr(GOOGLE_CLIENT_ID, 0, 10) . "...\n";
        echo "Client Secret: " . substr(GOOGLE_CLIENT_SECRET, 0, 5) . "...\n";
        echo "</pre>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ Google Client initialization failed: " . htmlspecialchars($e->getMessage()) . "</p>";
    }

} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
