<?php
declare(strict_types=1);

$pageTitle = $pageTitle ?? 'Abiverein';
$navLinks = $navLinks ?? [
  ['href' => '/abiverein/public/', 'label' => 'Anmeldung'],
  ['href' => '/abiverein/public/login.php', 'label' => 'Admin Login'],
];
?><!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="stylesheet" href="/abiverein/public/assets/css/style.css">
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="/abiverein/public/">
      <img src="/abiverein/public/assets/logo.png" alt="Logo">
      <div class="brand-title">
        <strong>Abiverein</strong>
        <span>Beitritt & Verwaltung</span>
      </div>
    </a>

    <nav class="nav">
      <?php foreach ($navLinks as $l): ?>
        <a href="<?= htmlspecialchars($l['href']) ?>"><?= htmlspecialchars($l['label']) ?></a>
      <?php endforeach; ?>
    </nav>
  </div>
</header>

<main>
  <div class="container">
