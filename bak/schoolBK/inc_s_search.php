<div class="STitle">
<h3>検索結果</h3>
</div><br>
<table width="620" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#ffffff"> 
<td align="right"> 
<!--table border="0" cellspacing="0" cellpadding="1">
<tr>
<td>
<img src="image/ico_tyu.gif" border=0>
</td>
<td class="rubi">
中学校 
</td>
<td>
<img src="image/ico_koutou.gif" border=0>
</td>
<td class="rubi">
高等学校 
</td>
<td>
<img src="image/ico_kyoiku.gif" border=0>
</td>
<td class="rubi">
中等教育学校 
</td>
<td>
<img src="image/ico_kyogaku.gif" border=0>
</td>
<td class="rubi">
共学校 
</td>
<td>
<img src="image/ico_man.gif" border=0>
</td>
<td class="rubi">
男子校 
</td>
<td>
<img src="image/ico_woman.gif" border=0>
</td>
<td class="rubi">
女子校 
</td>
<td>
<img src="image/ico_tushin.gif" border=0>
</td>
<td class="rubi">
通信制 
</td>
<td>
<img src="image/ico_ryo.gif" border=0>
</td>
<td class="rubi">
寮有り 
</td>
</tr>
</table-->
</td>
</tr>
</table>
<?php
	/* 変数整形 */
		$_gvars = $_dlv->stripslashArr($_gvars);
	/* セッションに代入 */
	if (isSet($_gvars['act']) && $_gvars['act']=="load") $_SESSION['school']['search_dat'] = $_gvars;
	if ($_SESSION['school']['search_dat'])				 $_svars = $_SESSION['school']['search_dat'];
	/* SQL */
//20110322
	//if (isSet($_svars['sex']) && is_array($_svars['sex']))	   $and[] = "(sex=".implode(" or sex=",$_svars['sex']).")";
	//if (isSet($_svars['sex']) && is_array($_svars['sex']) && is_array($_svars['sex']) != 4)	   $and[] = "(sex=".implode(" or sex=",$_svars['sex']).")";
	//if (isSet($_svars['sex']) && is_array($_svars['sex']) && is_array($_svars['sex']) == 4)	   $and[] = "(ryo=1)";

	if (isSet($_svars['sex']) && is_array($_svars['sex'])){
		$tmp_arr = array();
		foreach($_svars['sex'] as $val){
			if ($val != 4) $tmp_arr[] = $val;
			if ($val == 4) $and[] = "(ryo=1)";
		}
		if(isSet($tmp_arr) && is_array($tmp_arr) && count($tmp_arr)) $and[] = "(sex=".implode(" or sex=",$tmp_arr).")";
	}
	if (isSet($_svars['grade']) && is_array($_svars['grade'])){
		foreach($_svars['grade'] AS $key => $val){
			if($val == 0) $_svars['grade'][] = 2;
		}
	}
//20110322
	if (isSet($_svars['grade']) && is_array($_svars['grade'])) $and[] = "(grade=".implode(" or grade=",$_svars['grade']).")";
	if (isSet($_svars['id_area']) && $_svars['id_area'])	   $and[] = "id_area='".$_svars['id_area']."'";
	if (isSet($_svars['id_line']) && $_svars['id_line'])	   $and[] = "id_line~',".$_svars['id_line'].",'";
	if (isSet($_svars['id_eki']) && $_svars['id_eki'])		   $and[] = "id_eki~',".$_svars['id_eki'].",'";
	if ($_svars['others']){
		$dat=explode(" ",mb_convert_kana($_svars['others'],"s"));
		foreach(others_fields() as $fld){
			foreach($dat as $val){
				if ($val) $or[]="$fld~'$val'";
			}
		}
	}
	
	if (isSet($and)) $where.= " AND ".implode(" AND ",$and);
	if (isSet($or)) $where.= " AND (".implode(" OR ",$or).")";
	
	//ページコントロール
	if (isSet($_gvars['act']) && $_gvars['act']=="load"){
		$sql_max="SELECT count(id_sch) FROM sch_mst"
		." WHERE del_flg='f'".$where;
		$rs_max = pg_exec($con,$sql_max);
		$_SESSION['school']['search_dat']['max_rows'] = pg_result($rs_max,0,0);
	}
	if (isSet($_gvars['offset'])){
		$_SESSION['school']['search_dat']['offset'] = $_gvars['offset'];
	} elseif ($_SESSION['school']['search_dat']['offset']){
		$_gvars['offset'] = $_SESSION['school']['search_dat']['offset'];
	} else {
		$_gvars['offset'] = 0;
	}
	
	$sql_sch="SELECT * FROM sch_mst"
		." WHERE del_flg='f'".$where
