<table cellpadding="0" cellspacing="0" width="775">
	<tr>
		<td><img src="<?=$root_domain;?>images/top_1.gif" width="775" height="127"></td>
	</tr>
	<tr>
		<td><img src="<?=$root_domain;?>images/top_2.gif" width="775" height="2"></td>
	</tr>
</table>

<table id ="tbl_pos" cellpadding="0" cellspacing="0" width="775">
	<tr>
		<td><img src="<?=$root_domain;?>images/top_3.gif" width="194"></td>
		<td width="581" align="center" valign="middle" bgcolor="8FB57B">
			<!--- Top Menu----->
			<?php
			include("menu_top.tpl");
			?>
		</td>
	</tr>
	<tr>
		<td><img src="<?=$root_domain;?>images/top_4_1.gif" width="194"></td>
		<td><img src="<?=$root_domain;?>images/top_4_2.gif" width="581"></td>
	</tr>
</table>

<table cellpadding="0" cellspacing="0" width="775">
	<tr>
		<td width="194"><img src="<?=$root_domain;?>images/top_5_1.gif" width="194" height="48"></td>
		<td width="461" height="48" background="<?=$root_domain;?>images/top_5_2.gif">
		<marquee scrolldelay="5" scrollamount="4">
		<strong><font color="#FF0000">
			<?php
				include("chuchay.tpl");
			?>
		</font>
		</strong>
		</marquee></td>
		<td width="120" class="user" height="48" align="center" valign="top" bgcolor="EEEEEE"><?if ($_SESSION["login"]== 'logined') include($path.'welcome_user.tpl');?></td>
	</tr>
</table>		