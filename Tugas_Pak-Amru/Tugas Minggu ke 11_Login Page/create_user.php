<?php
// Script CLI untuk menambahkan user dengan password hashed ke tabel users.
require_once __DIR__ . '/db.php';

if (PHP_SAPI !== 'cli') {
    echo "This script must be run from CLI.\n";
    exit(1);
}

$opts = getopt('', ['username:', 'password:']);
if (empty($opts['username']) || empty($opts['password'])) {
    echo "Usage: php create_user.php --username=USER --password=PASS\n";
    exit(1);
}

$username = $opts['username'];
$password = $opts['password'];

$pdo = getPDO();
try {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)');
    $stmt->execute([$username, $hash]);
    echo "User '$username' created successfully.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
