<?php
//$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

$users_bdh_count = 0;
$users_bdh = array();

list_members_dieuhanh();

function list_members_dieuhanh(){
      global $users_bdh_count,$users_bdh;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //--------------------------------------------------------------
	 $sql_select = "SELECT users.id_user, users.last_name AS last_name, 
			 			   users.first_name AS first_name, 
						   users.address AS address, 
						   users.tel AS tel,
						   user_dieuhanh.chucvu AS chucvu
					FROM users INNER JOIN user_dieuhanh 
					ON users.id_user = user_dieuhanh.id_user 
					ORDER BY user_dieuhanh.order_num ASC, users.last_name ASC";	 
     $sql_query = $dbsql->query($sql_select);
     $rows = $dbsql->num_rows($sql_query);
     if ($rows>0)
     {
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$users_bdh["id"][$users_bdh_count] 			= $result["id_user"];
			$users_bdh["realname"][$users_bdh_count] 	= $result["first_name"].' '.$result["last_name"];
			$users_bdh["chucvu"][$users_bdh_count] 		= $result["chucvu"];
			$users_bdh["address"][$users_bdh_count] 	= $result["address"];
			$users_bdh["tel"][$users_bdh_count] 		= $result["tel"];
			$users_bdh_count++;
		}
     }
     //--------------------------------------------------------------
     $dbsql->close();
}

?>