	<tr>
			<td class="MenuLeft1" width="165" height="30" onmouseover=Ovr_td(this,'MenuLeft2'); onmouseout=Out_td(this,'MenuLeft1'); onclick="HideShow('id_submenu_finance'), set_cookies_hideshow_submenu('id_submenu_finance','show_menupopup_finance')";> Qu&#7843;n tr&#7883; t&agrave;i ch&iacute;nh</td>		
	</tr>
	
	<tr id="id_submenu_finance" style="display:<?=$_COOKIE['show_menupopup_finance']?>">
		<td valign="top">
			<table cellpadding="0" cellspacing="0" width="165" bgcolor="#93AC00">
				<tr>
					<td width="30"></td>
				  <td class="MenuLeft_sub" width="136" valign="top">
					  	<a href="<?=$root_domain?>index.php?fod=ad&act=add_thu&exe=thuchi&code=add">- Nh&#7853;p ti&#7873;n thu</a><br>
		          		<a href="<?=$root_domain?>index.php?fod=ad&act=add_chi&exe=thuchi&code=add">- Nh&#7853;p ti&#7873;n chi</a><br>
					  	<a href="<?=$root_domain?>index.php?fod=ad&act=lst_thu&exe=thuchi&code=list">- Qu&#7843;n l&yacute; ti&#7873;n thu</a><br>
	          			<a href="<?=$root_domain?>index.php?fod=ad&act=lst_chi&exe=thuchi&code=list">- Qu&#7843;n l&yacute; ti&#7873;n chi</a><br>
					  	<a href="<?=$root_domain?>index.php?fod=ad&act=tk_tc&exe=tk_tc">- T&#7893;ng k&#7871;t</a><br>
       		  		   <a href="<?=$root_domain?>index.php?fod=ad&act=dm_tiente&exe=tiente">- Danh m&#7909;c ti&#7873;n t&#7879;</a>
				   </td>
				</tr>
				<tr>
					<td colspan="2" height="5"></td>
				</tr>
			</table>
		</td>
	</tr>