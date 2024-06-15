<?php

/** $Id: rpc.php 2108 2023-08-07 09:22:56Z zhangxh $ */

include(APP . 'iapRegs.php');

require(APP . 'c/main.php');
class rpc extends main
{
  function __construct()
  {
    parent::__construct();
    $this->check();
  }

  function index()
  {
  }

  function regSet()
  {
    $rpc = load('m/rpc_m');

    $dev = 0;
    if (isset($_GET) && isset($_GET['dev'])) {
      $dev = intval($_GET['dev']);
    }
    $addr = 0;
    if (isset($_GET) && isset($_GET['addr'])) {
      $addr = $_GET['addr'];
    }
    $value = 0;
    if (isset($_GET) && isset($_GET['value'])) {
      $value = $_GET['value'];
    }

    $ret = $rpc->exeReg(RPC_REG_SET, $dev, $addr, $value);
    echo $ret;
    die;
  }

  function regGet()
  {
    $rpc = load('m/rpc_m');

    $dev = 0;
    if (isset($_GET) && isset($_GET['dev'])) {
      $dev = intval($_GET['dev']);
    }
    $addr = 0;
    if (isset($_GET) && isset($_GET['addr'])) {
      $addr = $_GET['addr'];
    }

    $ret = $rpc->exeReg(RPC_REG_GET, $dev, $addr);
    echo $ret;
    die;
  }

  function regSave()
  {
    $rpc = load('m/rpc_m');

    $dev = 0;
    if (isset($_GET) && isset($_GET['dev'])) {
      $dev = intval($_GET['dev']);
    }

    $ret = $rpc->exec(RPC_REG_SAVE, $dev);
    echo $ret;
    die;
  }

  function regReload()
  {
    $rpc = load('m/rpc_m');

    $dev = 0;
    if (isset($_GET) && isset($_GET['dev'])) {
      $dev = intval($_GET['dev']);
    }

    $ret = $rpc->exec(RPC_REG_RELOAD, $dev);
    echo $ret;
    die;
  }

  function regList()
  {
    $rpc = load('m/rpc_m');

    $dev = 0;
    if (isset($_GET) && isset($_GET['dev'])) {
      $dev = intval($_GET['dev']);
    }

    $ret = $rpc->exec(RPC_REG_LIST, $dev);
    echo $ret;
    die;
  }

  function nativeLog()
  {
    $rpc = load('m/rpc_m');

    $argv = array();
    $ret = $rpc->exes(RPC_LOG, $argv);
    echo $ret;
    die;
  }

  function laserIdList()
  {
    $rpc = load('m/rpc_m');

    $dev = 0;
    if (isset($_GET) && isset($_GET['dev'])) {
      $dev = intval($_GET['dev']);
    }
    //print_object($_GET);

    $ret = $rpc->exec(RPC_LASER_ID_LIST, $dev);
    echo $ret;
    die;
  }

  function chartData()
  {
    $rpc = load('m/rpc_m');

    $dev = 0;
    if (isset($_GET) && isset($_GET['dev'])) {
      $dev = intval($_GET['dev']);
    }
    $type = 0;
    if (isset($_GET) && isset($_GET['type'])) {
      $type = intval($_GET['type']);
    }
    $reload = 0;
    if (isset($_GET) && isset($_GET['reload'])) {
      $reload = intval($_GET['reload']);
    }

    $ret = $rpc->exec(RPC_CHART_DATA, $dev, $type, $reload);
    //write_log("chartdata---$ret\r\n");
    echo $ret;
    die;
  }

  function calibData()
  {
    $rpc = load('m/rpc_m');

    $type = 0;
    if (isset($_GET) && isset($_GET['type'])) {
      $type = intval($_GET['type']);
    }

    $ret = $rpc->exec(RPC_CALIBRATION, $type);
    echo $ret;
    die;
  }

  function enumComPort()
  {
    $rpc = load('m/rpc_m');

    $type = 1;
    if (isset($_GET) && isset($_GET['type'])) {
      $type = intval($_GET['type']);
    }
    
    $ret = $rpc->exec(RPC_PORT_LIST, $type);
    echo $ret;
    die;
  }

  function noiseCmd()
  {
    $rpc = load('m/rpc_m');

    $cmd = 1;
    if (isset($_GET) && isset($_GET['cmd'])) {
      $cmd = intval($_GET['cmd']);
    }
    $ch = 0;
    if (isset($_GET) && isset($_GET['ch'])) {
      $ch = intval($_GET['ch']);
    }
    $parment1 = 0;
    if (isset($_GET) && isset($_GET['parment1'])) {
      $parment1 = intval($_GET['parment1']);
    }
    $parment2 = 0;
    if (isset($_GET) && isset($_GET['parment2'])) {
      $parment2 = intval($_GET['parment2']);
    }
    $ret = $rpc->exec(RPC_NOISE_CMD, $cmd, $ch, $parment1, $parment2);
    echo $ret;
    die;
  }

