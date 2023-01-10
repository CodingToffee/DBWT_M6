<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "bewertung"
 */
function safe_bewertung($sternebewertung, $bemerkung, $benutzer_id) {
        $link = connectdb();

        $sql = "INSERT INTO bewertung (bemerkung, sternebewertung, benutzer_id) VALUES ('$bemerkung','$sternebewertung','$benutzer_id')";
        $result = mysqli_query($link, $sql);

        mysqli_close($link);
    }