<?php
$act   	= isset($_GET["act"])  ? $_GET["act"] 	: 'idx';
$code   = isset($_GET["code"]) ? $_GET["code"] 	: '';
$id   	= isset($_GET["id"])   ? $_GET["id"]  	: 0; //id_hoatdong

$page_start = ($page-1)*$posts_per_page;
$page_end   = $page*$posts_per_page;
$show_page = "";
$msg		= isset($msg) ? $msg : '';


switch ($code){
	 case "add":
		add_hoatdong();
		break;
		
	 case "list":
		list_hoatdong();
		break;
		
	case "edit":
		get_inf_hoatdong($id);
		break;
		
	case "editsm":
		edit_hoatdong($id);
		break;
		
	case "del":
		delete_hoatdong($id);
		break;
		
	case "img_up":
		upload_image_hoatdong();
		break;
}


//=======Function for THONG BAO =============
//======================================
function add_hoatdong()
{
	global $_POST,$_FILES, $hoatdong, $msg, $timezone;
	
	$hoatdong	= isset($_POST["hoatdong"])  ? ($_POST["hoatdong"])  : '';
	$file_name	= isset($_FILES['file_hd']['name'] ) ? $_FILES['file_hd']['name'] 	: '';

	//-- Kiem tra nhap lieu
    if (trim($hoatdong)=='') $msg = $msg."<br>- <b>Tr&iacute;ch d&#7851;n ch&#432;a nh&#7853;p!</b>";
	if (trim($file_name)=='') $msg = $msg."<br>- <b>File h&#7885;c b&#7893;ng ch&#432;a ch&#7885;n!</b>";
	if ($msg!='')
	{
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
	}
	
	//--- Kiem tra file thong bao ----
	$file_hoatdong ='';
     if ( !empty($file_name) )
	 {
		// GET THE TYPE OF FILE: .RTF , .DOC ,....
		$start = strpos($file_name,".");
		$type  = substr($file_name,$start,strlen($file_name));
		if ( (strtolower($type)!=".htm")&&(strtolower($type)!=".html"))
		{
			$msg = "<b>B&#7841;n ch&#7881; &#273;&#432;&#7907;c upload file h&igrave;nh c&oacute; d&#7841;ng .htm ho&#7863;c .html</b>";
			return false;
		}

		//---------------------------------------------- 		     
        $file_hoatdong = 'hd_'.time().$type;
		if (is_uploaded_file($_FILES['file_hd']['tmp_name'])) {
			copy($_FILES['file_hd']['tmp_name'], "./anhhoatdong/file_hd/".$file_hoatdong);
		} else {
			$msg = "Khong the upload Filename: " . $_FILES['file_hd']['name'];
			return;
		}       
     }

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //-----------------------------------------------------
     $timenow = time()+($timezone*3600);
	 $id_user = $_SESSION['ses_id_user'];
	 
     $sql_insert = "INSERT INTO hoatdong(id_user, ngay_hd, hoatdong, file_hoatdong)
                               VALUES(".$id_user.", ".$timenow.", '".$hoatdong."', '".$file_hoatdong."')";
     $dbsql->query($sql_insert);

     //-----------------------------------------------------
     $dbsql->close();

     $msg = "G&#7917;i &#7843;nh ho&#7841;t &#273;&#7897;ng th&agrave;nh c&ocirc;ng!";
	 $site = "index.php?fod=ad&act=lst_hd&exe=hd&code=list";
     page_transfer($msg,$site);
}


//=============================
function list_hoatdong()
{
	global 	$hoatdong_count, $hoatdong,
			$page_start, $page_end, $page, $posts_per_page, $show_page;
			
	$hoatdong_count = 0;
	$hoatdong = array();
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
      //-----------------------------------------------------
      $sql_select = "SELECT * FROM hoatdong ORDER BY ngay_hd DESC ";
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
                       else $show_page .= " <a href='index.php?fod=ad&act=lst_hd&exe=hd&code=list&page=".$i."'>[$i]</a>";
                 }
           }

           $i=0;
           while ($result = $dbsql->fetch_array($sql_query))
           {
                 if ($i>=$page_start)
                 {
                      $hoatdong["id_hoatdong"][$hoatdong_count] = $result["id_hoatdong"];
					  $hoatdong["ngay_hd"][$hoatdong_count] 	= gmdate("d-m-Y",$result["ngay_hd"]).'<br>'.gmdate("h:i a",$result["ngay_hd"]);
                      $hoatdong["hoatdong"][$hoatdong_count] 	= "<a href='./anhhoatdong/index.php?act=view&code=view&id=".$result["id_hoatdong"]."'>".$result["hoatdong"]."</a>";
					  $hoatdong["edit"][$hoatdong_count] 	= "<a href='index.php?fod=ad&act=edit_hd&exe=hd&code=edit&id=".$result["id_hoatdong"]."&page=$page'><img src='./images/edit_post_icon.gif' title='Thay &#273;&#7893;i' border=0></a>"; 
					  $hoatdong["del"][$hoatdong_count] 	= "<a href='index.php?fod=ad&act=lst_hd&exe=hd&code=del&id=".$result["id_hoatdong"]."&page=$page'><img src='./images/delete_icon.gif' title='X&oacute;a b&#7887;' border=0></a>"; 
                      $hoatdong_count++;
                 }
                 $i++;
                 if ($i>=$page_end) break;
           }
      }
      $dbsql->close();
}

//====================================
function get_inf_hoatdong($id_hoatdong)
{
	global 	$hoatdong;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_news_select = "SELECT * FROM hoatdong WHERE id_hoatdong=$id_hoatdong";
	$sql_news_query = $dbsql->query($sql_news_select);
	$result = $dbsql->fetch_array($sql_news_query);
	$hoatdong 	= $result["hoatdong"];
	$dbsql->close();
}

