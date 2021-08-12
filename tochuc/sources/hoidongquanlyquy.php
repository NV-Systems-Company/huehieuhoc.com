<?php
//$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

$users_qlq_count = 0;
$users_qlq = array();

list_members_qlquy();

function list_members_qlquy(){
      global $users_qlq_count,$users_qlq;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //--------------------------------------------------------------
	 $sql_select = "SELECT users.id_user, users.last_name AS last_name, 
			 			   users.first_name AS first_name, 
						   users.address AS address, 
						   users.tel AS tel,
						   user_quanlyquy.chucvu AS chucvu
					FROM users INNER JOIN user_quanlyquy 
					ON users.id_user = user_quanlyquy.id_user 
					ORDER BY user_quanlyquy.order_num ASC, users.last_name ASC";	 
     $sql_query = $dbsql->query($sql_select);
     $rows = $dbsql->num_rows($sql_query);
     if ($rows>0)
     {
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$users_qlq["id"][$users_qlq_count] 			= $result["id_user"];
			$users_qlq["realname"][$users_qlq_count] 	= $result["first_name"].' '.$result["last_name"];
			$users_qlq["chucvu"][$users_qlq_count] 		= $result["chucvu"];
			$users_qlq["address"][$users_qlq_count] 	= $result["address"];
			$users_qlq["tel"][$users_qlq_count] 		= $result["tel"];
			$users_qlq_count++;
		}
     }
     //--------------------------------------------------------------
     $dbsql->close();
}

?>