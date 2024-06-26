<?php
/* 
** # DO NOT EDIT THIS FILE!  
** # Auto generated from: 
** # D:\doc\04.HMI协议（LARK）
** # 2024/6/14 10:35:23 
**/





/************BSP基础************/
/* @brief BSP重新初始化
 * @param data1(4byte)-  @default [0]
 */
define('REG_BSP_INIT',                           1 ); /*RW*/

/* @brief BSP复位
 * @param data1(4byte)-  @default [0]
 */
define('REG_BSP_RESET',                          2 ); /*RW*/

/* @brief 串口波特率
 * @param data1(4byte)-  @default [115200]
 */
define('REG_UART1_BAUD_RATE',                    3 ); /*RW*/

/* @brief http server功能使能
 * @param data1(4byte)-  @default [1]
 */
define('REG_HTTP_SERVER_ENABLE',                 4 ); /*RW*/


/* @brief 设备ID，可用于测试及数据记录唯一标识
 * @param data1(4byte)-  @default [0]
 */
define('REG_DEVICE_ID1',                         6 ); /*RW*/

/* @brief 设备ID，可用于测试及数据记录唯一标识
 * @param data1(4byte)-  @default [0]
 */
define('REG_DEVICE_ID2',                         7 ); /*RW*/


/* @brief 点云数据发送使能
 * @param data1(4byte)-  @default [1]
 */
define('REG_UDP_TRANS_DISABLE',                  9 ); /*RW*/

/* @brief 设置为1命令通道静默，重启后恢复通讯
 *  点云性能测试时可屏蔽相关报文回传
 *  (通道还可接受命令，但无返回）
 * @param data1(4byte)-  @default [0]
 */
define('REG_CMD_TRANS_DISABLE',                  10 ); /*RW*/

/* @brief RTC时钟计数
 * @param data1(4byte)-  @default [0]
 */
define('REG_RTC_TICK',                           11 ); /*RW*/

/* @brief 写配置
 * @param data1(4byte)-  @default [0]
 */
define('REG_CONFIG_WRITE',                       12 ); /*RW*/

/* @brief 读配置
 * @param data1(4byte)-  @default [0]
 */
define('REG_CONFIG_LOAD',                        13 ); /*RW*/

/* @brief 所有参数还原为默认
 * @param data1(4byte)-  @default [0]
 */
define('REG_CONFIG_DEFAULT',                     14 ); /*RW*/

/* @brief 状态监控，将定时查询状态
 * @param data1(4byte)-  @default [0]
 */
define('REG_STATUS_LISTEN',                      15 ); /*RW*/

/* @brief 记录状态到csv
 * @param data1(4byte)-  @default [0]
 */
define('REG_STATUS_RECORD',                      16 ); /*RW*/


/* @brief switch_work_mode()
 *  CLOUDMODEDMA   = 0,
 *  RAWMODEDMA1    = 1,// 附加通道参数16bit
 *  RAWMODEDMA2    = 2,// 附加通道参数16bit
 *  TORAWMODE1     = 3,// HOST忽略
 *  TORAWMODE2     = 4,// HOST忽略
 *  TOCLOUDMODE    = 5,// HOST忽略
 * @param data1(4byte)-  @default [0]
 */
define('REG_WORK_MODE',                          18 ); /*RW*/

/* @brief 0：电机使能命令，value值[0-1],0--关闭所有电机运动，1--使能所有电机运动；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_EN_DIS',                       19 ); /*RW*/

/* @brief 1：振镜停命令，uint16类型value，振镜停在value数值的位置；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VSTOP_MODE',                   20 ); /*RW*/

/* @brief 2：振镜继续执行默认运动状态，无value参数；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VCONTIBUE_MODE',               21 ); /*RW*/

/* @brief 4：转镜停止命令；无value参数；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_HSTOP_MODE',                   22 ); /*RW*/

/* @brief 5：转镜启动命令；无value参数；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_HCONTIBUE_MODE',               23 ); /*RW*/

/* @brief 6：转镜offset设置命令，value参数uint16类型；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_H_OFFSET',                     24 ); /*RW*/

/* @brief 13：读取振镜和转镜位置数值，uint32类型，16-31bits--转镜角度，0-15bits--振镜角度；
 * @param data1(4byte)-  @default [16]
 */
define('REG_MOTOR_ALL_POSITIONS',                25 ); /*RW*/

/* @brief 14：振镜trig-offset设置命令，value参数是uint16类型；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VERTICAL_TRIG_OFFSET',         26 ); /*RW*/

/* @brief 15：数值输出模式控制，value参数[0-1],0--转镜输出120度有效范围内数据，1--输出所有数据；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_ALWAYS_OUTPUT_MODE',           27 ); /*RW*/

