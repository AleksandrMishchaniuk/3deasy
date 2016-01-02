var glob_scene, glob_camera, glob_render;
var glob_bodies = new Array();

function saveToGlobal(bodies,camera,render){
    glob_bodies = bodies;
    glob_camera = camera;
    glob_render = render;
}

function getMoreProperties(body){
    //Отображение панели свойств фигуры
    body.showPropertiesPanel = function(){
        this.form = createPropertiesPanel(body);
        $("#bsb").empty();
        $("#bsb").append(this.form);
    };
    return body;
}
//Создание панели свойств фигуры
function createPropertiesPanel(body){
    var form = $('<form>');
    var position = createPositionPanel(body,body.position.x,body.position.y,body.position.z);
    var rotation = createRotationPanel(body,body.rotation.x,body.rotation.y,body.rotation.z);
    var anim_rotation = createAnimRotationPanel(body,body.animSpeed.rotation);

    form.append(position).append(rotation).append(anim_rotation);

    $('input', form).change(function(){
        var key = $(this).attr('name').split('_');
        var val = +this.value;
        if(key[0] === 'rotation'){
           val = val/180*Math.PI; 
        }
        if(key.length === 2){
            body[key[0]][key[1]] = val;
        }else if(key.length === 3){
            body[key[0]][key[1]][key[2]] = val;
        }
    });
    return form;
}
    
function createPositionPanel(body,x,y,z){
    var coord = {'x':x, 'y':y, 'z':z};
    var div = $("<div>").addClass('position_panel');
    for(var k in coord){
        var inp = $("<input>").attr({
            'type': 'number',
            'name': 'position_'+k,
            'value': coord[k]
            }).css({'width': '50px'});
        var label = $("<label>").append('p.'+k+':').append(inp);
        div.append(label);
    }
    return div;
}

function createRotationPanel(body,x,y,z){
    var rot = {'x':x, 'y':y, 'z':z};
    var div = $("<div>").addClass('rotation_panel');
    for(var k in rot){
        var inp = $("<input>").attr({
            'type': 'number',
            'name': 'rotation_'+k,
            'value': (rot[k]/Math.PI*180)%360
            }).css({'width': '50px'});
        var label = $("<label>").append('r.'+k+':').append(inp);
        div.append(label);
    }
    return div;
}
function createAnimRotationPanel(body, speed){
    var rot = {'x':speed.x, 'y':speed.y, 'z':speed.z};
    var div = $("<div>").addClass('anim_rotation_panel');
    for(var k in rot){
        var inp = $("<input>").attr({
            'type': 'number',
            'name': 'animSpeed_rotation_'+k,
            'value': rot[k]
            }).css({'width': '50px'});
        var label = $("<label>").append('a.r.'+k+':').append(inp);
        div.append(label);
    }
    return div;
}