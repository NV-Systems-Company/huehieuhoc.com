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
<form name="update_donghanh" method="post" action="index.php?fod=ad&act=add_qc&exe=qc&code=add" enctype="multipart/form-data" >
<table width="375" border="0" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC">
	<tr>
		<td class="title1" colspan="2" align="center">C&#7853;p nh&#7853;t danh s&aacute;ch Qu&#7843;ng c&aacute;o</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp; </td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right" valign="top"><font class="yeucau">*</font>Logo qu&#7843;ng c&aacute;o:</td>
		<td width="60%">
			<input class=form type="file" name="logo" size="17"><br>
			<font class="ghichu">Y&ecirc;u c&#7847;u logo: 110  x 100pixel, 72dpi.</font>
		</td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right"><font class="yeucau">*</font>T&ecirc;n &#273;&#417;n v&#7883;:</td>
		<td width="60%"><input class="form" name="tendonvi" value="<?=$tendonvi?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right">Website:</td>
		<td width="60%"><input class="form" name="website" value="<?=$website?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td width="40%">&nbsp;</td>
		<td width="60%" height="35">
			<input class="submit" type="submit" name="submit" value="Add">
		</td>
	</tr>
</table>
</form>

</center>