/* @brief 16：振镜工作模式设置，value参数[0-1], 0--振镜与转镜协调工作，1--振镜独立工作；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VHMOTOR_WORK_MODE',            28 ); /*RW*/

/* @brief 17：垂直角度在转镜5个镜面的补偿值，5个int32类型的参数；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VMOTOR_OFFSET_BY_MIRROR0',     29 ); /*RW*/

/* @brief 镜面垂直角度补偿1
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VMOTOR_OFFSET_BY_MIRROR1',     30 ); /*RW*/

/* @brief 镜面垂直角度补偿2
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VMOTOR_OFFSET_BY_MIRROR2',     31 ); /*RW*/

/* @brief 镜面垂直角度补偿3
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VMOTOR_OFFSET_BY_MIRROR3',     32 ); /*RW*/

/* @brief 镜面垂直角度补偿4
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VMOTOR_OFFSET_BY_MIRROR4',     33 ); /*RW*/

/* @brief 18：水平角度在转镜5个镜面的补偿值，5个int32类型的参数；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_HMOTOR_OFFSET_BY_MIRROR0',     34 ); /*RW*/

/* @brief 镜面水平角度补偿1
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_HMOTOR_OFFSET_BY_MIRROR1',     35 ); /*RW*/

/* @brief 镜面水平角度补偿2
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_HMOTOR_OFFSET_BY_MIRROR2',     36 ); /*RW*/

/* @brief 镜面水平角度补偿3
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_HMOTOR_OFFSET_BY_MIRROR3',     37 ); /*RW*/

/* @brief 镜面水平角度补偿4
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_HMOTOR_OFFSET_BY_MIRROR4',     38 ); /*RW*/

/* @brief 19：转镜电机速度设置，value参数值：32, 30, 25, 20, 16, 15, 10, 8, 5；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_HORIZONTAL_MIRROR_SPEED',      39 ); /*RW*/

/* @brief 20：振镜每帧位置数量设置：120线设置15，80线设置10；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VERTICAL_MIRROR_DEGREE_NUM',   40 ); /*RW*/

/* @brief 21：pattern扫描模式设置：0--三角波扫描，1--锯齿波扫描，2--交叉扫描；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_PETTERN_WORK_MODE',            41 ); /*RW*/

/* @brief 25：PL输出数据bypass水平转镜设置命令：0--bypass无效，1--bypass有效；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_MOVE_HBYPASS',                 42 ); /*RW*/

/* @brief 26：PL输出数据bypass垂直振镜设置命令：0--bypass无效，1--bypass有效；
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_MOVE_VBYPASS',                 43 ); /*RW*/

/* @brief set_snr_enc
 * @param data1(4byte)-  @default [0]
 */
define('REG_THRESHOLD',                          44 ); /*RW*/

/* @brief 可变增益放大器
 * @param data1(4byte)-  @default [0]
 */
define('REG_VGA_DAC5311',                        45 ); /*RW*/

/* @brief fml_tia_dac5311_write
 * @param data1(4byte)-  @default [0]
 */
define('REG_TIA_DAC5311',                        46 ); /*RW*/

/* @brief (16--30)15 bits是ddc1， 
 *  (0--14)15bits是ddc0，
 * @param data1(4byte)-  @default [0]
 */
define('REG_FFT_START_BIN',                      47 ); /*RW*/

/* @brief (16--30)15 bits是ddc1， 
 *  (0--14)15bits是ddc0，
 * @param data1(4byte)-  @default [0]
 */
define('REG_FFT_CUTOFF_BIN',                     48 ); /*RW*/

/* @brief 0：disable go-far and movesum；
 *  2：enable only movesum；
 *  3：enable go-cfar and movesum
 * @param data1(4byte)-  @default [0]
 */
define('REG_FFT_PEAK_CMD',                       49 ); /*RW*/

/* @brief 信号功率截断起始位, [0--15]
 * @param data1(4byte)-  @default [0]
 */
define('REG_POWER_START_BIT',                    50 ); /*RW*/

/* @brief set_edfa_power
 * @param data1(4byte)-  @default [0]
 */
define('REG_EDFA_POWER',                         51 ); /*RW*/

/* @brief 清除edfa告警
 * @param data1(4byte)-  @default [0]
 */
define('REG_EDFA_WARNING_CLEAR',                 52 ); /*RW*/

/* @brief 使能edfa pump
 * @param data1(4byte)-  @default [1]
 */
define('REG_EDFA_PUMP_ENABLE',                   53 ); /*RW*/

/* @brief PCLD版本定义，为0时默认选择最新（LARK32）：
 *  1:FMLB
 *  2:LARK16
 *  3:LARK32
 * @param data1(4byte)-  @default [0]
 */
