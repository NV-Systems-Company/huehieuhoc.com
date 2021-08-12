<?php
$act    = isset($_GET["act"])  	? $_GET["act"]   : 'idx';
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';
$record_start = ($page-1)*$ungho_per_page;
$record_end   = $page*$ungho_per_page;
$show_page = "";

$msg    		= isset($msg)  	? $msg   : '';
$keyword 		= isset($_POST["keyword"]) 		? $_POST["keyword"]: '';
					if ($keyword =='') $keyword  = isset($_GET["key"])? $_GET["key"]: '';
$id_ungho 		= isset($_POST["id_ungho"]) ? $_POST["id_ungho"]: -1;
					if ($id_ungho==-1) $id_ungho = isset($_GET["id"])? $_GET["id"]: -1;
$canhan_donvi 	= isset($_POST["canhan_donvi"]) ? $_POST["canhan_donvi"]: -1;
					if ($canhan_donvi==-1) $canhan_donvi = isset($_GET["dt"])? $_GET["dt"]: -1;
$ngay 			= isset($_POST["ngay"]) 		? $_POST["ngay"] 		: '';
$nguoiungho		= isset($_POST["nguoiungho"]) 	? $_POST["nguoiungho"] 	: '';
$address		= isset($_POST["address"]) 		? $_POST["address"] 	: '';
$website		= isset($_POST["website"]) 		? $_POST["website"] 	: '';
$email			= isset($_POST["email"]) 		? $_POST["email"] 		: '';
$tel			= isset($_POST["tel"]) 			? $_POST["tel"] 		: '';
$fax			= isset($_POST["fax"]) 			? $_POST["fax"] 		: '';
$yim			= isset($_POST["yim"]) 			? $_POST["yim"] 		: '';
$ungho			= isset($_POST["ungho"]) 		? $_POST["ungho"] 		: '';
$link_news		= isset($_POST["link_news"]) 	? $_POST["link_news"]	: '';

switch ($code)
{
	case "list":
		$ds_ungho_count = 0;
		$ds_ungho = array();
		list_ungho();
		break;
		
	case "addsm":
		if (addsm_ungho())
		{
			$msg = "Th&ecirc;m v&agrave;o danh s&aacute;ch th&agrave;nh c&ocirc;ng!";
			$site = "index.php?fod=ad&act=lst_uh&exe=uh&code=list";
			page_transfer($msg,$site);
		}
		break;
		
	case "edit":
		view_item_ungho();
		break;
		
	case "editsm":
		if (edit_item_ungho())
		{
			$msg = "Ch&#7881;nh s&#7917;a th&agrave;nh c&ocirc;ng!";
			$site = "index.php?fod=ad&act=lst_uh&exe=uh&code=list";
			page_transfer($msg,$site);
		}
		break;	
		
	case "del":
		$id_ungho = isset($_GET["id"]) ? $_GET["id"] : -1;
		if (delete_ungho())
		{
			$msg = "X&oacute;a th&agrave;nh c&ocirc;ng!";
			$site = "index.php?fod=ad&act=lst_uh&exe=uh&code=list";
			page_transfer($msg,$site);
		}
		break;
}

