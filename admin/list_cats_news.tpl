
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
  <br>
<?}?>
<!--- ---->

<br>
<span class=Title>Chuy&ecirc;n m&#7909;c tin t&#7913;c</span ><br>
<form name="CATORDER" method="POST" action="index.php?fod=ad&act=cats_news&exe=news&code=save">
<input name="number_cats" type="hidden" value="<?=$cats_count?>">
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="4">
		  <tr class="header">
			<td width="12%" height="20">&#431;u ti&ecirc;n</td>
			<td width="80%" height="20">T&ecirc;n chuy&ecirc;n m&#7909;c</td>
			<td width="8%" height="20">X&oacute;a</td>
		  </tr>
		  <?php
			if ($cats_count<=0)
			{	?>
		  <tr class="row_content">
			<td colspan="4" align="center"><b>Kh&ocirc;ng c&oacute; chuy&ecirc;n m&#7909;c n&agrave;o</b></td>
		  </tr>
		  
		<?php
		}else
		{	
			for($i=0;$i<$cats_count;$i++)
			{
		?>
		  <tr class="row_content">
			<td width="12%" align="center">
				<input name="id_cat_<?=$i?>" type="hidden" value="<?=$cats['id_cat'][$i]?>">
				<input class="form1" name="cat_order_<?=$i?>" type="text" value="<?=$cats['cat_order'][$i]?>" size="2">
			</td>
			<td width="80%"><input class="form1" name="cat_name_<?=$i?>" type="text" value="<?=$cats['cat_name'][$i]?>" size="60"></td>
			<td width="8%" align="center"><?=$cats['del'][$i]?></td>
		  </tr>
		<?php }?>

		  <tr class="row_content">
			<td colspan="4" align="left"><input type="submit" name="submit" value="L&#432;u thay &#273;&#7893;i"></td>
		  </tr>
	<?php }?>
		</table>
    </td>
  </tr>
</table>
</form>

<br>
<form name="chuyenmuc" method="post" action="index.php?fod=ad&act=cats_news&exe=news&code=add" enctype="multipart/form-data" >
<table width="375" border="0" cellpadding="2" cellspacing="0" bgcolor="#DDEEDE">
	<tr class="header">
		<td align="center" colspan="2">Th&ecirc;m chuy&ecirc;n m&#7909;c tin t&#7913;c</td>
	</tr>
	<tr>
		<td height="10" colspan="2"></td>
	</tr>
	<tr>
		<td class="textbody" width="36%" align="right">
			<font class="yeucau">*</font>T&ecirc;n chuy&ecirc;n m&#7909;c: 
		</td>
		<td class="textbody" width="64%">
			<input class="form" name="cat_name" value="<?=$cat_name?>" type="text" size="35">		
		</td>
	</tr>
	<tr>
		<td class="textbody" width="36%" align="right">
			&#272;&#7897; &#432;u ti&ecirc;n: 
		</td>
		<td class="textbody" width="64%">
			<input class="form" name="cat_order" value="<?=$cat_order?>" type="text" size="15">		
		</td>
	</tr>
	<tr>
		<td height="10" colspan="2" align="center"><input type="submit" name="submit" value="Add"></td>
	</tr>
	<tr>
		<td height="10" colspan="2"></td>
	</tr>
</table>
</form>

</center>
