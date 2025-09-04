<?php
<<<<<<< HEAD
include "checkJson.php";
include 'connection.php';
=======

ob_start();

include "checkJson.php";
include '../../config/php/connection.php';

ob_clean();

>>>>>>> origin/main


// Überprüfen, ob beide Werte vorhanden sind
if ($ip !== '' && $name !== '' &&  $listelengthValue[1][1] < $listelengthValue[1][0]) {
    // SQL-Abfrage mit Prepared Statement
    $sql = "INSERT INTO infotherminals (titel, ipAdresse) VALUES (?, ?)";
    $params = array($name, $ip);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt) {
        // Statement ausführen
        if (sqlsrv_execute($stmt)) {
<<<<<<< HEAD
            echo "Datensatz erfolgreich eingefügt";
=======
            // echo "Datensatz erfolgreich eingefügt";
>>>>>>> origin/main
            $ip = "";
            $name = "";
        } else {
            echo "Fehler beim Einfügen: ";
            print_r(sqlsrv_errors());
        }
        // Statement schließen
<<<<<<< HEAD
        sqlsrv_free_stmt($stmt);
    } else {
        echo "Fehler bei der Vorbereitung: ";
=======
      
    } else {
        // echo "Fehler bei der Vorbereitung: ";
>>>>>>> origin/main
        print_r(sqlsrv_errors());
    }
} else {
    echo "Fehler: IP oder Name nicht gesetzt, oder maximale Anzahl an Infoterminals erreicht.";
}
<<<<<<< HEAD
=======
sqlsrv_free_stmt($stmt);
>>>>>>> origin/main

sqlsrv_close($conn);
?>