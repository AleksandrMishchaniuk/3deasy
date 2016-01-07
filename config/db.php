<?php

function getDBConection(){
    $dblocation = "127.0.0.1";
    $dbname = "3deasy";
    $dbuser = 'root';
    $dbpwd = "";

    $db = new mysqli($dblocation, $dbuser, $dbpwd, $dbname);

    if(!$db){
    //    echo 'Ошибка доступа к mySQL';
        $message = 'Ошибка доступа к mySQL';
    }

    mysqli_set_charset($db, 'utf8');
    
    return $db;
}