<?php
if(
    isset($_POST['json_bodies'])&&
    isset($_POST['file_name'])&&
    isset($_COOKIE['form'])
){
    setcookie('form', 1, time()-3600);
    $json_bodies = $_POST['json_bodies'];
    $file_name = htmlentities($_POST['file_name']);
    
    
    $filepath = './views/scripts/threeJS/template.js';  //путь к шаблону
    $fd = fopen($filepath, 'r');
    $script = fread($fd, 3426+56);  //!!!!--Надо определить количество символов для считывания из шаблона--!!!!!
    fclose($fd);
    
    $script .= <<<SCRIPT
        
        function getSavedCondition(){
            var bodies1 = new Array();
            
            var bodies_prop = JSON.parse('{$json_bodies}');
            
            for(var i=0; i<bodies_prop.length; i++){
                var body = new Object();
                if(bodies_prop[i].mytype === 'cube'){
                    body = createCube();
                }
                body.mytype = bodies_prop[i].mytype;
                body.myid = bodies_prop[i].myid;
                body.myname = bodies_prop[i].myname;
                equilObjects(body.position, bodies_prop[i].position);
                equilObjects(body.rotation, bodies_prop[i].rotation);
                equilObjects(body.geometry.vertices, bodies_prop[i].vertices);
                equilObjects(body.animSpeed, bodies_prop[i].animSpeed);
                bodies1.push(body);
            }
            
            return bodies1;
        }
        
        function getContainerName(){
            return '{$file_name}';
        }
    });
SCRIPT;
            
    script_download($script, $file_name);
}

function script_download($script, $file_name) {
    // заставляем браузер показать окно сохранения файла
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$file_name.'.js');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($script));
    // читаем строку и отправляем ее пользователю
    print $script;
    exit;
}