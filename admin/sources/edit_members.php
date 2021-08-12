<?php
$act    = isset($_GET["act"])  	? $_GET["act"]   : 'idx';
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

switch ($code)
{
	case "ban":
                   banned();
                   break;
	case "unban":
                   unban();
                   break;
	case "unapp":
					approve();
					$act = "lstmem";
					require("./admin/sources/list_members.php");
					//include("./admin/sources/list_members.php");
					break;
	case "app":
					approve();
					$act = "notmem";
					require("./admin/sources/list_members.php");
					break;
	case "edit":
					$user = array();
					info_member();
					$act_temp = $act;	//transfer bien act luc dau vao site k?t ti?p
					$act = "editmem";
					break;
					
    case "editsm":
				if ($_POST["submit"]=="Cancel") 
				{
					require("./admin/sources/list_members.php");
					break;
				}
				
				$user = array();			
				global $msg, $picture, $realname, $address,	
				$gender, $education, $job, $email, $old_picture,
				$yim, $tel, $fax, $hide_email,$join_date, $order_num;	
				if (editsm_member())
				{
					//require("./admin/sources/list_members.php");
					$msg = "Ch&#7881;nh s&#7917;a th&agrave;nh c&ocirc;ng !";
					$site = "index.php?fod=ad&act=$act&exe=lstmem&page=$page";
					page_transfer($msg,$site);
				}
				else
				{
					 $user["id_user"] 		= $id;
					 $user["realname"] 		= $realname;
					 $user["namsinh"] 		= $namsinh;
					 $user["email"] 		= $email;
					 $user["address"] 		= $address;
					 $user["gender"] 		= $gender;
					 $user["tel"] 			= $tel;
					 $user["fax"] 			= $fax;
					 $user["yim"] 			= $yim;
					 $user["education"] 	= $education;
					 $user["job"] 			= $job;
					 $user["hide_email"] 	= $hide_email;
					 $user["order_num"] 	= $order_num;
					 $user["join_date"] 	= $join_date;
					 $user["picture"]		= $old_picture;
					 
					$act_temp = $act;
					$act = "editmem";
				}
               	break;
					
	case "del":
					delete_member();
					break;
	
    default :
				$act = "idx";
				break;
}

function banned(){
    global $id, $page, $act;

    $dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
    //--------------------------------------------------------------
    $sql_query = "INSERT INTO banned(id_user) VALUES($id)";
    $dbsql->query($sql_query);
    //--------------------------------------------------------------
    $dbsql->close();

    $msg = "Ch&#7881;nh s&#7917;a th&agrave;nh c&ocirc;ng !";
    $site = "index.php?fod=ad&act=$act&exe=lstmem&page=$page";
    page_transfer($msg,$site);

    return true;
}

function unban(){
    global $id, $page, $act;

    $dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
    //--------------------------------------------------------------
	$sql_query = "DELETE FROM banned WHERE id_user=$id";
    $dbsql->query($sql_query);
    //--------------------------------------------------------------
    $dbsql->close();

    $msg = "Ch&#7881;nh s&#7917;a th&agrave;nh c&ocirc;ng !";
    $site = "index.php?fod=ad&act=$act&exe=lstmem&page=$page";
    page_transfer($msg,$site);

    return true;
}

function approve()
{
	global $_POST, $id, $code;

    $dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
		
	$users_count = isset($_POST["users_count"]) ? $_POST["users_count"] : 0;
	if ($code=="unapp")
		$sql_update = "UPDATE users SET approve=0 WHERE id_user=-1"; 
	else 
		$sql_update = "UPDATE users SET approve=1 WHERE id_user=-1"; 
		
	if ($users_count>0)
	{
		for ( $i=0;$i<$users_count;$i++ ){
			   if ( !empty($_POST["approve_user_$i"]) ){
					 $sql_update .= " OR id_user=". $_POST["approve_user_$i"] ." ";
			   }
		}
	}
	$dbsql->query($sql_update);
	$dbsql->close();
	
	// GUI MAIL TRA LOI----
	if ($code =="app")
	{
		if ($users_count>0)
		{
			for ( $i=0;$i<$users_count;$i++ )
			{
			   if ( !empty($_POST["approve_user_$i"]) )
					 reply_email($_POST["approve_user_$i"]);
			}
		}
	}
	//--------------------
	return true;
}

