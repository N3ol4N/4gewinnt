systemstart:

production-files in xampp/htdocs laden

Apache und Sql-Server starten

Datenbank mit Namen databases in php MyAdmin anlegen

File datenbank.sql in databases importieren

Im Browser localhost/production aufrufen

______________
hinweis:

zur einfacheren bedienung haben wir bereits einen beispieluser in der datenbank. für den zugang mit diesem user gilt:

nickname: user1
email: user1@test.de
pw: user1

profilbilder können über das accountmanagement hinzugefügt werden und werden auch dort angezeigt

ajax requests finden sich gehäuft innerhalb von gametable.php. die buttons für die spielsteineinwürfe senden per javascript einen request.

um einen reibungsfreien ablauf zu garantieren ist es sinnvoll sich auf unterschiedlichen browsern mit unterscheidlichen usern anzumelden
des weiteren sollte man nicht in einem spiel einen zug machen bevor ein zweiter spieler dem spiel beigetreten ist
______________

entwicklerkommentar:

getestet auf firefox v.54.0.1 und chrome 60.0.3112.90
getestet auf einem widescreen-bildschirm und maximiertem browser

sollten die spieloberfläche oder die lobby aufflackern, passiert dies auf Grund des automatisierten pollings.

zur besseren Nutzbarkeit wurde der die emailfunktion für die challenge auskommentiert und als link direkt in der website implementiert. (vgl registration.php zeile 97/98)

zur sicherheit wurden alle einträge aus den formularen durch real_escape_string gefiltert.
außerdem wird jedesmal die session id gecheckt wenn eine neue seite aufgerufen wird.

beim bilder upload ist zu beachten, dass nur relativ kleine bilder(getestet mit bilder unter 800kb) verwendet werden können.
der algorithmus der kodierung hat eine zeichenbegrenzung.
zum testen wurden beispielbilder im ordner bilder hinterlegt.





