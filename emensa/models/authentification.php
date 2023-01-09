<?php


function auth($passwort, $email)
{
    $link = connectdb();
    $salt = "baby";
    $hash = sha1($passwort.$salt);
    mysqli_begin_transaction($link);
    $sql = "SELECT * FROM benutzer WHERE email = '$email' AND passwort = '$hash'";
    $result = mysqli_query($link,$sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    if ($data[0] != null) {
        $id = $data[0]['id'];
        //update anzahlanmeldungen
        $sql = "UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen +1 WHERE id = '$id'";
        mysqli_query($link,$sql);
        //Update letzteanmeldung
        $sql = "UPDATE benutzer SET letzteanmeldung = NOW() WHERE id = '$id'";
        mysqli_query($link,$sql);
    }
    else {
        //update letzterfehler
        $sql = "UPDATE benutzer SET letzterfehler = NOW() WHERE email = '$email'";
        $result = mysqli_query($link,$sql);
    }
    mysqli_commit($link);
    mysqli_close($link);
    return $data[0];
}


