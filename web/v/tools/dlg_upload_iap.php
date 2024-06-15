<!-- modal dialog -->
<div class="modal fade" id="dialogUploadIap" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">Program flash memory (*.bin)</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="<?= AJAX_BASE ?>/uploadIap " method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 padding5">
                        <div class="form-group" style="margin-top: 0px;">
                          <label class="bmd-label-floating">Target device<small></small></label>
                          <select name="iapDev" id="iapDev" class="selectpicker padding0 col-lg-12" data-live-search="true" data-style="btn-success select-ext">
                            <?php
                            echo select_option($iapList, $iapDev);
                            ?>
                          </select>

                        </div>
                      </div>
            <div class="col-lg-12 col-md-12 col-sm-12 padding5">
              <input type="file" accept="aplication/zip" id="btnIapFile" class="btn btn-primary pull-rightxx" name="fileInfo" required />
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary pull-right" value="Start">
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  $(function() {


    $("#btnIapFile").change(function() {
      const file = $(this).prop('files')[0];

      console.log(file);
      if (file) {
        const fileName = file.name;
        const fileType = fileName.slice(fileName.lastIndexOf('.') + 1);

        console.log(fileName);
        console.log(fileType);
        if (fileType.toLowerCase() !== 'bin') {
          Swal.fire({
            title: 'IAP programing',
            text: "Invalid file type '*." + fileType + "', please select '*.bin' ",
            icon: 'warning', // 指定对话框图标，可以是 success, error, warning, info 等
            confirmButtonText: 'OK'
          });
        }

      }

    });

  });
</script>