<br>
<br>
<font class="Title">H&#7896;I &#272;&#7890;NG C&#7888; V&#7844;N</font>
<br>

<br>
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="4">
		  <tr>
			<td class="title1" width="18">TT</td>
			<td class="title1" width="123">H&#7885; v&agrave; t&ecirc;n</td>
			<td class="title1" width="92">Ch&#7913;c v&#7909;</td>
			<td class="title1" width="190">&#272;&#7883;a ch&#7881;</td>
		  </tr>
<?php
if ($users_cv_count>0){
	for ($i=0;$i<$users_cv_count;$i++){
?>
		  <tr class="row_content" <? if ($_SESSION["login"]=='logined'){ ?> onclick= window.open("index.php?fod=mem&act=infomem&exe=infomem&id=<?=$users_cv['id'][$i]?>","_self"); onmouseover=Ovr_row(this); onmouseout=Out_row(this); <? } ?> >
		  	<td width="18" align="right"><?=$i+1?></td>
			<td width="123"><?=$users_cv["realname"][$i]?></td>
			<td width="92"><?=$users_cv["chucvu"][$i]?></td>
			<td width="190"><?=$users_cv["address"][$i]?></td>
		  </tr>
<?php
	}
}
?>

		</table>
    </td>
  </tr>
</table>
