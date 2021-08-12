<?php
if (!isset($act))
	$act   	= isset($_GET["act"])  ? $_GET["act"] 	: 'idx';
$code   = isset($_GET["code"]) ? $_GET["code"] 	: '';
$app   	= isset($_GET["app"])  ? $_GET["app"]  	: 1;
$id   	= isset($_GET["id"])   ? $_GET["id"]  	: 1; //id_post
$page_start = ($page-1)*$posts_per_page;
$page_end   = $page*$posts_per_page;
$show_page = "";
$msg		= isset($msg) ? $msg : '';

//---News ----
$posts_count = 0;
$posts = array();
$subject='';	// title cho danh sach tin
$total_rows = 0;

//---categories----
$cats_count = 0;
$cats = array();

$cats_select_count = 0; // so catagories duoc chon
$cats_select = array();

$cat_name	= isset($_POST["cat_name"]) ? $_POST["cat_name"] : '';
$cat_order 	= isset($_POST["cat_order"]) ? $_POST["cat_order"] : '';

//$title          = isset($_POST["title"])             ? htmlspecialchars($_POST["title"])       	: '';
$title          = isset($_POST["title"])             ? ($_POST["title"])       		: '';
$content_desc   = isset($_POST["content_desc"])      ? ($_POST["content_desc"])		: '';
$content_detail = isset($_POST["content_detail"])    ? ($_POST["content_detail"])   : '';
$author 		= isset($_POST["author"])    		 ? ($_POST["author"])   		: '';
$nguontin 		= isset($_POST["nguontin"])    	 	 ? ($_POST["nguontin"])   		: '';
$link_nguontin	= isset($_POST["link_nguontin"])     ? ($_POST["link_nguontin"])   	: '';
$imgname        = isset($_FILES['imgfile']['name'] ) ? $_FILES['imgfile']['name'] 	: '';

switch ($code){
	//---categories---
	 case "add":
	 	list_categories();
		add_categories();
		break;
		
     case "cats":
		list_categories();
		break;

	case "del":
		$id_cat =  isset($_GET["id_cat"])  ? $_GET["id_cat"]  : 0;
		delete_categories($id_cat);
		break;
	  
	case "save":
		save_lst_categories();
		list_categories();
		break;

	//---News-----	
	case "app_sm":
		approve_news($app);
		list_news($app);
		break;
		
	case "post":
		list_categories();
		break; 
	
	case "postsm":
		list_categories();
		add_news();
		break;
		 
	case "del_news":
		delete_news($id);
		break;
	
	case "edit_news":
		$approve = !empty($_POST["approve"]) ? 1 : 0;
		list_categories();
		get_news_info($id);
		break; 
		
	case "edit_news_sm":
		$approve = !empty($_POST["approve"]) ? 1 : 0;
		list_categories();
		edit_news($id);
		break; 

	case "lst_news":
		list_news($app);
		break;
		
	case "try_view":
		$v_img	= isset($_POST["v_img"]) ? $_POST["v_img"] : '';
		$v_img = str_replace("\\\\","/",$v_img);
		try_view_news($id);
		break;
		
	case "view_news":
		get_news_info($id);
		$content_desc = str_replace("\n","<br>",$content_desc);
		$content_detail = str_replace("\n","<br>",$content_detail);
		break;
}


//======FUNCTION FOR CATEGORIES=========
//======================================
function add_categories()
{
	global 	$msg,
			$cat_name,
			$cat_order;
	
	$order_qc = 1;
	
	if (trim($cat_name)=='')
	{	
		$msg = $msg."- <b>T&ecirc;n chuy&ecirc;n m&#7909;c ch&#432;a c&oacute;!</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
    }

   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	if ($cat_order=='') $cat_order = 1;
	$sql_insert = "INSERT INTO news_categories (cat_name,cat_order)
							 VALUES('".$cat_name."','".$cat_order."')";
	$dbsql->query($sql_insert);	
	
	//---------------------
    $dbsql->close();
	
	$site = "index.php?fod=ad&act=cats_news&exe=news&code=cats";
	page_fast_transfer($site);
	return true;
}

