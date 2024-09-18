<?php
/*
production database : bgkirjgh_kcl
user name : bgkirjgh_kcl_user
password : *t)W]EEI;5N@
*/



$db_name = "mysql:host=localhost;dbname=bgkirjgh_kcl";
$db_user_name = "root";
$db_user_pass = "";

$conn = new PDO($db_name, $db_user_name, $db_user_pass);

function create_unique_id()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>