
<script language="javascript">
	function check_form(the_form)
	{
		var the_username    = the_form.username.value;
		var the_password 	= the_form.password.value;
	
		if (the_username=='')
		{
			alert("Ten dang nhap chua co!");
			the_form.username.focus();
			return false;
		}
		
		if (the_password=='')
		{
			alert("Mat khau chua co!");
			the_form.password.focus();
			return false;
		}

	}
</script>

<center>
<br>
<br>
<font class=box_Subject>TH&Agrave;NH VI&Ecirc;N &#272;&#258;NG NH&#7852;P</font><br>
<br>
<form name="REG" method="post" action="index.php?fod=mem&exe=login" onsubmit="return check_form(this)">
<table border="0" width="345"  cellspacing="0" cellpadding="1" bgcolor="#CCCCCC">
  <tr>
    <td width="100%">
		<table class=tb_news border="0" width="100%" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
			<tr>
			  	<td height="20"></td>
				<td></td>
			</tr>
			<tr>
			  	<td class=textbody width="38%" align="right">T&ecirc;n &#273;&#259;ng nh&#7853;p:</td>
				<td width="62%"><input class="form" type="text" name="username" size="28"></td>
			</tr>
			<tr>
			  	<td class=textbody width="38%" align="right">M&#7853;t kh&#7849;u:</td>
				<td width="62%"><input class="form" type="password" name="password" size="28"></td>
			</tr>
			<tr>
				<td width="38%">&nbsp;</td>
				<td width="62%" height="35"><input class="submit" type="submit" name="submit" value="&#272;&#259;ng nh&#7853;p"></td>
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
