<br>
<br>
<font class=Title>DANH S&Aacute;CH &#272;&#416;N V&#7882;, C&Aacute; NH&Acirc;N &#272;&#7890;NG H&Agrave;NH <br>
V&#7898;I QU&#7928; GI&Aacute;O D&#7908;C HU&#7870; HI&#7870;U H&#7884;C</font>
<br>
<br>
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="4">
		  <tr>
			<td class="title1" width="18">TT</td>
			<td class="title1" width="217">T&ecirc;n &#273;&#417;n v&#7883;, t&#7893; ch&#7913;c</td>
			<td class="title1" width="197">&#272;&#7883;a ch&#7881;</td>
		  </tr>
<?php
if ($donghanh_count>0){
	for ($i=0;$i<$donghanh_count;$i++){
?>
		  <tr class="row_content" onclick= window.open("<?=$donghanh['website'][$i]?>","_plank"); onmouseover=Ovr_row(this); onmouseout=Out_row(this);>
			<td width="18" align="right"><?=$i+1?></td>
			<td width="217"><?=$donghanh["ten_donghanh"][$i]?></td>
			<td width="197"><?=$donghanh["address"][$i]?></td>
		  </tr>
<?php
	}
}
?>

		</table>
    </td>
  </tr>
</table>
</center>
