<?php
	/* リストア */
	if(isSet($_gvars['act']) && $_gvars['act']=="load") $_SESSION['school']['search_dat'] =$_gvars;
	if(isSet($_SESSION['school']['search_dat'])) $_dvars = $_SESSION['school']['search_dat'];
	//項目配列抽出
	$name_grade = name_grade();
	$name_sex   = name_sex();
	if(count($name_grade)>count($name_sex)){
		$tbl_cols = count($name_grade);
	} else {
		$tbl_cols = count($name_sex);
	}
	
?>
<style type="text/css">
<!--
.textform
{
    BORDER-RIGHT: #ff6600 1px solid;
    BORDER-TOP: #ff6600 1px solid;
    BORDER-LEFT: #ff6600 1px solid;
    BORDER-BOTTOM: #ff6600 1px solid;
    PADDING-TOP: 2px;PADDING-RIGHT: 2px;PADDING-LEFT: 2px;PADDING-BOTTOM: 2px;
    BACKGROUND-COLOR: #FFF0F0
}
.rubi{font-size:12px;}
.result{font-size:18px;}
-->
</style>
<script language="JavaScript">
<!--
function wopen1(){
	window.open("../top/about.html","window1","resizable=yes,scrollbars=yes,width=580,height=550");
}
//-->
</script>
<!--20110322-->
<!--
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" text="#333333">
-->
<!--20110322-->




<div id="wrap">
	<div class="STitle_s">
		<div style="float:left;"><h3>キーワード・マップで探す</h3></div>
		<div style="text-align: right;"><a href="search.php?mode=list_all&act=load&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="./image/btn_03.gif" alt="検索方法" /></a></div>
  </div>
<br />

  <center>
	<div id="searchMethod">
		<div style="float:left;clear:both;">
		<img src="./image/title_01.gif" alt="検索方法" />
		</div>
		<div style="float:left;clear:both;">
		<p style="margin:10px 0px;">行きたい学校や知りたい情報等から学校名を検索できます。</p>
		</div>
	</div>
	</center>
	<!--div id="sch_all">
		<a href="search.php?mode=list_all&act=load&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="./image/btn_01_off.gif" alt="学校一覧から探す" /></a>
	</div-->
	<div id="step">
		<img src="./image/step.gif" alt="検索方法" />
	</div>
	<div id="searchBox">
<?
	if ($_SESSION['school']['search_dat'] && $_gvars['mode'] == 'search') $_s = $_SESSION['school']['search_dat'];
	if(isSet($_gvars['grade']) && is_array($_gvars['grade'])){
		foreach($_gvars['grade'] AS $key => $val){
			$search_grade = $val;
		}
	}elseif(isSet($_s['grade']) && is_array($_s['grade'])){
		foreach($_s['grade'] AS $key => $val){
			$search_grade = $val;
		}
	}
	if($search_grade == 1){
?>
		<div id="mapTop"><a href="javascript:void(0)" onClick="search_submit('0'); return false;"><img id="junior" src="./image/junior_02.gif" alt="中学校" /></a><a href="javascript:void(0)" onClick="search_submit('1'); return false;"><img id="high" src="./image/high_01.gif" alt="高等学校" /></a><img src="./image/box_top.gif" /></div>
<?
	}else{
?>
		<div id="mapTop"><a href="javascript:void(0)" onClick="search_submit('0'); return false;"><img id="junior" src="./image/junior_01.gif" alt="中学校" /></a><a href="javascript:void(0)" onClick="search_submit('1'); return false;"><img id="high" src="./image/high_02.gif" alt="高等学校" /></a><img src="./image/box_top.gif" /></div>
<?
	}
