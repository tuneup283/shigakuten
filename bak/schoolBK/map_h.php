#!/usr/local/bin/php -q
<?php
/* Copyright (C) PLOTT CO.,LTD. 2004							*/
/****************************************************************
*
*	マップ検索（高等学校）
*
*	Create Date	: 2005/10/27
*	Creator		: M.Ogata
*	Note		: 
*
*****************************************************************/

/* 外部ファイル読み出し */
	include("../ini/config.php");
	include("../ini/inc_html.php");
	headers_start("nocache");
	$con = connect_db();


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>大阪私立中学校高等学校連合会 ｜ マップ検索</title>
<link rel="stylesheet" href="../common/css/base.css" type="text/css">
<link rel="stylesheet" href="../common/css/contents.css" type="text/css">
<link rel="stylesheet" type="text/css" href="../common/css/print.css" media="print">

<script language="JavaScript" type="text/JavaScript" src="../common/js/basic.js"></script>
</head>


<body onLoad="MM_preloadImages('../common/image/btn_student_on.gif','../common/image/btn_parents_on.gif','../common/image/btn_teacher_on.gif','../common/image/btn_activity_on.gif','../common/image/btn_aboutus_on.gif')">
<noscript></noscript>
<a name="top"></a><!--header -->
<div id="HPrint">
<table width="810" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="header">大阪の私立中学校・高等学校情報<br>
<a href="../"><img src="../common/image/logo.gif" alt="大阪私立中学校高等学校連合会　ウェブサイト" width="275" height="32" border="0"></a></td>
<td align="right" id="headerLink"><a href="../"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" align="absmiddle">ホーム</a>　<a href="../link/"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" align="absmiddle">リンク集</a>　<a href="../contact/"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" align="absmiddle">お問い合わせ</a>　<a href="../sitemap/"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" align="absmiddle">サイトマップ</a></td>
</tr>
</table>
<!--/header -->
<table width="810" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="GMenuBack"><!--menu -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="1%"><img src="../common/image/spacer.gif" alt="" width="10" height="1"></td>
<td width="1%"><a href="./" onMouseOver="MM_swapImage('btn_student','','../common/image/btn_student_on.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../common/image/btn_student_off.gif" alt="私立学校を目指す方へ" name="btn_student" width="150" height="34" border="0" id="btn_student"></a></td>
<td width="1%"><a href="../hogosya/" onMouseOver="MM_swapImage('btn_parents','','../common/image/btn_parents_on.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../common/image/btn_parents_off.gif" alt="保護者の皆様へ" name="btn_parents" width="102" height="34" border="0" id="btn_parents"></a></td>
<td width="1%"><a href="../kyouin/" onMouseOver="MM_swapImage('btn_teacher','','../common/image/btn_teacher_on.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../common/image/btn_teacher_off.gif" alt="教員・教員志望の方へ" name="btn_teacher" width="149" height="34" border="0" id="btn_teacher"></a></td>
<td width="1%"><a href="../dantai/" onMouseOver="MM_swapImage('btn_activity','','../common/image/btn_activity_on.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../common/image/btn_activity_off.gif" alt="大阪私学の活動紹介" name="btn_activity" width="137" height="34" border="0" id="btn_activity"></a></td>
<td width="1%"><a href="../about/" onMouseOver="MM_swapImage('btn_aboutus','','../common/image/btn_aboutus_on.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../common/image/btn_aboutus_off.gif" alt="大阪中高連とは" name="btn_aboutus" width="114" height="34" border="0" id="btn_aboutus"></a></td>
<td width="94%" id="GMenuBackR">&nbsp;</td>
</tr>
</table>
<!--/menu --></td>
</tr>
</table>
</div>

