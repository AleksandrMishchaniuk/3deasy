<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>3D easy</title>
        <link rel="stylesheet" href="views/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="views/css/main-styles.css"/>
        <script src="views/scripts/jquery-2.1.4.min.js"></script>
        <script src="views/scripts/three.min.js"></script>
        
        <?php if(isset($_SESSION['opening_project_data'])): ?>
            <script>
                localStorage.setItem('currentCondition', '<?php echo $_SESSION['opening_project_data'] ?>');
            </script>
        <?php
            unset($_SESSION['opening_project_data']);
            endif; 
        ?>
        <script src="views/scripts/threeJS/template.js"></script>
        <script src="views/scripts/threeJS/wrap.js"></script>
        <script src="views/scripts/interface/handlers.js"></script>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php include TPL_PATH . 'about.php'; ?>
        <div id="container"></div>
        <div id='bsb' class="app-panel"></div>
        <div id="lsb" class="app-panel">
            <div id="list_of_bodies"></div>
        </div>
        <?php 
            if(isset($project['name'])){
                include TPL_PATH . 'projectInformation.php';
            }
        ?>
        <div id="rsb" class="app-panel">
            <a id="btn_about" href="" data-toggle="modal" data-target="#about">Информация о приложении</a>
            <hr/>