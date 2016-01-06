<?php

function getProjectsByUserId($user_id){
    global $db;
    $projects = NULL;
    $query = "SELECT id, name FROM `projects`".
            " WHERE `users_id` = ?";
    if($stmt = $db->prepare($query)){
        $projects = array();
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        while ($stmt->fetch()){
            $projects['id'] = $id;
            $projects['name'] = $name;
        }
    }
    return $projects;
}