define('REG_PCLD_VERSION',                       54 ); /*RW*/

/* @brief 16k--3536，4k--884, 2k--442
 * @param data1(4byte)-  @default [3536]
 */
define('REG_HIGHBAND_OFFSET',                    55 ); /*RW*/

/* @brief 8--40，实际设置数值*8
 * @param data1(4byte)-  @default [20]
 */
define('REG_STCFAR_THR',                         56 ); /*RW*/

/* @brief 码盘起始码
 * @param data1(4byte)-  @default [663]
 */
define('REG_CODEWHEEL_START',                    57 ); /*RW*/

/* @brief 码盘截至码
 * @param data1(4byte)-  @default [2663]
 */
define('REG_CODEWHEEL_STOP',                     58 ); /*RW*/




/************设备统计信息************/
/* @brief 电机控制模块版本
 * @param data1(4byte)-  @default [0]
 */
define('REG_MOTOR_VERSION',                      128 ); /*R*/

/* @brief 硬件版本号
 * @param data1(4byte)-  @default [0]
 */
define('REG_HARDWARE_VERSION',                   129 ); /*R*/

/* @brief BSP APP版本号
 * @param data1(4byte)-  @default [0]
 */
define('REG_APP_VERSION',                        130 ); /*R*/

/* @brief FSBL版本号（默认与APP一致）
 * @param data1(4byte)-  @default [0]
 */
define('REG_BOOT_VERSION',                       131 ); /*R*/

/* @brief FPGA版本号0
 * @param data1(4byte)-  @default [0]
 */
define('REG_FPGA_VERSION0',                      132 ); /*R*/

/* @brief FPGA版本号1
 * @param data1(4byte)-  @default [0]
 */
define('REG_FPGA_VERSION1',                      133 ); /*R*/

/* @brief FPGA版本号2
 * @param data1(4byte)-  @default [0]
 */
define('REG_FPGA_VERSION2',                      134 ); /*R*/

/* @brief FPGA ID
 * @param data1(4byte)-  @default [0]
 */
define('REG_FPGA_ID',                            135 ); /*R*/

/* @brief Flash ID
 * @param data1(4byte)-  @default [0]
 */
define('REG_FLASH_ID',                           136 ); /*R*/

/* @brief First error
 * @param data1(4byte)-  @default [0]
 */
define('REG_BSP_FIRST_ERROR',                    137 ); /*R*/

/* @brief Last error
 * @param data1(4byte)-  @default [0]
 */
define('REG_BSP_LAST_ERROR',                     138 ); /*R*/

/* @brief 初始化错误码
 * @param data1(4byte)-  @default [0]
 */
define('REG_BSP_INIT_ERROR',                     139 ); /*R*/

/* @brief On Chip Temperature
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_TEMP',                        140 ); /*R*/

/* @brief Temperature Remote
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_TEMP_REMTE',                  141 ); /*R*/

/* @brief SUPPLY1 VCC_PSINTLP
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY1',                     142 ); /*R*/

/* @brief SUPPLY2 VCC_PSINTFP
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY2',                     143 ); /*R*/

/* @brief SUPPLY3 VCC_PSAUX
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY3',                     144 ); /*R*/

/* @brief SUPPLY4 VCC_PSDDR_504
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY4',                     145 ); /*R*/

/* @brief SUPPLY5 VCC_PSIO3_503
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY5',                     146 ); /*R*/

/* @brief SUPPLY6 VCC_PSIO0_500
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY6',                     147 ); /*R*/

/* @brief SUPPLY7 VCC_PSIO1_501
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY7',                     148 ); /*R*/

/* @brief SUPPLY8 VCC_PSIO2_502
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY8',                     149 ); /*R*/

/* @brief SUPPLY9 PS_MGTRAVCC
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY9',                     150 ); /*R*/

/* @brief SUPPLY10 PS_MGTRAVTT
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY10',                    151 ); /*R*/

/* @brief VCCAMS
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_VCCAMS',                      152 ); /*R*/

/* @brief VCC_PSLL0
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_VCC_PSLL0',                   153 ); /*R*/

/* @brief VCC_PSLL3
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_VCC_PSLL3',                   154 ); /*R*/

/* @brief VCCINT
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_VCCINT',                      155 ); /*R*/

/* @brief VCCBRAM
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_VCCBRAM',                     156 ); /*R*/

/* @brief VCCAUX
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_VCCAUX',                      157 ); /*R*/

/* @brief VCC_PSDDRPLL
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_VCC_PSDDRPLL',                158 ); /*R*/

/* @brief VP/VN Dedicated analog inputs
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_VPVN',                        159 ); /*R*/

