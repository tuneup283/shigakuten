#!/usr/local/bin/php -q
<?php
include("../ini/config.php");
include("../ini/inc_html.php");
include("../ini/cls_common.php");
include("./tmp_conf.php");

session_start();
headers_start("nocache");
$con = connect_db();

/* ���󥹥ȥ饯�� */
	$_dlv = new DeliveryVars;
	$_bas = new CnfBaseInf_Fnc;

/* �ѿ�������� */
	$_pvars  = $_dlv->Post2Vars();
	$_gvars  = $_dlv->Get2Vars();

switch($mode){
  case 'pick':
  	include_once("./inc_s_uppick.php");
	break;
  default:		//����
	html_head_buf();
  	include_once("./inc_s_form.php");
  	html_foot_buf();
}
?>
