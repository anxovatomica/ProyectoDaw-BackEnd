function start() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "words.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function () {
        //console.log("peticio 1");
        if (xmlhttp.readyState == 4) {
            respostaWordAjax(xmlhttp);
        }
    };
    xmlhttp.send();
}
var resposta;
function respostaWordAjax(xmlhttp) {
    if (xmlhttp.status == 200) {
        resposta = xmlhttp.responseText;
        console.log("resp1: " + resposta);
        var wordLenght = resposta.length - 2;
        newWord(wordLenght);
        //let respJSON = JSON.parse(resposta);
        //console.log(respJSON.words);
        //let long = respJSON.long;
        /*document.getElementById("palabra").innerHTML="";
        for(let k=0; k<long;k++){
            let span = document.createElement("SPAN");
            span.id="letra"+k;
            span.innerHTML=" _ ";
            document.getElementById("palabra").appendChild(span);
        }*/
    }
}
function newWord(wordLenght) {
    var span = document.getElementById("text");
    span.innerHTML + "";
    //let token = "_";
    for (var index = 0; index < wordLenght; index++) {
        span.innerHTML += " _ ";
    }
    span.innerHTML += "(" + wordLenght + ")";
}
function guess() {
    var usuWord = document.getElementById("txt");
    var lletra = usuWord.value;
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    var vars = "lletra=" + lletra + "&paraula=" + resposta;
    hr.open("POST", "guess.php", true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function () {
        console.log(hr);
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
        }
    };
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
}
