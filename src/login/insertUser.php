<?php

session_start();

include("../../config/php/connection.php");

// Beispiel-Werte (ersetze mit echten Daten aus POST oder Form)
$username = 'maxmustermann'; // Beispiel-Username
$password = '123'; // Beispiel-Password
$isActive = '1'; // Beispiel-is_active

$username = trim($username);
if (strpos($username, ' ') !== false) {
    echo "Im Benutzernamen befindet sich ein Leerzeichen.";
    exit;
}


// Validierung

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// INSERT mit Prepared Statement
$insertSql = "INSERT INTO user_login (username, password, is_active) VALUES (?, ?, ?)";
$insertParams = array($username, $hashedPassword, $isActive);
$insertResult = sqlsrv_query($conn, $insertSql, $insertParams);

if ($insertResult === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo json_encode(['success' => true, 'message' => 'User erfolgreich eingefügt.']);
}

sqlsrv_close($conn);
?>