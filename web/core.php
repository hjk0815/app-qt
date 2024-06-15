<?php

/** $Id: core.php 2556 2023-11-17 06:09:40Z zhangxh $ */

// 时间设置 zhangxinghua
date_default_timezone_set("Asia/Shanghai");

include(APP . 'version.php');
include(APP . 'error.php');
include(APP . 'defines.php');

include(APP . 'msysTop.php');
include(APP . 'rpcRegs.php');
include(APP . 'hostRegs.php');
include(APP . 'bspRegs.php');
include(APP . 'deltaRegs.php');
include(APP . 'bnoiseRegs.php');
include(APP . 'pcldRegs.php');

// 载入配置文件：数据库、url路由等等
require(APP . 'config.php');

function print_stack_trace()
{
  $array = debug_backtrace(); //print_r($array);//信息很齐全
  //unset($array[0]);
  echo "<pre>print_stack_trace";

  $html = '';
  foreach ($array as $row) {
    $html .= $row['file'] . ':' . $row['line'] . ':' . $row['function'] . '<br />';
  }
  echo $html;
  echo "</pre>";
  die;
  return $html;
}

function print_object($ob, $name = "", $term = 1)
{
  //print_stack_trace();
  $log = print_r($ob, true);
  echo "print_object:$name-<pre>$log</pre><br>";
  if ($term) {
    die;
  }
}

function handle_exception($exception)
{
  $debug = print_r($exception, 1);
  echo "handle_exception--$debug<br>";
  die;
}

function handle_error($errno, $message, $file, $line)
{
  echo "handle_error:";
  echo "$file:$line-$message<br>";
  //die;
}

function handle_dummy($errno, $message, $file, $line)
{
  // do nothing
}

// 如果配置了数据库则载入
if (isset($db_config)) {
  $db = new db($db_config);
}

// 获取请求的地址兼容 SAE
$uri = '';
if (isset($_SERVER['PATH_INFO'])) {
  $uri = $_SERVER['PATH_INFO'];
} elseif (isset($_SERVER['ORIG_PATH_INFO'])) {
  $uri = $_SERVER['ORIG_PATH_INFO'];
} elseif (isset($_SERVER['QUERY_STRING'])) {
  $ss = explode('&', $_SERVER['QUERY_STRING']);
  $uri = $ss[0];
}

function render_url()
{
  // redirect abc/def to abc/def/ to make SEO url
  global $uri;
  if (strpos($uri, '.'))
    return;
  if (isset($_SERVER['QUERY_STRING']))
    return;
  if (substr($uri, -1) == '/')
    return;
  if ($uri == '')
    return;
  header("HTTP/1.1 301 Moved Permanently");
  header('Location:' . $_SERVER['REQUEST_URI'] . '/');
  exit(0);
}

render_url();

//echo ' 去除Magic_Quotes';
// if (get_magic_quotes_gpc()) { // Maybe would be removed in php6
//   function stripslashes_deep($value)
//   {
//     $value = is_array($value) ? array_map('stripslashes_deep', $value) : (isset($value) ?
//       stripslashes($value) : null);
//     return $value;
//   }
//   $_POST = stripslashes_deep($_POST);
//   $_GET = stripslashes_deep($_GET);
//   $_COOKIE = stripslashes_deep($_COOKIE);
// }

// 执行 config.php 中配置的url路由
foreach ($route_config as $key => $val) {
  $key = str_replace(':any', '([^\/.]+)', str_replace(':num', '([0-9]+)', $key));
  if (preg_match('#^' . $key . '#', $uri)) {
    $uri = preg_replace('#^' . $key . '#', $val, $uri);
  }
}

//echo ' 获取URL中每一段的参数';
$uri = rtrim($uri, '/');
$seg = explode('/', $uri);
$des_dir = $dir = '';

/* 依次载入控制器上级所有目录的架构文件 __construct.php
* 架构文件可以包含当前目录下的所有控制器的父类，和需要调用的函数 
*/

//echo 'look';
foreach ($seg as $cur_dir) {
  $des_dir .= $cur_dir . "/";
  if (is_file(APP . 'c' . $des_dir . 'base.php')) {
    require(APP . 'c' . $des_dir . 'base.php');
    $dir .= array_shift($seg) . '/';
  } else {
    break;
  }
}

/* 根据 url 调用控制器中的方法，如果不存在返回 404 错误
* 默认请求 class home->index()
*/
//echo  '默认请求 class home->index()';
$dir = $dir ? $dir : '/';
array_unshift($seg, null);
$class = isset($seg[1]) ? $seg[1] : 'main';
$method = isset($seg[2]) ? $seg[2] : 'index';

$path = APP . 'c' . $dir . $class . '.php';
if (!is_file($path)) {
  show_404('file:' . $path);
}
require($path);

