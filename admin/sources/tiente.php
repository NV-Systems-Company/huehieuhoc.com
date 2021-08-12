<?php
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';
$id_loaitien  	= isset($_GET["id"]) ? $_GET["id"] : -1;
$donvitien  	= isset($_POST["donvitien"]) ? $_POST["donvitien"] : '';

$tiente_count = 0;
$tiente = array();

switch ($code)
{				
	case "edit":
		view_item_tiente();
		break;
		
	case "editsm":
		if (edit_tiente())
			{
				$msg = "Thay &#273;&#7893;i th&agrave;nh c&ocirc;ng!";
				$site = "index.php?fod=ad&act=dm_tiente&exe=tiente";
				page_transfer($msg,$site);
			}
		break;
	
    case "add":	
		global $msg, $donvitien;
		if (add_tiente())
		{
			$msg = "Th&ecirc;m v&agrave;o danh m&#7909;c th&agrave;nh c&ocirc;ng.";
			$site = "index.php?fod=ad&act=dm_tiente&exe=tiente";
			page_transfer($msg,$site);
		}
		break;	 
					
	case "del":
		if (delete_tiente())
		{
			/*$msg = "X&oacute;a th&agrave;nh c&ocirc;ng!";
			$site = "index.php?fod=ad&act=dm_tiente&exe=tiente";
			page_transfer($msg,$site);*/				
		}
}


view_dm_tiente();

function view_dm_tiente()
{
	global $tiente_count, $tiente;
		   
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//--------------------------------------------------------------
	$sql_select = "SELECT *	FROM loai_tien ORDER BY id_loaitien ASC";	 
	$sql_query = $dbsql->query($sql_select);
	$rows = $dbsql->num_rows($sql_query);
	if ($rows>0)
	{
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$tiente["id_loaitien"][$tiente_count] = $result["id_loaitien"];
			$tiente["donvitien"][$tiente_count]  	= $result["donvitien"];
			$tiente_count++;
		}
	}
	//--------------------------------------------------------------
	$dbsql->close();
}

function add_tiente()
{
	global  $_POST, $msg, $donvitien;

	$donvitien  = isset($_POST["donvitien"]) ? $_POST["donvitien"] : '';

   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();				
	
	if (trim($donvitien)=='') 
	{
		$msg = $msg."<br>- <b>T&ecirc;n &#273;&#417;n v&#7883; ti&#7873;n t&#7879; ch&#432;a c&oacute;!</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
    }

	$sql_insert = "INSERT INTO loai_tien (donvitien)
				  VALUES('".$donvitien."')";
	$dbsql->query($sql_insert);	
    $dbsql->close();
	return true;
}

function view_item_tiente()
{
	global $_GET, $msg, $id_loaitien, $donvitien;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//--------------------------------------------------------------
	$sql_select = "SELECT *	FROM loai_tien WHERE id_loaitien=$id_loaitien";	 
  	$dbsql->query($sql_select);
     if ($dbsql->num_rows()==0)
	 {
          $msg = "Kh&ocirc;ng t&#7891;n t&agrave;i &#273;&#417;n v&#7883; ti&#7873;n t&#7879; n&agrave;y!";
          $page_url = "index.php?fod=ad&act=up_dh&exe=up_dh";
          page_transfer($msg,$page_url);
          return false;
     }
     $result = $dbsql->fetch_array();
	 $donvitien = $result["donvitien"];
	 $dbsql->close();
}

function edit_tiente()
{
	global  $id_loaitien, $msg, $donvitien;

   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();				
	
	if (trim($donvitien)=='') 
	{
		$msg = $msg."<br>- <b>T&ecirc;n &#273;&#417;n v&#7883; ti&#7873;n t&#7879; ch&#432;a c&oacute;!</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
    }
	
	$sql_update = "UPDATE loai_tien SET donvitien='".$donvitien."' WHERE id_loaitien=$id_loaitien";
	$dbsql->query($sql_update);	
    $dbsql->close();
	return true;
}


function delete_tiente()
{
	global $id_loaitien;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	$sql_delete = "DELETE FROM loai_tien WHERE id_loaitien = $id_loaitien";
	$dbsql->query($sql_delete);
	$dbsql->close();
	return true;
}
?>