
<center>
<br><br>
<font class=Title>Danh s&aacute;ch &#273;&#417;n v&#7883; c&aacute; nh&acirc;n &#7911;ng h&#7897;</font><br>
<br> 
<form name="doituong" method="POST" action="index.php?fod=ad&act=lst_uh&exe=uh&code=list">
<p class="sub_Title1">
T&ecirc;n c&#7847;n t&igrave;m: <input class="form" name="keyword" type="text" size="15" value="<?=$keyword?>">

&#272;&#7889;i t&#432;&#7907;ng:
  <select class="form" name="canhan_donvi">
  <option value="-1" <?if ($canhan_donvi==-1) echo 'selected';?>>T&#7845;t c&#7843;</option>
  <option value="1" <?if ($canhan_donvi==1) echo 'selected';?>>T&#7893; ch&#7913;c</option>
  <option value="0" <?if ($canhan_donvi==0) echo 'selected';?>>C&aacute; nh&acirc;n</option>
</select>
  <input class="form" type="submit" name="find" value="T&igrave;m">
</p>
</form>
<p class=showpage align="right"><?=$show_page?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="3">
		  <tr>
		  	<td class="title1" width="23">TT</td>
			<td class="title1" width="57">Ng&agrave;y</td>
			<td class="title1" width="177">T&ecirc;n t&#7893; ch&#7913;c, c&aacute; nh&acirc;n</td>
			<td class="title1" width="129">&#7910;ng h&#7897;</td>
			<td class="title1" width="38">X&oacute;a</td>
		  </tr>
<?php
if ($ds_ungho_count>0){
	for ($i=0;$i<$ds_ungho_count;$i++){
?>
		  <tr class="row_content" onclick= window.open("index.php?fod=ad&act=edit_uh&exe=uh&code=edit&id=<?=$ds_ungho['id_ungho'][$i]?>","_self"); onmouseover=Ovr_row(this); onmouseout=Out_row(this);>
			<td width="23" align="right"><?=($ungho_per_page*($page-1))+$i+1?></td>
			<td width="57"><?=$ds_ungho["ngay"][$i]?></td>
			<td width="177"><?=$ds_ungho["nguoiungho"][$i]  ?></td>
			<td width="129"><?=$ds_ungho["ungho"][$i]  ?></td>
			<td width="38"><a href="index.php?fod=ad&act=lst_uh&exe=uh&code=del&id=<?=$ds_ungho['id_ungho'][$i]?>">X&oacute;a</a></td>
		  </tr>
<?php
	}
}
else {
?>
		 <tr>
		  	<td class="content" align="center" colspan="5">Kh&ocirc;ng t&igrave;m th&#7845;y th&ocirc;ng tin c&#7847;n t&igrave;m  trong danh s&aacute;ch!</td>
		  </tr>
<? } ?>
		</table>
    </td>
  </tr>
</table>
<p class=showpage align="right"><?=$show_page?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
<br>
<a class="menu_admin" href="index.php?fod=ad&act=add_uh&exe=uh">Th&ecirc;m c&aacute; nh&acirc;n - &#273;&#417;n v&#7883; &#7911;ng h&#7897;</a>
</center>

