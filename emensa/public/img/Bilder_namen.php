<?php

$link = mysqli_connect("localhost", "root", "root", "emensawerbeseite");
$files = glob('./emensa/public/img/gerichte/{*.png,*.jpg}', GLOB_BRACE);
$error_name = null;
foreach ($files as $file) {

    $filename = basename($file);
    $gericht_id = explode('_', $filename)[0];

    $sql = "UPDATE gericht set bildname= '$filename' WHERE id = '$gericht_id'";

    mysqli_query($link, $sql);

    if($gericht_id == 0){
        $error_name = $filename;
    }

}

$sql = "UPDATE gericht set bildname='$error_name' WHERE bildname is null";
mysqli_query($link, $sql);