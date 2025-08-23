<?php
// ...existing code...
// Versuche Konfiguration aus JSON-Datei zu laden
$configPath = '../../config/ipadress.json';

$config = null;
if (file_exists($configPath)) {
    $json = @file_get_contents($configPath);
    $cfg = json_decode($json, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($cfg)) {
        $config = $cfg;
    }
}



// Fallback-Werte (wie vorher)
$serverName = $config['serverName'];
$connectionOptions = array(
    "Database" => $config['Database'] ?? "testdbTerminal",
    "CharacterSet" => $config['CharacterSet'] ?? "UTF-8",
    "TrustServerCertificate" => $config['TrustServerCertificate'] ?? true,
    "Encrypt" => $config['Encrypt'] ?? true,
    "UID" => $config['UID'] ?? "sa",
    "PWD" => $config['PWD'] ?? "A%00000p&",
);

// Verbindung herstellen
global $conn;
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Verbindung überprüfen
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . print_r(sqlsrv_errors(), true));
} else {
    // echo "Verbindung erfolgreich hergestellt.";
}
?>