//========================
function delete_categories($id_cat)
{
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
		
	$sql_delete = "DELETE FROM news_categories WHERE id_cat = $id_cat";
	$dbsql->query($sql_delete);
	$dbsql->close();

	$site = "index.php?fod=ad&act=cats_news&exe=news&code=cats";
	page_fast_transfer($site);
	return true;
}
//========================
function list_categories()
{
	global $cats_count,$cats;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_select = "SELECT * FROM news_categories ORDER BY cat_order ASC";
	$sql_query = $dbsql->query($sql_select);
	if ($dbsql->num_rows($sql_query)>0)
	{
	   while ( $result = $dbsql->fetch_array($sql_query) )
	   {
			$cats["id_cat"][$cats_count] 	= $result["id_cat"];
			$cats["cat_name"][$cats_count] = $result["cat_name"];
			$cats["cat_order"][$cats_count]= $result["cat_order"];
			$cats["posts"][$cats_count] 	= $result["posts"];		
				//---Kiem tra categories nay co tin khong ----- 
				$sql_select_catsposts = "SELECT COUNT(id_cat) AS num_post FROM news_catsposts WHERE id_cat=".$result['id_cat'];
				$sql_query_catsposts = $dbsql->query($sql_select_catsposts);
				$result_catsposts = $dbsql->fetch_array($sql_query_catsposts);
				$count_post = isset($result_catsposts['num_post']) ? $result_catsposts['num_post'] : 0;
				//------------------------------------------------
			$cats["del"][$cats_count] = ($count_post==0) ? ("<a href='index.php?fod=ad&act=cats_news&exe=news&code=del&id_cat=".$result["id_cat"]."'><img src='./images/delete.gif' border=0></a>") : '';
			$cats_count++;
	   }
	}
	$dbsql->close();
}

//========================
function save_lst_categories()
{
	global $_POST;
	
	$number_cats = isset($_POST["number_cats"]) ? $_POST["number_cats"] : 0;
	if ($number_cats>0)
	{
		$dbsql = new db_mysql;
		$dbsql->connect();
		$dbsql->selectdb();
		
		for($i=0;$i<$number_cats;$i++)
		{
			$id_cat	 	= isset($_POST["id_cat_$i"]) 	? $_POST["id_cat_$i"] : 0;	
			$cat_order 	= isset($_POST["cat_order_$i"]) ? $_POST["cat_order_$i"] : 1;	
			$cat_name 	= isset($_POST["cat_name_$i"]) 	? $_POST["cat_name_$i"] : '';	
			
			$sql_update = "UPDATE news_categories SET cat_order='".$cat_order."', cat_name='".$cat_name."' WHERE id_cat=$id_cat";
			$dbsql->query($sql_update);	

		}
	    $dbsql->close();
	}
}

