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
</script><div class="STitle"><h3>�����Ǹ�������</h3></div><br><br>
<form>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
<tr>
<!--td width="1%"><a href="search.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="../image/tab_01.gif" alt="������ɸ���" width="126" height="25" border="0"></a></td//-->
<td width="1%"><a href="map_jj.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="../image/tab_02j.gif" alt="�ޥå׸�������ع���" width="126" height="25" border="0"></a></td>
<!--td width="1%"><a href="map_h.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="../image/tab_03.gif" alt="�ޥå׸����ʹ����ع���" width="126" height="25" border="0"></a></td//-->
<td width="1%"><a href="search_j.php?mode=list_j&act=load&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="../image/tab_04.gif" alt="	��ع���������õ��" width="126" height="25" border="0"></a></td>
<td><img src="../image/tab_back_j.gif" alt=""></td>
</tr>
</table>

<br>
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
<td>
<font class="mid2" color="#990000">
���λ�Ω��ع��ΰ����Ǥ�����ʬ�˹�ä����̾���򸫤Ĥ��褦��</font></td>
</tr>
</table>

</form>
</TD>
</TR>
</TABLE>

<br><br>

<table width="620" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#ffffff"> 
<td align="right"> 
<table border="0" cellspacing="0" cellpadding="1">
<tr>
<td>
<img src="image/ico_tyu.gif" border=0>
</td>
<td class="rubi">
��ع� 
</td>
<!--td>
<img src="image/ico_koutou.gif" border=0>
</td>
<td class="rubi">
�����ع� 
</td//-->
<td>
<img src="image/ico_kyoiku.gif" border=0>
</td>
<td class="rubi">
��������ع� 
</td>
<td>
<img src="image/ico_kyogaku.gif" border=0>
</td>
<td class="rubi">
���ع� 
</td>
<td>
<img src="image/ico_man.gif" border=0>
</td>
<td class="rubi">
�˻ҹ� 
</td>
<td>
<img src="image/ico_woman.gif" border=0>
</td>
<td class="rubi">
���ҹ� 
</td>
<td>
<img src="image/ico_tushin.gif" border=0>
</td>
<td class="rubi">
�̿��� 
</td>
<td>
<img src="image/ico_ryo.gif" border=0>
</td>
<td class="rubi">
��ͭ�� 
</td>
</tr>
</table>
</td>
</tr>
</table>
<?php
	
	$sql_sch="SELECT * FROM sch_mst"
		." WHERE del_flg='f'"
		." AND grade IN('0','2')"
//		." order by id_sch";
//		." ORDER BY grade,sex,kana";
		." ORDER BY grade,sort_key";		//�����Ȼ����ѹ� 2008.6.18
	if(!pg_exec($con,$sql_sch)) exit;
	$rs_sch = pg_exec($con,$sql_sch);
	if(!$sch_rows = pg_numrows($rs_sch)){
?>
<table width="620" border="0" cellspacing="0" cellpadding="1">
<tr bgcolor="#ffffff"> 
<td> 
<table width="100%" border="0" cellspacing="1" cellpadding="3">
<tr> 
<td><b class="result">�ع�����</b>
<img src="../image/space.gif" width="30" height="1">
<b>�������ϸ��Ĥ���ޤ���Ǥ�����</b></td>
</tr>
</table>
</td>
</tr>
</table>
<?php
	}else{
?>
<table width="620" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#ffffff"> 
<td> 
<table width="100%" border="0" cellspacing="1" cellpadding="3">
<tr> 
<td><b class="result">�ع�����</b></td>
</tr>
<?php
	for($n=0; $n < $sch_rows; $n++){
		if($n%2){
			$bgcolor="#ffffff";
		}else{
			$bgcolor="#e0e0e0";
		}
		$_dat = pg_fetch_array($rs_sch,$n,PGSQL_ASSOC);
?>
<tr align="right"> 
<td bgcolor="#FFFFFF"> 
<table width="100%" border="0" cellspacing="0" cellpadding="1">
<tr valign="middle" bgcolor="<?=$bgcolor;?>"> 
<td> 
<a href="<?=$PHP_SELF;?>?mode=detail&id_sch=<?=$_dat['id_sch'];?>&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>">
<b><?=$_dat['name'];?></b></a> </td>
<td align="right">
<?//��������ɽ��
		if($_dat['ryo']) echo'<img src="image/ico_ryo.gif" border=0>';
		if($_dat['grade']==0){
			echo'<img src="image/ico_tyu.gif" border=0>';
		}elseif($_dat['grade']==1){
			echo'<img src="image/ico_koutou.gif" border=0>';
		}elseif($_dat['grade']==2){
			echo'<img src="image/ico_kyoiku.gif" border=0>';
		}
		if($_dat['sex']==0){
			echo'<img src="image/ico_kyogaku.gif" border=0>';
		}elseif($_dat['sex']==1){
			echo'<img src="image/ico_man.gif" border=0>';
		}elseif($_dat['sex']==2){
			echo'<img src="image/ico_woman.gif" border=0>';
		}elseif($_dat['sex']==3){
			echo'<img src="image/ico_tushin.gif" border=0>';
		}
?>
</td>
</tr>
</table>
</td>
</tr>
<?php
	}
?>
</table>
</td>
</tr>
</table>
<?php
	}
?>
