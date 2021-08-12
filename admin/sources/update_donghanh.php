<?php
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

$donghanh_count = 0;
$donghanh = array();

switch ($code)
{				
    case "add":	
				global $msg, $ten_donghanh, $address, $tel, $fax, $email, $website, $num_order;
				if (add_donghanh())
				{
					/*$msg = "Th&ecirc;m  v&agrave;o danh s&aacute;ch th&agrave;nh c&ocirc;ng!";
					$site = "index.php?fod=ad&act=up_dh&exe=up_dh";
					page_transfer($msg,$site);*/
				}
				break;	 
					
	case "del":
				if (delete_donghanh())
				{
					/*$msg = "X&oacute;a th&agrave;nh c&ocirc;ng!";
					$site = "index.php?fod=ad&act=up_dh&exe=up_dh";
					page_transfer($msg,$site);*/				
				}
}


view_ds_donghanh();

function view_ds_donghanh()
{
	global $donghanh_count, $donghanh;
		   
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//--------------------------------------------------------------
	$sql_select = "SELECT *	FROM donghanh ORDER BY num_order ASC";	 
	$sql_query = $dbsql->query($sql_select);
	$rows = $dbsql->num_rows($sql_query);
	if ($rows>0)
	{
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$donghanh["id_donghanh"][$donghanh_count] 	= $result["id_donghanh"];
			$donghanh["ten_donghanh"][$donghanh_count]  = $result["ten_donghanh"];
			$donghanh["address"][$donghanh_count] 		= $result["address"];
			$donghanh["tel"][$donghanh_count] 			= $result["tel"];
			$donghanh["fax"][$donghanh_count] 			= $result["fax"];
			$donghanh["email"][$donghanh_count] 		= $result["email"];
			$donghanh["website"][$donghanh_count] 		= $result["website"];
			$donghanh["num_order"][$donghanh_count] 	= $result["num_order"];
			$donghanh_count++;
		}
	}
	//--------------------------------------------------------------
	$dbsql->close();
}

function add_donghanh()
{
	global  $_POST, $msg, $ten_donghanh, $address,
			$tel, $fax, $email, $website, $num_order;

	$ten_donghanh  = isset($_POST["ten_donghanh"]) 	? $_POST["ten_donghanh"] : '';
	$address 		= isset($_POST["address"]) 		? $_POST["address"] 	 : '';
	$tel 			= isset($_POST["tel"]) 			? $_POST["tel"]  		 	 : '';
	$fax 			= isset($_POST["fax"]) 			? $_POST["fax"] 		 : '';
	$email 			= isset($_POST["email"]) 		? $_POST["email"] 		 : '';
	$website		= isset($_POST["website"]) 		? $_POST["website"] 	 : '';
	$num_order		= isset($_POST["num_order"]) 	? $_POST["num_order"] 	 	 : 0;

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

	$sql_insert = "INSERT INTO donghanh (ten_donghanh, address, tel, fax, email, website, num_order)
				  VALUES('".$ten_donghanh."','".$address."','".$tel."','".$fax."','".$email."','".$website."',".$num_order.")";
	$dbsql->query($sql_insert);	
    $dbsql->close();
	return true;
}

function delete_donghanh()
{
	global $_GET;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	$sql_delete = "DELETE FROM donghanh WHERE id_donghanh = ".$_GET['id'];
	$dbsql->query($sql_delete);
	$dbsql->close();
	return true;
}
?>