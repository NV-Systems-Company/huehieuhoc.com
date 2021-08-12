<?php 
$path = "./";
include($path."includes/config.php");
include($path."includes/mysql.php");
include($path."includes/functions.php");
include($path."includes/sessions.php");
include($path."includes/cookies.php");
include($path."includes/global.php");

$desc  = isset($_GET["desc"]) ? $_GET["desc"] : " ";
$page  = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

$fod   = isset($_GET["fod"])  ? $_GET["fod"]  : 'home';
$foder = array(
				"home"		=> '',
				"news"		=> "./news/",
                "tch"       => "./tochuc/",
                "mem"       => "./members/",
                "ad"       	=> "./admin/",
				"dh"       	=> "./donghanh/",
				"bt"       	=> "./baotro/",
				"taichinh" 	=> "./taichinh/",
				"tb" 		=> "./thongbao/",
				"hb" 		=> "./hocbong/",
				"contact" 	=> "./contact/",
);

include($foder[$fod]."action.php");
include($foder[$fod]."execute.php");
?>


<?php include($path."header_code.tpl");?>
<!---- Hearder------>
<?php include($path."header.tpl");?>

<SCRIPT language="Javascript" src="./hieuhoc.js"></script>

<!----Body-------------->
<table cellpadding="0" cellspacing="0" width="775">
	<tr>
		<td width="165" valign="top" class="MenuGradient">
			<!-----------Ben trai------->
			<?php include($path."left.tpl");?>
		</td>
		<td width="7" background="images/body_line.gif"></td>
		<td width="481" class="BodyGradient" valign="top" align="center">
		
			<!-----------Noi Dung body------->
			<?php //include("index.tpl");?>
			<?php include($foder[$fod] . $choice[$act].".tpl");?>
			
		</td>
		<td width="2"></td>
		
		<td width="120" align="center" valign="top" bgcolor="EEEEEE">
			<!-----------Right------->
			<?php include($path."right.tpl");?>
		</td>
	</tr>
</table>		
<!----End Body-------------->
		
<!------Footer ------>
<?php include($path."footer.tpl");?>	

<!----------------------------->
<?php include($path."footer_code.tpl");?>