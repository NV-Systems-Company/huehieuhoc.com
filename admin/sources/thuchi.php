<?php
$act    = isset($_GET["act"])  	? $_GET["act"]   : 'idx';
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

$record_start = ($page-1)*$thuchi_per_page;
$record_end   = $page*$thuchi_per_page;
$show_page = "";
$msg    		= isset($msg)  	? $msg   : '';
$month 		= isset($_POST["month"]) ? $_POST["month"]: 0;
					if ($month==0) $month  = isset($_GET["m"])? $_GET["m"]: 0;
$year 		= isset($_POST["year"]) ? $_POST["year"]: 0;
					if ($year ==0) $year  = isset($_GET["y"])? $_GET["y"]: 0;

$id_thuchi   	= isset($_GET["id"])  			? $_GET["id"]  : -1;					
$loaiphieu		= isset($_POST["loaiphieu"])	? $_POST["loaiphieu"]	: '';
if ($loaiphieu=='')
{
	if ($act=='lst_thu') $loaiphieu='T';
	if ($act=='lst_chi') $loaiphieu='C';
}
$so_phieu		= isset($_POST["so_phieu"]) 	? $_POST["so_phieu"] 	: '';
$ngayphatsinh	= isset($_POST["ngayphatsinh"])	? $_POST["ngayphatsinh"]: '';
$lydo			= isset($_POST["lydo"]) 		? $_POST["lydo"] 		: '';
$sotien			= isset($_POST["sotien"]) 		? $_POST["sotien"] 		: 0;
$id_loaitien	= isset($_POST["id_loaitien"]) 	? $_POST["id_loaitien"] : -1;
$nguoi_nop_nhan	= isset($_POST["nguoi_nop_nhan"]) ? $_POST["nguoi_nop_nhan"] : '';
$nguoi_capnhat	= $_SESSION["ses_realname"];
$ngay_capnhat	= time();

//------------------------------
$last_update = get_last_day_update()+ $timezone*3600;
$gio = gmdate("H",$last_update);
$phut = gmdate("i",$last_update);
$ngay = gmdate("d-m-Y",$last_update);
$last_update = $gio."h".$phut."', ng&agrave;y ".$ngay;

$lst_donvitien_count = 0;
$lst_donvitien = array();
list_donvitien();

switch ($code)
{
	case "list":
		$lst_year_count = 0;
		$lst_year = array();
		list_year();
		
		$thuchi_count = 0;
		$thuchi = array();
		list_thuchi();
		break;
	
	case "add":	
		break;
		
	case "addsm":
		if (addsm_thuchi())
		{
			$msg = "C&#7853;p nh&#7853;t ph&aacute;t sinh th&agrave;nh c&ocirc;ng.";
			if ($loaiphieu=='T')
				$site = "index.php?fod=ad&act=lst_thu&exe=thuchi&code=list";
			if ($loaiphieu=='C')
				$site = "index.php?fod=ad&act=lst_chi&exe=thuchi&code=list";
			page_transfer($msg,$site);
		}
		break;
		
	case "edit":
		view_item_thuchi();
		break;
		
	case "editsm":
		if (edit_item_thuchi())
		{
			$msg = "Ch&#7881;nh s&#7917;a th&agrave;nh c&ocirc;ng!";
			if ($loaiphieu=='T')
				$site = "index.php?fod=ad&act=lst_thu&exe=thuchi&code=list";
			if ($loaiphieu=='C')
				$site = "index.php?fod=ad&act=lst_chi&exe=thuchi&code=list";
			page_transfer($msg,$site);
		}
		break;	
		
	case "del":
		if (delete_thuchi())
		{
			$msg = "X&oacute;a th&agrave;nh c&ocirc;ng!";
			if ($loaiphieu=='T')
				$site = "index.php?fod=ad&act=lst_thu&exe=thuchi&code=list";
			if ($loaiphieu=='C')
				$site = "index.php?fod=ad&act=lst_chi&exe=thuchi&code=list";
			page_transfer($msg,$site);
		}
		break;
}

function get_last_day_update()
{
	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$last_update = 0;
	
	$sql_select = "SELECT max(ngay_capnhat) as ngay_capnhat FROM thu_chi";
    $sql_query = $dbsql->query($sql_select);
    if ( $dbsql->num_rows()>0 )
	{
          $result = $dbsql->fetch_array($sql_query);
          $last_update = $result["ngay_capnhat"];
    }
	$dbsql->close();
	return $last_update;
}

