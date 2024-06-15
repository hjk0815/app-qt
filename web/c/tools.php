<?php

/** $Id: tools.php 2556 2023-11-17 06:09:40Z zhangxh $ */

require(APP . 'c/main.php');
class tools extends main
{
  function __construct()
  {
    parent::__construct();
    $this->check();
  }

  function jumpLastPage()
  {
    $session = load('m/session_m');

    $page = $session->getKey("tools.active", PROP_HOST);
    switch ($page) {
    case TOOL_SLIDER:
      $this->slider();
      break;
      
    case TOOL_NOISE:
    default:
      $this->noise();
      break;

    case TOOL_PCLD:
      $this->pcld();
      break;
      
    case TOOL_MOTOR:
      $this->motor();
      break;
      
    case TOOL_IAP:
      $this->iap();
      break;
    case TOOL_ALGORITHM:
      $this->algorithm();
      break;
      
    }
    die;
  }

  function setActive($page)
  {
    $session = load('m/session_m');

    $session->setKey("tools.active", $page);
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
    $value = ($value == 0) ? 3000 : $value;
    $param['bufSize'] = $value;

    // SIZE
    $arr = [500, 1000, 2000, 3000, 6000, 12000, 30000];
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
  // http://localhost:8800/index.php?/prop/slider
  function slider()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $dev = DEVICE_DELTA;

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_ENGINEER;
    $param['dev'] = $dev;

    $value = $regs->getValue($dev, REG_TARGET_POS, 0);
    $value = ($value == 0) ? 1000 : $value;
    $param['REG_TARGET_POS'] = $value;
    
    $value = $regs->getValue($dev, REG_TARGET_SPEED, 0);
    $value = ($value == 0) ? 500 : $value;
    $param['REG_TARGET_SPEED'] = $value;

    $value = $regs->getValue($dev, REG_TARGET_CYCLE, 0);
    $value = ($value == 0) ? 1 : $value;
    $param['REG_TARGET_CYCLE'] = $value;

    $value = $regs->getValue($dev, REG_MOTION_ACCE, 0);
    $value = ($value == 0) ? 10000 : $value;
    $param['REG_MOTION_ACCE'] = $value;

    $value = $regs->getValue($dev, REG_MOTION_DECE, 0);
    $value = ($value == 0) ? 10000 : $value;
    $param['REG_MOTION_DECE'] = $value;

    // displayUnitList
    $arr = [0, 1, 2];
    $vars = ['Moving once ', 'Circulated moving', 'Absolution moving'];
    $list = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $list[$v] = $vars[$i];
    }
    $param['bidList'] = $list;
    $value = $regs->getValue($dev, REG_BID_MOTION, 0);
    $param['REG_BID_MOTION'] = $value;

    //
    $dev = DEVICE_HOST;
    $value = $regs->getValue($dev, REG_RECORD_FLAG, 0);
    $param['recordEnable'] = ($value & BRME_SLIDER) ? 1 : 0;

    $this->appendChartSetting($param);
    
