<center>
<!--- Thong bao loi---->
<?php 
	$msg = isset($msg) ? $msg : '';
	if (trim($msg)!='')
	{?>
	<br><br>
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
<?}?>
<!--- ---->

<br>
<br>
<form name="update_donghanh" method="post" action="index.php?fod=ad&act=edit_qc&exe=qc&code=smedit&id=<?=$id_quangcao?>" enctype="multipart/form-data" >
<table width="342" border="0" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC">
	<tr>
		<td class="title1" colspan="2" align="center">C&#7853;p nh&#7853;t danh s&aacute;ch Qu&#7843;ng c&aacute;o</td>
	</tr>
	<tr>
		<td colspan="2" height="5"></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<img src="<?=$logo?>" width="110" border="0">
			<input name="pic_logo" type="hidden" value="<?=$logo?>">
		</td>
	</tr>
	<tr>
		<td class=textbody width="30%" align="right" valign="top">Thay &#273;&#7893;i logo:</td>
		<td width="70%">
			<input class=form type="file" name="logo" size="17"><br>
			<font class="ghichu">- Y&ecirc;u c&#7847;u logo: 110  x 100pixel, 72dpi.<br>
			- &#272;&#7875; tr&#7889;ng ph&#7847;n n&agrave;y, n&#7871;u kh&ocirc;ng  thay &#273;&#7893;i logo.</font>
		</td>
	</tr>
	<tr>
		<td class=textbody width="30%" align="right"><font class="yeucau">*</font>T&ecirc;n &#273;&#417;n v&#7883;:</td>
		<td width="70%"><input class="form" name="tendonvi" value="<?=$tendonvi?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td class=textbody width="30%" align="right">Website:</td>
		<td width="70%"><input class="form" name="website" value="<?=$website?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td height="35" colspan="2" align="center">
			<input class="submit" type="submit" name="submit" value="Save">  
			<input class="submit" type="button" name="button" value="Cancel" onclick= window.open('index.php?fod=ad&act=man_qc&exe=qc&code=man','_self')>
		</td>
	</tr>
</table>
</form>

</center>