  function noiseChange()
  {
    $rpc = load('m/rpc_m');

    // json
    $ret = array();
    $ret['code'] = 1;
    $ret['desc'] = "param error";
    $ret = json_encode_ex($ret);

    $cmd = NCE_CHANGE_ITEM;
    do {
      $col = 0;
      if (isset($_GET) && isset($_GET['col'])) {
        $col = $_GET['col'];
      }

      $names = array('ch0', 'ch1', 'ch2', 'ch3', 'ch4', 'ch5', 'ch6', 'ch7');
      $ch = 0;
      $r = array_keys($names, $col, false);
      if (count($r) == 0)
        break;
      $ch = $r[0];

      $id = 1;
      if (isset($_GET) && isset($_GET['id'])) {
        $id = intval($_GET['id']);
      }

      $data = 0;
      if (isset($_GET) && isset($_GET['data'])) {
        $data = intval($_GET['data']);
      }

      $ret = $rpc->exec(RPC_NOISE_CMD, $cmd, $ch, $id, $data);
    } while(0);
    
    echo $ret;
    die;
  }

  function noiseData()
  {
    $rpc = load('m/rpc_m');

    $type = 0;
    if (isset($_GET) && isset($_GET['type'])) {
      $type = intval($_GET['type']);
    }
    $ch = 0;
    if (isset($_GET) && isset($_GET['ch'])) {
      $ch = intval($_GET['ch']);
    }
    
    $ret = $rpc->exec(RPC_NOISE_DATA, $type, $ch);
    echo $ret;
    die;
  }

  //
  function pcldCmd()
  {
    $rpc = load('m/rpc_m');

    $cmd = 1;
    if (isset($_GET) && isset($_GET['cmd'])) {
      $cmd = intval($_GET['cmd']);
    }
    
    $ret = $rpc->exec(RPC_PCLD_CMD, $cmd);
    echo $ret;
    die;
  }

  //
  function dashboardCmd()
  {
    $rpc = load('m/rpc_m');

    $cmd = 1;
    if (isset($_GET) && isset($_GET['cmd'])) {
      $cmd = intval($_GET['cmd']);
    }
    
    $ret = $rpc->exec(RPC_DASHBOARD, $cmd);
    echo $ret;
    die;
  }

  //
  function pcdList()
  {
    $rpc = load('m/rpc_m');

    $dev = 1;
    if (isset($_GET) && isset($_GET['dev'])) {
      $dev = intval($_GET['dev']);
    }
    $stage = 0;
    if (isset($_GET) && isset($_GET['stage'])) {
      $stage = intval($_GET['stage']);
    }
    
    $ret = $rpc->exec(RPC_PCD_LIST, $dev, $stage);
    echo $ret;
    die;
  }

  function pcdBin()
  {
    do {
      $frameId = 0;
      if (isset($_GET) && isset($_GET['frameId'])) {
        $frameId = intval($_GET['frameId']);
      }
      #echo "name:$name<br>";
      write_log("frameId==$frameId\r\n");
  
      $path = "C:/morelite/pcds/$frameId.pcd";
      #write_log("path==$path\r\n");
      $name = pathinfo($path, PATHINFO_BASENAME);

      if (is_file($path)) {
        $file = fopen($path, "rb");
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: " . filesize($path));
        Header("Content-Disposition: attachment; filename=" . $name);
        echo fread($file, filesize($path));
        fclose($file);
      } else {
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: " . 0);
        Header("Content-Disposition: attachment; filename=" . $name);

        echo "# .PCD v0.7 - Point Cloud Data file format\n";
        echo "VERSION 0.7\n";
        echo "FIELDS x y z v intensity laserId timestamp \n";
        echo "SIZE  4 4 4 4 2 2 8 \n";
        echo "TYPE  F F F F U U F \n";
        echo "COUNT 1 1 1 1 1 1 1 \n";
        echo "WIDTH 0\n";
        echo "HEIGHT 1\n";
        echo "VIEWPOINT 0 0 0 1 0 0 0\n";
        echo "POINTS 0\n";
        echo "DATA ascii\n";
        echo "\n";
      }

      exit();
    } while (0);
  }

