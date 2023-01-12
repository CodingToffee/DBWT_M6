<?php

function hash_baby($passwort)
{
    $salt = "baby";
    return sha1($passwort.$salt);
}

echo hash_baby("hallo");

//pw admin: root
//pw nico@gmail.com: hallo