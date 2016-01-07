<?php

/**
 * 
 * @param type $controllerName
 * @param type $actionName
 */
function loadPage($controllerName = 'Index', $actionName = 'index'){
    if(isset($_POST['newProject']) && isset($_SESSION['project'])){
        unset($_SESSION['project']);
    }
    include CONTR_PATH_PREF . $controllerName . CONTR_PATH_POSTF;
    $function = $actionName . 'Action';
    $function();
}

/**
 * 
 * @param type $x
 * @param type $y
 */
function d($x, $y=0){
    echo '<pre>';
        print_r($x);
    echo '</pre>';
    if($y === 0){
        exit();
    }
}

/**
 * 
 * @return type
 */
function getUserFromSession(){
    $user = NULL;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }
    return $user;
}

/**
 * 
 * @return type
 */
function getProjectFromSession(){
    $project = NULL;
    if(isset($_SESSION['project'])){
        $project = $_SESSION['project'];
    }
    return $project;
}