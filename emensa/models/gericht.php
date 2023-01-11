<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all() {
    try {
        $link = connectdb();

        $sql = 'SELECT id, name, beschreibung FROM gericht ORDER BY name';
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
        return $data;
    }

}

function db_gericht_select_names_preis_intern(){
    try {
        $link = connectdb();

        $sql = 'SELECT name, preis_intern FROM gericht 
                          where preis_intern > 2 
                          order by name desc ';
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
        return $data;
    }
}

function zufaellige_gerichte(){
    try {
        $link = connectdb();

        $sql = "SELECT id ,name, 
                               preis_intern, 
                               preis_extern,
                               bildname,
                               group_concat(code) as code
                                    from gericht
                             left join gericht_hat_allergen on gericht.id = gericht_hat_allergen.gericht_id
                         group by gericht.name ORDER BY RAND() limit 5";
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
        return $data;
    }

}

function codes_from_zufaellige_gerichte($data)
{

    $codes = "";
    foreach ($data as $gericht) {
        if ($gericht['code'] != null) {
            if ($codes != "") {
                $codes .= ',';

            }
            $codes .= $gericht['code'];
        }
    }
    $codes = explode(",", $codes);
    for ($i = 0; $i < count($codes); $i++)
        $codes[$i] = "'" . $codes[$i] . "'";

    // wieder als String sprichern
    $codes = implode(",", $codes);

    try {
        $link = connectdb();

        $sql = "SELECT code, name FROM allergen WHERE code IN ($codes)";
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    } catch (Exception $ex) {
        $data = array(
            'id' => '-1',
            'error' => true,
            'name' => 'Datenbankfehler ' . $ex->getCode(),
            'beschreibung' => $ex->getMessage());
    } finally {
        return $data;
    }
}

function gericht_bewertung($id) {
        try {
            $link = connectdb();

            $sql = "SELECT name, bildname FROM gericht WHERE id = '$id'";
            $result = mysqli_query($link, $sql);

            $data = mysqli_fetch_all($result, MYSQLI_BOTH);

            mysqli_close($link);
        }
        catch (Exception $ex) {
            $data[0] = array(
                'id'=>'-1',
                'error'=>true,
                'name' => 'Datenbankfehler '.$ex->getCode(),
                'beschreibung' => $ex->getMessage());
        }
        return $data[0];
}
