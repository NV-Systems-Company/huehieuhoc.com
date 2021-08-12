<?php
$act    	= isset($_GET["act"])  	? $_GET["act"]   : 'idx';
$code   	= isset($_GET["code"])  ? $_GET["code"]  : '';
$id_tongket = isset($_GET["id"]) 	? $_GET["id"]  : -1;

$find_year 		= isset($_POST["find_year"]) 	? $_POST["find_year"]: 0;
$nam_tongket	= isset($_POST["nam_tongket"]) 	? $_POST["nam_tongket"]: 0;
$max_year = get_max_year();

//------------------------------
$last_update = get_last_day_update()+ $timezone*3600;
$gio = gmdate("H",$last_update);
$phut = gmdate("i",$last_update);
$ngay = gmdate("d-m-Y",$last_update);
$last_update = $gio."h".$phut."', ng&agrave;y ".$ngay;

$lst_finance_year_count = 0;
$lst_finance_year = array();
list_finance_year();
		
switch ($code)
{
	case "tk":
		if ($nam_tongket >$max_year)
		{
			tongket_taichinh($nam_tongket);
			$max_year = $nam_tongket;
		}
		else
		{
			while ($nam_tongket <= $max_year)
			{
				tongket_taichinh($nam_tongket);
				$nam_tongket++;
			}
		}
		break;
		
	case "del":
		if (delete_tongket())
		{
			$msg = "X&oacute;a th&agrave;nh c&ocirc;ng!";
			$site = "index.php?fod=ad&act=tk_tc&exe=tk_tc";
			page_transfer($msg,$site);
		}
		break;	
}

$lst_find_year_count = 0;
$lst_find_year = array();
list_find_year();

$tongket_count = 0;
$tongket = array();
list_tongket();

function get_max_year()
{
	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$max_year = 0;
	$sql_select = "SELECT MAX(nam) AS nam FROM tongket_quy";
	$sql_query = $dbsql->query($sql_select);
	if ( mysql_num_rows($sql_query)>0 )
	{
          $result = $dbsql->fetch_array($sql_query);
          $max_year = $result["nam"];
    }
	$dbsql->close();
	return $max_year;
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

function list_finance_year()
{
	global $lst_finance_year_count,$lst_finance_year;

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
			$lst_finance_year["year"][$lst_finance_year_count] 	= $result["year"];
			$lst_finance_year_count++;
	   }
	}
	$dbsql->close();
}

function list_find_year()
{
	global 	$lst_find_year_count, $lst_find_year;

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
			$lst_find_year["nam"][$lst_find_year_count] 	= $result["nam"];
			$lst_find_year_count++;
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

function tongket_taichinh($year)
{
	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	// xoa tong ket cu~
	$sql_delete_old_tongket = "DELETE FROM tongket_quy WHERE nam = ".$year;
	$dbsql->query($sql_delete_old_tongket);
	
	//Chon loai tien
	$sql_select_tien = "SELECT * FROM loai_tien";
	$sql_query_tien = $dbsql->query($sql_select_tien);
	$rows_tien = mysql_num_rows($sql_query_tien);
	if ($rows_tien>0)
	{
		while ($result_tien = $dbsql->fetch_array($sql_query_tien))
		{
			// Chon  Sum thu chi 
			$sql_select_sum = "SELECT year(ngayphatsinh) AS nam, Sum(If(loaiphieu='T',sotien,0)) AS tong_thu, 
								  Sum(If(loaiphieu='C',sotien,0)) AS tong_chi, id_loaitien 
						   FROM thu_chi WHERE year(ngayphatsinh) ='".$year."' AND id_loaitien = ".$result_tien['id_loaitien']."
						   GROUP BY nam";  
			$sql_query_sum = $dbsql->query($sql_select_sum);
			$tong_thu = 0;
			$tong_chi = 0;
			$rows_sum = mysql_num_rows($sql_query_sum);
			if ($rows_sum>0)
			{
				$result_sum = $dbsql->fetch_array($sql_query_sum);
				$tong_thu 	= $result_sum["tong_thu"];
				$tong_chi 	= $result_sum["tong_chi"];
			}
			
			//Lay so du	
			$sodu_dauky = 0;
			$sodu_cuoiky = 0;			
			$sql_select_sddk = "SELECT sodu_cuoiky FROM tongket_quy WHERE nam = ".($year-1)." AND id_loaitien = ".$result_tien['id_loaitien'];
			$sql_query_sddk = $dbsql->query($sql_select_sddk);
			$rows_sddk = mysql_num_rows($sql_query_sddk);
			if ($rows_sddk>0)
			{
				$result_sddk = $dbsql->fetch_array($sql_query_sddk);
				$sodu_dauky = $result_sddk["sodu_cuoiky"];
			}
			$sodu_cuoiky = $tong_thu + $sodu_dauky - $tong_chi;
			
			//Update du lieu
			if ( ($tong_thu!=0)||($tong_chi!=0)||($sodu_dauky!=0) )
			{
				$sql_insert_tongket = "INSERT INTO tongket_quy (nam, sodu_dauky, tong_thu, tong_chi, sodu_cuoiky, id_loaitien)
							   VALUES('".$year."',".$sodu_dauky.",".$tong_thu.",".$tong_chi.",".$sodu_cuoiky.",".$result_tien['id_loaitien'].")";
				$dbsql->query($sql_insert_tongket);	
			}
		}
	}
	$dbsql->close();
}

function delete_tongket()
{
	global $id_tongket;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
			
	$sql_delete = "DELETE FROM tongket_quy WHERE id_tongket = $id_tongket";
	$dbsql->query($sql_delete);
	$dbsql->close();
	return true;
}
?>