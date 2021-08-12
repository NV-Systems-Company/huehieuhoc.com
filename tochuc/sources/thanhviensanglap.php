<?php
//$code   = isset($_GET["code"])  ? $_GET["code"]  : '';
$page_start = ($page-1)*$members_per_page;
$page_end   = $page*$members_per_page;
$show_page = "";

$users_sl_count = 0;
$users_sl = array();

list_members_sanglap();

function list_members_sanglap()
{
      global $users_sl_count,$users_sl,$page_start,$page_end,$show_page,$members_per_page,$page;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //--------------------------------------------------------------
	 $sql_select = "SELECT users.id_user, users.last_name AS last_name, 
			 			   users.first_name AS first_name, 
						   users.address AS address, 
						   users.tel AS tel,
						   users.email AS email
					FROM users INNER JOIN user_sanglap 
					ON users.id_user = user_sanglap.id_user 
					ORDER BY users.order_num ASC, users.last_name ASC";	 
					
     $sql_query = $dbsql->query($sql_select);
     $rows = $dbsql->num_rows($sql_query);
     if ($rows>0)
     {
		$num_page = ceil($rows/$members_per_page);
		if ($num_page>1)
		{
			 $show_page = "Trang:";
			 for ($i=1;$i<$num_page+1;$i++)
			 {
				   if ($i==$page) $show_page .= " [$i]";
				   else $show_page .= " <a href='index.php?fod=tch&act=tvsl&exe=tvsl&page=".$i."'>[$i]</a>";
			 }
		}
		
		$i=0;   
		while ($result = $dbsql->fetch_array($sql_query))
		{
			if ($i>=$page_start)
            {
				$users_sl["id"][$users_sl_count] 		= $result["id_user"];
				$users_sl["realname"][$users_sl_count] 	= $result["first_name"].' '.$result["last_name"];
				$users_sl["email"][$users_sl_count] 	= $result["email"];
				$users_sl["address"][$users_sl_count] 	= $result["address"];
				$users_sl["tel"][$users_sl_count] 		= $result["tel"];
				$users_sl_count++;
			}
			$i++;
            if ($i>=$page_end) break;
		}
     }
     //--------------------------------------------------------------
     $dbsql->close();
}

?>