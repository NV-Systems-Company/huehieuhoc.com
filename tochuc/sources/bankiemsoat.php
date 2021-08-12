<?php
//$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

$users_bks_count = 0;
$users_bks = array();

list_members_kiemsoat();

function list_members_kiemsoat(){
      global $users_bks_count,$users_bks;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //--------------------------------------------------------------
	 $sql_select = "SELECT users.id_user, users.last_name AS last_name, 
			 			   users.first_name AS first_name, 
						   users.address AS address, 
						   users.tel AS tel,
						   user_kiemsoat.chucvu AS chucvu
					FROM users INNER JOIN user_kiemsoat 
					ON users.id_user = user_kiemsoat.id_user 
					ORDER BY user_kiemsoat.order_num ASC, users.last_name ASC";	 
     $sql_query = $dbsql->query($sql_select);
     $rows = $dbsql->num_rows($sql_query);
     if ($rows>0)
     {
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$users_bks["id"][$users_bks_count] 		= $result["id_user"];
			$users_bks["realname"][$users_bks_count] 	= $result["first_name"].' '.$result["last_name"];
			$users_bks["chucvu"][$users_bks_count] 	= $result["chucvu"];
			$users_bks["address"][$users_bks_count] 	= $result["address"];
			$users_bks["tel"][$users_bks_count] 		= $result["tel"];
			$users_bks_count++;
		}
     }
     //--------------------------------------------------------------
     $dbsql->close();
}

?>