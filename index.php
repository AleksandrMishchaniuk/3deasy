<?php
    include './config/config.php';
    include './functions/mainFunctions.php';
    include './creater3dScript.php';
    
    $controllerName = (isset($_GET['controller']))? ucfirst($_GET['controller']): 'Index';
    $actionName = (isset($_GET['action']))? lcfirst($_GET['action']): 'index';
    
    loadPage($controllerName, $actionName);