

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

<div id="wrap">
	<div class="STitle_s">
		<div style="float:left;"><h3>学校一覧から探す</h3></div>
		<div style="text-align: right;"><a href="search.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="./image/btn_04.gif" alt="学校一覧から探す" /></a></div>
  </div>
<br />
</div>

<div id="wrap">
	<!--div class="STitle">
		<h3>学校一覧から探す</h3>
	</div>
	<div id="sch_all">
		<a href="search.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="./image/btn_02_off.gif" alt="学校一覧から探す" /></a>
	</div-->
	<div id="sarch_method">
		<p>全学校の一覧です。自分に合った個別情報を見つけよう！</p>
	</div>
</div>

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
<TABLE cellSpacing=0 cellPadding=0 width=620 border=0>
<TR> 
<TD> 
<script language="JavaScript">
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
</TD>
</TR>
</TABLE>

<?php
	
	$sql_sch="SELECT * FROM sch_mst"
		." WHERE del_flg='f'"
//		." order by id_sch";
//		." ORDER BY grade,sex,kana";
		." ORDER BY grade,sort_key";		//ソート指定変更 2008.6.18
	if(!pg_exec($con,$sql_sch)) exit;
	$rs_sch = pg_exec($con,$sql_sch);
	if(!$sch_rows = pg_numrows($rs_sch)){
?>
<table width="620" border="0" cellspacing="0" cellpadding="1">
<tr bgcolor="#ffffff"> 
<td> 
<table width="100%" border="0" cellspacing="1" cellpadding="3">
<tr> 
<td><b class="result">学校一覧</b>
<img src="../image/space.gif" width="30" height="1">
<b>該当校は見つかりませんでした。</b></td>
</tr>
</table>
</td>
</tr>
</table>
<?php
	}else{
?>

<div id="schAllList">
<?php
		print	"<img id=\"allJuniorTab\" onClick=\"change_grade('junior'); return false;\" src=\"image/junior_04.gif\" alt=\"中学校\" /><img id=\"allHighTab\" onClick=\"change_grade('high'); return false;\" src=\"image/high_03.gif\" alt=\"高等学校\" /><img  src=\"image/line_01.gif\" alt=\"女子校\" />";

		$sch_all_arr = array();
		for($n=0; $n < $sch_rows; $n++){
			$_dat = pg_fetch_array($rs_sch,$n,PGSQL_ASSOC);
			//$sch_all_arr[$_dat['grade']][$_dat['sex']][] = $_dat;
			
			//中等の学校を中学の一覧に加える
			if( $_dat['grade'] != 2 ){
				$sch_all_arr[$_dat['grade']][$_dat['sex']][] = $_dat;
			}else{
				$sch_all_arr[0][$_dat['sex']][] = $_dat;
			}
		}
		$n = 0;

		print "<div id=\"gradeLink\">";
		print "<div id=\"juniorLink\">";
		print "<a href=\"#junior_boy\"><img src=\"image/btn_boy_off.gif\" alt=\"男子校\" /></a>";
		print "<a href=\"#junior_girl\"><img src=\"image/btn_girl_off.gif\" alt=\"女子校\" /></a>";
		print "<a href=\"#junior_coeducation\"><img src=\"image/btn_coeducation_off.gif\" alt=\"共学校\" /></a>";
		//print "<a href=\"#junior_commu\"><img src=\"image/btn_communication_off.gif\" alt=\"通信制・単位制\" /></a>";
		print "</div>";
		print "<div id=\"highLink\" style=\"display:none\">";
		print "<a href=\"#high_boy\"><img src=\"image/btn_boy_off.gif\" alt=\"男子校\" /></a>";
		print "<a href=\"#high_girl\"><img src=\"image/btn_girl_off.gif\" alt=\"女子校\" /></a>";
		print "<a href=\"#high_coeducation\"><img src=\"image/btn_coeducation_off.gif\" alt=\"共学校\" /></a>";
		print "<a href=\"#high_commu\"><img src=\"image/btn_communication_off.gif\" alt=\"通信制・単位制\" /></a>";
		print "</div>";
		print "</div>";

		foreach($sch_all_arr AS $key => $val){

			$grade_class = ($key == 1) ? 'high':'junior';

			//並べ替え
			$tmp_arr = array();
			if( isSet($val['1']) && is_array($val['1'])) {
				$tmp_arr['1'] = $val['1'];
			}
			if( isSet($val['2']) && is_array($val['2'])) {
				$tmp_arr['2'] = $val['2'];
			}
			if( isSet($val['0']) && is_array($val['0'])) {
				$tmp_arr['0'] = $val[0];
			}
			if( isSet($val['3']) && is_array($val['3'])) {
				$tmp_arr['3'] = $val['3'];
			}
			$val = array();
			$val = $tmp_arr;
			print "<center>";
			print "<table id=\"".$grade_class."Tab\">";
			foreach($val AS $key2 => $val2){
				print "<tr>";
				if($key2 == 0){
					print  "<th colspan=\"2\"><div class=\"schTitleWrap\"><div class=\"schTitle\"><a id=\"".$grade_class."_coeducation\">共学校</a></div></div></th>";
				}elseif($key2 == 1){
					print  "<th colspan=\"2\"><div class=\"schTitleWrap\"><div class=\"schTitle\"><a id=\"".$grade_class."_boy\">男子校</a></div></div></th>";
				}elseif($key2 == 2){
					print  "<th colspan=\"2\"><div class=\"schTitleWrap\"><div class=\"schTitle\"><a id=\"".$grade_class."_girl\">女子校</a></div></div></th>";
				}elseif($key2 == 3){
					print  "<th colspan=\"2\"><div class=\"schTitleWrap\"><div class=\"schTitle\"><a id=\"".$grade_class."_commu\">通信制・単位制</a></div></div></th>";
				}
				print "</tr>";
				$c_cnt = 0;
				for($i=0;$i<count($val2);$i++){
					if($i%2 == 0){
						print "<tr>";
						$c_cnt++;
					}
					if($c_cnt%2){
						print "<td style=\"width:50%;\" class=\"even\">";
					}else{
						print "<td style=\"width:50%;\">";
					}
					/*
					print "<a href=".$PHP_SELF."?mode=detail&id_sch=".$val2[$i]['id_sch'].
							"&xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")))."><b>".$val2[$i]['name']."</b></a>";
					if($val2[$i]['ryo']) echo'<img class="icon" style="arign:right;vertical-align: middle;" src="image/btn_dormitory.gif" border=0>';
					*/
					//if($val2[$i]['sex']==3){ echo'<img class="icon" style="arign:right;vertical-align: middle;" src="image/ico_tushin.gif" border=0>';}

					print "<a style=\"float:left;\" href=".$PHP_SELF."?mode=detail&id_sch=".$val2[$i]['id_sch'].
							"&xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")))."><b>".$val2[$i]['name']."</b></a>";
					if($val2[$i]['ryo']) echo'<img class="icon" style="float:right;arign:right;vertical-align: middle;" src="image/btn_dormitory.gif" border=0>';

					print "</td>";
					
					if($i%2 != 0){
						print "</tr>";
					}
					if($i%2 == 0 && $i == (count($val2)-1)){
						if($c_cnt%2){
							print "<td class=\"even\">&nbsp;</td></th></tr>";
						}else{
							print "<td>&nbsp;</td></th></tr>";
						}
					}
					if($i == (count($val2)-1)){
						print "<tr><td class=\"pageTop\" colspan=\"2\"><a href=\"#top\">△ページの先頭へ戻る</a></td></tr>";
					}
				}
			}
			print "</table>";
			print "</center>";
		}