//======================================
function edit_hoatdong($id_hoatdong)
{
	global $_POST,$_FILES, $hoatdong, $msg, $timezone, $page;

	$hoatdong	= isset($_POST["hoatdong"])  ? ($_POST["hoatdong"])  : '';
	$file_name	= isset($_FILES['file_hd']['name'] ) ? $_FILES['file_hd']['name'] 	: '';

	//-- Kiem tra nhap lieu
    if (trim($hoatdong)=='') $msg = $msg."<br>- <b>Tr&iacute;ch d&#7851;n th&ocirc;ng b&aacute;o ch&#432;a nh&#7853;p!</b>";
	if ($msg!='')
	{
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
	}	
	
	//--- Kiem tra file thong bao ----
	$file_hoatdong ='';
     if ( !empty($file_name) )
	 {
		// GET THE TYPE OF FILE: .RTF , .DOC ,....
		$start = strpos($file_name,".");
		$type  = substr($file_name,$start,strlen($file_name));
		if ( (strtolower($type)!=".htm")&&(strtolower($type)!=".html")){
			$msg = "<b>B&#7841;n ch&#7881; &#273;&#432;&#7907;c upload file h&igrave;nh c&oacute; d&#7841;ng .htm ho&#7863;c .html</b>";
			return false;
		}

		//---------------------------------------------- 		     
        $file_hoatdong = 'hd_'.time().$type;
		if (is_uploaded_file($_FILES['file_hd']['tmp_name'])) {
			copy($_FILES['file_hd']['tmp_name'], "./anhhoatdong/file_hd/".$file_hoatdong);
			 //if ( !(copy($_FILES['imgfile']['tmp_name'], "./news/news_images/".$filename)) ) die("Cannot upload file.");
		} else {
			$msg = "Khong the upload Filename: " . $_FILES['file_hd']['name'];
			return;
		}       
     }

	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	//--- select old_file_image
	$sql_select_img = "SELECT * FROM hoatdong WHERE id_hoatdong = $id_hoatdong"; 
	$sql_query_img = $dbsql->query($sql_select_img);
	$result = $dbsql->fetch_array($sql_query_img);
	$old_file_name = isset($result['file_hoatdong']) ? $result['file_hoatdong'] : '';

	//-----Update data------------------------------------------------
	$timenow = time()+($timezone*3600);
	$id_user = $_SESSION['ses_id_user'];
	
	$timenow = time(); 
	$sql_update = "UPDATE hoatdong SET id_user='".$id_user."', ngay_hd='".$timenow."', hoatdong='".$hoatdong."'";
		if ($file_hoatdong!='') $sql_update .= ", file_hoatdong='".$file_hoatdong."' "; 
		$sql_update .=" WHERE id_hoatdong=$id_hoatdong";
	$dbsql->query($sql_update);	

	// delete file thong bao cu tren host
	if (($file_hoatdong!='')&&($old_file_name!='')) unlink("./anhhoatdong/file_hd/".$old_file_name);	

	$dbsql->close();
	
	$msg = "Thay &#273;&#7893;i &#7843;nh ho&#7841;t &#273;&#7897;ng th&agrave;nh c&ocirc;ng!";
	$page = "index.php?fod=ad&act=lst_hd&exe=hd&code=list&page=$page";
	page_transfer($msg,$page);
}

//========================
function delete_hoatdong($id_hoatdong)
{
	global $page;
			
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	//--- select old_file_image
	$sql_select_img = "SELECT * FROM hoatdong WHERE id_hoatdong = $id_hoatdong"; 
	$sql_query_img = $dbsql->query($sql_select_img);
	$result = $dbsql->fetch_array($sql_query_img);
	$file_name = isset($result['file_hoatdong']) ? $result['file_hoatdong'] : '';
	
	//---delete news
	$sql_delete = "DELETE FROM hoatdong WHERE id_hoatdong = $id_hoatdong";
	$dbsql->query($sql_delete);
	
	unlink("./anhhoatdong/file_hd/".$file_name);
	$dbsql->close();

	$site = "index.php?fod=ad&act=lst_hd&exe=hd&code=list&page=$page";
	page_fast_transfer($site);
	return true;
}

//===================================
function upload_image_hoatdong()
{
	global $_FILES, $msg;
	
	for($i=1;$i<=5;$i++)
	{
		$file_name	= isset($_FILES["file$i"]["name"] ) ? $_FILES["file$i"]["name"] : '';
		
		//--- Kiem tra file upload ----
		$checkfile = true;
		 if ( !empty($file_name) )
		 {
			// GET THE TYPE OF FILE: .GIF , .JPG ,....
			$start = strpos($file_name,".");
			$type  = substr($file_name,$start,strlen($file_name));
			if ( (strtolower($type)!=".gif")&&(strtolower($type)!=".jpg")){
				$msg = $msg. "<br><b>-File$i: $file_name kh&ocirc;ng ph&#7843;i &#273;&#7883;nh d&#7841;ng .jpg ho&#7863;c .gif</b>";
				$checkfile = false;
			}
	
			//---------------------------------------------- 	
			if ($checkfile==true)
			{  
				if (is_uploaded_file($_FILES["file$i"]["tmp_name"]))
				{
					copy($_FILES["file$i"]["tmp_name"], "./anhhoatdong/file_hd/img_upload/".$file_name);
				}
				else 
				{
					$msg = $msg. "<br><b>-File$i: $file_name khong the upload!";
					$checkfile = false;
				}   
			}
			if ($checkfile==true)
		 		$msg = $msg. "<br><b>-File$i: $file_name upload th&agrave;nh c&ocirc;ng.";    
		 }
	}
}
?>