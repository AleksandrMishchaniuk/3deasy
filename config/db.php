<?php

function getDBConection(){
    $dblocation = "127.0.0.1";
    $dbname = "3deasy";
    $dbuser = 'root';
    $dbpwd = "";
    
    $db = new mysqli($dblocation, $dbuser, $dbpwd, $dbname);

    if ($db->connect_error) {
        die('Ошибка подключения (' . $db->connect_errno . ') '
                . $db->connect_error);
    }

    mysqli_set_charset($db, 'utf8');
    
    return $db;
}