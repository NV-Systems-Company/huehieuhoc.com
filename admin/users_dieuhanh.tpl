<script language="javascript">
	function check_form(the_form)
	{
		var the_id_user = the_form.id_user.value;
		var the_chucvu 	= the_form.chucvu.value;
	
		if (the_id_user==-1)
		{
			alert("Chua chon ten thanh vien!");
			the_form.id_user.focus();
			return false;
		}
		
		if (the_chucvu=='')
		{
			alert("Chua nhap chuc vu!");
			the_form.chucvu.focus();
			return false;
		}
	}
</script>

<br>
<br>
<font class=Title>Danh s&aacute;ch Ban gi&aacute;m &#273;&#7889;c &#273;i&#7873;u h&agrave;nh</font>
<br>
<br>
<form name="users_cv" action="index.php?fod=ad&act=memdh&exe=memdh&code=order" method="post">
<input type="hidden" name="users_dh_count" value="<?=$users_dh_count?>">
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="4">
		  <tr>
			<td class="title1" width="53">Th&#7913; t&#7921;</td>
			<td class="title1" width="165">H&#7885; v&agrave; t&ecirc;n</td>
			<td class="title1" width="136">Ch&#7913;c v&#7909;</td>
			<td class="title1" width="69">X&oacute;a</td>
		  </tr>
<?php
if ($users_dh_count>0){
	for ($i=0;$i<$users_dh_count;$i++){
?>
		  <tr>
		    <td class="content" width="53" align="center">
				<input type="hidden" name="id_dieuhanh_<?=$i?>" value="<?=$users_dh['id'][$i]?>">
				<input class=form name="order_num_<?=$i?>" value="<?=$users_dh['order_num'][$i]?>" size=4>
			</td>
			<td class="content" width="165"><?=$users_dh["realname"][$i]?></td>
			<td class="content" width="136"><?=$users_dh["chucvu"][$i]?></td>
			<td class="content" width="69"><a href="index.php?fod=ad&act=memdh&exe=memdh&code=del&id=<?=$users_dh['id'][$i]?>">X&oacute;a b&#7887;</a></td>
		  </tr>
<?php
	}
}
?>
		<tr>
		   <td class="content" colspan="4"><input class=submit type="submit" name="submit" value="L&#432;u th&#7913; t&#7921;"></td>
		  </tr>
		</table>
    </td>
  </tr>
</table>
</form>
<br>
<br>
<form name="dieuhanh" method="post" action="index.php?fod=ad&act=memdh&exe=memdh&code=add" enctype="multipart/form-data" onsubmit="return check_form(this)">
<table width="375" border="0" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC">
	<tr>
		<td class="title1" colspan="2" align="center">Th&ecirc;m th&agrave;nh vi&ecirc;n v&agrave;o Ban gi&aacute;m &#273;&#7889;c &#273;i&#7873;u h&agrave;nh</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp; </td>
	</tr>
	<tr>
		<td class=textbody width="111" align="right">H&#7885; t&ecirc;n:</td>
		<td width="264">
			<select class="form" name="id_user">
				<option value="-1" selected>Ch&#7885;n t&ecirc;n th&agrave;nh vi&ecirc;n</option>
<?php
if ($users_count>0){
	for ($i=0;$i<$users_count;$i++){
?>			
				<option value="<?=$users['id'][$i]?>"><?=$users['realname'][$i]?></option>
<?php
	}
}
?>
			</select>	  
		</td>
	</tr>
	<tr>
		<td class=textbody width="111" align="right">Ch&#7913;c v&#7909;:</td>
		<td width="264"><input class="form" type="text" name="chucvu" size="28"></td>
	</tr>
	<tr>
		<td class=textbody width="111" align="right">Th&#7913; t&#7921; &#432;u ti&ecirc;n:</td>
		<td width="264"><input class="form" type="text" name="order_num" size="5"></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input class="submit" type="submit" name="submit" value="add"></td>
	</tr>
</table>

</form>
