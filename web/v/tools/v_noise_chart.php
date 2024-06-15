<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = TOOL_NOISE;
        $page = NOISE_CONFIG;
        include(APP . 'v/tools/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-9 col-md-9 col-sm-9 padding5">

            <div class="panel_block padding5">
              <h2 class="">Base noise chart</h2>
              <ul class="padding0">

                <div class="row">
<?php for($i = 0; $i < 8; $i++) { 
  $id = $i + 1;
  ?>
                  <div class="col-lg-6 padding0">
                    <div class="row padding0">
                      <div id="echartId<?= $id ?>" style="width:100%;height:250px;"></div>
                    </div>
                  </div>

<?php } ?>

                </div>
              </ul>
            </div>
          </div>
<!-- 
          <div class="col-lg-3 col-md-3 col-sm-3 padding5">
            <div class="panel_block padding5">
              <h2 class="">Base noise control</h2>
              <ul class="padding0">
                <div class="row ">

                  <div class="col-lg-12">
                    <button id="btnStopCap" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Load local config">
                      <span class="fa fa-archive fa-5x"></span>
                    </button>
                    <button id="btnWrite" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Download to device">
                      <span class="fa fa-cloud-download fa-5x"></span>
                    </button>
                    <button id="btnWrite" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload device config">
                      <span class="fa fa-cloud-upload fa-5x"></span>
                    </button>
                    <button id="btnSave" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Export config">
                      <span class="fa fa-save fa-5x"></span>
                    </button>
                  </div>

                  <div class="col-lg-12">
                  </div>

                </div>

              </ul>
            </div>
          </div> -->

        </div>

      </div>
    </div>
  </div>
</div>

<?php
include(APP . 'v/tools/v_tail.php');
?>

<script type="text/javascript">
  
<?php for($i = 0; $i < 8; $i++) { 
  $id = $i + 1;
  $title = "ADC".(int)($i/2 + 1)."-DDC".($i%2);
  ?>

  var myChart<?= $id ?> = echarts.init(document.getElementById('echartId<?= $id ?>'));

  var option<?= $id ?> = {
    legend: {},
    tooltip: {
      show: true,
      trigger: 'axis',
      axisPointer: {
        type: 'line',
        snap: false,
      },
    },
    grid: {
      //containLabel: true,
      top: '10%',
      bottom: '15%',
      left: '15%',
      right: '5%',
    },
    xAxis: {
      type: 'category',
      data: [],
      axisLabel: {
        interval: 499,
        rotate: 40
      },
    },
    yAxis: {},
    series: [{
      name: '<?= $title ?>',
      type: 'line',
      data: []
    }],
    dataZoom: [{
      type: 'slider', //x轴
      xAxisIndex: 0,
    }, {
      type: 'inside', //x轴
      xAxisIndex: 0,
      zoomOnMouseWheel: 'alt',
    }, ],
  };

  myChart<?= $id ?>.setOption(option<?= $id ?>);

  // https://www.cnblogs.com/agansj/p/10837350.html
  //myChart1.showLoading(); //数据加载完之前先显示一段简单的loading动画
  function updateChart<?= $id ?>() {
    $.ajax({
      type: "GET",
      url: "<?= AJAX_BASE ?>/noiseData/&type=<?= NCE_CHART ?>&ch=<?= $i ?>",
      contentType: 'application/json;charset=utf-8',
      dataType: "json",
      data: {}, 
      success: function(res) {
        var ticks = [];
        var noiseTemp = [];
        //console.log(res);
        while (res) {
          count = res.count;
          rows = res.rows;
          //document.getElementById("currentValue").innerText = res.current;
          //document.getElementById("currentStatus").innerText = res.status;
          //document.getElementById("currentAverage").innerText = res.average;
          //document.getElementById("currentMin").innerText = res.minv;
          //document.getElementById("currentMax").innerText = res.maxv;
          // document.getElementById("currentVariance").innerText = res.variance;
          // document.getElementById("currentStdev").innerText = res.stdev;
          // document.getElementById("currentFreq").innerText = res.freq;

          if (count < 1) {
            break;
          }

          ticks = res.tick;
          noiseTemp = res.value;

          //myChart<?= $id ?>.hideLoading(); //隐藏加载动画
          myChart<?= $id ?>.setOption({ //加载数据图表
            xAxis: {
              data: ticks
            },
            series: [{
              // 根据名字对应到相应的系列
              name: '<?= $title ?>',
              data: noiseTemp
            }, ]
          });

          break;
        }

      },
      error: function(errorMsg) {
      }
    });
  }

<?php } ?>

  updateChart1();
  updateChart2();
  updateChart3();
  updateChart4();
  updateChart5();
  updateChart6();
  updateChart7();
  updateChart8();
  // setInterval(function() {
  //   if (1) {
  //     updateChart1();
  //   }
  // }, 1000);

  window.onresize = function() {
    myChart1.resize();
    myChart2.resize();
    myChart3.resize();
    myChart4.resize();
    myChart5.resize();
    myChart6.resize();
    myChart7.resize();
    myChart8.resize();
  }

</script>



<script>
  $(function() {
    var activeDev = <?= DEVICE_BOTTOM_NOISE ?>;

  });
</script>


