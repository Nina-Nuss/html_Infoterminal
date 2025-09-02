<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include '../assets/links.html'; ?>
    <?php include '../assets/scripts.html'; ?>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card w-25">
            <div class="card-body">
                <form class="d-flex flex-column justify-content-center">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Benutzername</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <!-- <div id="emailHelp" class="form-text">bite Benutzername eingeben.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Angemeldet bleiben</label>
                    </div>
                    <button  id="loginForm" class="btn btn-primary">Einloggen</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        event.preventDefault();
        var username = document.getElementById('exampleInputEmail1').value;
        var password = document.getElementById('exampleInputPassword1').value;

        if (username === '' || password === '') {
            alert('Bitte füllen Sie alle Felder aus.');
            event.preventDefault();
        }
        fetch("login.php").then(async (response) => {
            this.responseText = await response.text();
            var obj = JSON.parse(this.responseText);

            obj.forEach(o => {
                anzeigebereichv.innerHTML += o + `<br>`
            });

        });

    });

</script>

</html>

<head>

</head>