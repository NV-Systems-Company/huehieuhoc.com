
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
<form name="editmember" method="post" action="index.php?fod=mem&act=infmy&exe=infmy&code=edit" enctype="multipart/form-data">
<table border="0" width="300" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%">
			<table border="0" width="100%" cellspacing="0" cellpadding="3" bgcolor="#FFFFFF">
				<tr>
					<td class="content" colspan="2"align="center">	
						<table border="0" width="80" height="100" cellspacing="0" cellpadding="0">
							<tr>
								<td width="100%">
									<img src="<?=$user['picture']?>" width="80" height="100">
									<input name="old_picture" type="hidden" value="<?=$user['picture']?>">
								</td>
							</tr> 
						</table>
						 Gia nh&#7853;p ng&agrave;y <?=$user['join_date']?>
					</td>
				</tr>
				<tr>
					<td class=textbody width="34%" align="right">&#272;&#7893;i &#7843;nh:</td>
					<td width="66%">
						<input class="form" name="picture" type="file" size="16">
					</td>
				</tr>
				<tr>
					<td></td>
					<td class="ghichu">&#272;&#7875; tr&#7889;ng n&#7871;u kh&ocirc;ng thay &#273;&#7893;i</td>
				</tr>
				<tr>
					<td class=textbody width="34%" align="right"></td>
					<td width="66%"><p>&nbsp; </p></td>
				</tr>
				<tr>
				    <td class=textbody width="34%" align="right"><font class="yeucau">*</font>H&#7885; t&ecirc;n:</td>
					<td width="66%"><input class="form" value="<?=$user['realname']?>" type="text" name="realname" size="28"></td>
				</tr>
				<tr>
				    <td class=textbody width="34%" align="right">N&#259;m sinh:</td>
					<td width="66%"><input class="form" value="<?=$user['namsinh']?>" type="text" name="namsinh" size="28"></td>
				</tr>
				<tr>
				  <td class=textbody width="34%" align="right" valign="top"><font class="yeucau">*</font>&#272;&#7883;a ch&#7881;:</td>
					<td width="66%"><textarea class="form" name="address" cols="27"><?=$user['address']?></textarea></td>
				</tr>
				<tr>
				  <td class=textbody width="34%" align="right">Gi&#7899;i t&iacute;nh:</td>
					<td width="66%">
						<select class="form"  name="gender">
							<option value="1" <? if ($user['gender']==1) echo 'selected'?>> Nam
							<option value="0" <? if ($user['gender']==0) echo 'selected'?>> N&#7919;
						</select>
					</td>
				</tr>
				<tr>
				  <td class=textbody width="34%" align="right">T&ecirc;n &#273;&#259;ng nh&#7853;p:</td>
					<td width="66%"><input disabled class="form" value="<?=$user['username']?>" name="username" type="text" size="28"></td>
				</tr>
				<tr>
				  <td class=textbody width="34%" align="right">M&#7853;t kh&#7849;u:</td>
					<td width="66%"><input class="form" value="" name="password" type="text" size="28"></td>
				</tr>
				<tr>
					<td></td>
					<td class="ghichu" height="30" valign="top">&#272;&#7875; tr&#7889;ng n&#7871;u kh&ocirc;ng thay &#273;&#7893;i</td>
				</tr>
				<tr>
				  <td class=textbody width="34%" align="right">H&#7885;c v&#7845;n:</td>
					<td width="66%"><input class="form" value="<?=$user['education']?>" name="education" type="text" size="28"></td>
				</tr>
				<tr>
				  <td class=textbody width="34%" align="right">Ngh&#7873; nghi&#7879;p</td>
					<td width="66%"><input class="form" value="<?=$user['job']?>" name="job" type="text" size="28"></td>
				</tr>
				<tr>
					<td class=textbody width="34%" align="right"><font class="yeucau">*</font>Email:</td>
					<td width="66%"><input class="form" name="email" value="<?=$user['email']?>" type="text" size="28"></td>
				</tr>
				<tr>
				  <td class=textbody width="34%" align="right">YM</td>
					<td width="66%"><input class="form" name="yim" value="<?=$user['yim']?>" type="text" size="28"></td>
				</tr>
				<tr>
				  <td class=textbody width="34%" align="right">&#272;i&#7879;n tho&#7841;i</td>
					<td width="66%"><input class="form" name="tel" value="<?=$user['tel']?>" type="text" id="tel" size="28"></td>
				</tr>
				<tr>
				  <td class=textbody width="34%" align="right">Fax</td>
				<td width="66%"><input class="form" name="fax" value="<?=$user['fax']?>" type="text" size="28"></td>
				</tr>
				<tr>
				  <td class=textbody width="34%" align="right">Che d&#7845;u email:</td>
					<td width="66%"><input class="form" name="hide_email" type="checkbox" value="1" <? if ($user['hide_email']==1) echo 'checked'; ?> ></td>
				</tr>
				<tr>
					<td width="34%">&nbsp;</td>
					<td width="66%" height="35">
						<input class="submit" type="submit" name="submit" value="Save">
						<input class="submit" type="submit" name="submit" value="Cancel">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</center>
