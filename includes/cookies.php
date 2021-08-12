<?php
if (!isset($_COOKIE["show_menupopup_admin"]))
	setcookie("show_menupopup_admin","none",time()+(60*60*1),"/",$root_domain, 0);

if (!isset($_COOKIE["show_menupopup_news"]))
	setcookie("show_menupopup_news","none",time()+(60*60*1),"/",$root_domain, 0);

if (!isset($_COOKIE["show_menupopup_finance"]))
	setcookie("show_menupopup_finance","none",time()+(60*60*1),"/",$root_domain, 0);

if (!isset($_COOKIE["show_menupopup_hocbong"]))
	setcookie("show_menupopup_hocbong","none",time()+(60*60*1),"/",$root_domain, 0);

?>