//===========================
function reply_email($id)
{
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	$sql_select = "SELECT email FROM users WHERE id_user=$id";
	$dbsql->query($sql_select);
	$result = $dbsql->fetch_array();
	$email	= $result["email"];
	$dbsql->close(); 
	
	//-- GUI MAIL
	$subject = "Thong bao cua Quy GD Hue Hieu Hoc";
	$to_email = $email;
	$reply_email = 'admin@huehieuhoc.com';
	//Send Email
	$content = "Dang ky thanh vien cua Quy GD Hue Hieu Hoc da duoc xac nhan. \n CHUC MUNG BAN DA TRO THANH THANH VIEN CUA QUY GIAO DUC HUE HIEU HOC";
	mail($to_email,$subject,$content,"From: ".$reply_email."\nReply-To: ".$reply_email."\n") or die("SMTP error. Please contact admin about this error.");
}

//==================	
function info_member(){
     global $id,$user,$timezone,$act;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //-----------------------------------------------------
     $sql_select = "SELECT * FROM users WHERE id_user=$id";
     $dbsql->query($sql_select);
     if ($dbsql->num_rows()==0){
          $msg = "Khong ton tai th&agrave;nh vi&ecirc;n nay.";
          $page_url = "index.php?fod=ad&act=$act&exe=lstmem";
          page_transfer($msg,$page_url);
          return false;
     }

     $result = $dbsql->fetch_array();
	 $user["id_user"] 		= $id;
	 $user["username"] 		= $result["username"];
	 $user["realname"] 		= $result["first_name"].' '.$result["last_name"] ;
	 $user["namsinh"] 		= $result["namsinh"];
     $user["email"] 		= $result["email"];
     //$user["email"] 		= ($result["hide_email"]==1) ? '' : $user["email"];
     $user["address"] 		= $result["address"];
	 $user["gender"] 		= $result["gender"];
     $user["tel"] 			= $result["tel"];
     $user["fax"] 			= $result["fax"];
     $user["yim"] 			= $result["yim"];
     $user["education"] 	= $result["education"];
	 $user["job"] 			= $result["job"];
	 $user["hide_email"] 	= $result["hide_email"];
	 $user["order_num"] 	= $result["order_num"];
     $user["join_date"] 	= gmdate("d-m-Y",$result["join_date"] + $timezone*3600);
     $user["picture"] 		= ($result["picture"]=='') ? './members/img_members/male.gif' : "./members/img_members/".$result["picture"];

     //-----------------------------------------------------
     $dbsql->close();

}

