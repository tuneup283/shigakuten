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

	// ��ɸ��������Τ���ȥåפ��ɹ��� 080204 y-kihara
	if($mode == "detail"){
		/* inc_s_detail.php�����ư -------------------------------------------*/
		/* �ѿ����� */
			$_gvars = $_dlv->stripslashArr($_gvars);
		/* ���å��������� */
		if (isSet($_gvars['act']) && $_gvars['act']=="back"){
			$_gvars = $_SESSION['sch']['detail_dat'];
		} elseif (isSet($_gvars['id_sch'])){
			$_SESSION['sch']['detail_dat'] = $_gvars;
		}
		
		if ($_gvars['id_sch']){
			$sql_sch="select distinct sch_mst.*"
			." from sch_mst left join area_mst on sch_mst.id_area=area_mst.id_area"
			." where sch_mst.del_flg='f' and sch_mst.id_sch='".$_gvars['id_sch']."'";
			$rs_sch = pg_exec($con,$sql_sch);
			$rows_sch = pg_numrows($rs_sch);
		}
		if(!$rows_sch){
			locate($PHP_SELF);
			exit;
		}
		/* ���� */
		$_dvars = pg_fetch_array($rs_sch,0,PGSQL_ASSOC);
		$name_grade = name_grade();
		$name_sex   = name_sex();
		$name_img  = $_dvars['id_sch'].".jpg";
		
		//20110322
		//$google_js = "load()\" onunload=\"GUnload()";
		$google_js = "load()\"";
		//20110322
		
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
<!--[if IE 6]>
	<script src="../common/js/DD_belatedPNG.js"></script>
	<script>
		DD_belatedPNG.fix('img, .png_bg');
	</script>
<![endif]-->
<META http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<meta http-equiv="Expires" content="Tue, 20 Aug 1996 14:25:27 GMT">
<meta http-equiv="Pragma" content="no-cache">
<title>����Ω��ع������ع�Ϣ��� �� �ع�����</title>
<link rel="stylesheet" href="../common/css/base.css" type="text/css">
<link rel="stylesheet" href="../common/css/top.css" type="text/css">
<link rel="stylesheet" href="../common/css/contents.css" type="text/css">
<link rel="stylesheet" type="text/css" href="../common/css/print.css" media="print">
<script language="JavaScript" type="text/JavaScript" src="../common/js/basic.js"></script>

<!-- googlemap 080204 -->
<?php
	// �ƥ���
	//$googlemap_key = "ABQIAAAAYlr98FWxlIHT1Refr88rVxSXc8aISPqM-fDjS_HwpaPTt9K2EBRCa9Zeq1JmRERAy8xhevJtPdv6jw";
	// ����
	//20110322
	//$googlemap_key = "ABQIAAAAYlr98FWxlIHT1Refr88rVxT-8lCmQOAMl1WcgLgmKD3Fi9vbGRQCNRf8ypHm5oltjms5G-l1aBxstA";
	//20110322
?>

<!-- 20110322 -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<!-- 20110322 -->

<?php if($mode == "detail"){ ?>
<script type="text/javascript">
//<![CDATA[
function load() {
	//20110322
	/*
	if (GBrowserIsCompatible()) {
	var map = new GMap2(document.getElementById("map"));
	
	var lon = <?=$_dvars['longitude'];?>;
	var lat = <?=$_dvars['latitude'];?>;
	var zoom = <?=$_dvars['zoom'];?>;
	
	var point = new GLatLng(lat,lon);
	map.setCenter(point,zoom);
	
	map.addControl(new GLargeMapControl());	
	map.addControl(new GMapTypeControl());
	map.addControl(new GScaleControl());	
	map.addControl(new GOverviewMapControl());
	
	var marker = new GMarker(point);
	map.addOverlay(marker);
	}
	*/
	var latlng = new google.maps.LatLng(<?=$_dvars['latitude'];?>, <?=$_dvars['longitude'];?>);
	var myOptions = {
		zoom: <?=$_dvars['zoom'];?>,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scaleControl: true
	};
	var map = new google.maps.Map(document.getElementById("map"), myOptions);

	var icon = new google.maps.MarkerImage(
	'./image/btn_map_16.png',
	new google.maps.Size(37,38),
	new google.maps.Point(0,0),
	new google.maps.Point(37,38)
	);
	 
	var shadow = new google.maps.MarkerImage(
	'./image/btn_map_shadow_16.png',
	new google.maps.Size(37,38),
	new google.maps.Point(0,0),
	new google.maps.Point(37,38)
	);

	var marker<?=$_dvars['id_sch'];?> = new google.maps.Marker({
		icon:icon,
		shadow:shadow,
		position: latlng, 
		map: map,
		zIndex : <?=$_dvars['latitude']?>,
		title: '<?=$_dvars['name'];?>'
	});

	var contentString = "";
	contentString += "<div class=\"schInfoWindow\">";
	contentString += "<b><?=$_dvars['name'];?></b><br />";
	contentString += "<?=$_dvars['yubin'];?><br />";
	contentString += "<?=$_dvars['jusho'];?><br />";
	contentString += "<?=$_dvars['tel'];?><br />";
	contentString += "</div>";

	var infowindow<?=$_dvars['id_sch'];?> = new google.maps.InfoWindow({
		content: contentString
	});
	google.maps.event.addListener(marker<?=$_dvars['id_sch'];?>, 'mouseover', function() {
		infowindow<?=$_dvars['id_sch'];?>.open(map,marker<?=$_dvars['id_sch'];?>);
		zindex = marker<?=$_dvars['id_sch'];?>.getZIndex(<?=$_dvars['latitude'];?>);
		zindex += 1000;
		marker<?=$_dvars['id_sch'];?>.setZIndex(zindex);
	});
	google.maps.event.addListener(marker<?=$_dvars['id_sch'];?>, 'mouseout', function() {
		infowindow<?=$_dvars['id_sch'];?>.close();
		zindex = marker<?=$_dvars['id_sch'];?>.getZIndex(<?=$_dvars['latitude'];?>);
		zindex -= 1000;
		marker<?=$_dvars['id_sch'];?>.setZIndex(zindex);
	});
	//20110322
}
//]]>
</script>
<?php } ?>
<!-- 20110322 -->
<?php 
	//$google_js = "load()\"";
	if($mode != "detail" && $mode != "list_all"){ 
	$google_js = "load()\"";
?>
<script type="text/javascript">
//<![CDATA[

//sch_arr = new Array();
function load() {
	var latlng = new google.maps.LatLng(34.693375,135.499878);
	var myOptions = {
		zoom: 10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scaleControl: true
	};
	var map = new google.maps.Map(document.getElementById("map"), myOptions);

//for (var keyString in sch_arr) {
//  alert( myObj[keyString][0] );
//}

}
/*
function addMarker(lat,lng,name){
	var latlng = new google.maps.LatLng(lat,lng);
	var marker = new google.maps.Marker({
	    position: latlng,
	    map: map
	});
}
*/

//]]>
</script>
<?php } ?>
<!-- 20110322 -->
<script type="text/javascript">
//<![CDATA[
//20110322
function search_submit(grade){
	if(grade != 'submit'){
		document.getElementById('grade[]').value = grade;
	}
	document.Form.submit();
}

function change_grade(grade){
	var isMSIE = /*@cc_on!@*/false; 
	if(grade == 'junior'){
		document.images["allJuniorTab"].src = "./image/junior_04.gif";
		document.images["allHighTab"].src = "./image/high_03.gif";
		if (!isMSIE) {
			document.getElementById('juniorTab').style.display = 'table';
			document.getElementById('juniorLink').style.display = 'table';
		} else {
			document.getElementById('juniorTab').style.display = 'block';
			document.getElementById('juniorLink').style.display = 'block';
		}
		document.getElementById('highTab').style.display = 'none';
		document.getElementById('highLink').style.display = 'none';
	}else if(grade == 'high'){
		document.images["allJuniorTab"].src = "./image/junior_03.gif";
		document.images["allHighTab"].src = "./image/high_04.gif";
		document.getElementById('juniorTab').style.display = 'none';
		document.getElementById('juniorLink').style.display = 'none';
		if (!isMSIE) {
			document.getElementById('highTab').style.display = 'table';
			document.getElementById('highLink').style.display = 'table';
		} else {
			document.getElementById('highTab').style.display = 'block';
			document.getElementById('highLink').style.display = 'block';
		}
	}
}

/*
function grade_change(grade){
	if(grade == 0){
		document.images["junior"].src = "./image/junior_01.gif";
		document.images["high"].src = "./image/high_02.gif";
	}else if(grade == 1){
		document.images["junior"].src = "./image/junior_02.gif";
		document.images["high"].src = "./image/high_01.gif";
	}
}
*/
//]]>
</script>
<!-- 20110322 -->
</head>
<!--body onLoad="MM_preloadImages('../common/image/btn_student_on.gif','../common/image/btn_parents_on.gif','../common/image/btn_teacher_on.gif','../common/image/btn_activity_on.gif','../common/image/btn_aboutus_on.gif');<?=$google_js ?>"-->
<body onLoad="<?=$google_js ?>">
<!--a name="top"></a--><!--header -->
<div id="HPrint">
<table width="810" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="header">���λ�Ω��ع��������ع�����<br>
<a href="../"><img src="../common/image/logo.gif" alt="����Ω��ع������ع�Ϣ��񡡥����֥�����" width="275" height="32" border="0"></a></td>
<td align="right" id="headerLink"><a href="../"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" align="absmiddle">�ۡ���</a>��<a href="../link/"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" align="absmiddle">��󥯽�</a>��<a href="../contact/"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" align="absmiddle">���䤤��碌</a>��<a href="../sitemap/"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" align="absmiddle">�����ȥޥå�</a></td>
</tr>
</table>
<!--/header -->
<table width="810" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="GMenuBack"><!--menu -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="1%"><img src="../common/image/spacer.gif" alt="" width="10" height="1"></td>
<td width="1%"><a href="../school"><img src="../common/image/btn_student_off.gif" alt="��Ω�ع����ܻؤ�����" name="btn_student" width="150" height="34" border="0" id="btn_student"></a></td>
<td width="1%"><a href="../hogosya/"><img src="../common/image/btn_parents_off.gif" alt="�ݸ�Ԥγ��ͤ�" name="btn_parents" width="102" height="34" border="0" id="btn_parents"></a></td>
<td width="1%"><a href="../kyouin/"><img src="../common/image/btn_teacher_off.gif" alt="������������˾������" name="btn_teacher" width="149" height="34" border="0" id="btn_teacher"></a></td>
<td width="1%"><a href="../dantai/"><img src="../common/image/btn_activity_off.gif" alt="����ؤγ�ư�Ҳ�" name="btn_activity" width="137" height="34" border="0" id="btn_activity"></a></td>
<td width="1%"><a href="../about/"><img src="../common/image/btn_aboutus_off.gif" alt="������Ϣ�Ȥ�" name="btn_aboutus" width="114" height="34" border="0" id="btn_aboutus"></a></td>
<!--td width="1%"><a href="../school" onMouseOver="MM_swapImage('btn_student','','../common/image/btn_student_on.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../common/image/btn_student_off.gif" alt="��Ω�ع����ܻؤ�����" name="btn_student" width="150" height="34" border="0" id="btn_student"></a></td>
<td width="1%"><a href="../hogosya/" onMouseOver="MM_swapImage('btn_parents','','../common/image/btn_parents_on.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../common/image/btn_parents_off.gif" alt="�ݸ�Ԥγ��ͤ�" name="btn_parents" width="102" height="34" border="0" id="btn_parents"></a></td>
<td width="1%"><a href="../kyouin/" onMouseOver="MM_swapImage('btn_teacher','','../common/image/btn_teacher_on.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../common/image/btn_teacher_off.gif" alt="������������˾������" name="btn_teacher" width="149" height="34" border="0" id="btn_teacher"></a></td>
<td width="1%"><a href="../dantai/" onMouseOver="MM_swapImage('btn_activity','','../common/image/btn_activity_on.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../common/image/btn_activity_off.gif" alt="����ؤγ�ư�Ҳ�" name="btn_activity" width="137" height="34" border="0" id="btn_activity"></a></td>
<td width="1%"><a href="../about/" onMouseOver="MM_swapImage('btn_aboutus','','../common/image/btn_aboutus_on.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../common/image/btn_aboutus_off.gif" alt="������Ϣ�Ȥ�" name="btn_aboutus" width="114" height="34" border="0" id="btn_aboutus"></a></td-->
<td width="94%" id="GMenuBackR">&nbsp;</td>
</tr>
</table>
<!--/menu --></td>
</tr>
</table>
</div>

<table width="810" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="pan"><a href="../">�ۡ���</a> &gt; <a href="index.html">��Ω�ع����ܻؤ�����</a> &gt; �ع�����</td>
</tr>
</table>
<table width="810" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10"><img src="../common/image/spacer.gif" alt="" width="10" height="1"></td>
<td width="620" valign="top">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="PTitle"><h1>�ع�����</h1></td>
</tr>
<tr>
<td height="20">&nbsp;</td>
</tr>
</table>
<!--contents-->
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
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
</table>
<?
if($mode != 'list_all'){
?>
<center>
<table width="95%"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="pageTop"><a href="#top">���ڡ�������Ƭ�����</a></td>
</tr>
</table>
</center>
<?
}
?>
<!--contents-->
</td>
<td width="10"><img src="../common/image/spacer.gif" alt="" width="10" height="1"></td>
<td width="170" valign="top" class="RMenuBack"><!--menu-->
<div id="RmenuW">
<table  border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="RMenuTitle"><a href="./">��Ω�ع����ܻؤ�����</a></td>
</tr>
</table>
<table width="158"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr>
  <tr>
    <td><a href="../news/info.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
    <td colspan="2" class="RMenuLink"><a href="../news/info.html">�������</a></td>
  </tr>
  <tr>
    <td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  <tr>
    <td valign="top"><a href="open_campus.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
    <td class="RMenuLink"><a href="open_campus.html">�����ץ󥭥��ѥ������������</a></td>
  </tr>
  <tr>
    <td colspan="3" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr><!--<tr>
    <td valign="top"><a href="iitoko/index.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
    <td colspan="2" class="RMenuLink"><a href="iitoko/index.html">��ؤΥ����Ȥ����ܡ�</a></td>
  </tr>
  <tr>
    <td colspan="3" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr>-->
  <tr>
    <td width="1%"><a href="search.php"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
    <td width="99%" class="RMenuLink"><a href="search.php">������ɡ��ޥåפ���õ��</a></td>
  </tr>
  <tr>
    <td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr>
  <tr>
    <td><a href="search.php?mode=list_all&act=load&xxxxx_yyyyy=71f3ef649dd20bfb5e4ab6986983a97e"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
    <td class="RMenuLink"><a href="search.php?mode=list_all&act=load&xxxxx_yyyyy=71f3ef649dd20bfb5e4ab6986983a97e">�ع���������õ��</a></td>
  </tr>
  <tr>
    <td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr>
  <tr>
    <td><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></td>
    <td class="RMenuLink"><a href="http://www.osaka-shigaku.gr.jp/shigakuten/">����Ω�ع�Ÿ</a></td>
  </tr>
  <tr>
    <td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr>
  <!--</tr>
    <tr>
    <td valign="top"><a href="../news/info.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
    <td class="RMenuLink"><a href="../news/info.html">�����罸����</a></td>
  </tr>
  <tr>
    <td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr>-->
  <td><a href="osaka_high/index.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
      <td colspan="2" class="RMenuLink"><a href="osaka_high/index.html">���λ�Ω��ع�</a></td>
  </tr>
  <!--<tr>
<td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
</tr>
<tr>
 <td valign="top"><a href="http://www.osaka-shigaku.gr.jp/school/shigakuten.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
<td class="RMenuLink"><a href="http://www.osaka-shigaku.gr.jp/school/shigakuten.html">����Ω�ع�Ÿ</a></td>
</tr>-->
  <!--<tr>
<td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
</tr>
<tr>
<td valign="top"><a href="../nyushi/index.php"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
<td class="RMenuLink"><a href="../nyushi/index.php">����Τ�����</a></td>
</tr> -->
</table>
</div>
<!--/menu-->
<!--banner -->
<table width="170" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--
<tr>
<td><a href="http://www.osaka-shigaku.gr.jp/enquate/" target="_blank"><img src="../common/image/banner_link03.gif" alt="��ؤΥ����Ȥ����ܥ��󥱡���" width="170" height="75" border="0"></a></td>
</tr>
<tr>
<td height="5" class="white"></td>
</tr>
-->
  <tr>
    <td><!-- #BeginLibraryItem "/Library/banner.lbi" --><ul id="bnr">
<li><a href="http://www.osaka-shigaku.gr.jp/geibunren/" target="_blank"><img src="../common/image/banner_geibunren2007.gif" alt="�ݽ�ʸ����ŵ������Ω��ع������ع����ݽ�ʸ��Ϣ��" width="170" height="47" border="0"></a></li>
<li><a href="http://www.osaka-shigaku.gr.jp/shitairen/" target="_blank"><img src="../common/image/banner_sitairen.gif" alt="����Ω��ع������ع��ΰ�Ϣ�����������ΰ����" width="170" height="47" border="0"></a></li>

<li><a href="http://www.shigaku-jinken.gr.jp/" target="_blank"><img src="../common/image/banner03.gif" alt="����Ω�ع��͸����鸦���" width="170" height="46" border="0"></a></li>
<li><a href="../hogoren/index.html" target="_blank"><img src="../common/image/bnr_hogoren.jpg" alt="����Ω��ع������ع����ݸ�Բ�Ϣ��񡡻Ҷ�������̤��Τ���ˡ�" width="170" height="47" border="0"></a></li>
<li class="bottom"><a href="http://www.osaka-syouren.gr.jp/" target="_blank"><img src="../common/image/banner_shishoren.gif" alt="����ܻ�Ω���ع�Ϣ��" border="0"></a></li>


</li>
</ul>
<!-- #EndLibraryItem --></td>
  </tr>
  <tr>
    <td id="SSLSeal"><a href="http://www.shigaku-jinken.gr.jp/" target="_blank">
      <div class="SSLsealimg">
        <!-- SSL Icon tag. Do not edit. -->
        <table width="115" border="0" cellpadding="2" cellspacing="0" title="SSL�����о�����Ƴ���ξڡ������Х륵����Υ����ȥ�����">
<tr>
<td width="115" align="center" valign="top">
<span id="ss_img_wrapper_115-57_image_ja">
<a href="http://jp.globalsign.com/" target="_blank">
<img alt="SSL�������Х륵����Υ����ȥ�����" border="0" id="ss_jpn2_gif" src="//seal.globalsign.com/SiteSeal/images/gs_noscript_115-57_ja.gif">
</a>
</span><br>
<script type="text/javascript" src="//seal.globalsign.com/SiteSeal/gs_image_115-57_ja.js" defer="defer"></script> 
<a href="https://www.sslcerts.jp/" target="_blank" style="color:#000000; text-decoration:none; font:bold 12px '�ͣ� �����å�',sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;">SSL�Ȥ�?</a>
</td>
</tr>
</table>
        <!-- SSL Icon tag -->
      </div>
    </a>�������ȤǤϡ��º����ξ����ȥץ饤�Х����ݸ�Τ��ᡢGMO�����Х륵���������Ҥ�SSL�����о��������Ѥ���SSL�Ź沽�̿���¸����Ƥ��ޤ���</td>
  </tr>
</table>
<!--/banner -->
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td id="footerLink">| <a href="../guide/">�����ȤΤ����ѤˤĤ���</a> | <a href="../privacy/">�Ŀ;���μ�갷���ˤĤ���</a> | </td>
<td></td>
<td class="RMenuBack">&nbsp;</td>
</tr>
</table>
<table width="810" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="footer">Copyright 2005-2011 OSAKA SHIGAKU All rights reserved.</td>
</tr>
</table>
<script type="text/javascript">
// ���륪���С�
$('a img')
.mouseover(function(){
    var onSrc = $(this).attr('src').replace('off.gif', 'on.gif');
    $(this).attr('src', onSrc);
})
.mouseout(function(){
    var offSrc = $(this).attr('src').replace('on.gif', 'off.gif');
    $(this).attr('src', offSrc);
});
</script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-39283285-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
</body>
</html>
