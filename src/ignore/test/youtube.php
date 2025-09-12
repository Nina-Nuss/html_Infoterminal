<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
</head>
<style>
    .fullscreen {
        width: 100vw;
        height: 95vh;
        display: block;
        object-fit: contain;
    }

    /* iframe::-webkit-media-controls {
        display: none !important;
    } */
    .text {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5rem;
        font-weight: bold;

    }
</style>

<body>
   
    <!-- Bootstrap CSS -->

</body>
<script>
    var str = "https://www.youtube.com/watch?v=liJVSwOiiwg";
    var strSplit = str.split("v=");
    var videoId = strSplit[1];
    console.log(videoId);
    var iframe = document.querySelector("iframe");
    iframe.allow = "autoplay; encrypted-media";
    iframe.style.border = "none";
    // Hide YouTube progress bar and controls

    iframe.src = "https://www.youtube.com/embed/" + videoId + "?autoplay=1&mute=1&modestbranding=1&rel=0&controls=1&enablejsapi=1";
    iframe.className = "fullscreen";
    iframe.frameBorder = "0";

    var text = document.createElement("div");
    text.innerHTML = "Quelle: " + str;
    text.className = "text";
    document.body.appendChild(text);

    // Hide the select menu on page load

</script>

<iframe
  src="https://www.youtube.com/embed/liJVSwOiiwg?autoplay=1&mute=1&modestbranding=1&rel=0&controls=1&enablejsapi=1"
  width="800" height="450"
  frameborder="0"
  allowfullscreen>
</iframe>

</html>