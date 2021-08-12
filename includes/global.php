<?php
$global_logo_count   = 0;
$global_logo        = array();
$timezone   = "+7";

$total_users    = 0;
$users_online   = 0;
$guest_online_max   = 0;
$guest_online_today   = 0;
$guest_max   = 0;
$time_max	=0;
$total_posts    = 0;
$new_user[]  = array();


show_all_global();

function show_all_global()
{
     global $global_logo,$global_logo_count,
			$total_users,$users_online,$guest_online_max,$guest_online_today,$time_max,$guest_max;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //-----------------------------------------------------
     //logos
     $sql_select = "SELECT * FROM quangcao ORDER BY order_qc";
     $dbsql->query($sql_select);
     if ($dbsql->num_rows()>0)
     {
          while ( $result = $dbsql->fetch_array() )
          {
               $global_logo["logo"][$global_logo_count] 	= $result["logo"];
               $global_logo["tendonvi"][$global_logo_count]   = $result["tendonvi"];
               $global_logo["website"][$global_logo_count]    = $result["website"];
               $global_logo_count++;		   
          }
     }
     
     //Total members
     /*$sql_select = "SELECT user_id,realname FROM users ORDER BY user_id DESC";
     $dbsql->query($sql_select);
     $total_users = $dbsql->num_rows();
     if ($total_users>0)
     {
     	$result = $dbsql->fetch_array();
        $new_user["id"] = $result["user_id"];
        $new_user["realname"] = $result["realname"];
     }*/

     //Who is online
     $sql_select = "SELECT session_id FROM sessions";
     $dbsql->query($sql_select);
     $users_online = $dbsql->num_rows();

	// Statistics max online guest 
	$sql_select = "SELECT * FROM statistics";
    $dbsql->query($sql_select);

   	$result = mysql_fetch_array($dbsql->query_id);
	$guest_online_max = $result["online_max"];
	$time_max = $result["time_max"];
	$guest_online_today = $result["online_today"];
	$guest_max = number_format($result["totalguest"],0,',','.');
	
	if ($users_online>$result["online_max"])
	{
		$guest_online_max = $users_online;
		$sql_update = "UPDATE statistics set online_max = ".$guest_online_max.", time_max = ".time()." ";
        $dbsql->query($sql_update);
		
		$time_max = time();
	}
    //-----------------------------------------------------
    $dbsql->close();
}
?>