function editsm_member(){
	global  $_POST, $msg, $id, $picture, $realname, $address,$namsinh,
			$gender, $education, $job, $email, $yim, $join_date,
			$tel,$fax, $hide_email, $order_num;	
	$file_picture = '';
	$new_join_time = gmdate("d-m-Y",time());
	
	$msg		= isset($msg) ? $msg : '';
	$id   		= isset($_POST["id"]) 		? $_POST["id"] : '';
	$realname   = isset($_POST["realname"]) ? $_POST["realname"] : '';
	$namsinh    = isset($_POST["namsinh"]) ? $_POST["namsinh"] : '';
	$gender   	= isset($_POST["gender"]) 	? $_POST["gender"] : 1;
	$address   	= isset($_POST["address"]) ? $_POST["address"] : '';
	$email     	= isset($_POST["email"]) ? $_POST["email"] : '';
	$picture	= isset($_FILES['picture']['name'] ) ? $_FILES['picture']['name'] : '';			
	$hide_email  = isset($_POST["hide_email"]) ? $_POST["hide_email"] : -1;
	$order_num   = isset($_POST["order_num"]) ? $_POST["order_num"] : 1000;
	$tel  		 = isset($_POST["tel"]) 	   ? $_POST["tel"] 		  : '';
	$fax  		 = isset($_POST["fax"]) 	   ? $_POST["fax"] : '';
	$yim  		 = isset($_POST["yim"]) 	   ? $_POST["yim"] 		  : '';
	$job  		 = isset($_POST["job"]) 	   ? $_POST["job"] 		  : '';
	$education	 = isset($_POST["education"])  ? $_POST["education"]  : '';
	$join_date	 = isset($_POST["join_date"])   ? $_POST["join_date"]  : $new_join_time;
	$password	 = isset($_POST["password"])   ? $_POST["password"]  : '';
	$old_picture = isset($_POST["old_picture"])? $_POST["old_picture"]: ''; //su dung cho phan hien thi lai anh

   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();				
	
	if (trim($join_date)==''||trim($address)==''||trim($email)==''|| trim($realname)=='')
	{	
		if (trim($join_date)=='') $msg = $msg."<br>- <b>Ng&agrave;y th&aacute;ng gia nh&#7853;p ch&#432;a c&oacute;!</b>";
		if (trim($realname)=='') $msg = $msg."<br>- <b>H&#7885; v&agrave; t&ecirc;n ch&#432;a c&oacute;!</b>";
		if (trim($address)=='') $msg = $msg."<br>- <b>&#272;&#7883;a ch&#7881; ch&#432;a c&oacute;!</b>";
		if (trim($email)=='') $msg = $picture.$msg."<br>- <b>Email ch&#432;a c&oacute;!</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
    }

	// Kiem tra ngay thang
	if (!check_date_vietnam($join_date))
	{
	   $msg = $msg."- <b>Ng&agrave;y th&aacute;ng gia nh&#7853;p ch&#432;a &#273;&uacute;ng!</b>";
	   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
	   $msg = $msg.'<br>';
       return false;
	}
	else
	{
		$new_join_time = mktime ( 0, 0, 0, get_month($join_date), get_day($join_date), get_year($join_date));
	}

	// Kiem tra email
	$start_domain_email = strpos($email,"@");
	$name_email = substr($email,0,$start_domain_email);
	$domain_email = substr($email,$start_domain_email+1,strlen($email));
	$dot_in_domain = strpos($domain_email,".");
	if (empty($start_domain_email)||empty($dot_in_domain)||(($dot_in_domain+1)==strlen($domain_email)))
	{
	   $msg = $msg."- <b>Email nh&#7853;p kh&ocirc;ng &#273;&uacute;ng!</b>";
	   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
	   $msg = $msg.'<br>';
       return false;
	}
	
	// Kiem tra email nay da co chua
	$sql_select = "SELECT * FROM users WHERE (email = '".$email."') AND (id_user <> ".$id.")";
	$dbsql->query($sql_select);
	if ($dbsql->num_rows()!=0)
	{ 
	   $msg = $msg."- <b>Email n&agrave;y &#273;&atilde; c&oacute; ng&#432;&#7901;i s&#7917; d&#7909;ng!</b>";
	   $msg = $msg."<br><br><em>Vui l&ograve;ng s&#7917; d&#7909;ng email kh&aacute;c &#273;&#7875; &#273;&#259;ng k&yacute;.</em>";
	   $dbsql->close();
	   return false;	
	}

	if (trim($picture)!='')
	{
		// GET THE TYPE OF IMAGE . EX: .GIF , .JPG ,....
		$start_img = strpos($picture,"."); //do dai ten file
		$type_img = substr($picture,$start_img,strlen($picture)); //Kieu file
		   
		if ((strtolower($type_img)!=".gif")&&(strtolower($type_img)!=".jpg")&&(strtolower($type_img)!=".bmp"))
		{
		   $msg = $msg."- <b>B&#7841;n ch&#7881; &#273;&#432;&#7907;c upload c&aacute;c file ki&#7875;u .gif, .jpg, .bmp</b>";
		   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		   return false;
		}
	
		//----------------------------------------------
		//Get file name and Copy file picture thanh vien len server
		$sql_select = "SELECT picture FROM users WHERE id_user = $id";
		$dbsql->query($sql_select);
		$result = $dbsql->fetch_array();
		$file_picture = $result["picture"];
		if ($file_picture=='')
			$file_picture = $name_email.'_'.time().$type_img;
		if (!(copy($_FILES['picture']['tmp_name'], "./members/img_members/".$file_picture)) ) die("Cannot upload files.");	
	}

	//tach phan first name va last name
	$pos_space = strrpos(trim($realname),' ');
	if ($pos_space)
	{
		$first_name = trim(substr($realname,0,$pos_space));
		$last_name	= trim(substr($realname,$pos_space,strlen($realname)));
	}
	else
	{
		$first_name = '';
		$last_name	= trim($realname);
	}

	//---Edit so lieu database
	$sql_update = "UPDATE users SET first_name='".$first_name."', last_name='".$last_name."', namsinh='".$namsinh."',  address='".$address."', gender=".$gender.",
				  education='".$education."', job='".$job."', email='".$email."', fax='".$fax."', tel='".$tel."', yim='".$yim."', hide_email=$hide_email, order_num=$order_num, join_date=".$new_join_time;
	if (trim($password)!='')
		$sql_update .= ", password='".md5($password)."' ";
	if ($picture!='')
		$sql_update .= ", picture='".$file_picture."' ";
	
	$sql_update .= " WHERE id_user = $id";
	$dbsql->query($sql_update);	
	$dbsql->close();
	return true;
}

function delete_member()
{
	global $id, $page, $act;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	$sql_delete = "DELETE FROM users WHERE id_user = $id";
	$dbsql->query($sql_delete);
	$dbsql->close();

    $msg = "Xo&aacute; th&agrave;nh c&ocirc;ng !";
    $site = "index.php?fod=ad&act=$act&exe=lstmem&page=$page";
    page_transfer($msg,$site);
}
?>