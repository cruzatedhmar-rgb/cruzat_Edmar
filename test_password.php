<?php
// Test password verification
$password = 'admin123';
$hash_from_db = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

echo "Testing password verification:\n";
echo "Password: " . $password . "\n";
echo "Hash from DB: " . $hash_from_db . "\n";

if (password_verify($password, $hash_from_db)) {
    echo "✅ Password verification: SUCCESS\n";
} else {
    echo "❌ Password verification: FAILED\n";
    echo "Generating new hash...\n";
    $new_hash = password_hash($password, PASSWORD_DEFAULT);
    echo "New hash: " . $new_hash . "\n";
    
    if (password_verify($password, $new_hash)) {
        echo "✅ New hash verification: SUCCESS\n";
    }
}
?>