  function copyUploadFile(&$fileName)
  {
    $err = 0;
    $data = $_FILES;
    $debug = print_r($data, true);
    write_log("copyUploadFile enter--$debug");

    do {
      $fi = 0;
      if (isset($data) && isset($data['fileInfo'])) {
        $fi = $data['fileInfo'];
      }
      if ($fi == 0) {
        write_log("error: invalid fileInfo");
        $err = 1;
        break;
      }
      if ($fi['error'] != 0) {
        $err = $fi['error'];
        
        // 0，没有错误发生，文件上传成功
        // 1，上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。 
        // 2，上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 
        // 3，文件只有部分被上传。 
        // 4，没有文件被上传。 
        // 6，找不到临时文件夹。PHP 4.3.10 和 PHP 5.0.3 引进。 
        // 7，文件写入失败。PHP 5.1.0 引进。 
        write_log("error: fileInfo::error: $err");
        break;
      }

      $dir = "c:/morelite/upload";
      if (!is_dir($dir)) {
        mkdir(iconv("UTF-8", "GBK", $dir), 0777, true);
      }
    
      $temp_file = $fi['tmp_name'];
      $fileName = $dir . '/' . date('ymd-His') . '-' . $fi['name'];
      move_uploaded_file($temp_file, $fileName);
    } while (0);

    return $err;
  }

  function uploadFirmware()
  {
    $regs = load('m/regmap_m');
    $rpc = load('m/rpc_m');
    $session = load('m/session_m');

    //print_object($data, "_FILES", 1);
    
    $err = $this->copyUploadFile($fileName);
    $debug = print_r($fileName, true);
    write_log("uploadFirmware enter--$debug");
  
    // remote parser
    $argv = array();
    $argv['type'] = IAP_UPLOAD;
    $argv['fileName'] = $fileName;
    $ret = $rpc->exes(RPC_IAP, $argv);
    //$json = json_decode($ret, true);

    $now = time();
    $timeout = 10; // 20231213 增加导入延时
    $expire = $now + $timeout;
    //$regs->setValue(DEVICE_HOST, REG_WAIT_STAMP, $expire);
    $session->setKey("waitStamp.timeout", $timeout);
    $session->setKey("waitStamp.expire", $expire);
    $session->setKey("waitStamp.title", "BSP IAP running ");
    echo $ret;

    //die;
    redirect(URL_BASE . "/prop/bsp", "");
  }

  function uploadPattern()
  {
    $regs = load('m/regmap_m');
    $rpc = load('m/rpc_m');
    $session = load('m/session_m');

    //print_object($data, "_FILES", 1);
    
    $err = $this->copyUploadFile($fileName);
    $debug = print_r($fileName, true);
    write_log("uploadPattern enter--$debug");
  
    // remote parser
    $argv = array();
    $argv['type'] = UPLOAD_PATTERN;
    $argv['fileName'] = $fileName;
    $ret = $rpc->exes(RPC_UPLOAD, $argv);
    //$json = json_decode($ret, true);

    $now = time();
    $timeout = 10; // 20231213 增加导入延时
    $expire = $now + $timeout;
    //$regs->setValue(DEVICE_HOST, REG_WAIT_STAMP, $expire);
    $session->setKey("waitStamp.timeout", $timeout);
    $session->setKey("waitStamp.expire", $expire);
    $session->setKey("waitStamp.title", "Upload pattern running ");
    echo $ret;

    //die;
    redirect(URL_BASE . "/tools/pcld", "", 2);
  }

  function uploadF2r()
  {
    $regs = load('m/regmap_m');
    $rpc = load('m/rpc_m');
    $session = load('m/session_m');

    //print_object($data, "_FILES", 1);
    
    $err = $this->copyUploadFile($fileName);
    $debug = print_r($fileName, true);
    write_log("uploadF2r enter--$debug");
  
    // remote parser
    $argv = array();
    $argv['type'] = UPLOAD_F2R;
    $argv['fileName'] = $fileName;
    $ret = $rpc->exes(RPC_UPLOAD, $argv);
    //$json = json_decode($ret, true);

    $now = time();
    $timeout = 10; // 20231213 增加导入延时
    $expire = $now + $timeout;
    //$regs->setValue(DEVICE_HOST, REG_WAIT_STAMP, $expire);
    $session->setKey("waitStamp.timeout", $timeout);
    $session->setKey("waitStamp.expire", $expire);
    $session->setKey("waitStamp.title", "Upload f2r running ");
    echo $ret;

    //die;
    redirect(URL_BASE . "/tools/pcld", "", 2);
  }

