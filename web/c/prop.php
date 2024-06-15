<?php

/** $Id: prop.php 2556 2023-11-17 06:09:40Z zhangxh $ */

require(APP . 'c/main.php');
class prop extends main
{
  function __construct()
  {
    parent::__construct();
    $this->check();
  }

  function jumpLastPage()
  {
    $session = load('m/session_m');

    $page = $session->getKey("prop.active", PROP_HOST);
    switch ($page) {
      case PROP_HOST:
      default:
        $this->host();
        break;

      case PROP_BSP:
        $this->bsp();
        break;

      case PROP_FPGA:
        $this->fpga();
        break;

      case PROP_DEBUG:
        $this->debug();
        break;
    }
    die;
  }

  function setActive($page)
  {
    $session = load('m/session_m');

    $session->setKey("prop.active", $page);
  }

  function index()
  {
    $this->jumpLastPage();
  }

  /*************************************************************************/
  // http://localhost:8800/index.php?/prop/propHost
  function host()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $config = load('m/config_m');
    $dev = DEVICE_HOST;

    $param = array();
    $param['menu'] = MENU_PROP;
    $param['authMin'] = AUTH_GUEST;
    $param['lidarIP'] = DEFAULT_DEVICE_IP;
    $param['dev'] = $dev;

    $cache = $regs->getRegGroup($dev);

    $param['REG_LIDAR_PARAM1'] = $cache[REG_LIDAR_PARAM1];
    $param['REG_LIDAR_PARAM2'] = $cache[REG_LIDAR_PARAM2];
    $param['REG_LIDAR_VELOCITY_MAX'] = $cache[REG_LIDAR_VELOCITY_MAX];
    $param['REG_LIDAR_DISTANCE_MAX'] = $cache[REG_LIDAR_DISTANCE_MAX];
    $param['REG_LIDAR_SNR_MIN'] = $cache[REG_LIDAR_SNR_MIN];
    $param['REG_LIDAR_PARAM_ENC_MUL_LAYS'] = $cache[REG_LIDAR_PARAM_ENC_MUL_LAYS];
    $param['REG_LIDAR_DIS_OFF'] = $cache[REG_LIDAR_DIS_OFF];
    $param['REG_LIDAR_MSFLAG'] = $cache[REG_LIDAR_MSFLAG];
    //print_object($param);

