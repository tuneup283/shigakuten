<?php
/* Copyright (C) 2007 PLOTT CO.,LTD. ======================================== *
 *	Note			: 0801311 該当部分コメントアウト C.Nishikawa
 * ========================================================================= */


	/* 変数整形 */
//		$_gvars = $_dlv->stripslashArr($_gvars);
	/* セッションに代入 */

/*
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
*/

	/* 配列 */
/*
	$_dvars = pg_fetch_array($rs_sch,0,PGSQL_ASSOC);
	$name_grade = name_grade();
	$name_sex   = name_sex();
	$name_img  = $_dvars['id_sch'].".jpg";
*/

	/* 画像の高さでrowspan値を決める */
	$myimg = img_sch_dir.$name_img;
	if (file_exists($myimg)){
		$imgsize = getimagesize($myimg);
		$imgsize_org = getimagesize($myimg);

		//でかい画像を強制縮小
		$maxwidth	= 300;
		$maxheight	= 300;
		$width_org	= round($imgsize[0] * 1.2);
		$height_org	= round($imgsize[1] * 1.2);
		$width		= $imgsize[0];
		$height		= $imgsize[1];
		if ($imgsize[0] >= $imgsize[1]){		//幅>=縦
			if ($imgsize[0] > $maxwidth){
				$width	= $maxwidth;
				$per	= $maxwidth / $imgsize[0];
				$height	= round($imgsize[1] * $per);
			}
		}
		if ($imgsize[0] < $imgsize[1]){			//幅<縦
			if ($imgsize[1] > $maxheight){
				$height	= $maxheight;
				$per	= $maxheight / $imgsize[1];
				$width	= round($imgsize[0] * $per);
			}
		}
		$imgsize[0] = $width;
		$imgsize[1] = $height;
		$imgsize[3] = " width=\"".$width."\" height=\"".$height."\"";
		
		if ($imgsize_org[0] > $imgsize[0] || $imgsize_org[1] > $imgsize[1]){
			$img_comment = "<span style=\"color:#FF0000;font-size:10px;\">※クリックで拡大</span>";
			$img_tag	 = "<a href=\"javascript:window.open('".img_sch_dir.$name_img."','_blank','scrollbars=yes,height=".$height_org.",width=".$width_org."');void(0);\" border=\"0\"><img src=\"".img_sch_dir.$name_img."\" border=0 ".$imgsize[3]."></a><br>".$img_comment;
		} else {
			$img_tag	 = "<img src=\"".img_sch_dir.$name_img."\" border=0 ".$imgsize[3].">";
		}

		//縦セルのぶち抜き設定
		if ($imgsize[1] < 200){
			$rowspan = 3;
			$colspan = Array("","",""," colspan=\"2\""," colspan=\"2\"");
		} elseif ($imgsize[1] < 250){
			$rowspan = 4;
			$colspan = Array("","","",""," colspan=\"2\"");
		} else {
			$rowspan = 5;
			$colspan = Array("","","","","");
		}
	} else {
		$rowspan = 1;
		$colspan = Array(" colspan=\"2\""," colspan=\"2\""," colspan=\"2\""," colspan=\"2\""," colspan=\"2\"");
	}

	//学科・コース・交通の便の存否でcolspan適用を決める
	if($_dvars['gakka'] || $_dvars['gakka']){
		$kotsu_colspan = $colspan[4];
	} else {
		$kotsu_colspan = $colspan[3];
	}

	/* 画像の高さでrowspan値を決める（写真２） */
	$myimg2 = img_act_dir.$name_img;
	$colspan_cnt2 = 0;
	if (file_exists($myimg2)){
		$imgsize2 = getimagesize($myimg2);
		$imgsize2_org = getimagesize($myimg2);

		//でかい画像を強制縮小
		$maxwidth	= 300;
		$maxheight	= 300;
		$width_org2	= round($imgsize2[0] * 1.3);
		$height_org2= round($imgsize2[1] * 1.3);
		$width		= $imgsize2[0];
		$height		= $imgsize2[1];
		if ($imgsize2[0] >= $imgsize2[1]){		//幅>=縦
			if ($imgsize2[0] > $maxwidth){
				$width	= $maxwidth;
				$per	= $maxwidth / $imgsize2[0];
				$height	= round($imgsize2[1] * $per);
			}
		}
		if ($imgsize2[0] < $imgsize2[1]){			//幅<縦
			if ($imgsize2[1] > $maxheight){
				$height	= $maxheight;
				$per	= $maxheight / $imgsize2[1];
				$width	= round($imgsize2[0] * $per);
			}
		}
		$imgsize2[0] = $width;
		$imgsize2[1] = $height;
		$imgsize2[3] = " width=\"".$width."\" height=\"".$height."\"";
		if ($imgsize2_org[0] > $imgsize2[0] || $imgsize2_org[1] > $imgsize2[1]){
			$img_comment2 = "<span style=\"color:#FF0000;font-size:10px;\">※クリックで拡大</span>";
			$img_tag2	  = "<a href=\"javascript:window.open('".img_act_dir.$name_img."','_blank','scrollbars=yes,height=".$height_org2.",width=".$width_org2."');void(0);\" border=\"0\"><img src=\"".img_act_dir.$name_img."\" border=0 ".$imgsize2[3]."></a><br>".$img_comment2;
		} else {
			$img_tag2	  = "<img src=\"".img_act_dir.$name_img."\" border=0 ".$imgsize2[3].">";
		}

		//縦セルのぶち抜き設定
		if ($imgsize2[1] < 100){
			$rowspan2 = 1;
			$colspan2 = Array(" colspan=\"2\""," colspan=\"2\"");
		} else {
			$rowspan2 = 2;
			$colspan2 = Array(""," colspan=\"2\"");
		}
	} else {
		$rowspan2 = 0;
		$colspan2 = Array(" colspan=\"2\""," colspan=\"2\"");
	}

