<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = TOOL_LASERID;
        include(APP . 'v/tools/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-4 col-md-4 col-sm-4 padding0">
            <div class="tab-content">

              <div class="table-box" style="margin: 1px;">
                <table id="localTable1"></table>
              </div>

              <div id="updown">
                <span class="up"></span>
                <br>
                <span class="down"></span>
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
include(APP . 'v/tools/dlg_upload_laserId.php');
?>

<!-- 工具容器 -->
<div class="btn-toolbar" id="localToobar1">
  <ul class="padding0">
    <div class="row ">
          <div class="col-lg-12 col-md-12 col-sm-12 padding0">
            <div class="row ">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <button id="btnPcldReload" type="button" class="btn btn-primary pull-rightxx" style="padding:8px 8px" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload regs">
                  <span class="fa fa-refresh "></span> Refresh
                </button>
                <label class="pull-right" style="font-weight:bold">&nbsp;
                </label>
                <button id="btnImportLaserId" type="button" class="btn btn-primary pull-rightxx" style="padding:8px 8px" data-bs-toggle="tooltip" data-bs-placement="top" title="Import local laserId file" data-toggle="modal" data-target="#dialogUploadLaserId">
                  <span class="fa fa-cloud-upload "></span> Import laserId
                </button>
                <label class="pull-right" style="font-weight:bold">&nbsp;
                </label>
                <button id="btnPcldDownload" type="button" class="btn btn-primary pull-rightxx" style="padding:8px 8px" data-bs-toggle="tooltip" data-bs-placement="top" title="Save configuration to EEPROM">
                  <span class="fa fa-save "></span> Save all
                </button>

              </div>

            </div>
          </div>
    </div>

  </ul>
</div>

<script>
  $(function() {
    var activeDev = <?= $dev ?>;
    var activeName = <?= $activeName ?>;
    var autoUpdate = 0;
    var lastUpdate = 0;
    let $table1 = $('#localTable1');

    //------------------------------------------------------------------
    function updateToolbar1() {
      var selectData = getIdSelections();

      enable = selectData.length > 0;
      if (selectData.length >= 1) {
        //$("#btnDelete").show();
      } else {
        //$("#btnDelete").hide();
      }

    }

    function uploadData(row, value) {
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + row.addr + "&value=" + value + "";
      ajaxExec(url);
    }

    function updateRow(index, field, value) {
      $table1.bootstrapTable('updateCell', {
        index: index, //行索引
        field: field, //列名
        value: value //cell值
      })
    }

    function DoOnMsoNumberFormat(cell, row, col) {
      var result = "";
      if (row > 0 && col == 0)
        result = "\\@";
      return result;
    }

    $table1.bootstrapTable({
      ajax: function(request) { //使用ajax请求
        $.ajax({
          type: "GET",
          url: "<?= AJAX_BASE ?>/laserIdList/&dev=" + activeDev,
          contentType: 'application/json;charset=utf-8',
          dataType: 'json',
          data: request.data,
          success: function(res) {
            autoUpdate = lastUpdate;
            request.success({
              row: res.data,
            });

            $table1.bootstrapTable('load', res.data);
            updateToolbar1();
          },
          error: function(error) {
            autoUpdate = lastUpdate;
            console.log(error);
          }
        })
      },
      toolbar: '#localToobar1',
      classes: "table table-bordered table-striped", // table-striped表示隔行变色
      clickEdit: true,
      showToggle: false,
      pagination: false, // 显示分页条
      showColumns: true,
      showPaginationSwitch: false, // 显示切换分页按钮
      showRefresh: false, // 显示刷新按钮

      search: true,
      searchOnEnterKey: true,
      showExport: true,
      exportDataType: "all",
      exportTypes: ['excel', 'csv'],
      //exportTypes: 'all',
      //Icons:'glyphicon-export',
      //Icons: 'glyphicon-export icon-share',
      icons: {
        refresh: "glyphicon-repeat",
        toggle: "glyphicon-list-alt",
        columns: "glyphicon-list"
      },
      exportOptions: {
        //ignoreColumn: [0,1],  // 忽略某一列的索引
        fileName: 'laserId', // 文件名称设置
        worksheetName: 'sheet1', // 表格工作区名称
        tableName: 'laserId',
        excelstyles: ['background-color', 'color', 'font-size', 'font-weight'],
        onMsoNumberFormat: DoOnMsoNumberFormat
      },

      checkboxHeader: true,
      clickToSelect: true, // 点击row选中radio或CheckBox
      singleSelect: false,
      columns: [{
        checkbox: true,
        width: 20,
      }, {
        field: 'id',
        title: '#',
        width: 40,
      }, {
        field: 'value',
        title: 'VALUE',
        width: 60,
      }], // 列设置
      onLoadSuccess: function(res) { //可不写
      },
      onLoadError: function(statusCode) {
        return "加载失败"
      },

      onClickRow: function onClickRow(item, $element) {
        return false;
      },
      onCheck: function onCheck(row) {
        updateToolbar1();
        return false;
      },
      onUncheck: function onUncheck(row) {
        updateToolbar1();
        return false;
      },
      onCheckAll: function onCheckAll(rows) {
        updateToolbar1();
        return false;
      },
      onUncheckAll: function onUncheckAll(rows) {
        updateToolbar1();
        return false;
      },
      onDblClickRow: function onDblClickRow(item, $element) {
        updateToolbar1();
        return false;
      },
      onDblClickCell: function onDblClickCell(field, value, row, $element) {
        if (field != 'value') return false;

        $element.attr('contenteditable', true);
        $element.attr({
          style: "color:red;font-style: italic;font-weight:bold"
        });
        $element.blur(function() {
          let index = $element.parent().data('index');
          let tdValue = $element.html();
          var textValue = $element.text();

          uploadData(row, textValue);
          updateRow(index, field, tdValue);
        })
      },
      onRefresh: function(params) {
        //alert(JSON.stringify(params));
      },
      formatLoadingMessage: function() {
        //正在加载
        return "请稍候...";
      },
      formatNoMatches: function() {
        //没有匹配的结果
        return '列表为空';
      }

    });
    // 已选择的行id
    function getIdSelections() {
      return $.map($table1.bootstrapTable('getSelections'), function(row) {
        return parseInt(row.id);
      })
    }

    // 更新整表
    function updateTable1() {
      lastUpdate = autoUpdate;
      autoUpdate = 0;
      $table1.bootstrapTable("refresh", {
        silent: true
      }); //静态刷新
    }

    // 工具条
    function reloadRegs() {
      var cmd = <?= PCLD_RELOAD ?>;
      var url = "<?= AJAX_BASE ?>/pcldCmd/&cmd=" + cmd + "";

      ajaxExec(url);
    }

    $("#btnPcldReload").click(function() {
      reloadRegs();
    });

    $("#btnPcldDownload").click(function() {
      var cmd = <?= PCLD_DOWNLOAD_CONFIG ?>;
      var url = "<?= AJAX_BASE ?>/pcldCmd/&cmd=" + cmd + "";

      ajaxExec(url);
    });

    $("#btnSave").click(function() {
      var selectData = getIdSelections();
      var fids = JSON.stringify(selectData);
      var url = "<?= AJAX_BASE ?>" + "/regSave/&dev=" + activeDev;

      ajaxExec(url);
    });

    $("#btnDevice").change(function() {
      //var p1 = $(this).find("option:selected").value();
      var p1 = $(this).val();

      activeDev = parseInt(p1);
      console.log(p1);
      console.log(activeDev);
      var url = "<?= URL_BASE ?>" + "/main/systemRegs/&dev=" + p1;
      window.location.href = url;
    });

    $("#autoUpdate").click(function() {
      var value = $(this).prop('checked') ? 1 : 0;

      autoUpdate = value;
      console.log("autoUpdate changed to:" + autoUpdate);
    });

    $('#updown .up').click(function() {
      $('html,body').animate({
        scrollTop: '0px'
      }, 100);
    });
    $('#updown .down').click(function() {
      $('html,body').animate({
        scrollTop: $(document).height() + 'px'
      }, 100);
    });

    reloadRegs();
    updateTable1();

    setInterval(function() {
      if (autoUpdate) {
        updateTable1();
      }
    }, 1000);

  });
</script>


<script>
  $(function() {});
</script>