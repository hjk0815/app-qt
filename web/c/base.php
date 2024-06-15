<?php
/** $Id: base.php 2015 2023-07-24 06:46:52Z zhangxh $ */

load('u/utils', false);

class base extends c
{
  function __construct()
  {
    global $db_config;
  }

  function check()
  {
  }

  function display($view, $param = array())
  {
    $param['htmlContent'] = view($view, $param, TRUE);
    header("Content-type: text/html; charset=utf-8");
  }

}
