<!DOCTYPE html>
<html lang="en">

<head>
    <meta chrset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Test Page</h1>
    <div id="form">
        <input type="text" id="val1" value="">
        <button id="submit" onclick="update('maxCountForInfoPages', document.getElementById('val1').value)">Submit</button>
        <input type="text" id="val2" value="">
        <button id="submit" onclick="update('maxCountForInfoTerminals', document.getElementById('val2').value)">Submit</button>
        <input type="text" id="val3" value="">
        <button id="submit" onclick="update('maxUsers', document.getElementById('val3').value)">Submit</button>

    </div>


</body>
<script>
    async function getData() {
        const result = await fetch('../../../config/configTest.json')
        return await result.json();

    }
    async function setData() {
        var data = await getData();
        document.getElementById("val1").value = data.webpageSettings[0].maxCountForInfoPages
        document.getElementById("val3").value = data.webpageSettings[0].maxUsers
        document.getElementById("val2").value = data.webpageSettings[0].darkMode
    }

    async function update(key, value) {

        console.log(value);
        const result = await fetch("saveValue.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify([{"key": key, "value": value}])
        });
        const res = await result.json();
        console.log(res);
    }


    setData()

    // console.log(data);

    document.getElementById("submit").addEventListener("click", function() {
        let text = document.getElementById("val1").value


    });
</script>

</html>