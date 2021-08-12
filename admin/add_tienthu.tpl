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
<form name="add_ungho" method="post" action="index.php?fod=ad&act=add_thu&exe=thuchi&code=addsm" enctype="multipart/form-data">
<input name="loaiphieu" type="hidden" value="T">
<table width="400" border="0" cellpadding="2" cellspacing="0" bgcolor="#FDFFCA">
	<tr>
		<td class="title1" colspan="2" align="center">Ph&aacute;t sinh Thu </td>
	</tr>
	<tr>
		<td colspan="2">&nbsp; </td>
	</tr>	
	<tr>
		<td class=textbody width="40%" align="right"><font class="yeucau">*</font>S&#7889; phi&#7871;u thu:</td>
		<td width="60%"><input class="form" name="so_phieu" value="<?=$so_phieu?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right" valign="top"><font class="yeucau">*</font>Ng&agrave;y thu:</td>
		<td width="60%"><input class="form" name="ngayphatsinh" value="<?=$ngayphatsinh?>" type="text" size="28">
		<p class="ghichu1">Nh&#7853;p theo d&#7841;ng: ng&agrave;y-th&aacute;ng-n&#259;m.<br>
	    V&iacute; du: 20-12-2006</p></td>
	</tr>
	<tr>
	  	<td class=textbody width="40%" align="right" valign="top"><font class="yeucau">*</font>Ng&#432;&#7901;i n&#7897;p:</td>
		<td width="60%" ><textarea class="form" name="nguoi_nop_nhan" cols="27"><?=$nguoi_nop_nhan?></textarea></td>
	</tr>
	<tr>
	  <td class=textbody width="40%" align="right" valign="top"><font class="yeucau">*</font>M&#7909;c &#273;&iacute;ch thu:</td>
		<td width="60%"><textarea class="form" name="lydo" cols="27"><?=$lydo?></textarea>	  </td>
	</tr>
	  <tr>
	  <td class=textbody width="40%" align="right"><font class="yeucau">*</font>S&#7889; ti&#7873;n</td>
		<td width="60%"><input class="form" name="sotien" value="<?=$sotien?>" type="text" id="tel" size="28"></td>
	</tr>
	<tr>
	  <td class=textbody width="40%" align="right"><font class="yeucau">*</font>Lo&#7841;i ti&#7873;n:</td>
		<td width="60%">
          <select class="form" name="id_loaitien">
			<option value="-1" selected>Ch&#7885;n &#273;&#417;n v&#7883; ti&#7873;n</option>
<?php
if ($lst_donvitien_count>0){
	for ($i=0;$i<$lst_donvitien_count;$i++){
?>
			<option value="<?=$lst_donvitien['id_loaitien'][$i]?>"><?=$lst_donvitien['donvitien'][$i]?></option>
<?php
	}
}?>
          </select>
		</td>
	</tr>			
	<tr>
		<td width="40%">&nbsp;</td>
		<td width="60%" height="35">
			<input class="submit" type="submit" name="submit" value="Add">&nbsp;
			<input class="submit" type="button" name="button" value="Cancel" onclick= window.open('index.php?fod=ad&act=lst_thu&exe=thuchi&code=list','_self')>
		</td>
	</tr>
	<tr>
		<td height="20"></td>
		<td></td>
	</tr>
</table>
</form>
</center>