function list_year()
{
	global $lst_year_count,$lst_year;

	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT year(ngayphatsinh)as year FROM thu_chi GROUP BY year ORDER BY year DESC";
	$sql_query = $dbsql->query($sql_select);
	$rows = $dbsql->num_rows($sql_query);
	if ($rows>0)
	{
	   while ($result = $dbsql->fetch_array($sql_query))
	   {
			$lst_year["year"][$lst_year_count] 	= $result["year"];
			$lst_year_count++;
	   }
	}
	$dbsql->close();
}

function list_donvitien()
{
	global $lst_donvitien_count,$lst_donvitien;

	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT * FROM loai_tien";
	$sql_query = $dbsql->query($sql_select);
	$rows = $dbsql->num_rows($sql_query);
	if ($rows>0)
	{
	   while ($result = $dbsql->fetch_array($sql_query))
	   {
			$lst_donvitien["id_loaitien"][$lst_donvitien_count] 	= $result["id_loaitien"];
			$lst_donvitien["donvitien"][$lst_donvitien_count] 	= $result["donvitien"];
			$lst_donvitien_count++;
	   }
	}
	$dbsql->close();
}

function list_thuchi()
{
	global $act, $loaiphieu, $thuchi_count,$thuchi,$month,$year,$record_start,$record_end,$show_page,$thuchi_per_page,$page;

	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT thu_chi.*, loai_tien.donvitien as donvitien 
				   FROM thu_chi LEFT JOIN loai_tien ON thu_chi.id_loaitien = loai_tien.id_loaitien 
				   WHERE loaiphieu='$loaiphieu' ";
	if ($month!=0) $sql_select .= "AND month(ngayphatsinh)=$month ";
	if ($year!=0) $sql_select .= "AND year(ngayphatsinh)=$year ";
	$sql_select .= "ORDER BY ngayphatsinh DESC, so_phieu DESC";
	$sql_query = $dbsql->query($sql_select);
	$rows = $dbsql->num_rows($sql_query);
	if ($rows>0)
	{
	   $num_page = ceil($rows/$thuchi_per_page);
	   if ($num_page>1)
	   {
			 $show_page = "Trang:";
			 for ($i=1;$i<$num_page+1;$i++)
			 {
				   if ($i==$page) $show_page .= " [$i]";
				   else $show_page .= " <a href='index.php?fod=ad&act=$act&exe=thuchi&code=list&m=".$month."&y=".$year."&page=".$i."'>[$i]</a>";
			 }
	   }
	
	   mysql_data_seek($sql_query, $record_start);
	   while (($result = $dbsql->fetch_array($sql_query))&&(($thuchi_count+$record_start)<$record_end))
	   {
			$thuchi["id_thuchi"][$thuchi_count] 	= $result["id_thuchi"];
			$thuchi["so_phieu"][$thuchi_count] 		= $result["so_phieu"];
			$thuchi["ngayphatsinh"][$thuchi_count] 	= cv_date_vietnam($result["ngayphatsinh"]);
			$thuchi["lydo"][$thuchi_count] 			= $result["lydo"];
			$thuchi["nguoi_nop_nhan"][$thuchi_count]= $result["nguoi_nop_nhan"];
			$thuchi["nguoi_capnhat"][$thuchi_count]	= "Ng&#432;&#7901;i c&#7853;p nh&#7853;t: " . $result["nguoi_capnhat"];
			$thuchi["sotien"][$thuchi_count] 		= number_format($result["sotien"], 0, ',', '.');
			$thuchi["donvitien"][$thuchi_count] 	= $result["donvitien"];
			$thuchi_count++;
	   }
	}
	$dbsql->close();
}

