        $().ready(function(){
            var scene, camera, render;
            var bodies = new Array();
            var bodies_prop = JSON.parse('[{"mytype":"cube","position":{"x":"0","y":"0","z":"-1000"},"rotation":{"_x":29.64384455411493,"_y":29.64384455411493,"_z":0,"_order":"XYZ"},"vertices":[{"x":50,"y":200,"z":300},{"x":50,"y":200,"z":-300},{"x":50,"y":-200,"z":300},{"x":50,"y":-200,"z":-300},{"x":-50,"y":200,"z":-300},{"x":-50,"y":200,"z":300},{"x":-50,"y":-200,"z":-300},{"x":-50,"y":-200,"z":300}]},{"mytype":"cube","position":{"x":"300","y":"0","z":"-12"},"rotation":{"_x":0,"_y":0,"_z":0,"_order":"XYZ"},"vertices":[{"x":150,"y":150,"z":150},{"x":150,"y":150,"z":-150},{"x":150,"y":-150,"z":150},{"x":150,"y":-150,"z":-150},{"x":-150,"y":150,"z":-150},{"x":-150,"y":150,"z":150},{"x":-150,"y":-150,"z":-150},{"x":-150,"y":-150,"z":150}]}]');
            
            for(var i=0; i<bodies_prop.length; i++){
                var body = new Object();
                if(bodies_prop[i].mytype === 'cube'){
                    body = createCube();
                }
                equilObjects(body.position, bodies_prop[i].position);
                equilObjects(body.rotation, bodies_prop[i].rotation);
                equilObjects(body.geometry.vertices, bodies_prop[i].vertices);
                bodies.push(body);
            }
            
            init(bodies);

            function init(bodies){
                var container = $("#container").eq(0);

                var camera_proportions = parseInt($("#container").css('width'))/parseInt($("#container").css('height'));
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
                bodies[0].rotation.y += Math.PI/180*0.5;
                bodies[0].rotation.x += Math.PI/180*0.5;
                render.render(scene, camera);
            }
        });
        function createCube(){
            var cube_geometry = new THREE.BoxGeometry(300,300,300);
            var cube_texture = new THREE.MeshNormalMaterial({wireframe: false ,wireframeLinewidth: 3, morphTargets: true});
            var cube = new THREE.Mesh(cube_geometry, cube_texture);
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