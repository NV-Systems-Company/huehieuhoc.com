	<tr>
		<td class="MenuLeft1" width="165" height="30" onmouseover=Ovr_td(this,'MenuLeft2'); onmouseout="Out_td(this,'MenuLeft1')"; onClick="HideShow('id_approve_news'), set_cookies_hideshow_submenu('id_approve_news','show_menupopup_news')">Ki&#7875;m duy&#7879;t tin</td>
	</tr>
	<tr id="id_approve_news" style="display:<?=$_COOKIE['show_menupopup_news']?>">
		<td valign="top">
			<table cellpadding="0" cellspacing="0" width="165" bgcolor="#93AC00">
				<tr>
					<td width="30" height="20"></td>
					<td class="MenuLeft_sub_header" valign="bottom">TIN T&#7912;C</td>
				</tr>
				<tr>
					<td width="30"></td>
					<td class="MenuLeft_sub" width="136" valign="top">
						  <a href="<?=$root_domain?>index.php?fod=ad&act=lst_news&exe=news&code=lst_news&app=0">- Tin ch&#432;a duy&#7879;t</a><br>
						  <a href="<?=$root_domain?>index.php?fod=ad&act=lst_news&exe=news&code=lst_news&app=1">- Tin &#273;&atilde; ki&#7875;m duy&#7879;t</a>
					 </td>
				</tr>
				<tr>
					<td width="30" height="20"></td>
					<td class="MenuLeft_sub_header" valign="bottom">&#7842;NH HO&#7840;T &#272;&#7896;NG</td>
				</tr>
				
				<tr>
					<td width="30"></td>
				  <td class="MenuLeft_sub" width="136" valign="top">
						<a href="<?=$root_domain?>index.php?fod=ad&act=lst_hd&exe=hd&code=list">- Danh s&aacute;ch &#7843;nh H&#272;</a><br>
						<a href="<?=$root_domain?>index.php?fod=ad&act=add_hd">- C&#7853;p nh&#7853;t &#7843;nh H&#272;</a><br>
					  <a href="<?=$root_domain?>index.php?fod=ad&act=up_hd">- Upload h&igrave;nh &#7843;nh</a>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="5"></td>
				</tr>
			</table>
		</td>
	</tr>