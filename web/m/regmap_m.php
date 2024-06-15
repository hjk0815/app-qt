<?php

/** $Id: regmap_m.php 2015 2023-07-24 06:46:52Z zhangxh $ */

class regmap_m extends m
{
  function __construct()
  {
    parent::__construct();
  }

  function setValue($dev, $addr, $v)
  {
    $rpc = load('m/rpc_m');
    $ret = $rpc->exec(RPC_REG_SET, $dev, $addr, $v);
    $json = json_decode($ret, true);

    $value = 0;
    if (isset($json['code']) && $json['code'] == 0 && $json['dev'] == $dev && $json['addr'] == $addr) {
      $value = $json['value'];
    }

    return $value;
  }

  function getValue($dev, $addr, $value = 0)
  {
    $rpc = load('m/rpc_m');
    $ret = $rpc->exec(RPC_REG_GET, $dev, $addr);
    $json = json_decode($ret, true);

    if (isset($json['code']) && $json['code'] == 0 && $json['dev'] == $dev && $json['addr'] == $addr) {
      $value = $json['value'];
    }

    return $value;
  }

  function heartBeat()
  {
    $webTime = 0;
    $rpc = load('m/rpc_m');
    $ret = $rpc->exec(RPC_HEART_BEAT, $webTime);
    $json = json_decode($ret, true);

    $value = 0;
    if (isset($json['code']) && $json['code'] == 0) {
      //$value = $json['time'];
    }
    //print_object($json, "getValue");

    return $value;
  }

  function reload($dev)
  {
    $rpc = load('m/rpc_m');
    $ret = $rpc->exec(RPC_REG_RELOAD, $dev);
    $json = json_decode($ret, true);
  }

  function getRegGroup($dev)
  {
    $rpc = load('m/rpc_m');
    $ret = $rpc->exec(RPC_REG_GROUP, $dev);
    $json = json_decode($ret, true);

    // {"code":0,"count":512,"datas":["0","192.168.1.10","0","....,"0"]}
    $datas = array();
    if (isset($json['code']) && $json['code'] == 0 && $json['dev'] == $dev && $json['count'] > 0) {
      $datas = $json['datas'];
    }

    // fail routine...
    if (count($datas) == 0) {
      $dummySize = 0;
      switch ($dev) {
        case DEVICE_HOST:
          $dummySize = HOST_REG_CNT;
          break;
        case DEVICE_BSP:
          $dummySize = BSP_REG_CNT;
          break;
        default:
          $dummySize = REGS_CNT_ONCE_BUFFER_MAX;
          break;
      }
      for ($i = 0; $i < $dummySize; $i++) {
        $datas[$i] = 0;
      }
    }

    //echo "REG_LIDAR_IP--".$datas[REG_LIDAR_IP]."<br>";
    //print_object($datas, "getRegGroup");
    return $datas;
  }

  function save($dev)
  {
    $rpc = load('m/rpc_m');
    $ret = $rpc->exec(RPC_REG_SAVE, $dev);
    $json = json_decode($ret, true);
  }
}
