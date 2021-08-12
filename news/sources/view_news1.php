<?php
$act   	= isset($_GET["act"])  ? $_GET["act"] 	: 'idx';
$code   = isset($_GET["code"]) ? $_GET["code"] 	: 'home';
$id   	= isset($_GET["id"])   ? $_GET["id"]  	: 1; //id_post

$num_news_intro = 5; //so tin gioi thieu ngoai trang chu
$num_news_index = 10; //so tin liet ke ben duoi
//---News ----
switch ($code){		
	case "home":
		home_news();
		break;
	case "item":
		view_item_news($id);
		break;
}

//======================================
function home_news()
{
	global 	$news_count,
			$news,
			$num_news_intro, $num_news_index;
	
	$news_count = 0;
	$news = array();
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_news_select = "SELECT * FROM news_posts WHERE approve = 1 ORDER BY re_appear_home DESC, post_date DESC";
	$sql_news_query = $dbsql->query($sql_news_select);
	if ($dbsql->num_rows($sql_news_query)>0)
	{
		while (($result_news = $dbsql->fetch_array($sql_news_query))&&($news_count < $num_news_intro+$num_news_index))
		{
			$news["id_post"][$news_count] 		= $result_news["id_post"];
			$news["title"][$news_count] 		= "<a href='index.php?fod=news&act=item&exe=news&code=item&id=".$result_news['id_post']."'>".$result_news["title"]."</a>";
			$news["content_desc"][$news_count] 	= str_replace("\n","<br>",$result_news["content_desc"]);
			$news["content_detail"][$news_count]= isset($result_news["content_detail"]) ? str_replace("\n","<br>",$result_news["content_detail"]) :'';
			//$news["author"][$news_count] 		= $result_news["author"];
			$news["nguontin"][$news_count] 		= isset($result_news["nguontin"]) ? $result_news["nguontin"] :'';
			if ($news["nguontin"][$news_count]!='')
			{
				$news["link_nguontin"][$news_count]	= isset($result_news["link_nguontin"]) ? $result_news["link_nguontin"] : '';
				if (trim($news["link_nguontin"][$news_count])!='') 
					$news["nguontin"][$news_count] = "<a href='".$result_news["link_nguontin"]."' target='_blank'>(".$news['nguontin'][$news_count].")</a>";
				else
					$news["nguontin"][$news_count] = "(".$news['nguontin'][$news_count].")";
			}
			$news["chitiet"][$news_count] 		= "<a href='index.php?fod=news&act=item&exe=news&code=item&id=".$result_news['id_post']."'>Xem chi ti&#7871;t>></a>";
			$news["imgname"][$news_count] 		= (!empty($result_news["imgname"])) ? "<img src='./news/news_images/".$result_news["imgname"]."' width='200'>" : '';
			if ($news_count < $num_news_intro)
				$news["post_date"][$news_count] 	= "C&#7853;p nh&#7853;t: " . gmdate("d-m-Y, h:i a",$result_news["post_date"]);
			else
				$news["post_date"][$news_count] 	= gmdate("d-m-Y",$result_news["post_date"]);
			$news_count++;
		}
	}
	$dbsql->close();
}

//===================================
function view_item_news($id_post)
{
	global 	$title, $content_desc, $content_detail, $author, $post_date, $imgname, $nguontin, $link_nguontin;
			
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_news_select = "SELECT * FROM news_posts WHERE id_post=$id_post AND approve = 1";
	$sql_news_query = $dbsql->query($sql_news_select);
	$result = $dbsql->fetch_array($sql_news_query);
	$title 			= $result["title"];
	$content_desc 	= str_replace("\n","<br>",$result["content_desc"]);
	$content_detail = isset($result["content_detail"]) ? str_replace("\n","<br>",$result["content_detail"]) : '';
	$nguontin 		= isset($result["nguontin"]) ? $result["nguontin"] : '';
	if ($nguontin!='')
	{
		$link_nguontin  = isset($result["link_nguontin"]) ? $result["link_nguontin"] : '';
		if ($link_nguontin!='') 
			$nguontin = "<a href='".$link_nguontin."' target='_blank'>(".$nguontin.")</a>";			
		else
			$nguontin = "(".$nguontin.")";
	}
	$author 		= isset($result["author"]) ? $result["author"] :'';
	$post_date		= "C&#7853;p nh&#7853;t: " . gmdate("d-m-Y, h:i a",$result["post_date"]);
	$imgname = (!empty($result["imgname"])) ? "<img src='./news/news_images/".$result["imgname"]."' width='250'>" : "";
	$dbsql->close();
	
	list_old_news($result["post_date"]);
}

//=================================
function list_old_news($date)
{
	global 	$news_count,
			$news, $num_news_index;
	
	$news_count = 0;
	$news = array();
			
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_news_select = "SELECT * FROM news_posts WHERE (post_date < $date) AND approve = 1 ORDER BY post_date DESC";
	$sql_news_query = $dbsql->query($sql_news_select);
	if ($dbsql->num_rows($sql_news_query)>0)
	{
		while (($result_news = $dbsql->fetch_array($sql_news_query))&&($news_count < $num_news_index))
		{
			$news["id_post"][$news_count] 	= $result_news["id_post"];
			$news["title"][$news_count] 	= "<a href='index.php?fod=news&act=item&exe=news&code=item&id=".$result_news['id_post']."'>".$result_news["title"]."</a>";
			$news["post_date"][$news_count] = gmdate("d-m-Y",$result_news["post_date"]);
			$news_count++;
		}
	}
	$dbsql->close();
}
?>