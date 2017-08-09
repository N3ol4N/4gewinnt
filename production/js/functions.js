function getpartyList(){
    var request = new XMLHttpRequest();
    var path = "logic/loadgamelist.php";
    var div = document.getElementById("gamelist");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
        }

    }

    request.send();
    window.setTimeout("getpartyList()", 6000);
}

function joinparty(Spiel_ID)
{
    var request = new XMLHttpRequest();
    var path = "logic/joinparty.php?gameID="+Spiel_ID;
    var div = document.getElementById("messages");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
            getpartyList();
        }
    }

    request.send();

}

function createparty()
{
    var request = new XMLHttpRequest();
    var path = "logic/createparty.php?createparty";
    var div = document.getElementById("messages");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
            getpartyList();
        }
    }

    request.send();
}

function logout()
{
    var request = new XMLHttpRequest();
    var path = "logic/logout.php";

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.send();

    document.location.href= "index.php";
}

function spalte(spalte)
{
    var request = new XMLHttpRequest();
    var path = "logic/gamelogic.php?row="+spalte;
    var div = document.getElementById("message");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
        }
    }

    request.send();
}

function getgame(colorset)
{
    var request = new XMLHttpRequest();
    var path = "logic/gamelogic.php?getgame="+colorset;
    var div = document.getElementById("gamecontainer");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
        }
    }

    request.send();
    window.setTimeout("getgame(colorset)", 6000);
}


function setcolor(value)
{
    colorset=value;
    getgame(colorset);
/*
    var request = new XMLHttpRequest();
    var path = "logic/gamelogic.php?getgame=value";
    var div = document.getElementById("gamecontainer");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
        }
    }



    console.log(value);
    if(value == "redyellow"){
        var div = document.getElementsByClassName("spieler1");
        div[0].classList.toggle("red");
        var div = document.getElementsByClassName("spieler2");
        div[0].classList.toggle("yellow");
    }
    if(value == "yellowred"){
        var div = document.getElementsByClassName('spieler1');
        console.log(div[0]);
        div[0].classList.toggle("yellow");
        var div = document.getElementsByClassName("spieler2");
        div[0].classList.toggle("red");
    }
    */
}
