//function to print the list of parties
function getpartyList() {
    var request = new XMLHttpRequest();
    var path = "logic/loadgamelist.php";
    var div = document.getElementById("gamelist");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
        }

    };

    request.send();
    window.setTimeout("getpartyList()", 6000);
}

//function to join a party
function joinparty(Spiel_ID) {
    var request = new XMLHttpRequest();
    var path = "logic/joinparty.php?gameID=" + Spiel_ID;
    var div = document.getElementById("messages");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
            getpartyList();
            //document.location.href= "gametable.php";
        }
    };
    request.send();
}

//function to create a party
function createparty() {
    var request = new XMLHttpRequest();
    var path = "logic/createparty.php?createparty";
    var div = document.getElementById("messages");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
            getpartyList();
            document.location.href = "gametable.php";
        }
    };
    request.send();
}

//function to logout
function logout() {
    var request = new XMLHttpRequest();
    var path = "logic/logout.php";

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.send();

    document.location.href = "index.php";
}

//function to select a row to put a chip into
function spalte(spalte) {
    var request = new XMLHttpRequest();
    var path = "logic/gamelogic.php?row=" + spalte;
    var div = document.getElementById("message");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
            getgame(colorset);
        }
    };

    request.send();
}

//function to print the current game
function getgame(colorset) {
    var request = new XMLHttpRequest();
    var path = "logic/gamelogic.php?getgame=" + colorset;
    var div = document.getElementById("gamecontainer");

    request.open("GET", path, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var return_data = request.responseText;
    div.innerHTML = return_data;

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            div.innerHTML = return_data;
        }
    };

    request.send();
    window.setTimeout("getgame(colorset)", 6000);
}

//function to select a color scheme on your current game
function setcolor(value) {
    colorset = value;
    getgame(colorset);

}