<table width="810" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="pan"><a href="../">ホーム</a> &gt; <a href="index.html">私立学校を目指す方へ</a> &gt; マップ検索</td>
</tr>
</table>
<table width="810" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10"><img src="../common/image/spacer.gif" alt="" width="10" height="1"></td>
<td width="620" valign="top">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="PTitle"><h1>マップ検索</h1></td>
</tr>
<tr>
<td height="20">&nbsp;</td>
</tr>
</table>
<div class="STitle">
<h3>高等学校を検索する</h3>
</div>
<br>
<br>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="1%"><a href="search.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="../image/tab_01.gif" alt="キーワード検索" width="126" height="25" border="0"></a></td>
<td width="1%"><a href="map_j.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="../image/tab_02.gif" alt="マップ検索（中学校）" width="126" height="25" border="0"></a></td>
<td width="1%"><a href="map_h.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="../image/tab_03.gif" alt="マップ検索（高等学校）" width="126" height="25" border="0"></a></td>
<td width="1%"><a href="search.php?mode=list_all&act=load&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="../image/tab_04.gif" alt="学校一覧から探す" width="126" height="25" border="0"></a></td>
<td width="96%" align="right" id="SearchTabBack"><img src="../image/tab_back.gif" alt="" width="78" height="25"></td>
</tr>
</table>
<TABLE cellSpacing=0 cellPadding=0 width=620 border=0>
<TR>
<TD><script language="JavaScript">
<!--
var post_flg = false;
function PostCheck(){
	if(post_flg == true){
		return false;
	}
	post_flg = true;
	return true;
}
-->
</script>
<form>
<table width="619" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="SearchWLeft"><img src="../image/w_left.gif" alt="" width="10" height="10"></td>
<td align="center" id="SearchBackC"><br>
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td><font class="mid2" color="#990000"> 行きたい高等学校または通信制を含む学校を検索できます。<BR>
地図上で自分に合った学校を上手に見つけよう！</font></td>
</tr>
</table>
<br>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="500" height="431">
<param name=movie value="map_h.swf">
<param name=quality value=high>
<embed src="map_h.swf" quality=high pluginspage="http://www.macromedia.com/jp/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="500" height="431"> </embed>
</object>
<br></td>
<td width="1%" valign="top" id="SearchWRight"><img src="../image/w3.gif" alt="" width="10" height="10"></td>
</tr>
<tr>
<td width="1%"><img src="../image/w1.gif" alt="" width="10" height="10"></td>
<td width="98%" id="SearchWUnder"><img src="../image/w_under.gif" alt="" width="10" height="10"></td>
<td width="1%"><img src="../image/w2.gif" alt="" width="10" height="10"></td>
</tr>
</table>
</form></TD>
</TR>
</TABLE>
<!--contents-->
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td> 
<br>
<b>□ 操作説明 </b><br>
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td width="200"> 
<table cellspacing=0 cellpadding=1 border=0 width="200">
<tr> 
<td align="right" width="70" class="mini">上へ移動</td>
<td align="center" width="60"><img src="image/map_up.gif" width="30" height="30" border=0></td>
<td width="70" class="mini">　</td>
</tr>
<tr> 
<td align="right" width="70" class="mini">左へ移動</td>
<td align="center" width="60"><img src="image/map_left.gif" width="30" height="30" border=0><img src="image/map_right.gif" width="30" height="30" border=0></td>
<td width="70" class="mini">右へ移動</td>
</tr>
<tr> 
<td align="right" width="70" class="mini">　</td>
<td align="center" width="60"><img src="image/map_down.gif" width="30" height="30" border=0></td>
<td width="70" class="mini">下へ移動</td>
</tr>
</table>
</td>
<td width="128" valign="top" class="mini">左図矢印を押すと地図に対して上下左右に移動することができます。</td>
<td width="61" align="center"> <img src="image/map_big.gif" width="54" height="30"><br>
<img src="image/map_small.gif" width="54" height="30"> <br>
<img src="image/map_zero.gif" width="54" height="30"> <br>
</td>
<td width="215" valign="top" class="mini">地図の縮尺を変更することができます。表示された中心を基点にしています。上手く使って目的の地域を調べましょう。<br>
<br>
また、<b>「初期」</b>を押すと、初めの位置初めの縮尺に戻ります。</td>
</tr>
</table>
</td>
</tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="pageTop"><a href="#top">△ページの先頭へ戻る</a></td>
</tr>
</table>
<!--contents-->
</td>
<td width="10"><img src="../common/image/spacer.gif" alt="" width="10" height="1"></td>
<td width="170" valign="top" class="RMenuBack"><!--menu-->
<div id="RmenuW">
<table  border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="RMenuTitle"><a href="./">私立学校を目指す方へ</a></td>
</tr>
</table>
<table width="158"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
</tr>
<tr>
<td width="1%" valign="top"><a href="search.php"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
<td width="99%" class="RMenuLink"><a href="search.php">キーワード検索</a></td>
</tr>
<tr>
<td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
</tr>
<tr>
<td valign="top"><a href="map_j.php?xxxxx_yyyyy=f64f9fbbb0fd4feb4acb52347ba5c750"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
<td class="RMenuLink"><a href="map_j.php?xxxxx_yyyyy=f64f9fbbb0fd4feb4acb52347ba5c750">マップ検索　中学校</a></td>
</tr>
<tr>
<td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
</tr>
<tr>
<td valign="top"><a href="map_h.php?xxxxx_yyyyy=f64f9fbbb0fd4feb4acb52347ba5c750"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
<td class="RMenuLink"><a href="map_h.php?xxxxx_yyyyy=f64f9fbbb0fd4feb4acb52347ba5c750">マップ検索　高等学校</a></td>
</tr>
<tr>
<td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
</tr><!--<tr>
    <td valign="top"><a href="iitoko/index.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
    <td colspan="2" class="RMenuLink"><a href="iitoko/index.html">私学のイイとこ満載！</a></td>
  </tr>
  <tr>
    <td colspan="3" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr>-->
