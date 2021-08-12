<script language="javascript">
function checkdangky(checkdk)
{
	if (checkdk.checked==true)
		document.all.iddangky.disabled =false;
	else
		document.all.iddangky.disabled =true;
}
</script>

<br> 
<table>
	<tr>
	  <td width="393" class="sub_Title2" align="center">
Tr&#432;&#7899;c khi &#273;&#259;ng k&yacute; th&agrave;nh vi&ecirc;n. <br>
Xin &#273;&#7885;c qua &#273;i&#7873;u l&#7879; t&#7893; ch&#7913;c ho&#7841;t &#273;&#7897;ng <br>
c&#7911;a Qu&#7929; gi&aacute;o d&#7909;c Hu&#7871; Hi&#7871;u H&#7885;c
		</td>
	</tr>
</table>
<br>

<iframe class="form" src="<?=$root_domain;?>/members/dieule.htm" width="460" height="400"></iframe>

<form name="form1">
   <p class="yeucau1"><input type="checkbox" name="checkbox" value="checkbox" onclick="javascript:checkdangky(this);"> 
 T&ocirc;i &#273;&#7891;ng &yacute; v&#7899;i &#273;i&#7873;u l&#7879; t&#7893; ch&#7913;c ho&#7841;t &#273;&#7897;ng c&#7911;a Qu&#7929; gi&aacute;o d&#7909;c Hu&#7871; Hi&#7871;u H&#7885;c.</p>
 <br><input id="iddangky" disabled name="" type="button" value="&#272;&#259;ng k&yacute;" onclick= window.open('index.php?fod=mem&act=reg&exe=reg','_self')>
</form>