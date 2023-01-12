<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function benutzer_select($id) {
    try {
        $link = connectdb();

        $sql = "SELECT * FROM benutzer WHERE id='$id'";

        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'error'=>true,
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data[0];
    }

}