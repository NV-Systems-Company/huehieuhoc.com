<?php
$act    = isset($_GET["act"])  	? $_GET["act"]   : 'idx';
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

if ($_SESSION["login"] == "logined")
{
	$id = $_SESSION["ses_id_user"];
	
	switch ($code)
	{
		case "view":
						$user = array();
						info_myself();
						break;
						
		case "edit":
					if ($_POST["submit"]=="Cancel") 
					{
						$fod='home';
						$act='idx';
						break;
					}
					
					$user = array();			
					global $msg, $picture, $realname, $address,	
					$gender, $education, $job, $email, $old_picture,
					$yim, $tel, $fax, $hide_email,$join_date;	
					if (edit_myself())
					{
						$msg = "Ch&#7881;nh s&#7917;a th&agrave;nh c&ocirc;ng !";
						$site = "index.php";
						page_transfer($msg,$site);
					}
					else
					{
						 $user["id_user"] 		= $id;
						 $user["realname"] 		= $realname;
						 $user["email"] 		= $email;
						 $user["address"] 		= $address;
						 $user["namsinh"] 		= $namsinh;
						 $user["gender"] 		= $gender;
						 $user["tel"] 			= $tel;
						 $user["fax"] 			= $fax;
						 $user["yim"] 			= $yim;
						 $user["education"] 	= $education;
						 $user["job"] 			= $job;
						 $user["hide_email"] 	= $hide_email;
						 $user["join_date"] 	= $join_date;
						 $user["picture"]		= $old_picture;
					}
					break;
		
		default :
					$act = "idx";
					$fod='home';
					break;
	}

}

function info_myself(){
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
     $user["email"] 		= $result["email"];
     //$user["email"] 		= ($result["hide_email"]==1) ? '' : $user["email"];
     $user["address"] 		= $result["address"];
	 $user["namsinh"] 		= $result["namsinh"];
	 $user["gender"] 		= $result["gender"];
     $user["tel"] 			= $result["tel"];
     $user["fax"] 			= $result["fax"];
     $user["yim"] 			= $result["yim"];
     $user["education"] 	= $result["education"];
	 $user["job"] 			= $result["job"];
	 $user["hide_email"] 	= $result["hide_email"];
     $user["join_date"] 	= gmdate("d-m-Y",$result["join_date"] + $timezone*3600);
     $user["picture"] 		= ($result["picture"]=='') ? './members/img_members/male.gif' : "./members/img_members/".$result["picture"];

     //-----------------------------------------------------
     $dbsql->close();

}

function edit_myself(){
	global  $_POST, $msg, $id, $picture, $realname, $address,	
			$gender, $education, $job, $email, $yim, $join_date,
			$tel,$fax, $hide_email;	
	$file_picture = '';

	$msg		= isset($msg) ? $msg : '';
	$realname   = isset($_POST["realname"]) ? $_POST["realname"] : '';
	$namsinh    = isset($_POST["namsinh"]) ? $_POST["namsinh"] : '';
	$gender   	= isset($_POST["gender"]) 	? $_POST["gender"] : 1;
	$address   	= isset($_POST["address"]) ? $_POST["address"] : '';
	$email     	= isset($_POST["email"]) ? $_POST["email"] : '';
	$picture	= isset($_FILES['picture']['name'] ) ? $_FILES['picture']['name'] : '';			
	$hide_email  = isset($_POST["hide_email"]) ? $_POST["hide_email"] : -1;
	$tel  		 = isset($_POST["tel"]) 	   ? $_POST["tel"] 		  : '';
	$fax  		 = isset($_POST["fax"]) 	   ? $_POST["fax"] : '';
	$yim  		 = isset($_POST["yim"]) 	   ? $_POST["yim"] 		  : '';
	$job  		 = isset($_POST["job"]) 	   ? $_POST["job"] 		  : '';
	$education	 = isset($_POST["education"])  ? $_POST["education"]  : '';
	$password	 = isset($_POST["password"])   ? $_POST["password"]  : '';
	
   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();				
	
	if (trim($address)==''||trim($email)==''|| trim($realname)=='')
	{	
		if (trim($realname)=='') $msg = $msg."<br>- <b>H&#7885; v&agrave; t&ecirc;n ch&#432;a c&oacute;!</b>";
		if (trim($address)=='') $msg = $msg."<br>- <b>&#272;&#7883;a ch&#7881; ch&#432;a c&oacute;!</b>";
		if (trim($email)=='') $msg = $picture.$msg."<br>- <b>Email ch&#432;a c&oacute;!</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
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

	if ($picture!='')
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
	$sql_update = "UPDATE users SET first_name='".$first_name."', last_name='".$last_name."', namsinh='".$namsinh."', address='".$address."', gender=".$gender.",
				  education='".$education."', job='".$job."', email='".$email."', fax='".$fax."', tel='".$tel."', yim='".$yim."', hide_email=$hide_email";
	if (trim($password)!='')
		$sql_update .= ", password='".md5($password)."' ";
	if ($picture!='')
		$sql_update .= ", picture='".$file_picture."' ";
	
	$sql_update .= " WHERE id_user = $id";
	$dbsql->query($sql_update);	
	$dbsql->close();
	return true;
}
?>