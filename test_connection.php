<?php
require_once 'config/config.php';

echo "<h2>Database Connection Test</h2>";

try {
    // Test database connection
    $conn = getDBConnection();
    if (!$conn) {
        throw new Exception("Failed to connect to database");
    }
    echo "<p style='color: green;'>✓ Database connection successful</p>";

    // Test if tables exist
    $tables = ['users', 'developers', 'books', 'book_issues'];
    foreach ($tables as $table) {
        $result = $conn->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows > 0) {
            echo "<p style='color: green;'>✓ Table '$table' exists</p>";
        } else {
            echo "<p style='color: red;'>✗ Table '$table' does not exist</p>";
        }
    }

    // Test admin user
    $stmt = $conn->prepare("SELECT id, username FROM developers WHERE username = ?");
    $username = 'admin';
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<p style='color: green;'>✓ Admin user exists</p>";
        
        // Test password
        $stmt = $conn->prepare("SELECT password_hash FROM developers WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $password = 'VVITWEBLIB724020';
        if (password_verify($password, $row['password_hash'])) {
            echo "<p style='color: green;'>✓ Admin password is correct</p>";
        } else {
            echo "<p style='color: red;'>✗ Admin password hash is incorrect</p>";
            
            // Update password
            $new_hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE developers SET password_hash = ? WHERE username = ?");
            $stmt->bind_param("ss", $new_hash, $username);
            if ($stmt->execute()) {
                echo "<p style='color: green;'>✓ Admin password has been updated</p>";
            } else {
                echo "<p style='color: red;'>✗ Failed to update admin password</p>";
            }
        }
    } else {
        echo "<p style='color: red;'>✗ Admin user does not exist</p>";
        
        // Create admin user
        $password_hash = password_hash('VVITWEBLIB724020', PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO developers (username, password_hash) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password_hash);
        if ($stmt->execute()) {
            echo "<p style='color: green;'>✓ Admin user has been created</p>";
        } else {
            echo "<p style='color: red;'>✗ Failed to create admin user</p>";
        }
    }

    // Display database configuration
    echo "<h3>Current Database Configuration:</h3>";
    echo "<pre>";
    echo "Host: " . DB_HOST . "\n";
    echo "Database: " . DB_NAME . "\n";
    echo "Username: " . DB_USER . "\n";
    echo "Port: " . DB_PORT . "\n";
    echo "</pre>";

} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
