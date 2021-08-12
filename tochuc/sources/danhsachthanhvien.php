<?php
$desc   = isset($_GET["desc"])  ? $_GET["desc"]  : '';
$page_start = ($page-1)*$members_per_page;
$page_end   = $page*$members_per_page;
$show_page = "";

$users_tg_count = 0;
$users_tg = array();

list_members_thamgia();

function list_members_thamgia()
{
      global $users_tg_count,$users_tg,$page_start,$page_end,$show_page,$members_per_page,$page, $desc;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //--------------------------------------------------------------
	 if ($desc!=" ")  $sql_select = "SELECT * FROM users WHERE (last_name LIKE '".strtolower($desc)."%' OR last_name LIKE '".strtoupper($desc)."%') AND approve=1 ORDER BY order_num ASC, last_name ASC";
	 else $sql_select = "SELECT * FROM users WHERE approve=1 ORDER BY users.order_num ASC, users.last_name ASC";	 
					
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
				   else $show_page .= " <a href='index.php?fod=tch&act=dstv&exe=dstv&desc=$desc&page=".$i."'>[$i]</a>";
			 }
		}
		
		$i=0;   
		while ($result = $dbsql->fetch_array($sql_query))
		{
			if ($i>=$page_start)
            {
				$users_tg["id"][$users_tg_count] 		= $result["id_user"];
				$users_tg["realname"][$users_tg_count] 	= $result["first_name"].' '.$result["last_name"];
				$users_tg["email"][$users_tg_count] 	= $result["email"];
				$users_tg["address"][$users_tg_count] 	= $result["address"];
				$users_tg["tel"][$users_tg_count] 		= $result["tel"];
				$users_tg_count++;
			}
			$i++;
            if ($i>=$page_end) break;
		}
     }
     //--------------------------------------------------------------
     $dbsql->close();
}

?>