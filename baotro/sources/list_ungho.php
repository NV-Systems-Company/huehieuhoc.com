<?php
//$act    = isset($_GET["act"])  	? $_GET["act"]   : 'idx';
//$code   = isset($_GET["code"])  ? $_GET["code"]  : '';
$record_start = ($page-1)*$ungho_per_page;
$record_end   = $page*$ungho_per_page;
$show_page = "";

$msg    		= isset($msg)  	? $msg   : '';
$keyword 		= isset($_POST["keyword"]) 		? $_POST["keyword"]: '';
				if ($keyword =='') $keyword  = isset($_GET["key"])? $_GET["key"]: '';
				 
$id_ungho 		= isset($_POST["id_ungho"]) ? $_POST["id_ungho"]: -1;
					if ($id_ungho==-1) $id_ungho = isset($_GET["id"])? $_GET["id"]: -1;
$canhan_donvi 	= isset($_POST["canhan_donvi"]) ? $_POST["canhan_donvi"]: -1;
					if ($canhan_donvi==-1) $canhan_donvi = isset($_GET["dt"])? $_GET["dt"]: -1;
					
$ngay 		= isset($ngay) 		? $ngay 		: '';
$nguoiungho	= isset($nguoiungho)? $nguoiungho 	: '';
$address	= isset($address) 	? $address 		: '';
$website	= isset($website) 	? $website 		: '';
$email		= isset($email) 	? $email 		: '';
$tel		= isset($_tel) 		? $tel 			: '';
$fax		= isset($fax) 		? $fax 			: '';
$yim		= isset($yim) 		? $yim 			: '';
$ungho		= isset($ungho) 	? $ungho 		: '';
$link_news	= isset($link_news) ? $link_news	: '';


$ds_ungho_count = 0;
$ds_ungho = array();
list_ungho();

	
function list_ungho()
{
	global $ds_ungho_count,$ds_ungho,$keyword, $canhan_donvi, $record_start,$record_end,$show_page,$ungho_per_page,$page;

	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT * FROM ds_ungho ";
	if (($canhan_donvi!=-1)||($keyword!='')) $sql_select .= "WHERE id_ungho<>-1 ";
	if ($canhan_donvi!=-1) $sql_select .= "AND canhan_donvi=$canhan_donvi ";
	if ($keyword!='') $sql_select .= "AND (nguoiungho LIKE '%".$keyword."%') ";	
	$sql_select .= "ORDER BY ngay DESC";
	$sql_query = $dbsql->query($sql_select);
	$rows = $dbsql->num_rows($sql_query);
	if ($rows>0)
	{
	   $num_page = ceil($rows/$ungho_per_page);
	   if ($num_page>1)
	   {
			 $show_page = "Trang:";
			 for ($i=1;$i<$num_page+1;$i++)
			 {
				   if ($i==$page) $show_page .= " [$i]";
				   else $show_page .= " <a href='index.php?fod=bt&act=lst_uh&exe=lst_uh&dt=".$canhan_donvi."&key=".$keyword."&page=".$i."'>[$i]</a>";
			 }
	   }
	
	   mysql_data_seek($sql_query, $record_start);
	   while (($result = $dbsql->fetch_array($sql_query))&&(($ds_ungho_count+$record_start)<$record_end))
	   {
			$ds_ungho["id_ungho"][$ds_ungho_count] 		= $result["id_ungho"];
			$ds_ungho["canhan_donvi"][$ds_ungho_count] 	= $result["canhan_donvi"];
			$ds_ungho["ngay"][$ds_ungho_count] 			= cv_date_vietnam($result["ngay"]);
			$ds_ungho["nguoiungho"][$ds_ungho_count] 	= str_replace("\n","<br>",$result["nguoiungho"]);
			$ds_ungho["ungho"][$ds_ungho_count] 		= str_replace("\n","<br>",$result["ungho"]);	
			$ds_ungho_count++;
	   }
	}
}
?>