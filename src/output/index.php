<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/anzeige.css">
</head>
<style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    header,
    footer {
        display: flex;
        flex-direction: column;
        padding: 0%;
        z-index: 1;

    }

    .iframe-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 74vw;
        height: 74vh;
        /* border: 1px solid black; */

        box-sizing: border-box;
        /* <- verhinder Überlauf */
    }


    .iframe-container iframe {
        height: 74vh;
        width: 74vw;
        border: none;
        object-fit: cover;
        display: block;

    }

    /* 
    @media screen and (max-width: 1920px) {
        .iframe-container {
            border: 8px solid pink;
        }
    } */


    @media screen and (max-width: 1920px) {
        .iframe-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 74.5vw;
            height: 74.5vh;
            /* border: 1px solid black; */

            box-sizing: border-box;
            /* <- verhinder Überlauf */
        }


    }

    @media screen and (min-width: 3840px) {
        .iframe-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 74.5vw;
            height: 74.5vh;
            /* border: 1px solid black; */

            box-sizing: border-box;
            /* <- verhinder Überlauf */
        }
    }
</style>
</head>


<header>
    <?php include '../layout/logo.php'; ?>
    <?php include '../layout/header.php'; ?>
</header>

<body>
    <div style="display: flex; justify-content: center;">
        <div class="iframe-container" id="container"></div>
    </div>
</body>

<footer>
    <?php include  '../layout/footer.php'; ?>
</footer>


<script>
    window.addEventListener('DOMContentLoaded', async () => {
        const params = new URLSearchParams(window.location.search);
        const ort = params.get('ip');
        const container = document.getElementById('container');
        const ip = await checkIP(ort);
        console.log(ip);
        if (ort && container != null && ip != false) {
            startCarousel(ort);
        } else {
            container.innerHTML = `<p class="text-danger">name ${ort} ist keiner gültigen IP-Adresse zugeordnet</p>`;
        }
    });

    function startCarousel(ort) {
        const iframe = document.createElement('iframe');
        // Variablen als Query-Parameter anhängen
        let data = `out.php?ip=${encodeURIComponent(ort)}`;
        // Wenn du weitere Variablen hast, einfach anhängen:
        // data += `&foo=${encodeURIComponent(foo)}`;
        iframe.src = data;
        container.appendChild(iframe);
    }


    async function checkIP(ort) {
        const response = await fetch("../php/checkURL.php?ip=" + ort);
        const clientIP = await response.text();
        return clientIP; // Rückgabe der IP-Adresse für weitere Verwendung
    }
</script>

</html>