<?php 
include("../includes/config.php");
include("../includes/mysql.php");
include("../includes/functions.php");
include("../includes/sessions.php");
include("../includes/cookies.php");
include("../includes/global.php");
$page  = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
require("./sources/w_hocbong.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Hue Hieu Hoc</title>
</head>

<frameset rows="60,*"" frameborder="NO" border="0" framespacing="0">
   <frame src="top.php" name="topFrame" scrolling="no">
   <frame src="./file_hb/<?=$file_hocbong?>" name="main">
</frameset>
<noframes>
<body>
<p>This page uses frames, but your browser doesn't support them.</p>
</body>
</noframes>

</html>
