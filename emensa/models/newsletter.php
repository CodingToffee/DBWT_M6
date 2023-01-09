<?php

function anmelden(RequestData $rd){

    $name = trim($rd->query["Name"]); // trimming
    $name = preg_replace('/[\x00-\x1F\x7F]/u', '', $name); // removing unsichtbare Chars

//Whitespaces entfernen
    $email = trim($rd->query["Email"]);

//Datenschutz
    $ds = $rd->query["ds"];
//Language
    $lan = $rd->query["lan"];


//Feld für Fehlermeldungen erzeugen
    $msgs = [];


    $fehler = false;

//Fehlermeldung für fehlenden Namen
    if($name == ""){
        $msgs[] = 'Dein Name ist leer';
        $fehler = true;

    }

//Fehlermeldung für fehlendes Häckchen
    if($ds == NULL){
        $msgs[] = 'Bitte setze das Häckchen für den Datenschutz';
        $fehler = true;
    }

//Fehlermeldung für ungültiges mail Format
    $invalidEmail = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msgs[] = 'Invalid email format';
        $fehler = true;
        $invalidEmail = true;
    }


    $domain = substr(strrchr($email, "@"), 1);
    $dispose_domain = array();
    /*
    * fetching disposable emails from text file to array.
    */
    $handle = fopen("../models/dispose.txt", "r");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $dispose_domain[$data[0]] = $data[0];
    }
    fclose($handle);
    /*
    * checking disposable email addresses which are stored in text file dispos1.txt
    */
    if (in_array($domain, $dispose_domain) || str_contains($domain, "trashmail.")) {
        $fehler = true;
        if($invalidEmail)
            $msgs[] = 'btw, Deine E-Mail Adresse ist trash';
        else
            $msgs[] = 'Deine E-Mail Adresse ist trash';
    }

    if(!$fehler){
        $link = connectdb();
        $sql ="INSERT INTO newsletter(name, email, sprache) VALUES('$name', '$email', '$lan')";
        mysqli_query($link, $sql);
        mysqli_close($link);
    }

    return $msgs;
}