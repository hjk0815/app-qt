<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <title> <?= $productName ?> </title>
  <link rel="apple-touch-icon" sizes="76x76" href="r/img/apple-icon.png">
  <link rel="icon" type="image/png" href="r/img/favicon.png">

  <?php
  $userBootstrapOnly = 0;
  ?>

  <!--   core css files   -->
  <link rel="stylesheet" href="r/css/font-awesome.min.css">
  <?php
  if ($userBootstrapOnly) { // bootstrap
  ?>
    <link rel="stylesheet" href="r/css/bootstrap.css" />
    <link rel="stylesheet" href="r/css/bootstrap-theme.css" />
  <?php } else { ?>
    <link rel="stylesheet" href="r/css/material-dashboard.css" />
  <?php } ?>
  <link rel="stylesheet" href="r/css/glyphicon.css">
  <link rel="stylesheet" href="r/css/bootstrap-table.css">
  <link rel="stylesheet" href="r/css/bootstrap-select.css">
  <link rel="stylesheet" href="r/css/toggle.css">
  <link rel="stylesheet" href="r/css/sweetalert2.css">
  <link rel="stylesheet" href="r/css/swiper.css">
  <link rel="stylesheet" href="r/default.css">

  <!--   core js files   -->
  <script src="r/js/jquery-latest.min.js"></script>
  <script src="r/js/jquery.bootstrap-wizard.js"></script>
  <script src="r/js/jquery-jvectormap.js"></script>
  <script src="r/js/jquery.dataTables.min.js"></script>
  <script src="r/js/jquery.validate.min.js"></script>
  <script src="r/js/Popper.js"></script>
  <?php if ($userBootstrapOnly) { // bootstrap 
  ?>
  <?php } ?>
  <script src="r/js/bootstrap.js" type="text/javascript"></script>

  <script src="r/js/core.js"></script>
  <script src="r/js/arrive.min.js"></script>
  <script src="r/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="r/js/bootstrap-treeview.js"></script>
  <script src="r/js/moment.min.js"></script>
  <script src="r/js/jasny-bootstrap.min.js"></script>
  <script src="r/js/fullcalendar.min.js"></script>
  <script src="r/js/nouislider.min.js"></script>
  <script src="r/js/bootstrap-datetimepicker.min.js"></script>
  <script src="r/js/chartist.min.js"></script>
  <script src="r/js/bootstrap-material-design.min.js"></script>
  <script src="r/js/bootstrap-tagsinput.js"></script>
  <script src="r/js/bootstrap-selectpicker.js"></script>
  <script src="r/js/bootstrap-notify.js"></script>
  <script src="r/js/bootstrap-table.js"></script>
  <script src="r/js/bootstrap-table-zh-CN.js"></script>
  <script src="r/js/bootstrap-select.js"></script>

  <script src="r/js/bootstrap-table-export.js"></script>
  <script src="r/js/tableExport.js"></script>
  <!-- 
  <script src="r/js/FileSaver.min.js"></script>
  <script src="r/js/xlsx.core.min.js"></script>  -->

  <script src="r/js/sweetalert2.all.js"></script>
  <script src="r/js/swiper.js"></script>
  <script src="r/js/echarts.min.js"></script>

  <script src="r/utils.js"></script>
</head>

<body class="">
  <div class="wrapper ">
    <div class="main-panel bg-black">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="col-lg-12 col-md-12 col-sm-12">
<?php include(APP . 'v/frame/t_header.php'); ?>
            </div>
          </div>

          <div class="navbar-wrapper">

            <div class="col-lg-12 col-md-12 col-sm-12">
              <ul class="nav nav-tabs" data-tabs="tabs">
                
                <li class="nav-item pull-right">
                  <a class="nav-link  " href="#" data-toggle="modal" data-target="#dialogUserSwitch">
                    <i class="fa fa-user fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="User switch"></i>
                    <div class="ripple-container"></div>
                  </a>
                </li>
                
              </ul>
            </div>

          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      <div class="content ">
        <div class="container-fluid">
          <!-- content enter -->
          <?= $htmlContent ?>
          <!-- content leave -->
        </div>
      </div>

      <footer class="footer">
        <?php include(APP . 'v/frame/t_footer.php'); ?>
      </footer>

      <?php
      // modal dialog
      include(APP . 'v/frame/dlg_user_switch.php');
      ?>
    </div>
  </div>
</body>

</html>