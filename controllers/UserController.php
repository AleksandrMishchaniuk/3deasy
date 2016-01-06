<?php

include './models/UsersModel.php';
include './models/ProjectsModel.php';

/**
 * 
 * @global type $db
 */
function enterAction(){
    global $db;
    $user = NULL;
    if(
        isset($_POST['login'])&&
        isset($_POST['pass'])
    ){
        $login = lcfirst(htmlentities($db->real_escape_string($_POST['login'])));
        $pass = htmlentities($db->real_escape_string($_POST['pass']));
        
        $user = getUserByLoginAndPassword($login, $pass);
    }
    
    include TPL_PATH . 'main.php';
    if($user){
        $_SESSION['user'] = $user;
        $project['name'] = 'Новый проект';
        $projects = getProjectsByUserId($user['id']);
        include TPL_PATH . 'projectInformation.php';
        include TPL_RSB_PATH . 'userRsb.php';
    }  else {
        $message = 'Введен неверный логин или пароль';
        include TPL_RSB_PATH . 'indexRsb.php';
    }
    include TPL_PATH . 'end.php';
}

/**
 * 
 */
function quitAction(){
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
    }
    include CONTR_PATH_PREF. 'Index' .CONTR_PATH_POSTF;
    indexAction();
}

/**
 * 
 */
function startRegistrationAction(){
    include TPL_PATH . 'main.php';
    include TPL_RSB_PATH . 'registrRsb.php';
    include TPL_PATH . 'end.php';
}