//=======Function for NEWS =============
//======================================
function add_news()
{
     global $_POST, $_SESSION, $_FILES, $cats_select_count,$cats_select,$message,
	 		$title, $content_desc, $content_detail, $imgname, $author, $nguontin, $link_nguontin, $msg, $timezone;

     /*$id_cat = array();
     $cat = isset($_POST["id_cat"]) ? $_POST["id_cat"] : '';
     if (is_array($cat)) $id_cat = $cat;
     else $id_cat[0] = $cat;

     $cats_select_count = 0;
     while (list($key,$value) = each($id_cat))
	 {
		if (!empty($value))
		{
			$cats_select[$cats_select_count] = $value;
			$cats_select_count++;
		}
     }*/

	//----Xu ly link_nguontin
	$link_news='';
	if (trim($link_nguontin)!='')
	{
		if (substr($link_nguontin,0,7)!='http://')
			$link_news = 'http://'.$link_nguontin;
		else
			$link_news = $link_nguontin;
	}
	
	//-- Kiem tra nhap lieu
    if (trim($title)=='') $msg = $msg."<br>- <b>Ph&#7847;n Ti&ecirc;u &#273;&#7873; tin t&#7913;c ch&#432;a c&oacute;!</b>";
	if (trim($content_desc)=='') $msg = $msg."<br>- <b>Tr&iacute;ch &#273;o&#7841;n n&#7897;i dung tin t&#7913;c ch&#432;a c&oacute;!</b>";
	//if (trim($content_detail)=='') $msg = $msg."<br>- <b>N&#7897;i dung tin chi ti&#7871;t  ch&#432;a c&oacute;!</b>";
	//if ($cats_select_count==0) $msg = $msg."<br>- <b>Chuy&ecirc;n m&#7909;c tin t&#7913;c ch&#432;a &#273;&#432;&#7907;c ch&#7885;n!</b>";
	//if (trim($author)=='') $msg = $msg."<br>- <b>T&aacute;c gi&#7843; ch&#432;a c&oacute;!</b>";
	if ($msg!='')
	{
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
	}
	
	//--- Kiem tra file image ----
	$filename ='';
     if ( !empty($imgname) )
	 {
		// GET THE TYPE OF IMAGE . EX: .GIF , .JPG ,....
		$start = strpos($imgname,".");
		$type  = substr($imgname,$start,strlen($imgname));
		if ( (strtolower($type)!=".gif")&&(strtolower($type)!=".jpg")){
			$msg = "<b>B&#7841;n ch&#7881; &#273;&#432;&#7907;c upload file h&igrave;nh c&oacute; d&#7841;ng .gif ho&#7863;c .jpg</b>";
			return false;
		}
        
		//---------------------------------------------- 		     
        $filename = $_SESSION["ses_username"].'_'.time().$type;
		if (is_uploaded_file($_FILES['imgfile']['tmp_name'])) {
			copy($_FILES['imgfile']['tmp_name'], "./news/news_images/".$filename);
			 //if ( !(copy($_FILES['imgfile']['tmp_name'], "./news/news_images/".$filename)) ) die("Cannot upload file.");
		} else {
			$msg = "Khong the upload Filename: " . $_FILES['imgfile']['name'];
			return;
		}       
     }

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //-----------------------------------------------------
     $timenow = time()+($timezone*3600);
	 $approve =0;	
	 $id_user = $_SESSION['ses_id_user'];
	 
     $sql_insert = "INSERT INTO news_posts(id_user,title,content_desc,content_detail,author,imgname,post_date,views,approve,nguontin,link_nguontin)
                               VALUES(".$id_user.",'".$title."','".$content_desc."','".$content_detail."','".$author."','".$filename."',".$timenow.",0,$approve,'$nguontin','$link_news')";
     $dbsql->query($sql_insert);

     //SELECT id_post
    /* $sql_select = "SELECT max(id_post) AS id_post FROM news_posts WHERE id_user=".$id_user;
     $sql_query = $dbsql->query($sql_select);
     $result = $dbsql->fetch_array($sql_query);
     $id_post = $result["id_post"];

     reset($id_cat);
     while (list($key,$value) = each($id_cat)){
            $sql_insert = "INSERT INTO news_catsposts(id_cat,id_post) VALUES($value,$id_post)";
            $dbsql->query($sql_insert);

            $sql_update = "UPDATE news_categories SET posts = posts + 1 WHERE id_cat=$value";
            $dbsql->query($sql_update);
     }*/

     //-----------------------------------------------------
     $dbsql->close();

     $msg = "G&#7903;i tin th&agrave;nh c&ocirc;ng!<br>Tuy nhi&ecirc;n, b&agrave;i vi&#7871;t c&#7911;a b&#7841;n s&#7869; &#273;&#432;&#7907;c s&#7917; d&#7909;ng sau khi ban ph&#7909; tr&aacute;ch tin t&#7913;c ki&#7875;m tra xong.";
	 if ($_SESSION["right_admin"]==1)
     	$page = "index.php?fod=ad&act=lst_news&exe=news&code=lst_news&app=0";
	 else
	 	$page = "index.php?fod=news&act=home&exe=news";
     page_transfer($msg,$page);
}

