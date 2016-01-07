<?php

include './models/UsersModel.php';
include './models/ProjectsModel.php';

function indexAction($errors = NULL, $entered_name = ''){
    $user = getUserFromSession();
    if(!$user){
        header('Location: /');
    }
    
    $projects = getProjectsByUserId($user['id']);
    
    $project = getProjectFromSession();
    if(!$project){
        $project['name'] = 'Новый проект';
    }
    
    include TPL_PATH . 'main.php';
    include TPL_PATH . 'projectInformation.php';
    include TPL_RSB_PATH . 'userRsb.php';
    include TPL_PATH . 'end.php';
}
/**
 * 
 * @global type $db
 */
function enterAction(){
    $db = getDBConection();
    $user = getUserFromSession();
    if(
        isset($_POST['login'])&&
        isset($_POST['pass'])&&
        isset($_COOKIE['form'])
    ){
        setcookie('form', 1, time()-3600);
        $login = lcfirst(htmlentities($db->real_escape_string($_POST['login'])));
        $pass = htmlentities($db->real_escape_string($_POST['pass']));
        
        $user = getUserByLoginAndPassword($login, $pass);
    }
    if($user){
        $_SESSION['user'] = $user;
        header('Location: /');
    }else{
        $message = 'Введен неверный логин или пароль';
        include TPL_PATH . 'main.php';
        include TPL_RSB_PATH . 'indexRsb.php';
        include TPL_PATH . 'end.php';
    }
}

/**
 * 
 */
function quitAction(){
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
    }
    if(isset($_SESSION['project'])){
        unset($_SESSION['project']);
    }
    header('Location: /');
}

/**
 * 
 */
function registrationAction(){
    $db = getDBConection();
    $is_success = FALSE;
    $errs = NULL;
    $login = '';
    $pass1 = '';
    $pass2 = '';
    
    if(isset($_POST['submit']) && isset($_COOKIE['form'])){
        setcookie('form', 1, time()-3600);
        $login = $_POST['new_login'];
        $pass1 = $_POST['new_pass1'];
        $pass2 = $_POST['new_pass2'];
        if($login === ''){$errs[] = 'Введите логин';}
        if($pass1 === ''){$errs[] = 'Введите пароль';}
        if($pass2 === ''){$errs[] = 'Введите повторный пароль';}
        if(isExistUserByLogin($login)){$errs[] = 'Такой логин уже существует';}
        if($pass1 !== $pass2){$errs[] = 'Пароли не совпадают';}
        if(!$errs){
            $is_success = registrationNewUser($login, $pass1);
            if(!$is_success){
                $errs[] = 'Произошла ошибка <br/> Попробуйте еще раз';
            }
        }
    }
    
    if($is_success){
        $message = 'Регистрация прошла успешно';
        include TPL_PATH . 'main.php';
        include TPL_RSB_PATH . 'indexRsb.php';
        include TPL_PATH . 'end.php';
    }else{
        include TPL_PATH . 'main.php';
        include TPL_RSB_PATH . 'registrRsb.php';
        include TPL_PATH . 'end.php';
    }
}

/**
 * 
 */
function saveAsNewProjectAction(){
    $errors = NULL;
    $entered_name = '';
    if(isset($_POST['submit']) && isset($_COOKIE['form'])){
        setcookie('form', 1, time()-3600);
        $name = $_POST['new_proj_name'];
        $data = $_POST['new_proj_data'];
        $userId = getUserFromSession()['id'];
        
        if($name === '') {$errors[] = 'Введите название';}
        if($data === '') {$errors[] = 'Нет данных проекта';}
        if(isExistProjectByUserIdAndName($userId, $name)) {
            $errors[] = 'Такое название уже есть';
            $entered_name = $name;
        }
        
        if(!$errors){
            $project = NULL;
            if(saveNewProject($name, $data, $userId)){
                $project = getLastProjectByUserId($userId);
            }
            if($project){
                $_SESSION['project'] = $project;
            }
        }
    }
    
    indexAction($errors, $entered_name);
}


function openProjectAction(){
    $errors = NULL;
    if(isset($_POST['opening_project']) && isset($_COOKIE['form'])){
        setcookie('form', 1, time()-3600);
        
    }
}
