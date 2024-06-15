<?php

/** $Id: main.php 2556 2023-11-17 06:09:40Z zhangxh $ */

class main extends base
{
  function __construct()
  {
    parent::__construct();
    $this->check();
  }

  function index()
  {
    //$this->viewChange();
    redirect(URL_BASE . "/status/index", "");
  }

  function releaseNote()
  {
    header("Content-type: text/html; charset=utf-8");
    $content = file_get_contents('CHANGES.md');
    echo "<pre>" . $content . "</pre>";
    die;
  }

  function getUserLevel()
  {
    $session = load('m/session_m');
    //$level = $session->getKey("userLevel", AUTH_ENGINEER);
    $level = $session->getKey("userLevel", AUTH_USER);

    return $level;
  }

  function getUserName()
  {
    $session = load('m/session_m');
    //$level = $session->getKey("userLevel", AUTH_ENGINEER);
    $level = $session->getKey("userLevel", AUTH_USER);

    $name = 'Guest';
    switch ($level) {
      case AUTH_GUEST:
      default:
        $name = 'Guest';
        break;
      case AUTH_USER:
        $name = 'User';
        break;
      case AUTH_ADMIN:
        $name = 'Admin';
        break;
      case AUTH_ENGINEER:
        $name = 'Engineer';
        break;
    }

    return $name;
  }

  function display($view, $param = array())
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');

    $param['productName'] = "Morelite LARK";
    $param['userAuth'] = $this->getUserLevel();
    $param['userName'] = $this->getUserName();

    // 权限保护
    if (isset($param['authMin']) && ($param['userAuth'] < $param['authMin'])) {
      redirect(URL_BASE . "/status/index", "");
    }
    
    // FIXME 雷达设备连接状态
    $param['isConnected'] = $regs->heartBeat(); // TODO device connnected nitify
    //print_object($param);

    $param['htmlContent'] = view($view, $param, true);

    header("Content-type: text/html; charset=utf-8");
    view('v/frame/template', $param);
  }

  function updateRecordTag()
  {
    $config = load('m/config_m');

    //print_object($_GET);
    $tag = "#1";
    if (isset($_GET) && isset($_GET['tag'])) {
      $tag = $_GET['tag'];
    }
    $config->setValue("recordFile", "tag", $tag);
    //write_log("updateRecordTag--$tag");

    // json
    $ret = array();
    $ret['code'] = 0;
    $ret['desc'] = "update tag";
    $ret['tag'] = $tag;
    $json = json_encode_ex($ret);
    echo $json;
    die;
  }

  /*************************************************************************/
  function getDevName($dev)
  {
    $name = "(DUMMY)";
    switch ($dev)
    {
    case DEVICE_BSP: $name = "DEVICE_BSP"; break;
    case DEVICE_HOST: $name = "DEVICE_HOST"; break;
    case DEVICE_DELTA: $name = "DEVICE_DELTA"; break;
    case DEVICE_EVB: $name = "DEVICE_EVB"; break;
    case DEVICE_FPGA: $name = "DEVICE_FPGA"; break;
    case DEVICE_BOTTOM_NOISE: $name = "DEVICE_BOTTOM_NOISE"; break;
    case DEVICE_PCLD: $name = "DEVICE_PCLD"; break;
    }
    return $name;
  }

  /*************************************************************************/
  function systemRegs()
  {
    $session = load('m/session_m');

    $activeDev = DEVICE_HOST;
    if (isset($_GET) && isset($_GET['dev'])) {
      $activeDev = intval($_GET['dev']);
    }

    $param = array();
    $param['menu'] = MENU_SYSTEM;
    $param['authMin'] = AUTH_ENGINEER;

    $devList = array();
    $devList[DEVICE_BSP] = "DEVICE_BSP";
    $devList[DEVICE_LWIP] = "DEVICE_LWIP";
    $devList[DEVICE_HOST] = "DEVICE_HOST";
    $devList[DEVICE_PCLD] = "DEVICE_PCLD";
    $devList[DEVICE_IAP] = "DEVICE_IAP";
    $devList[DEVICE_BOTTOM_NOISE] = "DEVICE_BOTTOM_NOISE";
    $param['devList'] = $devList;
    $param['activeDev'] = $activeDev;
    $param['activeName'] = "'".$this->getDevName($activeDev)."'";

    header("Content-type: text/html; charset=utf-8");
    $this->display('v/system/v_regs', $param);
  }

  /*************************************************************************/
  function userSwitch()
  {
    $session = load('m/session_m');
    $data = $_POST;
    $conf = array(
      'userName' => 'required',
      'password' => 'required',
    );

    $err = validate($conf, $data);
    if ($err === true) {
      $name = $data['userName'];
      $password = $data['password'];
      switch ($name) {
        case "admin":
          if ($password == 'admin') {
            $session->setKey("userLevel", AUTH_ADMIN);
          }
          break;

        case "morelite":
          if ($password == 'morelite') {
            $session->setKey("userLevel", AUTH_ENGINEER);
          }
          break;

        case "user":
          if ($password == 'user') {
            $session->setKey("userLevel", AUTH_USER);
          }
          break;

        default:
          break;
      }
      redirect(URL_BASE . "/status/index", "");
    }
  }

  /*************************************************************************/
  function pointCloud()
  {
    $session = load('m/session_m');

    $param = array();
    $param['menu'] = MENU_POINTS;
    $param['authMin'] = AUTH_ENGINEER;

    //$this->display('v/3d/v_pts', $param);
    $param['productName'] = "Morelite lidar";
    //$param['htmlContent'] = view("v/3d/v_pts", $param, true);

    header("Content-type: text/html; charset=utf-8");
    view('v/3d/v_cloud', $param);
  }
}
