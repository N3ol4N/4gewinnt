
function spalte(i) {
    var feld = i;
    var laeufer = document.getElementById(feld).getAttribute("class");
    console.log(laeufer);

    //dieser teil muss per php erfolgen und an die datenbank senden

    if (laeufer == "neutral"){
        console.log("in if zweig");
        document.getElementById(feld).setAttribute("class", "spieler1");
    }else{
        feld=feld+7;
        console.log("in else zweig");
        if(feld<43) {
            spalte(feld);
        }else{
            alert("kann hier keine steine mehr setzen");
        }
    }
}