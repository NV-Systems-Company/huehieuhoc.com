<?php
//$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

$donghanh_count = 0;
$donghanh = array();

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
			$donghanh_count++;
		}
	}
	//--------------------------------------------------------------
	$dbsql->close();
}

?>