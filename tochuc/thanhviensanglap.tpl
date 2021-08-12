<br>
<br>
<font class="Title">TH&Agrave;NH VI&Ecirc;N S&Aacute;NG L&#7852;P</font>
<br>
<p><font class=showpage><?=$show_page?></font></p>
<br>
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="4">
		  <tr>
			<td class="title1" width="18">TT</td>
			<td class="title1" width="150">H&#7885; v&agrave; t&ecirc;n</td>
			<td class="title1" width="264">&#272;&#7883;a ch&#7881;</td>
		  </tr>
<?php
if ($users_sl_count>0){
	for ($i=0;$i<$users_sl_count;$i++){
?>
		  <tr class="row_content" <? if ($_SESSION["login"]=='logined'){ ?> onclick= window.open("index.php?fod=mem&act=infomem&exe=infomem&id=<?=$users_sl['id'][$i]?>","_self"); onmouseover=Ovr_row(this); onmouseout=Out_row(this); <? } ?> >
		  	<td width="18" align="right"><?=($members_per_page*($page-1))+$i+1?></td>
			<td width="150"><?=$users_sl["realname"][$i]?></td>
			<td width="264"><?=$users_sl["address"][$i]?></td>
		  </tr>
<?php
	}
}
?>

		</table>
    </td>
  </tr>
</table>
<br><p align="right"><font class=showpage><?=$show_page?></font></p>
