<?php
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';
$id_donghanh  	= isset($_GET["id"]) ? $_GET["id"] : -1;
$ten_donghanh  	= isset($_POST["ten_donghanh"]) 	? $_POST["ten_donghanh"] : '';
$address 		= isset($_POST["address"]) 		? $_POST["address"] 	 : '';
$tel 			= isset($_POST["tel"]) 			? $_POST["tel"]  		 	 : '';
$fax 			= isset($_POST["fax"]) 			? $_POST["fax"] 		 : '';
$email 			= isset($_POST["email"]) 		? $_POST["email"] 		 : '';
$website		= isset($_POST["website"]) 		? $_POST["website"] 	 : '';
$num_order		= isset($_POST["num_order"]) 	? $_POST["num_order"] 	 : 0;

global  $msg, $id_donghanh, $ten_donghanh, $address, $tel, $fax, $email, $website, $num_order;

if ($code=='save')
{				
	if (save_donghanh())
	{
		$msg = "Thay &#273;&#7893;i th&agrave;nh c&ocirc;ng!";
		$site = "index.php?fod=ad&act=up_dh&exe=up_dh";
		page_transfer($msg,$site);
	}
}
else
{
	view_item_donghanh();
}


function view_item_donghanh()
{
	global $_GET, $msg, $id_donghanh, $ten_donghanh, $address, $tel, $fax, $email, $website, $num_order;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//--------------------------------------------------------------
	$sql_select = "SELECT *	FROM donghanh WHERE id_donghanh=$id_donghanh";	 
  	$dbsql->query($sql_select);
     if ($dbsql->num_rows()==0)
	 {
          $msg = "Kh&ocirc;ng t&#7891;n t&agrave;i &#273;&#417;n v&#7883; &#273;&#7891;ng h&agrave;nh n&agrave;y!";
          $page_url = "index.php?fod=ad&act=up_dh&exe=up_dh";
          page_transfer($msg,$page_url);
          return false;
     }
     $result = $dbsql->fetch_array();
	 $ten_donghanh 	= $result["ten_donghanh"];
	 $address 		= $result["address"];
	 $tel 			= $result["tel"];
	 $fax 			= $result["fax"];
	 $email 		= $result["email"];
	 $website 		= $result["website"];
	 $num_order 	= $result["num_order"];
	 $dbsql->close();
}

function save_donghanh()
{
	global  $_POST, $_GET, $id_donghanh, $msg, $ten_donghanh, $address,	$tel, $fax, $email, $website, $num_order;

   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();				
	
	if (trim($ten_donghanh)==''||trim($address)=='')
	{	
		if (trim($ten_donghanh)=='') $msg = $msg."<br>- <b>T&ecirc;n &#273;&#417;n v&#7883;, t&#7893; ch&#7913;c &#272;&#7891;ng h&agrave;nh ch&#432;a c&oacute;!</b>";
		if (trim($address)=='') $msg = $msg."<br>- <b>&#272;&#7883;a ch&#7881; ch&#432;a c&oacute;!</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
    }
	
	$sql_update = "UPDATE donghanh SET ten_donghanh='".$ten_donghanh."', address='".$address."', tel='".$tel."', fax='".$fax."', email='".$email."', website='".$website."', num_order=".$num_order." WHERE id_donghanh=$id_donghanh";
	$dbsql->query($sql_update);	
    $dbsql->close();
	return true;
}


?>