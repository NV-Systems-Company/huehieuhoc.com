<?php
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';
$msg		= isset($msg) ? $msg : '';

$logo		= isset($_FILES['logo']['name'] ) ? $_FILES['logo']['name'] : 'NULL';
$tendonvi	= isset($_POST["tendonvi"]) ? $_POST["tendonvi"] : '';
$website 	= isset($_POST["website"]) ? $_POST["website"] : 'http://';

switch ($code)
{
	case "add":
		if (add_quangcao())
		{
			$msg = "Th&ecirc;m qu&#7843;ng c&aacute;o th&agrave;nh c&ocirc;ng!";
			$site = "index.php?fod=ad&act=man_qc&exe=qc&code=man";
			page_transfer($msg,$site);
		}  
		break;
		
	case "man":
		$quangcao_count = 0;
		$quangcao = array();
		list_quangcao();
		break;
		
	case "order":
		save_order_quangcao();
		break;
		
	case "edit":
		$id_quangcao = isset($_GET["id"]) ? $_GET["id"] : -1;
		view_item_quangcao();
		break;
		
	case "smedit":
		$id_quangcao = isset($_GET["id"]) ? $_GET["id"] : -1;
		if (submit_edit_quangcao())
		{
			$msg = "Thay &#273;&#7893;i &#273;&#7893;i th&agrave;nh c&ocirc;ng!";
			$site = "index.php?fod=ad&act=man_qc&exe=qc&code=man";
			page_transfer($msg,$site);
		}
		else
		{
			$logo = $_POST["pic_logo"];
		}
		break;
				
	case "del":
		$id_quangcao = isset($_GET["id"]) ? $_GET["id"] : -1;
		if (delete_quangcao())
		{
			$msg = "X&oacute;a qu&#7843;ng c&aacute;o th&agrave;nh c&ocirc;ng!";
			$site = "index.php?fod=ad&act=man_qc&exe=qc&code=man";
			page_transfer($msg,$site);
		}
		break;
}



function add_quangcao()
{
	global  $_POST, $logo, $tendonvi, $website,$msg;
	
	$order_qc = 1;
	
	if (empty($logo)||trim($tendonvi)=='')
	{	
		if (empty($logo)) $msg = "- <b>Logo &#273;&#417;n v&#7883; ch&#432;a &#273;&#432;&#7907;c ch&#7885;n!</b>";
		if (trim($tendonvi)=='') $msg = $msg."<br>- <b>T&ecirc;n &#273;&#417;n v&#7883; ch&#432;a c&oacute;!</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
    }


	if ($logo!='NULL')
	{
		// GET THE TYPE OF IMAGE . EX: .GIF , .JPG ,....
		$pos_dot = strpos($logo,"."); //do dai ten file
		$type_img = substr($logo,$pos_dot,strlen($logo)); //Kieu file
		$name_logo = substr($logo,0,$pos_dot);
		   
		if ((strtolower($type_img)!=".gif")&&(strtolower($type_img)!=".jpg")&&(strtolower($type_img)!=".bmp"))
		{
		   $msg = $msg."- <b>B&#7841;n ch&#7881; &#273;&#432;&#7907;c upload c&aacute;c file ki&#7875;u .gif, .jpg, .bmp</b>";
		   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		   $act = "reg";
		   return false;
		}
	
		//----------------------------------------------
		//Copy file logo quang cao len server
		$file_logo = $name_logo.'_'.time().$type_img;
	
		if (!(copy($_FILES['logo']['tmp_name'], "./quangcao/img_logo/".$file_logo))) die("Cannot upload files.");
	
	}

   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	//get order
	$order_select = "SELECT max(order_qc) as num_order FROM quangcao";
    $order_query = $dbsql->query($order_select);
    if ( $dbsql->num_rows()>0 )
	{
          $result = $dbsql->fetch_array($order_query);
          $order_qc = $result["num_order"] + 1;
    }
	

	$sql_insert = "INSERT INTO quangcao (order_qc,tendonvi,logo,website)
							 VALUES(".$order_qc.",'".$tendonvi."','".$file_logo."','".$website."')";
	$dbsql->query($sql_insert);	
	
	//---------------------
    $dbsql->close();
	return true;
}