?>





<!--tr> 
<td class="<?=$tdcolor;?>"> 
<a href="<?=$PHP_SELF;?>?mode=detail&id_sch=<?=$_dat['id_sch'];?>&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>">
<b><?=$_dat['name'];?></b></a> </td>
<td class="<?=$tdcolor;?>" align="right">
<?//アイコン表示
		if($_dat['grade']==0){
			echo'<img src="image/ico_tyu.gif" border=0>';
		}elseif($_dat['grade']==1){
			echo'<img src="image/ico_koutou.gif" border=0>';
		}elseif($_dat['grade']==2){
			echo'<img src="image/ico_kyoiku.gif" border=0>';
		}
		if($_dat['sex']==0){
			echo'<img src="image/btn_coeducation.gif" border=0>';
		}elseif($_dat['sex']==1){
			echo'<img src="image/btn_boy.gif" border=0>';
		}elseif($_dat['sex']==2){
			echo'<img src="image/btn_girl.gif" border=0>';
		}elseif($_dat['sex']==3){
			echo'<img src="image/btn_communication.gif" border=0>';
		}
		if($_dat['ryo']) echo'<img src="image/btn_dormitory.gif" border=0>';
?>
</td>
</tr-->
</div>
<?php
	}
?>
<?php
//	}
?>
