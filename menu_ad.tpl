<tr>
	<td class="MenuLeft1" width="165" height="30" onmouseover=Ovr_td(this,'MenuLeft2'); onmouseout=Out_td(this,'MenuLeft1'); onclick= "HideShow('id_administrator'), set_cookies_hideshow_submenu('id_administrator','show_menupopup_admin')";>Administrator</td>
</tr>

<tr id="id_administrator" style="display:<?=$_COOKIE['show_menupopup_admin']?>">
	<td valign="top">
		<table cellpadding="0" cellspacing="0" width="165" bgcolor="#93AC00">
			<tr>
				<td width="30"></td>
				<td class="MenuLeft_sub_header">T&#7892; CH&#7912;C</td>
			</tr>
			<tr>
				<td width="30"></td>
				<td class="MenuLeft_sub" width="136" valign="top">
					<a href="<?=$root_domain?>index.php?fod=ad&act=memslp&exe=memslp">- Th&agrave;nh vi&ecirc;n s&aacute;ng l&#7853;p</a><br>
					<a href="<?=$root_domain?>index.php?fod=ad&act=memcv&exe=memcv">- H&#272; c&#7889; v&#7845;n</a><br>
					<a href="<?=$root_domain?>index.php?fod=ad&act=memqlq&exe=memqlq">- H&#272; qu&#7843;n l&yacute; qu&#7929;</a><br>
					<a href="<?=$root_domain?>index.php?fod=ad&act=memks&exe=memks">- Ban ki&#7875;m so&aacute;t qu&#7929;</a><br>
					<a href="<?=$root_domain?>index.php?fod=ad&act=memdh&exe=memdh">- Ban G&#272; &#273;i&#7873;u h&agrave;nh</a>
				</td>
			</tr>
			<tr>
				<td width="30" height="20"></td>
				<td class="MenuLeft_sub_header" valign="bottom">Q.L&Yacute; TH&Agrave;NH VI&Ecirc;N</td>
			</tr>
			
			<tr>
				<td width="30"></td>
			  <td class="MenuLeft_sub" width="136" valign="top">
					<a href="<?=$root_domain?>index.php?fod=ad&act=lstmem&exe=lstmem">- Th&agrave;nh vi&ecirc;n HHH </a><br>
					<a href="<?=$root_domain?>index.php?fod=ad&act=notmem&exe=lstmem">- Th&agrave;nh vi&ecirc;n d&#7921; b&#7883;</a><br>
					<a href="<?=$root_domain?>index.php?fod=ad&act=memad&exe=memad">- Quy&#7873;n Administrator</a><br>
					<a href="<?=$root_domain?>index.php?fod=ad&act=memupfi&exe=memupfi">- Quy&#7873;n qu&#7843;n l&yacute; thu chi</a><br>
				  <a href="<?=$root_domain?>index.php?fod=ad&act=memupnw&exe=memupnw">- Quy&#7873;n duy&#7879;t tin t&#7913;c</a><br>	
				  <a href="<?=$root_domain?>index.php?fod=ad&act=memuphb&exe=memuphb">- Quy&#7873;n nh&#7853;p ds HB </a>
				</td>
			</tr>
			<tr>
				<td width="30" height="20"></td>
				<td class="MenuLeft_sub_header" valign="bottom">TH&Ocirc;NG B&Aacute;O</td>
			</tr>
			<tr>
				<td width="30"></td>
				<td class="MenuLeft_sub" width="136" valign="top">
					<a href="<?=$root_domain?>index.php?fod=ad&act=lst_tb&exe=tb&code=list">- Danh s&aacute;ch th&ocirc;ng b&aacute;o</a><br>
					<a href="<?=$root_domain?>index.php?fod=ad&act=add_tb">- C&#7853;p nh&#7853;t th&ocirc;ng b&aacute;o</a>			
				</td>
			</tr>
			
			<tr>
				<td width="30" height="20"></td>
				<td class="MenuLeft_sub_header" valign="bottom">&#272;&#7890;NG H&Agrave;NH</td>
			</tr>
			<tr>
				<td width="30"></td>
				<td class="MenuLeft_sub" width="136" valign="top">
					<a href="<?=$root_domain?>index.php?fod=ad&act=up_dh&exe=up_dh">- Nh&#7853;p ds &#273;&#7891;ng h&agrave;nh</a><br>
					<!---<a href="<?=$root_domain?>index.php?fod=ad&act=lst_uh&exe=uh&code=list">- Nh&#7853;p ds &#7911;ng h&#7897;</a>---->
				</td>
			</tr>
			<tr>
				<td width="30" height="20"></td>
				<td class="MenuLeft_sub_header" valign="bottom">QU&#7842;NG C&Aacute;O</td>
			</tr>
			<tr>
				<td width="30"></td>
				<td class="MenuLeft_sub" width="136" valign="top">
					<a href="<?=$root_domain?>index.php?fod=ad&act=add_qc&exe=qc">- C&#7853;p nh&#7853;t qu&#7843;ng c&aacute;o</a><br>
					<a href="<?=$root_domain?>index.php?fod=ad&act=man_qc&exe=qc&code=man">- &#272;i&#7873;u h&agrave;nh qu&#7843;ng c&aacute;o</a>			
				</td>
			</tr>
			<tr>
				<td colspan="2" height="5"></td>
			</tr>
		</table>
	</td>
</tr>