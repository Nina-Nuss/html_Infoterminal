<?php
// ...existing code..
$serverName =  "10.1.6.3";
// Versuche Konfiguration aus JSON-Datei zu laden
$connectionOptions = array(
    "Database" =>  "testdbTerminal",
    "CharacterSet" =>  "UTF-8",
    "TrustServerCertificate" =>  true,
    "Encrypt" =>  true,
    "UID" => "sa",
    "PWD" =>  "A%00000p&",
);

// Verbindung herstellen
global $conn;
$conn = sqlsrv_connect( $serverName , $connectionOptions);

// Verbindung überprüfen
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . print_r(sqlsrv_errors(), true));
} else {
    // echo "Verbindung erfolgreich hergestellt.";
}
?>