//==================================
function approve_news($approve)
{
	global $_POST;
	
	$number_news = isset($_POST["number_news"]) ? $_POST["number_news"] : 0;
	if ($number_news>0)
	{
		$dbsql = new db_mysql;
		$dbsql->connect();
		$dbsql->selectdb();
		
		if ($approve==1) $set_app = 0;
		else $set_app = 1;
		for($i=0;$i<$number_news;$i++)
		{
			$id_post 	= !empty($_POST["id_post_$i"]) ? $_POST["id_post_$i"] : 0;	
			if ($id_post!=0)
			{
			$sql_update = "UPDATE news_posts SET approve=".$set_app." WHERE id_post=$id_post";
			$dbsql->query($sql_update);	
			}
		}
	    $dbsql->close();
	}
}

//========================
function delete_news($id_post)
{
	global $app, $page;
			
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	//---delete news
	$sql_delete = "DELETE FROM news_posts WHERE id_post = $id_post";
	$dbsql->query($sql_delete);
	
	//---delete news in catagories
	$sql_select = "SELECT * FROM news_catsposts WHERE id_post = $id_post";
	$sql_query = $dbsql->query($sql_select);
	if ($dbsql->num_rows($sql_query)>0)
	{
		while ( $result = $dbsql->fetch_array($sql_query) )
		{
			$sql_update = "UPDATE news_categories SET posts = posts - 1 WHERE id_cat=".$result['id_cat'];
            $dbsql->query($sql_update);
		}
		
		$sql_delete = "DELETE FROM news_catsposts WHERE id_post = $id_post";
		$dbsql->query($sql_delete);
	}		
	
	$dbsql->close();

	$site = "index.php?fod=ad&act=lst_news&exe=news&code=lst_news&app=$app&page=$page";
	page_fast_transfer($site);
	return true;
}

//======================================
function edit_news($id_post)
{
     global $_POST, $_SESSION, $_FILES, $cats_select_count,$cats_select, 
	 		$title, $content_desc, $content_detail, $imgname, $author, $approve, $msg, $nguontin, $link_nguontin, $re_appear_home,
			$app, $page;

     /*$id_cat = array();
     $cat = isset($_POST["id_cat"]) ? $_POST["id_cat"] : '';
     if (is_array($cat)) $id_cat = $cat;
     else $id_cat[0] = $cat;

     $cats_select_count = 0;
     while (list($key,$value) = each($id_cat))
	 {
		if (!empty($value))
		{
			$cats_select[$cats_select_count] = $value;
			$cats_select_count++;
		}
     }*/

	//----Xu ly link_nguontin
	$link_news='';
	if (trim($link_nguontin)!='')
	{
		if (substr($link_nguontin,0,7)!='http://')
			$link_news = 'http://'.$link_nguontin;
		else
			$link_news = $link_nguontin;
	}
	
	//-- Kiem tra nhap lieu
    if (trim($title)=='') $msg = $msg."<br>- <b>Ph&#7847;n Ti&ecirc;u &#273;&#7873; tin t&#7913;c ch&#432;a c&oacute;!</b>";
	if (trim($content_desc)=='') $msg = $msg."<br>- <b>Tr&iacute;ch &#273;o&#7841;n n&#7897;i dung tin t&#7913;c ch&#432;a c&oacute;!</b>";
	//if (trim($content_detail)=='') $msg = $msg."<br>- <b>N&#7897;i dung tin chi ti&#7871;t  ch&#432;a c&oacute;!</b>";
	//if ($cats_select_count==0) $msg = $msg."<br>- <b>Chuy&ecirc;n m&#7909;c tin t&#7913;c ch&#432;a &#273;&#432;&#7907;c ch&#7885;n!</b>";
	//if (trim($author)=='') $msg = $msg."<br>- <b>T&aacute;c gi&#7843; ch&#432;a c&oacute;!</b>";
	if ($msg!='')
	{
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
	}
	
	//--- Kiem tra file image ----
	$filename ='';
     if ( !empty($imgname) )
	 {
		// GET THE TYPE OF IMAGE . EX: .GIF , .JPG ,....
		$start = strpos($imgname,".");
		$type  = substr($imgname,$start,strlen($imgname));
		if ( (strtolower($type)!=".gif")&&(strtolower($type)!=".jpg")){
			$msg = "<b>B&#7841;n ch&#7881; &#273;&#432;&#7907;c upload file h&igrave;nh c&oacute; d&#7841;ng .gif ho&#7863;c .jpg</b>";
			return false;
		}
        
		//---------------------------------------------- 		     
        $filename = $_SESSION["ses_username"].'_'.time().$type;
		if (is_uploaded_file($_FILES['imgfile']['tmp_name'])) {
			copy($_FILES['imgfile']['tmp_name'], "./news/news_images/".$filename);
			 //if ( !(copy($_FILES['imgfile']['tmp_name'], "./news/news_images/".$filename)) ) die("Cannot upload file.");
		} else {
			$msg = "Khong the upload duoc File: " . $_FILES['imgfile']['name'];
			return;
		}       
     }

	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	//--- select old_file_image
	$sql_select_img = "SELECT imgname FROM news_posts WHERE id_post = $id_post"; 
	$sql_query_img = $dbsql->query($sql_select_img);
	$result = $dbsql->fetch_array($sql_query_img);
	$old_imgname = isset($result['imgname']) ? $result['imgname'] : '';

	//-----Update data------------------------------------------------
	//$timenow = time(); 
	if (empty($re_appear_home)) $re_appear_home = 0;
	$sql_update = "UPDATE news_posts SET title='".$title."', content_desc='".$content_desc."', content_detail='".$content_detail."', author='".$author."', approve=".$approve.", nguontin='$nguontin', link_nguontin='$link_news', re_appear_home=$re_appear_home";
		if ($filename!='') $sql_update .= ", imgname='".$filename."' "; 
		$sql_update .=" WHERE id_post=$id_post";
	$dbsql->query($sql_update);	

	// delete file anh cu tren host
	if (($filename!='')&&($old_imgname!='')) unlink("./news/news_images/".$old_imgname);	
	
	//Delete news_catsposts
	/*$sql_del_select = "DELETE FROM news_catsposts WHERE id_post=".$id_post;
	$dbsql->query($sql_del_select);

	reset($id_cat);
	while (list($key,$value) = each($id_cat))
	{
		// add news_catsposts
		$sql_insert = "INSERT INTO news_catsposts(id_cat,id_post) VALUES($value,$id_post)";
		$dbsql->query($sql_insert);
	}*/

	$dbsql->close();
	
	$msg = "Ki&#7875;m duy&#7879;t tin th&agrave;nh c&ocirc;ng!";
	$page = "index.php?fod=ad&act=lst_news&exe=news&code=lst_news&app=$app&page=$page";
	page_transfer($msg,$page);
}

