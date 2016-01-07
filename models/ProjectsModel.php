<?php

function getProjectsByUserId($user_id){
    $db = getDBConection();
    $projects = array();
    $query = "SELECT id, name FROM `projects`".
            " WHERE `users_id` = ?";
    if($stmt = $db->prepare($query)){
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        $i = 0;
        while ($stmt->fetch()){
            $projects[$i]['id'] = $id;
            $projects[$i]['name'] = $name;
            $i++;
        }
    }
    return $projects;
}

/**
 * 
 * @param type $name
 * @param type $data
 * @param type $userId
 * @return type
 */
function saveNewProject($name, $data, $userId){
    $db = getDBConection();
    $query = "INSERT INTO `projects` (users_id, name, data)".
            " VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('iss', $userId, $name, $data);
    return $stmt->execute();
}


function getLastProjectByUserId($userId){
    $db = getDBConection();
    $project = array();
    $query = "SELECT id, name, data FROM `projects`".
            " WHERE `users_id` = ?".
            " ORDER BY id DESC LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($id, $name, $data);
    while ($stmt->fetch()){
        $project['id'] = $id;
        $project['name'] = $name;
        $project['data'] = $data;
    }
    return $project;
}

function isExistProjectByUserIdAndName($userId, $name){
    $db = getDBConection();
    $query = "SELECT name FROM `projects`".
            " WHERE (`users_id` = ? AND `name` = ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("is", $userId, $name);
    $stmt->execute();
    if ($stmt->fetch()){
        return TRUE;
    }
    return FALSE;
}