<!-- modal dialog -->
<div class="modal fade" id="dialogUserSwitch" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">Switch user</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="<?= URL_BASE ?>/main/userSwitch" method="POST">
        <div class="modal-body">

          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="bmd-label-floating">User name</label>
                <!-- <input type="text" class="form-control" name="userName" required=""> -->
                <select name="userName" id="btnUserName" class="selectpicker col-lg-12 padding0" 
                      data-live-search="true" data-style="btn-primary select-ext">
                      <option value='user'selected >User</option>
                      <option value='admin' >Administrator</option>
                      <option value='morelite' >Engineer</option>
                    </select>
              </div>
              <div class="form-group">
                <label class="bmd-label-floating">Password</label>
                <input type="password" class="form-control" name="password" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary pull-right" value="Apply">
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  $(function() {

  });
</script>