$().ready(function(){
    
    fillListOfBodies(glob_bodies, $('#list_of_bodies'));    //вывод списка обьектов
    
    $('#form_get_script').submit(function(){
        var bodies_json = JSON.stringify( getCurrentCondition() );
        document.cookie = 'form_get_script=1';
        $("[name='json_bodies']").val(bodies_json);
    });
    
    $(window).unload(function(){
        localStorage.setItem('currentCondition', JSON.stringify( getCurrentCondition() ));
    });
    $("#button_newCondition").click(function(){
        localStorage.setItem('newCondition','1');
        location.reload();
    });
});

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