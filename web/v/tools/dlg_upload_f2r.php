<!-- modal dialog -->
<div class="modal fade" id="dialogUploadF2r" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">Upload F2R(*.txt)</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="<?= AJAX_BASE ?>/uploadF2r/&dev=<?= DEVICE_PCLD ?> " method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 padding5">
              <input type="file" accept="aplication/zip" class="btn btn-primary pull-rightxx" name="fileInfo" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary pull-right" value="Import">
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  $(function() {

  });
</script>