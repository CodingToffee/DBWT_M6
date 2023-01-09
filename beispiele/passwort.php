<?php

function hash_baby($passwort)
{
    $salt = "baby";
    return sha1($passwort.$salt);
}

echo hash_baby("root");