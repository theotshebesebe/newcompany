<?php
/**
 * ADMIN SETUP SCRIPT
 * 
 * This script adds an admin role to the users table and creates a default admin user.
 * I'm adding this as a one-time setup to enable admin functionality.
 * 
 * Run this once to set up admin capabilities in your system.
 */

// Include database configuration
require_once '../config/config.php';

try {
    // Connect to database
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, 
        DB_USER, 
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Add admin role column to users table if it doesn't exist
    $pdo->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS is_admin TINYINT(1) DEFAULT 0");
    echo "✅ Admin role column added to users table<br>";

    // Create default admin user (you can change these credentials)
    $adminEmail = 'admin@newcompany.com';
    $adminPassword = 'admin123'; // Change this to a secure password
    $adminName = 'System Administrator';
    $hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

    // Check if admin already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$adminEmail]);
    
    if ($stmt->rowCount() == 0) {
        // Create admin user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, is_admin) VALUES (?, ?, ?, 1)");
        $stmt->execute([$adminName, $adminEmail, $hashedPassword]);
        echo "✅ Admin user created successfully<br>";
        echo "📧 Email: {$adminEmail}<br>";
        echo "🔑 Password: {$adminPassword}<br>";
        echo "⚠️  Please change the admin password after first login!<br>";
    } else {
        // Update existing user to admin
        $stmt = $pdo->prepare("UPDATE users SET is_admin = 1 WHERE email = ?");
        $stmt->execute([$adminEmail]);
        echo "✅ Existing user promoted to admin<br>";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; }
</style>
<h2>🛠️ Admin Setup Complete</h2>
<p><a href="<?php echo URLROOT; ?>">← Back to Application</a></p>