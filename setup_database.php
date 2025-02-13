<?php
require_once 'config/config.php';

echo "<h2>Database Setup and Verification</h2>";

try {
    // Test database connection
    $conn = getDBConnection();
    if (!$conn) {
        throw new Exception("Failed to connect to database");
    }
    echo "<p style='color: green;'>✓ Database connection successful</p>";

    // Check if developers table exists
    $result = $conn->query("SHOW TABLES LIKE 'developers'");
    if ($result->num_rows === 0) {
        // Create developers table
        $sql = "CREATE TABLE developers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if ($conn->query($sql)) {
            echo "<p style='color: green;'>✓ Developers table created successfully</p>";
        } else {
            throw new Exception("Failed to create developers table: " . $conn->error);
        }
    } else {
        echo "<p style='color: green;'>✓ Developers table exists</p>";
    }

    // Check if admin user exists
    $stmt = $conn->prepare("SELECT id FROM developers WHERE username = ?");
    $admin = 'admin';
    $stmt->bind_param("s", $admin);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Create admin user
        $password = 'VVITWEBLIB724020';
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $conn->prepare("INSERT INTO developers (username, password_hash) VALUES (?, ?)");
        $stmt->bind_param("ss", $admin, $password_hash);
        
        if ($stmt->execute()) {
            echo "<p style='color: green;'>✓ Admin user created successfully</p>";
            echo "<p>Username: admin</p>";
            echo "<p>Password: VVITWEBLIB724020</p>";
        } else {
            throw new Exception("Failed to create admin user: " . $stmt->error);
        }
    } else {
        echo "<p style='color: green;'>✓ Admin user exists</p>";
    }

    echo "<h3>Database Information:</h3>";
    echo "<pre>";
    echo "Host: " . DB_HOST . "\n";
    echo "Database: " . DB_NAME . "\n";
    echo "Username: " . DB_USER . "\n";
    echo "</pre>";

    echo "<p>You can now try to <a href='developer/login.php'>login as developer</a></p>";

} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
