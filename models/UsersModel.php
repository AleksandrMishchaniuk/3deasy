<?php

/**
 * 
 * @global type $db
 * @param type $login
 * @param type $pass
 * @return type
 */
function getUserByLoginAndPassword($login, $pass){
    global $db;
    $user = NULL;
    $query = "SELECT id, login FROM `users`".
            " WHERE (`login` = ? and `password` = ?)".
            " LIMIT 1";
    if($stmt = $db->prepare($query)){
        $user = array();
        $stmt->bind_param("ss", $login, $pass);
        $stmt->execute();
        $stmt->bind_result($id, $log);
        while ($stmt->fetch()){
            $user['id'] = $id;
            $user['login'] = $log;
        }
    }
    return $user;
}