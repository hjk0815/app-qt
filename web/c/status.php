<?php

/** $Id: status.php 2556 2023-11-17 06:09:40Z zhangxh $ */

define('HRZ_MOTO_READY',        0);
define('HRZ_SPEED_READY',       1);
define('MOTO_SCAN_DIS',         2);
define('HRZ_MOTO_STOP',         3);
define('AEDR_A_ZERO',           4);
define('AEDR_B_ZERO',           5);
define('AEDR_I_ZERO',           6);
define('AEDR_I_OVER',           7);
define('AEDR_I_MUCH',           8);
define('AEDR_I_GAP_OVER',       9);
define('VRL_DEG_ZERO',          10);
define('VRL_MOTO_STOP',         11);
define('VRL_VPP_OVER',          12);
define('HRZ_SPEED_ERROR',       13);
define('RASTER_OVER',           14);

require(APP . 'c/main.php');
class status extends main
{
  function __construct()
  {
    parent::__construct();
    $this->check();
  }

  function jumpLastPage()
  {
    $session = load('m/session_m');

    $page = $session->getKey("status.active", STATUS_MAIN);
    switch ($page) {
    case STATUS_TEMPERATURE:
      $this->temp();
      break;
      
    case STATUS_NETWORK:
      $this->network();
      break;

    case STATUS_VOLTAGE:
      $this->voltage();
      break;
      
    case STATUS_MAIN:
    default:
      $this->main();
      break;
    }
    die;
  }

  function setActive($page)
  {
    $session = load('m/session_m');

    $session->setKey("status.active", $page);
  }

  function index()
  {
    $this->jumpLastPage();
  }

  function appendChartSetting(&$param)
  {
    $regs = load('m/regmap_m');
    $config = load('m/config_m');

    $dev = DEVICE_HOST;
    $cache = $regs->getRegGroup($dev);
    $value = $cache[REG_CHART_BUF_SIZE];
    $value = ($value < 500) ? 500 : $value;
    $param['bufSize'] = $value;

    // SIZE
    $arr = [500, 1000, 2000, 3000, 6000, 12000];
    $bufSizeList = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $bufSizeList[$v] = "$v";
    }
    $param['bufSizeList'] = $bufSizeList;

