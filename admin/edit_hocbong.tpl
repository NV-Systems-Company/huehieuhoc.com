
<center>
<!--- Thong bao loi---->
<?php 
	$msg = isset($msg) ? $msg : '';
	if (trim($msg)!='')
	{?>
	<br>
	<table width="375" border="0" cellpadding="0" cellspacing="0" bgcolor="#FF0000">
		<tr>
			<td height="27" align="center" bgcolor="#CC3300" class="error">
				<font color="#FFFFFF"><strong>TH&Ocirc;NG B&Aacute;O L&#7894;I</strong></font>
			</td>
	    </tr>
	  	<tr>
    		<td width="100%">
				<table width="100%" border="0" cellpadding="10" cellspacing="1">
			    	<tr>
			        	<td bgcolor="#FFFFFF" class="error">
							<?echo $msg;?> 
						</td>
			     	</tr>
			    </table>
			</td>
	  	</tr>
  </table>
  <br>
<?}?>
<!--- ---->

<br>
<font class=box_Subject>THAY &#272;&#7892;I DANH S&Aacute;CH H&#7884;C B&#7892;NG</font>
<br>
<form method="POST" action="index.php?fod=ad&act=edit_hb&exe=hb&code=editsm&id=<?=$id?>" enctype="multipart/form-data">
<table border="0" width="481" cellspacing="5" cellpadding="0">
  <tr>
  	<td width="105" align="right" valign="top" class="name_item"><font class="yeucau">*</font>Tr&iacute;ch d&#7851;n:</td>
    <td width="376"><textarea class="form" name="hocbong" cols="54" rows="2"><?=$hocbong?></textarea>
	</td>
  </tr>
  <tr>
  	<td align="right" valign="top" class="name_item"><font class="yeucau">*</font>File h&#7885;c b&#7893;ng:</td>
    <td class="name_item">
		<input class=form type="file" name="file_hb" size="43"><br>
		<span class="ghichu">&#272;&#7875; tr&#7889;ng n&#7871;u kh&ocirc;ng thay &#273;&#7893;i file upload </span></td>
  </tr>
  <tr>
    <td class="name_item" align="center" colspan="2"><br>
		<input type="submit" name="submit" value="Thay &#273;&#7893;i">
		<input name="Cancel" type="button" value="H&#7911;y l&#7879;nh" onclick= window.open('javascript:history.go(-1);','_self');>
	</td>
  </tr>
</table>
</form>
</center>
