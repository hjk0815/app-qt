<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = TOOL_PCLD;
        include(APP . 'v/tools/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-3 col-md-3 col-sm-3 padding0">
            <div class="row ">

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Doppler setting(FMLB)</h2>
                  <ul class="padding0">
                    <div class="row ">

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Doppler factor<small></small></label>
                          <input type="number" class="form-control" id="dopplerFactor" required="" data-decimals="0" step="1" value="<?= $dopplerFactor ?>">
                        </div>
                      </div>

                    </div>

                  </ul>
                </div>

              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">FOV setting</h2>
                  <ul class="padding0">
                    <div class="row ">

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Channel 1<small></small></label>
                          <input type="number" class="form-control" id="fov0" required="" data-decimals="0" step="1e-6" min="-5" max="5" value="<?= $fov0 ?>">
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Channel 2<small></small></label>
                          <input type="number" class="form-control" id="fov1" required="" data-decimals="6" step="1e-6" min="-5" max="5" value="<?= $fov1 ?>">
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Channel 3<small></small></label>
                          <input type="number" class="form-control" id="fov2" required="" data-decimals="6" step="1e-6" min="-5" max="5" value="<?= $fov2 ?>">
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Channel 4<small></small></label>
                          <input type="number" class="form-control" id="fov3" required="" data-decimals="6" step="1e-6" min="-5" max="5" value="<?= $fov3 ?>">
                        </div>
                      </div>

                    </div>

                  </ul>
                </div>

              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Horizontal setting</h2>
                  <ul class="padding0">
                    <div class="row ">

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Left degree<small></small></label>
                          <input type="number" class="form-control" id="horzLeft" required="" data-decimals="0" step="1" min="0" max="1000" value="<?= $horzLeft ?>" readonly>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Right degree<small></small></label>
                          <input type="number" class="form-control" id="horzRight" required="" data-decimals="0" step="1" min="0" max="5000" value="<?= $horzRight ?>" readonly>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Encoder resolution<small></small></label>
                          <input type="number" class="form-control" id="horzRes" required="" value="<?= $horzRes ?>" readonly>
                        </div>
                      </div>


                    </div>

                  </ul>
                </div>

              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Vertical setting</h2>
                  <ul class="padding0">
                    <div class="row ">

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Factory(K)<small></small></label>
                          <input type="number" class="form-control" id="factoryK" required="" data-decimals="0" step="1e-9" min="-1" max="1" value="<?= $factoryK ?>">
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Factory(A)<small></small></label>
                          <input type="number" class="form-control" id="factoryA" required="" data-decimals="0" step="1e-6" min="-1000" max="1000" value="<?= $factoryA ?>">
                        </div>
                      </div>


                    </div>

                  </ul>
                </div>

              </div>

            </div>

          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 padding0">
            <div class="row ">

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Scanning setting</h2>
                  <ul class="padding0">
                    <div class="row ">


                      <div class="col-lg-2">
                        <div class="form-group pull-right" style="margin-top: 7px;">
                          <label class="bmd-label-floating">#<small></small></label>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Real degree<small></small></label>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">DAC(control)<small></small></label>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">F2R<small></small></label>
                        </div>
                      </div>

                      <?php
                      //print_object($f2rMap);
                      for ($i = 0; $i < 16; $i++) {
                        $item = $f2rMap[$i];
                        $degree = "  " . $item['deg'];
                        $dac = $item['dac'];
                        $f2r = $item['f2r'];
                      ?>
                        <div class="col-lg-2">
                          <div class="form-group pull-right" style="margin-top: 7px;">
                            <label class="bmd-label-floating">CH<?= $i + 1 ?><small></small></label>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group" style="margin-top: 0px;">
                            <input type="text" class="form-control" id="degree<?= $i ?>" required="" data-decimals="0" step="1" min="-5000" max="5000" value="<?= $degree ?>" readonly>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group" style="margin-top: 0px;">
                            <input type="number" class="form-control" id="dac<?= $i ?>" required="" data-decimals="0" step="1" min="100" max="1200" value="<?= $dac ?>">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group" style="margin-top: 0px;">
                            <input type="number" class="form-control" id="f2r<?= $i ?>" required="" data-decimals="0" step="1" min="100" max="5000" value="<?= $f2r ?>">
                          </div>
                        </div>

                      <?php } ?>

                    </div>

                  </ul>
                </div>

              </div>

            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-3 padding0">
            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">PCLD control</h2>
                  <ul class="padding0">
                    <div class="row ">
                    </div>
                    <div class="row ">

                      <button id="btnPcldDownload" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Download to device">
                        <span class="fa fa-cloud-download fa-5x"></span>
                      </button>
                      <button id="btnPcldExport" type="button" class="btn btn-primary pull-rightx" data-bs-toggle="tooltip" data-bs-placement="top" title="Save config">
                        <span class="fa fa-save fa-5x"></span>
                      </button>
                    </div>
                  </ul>
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding0">
                  <h2 class="">Format version(FMLB)</h2>
                  <ul class="padding0">
                    <div class="row ">
                    </div>
                    <div class="row ">

                      <div class="col-lg-12 padding5">
                        <div class="form-group" style="margin-top: 0px;">
                          <select id="btnSampleVersion" class="selectpicker padding0 col-lg-12" data-live-search="true" data-style="btn-success select-ext">
                            <?php
                            echo select_option($sampleMap, $sampleVersion);
                            ?>
                          </select>

                        </div>
                      </div>

                    </div>
                  </ul>
                </div>
              </div>


              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding0">
                  <h2 class="">Fake or real control</h2>
                  <ul class="padding0">
                    <div class="row ">
                    </div>
                    <div class="row ">

                      <div class="col-lg-12 padding5">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Fake select<small></small></label>
                          <select id="btnFakeSel" class="selectpicker padding0 col-lg-12" data-live-search="true" data-style="btn-success select-ext">
                            <?php
                            echo select_option($fakeList, $fakeSel);
                            ?>
                          </select>

                        </div>
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

<script>
  $(function() {
    var activeDev = <?= DEVICE_PCLD ?>;
    var firstDownloadDac = 1;
    var firstDownloadF2R = 1;

    $("#btnSampleVersion").change(function() {
      var text = $(this).val();
      var value = parseInt(text);
      var url = "<?= URL_BASE ?>/tools/switchPcldVersion/&value=" + value + "";

      window.location.href = url;
    });

    $("#dopplerFactor").change(function() {
      var addr = <?= REG_DOPPLER_FACTOR ?>;
      var value = document.getElementById("dopplerFactor").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#fov0").change(function() {
      var addr = <?= REG_FOV_CH0 ?>;
      var value = 1e6 * document.getElementById("fov0").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#fov1").change(function() {
      var addr = <?= REG_FOV_CH1 ?>;
      var value = 1e6 * document.getElementById("fov1").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#fov2").change(function() {
      var addr = <?= REG_FOV_CH2 ?>;
      var value = 1e6 * document.getElementById("fov2").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#fov3").change(function() {
      var addr = <?= REG_FOV_CH3 ?>;
      var value = 1e6 * document.getElementById("fov3").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#horzLeft").change(function() {
      var addr = <?= REG_HORZ_LEFT ?>;
      var value = 1000 * document.getElementById("horzLeft").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#horzRight").change(function() {
      var addr = <?= REG_HORZ_RIGHT ?>;
      var value = 1000 * document.getElementById("horzRight").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#horzRes").change(function() {
      var addr = <?= REG_HORZ_RESOLUTION ?>;
      var value = 1000 * document.getElementById("horzRes").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#factoryK").change(function() {
      var addr = <?= REG_VERT_FACTOR_K ?>;
      var value = 1e9 * document.getElementById("factoryK").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#factoryA").change(function() {
      var addr = <?= REG_VERT_FACTOR_A ?>;
      var value = 1e6 * document.getElementById("factoryA").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    $("#btnFakeSel").change(function() {
      var addr = <?= REG_F2R_SELECT ?>;
      var text = document.getElementById("btnFakeSel").value;
      var value = parseInt(text);
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    function updateVertMotorDAC(id) {
      var addr, value, url;
      var id;

      if (firstDownloadDac) {
        firstDownloadDac = 0;
    <?php for ($i = 0; $i < 16; $i++) { ?>
        addr = <?= REG_PATTERN_LUT_V0 + $i ?>;
        value = document.getElementById("dac<?= $i ?>").value;
        url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

        ajaxExec(url, 0);
    <?php } ?>
      }

      addr = parseInt(<?= REG_PATTERN_LUT_V0 ?>) + parseInt(id);
      id = "dac" + id;
      value = document.getElementById(id).value;
      url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";
      ajaxExec(url, 0);
    }

    function updateF2R(id) {
      var addr, value, url;
      var id;

      if (firstDownloadF2R) {
        firstDownloadF2R = 0;
    <?php for ($i = 0; $i < 16; $i++) { ?>
        addr = <?= REG_F2R_LUT_V0 + $i ?>;
        value = document.getElementById("f2r<?= $i ?>").value;
        url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

        ajaxExec(url, 0);
    <?php } ?>
      }

      addr = parseInt(<?= REG_F2R_LUT_V0 ?>) + parseInt(id);
      id = "f2r" + id;
      value = document.getElementById(id).value;
      url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";
      ajaxExec(url, 0);
    }

    <?php for ($i = 0; $i < 16; $i++) { ?>
      $("#dac<?= $i ?>").change(function() {
        updateVertMotorDAC(<?= $i ?>);
      });

      $("#f2r<?= $i ?>").change(function() {
        updateF2R(<?= $i ?>);
      });

    <?php } ?>


    $("#btnPcldDownload").click(function() {
      var cmd = <?= PCLD_DOWNLOAD_CONFIG ?>;
      var url = "<?= AJAX_BASE ?>/pcldCmd/&cmd=" + cmd + "";

      ajaxExec(url);
    });

    $("#btnPcldExport").click(function() {
      var cmd = <?= PCLD_EXPORT_CONFIG ?>;
      var url = "<?= AJAX_BASE ?>/pcldCmd/&cmd=" + cmd + "";

      ajaxExec(url);
    });
  });
</script>