  function uploadLaserId()
  {
    $regs = load('m/regmap_m');
    $rpc = load('m/rpc_m');
    $session = load('m/session_m');

    //print_object($data, "_FILES", 1);
    
    $err = $this->copyUploadFile($fileName);
    $debug = print_r($fileName, true);
    write_log("uploadLaserId enter--$debug");
  
    // remote parser
    $argv = array();
    $argv['type'] = UPLOAD_LASER_ID;
    $argv['fileName'] = $fileName;
    $ret = $rpc->exes(RPC_UPLOAD, $argv);
    //$json = json_decode($ret, true);

    $now = time();
    $timeout = 10; // 20231213 增加导入延时
    $expire = $now + $timeout;
    //$regs->setValue(DEVICE_HOST, REG_WAIT_STAMP, $expire);
    $session->setKey("waitStamp.timeout", $timeout);
    $session->setKey("waitStamp.expire", $expire);
    $session->setKey("waitStamp.title", "Upload laserId running ");
    echo $ret;

    //die;
    redirect(URL_BASE . "/tools/laserIds", "", 2);
  }

  function uploadIap()
  {
    $regs = load('m/regmap_m');
    $rpc = load('m/rpc_m');
    $session = load('m/session_m');

    $data = $_POST;
    $iapDev = 0;
    if (isset($data) && isset($data['iapDev'])) {
      $iapDev = intval($data['iapDev']);
    }
    
    $err = $this->copyUploadFile($fileName);
    $debug = print_r($fileName, true);
    write_log("uploadIap enter--$debug");
    //print_object($data);
  
    // remote parser
    $argv = array();
    $argv['type'] = IAP_UPLOAD;
    $argv['iapDev'] = $iapDev;
    $argv['fileName'] = $fileName;
    $ret = $rpc->exes(RPC_IAP, $argv);

    $now = time();
    $timeout = 90; // 20231213 增加导入延时
    $expire = $now + $timeout;
    //$regs->setValue(DEVICE_HOST, REG_WAIT_STAMP, $expire);
    $session->setKey("waitStamp.timeout", $timeout);
    $session->setKey("waitStamp.expire", $expire);
    $session->setKey("waitStamp.title", "Upload laserId running ");
    echo $ret;

    //die;
    redirect(URL_BASE . "/tools/iap", "", 2);
  }

  //
  function iapStatus()
  {
    $session = load('m/session_m');
    $regs = load('m/regmap_m');

    $dev = DEVICE_IAP;
    $value = $regs->getValue($dev, REG_IAP_STATUS, 0);
    $status = $value & 0xff;
    $percent = ($value >> 16) & 0xff;
    $stage = "UNKNOWN";
    switch ($status)
    {
    case ISE1_IDLE:
      $stage = "IDLE";
      break;

    case ISE1_READY:
      $stage = "READY";
      break;

    case ISE1_TRANSING:
      $stage = "TRANSING";
      break;

    case ISE1_WAIT_RESEND:
      $stage = "RESEND";
      break;

    case ISE1_FINISH:
      $stage = "WAITING";
      break;

    case ISE1_VERIFYING:
      $stage = "VERIFYING";
      break;

    case ISE1_VERIFY_OK:
      $stage = "VERIFY_OK";
      break;

    case ISE1_FLUSHING:
      $stage = "FLUSHING";
      break;

    case ISE1_FLUSH_OK:
      $stage = "FLUSH_OK";
      break;

    case ISE1_ERROR:
      $stage = "WAITING";
      break;
    }

    $ret = array();
    $ret['code'] = 0;
    $ret['desc'] = "iap status";
    $ret['status'] = $status;
    $ret['stage'] = $stage;
    $ret['percent'] = $percent;

    $dev = DEVICE_BSP;
    $ret['bspVersion'] = $regs->getValue($dev, REG_APP_VERSION, 0);
    $ret['bootVersion'] = $regs->getValue($dev, REG_BOOT_VERSION, 0);

    $d0 = $regs->getValue($dev, REG_FPGA_VERSION0, 0);
    $d1 = $regs->getValue($dev, REG_FPGA_VERSION1, 0);
    $d2 = $regs->getValue($dev, REG_FPGA_VERSION2, 0);
    $ret['fpagVersion'] = "git:(" . $d0 . "-" . $d1 . "-" . $d2 . ")";

    $json = json_encode_ex($ret);
    echo $json;
    die;
  }

  function iapReboot()
  {
    $rpc = load('m/rpc_m');

    $data = $_GET;
    $iapDev = 0;
    if (isset($data) && isset($data['iapDev'])) {
      $iapDev = intval($data['iapDev']);
    }

    $argv = array();
    $argv['type'] = IAP_REBOOT;
    $argv['iapDev'] = $iapDev;
    $ret = $rpc->exes(RPC_IAP, $argv);
    echo $ret;
    die;
  }

}
