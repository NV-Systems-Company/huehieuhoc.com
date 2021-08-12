<?php 
$path = "../";

include($path."includes/config.php");
include($path."includes/mysql.php");
include($path."includes/functions.php");
include($path."includes/sessions.php");
include($path."includes/cookies.php");
include($path."includes/global.php");

$desc  = isset($_GET["desc"]) ? $_GET["desc"] : " ";
$page  = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

$act   = isset($_GET["act"])  ? $_GET["act"]  : "view";

$choice = array(
				"view"  => "view_hoatdong",
);
require("./sources/anhhoatdong.php");

include($path."header_code.tpl");
include($path."header.tpl");
?>

<SCRIPT language="Javascript" src="../hieuhoc.js"></script>

<!----Body-------------->
<table cellpadding="0" cellspacing="0" width="775">
	<tr>
		<td width="165" valign="top" class="MenuGradient">
			<!-----------Ben trai------->
			<?php include($path."left.tpl");?>
		</td>
		<td width="7" background="../images/body_line.gif"></td>
		<td width="481" class="BodyGradient" valign="top" align="center">
		
			<!-----------Noi Dung body------->
			<?php include($choice[$act].".tpl");?>
			
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