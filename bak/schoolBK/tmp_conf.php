<?php
function name_grade(){
	//20110322//
	//$arr = array("中学校","高等学校","中等教育学校");
	$arr = array("中学校","高等学校");
	//20110322//
	return $arr;
}
function name_sex(){
	//20110322//
	//$arr = array("男女共学","男子校","女子校","通信制");
	$arr = array("共学校","男子校","女子校","通信制","寮あり");
	//20110322//
	return $arr;
}
function others_fields(){
	$arr = array("name","kana","comment","jusho",
		"kotsu","hoshin","gakka","course",
		"shukyo","ryoko","ryugaku","gyoji",
		"club","koryu","sehuku","meet_date",
		"meet_full","ninzu","appl_date","exam_date",
		"view_date","kamoku","pass_date","fee_biko",
		"kanren","tel","shinro","comment");
	return $arr;
}

define(img_sch_dir,'../image/img_sch/');
define(img_act_dir,'../image/img_act/');
define(img_uni_dir,'../image/img_uni/');
define(img_uni2_dir,'../image/img_uni2/');
?>