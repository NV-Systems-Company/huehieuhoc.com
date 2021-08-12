<script language="javascript">
	function check_find(the_form)
	{	//String.fromCharCode(0xE1)
		if (the_form.nam_tongket.value==0)
		{
			alert("Nam tai chinh chua chon!");
			the_form.nam_tongket.focus();
			return false;
		}
		return true;
	}
</script>
<center>
<br><br>
<p>
<a class="menu_admin" href="index.php?fod=ad&act=lst_thu&exe=thuchi&code=list">Qu&#7843;n l&yacute; ti&#7873;n Thu</a> 
&nbsp;&nbsp;
<a class="menu_admin" href="index.php?fod=ad&act=lst_chi&exe=thuchi&code=list">Qu&#7843;n l&yacute;  ti&#7873;n Chi</a> 
</p>
<hr color="#B91200" size="1">
<br>			
<font class=Title>T&#7893;ng k&#7871;t n&#259;m T&agrave;i Ch&iacute;nh</font>
<form name="form_tongket" method="POST" action="index.php?fod=ad&act=tk_tc&exe=tk_tc&code=tk" onsubmit="return check_find(this)">
<p class="sub_Title1">
Ch&#7885;n n&#259;m T&agrave;i Ch&iacute;nh:
  <select class="form" name="nam_tongket">
  	<option value="0" selected>Ch&#7885;n n&#259;m t&agrave;i ch&iacute;nh</option>
<?php
if ($lst_finance_year_count>0){
	for ($i=0;$i<$lst_finance_year_count;$i++){
?>
	<option value="<?=$lst_finance_year['year'][$i]?>"><?=$lst_finance_year['year'][$i]?></option>
<?php
	}
}?>
  </select>
&nbsp;
 <input class="form" type="submit" name="tongket" value="T&#7893;ng k&#7871;t"> 
</p>
</form>

<p>S&#7889; li&#7879;u &#273;&#432;&#7907;c c&#7853;p nh&#7853;t m&#7899;i nh&#7845;t v&agrave;o l&uacute;c: <?=$last_update?></p>
<br> 

<form name="form_find" method="POST" action="index.php?fod=ad&act=tk_tc&exe=tk_tc&code=find">
<p class="sub_Title1">
T&igrave;m n&#259;m t&agrave;i ch&iacute;nh:
  <select class="form" name="find_year">
  	<option value="0" <? if ($find_year==0) echo 'selected';?>>T&#7845;t c&#7843;</option>
<?php
if ($lst_find_year_count>0){
	for ($i=0;$i<$lst_find_year_count;$i++){
?>
	<option value="<?=$lst_find_year['nam'][$i]?>" <? if ($find_year==$lst_find_year['nam'][$i]) echo 'selected';?>><?=$lst_find_year['nam'][$i]?></option>
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
		  	<td class="title1" width="32">N&#259;m</td>
			<td class="title1" width="39">Ti&#7873;n t&#7879;</td>
			<td class="title1" width="76" align="right">SD &#273;&#7847;u k&#7923;</td>
			<td class="title1" width="77" align="right">T&#7893;ng thu</td>
			<td class="title1" width="77" align="right">T&#7893;ng chi</td>
			<td class="title1" width="77" align="right">SD cu&#7889;i k&#7923;</td>
			<td class="title1" width="32" align="right">&nbsp;</td>
		  </tr>
<?php
if ($tongket_count>0){
	for ($i=0;$i<$tongket_count;$i++){
?>
		  <tr class="row_<?=$tongket['nam'][$i]%2?>">
			<td width="32" align="center"><?=$tongket["nam"][$i]?></td>
			<td width="39" ><?=$tongket["donvitien"][$i]?></td>
			<td width="76" align="right"><?=$tongket["sodu_dauky"][$i]?></td>
			<td width="77" align="right"><?=$tongket["tong_thu"][$i]?></td>
			<td width="77" align="right"><?=$tongket["tong_chi"][$i]?></td>
			<td width="77" align="right"><?=$tongket["sodu_cuoiky"][$i]?></td>
			<td width="32" align="center">
				<? if ($tongket["nam"][$i]==$max_year) { ?>
				<a href="index.php?fod=ad&act=tk_tc&exe=tk_tc&code=del&id=<?=$tongket['id_tongket'][$i]?>">X&oacute;a</a>
				<? } ?>
			</td>
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

