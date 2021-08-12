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
<form name="edit_tiente" method="post" action="index.php?fod=ad&act=edit_tt&exe=tiente&code=editsm&id=<?=$id_loaitien?>" enctype="multipart/form-data" >
<table width="375" border="0" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC">
	<tr>
		<td class="title1" colspan="2" align="center">Thay &#273;&#7893;i th&ocirc;ng tin &#273;&#417;n v&#7883; ti&#7873;n t&#7879;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp; </td>
	</tr>
	<tr>
		<td class=textbody width="40%" align="right"><font class="yeucau">*</font>T&ecirc;n &#273;&#417;n v&#7883; ti&#7873;n t&#7879;:</td>
		<td width="60%"><input class="form" name="donvitien" value="<?=$donvitien?>" type="text" size="28"></td>
	</tr>
	<tr>
		<td width="40%">&nbsp;</td>
		<td width="60%" height="35">
			<input class="submit" type="submit" name="submit" value="Save">&nbsp;
			<input class="submit" type="button" name="button" value="Cancel" onclick= window.open('index.php?fod=ad&act=dm_tiente&exe=tiente','_self')>
		</td>
	</tr>
</table>
</form>

</center>
