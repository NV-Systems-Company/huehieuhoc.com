	<tr>
		<td class="MenuLeft1" width="165" height="30" onmouseover=Ovr_td(this,'MenuLeft2'); onmouseout=Out_td(this,'MenuLeft1'); onclick="HideShow('id_submenu_hocbong'), set_cookies_hideshow_submenu('id_submenu_hocbong','show_menupopup_hocbong')";>C&#7853;p nh&#7853;t h&#7885;c b&#7893;ng</td>
	</tr>
	
	<tr id="id_submenu_hocbong" style="display:<?=$_COOKIE['show_menupopup_hocbong']?>">
		<td valign="top">
			<table cellpadding="0" cellspacing="0" width="165" bgcolor="#93AC00">
				<tr>
					<td width="30"></td>
					<td class="MenuLeft_sub" width="136" valign="top">
						<a href="<?=$root_domain?>index.php?fod=ad&act=lst_hb&exe=hb&code=list">- Danh s&aacute;ch h&#7885;c b&#7893;ng</a><br>
						<a href="<?=$root_domain?>index.php?fod=ad&act=add_hb">- C&#7853;p nh&#7853;t ds h&#7885;c b&#7893;ng</a>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="5"></td>
				</tr>
			</table>
		</td>
	</tr>

			