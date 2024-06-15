<!DOCTYPE html>
<html lang="en">

<head>
  <title>more lidar view</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <!-- <link type="text/css" rel="stylesheet" href="./examples/main.css"> -->
  <style>
    body {
      background-color: #999;
    }
  </style>

  <!-- Import maps polyfill -->
  <script src="../../r/js/jquery-3.4.1.js"></script>
  <script async src="../../r/3js/es-module-shims.js"></script>
  <script type="importmap">
    {
      "imports": {
        "three": "../../r/3js/build/three.module.js",
        "three/addons/": "../../r/3js/examples/jsm/"
      }
    }
  </script>
</head>

<body>
  <div id="container"></div>
  <div id="info">
    <strong>click</strong>: add voxel
  </div>
  <script type="module" src="../../r/3js/main.js">
  </script>

  <script>
    $(function() {
      var lastFrameId = 0;
      var lastExpire = 0;

      //import {updatePcdPath} from "../../r/3js/main.js";
      // function animate() {
      //   const currentTime = Date.now();
      //   const time = (currentTime - startTime) / 1000;

      //   requestAnimationFrame(animate);

      //   stats.begin();
      //   renderer.render(scene, camera);
      //   stats.end();

      //   fetchFrame(lastFrameId);
      // }

      // function updatePcdPath(path) {
      //   loader2.load(path, function(points) {
      //     points.name = 'morelidar.pcd';
      //     points.material.color.setHex(0x00ff00);

      //     //scene.add(points);
      //     scene.addCloud(points);
      //     render();

      //     points.dispose;
      //   });
      // }

      function fetchFrame(frameId) {
        var url = '<?= URL_BASE ?>/rpc/pcdBin&frameId=' + frameId;

        console.log(url);
        updatePcdPath(url);
      }

      function updateFrame() {
        $.ajax({
          type: "GET",
          url: "<?= URL_BASE ?>/rpc/pcdList",
          contentType: 'application/json;charset=utf-8',
          dataType: "json",
          data: {},
          success: function(res) {
            //console.log(res);
            while (res) {
              if (res.code == 0 && res.count > 0) {
                var frameId = res.frameId.pop();
                console.log(frameId);
                lastFrameId = frameId;
                
                var expire = res.expire.pop();
                console.log(expire);
                lastExpire = expire;

                fetchFrame(frameId);
              }
              break;
            }

          },
          error: function(errorMsg) {
            console.log(errorMsg);
          }
        });
      }

      // updateFrame();
      // setInterval(function() {
      //   if (1) {
      //     updateFrame();
      //   }
      // }, 100);


    });
  </script>

</body>

</html>