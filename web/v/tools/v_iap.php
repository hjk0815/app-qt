
<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = TOOL_IAP;
        include(APP . 'v/tools/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-9 col-md-9 col-sm-9 padding0">
            <div class="col-lg-12 col-md-12 col-sm-12 padding5">
              <div class="panel_block padding0">
                <h2 class="">System log</h2>
                <ul class="padding0">
                  <div class="row ">
                  </div>
                  <div class="row ">

                    <div class="col-lg-12 col-md-12 col-sm-12 padding0">
                      <div class="log-container">
                        <div class="log-box">
                          <ul id="nativeLog" class="log-list"></ul>
                        </div>
                      </div>

                    </div>

                  </div>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 padding0">
            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding0">
                  <h2 class="">Program Flash </h2>
                  <ul class="padding0">
                    <div class="row ">
                          
                      <div class="col-lg-5">
                        <label class="bmd-label-floating" style="font-size: 1em;">iapStage<small></small></label>
                      </div>
                      <div class="col-lg-7">
                        <label id="iapStage" class="bmd-label-floating" style="font-size: 1em;">IDLE<small></small></label>
                      </div>
                      <div class="col-lg-5 row-bg-even">
                        <label class="bmd-label-floating" style="font-size: 1em;">iapPercent<small>(%)</small></label>
                      </div>
                      <div class="col-lg-7 row-bg-even">
                        <label id="iapPercent" class="bmd-label-floating" style="font-size: 1em;">0<small></small></label>
                      </div>
                      <div class="col-lg-5">
                        <label class="bmd-label-floating" style="font-size: 1em;">timeUsed<small>(s)</small></label>
                      </div>
                      <div class="col-lg-7">
                        <label id="iapTimeUsed" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                      </div>
                      
                      <div class="col-lg-5 row-bg-even">
                        <label class="bmd-label-floating" style="font-size: 1em;">bspVersion<small></small></label>
                      </div>
                      <div class="col-lg-7 row-bg-even">
                        <label id="bspVersion" class="bmd-label-floating" style="font-size: 1em;">0<small></small></label>
                      </div>
                      <div class="col-lg-5">
                        <label class="bmd-label-floating" style="font-size: 1em;">bootVersion<small></small></label>
                      </div>
                      <div class="col-lg-7">
                        <label id="bootVersion" class="bmd-label-floating" style="font-size: 1em;">0<small></small></label>
                      </div>
                      
                      <div class="col-lg-5 row-bg-even">
                        <label class="bmd-label-floating" style="font-size: 1em;">fpagVersion<small></small></label>
                      </div>
                      <div class="col-lg-7 row-bg-even">
                        <label id="fpagVersion" class="bmd-label-floating" style="font-size: 1em;"><small></small></label>
                      </div>

                    </div>
                    <div class="row ">
                      <div class="col-lg-12">
                        <button id="btnStartIap" type="button" class="btn btn-primary pull-rightxx" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload local image" data-toggle="modal" data-target="#dialogUploadIap">
                          <span class="fa fa-download "></span> Program
                        </button>
                      </div>

                    </div>
                  </ul>
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding0">
                  <h2 class="">Switch image </h2>
                  <ul class="padding0">
                    <div class="row ">
                      <div class="col-lg-12 padding5">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Image select<small></small></label>
                          <select id="btnRebootDev" class="selectpicker padding0 col-lg-12" data-live-search="true" data-style="btn-success select-ext">
                            <?php
                            echo select_option($rebootList, $rebootDev);
                            ?>
                          </select>

                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row ">
                      <div class="col-lg-12">
                        <button id="btnReboot" type="button" class="btn btn-primary pull-rightxx" data-bs-toggle="tooltip" data-bs-placement="top" title="Reboot image">
                          <span class="fa fa-repeat "></span> Reboot
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
  </div>
</div>

<?php
include(APP . 'v/tools/v_tail.php');
?>

<?php
include(APP . 'v/tools/dlg_upload_iap.php');
?>

<script>
  $(function() {
    var iapTimeUsed = 0;

    function updateIapStatus() {
      var url = "<?= AJAX_BASE ?>/iapStatus";

      $.ajax({
        type: "GET",
        url: url,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        timeout: 5000,
        success: function(res) {
          console.log(res);
          document.getElementById("iapStage").innerText = res.stage;
          document.getElementById("iapPercent").innerText = res.percent;

          document.getElementById("bspVersion").innerText = res.bspVersion;
          document.getElementById("bootVersion").innerText = res.bootVersion;
          document.getElementById("fpagVersion").innerText = res.fpagVersion;

          switch (res.status)
          {
          case <?= ISE1_TRANSING ?>:
          default:
            //timerSwal("System reboot, please wait...", 40 * 1000);
            break;

          case <?= ISE1_IDLE ?>:
            break;
          }
        },
        error: function(error) {
        }
      });
    }

    $("#btnIapDev").change(function() {
      var text = $(this).val();
      var value = parseInt(text);

      console.log("btnIapDev:" + value);
      document.getElementById("iapDev").value = value;
    });

    $("#btnRebootDev").change(function() {
      var text = $(this).val();
      var value = parseInt(text);

      console.log("btnRebootDev:" + value);
      //document.getElementById("iapDev").value = value;
    });

    $("#btnReboot").click(function() {
      var text = $("#btnRebootDev").val();
      var value = parseInt(text);
      var url = "<?= AJAX_BASE ?>/iapReboot/&iapDev=" + value;

      console.log("btnReboot:" + value);
      ajaxExec(url);
      timerSwal("System reboot, please wait...", 40 * 1000);
    });

    setInterval(function() {
      if (1) {
        updateIapStatus();
      }
    }, 1000);

  });
</script>

<script>
  $(function() {
    var maxLogs = 1000; // 最大日志行数
    var logCounter = 0; // 当前日志行数计数
    var logShow = 0;
    var reload = 1;

    function addLog(type, message) {
      var logClass = 'log-item';
      switch (type) {
        case <?= EL_NORMAL ?>:
        default:
          logClass += ' log-info';
          break;
        case <?= EL_HIGHLIGHT ?>:
          logClass += ' log-highlight';
          break;
        case <?= EL_WARNING ?>:
          logClass += ' log-warning';
          break;
        case <?= EL_ERROR ?>:
          logClass += ' log-error';
          break;
      }

      var logItem = $('<li>').addClass(logClass).text(message);
      logItem.attr('data-line', logCounter + 1); // 设置自定义属性作为行号
      $('#nativeLog').append(logItem);

      logCounter++;
      logShow++;
      if (logShow > maxLogs) {
        $('#nativeLog li:first').remove();
        logShow--;
      }

      // 滚动到最新的日志位置
      $('.log-box').scrollTop($('.log-box')[0].scrollHeight);
    }

    function updateLog() {
      $.ajax({
        type: "GET",
        url: "<?= AJAX_BASE ?>/nativeLog/&reload=" + reload,
        contentType: 'application/json;charset=utf-8',
        dataType: "json",
        data: {},
        success: function(res) {
          var ticks = [];
          var noiseTemp = [];

          reload = 0;
          //console.log(res);
          while (res.code == 0) {
            if (res.count < 1) break;

            count = res.count;
            rows = res.rows;
            for (var i = 0; i < res.rows.length; i++) {
              var r = res.rows[i];
              addLog(r.level, r.log);
            }
            break;
          }

        },
        error: function(errorMsg) {

        }
      });
    }


    addLog(1, '--------IAP log message.--------');
    setInterval(function() {
      if (1) {
        updateLog();
      }
    }, 100);

  });
</script>