if (!class_exists($class)) {
  show_404('class_not_exists:' . $class);
}
if (!method_exists($class, $method)) {
  show_404('method_not_exists:' . $class . $method);
}

function main()
{
  global $class;
  global $method;
  global $seg;

  set_error_handler('handle_error');
  set_exception_handler('handle_exception');

  try {
    $B2 = new $class();
    call_user_func_array(array(&$B2, $method), array_slice($seg, 3));
  } catch (Exception $e) {
    print_stack_trace();

    $log = print_r($e, true);
    echo "meet exception-<pre>$log</pre><br>";
  }
}

main();

/* B2 系统函数
* load($path,$instantiate) 可以动态载入对象，如：控制器、Model、库类等
* $path 是类文件相对 app 的地址
* $instantiate 为 False 时，仅引用文件，不实例化对象
* $instantiate 为数组时，数组内容会作为参数传递给对象 
*/
function &load($path, $instantiate = true)
{
  $param = false;
  if (is_array($instantiate)) {
    $param = $instantiate;
    $instantiate = true;
  }
  $file = explode('/', $path);
  $class_name = array_pop($file);
  $object_name = md5($path);

  static $objects = array();
  if (isset($objects[$object_name])) {
    return $objects[$object_name];
  }

  require(APP . $path . '.php');
  if ($instantiate == false) {
    $objects[$object_name] = true;
  } elseif ($param) {
    $objects[$object_name] = new $class_name($param);
  } else {
    $objects[$object_name] = new $class_name();
  }
  return $objects[$object_name];
}

// 取得 url 的片段，如 url 是 /abc/def/g/  seg(1) = abc
function seg($i)
{
  global $seg;
  return isset($seg[$i]) ? $seg[$i] : false;
}

/* 调用 view 文件
* function view($view,$param = array(),$cache = FALSE)
* $view 是模板文件相对 app/v/ 目录的地址，地址应去除 .php 文件后缀
* $param 数组中的变量会传递给模板文件
* $cache = TRUE 时，不像浏览器输出结果，而是以 string 的形式 return
*/
function view($view, $param = array(), $cache = false)
{
  if (!empty($param))
    extract($param);
  ob_start();
  if (is_file(APP . $view . '.php')) {
    require APP . $view . '.php';
  } else {
    echo 'view ' . $view . ' desn\'t exsit';
    return false;
  }
  // Return the file data if requested
  if ($cache === true) {
    $buffer = ob_get_contents();
    @ob_end_clean();
    return $buffer;
  }
}

// 写入日志
function write_log($format = 'none', ...$args)
{
  $dir = "c:/morelite/log/";
  if (!is_dir($dir)) {
    mkdir(iconv("UTF-8", "GBK", $dir), 0777, true);
  }

  $file = $dir . 'webui.' . date('Y.m.d') . '.log';
  $text = date("H:i:s\t") . "$format\n";
  file_put_contents($file, $text, FILE_APPEND);
}

//echo ' 显示404错误';
function show_404($msg)
{ //显示 404 错误
  header("HTTP/1.1 404 Not Found");
  // 调用 模板 v/404.php
  view('v/404');
  echo "$msg";
  exit(1);
}

/* 系统类 */
// 抽象的控制器类，所有的控制器均基层此类或者此类的子类
class c
{
  function index()
  {
    echo "core version: " . SVN_VERSION . " ";
  }
}

class db
{
  var $conn;
  var $last_query;

  function __construct($conf)
  {
    //$this->init($conf);
  }

  function init($conf)
  {
    $this->conn = mysqli_connect($conf['host'], $conf['user'], $conf['password']);
    if (!$this->conn) {
      die('mysqli_error ' . mysqli_error($this->conn));
      return false;
    }

    $db_selected = mysqli_select_db($this->conn, $conf['default_db']);
    if (!$db_selected) {
      die('mysqli_error ' . mysqli_error($this->conn));
    }
    mysqli_query($this->conn, 'set names utf8');
  }

  //执行 query 查询，如果结果为数组，则返回数组数据
  function query($query)
  {
    //echo '<br>'.$query.'<br>';
    $ret = array();

    $this->last_query = $query;
    $result = mysqli_query($this->conn, $query);
    if (!$result) {
      //echo print_stack_trace();
      echo "DB Error, could not query the database\n";
      echo 'MySQL Error: ' . mysqli_error($this->conn);
      echo 'Error Query: ' . $query;
      exit();
    }

    if ($result === true)
      return true;
    while ($record = mysqli_fetch_assoc($result)) {
      $ret[] = $record;
    }
    mysqli_free_result($result);
    return $ret;
  }

  function insert_id()
  {
    return mysqli_insert_id($this->conn);
  }