    $tag = $config->getValue("recordFile", "tag", "#1");
    $param['recordTag'] = $tag;
  }

  /*************************************************************************/
  function status()
  {
    $session = load('m/session_m');

    $this->main();
    //$this->statusTemp();
  }

  function temp()
  {
    $regs = load('m/regmap_m');

    $param = array();
    $param['menu'] = MENU_STATUS;
    $param['authMin'] = AUTH_GUEST;

    $dev = DEVICE_HOST;
    $value = $regs->getValue($dev, REG_RECORD_FLAG, 0);
    $param['recordEnable'] = ($value & BRME_TEMPERATURE) ? 1 : 0;

    $this->appendChartSetting($param);

    //
    $this->setActive(STATUS_TEMPERATURE);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/status/v_temp', $param);
  }

  function voltage()
  {
    $regs = load('m/regmap_m');

    $param = array();
    $param['menu'] = MENU_STATUS;
    $param['authMin'] = AUTH_GUEST;

    $dev = DEVICE_HOST;
    $value = $regs->getValue($dev, REG_RECORD_FLAG, 0);
    $param['recordEnable'] = ($value & BRME_VOLTAGE) ? 1 : 0;

    $this->appendChartSetting($param);

    //
    $this->setActive(STATUS_VOLTAGE);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/status/v_voltage', $param);
  }

  function network()
  {
    $regs = load('m/regmap_m');

    $param = array();
    $param['menu'] = MENU_STATUS;
    $param['authMin'] = AUTH_GUEST;

    $dev = DEVICE_HOST;
    $value = $regs->getValue($dev, REG_RECORD_FLAG, 0);
    $param['recordEnable'] = ($value & BRME_NETWORK) ? 1 : 0;

    $this->appendChartSetting($param);

    //
    $this->setActive(STATUS_NETWORK);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/status/v_network', $param);
  }

  function enableRecord()
  {
    $regs = load('m/regmap_m');

    $mask = 0;
    if (isset($_GET) && isset($_GET['mask'])) {
      $mask = intval($_GET['mask']);
    }

    $enable = 0;
    if (isset($_GET) && isset($_GET['enable'])) {
      $enable = intval($_GET['enable']);
    }

    $dev = DEVICE_HOST;
    $value = $regs->getValue($dev, REG_RECORD_FLAG, 0);
    if ($enable) {
      $value |= $mask;
    } else {
      $value &= ~$mask;
    }
    $regs->setValue($dev, REG_RECORD_FLAG, $value);
    //$regs->setValue($dev, REG_STATUS_LISTEN, ($value == 0) ? 0 : 1);

    $dev = DEVICE_BSP;
    $regs->setValue($dev, REG_STATUS_LISTEN, $enable ? 1 : 0);

    $ret = array();
    $ret['code'] = 0;
    $ret['desc'] = "enable record ($value)";
    $json = json_encode_ex($ret);
    echo $json;
    die;
  }

  function main()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $dev = DEVICE_BSP;

    $param = array();
    $param['menu'] = MENU_STATUS;
    $param['authMin'] = AUTH_GUEST;
    $param['lidarIP'] = DEFAULT_DEVICE_IP;
    $param['dev'] = $dev;

    $regs->reload($dev);
    $cache = $regs->getRegGroup($dev);
    // print_object($cache);

    $param['REG_HARDWARE_VERSION'] = $cache[REG_HARDWARE_VERSION];
    $d0 = $cache[REG_FPGA_VERSION0];
    $d1 = $cache[REG_FPGA_VERSION1];
    $d2 = $cache[REG_FPGA_VERSION2];
    
    //$param['fpag_version'] = "git:(" . dechex($d0) . "-" . dechex($d1) . "-" . dechex($d2) . ")";
    $param['fpag_version'] = "git:(" . $d0 . "-" . $d1 . "-" . $d2 . ")";

    $param['REG_APP_VERSION'] = $cache[REG_APP_VERSION];
    $param['REG_BOOT_VERSION'] = $cache[REG_BOOT_VERSION];
    $param['REG_FPGA_ID'] = $cache[REG_FPGA_ID];

    // print_r($cache[REG_DEVICE_ID2]);
    // serial number
    $param['PRODUCT_V'] = ($cache[REG_DEVICE_ID1] >> 24) & 0xFF;
    $param['CHIP_V']    = ($cache[REG_DEVICE_ID1] >> 16) & 0xFF;
    $param['LASER_V']   = ($cache[REG_DEVICE_ID1] >> 8) & 0xFF;
    $param['ALG_V']     =  $cache[REG_DEVICE_ID1] & 0xFF;
    
    $param['MOTOR_V'] = ($cache[REG_DEVICE_ID2] >> 24) & 0xFF;
    // print_r($param['MOTOR_V']);
    $param['hold_1']  = ($cache[REG_DEVICE_ID2] >> 16) & 0xFF;
    $param['DEVICE_NUMBER'] = $cache[REG_DEVICE_ID2] & 0xFFFF;

    //
    $this->setActive(STATUS_MAIN);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/status/v_status', $param);
  }

  function formatMotorStatus()
  {
    $regs = load('m/regmap_m');
    $dev = DEVICE_BSP;

    $regs->reload($dev);
    $cache = $regs->getRegGroup($dev);

    // HRZ_MOTO_READY	   水平电机准备好	1：电机准备好
    // HRZ_SPEED_READY	水平电机转速正常(转速误差小于1%)	1：电机转速正常
    // MOTO_SCAN_DIS	  关闭电动扫描	1：电机扫描已被关闭
    // HRZ_MOTO_STOP	  水平电机停止	1：水平电机已经停止转动
    // AEDR_A_ZERO	    码盘A脉冲标志	1：码盘没有A脉冲
    // AEDR_B_ZERO	    码盘B脉冲标志	1：码盘没有B脉冲
    // AEDR_I_ZERO	    码盘I脉冲标志	1：码盘没有I脉冲
    // AEDR_I_OVER	    码盘I脉冲较多	1：码盘I脉冲多于20个
    // AEDR_I_MUCH	    码盘I脉冲过多	1：码盘I脉冲多于250个
    // AEDR_I_GAP_OVER	码盘I脉冲间隔过大	1：码盘的两个I脉冲之间的间隔多于12个光栅
    // VRL_DEG_ZERO	    垂直电机角度码是0	1：垂直电机角度码是全0
    // VRL_MOTO_STOP	    垂直电机停止摆动	1：垂直电机停止摆动
    // VRL_VPP_OVER	    垂直角度VPP过大	1：垂直角度VPP大于25
    // HRZ_SPEED_ERROR	水平电机转速出错(转速误差大于2%)	1：电机转速不正确
    // RASTER_OVER	    光栅过宽	1：码盘某个光栅过宽
    $value = $cache[REG_MOTOR_MODULE_STATUS];
    //$value = 0xffff;
    $stats = "";
    for ($i = 0; $i <= RASTER_OVER; $i++) {
      $mask = 0x1 << $i;
      if (0 == ($mask & $value)) {
        continue;
      }

      $text = "";
      $color = "color:red;font-weight: bold;";
      switch ($i) {
        case HRZ_MOTO_READY:
          $text .= "电机准备好";
          $color = "color:green;";
          break;
        case HRZ_SPEED_READY:
          $text .= "电机转速正常";
          $color = "color:green;";
          break;
        case MOTO_SCAN_DIS:
          $text .= "电机扫描已被关闭";
          break;
        case HRZ_MOTO_STOP:
          $text .= "水平电机已经停止转动";
          break;
        case AEDR_A_ZERO:
          $text .= "码盘没有A脉冲";
          break;
        case AEDR_B_ZERO:
          $text .= "码盘没有B脉冲";
          break;
        case AEDR_I_ZERO:
          $text .= "码盘没有I脉冲";
          break;
        case AEDR_I_OVER:
          $text .= "码盘I脉冲多于20个";
          break;
        case AEDR_I_MUCH:
          $text .= "码盘I脉冲多于250个";
          break;
        case AEDR_I_GAP_OVER:
          $text .= "码盘的两个I脉冲之间的间隔多于12个光栅";
          break;
        case VRL_DEG_ZERO:
          $text .= "垂直电机角度码是全0";
          break;
        case VRL_MOTO_STOP:
          $text .= "垂直电机停止摆动";
          break;
        case VRL_VPP_OVER:
          $text .= "垂直角度VPP大于25";
          break;
        case HRZ_SPEED_ERROR:
          $text .= "电机转速不正确(转速误差大于2%)";
          break;
        case RASTER_OVER:
          $text .= "码盘某个光栅过宽";
          break;

        default:
          break;
      }
      if ($text == "") continue;

      $stats .= "<small style=\"font-size: 0.8em;$color\">*$text</small><br>";
    }

    //
    $speed = 0.001 * $cache[REG_HORZ_MOTOR_SPEED];
    $version = dechex($cache[REG_MOTOR_MODULE_VERSION]);

    $ret = array();
    $ret['code'] = 0;
    $ret['desc'] = "motor stats ($value)";
    $ret['driverVersion'] = "$version";
    $ret['horzSpeed'] = "$speed";
    $ret['motorStats'] = "$stats";
    $json = json_encode_ex($ret);
    echo $json;
    die;
  }

  function formatSerialNumber()
  {

  }
}
