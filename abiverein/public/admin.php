<?php
declare(strict_types=1);

require __DIR__ . '/../app/auth.php';
require __DIR__ . '/../app/db.php';

$pageTitle = 'Admin – Anmeldungen';
$navLinks = [
  ['href' => '/abiverein/public/admin.php', 'label' => 'Übersicht'],
  ['href' => '/abiverein/public/logout.php', 'label' => 'Logout'],
];

$rows = $pdo->query(
  'SELECT id, created_at, child_name, parent1_name, parent1_age, parent2_name, parent2_age, email, phone
   FROM applications
   ORDER BY created_at DESC'
)->fetchAll();

require __DIR__ . '/../app/partials/header.php';
?>

<h1 class="page-title">Anmeldungen</h1>
<p class="page-subtitle">
  Eingeloggt als: <?= htmlspecialchars((string)($_SESSION['username'] ?? '')) ?>
  · Anzahl: <?= count($rows) ?>
</p>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Zeit</th>
          <th>Kind</th>
          <th>Elternteil 1</th>
          <th>Elternteil 2</th>
          <th>E-Mail</th>
          <th>Telefon</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= (int)$r['id'] ?></td>
            <td><?= htmlspecialchars((string)$r['created_at']) ?></td>
            <td><?= htmlspecialchars((string)$r['child_name']) ?></td>
            <td><?= htmlspecialchars((string)$r['parent1_name']) ?> (<?= (int)$r['parent1_age'] ?>)</td>
            <td>
              <?php if (!empty($r['parent2_name'])): ?>
                <?= htmlspecialchars((string)$r['parent2_name']) ?>
                <?php if ($r['parent2_age'] !== null): ?>
                  (<?= (int)$r['parent2_age'] ?>)
                <?php endif; ?>
              <?php else: ?>
                —
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars((string)$r['email']) ?></td>
            <td><?= htmlspecialchars((string)$r['phone']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php if (count($rows) === 0): ?>
    <p class="muted">Noch keine Anmeldungen vorhanden.</p>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../app/partials/footer.php'; ?>
