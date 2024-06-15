<?php

/** $Id: rpc_m.php 2128 2023-08-14 02:29:47Z zhangxh $ */

//error_reporting(E_ERROR); // 模块关闭debug输出
class sock_m
{
  var $socket;
  var $verbose;
  var $alive;
  var $sockConfig;

  function __construct()
  {
    $this->sockConfig = array(
      "server"    => "127.0.0.1", // server adress
      "port"      => RPC_CMD_PORT,
      "domain"    => AF_INET,
      "type"      => SOCK_STREAM, // TCP socket type (Default)
      "protocol"  => getprotobyname(SOL_TCP), // TCP protocol
      "readtype"  => PHP_NORMAL_READ, // Reads the return string
    );

    $this->verbose      = 0;
    $this->alive        = false;

    $this->connect();
  }

  function __destruct()
  {
    $this->disconect();
  }

  function isConnected()
  {
    return (isset($this->socket) and $this->alive == 1);
  }

  private function tryConnect($timeout)
  {
    do {
      // if (!isRpcOnline()) {
      //     return null;
      // }

      $sock = socket_create(
        $this->sockConfig["domain"],
        $this->sockConfig["type"],
        $this->sockConfig["protocol"]
      );

      if (socket_connect(
        $sock,
        $this->sockConfig["server"],
        $this->sockConfig["port"]
      )) {
        return $sock;
      }
    } while (0);
    socket_close($sock);

    return null;
  }

  private function connect()
  {
    if ($this->isConnected()) {
      //write_log("sock_m::connect skip-------------\r\n");
      return;
    }

    // 关闭错误提示
    $elevel = error_reporting(0);
    $ofn = set_error_handler('handle_dummy');

    // 尝试连接
    $socket = $this->tryConnect(2);

    // 恢复错误提示
    error_reporting($elevel);
    set_error_handler($ofn);

    // 错误处理
    $this->socket = $socket;
    if ($socket === null) {
      $this->alive = 0;
      return;
    }

    // 接收超时设置
    socket_set_option(
      $this->socket,
      SOL_SOCKET,
      SO_RCVTIMEO,
      array("sec" => 0, "usec" => 500)
    );
    // 发送超时设置
    socket_set_option(
      $this->socket,
      SOL_SOCKET,
      SO_SNDTIMEO,
      array("sec" => 0, "usec" => 500)
    );
    $this->alive = 1;
  }

  function disconect()
  {
    if ($this->isConnected()) {
      socket_close($this->socket);
    }
    $this->alive = false;
  }

  function sendCmd($command)
  {
    $t0 = time() + intval(microtime());
    if (!$this->isConnected()) {
      return $this->returnUnconnect();
    }

    $res = socket_write($this->socket, $command, strlen($command));
    if ($res == false) {
      return $this->returnUnconnect(404, "socket write failure");
    }

    $buff = '';
    while ($sRead = socket_read($this->socket, 16384, $this->sockConfig["readtype"])) {
      $buff .= $sRead;

      // FIXME
      if (strpos($sRead, "\r"))
        break;
    }
    $buff .= "\r\n";
    //$buff = trim($buff, "\r\n ");
    $t1 = time() + intval(microtime()) - $t0;
    //write_log("sock_m::sendCmd leave--tick($t1)--$buff\r\n");
    return $buff;
  }

  function returnUnconnect($code = 404, $err = "rpc socket disconnnected")
  {
    return "{\"code\":$code,\"desc\":\"$err\"}";
  }
}

/*****************************************************************************/
class rpc_m
{
  var $sock;

  function __construct()
  {
    $this->sock = new sock_m();
  }

  function __destruct()
  {
  }

  public static function instance()
  {
    return new rpc_m();
  }

  function isConnected()
  {
    return (isset($this->sock) and $this->sock->isConnected());
  }

  function returnUnconnect($code = 404, $err = "rpc socket disconnnected")
  {
    return "{\"code\":$code,\"desc\":\"$err\"}";
  }

  function object2array(&$object)
  {
    $object = json_decode(json_encode($object), true);
    return $object;
  }

  function version()
  {
    return $this->exec(RPC_VERSION);
  }

  // int参数
  function exec($cmd, $idata0 = 0, $idata1 = 0, $data2 = 0, $data3 = 0)
  {
    if (!$this->isConnected()) {
      return $this->returnUnconnect();
    }

    $command = "{\"cmd\":$cmd, \"argv0\":$idata0, \"argv1\":$idata1, \"argv2\":$data2, \"argv3\":$data3}\r\n";
    $buff = $this->sock->sendCmd($command);

    return $buff;
  }

  // int参数
  function exeReg($cmd, $dev = 0, $addr = 0, $data2 = 0, $data3 = 0)
  {
    if (!$this->isConnected()) {
      return $this->returnUnconnect();
    }

    $command = "{\"cmd\":$cmd, \"argv0\":$dev, \"argv1\":\"$addr\", \"argv2\":$data2, \"argv3\":$data3}\r\n";
    $buff = $this->sock->sendCmd($command);

    return $buff;
  }

  // 字符串参数
  function exes($cmd, $argv)
  {
    if (!$this->isConnected()) {
      return $this->returnUnconnect();
    }

    // argv["section"] = "aa";
    // argv["key"] = "k";

    $text = "";
    foreach ($argv as $k => $v)
    {
      $text .= "\"$k\":\"$v\",";
    }
    $text .= "\"dummyArgv\":\"dummy\"";

    $command = "{\"cmd\":$cmd, $text}\r\n";
    $buff = $this->sock->sendCmd($command);
    //$buff = gbk2utf($buff);
    
    return $buff;
  }

}


//error_reporting(E_ERROR); // 模块关闭debug输出
