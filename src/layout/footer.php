<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <?php include '../assets/links.html'; ?>

    <style>
        #ticker {
            width: 100%;
            color: #ffffff;
            background-color: green;
            font-weight: bold;
         
            white-space: nowrap;
            overflow: hidden;
            font-weight: 700;
        }

        #ticker span {
            display: inline-block;
            animation: ticker 700s linear infinite;
            font-weight: 700;
        }

        @keyframes ticker {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }
       
    </style>
</head>


<body>
    <div class="parallelogram">
        <div class="para_inhalt text d-flex justify-content-between align-items-center px-5 gap-2">
            <div class="me-5 pr-3">Tagesschau.de</div>
            <div>
                <div id="ticker">
                    <span>Lade Nachrichten...</span>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function fetchRSS() {
            const response = await fetch('https://www.tagesschau.de/infoservices/alle-meldungen-100~rss2.xml');
            const text = await response.text();
            const parser = new DOMParser();
            const xml = parser.parseFromString(text, 'application/xml');
            const items = xml.querySelectorAll('item');
            let tickerText = '';
            items.forEach(item => {
                const title = item.querySelector('title').textContent;
                tickerText += title + ' *** ';
            });
            // Text verdoppeln für nahtlosen Übergang
            tickerText = tickerText + tickerText;
            document.getElementById('ticker').innerHTML = '<span>' + tickerText + '</span>';
            
            
        }

        document.addEventListener('DOMContentLoaded', fetchRSS);
        setInterval(fetchRSS, 360000);
    </script>

</body>

</html>