<?php
declare(strict_types=1);
require __DIR__ . '/../app/db.php';

$username = 'admin';
$password = 'Start123'; // danach ändern!

$hash = password_hash($password, PASSWORD_BCRYPT);

$stmt = $pdo->prepare('INSERT INTO users (username, password_hash, is_admin) VALUES (?, ?, 1)
                       ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash), is_admin = 1');
$stmt->execute([$username, $hash]);

echo "Admin user ready: admin / Start123 (BITTE ändern)";
// Danach Datei löschen oder umbenennen!
