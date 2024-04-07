<?php
	$sql_uni ="select sehuku from sch_mst"
		." where del_flg='f' and id_sch='".$_gvars['id_sch']."'";
	$rs_uni  = @pg_exec($con,$sql_uni);
?>
<div align="center">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="10">
<tr> 
<td>
<table cellspacing=0 cellpadding=0 width="100%" height="100%" border=0>
<tr valign=top> 
<td height=10> 
<table cellspacing=0 cellpadding=1 border=0 width="100%" height="100%">
<tr bgcolor=#333333> 
<td>
<table cellspacing=1 cellpadding=3 width="100%" height="100%" border=0>
<tr> 
<td bgcolor=#ffcc33 height="25"> <b>À©Éþ</b></td>
</tr>
<tr bgcolor="#FFFFFF"> 
<td align="center"> 
<table border="0" cellspacing="0" cellpadding="2" width="100%" height="100%">
<tr> 
<td valign=top height="3">
</td>
</tr>
<tr bgcolor="#FFFFFF" height="1%"> 
<td bgcolor="#FFFFFF" align="center" valign="top">
<?php
$name_img  = $_gvars['id_sch'].".jpg";
if (file_exists(img_uni_dir.$name_img)) echo "<img src=\"".img_uni_dir.$name_img."\"> ";
if (file_exists(img_uni2_dir.$name_img)) echo "<img src=\"".img_uni2_dir.$name_img."\">";
?>
</td>
</tr>
<tr bgcolor="#FFFFFF"> 
<td bgcolor="#FFFFFF" valign="top" height="99%">
<?php
 if (@pg_numrows($rs_uni)) echo @pg_result($rs_uni,0,0);
?>
</td>
</tr>
<tr height="10"> 
<form>
<td align="center">
<input type="button" value="ÊÄ¤¸¤ë" onClick="window.close();">
</td>
</form>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
