<?php
    include './creater3dScript.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>3D easy</title>
        <link rel="stylesheet" href="views/css/MainStyles.css"/>
        <script src="views/scripts/jquery-2.1.4.min.js"></script>
        <script src="views/scripts/three.min.js"></script>
        <script src="views/scripts/threeJS/container.js"></script>
        <script src="views/scripts/interface/formGetScript.js"></script>
    </head>
    <body>
        <div id="container"></div>
        <div id='bsb' class="panel"></div>
        <div id="lsb" class="panel">
            <div id="list_of_bodies"></div>
            <form method="POST" id="form_get_script">
                <input type="submit" value="Получить файл"/>
                <input type="hidden" name="json_bodies" value=""/>
<!--                <input type="hidden" name="json_bodies" value=""/>
                <input type="hidden" name="json_scene" value=""/>
                <input type="hidden" name="json_camera" value=""/>
                <input type="hidden" name="json_render" value=""/>-->
            </form>
        </div>
    </body>
</html>
