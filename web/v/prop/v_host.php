<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = PROP_HOST;
        include(APP . 'v/prop/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-9 col-md-9 col-sm-12 padding0">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Host runtime parameters</h2>
                  <ul class="padding0">
                    <div class="row ">
                      <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Angle compensation<small></small></label>
                          <input type="number" class="form-control" id="REG_LIDAR_PARAM1" required="" data-decimals="0" min="-32768" max="32767" step="1" value="<?= $REG_LIDAR_PARAM1 ?>">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Start bin<small></small></label>
                          <input type="number" class="form-control" id="REG_LIDAR_PARAM2" required="" data-decimals="0" min="-32768" max="32767" step="1" value="<?= $REG_LIDAR_PARAM2 ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row ">
                      <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Velocity threshold<small></small></label>
                          <input type="number" class="form-control" id="REG_LIDAR_VELOCITY_MAX" required="" data-decimals="0" min="-32768" max="32767" step="1" value="<?= $REG_LIDAR_VELOCITY_MAX ?>">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Distance threshold<small></small></label>
                          <input type="number" class="form-control" id="REG_LIDAR_DISTANCE_MAX" required="" data-decimals="0" min="-32768" max="32767" step="1" value="<?= $REG_LIDAR_DISTANCE_MAX ?>">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">SNR threshold<small></small></label>
                          <input type="number" class="form-control" id="REG_LIDAR_SNR_MIN" required="" data-decimals="0" min="-32768" max="32767" step="1" value="<?= $REG_LIDAR_SNR_MIN ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row ">
                      <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">EucMulLays<small></small></label>
                          <input type="number" class="form-control" id="REG_LIDAR_PARAM_ENC_MUL_LAYS" required="" data-decimals="0" min="-32768" max="32767" step="1" value="<?= $REG_LIDAR_PARAM_ENC_MUL_LAYS ?>">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Dis off<small></small></label>
                          <input type="number" class="form-control" id="REG_LIDAR_DIS_OFF" required="" data-decimals="0" min="-32768" max="32767" step="1" value="<?= $REG_LIDAR_DIS_OFF ?>">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">ms flag<small></small></label>
                          <input type="number" class="form-control" id="REG_LIDAR_MSFLAG" required="" data-decimals="0" min="-32768" max="32767" step="1" value="<?= $REG_LIDAR_MSFLAG ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row ">
                    </div>

                  </ul>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Render field</h2>
                  <ul class="padding0">
                    <div class="row ">
                      <div class="col-lg-3">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Velocity range<small></small></label>
                          <input type="number" class="form-control" id="REG_VELOCITY_RENDER_RANGE" required="" data-decimals="0" min="1" max="60" step="1" value="<?= $REG_VELOCITY_RENDER_RANGE ?>">
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Velocity step<small></small></label>
                          <input type="number" class="form-control" id="REG_VELOCITY_RENDER_STEP" required="" data-decimals="0" min="0.1" max="10" step="0.1" value="<?= $REG_VELOCITY_RENDER_STEP ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row ">
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
                  <h2 class="">Host configuration</h2>
                  <ul class="padding0">
                    <div class="row ">
                      <div class="col-lg-12">
                        <button id="btnSave" type="button" class="btn btn-primary pull-rightxx">
                          <span class="fa fa-archive "></span>Save
                        </button>
                        <label class="pull-right align-middle">*Archive to disk</label>
                      </div>
                    </div>
                    <!-- 
                    <hr>
                    <div class="row ">
                      <div class="col-lg-12">
                        <button id="btnReload" type="button" class="btn btn-primary pull-rightxx">
                          <span class="fa fa-gavel "></span>Load
                        </button>
                        <label class="pull-right align-middle">*Reload setting from disk</label>
                      </div>
                    </div> -->

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

<script>
  $(function() {
    var activeDev = <?= DEVICE_HOST ?>;

    $("#REG_LIDAR_PARAM1").change(function() {
      var addr = <?= REG_LIDAR_PARAM1 ?>;
      var value = document.getElementById("REG_LIDAR_PARAM1").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_LIDAR_PARAM2").change(function() {
      var addr = <?= REG_LIDAR_PARAM2 ?>;
      var value = document.getElementById("REG_LIDAR_PARAM2").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_LIDAR_VELOCITY_MAX").change(function() {
      var addr = <?= REG_LIDAR_VELOCITY_MAX ?>;
      var value = document.getElementById("REG_LIDAR_VELOCITY_MAX").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_LIDAR_DISTANCE_MAX").change(function() {
      var addr = <?= REG_LIDAR_DISTANCE_MAX ?>;
      var value = document.getElementById("REG_LIDAR_DISTANCE_MAX").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_LIDAR_SNR_MIN").change(function() {
      var addr = <?= REG_LIDAR_SNR_MIN ?>;
      var value = document.getElementById("REG_LIDAR_SNR_MIN").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_LIDAR_PARAM_ENC_MUL_LAYS").change(function() {
      var addr = <?= REG_LIDAR_PARAM_ENC_MUL_LAYS ?>;
      var value = document.getElementById("REG_LIDAR_PARAM_ENC_MUL_LAYS").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_LIDAR_DIS_OFF").change(function() {
      var addr = <?= REG_LIDAR_DIS_OFF ?>;
      var value = document.getElementById("REG_LIDAR_DIS_OFF").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_LIDAR_MSFLAG").change(function() {
      var addr = <?= REG_LIDAR_MSFLAG ?>;
      var value = document.getElementById("REG_LIDAR_MSFLAG").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#REG_VELOCITY_RENDER_RANGE").change(function() {
      var addr = <?= REG_VELOCITY_RENDER_RANGE ?>;
      var value = document.getElementById("REG_VELOCITY_RENDER_RANGE").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#REG_VELOCITY_RENDER_STEP").change(function() {
      var addr = <?= REG_VELOCITY_RENDER_STEP ?>;
      var value = 10 * document.getElementById("REG_VELOCITY_RENDER_STEP").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#btnSave").click(function() {
      var url = "<?= AJAX_BASE ?>/regSave/&dev=" + activeDev + "";

      ajaxExec(url);
      //window.location.href = url;
    });

    $("#btnReload").click(function() {
      //var value = 1;
      //var url = "<?= AJAX_BASE ?>/regSave/&dev=" + activeDev "";

      //ajaxExec(url);
      //window.location.href = url;
    });

  });
</script>