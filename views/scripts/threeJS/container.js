var scene, camera, render;
var bodies = new Array();

$().ready(function(){
    
    bodies.push(createCube());
    bodies.push(createCube());
    
    init(bodies);
    
    bodies[0].resize(50,200,300);
    bodies[1].position.x = 300;
    fillListOfBodies(bodies, $('#list_of_bodies'));
    
    function init(bodies){
        var container = $("#container").eq(0);
   
        var camera_proportions = parseInt(container.css('width'))/parseInt(container.css('height'));
        camera = new THREE.PerspectiveCamera(70,camera_proportions,1,10000);
        camera.position.z = 600;

        scene = new THREE.Scene();
        for(var i=0; i<bodies.length; i++){
            scene.add(bodies[i]);
        }
        
        render = new THREE.WebGLRenderer();
        render.setSize(parseInt(container.css('width')), parseInt(container.css('height')));
        render.setClearColor(0xFFFACD);
        container.append(render.domElement);
        
        render.render(scene, camera);
        animation(bodies);
    }
   
    function animation(bodies){
        requestAnimationFrame(function(){
            animation(bodies);
        });
        for(var i=0; i<bodies.length; i++){
            bodies[i].animation();
        }
        render.render(scene, camera);
    }
});

function createCube(){
    var cube_geometry = new THREE.BoxGeometry(300,300,300);
    var cube_texture = new THREE.MeshNormalMaterial({wireframe: false ,wireframeLinewidth: 3, morphTargets: true});
    var cube = new THREE.Mesh(cube_geometry, cube_texture);

    var date = new Date();
    cube.myid = date.getTime();
    cube.mytype = 'cube';
    cube.myname = cube.mytype+'_'+cube.myid;
    cube.form = Object();
    cube.animSpeed = {                 //свойство включено в шаблон
        'rotation' : {
            'x' : 0,
            'y' : 0,
            'z' : 0
        },
        'position' : {
            'x' : 0,
            'y' : 0,
            'z' : 0
        }
    };
    
    cube.animation = function(){        //метод включен в шаблон
        for(var k in this.animSpeed.rotation){
            if(this.animSpeed.rotation[k]){
                this.rotation[k] += Math.PI/180*this.animSpeed.rotation[k]/40;
            }
        }
        for(var k in this.animSpeed.position){
            if(this.animSpeed.position[k]){
                this.position[k] += this.animSpeed.position[k];
            }
        }
    }
    
    cube.resize = function(x,y,z){
        for(var k=0; k<this.geometry.vertices.length; k++){
            var old_x = this.geometry.vertices[k].x;
            var old_y = this.geometry.vertices[k].y;
            var old_z = this.geometry.vertices[k].z;
            this.geometry.vertices[k].x = (old_x>0)? x: -x;
            this.geometry.vertices[k].y = (old_y>0)? y: -y;
            this.geometry.vertices[k].z = (old_z>0)? z: -z;
        }
        this.geometry.verticesNeedUpdate = true;
    };

    //Отображение панели свойств фигуры
    cube.showPropertiesPanel = function(){
        this.form = createPropertiesPanel();
        $("#bsb").empty();
        $("#bsb").append(this.form);
    };

    //Создание панели свойств фигуры
    function createPropertiesPanel(){
        var form = $('<form>');
        var position = createPositionPanel(cube,cube.position.x,cube.position.y,cube.position.z);
        var rotation = createRotationPanel(cube,cube.rotation.x,cube.rotation.y,cube.rotation.z);
        var anim_rotation = createAnimRotationPanel(cube,cube.animSpeed.rotation);

        form.append(position).append(rotation).append(anim_rotation);
        
        $('input', form).change(function(){
            var key = $(this).attr('name').split('_');
            var val = +this.value;
            if(key[0] == 'rotation'){
               val = val/180*Math.PI; 
            }
            if(key.length === 2){
                cube[key[0]][key[1]] = val;
            }else if(key.length === 3){
                cube[key[0]][key[1]][key[2]] = val;
            }
        });
        return form;
    }
    return cube;
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