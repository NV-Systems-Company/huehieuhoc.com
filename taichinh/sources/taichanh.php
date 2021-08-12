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
$keyword 		= isset($_POST["keyword"]) 		? $_POST["keyword"]: '';
				if ($keyword =='') $keyword  = isset($_GET["key"])? $_GET["key"]: '';

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

//------------------------------
$last_update = get_last_day_update()+ $timezone*3600;
$gio = gmdate("H",$last_update);
$phut = gmdate("i",$last_update);
$ngay = gmdate("d-m-Y",$last_update);
$last_update = $gio."h".$phut."', ng&agrave;y ".$ngay;

switch ($code)
{
	case "list":
		$lst_year_count = 0;
		$lst_year = array();
		list_year();
		
		$total_rows = 0;
		$thuchi_count = 0;
		$thuchi = array();
		list_thuchi();
		break;
		
	case "tk":
		$find_year 		= isset($_POST["find_year"]) 	? $_POST["find_year"]: 0;
		$lst_year_tket_count = 0;
		$lst_year_tket = array();
		lst_year_tongket();

		$tongket_count = 0;
		$tongket = array();
		list_tongket();
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

function list_thuchi()
{
	global $total_rows, $act, $keyword, $loaiphieu, $thuchi_count,$thuchi,$month,$year,$record_start,$record_end,$show_page,$thuchi_per_page,$page;

	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT thu_chi.*, loai_tien.donvitien as donvitien 
				   FROM thu_chi LEFT JOIN loai_tien ON thu_chi.id_loaitien = loai_tien.id_loaitien 
				   WHERE loaiphieu='$loaiphieu' ";
	if ($month!=0) $sql_select .= "AND month(ngayphatsinh)=$month ";
	if ($year!=0) $sql_select .= "AND year(ngayphatsinh)=$year ";
	if (($keyword!='')&&($loaiphieu=='T')) $sql_select .= "AND (nguoi_nop_nhan LIKE '%".$keyword."%') ";	
	if (($keyword!='')&&($loaiphieu=='C')) $sql_select .= "AND (lydo LIKE '%".$keyword."%') ";	
	$sql_select .= "ORDER BY ngayphatsinh DESC, so_phieu DESC";
	$sql_query = $dbsql->query($sql_select);
	$rows = $dbsql->num_rows($sql_query);
	$total_rows = $rows;
	if ($rows>0)
	{
	   $num_page = ceil($rows/$thuchi_per_page);
	   if ($num_page>1)
	   {
			 $show_page = "Trang:";
			 for ($i=1;$i<$num_page+1;$i++)
			 {
				   if ($i==$page) $show_page .= " [$i]";
				   else $show_page .= " <a href='index.php?fod=taichinh&act=$act&exe=taich&code=list&m=".$month."&y=".$year."&page=".$i."'>[$i]</a>";
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
			$thuchi["sotien"][$thuchi_count] 		= number_format($result["sotien"], 0, ',', '.');
			$thuchi["donvitien"][$thuchi_count] 	= $result["donvitien"];
			$thuchi_count++;
	   }
	}
	$dbsql->close();
}

function lst_year_tongket()
{
	global 	$lst_year_tket_count, $lst_year_tket;

	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT nam FROM tongket_quy GROUP BY nam ORDER BY nam DESC";
	$sql_query = $dbsql->query($sql_select);
	$rows = mysql_num_rows($sql_query);
	if ($rows>0)
	{
	   while ($result = $dbsql->fetch_array($sql_query))
	   {
			$lst_year_tket["nam"][$lst_year_tket_count] 	= $result["nam"];
			$lst_year_tket_count++;
	   }
	}

	$dbsql->close();
}

function list_tongket()
{
	global 	$tongket_count, $tongket, $find_year;

	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT tongket_quy.*, loai_tien.donvitien as donvitien 
				   FROM tongket_quy LEFT JOIN loai_tien ON tongket_quy.id_loaitien = loai_tien.id_loaitien 
				   WHERE id_tongket <> -1 ";
	if  ($find_year<>0) $sql_select .= "AND nam = $find_year ";
	$sql_select .= "ORDER BY nam DESC, id_loaitien ASC";
	
	$sql_query = $dbsql->query($sql_select);
	$rows = mysql_num_rows($sql_query);
	if ($rows>0)
	{
	   while ($result = $dbsql->fetch_array($sql_query))
	   {
			$tongket["id_tongket"][$tongket_count] 	= $result["id_tongket"];
			$tongket["nam"][$tongket_count] 		= $result["nam"];
			$tongket["sodu_dauky"][$tongket_count] 	= number_format($result["sodu_dauky"],0,',','.');
			$tongket["tong_thu"][$tongket_count] 	= number_format($result["tong_thu"],0,',','.');
			$tongket["tong_chi"][$tongket_count] 	= number_format($result["tong_chi"],0,',','.');
			$tongket["sodu_cuoiky"][$tongket_count] = number_format($result["sodu_cuoiky"],0,',','.');
			$tongket["donvitien"][$tongket_count] 	= $result["donvitien"];
			$tongket_count++;
	   }
	}
	$dbsql->close();
}
?>