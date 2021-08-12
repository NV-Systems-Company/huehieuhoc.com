<center>
<br>
<br>
<!--- Thong bao loi---->
<?php 
	$msg = isset($msg) ? $msg : '';
	if (trim($msg)!='')
	{?>
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
<font class=box_Subject>&#272;&#258;NG K&Yacute; TH&Agrave;NH VI&Ecirc;N</font><br>
<br>
<form name="REG" method="post" action="index.php?fod=mem&act=reg&exe=reg&code=sm" enctype="multipart/form-data">
<table border="0" width="373"  cellspacing="0" cellpadding="1" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
		<table class=tb_news border="0" width="100%" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
			<tr>
			  	<td height="20"></td>
				<td></td>
			</tr>
			<tr>
			  	<td class=textbody width="40%" align="right"><font class="yeucau">*</font>T&ecirc;n &#273;&#259;ng nh&#7853;p:</td>
				<td width="60%"><input class="form" value="<?=$username?>" type="text" name="username" size="28"></td>
			</tr>
			<tr>
			  <td class=textbody width="40%" align="right"><font class="yeucau">*</font>M&#7853;t kh&#7849;u:</td>
				<td width="60%"><input class="form" value="<?=$password?>" type="password" name="password" size="28"></td>
			</tr>
			<tr>
			  <td class=textbody width="40%" align="right"><font class="yeucau">*</font>Nh&#7853;p l&#7841;i m&#7853;t kh&#7849;u:</td>
				<td width="60%"><input class="form" value="<?=$verifypass?>" type="password" name="verifypass" size="28"></td>
			</tr>
			<tr>
			  	<td class=textbody width="40%" align="right"><font class="yeucau">*</font>H&#7885; t&ecirc;n:</td>
				<td width="60%"><input class="form" value="<?=$realname?>" type="text" name="realname" size="28"></td>
			</tr>
			<tr>
			  	<td class=textbody width="40%" align="right">N&#259;m sinh:</td>
				<td width="60%"><input class="form" value="<?=$namsinh?>" type="text" name="namsinh" size="28"></td>
			</tr>
			<tr>
			  <td class=textbody width="40%" align="right" valign="top"><font class="yeucau">*</font>&#272;&#7883;a ch&#7881;:</td>
				<td width="60%"><textarea class="form" name="address" cols="27"><?=$address?></textarea></td>
			</tr>
			<tr>
			  <td class=textbody width="40%" align="right">Gi&#7899;i t&iacute;nh:</td>
				<td width="60%">
					<select class="form"  name="gender">
						<option value="1" <? if ($gender==1) echo 'selected'?>> Nam
						<option value="0" <? if ($gender==0) echo 'selected'?>> N&#7919;
					</select>
				</td>
			</tr>	
			<tr>
			  <td class=textbody width="40%" align="right">H&#7885;c v&#7845;n:</td>
				<td width="60%"><input class="form" value="<?=$education?>" name="education" type="text" size="28"></td>
			</tr>
			<tr>
			  <td class=textbody width="40%" align="right">Ngh&#7873; nghi&#7879;p</td>
				<td width="60%"><input class="form" value="<?=$job?>" name="job" type="text" size="28"></td>
			</tr>
			<tr>
				<td class=textbody width="40%" align="right"><font class="yeucau">*</font>Email:</td>
				<td width="60%"><input class="form" name="email" value="<?=$email?>" type="text" size="28"></td>
			</tr>
			<tr>
			  <td class=textbody width="40%" align="right">YM</td>
				<td width="60%"><input class="form" name="yim" value="<?=$yim?>" type="text" size="28"></td>
			</tr>
			<tr>
			  <td class=textbody width="40%" align="right">&#272;i&#7879;n tho&#7841;i</td>
				<td width="60%"><input class="form" name="tel" value="<?=$tel?>" type="text" id="tel" size="28"></td>
			</tr>
			<tr>
			  <td class=textbody width="40%" align="right">Fax</td>
				<td width="60%"><input class="form" name="fax" value="<?=$fax?>" type="text" size="28"></td>
			</tr>
			<tr>
			  <td class=textbody width="40%" align="right" valign="top">&#7842;nh th&agrave;nh vi&ecirc;n</td>
			  <td width="60%">
					<input class="form" name="picture" value="<?=$picture?>" type="file" size="16">
				  <p class="ghichu">K&iacute;ch th&#432;&#7899;c: 80 pixel x 100 pixel</p>				</td>
			</tr>
			<tr>
			  <td class=textbody width="40%" align="right">Che d&#7845;u email:</td>
				<td width="60%"><input class="form" name="hide_email" type="checkbox" value="1" <? if ($hide_email==1) echo 'checked'; ?> ></td>
			</tr>
			<tr>
				<td width="40%">&nbsp;</td>
				<td width="60%" height="35"><input class="submit" type="submit" name="submit" value="&#272;&#259;ng k&yacute;"></td>
			</tr>
			<tr>
			  	<td height="20"></td>
				<td></td>
			</tr>
		</table>
    </td>
  </tr>
</table>
</form>
</center>
