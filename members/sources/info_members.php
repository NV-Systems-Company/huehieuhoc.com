<?php
$act    = isset($_GET["act"])  	? $_GET["act"]   : 'idx';
//$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

info_member();

function info_member(){
     global $id,$user,$timezone,$act;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //-----------------------------------------------------
     $sql_select = "SELECT * FROM users WHERE id_user=$id";
     $dbsql->query($sql_select);
     if ($dbsql->num_rows()==0){
          $msg = "Khong ton tai th&agrave;nh vi&ecirc;n nay.";
          $page_url = "index.php?fod=ad&act=$act&exe=lstmem";
          page_transfer($msg,$page_url);
          return false;
     }

     $result = $dbsql->fetch_array();
	 $user["id_user"] 		= $id;
	 $user["username"] 		= $result["username"];
	 $user["realname"] 		= $result["first_name"].' '.$result["last_name"] ;
	 $user["namsinh"] 		= $result["namsinh"];
     //$user["email"] 		= $result["email"];
     $user["email"] 		= ($result["hide_email"]==1) ? '' : $result["email"];
     $user["address"] 		= $result["address"];
	 $user["gender"] 		= ($result["gender"]==1) ? 'Nam' : 'N&#7919;';
     $user["tel"] 			= $result["tel"];
     $user["fax"] 			= $result["fax"];
     $user["yim"] 			= $result["yim"];
     $user["education"] 	= $result["education"];
	 $user["job"] 			= $result["job"];
	 $user["hide_email"] 	= $result["hide_email"];
     $user["join_date"] 	= gmdate("d.m.Y",$result["join_date"] + $timezone*3600);
     $user["picture"] 		= ($result["picture"]=='') ? './members/img_members/male.gif' : "./members/img_members/".$result["picture"];

     //-----------------------------------------------------
     $dbsql->close();
}
?>