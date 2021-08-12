<?php
$code   = isset($_GET["code"]) ? $_GET["code"] 	: 'view';
$id   	= isset($_GET["id"])   ? $_GET["id"]  	: 0; //id_hoatdong

switch ($code){		
	 case "view":
		view_hoatdong($id);
		break;
}

//=======Function for Hoat dong anh =============
function view_hoatdong($id_hoatdong)
{
	global 	$file_hoatdong, $title_hoatdong, $ngay_capnhat;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	if ($id_hoatdong==0)
	{
		$sql_max_select = "SELECT MAX(id_hoatdong) AS id_hoatdong FROM hoatdong";
		$sql_max_query = $dbsql->query($sql_max_select);
		$result_max = $dbsql->fetch_array($sql_max_query);
		$id_hoatdong = $result_max["id_hoatdong"];
	}
	$sql_select = "SELECT * FROM hoatdong WHERE id_hoatdong=$id_hoatdong";
	$sql_query = $dbsql->query($sql_select);
	$result = $dbsql->fetch_array($sql_query);
	$file_hoatdong 	= $result["file_hoatdong"];
	$title_hoatdong = $result["hoatdong"];
	$ngay_capnhat	= gmdate("d-m-Y, h:i a",$result["ngay_hd"]);
	$dbsql->close();
	
	list_old_hoatdong($result["ngay_hd"]);
}

//=================================
function list_old_hoatdong($date)
{
	global 	$hoatdong_count,
			$hoatdong;
	
	$num_item = 10;
	$hoatdong_count = 0;
	$hoatdong = array();
			
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_news_select = "SELECT * FROM hoatdong WHERE (ngay_hd < $date) ORDER BY ngay_hd DESC";
	$sql_news_query = $dbsql->query($sql_news_select);
	if ($dbsql->num_rows($sql_news_query)>0)
	{
		while (($result = $dbsql->fetch_array($sql_news_query))&&($hoatdong_count < $num_item))
		{
			$hoatdong["id_hoatdong"][$hoatdong_count] 	= $result["id_hoatdong"];
			$hoatdong["hoatdong"][$hoatdong_count] 		= "<a href='index.php?act=view&code=view&id=".$result["id_hoatdong"]."'>".$result["hoatdong"]."</a>";
			$hoatdong["ngay_hd"][$hoatdong_count] 		= gmdate("d-m-Y",$result["ngay_hd"]);
			$hoatdong_count++;
		}
	}
	$dbsql->close();
}

?>