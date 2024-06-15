<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = PROP_CHANNELS;
        include(APP . 'v/prop/v_header.php');
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
include(APP . 'v/prop/v_tail.php');
?>

<!-- 工具容器 -->
<div class="btn-toolbar" id="localToobar1">
  <div class="btn-group btn-group">
    <button id="btnRefresh" type="button" class="btn btn-primary">
      <span class="fa fa-refresh "></span>刷新
    </button>
  </div>
  <div class="btn-group btn-group">
    <button id="btnSave" type="button" class="btn btn-primary">
      <span class="fa fa-archive "></span>保存
    </button>
  </div>
  <div class="btn-group btn-group">
    <select name="szProfile" id="btnDevice" class="selectpicker col-lg-12" data-live-search="true" data-style="btn-primary select-ext">

    </select>
  </div>
</div>


<script>
  $(function() {
    var activeDev = <?= DEVICE_HOST ?>;
    var checkedIds = [];
    var autoUpdate = 1;
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
      var url = "<?= AJAX_BASE ?>/channelEnable/&dev=1&ch=" + row.id + "&value=" + value + "";
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
        $.ajax({
          type: "GET",
          url: "<?= AJAX_BASE ?>/channelList/&dev=1" ,
          contentType: 'application/json;charset=utf-8',
          dataType: 'json',
          data: request.data,
          success: function(res) {
            console.log(res);
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
      checkboxHeader: true,
      clickToSelect: false, //点击row选中radio或CheckBox
      search: true,
      searchOnEnterKey: true,
      singleSelect: false,
      columns: [ {
        field: 'enable',
        title: 'enable',
        width: 20,
        checkbox: true,
      }, {
        field: 'id',
        title: 'CH#',
        width: 40,
      }, {
        field: 'remap',
        title: 'remap',
        width: 40,
      },{
        field: 'azimuth',
        title: 'azimuth',
        width: 120,
      }, {
        field: 'elevation',
        title: 'elevation',
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
      checkedIds = getIdSelections();
      $table1.bootstrapTable("refresh", {
        silent: true
      }); //静态刷新
    }


    // 作业表工具条
    $("#btnRefresh").click(function() {
      updateTable1();
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
        //updateTable1();
      }
    }, 1000);

  });
</script>


<script>
  $(function() {});
</script>