/* 新着情報読み出し */
	$sql_update = "select id_sch_u,up_date,title,comment,link from sch_u_tbl"
				." where del_flg='f' and id_sch='".$_dvars['id_sch']."'"
				." order by up_date desc,id_sch_u desc";
	$rs_update  = pg_exec($con,$sql_update);
	if (pg_numrows($rs_update) > 0){
?>

<table width="620"  border="0" cellspacing="0" cellpadding="0" id="SearchBottom">
<tr>
<td width="1%"><img src="image/title_new.gif" alt="新着情報" width="100" height="22"></td>
<td width="99%" align="right" class="TabLinkB">&nbsp;</td>
</tr>
</table>

<table width="620" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><img src="../image/w5.gif" alt="" width="10" height="10"></td>
<td id="SearchWTop"><img src="../image/w_top.gif" alt="" width="10" height="10"></td>
<td><img src="../image/w4.gif" alt="" width="10" height="10"></td>
</tr>
<tr>
<td id="SearchWLeft"><img src="../image/w_left.gif" alt="" width="10" height="10"></td> 
<td id="SearchBackC"><table width="90%" border="0" cellspacing="0" cellpadding="1" align="center" background="image/space.gif">
<?php
		for($n=0; $n < pg_numrows($rs_update); $n++){
?>
<tr> 
<td width="18%" valign="top"><font color="#FF0000">
■<?=ereg_replace("-","/",pg_result($rs_update,$n,1));?></font></td>
<td width="82%">
<?
			if (pg_result($rs_update,$n,3) || pg_result($rs_update,$n,4)){
?>
<a href="javascript:void(0)" onClick="window.open('search_change.php?mode=pick&id_sch_u=<?=pg_result($rs_update,$n,0);?>&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>','_blank','scrollbars=yes,height=200,width=300')"><?=pg_result($rs_update,$n,2);?></a>
<?
			} else {
				echo pg_result($rs_update,$n,2);
			}
?>
</td>
</tr>
<?
		}
?>
</table></td>
<td id="SearchWRight"><img src="../image/w3.gif" alt="" width="10" height="10"></td>
</tr>
<tr>
<td width="1%"><img src="../image/w1.gif" alt="" width="10" height="10"></td>
<td width="98%" id="SearchWUnder"><img src="../image/w_under.gif" alt="" width="10" height="10"></td>
<td width="1%"><img src="../image/w2.gif" alt="" width="10" height="10"></td>
</tr>
</table>
<br>
<?php
	}
