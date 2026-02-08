<?php
declare(strict_types=1);

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Method not allowed');
}

$username = trim((string)($_POST['username'] ?? ''));
$password = (string)($_POST['password'] ?? '');

if ($username === '' || $password === '') {
  header('Location: ../public/login.php?err=1', true, 303);
  exit;
}

require __DIR__ . '/db.php';

$stmt = $pdo->prepare('SELECT id, username, password_hash, is_admin FROM users WHERE username = ? LIMIT 1');
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password_hash']) || (int)$user['is_admin'] !== 1) {
  header('Location: ../public/login.php?err=1', true, 303);
  exit;
}

// Session setzen
$_SESSION['user_id'] = (int)$user['id'];
$_SESSION['username'] = (string)$user['username'];
$_SESSION['is_admin'] = 1;

header('Location: ../public/admin.php', true, 303);
exit;
