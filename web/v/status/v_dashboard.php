<div class="row">
  <div class="col-lg-8 col-md-8 col-sm-12 padding0">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-chart">
          <div class="card-header card-header-success">
            <span class="fa fa-window-restore icon-2x"></span>Temperature
          </div>
          <div class="card-body">
            <div class="row ">
              <div class="col-lg-12 col-md-12 col-sm-12 padding0">

                <div class="panel_block padding0">
                  <ul class="padding0">
                    <div class="row padding0">
                      <div class="col-lg-12 padding0">
                        <div class="row padding0">
                          <div id="echartId1" style="width:100%;height:400px;"></div>
                        </div>
                      </div>
                    </div>
                  </ul>
                </div>
              </div>
            </div>

            <div class="row ">
              <div class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">access_time</i> updated 4 minutes ago
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12 padding0">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="material-icons">content_copy</i>
          </div>
          <p class="card-category">Used Space</p>
          <h3 class="card-title">49/50
            <small>GB</small>
          </h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons text-danger">warning</i>
            <a href="#pablo">Get More Space...</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card card-stats">
        <div class="card-header card-header-success card-header-icon">
          <div class="card-icon">
            <i class="material-icons">store</i>
          </div>
          <p class="card-category">Revenue</p>
          <h3 class="card-title">$34,245</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">date_range</i> Last 24 Hours
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
</div>


<script type="text/javascript">
  var myChart1 = echarts.init(document.getElementById('echartId1'));

  var option1 = {
    legend: {
      data: ['Temperature']
    },
    tooltip: {},
    grid: {
      containLabel: true
    },
    xAxis: {
      data: []
    },
    yAxis: {},
    series: [{
      name: 'Temperature',
      type: 'line',
      data: []
    }]
  };

  myChart1.setOption(option1);

  // https://www.cnblogs.com/agansj/p/10837350.html
  myChart1.showLoading(); //数据加载完之前先显示一段简单的loading动画

  var ticks = []; //类别数组（实际用来盛放X轴坐标值）
  var values = []; //销量数组（实际用来盛放Y坐标值）

  $.ajax({
    type: "GET",
    // http://localhost:8080/chartData/&dev=1&type=1
    url: "<?= AJAX_BASE ?>/chartData/&dev=1&type=1",
    //contentType: 'application/json;charset=utf-8',
    dataType: "json", //返回数据形式为json
    data: {},
    //async: true,
    success: function(res) {
      if (res) {
        console.log(res);
        count = res.count;
        rows = res.rows;
        for (var i = 0; i < count; i++) {
          ticks.push(rows[i].tick); //挨个取出类别并填入类别数组
          values.push(rows[i].value); //挨个取出销量并填入销量数组
        }
        myChart1.hideLoading(); //隐藏加载动画
        myChart1.setOption({ //加载数据图表
          xAxis: {
            data: ticks
          },
          series: [{
            // 根据名字对应到相应的系列
            name: '销量',
            data: values
          }]
        });

      }

    },
    error: function(errorMsg) {
      //请求失败时执行该函数
      alert("图表请求数据失败!");
      myChart1.hideLoading();
    }
  })
</script>


<script>
  $(function() {

  });
</script>