?>
<TABLE cellSpacing=0 cellPadding=5 width="620" border=0>
<TR>
<TD>　</TD>
<TD class=mini align=right><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr align="right">
<td><table cellspacing=0 cellpadding=0 border=0>
<tr>
<?
	if($_dvars['url']){
?>
<td width=97 align="center"><a href="<?=$_dvars['url'];?>" target="_blank"><img src="image/b_homepage.gif" border="0"></a> </td>
<td width=10 align="center"><img src="image/space.gif" width="10" height="1"></td>
<?
	}

print "<!--\n";
print img_sch_dir."\n";
print img_act_dir."\n";
print img_uni_dir."\n";
print img_uni2_dir."\n";
print "\n//-->";

	if(file_exists(img_uni_dir.$name_img) || file_exists(img_uni2_dir.$name_img)){
?>
<td width=97 align="center"><a href="javascript:void(0)" onClick="window.open('./sehuku.php?mode=sehuku&id_sch=<?=$_dvars['id_sch'];?>&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>','_blank','scrollbars=yes,height=380,width=500')"><img src="image/seifuku.gif" width="97" height="21" border="0"></a> </td>
<td width=10 align="center"><img src="image/space.gif" width="10" height="1"> </td>
<?
	}
?>
<td width=97 align="right"><?php
	if($_gvars['turn']=="map_h"){
?>
<a href="./map_h.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>" target="_self">
<?
	}elseif($_gvars['turn']=="map_j"){
?>
</a><a href="./map_j.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>" target="_self">
<?
	}elseif($_gvars['turn']=="nyushi"){
?>
</a><a href="../nyushi/index.php?act=back&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>" target="_self">
<?
	}else{
?>
</a><a href="<?=$PHP_SELF;?>?mode=search&act=back&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>" target="_self">
<?
	}
	if ($_gvars['mode'] != "detail"){
?>
<img src="image/back.gif" width="97" height="21" border="0"></a>
<?php
	}
?>
</td>
</tr>
</table></td>
</tr>
</table></TD>
</TR>
</TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=620 border=0>
<TR>
<TD class="StitleC1"><TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR>
<TD width="50%" style="font-size:16px;font-weight:bold;"><?=$_dvars['name'];?></TD>
<TD width="50%" align="right">最終更新日：
<?=date("Y年n月j日", strtotime($_dvars['up_date']));?></TD>
</TR>
</TABLE></TD>
</TR>
<TR bgColor=#ffffff>
<TD></TD>
</TR>
</TABLE>
<br>


