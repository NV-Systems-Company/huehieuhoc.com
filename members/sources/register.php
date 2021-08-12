<?php
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';
$msg		= isset($msg) ? $msg : '';

//$username 	= isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : '';
$username 	= isset($_POST["username"]) ? $_POST["username"] : '';
$password 	= isset($_POST["password"]) ? $_POST["password"] : '';
$verifypass = isset($_POST["verifypass"]) ? $_POST["verifypass"] : '';
$realname   = isset($_POST["realname"]) ? $_POST["realname"] : '';
$namsinh   = isset($_POST["namsinh"]) 	? $_POST["namsinh"] : '';
$gender   	= isset($_POST["gender"]) 	? $_POST["gender"] : 1;

//$address   	= isset($_POST["address"]) ? htmlspecialchars($_POST["address"]) : '';
$address   	= isset($_POST["address"]) ? $_POST["address"] : '';
$email     	= isset($_POST["email"]) ? $_POST["email"] : '';
$picture	= isset($_FILES['picture']['name'] ) ? $_FILES['picture']['name'] : 'NULL';

$hide_email  = isset($_POST["hide_email"]) ? $_POST["hide_email"] : -1;
$tel  		 = isset($_POST["tel"]) 	   ? $_POST["tel"] 		  : '';
$fax  		 = isset($_POST["fax"]) 	   ? $_POST["fax"] : '';
$yim  		 = isset($_POST["yim"]) 	   ? $_POST["yim"] 		  : '';
$job  		 = isset($_POST["job"]) 	   ? $_POST["job"] 		  : '';
$education	 = isset($_POST["education"])  ? $_POST["education"]  : '';

if ($code=='sm')
{
	if (submit_register())
	{
		$msg = "&#272;&#259;ng k&yacute; th&agrave;nh c&ocirc;ng!";
		$site = "index.php";
		page_transfer($msg,$site);
	}
}

function submit_register()
{
	global  $_POST, 
			$act, $msg, $username, $password,$verifypass,
			$realname,$namsinh,$address, $email,$picture,$education,
			$hide_email,$tel,$fax,$yim,$job, $gender;
	$file_picture = '';
	
	if (trim($username)==''||trim($address)==''||trim($email)==''|| 
  		trim($password)==''||trim($verifypass)==''||trim($realname)=='')
	{	
		if (trim($username)=='') $msg = "- <b>T&ecirc;n &#273;&#259;ng nh&#7853;p ch&#432;a c&oacute;!</b>";
		if (trim($password)=='') $msg = $msg."<br>- <b>M&#7853;t m&atilde; ch&#432;a &#273;&#432;&#7907;c nh&#7853;p!</b>";
		if (trim($verifypass)=='') $msg = $msg."<br>- <b>X&aacute;c nh&#7853;n l&#7841;i m&#7853;t m&atilde; ch&#432;a &#273;&#432;&#7907;c nh&#7853;p!</b>";
		if (trim($realname)=='') $msg = $msg."<br>- <b>H&#7885; v&agrave; t&ecirc;n ch&#432;a c&oacute;!</b>";
		if (trim($address)=='') $msg = $msg."<br>- <b>&#272;&#7883;a ch&#7881; ch&#432;a c&oacute;!</b>";
		if (trim($email)=='') $msg = $msg."<br>- <b>Email ch&#432;a c&oacute;!</b>";
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";

		$act = "reg";
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
       $act = "reg";
       return false;
	}
	
	if ( $verifypass!=$password )
	{
	   $msg = $msg."- <b>Nh&#7853;p l&#7841;i m&#7853;t kh&#7849;u kh&ocirc;ng ch&iacute;nh x&aacute;c.</b>";
	   $msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
	   $act = "reg";
	   return false;
	}
	
	// Kiem tra usernam nay da co nguoi su dung chua
	if (checkusername($username))
	{
	   $msg = $msg."- <b>T&ecirc;n &#273;&#259;ng nh&#7853;p n&agrave;y &#273;&atilde; c&oacute; ng&#432;&#7901;i s&#7917; d&#7909;ng!</b>";
	   $msg = $msg."<br><br><em>Vui l&ograve;ng s&#7917; d&#7909;ng t&ecirc;n &#273;&#259;ng nh&#7853;p kh&aacute;c &#273;&#7875; &#273;&#259;ng k&yacute;.</em>";
	   $act = "reg";
	   return false;
	}
	
	// Kiem tra email nay da co chua
	if (checkemail($email))
	{
	   $msg = $msg."- <b>Email n&agrave;y &#273;&atilde; c&oacute; ng&#432;&#7901;i s&#7917; d&#7909;ng!</b>";
	   $msg = $msg."<br><br><em>Vui l&ograve;ng s&#7917; d&#7909;ng email kh&aacute;c &#273;&#7875; &#273;&#259;ng k&yacute;.</em>";
	   $act = "reg";
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
		   $act = "reg";
		   return false;
		}
	
		//----------------------------------------------
		//Copy file picture thanh vien len server
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

	//---Add so lieu vao database
   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_insert = "INSERT INTO users (username,password,first_name,last_name,namsinh,address,gender,email,education,job,yim,tel,fax,hide_email,picture,website,sign,intro,last_login,join_date)
							 VALUES('".$username."','".md5($password)."','".$first_name."','".$last_name."','".$namsinh."','".$address."','".$gender."','".$email."','".$education."','".$job."','".$yim."','".$tel."','".$fax."',".$hide_email.",'".$file_picture."','','','',0,".time().")";
	$dbsql->query($sql_insert);	
	
	//----Kiem tra co phai la nguoi dang ky dau tien - Neu là dau tien thi cho quyen admin
	$sql_select = "SELECT id_user FROM users";
	$dbsql->query($sql_select);
	
	if ($dbsql->num_rows()==1)
	{  	  
		$result = $dbsql->fetch_array();
		$id_user = $result["id_user"];
		$sql_insert = "INSERT INTO user_admin (id_user)
							 VALUES('".$id_user."')";
		$dbsql->query($sql_insert);	
		
		$sql_update = "UPDATE users SET approve=1 WHERE id_user=".$id_user;
		$dbsql->query($sql_update);
	} 
	
	//---------------------
    $dbsql->close();
	
	
	//--GUI MAI THONG BAO ADMIN LA CO NGUOI DANG KY-------------------------
	$subject = "Hue Hieu Hoc - Thong bao co thanh vien moi dang ky vào HHH";
	$to_email = 'admin@huehieuhoc.com';
	$reply_email = $email;
	//Send Email
	$content = $realname."\n Email:".$email."\n Da dang ky lam thanh vien cua Quy Giao Duc Hue Hieu Hoc \n Yeu cau admin xac nhan.";
	mail($to_email,$subject,$content,"From: ".$reply_email."\nReply-To: ".$reply_email."\n") or die("SMTP error. Please contact admin about this error.");
	//---------------------
	return true;
}

function checkemail($email)
{
   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT * FROM users WHERE email = '".$email."'";
	$dbsql->query($sql_select);
	if ($dbsql->num_rows()==0)
	{ 
		return false;
	}
	return true;
}

function checkusername($username)
{
   	$dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
	$sql_select = "SELECT * FROM users WHERE username = '".$username."'";
	$dbsql->query($sql_select);
	if ($dbsql->num_rows()==0)
	{ 
		return false;
	}
	return true;
}

?>