function list_quangcao()
{
	global $quangcao_count, $quangcao;
	
	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT * FROM quangcao ORDER BY order_qc";
	$dbsql->query($sql_select);
	if ($dbsql->num_rows()>0)
	{
	  	while ( $result = $dbsql->fetch_array() )
	  	{
			$quangcao["id_quangcao"][$quangcao_count] 	= $result["id_quangcao"];
		   	$quangcao["logo"][$quangcao_count] 			= $result["logo"];
		   	$quangcao["tendonvi"][$quangcao_count]   	= $result["tendonvi"];
		   	$quangcao["website"][$quangcao_count]    	= $result["website"];
		   	$quangcao["order_qc"][$quangcao_count]    	= $result["order_qc"];
		   	$quangcao_count++;		   
		}
	}
}

function save_order_quangcao()
{
	global $_POST;

    $dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
    //--------------------------------------------------------------
    $quangcao_count = isset($_POST["quangcao_count"]) ? $_POST["quangcao_count"] : 0;
    if ( $quangcao_count>0 ){
        for ($i=0;$i<$quangcao_count;$i++){
            $id_quangcao[$i] = isset($_POST["id_qc_$i"]) ? $_POST["id_qc_$i"] : '';
            if ( !empty($id_quangcao[$i]) )
			{
                  $order_qc[$i] = isset($_POST["order_qc_$i"]) ? $_POST["order_qc_$i"] : '';
	
                  $sql_update = "UPDATE quangcao SET order_qc=$order_qc[$i] WHERE id_quangcao=$id_quangcao[$i]";
                  $dbsql->query($sql_update);
            }
        }
    }
    //--------------------------------------------------------------
    $dbsql->close();

    $msg = "Ch&#7881;nh s&#7917;a th&#7913; t&#7921; th&agrave;nh c&ocirc;ng !";
    $site = "index.php?fod=ad&act=man_qc&exe=qc&code=man";
    page_transfer($msg,$site);

    return true;
}

function view_item_quangcao()
{
	global $id_quangcao,$logo, $tendonvi, $website;
	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT * FROM quangcao WHERE id_quangcao = $id_quangcao";
	$dbsql->query($sql_select);
	if ($dbsql->num_rows()>0)
	{
	  	$result = $dbsql->fetch_array();
		$logo = "./quangcao/img_logo/".$result["logo"];
		$tendonvi = $result["tendonvi"];
		$website = $result["website"];
	}
	$dbsql->close();
}

function submit_edit_quangcao()
{
	global  $_POST, $id_quangcao, $logo, $tendonvi, $website,$msg;
	
   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	if (trim($tendonvi)=='') 
	{
		$msg = $msg."<br>- <b>T&ecirc;n &#273;&#417;n v&#7883; ch&#432;a c&oacute;!</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
	}


	if (!empty($logo))
	{
		// GET THE TYPE OF IMAGE . EX: .GIF , .JPG ,....
		$pos_dot = strpos($logo,"."); //do dai ten file
		$type_img = substr($logo,$pos_dot,strlen($logo)); //Kieu file
		   
		if ((strtolower($type_img)!=".gif")&&(strtolower($type_img)!=".jpg")&&(strtolower($type_img)!=".bmp"))
		{
		   $msg = $msg."- <b>B&#7841;n ch&#7881; &#273;&#432;&#7907;c upload c&aacute;c file ki&#7875;u .gif, .jpg, .bmp</b>";
		   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		   $act = "reg";
		   return false;
		}
	
		//Get file name and Copy file picture thanh vien len server
		$sql_select = "SELECT logo FROM quangcao WHERE id_quangcao = $id_quangcao";
		$dbsql->query($sql_select);
		$result = $dbsql->fetch_array();
		$file_logo = $result["logo"];
		//if ($file_logo=='')	$file_logo = substr($logo,0,$pos_dot).'_'.time().$type_img;
		if (!(copy($_FILES['logo']['tmp_name'], "./quangcao/img_logo/".$file_logo))) die("Cannot upload files.");	
	}

	
	$sql_update = "UPDATE quangcao SET tendonvi='".$tendonvi."', website='".$website."' WHERE id_quangcao = $id_quangcao";
	$dbsql->query($sql_update);	
	
	//---------------------
    $dbsql->close();
	return true;
}

function delete_quangcao()
{
	global $id_quangcao;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	$file_logo ='';
	$sql_select = "SELECT * FROM quangcao WHERE id_quangcao = $id_quangcao"; 
	if (mysql_num_rows($dbsql->query($sql_select))!=0)
	{
		$result = mysql_fetch_array($dbsql->query($sql_select));
		$file_logo = $result['logo'];
		// delete file anh cu tren host
		unlink("./quangcao/img_logo/".$file_logo);	
			
		$sql_delete = "DELETE FROM quangcao WHERE id_quangcao = $id_quangcao";
		$dbsql->query($sql_delete);
	}
	$dbsql->close();
	return true;
}
?>