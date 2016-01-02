$().ready(function(){
    
    fillListOfBodies(glob_bodies, $('#list_of_bodies'));
    
    $('#form_get_script').submit(function(){
        var bodies_for_json = new Array();
        for(var i=0; i<glob_bodies.length; i++){
            var body_prop = {
                'mytype': glob_bodies[i].mytype,
                'position': glob_bodies[i].position,
                'rotation': glob_bodies[i].rotation,
                'vertices': glob_bodies[i].geometry.vertices,
                'animSpeed': glob_bodies[i].animSpeed
            };
            bodies_for_json.push(body_prop);
        }
        var bodies_json = JSON.stringify(bodies_for_json);
        document.cookie = 'form_get_script=1';
        $("[name='json_bodies']").val(bodies_json);
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
            this.obj.showPropertiesPanel();
        };
        ul.append(li);
    }
}