<?php

function enterAction(){
    include TPL_PATH . 'main.php';
    include TPL_RSB_PATH . 'userRsb.php';
    include TPL_PATH . 'end.php';
}

function startRegistrationAction(){
    include TPL_PATH . 'main.php';
    include TPL_RSB_PATH . 'registrRsb.php';
    include TPL_PATH . 'end.php';
}