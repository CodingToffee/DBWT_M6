<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "bewertung"
 */
function safe_bewertung($sternebewertung, $bemerkung, $benutzer_id,$gericht_id) {
        $link = connectdb();

        $sql = "INSERT INTO bewertung (bemerkung, sternebewertung, benutzer_id, gericht_id) VALUES ('$bemerkung','$sternebewertung','$benutzer_id','$gericht_id')";
        $result = mysqli_query($link, $sql);

        mysqli_close($link);
    }

    function letzte_30() {
        $link = connectdb();

        $sql = "SELECT bewertung.bewertungszeitpunkt, bewertung.bemerkung, bewertung.sternebewertung, bewertung.id, bewertung.benutzer_id, gericht.name 
                FROM bewertung 
                INNER JOIN gericht ON bewertung.gericht_id = gericht.id
                ORDER BY bewertungszeitpunkt DESC 
                LIMIT 30";
        $result = mysqli_query($link, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);

        return $data;
    }

    function bewertungen_benutzer($benutzerid) {
        $link = connectdb();

        $sql = "SELECT bewertung.bewertungszeitpunkt, bewertung.bemerkung, bewertung.sternebewertung, gericht.name 
                FROM bewertung 
                INNER JOIN gericht ON bewertung.gericht_id = gericht.id
                WHERE benutzer_id = '$benutzerid'
                ORDER BY bewertungszeitpunkt DESC";

        $result = mysqli_query($link, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);

        return $data;
    }

    function bewertung_loeschen($id) {
        $link = connectdb();

        $sql = "DELETE FROM bewertung WHERE id = '$id'";

        mysqli_query($link, $sql);

        mysqli_close($link);
    }