<?php
    $_SESSION["login"]      = "not_login";
    $_SESSION["ses_id_user"]    = -1;
	$_SESSION["ses_username"]   = "";
    $_SESSION["ses_realname"]   = "";
	$_SESSION["ses_yim"]      	= "";
	$_SESSION["right_update_finance"]   = 0;
	$_SESSION["right_update_news"]   	= 0;
	$_SESSION["right_update_hocbong"]   = 0;
	$_SESSION["right_admin"]   			= 0;
	
	/*$act = 'idx';
	$fod = 'home';*/
   $msg = "C&aacute;m &#417;n b&#7841;n &#273;&atilde; tham gia <br> Qu&#7929; Gi&aacute;o d&#7909;c  Hu&#7871; Hi&#7871;u H&#7885;c.";
   $page = "index.php";
   page_transfer($msg,$page);
   return false;

?>
