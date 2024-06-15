<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = TOOL_SLIDER;
        include(APP . 'v/tools/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-9 col-md-9 col-sm-9 padding5">
            <div class="panel_block padding5">
              <h2 class="">Motion setting</h2>
              <ul class="padding0">
                <div class="row ">

                  <div class="col-lg-2">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">Velocity<small>(mm/s)</small></label>
                      <input type="number" class="form-control" id="targetSpeed" required="" data-decimals="0" step="100" min="100" max="1500" value="<?= $REG_TARGET_SPEED ?>">
                    </div>
                  </div>

                  <div class="col-lg-2">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">Acceleration<small>(mm/s2)</small></label>
                      <input type="number" class="form-control" id="targetAcce" required="" data-decimals="0" step="1000" min="5000" max="20000" value="<?= $REG_MOTION_ACCE ?>">
                    </div>
                  </div>

                  <div class="col-lg-2">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">Deceleration<small>(mm/s2)</small></label>
                      <input type="number" class="form-control" id="targetDece" required="" data-decimals="0" step="1000" min="5000" max="20000" value="<?= $REG_MOTION_DECE ?>">
                    </div>
                  </div>

                </div>

              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-3 padding5">
            <div class="panel_block padding5">
              <h2 class="">Slider control</h2>
              <ul class="padding0">
                <div class="row ">
                  <div class="col-lg-12">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">Absolute position<small>(mm)</small></label>
                      <input type="number" class="form-control" id="targetPos" required="" data-decimals="0" step="100" min="100" max="2800" value="<?= $REG_TARGET_POS ?>">
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">Cycle number<small></small></label>
                      <input type="number" class="form-control" id="targetCycle" required="" data-decimals="0" step="1" min="0" max="10000" value="<?= $REG_TARGET_CYCLE ?>">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">Moving mode <small style="color:red"></small></label>
                      <select name="moveMode" id="btnMoveMode" class="selectpicker padding0 col-lg-12" data-live-search="true" data-style="btn-success select-ext">
                        <?php
                        echo select_option($bidList, $REG_BID_MOTION);
                        ?>
                      </select>

                    </div>
                  </div>

                </div>
                <hr>
                <div class="row ">
                </div>
                <div class="row ">

                  <div class="col-lg-4">
                    <button id="btnRun" type="button" class="btn btn-success pull-right" data-bs-toggle="tooltip" data-bs-placement="top" title="Start moving">
                      <span class="fa fa-play fa-5x"></span>
                    </button>
                  </div>
                  <div class="col-lg-4">
                    <button id="btnStop" type="button" class="btn btn-primary pull-right" data-bs-toggle="tooltip" data-bs-placement="top" title="Stop moving">
                      <span class="fa fa-stop fa-5x"></span>
                    </button>
                  </div>
                  <div class="col-lg-4">
                    <button id="btnHome" type="button" class="btn btn-primary pull-right" data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Home">
                      <span class="fa fa-refresh fa-5x"></span>
                    </button>
                  </div>

                  <div class="col-lg-12">
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

<script>
  $(function() {
    var activeDev = <?= DEVICE_DELTA ?>;

    $("#targetPos").change(function() {
      var addr = <?= REG_TARGET_POS ?>;
      var value = document.getElementById("targetPos").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#targetCycle").change(function() {
      var addr = <?= REG_TARGET_CYCLE ?>;
      var value = document.getElementById("targetCycle").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#targetSpeed").change(function() {
      var addr = <?= REG_TARGET_SPEED ?>;
      var value = document.getElementById("targetSpeed").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#targetAcce").change(function() {
      var addr = <?= REG_MOTION_ACCE ?>;
      var value = document.getElementById("targetAcce").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#targetDece").change(function() {
      var addr = <?= REG_MOTION_DECE ?>;
      var value = document.getElementById("targetDece").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#btnMoveMode").change(function() {
      var addr = <?= REG_BID_MOTION ?>;
      var p1 = $(this).val();
      var text = document.getElementById("btnMoveMode").value;
      var value = parseInt(text);
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#btnRun").click(function() {
      var addr = <?= REG_BASE_CTRL ?>;
      var value = 0x1 << 2; // 计数器
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";
      //ajaxExec(url);

      value = 0x1 << 2;
      url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";
      ajaxExec(url);
    });

    $("#btnStop").click(function() {
      var addr = <?= REG_BASE_CTRL ?>;
      var value = 0x1 << 1;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#btnHome").click(function() {
      var addr = <?= REG_BASE_CTRL ?>;
      var value = 0x1 << 0;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

  });
</script>


