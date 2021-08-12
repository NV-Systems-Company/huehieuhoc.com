<style type="text/css">
<!--
.style1 {
	font-family: "Times New Roman", Times, serif;
	font-size: 16px;
	font-weight: bold;
	color: #FF6600;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
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


<br><br>
<form name="CONTACT" method="post" action="index.php?fod=contact&act=ct&exe=ct&code=send" enctype="multipart/form-data">
<table border="0" width="400" cellspacing="0" cellpadding="0">
  <tr>
	<td width="100%" align="left" valign="bottom"><img src="./contact/images/lyric_bg_top.gif" width="400" height="21" border="0" align="bottom"></td>
  </tr>
  <tr>
    <td height="363" align="right" background="./contact/images/lyric_bg.gif">
		<table border="0" width="360" cellspacing="0" cellpadding="2">
		  <tr align="center">
			<td height="38" colspan="2"><span class="style1">LI&Ecirc;N L&#7840;C CH&Uacute;NG T&Ocirc;I</span></td>
		  </tr>
		  <tr>
			<td width="25%" align="right" valign="top" class="style2"><font class="yeucau">*</font><span class="style2">T&ecirc;n c&#7911;a b&#7841;n</span>:</td>
			<td width="75%"><input class="form" type="text" name="name" size="40"></td>
		  </tr>
		  <tr>
			<td width="25%" align="right" valign="top" class="style2"><font class="yeucau">*</font>&#272;&#7883;a ch&#7881;:</td>
			<td width="75%"><textarea class="form" name="address" cols="39" rows="2"></textarea></td>
		  </tr>
		  <tr>
			<td width="25%" align="right" valign="top" class="style2"><span class="style2">&#272;i&#7879;n tho&#7841;i</span>:</td>
			<td width="75%"><input class="form" type="text" name="tel" size="40"></td>
		  </tr>
		  <tr>
			<td width="25%" align="right" class="style2"><font class="yeucau">*</font><span class="style2">Email</span>:</td>
			<td width="75%"><input class="form" type="text" name="email" size="40"></td>
		  </tr>
		  <tr>
			<td width="25%" align="right" valign="top" class="style2"><font class="yeucau">*</font>N&#x1ED9;i dung th&ocirc;ng tin:</td>
			<td width="75%"><textarea class="form" name="content" cols="39" rows="12"></textarea></td>
		  </tr>
		  <tr>
			<td width="25%">&nbsp;</td>
			<td width="75%" height="35"><input type="submit" name="submit" value="G&#7917;i th&ocirc;ng tin"></td>
		  </tr>
		</table>
	</td>
  </tr>
  <tr>
	<td height="18" align="left" valign="top"><img src="./contact/images/lyric_bg_bottom.gif" width="400" height="18" border="0" align="top"></td>
  </tr>
</table>
</form>

<br><hr size="1">
<table width="480" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td><p><strong>&#8226; &#272;&#7882;A CH&#7880; LI&Ecirc;N L&#7840;C: </strong></p>
      <p align="center">Ng&#432;&#7901;i nh&#7853;n: <strong>B&#7842;O K&#7922;</strong></p>
      <p align="center">72/23 &#x110;&#x1B0;&#x1EDD;ng s&#x1ED1; 4, Ph&#432;&#7901;ng Hi&#7879;p B&#236;nh Ph&#432;&#7899;c, Qu&#7853;n Th&#x1EE7; &#x110;&#x1EE9;c, TP. H&#7891; Ch&iacute; Minh, Vi&#7879;t Nam.</p>
      <p align="center"> &#272;i&#7879;n tho&#7841;i: (84.8) 37273942 - Di &#273;&#7897;ng: (84) 923 99 88 79 - Fax:(84.8) 37273942</p>
      <p align="center">&nbsp;</p>
      <p align="left"><strong>&#8226; TH&Ocirc;NG TIN T&Agrave;I KHO&#7842;N</strong></p>      <p align="center">T&ecirc;n &#273;&#417;n v&#7883;: <strong>QU&#7928; GI&Aacute;O D&#7908;C HU&#7870; HI&#7870;U H&#7884;C</strong></p>
    <p align="center">S&#7889; t&agrave;i kho&#7843;n<strong>: - VN&#272;:</strong> 22415479. <strong>- USD:</strong> 22415509</p>
    <p align="center"><strong> Ng&acirc;n H&agrave;ng C&#7893; Ph&#7847;n Th&#432;&#417;ng M&#7841;i &Aacute; Ch&acirc;u (ACB) CN H&#x1ED3; V&#x103;n Hu&ecirc;, TP HCM, Vi&#7879;t Nam</strong></p></td>
  </tr>
</table>

