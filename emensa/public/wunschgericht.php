<form method="post" action="wunschgericht.php">

    <label for="wunschgerichtName">
        Ihr Wunschgerichtsname:
        <input id= "wunschgerichtName" type="text" placeholder="Wunschgericht" name="wunschgerichtName" value="<?php echo $_SESSION["wunschgerichtName"];?>">
    </label> <br>
    <label for="beschreibung">beschriebung:
        <input id= "beschreibung" type="text" placeholder="Beschreibung" name="beschreibung" value="<?php echo $_SESSION["beschreibung"];?>">
    </label> <br>

    <label for="erstellerName">Ihr Name:
        <input id= "erstellerName" type="text" name="erstellerName" value="<?php echo $_SESSION["erstellerName"];?>">
    </label>
    <label for="erstellerEmail">Ihr Email:
        <input id= "erstellerEmail" type="text" name="erstellerEmail" value="<?php echo $_SESSION["erstellerEmail"];?>">
    </label>

    <br>
    <input id="submitGericht" type="submit" name="submitGericht" value="Wunsch abschicken">
</form>

<?php


if(isset($_POST["submitGericht"])){
    $gerichtsname = $_POST["wunschgerichtName"];
    $geichtsbeschreibung = $_POST["beschreibung"];
    $erstellername = $_POST["erstellerName"];
    if($erstellername == ""){
        $erstellername = "anynom";
    }
    $erstelleremail = $_POST["erstellerEmail"];

    $link=mysqli_connect("localhost", // Host der Datenbank
        "root",                 // Benutzername zur Anmeldung
        "root",    // Passwort
        "emensawerbeseite"      // Auswahl der Datenbanken (bzw. des Schemas)
// optional port der Datenbank
    );

    if (!$link) {
        echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
        exit();
    }
    $sql ="INSERT INTO wunschgericht(name, Beschreibung, ersteller_name, ersteller_email) VALUES('$gerichtsname', '$geichtsbeschreibung', '$erstellername', '$erstelleremail')";
    mysqli_query($link, $sql);
    $erfolgreich = true;
}

if($erfolgreich){
    echo "Danke! es wurde gespeichert";
    echo "
        <a href='werbeseite.php'>zurück</a>
    ";
}


