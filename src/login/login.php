<?php
session_start();

include("../../config/php/connection.php");

$file = file_get_contents('php://input');
// Abrufen der JSON-Daten aus der Anfrage
$data = json_decode($file, true);

$userExist = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($data['username'] ?? ''); // Leerzeichen entfernen, Default leer
    $email = trim($data['email'] ?? ''); // Leerzeichen entfernen
    $password = $data['password'] ?? ''; // Leerzeichen entfernen, Default leer
    $remember = $data['remember'] ?? false; // Boolean konvertieren

    // if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    //     echo "Ungültige Email-Adresse.";
    //     exit();
    // }

    // if (strlen($password) < 4) {
    //     echo "Passwort muss mindestens 4 Zeichen haben.";
    //     exit();
    // }
    $sql = "SELECT * FROM user_login";

    $result = sqlsrv_query($conn, $sql);
    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        if (isset($row['username']) && isset($row['password'])) {
            if ($row['username'] == $username && password_verify($password, $row['password']) && $row['is_active'] == 1) {
                $userExist = true;
                $rememberDB = $row['remember_me'];
                $userId = $row['id'];
                $_SESSION['remember'] = $rememberDB;
                $_SESSION['user_id'] = $userId;
                if ($rememberDB != $remember) {
                    $updateSql = "UPDATE user_login SET remember_me = ? WHERE id = ?";
                    $params = [$remember, $userId];
                    $updateResult = sqlsrv_query($conn, $updateSql, $params);
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
