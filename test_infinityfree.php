<?php
require_once 'config/config.php';

echo "<h2>InfinityFree Configuration Test</h2>";

// Test Database Connection
echo "<h3>Database Connection Test:</h3>";
$conn = getDBConnection();
if ($conn) {
    echo "<p style='color: green;'>✓ Database connection successful</p>";
    
    // Test query execution
    $result = $conn->query("SHOW TABLES");
    if ($result) {
        echo "<p style='color: green;'>✓ Query execution successful</p>";
        echo "<h4>Tables in database:</h4>";
        echo "<ul>";
        while ($row = $result->fetch_array()) {
            echo "<li>" . htmlspecialchars($row[0]) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color: red;'>✗ Query execution failed: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: red;'>✗ Database connection failed</p>";
}

// Test File System
echo "<h3>File System Test:</h3>";
$testDir = SITE_ROOT . '/test_dir';
if (mkdir($testDir, 0777, true)) {
    echo "<p style='color: green;'>✓ Directory creation successful</p>";
    rmdir($testDir);
} else {
    echo "<p style='color: red;'>✗ Directory creation failed</p>";
}

// Display Configuration
echo "<h3>Current Configuration:</h3>";
echo "<pre>";
echo "Site URL: " . SITE_URL . "\n";
echo "Site Root: " . SITE_ROOT . "\n";
echo "Upload Directory: " . UPLOAD_DIR . "\n";
echo "Database Host: " . DB_HOST . "\n";
echo "Database Name: " . DB_NAME . "\n";
echo "Database User: " . DB_USER . "\n";
echo "</pre>";

// Test PHP Settings
echo "<h3>PHP Settings:</h3>";
echo "<pre>";
echo "max_execution_time: " . ini_get('max_execution_time') . "\n";
echo "memory_limit: " . ini_get('memory_limit') . "\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "</pre>";
?>
