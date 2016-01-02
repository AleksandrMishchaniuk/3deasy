$().ready(function(){
    var scene, camera, render;
    var bodies = new Array();
    
    bodies = getBodies();
  
    init(bodies);
  
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
        
        try{
            saveToGlobal(bodies,camera,render);
        }catch(err){}
        
        render.render(scene, camera);
    }
    
    function createCube(){
        var cube_geometry = new THREE.BoxGeometry(300,300,300);
        var cube_texture = new THREE.MeshNormalMaterial({wireframe: false ,wireframeLinewidth: 3, morphTargets: true});
        var cube = new THREE.Mesh(cube_geometry, cube_texture);

        var date = new Date();
        cube.myid = date.getTime();
        cube.mytype = 'cube';
        cube.myname = cube.mytype+'_'+cube.myid;
        cube.form = Object();
        cube.animSpeed = {                 //скорость анимации
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

        cube.animation = function(){        //анимация согласно заданной скорости анимации
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
        
        try{
            cube = getMoreProperties(cube);
        }catch(err){}
        
        return cube;
    }
    function equilObjects(targ, orig){
        for(var key_o in orig){
            var key_t = key_o;
            if(key_o[0] === '_'){
                key_t = key_o.slice(1);
            }
            targ[key_t] = orig[key_o]; 
        }
    }
    /**--------------------------------------------------------------------------
     * Конец шаблона--------------------------------------------------------------
     * ----------------------------------------------------------------------------
     */
    
    function getBodies(){
        var bodies1 = new Array();
        bodies1.push(createCube());
        bodies1.push(createCube());
        bodies1[0].resize(50,200,300);
        bodies1[1].position.x = 300;
        return bodies1;
    }
});