function list_ungho()
{
	global $ds_ungho_count,$ds_ungho,$keyword, $canhan_donvi, $record_start,$record_end,$show_page,$ungho_per_page,$page;

	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT * FROM ds_ungho ";
	if (($canhan_donvi!=-1)||($keyword!='')) $sql_select .= "WHERE id_ungho<>-1 ";
	if ($canhan_donvi!=-1) $sql_select .= "AND canhan_donvi=$canhan_donvi ";
	if ($keyword!='') $sql_select .= "AND (nguoiungho LIKE '%".$keyword."%') ";	
	$sql_select .= "ORDER BY ngay DESC";
	$sql_query = $dbsql->query($sql_select);
	$rows = $dbsql->num_rows($sql_query);
	if ($rows>0)
	{
	   $num_page = ceil($rows/$ungho_per_page);
	   if ($num_page>1)
	   {
			 $show_page = "Trang:";
			 for ($i=1;$i<$num_page+1;$i++)
			 {
				   if ($i==$page) $show_page .= " [$i]";
				   else $show_page .= " <a href='index.php?fod=ad&act=lst_uh&exe=uh&code=list&dt=".$canhan_donvi."&key=".$keyword."&page=".$i."'>[$i]</a>";
			 }
	   }
	
	   mysql_data_seek($sql_query, $record_start);
	   while (($result = $dbsql->fetch_array($sql_query))&&(($ds_ungho_count+$record_start)<$record_end))
	   {
			$ds_ungho["id_ungho"][$ds_ungho_count] 		= $result["id_ungho"];
			$ds_ungho["canhan_donvi"][$ds_ungho_count] 	= $result["canhan_donvi"];
			$ds_ungho["ngay"][$ds_ungho_count] 			= cv_date_vietnam($result["ngay"]);
			//$ds_ungho["nguoiungho"][$ds_ungho_count] 	= $result["nguoiungho"];
			$ds_ungho["nguoiungho"][$ds_ungho_count] 	= str_replace("\n","<br>",$result["nguoiungho"]);
			$ds_ungho["ungho"][$ds_ungho_count] 		= str_replace("\n","<br>",$result["ungho"]);	
			$ds_ungho_count++;
	   }
	}
}

function addsm_ungho()
{
	global  $_POST, $msg, $canhan_donvi, $ngay, $nguoiungho,
			$address, $website, $email, $tel, $fax, $yim, 
			$ungho, $link_news;
	
	if ($canhan_donvi==-1||trim($ngay)==''||trim($nguoiungho)==''||trim($address)==''||trim($ungho)=='')
	{	
		if ($canhan_donvi==-1) $msg = "- <b>&#272;&#7889;i t&#432;&#7907;ng &#7911;ng h&#7897; ch&#432;a ch&#7885;n.</b>";
		if (trim($ngay)=='') $msg = $msg."<br>- <b>Ng&agrave;y &#7911;ng h&#7897; ch&#432;a c&oacute;.</b>";
		if (trim($nguoiungho)=='') $msg = $msg."<br>- <b>T&ecirc;n &#273;&#417;n v&#7883; c&aacute; nh&acirc;n &#7911;ng h&#7897; ch&#432;a c&oacute;.</b>";
		if (trim($address)=='') $msg = $msg."<br>- <b>&#272;&#7883;a ch&#7881; ch&#432;a c&oacute;.</b>";
		if (trim($ungho)=='') $msg = $msg."<br>- <b>&#7910;ng h&#7897; ch&#432;a c&oacute;.</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
    }
	//Kiem tra ngay thang
	$ngay = str_replace("/","-",$ngay);
	if (!check_date_vietnam($ngay))
	{
	   $msg = $msg."- <b>Ng&agrave;y th&aacute;ng &#7911;ng h&#7897; ch&#432;a &#273;&uacute;ng.</b>";
	   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
	   $msg = $msg.'<br>';
       return false;
	}
	$ngay = cv_date_sql($ngay);

	//---Add so lieu vao database
   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_insert = "INSERT INTO ds_ungho (nguoiungho,canhan_donvi,address,website,email,tel,fax,yim,ungho,ngay,link_news) 
				 VALUES('".$nguoiungho."','".$canhan_donvi."','".$address."','".$website."','".$email."','".$tel."','".$fax."','".$yim."','".$ungho."','".$ngay."','".$link_news."')";
	$dbsql->query($sql_insert);	

    $dbsql->close();
	return true;
}

