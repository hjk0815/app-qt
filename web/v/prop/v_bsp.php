<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = PROP_BSP;
        include(APP . 'v/prop/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-3 col-md-3 col-sm-12 padding0">
            <div class="row ">
              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Normal parameters</h2>
                  <ul class="padding0">

                    <div class="row ">
                      <?php if ($userAuth >= AUTH_ENGINEER) { ?>
                        <div class="col-lg-5">
                          <div class="form-group" style="margin-top: 0px;">
                            <label class="bmd-label-floating">Work mode<small></small></label>
                            <select id="btnWorkMode" class="selectpicker padding0 col-lg-12" data-live-search="true" data-style="btn-success select-ext">
                              <?php
                              echo select_option($workMode, $activeMode);
                              ?>
                            </select>

                          </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                          <div class="form-group" style="margin-top: 0px;">
                            <label class="bmd-label-floating" id="rawDegreeTitle">Raw channel select<small></small></label>
                            <input type="number" class="form-control" id="rawDegree" required="" data-decimals="0" step="1" min="0" max="65536" value="<?= $rawDegree ?>">
                          </div>
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                          <div class="form-group" style="margin-top: 0px;">
                            <label class="bmd-label-floating">DDC0 start bin<small></small></label>
                            <input type="number" class="form-control" id="ddc0FftStart" required="" data-decimals="0" step="1" min="0" max="65536" value="<?= $ddc0FftStart ?>">
                          </div>
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                          <div class="form-group" style="margin-top: 0px;">
                            <label class="bmd-label-floating">DDC0 cutoff bin<small></small></label>
                            <input type="number" class="form-control" id="ddc0FftCutoff" required="" data-decimals="0" step="1" min="0" max="65536" value="<?= $ddc0FftCutoff ?>">
                          </div>
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                          <div class="form-group" style="margin-top: 0px;">
                            <label class="bmd-label-floating">DDC1 start bin<small></small></label>
                            <input type="number" class="form-control" id="ddc1FftStart" required="" data-decimals="0" step="1" min="0" max="65536" value="<?= $ddc1FftStart ?>">
                          </div>
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                          <div class="form-group" style="margin-top: 0px;">
                            <label class="bmd-label-floating">DDC1 cutoff bin<small></small></label>
                            <input type="number" class="form-control" id="ddc1FftCutoff" required="" data-decimals="0" step="1" min="0" max="65536" value="<?= $ddc1FftCutoff ?>">
                          </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <label class="bmd-label-floating">FFT peak mode<small></small></label>
                          <select id="fftPeakMode" class="selectpicker col-lg-12" data-live-search="true" data-style="btn-primary select-ext">
                            <?php
                            echo select_option($fftPeakModeList, $fftPeakMode);
                            ?>
                          </select>
                        </div>

                      <?php } ?>

                    </div>

                  </ul>

                </div>
              </div>


            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 padding0">
            <div class="row ">
              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Module enable</h2>
                  <ul class="padding0">
                    <div class="row ">

                      <div class="col-lg-12">
                        <label class="bmd-label-floating">
                          <input type="checkbox" class="form-check-inputx" id="REG_UDP_TRANS_DISABLE" value="1" <?= $REG_UDP_TRANS_DISABLE ? "checked" : "" ?>>
                          UDP data disable
                        </label>
                      </div>
                      <div class="col-lg-12">
                        <label class="bmd-label-floating">
                          <input type="checkbox" class="form-check-inputx" id="REG_CMD_TRANS_DISABLE" value="1" <?= $REG_CMD_TRANS_DISABLE ? "checked" : "" ?>>
                          CMD response disable
                        </label>
                      </div>

                    </div>

                  </ul>
                </div>
              </div>
            </div>

            <div class="row ">
              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">EDFA control</h2>
                  <ul class="padding0">
                    <div class="row ">

                      <div class="col-lg-12">
                        <label class="bmd-label-floating">
                          <input type="checkbox" class="form-check-inputx" id="REG_EDFA_PUMP_ENABLE" value="1" <?= $REG_EDFA_PUMP_ENABLE ? "checked" : "" ?>>
                          EDFA Pump enable
                        </label>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">EDFA power value<small></small></label>
                          <input type="number" class="form-control" id="REG_EDFA_POWER" required="" data-decimals="0" min="150" max="450" step="1" value="<?= $REG_EDFA_POWER ?>">
                        </div>
                      </div>

                    </div>

                    <div class="row ">
                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <label class="pull-rightxx align-middle">Clear warning </label>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <button id="clearEdfaWarning" type="button" class="btn btn-primary pull-rightxx">
                          <span class="fa fa-upload "></span>Clear
                        </button>
                      </div>

                    </div>

                  </ul>
                </div>
              </div>
            </div>

            <div class="row ">
              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">DAC5311 control</h2>
                  <ul class="padding0">
                    <div class="row ">

                      <div class="col-lg-12">
                        <label class="bmd-label-floating">
                          <input type="checkbox" class="form-check-inputx" id="REG_TIA_DAC5311" value="1" <?= $REG_TIA_DAC5311 ? "checked" : "" ?>>
                          TIA enable
                        </label>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">VGA value<small></small></label>
                          <input type="number" class="form-control" id="REG_VGA_DAC5311" required="" data-decimals="0" value="<?= $REG_VGA_DAC5311 ?>">
                        </div>
                      </div>

                    </div>

                  </ul>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 padding0">
            <div class="row ">

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Debug parameters</h2>
                  <ul class="padding0">

                    <?php foreach ($debugParamGroup as $name => $pair) {
                      $value = $pair[0];
                      $id = $pair[1];
                    ?>
                      <div class="row ">
                        <div class="col-lg-12">
                          <div class="form-group" style="margin-top: 0px;">
                            <label class="bmd-label-floating"><?= $name ?> <small></small></label>
                            <input type="number" class="form-control" id="btnCustom<?= $id ?>" required="" value="<?= $value ?>">
                          </div>
                        </div>
                      </div>
                    <?php }  ?>

                    <?php if ($userAuth >= AUTH_ENGINEER) { ?>
                      <div class="row ">

                      </div>

                    <?php } ?>

                  </ul>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 padding0">
            <div class="row ">
              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">System configuration</h2>
                  <ul class="padding0">
                    <div class="row ">
                      <div class="col-lg-12">
                        <button id="btnSave" type="button" class="btn btn-primary pull-rightxx">
                          <span class="fa fa-archive "></span>Save
                        </button>
                        <label class="pull-right align-middle">*Archive to flash</label>
                      </div>
                    </div>

                    <hr>
                    <div class="row ">
                      <div class="col-lg-12">
                        <button id="btnReload" type="button" class="btn btn-primary pull-rightxx">
                          <span class="fa fa-gavel "></span>Load
                        </button>
                        <label class="pull-right align-middle">*Reload setting from flash</label>
                      </div>
                    </div>

                    <hr>
                    <div class="row ">
                      <div class="col-lg-12">
                        <button id="btnDefault" type="button" class="btn btn-primary pull-rightxx">
                          <span class="fa fa-refresh "></span>Default
                        </button>
                        <label class="pull-right align-middle">*Reset all </label>
                      </div>
                    </div>

                  </ul>
                </div>
              </div>
            </div>

            <div class="row ">
              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">System IAP</h2>
                  <ul class="padding0">
                    <div class="row ">
                      <div class="col-lg-12">
                        <button id="btnUpload" type="button" class="btn btn-primary pull-rightxx" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload local threshold file" href="#" data-toggle="modal" data-target="#dialogUploadFile">
                          <span class="fa fa-cloud-upload "></span> Upload
                        </button>
                        <label class="pull-right align-middle">*Upload firmware(*.bin)</label>


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
include(APP . 'v/prop/v_tail.php');
?>

<?php
include(APP . 'v/prop/dlg_upload_fw.php');
?>

<script>
  $(function() {
    var activeDev = <?= DEVICE_BSP ?>;
    var waitTime = <?= $waitTime ?>;
    var waitTitle = "<?= $waitTitle ?>";

    function updateWorkMode(download = 0) {
      var addr = <?= REG_WORK_MODE ?>;
      var text1 = document.getElementById("btnWorkMode").value;
      var text2 = document.getElementById("rawDegree").value;
      var mode = parseInt(text1);
      var degree = parseInt(text2);
      var value = (mode & 0xff) + ((degree & 0xffff) << 16);
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      if (mode == 0) {
        $("#rawDegreeTitle").hide();
        $("#rawDegree").hide();
      } else {
        $("#rawDegreeTitle").show();
        $("#rawDegree").show();
      }

      if (download) {
        ajaxExec(url);
      }
      //window.location.href = url;
    }

    <?php if ($userAuth >= AUTH_ENGINEER) { ?>
      updateWorkMode();
      $("#btnWorkMode").change(function() {
        updateWorkMode(1);
      });
    <?php } ?>

    $("#rawDegree").change(function() {
      updateWorkMode(1);
    });

    function updateFftStartBin() {
      var addr = <?= REG_FFT_START_BIN ?>;
      var text1 = document.getElementById("ddc0FftStart").value;
      var text2 = document.getElementById("ddc1FftStart").value;
      var b0 = parseInt(text1);
      var b1 = parseInt(text2);
      var value = (b0 & 0x7fff) + ((b1 & 0x7fff) << 16);
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    }

    function updateFftCutoffBin() {
      var addr = <?= REG_FFT_CUTOFF_BIN ?>;
      var text1 = document.getElementById("ddc0FftCutoff").value;
      var text2 = document.getElementById("ddc1FftCutoff").value;
      var b0 = parseInt(text1);
      var b1 = parseInt(text2);
      var value = (b0 & 0x7fff) + ((b1 & 0x7fff) << 16);
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    }

    $("#ddc0FftStart").change(function() {
      updateFftStartBin();
    });

    $("#ddc1FftStart").change(function() {
      updateFftStartBin();
    });

    $("#ddc0FftCutoff").change(function() {
      updateFftCutoffBin();
    });

    $("#ddc1FftCutoff").change(function() {
      updateFftCutoffBin();
    });

    //
    $("#fftPeakMode").change(function() {
      var addr = <?= REG_FFT_PEAK_CMD ?>;
      var text = $(this).val();
      var value = parseInt(text);
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    <?php foreach ($debugParamGroup as $name => $pair) { // 模板化输入
      $value = $pair[0];
      $id = $pair[1];
    ?>
      $("#btnCustom<?= $id ?>").change(function() {
        var addr = <?= $id ?>;
        var text = document.getElementById("btnCustom<?= $id ?>").value;
        var value = parseInt(text);
        var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

        ajaxExec(url);
        //window.location.href = url;
      });

    <?php }  ?>

    $("#REG_UDP_TRANS_DISABLE").click(function() {
      var addr = <?= REG_UDP_TRANS_DISABLE ?>;
      var value = $(this).prop('checked') ? 1 : 0;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_CMD_TRANS_DISABLE").click(function() {
      var addr = <?= REG_CMD_TRANS_DISABLE ?>;
      var value = $(this).prop('checked') ? 1 : 0;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#btnSave").click(function() {
      var addr = <?= REG_CONFIG_WRITE ?>;
      var value = 1;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#btnReload").click(function() {
      var addr = <?= REG_CONFIG_LOAD ?>;
      var value = 1;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      sleep(100);
      //window.location.href = url;
      location.reload();
    });

    $("#btnDefault").click(function() {
      var addr = <?= REG_CONFIG_DEFAULT ?>;
      var value = 1;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      sleep(100);
      //window.location.href = url;
      location.reload();
    });

    $("#btnNoistSet").click(function() {
      var url = "<?= URL_BASE ?>/tools/noise";
      window.location.href = url;
    });

    $("#REG_EDFA_PUMP_ENABLE").click(function() {
      var addr = <?= REG_EDFA_PUMP_ENABLE ?>;
      var value = $(this).prop('checked') ? 1 : 0;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_EDFA_POWER").click(function() {
      var addr = <?= REG_EDFA_POWER ?>;
      var value = document.getElementById("REG_EDFA_POWER").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#clearEdfaWarning").click(function() {
      var addr = <?= REG_EDFA_WARNING_CLEAR ?>;
      var value = 1
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#REG_VGA_DAC5311").click(function() {
      var addr = <?= REG_VGA_DAC5311 ?>;
      var value = document.getElementById("REG_VGA_DAC5311").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_TIA_DAC5311").click(function() {
      var addr = <?= REG_TIA_DAC5311 ?>;
      var value = $(this).prop('checked') ? 1 : 0;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    function waitJobFinish() {
      if (waitTime > 0) {
        timerSwal(waitTitle, waitTime * 1000);
      }
      waitTime = 0;
      waitTitle = "";
    }

    if (waitTime > 0) {
      waitJobFinish();
    } else {
      // updateRoughValue();
      // updateCaptureStatus();
      // setInterval(function() {
      //   if (updateCapture) {
      //     updateCaptureStatus();
      //   }
      // }, 500);
    }

  });
</script>