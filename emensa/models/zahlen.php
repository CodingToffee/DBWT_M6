<?php

function db_zahlen_besucher() {
    $link = connectdb();

    $sql = "SELECT views FROM besucher";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH)[0];

    mysqli_close($link);
    return $data;
}
function db_zahlen_gerichte() {
    $link = connectdb();

    $sql = "SELECT count(*) FROM gericht";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH)[0];

    mysqli_close($link);
    return $data;
}
function db_zahlen_anmeldungen() {
    $link = connectdb();

    $sql = "SELECT count(*) FROM newsletter";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH)[0];

    mysqli_close($link);
    return $data;
}

function update_besucher(){
    $link = connectdb();

    $sql = "UPDATE besucher set views = views + 1";
    mysqli_query($link, $sql);
    mysqli_close($link);
}