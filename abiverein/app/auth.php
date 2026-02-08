<?php
declare(strict_types=1);

session_start();

if (empty($_SESSION['is_admin'])) {
  header('Location: ../public/login.php', true, 303);
  exit;
}
