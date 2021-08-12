<?php
$act   	= isset($_GET["act"])  ? $_GET["act"] 	: 'idx';
$code   = isset($_GET["code"]) ? $_GET["code"] 	: 'home';

//---News ----
switch ($code){		
	case "send":
		send_email();
		break;

}

//=======================================
function send_email()
{
	global $_POST, $msg;
	
	$name    	= isset($_POST["name"])    ? $_POST["name"]    : '';
	$email   	= isset($_POST["email"])   ? $_POST["email"]   : '';
	$content 	= isset($_POST["content"]) ? $_POST["content"] : '';
	$address 	= isset($_POST["address"]) ? $_POST["address"]   : '';
	$tel 		= isset($_POST["tel"]) 	   ? $_POST["tel"] : '';

	//-- Kiem tra nhap lieu
	if (trim($name)=='') $msg = $msg."<br>- <b>H&#7885; t&ecirc;n ng&#432;&#7901;i g&#7917;i ch&#432;a c&oacute;!</b>";
	if (trim($address)=='') $msg = $msg."<br>- <b>&#272;&#7883;a ch&#7881; ng&#432;&#7901;i g&#7917;i ch&#432;a c&oacute;!</b>";
	if (trim($email)=='') $msg = $msg."<br>- <b>Email ng&#432;&#7901;i g&#7917;i ch&#432;a c&oacute;!</b>";
	if (trim($content)=='') $msg = $msg."<br>- <b>N&#7897;i dung g&#7917;i ch&#432;a c&oacute;!</b>";

	if ($msg!='')
	{
		$msg = $msg."<br><br><em>Y&ecirc;u c&#7847;u ki&#7875;m tra v&agrave; nh&#7853;p l&#7841;i ch&iacute;nh x&aacute;c th&ocirc;ng tin c&oacute; d&#7845;u *.</em>";
		return false;
	}

	$subject = $name." gui mail tu website Hue Hieu Hoc";
	$to_email = 'contact@huehieuhoc.com';
	$reply_email = $email;
	//Send Email
	$content = "Ho ten: ".$name."\n Dia chi: ".$address."\n Dien thoai: ".$tel."\n Email:".$email."\n Noi dung: ".$content;
	mail($to_email,$subject,$content,"From: ".$reply_email."\nReply-To: ".$reply_email."\n") or die("SMTP error. Please contact admin about this error.");
	
	$page_url = "index.php?fod=contact&act=msg";
	page_fast_transfer($page_url);
}
?>