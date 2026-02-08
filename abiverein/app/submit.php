<?php
declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Method not allowed');
}

// Honeypot
if (!empty($_POST['website'] ?? '')) {
  http_response_code(200);
  exit('OK');
}

function val(string $key): string {
  return trim((string)($_POST[$key] ?? ''));
}

$child_name   = val('child_name');
$parent1_name = val('parent1_name');
$parent2_name = val('parent2_name');
$email        = val('email');
$phone        = val('phone');

$parent1_age_raw = val('parent1_age');
$parent2_age_raw = val('parent2_age');

$privacy_accepted     = (int)($_POST['privacy_accepted'] ?? 0);
$initial_payment_ack  = (int)($_POST['initial_payment_ack'] ?? 0);

// Basic required checks
if ($child_name === '' || $parent1_name === '' || $email === '' || $phone === '') {
  http_response_code(400);
  exit('Bitte alle Pflichtfelder ausfüllen.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  exit('Bitte eine gültige E-Mail angeben.');
}

$parent1_age = filter_var($parent1_age_raw, FILTER_VALIDATE_INT, ["options" => ["min_range" => 10, "max_range" => 120]]);
if ($parent1_age === false) {
  http_response_code(400);
  exit('Bitte ein gültiges Alter für Elternteil 1 angeben.');
}

$parent2_age = null;
if ($parent2_age_raw !== '') {
  $tmp = filter_var($parent2_age_raw, FILTER_VALIDATE_INT, ["options" => ["min_range" => 10, "max_range" => 120]]);
  if ($tmp === false) {
    http_response_code(400);
    exit('Bitte ein gültiges Alter für Elternteil 2 angeben (oder leer lassen).');
  }
  $parent2_age = (int)$tmp;
}

// Wenn Elternteil 2 Alter eingetragen ist, aber kein Name -> Name verlangen (UX)
if ($parent2_age !== null && $parent2_name === '') {
  http_response_code(400);
  exit('Wenn du ein Alter für Elternteil 2 angibst, bitte auch den Namen eintragen.');
}

if ($privacy_accepted !== 1 || $initial_payment_ack !== 1) {
  http_response_code(400);
  exit('Bitte beide Häkchen (Datenschutz & Ersteinzahlung) setzen.');
}

require __DIR__ . '/db.php';

// Optional: IP + User-Agent speichern
$ip = $_SERVER['REMOTE_ADDR'] ?? null;
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;

// IPv4/IPv6 -> VARBINARY(16)
$ipBin = null;
if ($ip) {
  $packed = @inet_pton($ip);
  if ($packed !== false) $ipBin = $packed;
}

$stmt = $pdo->prepare(
  'INSERT INTO applications
   (child_name, parent1_name, parent1_age, parent2_name, parent2_age, email, phone, privacy_accepted, initial_payment_ack, source_ip, user_agent)
   VALUES
   (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
);

$stmt->execute([
  $child_name,
  $parent1_name,
  (int)$parent1_age,
  $parent2_name !== '' ? $parent2_name : null,
  $parent2_age,
  $email,
  $phone,
  1,
  1,
  $ipBin,
  $userAgent,
]);

header('Location: ../public/danke.php', true, 303);
exit;
