<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = STATUS_VOLTAGE;
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
                      <div id="echartId1" style="width:100%;height:230px;"></div>
                    </div>
                    <div class="row padding0">
                      <div id="echartId2" style="width:100%;height:230px;"></div>
                    </div>
                    <div class="row padding0">
                      <div id="echartId3" style="width:100%;height:230px;"></div>
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
                    <label id="currentStatus" class="bmd-label-floating" style="font-size: 1em;color:darkslategray">V</label>
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

                  <!-- <div class="col-lg-6">
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
  var myChart2 = echarts.init(document.getElementById('echartId2'));
  var myChart3 = echarts.init(document.getElementById('echartId3'));

  var option1 = {
    legend: {},
    tooltip: {},
    grid: {
      //containLabel: true,
      top: '10%',
      bottom: '20%',
      left: '7%',
      right: '5%',
    },
    xAxis: {
      type: 'category',
      data: [],
      axisLabel: {
        interval: 29,
        rotate: 40
      },
    },
    yAxis: {},
    series: [{
      name: 'vccData0',
      type: 'line',
      data: []
    }, {
      name: 'vccData1',
      type: 'line',
      data: []
    }, {
      name: 'vccData2',
      type: 'line',
      data: []
    }, {
      name: 'vccData3',
      type: 'line',
      data: []
    }, {
      name: 'vccData4',
      type: 'line',
      data: []
    }, {
      name: 'vccData5',
      type: 'line',
      data: []
    }]
  };
  var option2 = {
    legend: {},
    tooltip: {},
    grid: {
      //containLabel: true,
      top: '10%',
      bottom: '20%',
      left: '7%',
      right: '5%',
    },
    xAxis: {
      type: 'category',
      data: [],
      axisLabel: {
        interval: 29,
        rotate: 40
      },
    },
    yAxis: {},
    series: [{
      name: 'vccData6',
      type: 'line',
      data: []
    }, {
      name: 'vccData7',
      type: 'line',
      data: []
    }, {
      name: 'vccData8',
      type: 'line',
      data: []
    }, {
      name: 'vccData9',
      type: 'line',
      data: []
    }]
  };
  var option3 = {
    legend: {},
    tooltip: {},
    grid: {
      //containLabel: true,
      top: '10%',
      bottom: '20%',
      left: '7%',
      right: '5%',
    },
    xAxis: {
      type: 'category',
      data: [],
      axisLabel: {
        interval: 29,
        rotate: 40
      },
    },
    yAxis: {},
    series: [{
      name: 'vccData10',
      type: 'line',
      data: []
    }, {
      name: 'vccData11',
      type: 'line',
      data: []
    }, {
      name: 'vccData12',
      type: 'line',
      data: []
    }, {
      name: 'vccData13',
      type: 'line',
      data: []
    }, {
      name: 'vccData14',
      type: 'line',
      data: []
    }, {
      name: 'vccData15',
      type: 'line',
      data: []
    }, {
      name: 'vccData16',
      type: 'line',
      data: []
    }]
  };

  myChart1.setOption(option1);
  myChart2.setOption(option2);
  myChart3.setOption(option3);

  // https://www.cnblogs.com/agansj/p/10837350.html
  //myChart1.showLoading(); //数据加载完之前先显示一段简单的loading动画

  var ticks = [];
  var vccData0 = [];
  var vccData1 = [];
  var vccData2 = [];
  var vccData3 = [];
  var vccData4 = [];
  var vccData5 = [];
  var vccData6 = [];
  var vccData7 = [];
  var vccData8 = [];
  var vccData9 = [];
  var vccData10 = [];
  var vccData11 = [];
  var vccData12 = [];
  var vccData13 = [];
  var vccData14 = [];
  var vccData15 = [];
  var vccData16 = [];
  var contentSize = <?= $bufSize ?>;
  var reload = 1;

  function resetChart1() {
    ticks = [];
    vccData0 = [];
    vccData1 = [];
    vccData2 = [];
    vccData3 = [];
    vccData4 = [];
    vccData5 = [];
    vccData6 = [];
    vccData7 = [];
    vccData8 = [];
    vccData9 = [];
    vccData10 = [];
    vccData11 = [];
    vccData12 = [];
    vccData13 = [];
    vccData14 = [];
    vccData15 = [];
    vccData16 = [];
  }
  function updateChart1() {
    $.ajax({
      type: "GET",
      url: "<?= AJAX_BASE ?>/chartData/&dev=1&type=<?= CHART_VOLTAGE ?>&reload=" + reload,
      contentType: 'application/json;charset=utf-8',
      dataType: "json",
      data: {},
      success: function(res) {
        while (res) {
          //console.log(res);
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
          vccData0 = vccData0.concat(res.value);
          vccData1 = vccData1.concat(res.value1);
          vccData2 = vccData2.concat(res.value2);
          vccData3 = vccData3.concat(res.value3);
          vccData4 = vccData4.concat(res.value4);
          vccData5 = vccData5.concat(res.value5);
          vccData6 = vccData6.concat(res.value6);
          vccData7 = vccData7.concat(res.value7);
          vccData8 = vccData8.concat(res.value8);
          vccData9 = vccData9.concat(res.value9);

          vccData10 = vccData10.concat(res.value10);
          vccData11 = vccData11.concat(res.value11);
          vccData12 = vccData12.concat(res.value12);
          vccData13 = vccData13.concat(res.value13);
          vccData14 = vccData14.concat(res.value14);
          vccData15 = vccData15.concat(res.value15);
          vccData16 = vccData16.concat(res.value16);
          if (ticks.length > contentSize) {
            rm = ticks.length - contentSize;
            ticks.splice(0, rm);
            vccData0.splice(0, rm);
            vccData1.splice(0, rm);
            vccData2.splice(0, rm);
            vccData3.splice(0, rm);
            vccData4.splice(0, rm);
            vccData5.splice(0, rm);
            vccData6.splice(0, rm);
            vccData7.splice(0, rm);
            vccData8.splice(0, rm);
            vccData9.splice(0, rm);

            vccData10.splice(0, rm);
            vccData11.splice(0, rm);
            vccData12.splice(0, rm);
            vccData13.splice(0, rm);
            vccData14.splice(0, rm);
            vccData15.splice(0, rm);
            vccData16.splice(0, rm);
          }

          //myChart1.hideLoading(); //隐藏加载动画
          myChart1.setOption({ //加载数据图表
            xAxis: {
              data: ticks
            },
            series: [{
              // 根据名字对应到相应的系列
              name: 'VCC_INTLP(\'V)',
              data: vccData0
            }, {
              name: 'VCCAMS(\'V)',
              data: vccData1
            }, {
              name: 'MAINBOARD_9V(\'V)',
              data: vccData2
            }, {
              name: 'POWERIN_12V(\'V)',
              data: vccData3
            }, {
              name: 'AMPLIFIER_6V6(\'V)',
              data: vccData4
            }, {
              name: 'MOTOR_25V(\'V)',
              data: vccData5
            }, ]
          });
          myChart2.setOption({ //加载数据图表
            xAxis: {
              data: ticks
            },
            series: [{
              name: 'I_MAINBOARD_9V(\'A)',
              data: vccData6
            }, {
              name: 'I_POWERIN_12V(\'A)',
              data: vccData7
            }, {
              name: 'I_AMPLIFIER_6V6(\'A)',
              data: vccData8
            }, {
              name: 'I_MOTOR_25V(\'A)',
              data: vccData9
            }, ]
          });
          myChart3.setOption({ //加载数据图表
            xAxis: {
              data: ticks
            },
            series: [{
              name: 'V_GTX(\'V)',
              data: vccData10
            }, {
              name: 'V_PS_CORE(\'V)',
              data: vccData11
            }, {
              name: 'V_PL_CORE(\'V)',
              data: vccData12
            }, {
              name: 'V_PL_1V8IO(\'V)',
              data: vccData13
            }, {
              name: 'V_PS_3V3IO(\'V)',
              data: vccData14
            }, {
              name: 'V_MB_3V3LDO(\'V)',
              data: vccData15
            }, {
              name: 'V_MB_3V3BUCK(\'V)',
              data: vccData16
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
    myChart2.resize();
    myChart3.resize();
  }
</script>


<script>
  $(function() {

    $("#recordEnable").click(function() {
      var enable = $(this).prop('checked') ? 1 : 0;
      var mask = <?= BRME_VOLTAGE ?>;
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