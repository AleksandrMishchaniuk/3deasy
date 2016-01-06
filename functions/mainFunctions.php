<?php

function loadPage($controllerName = 'Index', $actionName = 'index'){
    include CONTR_PATH_PREF . $controllerName . CONTR_PATH_POSTF;
    $function = $actionName . 'Action';
    $function();
}

function d($x, $y=0){
    echo '<pre>';
        print_r($x);
    echo '</pre>';
    if($y === 0){
        exit();
    }
}