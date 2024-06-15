<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = TOOL_NOISE;
        $page = NOISE_LIST;
        include(APP . 'v/tools/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-9 col-md-9 col-sm-9 padding0">
            <div class="panel_block padding5">
              <h2 class="">Base noise list</h2>
              <ul class="padding0">
                <div class="row ">
                  <div class="table-box" style="margin: 1px;">
                    <table id="localTable1"></table>
                  </div>

                  <div id="updown">
                    <span class="up"></span>
                    <br>
                    <span class="down"></span>
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
include(APP . 'v/tools/v_tail.php');
?>

<script>
  $(function() {
    var activeDev = <?= DEVICE_BOTTOM_NOISE ?>;
    var checkedIds = [];
    var autoUpdate = 0;
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

    function uploadData(row, field, value) {
      // console.log(row);
      // console.log(field);
      // console.log(value);
      
      var url = "<?= AJAX_BASE ?>/noiseChange/&id=" + row['id'] + "&col=" + field + "&data=" + value + "";
      console.log(url);
      ajaxExec(url);
    }

    function updateRow(index, field, value) {
      $table1.bootstrapTable('updateCell', {
        index: index, //行索引
        field: field, //列名
        value: value //cell值
      })
    }

    $table1.bootstrapTable({
      ajax: function(request) { //使用ajax请求
        var type = <?= NCE_LIST ?>;
        var url = "<?= AJAX_BASE ?>/noiseData/&type=<?= NCE_LIST ?>";
        $.ajax({
          type: "GET",
          url: url,
          contentType: 'application/json;charset=utf-8',
          dataType: 'json',
          data: request.data,
          success: function(res) {
            request.success({
              row: res.data,
            });

            $table1.bootstrapTable('load', res.data);
            updateToolbar1();
          },
          error: function(error) {
            console.log(error);
          }
        })
      },
      toolbar: '#localToobar1',
      classes: "table table-bordered table-striped", //table-striped表示隔行变色
      clickEdit: true,
      showToggle: false,
      pagination: false, //显示分页条
      showColumns: true,
      showPaginationSwitch: false, //显示切换分页按钮
      showRefresh: false, //显示刷新按钮
      showExport: true,
      exportDataType: "all",
      exportTypes: 'basic',
      //exportTypes: 'all',
      //Icons:'glyphicon-export',
      Icons: 'glyphicon-export icon-share',
      exportOptions: {
        //ignoreColumn: [0,1],  //忽略某一列的索引
        fileName: '寄存器列表', //文件名称设置
        worksheetName: 'sheet1', //表格工作区名称
        tableName: '寄存器列表',
        excelstyles: ['background-color', 'color', 'font-size', 'font-weight'],
        //onMsoNumberFormat: DoOnMsoNumberFormat
      },
      checkboxHeader: true,
      clickToSelect: true, //点击row选中radio或CheckBox
      search: true,
      searchOnEnterKey: true,
      singleSelect: false,
      columns: [{
        checkbox: true,
        width: 20,
      }, {
        field: 'id',
        title: 'id',
        width: 40,
        visible: false,
      }, {
        field: 'index',
        title: '#',
        width: 40,
      }, {
        field: 'ch0',
        title: 'ch0',
      }, {
        field: 'ch1',
        title: 'ch1',
      }, {
        field: 'ch2',
        title: 'ch2',
      }, {
        field: 'ch3',
        title: 'ch3',
      }, {
        field: 'ch4',
        title: 'ch4',
      }, {
        field: 'ch5',
        title: 'ch5',
      }, {
        field: 'ch6',
        title: 'ch6',
      }, {
        field: 'ch7',
        title: 'ch7',
      }], //列设置
      onLoadSuccess: function(res) { //可不写
        var ids = JSON.stringify(checkedIds)
        var sett = {
          field: "id",
          values: checkedIds
        };
        $table1.bootstrapTable("checkBy", {
          field: "id",
          values: checkedIds
        });
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
        if (field == 'id') return false;

        $element.attr('contenteditable', true);
        $element.attr({
          style: "color:red;font-style: italic;font-weight:bold"
        });
        $element.blur(function() {
          let index = $element.parent().data('index');
          let tdValue = $element.html();
          var textValue = $element.text();

          // console.log(index);
          // console.log(tdValue);
          // console.log(textValue);
          uploadData(row, field, textValue);
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
      checkedIds = getIdSelections();
      $table1.bootstrapTable("refresh", {
        silent: true
      }); //静态刷新
    }

    // 工具条
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

    // setInterval(function() {
    //   if (autoUpdate) {
    //     updateTable1();
    //   }
    // }, 1000);

  });
</script>

<script>
  $(function() {
    var activeDev = <?= DEVICE_BOTTOM_NOISE ?>;

  });
</script>