<table width="620" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
	<td class="Detail01L"><img src="image/t_profile.gif" width="139" height="21" vspace="5"></td>
	</tr>
	<tr>
	<td height="10"></td>
	</tr>
	</table>
	
	<TABLE cellSpacing=3 cellPadding=3 width="100%" border=0>
	<TR>
	<TD vAlign=top width="1%" class="Detail01T">学校名 </TD>
	<TD vAlign=top width="80%" class="Detail01C"<?=$colspan[0];?>>
	<?=$_dvars['name'];?></TD>
	<TD vAlign=top width="1%" bgColor=#ffffff align="right" rowspan="<?=$rowspan;?>" nowrap>
	<?php
		//イメージ
		if(file_exists(img_sch_dir.$name_img)) echo $img_tag;
	?>
	</TD>
	</TR>
	<TR>
	<TD vAlign=top width="1%" class="Detail01T">男/女/共学/通信 </TD>
	<TD vAlign=top width="80%" class="Detail01C"<?=$colspan[1];?>>
	<?=$name_sex[$_dvars['sex']];?></TD>
	</TR>
	<TR>
	<TD vAlign=top class="Detail01T">学校所在地 </TD>
	<TD vAlign=top class="Detail01C"<?=$colspan[2];?>>
	<?php
		if($_dvars['yubin']) echo "〒".$_dvars['yubin']."<br>";
		if($_dvars['jusho']) echo $_dvars['jusho']."<br>";
		if($_dvars['tel'])   echo $_dvars['tel']."<br>";
		if($_dvars['url'])   echo $_dvars['url']."<br><a href=\"javascript:void(0)\" onClick=\"window.open('".$_dvars['url']."','_blank')\"><img src=\"./image/btn_link.gif\"></a><br>";
	?>
	</TD>
	</TR>
	<?if($_dvars['gakka']){?>
	<TR>
	<TD vAlign=top class="Detail01T">学科 </TD>
	<TD vAlign=top class="Detail01C"<?=$colspan[3];?>><?=$_dvars['gakka'];?></TD>
	</TR>
	<?}?>
	<?if($_dvars['course']){?>
	<TR>
	<TD vAlign=top class="Detail01T">コース </TD>
	<TD vAlign=top class="Detail01C"<?=$colspan[3];?>><?=$_dvars['course'];?></TD>
	</TR>
	<?}?>
	<?if($_dvars['kotsu']){?>
	<TR>
	<TD vAlign=top class="Detail01T">交通の便 </TD>
	<TD vAlign=top class="Detail01C"<?=$kotsu_colspan;?>><?=$_dvars['kotsu'];?></TD>
	</TR>
	<?}?>
	<?if($_dvars['hoshin']){?>
	<TR>
	<TD vAlign=top class="Detail01T">建学の精神<BR>
	・教育方針 </TD>
	<TD vAlign=top class="Detail01C" colspan="2"><?=$_dvars['hoshin'];?></TD>
	</TR>
	<?}?>
	<?if($_dvars['kanren']){?>
	<TR>
	<TD vAlign=top class="Detail01T">関連校 </TD>
	<TD vAlign=top class="Detail01C" colspan="2"><?=$_dvars['kanren'];?></TD>
	</TR>
	<?}?>
	<?if($_dvars['koryu']){?>
	<TR>
	<TD vAlign=top class="Detail01T">海外交流 </TD>
	<TD vAlign=top class="Detail01C" colspan="2"><?=$_dvars['koryu'];?></TD>
	</TR>
	<?}?>
	<TR>
	<TD><img height=1 src="image/space.gif" width=110></TD>
	<TD colspan="2"><IMG height=1 src="image/space.gif" width=200></TD>
	</TR>
	</TABLE>
