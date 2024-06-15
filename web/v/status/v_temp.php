<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = STATUS_TEMPERATURE;
        include(APP . 'v/status/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">
          <div class="col-lg-9 col-md-9 col-sm-9 padding5">

            <div class="panel_block padding5">
              <ul class="padding0">

                <div class="row padding0">
                  <div class="col-lg-12 padding0">
                    <div class="row padding0">
                      <div id="echartId1" style="width:100%;height:500px;"></div>
                    </div>
                  </div>
                </div>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 padding5">

            <div class="panel_block padding5">
              <h2 class="">Runtime value</h2>
              <ul class="padding0">
                <div class="row ">
                  <div class="col-lg-12">
                    <label id="currentValue" class="bmd-label-floating" style="font-size: 4em;color:darkslategray">0.0</label>
                    <label id="currentStatus" class="bmd-label-floating" style="font-size: 1em;color:darkslategray">°C</label>
                  </div>

                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Average<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="currentAverage" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label class="bmd-label-floating" style="font-size: 1em;">Minimum<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label id="currentMin" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Maximum<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="currentMax" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
<!-- 
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Variance<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="currentVariance" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Stdev<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="currentStdev" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Report frequency<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="currentFreq" class="bmd-label-floating" style="font-size: 1em;">0<small></small></label>
                  </div> -->

                </div>

              </ul>
            </div>

            <div class="panel_block padding5">
              <h2 class="">View setting</h2>
              <ul class="padding0">
                <div class="row ">

                  <div class="col-lg-12">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">Chart size<small></small></label>
                      <select id="btnBufSize" class="selectpicker padding0 col-lg-12" data-live-search="true" data-style="btn-success select-ext">
                        <?php
                        echo select_option($bufSizeList, $bufSize);
                        ?>
                      </select>

                    </div>
                  </div>
                  
                </div>

              </ul>
            </div>
            <div class="panel_block padding5">
              <h2 class="">Record setting<small>(<?= $recordTag ?>)</small></h2>
              <ul class="padding0">
                <div class="row ">

                  <div class="col-lg-12">

                    <label class="bmd-label-floating">
                      <div class="form-check" style="padding-left: 0em;">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" id="recordEnable" value="1" <?= $recordEnable ? "checked" : "" ?>>
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                          Record data
                        </label>
                      </div>
                    </label>

                  </div>

                </div>

              </ul>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<?php
include(APP . 'v/status/v_tail.php');
?>


<script type="text/javascript">
  var myChart1 = echarts.init(document.getElementById('echartId1'));

  var option1 = {
    legend: {},
    tooltip: {},
    grid: {
      //containLabel: true,
      top: '10%',
      bottom: '15%',
      left: '7%',
      right: '5%',
    },
    xAxis: {
      type: 'category',
      data: [],
      axisLabel: {
        interval: 100,
        rotate: 40
      },
    },
    yAxis: {},
    series: [{
      name: 'CH_TEMP',
      type: 'line',
      data: [] // 0
    }, {
      name: 'TEMP_REMTE',
      type: 'line',
      data: [] // 1
    }, {
      name: 'vertMotor',
      type: 'line',
      data: [] // 2
    }, {
      name: 'powerBoard',
      type: 'line',
      data: [] // 3
    }, {
      name: 'mainBoardAdc',
      type: 'line',
      data: [] // 4
    }, {
      name: 'mainBoardFpga',
      type: 'line',
      data: [] // 5
    }]
  };

  myChart1.setOption(option1);

  // https://www.cnblogs.com/agansj/p/10837350.html
  //myChart1.showLoading(); //数据加载完之前先显示一段简单的loading动画

  var ticks = [];
  var tempData1 = [];
  var tempData2 = [];
  var tempData3 = [];
  var tempData4 = [];
  var tempData5 = [];
  var tempData6 = [];
  var contentSize = <?= $bufSize ?>;
  var reload = 1;

  function resetChart1() {
    ticks = [];
    tempData1 = [];
    tempData2 = [];
    tempData3 = [];
    tempData4 = [];
    tempData5 = [];
    tempData6 = [];
  }
  function updateChart1() {
    $.ajax({
      type: "GET",
      url: "<?= AJAX_BASE ?>/chartData/&dev=1&type=<?= CHART_TEMPEATURE ?>&reload=" + reload,
      contentType: 'application/json;charset=utf-8',
      dataType: "json",
      data: {},
      success: function(res) {
        while (res) {
          reload = 0;
          count = res.count;
          rows = res.rows;
          document.getElementById("currentValue").innerText = res.current;
          //document.getElementById("currentStatus").innerText = res.status;
          document.getElementById("currentAverage").innerText = res.average;
          document.getElementById("currentMin").innerText = res.minv;
          document.getElementById("currentMax").innerText = res.maxv;
          // document.getElementById("currentVariance").innerText = res.variance;
          // document.getElementById("currentStdev").innerText = res.stdev;
          // document.getElementById("currentFreq").innerText = res.freq;

          if (count < 1) {
            break;
          }

          ticks = ticks.concat(res.tick);
          tempData1 = tempData1.concat(res.value);
          tempData2 = tempData2.concat(res.value1);
          tempData3 = tempData3.concat(res.value2);
          tempData4 = tempData4.concat(res.value3);
          tempData5 = tempData5.concat(res.value4);
          tempData6 = tempData6.concat(res.value5);
          if (ticks.length > contentSize) {
            rm = ticks.length - contentSize;
            ticks.splice(0, rm);
            tempData1.splice(0, rm);
            tempData2.splice(0, rm);
            tempData3.splice(0, rm);
            tempData4.splice(0, rm);
            tempData5.splice(0, rm);
            tempData6.splice(0, rm);
          }
          //console.log(ticks.length);

          //myChart1.hideLoading(); //隐藏加载动画
          myChart1.setOption({ //加载数据图表
            xAxis: {
              data: ticks
            },
            series: [{
              // 根据名字对应到相应的系列
              name: 'CH_TEMP',
              data: tempData1 // 0
            }, {
              name: 'TEMP_REMTE',
              data: tempData2 // 1
            }, {
              name: 'vertMotor',
              data: tempData3 // 2
            }, {
              name: 'powerBoard',
              data: tempData4 // 3
            }, {
              name: 'mainBoardAdc',
              data: tempData5 // 4
            }, {
              name: 'mainBoardFpga',
              data: tempData6 // 5
            }, ]
          });

          break;
        }

      },
      error: function(errorMsg) {
      }
    });
  }

  updateChart1();
  setInterval(function() {
    if (1) {
      updateChart1();
    }
  }, 1000);

  window.onresize = function() {
    //location.reload();
    myChart1.resize();
  }
</script>


<script>
  $(function() {

    $("#recordEnable").click(function() {
      var enable = $(this).prop('checked') ? 1 : 0;
      var mask = <?= BRME_TEMPERATURE ?>;
      var url = "<?= URL_BASE ?>/status/enableRecord&mask=" + mask + "&enable=" + enable;

      resetChart1();
      ajaxExec(url);
    });

    $("#btnBufSize").change(function() {
      console.log("btnBufSize change");
      var dev = <?= DEVICE_HOST ?>;
      var addr = <?= REG_CHART_BUF_SIZE ?>;
      var p1 = $(this).val();
      var text = document.getElementById("btnBufSize").value;
      var value = parseInt(text);
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + dev + "&addr=" + addr + "&value=" + value + "";

      contentSize = value;
      resetChart1();
      ajaxExec(url);

      url = "<?= AJAX_BASE ?>/regSave/&dev=" + dev + "";
      ajaxExec(url);
    });

  });
</script>