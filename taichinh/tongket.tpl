<center>
<? include ('./taichinh/index.tpl'); ?>
<br>
	
<font class=sub_Title>T&#7893;ng k&#7871;t n&#259;m T&agrave;i Ch&iacute;nh</font>
<br> 
<form name="form_find" method="POST" action="index.php?fod=taichinh&act=tk&exe=taich&code=tk">
<p class="sub_Title1">
T&igrave;m n&#259;m t&agrave;i ch&iacute;nh:
  <select class="form" name="find_year">
  	<option value="0" <? if ($find_year==0) echo 'selected';?>>T&#7845;t c&#7843;</option>
<?php
if ($lst_year_tket_count>0){
	for ($i=0;$i<$lst_year_tket_count;$i++){
?>
	<option value="<?=$lst_year_tket['nam'][$i]?>" <? if ($find_year==$lst_year_tket['nam'][$i]) echo 'selected';?>><?=$lst_year_tket['nam'][$i]?></option>
<?php
	}
}?>
  </select>
&nbsp;
 <input class="form" type="submit" name="find" value="T&igrave;m"> 
</p>

</form>

<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="3">
		  <tr>
		  	<td class="title1" width="30">N&#259;m</td>
			<td class="title1" width="43">Ti&#7873;n t&#7879;</td>
			<td class="title1" width="86" align="right">SD &#273;&#7847;u k&#7923;</td>
			<td class="title1" width="86" align="right">T&#7893;ng thu</td>
			<td class="title1" width="86" align="right">T&#7893;ng chi</td>
			<td class="title1" width="86" align="right">SD cu&#7889;i k&#7923;</td>
		  </tr>
<?php
if ($tongket_count>0){
	for ($i=0;$i<$tongket_count;$i++){
?>
		  <tr class="row_<?=$tongket['nam'][$i]%2?>">
			<td width="30" align="center"><?=$tongket["nam"][$i]?></td>
			<td width="43" ><?=$tongket["donvitien"][$i]?></td>
			<td width="86" align="right"><?=$tongket["sodu_dauky"][$i]?></td>
			<td width="86" align="right"><?=$tongket["tong_thu"][$i]?></td>
			<td width="86" align="right"><?=$tongket["tong_chi"][$i]?></td>
			<td width="86" align="right"><?=$tongket["sodu_cuoiky"][$i]?></td>
		  </tr>
<?php
	}
}
else {
?>
		 <tr>
		  	<td class="content" align="center" colspan="7">Kh&ocirc;ng t&igrave;m th&#7845;y th&ocirc;ng tin c&#7847;n t&igrave;m!</td>
		  </tr>
<? } ?>
		</table>
    </td>
  </tr>
</table>
<br>
</center>

