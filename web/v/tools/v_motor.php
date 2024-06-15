<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = TOOL_MOTOR;
        include(APP . 'v/tools/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-3 col-md-3 col-sm-12 padding0">
            <div class="col-lg-12 col-md-12 col-sm-12 padding5">
              <div class="panel_block padding5">
                <h2 class="">Motor control</h2>
                <ul class="padding0">
                  <div class="row ">
                    <div class="col-lg-12">
                      <label class="bmd-label-floating">
                        <input type="checkbox" class="form-check-inputx" id="REG_MOTOR_EN_DIS" value="1" <?= $REG_MOTOR_EN_DIS ? "checked" : "" ?>>
                        Motor enable
                      </label>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                      <div class="form-group" style="margin-top: 0px;">
                        <label class="bmd-label-floating">Motor Position<small></small></label>
                        <input type="number" class="form-control" id="REG_MOTOR_ALL_POSITIONS" required="" data-decimals="0" step="1" min="1" max="65535" value="<?= $REG_MOTOR_ALL_POSITIONS ?>" readonly>
                      </div>
                    </div>
                  </div>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 padding0">

            <?php if ($userAuth >= AUTH_ENGINEER) { ?>
              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Vertical mirror offset</h2>
                  <ul class="padding0">
                    <div class="row ">
                      <?php for ($i = 0; $i < 5; $i++) { ?>
                        <div class="col-lg-2 col-md-2 col-sm-2 ">
                          <div class="form-group" style="margin-top: 0px;">
                            <label class="bmd-label-floating"># <?= $i + 1 ?> <small></small></label>
                            <input type="number" class="form-control" id="REG_MOTOR_VMOTOR_OFFSET_BY_MIRROR<?= $i ?>" required="" data-decimals="0" value="<?= $vertMirrorOffset[$i] ?>">
                          </div>
                        </div>
                      <?php } ?>

                    </div>
                  </ul>
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Vertical motor control</h2>
                  <ul class="padding0">
                    <div class="row ">
                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <button id="btnVertMotorContinue" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Run continue">
                          <span class="fa fa-play fa-5x"></span>
                        </button>
                        <button id="btnVertMotorStop" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Stop to position">
                          <span class="fa fa-stop fa-5x"></span>
                        </button>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Stop Position(DAC)<small></small></label>
                          <input type="number" class="form-control" id="REG_MOTOR_VSTOP_MODE" required="" data-decimals="0" step="1" min="1" max="65535" value="<?= $REG_MOTOR_VSTOP_MODE ?>">
                        </div>
                      </div>

                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Tirgger offset<small></small></label>
                          <input type="number" class="form-control" id="REG_MOTOR_VERTICAL_TRIG_OFFSET" required="" data-decimals="0" step="1" min="0" max="65535" value="<?= $REG_MOTOR_VERTICAL_TRIG_OFFSET ?>">
                        </div>
                      </div>

                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">REG_MOTOR_VHMOTOR_WORK_MODE<small></small></label>
                          <input type="number" class="form-control" id="REG_MOTOR_VHMOTOR_WORK_MODE" required="" data-decimals="0" step="1" min="0" max="65535" value="<?= $REG_MOTOR_VHMOTOR_WORK_MODE ?>">
                        </div>
                      </div>

                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">REG_MOTOR_VERTICAL_MIRROR_DEGREE_NUM<small></small></label>
                          <input type="number" class="form-control" id="REG_MOTOR_VERTICAL_MIRROR_DEGREE_NUM" required="" data-decimals="0" step="1" min="0" max="65535" value="<?= $REG_MOTOR_VERTICAL_MIRROR_DEGREE_NUM ?>">
                        </div>
                      </div>

                    </div>
                  </ul>
                </div>
              </div>


            <?php } ?>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 padding0">

            <div class="col-lg-12 col-md-12 col-sm-12 padding5">
              <div class="panel_block padding5">
                <h2 class="">Horizontal mirror offset</h2>
                <ul class="padding0">
                  <div class="row ">
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <div class="col-lg-2 col-md-2 col-sm-2 ">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating"># <?= $i + 1 ?> <small></small></label>
                          <input type="number" class="form-control" id="REG_MOTOR_HMOTOR_OFFSET_BY_MIRROR<?= $i ?>" required="" data-decimals="0" value="<?= $horzMirrorOffset[$i] ?>">
                        </div>
                      </div>
                    <?php } ?>

                  </div>
                </ul>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 padding5">
              <div class="panel_block padding5">
                <h2 class="">Horizontal motor control</h2>
                <ul class="padding0">
                  <div class="row ">

                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                      <div class="form-group" style="margin-top: 0px;">
                        <label class="bmd-label-floating">Horizontal Offset<small></small></label>
                        <input type="number" class="form-control" id="REG_MOTOR_H_OFFSET" required="" data-decimals="0" step="1" min="1" max="480" value="<?= $REG_MOTOR_H_OFFSET ?>">
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                      <div class="form-group" style="margin-top: 0px;">
                        <label class="bmd-label-floating">REG_MOTOR_ALWAYS_OUTPUT_MODE<small></small></label>
                        <input type="number" class="form-control" id="REG_MOTOR_ALWAYS_OUTPUT_MODE" required="" data-decimals="0" step="1" min="1" max="480" value="<?= $REG_MOTOR_ALWAYS_OUTPUT_MODE ?>">
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                      <label class="bmd-label-floating">horzMotorSpeed<small></small></label>
                      <select id="horzMotorSpeed" class="selectpicker col-lg-12" data-live-search="true" data-style="btn-primary select-ext">
                        <?php
                        echo select_option($horzMotorSpeedArr, $horzMotorSpeed);
                        ?>
                      </select>
                    </div>

                  </div>
                </ul>
              </div>
            </div>

          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 padding0">

            <div class="col-lg-12 col-md-12 col-sm-12 padding5">
              <div class="panel_block padding5">
                <h2 class="">Pattern control</h2>
                <ul class="padding0">

                  <div class="row ">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                      <label class="bmd-label-floating">Pattern work mode<small></small></label>
                      <select id="patternWorkMode" class="selectpicker col-lg-12" data-live-search="true" data-style="btn-primary select-ext">
                        <?php
                        echo select_option($patternWorkList, $patternWorkMode);
                        ?>
                      </select>
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

