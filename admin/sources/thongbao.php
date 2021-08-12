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
	 case "add":
		add_thongbao();
		break;
		
	 case "list":
		list_thongbao();
		break;
		
	case "edit":
		get_inf_thongbao($id);
		break;
		
	case "editsm":
		edit_thongbao($id);
		break;
		
	case "del":
		delete_thongbao($id);
		break;
}


//=======Function for THONG BAO =============
//======================================
function add_thongbao()
{
	global $_POST,$_FILES, $thong_bao, $msg, $timezone;
	
	$thong_bao	= isset($_POST["thong_bao"])  ? ($_POST["thong_bao"])  : '';
	$file_name	= isset($_FILES['file_tb']['name'] ) ? $_FILES['file_tb']['name'] 	: '';

	//-- Kiem tra nhap lieu
    if (trim($thong_bao)=='') $msg = $msg."<br>- <b>Tr&iacute;ch d&#7851;n th&ocirc;ng b&aacute;o ch&#432;a nh&#7853;p!</b>";
	if (trim($file_name)=='') $msg = $msg."<br>- <b>File th&ocirc;ng b&aacute;o ch&#432;a ch&#7885;n!</b>";
	if ($msg!='')
	{
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
	}
	
	//--- Kiem tra file thong bao ----
	$file_thongbao ='';
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
        $file_thongbao = 'tb_'.time().$type;
		if (is_uploaded_file($_FILES['file_tb']['tmp_name'])) {
			copy($_FILES['file_tb']['tmp_name'], "./thongbao/file_tb/".$file_thongbao);
			 //if ( !(copy($_FILES['imgfile']['tmp_name'], "./news/news_images/".$filename)) ) die("Cannot upload file.");
		} else {
			$msg = "Khong the upload Filename: " . $_FILES['file_tb']['name'];
			return;
		}       
     }

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //-----------------------------------------------------
     $timenow = time()+($timezone*3600);
	 $id_user = $_SESSION['ses_id_user'];
	 
     $sql_insert = "INSERT INTO thongbao(id_user, ngay_tb, thong_bao, file_thongbao)
                               VALUES(".$id_user.", ".$timenow.", '".$thong_bao."', '".$file_thongbao."')";
     $dbsql->query($sql_insert);

     //-----------------------------------------------------
     $dbsql->close();

     $msg = "G&#7917;i th&ocirc;ng b&aacute;o th&agrave;nh c&ocirc;ng!";
	 $site = "index.php?fod=ad&act=lst_tb&exe=tb&code=list";
     page_transfer($msg,$site);
}


//=============================
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
                       else $show_page .= " <a href='index.php?fod=ad&act=lst_tb&exe=tb&code=list&page=".$i."'>[$i]</a>";
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
					  $thongbao["edit"][$thongbao_count] 	= "<a href='index.php?fod=ad&act=edit_tb&exe=tb&code=edit&id=".$result["id_thongbao"]."&page=$page'><img src='./images/edit_post_icon.gif' title='Thay &#273;&#7893;i' border=0></a>"; 
					  $thongbao["del"][$thongbao_count] 	= "<a href='index.php?fod=ad&act=lst_tb&exe=tb&code=del&id=".$result["id_thongbao"]."&page=$page'><img src='./images/delete_icon.gif' title='X&oacute;a b&#7887;' border=0></a>"; 
                      $thongbao_count++;
                 }
                 $i++;
                 if ($i>=$page_end) break;
           }
      }
      $dbsql->close();
}

//====================================
function get_inf_thongbao($id_thongbao)
{
	global 	$thong_bao;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	//-----------------------------------------------------
	$sql_news_select = "SELECT * FROM thongbao WHERE id_thongbao=$id_thongbao";
	$sql_news_query = $dbsql->query($sql_news_select);
	$result = $dbsql->fetch_array($sql_news_query);
	$thong_bao 	= $result["thong_bao"];
	$dbsql->close();
}

//======================================
function edit_thongbao($id_thongbao)
{
	global $_POST,$_FILES, $thong_bao, $msg, $timezone, $page;

	$thong_bao	= isset($_POST["thong_bao"])  ? ($_POST["thong_bao"])  : '';
	$file_name	= isset($_FILES['file_tb']['name'] ) ? $_FILES['file_tb']['name'] 	: '';

	//-- Kiem tra nhap lieu
    if (trim($thong_bao)=='') $msg = $msg."<br>- <b>Tr&iacute;ch d&#7851;n th&ocirc;ng b&aacute;o ch&#432;a nh&#7853;p!</b>";
	if ($msg!='')
	{
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
	}	
	
	//--- Kiem tra file thong bao ----
	$file_thongbao ='';
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
        $file_thongbao = 'tb_'.time().$type;
		if (is_uploaded_file($_FILES['file_tb']['tmp_name'])) {
			copy($_FILES['file_tb']['tmp_name'], "./thongbao/file_tb/".$file_thongbao);
			 //if ( !(copy($_FILES['imgfile']['tmp_name'], "./news/news_images/".$filename)) ) die("Cannot upload file.");
		} else {
			$msg = "Khong the upload Filename: " . $_FILES['file_tb']['name'];
			return;
		}       
     }

	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	//--- select old_file_image
	$sql_select_img = "SELECT * FROM thongbao WHERE id_thongbao = $id_thongbao"; 
	$sql_query_img = $dbsql->query($sql_select_img);
	$result = $dbsql->fetch_array($sql_query_img);
	$old_file_name = isset($result['file_thongbao']) ? $result['file_thongbao'] : '';

	//-----Update data------------------------------------------------
	$timenow = time()+($timezone*3600);
	$id_user = $_SESSION['ses_id_user'];
	
	$timenow = time(); 
	$sql_update = "UPDATE thongbao SET id_user='".$id_user."', ngay_tb='".$timenow."', thong_bao='".$thong_bao."'";
		if ($file_thongbao!='') $sql_update .= ", file_thongbao='".$file_thongbao."' "; 
		$sql_update .=" WHERE id_thongbao=$id_thongbao";
	$dbsql->query($sql_update);	

	// delete file thong bao cu tren host
	if (($file_thongbao!='')&&($old_file_name!='')) unlink("./thongbao/file_tb/".$old_file_name);	

	$dbsql->close();
	
	$msg = "Thay &#273;&#7893;i th&ocirc;ng b&aacute;o th&agrave;nh c&ocirc;ng!";
	$page = "index.php?fod=ad&act=lst_tb&exe=tb&code=list&page=$page";
	page_transfer($msg,$page);
}

//========================
function delete_thongbao($id_thongbao)
{
	global $page;
			
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	//--- select file_image
	$sql_select_img = "SELECT * FROM thongbao WHERE id_thongbao = $id_thongbao"; 
	$sql_query_img = $dbsql->query($sql_select_img);
	$result = $dbsql->fetch_array($sql_query_img);
	$file_name = isset($result['file_thongbao']) ? $result['file_thongbao'] : '';
	
	//---delete news
	$sql_delete = "DELETE FROM thongbao WHERE id_thongbao = $id_thongbao";
	$dbsql->query($sql_delete);

	$dbsql->close();

	unlink("./thongbao/file_tb/".$file_name);	
	$site = "index.php?fod=ad&act=lst_tb&exe=tb&code=list&page=$page";
	page_fast_transfer($site);
	return true;
}
?>