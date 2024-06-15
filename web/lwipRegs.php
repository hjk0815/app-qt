<?php
/* 
** # DO NOT EDIT THIS FILE!  
** # Auto generated from: 
** # D:\t\13.FML\00.doc\03.HMIЭ��
** # 2023/7/18 10:46:58 
**/





/************�豸IP��************/
/* @brief ����IP��ַ�����ڵ��Ƽ����������ϴ�
 * @param data1(4byte)-  @default [192.168.1.111]
 */
define('REG_HOST_IP',                            1 ); /*RW*/

/* @brief DHCPʹ��
 * @param data1(4byte)-1-enable��0-disable  @default [0]
 */
define('REG_DHCP_ENABLE',                        2 ); /*RW*/

/* @brief ��̬IP����
 * @param data1(4byte)-IPv4��4�ֽ�IP����  @default [192.168.1.10]
 */
define('REG_DEVICE_IP',                          3 ); /*RW*/

/* @brief ��������
 * @param data1(4byte)-IPv4��4�ֽ���������  @default [255.255.255.0]
 */
define('REG_NET_MASK',                           4 ); /*RW*/

/* @brief ����
 * @param data1(4byte)-IPv4��4�ֽ�����  @default [192.168.1.1]
 */
define('REG_NET_GATEWAY',                        5 ); /*RW*/

/* @brief DNS����
 * @param data1(4byte)-IPv4��4�ֽ�DNS  @default []
 */
define('REG_NET_DNS',                            6 ); /*RW*/

/* @brief MAC��ַbyte[0-3]
 * @param data1(4byte)-MAC��ַbyte[0-3]  @default []
 */
define('REG_NET_MAC0',                           7 ); /*RW*/

/* @brief MAC��ַbyte[4-5]
 * @param data1(4byte)-MAC��ַbyte[4-5]  @default []
 */
define('REG_NET_MAC1',                           8 ); /*RW*/

/* @brief ��̬IPv6����byte[0-3]
 * @param data1(4byte)-��̬IPv6����byte[0-3]  @default []
 */
define('REG_STATIC_IPv6_0',                      9 ); /*RW*/

/* @brief ��̬IPv6����byte[4-7]
 * @param data1(4byte)-��̬IPv6����byte[4-7]  @default []
 */
define('REG_STATIC_IPv6_1',                      10 ); /*RW*/

/* @brief ��̬IPv6����byte[8-11]
 * @param data1(4byte)-��̬IPv6����byte[8-11]  @default []
 */
define('REG_STATIC_IPv6_2',                      11 ); /*RW*/

/* @brief ��̬IPv6����byte[12-15]
 * @param data1(4byte)-��̬IPv6����byte[12-15]  @default []
 */
define('REG_STATIC_IPv6_3',                      12 ); /*RW*/












/************�û���Ϣ��************/
/* @brief �洢����Ա�û�����-ǰ4byte(���8���ַ�)
 * @param data1(4byte)-  @default ['admi']
 */
define('REG_ADMIN_NAME0',                        111 ); /*RW*/

/* @brief �洢����Ա�û�����-��4byte
 * @param data1(4byte)-  @default ['n']
 */
define('REG_ADMIN_NAME1',                        112 ); /*RW*/

/* @brief �洢����Ա�û�����-ǰ4byte(���8���ַ�)
 * @param data1(4byte)-  @default []
 */
define('REG_ADMIN_PWD0',                         113 ); /*RW*/

/* @brief �洢����Ա�û�����-��4byte
 * @param data1(4byte)-  @default []
 */
define('REG_ADMIN_PWD1',                         114 ); /*RW*/

/* @brief �洢һ���û�0����-ǰ4byte(���8���ַ�)
 * @param data1(4byte)-  @default ['user']
 */
define('REG_USER0_NAME0',                        115 ); /*RW*/

/* @brief �洢һ���û�0����-��4byte
 * @param data1(4byte)-  @default ['1']
 */
define('REG_USER0_NAME1',                        116 ); /*RW*/

/* @brief �洢һ���û�0����-ǰ4byte(���8���ַ�)
 * @param data1(4byte)-  @default ['more']
 */
define('REG_USER0_PWD0',                         117 ); /*RW*/

/* @brief �洢һ���û�0����-��4byte
 * @param data1(4byte)-  @default ['']
 */
define('REG_USER0_PWD1',                         118 ); /*RW*/

/* @brief �洢һ���û�1����-ǰ4byte(���8���ַ�)
 * @param data1(4byte)-  @default ['user']
 */
define('REG_USER1_NAME0',                        119 ); /*RW*/

/* @brief �洢һ���û�1����-��4byte
 * @param data1(4byte)-  @default ['2']
 */
define('REG_USER1_NAME1',                        120 ); /*RW*/

/* @brief �洢һ���û�1����-ǰ4byte(���8���ַ�)
 * @param data1(4byte)-  @default ['more']
 */
define('REG_USER1_PWD0',                         121 ); /*RW*/

/* @brief �洢һ���û�1����-��4byte
 * @param data1(4byte)-  @default ['']
 */
define('REG_USER1_PWD1',                         122 ); /*RW*/



/************�豸ͳ����Ϣ************/
/* @brief Lwip�汾��
 * @param data1(4byte)-  @default []
 */
define('REG_LWIP_VERSION',                       129 ); /*R*/

/* @brief ���´���
 * @param data1(4byte)-  @default []
 */
define('REG_LWIP_LAST_ERROR',                    130 ); /*R*/






/* �Ĵ��������� */
define('LWIP_REG_CNT',           131 );



