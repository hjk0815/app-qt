<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = PROP_DEBUG;
        include(APP . 'v/prop/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-6 col-md-6 col-sm-12 padding5">
            <div class="panel_block padding5">
              <h2 class="">Register debug</h2>
              <ul class="padding0">
                <div class="row ">
                  <div class="col-lg-4 padding0">
                    <select name="devId" id="btnDevice" class="selectpicker col-lg-12" data-live-search="true" data-style="btn-primary select-ext">
                      <?php
                      //print_object($devList);
                      echo select_option($devList, $activeDev);
                      ?>
                    </select>
                  </div>
                </div>
                <hr>
                <div class="row ">
                  <div class="col-lg-4">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">Read address<small>(Decimal)</small></label>
                      <input type="number" class="form-control" id="readAddr" required="" data-decimals="0" step="1" min="0" max="511" value="<?= 0 ?>">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">value<small></small></label>
                      <input type="text" class="form-control" id="readValue" readonly value="<?= 0 ?>">
                    </div>
                  </div>
                  <div class="col-lg-5">
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
                      <label class="bmd-label-floating">Write address<small>(Decimal)</small></label>
                      <input type="number" class="form-control" id="writeAddr" required="" data-decimals="0" step="1" min="0" max="511" value="<?= 0 ?>">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group" style="margin-top: 0px;">
                      <label class="bmd-label-floating">value<small>(Decimal)</small></label>
                      <input type="number" class="form-control" id="writeValue" required="" data-decimals="0" step="1" min="0" max="65536" value="<?= 0 ?>">
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
    var activeDev = <?= $activeDev ?>;

    // ajax exec
    function ajaxLocal(link) {
      $.ajax({
        type: "GET",
        url: link,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        timeout: 5000,
        success: function(data) {
          //console.log(data);
          if (data.code == 0) {
            if (data.desc == "regGet") {
              var dec = parseInt(data.value, 10);
              var hex = dec.toString(16);
              var text = dec + "(0x" + hex + ")";
              var text = data.value + "(0x" + hex + ")";
              console.log(text);
              document.getElementById("readValue").value = text;
            } else if (data.desc == "regSet") {
              //document.getElementById("readValue").value = data.value;
            }
            showNotification('top', 'center', 'success', "Command exec success<br>" + data.desc);
          } else {
            console.log(data);
            showNotification('top', 'center', 'warning', "Command exec failure<br>" + data.desc);
          }
        },
        error: function(error) {
          console.log(error);
          showNotification('top', 'center', 'warning', "Command exec error" + error);
        }
      });
    }


    $("#btnDevice").change(function() {
      //var p1 = $(this).find("option:selected").value();
      var p1 = $(this).val();

      activeDev = parseInt(p1);
      console.log(p1);
      console.log(activeDev);
    });

    $("#btnRead").click(function() {
      var addr = parseInt(document.getElementById("readAddr").value, 10);
      var url = "<?= AJAX_BASE ?>/regGet/&dev=" + activeDev + "&addr=" + addr;

      console.log(url);
      ajaxLocal(url);
      //window.location.href = url;
    });

    $("#btnWrite").click(function() {
      var addr = parseInt(document.getElementById("writeAddr").value, 10);
      var value = document.getElementById("writeValue").value;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + value;

      console.log(url);
      ajaxLocal(url);
      //window.location.href = url;
    });

  });
</script>