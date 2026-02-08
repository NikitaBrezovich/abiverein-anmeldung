<?php
$pageTitle = 'Beitritt zum Abiverein';
require __DIR__ . '/../app/partials/header.php';
?>

<h1 class="page-title">Beitritt zum Abiverein</h1>
<h4 class="page-subtitle">Bitte fülle alle Pflichtfelder (*) aus.</h4>

<div class="card">
  <form class="form" method="post" action="../app/submit.php" novalidate>

    <!-- Kind -->
    <section class="form-section">
      <h2 class="section-title">Angaben zum Kind</h2>

      <div class="field">
        <label for="child_name">Name des Kindes*</label>
        <input id="child_name" name="child_name" required maxlength="120" autocomplete="name">
      </div>
    </section>

    <hr class="divider">

    <!-- Eltern -->
    <section class="form-section">
      <h2 class="section-title">Angaben zu den Eltern</h2>

      <div class="grid-2">
        <div class="field">
          <label for="parent1_name">Name Elternteil 1*</label>
          <input id="parent1_name" name="parent1_name" required maxlength="120">
        </div>

        <div class="field">
          <label for="parent1_age">Alter Elternteil 1*</label>
          <input id="parent1_age" name="parent1_age" type="number" min="10" max="120" required>
        </div>
      </div>

      <div class="grid-2">
        <div class="field">
          <label for="parent2_name">Name Elternteil 2 (optional)</label>
          <input id="parent2_name" name="parent2_name" maxlength="120">
        </div>

        <div class="field">
          <label for="parent2_age">Alter Elternteil 2 (optional)</label>
          <input id="parent2_age" name="parent2_age" type="number" min="10" max="120">
        </div>
      </div>

      <p class="muted">Elternteil 2 ist optional (z. B. alleinerziehend).</p>
    </section>

    <hr class="divider">

    <!-- Kontakt -->
    <section class="form-section">
      <h2 class="section-title">Kontaktdaten</h2>

      <div class="grid-2">
        <div class="field">
          <label for="email">E-Mail*</label>
          <input id="email" name="email" type="email" required maxlength="254" autocomplete="email">
        </div>

        <div class="field">
          <label for="phone">Telefon*</label>
          <input id="phone" name="phone" required maxlength="32" placeholder="+49 1xx xxxxxxx" autocomplete="tel">
        </div>
      </div>
    </section>

    <hr class="divider">

    <!-- Einwilligungen -->
    <section class="form-section">
      <h2 class="section-title">Einwilligungen</h2>

      <div class="checkbox">
        <input id="privacy_accepted" type="checkbox" name="privacy_accepted" value="1" required>
        <label for="privacy_accepted">
          Ich habe die Datenschutzerklärung gelesen und akzeptiere sie.*
          <div class="muted">Link zur Datenschutzerklärung</div>
        </label>
      </div>

      <div class="checkbox">
        <input id="initial_payment_ack" type="checkbox" name="initial_payment_ack" value="1" required>
        <label for="initial_payment_ack">
          Hinweis zur Ersteinzahlung gelesen / akzeptiert.*
          <div class="muted">Infos zur Ersteinzahlung</div>
        </label>
      </div>
    </section>

    <!-- Honeypot -->
    <div class="honeypot">
      <label>Website <input name="website"></label>
    </div>

    <div class="actions">
      <button class="btn primary" type="submit">Anmelden</button>
      <a class="btn" href="./login.php">Admin Login</a>
      <span class="muted">Nach dem Absenden wirst du weitergeleitet.</span>
    </div>

  </form>
</div>

<?php require __DIR__ . '/../app/partials/footer.php'; ?>
