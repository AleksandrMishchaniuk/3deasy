<?php

function indexAction(){
    $message = '';
    include TPL_PATH . 'main.php';
    include TPL_RSB_PATH . 'indexRsb.php';
    include TPL_PATH . 'end.php';
}