<tr>
 <td valign="top"><a href="http://www.osaka-shigaku.gr.jp/school/shigakuten.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
<td class="RMenuLink"><a href="http://www.osaka-shigaku.gr.jp/school/shigakuten.html">大阪私立学校展</a></td>
</tr>
<tr>
<td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td></tr>
    <tr>
    <td valign="top"><a href="../news/info.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
    <td class="RMenuLink"><a href="../news/info.html">入試情報</a></td>
  </tr>
  <tr>
    <td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr>
<tr>
<td valign="top"><a href="search.php?mode=list_all&act=load&xxxxx_yyyyy=f64f9fbbb0fd4feb4acb52347ba5c750"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
<td class="RMenuLink"><a href="search.php?mode=list_all&act=load&xxxxx_yyyyy=f64f9fbbb0fd4feb4acb52347ba5c750">学校一覧</a></td>
</tr>
    <tr>
    <td colspan="3" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr>
  <tr>
    <td valign="top"><a href="open_campus.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
    <td colspan="2" class="RMenuLink"><a href="open_campus.html">オープンキャンパス・説明会情報</a></td>
  </tr>
  <tr>
    <td colspan="3" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
  </tr>  <tr>
    <td valign="top"><a href="osaka_high/index.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
    <td colspan="2" class="RMenuLink"><a href="osaka_high/index.html">大阪の私立中学校</a></td>
  </tr>
  
  <!--<tr>
<td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
</tr>
<tr>
 <td valign="top"><a href="http://www.osaka-shigaku.gr.jp/school/shigakuten.html"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
<td class="RMenuLink"><a href="http://www.osaka-shigaku.gr.jp/school/shigakuten.html">大阪私立学校展</a></td>
</tr>-->
<!--<tr>
<td colspan="2" class="subMenuBackL"><img src="../common/image/spacer.gif" width="1" height="15" alt=""></td>
</tr>
<tr>
<td valign="top"><a href="../nyushi/index.php"><img src="../common/image/ico_arrow.gif" alt="" width="16" height="12" border="0" align="absmiddle"></a></td>
<td class="RMenuLink"><a href="../nyushi/index.php">入試のご案内</a></td>
</tr> -->
</table>
</div>
<!--/menu-->
<table width="170" border="0" align="center" cellpadding="0" cellspacing="0">
 