    // RECORD
    $arr = [10000, 60000, 180000, 360000, 600000];
    $recordLineLimitList = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $recordLineLimitList[$v] = "$v";
    }
    $param['recordLineLimitList'] = $recordLineLimitList;
    $value = $cache[REG_RECORD_LINE_LIMIT];
    $value = ($value == 0) ? 100000 : $value;
    $param['recordLIneLimit'] = $value;

    $arr = [5, 10, 30, 60];
    $recordTimeLimitList = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $recordTimeLimitList[$v] = "$v";
    }
    $param['recordTimeLimitList'] = $recordTimeLimitList;
    $value = $cache[REG_RECORD_TIME_LIMIT];
    $value = ($value == 0) ? 60 : $value;
    $param['recordTimeLimit'] = $value;

    $arr = [16, 32, 64, 128];
    $recordSizeLimitList = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $recordSizeLimitList[$v] = "$v";
    }
    $param['recordSizeLimitList'] = $recordSizeLimitList;
    $value = $cache[REG_RECORD_SIZE_LIMIT];
    $value = ($value == 0) ? 64 : $value;
    $param['recordSizeLimit'] = $value;

    $tag = $config->getValue("recordFile", "tag", "AA");
    $param['recordTag'] = $tag;

    //
    $dev = DEVICE_HOST;
    $value = $regs->getValue($dev, REG_RECORD_FLAG, 0);
    $param['recordVoltage'] = ($value & BRME_VOLTAGE) ? 1 : 0;
    $param['recordTemp'] = ($value & BRME_TEMPERATURE) ? 1 : 0;
    $param['recordNetwork'] = ($value & BRME_NETWORK) ? 1 : 0;
    $param['recordRaw'] = ($value & BRME_RAW_DATA) ? 1 : 0;
    $param['recordCombine'] = ($value & BRME_COMBINE) ? 1 : 0;
    $param['recordEvb'] = ($value & BRME_EVB) ? 1 : 0;
    $param['recordSlider'] = ($value & BRME_SLIDER) ? 1 : 0;

    $param['REG_VELOCITY_RENDER_RANGE'] = $cache[REG_VELOCITY_RENDER_RANGE];
    $param['REG_VELOCITY_RENDER_STEP'] = 0.1 * $cache[REG_VELOCITY_RENDER_STEP];

    //
    $this->setActive(PROP_HOST);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/prop/v_host', $param);
  }

  /*************************************************************************/
  // http://localhost:8800/index.php?/main/propBsp
  function bsp()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $dev = DEVICE_BSP;

    $param = array();
    $param['menu'] = MENU_PROP;
    $param['authMin'] = AUTH_GUEST;
    $param['lidarIP'] = DEFAULT_DEVICE_IP;
    $param['dev'] = $dev;

    $regs->reload($dev);
    $cache = $regs->getRegGroup($dev);

    //
    $param['REG_EDFA_POWER'] = $cache[REG_EDFA_POWER];
    $param['REG_VGA_DAC5311'] = $cache[REG_VGA_DAC5311];
    $param['REG_TIA_DAC5311'] = $cache[REG_TIA_DAC5311];

    //
    $param['REG_EDFA_PUMP_ENABLE'] = $cache[REG_EDFA_PUMP_ENABLE];
    $param['REG_UDP_TRANS_DISABLE'] = $cache[REG_UDP_TRANS_DISABLE];
    $param['REG_CMD_TRANS_DISABLE'] = $cache[REG_CMD_TRANS_DISABLE];

    //$param['REG_START_BIN'] = $cache[REG_START_BIN] & 0xfff;

    //
    $value = $cache[REG_WORK_MODE];
    $workMode = array();
    $workMode[0] = "CLOUDMODEDMA";
    $workMode[1] = "RAWMODEDMA1";
    $workMode[2] = "RAWMODEDMA2";
    // $workMode[3] = "TORAWMODE1";
    // $workMode[4] = "TORAWMODE2";
    // $workMode[5] = "TOCLOUDMODE";
    $param['workMode'] = $workMode;
    $param['activeMode'] = $value & 0xf;
    $param['rawDegree'] = ($value >> 16) & 0xfffff;

    $start = $cache[REG_FFT_START_BIN];
    $cutoff = $cache[REG_FFT_CUTOFF_BIN];
    $param['ddc0FftStart'] = $start & 0x7fff;
    $param['ddc1FftStart'] = ($start >> 16) & 0x7fff;
    $param['ddc0FftCutoff'] = $cutoff & 0x7fff;
    $param['ddc1FftCutoff'] = ($cutoff >> 16) & 0x7fff;

    $arr = [0, 2, 3];
    $title = ["Disable go-far and movesum", "Enable only movesum", "Enable go-cfar and movesum"];
    $fftPeakModeList = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $fftPeakModeList[$v] = $title[$i];
    }
    $param['fftPeakModeList'] = $fftPeakModeList;
    $value = $cache[REG_FFT_PEAK_CMD];
    $param['fftPeakMode'] = $value;

    // 模板化参数，待逐一整理
    $group = array();
    $group['SNR threshold'] = [$cache[REG_THRESHOLD], REG_THRESHOLD];
    //$group['FFT frequency range'] = [$cache[REG_FFT_FREQ], REG_FFT_FREQ];
    $param['debugParamGroup'] = $group;
    
    // wait dlg
    $now = time();
    $timeout = $session->getKey("waitStamp.timeout", 0);
    $param['waitTimeout'] = $timeout;

    $expire = $session->getKey("waitStamp.expire", 0);
    //$waitStamp = $regs->getValue(DEVICE_HOST, REG_WAIT_STAMP, 0);
    $waitTime = 0;
    if ($expire > $now) {
      $waitTime = $expire - $now;
    }
    $param['waitTime'] = $waitTime;

    $waitTitle = $session->getKey("waitStamp.title", "");
    $param['waitTitle'] = $waitTitle;
    
    //
    $this->setActive(PROP_BSP);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/prop/v_bsp', $param);
  }

  /*************************************************************************/
  // http://localhost:8800/index.php?/main/propFpga
  function fpga()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $dev = DEVICE_FPGA;

    $param = array();
    $param['menu'] = MENU_PROP;
    $param['authMin'] = AUTH_ENGINEER;
    $param['lidarIP'] = DEFAULT_DEVICE_IP;
    $param['dev'] = $dev;

    $addr = 0x43C40004;
    $value = $regs->getValue($dev, $addr, 0);
    $param['addr'] = $addr;
    $param['value'] = $value;

    //
    $this->setActive(PROP_FPGA);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/prop/v_fpga', $param);
  }

  /*************************************************************************/
  // http://localhost:8800/index.php?/main/propDebug
  function debug()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $dev = DEVICE_BSP;

    $param = array();
    $param['menu'] = MENU_PROP;
    $param['authMin'] = AUTH_ENGINEER;
    $param['lidarIP'] = DEFAULT_DEVICE_IP;
    $param['dev'] = $dev;

    $devList[DEVICE_BSP] = "BSP";
    $devList[DEVICE_LWIP] = "LWIP";
    // $devList[DEVICE_IMK04826] = "IMK04826";
    // $devList[DEVICE_ADS7038] = "ADS7038";
    // $devList[DEVICE_AFE58JD18_0] = "AFE58JD18_0";
    // $devList[DEVICE_AFE58JD18_1] = "AFE58JD18_1";
    // $devList[DEVICE_AFE58JD18_2] = "AFE58JD18_2";
    // $devList[DEVICE_AFE58JD18_3] = "AFE58JD18_3";
    $param['devList'] = $devList;
    $param['activeDev'] = DEVICE_BSP;

    //
    $this->setActive(PROP_DEBUG);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/prop/v_debug', $param);
  }

  /*************************************************************************/
  function saveBsp()
  {
    $regs = load('m/regmap_m');

    $dev = DEVICE_BSP;
    $regs->save($dev);
  }

  /*************************************************************************/
  // http://localhost:8800/index.php?/main/propChannels
  function channels()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $dev = DEVICE_HOST;

    $param = array();
    $param['menu'] = MENU_PROP;
    $param['authMin'] = AUTH_ENGINEER;
    $param['lidarIP'] = DEFAULT_DEVICE_IP;

    header("Content-type: text/html; charset=utf-8");
    $this->display('v/prop/v_channels', $param);
  }

}
