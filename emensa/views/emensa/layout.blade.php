<!DOCTYPE html>
<html lang="de">
<!--
- Praktikum DBWT. Autoren:
- Majd, Boussad, 3519015
- Nicolas, Harrje, 3518047
-->
<head>
    <meta charset="UTF-8">
    <title>@yield("title")</title>
    <link href="css/emensa.css" rel="stylesheet" />
    @yield("head")
</head>
<body style="margin-bottom: 900px">
<div class="frame border">


    <div class="grid-oben">
        <div class="grid-oben-element border logo">
            <a href="/home"><img src="img/Logo_E-Mensa.PNG" alt="E-Mensa Logo" height="auto" width="100%"></a>
        </div>
        <div class="grid-oben-element border">
            <ul class="nav">
                <li> <a href="/home#info">Ankündigung</a></li>
                <li> <a href="/home#speisen">Speisen</a></li>
                <li> <a href="/home#zahlen">Zahlen</a></li>
                <li> <a href="/home#kontakt">Kontakt</a></li>
                <li> <a href="/home#wichtig">Wichtig für uns</a></li>
            </ul>


        </div>
        <ul style="position: absolute; right: 10%; list-style-type: none">
            @if(isset($_SESSION["cookie"]))
                <li>Angemeldet als <a href="/profile" > {{$_SESSION["benutzer_name"]}}</a></li>
                <li><a href="/abmelden" >Abmelden</a></li>
            @else
                <li><a href="/anmeldung" >Anmelden</a></li>
            @endif
        </ul>

    </div>
    <hr>
    <div class="grid-main">
        @yield("main")

    </div>



    <br>
    <br>
    <br>
    <br>
    <hr>
    <footer>
        @yield("footer")
        <h1 class="center footer">Wir freuen uns auf Ihren Besuch!</h1>
    </footer>
</div>

</body>
</html>