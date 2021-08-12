<?php
$act   = isset($act)  ? $act  : '';
$page_start = ($page-1)*$members_per_page;
$page_end   = $page*$members_per_page;
$show_page = "";
$users_count = 0;
$users = array();
list_members();

function list_members(){
      global $users_count,$users,$id,$desc,$page_start,$page_end,$show_page,$members_per_page,$page, $act;
	  
	  if (($act!= "lstmem")&&($act!= "notmem")) return false;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //--------------------------------------------------------------
	 if ($act=="lstmem")
	 {
		 if ($desc!=" ")  $sql_select = "SELECT * FROM users WHERE (last_name LIKE '".strtolower($desc)."%' OR last_name LIKE '".strtoupper($desc)."%') AND approve=1 ORDER BY last_name ASC";
		 else   $sql_select = "SELECT * FROM users WHERE approve=1 ORDER BY order_num ASC, last_name ASC";
	 }
	 else
	 {
		 if ($desc!=" ")  $sql_select = "SELECT * FROM users WHERE (last_name LIKE '".strtolower($desc)."%' OR last_name LIKE '".strtoupper($desc)."%') AND approve=0 ORDER BY last_name ASC";
		 else   $sql_select = "SELECT * FROM users WHERE approve=0 ORDER BY order_num ASC, last_name ASC";	 
	 }
	 
     $sql_query = $dbsql->query($sql_select);
     $rows = $dbsql->num_rows($sql_query);
     if ($rows>0)
     {
           $num_page = ceil($rows/$members_per_page);
           if ($num_page>1)
           {
                 $show_page = "Page:";
                 for ($i=1;$i<$num_page+1;$i++)
                 {
                       if ($i==$page) $show_page .= " [$i]";
                       else $show_page .= " <a href='index.php?fod=ad&act=".$act."&exe=lstmem&page=".$i."'>[$i]</a>";
                 }
           }

           $i=0;
           while ($result = $dbsql->fetch_array($sql_query))
           {
                 if ($i>=$page_start)
                 {
                      $users["id"][$users_count] = $result["id_user"];
                      $users["realname"][$users_count] = $result["first_name"].' '.$result["last_name"];

                      //Banned ?
                      $ban_check = "SELECT * FROM banned WHERE id_user=".$users["id"][$users_count];
                      $ban_query = $dbsql->query($ban_check);
                      if ($dbsql->num_rows($ban_query)>0){
                           $users["ban"][$users_count] = "<a href='index.php?fod=ad&act=$act&exe=editmem&code=unban&page=$page&id=".$users["id"][$users_count]."'>B&#7887; c&#7845;m</a>";
                           $users["banned"][$users_count] = "(b&#7883; c&#7845;m)";
                      }
                      else{
                           $users["ban"][$users_count] = "<a href='index.php?fod=ad&act=$act&exe=editmem&code=ban&page=$page&id=".$users["id"][$users_count]."'>C&#7845;m th&agrave;nh vi&ecirc;n n&agrave;y</a>";
                           $users["banned"][$users_count] = "";
                      }

                      $users_count++;
                 }
                 $i++;
                 if ($i>=$page_end) break;
           }
     }
     //--------------------------------------------------------------
     $dbsql->close();
}
?>