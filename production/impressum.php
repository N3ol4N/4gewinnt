<footer class="footer navbar-fixed-bottom">
    <div id="impressum">
        Illi Rahel, König Stefanie, Lang Heiko, Mannsdörfer Andreas<br>
        Kontakt:
    </div>
</footer>
<script type="application/javascript">
    function mail() {
        var praefix = "h.lang1508";
        var address = "googlemail.";
        var suffix = "com";
        var mail = document.createElement("a");
        mail.appendChild(document.createTextNode(praefix + "@" + address + suffix));
        mail.setAttribute("href", "mailto:" + praefix + "@" + address + suffix);
        document.getElementById("impressum").appendChild(mail);
    }
</script>
