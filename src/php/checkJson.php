<?php
// include("connection.php");
include("../database/selectInfotherminal.php");
include("../database/selectSchemas.php");

ob_end_clean();
session_start();

$infoterminalListLength = count($infotherminalList1);
$schemalistLength = count($schemaList1);



$jsonFile = '../../config/config.json'; // Pfad zur JSON-Datei
$jsonData = json_decode(file_get_contents($jsonFile), true); // In ein PHP-Array umwandeln


foreach ($jsonData as $key => $value) {
    if ($key === 'defaultMaxCountForInfoTerminals') {
        $_SESSION['defaultMaxCountForInfoTerminals'] = $value;
        $_SESSION['infoterminalListLength'] = $infoterminalListLength;
    }
    if ($key === 'defaultMaxCountForInfoPages') {
        $_SESSION['defaultMaxCountForInfoPages'] = $value;
        $_SESSION['schemalistLength'] = $schemalistLength;
    }

}