function addsm_thuchi()
{
	global  $msg, $loaiphieu, $so_phieu, $ngayphatsinh,	$lydo, $sotien, 
			$id_loaitien, $nguoi_nop_nhan, $nguoi_capnhat, $ngay_capnhat;
	
	if (trim($so_phieu)==''||trim($ngayphatsinh)==''||trim($nguoi_nop_nhan)==''||trim($lydo)==''||$sotien==0||trim($id_loaitien)==-1)
	{	
		if ($loaiphieu=='T')
		{
			if (trim($so_phieu)=='')	 	$msg .= "- <b>S&#7889; phi&#7871;u Thu ch&#432;a c&oacute;!</b><br>";
			if (trim($ngayphatsinh)=='') 	$msg .= "- <b>Ng&agrave;y n&#7897;p ch&#432;a c&oacute;!</b><br>";
			if (trim($nguoi_nop_nhan)=='') 	$msg .= "- <b>Ng&#432;&#7901;i n&#7897;p ch&#432;a c&oacute;!</b><br>";
			if (trim($lydo)=='') 			$msg .= "- <b>M&#7909;c &#273;&iacute;ch Thu ch&#432;a c&oacute;!</b><br>";
			if ($sotien==0) 			$msg .= "- <b>Ti&#7873;n Thu ch&#432;a c&oacute;!</b><br>";
		}
		
		if ($loaiphieu=='C')
		{
			if (trim($so_phieu)=='') 		$msg .= "- <b>S&#7889; phi&#7871;u Chi ch&#432;a c&oacute;!</b><br>";
			if (trim($ngayphatsinh)=='') 	$msg .= "- <b>Ng&agrave;y Chi ch&#432;a c&oacute;!</b><br>";
			if (trim($nguoi_nop_nhan)=='') 	$msg .= "- <b>Ng&#432;&#7901;i nh&#7853;n  ch&#432;a c&oacute;!</b><br>";
			if (trim($lydo)=='') 			$msg .= "- <b>L&yacute; do Chi ch&#432;a c&oacute;!</b><br>";
			if ($sotien==0) 			$msg .= "- <b>Ti&#7873;n Chi ch&#432;a c&oacute;!</b><br>";
		}
		if ($id_loaitien==-1) $msg .= "- <b>&#272;&#417;n v&#7883; ti&#7873;n ch&#432;a &#273;&#432;&#7907;c ch&#7885;n!</b><br>";

		$msg .= "<br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
    }
	//Kiem tra ngay thang
	$ngayphatsinh = str_replace("/","-",$ngayphatsinh);
	if (!check_date_vietnam($ngayphatsinh))
	{
	   $msg = $msg."- <b>Ng&agrave;y th&aacute;ng &#7911;ng h&#7897; ch&#432;a &#273;&uacute;ng.</b>";
	   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
	   $msg = $msg.'<br>';
       return false;
	}
	// Kiem tra dang so
	if (!is_numeric($sotien))
	{
	   $msg = $msg."- <b>S&#7889; ti&#7873;n nh&#7853;p kh&ocirc;ng &#273;&uacute;ng!</b>";
	   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
	   $msg = $msg.'<br>';
       return false;
	}

	//---Add so lieu vao database
	
   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();

	$ngayphatsinh = cv_date_sql($ngayphatsinh);	
	$sql_insert = "INSERT INTO thu_chi (loaiphieu,so_phieu,ngayphatsinh,lydo,sotien,id_loaitien,nguoi_nop_nhan,nguoi_capnhat,ngay_capnhat) 
				 VALUES('".$loaiphieu."','".$so_phieu."','".$ngayphatsinh."','".$lydo."',".$sotien.",'".$id_loaitien."','".$nguoi_nop_nhan."','".$nguoi_capnhat."',".$ngay_capnhat.")";
	$dbsql->query($sql_insert);	

    $dbsql->close();
	return true;
}

function view_item_thuchi()
{
	global $msg, $id_thuchi, $loaiphieu, $so_phieu, $ngayphatsinh, $lydo, $sotien, 
		   $id_loaitien, $nguoi_nop_nhan, $nguoi_capnhat, $ngay_capnhat;

	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT * FROM thu_chi WHERE id_thuchi=$id_thuchi ";
	$dbsql->query($sql_select);	
	if ($dbsql->num_rows()==0){
          $msg = "Kh&ocirc;ng t&#7891;n t&#7841;i ph&aacute;t sinh n&agrave;y!";
          return false;
     }
    $result = $dbsql->fetch_array();
	$id_thuchi 		= $result["id_thuchi"];
	$so_phieu 		= $result["so_phieu"];
	$ngayphatsinh	= cv_date_vietnam($result["ngayphatsinh"]);
	$lydo			= $result["lydo"];
	$sotien			= $result["sotien"];
	$id_loaitien	= $result["id_loaitien"];
	$nguoi_nop_nhan	= $result["nguoi_nop_nhan"];
	$dbsql->close();
}

