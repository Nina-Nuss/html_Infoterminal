<?php
// ...existing code..

// Versuche Konfiguration aus JSON-Datei zu laden

// $ninchen = "Nina\SQLEXPRESS";


$serverName =  "10.1.6.3";
$UID = "sa";
$PWD = "A%00000p&";


$connectionOptions = array(
    "Database" =>  "testdbTerminal",
    "CharacterSet" =>  "UTF-8",
    "TrustServerCertificate" =>  true,
    "Encrypt" =>  true,
    "UID" => $UID ?? "",
    "PWD" =>  $PWD ?? "",
);

// Verbindung herstellen
global $conn;
$conn = sqlsrv_connect( $serverName ?? $ninchen, $connectionOptions);

// Verbindung überprüfen
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . print_r(sqlsrv_errors(), true));
} else {
    // echo "Verbindung erfolgreich hergestellt.";
}
?>