<?php
include(APP . 'v/tools/v_tail.php');
?>

<script>
  $(function() {
    var activeDev = <?= DEVICE_BSP ?>;

    $("#REG_MOTOR_EN_DIS").change(function() {
      var addr = <?= REG_MOTOR_EN_DIS ?>;
      var value = $(this).prop('checked') ? 1 : 0;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#btnVertMotorStop").click(function() {
      var addr = <?= REG_MOTOR_VSTOP_MODE ?>;
      var value = document.getElementById("REG_MOTOR_VSTOP_MODE").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#REG_MOTOR_VSTOP_MODE").change(function() {
      var addr = <?= REG_MOTOR_VSTOP_MODE ?>;
      var value = document.getElementById("REG_MOTOR_VSTOP_MODE").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#REG_MOTOR_VERTICAL_TRIG_OFFSET").change(function() {
      var addr = <?= REG_MOTOR_VERTICAL_TRIG_OFFSET ?>;
      var value = document.getElementById("REG_MOTOR_VERTICAL_TRIG_OFFSET").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#btnVertMotorContinue").click(function() {
      var addr = <?= REG_MOTOR_VCONTIBUE_MODE ?>;
      var value = 0;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#REG_MOTOR_VHMOTOR_WORK_MODE").click(function() {
      var addr = <?= REG_MOTOR_VHMOTOR_WORK_MODE ?>;
      var value = document.getElementById("REG_MOTOR_VHMOTOR_WORK_MODE").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#REG_MOTOR_VERTICAL_MIRROR_DEGREE_NUM").click(function() {
      var addr = <?= REG_MOTOR_VERTICAL_MIRROR_DEGREE_NUM ?>;
      var value = document.getElementById("REG_MOTOR_VERTICAL_MIRROR_DEGREE_NUM").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    <?php for ($i = 0; $i < 5; $i++) { ?>
      $("#REG_MOTOR_VMOTOR_OFFSET_BY_MIRROR<?= $i ?>").click(function() {
        var addr = <?= REG_MOTOR_VMOTOR_OFFSET_BY_MIRROR0 + $i ?>;
        var value = document.getElementById("REG_MOTOR_VMOTOR_OFFSET_BY_MIRROR<?= $i ?>").value;
        var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

        ajaxExec(url);
      });
    <?php } ?>

    //
    $("#btnHorzMotorStop").click(function() {
      var addr = <?= REG_MOTOR_HSTOP_MODE ?>;
      var value = 1;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#btnHorzMotorContinue").click(function() {
      var addr = <?= REG_MOTOR_HCONTIBUE_MODE ?>;
      var value = 1;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#REG_MOTOR_H_OFFSET").click(function() {
      var addr = <?= REG_MOTOR_H_OFFSET ?>;
      var value = document.getElementById("REG_MOTOR_H_OFFSET").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#REG_MOTOR_ALWAYS_OUTPUT_MODE").click(function() {
      var addr = <?= REG_MOTOR_ALWAYS_OUTPUT_MODE ?>;
      var value = document.getElementById("REG_MOTOR_ALWAYS_OUTPUT_MODE").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    <?php for ($i = 0; $i < 5; $i++) { ?>
      $("#REG_MOTOR_HMOTOR_OFFSET_BY_MIRROR<?= $i ?>").click(function() {
        var addr = <?= REG_MOTOR_HMOTOR_OFFSET_BY_MIRROR0 + $i ?>;
        var value = document.getElementById("REG_MOTOR_HMOTOR_OFFSET_BY_MIRROR<?= $i ?>").value;
        var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

        ajaxExec(url);
      });
    <?php } ?>

    //
    $("#patternWorkMode").change(function() {
      var addr = <?= REG_MOTOR_PETTERN_WORK_MODE ?>;
      var text = $(this).val();
      var value = parseInt(text);
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    //
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

  });
</script>