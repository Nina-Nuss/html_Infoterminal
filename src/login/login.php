<?php
session_start();
ob_start();

require("../database/selectUser.php");
include("../../config/php/connection.php");


ob_end_clean();

$file = file_get_contents('php://input');
// Abrufen der JSON-Daten aus der Anfrage
$data = json_decode($file, true);

$userExist = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($data['username'] ?? 'user'); // Leerzeichen entfernen, Default leer
    $email = trim($data['email'] ?? ''); // Leerzeichen entfernen
    $password = $data['password'] ?? '0000'; // Leerzeichen entfernen, Default leer
    $remember = $data['remember']; // Boolean konvertieren
    // if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    //     echo "Ungültige Email-Adresse.";
    //     exit();
    // }



    // if (strlen($password) < 4) {
    //     echo "Passwort muss mindestens 4 Zeichen haben.";
    //     exit();
    // // }
    foreach ($userList as $row) {
        if (isset($row['username']) && isset($row['password'])) {
            if ($row['username'] == $username && password_verify($password, $row['password']) && $row['is_active'] == 1) {
                $userExist = true;
                $_SESSION['remember'] = $row['remember_me'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['is_admin'] = $row['is_admin'];
                $_SESSION['is_active'] = $row['is_active'];
                if ($row['remember_me'] != $remember) {
                    $updateSql = "UPDATE user_login SET remember_me = ? WHERE id = ?";
                    $params = [$row['remember_me'],  $row['id']];
                    $updateResult = sqlsrv_query($conn, $updateSql, $params);
                    sqlsrv_free_stmt($updateResult);
                    if ($updateResult === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                }
            }
        }
    }
    if ($userExist == true) {
        echo json_encode([
            'success' => $userExist,
            'message' => 'Login erfolgreich'
        ]);
        exit();
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Login fehlgeschlagen'
        ]);
        exit();
    }
}

