<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = TOOL_ALGORITHM;
        include(APP . 'v/tools/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-3 col-md-3 col-sm-12 padding0">

            <div class="col-lg-12 col-md-12 col-sm-12 padding5">
              <div class="panel_block padding5">
                <h2 class="">ALGORITHM</h2>
                <ul class="padding0">

                  <div class="row ">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                      <div class="form-group" style="margin-top: 0px;">
                        <label class="bmd-label-floating">STCFAR_THR<small></small></label>
                        <input type="number" class="form-control" id="REG_STCFAR_THR" required="" data-decimals="0" step="1" min="8" max="40" value="<?= $REG_STCFAR_THR ?>">
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

<?php
include(APP . 'v/tools/v_tail.php');
?>

<script>
  $(function() {
    var activeDev = <?= DEVICE_BSP ?>;

    $("#REG_STCFAR_THR").change(function() {
      var addr = <?= REG_STCFAR_THR ?>;
      var value = document.getElementById("REG_STCFAR_THR").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value + "";
    //   console.log("JKJK",url);
      ajaxExec(url);
    });

  });
</script>