//		." ORDER BY id_sch LIMIT ".BBS_PMAX." OFFSET ".$_gvars['offset'];
//		." ORDER BY grade,sex,kana LIMIT ".BBS_PMAX." OFFSET ".$_gvars['offset'];
		." ORDER BY grade,sort_key LIMIT ".BBS_PMAX." OFFSET ".$_gvars['offset'];	//ソート指定変更 2008.6.18
	if (!pg_exec($con,$sql_sch)) exit;
	$rs_sch = pg_exec($con,$sql_sch);

//20110322
	$sql_sch_all="SELECT * FROM sch_mst"
		." WHERE del_flg='f'".$where
		." ORDER BY grade,sort_key ";	//ソート指定変更 2008.6.18
/*
if (!pg_exec($con,$sql_sch_all)){
	print "NG";
}else{
	print "OK";
};
if (!$sch_rows = pg_numrows($rs_sch)){
	print "NG";
}else{
	print "OK";
};
exit;
*/
	if (!pg_exec($con,$sql_sch_all)) exit;
	$rs_sch_all = pg_exec($con,$sql_sch_all);
	$sch_rows = pg_numrows($rs_sch);
	$sch_all_rows = pg_numrows($rs_sch_all);
	if ( !$sch_rows || !$sch_all_rows ){
	//if (!$sch_rows = pg_numrows($rs_sch)){
//20110322
?>
<table width="620" border="0" cellspacing="0" cellpadding="1">
<tr bgcolor="#ffffff"> 
<td> 
<table summary="schList" width="100%" border="0" cellspacing="1" cellpadding="3">
<tr> 
<td>
<!---b class="result">学校一覧</b>
<img src="../image/space.gif" width="30" height="1"-->
<b>該当校は見つかりませんでした。</b></td>
</tr>
</table>
</td>
</tr>
</table>
<?php
	} else {
?>
<!-- 20110322 -->
<script type="text/javascript">
//<![CDATA[
function load() {

	var maxlat = '';//最大緯度
	var maxlng = '';//最大経度
	var minlat = '';//最小緯度
	var minlng = '';//最小経度

	var latlng = new google.maps.LatLng(37.614231,139.306641);
	var myOptions = {
		zoom: 4,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scaleControl: true
	};
	var map = new google.maps.Map(document.getElementById("map"), myOptions);

	<?php
	for($n=0; $n < $sch_all_rows; $n++){
		$_dat = pg_fetch_array($rs_sch_all,$n,PGSQL_ASSOC);
	?>
		var latlng = new google.maps.LatLng(<?=$_dat['latitude'];?>, <?=$_dat['longitude'];?>);

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

		var marker<?=$_dat['id_sch'];?> = new google.maps.Marker({
			icon: icon,
			shadow: shadow,
			position: latlng,
			map: map,
			zIndex : <?=$_dat['latitude']?>,
			//title: '<?=$_dat['name'];?>'
			title: 'アイコンをクリックすると詳細ページへ移動します。'
		});
		if (maxlat == '') maxlat = <?=$_dat['latitude'];?>;
		if (maxlng == '') maxlng = <?=$_dat['longitude'];?>;
		if (minlat == '') minlat = <?=$_dat['latitude'];?>;
		if (minlng == '') minlng = <?=$_dat['longitude'];?>;

		if (maxlat < <?=$_dat['latitude'];?>) maxlat = <?=$_dat['latitude'];?>;
		if (maxlng < <?=$_dat['longitude'];?>) maxlng = <?=$_dat['longitude'];?>;
		if (minlat > <?=$_dat['latitude'];?>) minlat = <?=$_dat['latitude'];?>;
		if (minlng > <?=$_dat['longitude'];?>) minlng = <?=$_dat['longitude'];?>;

		google.maps.event.addListener(marker<?=$_dat['id_sch'];?>, 'click', function() {
			location.href  = "<?=$PHP_SELF;?>?mode=detail&id_sch=<?=$_dat['id_sch'];?>&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>";
		});

		var contentString = "";
		contentString += "<div class=\"schInfoWindow\">";
		contentString += "<b><?=$_dat['name'];?></b><br />";
		contentString += "<?=$_dat['yubin'];?><br />";
		contentString += "<?=$_dat['jusho'];?><br />";
		contentString += "<?=$_dat['tel'];?>";
		contentString += "</div>";
		
		var infowindow<?=$_dat['id_sch'];?> = new google.maps.InfoWindow({
			content: contentString
		});

		google.maps.event.addListener(marker<?=$_dat['id_sch'];?>, 'mouseover', function() {
			infowindow<?=$_dat['id_sch'];?>.open(map,marker<?=$_dat['id_sch'];?>);
			zindex = marker<?=$_dat['id_sch'];?>.getZIndex(<?=$_dat['latitude'];?>);
			zindex += 1000;
			marker<?=$_dat['id_sch'];?>.setZIndex(zindex);
		});
		google.maps.event.addListener(marker<?=$_dat['id_sch'];?>, 'mouseout', function() {
			infowindow<?=$_dat['id_sch'];?>.close();
			zindex = marker<?=$_dat['id_sch'];?>.getZIndex(<?=$_dat['latitude'];?>);
			zindex -= 1000;
			marker<?=$_dat['id_sch'];?>.setZIndex(zindex);
		});
	<?
		}
		if( $sch_all_rows > 1){
	?>
	//北西端の座標を設定
	var sw = new google.maps.LatLng(maxlat,minlng);
	//東南端の座標を設定
	var ne = new google.maps.LatLng(minlat,maxlng);
	 
	//範囲を設定
	var bounds = new google.maps.LatLngBounds(sw, ne);
	 
	//自動調整
	map.fitBounds(bounds);
	<?
		}else{
			
	?>
		map.setCenter(latlng);
		map.setZoom(15);
	<?
		}
	?>
}
//]]>
</script>


<table width="620" border="0" cellspacing="0" cellpadding="1">
<tr bgcolor="#ffffff"> 
<td>
<center> 
<table summary="schList" width="95%" border="0" cellspacing="1" cellpadding="3">
<tr> 
<td>
<!--b class="result">学校一覧</b>
<img src="../image/space.gif" width="30" height="1"-->
<b>該当校は（<font color=#ff0000><?=$_SESSION['school']['search_dat']['max_rows'];?>件</font>）ありました。</b></td>
</tr>





</table>
</center> 
</td>
</tr>
</table>


<center>
<div id="schList">
<?php
	for($n=0; $n < $sch_rows; $n++){
		$_dat = pg_fetch_array($rs_sch,$n,PGSQL_ASSOC);
?>
	<div class="contents">
		<div class="schTitleWrap">
			<div class="schTitle">
				<div class="sch_name"><?=$_dat['name'];?></div>
				<?//アイコン表示
/*
						if ($_dat['grade']==0){
							echo'<img class="features_icon" src="image/ico_tyu.gif" border=0>';
						} elseif ($_dat['grade']==1){
							echo'<img class="features_icon" src="image/ico_koutou.gif" border=0>';
						} elseif ($_dat['grade']==2){
							echo'<img class="features_icon" src="image/ico_kyoiku.gif" border=0>';
						}
*/
						if ($_dat['sex']==0){
							echo'<img class="features_icon" src="image/btn_coeducation.gif" border=0>';
						} elseif ($_dat['sex']==1){
							echo'<img class="features_icon" src="image/btn_boy.gif" border=0>';
						} elseif ($_dat['sex']==2){
							echo'<img class="features_icon" src="image/btn_girl.gif" border=0>';
						} elseif ($_dat['sex']==3){
							echo'<img class="features_icon" src="image/btn_communication.gif" border=0>';
						}
						if ($_dat['ryo']){
							echo'<img class="features_icon" src="image/btn_dormitory.gif" border=0>';
	//						echo'<div>';
						}
				?>
			</div>
		</div>
		<table summary="sch_detail">
			<tr> 
			<th>所在地 </th>
			<td> <?=$_dat['jusho'];?> </td>
			</tr>
			<tr> 
			<th> 連絡先 </th>
			<td> <?=$_dat['tel'];?> </td>
			</tr>
			<?if ($_dat['kotsu']){?>
			<tr> 
			<th>アクセス情報 </th>
			<td> <?=$_dat['kotsu'];?> </td>
			</tr>
			<?}?>
			<?if ($_dat['comment']){?>
			<tr> 
			<th>コメント </th>
			<td> <?=$_dat['comment'];?> </td>
			</tr>
			<?}?>
		</table>
		<div class="detail">
			<a href="<?=$PHP_SELF;?>?mode=detail&id_sch=<?=$_dat['id_sch'];?>&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>">
			<img src="image/btn_details_off.gif" border=0 alt="詳細を見る">
			</a>
		</div>
	</div>
<?php
	}
?>
</div>
</center>
















<center>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
<tr> 
<td height="5" colspan="4"></td>
</tr>
<tr> 
<!--td width="1%"><img src="image/arrow_left.gif" width="10" height="10" hspace="2"></td>
<td width="49%"-->
<?php
	if ($_gvars['offset']){
		if ($_gvars['mode']=="list_all"){
?>
<td width="1%"><img src="image/arrow_left.gif" width="10" height="10" hspace="2"></td>
<td width="49%">
<a href="<?=$PHP_SELF;?>?mode=list_all&offset=<?=($_gvars['offset']-BBS_PMAX);?>&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>">前の<?=BBS_PMAX;?>件</a></td>
<?
		} else {
?>
<td width="1%"><img src="image/arrow_left.gif" width="10" height="10" hspace="2"></td>
<td width="49%">
<a href="<?=$PHP_SELF;?>?mode=search&offset=<?=($_gvars['offset']-BBS_PMAX);?>&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>">前の<?=BBS_PMAX;?>件</a></td>
<?
		}
	} else {
print "<td width=\"1%\">&nbsp;</td>";
print "<td width=\"49%\">";
print "&nbsp;";
	}
?>
</td>
<td width="49%" align="right">
<?
	if ((BBS_PMAX+$_gvars['offset'])<$_SESSION['school']['search_dat']['max_rows']){
		if ($_gvars['mode']=="list_all"){
?>
<a href="<?=$PHP_SELF;?>?mode=list_all&offset=<?=($_gvars['offset']+BBS_PMAX);?>&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>">次の<?=BBS_PMAX;?>件</a>
<?
		} else {
?>
<a href="<?=$PHP_SELF;?>?mode=search&offset=<?=($_gvars['offset']+BBS_PMAX);?>&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>">次の<?=BBS_PMAX;?>件</a>
</td>
<td width="1%" align="right"><img src="image/arrow_right.gif" width="10" height="10" hspace="2"></td>
<?
		}
	} else {
		print "&nbsp;";
		print "</td>";
		print "<td width=\"1%\" align=\"right\">&nbsp;</td>";
	}
?>
<!--/td>
<td width="1%" align="right"><img src="image/arrow_right.gif" width="10" height="10" hspace="2"></td-->
</tr>
</table>
</center>
<!--/td>
</tr>
</table-->
<?
	}
?>
<!-- 20110322 -->
