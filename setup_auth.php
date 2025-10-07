<?php
// Simple script to create the users table and insert default admin user
// Run this script once to set up the authentication system

// Database configuration
$host = 'sql12.freesqldatabase.com';
$port = '3306';
$username = 'sql12801240';
$password = '7XyCagV58k';
$database = 'sql12801240';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create user table
    $sql = "CREATE TABLE IF NOT EXISTS `user` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) NOT NULL UNIQUE,
        `email` varchar(100) NOT NULL UNIQUE,
        `password` varchar(255) NOT NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "Users table created successfully!\n";
    
    // Check if admin user already exists
    $checkSql = "SELECT COUNT(*) FROM user WHERE username = 'admin'";
    $stmt = $pdo->prepare($checkSql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        // Insert default admin user (username: admin, password: admin123)
        $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
        $insertSql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($insertSql);
        $stmt->execute(['admin', 'admin@example.com', $adminPassword]);
        echo "Default admin user created successfully!\n";
        echo "Username: admin\n";
        echo "Password: admin123\n";
    } else {
        echo "Admin user already exists!\n";
    }
    
    echo "Database setup completed successfully!\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
