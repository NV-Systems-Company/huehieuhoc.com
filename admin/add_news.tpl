<script language="javascript">
function readyDiv() 
{
	var theHTML;
	theHTML = document.all.tags('div')['message'].innerText;
	document.all.tags('div')['message'].innerHTML = theHTML;
}

function cmdExec(cmd,opt) 
{
	document.body.all.tags('div')['content_detail'].focus();
	content_detail.document.execCommand(cmd,"",opt);
}

function createLink() 
{
	cmdExec("CreateLink");
}

function insertImage() 
{
	var sImgSrc = prompt("Image: ", "http://");
	if(sImgSrc!=null)
		cmdExec("InsertImage",sImgSrc);
}

function div2hidden(objForm) 
{
	objForm.content_detail.value = document.all.tags('div')['content_detail'].innerHTML;
}

</script>

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
<span class=Title>&#272;&#259;ng tin</span>
<br>
<!------
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%">
	<table class=vietkey border="0" width="100%" cellspacing="0" cellpadding="1">
	  <tr>
	    <td width="100%" height="10" class="small_Title" align="center">
		<script language="JavaScript1.2" src="./js/vietuni.js" type='text/javascript'></script> 
		<input type=radio name="switcher" value="OFF" checked onfocus="setTypingMode(0)">T&#7855;t b&#7897; g&otilde; 
		<input type=radio name="switcher" value="TELEX" onfocus="setTypingMode(1)"> Telex 
		<input type=radio name="switcher" value="VNI" onfocus="setTypingMode(2)"> VNI 
		<input type=radio name="switcher" value="VIQR" onfocus="setTypingMode(3)"> VIQR 
		<input type=radio name="switcher" value="ALL" onfocus="setTypingMode(4)"> Tu&#7923; &yacute; (c&#7843; 3 ki&#7875;u) 
		</td>
	  </tr>
	</table>

    </td>
  </tr>
</table>
----->
	
<form method="POST" action="index.php?fod=ad&act=add_news&exe=news&code=postsm" onsubmit="return div2hidden(this);" enctype="multipart/form-data">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="name_item">&nbsp;</td>
  </tr>
  <tr>
    <td width="43%" class="name_item">Ngu&#7891;n tin :<br>
      <input class="form" type="text" name="nguontin" value="<?=$nguontin?>" size="30"></td>
    <td width="57%" class="name_item">Link ngu&#7891;n tin :<br>
      http://<input class="form" type="text" name="link_nguontin" value="<?=$link_nguontin?>" size="34"></td>
  </tr>
  <tr>
    <td colspan="2" class="name_item"><br>
	<font class="yeucau">*</font>Ti&ecirc;u &#273;&#7873;:<br><input class="form" type="text" name="title" value="<?=$title?>" size="75"></td>
  </tr>
  <tr>
    <td colspan="2" class="name_item"><br>
    <font class="yeucau">*</font>Tr&iacute;ch &#273;o&#7841;n  n&#7897;i dung:<br>
    <textarea class="form" name="content_desc" cols="75" rows="10"><?=$content_desc?></textarea></td>
  </tr>
  <tr>
    <td colspan="2"  class="name_item"><br>
    N&#7897;i dung chi ti&#7871;t:<br>
    <!--<textarea class="form" name="content_detail" cols="75" rows="2"><?=$content_detail?></textarea><br>-->
	
		<table>
			<tr height=23>
				<td width=23><a href="javascript:cmdExec('cut')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_cut.gif" alt="Ctrl + X"></a></td>
				<td width=23><a href="javascript:cmdExec('copy')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_copy.gif" alt="Ctrl + C"></a></td>
				<td width=23><a href="javascript:cmdExec('paste')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_paste.gif" alt="Ctrl + V"></a></td>
				<td width=23><a href="javascript:cmdExec('bold')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_bold.gif" alt="Ctrl + B"></a></td>
				<td width=23><a href="javascript:cmdExec('italic')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_italic.gif" alt="Ctrl + I"></a></td>
				<td width=23><a href="javascript:cmdExec('underline')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_underline.gif" alt="Ctrl + U"></a></td>
				<td width=23><a href="javascript:cmdExec('justifyleft')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_left_just.gif" alt="Can le trai"></a></td>
				<td width=23><a href="javascript:cmdExec('justifycenter')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_center_just.gif" alt="Can le giua"></a></td>
				<td width=23><a href="javascript:cmdExec('justifyright')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_right_just.gif" alt="Can le phai"></a></td>
				<td width=23><a href="javascript:cmdExec('insertorderedlist')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_order_list.gif" alt="So thu tu"></a></td>
				<td width=23><a href="javascript:cmdExec('insertunorderedlist')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_list.gif" alt="Danh sach"></a></td>
				<td width=23><a href="javascript:cmdExec('outdent')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_outdent.gif" alt="Vao trong"></a></td>
				<td width=23><a href="javascript:cmdExec('indent')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_indent.gif" alt="Ra truoc"></a></td>
				<td width=23><a href="javascript:cmdExec('createLink')"><img width=23 height=23 border=0 hspace=1 src="images/editor/post_button_hyperlink.gif" alt="Ctrl + K"></a></td>
				<td width=23><a href="javascript:insertImage()"><img width=23 height=23 border=0 hspace=1 align="absmiddle" src="images/editor/post_button_image.gif" alt="Chen hinh tu URL"></a></td>
				
			<!------------- editor ----------------->
			<tr>
				<td colspan=15>
					<input type=hidden name='content_detail' value="">
					<div class="news_editer" contentEditable=true id=content_detail name=content_detail style="width:468px;height:200px;overflow:auto;" type=div><?=$content_detail?></div>
				</td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
    <td colspan="2" class="name_item"><br>H&igrave;nh s&#7917; d&#7909;ng cho b&agrave;i vi&#7871;t:<br><input class=form type="file" name="imgfile" size="64"></td>
  </tr>
  <tr>
  <td colspan="2" class="name_item"><br>
    T&aacute;c gi&#7843;:<br>
    <input class="form" type="text" name="author" value="<?=$author?>" size="35"></td>
  </tr>
<!----
  <tr>
    <td colspan="2" class="name_item">
<br><font class="yeucau">*</font>M&#7909;c tin:<br>
<SELECT class="form" name="id_cat[]" size=3 multiple>

<?php
if ($cats_count>0)
{
	for($i=0;$i<$cats_count;$i++)
	{

?>
 <OPTION value="<?=$cats['id_cat'][$i]?>" <? if (check_option($cats['id_cat'][$i])) echo "selected"; ?>><?=$cats['cat_name'][$i]?></OPTION>
<?php
	}
}
?>

</SELECT>
<br/>
<span class="ghichu1">(C&oacute; th&#7875; ch&#7885;n nhi&#7873;u chuy&ecirc;n m&#7909;c tin b&#7857;ng c&aacute;ch gi&#7919; ph&iacute;m Ctrl r&#7891;i click chu&#7897;t &#273;&#7875; ch&#7885;n)</span>

	</td>
  </tr>
----->
  <tr>
    <td colspan="2" class="name_item" align="center"><br><br><input type="submit" name="submit" value="G&#7917;i tin"></td>
  </tr>
</table>
</form>
</center>