    //
    $this->setActive(TOOL_SLIDER);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_slider', $param);
  }

  // http://localhost:8800/index.php?/prop/motor
  function iap()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $dev = DEVICE_BSP;

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_ENGINEER;
    $param['dev'] = $dev;

    $regs->reload($dev);
    $cache = $regs->getRegGroup($dev);

    // iap
    $arr = [IFE_BOOTIMG, IFE_GLODEN];
    $title = ["BOOT IMAGE", "GOLDEN IMAGE"];
    $iapList = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $iapList[$v] = $title[$i];
    }
    $param['iapList'] = $iapList;
    $param['iapDev'] = 0;

    // reboot
    $arr = [IFE_BOOTIMG, IFE_GLODEN];
    $title = ["BOOT IMAGE", "GOLDEN IMAGE"];
    $rebootList = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $rebootList[$v] = $title[$i];
    }
    $param['rebootList'] = $rebootList;
    $param['rebootDev'] = 0;

    //
    $this->setActive(TOOL_IAP);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_iap', $param);
  }

  // http://localhost:8800/index.php?/prop/baseNoise
  function noise()
  {
    $this->noiseCmd();
  }

  function noiseCmd()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $utils = load('m/utils_m');
    $dev = DEVICE_BOTTOM_NOISE;

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_ENGINEER;
    //$param['dev'] = $dev;

    // SIZE
    $chList = array();
    for ($i = 0; $i < 8; $i++) {
      $text = "ADC".(int)($i/2)."-DDC".($i%2)."($i)";
      $chList[$i] = $text;
    }
    $param['chList'] = $chList;

    $value = $regs->getValue($dev, REG_SAMPLE_CHANNEL, 0);
    $param['chActive'] = $value;

    $value = $regs->getValue($dev, REG_SAMPLE_TIMES, 0);
    $value = ($value == 0) ? 20 : $value;
    $param['REG_SAMPLE_TIMES'] = $value;

    $value = $regs->getValue($dev, REG_SAMPLE_AUTO_TRAVERSAL, 0);
    $param['REG_SAMPLE_AUTO_TRAVERSAL'] = $value;

    //
    $this->setActive(TOOL_NOISE);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_noise_ctrl', $param);
  }

  // chart view
  function noiseChart()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $utils = load('m/utils_m');
    $dev = DEVICE_BOTTOM_NOISE;

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_ENGINEER;
    //$param['dev'] = $dev;

    //
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_noise_chart', $param);
  }

  function noiseShift()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $utils = load('m/utils_m');
    $dev = DEVICE_BOTTOM_NOISE;

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_ENGINEER;
    //$param['dev'] = $dev;

    //
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_noise_shift', $param);
  }

  // list view
  function noiseList()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $utils = load('m/utils_m');
    $dev = DEVICE_BOTTOM_NOISE;

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_ENGINEER;
    //$param['dev'] = $dev;

    $value = $regs->getValue($dev, REG_BNOISE_LUT_SIZE, 0);
    $param['REG_BNOISE_LUT_SIZE'] = $value;

    $param['activeLut'] = 0;

    //
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_noise_list', $param);
  }

  // http://localhost:8800/index.php?/prop/pcld
  function pcld()
  {
    $regs = load('m/regmap_m');

    $pcldVersion = $regs->getValue(DEVICE_BSP, REG_PCLD_VERSION, 0);
    switch ($pcldVersion)
    {
    case SAMPLE_FMLB:
      $this->pcldFmlb();
      break;

    case SAMPLE_LARK16:
      $this->pcldLark16();
      break;

    case SAMPLE_LARK32:
    case SAMPLE_DEFAULT:
    default:
      $this->pcldLark32();
      break;
    }
  }

  function switchPcldVersion()
  {
    $regs = load('m/regmap_m');

    $data = $_GET;
    $conf = array(
      'value' => 'required',
    );
    //print_object($data);

    $err = validate($conf, $data);
    if ($err === true) {
      $value = $data['value'];
      $regs->setValue(DEVICE_BSP, REG_PCLD_VERSION, $value);
    }

    redirect(URL_BASE . "/tools/pcld", "", 2);
  }

  function pcldFmlb()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $utils = load('m/utils_m');
    $dev = DEVICE_PCLD;

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_ENGINEER;
    //$param['dev'] = $dev;

    // SAMPLE
    $arr = [SAMPLE_DEFAULT, SAMPLE_FMLB, SAMPLE_LARK16, SAMPLE_LARK32];
    $vars = ['DEFAULT', 'FMLB', 'LARK16', 'LARK32'];
    $sampleMap = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $sampleMap[$v] = $vars[$i];
    }
    $param['sampleMap'] = $sampleMap;
    $value = $regs->getValue(DEVICE_BSP, REG_PCLD_VERSION, 0);
    $param['sampleVersion'] = $value;
    //print_object($param);

    // dopper
    $value = $regs->getValue($dev, REG_DOPPLER_FACTOR, 0);
    $value = ($value == 0) ? 0 : $value;
    $param['dopplerFactor'] = $value;

    // fov-4路
    $fov_degree = [1.8, 0.6, -0.6, 1.8]; 
    for ($i = 0; $i < 4; $i++) {
      $value = $regs->getValue($dev, REG_FOV_CH0 + $i, 0);
      $value = ($value == 0) ? 1e8 * $fov_degree[$i] : $value;
      $param["fov$i"] = 1e-6 * $value;
    }

    // horz
    $value = $regs->getValue($dev, REG_HORZ_LEFT, 0);
    $value = ($value == 0) ? 480 : $value; // 9'
    $param['horzLeft'] = $value;

    $value = $regs->getValue($dev, REG_HORZ_RIGHT, 0);
    $value = ($value == 0) ? 4320 : $value; // 81'
    $param['horzRight'] = $value;
    
    $value = $regs->getValue($dev, REG_HORZ_RESOLUTION, 0);
    $value = ($value == 0) ? 19200 : $value;
    $param['horzRes'] = $value;

    // vert // y = x*0.004963898916967509-11.85379061371841
    $value = $regs->getValue($dev, REG_VERT_FACTOR_K, 0);
    $value = ($value == 0) ? 4963899 : $value;
    $param['factoryK'] = 1e-9 * $value;

    $value = $regs->getValue($dev, REG_VERT_FACTOR_A, 0);
    $value = ($value == 0) ? -11853790 : $value;
    $param['factoryA'] = 1e-6 * $value;

    // f2r
    $arr = [0, 1];
    $vars = ['Real values ', 'Fake values'];
    $list = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $list[$v] = $vars[$i];
    }
    $param['fakeList'] = $list;
    $value = $regs->getValue($dev, REG_F2R_SELECT, 0);
    $param['fakeSel'] = $value;

    // f2rMap
    $degreesDefault = [11.62, 7.409, 6.801, 2.8, 
      2.404, 1.994, 0, -1.8, 
      -1.99, -2.21, -2.4, -2.6, 
      -2.8, -6.8, -7.21, -7.61, -11.6];
    $patternDefault = [665, 610, 602, 550, 
      545, 540, 514, 490, 
      488, 485, 482, 480, 
      477, 425, 414, 363];
    $f2rDefault = [2665, 2652, 2637, 2623, 
      2608, 2593, 2579, 2563, 
      2211, 2197, 2181, 2171, 
      2156, 2141, 2126, 2111];

    $f2rMap = array();
    for ($i = 0; $i < 16; $i++)
    {
      $item = array();

      $item['deg'] = $degreesDefault[$i];

      $value = $regs->getValue($dev, REG_PATTERN_LUT_V0 + $i, 0);
      $value = ($value == 0) ? $patternDefault[$i] : $value;
      $item['dac'] =  $value;

      $value = $regs->getValue($dev, REG_F2R_LUT_V0 + $i, 0);
      $value = ($value == 0) ? $f2rDefault[$i] : $value;
      $item['f2r'] = $value;

      $f2rMap[] = $item;
    }
    $param['f2rMap'] = $f2rMap;
    
    //
    $this->setActive(TOOL_PCLD);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_pcldFmlb', $param);
  }
  
  function pcldLark16()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $utils = load('m/utils_m');
    $dev = DEVICE_PCLD;

    $regs->reload($dev);
    $cache = $regs->getRegGroup($dev);

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_ENGINEER;
    //$param['dev'] = $dev;

    // SAMPLE
    $arr = [SAMPLE_DEFAULT, SAMPLE_FMLB, SAMPLE_LARK16, SAMPLE_LARK32];
    $vars = ['DEFAULT', 'FMLB', 'LARK16', 'LARK32'];
    $sampleMap = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $sampleMap[$v] = $vars[$i];
    }
    $param['sampleMap'] = $sampleMap;
    $value = $regs->getValue(DEVICE_BSP, REG_PCLD_VERSION, 0);
    $param['sampleVersion'] = $value;

    //-------------------------------------------------------------------------
    // dopper
    $fm = 16;
    $dopperDefault = round(4 * pi() * $fm * 1000000000/1550);
    $value = $cache[REG_DOPPLER_FACTOR];
    $value = ($value == 0) ? $dopperDefault : $value;
    $param['dopplerFactor'] = $value;

    // horz 9.hsin, 10.hcos
    $value = $cache[REG_HORZ_LEFT];
    $value = ($value == 0) ? 360 : $value; // 9'
    $param['horzLeft'] = $value;

    $value = $cache[REG_HORZ_RIGHT];
    $value = ($value == 0) ? 3240 : $value; // 81'
    $param['horzRight'] = $value;
    
    $value = $cache[REG_HORZ_RESOLUTION];
    $value = ($value == 0) ? 14400 : $value;
    $param['horzRes'] = $value;

    // vert, 11.vcos, 12.vsin
    //coe_A = -0.00773005669849551828
    //coe_B = 12.77082023404271282629
    $value = $cache[REG_VERT_FACTOR_K];
    $value = ($value == 0) ? -7730056 : $value;
    $param['factoryK'] = $factoryK = 1e-9 * $value;

    $value = $cache[REG_VERT_FACTOR_A];
    $value = ($value == 0) ? 12770820 : $value;
    $param['factoryA'] = $factoryA = 1e-6 * $value;

    //-------------------------------------------------------------------------
    // fov-8路
    // 1.fovsin.txt, 2.sqfovsin.txt, 3.fovcos.txt, 4.sqfovcos.txt
    $fov_degree = [
      -5.5725, -3.98036, -2.38821, -0.79607, 
      0.79607, 2.38821, 3.98036, 5.5725
    ]; 
    $fovMap = array();
    for ($i = 0; $i < 8; $i++) {
      $value = $cache[REG_FOV_CH0 + $i];
      //echo("value===$value<br>");
      $value = ($value == 0) ? $fov_degree[$i] : 1e-6 * $value;
      $fovMap[] = $value;
    }
    $param['fovMap'] = $fovMap;
    //print_object($param);

    //-------------------------------------------------------------------------
    // 7.pid
    $pidDefault = [
      2, 0, 194, 800,
      3300, 1910, 1906, 1904,
      1902, 1900, 1899, 1898,
      1897, 0, 0, 0
    ];

    $pidMap = array();
    for ($i = 0; $i < 16; $i++)
    {
      $value = $cache[REG_PID_LUT_V0 + $i];
      $value = ($value == 0) ? $pidDefault[$i] : $value;
      $pidMap[] = $value;
    }
    $param['pidMap'] = $pidMap;

    $pidColName = array();
    $pidColName[] = "KP";
    $pidColName[] = "KI";
    $pidColName[] = "KD";
    $pidColName[] = "DAC_CODE_MIN";
    $pidColName[] = "DAC_CODE_MAX";
    $pidColName[] = "DAC_CODE_MID0";
    $pidColName[] = "DAC_CODE_MID1";
    $pidColName[] = "DAC_CODE_MID2";
    $pidColName[] = "DAC_CODE_MID3";
    $pidColName[] = "DAC_CODE_MID4";
    $pidColName[] = "DAC_CODE_MID5";
    $pidColName[] = "DAC_CODE_MID6";
    $pidColName[] = "DAC_CODE_MID7";
    $pidColName[] = "SUM_SCALE_DOWN_SEL";
    $pidColName[] = "DELTA_CODE_SEL";
    $pidColName[] = "rev2";
    $param['pidColName'] = $pidColName;

    //-------------------------------------------------------------------------
    // 5.f2r.txt + 6.pattern.txt
    // default
    $patternDefault = [
      1288, 1803, 1816, 1828, 
      1840, 1851, 1863, 1877, 
      1889, 1901, 1913, 1921, 
      1932, 1944, 2616, 2616, 
      
      1944, 1932, 1921, 1913, 
      1901, 1889, 1877, 1863, 
      1851, 1840, 1828, 1816, 
      1803, 1288, 2000, 2000, 
    ];
    $f2rDefault = [
      1295, 1804, 1816, 1828, 
      1840, 1851, 1863, 1875, 
      1887, 1899, 1911, 1923, 
      1934, 1946, 2616, 2616, 

      1946, 1934, 1923, 1911, 
      1899, 1887, 1875, 1863, 
      1851, 1840, 1828, 1816, 
      1804, 1295, 1900, 1900, 
    ];

    // f2r title
    $arr = [0, 1];
    $vars = ['Expected mode ', 'Real mode'];
    $list = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $list[$v] = $vars[$i];
    }
    $param['fakeList'] = $list;
    $value = $cache[REG_F2R_SELECT];
    $param['fakeSel'] = $value;

    // map
    $f2rMap = array();
    for ($i = 0; $i < 32; $i++)
    {
      $item = array();

      $value = $cache[REG_PATTERN_LUT_V0 + $i];
      $value = ($value == 0) ? $patternDefault[$i] : $value;
      $item['dac'] =  $value;

      $value = $cache[REG_F2R_LUT_V0 + $i];
      $value = ($value == 0) ? $f2rDefault[$i] : $value;
      $item['f2r'] = $value;

      $item['deg'] = round($value * $factoryK + $factoryA, 9); //$degreesDefault[$i];

      $f2rMap[] = $item;
    }
    $param['f2rMap'] = $f2rMap;
    
    //
    $this->setActive(TOOL_PCLD);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_pcldLark16', $param);
  }
  
  function pcldLark32()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $utils = load('m/utils_m');
    $dev = DEVICE_PCLD;

    $regs->reload($dev);
    $cache = $regs->getRegGroup($dev);

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_ENGINEER;
    //$param['dev'] = $dev;

    // SAMPLE
    $arr = [SAMPLE_DEFAULT, SAMPLE_FMLB, SAMPLE_LARK16, SAMPLE_LARK32];
    $vars = ['DEFAULT', 'FMLB', 'LARK16', 'LARK32'];
    $sampleMap = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $sampleMap[$v] = $vars[$i];
    }
    $param['sampleMap'] = $sampleMap;
    $value = $regs->getValue(DEVICE_BSP, REG_PCLD_VERSION, 0);
    $param['sampleVersion'] = $value;

    //-------------------------------------------------------------------------
    // dopper
    $fm = 16;
    $dopperDefault = round(4 * pi() * $fm * 1000000000/1550);
    $value = $cache[REG_DOPPLER_FACTOR];
    $value = ($value == 0) ? $dopperDefault : $value;
    $param['dopplerFactor'] = $value;

    // horz: 8.hsin, 9.hcos
    $value = $cache[REG_HORZ_LEFT];
    $value = ($value == 0) ? 462 : $value; // 9'
    $param['horzLeft'] = $value;

    $value = $cache[REG_HORZ_RIGHT];
    $value = ($value == 0) ? 2862 : $value; // 81'
    $param['horzRight'] = $value;
    
    $value = $cache[REG_HORZ_RESOLUTION];
    $value = ($value == 0) ? 12000 : $value;
    $param['horzRes'] = $value;

    // vert: 10.verX, 11.verY, 12.verZ
    //coe_A = 0.00035005846703752962
    //coe_B = -13.25303488864105005973
    $value = $cache[REG_VERT_FACTOR_K];
    $value = ($value == 0) ? 250787 : $value;
    $param['factoryK'] = $factoryK = 1e-9 * $value;
    $param['factoryKDef'] = 250787 * 1e-9;

    $value = $cache[REG_VERT_FACTOR_A];
    $value = ($value == 0) ? -8311086 : $value; 
    $param['factoryA'] = $factoryA = 1e-6 * $value;
    $param['factoryADef'] = -8311086 * 1e-6;

    $param['glov_c'] = $cache[REG_GLOV_C_FACTOR];
    $param['glov_cDef'] = 32.6355;
    //-------------------------------------------------------------------------
    // fov-8路
    // 1.fovX, 2.fovY, 3.fovZ
    $fov_degree = [
      2.78073 , 1.98757 , 1.19305 , 0.39777, 
      -0.39777, -1.19305, -1.98757, -2.78073
    ]; 
    $fovMap = array();
    for ($i = 0; $i < 8; $i++) {
      $value = $cache[REG_FOV_CH0 + $i];
      //echo("value===$value<br>");
      $value = ($value == 0) ? $fov_degree[$i] : 1e-6 * $value;
      $fovMap[] = $value;
    }
    $param['fovMap'] = $fovMap;
    $param['fovMapDefault'] = $fov_degree;
    //print_object($param);

    //-------------------------------------------------------------------------
    // 7.pid
    $pidDefault = [
      11, 0, 740, 16384, 
      64512, 39792, 39872, 39904, 
      39920, 39952, 39968, 39984, 
      40000, 0, 0, 0, 
    ];

    $pidMap = array();
    for ($i = 0; $i < 16; $i++)
    {
      $value = $cache[REG_PID_LUT_V0 + $i];
      $value = ($value == 0) ? $pidDefault[$i] : $value;
      $pidMap[] = $value;
    }
    $param['pidMap'] = $pidMap;
    $param['pidDefault'] = $pidDefault;

    $pidColName = array();
    $pidColName[] = "KP";
    $pidColName[] = "KI";
    $pidColName[] = "KD";
    $pidColName[] = "DAC_CODE_MIN";
    $pidColName[] = "DAC_CODE_MAX";
    $pidColName[] = "DAC_CODE_MID0";
    $pidColName[] = "DAC_CODE_MID1";
    $pidColName[] = "DAC_CODE_MID2";
    $pidColName[] = "DAC_CODE_MID3";
    $pidColName[] = "DAC_CODE_MID4";
    $pidColName[] = "DAC_CODE_MID5";
    $pidColName[] = "DAC_CODE_MID6";
    $pidColName[] = "DAC_CODE_MID7";
    $pidColName[] = "DAC_CODE_MID8";
    $pidColName[] = "SUM_SCALE_DOWN_SEL";
    $pidColName[] = "DELTA_CODE_SEL";
    $param['pidColName'] = $pidColName;

    //-------------------------------------------------------------------------
    // 5.f2r.txt + 6.pattern.txt
    // default
    $patternDefault = [
      21205, 30430, 31047, 39706, 
      39824, 39946, 40072, 40196, 
      40319, 40442, 40567, 40695, 
      40812, 49539, 50167, 50167, 

      49539, 40812, 40695, 40567, 
      40442, 40319, 40196, 40072, 
      39946, 39824, 39706, 31047, 
      30430, 21205, 40000, 40000, 
    ];
    $f2rDefault = [
      1122, 1912, 1965, 2710, 
      2720, 2731, 2742, 2752, 
      2763, 2773, 2784, 2795, 
      2805, 3554, 3608, 3608, 

      3554, 2805, 2795, 2784, 
      2773, 2763, 2752, 2742, 
      2731, 2720, 2710, 1965, 
      1912, 1122, 2000, 2000, 
    ];

    // f2r title
    $arr = [0, 1];
    $vars = ['Expected mode ', 'Real mode'];
    $list = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $list[$v] = $vars[$i];
    }
    $param['fakeList'] = $list;
    $value = $cache[REG_F2R_SELECT];
    $param['fakeSel'] = $value;

    // map
    $f2rMap = array();
    for ($i = 0; $i < 32; $i++)
    {
      $item = array();

      $value = $cache[REG_PATTERN_LUT_V0 + $i];
      $value = ($value == 0) ? $patternDefault[$i] : $value;
      $item['dac'] =  $value;

      $value = $cache[REG_F2R_LUT_V0 + $i];
      $value = ($value == 0) ? $f2rDefault[$i] : $value;
      $item['f2r'] = $value;

      $item['deg'] = round($value * $factoryK + $factoryA, 9); //$degreesDefault[$i];

      $f2rMap[] = $item;
    }
    $param['f2rMap'] = $f2rMap;
    //print_object($param);
    // 棱镜相关
    // $param['REG_POLYGON_RADIUS_CAL'] = 1e-6 * $cache[REG_POLYGON_RADIUS_CAL];
    // $param['REG_POLYGON_AXESX_CAL']  = 1e-6 * $cache[REG_POLYGON_AXESX_CAL];
    // $param['REG_POLYGON_AXESY_CAL']  = 1e-6 * $cache[REG_POLYGON_AXESY_CAL];

    $param['REG_POLYGON_RADIUS_REAL'] = 1e-6 * $cache[REG_POLYGON_RADIUS_REAL];
    $param['REG_POLYGON_AXESX_REAL']  = 1e-6 * $cache[REG_POLYGON_AXESX_REAL];
    $param['REG_POLYGON_AXESY_REAL']  = 1e-6 * $cache[REG_POLYGON_AXESY_REAL];
    $param['REG_GALVO_AXESX_REAL']    = 1e-6 * $cache[REG_GALVO_AXESX_REAL];
    $param['REG_GALVO_INIT_POS']      = 1e-6 * $cache[REG_GALVO_INIT_POS];

    // BSP

    $dev = DEVICE_BSP;

    $regs->reload($dev);
    $cache = $regs->getRegGroup($dev);

    $param['REG_CODEWHEEL_START'] = $cache[REG_CODEWHEEL_START];
    $param['REG_CODEWHEEL_STOP'] = $cache[REG_CODEWHEEL_STOP];
    //
    $this->setActive(TOOL_PCLD);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_pcldLark32', $param);
  }

  // http://localhost:8800/index.php?/prop/motor
  function motor()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $dev = DEVICE_BSP;

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_GUEST;
    $param['dev'] = $dev;

    $regs->reload($dev);
    $cache = $regs->getRegGroup($dev);

    // all
    $param['REG_MOTOR_EN_DIS'] = $cache[REG_MOTOR_EN_DIS];
    $param['REG_MOTOR_ALL_POSITIONS'] = $cache[REG_MOTOR_ALL_POSITIONS];
    
    // vert
    $value = $cache[REG_MOTOR_VCONTIBUE_MODE]; // cmd only
    $value = $cache[REG_MOTOR_VSTOP_MODE];// $regs->getValue($dev, REG_MOTOR_VSTOP_MODE, 0);
    $value = ($value == 0) ? 100 : $value;
    $param['REG_MOTOR_VSTOP_MODE'] = $value;
    $param['REG_MOTOR_VERTICAL_TRIG_OFFSET'] = $cache[REG_MOTOR_VERTICAL_TRIG_OFFSET];
    $param['REG_MOTOR_VHMOTOR_WORK_MODE'] = $cache[REG_MOTOR_VHMOTOR_WORK_MODE];
    $param['REG_MOTOR_VERTICAL_MIRROR_DEGREE_NUM'] = $cache[REG_MOTOR_VERTICAL_MIRROR_DEGREE_NUM];

    $voff = array();
    for ($i = 0; $i < 5; $i++) {
      $voff[$i] = $cache[REG_MOTOR_VMOTOR_OFFSET_BY_MIRROR0 + $i];
    }
    $param['vertMirrorOffset'] = $voff;

    // horz
    $param['REG_MOTOR_HSTOP_MODE'] = $cache[REG_MOTOR_HSTOP_MODE];
    $param['REG_MOTOR_HCONTIBUE_MODE'] = $cache[REG_MOTOR_HCONTIBUE_MODE];
    $param['REG_MOTOR_H_OFFSET'] = $cache[REG_MOTOR_H_OFFSET];
    $param['REG_MOTOR_ALWAYS_OUTPUT_MODE'] = $cache[REG_MOTOR_ALWAYS_OUTPUT_MODE];

    $hoff = array();
    for ($i = 0; $i < 5; $i++) {
      $hoff[$i] = $cache[REG_MOTOR_HMOTOR_OFFSET_BY_MIRROR0 + $i];
    }
    $param['horzMirrorOffset'] = $hoff;

    $arr = [32, 30, 25, 20, 16, 15, 10, 8, 5];
    $horzMotorSpeedArr = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $horzMotorSpeedArr[$v] = "$v";
    }
    $param['horzMotorSpeedArr'] = $horzMotorSpeedArr;
    $value = $cache[REG_MOTOR_HORIZONTAL_MIRROR_SPEED];
    $param['horzMotorSpeed'] = $value;

    // pattern
    $arr = [0, 1, 2];
    $title = ["TRIANGLE", "ZIGZAG", "INTERACTIVE"];
    $patternWorkList = array();
    for ($i = 0; $i < count($arr); $i++) {
      $v = $arr[$i];
      $patternWorkList[$v] = $title[$i];
    }
    $param['patternWorkList'] = $patternWorkList;
    $value = $cache[REG_MOTOR_PETTERN_WORK_MODE];
    $param['patternWorkMode'] = $value;

    // normal
    $dev = DEVICE_BSP;

    // 模板化参数，待逐一整理
    $group = array();
    $group['SNR threshold'] = [$cache[REG_THRESHOLD], REG_THRESHOLD];
    $param['debugParamGroup'] = $group;

    //
    $this->setActive(TOOL_MOTOR);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_motor', $param);
  }

  function laserIds()
  {
    $session = load('m/session_m');

    $dev = DEVICE_PCLD;
    if (isset($_GET) && isset($_GET['dev'])) {
      $dev = intval($_GET['dev']);
    }

    $param = array();
    $param['menu'] = MENU_TOOLS;
    $param['authMin'] = AUTH_GUEST;
    $param['dev'] = $dev;

    // $devList = array();
    // $devList[DEVICE_BSP] = "DEVICE_BSP";
    // $devList[DEVICE_LWIP] = "DEVICE_LWIP";
    // $devList[DEVICE_HOST] = "DEVICE_HOST";
    // $devList[DEVICE_PCLD] = "DEVICE_PCLD";
    // $devList[DEVICE_IAP] = "DEVICE_IAP";
    // $devList[DEVICE_BOTTOM_NOISE] = "DEVICE_BOTTOM_NOISE";
    // $param['devList'] = $devList;
    // $param['activeDev'] = $activeDev;
    $param['activeName'] = "'laserId'";

    $this->setActive(TOOL_MOTOR);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_laserId', $param);
  }
  
  function algorithm()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');
    $dev = DEVICE_BSP;

    $param = array();
    $param['dev'] = $dev;

    $regs->reload($dev);
    $cache = $regs->getRegGroup($dev);

    // all
    $param['REG_STCFAR_THR'] = $cache[REG_STCFAR_THR];

    // print_object(($param));
    $this->setActive(TOOL_ALGORITHM);
    header("Content-type: text/html; charset=utf-8");
    $this->display('v/tools/v_algorithm', $param);

  }
}

