<?php

/** $Id: session_m.php 2556 2023-11-17 06:09:40Z zhangxh $ */

class session_m extends m
{
  function __construct()
  {
    session_start();
    parent::__construct();
  }

  function setKey($key, $data)
  {
    $_SESSION[$key] = $data;
  }

  function getKey($key, $default = '')
  {
    $data = $default;
    if (isset($_SESSION[$key]))
      $data = $_SESSION[$key];
    return $data;
  }
}
