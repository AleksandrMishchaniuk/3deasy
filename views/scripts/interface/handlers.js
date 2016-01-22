$().ready(function(){
    
    fillListOfBodies(glob_bodies, $('#list_of_bodies'));    //вывод списка обьектов
    
    $('#form_get_script').submit(function(){
        var bodies_json = JSON.stringify( getCurrentCondition() );
        $("[name='json_bodies']").val(bodies_json);
        
        var file_name = ($('#project_info').html() !== undefined)? $('#project_info').html().trim(): 'new_project';
        var text = 'Введите имя файла.\n';
        text += '(оно также будет использоваться в качестве идентификатора html-блока';
        text += 'в котором потребуется отобразить созданный проект)\n';
        text += 'Допускаются только латинские буквы, цифры и символ подчеркивания';
        file_name = prompt(text, file_name);
        try{
            file_name = file_name.replace(/[^A-Za-z0-9_]+/g, "_");
        }catch(ex){
            return false;
        }
        if(!file_name || file_name==='_'){
            alert('Введено недопустимое имя файла');
            return false;
        }
        $("[name='file_name']").val(file_name);
    });
    
    
    $('#saveAsNewProject').submit(function(){
        var bodies_json = JSON.stringify( getCurrentCondition() );
        $("[name='new_proj_data']").val(bodies_json);
    });
    
    $("#newCondition").submit(function(){
        localStorage.setItem('newCondition','1');
    });
    
    $('#openProject').submit(function(){
        var id = $('#projects_list li.selected').attr('data-id');
        $("[name='opening_project']").val(id);
    });
    
    $('#deleteProject').submit(function(){
        var id = $('#projects_list li.selected').attr('data-id');
        $("[name='deleting_project']").val(id);
    });
    
    $('#saveProject').submit(function(){
        var bodies_json = JSON.stringify( getCurrentCondition() );
        $("[name='project_data']").val(bodies_json);
    });
    
    
    $("#projects_list li").click(function(){
        $("#projects_list li").each(function(){
            $(this).removeClass('selected');
        });
        $(this).addClass('selected');
        $('#deleteProject [type="submit"]').removeAttr('disabled');
        if($(this).hasClass('active')){
            $('#deleteProject [type="submit"]').attr('disabled','disabled');
        }
    });
    
    
    $('form').submit(function(){
        document.cookie = 'form=1';
    });
    
    $(window).unload(function(){
        localStorage.setItem('currentCondition', JSON.stringify( getCurrentCondition() ));
    });
});

/**
 * 
 * @param {type} bodies
 * @param {type} list
 * @returns {undefined}
 */
function fillListOfBodies(bodies, list){
    var ul = $('<ul>');
    list.append(ul);
    for(var i=0; i<bodies.length; i++){
        var li = $('<li>').html(bodies[i].myname);
        li = li.get(0);
        li.obj = bodies[i];
        li.onclick = function(){
            $("li", ul).css("background", 'none');
            $(this).css('background','#6495ED');
            this.obj.showPropertiesPanel($("#bsb"));
        };
        ul.append(li);
    }
}

/**
 * 
 * @returns {Array|getCurrentCondition.bodies}
 */
function getCurrentCondition(){
    var bodies = new Array();
    for(var i=0; i<glob_bodies.length; i++){
        var body_prop = {
            'myid': glob_bodies[i].myid,
            'mytype': glob_bodies[i].mytype,
            'myname': glob_bodies[i].myname,
            'position': glob_bodies[i].position,
            'rotation': glob_bodies[i].rotation,
            'vertices': glob_bodies[i].geometry.vertices,
            'animSpeed': glob_bodies[i].animSpeed
        };
        bodies.push(body_prop);
    }
    return bodies;
}