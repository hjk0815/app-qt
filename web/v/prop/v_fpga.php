<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = PROP_FPGA;
        include(APP . 'v/prop/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-6 col-md-6 col-sm-12 padding5">
            <div class="panel_block padding5">
              <h2 class="">Bypass read/write</h2>
                <ul class="padding0">
                  <div class="row ">
                    <div class="col-lg-4">
                      <div class="form-group" style="margin-top: 0px;">
                        <label class="bmd-label-floating">Read address<small>(Hexadecimal)</small></label>
                        <input type="text" class="form-control" id="readFpgaAddr" required="" 
                        data-decimals="0" step="4" value="<?= dechex($addr) ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group" style="margin-top: 0px;">
                        <label class="bmd-label-floating">value<small></small></label>
                        <input type="text" class="form-control" id="readFpgaValue" readonly 
                        value="<?= $value."(0x".dechex($value).")" ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <button id="btnRead" type="button" class="btn btn-primary pull-right">
                        <span class="fa fa-gavel "></span>Exec
                      </button>
                    </div>
                  </div>

                  <hr>
                  <div class="row ">
                  </div>
                  <div class="row ">
                    <div class="col-lg-4">
                      <div class="form-group" style="margin-top: 0px;">
                        <label class="bmd-label-floating">Write address<small>(Hexadecimal)</small></label>
                        <input type="text" class="form-control" id="writeFpgaAddr" required="" 
                        data-decimals="0" step="4" value="<?= dechex($addr) ?>">
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group" style="margin-top: 0px;">
                        <label class="bmd-label-floating">value<small>(Hexadecimal)</small></label>
                        <input type="text" class="form-control" id="writeFpgaValue" required="" 
                        data-decimals="0" step="1" value="<?= dechex($value) ?>">
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <button id="btnWrite" type="button" class="btn btn-primary pull-right">
                        <span class="fa fa-gavel "></span>Exec
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
include(APP . 'v/prop/v_tail.php');
?>

<script>
  $(function() {
    var activeDev = <?= DEVICE_FPGA ?>;

    // ajax exec
    function ajaxLocal(link) {
      $.ajax({
        type: "GET",
        url: link,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        timeout: 5000,
        success: function(data) {
          console.log(data);
          if (data.code == 0) {
            if (data.desc == "regGet") {
              var dec = parseInt(data.value, 10);
              var hex = dec.toString(16);
              var text = dec + "(0x" + hex + ")";
              console.log(text);
              document.getElementById("readFpgaValue").value = text;
            } else if (data.desc == "regSet") {
              //document.getElementById("readFpgaValue").value = data.value;
            }
            showNotification('top', 'center', 'success', "Command exec success<br>" + data.desc);
          } else {
            console.log(data);
            document.getElementById("readFpgaValue").value = "INV.";
            showNotification('top', 'center', 'warning', "Command exec failure<br>" + data.desc);
          }
        },
        error: function(error) {
          console.log(error);
          showNotification('top', 'center', 'warning', "Command exec error" + error);
        }
      });
    }

    $("#btnRead").click(function() {
      var addr = parseInt(document.getElementById("readFpgaAddr").value, 16);
      var url = "<?= AJAX_BASE ?>/regGet/&dev=" + activeDev + "&addr=" + addr;

      console.log(url);
      ajaxLocal(url);
      //window.location.href = url;
    });

    $("#btnWrite").click(function() {
      var addr = parseInt(document.getElementById("writeFpgaAddr").value, 16);
      var value = document.getElementById("writeFpgaValue").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value;

      console.log(url);
      ajaxLocal(url);
      //window.location.href = url;
    });

  });
</script>