<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
</head>


<body>
    <iframe src="" frameborder="0"></iframe>
    <select class="form-select" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <option value="img" selected>Bilder Video</option>
        <option value="yt">Youtube</option>

    </select>
</body>
<script>
    var str = "https://www.youtube.com/watch?v=liJVSwOiiwg"
    var strSplit = str.split("v=")
    var videoId = strSplit[1];
    console.log(videoId);
    var iframe = document.createElement("iframe");
    iframe.src = "https://www.youtube.com/embed/" + videoId;
    iframe.frameBorder = "0";
    document.body.appendChild(iframe);
</script>

</html>