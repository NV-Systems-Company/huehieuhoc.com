<?php
$act   	= isset($_GET["act"])  ? $_GET["act"] 	: 'idx';
$code   = isset($_GET["code"]) ? $_GET["code"] 	: '';
$id   	= isset($_GET["id"])   ? $_GET["id"]  	: 0; //id_hocbong

$page_start = ($page-1)*$posts_per_page;
$page_end   = $page*$posts_per_page;
$show_page = "";
$msg		= isset($msg) ? $msg : '';

//---News ----
$posts_count = 0;
$posts = array();

switch ($code){	
	 case "v_list":
		list_hocbong();
		break;
		
	 case "view":
		view_hocbong($id);
		break;
}

//=======Function for THONG BAO =============
//======================================
function list_hocbong()
{
	global 	$hocbong_count, $hocbong,
			$page_start, $page_end, $page, $posts_per_page, $show_page;
			
	$hocbong_count = 0;
	$hocbong = array();
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
      //-----------------------------------------------------
      $sql_select = "SELECT * FROM hocbong ORDER BY ngay_hb DESC ";
      $sql_query = $dbsql->query($sql_select);
      $rows = $dbsql->num_rows($sql_query);
      if ($rows>0)
      {
           $num_page = ceil($rows/$posts_per_page);
           if ($num_page>1)
           {
                 $show_page = "Page:";
                 for ($i=1;$i<$num_page+1;$i++)
                 {
                       if ($i==$page) $show_page .= " [$i]";
                       else $show_page .= " <a href='index.php?fod=hb&act=lst_tb&exe=w_hb&code=v_list&page=".$i."'>[$i]</a>";
                 }
           }

           $i=0;
           while ($result = $dbsql->fetch_array($sql_query))
           {
                 if ($i>=$page_start)
                 {
                      $hocbong["id_hocbong"][$hocbong_count] = $result["id_hocbong"];
					  $hocbong["ngay_hb"][$hocbong_count] 	= gmdate("d-m-Y",$result["ngay_hb"]).'<br>'.gmdate("h:i a",$result["ngay_hb"]);
                      $hocbong["hocbong"][$hocbong_count] 	= "<a href='./hocbong/index.php?code=view&id=".$result["id_hocbong"]."'>".$result["hocbong"]."</a>"; 
                      $hocbong_count++;
                 }
                 $i++;
                 if ($i>=$page_end) break;
           }
      }
      $dbsql->close();
}

//========================================
function view_hocbong($id_hocbong)
{
	global 	$file_hocbong;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_news_select = "SELECT * FROM hocbong WHERE id_hocbong=$id_hocbong";
	$sql_news_query = $dbsql->query($sql_news_select);
	$result = $dbsql->fetch_array($sql_news_query);
	$file_hocbong = $result["file_hocbong"];
	$dbsql->close();
}
?>