/* @brief VREFP
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_VREFP',                       160 ); /*R*/

/* @brief VREFN
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_VREFN',                       161 ); /*R*/

/* @brief Supply Calib Data Reg
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_SUPPLY_CALIB',                162 ); /*R*/

/* @brief ADC Offset Channel Reg
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_ADC_CALIB',                   163 ); /*R*/

/* @brief Gain Error Channel Reg 
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_GAINERR_CALIB',               164 ); /*R*/

/* @brief Channel number for 1st Aux Channel
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_AUX_MIN',                     165 ); /*R*/

/* @brief Channel number for Last Aux channel
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_AUX_MAX',                     166 ); /*R*/

/* @brief DDRPHY_VREF
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_DDRPHY_VREF',                 167 ); /*R*/

/* @brief PSGT_AT0
 * @param data1(4byte)-  @default [0]
 */
define('REG_XSM_CH_RESERVE1',                    168 ); /*R*/

/* @brief UDP发送速率
 * @param data1(4byte)-  @default [0]
 */
define('REG_UDP_SEND_RATE',                      169 ); /*R*/

/* @brief DMA失败计数
 * @param data1(4byte)-  @default [0]
 */
define('REG_DMA_FAIL_CNT',                       170 ); /*R*/

/* @brief COMMAND TCP连接数量
 * @param data1(4byte)-  @default [0]
 */
define('REG_CMD_CONNTECTIONS',                   171 ); /*R*/

/* @brief CMD通道已接收的字节数
 * @param data1(4byte)-  @default [0]
 */
define('REG_CMD_RECV_BYTES',                     172 ); /*R*/

/* @brief CMD通道已发送的字节数
 * @param data1(4byte)-  @default [0]
 */
define('REG_CMD_SEND_BYTES',                     173 ); /*R*/

/* @brief 横向电机速度*1000(MOTO_HRZ_SPEED_ADDR)
 * @param data1(4byte)-  @default [0]
 */
define('REG_HORZ_MOTOR_SPEED',                   174 ); /*R*/

/* @brief 电机模块版本
 * @param data1(4byte)-  @default [ 0 ]
 */
define('REG_MOTOR_MODULE_VERSION',               175 ); /*R*/

/* @brief 电机模块各个状态
 * @param data1(4byte)-  @default [ 0 ]
 */
define('REG_MOTOR_MODULE_STATUS',                176 ); /*R*/


/* @brief 主板9V供电电压，电源板传感器pac1954采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_MAINBOARD_9V',                     200 ); /*R*/

/* @brief 设备12V供电电压，电源板传感器pac1954采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_POWERIN_12V',                      201 ); /*R*/

/* @brief 放大器6.6V供电电压，电源板传感器pac1954采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_AMPLIFIER_6V6',                    202 ); /*R*/

/* @brief 电机25V供电电压，电源板传感器pac1954采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_MOTOR_25V',                        203 ); /*R*/

/* @brief 主板9V供电电流，电源板传感器pac1954采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_I_MAINBOARD_9V',                     204 ); /*R*/

/* @brief 设备12V供电电流，电源板传感器pac1954采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_I_POWERIN_12V',                      205 ); /*R*/

/* @brief 放大器6.6V供电电流，电源板传感器pac1954采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_I_AMPLIFIER_6V6',                    206 ); /*R*/

/* @brief 电机25V供电电流，电源板传感器pac1954采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_I_MOTOR_25V',                        207 ); /*R*/

/* @brief 主板 gtx电压，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_GTX',                              208 ); /*R*/

/* @brief 主板ps core电压，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_PS_CORE',                          209 ); /*R*/

/* @brief 主板pl core电压，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_PL_CORE',                          210 ); /*R*/

/* @brief 主板pl端1.8v io电压，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_PL_1V8IO',                         211 ); /*R*/

/* @brief 主板ps端3.3v io电压，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_PS_3V3IO',                         212 ); /*R*/

/* @brief 主板3.3V ldo电压，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_MB_3V3LDO',                        213 ); /*R*/

/* @brief 主板3.3V buck电压，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_V_MB_3V3BUCK',                       214 ); /*R*/

/* @brief 振镜温度，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_VERTICAL_MOTOR_TEMP',                215 ); /*R*/

/* @brief 电源板温度，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_POWERBOARD_TEMP',                    216 ); /*R*/

/* @brief 主板ADC温度，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_MAINBOARD_ADC_TEMP',                 217 ); /*R*/

/* @brief 主板FPGA温度，PL采集
 * @param data1(4byte)-  @default [0]
 */
define('REG_MAINBOARD_FPGA_TEMP',                218 ); /*R*/


/* 寄存器总数量 */
define('BSP_REG_CNT',            219 );




