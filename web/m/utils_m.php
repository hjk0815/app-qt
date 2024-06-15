<?php

/** $Id: utils_m.php 2015 2023-07-24 06:46:52Z zhangxh $ */

class utils_m extends m
{
  function __construct()
  {
    parent::__construct();
  }

  function enumComPort($type=1)
  {
    $rpc = load('m/rpc_m');
    $ret = $rpc->exec(RPC_PORT_LIST, $type);
    $json = json_decode($ret, true);

    $arrPort = array();
    if (isset($json['code']) && ($json['code'] == 0) && isset($json['data']['rows'])) {
      $arrPort = $json['data']['rows'];
    }
    //print_object($arrPort, "arrPort");
    return $arrPort;
  }
}
