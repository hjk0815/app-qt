<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = SYSTEM_REGS;
        include(APP . 'v/system/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">
          <div class="col-lg-12 col-md-12 col-sm-12 padding0">
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
include(APP . 'v/system/v_tail.php');
?>


<!-- 工具容器 -->
<div class="btn-toolbar" id="localToobar1">
  <ul class="padding0">
    <div class="row ">
      <div class="col-lg-12">
        <div class="btn-group btn-group">
          <button id="btnRefresh" type="button" class="btn btn-primary">
            <span class="fa fa-refresh "></span>Refresh
          </button>
        </div>
        <div class="btn-group btn-group">
          <button id="btnSave" type="button" class="btn btn-primary">
            <span class="fa fa-archive "></span>Save
          </button>
        </div>
        <div class="btn-group btn-group">
          <select name="devId" id="btnDevice" class="selectpicker col-lg-12" data-live-search="true" data-style="btn-primary select-ext">
            <?php
            //print_object($devList);
            echo select_option($devList, $activeDev);
            ?>
          </select>
        </div>
        <div class="btn-group btn-group">
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" id="autoUpdate" value="1">
              <span class="form-check-sign">
                <span class="check"></span>
              </span>
              Auto refresh
            </label>
          </div>
        </div>
      </div>
    </div>

  </ul>
</div>

<script>
  $(function() {
    var activeDev = <?= $activeDev ?>;
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
          url: "<?= AJAX_BASE ?>/regList/&dev=" + activeDev,
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
      icons: {refresh: "glyphicon-repeat", toggle: "glyphicon-list-alt", columns: "glyphicon-list"},
      exportOptions: {
        //ignoreColumn: [0,1],  // 忽略某一列的索引
        fileName: 'regMap('+activeName+')', // 文件名称设置
        worksheetName: 'sheet1', // 表格工作区名称
        tableName: 'regMap('+activeName+')',
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
        visible: false,
      }, {
        field: 'addr',
        title: 'ADDR',
        width: 60,
      }, {
        field: 'addrHex',
        title: 'ADDR(hex)',
        width: 60,
        visible: false,
      }, {
        field: 'name',
        title: 'NAME',
        width: 120,
        sortable: true,
      }, {
        field: 'value',
        title: 'VALUE',
        width: 60,
      }, {
        field: 'hex',
        title: 'HEX',
        width: 60,
        visible: false,
      }, {
        field: 'comment',
        title: 'COMMENT',
        //width: 60,
      }, {
        field: 'time',
        title: '创建时间',
        width: 200,
        visible: false,
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
    $("#btnRefresh").click(function() {
      var url = "<?= AJAX_BASE ?>" + "/regReload/&dev=" + activeDev;

      console.log(url);
      ajaxExec(url);
      updateTable1();
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