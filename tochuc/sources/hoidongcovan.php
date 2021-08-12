<?php
//$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

$users_cv_count = 0;
$users_cv = array();

list_members_covan();

function list_members_covan(){
      global $users_cv_count,$users_cv;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //--------------------------------------------------------------
	 $sql_select = "SELECT users.id_user, users.last_name AS last_name, 
			 			   users.first_name AS first_name, 
						   users.address AS address, 
						   users.tel AS tel,
						   user_covan.chucvu AS chucvu
					FROM users INNER JOIN user_covan 
					ON users.id_user = user_covan.id_user 
					ORDER BY user_covan.order_num ASC, users.last_name ASC";	 
     $sql_query = $dbsql->query($sql_select);
     $rows = $dbsql->num_rows($sql_query);
     if ($rows>0)
     {
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$users_cv["id"][$users_cv_count] 		= $result["id_user"];
			$users_cv["realname"][$users_cv_count] 	= $result["first_name"].' '.$result["last_name"];
			$users_cv["chucvu"][$users_cv_count] 	= $result["chucvu"];
			$users_cv["address"][$users_cv_count] 	= $result["address"];
			$users_cv["tel"][$users_cv_count] 		= $result["tel"];
			$users_cv_count++;
		}
     }
     //--------------------------------------------------------------
     $dbsql->close();
}

?>