<?php
	/* リストア */
	if(isSet($_gvars['act']) && $_gvars['act']=="back"){
		$_gvars = $_SESSION['sch']['search_dat'];
	}elseif(is_array($_gvars) && count($_gvars)){
		$_SESSION['sch']['search_dat'] =$_gvars;
	}elseif(is_array($_SESSION['sch']['search_dat']) && count($_SESSION['sch']['search_dat'])){
		$_gvars =$_SESSION['sch']['search_dat'];
	}

	
	//項目配列抽出
	$name_grade = name_grade();
	$name_sex   = name_sex();
	if(count($name_grade)>count($name_sex)){
		$tbl_cols = count($name_grade);
	}else{
		$tbl_cols = count($name_sex);
	}
?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <FORM name="Form" action="../school/search.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>" method="get">
                  <input type="hidden" name="mode" value="search">
                  <input type="hidden" name="act" value="load">
                <tr> 
                  <td><img src="image/title_school.gif" width="430" height="17" alt="学校紹介"></td>
                </tr>
                <tr> 
                  <td><img src="image/space.gif" width="5" height="5"></td>
                </tr>
                <tr> 
                  <td><img src="image/text.gif" width="328" height="22"></td>
                </tr>
                <tr> 
                  <td><img src="image/space.gif" width="5" height="5"></td>
                </tr>
                <tr> 
                  <td> 
                    <table width="430" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td><img src="image/tab_keyword.gif" width="91" height="30" alt="キーワード検索"></td>
                              <td><a href="../school/map_j.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="image/tab_map1.gif" width="100" height="30" border="0" alt="マップ検索（中学校）"></a></td>
                              <td><a href="../school/map_h.php?<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="image/tab_map2.gif" width="100" height="30" border="0" alt="マップ検索（高等学校）"></a></td>
                              <td><a href="../school/search.php?mode=list_all&act=load&<?="xxxxx_yyyyy=".md5(md5(date("Y-m-dH:i:s")));?>"><img src="image/tab_ichiran.gif" width="100" height="30" border="0" alt="学校一覧から探す"></a></td>
                              <td><img src="image/tab_edge.gif" width="39" height="30"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr background="image/search_w.gif"> 
                        <td background="image/search_w.gif"> 
                          <table cellspacing=0 cellpadding=3 border=0 align="center" width="400" background="image/space.gif">
                            <tbody> 
                            <tr> 
                              <td colspan=4> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="1%"><img src="image/keyword.gif" width="180" height="22"></td>
                                    <td width="99%" align="right" valign="middle" class="mid2">
                                    <a href="JavaScript:wopen1()">
                                    検索キーワードと検索方法について</a>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            <tr> 
                              <td colspan=3> 
                                <table border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td class="textform"> 
                        <input type="text" name="others" size="45" value="<?=$_gvars['others'];?>">
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <td> 
                        <input type=image alt=検索実行 src="image/b_search.gif" 
                        border=0 name=submit width="73" height="27">
                              </td>
                            </tr>
                            <tr> 
<?
		$cnt=0;
		foreach($name_grade as $key => $val){
?>
                              <td height="26"> 
                        <input type="radio" name="grade[]" value="<?=$key;?>"<?
			if($_gvars['grade'][$cnt]==$key){
				$cnt++;
				echo" checked";
			}
						?>><?=$val;?>
                              </td>
<?
		}
?>
                            </tr>
                            <tr> 
<?
		$cnt=0;
		foreach($name_sex as $key => $val){
		?>
                              <td> 
                        <input type="checkbox" name="sex[]" value="<?=$key;?>"<?
			if($_gvars['sex'][$cnt]!="" && $_gvars['sex'][$cnt]==$key){
				$cnt++;
				echo" checked";
			}
						?>><?=$val;?>
                              </td>
		<?
		}
		?>
                            </tr>
                            </tbody> 
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td><img src="image/search_wunder.gif" width="430" height="15"></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </FORM>
            </table>