?>
		<div id="mapBody">
			<center>
			<div id="map" style="width: 90%; height: 440px"></div>
			<!--div id="map" style="width: 1000px; height: 1000px"></div-->
			<div class="search_form">
				<form action="./search.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>#junior" method="GET" name="Form">
				<input type="hidden" name="xxxxx_yyyyy" value="<?=md5(md5(date("Y-m-dH:i:s")));?>">
				<input type="hidden" name="mode" value="search">
				<input type="hidden" name="act" value="load">
				<?
					$cnt=0;
					foreach($name_grade as $key => $val){
					if($_dvars['grade'][$cnt]==$key){
				?>
					<input type="hidden" id="grade[]" name="grade[]" value="<?=$key;?>"
					<?
						$cnt++;
					?>
					>
					<?
					}
					?>
				<?
					}
				?>
				<table style="margin-bottom:15px;" summary="sch_search">
					<tr>
						<th>学校区分</th>
						<td>
						<?
							$cnt=0;
							foreach($name_sex as $key => $val){
						?>
						<input type="checkbox" name="sex[]" value="<?=$key;?>"
						<?
							if($_dvars['sex'][$cnt]!="" && $_dvars['sex'][$cnt]==$key){
								$cnt++;
						?>
								 checked 
						<?
							}
						?>
						>
						<?=$val;?>
						<?
							}
						?>
						</td>
					</tr>
					<tr>
						<th>キーワード</th>
						<td> 
						<input type="text" name="others" size="65" value="<?=$_dvars['others'];?>">
						</td>
					</tr>
					<tr>
						<th>所在地 <span style="font-weight:normal;">※任意</span></th>
						<td>
						<?php
							//エリアマスタ
							$sql_area="select id_area,area_name from area_mst "
								."where del_flg='f' order by id_area asc";
							$rs_area = pg_exec($con,$sql_area);
							$rows_area= pg_numrows($rs_area);
						?>
						<select name="id_area">
						<option value="">《地域》</option>
						<?
							for($n=0; $n < $rows_area; $n++){
						?>
						<option value="<?=pg_result($rs_area,$n,0);?>"<?
								if($_dvars['id_area']!="" && $_dvars['id_area']==pg_result($rs_area,$n,0)) echo" selected";
						?>>
						<?=pg_result($rs_area,$n,1);?>
						</option>
						<?
							}
						?>
						</select>
						<?php
							//沿線マスタ
							//20110322
							//$sql_line ="select id_line,line_name from line_mst "
							//	."where del_flg='f' order by kana asc";
							$sql_line = "SELECT lm.id_line,lm.line_name,lcm.id_line_company,lcm.line_company_name FROM line_mst AS lm ".
										"LEFT JOIN line_company_mst AS lcm ON lm.id_line_company = lcm.id_line_company ".
										"WHERE lm.del_flg='f' order by lm.kana asc";
							//20110322
							$rs_line  = pg_exec($con,$sql_line);
							$rows_line= pg_numrows($rs_line);
							$company_arr = array();
							$_dat = array();
							for($n=0; $n < $rows_line; $n++){
								$_dat = pg_fetch_array($rs_line,$n,PGSQL_ASSOC);
								$company_arr[$_dat['line_company_name']][] = $_dat;
							}
						?>

						<select name="id_line" onChange="Form.action='./search.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>#junior';Form.submit();">
						<option value="">《沿線》</option>
						<?
						foreach($company_arr AS $key => $arr){
						?>
						<OPTGROUP label="<?=$key;?>">
						<?
						foreach($arr AS $key2 => $arr2){
						?>
						<option value="<?=$arr2['id_line'];?>"<?
						if($_dvars['id_line']!="" && $_dvars['id_line']==$arr2['id_line']) echo" selected";
						?>>
						<?=$arr2['line_name'];?>
						</option>
						<?
						}
						?>
						</OPTGROUP>
						<?
						}
						?>
						</select>

						<select name="id_eki">
						<option value="">《最寄駅》</option>
						<?php
							if($_dvars['id_line']){
								$sql_eki="select id_eki,eki_name from eki_mst "
									."where del_flg='f' and id_line='".$_dvars['id_line']."' "
									."order by id_eki asc";
								$rs_eki = pg_exec($con,$sql_eki);
								for($n=0; $n < pg_numrows($rs_eki); $n++){
						?>
						<option value="<?=pg_result($rs_eki,$n,0);?>"<?
								if($_dvars['id_eki']!="" && $_dvars['id_eki']==pg_result($rs_eki,$n,0)) echo" selected";
						?>>
						<?=pg_result($rs_eki,$n,1);?>
						</option>
						<?php
								}
							}
						?>
						</select>
						</td>
					</tr>
				</table>
				<a href="javascript:void(0);" onClick="search_submit('submit'); return false;"><img src="./image/btn_search_off.gif" alt="検索する" /></a>
			</form>
			</div>
			</center>
		<div id="mapBottom"></div>
		</div>
	</div>
</div>
