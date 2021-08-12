<br>
<br>
<font class=Title>Danh m&#7909;c ti&#7873;n t&#7879;</font>
<br>
<br>
<table border="0" width="375" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="375" cellspacing="1" cellpadding="4">
		  <tr>
			<td class="title1" width="20">TT</td>
			<td class="title1" width="249">T&ecirc;n &#273;&#417;n v&#7883; ti&#7873;n t&#7879;</td>
			<td class="title1" width="78" >&nbsp; </td>
		  </tr>
<?php
if ($tiente_count>0){
	for ($i=0;$i<$tiente_count;$i++){
?>
		  <tr class="row_content">
			<td width="20" align="right"><?=$i+1?></td>
			<td width="249"><?=$tiente["donvitien"][$i]?></td>
			<td width="78" align="center"><a href="index.php?fod=ad&act=edit_tt&exe=tiente&code=edit&id=<?=$tiente['id_loaitien'][$i]?>">S&#7917;a</a> : : <a href="index.php?fod=ad&act=dm_tiente&exe=tiente&code=del&id=<?=$tiente['id_loaitien'][$i]?>">X&oacute;a</a></td>
		  </tr>
<?php
	}
}
?>

		</table>
    </td>
  </tr>
</table>
<!-------------------------------------->

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
<form name="danhmuctien" method="post" action="index.php?fod=ad&act=dm_tiente&exe=tiente&code=add" enctype="multipart/form-data" >
<table width="375" border="0" cellpadding="2" cellspacing="0" bgcolor="#CCCCCC">
	<tr>
		<td class="title1" align="center">Th&ecirc;m &#273;&#417;n v&#7883; ti&#7873;n t&#7879; v&agrave;o danh m&#7909;c</td>
	</tr>
	<tr>
		<td height="10">&nbsp; </td>
	</tr>
	<tr>
		<td class="textbody" width="100%" align="center">
			<font class="yeucau">*</font>T&ecirc;n &#273;&#417;n v&#7883; ti&#7873;n t&#7879;: 
			<input class="form" name="donvitien" value="<?=$donvitien?>" type="text" size="15">
			&nbsp;
			<input class="submit" type="submit" name="submit" value="Add">
		</td>
	</tr>
	<tr>
		<td height="10">&nbsp; </td>
	</tr>
</table>
</form>

</center>
