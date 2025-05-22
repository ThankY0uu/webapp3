<?php
// Databaseconfiguratie
$host = 'db';          // of bijv. '127.0.0.1' of 'db' in Docker-omgevingen
$db   = 'restaurant';         // jouw database-naam
$user = 'root';               // jouw MySQL-gebruiker
$pass = 'rootpassword';                   // jouw MySQL-wachtwoord (laat leeg als je geen hebt)
$charset = 'utf8mb4';

// DSN = Data Source Name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opties voor PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // foutmeldingen als exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // associatieve arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // native prepared statements
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Fout bij verbinden met database: ' . $e->getMessage());
}
?>
