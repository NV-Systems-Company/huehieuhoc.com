
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
				<font color="#FFFFFF"><strong>TH&Ocirc;NG B&Aacute;O</strong></font></td>
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
<font class=box_Subject>UPLOAD FILE &#7842;NH HO&#7840;T &#272;&#7896;NG</font><br>

<form method="POST" action="index.php?fod=ad&act=up_hd&exe=hd&code=img_up" enctype="multipart/form-data">
<table border="0" width="481" cellspacing="5" cellpadding="0">
  <tr>
  	<td width="105" align="right" class="name_item">File 1:</td>
    <td width="376"><input class=form type="file" name="file1" size="43"></td>
  </tr>
  <tr>
  	<td width="105" align="right" class="name_item">File 2:</td>
    <td width="376"><input class=form type="file" name="file2" size="43"></td>
  </tr>
  <tr>
  	<td width="105" align="right" class="name_item">File 3:</td>
    <td width="376"><input class=form type="file" name="file3" size="43"></td>
  </tr>
  <tr>
  	<td width="105" align="right" class="name_item">File 4:</td>
    <td width="376"><input class=form type="file" name="file4" size="43"></td>
  </tr>
  <tr>
  	<td width="105" align="right" class="name_item">File 5:</td>
    <td width="376"><input class=form type="file" name="file5" size="43"></td>
  </tr>
  <tr>
    <td class="name_item" align="center" colspan="2"><br>
	<input type="submit" name="submit" value="G&#7917;i file">
	<input name="Cancel" type="button" value="H&#7911;y l&#7879;nh" onclick= window.open('javascript:history.go(-1);','_self');></td>
  </tr>
</table>
</form>
</center>
