<?php
// Generate proper password hash for admin123
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password: " . $password . "\n";
echo "Hash: " . $hash . "\n";

// Test verification
if (password_verify($password, $hash)) {
    echo "Password verification: SUCCESS\n";
} else {
    echo "Password verification: FAILED\n";
}
?>
