$().ready(function(){
    $('#form_get_script').submit(function(){
        var bodies_for_json = new Array();
        for(var i=0; i<bodies.length; i++){
            var body_prop = {
                'mytype': bodies[i].mytype,
                'position': bodies[i].position,
                'rotation': bodies[i].rotation,
                'vertices': bodies[i].geometry.vertices,
                'animSpeed': bodies[i].animSpeed
            };
            bodies_for_json.push(body_prop);
        }
        var bodies_json = JSON.stringify(bodies_for_json);
        document.cookie = 'form_get_script=1';
        $("[name='json_bodies']").val(bodies_json);
    });
});