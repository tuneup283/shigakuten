#!/usr/local/bin/php -q
<?php
/* Copyright (C) PLOTT CO.,LTD. 2004							*/
/****************************************************************
*
*	��Ω�ع����ܻؤ�����
*
*	Create Date	: 2005/10/27
*	Creator		: M.Ogata
*	Note		: 
*
*****************************************************************/

/* �����ե������ɤ߽Ф� */
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
	$_fvars  = $_dlv->File2Vars();
	$_svvars = $_dlv->Srv2Vars();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>����Ω��ع������ع�Ϣ��� �� �ع�����</title>
<link rel="stylesheet" href="../common/css/base.css" type="text/css">
<link rel="stylesheet" href="../common/css/contents.css" type="text/css">
<link rel="stylesheet" type="text/css" href="../common/css/print.css" media="print">

<script language="JavaScript" type="text/JavaScript" src="../common/js/basic.js"></script>
</head>


<body>
<!--contents-->
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td> 
<?php
/* ����ƥ����ʬɽ�� */
	switch($mode){
		case 'sehuku':		//����
			include_once("./inc_s_sehuku.php");
			break;
		case 'detail':		//�ܺ�
			include_once("./inc_s_detail.php");
			break;
		case 'list_all':	//�ع�����
			include_once("./inc_all_search.php");
			break;
		case 'search':		//�������
			include_once("./inc_s_form.php");
			include_once("./inc_s_search.php");
			break;
		default:			//����
			include_once("./inc_s_form.php");
	}
?>
</td>
</tr>
<tr>
<td valign="bottom"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="footer">Copyright 2005-2011 OSAKA SHIGAKU All rights reserved.</td>
</tr>
</table>
</td>
</tr>
</table>
<!--contents-->
</body>
</html>
