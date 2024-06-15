<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = TOOL_NOISE;
        $page = NOISE_CAPTURE;
        include(APP . 'v/tools/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-8 col-md-8 col-sm-8 padding5">
            <div class="panel_block padding5">
              <h2 class="">Base noise capture</h2>
              <ul class="padding0">

                <div class="row">
                  <div class="col-lg-12 padding0">
                    <div class="row padding0">
                      <div id="echartId1" style="width:100%;height:450px;"></div>
                    </div>
                  </div>

                </div>
              </ul>
            </div>
          </div>


          <div class="col-lg-4 col-md-4 col-sm-4 padding5">

            <div class="panel_block padding5">
              <h2 class="">Base noise calculate</h2>
              <ul class="padding0">

                <div class="row ">
                  <div class="col-lg-12">
                    <label class="bmd-label-floating" style="font-size: 1em;">Device ID : <small></small></label>
                  </div>

                  <div class="col-lg-12">
                    <input type="text" class="form-control" id="deviceID" required="" value="#B2"> 
                  </div>

                  <div class="col-lg-12">
                    <label class="bmd-label-floating" style="font-size: 1em;">algorithm : <small></small></label>
                  </div>

                  <div class="col-lg-2">
                    <label for="REG_BNOISE_DO_MAX" style="color:black">
                      <input type="radio" class="form-check-inputx" id="REG_BNOISE_DO_MAX" name="calculate" value="1" <?= 1 ? "checked" : "" ?>>
                      MAX
                    </label>
                  </div>
                  <div class="col-lg-2">
                    <label for="REG_BNOISE_DO_MIN" style="color:black">
                      <input type="radio" class="form-check-inputx" id="REG_BNOISE_DO_MIN" name="calculate" value="1" <?= 1 ? "checked" : "" ?>>
                      MIN
                    </label>
                  </div>
                  <div class="col-lg-2">
                    <label for="REG_BNOISE_DO_ONE" style="color:black">
                      <input type="radio" class="form-check-inputx" id="REG_BNOISE_DO_ONE" name="calculate" value="1" <?= 1 ? "checked" : "" ?>>
                      ONE
                    </label>
                  </div>
                  <div class="col-lg-3">
                    <label for="REG_BNOISE_DO_MHZ" style="color:black">
                      <input type="radio" class="form-check-inputx" id="REG_BNOISE_DO_MHZ" name="calculate" value="1" <?= 1 ? "checked" : "" ?>>
                      *MHz
                    </label>
                  </div>
                  <div class="col-lg-3">
                    <label for="REG_BNOISE_DO_STD" style="color:black">
                      <input type="radio" class="form-check-inputx" id="REG_BNOISE_DO_STD" name="calculate" value="1" <?= 1 ? "checked" : "" ?>>
                      std
                    </label>
                  </div>
                  <div class="col-lg-12">
                    <label for="MHZ_NUM" style="color:black">
                      MHZ放大倍数
                      <input type="number" class="form-check-inputx" id="REG_BNOISE_MHZ_NUM" value="10" step="1" min="0" max="1000" style="border: none;" >   
                    </label>
                  </div>

                  <div class="col-lg-12">
                    <label class="bmd-label-floating" style="font-size: 1em;">bin : <small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label for="DDC0_LOW" style="color:black">
                      DDC0start
                      <input type="number" class="form-check-inputx" id="DDC0_LOW" value="32" step="1" min="0" max="4096" style="border: none;" >   
                    </label>
                  </div>

                  <div class="col-lg-6">
                    <label for="DDC0_HIGH" style="color:black">
                      DDC0end
                      <input type="number" class="form-check-inputx" id="DDC0_HIGH" value="3936" step="1" min="0" max="4096" style="border: none;" >   
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <label for="DDC1_LOW" style="color:black">
                      DDC1start
                      <input type="number" class="form-check-inputx" id="DDC1_LOW" value="159" step="1" min="0" max="4096" style="border: none;" >   
                    </label>
                  </div>

                  <div class="col-lg-6">
                    <label for="DDC1_HIGH" style="color:black">
                      DDC1end
                      <input type="number" class="form-check-inputx" id="DDC1_HIGH" value="3800" step="1" min="0" max="4096" style="border: none;" >   
                    </label>
                  </div>

                  <div class="row ">
                    <div class="col-lg-12">
                      <button id="btnWrite" type="button" class="btn btn-success pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Start write">
                        <span class="fa fa-pencil fa-5x"></span>
                      </button>
                      <button id="btnRead" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Read Reg Noise">
                        <span class="fa fa-book fa-5x"></span>
                      </button>
                      <button id="btnWriteH5" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Write h5 to device">
                        <span class="fa fa-open fa-5x"></span>
                      </button>

                    </div>
                  </div>

                </div>
                <div class="row ">

                </div>

              </ul>
            </div>

            <div class="panel_block padding5">
              <h2 class="">Base noise control</h2>
              <ul class="padding0">
                <div class="row ">

                  <div class="col-lg-12">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">Channel index<small></small></label>
                      <select id="btnChannel" class="selectpicker padding0 col-lg-12" data-live-search="true" data-style="btn-success select-ext">
                        <?php
                        echo select_option($chList, $chActive);
                        ?>
                      </select>

                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">Sample number<small></small></label>
                      <input type="number" class="form-control" id="sampleNumber" required="" data-decimals="0" step="1" min="20" max="1000" value="<?= $REG_SAMPLE_TIMES ?>">
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <label class="bmd-label-floating">
                      <input type="checkbox" class="form-check-inputx" id="REG_SAMPLE_AUTO_TRAVERSAL" value="1" <?= $REG_SAMPLE_AUTO_TRAVERSAL ? "checked" : "" ?>>
                      Auto traversal
                    </label>
                  </div>

                  <div class="col-lg-12">
                    <progress class="progress" id="capturePercent" value="0" max="100" style="width:100%"></progress>
                  </div>

                </div>
                <hr>
                <div class="row ">
                </div>
                <div class="row ">

                  <div class="col-lg-12">
                    <button id="btnStartCap" type="button" class="btn btn-success pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Start cap">
                      <span class="fa fa-play fa-5x"></span>
                    </button>
                    <button id="btnStopCap" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Stop cap">
                      <span class="fa fa-stop fa-5x"></span>
                    </button>
                    <button id="btnDownload" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Download to device">
                      <span class="fa fa-cloud-download fa-5x"></span>
                    </button>
                    <button id="btnSave" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Save config">
                      <span class="fa fa-save fa-5x"></span>
                    </button>
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
include(APP . 'v/tools/v_tail.php');
?>

<script type="text/javascript">
  var myChart1 = echarts.init(document.getElementById('echartId1'));
  var chTitle = "Noise state(<?= $chActive ?>)";
  var chActive = <?= $chActive ?>;
  var autoTravel = 0;

  var option1 = {
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
      left: '7%',
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
      name: chTitle,
      type: 'line',
      data: [],
      itemStyle: {
        normal: {
          color: 'blue'
        }
      },
    }, {
      name: 'average',
      type: 'line',
      data: [],
      itemStyle: {
        normal: {
          color: 'green'
        }
      },
    }]
  };

  myChart1.setOption(option1);

  // https://www.cnblogs.com/agansj/p/10837350.html
  //myChart1.showLoading(); //数据加载完之前先显示一段简单的loading动画

  var ticks = [];
  var noiseTemp = [];
  var aveTemp = [];

  function checkTraversal(filled, full) {
    var dev = <?= DEVICE_BOTTOM_NOISE ?>;
    var cmd, url, value;

    if (filled < full) {
      return;
    }

    console.log("checkTraversal save config");
    cmd = <?= NCE_SAVE_CONFIG ?>;
    url = "<?= AJAX_BASE ?>/noiseCmd/&cmd=" + cmd + "&ch=" + chActive + "";
    ajaxExec(url);

    var traversal = $("#REG_SAMPLE_AUTO_TRAVERSAL").prop('checked') ? 1 : 0;
    if (!traversal) {
      return;
    }

    console.log("checkTraversal switch channel");
    addr = <?= REG_SAMPLE_CHANNEL ?>;
    value = (parseInt(chActive) + 1) % 8;
    url = "<?= AJAX_BASE ?>/regSet/&dev=" + dev + "&addr=" + addr + "&value=" + value + "";
    ajaxExec(url);
    chActive = value;

    console.log("checkTraversal start cap");
    cmd = <?= NCE_START_CAP ?>;
    url = "<?= AJAX_BASE ?>/noiseCmd/&cmd=" + cmd + "&ch=" + chActive + "";
    ajaxExec(url);

    location.reload();
  }

  function updateChart1() {
    $.ajax({
      type: "GET",
      url: "<?= AJAX_BASE ?>/noiseData/&type=<?= NCE_CAPTURE ?>&ch=" + chActive + "",
      contentType: 'application/json;charset=utf-8',
      dataType: "json",
      data: {},
      success: function(res) {
        //console.log(res);
        while (res) {
          count = res.count;
          rows = res.rows;
          if (count < 1) {
            break;
          }

          ticks = res.tick;
          noiseTemp = res.value;
          aveTemp = res.average;
          //aveTemp = res.capturePercent;
          console.log("filled:" + res.filled);
          console.log("full:" + res.full);
          console.log("percent:" + res.capturePercent);
          document.getElementById("capturePercent").value = res.capturePercent;

          var traversal = $("#REG_SAMPLE_AUTO_TRAVERSAL").prop('checked') ? 1 : 0;
          if (traversal) {
            checkTraversal(res.filled, res.full);
          }
          
          //myChart1.hideLoading(); //隐藏加载动画
          myChart1.setOption({ //加载数据图表
            xAxis: {
              data: ticks
            },
            series: [{
              name: chTitle,
              data: noiseTemp
            }, {
              name: 'average',
              data: aveTemp
            }, ]
          });

          break;
        }

      },
      error: function(errorMsg) {}
    });
  }

  updateChart1();
  // setInterval(function() {
  //   if (1) {
  //     updateChart1();
  //   }
  // }, 1000);

  window.onresize = function() {
    myChart1.resize();
  }