//=============================
function list_news($approve)
{
	global 	$posts_count, $posts, $code, $app, $subject, $total_rows,
			$page_start, $page_end, $page, $posts_per_page, $show_page;
			
	if ($approve==1) $subject = 'Danh s&aacute;ch tin t&#7913;c &#273;&atilde; &#273;&#432;&#7907;c duy&#7879;t';
	else $subject = 'Danh s&aacute;ch tin t&#7913;c ch&#432;a &#273;&#432;&#7907;c duy&#7879;t';
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
      //-----------------------------------------------------
      $sql_select = "SELECT P.*, U.first_name, U.last_name FROM news_posts AS P LEFT JOIN users AS U ON P.id_user = U.id_user WHERE P.approve=$approve ORDER BY P.post_date DESC ";
      $sql_query = $dbsql->query($sql_select);
      $rows = $dbsql->num_rows($sql_query);
	  $total_rows = $rows;
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
                      $posts["id_post"][$posts_count] = $result["id_post"];
                      $posts["title"][$posts_count] = "<a href='index.php?fod=ad&act=view_news&exe=news&code=view_news&id=".$result["id_post"]."&page=$page&app=$app'>".$result["title"]."</a>"; 
                      $posts["post_date"][$posts_count] = gmdate("d.m.Y",$result["post_date"]);
                      $posts["id_user"][$posts_count] = $result["id_user"];
						  $first_name = isset($result["first_name"]) ? $result["first_name"] :'';
						  $last_name  = isset($result["last_name"])  ? $result["last_name"]  :'';
                      $posts["realname"][$posts_count] = $first_name.' '.$last_name;
					  $posts["edit"][$posts_count] = "<a href='index.php?fod=ad&act=edit_news&exe=news&code=edit_news&id=".$result['id_post']."&app=$app&page=$page'><img src='./images/edit.gif' border=0></a>";
					  $posts["del"][$posts_count]  = "<a href='index.php?fod=ad&act=none&exe=news&code=del_news&id=".$result['id_post']."&app=$app&page=$page'><img src='./images/delete.gif' border=0></a>";
                      $posts_count++;
                 }
                 $i++;
                 if ($i>=$page_end) break;
           }
      }
      $dbsql->close();
}

