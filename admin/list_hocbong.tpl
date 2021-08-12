
<br><br>
<font class=box_Subject>DANH S&Aacute;CH C&Aacute;C &#272;&#7906;I X&Eacute;T DUY&#7878;T V&Agrave; NH&#7852;N H&#7884;C B&#7892;NG</font><br>
<br> 
<table border="0" width="481" cellspacing="1" cellpadding="3">
	<tr>
	<td width="98" align="left" class="title1">Ng&agrave;y</td>
	<td class="title1" width="368">Th&ocirc;ng tin h&#7885;c b&#7893;ng</td>
	</tr>
<?php
	if ($hocbong_count>0)
	{	
		for($i=0;$i<$hocbong_count;$i++)
		{ ?>
			<tr class="row_content" onmouseover=Ovr_row(this); onmouseout=Out_row(this);>
				<td valign="top"><?=$hocbong['ngay_hb'][$i]?></td>
				<td valign="top">
					<?=$hocbong['hocbong'][$i]?><br><br>
					<?=$hocbong['edit'][$i]?> : : <?=$hocbong['del'][$i]?>
				</td>
			</tr>
			<tr class="row_content1">
				<td colspan="2" height="1"></td>
			</tr>
		<?}
	}else {?>
			<tr class="row_content">
				<td colspan="2" align="center">Kh&ocirc;ng c&oacute; th&ocirc;ng tin n&agrave;o</td>
			</tr>
	<? } ?>
</table>

<p class=showpage align="right"><?=$show_page?>&nbsp;&nbsp;&nbsp;&nbsp;</p>