<br>
<BR>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
	<td class="Detail02L"><img src="image/t_gakko.gif" width="100" height="21" vspace="5"></td>
	</tr>
	<tr>
	<td height="10"></td>
	</tr>
	</table>
	
	<TABLE cellSpacing=3 cellPadding=3 width="100%" border=0>
	<TR>
	<?if($_dvars['gyoji']){?>
	<TD vAlign=top class="Detail02T">学校行事</TD>
	<TD vAlign=top class="Detail02C"><?=$_dvars['gyoji'];?></TD>
	<?}else{?>
	<TD> </TD>
	<TD> </TD>
	<?}?>
	<TD width="1%" vAlign=top bgColor=#ffffff align="right" rowspan="<?=$rowspan2;?>" nowrap>
	<?php
	//イメージ
		if (file_exists(img_act_dir.$name_img)) echo $img_tag2;
	?>
	</TD>
	</TR>
	<?php
		if($_dvars['club']){
			($colspan_cnt2 > 1 ? $html=" colspan=\"2\"" : $html=$colspan2[$colspan_cnt2]);
	?>
	<TR>
	<TD vAlign=top class="Detail02T">クラブ・<BR>課外活動 </TD>
	<TD vAlign=top class="Detail02C"<?=$html;?>><?=$_dvars['club'];?></TD>
	</TR>
	<?php
			++$colspan_cnt2;
		}
	?>
	<?php
		if($_dvars['ryoko']){
			($colspan_cnt2 > 1 ? $html=" colspan=\"2\"" : $html=$colspan2[$colspan_cnt2]);
	?>
	<TR>
	<TD vAlign=top width="1%" class="Detail02T">修学旅行</TD>
	<TD vAlign=top width="99%" class="Detail02C"<?=$html;?>><?=$_dvars['ryoko'];?></TD>
	</TR>
	<?php
			++$colspan_cnt2;
		}
	?>
	<?php
		if($_dvars['ryugaku']){
			($colspan_cnt2 > 1 ? $html=" colspan=\"2\"" : $html=$colspan2[$colspan_cnt2]);
	?>
	<TR>
	<TD vAlign=top class="Detail02T">留学制度</TD>
	<TD vAlign=top class="Detail02C"<?=$html;?>><?=$_dvars['ryugaku'];?></TD>
	</TR>
	<?php
			++$colspan_cnt2;
		}
	?>
	<?php
		if($_dvars['shinro']){
			($colspan_cnt2 > 1 ? $html=" colspan=\"2\"" : $html=$colspan2[$colspan_cnt2]);
	?>
	<TR>
	<TD vAlign=top class="Detail02T">希望進路</TD>
	<TD vAlign=top class="Detail02C"<?=$html;?>><?=$_dvars['shinro'];?></TD>
	</TR>
	<?php
			++$colspan_cnt2;
		}
	?>
	<?php
		if($_dvars['comment']){
			($colspan_cnt2 > 1 ? $html=" colspan=\"2\"" : $html=$colspan2[$colspan_cnt2]);
	?>
	<TR>
	<TD vAlign=top class="Detail02T">コメント</TD>
	<TD vAlign=top class="Detail02C"<?=$html;?>><?=$_dvars['comment'];?></TD>
	</TR>
	<?php
			++$colspan_cnt2;
		}
	?>
	<TR>
	<TD><img height=1 src="image/space.gif" width=110></TD>
	<TD colspan="2"><IMG height=1 src="image/space.gif" width=200></TD>
	</TR>
	</TABLE>
<br>
<BR>

<?php
	/* 0801311 ------------------------------------------------------- start */
	/*
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
	<td class="Detail03L"><img src="image/t_nyushi.gif" width="120" height="21" vspace="5"></td>
	</tr>
	<tr>
	<td height="10"></td>
	</tr>
	</table>

	<TABLE cellSpacing=3 cellPadding=3 width="100%" border=0>
	<?if($_dvars['meet_date']){?>
	<TR>
	<TD vAlign=top width="1%" class="Detail03T">入試説明会日時 </TD>
	<TD width="99%" class="Detail03C"><?=$_dvars['meet_date'];?></TD>
	</TR>
	<?}?>
	<?if($_dvars['meet_full']){?>
	<TR>
	<TD vAlign=top class="Detail03T">入試説明会詳細 </TD>
	<TD class="Detail03C"><?=$_dvars['meet_full'];?></TD>
	</TR>
	<?}?>
	<TR>
	<TD vAlign=top><img height=1 src="image/space.gif" width=110></TD>
	<TD>
	<IMG height=1 src="image/space.gif" width=200>
	</TD>
	</TR>
	</TABLE>
	*/
	/* 0801311 --------------------------------------------------------- end */
?>
</td>
</tr>
</table>


<!-- GoogleMap -->
<table width="620" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
	<td class="Detail01L"><img src="image/t_map.gif" vspace="5"></td>
	</tr>
	<tr>
	<td height="10"></td>
	</tr>
	</table>
	
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
		<TR>
		<TD algin="center">
			<div id="map" style="width: 500px; height: 440px"></div>
		</TD>
		</TR>
	</TABLE>
</td>
</tr>
</table>
<!-- GoogleMap end -->

<?
	//アクセスカウント
	
	if($_dvars['id_sch']){
		if($_dvars['ac_ip']!=$_svvars['REMOTE_ADDR']){
			$ac_cnt = ((int)$_dvars['ac_log'])+1;
			$sql_ac = "update sch_mst set"
				." ac_log='$ac_cnt',ac_ip='".$_svvars['REMOTE_ADDR']."'"
				." where del_flg='f' and id_sch='".$_dvars['id_sch']."'";
			pg_exec($con,$sql_ac);
		}
	}
?>
