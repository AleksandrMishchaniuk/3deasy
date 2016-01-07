<?php

/**
 * 
 * @global type $db
 * @param type $login
 * @param type $pass
 * @return type
 */
function getUserByLoginAndPassword($login, $pass){
    $db = getDBConection();
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

/**
 * 
 * @param type $login
 * @return boolean
 */
function isExistUserByLogin($login){
    $db = getDBConection();
    $query = "SELECT login FROM `users`".
            " WHERE `login` = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    if ($stmt->fetch()){
        return TRUE;
    }
    return FALSE;
}

/**
 * 
 * @param type $login
 * @param type $pass
 * @return type
 */
function registrationNewUser($login, $pass){
    $db = getDBConection();
    $query = "INSERT INTO `users` (login,  password)".
            " VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $login, $pass);
    return $stmt->execute();
}