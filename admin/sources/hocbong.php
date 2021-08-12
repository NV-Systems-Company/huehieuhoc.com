<?php
$act   	= isset($_GET["act"])  ? $_GET["act"] 	: 'idx';
$code   = isset($_GET["code"]) ? $_GET["code"] 	: '';
$id   	= isset($_GET["id"])   ? $_GET["id"]  	: 0; //id_hocbong

$page_start = ($page-1)*$posts_per_page;
$page_end   = $page*$posts_per_page;
$show_page = "";
$msg		= isset($msg) ? $msg : '';


switch ($code){
	 case "add":
		add_hocbong();
		break;
		
	 case "list":
		list_hocbong();
		break;
		
	case "edit":
		get_inf_hocbong($id);
		break;
		
	case "editsm":
		edit_hocbong($id);
		break;
		
	case "del":
		delete_hocbong($id);
		break;
}


//=======Function for THONG BAO =============
//======================================
function add_hocbong()
{
	global $_POST,$_FILES, $hocbong, $msg, $timezone;
	
	$hocbong	= isset($_POST["hocbong"])  ? ($_POST["hocbong"])  : '';
	$file_name	= isset($_FILES['file_hb']['name'] ) ? $_FILES['file_hb']['name'] 	: '';

	//-- Kiem tra nhap lieu
    if (trim($hocbong)=='') $msg = $msg."<br>- <b>Tr&iacute;ch d&#7851;n ch&#432;a nh&#7853;p!</b>";
	if (trim($file_name)=='') $msg = $msg."<br>- <b>File h&#7885;c b&#7893;ng ch&#432;a ch&#7885;n!</b>";
	if ($msg!='')
	{
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
	}
	
	//--- Kiem tra file thong bao ----
	$file_hocbong ='';
     if ( !empty($file_name) )
	 {
		// GET THE TYPE OF FILE: .RTF , .DOC ,....
		$start = strpos($file_name,".");
		$type  = substr($file_name,$start,strlen($file_name));
		/*if ( (strtolower($type)!=".rtf")&&(strtolower($type)!=".doc"))
		{
			$msg = "<b>B&#7841;n ch&#7881; &#273;&#432;&#7907;c upload file h&igrave;nh c&oacute; d&#7841;ng .rtf ho&#7863;c .doc</b>";
			return false;
		}*/

		//---------------------------------------------- 		     
        $file_hocbong = 'hb_'.time().$type;
		if (is_uploaded_file($_FILES['file_hb']['tmp_name'])) {
			copy($_FILES['file_hb']['tmp_name'], "./hocbong/file_hb/".$file_hocbong);
			 //if ( !(copy($_FILES['imgfile']['tmp_name'], "./news/news_images/".$filename)) ) die("Cannot upload file.");
		} else {
			$msg = "Khong the upload Filename: " . $_FILES['file_hb']['name'];
			return;
		}       
     }

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //-----------------------------------------------------
     $timenow = time()+($timezone*3600);
	 $id_user = $_SESSION['ses_id_user'];
	 
     $sql_insert = "INSERT INTO hocbong(id_user, ngay_hb, hocbong, file_hocbong)
                               VALUES(".$id_user.", ".$timenow.", '".$hocbong."', '".$file_hocbong."')";
     $dbsql->query($sql_insert);

     //-----------------------------------------------------
     $dbsql->close();

     $msg = "G&#7917;i danh s&aacute;ch th&agrave;nh c&ocirc;ng!";
	 $site = "index.php?fod=ad&act=lst_hb&exe=hb&code=list";
     page_transfer($msg,$site);
}


//=============================
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
                       else $show_page .= " <a href='index.php?fod=ad&act=lst_hb&exe=hb&code=list&page=".$i."'>[$i]</a>";
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
					  $hocbong["edit"][$hocbong_count] 	= "<a href='index.php?fod=ad&act=edit_hb&exe=hb&code=edit&id=".$result["id_hocbong"]."&page=$page'><img src='./images/edit_post_icon.gif' title='Thay &#273;&#7893;i' border=0></a>"; 
					  $hocbong["del"][$hocbong_count] 	= "<a href='index.php?fod=ad&act=lst_hb&exe=hb&code=del&id=".$result["id_hocbong"]."&page=$page'><img src='./images/delete_icon.gif' title='X&oacute;a b&#7887;' border=0></a>"; 
                      $hocbong_count++;
                 }
                 $i++;
                 if ($i>=$page_end) break;
           }
      }
      $dbsql->close();
}

