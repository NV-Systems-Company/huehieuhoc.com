<br><br>
<center>
<font class=Title>Qu&#7843;n l&yacute; qu&#7843;ng c&aacute;o</font><br>
<form name="manage_quangcao" action="index.php?fod=ad&act=man_qc&exe=qc&code=order" method="post">
<input type="hidden" name="quangcao_count" value="<?=$quangcao_count?>">
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table width="460" border="0" cellpadding="1" cellspacing="1">
		  <tr>
				<td class="title1" width="52" align="center">Th&#7913; t&#7921;</td>
				<td class="title1" align="center">Danh s&aacute;ch Qu&#7843;ng c&aacute;o</td>
		
		  </tr>
		<?php
		if ( $quangcao_count>0 ){
			for ($i=0;$i<$quangcao_count;$i++){
		?>
		  <tr>
			<td class="content1" width="52" align="center">
				<input type="hidden" name="id_qc_<?=$i?>" value="<?=$quangcao['id_quangcao'][$i]?>">
				<input class=form name="order_qc_<?=$i?>" value="<?=$quangcao['order_qc'][$i]?>" size=2 >
			</td>
			<td class="content1" width="315" valign="bottom"><img src="./quangcao/img_logo/<?=$quangcao['logo'][$i]?>" ALT="<?=$quangcao['tendonvi'][$i]?>" width="110" border="0"> :: <a href="index.php?fod=ad&act=edit_qc&exe=qc&code=edit&id=<?=$quangcao['id_quangcao'][$i]?>">Thay &#273;&#7893;i</a> :: <a href="index.php?fod=ad&act=man_qc&exe=qc&code=del&id=<?=$quangcao['id_quangcao'][$i]?>">X&oacute;a</a> ::</td>
		  </tr>
		<?php
			}
		}
		else{
		?>
		  <tr>
			<td class="content1" colspan="2" align="center">Kh&ocirc;ng c&oacute; qu&#7843;ng c&aacute;o n&agrave;o.</td>
		  </tr>
		<?php
		}
		?>
		  <tr>
		   <td class="content1" colspan="2"><input class=submit type="submit" name="submit" value="L&#432;u th&#7913; t&#7921;"></td>
		  </tr>
		</table>
   	</td>
  </tr>
</table>
</form>
<table width="460" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="desc">+ C&aacute;c qu&#7843;ng c&aacute;o s&#7869; &#273;&#432;&#7907;c hi&#7875;n th&#7883; tr&ecirc;n trang ch&#7911; theo tr&#7853;t t&#7921; c&oacute; s&#7889; th&#7913; t&#7921; nh&#7887; &#7903; tr&ecirc;n, s&#7889; th&#7913; t&#7921; l&#7899;n &#7903; d&#432;&#7899;i..</td>
  </tr>
</table>

<hr size="1" color="#006605">
<a class="menu_admin" href="index.php?fod=ad&act=add_qc&exe=qc">Th&ecirc;m qu&#7843;ng c&aacute;o m&#7899;i</a> 
<br><br><br>
</center>