  // 执行多条 SQL 语句
  function muti_query($query)
  {
    $sq = explode(";\n", $query);
    foreach ($sq as $s) {
      if (trim($s) != '')
        $this->query($s);
    }
  }

  function escape($str)
  {
    return mysqli_real_escape_string($this->conn, $str);
  }
}

// 模块类，封装了通用CURD模块操作，建议所有模块都继承此类。
class m
{
  var $db;
  var $table;
  var $fields;
  var $key;
  var $key2; // 额外加的一个key

  function __construct()
  {
    global $db;
    $this->db = $db;
    $this->key = 'id';
    $this->key2 = '';
  }

  public function __call($name, $arg)
  {
    return call_user_func_array(array($this, $name), $arg);
  }

  // 最大keyid
  function getMaxKeyId()
  {
    $sql = "select max(" . $this->key . ") as n from `$this->table`";
    $res = $this->db->query($sql);
    return $res[0]['n'];
  }

  // 向数据库插入数组格式数据
  function add($elem)
  {
    //write_log('m::add\r\n');

    $query_list = array();
    if (!$elem) {
      die("m::add invalid params");
      //$elem = $_POST;
      die;
    }
    foreach ($this->fields as $f) {
      if (isset($elem[$f])) {
        $elem[$f] = $this->db->escape($elem[$f]);
        $query_list[] = "`$f` ";
        $query_list1[] = "'$elem[$f]'";
      }
    }
    $query = "insert into `$this->table` (" . implode(',', $query_list) .
      ") values (" . implode(',', $query_list1) . ")";
    $this->db->query($query);
    return $this->db->insert_id();
  }

  // 删除某一条数据
  function del($id)
  {
    $this->db->query("delete from `$this->table` where " . $this->key . "='$id'");
  }

  // 更新数据
  function update($id, $elem = false)
  {
    $query_list = array();
    if (!$elem)
      $elem = $_POST;
    foreach ($this->fields as $f) {
      if (isset($elem[$f])) {
        $elem[$f] = $this->db->escape($elem[$f]);
        $query_list[] = "`$f` = '$elem[$f]'";
      }
    }

    $query = "update `$this->table` set " . implode(',', $query_list) .
      " where " . $this->key . " ='$id'";
    $this->db->query($query);
  }

  // 统计数量
  function count($where = '')
  {
    $res = $this->db->query("select count(*) as a from `$this->table` where 1 $where");
    return $res[0]['a'];
  }

  // 统计数量
  function maxx($id, $where = '')
  {
    $res = $this->db->query("select max($id) as a from `$this->table` where 1 $where");

    //echo "maxx<br><pre>";
    //print_r($res);
    //echo "</pre>";
    //die;
    return $res[0]['a'];
  }

  // 类别
  function distinct($type, $where = '')
  {
    $res = $this->db->query("select distinct($type) from `$this->table` where 1 $where");
    return $res;
  }

  // 计算总数
  function sum($where = '', $key = '')
  {
    $res = $this->db->query("select sum($key) as a from `$this->table` where 1 $where");
    $t = $res[0]['a'];
    return $t == '' ? 0 : $t;
  }

  // 计算总数
  function table_sum($table, $where = '', $key = '')
  {
    $res = $this->db->query("select sum($key) as a from `$table` where 1 $where");
    $t = $res[0]['a'];
    return $t == '' ? 0 : $t;
  }

  /* get($id) 取得一条数据 或
    *  get($postquery = '',$cur = 1,$psize = 30) 取得多条数据
    */
  function get()
  {
    //print_stack_trace();
    $args = func_get_args();
    if (is_numeric($args[0]))
      return $this->__call('get_one', $args);
    return $this->__call('get_many', $args);
  }

  function get_one($id)
  {
    $id = is_numeric($id) ? $id : 0;
    $res = $this->db->query("select * from `$this->table` where " . $this->key . "='$id'");
    if (isset($res[0]))
      return $res[0];
    return false;
  }

  function get_many($postquery = '', $cur = 1, $psize = 330)
  {
    $cur = $cur > 0 ? $cur : 1;
    $start = ($cur - 1) * $psize;
    $query = "select * from `$this->table` where 1 $postquery limit $start , $psize";
    return $this->db->query($query);
  }

  function check_db_exist($table)
  {
    // `devdb`.`_dev_data.$auth`
    $arr = explode('`.`', $table);
    $arr[0] = trim($arr[0], "`");
    $arr[1] = trim($arr[1], "`");

    $sql = "SHOW TABLES LIKE '" . $table . "'";
    $sql = "SELECT count(*) as c FROM `information_schema`.`tables` " .
      "WHERE table_schema = '" . $arr[0] . "' AND table_name = '" . $arr[1] . "';";
    $ret = $this->db->query($sql);

    return $ret[0]['c'] > 0 ? true : false;
  }
}