//====================================
function get_inf_hocbong($id_hocbong)
{
	global 	$hocbong;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_news_select = "SELECT * FROM hocbong WHERE id_hocbong=$id_hocbong";
	$sql_news_query = $dbsql->query($sql_news_select);
	$result = $dbsql->fetch_array($sql_news_query);
	$hocbong 	= $result["hocbong"];
	$dbsql->close();
}

//======================================
function edit_hocbong($id_hocbong)
{
	global $_POST,$_FILES, $hocbong, $msg, $timezone, $page;

	$hocbong	= isset($_POST["hocbong"])  ? ($_POST["hocbong"])  : '';
	$file_name	= isset($_FILES['file_hb']['name'] ) ? $_FILES['file_hb']['name'] 	: '';

	//-- Kiem tra nhap lieu
    if (trim($hocbong)=='') $msg = $msg."<br>- <b>Tr&iacute;ch d&#7851;n th&ocirc;ng b&aacute;o ch&#432;a nh&#7853;p!</b>";
	if ($msg!='')
	{
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
	}	
	
	//--- Kiem tra file thong bao ----
	$file_hocbong ='';
     if ( !empty($file_name) )
	 {
		// GET THE TYPE OF FILE: .RTF , .DOC ,....
		$start = strpos($file_name,".");
		$type  = substr($file_name,$start,strlen($file_name));
		/*if ( (strtolower($type)!=".rtf")&&(strtolower($type)!=".doc")){
			$msg = "<b>B&#7841;n ch&#7881; &#273;&#432;&#7907;c upload file h&igrave;nh c&oacute; d&#7841;ng .rtf ho&#7863;c .doc</b>";
			return false;
		}*/

		//---------------------------------------------- 		     
        $file_hocbong = 'hb_'.time().$type;
		if (is_uploaded_file($_FILES['file_hb']['tmp_name'])) {
			copy($_FILES['file_hb']['tmp_name'], "./hocbong/file_hb/".$file_hocbong);
			 //if ( !(copy($_FILES['imgfile']['tmp_name'], "./news/news_images/".$filename)) ) die("Cannot upload file.");
		} else {
			$msg = "Khong the upload Filename: " . $_FILES['file_hb']['name'];
			return;
		}       
     }

	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	//--- select old_file_image
	$sql_select_img = "SELECT * FROM hocbong WHERE id_hocbong = $id_hocbong"; 
	$sql_query_img = $dbsql->query($sql_select_img);
	$result = $dbsql->fetch_array($sql_query_img);
	$old_file_name = isset($result['file_hocbong']) ? $result['file_hocbong'] : '';

	//-----Update data------------------------------------------------
	$timenow = time()+($timezone*3600);
	$id_user = $_SESSION['ses_id_user'];
	
	$timenow = time(); 
	$sql_update = "UPDATE hocbong SET id_user='".$id_user."', ngay_hb='".$timenow."', hocbong='".$hocbong."'";
		if ($file_hocbong!='') $sql_update .= ", file_hocbong='".$file_hocbong."' "; 
		$sql_update .=" WHERE id_hocbong=$id_hocbong";
	$dbsql->query($sql_update);	

	// delete file thong bao cu tren host
	if (($file_hocbong!='')&&($old_file_name!='')) unlink("./hocbong/file_hb/".$old_file_name);	

	$dbsql->close();
	
	$msg = "Thay &#273;&#7893;i danh s&aacute;ch h&#7885;c b&#7893;ng th&agrave;nh c&ocirc;ng!";
	$page = "index.php?fod=ad&act=lst_hb&exe=hb&code=list&page=$page";
	page_transfer($msg,$page);
}

//========================
function delete_hocbong($id_hocbong)
{
	global $page;
			
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	//--- select old_file_image
	$sql_select_img = "SELECT * FROM hocbong WHERE id_hocbong = $id_hocbong"; 
	$sql_query_img = $dbsql->query($sql_select_img);
	$result = $dbsql->fetch_array($sql_query_img);
	$file_name = isset($result['file_hocbong']) ? $result['file_hocbong'] : '';
	
	//---delete news
	$sql_delete = "DELETE FROM hocbong WHERE id_hocbong = $id_hocbong";
	$dbsql->query($sql_delete);
	
	unlink("./hocbong/file_hb/".$file_name);
	$dbsql->close();

	$site = "index.php?fod=ad&act=lst_hb&exe=hb&code=list&page=$page";
	page_fast_transfer($site);
	return true;
}
?>