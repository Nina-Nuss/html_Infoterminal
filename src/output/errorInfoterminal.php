<?php
include '../assets/links.html';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="justify-content-center align-items-center d-flex vh-100">
    <div class="text-center w-100">
        <img class="img-fluid" style="max-width: 300px;" src="/src/images/logo.png" alt="">
    </div>
    <div class="mt-4"></div>
    <div id="error-message">

    </div>
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("../php/getClientIP.php")
            .then(response => response.text())
            .then(data => {
                console.log('IP-Adresse:', data);
                document.getElementById("error-message").innerHTML = "<p>Reparaturarbeiten werden durchgeführt. Bitte haben Sie Geduld.</p>";
            });
    });

    setInterval(() => {
        window.location.href = "index.php";
    }, 10000);
</script>