</script>

<script>
  $(function() {
    var activeDev = <?= DEVICE_BOTTOM_NOISE ?>;

    $("#REG_SAMPLE_AUTO_TRAVERSAL").change(function() {
      var addr = <?= REG_SAMPLE_AUTO_TRAVERSAL ?>;
      var value = $(this).prop('checked') ? 1 : 0;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      autoTravel = value;
      ajaxExec(url);
      //window.location.href = url;
    });

    $("#btnStartCap").click(function() {
      var cmd = <?= NCE_START_CAP ?>;
      var url = "<?= AJAX_BASE ?>/noiseCmd/&cmd=" + cmd + "&ch=" + chActive + "";

      ajaxExec(url);
    });

    $("#btnStopCap").click(function() {
      var cmd = <?= NCE_STOP_CAP ?>;
      var url = "<?= AJAX_BASE ?>/noiseCmd/&cmd=" + cmd + "&ch=" + chActive + "";

      ajaxExec(url);
    });

    $("#btnDownload").click(function() {
      var cmd = <?= NCE_DOWNLOAD_CONFIG ?>;
      var url = "<?= AJAX_BASE ?>/noiseCmd/&cmd=" + cmd + "&ch=" + chActive + "";
      console.info(url);
      ajaxExec(url);
    });

    $("#btnSave").click(function() {
      var cmd = <?= NCE_SAVE_CONFIG ?>;
      var url = "<?= AJAX_BASE ?>/noiseCmd/&cmd=" + cmd + "&ch=" + chActive + "";

      ajaxExec(url);
    });

    $("#btnChannel").change(function() {
      var addr = <?= REG_SAMPLE_CHANNEL ?>;
      var text = document.getElementById("btnChannel").value;
      var value = parseInt(text);
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);

      chActive = value;
      chTitle = "Noise state(" + chActive + ")";
      updateChart1();
    });

    $("#sampleNumber").change(function() {
      var addr = <?= REG_SAMPLE_TIMES ?>;
      var value = document.getElementById("sampleNumber").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#btnWrite").click(function(){
      var cmd = <?= NCE_SET_CALCULATE ?>;
      // var deviceID = document.getElementById("deviceID").value;
      var radioButtons = document.getElementsByName("calculate");
      var parment1 = 0;
      var parment2 = 0;
      for (var i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].checked) {
            // console.log("Checked radio value: " + radioButtons[i].id + "index :: " + i);
            parment1 = i ;
          }
      }
      // return;
      parment2 = document.getElementById("REG_BNOISE_MHZ_NUM").value;
      var url = "<?= AJAX_BASE ?>/noiseCmd/&cmd=" + cmd + "&ch=" + chActive + "&parment1="+ parment1 + "&parment2="+ parment2 + "";
      // console.info(url);
      // return;
      ajaxExec(url);

      var cmd = <?= NCE_SET_BIN_DDC0 ?>;
      var parment1 = document.getElementById("DDC0_LOW").value;
      var parment2 = document.getElementById("DDC0_HIGH").value;
      var url = "<?= AJAX_BASE ?>/noiseCmd/&cmd=" + cmd + "&ch=" + chActive + "&parment1="+ parment1 + "&parment2="+ parment2 + "";
      // console.info(url);
      // return;
      ajaxExec(url);

      var cmd = <?= NCE_SET_BIN_DDC1 ?>;
      var parment1 = document.getElementById("DDC1_LOW").value;
      var parment2 = document.getElementById("DDC1_HIGH").value;
      var url = "<?= AJAX_BASE ?>/noiseCmd/&cmd=" + cmd + "&ch=" + chActive + "&parment1="+ parment1 + "&parment2="+ parment2 + "";
      // console.info(url);
      // return;
      ajaxExec(url);
    });


  });
</script>