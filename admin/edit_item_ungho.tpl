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
<form name="add_ungho" method="post" action="index.php?fod=ad&act=edit_uh&exe=uh&code=editsm" enctype="multipart/form-data">
<input name="id_ungho" type="hidden" value="<?=$id_ungho?>">
<table width="400" border="0" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC">
	<tr>
		<td class="title1" colspan="2" align="center">Thay &#273;&#7893;i th&ocirc;ng tin &#7910;ng h&#7897;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp; </td>
	</tr>			
	<tr>
		<td class=textbody width="40%" align="right"><font class="yeucau">*</font>&#272;&#7889;i t&#432;&#7907;ng &#7911;ng h&#7897;:</td>
		<td width="60%">
			<select class="form"  name="canhan_donvi">
				<option value="-1"<? if ($canhan_donvi==-1) echo 'selected'?>> Ch&#7885;n &#273;&#7889;i t&#432;&#7907;ng &#7911;ng h&#7897;</option>
				<option value="1" <? if ($canhan_donvi==1) echo 'selected'?>> T&#7893; ch&#7913;c</option>
				<option value="0" <? if ($canhan_donvi==0) echo 'selected'?>> C&aacute; nh&acirc;n</option>
			</select>
		</td>
	</tr>	
	<tr>
		<td class=textbody width="40%" align="right" valign="top"><font class="yeucau">*</font>Ng&agrave;y &#7911;ng h&#7897;:</td>
		<td width="60%"><input class="form" name="ngay" value="<?=$ngay?>" type="text" size="28">
		<p class="ghichu1">Nh&#7853;p theo d&#7841;ng: ng&agrave;y-th&aacute;ng-n&#259;m.<br>
	    V&iacute; du: 20-12-2006</p></td>
	</tr>
	<tr>
	  <td class=textbody width="40%" align="right" valign="top"><font class="yeucau">*</font>T&ecirc;n &#273;&#417;n v&#7883;, c&aacute; nh&acirc;n:</td>
		<td width="60%"><textarea class="form" name="nguoiungho" cols="27"><?=$nguoiungho?></textarea>	  </td>
	</tr>
	<tr>
	  <td class=textbody width="40%" align="right" valign="top"><font class="yeucau">*</font>&#272;&#7883;a ch&#7881;:</td>
		<td width="60%"><textarea class="form" name="address" cols="27"><?=$address?></textarea></td>
	</tr>
	<tr>
	  <td class=textbody width="40%" align="right">Website:</td>
		<td width="60%"><input class="form" name="website" value="<?=$website?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right">Email:</td>
		<td width="60%"><input class="form" name="email" value="<?=$email?>" type="text" size="28"></td>
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
	  <td class=textbody width="40%" align="right">YIM</td>
		<td width="60%"><input class="form" name="yim" value="<?=$yim?>" type="text" size="28"></td>
	</tr>
	<tr>
	  <td class=textbody width="40%" align="right" valign="top"><font class="yeucau">*</font>&#7910;ng h&#7897;:</td>
		<td width="60%"><textarea class="form" name="ungho" cols="27"><?=$ungho?></textarea></td>
	</tr>
	<tr>
	  <td class=textbody width="40%" align="right">Link tin t&#7913;c:</td>
		<td width="60%"><input class="form" name="link_news" value="<?=$link_news?>" type="text" size="28"></td>
	</tr>			
	<tr>
		<td width="40%">&nbsp;</td>
		<td width="60%" height="35">
			<input class="submit" type="submit" name="submit" value="Save">
			<input class="submit" type="button" name="buton" value="Cancel" onclick= window.open('index.php?fod=ad&act=lst_uh&exe=uh&code=list','_self')>
		</td>
	</tr>
	<tr>
		<td height="20"></td>
		<td></td>
	</tr>
</table>
</form>
</center>
