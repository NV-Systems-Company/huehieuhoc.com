<?php

$second_timeout = 1800; // 30'
$nowtime  = time();
$time_update = $nowtime - $second_timeout; 

$dbsql = new db_mysql;
$dbsql->connect();
$dbsql->selectdb();

session_name("sid");
session_start();

if (!isset($_SESSION["sess_id"]))
{
	//session_register("sess_id");
	$_SESSION["sess_id"] ='';
}		
if ($_SESSION["sess_id"] =='')
{
	/*session_register("login");
    session_register("ses_id_user");
	session_register("ses_username");
    session_register("ses_realname");
	session_register("ses_yim");
	session_register("right_update_finance");
	session_register("right_update_news");
	session_register("right_update_hocbong");
	session_register("right_admin");
    session_register("start_time");
    session_register("poll_time");
    session_register("post_time");*/

    $_SESSION["login"]      = "not_login";
    $_SESSION["ses_id_user"]    = -1;
	$_SESSION["ses_username"]   = "";
    $_SESSION["ses_realname"]   = "";
    $_SESSION["ses_yim"]      	= "";
   	$_SESSION["right_update_finance"]   = 0;
	$_SESSION["right_update_news"]   	= 0;
	$_SESSION["right_update_hocbong"]   = 0;
	$_SESSION["right_admin"]   			= 0;
    $_SESSION["start_time"] = $nowtime - $second_timeout -60;
    $_SESSION["poll_time"]  = $nowtime - 3700;
    $_SESSION["post_time"]  = $nowtime - 30;
	$_SESSION["sess_id"]  = session_id();
}
	

$sql_delete = "DELETE FROM sessions WHERE (start_time + ".$second_timeout.")<".$nowtime;
$dbsql->query($sql_delete);
	  
$sql_select = "SELECT * FROM sessions WHERE session_id='".$_SESSION["sess_id"]."'";
$dbsql->query($sql_select);
	
if ($dbsql->num_rows()==0)
{
	$sql_insert = "INSERT INTO sessions (session_id,start_time) VALUES('".$_SESSION["sess_id"]."',".$nowtime.")";
    $dbsql->query($sql_insert);
		
	// Save stastics: online_max, online_onday 
	$sql_select = "SELECT * FROM statistics";
	$dbsql->query($sql_select);		
	if ($dbsql->num_rows()==0)
	{
		$sql_insert = "INSERT INTO statistics (totalguest,online_today,today,online_max,time_max) VALUES(1,1,".$nowtime.",1,".$nowtime.")";
        $dbsql->query($sql_insert);
	}
	else
	{
		$result = mysql_fetch_array($dbsql->query_id);
		$temp_max = $result["totalguest"]+1;
		if (date("d/m/y",$result["today"]) != date("d/m/y",$nowtime))
		{
			$temp_onlinetoday = 1;
		}
		else
		{
			$temp_onlinetoday = $result["online_today"]+1;
		}
		$sql_update = "UPDATE statistics set totalguest =".$temp_max.", online_today = ".$temp_onlinetoday.", today =".$nowtime;
       	$dbsql->query($sql_update);
	}
	// End save stastics: online_max, online_onday
}
else
{
	$sql_update = "UPDATE sessions set start_time = ".$nowtime." WHERE session_id = '".$_SESSION["sess_id"]."'";
    $dbsql->query($sql_update);
}

$dbsql->close();
?>