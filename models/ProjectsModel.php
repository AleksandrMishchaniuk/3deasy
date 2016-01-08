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
    $query = "SELECT id, name FROM `projects`".
            " WHERE `users_id` = ?".
            " ORDER BY id DESC LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($id, $name);
    while ($stmt->fetch()){
        $project['id'] = $id;
        $project['name'] = $name;
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

/**
 * 
 * @param type $proj_id
 * @param type $user_id
 * @return type
 */
function getProjectByIdAndUserId($proj_id, $user_id){
    $db = getDBConection();
    $project = array();
    $query = "SELECT id, name FROM `projects`".
            " WHERE (`id` = ? AND `users_id` = ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $proj_id, $user_id);
    $stmt->execute();
    $stmt->bind_result($id, $name);
    while ($stmt->fetch()){
        $project['id'] = $id;
        $project['name'] = $name;
    }
    return $project;
}

/**
 * 
 * @param type $id
 * @return string
 */
function getProjectDataById($id){
    $db = getDBConection();
    $data = '';
    $query = "SELECT `data` FROM `projects`".
            " WHERE `id` = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($data);
    while ($stmt->fetch()){
    }
    return $data;
}

function deleteProjectByIdAndUserId($proj_id, $user_id){
    $db = getDBConection();
    $query = "DELETE FROM `projects`".
            " WHERE (`id` = ? AND `users_id` = ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $proj_id, $user_id);
    return $stmt->execute();
}

function saveProject($proj_id, $data){
    $db = getDBConection();
    $query = "UPDATE `projects` SET `data` = ?".
            " WHERE `id` = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('si', $data, $proj_id);
    return $stmt->execute();
}