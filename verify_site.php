<?php
require_once 'config/config.php';

function checkFilePermissions($file) {
    clearstatcache();
    return substr(sprintf('%o', fileperms($file)), -4);
}

echo "<h2>Website Verification Test</h2>";

// Test 1: PHP Version and Settings
echo "<h3>1. PHP Configuration:</h3>";
echo "<pre>";
echo "PHP Version: " . phpversion() . "\n";
echo "display_errors: " . ini_get('display_errors') . "\n";
echo "error_reporting: " . ini_get('error_reporting') . "\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "memory_limit: " . ini_get('memory_limit') . "\n";
echo "</pre>";

// Test 2: File Structure and Permissions
echo "<h3>2. File Structure and Permissions:</h3>";
$critical_files = [
    '/config/config.php',
    '/developer/login.php',
    '/setup_database.php',
    '/verify_site.php'
];

foreach ($critical_files as $file) {
    $full_path = $_SERVER['DOCUMENT_ROOT'] . $file;
    if (file_exists($full_path)) {
        echo "<p style='color: green;'>✓ {$file} exists (Permissions: " . checkFilePermissions($full_path) . ")</p>";
    } else {
        echo "<p style='color: red;'>✗ {$file} is missing</p>";
    }
}

// Test 3: Database Connection
echo "<h3>3. Database Connection Test:</h3>";
try {
    $conn = getDBConnection();
    if ($conn) {
        echo "<p style='color: green;'>✓ Database connection successful</p>";
        
        // Test query
        $result = $conn->query("SHOW TABLES");
        if ($result) {
            echo "<p>Tables in database:</p><ul>";
            while ($row = $result->fetch_row()) {
                echo "<li>" . htmlspecialchars($row[0]) . "</li>";
            }
            echo "</ul>";
        }
        
        // Test developers table
        $result = $conn->query("SELECT COUNT(*) as count FROM developers");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p>Number of developers in database: " . $row['count'] . "</p>";
        }
        
        $conn->close();
    } else {
        echo "<p style='color: red;'>✗ Database connection failed</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Test 4: Server Information
echo "<h3>4. Server Information:</h3>";
echo "<pre>";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Server Name: " . $_SERVER['SERVER_NAME'] . "\n";
echo "HTTP Host: " . $_SERVER['HTTP_HOST'] . "\n";
echo "</pre>";

// Test 5: Directory Permissions
echo "<h3>5. Directory Permissions:</h3>";
$directories = [
    '/config',
    '/developer',
    '/uploads'
];

foreach ($directories as $dir) {
    $full_path = $_SERVER['DOCUMENT_ROOT'] . $dir;
    if (is_dir($full_path)) {
        echo "<p style='color: green;'>✓ {$dir} directory exists (Permissions: " . checkFilePermissions($full_path) . ")</p>";
        if (is_writable($full_path)) {
            echo "<p style='color: green;'>✓ {$dir} is writable</p>";
        } else {
            echo "<p style='color: red;'>✗ {$dir} is not writable</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ {$dir} directory is missing</p>";
    }
}

// Add quick links
echo "<h3>6. Quick Links:</h3>";
echo "<ul>";
echo "<li><a href='setup_database.php'>Run Database Setup</a></li>";
echo "<li><a href='developer/login.php'>Developer Login</a></li>";
echo "<li><a href='test_infinityfree.php'>Test InfinityFree Configuration</a></li>";
echo "</ul>";
?>