</table>
<!--banner -->
<table width="170" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--
<tr>
<td><a href="http://www.osaka-shigaku.gr.jp/enquate/" target="_blank"><img src="../common/image/banner_link03.gif" alt="私学のイイとこ満載アンケート" width="170" height="75" border="0"></a></td>
</tr>
<tr>
<td height="5" class="white"></td>
</tr>
-->
  <tr>
    <td><!-- #BeginLibraryItem "/Library/banner.lbi" --><ul id="bnr">
<li><a href="http://www.osaka-shigaku.gr.jp/geibunren/" target="_blank"><img src="../common/image/banner_geibunren2007.gif" alt="芸術文化祭典　大阪市立中学校高等学校　芸術文化連盟" width="170" height="47" border="0"></a></li>
<li><a href="http://www.osaka-shigaku.gr.jp/shitairen/" target="_blank"><img src="../common/image/banner_sitairen.gif" alt="大阪私立中学校高等学校体育連盟　私学総合体育大会" width="170" height="47" border="0"></a></li>

<li><a href="http://www.shigaku-jinken.gr.jp/" target="_blank"><img src="../common/image/banner03.gif" alt="大阪私立学校人権教育研究会" width="170" height="46" border="0"></a></li>
<li><a href="../hogoren/index.html" target="_blank"><img src="../common/image/bnr_hogoren.jpg" alt="大阪私立中学校高等学校　保護者会連合会　子供たちの未来のために…" width="170" height="47" border="0"></a></li>
<li class="bottom"><a href="http://www.osaka-syouren.gr.jp/" target="_blank"><img src="../common/image/banner_shishoren.gif" alt="大阪府私立小学校連盟" border="0"></a></li>


</li>
</ul>
<!-- #EndLibraryItem --></td>
  </tr>
  <tr>
    <td id="SSLSeal"><a href="http://www.shigaku-jinken.gr.jp/" target="_blank">
      <div class="SSLsealimg">
        <!-- SSL Icon tag. Do not edit. -->
        <table width="115" border="0" cellpadding="2" cellspacing="0" title="SSLサーバ証明書導入の証　グローバルサインのサイトシール">
<tr>
<td width="115" align="center" valign="top">
<span id="ss_img_wrapper_115-57_image_ja">
<a href="http://jp.globalsign.com/" target="_blank">
<img alt="SSL　グローバルサインのサイトシール" border="0" id="ss_jpn2_gif" src="//seal.globalsign.com/SiteSeal/images/gs_noscript_115-57_ja.gif">
</a>
</span><br>
<script type="text/javascript" src="//seal.globalsign.com/SiteSeal/gs_image_115-57_ja.js" defer="defer"></script> 
<a href="https://www.sslcerts.jp/" target="_blank" style="color:#000000; text-decoration:none; font:bold 12px 'ＭＳ ゴシック',sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;">SSLとは?</a>
</td>
</tr>
</table>
        <!-- SSL Icon tag -->
      </div>
    </a>当サイトでは、実在性の証明とプライバシー保護のため、GMOグローバルサイン株式会社のSSLサーバ証明書を使用し、SSL暗号化通信を実現しています。</td>
  </tr>
</table>
<!--/banner --></td>
</tr>
<tr>
<td>&nbsp;</td>
<td id="footerLink">| <a href="../guide/">サイトのご利用について</a> | <a href="../privacy/">個人情報の取り扱いについて</a> | </td>
<td></td>
<td class="RMenuBack">&nbsp;</td>
</tr>
</table>
<table width="810" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="footer">Copyright 2005-2011 OSAKA SHIGAKU All rights reserved.</td>
</tr>
</table>
</body>
</html>
