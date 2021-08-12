<?php
$act   	= isset($_GET["act"])  ? $_GET["act"] 	: 'idx';
$code   = isset($_GET["code"]) ? $_GET["code"] 	: '';
$id   	= isset($_GET["id"])   ? $_GET["id"]  	: 0; //id_thongbao

$page_start = ($page-1)*$posts_per_page;
$page_end   = $page*$posts_per_page;
$show_page = "";
$msg		= isset($msg) ? $msg : '';

//---News ----
$posts_count = 0;
$posts = array();

switch ($code){	
	 case "v_list":
		list_thongbao();
		break;
		
	 case "view":
		view_thongbao($id);
		break;
}

//=======Function for THONG BAO =============
//======================================
function list_thongbao()
{
	global 	$thongbao_count, $thongbao,
			$page_start, $page_end, $page, $posts_per_page, $show_page;
			
	$thongbao_count = 0;
	$thongbao = array();
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
      //-----------------------------------------------------
      $sql_select = "SELECT * FROM thongbao ORDER BY ngay_tb DESC ";
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
                       else $show_page .= " <a href='index.php?fod=ad&act=lst_news&exe=news&code=$code&app=$approve&page=".$i."'>[$i]</a>";
                 }
           }

           $i=0;
           while ($result = $dbsql->fetch_array($sql_query))
           {
                 if ($i>=$page_start)
                 {
                      $thongbao["id_thongbao"][$thongbao_count] = $result["id_thongbao"];
					  $thongbao["ngay_tb"][$thongbao_count] 	= gmdate("d-m-Y",$result["ngay_tb"]).'<br>'.gmdate("h:i a",$result["ngay_tb"]);
                      $thongbao["thong_bao"][$thongbao_count] 	= "<a href='./thongbao/index.php?code=view&id=".$result["id_thongbao"]."'>".$result["thong_bao"]."</a>"; 
                      $thongbao_count++;
                 }
                 $i++;
                 if ($i>=$page_end) break;
           }
      }
      $dbsql->close();
}

//========================================
function view_thongbao($id_thongbao)
{
	global 	$file_thongbao;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_news_select = "SELECT * FROM thongbao WHERE id_thongbao=$id_thongbao";
	$sql_news_query = $dbsql->query($sql_news_select);
	$result = $dbsql->fetch_array($sql_news_query);
	$file_thongbao = $result["file_thongbao"];
	$dbsql->close();
}
?>