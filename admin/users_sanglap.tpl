<br>
<br>
<font class=Title>C&#7853;p nh&#7853;t danh s&aacute;ch th&agrave;nh vi&ecirc;n s&aacute;ng l&#7853;p</font>
<br>
<form name="sanglap" method="post" action="index.php?fod=ad&act=memslp&exe=memslp" enctype="multipart/form-data">
<table width="375" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="title1" width="140" align="right"> Th&agrave;nh vi&ecirc;n</td>
		<td width="87" align="center">	</td>
		<td class="title1" width="148">Th&agrave;nh vi&ecirc;n s&aacute;ng l&#7853;p</td>
	</tr>
	<tr>
		<td width="140" align="right">
			<select class="form" name="id_members[]" size="20" multiple style="z-index:-1">
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
		<td width="87" align="center" valign="middle">
			<p>
				<input class="submit" type="submit" name="submit" value=">>">
			</p>
			  <p>&nbsp; </p>
			<p>
				<input class="submit" type="submit" name="submit" value="<<">
	  </p>	  </td>
		<td width="148">
			  <select class="form" name="id_members_sl[]" size="20" multiple>
<?php
if ($users_sanglap_count>0){
	for ($i=0;$i<$users_sanglap_count;$i++){
?>		
			  	<option value="<?=$users_sanglap['id'][$i]?>"><?=$users_sanglap['realname'][$i]?></option>
<?php
	}
}
?>
			  </select>	  	  
		</td>
	</tr>
</table>
</form>
