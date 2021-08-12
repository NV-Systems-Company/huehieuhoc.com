<script language="JavaScript">
<!--
//---Editor----
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

//----------------------
function setURL(form,url,wd)
{
    form.action = url;
	form.target = wd;
}

function getpathfile(idget,idpos)
{
   idpos.value = idget.value;
}
//-->
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
<span class=Title>Ki&#7875;m tra tin</span>
<br>
<form name="form_news" method="POST" action="" onsubmit="return div2hidden(this);" enctype="multipart/form-data">
<table border="0" width="481" cellspacing="0" cellpadding="0">
  <tr>
    <td class="name_item" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="43%" class="name_item">Ngu&#7891;n tin :<br>
      <input class="form" type="text" name="nguontin" value="<?=$nguontin?>" size="30"></td>
    <td width="57%" class="name_item">Link ngu&#7891;n tin :<br>
      http://<input class="form" type="text" name="link_nguontin" value="<?=$link_nguontin?>" size="34"></td>
  </tr>
  <tr>
    <td class="name_item" colspan="2"><br>
	<font class="yeucau">*</font>Ti&ecirc;u &#273;&#7873;:<br><input class="form" type="text" name="title" value="<?=$title?>" size="75"></td>
  </tr>
  <tr>
    <td class="name_item" colspan="2"><br>
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
    <td width="206" class="name_item"><br>
		<?=$v_img?>
	</td>
    <td width="275" align="left" valign="bottom" class="name_item"><br>
		H&igrave;nh cho b&agrave;i vi&#7871;t <br>
		<em>(Kh&ocirc;ng ch&#7885;n m&#7909;c n&agrave;y n&#7871;u kh&ocirc;ng thay h&igrave;nh)</em>:<br>
		<input class="form" type="file" name="imgfile" size="30" onChange="getpathfile(this,v_img)">	
		<input name="v_img" type="hidden" value="">
	</td>
  </tr>
  <tr>
  <td class="name_item" colspan="2"><br>
    T&aacute;c gi&#7843;:
    <input class="form" type="text" name="author" value="<?=$author?>" size="35"></td>
  </tr>
<!-----
  <tr>
    <td class="name_item" colspan="2">
<br><font class="yeucau">*</font>M&#7909;c tin:<br>
<SELECT  name="id_cat[]" size=3 multiple>
<?php
if ($cats_count>0)
{
	for($i=0;$i<$cats_count;$i++)
	{ ?>
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
 ------->
  <tr>
	 <td class="name_item" colspan="2"><br>
    	&#272;&#7891;ng &yacute; s&#7917; d&#7909;ng tin n&agrave;y: 
    	  <input name="approve" type="checkbox" value="1" <? if($approve==1) echo 'checked' ?>>
	 </td>
  </tr>
  <tr>
	 <td class="name_item" colspan="2"><br>
    	Hi&#7879;n l&#7841;i tin n&agrave;y l&ecirc;n trang ch&#7911;: 
    	  <input name="re_appear_home" type="checkbox" value="<?=time()+(3600*7)?>" <? if($re_appear_home<>0) echo 'checked' ?>>
	 </td>
  </tr>
  <tr>
    <td class="name_item" align="center" colspan="2"><br>
		<hr size="1">
		<input type="submit" name="submit" value="Xem th&#7917;" onClick="setURL(form_news,'index.php?fod=ad&act=try_view&exe=news&code=try_view&id=<?=$id?>&page=<?=$page?>&app=<?=$app?>#view','_blank')">
		<input type="submit" name="submit" value="L&#432;u tin" onClick="setURL(form_news,'index.php?fod=ad&act=edit_news&exe=news&code=edit_news_sm&id=<?=$id?>&page=<?=$page?>&app=<?=$app?>','')"> 
		<input name="cancel" type="button" value="H&#7911;y l&#7879;nh" onclick= window.open('index.php?fod=ad&act=lst_news&exe=news&code=lst_news&app=<?=$app?>&page=<?=$page?>','_self')>
	</td>
  </tr>
</table>
</form>
</center>
