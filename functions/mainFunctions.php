<?php
function loadPage($controllerName = 'Index', $actionName = 'index'){
    include CONTR_PATH_PREF . $controllerName . CONTR_PATH_POSTF;
    $function = $actionName . 'Action';
    $function();
}