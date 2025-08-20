const str = "6x";



function checkNumber(str) {
    if(str != "") {
    }else{
        return false;
    }
    for (const ch of str) {
        if (ch.trim() === "") continue; // Leerzeichen überspringen
        if (!Number.isNaN(Number(ch))) {
            console.log("parseable number:", ch);
        } else {
        console.log("not parseable:", ch);
        return false; 
        }
    }
    return true;
};

var result = checkNumber(str);

console.log(result);

