<?php

/** $Id: config_m.php 2015 2023-07-24 06:46:52Z zhangxh $ */

class config_m extends m
{
  function __construct()
  {
    parent::__construct();
  }

  function setValue($section, $key, $value)
  {
    $rpc = load('m/rpc_m');

    $argv = array();
    $argv["section"] = $section;
    $argv["key"] = $key;
    $argv["value"] = $value;
    $ret = $rpc->exes(RPC_CONFIG_SET, $argv);
    $json = json_decode($ret, true);

    $value = 0;
    if (isset($json['code']) && $json['code'] == 0 && $json['section'] == $section && $json['key'] == $key) {
      $value = $json['value'];
    }

    return $value;
  }

  function getValue($section, $key, $value)
  {
    $rpc = load('m/rpc_m');

    $argv = array();
    $argv["section"] = $section;
    $argv["key"] = $key;
    $argv["dv"] = $value;
    $ret = $rpc->exes(RPC_CONFIG_GET, $argv);
    $json = json_decode($ret, true);

    if (isset($json['code']) && $json['code'] == 0 && $json['section'] == $section && $json['key'] == $key) {
      $value = $json['value'];
    }

    return $value;
  }
}