function edit_item_thuchi()
{
	global  $msg, $id_thuchi, $loaiphieu, $so_phieu, $ngayphatsinh,	$lydo, $sotien, 
			$id_loaitien, $nguoi_nop_nhan, $nguoi_capnhat, $ngay_capnhat;
	
	if (trim($so_phieu)==''||trim($ngayphatsinh)==''||trim($nguoi_nop_nhan)==''||trim($lydo)==''||$sotien==0||trim($id_loaitien)==-1)
	{	
		if ($loaiphieu=='T')
		{
			if (trim($so_phieu)=='')	 	$msg .= "- <b>S&#7889; phi&#7871;u Thu ch&#432;a c&oacute;!</b><br>";
			if (trim($ngayphatsinh)=='') 	$msg .= "- <b>Ng&agrave;y n&#7897;p ch&#432;a c&oacute;!</b><br>";
			if (trim($nguoi_nop_nhan)=='') 	$msg .= "- <b>Ng&#432;&#7901;i n&#7897;p ch&#432;a c&oacute;!</b><br>";
			if (trim($lydo)=='') 			$msg .= "- <b>M&#7909;c &#273;&iacute;ch Thu ch&#432;a c&oacute;!</b><br>";
			if ($sotien==0) 			$msg .= "- <b>Ti&#7873;n Thu ch&#432;a c&oacute;!</b><br>";
		}
		
		if ($loaiphieu=='C')
		{
			if (trim($so_phieu)=='') 		$msg .= "- <b>S&#7889; phi&#7871;u Chi ch&#432;a c&oacute;!</b><br>";
			if (trim($ngayphatsinh)=='') 	$msg .= "- <b>Ng&agrave;y Chi ch&#432;a c&oacute;!</b><br>";
			if (trim($nguoi_nop_nhan)=='') 	$msg .= "- <b>Ng&#432;&#7901;i nh&#7853;n  ch&#432;a c&oacute;!</b><br>";
			if (trim($lydo)=='') 			$msg .= "- <b>L&yacute; do Chi ch&#432;a c&oacute;!</b><br>";
			if ($sotien==0) 				$msg .= "- <b>Ti&#7873;n Chi ch&#432;a c&oacute;!</b><br>";
		}
		if ($id_loaitien==-1) $msg .= "- <b>&#272;&#417;n v&#7883; ti&#7873;n ch&#432;a &#273;&#432;&#7907;c ch&#7885;n!</b><br>";

		$msg .= "<br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
    }
	//Kiem tra ngay thang
	$ngayphatsinh = str_replace("/","-",$ngayphatsinh);
	if (!check_date_vietnam($ngayphatsinh))
	{
	   $msg = $msg."- <b>Ng&agrave;y th&aacute;ng &#7911;ng h&#7897; ch&#432;a &#273;&uacute;ng.</b>";
	   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
	   $msg = $msg.'<br>';
       return false;
	}
	// Kiem tra dang so
	if (!is_numeric($sotien))
	{
	   $msg = $msg."- <b>S&#7889; ti&#7873;n nh&#7853;p kh&ocirc;ng &#273;&uacute;ng!</b>";
	   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
	   $msg = $msg.'<br>';
       return false;
	}

	//---Add so lieu vao database
	
   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();

	$ngayphatsinh = cv_date_sql($ngayphatsinh);	
	$sql_update = "UPDATE thu_chi SET so_phieu='".$so_phieu."',ngayphatsinh='".$ngayphatsinh."',lydo='".$lydo."',
									   sotien=".$sotien.",id_loaitien=".$id_loaitien.",nguoi_nop_nhan='".$nguoi_nop_nhan."',
									   nguoi_capnhat='".$nguoi_capnhat."',ngay_capnhat=".$ngay_capnhat." 
				  WHERE id_thuchi=$id_thuchi";
	$dbsql->query($sql_update);	
    $dbsql->close();
	return true;
}

function delete_thuchi()
{
	global $id_thuchi;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
			
	$sql_delete = "DELETE FROM thu_chi WHERE id_thuchi = $id_thuchi";
	$dbsql->query($sql_delete);
	$dbsql->close();
	return true;
}
?>