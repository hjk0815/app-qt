<?php
/** $Id: defines.php 2128 2023-08-14 02:29:47Z zhangxh $ */

// 样品版本
define('SAMPLE_DEFAULT',        0);
define('SAMPLE_FMLB',           1);
define('SAMPLE_LARK16',         2);
define('SAMPLE_LARK32',         3);

// 系统窗口
define('MENU_STATUS',           1);
define('MENU_PROP',             2);
define('MENU_SYSTEM',           3);
define('MENU_CALIB',            4);
define('MENU_TOOLS',            5);
define('MENU_POINTS',           6);

// props
define('PROP_HOST',             1);
define('PROP_BSP',              2);
define('PROP_CHANNELS',         3);
define('PROP_FPGA',             4);
define('PROP_DEBUG',            5);

// tools
define('TOOL_SLIDER',           1);
define('TOOL_NOISE',            2); # 噪底工具 
define('TOOL_PCLD',             3); #
define('TOOL_MOTOR',            4);
define('TOOL_LASERID',          5);
define('TOOL_IAP',              6);
define('TOOL_ALGORITHM',        7);

define('NOISE_CAPTURE',         11);
define('NOISE_LIST',            12);
define('NOISE_CONFIG',          13);
define('NOISE_SHIFT',           14);

//
define('STATUS_TEMPERATURE',    1);
define('STATUS_NETWORK',        2);
define('STATUS_MAIN',           3);
define('STATUS_VOLTAGE',        4);

//
define('SYSTEM_REGS',           1);

//
define('CHART_TEMPEATURE',      1);
define('CHART_NETWORK',         2);
define('CHART_VOLTAGE',         3);

//
define('AUTH_GUEST',            0);
define('AUTH_USER',             2);
define('AUTH_ADMIN',            3);
define('AUTH_ENGINEER',         4);

define('BRME_WATCH',            0x01);
define('BRME_VOLTAGE',          0x02);
define('BRME_TEMPERATURE',      0x04);
define('BRME_NETWORK',          0x08);
define('BRME_RAW_DATA',         0x10);
define('BRME_COMBINE',          0x20);
define('BRME_EVB',              0x40);
define('BRME_SLIDER',           0x80);

define('NCE_START_CAP',         1);
define('NCE_STOP_CAP',          2);
define('NCE_DOWNLOAD_CONFIG',   3);
define('NCE_SAVE_CONFIG',       4);
define('NCE_CHANGE_ITEM',       5);
define('NCE_SET_CALCULATE',     6);
define('NCE_SET_BIN_DDC0',      7);
define('NCE_SET_BIN_DDC1',      8);

define('NCE_LIST',              1);
define('NCE_CHART',             2);
define('NCE_SHIFT',             3);
define('NCE_CAPTURE',           4);

define('PCLD_DOWNLOAD_CONFIG',  1);
define('PCLD_EXPORT_CONFIG',    2);
define('PCLD_RELOAD',           3);

define('DCMD_RELOAD',           1);
define('DCMD_UPDATE',           2);

define('UPLOAD_PATTERN',        1);
define('UPLOAD_F2R',            2);
define('UPLOAD_LASER_ID',       3);

//
define('IAP_STATUS',            1);
define('IAP_UPLOAD',            2);
define('IAP_TERM',              3);
define('IAP_REBOOT',            4);

define('IFE_BOOTIMG',           1);
define('IFE_CONFIG',            2);
define('IFE_FPGA',              3);
define('IFE_GLODEN',            11);

define('ISE1_IDLE',             0); // 空闲状态
define('ISE1_READY',            0xc1); // 准备完毕
define('ISE1_TRANSING',         0xc2); // 正在传输
define('ISE1_WAIT_RESEND',      0xc3); // 需要重传
define('ISE1_FINISH',           0xc4); // 传输完毕
define('ISE1_VERIFYING',        0xc5); // 执行校验
define('ISE1_VERIFY_OK',        0xc6); // 校验OK
define('ISE1_FLUSHING',         0xc7); // 执行写入
define('ISE1_FLUSH_OK',         0xc8); // 写入OK
define('ISE1_ERROR',            0xc9); // 遇到错误

//
define('EL_FILE',               0);
define('EL_NORMAL',             1);
define('EL_HIGHLIGHT',          2); // blue
define('EL_WARNING',            3);
define('EL_ERROR',              4);
