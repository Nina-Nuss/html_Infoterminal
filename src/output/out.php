<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
        crossorigin="anonymous"></script>

</head>
<style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }



    .fullscreen {
        width: 100vw;
        height: 100vh;
        display: block;
        object-fit: contain;
    }


    video::-webkit-media-controls {
        display: none !important;
    }


    .fullscreenYoutube {
        width: 100vw;
        height: 97vh;
        display: block;
        object-fit: contain;
    }

    /* iframe::-webkit-media-controls {
        display: none !important;
    } */
    .textYoutube {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5rem;
        font-weight: bold;
        background-color: white;

    }
</style>

<body>




</body>

<script>
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    function errorAnzeige() {
        document.body.innerHTML = '<h5 class="text-danger d-flex justify-content-center align-items-center vh-100">Fehler beim Laden der Inhalte, versuche es erneut...</h5>';
        setTimeout(() => location.reload(), 10000);
    }
    async function carousel() {
        const params = new URLSearchParams(window.location.search);
        const ort = params.get('ip');
        const template = params.get('template');
        try {
            if (template) {
                console.log("Template geladen");
                if (template.includes('img_')) {
                    createPic(template);
                } else if (template.includes('video_')) {
                    createVid(template);
                } else if (template.includes('yt_')) {
                    createYoutubeVid(template);
                }
                return;
            }
            const response = await fetch("../database/getSchemas.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    ip: ort
                }), // Beispieldaten
            });

            if (!response.ok) {
                if (response.status === 404) {
                    console.error('404 Not Found: URL nicht gefunden');
                    // Hier deinen Code ausführen, z.B. Reload
                    errorAnzeige();
                    return;
                }
                console.error('Error fetching data:', response.status, response.statusText);
                return;
            }

            let data = await response.json();
            console.log(data);

            while (data.length === 0) {
                console.error('No data received or data is null/undefined');
                document.body.innerHTML = '<h5 class="text-danger d-flex justify-content-center align-items-center vh-100">Kein Inhalt verfügbar, bitte haben Sie Geduld...</h5>';
                await sleep(10000); // Warte 10 Sekunden, bevor du es erneut versuchst
                const retryResponse = await fetch("../database/getSchemas.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        ip: ort
                    }), // Beispieldaten
                });

                if (!retryResponse.ok) {
                    console.error('Error fetching data:', retryResponse.statusText);
                    return;
                }

                const retryData = await retryResponse.json();
                console.log('Retry data:', retryData);
                if (retryData.length > 0) {
                    data = retryData; // Aktualisiere die Daten, wenn sie jetzt verfügbar sind
                }
            }

            console.log('Received data:', data);
            while (true) {
                for (const element of data) {
                    if (element[1].includes('img_')) {
                        createPic(element[1])
                        // const img = document.createElement('img');
                        await sleep(element[2]); //wartet bis nächstes Bild angeziegt wird
                    } else if (element[1].includes('video_')) {
                        createVid(element[1])
                        await sleep(element[2]); //wartet bis nächstes Bild angeziegt wird
                    } else if (element[1].includes('yt_')) {
                        createYoutubeVid(element[1])
                        await sleep(element[2]); //wartet bis nächstes Bild angeziegt wird
                    }
                    if (data.length === 0) {
                        location.reload();
                    }
                }
                location.reload();
            }
        } catch (error) {
            console.error('Fetch error:', error);
            errorAnzeige();

        }
    }
    window.addEventListener('DOMContentLoaded', async () => {
        try {
            carousel();
        } catch (error) {
            console.error('Fetch error:', error);
            errorAnzeige();
        }

    });

    function createPic(element) {
        const img = document.createElement('img');
        img.src = "../../uploads/img/" + element;
        img.className = "fullscreen";
        img.alt = "Image";

        document.body.innerHTML = ''; // Clear the body content
        document.body.appendChild(img); // Add the new image to the body
    }

    function createYoutubeVid(element) {
        var strSplit = element.split("v=");
        var videoId = strSplit[1];
        console.log(videoId);
        var iframe = document.createElement("iframe");
        iframe.allow = "autoplay; encrypted-media; picture-in-picture";
        iframe.style.border = "none";
        // Hide YouTube progress bar and controls
        iframe.allowFullscreen = true;
        iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1&modestbranding=1&rel=0&controls=1&enablejsapi=1`;
        iframe.className = "fullscreenYoutube";
        iframe.frameBorder = "0";
        document.body.innerHTML = ''; // Clear the body content
        var text = document.createElement("div");
        text.classList = "textYoutube";
        text.innerHTML = "Quelle: " + iframe.src;
        text.className = "text";

        document.body.appendChild(iframe); // Add the new iframe to the body
        document.body.appendChild(text);
    }

    function createVid(element) {
        const video = document.createElement('video');
        video.src = "../../uploads/video/" + element;
        video.className = "fullscreen";
        video.controls = true; // Video Controls hinzufügen
        video.autoplay = true; // Video automatisch starten
        video.loop = true; // Video in einer Schleife abspielen
        video.playsInline = true; // Für mobile Geräte
        video.muted = true; // Meistens erforderlich für Autoplay in Browsern
        document.body.innerHTML = ''; // Clear the body content
        document.body.appendChild(video); // Add the new video to the body
    }
</script>


</html>