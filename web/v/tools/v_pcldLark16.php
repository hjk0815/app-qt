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

          <div class="col-lg-12 col-md-12 col-sm-12 padding0">
            <div class="row ">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <button id="btnPcldReload" type="button" class="btn btn-primary pull-rightxx" style="padding:8px 8px" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload regs">
                  <span class="fa fa-refresh "></span> Refresh
                </button>
                <label class="pull-right" style="font-weight:bold">&nbsp;
                </label>

                <button id="btnPcldExport" type="button" class="btn btn-primary pull-rightxx" style="padding:8px 8px" data-bs-toggle="tooltip" data-bs-placement="top" title="Export configrutation to file">
                  <span class="fa fa-cloud-download "></span> Export
                </button>
                <label class="pull-right" style="font-weight:bold">&nbsp;
                </label>
                <button id="btnImportPattern" type="button" class="btn btn-primary pull-rightxx" style="padding:8px 8px" data-bs-toggle="tooltip" data-bs-placement="top" title="Import local pattern file" data-toggle="modal" data-target="#dialogUploadPattern">
                  <span class="fa fa-cloud-upload "></span> Import pattern
                </button>
                <button id="btnImportF2R" type="button" class="btn btn-primary pull-rightxx" style="padding:8px 8px" data-bs-toggle="tooltip" data-bs-placement="top" title="Import local F2R file" data-toggle="modal" data-target="#dialogUploadF2r">
                  <span class="fa fa-cloud-upload "></span> Import F2R
                </button>
                <label class="pull-right" style="font-weight:bold">&nbsp;
                </label>
                <button id="btnPcldDownload" type="button" class="btn btn-primary pull-rightxx" style="padding:8px 8px" data-bs-toggle="tooltip" data-bs-placement="top" title="Save configuration to EEPROM">
                  <span class="fa fa-save "></span> Save all
                </button>

              </div>

            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2 padding0">
            <div class="row ">

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Laser beam setting<small>(1.fovsin,2.sqsin,3.fovcos,4.sqcos)</small></h2>
                  <ul class="padding0">
                    <div class="row ">


                      <div class="col-lg-6">
                        <div class="form-group pull-right" style="margin-top: 0px;">
                          <label class="bmd-label-floating">#<small></small></label>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Laser beam angle<small></small></label>
                        </div>
                      </div>

                      <?php
                      //print_object($f2rMap);
                      for ($i = 0; $i < 8; $i++) {
                      ?>
                        <div class="col-lg-6">
                          <div class="form-group pull-right" style="margin-top: 0px;">
                            <label class="bmd-label-floating">CH<?= $i + 1 ?><small></small></label>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group" style="margin-top: 0px;">
                            <input type="number" class="form-control" id="fov<?= $i ?>" required="" data-decimals="6" step="1e-5" min="-8" max="8" value="<?= $fovMap[$i] ?>" readonly>
                          </div>
                        </div>

                      <?php } ?>


                      <div class="col-lg-12 ">
                        <label class="bmd-label-floating ">
                          <input type="checkbox" class="form-check-inputx " id="fovWriteLock" value="1" >
                          Unlock write 
                        </label>
                      </div>

                    </div>

                  </ul>
                </div>

              </div>

            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2 padding0">
            <div class="row ">

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Vert PID setting<small>(7.pid)</small></h2>
                  <ul class="padding0">
                    <div class="row ">


                      <div class="col-lg-6">
                        <div class="form-group pull-right" style="margin-top: 0px;">
                          <label class="bmd-label-floating">#<small></small></label>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Value<small></small></label>
                        </div>
                      </div>

                      <?php
                      //print_object($f2rMap);
                      for ($i = 0; $i < 16; $i++) {
                        $title = $pidColName[$i];
                      ?>
                        <div class="col-lg-6">
                          <div class="form-group pull-right" style="margin-top: 0px;">
                            <label class="bmd-label-floating"><?= $title ?><small></small></label>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group" style="margin-top: 0px;">
                            <input type="number" class="form-control" id="pid<?= $i ?>" required="" data-decimals="0" step="1" min="0" max="4096" value="<?= $pidMap[$i] ?>" readonly>
                          </div>
                        </div>

                      <?php } ?>

                      <div class="col-lg-12 ">
                        <label class="bmd-label-floating ">
                          <input type="checkbox" class="form-check-inputx " id="pidLock" value="1" >
                          Unlock write 
                        </label>
                      </div>

                    </div>

                  </ul>
                </div>

              </div>

            </div>
          </div>

          <div class="col-lg-5 col-md-5 col-sm-5 padding0">
            <div class="row ">

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Pattern setting<small>(5.f2r,6.pattern)</small></h2>
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
                          <label class="bmd-label-floating">Pattern ctrl code<small>(6.pattern)</small></label>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Expected angle code<small>(5.f2r)</small></label>
                        </div>
                      </div>

                      <?php
                      //print_object($f2rMap);
                      for ($i = 0; $i < 32; $i++) {
                        $item = $f2rMap[$i];
                        $degree = "  " . $item['deg'];
                        $dac = $item['dac'];
                        $f2r = $item['f2r'];
                      ?>
                        <div class="col-lg-2">
                          <div class="form-group pull-right" style="margin-top: 7px;">
                            <label class="bmd-label-floating">Angle<?= $i + 1 ?><small></small></label>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group" style="margin-top: 0px;">
                            <input type="text" class="form-control" id="degree<?= $i ?>" required="" data-decimals="0" step="1" min="-5000" max="5000" value="<?= $degree ?>" readonly>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group" style="margin-top: 0px;">
                            <input type="number" class="form-control" id="dac<?= $i ?>" required="" data-decimals="0" step="1" min="0" max="65535" value="<?= $dac ?>" readonly>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group" style="margin-top: 0px;">
                            <input type="number" class="form-control" id="f2r<?= $i ?>" required="" data-decimals="0" step="1" min="0" max="65535" value="<?= $f2r ?>" readonly>
                          </div>
                        </div>

                      <?php } ?>

                      <div class="col-lg-12 ">
                        <label class="bmd-label-floating ">
                          <input type="checkbox" class="form-check-inputx " id="patternLock" value="1" >
                          Unlock write 
                        </label>
                      </div>

                    </div>

                  </ul>
                </div>

              </div>

            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-3 padding0">
            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding0">
                  <h2 class="">Format version(Lark16)</h2>
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
                  <h2 class="">Expected or real pattern control</h2>
                  <ul class="padding0">
                    <div class="row ">
                    </div>
                    <div class="row ">

                      <div class="col-lg-12 padding5">
                        <div class="form-group" style="margin-top: 0px;">
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

              <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                <div class="panel_block padding5">
                  <h2 class="">Doppler setting(LARK16)</h2>
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
                  <h2 class="">Horizontal setting<small>(9.hsin,10.hcos)</small></h2>
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
                  <h2 class="">Vertical formula<small>(11.vsin,12.vcos)</small></h2>
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
        </div>


      </div>

    </div>
  </div>
