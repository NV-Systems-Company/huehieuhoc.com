<?php


if ($_SESSION["login"]== "not_login")
{
	$username 	= isset($_POST["username"]) ? $_POST["username"] : '';
	$password 	= isset($_POST["password"]) ? $_POST["password"] : '';
	
	if (login($username,$password)==false)
	{
	   $msg		= isset($msg) ? $msg : "Th&ocirc;ng tin &#273;&#259;ng nh&#7853;p kh&ocirc;ng &#273;&uacute;ng!. <br>Vui l&ograve;ng &#273;&#259;ng nh&#7853;p l&#7841;i.";
	   $page = "index.php?fod=mem&act=login";
	   page_transfer($msg,$page);
	   return false;
	}
}

$act = "idx";
$fod = "home";
	
//-----------------------------
function login($username,$password)
{
	global $msg;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	$check_select = "SELECT * FROM users WHERE username='".$username."'";
	$dbsql->query($check_select);

	if ($dbsql->num_rows()==0) return false;
	
	$result    = $dbsql->fetch_array();
	
	$pass	      	= $result["password"];
	$id_user	 	= $result["id_user"];
	$realname	    = $result["first_name"].' '.$result["last_name"];
	$yim	 	  	= $result["yim"]; 
	$approve  	 	= $result["approve"]; 

	//-----------------------------------------------------
	
	//check password is correct ?
	if (md5($password)!=$pass)   return false;
	
	//Check if users is banned
	$banned_select = "SELECT * FROM banned WHERE id_user=$id_user";
	$dbsql->query($banned_select);
	if ($dbsql->num_rows()>0)
	{
		$msg = "Th&agrave;nh vi&ecirc;n n&agrave;y &#273;&atilde; b&#7883; c&#7845;m, t&#7841;m th&#7901;i kh&ocirc;ng th&#7875; &#273;&#259;ng nh&#7853;p &#273;&#432;&#7907;c.";
		return false;
	}
	
	//Check approve
	if ($approve==0)
	{
	   $msg = "B&#7841;n ch&#432;a th&#7875; &#273;&#259;ng nh&#7853;p v&igrave; th&ocirc;ng tin &#273;&#259;ng k&yacute; c&#7911;a b&#7841;n &#273;ang ch&#7901; &#273;&#432;&#7907;c x&aacute;c nh&#7853;n !";
	   return false;
	}
	
	//----------- LOGIN -----------------------
	$_SESSION["login"]    		 = "logined";
	$_SESSION["ses_id_user"]     	 = $id_user;
	$_SESSION["ses_username"]   	 = $username;
	$_SESSION["ses_realname"]        = $realname;
	$_SESSION["ses_yim"]      	 	 = $yim;

	// Quyen cap nhat tai chanh
	$select = "SELECT * FROM user_updatefinance WHERE id_user=".$id_user;
	$dbsql->query($select);
	if ($dbsql->num_rows()!=0) 	$_SESSION["right_update_finance"]   = 1;

	// Quyen cap nhat hoc bong
	$select = "SELECT * FROM user_updatehocbong WHERE id_user=".$id_user;
	$dbsql->query($select);
	if ($dbsql->num_rows()!=0) 	$_SESSION["right_update_hocbong"]   = 1;

	// Quyen cap nhat tin tuc
	$select = "SELECT * FROM user_updatenews WHERE id_user=".$id_user;
	$dbsql->query($select);
	if ($dbsql->num_rows()!=0) 	$_SESSION["right_update_news"]   = 1;
	
	// Quyen administrator
	$select = "SELECT * FROM user_admin WHERE id_user=".$id_user;
	$dbsql->query($select);
	if ($dbsql->num_rows()!=0) 	$_SESSION["right_admin"]   = 1;
	
	$dbsql->close();
	return true;
}
?>
