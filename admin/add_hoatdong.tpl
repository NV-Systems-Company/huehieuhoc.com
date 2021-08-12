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
<font class=box_Subject>C&#7852;P NH&#7852;T &#7842;NH HO&#7840;T &#272;&#7896;NG</font><br>

<form method="POST" action="index.php?fod=ad&act=add_hd&exe=hd&code=add" enctype="multipart/form-data">
<table border="0" width="481" cellspacing="5" cellpadding="0">
  <tr>
  	<td width="105" align="right" valign="top" class="name_item"><font class="yeucau">*</font>Ch&#7911; &#273;&#7875; <br>
  	  ch&ugrave;m &#7843;nh:</td>
    <td width="376"><textarea class="form" name="hoatdong" cols="54" rows="2"></textarea></td>
  </tr>
  <tr>
  	<td align="right" class="name_item"><font class="yeucau">*</font>File ho&#7841;t &#273;&#7897;ng:</td>
    <td><input class=form type="file" name="file_hd" size="43"></td>
  </tr>
  <tr>
    <td class="name_item" align="center" colspan="2"><br>
	<input type="submit" name="submit" value="G&#7917;i file">
	<input name="Cancel" type="button" value="H&#7911;y l&#7879;nh" onclick= window.open('javascript:history.go(-1);','_self');></td>
  </tr>
</table>
</form>

<hr size="1">
<table width="481" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td><p align="center"><strong>H&#431;&#7898;NG D&#7850;N C&Aacute;CH &#272;&#431;A &#7842;NH HO&#7840;T &#272;&#7896;NG L&Ecirc;N WEB</strong></p>
    <p><strong>B&#432;&#7899;c 1: </strong><br>
    T&#7843;i file <a href="./anhhoatdong/upload.zip"><strong>upload.zip</strong></a> xu&#7889;ng v&agrave; x&#7843; n&eacute;n ta s&#7869; c&oacute; m&#7897;t th&#432; m&#7909;c upload. Trong th&#432; m&#7909;c upload n&agrave;y c&oacute; ch&#7913;a file <strong>anhupload.htm</strong> v&agrave; th&#432; m&#7909;c<strong> file_hd</strong>.</p>
    <p>&nbsp;</p>    <p><strong>B&#432;&#7899;c 2:</strong> <em><strong>Chu&#7849;n b&#7883; &#7843;nh</strong></em><br>
    - X&#7917; l&yacute; nh&#7919;ng &#7843;nh d&ugrave;ng &#273;&#7875; &#273;&#432;a l&ecirc;n web c&oacute; k&iacute;ch th&#432;&#7899;c nh&#432; sau: ngang <strong>250pixel</strong>, cao t&ugrave;y thu&#7897;c v&agrave;o h&igrave;nh &#7843;nh.<br>
    - Copy to&agrave;n b&#7897; &#7843;nh c&#7847;n &#273;&#432;a l&ecirc;n web v&agrave;o th&#432; m&#7909;c <strong>img_upload</strong> n&#7857;m trong th&#432; m&#7909;c file_hd v&#7915;a x&#7843; n&eacute;n &#7903; B&#432;&#7899;c 1.</p>
    <p>&nbsp;</p>
    <p><strong>B&#432;&#7899;c 3:</strong> <em><strong>D&agrave;n b&#7889; c&#7909;c &#7843;nh theo file m&#7851;u</strong></em><br>
        D&ugrave;ng Microsoft FrontPage m&#7903; file <strong>anhupload.htm</strong> v&agrave; thay th&#7871; c&aacute;c &#7843;nh m&#7851;u  b&#7857;ng nh&#7919;ng &#7843;nh c&#7847;n &#273;&#432;a l&ecirc;n net v&#7915;a copy v&agrave;o th&#432; m&#7909;c img_upload &#7903; B&#432;&#7899;c 2 v&agrave; cho ch&uacute; th&iacute;ch t&#432;&#417;ng &#7913;ng v&#7899;i &#7843;nh &#273;&#432;a v&agrave;o. N&#7871;u h&igrave;nh &#7843;nh nhi&#7873;u h&#417;n b&#7889; c&#7909;c m&#7851;u th&igrave; ch&egrave;n th&ecirc;m c&aacute;c cell &#273;&#7875; &#273;&#432;a &#7843;nh v&agrave;o. Save l&#7841;i.</p>    <p>&nbsp;</p>
        <p><strong>B&#432;&#7899;c 4:</strong> <strong><em>&#272;&#432;a file anhupload.htm l&ecirc;n m&#7841;ng</em></strong><br>
          Ch&#7885;n menu <strong>C&#7853;p nh&#7853;t &#7843;nh H&#272;</strong>. Nh&#7853;p ch&#7911; &#273;&#7873; ch&ugrave;m &#7843;nh, ch&#7885;n file anhupload.htm v&#7915;a m&#7899;i l&agrave;m l&#7841;i xong. Click n&uacute;t g&#7917;i file.</p>      <p>&nbsp;</p>
          <p><strong>B&#432;&#7899;c 5:</strong> <em><strong>Upload c&aacute;c &#7843;nh ho&#7841;t &#273;&#7897;ng l&ecirc;n m&#7841;ng</strong></em><br>
    Ch&#7885;n menu <strong>Upload h&igrave;nh &#7843;nh</strong>. Ch&#7885;n c&aacute;c file &#7843;nh trong th&#432; m&#7909;c img_upload &#273;&#7875; t&#7843;i l&ecirc;n m&#7841;ng.</p></td>
  </tr>
</table>