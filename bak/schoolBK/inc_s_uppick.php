<?php
	$sql_uplog="select id_sch_u,up_date,title,comment,link from sch_u_tbl"
		." where del_flg='f' and id_sch_u='".$_gvars['id_sch_u']."'";
	$rs_uplog = pg_exec($con,$sql_uplog);
?>
<html>
<head>
<title><?=ereg_replace("-","/",pg_result($rs_uplog,0,1));?></title>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<link rel=stylesheet href="../style.css" type="text/css">
</head>
<body bgcolor="#FFAF00" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" text="#003366">
<table width="100%" border="0" cellspacing="10" cellpadding="3" height="100%">
  <tr bgcolor="#FFFFFF" valign="top"> 
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="3" height="100%">
        <tr valign="top"> 
          <td><b><?=pg_result($rs_uplog,0,3);?></b><br>
          </td>
        </tr>
	<?if(pg_result($rs_uplog,0,4)){?>
        <tr valign="bottom"> 
          <td>URL : <a href="<?=$_dlv->Ent2Meta(pg_result($rs_uplog,0,4));?>?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>" target="_blank">
	<?=pg_result($rs_uplog,0,4);?></a></td>
        </tr>
	<?}?>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
