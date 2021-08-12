
<br><br>
<font class=box_Subject>TH&Ocirc;NG B&Aacute;O C&#7910;A QU&#7928; GI&Aacute;O D&#7908;C HU&#7870; HI&#7870;U H&#7884;C</font><br>
<br> 
<table border="0" width="481" cellspacing="1" cellpadding="3">
	<tr>
	<td width="98" align="left" class="title1">Ng&agrave;y</td>
	<td class="title1" width="368">Th&ocirc;ng b&aacute;o v&#7873; vi&#7879;c</td>
	</tr>
<?php
	if ($thongbao_count>0)
	{	
		for($i=0;$i<$thongbao_count;$i++)
		{ ?>
			<tr class="row_content" onmouseover=Ovr_row(this); onmouseout=Out_row(this);>
				<td valign="top"><?=$thongbao['ngay_tb'][$i]?></td>
				<td valign="top">
					<?=$thongbao['thong_bao'][$i]?><br>
				</td>
			</tr>
			<tr class="row_content1">
				<td colspan="2" height="1"></td>
			</tr>
		<?}
	}else {?>
			<tr class="row_content">
				<td colspan="2" align="center">Kh&ocirc;ng c&oacute; th&ocirc;ng b&aacute;o n&agrave;o</td>
			</tr>
	<? } ?>
</table>

<p class=showpage align="right"><?=$show_page?>&nbsp;&nbsp;&nbsp;&nbsp;</p>

