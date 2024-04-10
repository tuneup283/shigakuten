#!/usr/local/bin/php -q
<?php
/* Copyright (C) PLOTT CO.,LTD. 2004							*/
/****************************************************************
*
*	私立学校を目指す方へ
*
*	Create Date	: 2005/10/27
*	Creator		: M.Ogata
*	Note		: 
*
*****************************************************************/

/* 外部ファイル読み出し */
	include("../ini/config.php");
	include("../ini/inc_html.php");
	include("../ini/cls_common.php");
	include("./tmp_conf.php");

	session_start();
	headers_start("nocache");
	$con = connect_db();

/* コンストラクタ */
	$_dlv = new DeliveryVars;
	$_bas = new CnfBaseInf_Fnc;

/* 変数受け取り */
	$_pvars  = $_dlv->Post2Vars();
	$_gvars  = $_dlv->Get2Vars();
	$_fvars  = $_dlv->File2Vars();
	$_svvars = $_dlv->Srv2Vars();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>大阪私立中学校高等学校連合会 ｜ 学校検索</title>
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
/* コンテンツ部分表示 */
	switch($mode){
		case 'sehuku':		//制服
			include_once("./inc_s_sehuku.php");
			break;
		case 'detail':		//詳細
			include_once("./inc_s_detail.php");
			break;
		case 'list_all':	//学校一覧
			include_once("./inc_all_search.php");
			break;
		case 'search':		//検索結果
			include_once("./inc_s_form.php");
			include_once("./inc_s_search.php");
			break;
		default:			//検索
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
