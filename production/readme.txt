production-files in xampp/htdocs laden

Apache und Sql-Server starten

Datenbank mit Namen databases in php MyAdmin anlegen

File datenbank.sql in databases importieren

Im Browser localhost/production aufrufen

_______________
entwicklerkommentar:

getestet auf firefox v.54.0.1 und chrome 60.0.3112.90

zur besseren Nutzbarkeit wurde der die emailfunktion für die challenge auskommentiert und als link direkt in der website implementiert.

zur sicherheit wurden alle einträge aus den formularen durch real_escape_string gefiltert.
außerdem wird jedesmal die session id gecheckt wenn eine neue seite aufgerufen wird.

beim bilder upload ist zu beachten dass nur relativ kleine bilder(getestet mit bilder unter 800kb) verwendet werden können.
der algorithmus der kodierung hat eine zeichenbegrenzung.
zum testen wurden beispielbilder im ordner bilder hinterlegt.





