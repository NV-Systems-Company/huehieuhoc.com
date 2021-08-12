
<br><br>
<font class=box_Subject>DANH S&Aacute;CH &#7842;NH HO&#7840;T &#272;&#7896;NG</font><br>
<br> 
<table border="0" width="481" cellspacing="1" cellpadding="3">
	<tr>
	<td width="98" align="left" class="title1">Ng&agrave;y c&#7853;p nh&#7853;t</td>
	<td class="title1" width="368">&#7842;nh ho&#7841;t &#273;&#7897;ng</td>
	</tr>
<?php
	if ($hoatdong_count>0)
	{	
		for($i=0;$i<$hoatdong_count;$i++)
		{ ?>
			<tr class="row_content" onmouseover=Ovr_row(this); onmouseout=Out_row(this);>
				<td valign="top"><?=$hoatdong['ngay_hd'][$i]?></td>
				<td valign="top">
					<?=$hoatdong['hoatdong'][$i]?><br><br>
					<?=$hoatdong['edit'][$i]?> : : <?=$hoatdong['del'][$i]?>
				</td>
			</tr>
			<tr class="row_content1">
				<td colspan="2" height="1"></td>
			</tr>
		<?}
	}else {?>
			<tr class="row_content">
				<td colspan="2" align="center">Kh&ocirc;ng c&oacute; ho&#7841;t &#273;&#7897;ng n&agrave;o n&agrave;o</td>
			</tr>
	<? } ?>
</table>

<p class=showpage align="right"><?=$show_page?>&nbsp;&nbsp;&nbsp;&nbsp;</p>

