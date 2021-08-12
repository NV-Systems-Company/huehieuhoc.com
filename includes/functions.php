<?php
function page_fast_transfer($page="index.php")
{
     $page_transfer = $page;
     include("./transfer_fast.tpl");
     exit();
}
function page_stop_transfer($msg,$page="index.php")
{
     $showtext = $msg;
     $page_transfer = $page;
     include("./transfer_stop.tpl");
     exit();
}
function page_transfer($msg,$page="index.php")
{
     $showtext = $msg;
     $page_transfer = $page;
     include("./transfer.tpl");
     exit();
}

function check_login()
{
     if ( isset($_SESSION["login"])&&($_SESSION["login"]=="logined") ) return true;

     $msg = "B&#7841;n ch&#432;a &#273;&#259;ng nh&#7853;p.";
     $page_url = "index.php";
     page_transfer($msg,$page_url);
     return false;
}

function get_user_info()
{
     $user = array();
     $user["id"]       = isset($_SESSION["user_id"])  ? $_SESSION["user_id"]  : 0;
     $user["email"]    = isset($_SESSION["email"])    ? $_SESSION["email"]    : '';
     $user["realname"] = isset($_SESSION["realname"]) ? $_SESSION["realname"] : '';
     $user["timezone"] = isset($_SESSION["timezone"]) ? $_SESSION["timezone"] : 7;
     $user["update_finance"] = isset($_SESSION["update_finance"]) ? $_SESSION["update_finance"] : -1;
     $user["update_news"] 	 = isset($_SESSION["update_news"])    ? $_SESSION["update_news"] 	: -1;
     $user["admin"] 		 = isset($_SESSION["admin"]) 	 	  ? $_SESSION["admin"] 			: -1;
     return $user;
}

function str_replace_tab($str)
{
	$result = str_replace("\n","<br>",$str);
	$result = str_replace("&lt;b&gt;","<b>",$result);
	$result = str_replace("&lt;/b&gt;","</b>",$result);
	return $result;
}

function check_date_vietnam($text)
{
	$first = strpos($text, "-");
	$last = strrpos($text, "-");

	$ngay = substr($text,0,$first);
	$thang = substr($text,$first+1,$last-$first-1);
	$nam = substr($text,$last+1);
	
	if (checkdate($thang, $ngay, $nam))
		return true;
	else
		return false;
}

function get_day($text)
{
	$first = strpos($text, "-");
	$ngay = substr($text,0,$first);
	return $ngay;
}

function get_month($text)
{
	$first = strpos($text, "-");
	$last = strrpos($text, "-");
	$thang = substr($text,$first+1,$last-$first-1);
	return $thang;
}

function get_year($text)
{
	$last = strrpos($text, "-");
	$nam = substr($text,$last+1);
	return $nam;
}

function cv_date_sql($date_vn)
{
	$first = strpos($date_vn, "-");
	$last = strrpos($date_vn, "-");

	$ngay = substr($date_vn,0,$first);
	$thang = substr($date_vn,$first+1,$last-$first-1);
	$nam = substr($date_vn,$last+1);
	
	$date_sql = $nam.'-'.$thang.'-'.$ngay;
	return $date_sql;
}

function cv_date_vietnam($date_sql)
{
	$first = strpos($date_sql, "-");
	$last = strrpos($date_sql, "-");

	$nam = substr($date_sql,0,$first);
	$thang = substr($date_sql,$first+1,$last-$first-1);
	$ngay = substr($date_sql,$last+1);
	
	$date_vn = $ngay.'-'.$thang.'-'.$nam;
	return $date_vn;
}
?>