//====================================
function get_news_info($id_post)
{
	global 	$code, $app, $id, $page,
			$cats_select_count, $cats_select,
			$title, $content_desc, $content_detail, $author, $v_img, $approve, $nguontin, $link_nguontin, $post_date, $re_appear_home;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_cats_select = "SELECT * FROM news_catsposts WHERE id_post = $id_post";
	$sql_cats_query = $dbsql->query($sql_cats_select);
	if ($dbsql->num_rows($sql_cats_query)>0)
	{
	   while ($result = $dbsql->fetch_array($sql_cats_query))
	   {
			 $cats_select[$cats_select_count] = $result["id_cat"];
			 $cats_select_count++;
	   }
	}
	
	$sql_news_select = "SELECT * FROM news_posts WHERE id_post=$id_post";
	$sql_news_query = $dbsql->query($sql_news_select);
		if ($dbsql->num_rows($sql_news_query)==0)
		{
		   $msg  = "Kh&ocirc;ng t&#7891;n t&#7841;i b&agrave;i vi&#7871;t n&agrave;y !";
		   $page = "index.php?fod=ad&act=lst_news&exe=news&code=lst_news&app=$app";
		   page_transfer($msg,$page);
		}
	$result = $dbsql->fetch_array($sql_news_query);
	$title 			= $result["title"];
	$content_desc 	= $result["content_desc"];
	$content_detail = isset($result["content_detail"]) ? ($result["content_detail"]) : '';
	$author 		= isset($result["author"]) ? $result["author"] :'';
	$approve 	 	= $result["approve"];
	$nguontin 	 	= isset($result["nguontin"]) ? $result["nguontin"] :'';
	$link_nguontin 	= isset($result["link_nguontin"]) ? $result["link_nguontin"] :'';
	$post_date 		= gmdate("d.m.Y",$result["post_date"]);
	$re_appear_home = isset($result["re_appear_home"]) ? $result["re_appear_home"] : null;
	$v_img = (!empty($result["imgname"])) ? "<img src='./news/news_images/".$result["imgname"]."' width='200'>" : "";

	$dbsql->close();
}

//========================================
function try_view_news($id_post)
{
	global 	$code, $app, $id, $page,
			$cats_select_count, $cats_select,
			$title, $content_desc, $content_detail, $author, $post_date, $nguontin, $link_nguontin,
			//-------------
			$v_title, $v_content_desc, $v_content_detail, $v_author, $v_img;
			
	$v_title			= $title;
	$v_content_desc		= str_replace("\n","<br>",$content_desc);
	$v_content_detail	= str_replace("\n","<br>",$content_detail);
	$v_author			= $author;		

	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_news_select = "SELECT * FROM news_posts WHERE id_post=$id_post";
	$sql_news_query = $dbsql->query($sql_news_select);
	$result = $dbsql->fetch_array($sql_news_query);
	$post_date = gmdate("d-m-Y, h:i a",$result["post_date"]);
	if ($v_img=='')
		$v_img = (!empty($result["imgname"])) ? "<img src='./news/news_images/".$result["imgname"]."' width='200'>" : '';
	else
		$v_img= "<img src='file:///".$v_img."' width='200'>";

	$dbsql->close();
}

//======================================
function check_option($id_cat){
      global $cats_select_count,$cats_select;

      if ($cats_select_count==0) return 0;

      for ($i=0;$i<$cats_select_count;$i++){
           if ($id_cat==$cats_select[$i]) return 1;
      }
      return 0;
}

?>