</div>

<?php
include(APP . 'v/tools/v_tail.php');
?>

<?php
include(APP . 'v/tools/dlg_upload_pattern.php');
include(APP . 'v/tools/dlg_upload_f2r.php');
?>

<script>
  $(function() {
    var activeDev = <?= DEVICE_PCLD ?>;
    var factoryK = <?= $factoryK ?>;
    var factoryA = <?= $factoryA ?>;

    $("#btnSampleVersion").change(function() {
      var text = $(this).val();
      var value = parseInt(text);
      var url = "<?= URL_BASE ?>/tools/switchPcldVersion/&value=" + value + "";

      window.location.href = url;
    });

    function updateRealDegree() {
      var value = 0;
      var degree = 0;

      <?php for ($i = 0; $i < 32; $i++) {
        $key = "f2r$i";
        $degree = "degree$i";
      ?>
        value = document.getElementById("<?= $key ?>").value;
        degree = factoryK * value + factoryA;
        document.getElementById("<?= $degree ?>").value = degree.toFixed(6);
      <?php } ?>
    }

    $("#dopplerFactor").change(function() {
      var addr = <?= REG_DOPPLER_FACTOR ?>;
      var value = document.getElementById("dopplerFactor").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

    <?php for ($i = 0; $i < 8; $i++) {
      $key = "fov$i";
    ?>
      $("#<?= $key ?>").change(function() {
        var addr = <?= REG_FOV_CH0 + $i ?>;
        var value = 1e6 * document.getElementById("<?= $key ?>").value;
        var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

        ajaxExec(url);
      });
    <?php } ?>

    $("#fovWriteLock").click(function() {
      var value = $(this).prop('checked') ? 0 : 1;
        
      <?php for ($i = 0; $i < 8; $i++) {
        $key = "fov$i";
      ?>
      document.getElementById('<?= $key ?>').readOnly = value;
      <?php } ?>

    });

    <?php for ($i = 0; $i < 16; $i++) {
      $key = "pid$i";
    ?>
      $("#<?= $key ?>").change(function() {
        var addr = <?= REG_PID_LUT_V0 + $i ?>;
        var value = document.getElementById("<?= $key ?>").value;
        var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

        ajaxExec(url);
      });
    <?php } ?>

    $("#pidLock").click(function() {
      var value = $(this).prop('checked') ? 0 : 1;
        
      <?php for ($i = 0; $i < 16; $i++) {
        $key = "pid$i";
      ?>
      document.getElementById('<?= $key ?>').readOnly = value;
      <?php } ?>

    });

    <?php for ($i = 0; $i < 32; $i++) {
      $key = "dac$i";
    ?>
      $("#<?= $key ?>").change(function() {
        var addr = <?= REG_PATTERN_LUT_V0 + $i ?>;
        var value = document.getElementById("<?= $key ?>").value;
        var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

        ajaxExec(url);
      });
    <?php } ?>

    <?php for ($i = 0; $i < 32; $i++) {
      $key = "f2r$i";
    ?>
      $("#<?= $key ?>").change(function() {
        var addr = <?= REG_F2R_LUT_V0 + $i ?>;
        var value = document.getElementById("<?= $key ?>").value;
        var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

        updateRealDegree();
        ajaxExec(url);
      });
    <?php } ?>

    $("#patternLock").click(function() {
      var value = $(this).prop('checked') ? 0 : 1;
        
      <?php for ($i = 0; $i < 32; $i++) {
        $key = "dac$i";
      ?>
      document.getElementById('<?= $key ?>').readOnly = value;
      <?php } ?>

      <?php for ($i = 0; $i < 32; $i++) {
        $key = "f2r$i";
      ?>
      document.getElementById('<?= $key ?>').readOnly = value;
      <?php } ?>
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

      factoryK = 1e-9 * value;
      updateRealDegree();

      ajaxExec(url);
    });

    $("#factoryA").change(function() {
      var addr = <?= REG_VERT_FACTOR_A ?>;
      var value = 1e6 * document.getElementById("factoryA").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      factoryA = 1e-6 * value;
      updateRealDegree();

      ajaxExec(url);
    });

    $("#btnFakeSel").change(function() {
      var addr = <?= REG_F2R_SELECT ?>;
      var text = document.getElementById("btnFakeSel").value;
      var value = parseInt(text);
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";

      ajaxExec(url);
    });

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

    function reloadRegs() {
      var cmd = <?= PCLD_RELOAD ?>;
      var url = "<?= AJAX_BASE ?>/pcldCmd/&cmd=" + cmd + "";

      ajaxExec(url);
    }

    $("#btnPcldReload").click(function() {
      reloadRegs();
    });

    reloadRegs();
    updateRealDegree();

  });
</script>