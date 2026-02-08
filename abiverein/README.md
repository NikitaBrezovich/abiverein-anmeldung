# Abiverein – Anmeldeformular & Adminbereich

Dieses Projekt stellt ein webbasiertes Anmeldeformular für den Abiverein bereit.
Eltern können ihre Daten eintragen, Administratoren können alle Anmeldungen
über einen geschützten Bereich einsehen.

Die Anwendung ist bewusst **schlank**, **datenschutzfreundlich** und auf einem
klassischen **LAMP-Stack** lauffähig.

---

## Features

- Öffentliches Anmeldeformular
- Speicherung der Anmeldungen in einer MySQL/MariaDB-Datenbank
- Admin-Login mit Passwort-Hashing
- Admin-Übersicht aller Anmeldungen (tabellarisch)
- Einheitliches Layout (Header + Footer)
- Zentrale CSS-Datei
- Responsive Design (mobil & desktop)
- Spamschutz (Honeypot)

---

## Technik

- PHP (≥ 8.0 empfohlen)
- MySQL / MariaDB
- Apache (oder kompatibler Webserver)
- Kein Framework, kein JavaScript notwendig

---

## Projektstruktur

```text
abiverein/
├─ public/
│  ├─ index.php        # Anmeldeformular
│  ├─ login.php        # Admin Login
│  ├─ admin.php        # Admin-Übersicht
│  ├─ danke.php        # Bestätigungsseite
│  ├─ logout.php       # Logout
│  └─ assets/
│     ├─ css/
│     │  └─ style.css  # Zentrales Styling
│     ├─ logo.png      # Logo (austauschbar)
│     └─ bg.jpg        # Hintergrundbild (austauschbar)
│
├─ app/
│  ├─ db.php               # Datenbankverbindung
│  ├─ submit.php           # Formular-Verarbeitung
│  ├─ login_handler.php    # Login-Logik
│  ├─ auth.php             # Zugriffsschutz (Admin)
│  └─ partials/
│     ├─ header.php
│     └─ footer.php
│
├─ sql/
│  ├─ schema.sql       # Tabelle für Anmeldungen
│  └─ users.sql        # Tabelle für Admin-User
│
└─ README.md
