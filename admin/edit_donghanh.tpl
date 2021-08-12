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
<form name="update_donghanh" method="post" action="index.php?fod=ad&act=edit_dh&exe=edit_dh&code=save&id=<?=$id_donghanh?>" enctype="multipart/form-data" >
<table width="375" border="0" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC">
	<tr>
		<td class="title1" colspan="2" align="center">Thay &#273;&#7893;i th&ocirc;ng tin &#273;&#417;n v&#7883; &#272;&#7891;ng H&agrave;nh</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp; </td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right"><font class="yeucau">*</font>T&ecirc;n &#273;&#417;n v&#7883; t&#7893; ch&#7913;c:</td>
		<td width="60%"><input class="form" name="ten_donghanh" value="<?=$ten_donghanh?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right" valign="top"><font class="yeucau">*</font>&#272;&#7883;a ch&#7881;:</td>
		<td width="60%"><textarea class="form" name="address" cols="27"><?=$address?></textarea></td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right">&#272;i&#7879;n tho&#7841;i:</td>
		<td width="60%"><input class="form" name="tel" value="<?=$tel?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right">Fax:</td>
		<td width="60%"><input class="form" name="fax" value="<?=$fax?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right">Email:</td>
		<td width="60%"><input class="form" name="email" value="<?=$email?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right">Website:</td>
		<td width="60%"><input class="form" name="website" value="<?=$website?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right">&#272;&#7897; &#432;u ti&ecirc;n:</td>
		<td width="60%"><input class="form" name="num_order" value="<?=$num_order?>" type="text" size="8"></td>
	</tr>
	<tr>
		<td width="40%">&nbsp;</td>
		<td width="60%" height="35">
			<input class="submit" type="submit" name="submit" value="Save">&nbsp;
			<input class="submit" type="button" name="button" value="Cancel" onclick= window.open('index.php?fod=ad&act=up_dh&exe=up_dh','_self')>
		</td>
	</tr>
</table>
</form>

</center>
