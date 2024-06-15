<?php
/* 
** # DO NOT EDIT THIS FILE!  
** # Auto generated from: 
** # D:\t\17.LARK\00.doc\03.HMI协议
** # 2024/5/10 9:54:57 
**/





/************基础参数************/
/* @brief RPC心跳，返回json数据
 * @param data1(4byte)-  @default [0]
 */
define('RPC_HEART_BEAT',                         1 ); /*RW*/

/* @brief RPC服务重启
 * @param data1(4byte)-  @default [0]
 */
define('RPC_REBOOT',                             2 ); /*RW*/

/* @brief 寄存器SET
 * @param data1(4byte)-设备ID  @default [0]
 */
define('RPC_REG_SET',                            3 ); /*RW*/

/* @brief 寄存器GET
 * @param data1(4byte)-设备ID  @default [0]
 */
define('RPC_REG_GET',                            4 ); /*RW*/

/* @brief 寄存器SAVE
 * @param data1(4byte)-设备ID  @default [0]
 */
define('RPC_REG_SAVE',                           5 ); /*RW*/

/* @brief 寄存器列表
 * @param data1(4byte)-设备ID  @default [0]
 */
define('RPC_REG_LIST',                           6 ); /*RW*/

/* @brief 寄存器重新加载
 * @param data1(4byte)-设备ID  @default [0]
 */
define('RPC_REG_RELOAD',                         7 ); /*RW*/

/* @brief 寄存器组获取
 * @param data1(4byte)-设备ID  @default [0]
 */
define('RPC_REG_GROUP',                          8 ); /*RW*/

/* @brief 配置文件SET
 * @param data1(4byte)-section  @default [0]
 */
define('RPC_CONFIG_SET',                         9 ); /*RW*/

/* @brief 配置文件GET
 * @param data1(4byte)-section  @default [0]
 */
define('RPC_CONFIG_GET',                         10 ); /*RW*/

/* @brief 配置文件SAVE
 * @param data1(4byte)-  @default [0]
 */
define('RPC_CONFIG_SAVE',                        11 ); /*RW*/

/* @brief 端口列表
 * @param data1(4byte)-类型定义  @default [0]
 */
define('RPC_PORT_LIST',                          12 ); /*RW*/

/* @brief 通道列表
 * @param data1(4byte)-类型定义  @default [0]
 */
define('RPC_CHANNEL_LIST',                       13 ); /*RW*/

/* @brief 图表数据
 * @param data1(4byte)-设备ID  @default [0]
 */
define('RPC_CHART_DATA',                         14 ); /*RW*/

/* @brief 执行校准
 * @param data1(4byte)-类型定义  @default [0]
 */
define('RPC_CALIBRATION',                        15 ); /*RW*/

/* @brief 噪底采集命令
 * @param data1(4byte)-通道号  @default [0]
 */
define('RPC_NOISE_CMD',                          16 ); /*RW*/

/* @brief 噪底数据显示-按通道
 * @param data1(4byte)-  @default [0]
 */
define('RPC_NOISE_DATA',                         17 ); /*RW*/

/* @brief PCLD命令
 * @param data1(4byte)-类型定义  @default [0]
 */
define('RPC_PCLD_CMD',                           18 ); /*RW*/

/* @brief 主面板统计数据
 * @param data1(4byte)-类型定义  @default [0]
 */
define('RPC_DASHBOARD',                          19 ); /*RW*/

/* @brief 数值转换
 * @param data1(4byte)-  @default [0]
 */
define('RPC_TRANS',                              20 ); /*RW*/

/* @brief IAP功能
 * @param data1(4byte)-  @default [0]
 */
define('RPC_IAP',                                21 ); /*RW*/

/* @brief laserId列表
 * @param data1(4byte)-  @default [0]
 */
define('RPC_LASER_ID_LIST',                      22 ); /*RW*/

/* @brief 导入文件
 * @param data1(4byte)-  @default [0]
 */
define('RPC_UPLOAD',                             23 ); /*RW*/

/* @brief 获取本地日志
 * @param data1(4byte)-  @default [0]
 */
define('RPC_LOG',                                24 ); /*RW*/


/************状态信息************/
/* @brief RPC板块版本号
 * @param data1(4byte)-  @default [0]
 */
define('RPC_VERSION',                            129 ); /*R*/

/* @brief 点云数据列表
 * @param data1(4byte)-选择读取源:0:Source;1:Filter;2:Right;3:Selected  @default [0]
 */
define('RPC_PCD_LIST',                           130 ); /*R*/

/* @brief 点云数据(pcd)
 * @param data1(4byte)-frameId  @default [0]
 */
define('RPC_PCD_DATA',                           131 ); /*R*/

/* @brief 状态数据
 * @param data1(4byte)-  @default [0]
 */
define('RPC_STATUS_DATA',                        132 ); /*R*/


















/* 寄存器总数量 */
define('RPC_CMD_CNT',            133 );




