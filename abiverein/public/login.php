<?php
$pageTitle = 'Admin Login';
require __DIR__ . '/../app/partials/header.php';
?>

<h1 class="page-title">Admin Login</h1>
<p class="page-subtitle">Nur für berechtigte Personen.</p>

<?php if (!empty($_GET['err'])): ?>
  <div class="alert error">Login fehlgeschlagen. Bitte überprüfe Username & Passwort.</div>
<?php endif; ?>

<div class="card">
  <form class="form" method="post" action="../app/login_handler.php">
    <div class="field">
      <label for="username">Username</label>
      <input id="username" name="username" required autocomplete="username">
    </div>

    <div class="field">
      <label for="password">Password</label>
      <input id="password" name="password" type="password" required autocomplete="current-password">
    </div>

    <div class="actions">
      <button class="btn primary" type="submit">Login</button>
      <a class="btn" href="./">Zurück zum Formular</a>
    </div>
  </form>
</div>

<?php require __DIR__ . '/../app/partials/footer.php'; ?>
