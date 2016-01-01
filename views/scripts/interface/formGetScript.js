$().ready(function(){
    $('#form_get_script').submit(function(){
        var bodies_for_json = new Array();
        for(var i=0; i<bodies.length; i++){
            var body_prop = {
                'mytype': bodies[i].mytype,
                'position': bodies[i].position,
                'rotation': bodies[i].rotation,
                'vertices': bodies[i].geometry.vertices
            };
            bodies_for_json.push(body_prop);
        }
        var bodies_json = JSON.stringify(bodies_for_json);
        
        $("[name='json_bodies']").val(bodies_json);
        
//        alert(bodies_json);
//        $("[name='json_bodies']").val(JSON.stringify(bodies));
//        $("[name='json_scene']").val(JSON.stringify(scene));
//        $("[name='json_camera']").val(JSON.stringify(camera));
//        $("[name='json_render']").val(JSON.stringify(render));
    });
});