function view_item_ungho()
{
	global $msg, $id_ungho, $canhan_donvi, $ngay, $nguoiungho,
	$address, $website, $email, $tel, $fax, $yim, $ungho, $link_news;

	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT * FROM ds_ungho WHERE id_ungho = $id_ungho";
	$dbsql->query($sql_select);	
	if ($dbsql->num_rows()==0){
          $msg = "Kh&ocirc;ng t&#7891;n t&#7841;i th&ocirc;ng tin &#7911;ng h&#7897; n&agrave;y.";
          return false;
     }
    $result = $dbsql->fetch_array();
	$id_ungho 		= $result["id_ungho"];
	$canhan_donvi 	= $result["canhan_donvi"];
	$ngay 			= cv_date_vietnam($result["ngay"]);
	$nguoiungho		= $result["nguoiungho"];
	$address		= $result["address"];
	$website		= $result["website"];
	$email			= $result["email"];
	$tel			= $result["tel"];
	$fax			= $result["fax"];
	$yim			= $result["yim"];
	$ungho			= $result["ungho"];	
	$link_news		= $result["link_news"];
	$dbsql->close();
}

function edit_item_ungho()
{
	global  $msg, $id_ungho, $canhan_donvi, $ngay, $nguoiungho,
			$address, $website, $email, $tel, $fax, $yim, 
			$ungho, $link_news;
	
	if ($canhan_donvi==-1||trim($ngay)==''||trim($nguoiungho)==''||trim($address)==''||trim($ungho)=='')
	{	
		if ($canhan_donvi==-1) $msg = "- <b>&#272;&#7889;i t&#432;&#7907;ng &#7911;ng h&#7897; ch&#432;a ch&#7885;n.</b>";
		if (trim($ngay)=='') $msg = $msg."<br>- <b>Ng&agrave;y &#7911;ng h&#7897; ch&#432;a c&oacute;.</b>";
		if (trim($nguoiungho)=='') $msg = $msg."<br>- <b>T&ecirc;n &#273;&#417;n v&#7883; c&aacute; nh&acirc;n &#7911;ng h&#7897; ch&#432;a c&oacute;.</b>";
		if (trim($address)=='') $msg = $msg."<br>- <b>&#272;&#7883;a ch&#7881; ch&#432;a c&oacute;.</b>";
		if (trim($ungho)=='') $msg = $msg."<br>- <b>&#7910;ng h&#7897; ch&#432;a c&oacute;.</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
    }
	//Kiem tra ngay thang
	$ngay = str_replace("/","-",$ngay);
	if (!check_date_vietnam($ngay))
	{
	   $msg = $msg."- <b>Ng&agrave;y th&aacute;ng &#7911;ng h&#7897; ch&#432;a &#273;&uacute;ng.</b>";
	   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
	   $msg = $msg.'<br>';
       return false;
	}
	$ngay = cv_date_sql($ngay);

	//---Edit so lieu 
   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();

/*	$sql_update = "UPDATE users SET first_name='".$first_name."', last_name='".$last_name."', namsinh='".$namsinh."',  address='".$address."', gender=".$gender.",
				  education='".$education."', job='".$job."', email='".$email."', fax='".$fax."', tel='".$tel."', yim='".$yim."', hide_email=$hide_email, join_date=".$new_join_time;*/
	
	$sql_update = "UPDATE ds_ungho SET nguoiungho='".$nguoiungho."',canhan_donvi='".$canhan_donvi."',address='".$address."',
									   website='".$website."',email='".$email."',tel='".$tel."',fax='".$fax."',yim='".$yim."',
									   ungho='".$ungho."',ngay='".$ngay."',link_news='".$link_news."'
				 
				  WHERE id_ungho=$id_ungho";
	$dbsql->query($sql_update);	
    $dbsql->close();
	return true;
}

function delete_ungho()
{
	global $id_ungho;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
			
	$sql_delete = "DELETE FROM ds_ungho WHERE id_ungho = $id_ungho";
	$dbsql->query($sql_delete);
	$dbsql->close();
	return true;
}
?>
