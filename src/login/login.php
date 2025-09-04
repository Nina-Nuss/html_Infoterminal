<?php
<<<<<<< HEAD

include("connection.php");
=======
session_start();

include("../../config/php/connection.php");

$file = file_get_contents('php://input');
// Abrufen der JSON-Daten aus der Anfrage
$data = json_decode($file, true);
>>>>>>> origin/main

$userExist = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
<<<<<<< HEAD
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM login";
    $result = sqlsrv_query($conn, $sql);
    if ($result === false) {

        die(print_r(sqlsrv_errors(), true));
    }
    $unsereTabelle = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        if (isset($row['email']) && $row['password'] !== null) {
            if($row['email'] == $username && $row['password'] == $password){
                $userExist = true;
                $currentUser = $row['email'];
            }
            array_push($unsereTabelle, array(
                $id = $row["id"],
                $email = $row["email"],
                $passwort = $row["password"],
                // $obj = new Account($row["id"], $row["email"], $row["password"])
            ));
        }
    };
    if($userExist == true){
        echo "willkommen " . $currentUser;
    }else{
        header("Location: index.php");
        exit();
    }

=======
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
            }
        }
    }

    if ($userExist == true) {
        $_SESSION['remember'] = $remember;
        $_SESSION['username'] = $username;
        if ($remember) {
            setcookie('username', $username, time() + 86400 * 30); // 30 Tage
        }
        echo json_encode($userExist);
        exit();
    } else {
        echo json_encode($userExist);
    }
>>>>>>> origin/main

}
