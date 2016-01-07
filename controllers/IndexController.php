<?php

include './models/ProjectsModel.php';

function indexAction(){
    $user = getUserFromSession();
    if(!$user){
        include TPL_PATH . 'main.php';
        include TPL_RSB_PATH . 'indexRsb.php';
        include TPL_PATH . 'end.php';
    }else{
        header("Location: /?controller=user");
    }
}