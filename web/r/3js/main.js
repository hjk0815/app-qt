
import * as THREE from 'three';

import Stats from 'three/addons/libs/stats.module.js';
import { GUI } from 'three/addons/libs/lil-gui.module.min.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { AMFLoader } from 'three/addons/loaders/AMFLoader.js';
import { PCDLoader } from 'three/addons/loaders/PCDLoader.js';

let camera, scene, renderer, loader2;
let startTime, stats;
let updateTick;

init();

function initGui() {
	const gui = new GUI();
	
	const localPlane = new THREE.Plane(new THREE.Vector3(0, - 1, 0), 0.8);
	const globalPlane = new THREE.Plane(new THREE.Vector3(- 1, 0, 0), 0.1);
	const folderLocal = gui.addFolder('Local Clipping');
	const propsLocal = {
		get 'Enabled'() {
			return renderer.localClippingEnabled;
		},
		set 'Enabled'(v) {
			renderer.localClippingEnabled = v;
		},

		get 'Plane'() {
			return localPlane.constant;
		},
		set 'Plane'(v) {
			localPlane.constant = v;
		}
	};

	const folderGlobal = gui.addFolder('Global Clipping');
	const propsGlobal = {
		get 'Enabled'() {
			//return renderer.clippingPlanes !== Empty;
		},
		set 'Enabled'(v) {
			//renderer.clippingPlanes = v ? globalPlanes : Empty;
		},

		get 'Plane'() {
			return globalPlane.constant;
		},
		set 'Plane'(v) {
			globalPlane.constant = v;
		}
	};

	//folderLocal.add(propsLocal, 'Enabled');
	//folderLocal.add(propsLocal, 'Shadows');
	folderLocal.add(propsLocal, 'Plane', 0.3, 1.25);

	//folderGlobal.add(propsGlobal, 'Enabled');
	folderGlobal.add(propsGlobal, 'Plane', - 0.4, 3);
}

function init() {
	const container = document.getElementById('container');

	scene = new THREE.Scene();
	scene.background = new THREE.Color(0x111111);
	scene.add(new THREE.AmbientLight(0x999999));

	camera = new THREE.PerspectiveCamera(35, window.innerWidth / window.innerHeight, 1, 500);
	camera.up.set(0, 0, 1); // Z is up for objects intended to be 3D printed.
	camera.position.set(0, - 90, 60);
	camera.add(new THREE.PointLight(0xffffff, 0.8));
	scene.add(camera);

	const axesHelper = new THREE.AxesHelper(50);
	axesHelper.layers.enableAll();
	scene.add(axesHelper);

	const colorGrid = 0x4c4c4c;
	const grid = new THREE.GridHelper(200, 20, colorGrid, colorGrid);
	grid.rotateOnAxis(new THREE.Vector3(1, 0, 0), 90 * (Math.PI / 180));
	scene.add(grid);

	const radius = 100;
	const sectors = 0;
	const rings = 10;
	const divisions = 20;
	const helper = new THREE.PolarGridHelper(radius, sectors, rings, divisions, colorGrid, colorGrid);
	helper.rotateOnAxis(new THREE.Vector3(1, 0, 0), 90 * (Math.PI / 180));
	scene.add(helper);

	// Stats
	stats = new Stats();
	container.appendChild(stats.dom);

	// loader
	loader2 = new PCDLoader();

	// renderer
	renderer = new THREE.WebGLRenderer({ antialias: true });
	renderer.setPixelRatio(window.devicePixelRatio);
	renderer.setSize(window.innerWidth, window.innerHeight);
	container.appendChild(renderer.domElement);

	// loader

	// controls
	const controls = new OrbitControls(camera, renderer.domElement);
	controls.addEventListener('change', render);
	controls.target.set(10, 1.2, 2);
	controls.update();

	// GUI
	initGui();

	// event
	window.addEventListener('resize', onWindowResize);
	window.addEventListener('keypress', keyboard);

	// Start
	updateTick = 0;
	startTime = Date.now();
	fetchFrame(0);
	animate();
}

function onWindowResize() {
	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();

	renderer.setSize(window.innerWidth, window.innerHeight);
	render();
}

function keyboard(ev) {
	const points = scene.getObjectByName('morelidar.pcd');
	switch (ev.key || String.fromCharCode(ev.keyCode || ev.charCode)) {
		case '+':
			points.material.size *= 10.2;
			break;
		case '-':
			points.material.size /= 10.2;
			break;
		case 'c':
			points.material.color.setHex(Math.random() * 0xffffff);
			break;
	}
	console.log(points.material);
	stats.begin();
	render();
	stats.end();
}

function render() {
	const timer = Date.now() * 0.03;

	//camera.position.x = Math.sin( timer ) * 0.5;
	//camera.position.z = Math.cos( timer ) * 0.5;
	//camera.lookAt( 0, 0.1, 0 );

	renderer.render(scene, camera);
}

function animate() {
	const currentTime = Date.now();
	const time = (currentTime - startTime) / 1000;

	requestAnimationFrame(animate);

	stats.begin();
	renderer.render(scene, camera);
	stats.end();

	updateTick++;
	updateFrame();
	// if ((updateTick % 30) == 5) {
	// 	console.log("fetchFrame" + updateTick);
	// 	fetchFrame(time);
	// }
}

var pointcloud = null;
function updatePcdPath(url) {
	if (pointcloud != null) {
		console.log("remove last");
		scene.remove(pointcloud);
		
		//console.log(pointcloud);
		pointcloud.geometry.dispose();
		pointcloud.material.dispose();
		pointcloud = null;
	}

	const loader = new PCDLoader();
	loader.load(url, function (pcd) {
			pointcloud = pcd;
			scene.add(pointcloud);
	});
}

function fetchFrame(frameId) {
	var url = 'http://localhost:8800/index.php?/rpc/pcdBin&frameId=' + frameId;

	console.log(url);
	updatePcdPath(url);
}

var lastFrameId = -1;
var LastTime = -1;
function updateFrame() {
	$.ajax({
		type: "GET",
		url: "http://localhost:8800/index.php?/rpc/pcdList",
		contentType: 'application/json;charset=utf-8',
		dataType: "json",
		data: {},
		success: function(res) {
			console.log(res);
			while (res) {
				if (res.code == 0 && res.count > 0) {
					var frameId = res.frameId.pop();
					var createTime = res.createTime.pop();
					if (lastFrameId != frameId || LastTime != createTime) {
						lastFrameId = frameId;
						LastTime = createTime;
							
						console.log(frameId);
						console.log(createTime);
						fetchFrame(frameId);
					}
				}
				break;
			}

		},
		error: function(errorMsg) {
			console.log(errorMsg);
		}
	});
}
