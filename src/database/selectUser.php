<?php
// ...existing code...

include '../../config/php/connection.php';

$sql = "SELECT * FROM user_login";
$result = sqlsrv_query($conn, $sql);

if ($result === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Abfragefehler']);
    exit;
}

$userList = [];
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $values = [];
    foreach ($row as $col => $val) {
        $values[] = $val ?? '';
    }
    $userList[] = $values;
}
sqlsrv_free_stmt($result);
sqlsrv_close($conn);



echo json_encode($userList);
?>
