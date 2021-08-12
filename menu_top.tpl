<SCRIPT language="Javascript">

function Show_submenu(menu,id_td) 
{
	var idTable;
	var idPos;
	var x = -170;
	
	idTable = document.getElementById(menu);
	idPos   = document.getElementById(id_td);
	
	idTable.style.display ='';
	idTable.style.left = document.body.offsetWidth/2 + idPos.offsetLeft + x;
	Ovr_td(idPos,idPos.className);
};

function Hide_submenu(menu,id_td) 
{
	var idTable;
	var idPos;
	idTable = document.getElementById(menu);
	idPos   = document.getElementById(id_td);
	idTable.style.display ='none';
	Out_td(idPos,idPos.className);
};

function Ovr_submenu(td) 
{
	td.className = 'Sub_menutop2';
	//td.style.cursor = 'hand';
};

function Out_submenu(td) 
{
	td.className = 'Sub_menutop1';
};

</SCRIPT>

<table id = "tbl_menu" width="480" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="menutop1" id="td_trangchu" width="16%" height="25" align="center" onmouseover=Ovr_td(this,'menutop2'); onmouseout=Out_td(this,'menutop1');><a class="Menu" href="<?=$root_domain;?>index.php">Trang ch&#7911;</a></td>
	<td class="menutop1" id="td_tochuc" width="16%" height="25" align="center" onmouseover=Ovr_td(this,'menutop2'),Show_submenu('menu_tochuc','td_tochuc'); onmouseout=Out_td(this,'menutop1'),Hide_submenu('menu_tochuc','td_tochuc');>T&#7893; ch&#7913;c</td>
    <td class="menutop1" id="td_taichinh" width="16%" height="25" align="center" onmouseover=Ovr_td(this,'menutop2'); onmouseout=Out_td(this,'menutop1');><a class="Menu" href="<?=$root_domain;?>index.php?fod=taichinh&act=idx&exe=taich">T&agrave;i ch&aacute;nh</a></td>
    <td class="menutop1" id="td_hocbong" width="16%" height="25" align="center" onmouseover=Ovr_td(this,'menutop2'); onmouseout=Out_td(this,'menutop1');><a class="Menu" href="<?=$root_domain;?>index.php?fod=hb&act=lst_hb&exe=w_hb&code=v_list">H&#7885;c b&#7893;ng</a></td>
    <td class="menutop1" id="td_donghanh" width="16%" height="25" align="center" onmouseover=Ovr_td(this,'menutop2'); onmouseout=Out_td(this,'menutop1');><a class="Menu" href="<?=$root_domain;?>index.php?fod=dh&act=lst_dh&exe=lst_dh">&#272;&#7891;ng h&agrave;nh</a></td>
<!---    <td class="menutop1" id="td_baotro" width="14%" height="25" align="center" onmouseover=Ovr_td(this,'menutop2'); onmouseout=Out_td(this,'menutop1');><a class="Menu" href="<?=$root_domain;?>index.php?fod=bt&act=lst_uh&exe=lst_uh">B&#7843;o tr&#7907;</a></td>--->
    <td class="menutop1" id="td_lienhe" width="16%" height="25" align="center" onmouseover=Ovr_td(this,'menutop2'); onmouseout=Out_td(this,'menutop1');><a class="Menu" href="<?=$root_domain;?>index.php?fod=contact&act=ct">Li&ecirc;n l&#7841;c</a></td>
  </tr>
</table>

<!-----------To Chuc---------->
<table class="SubMenu" id="menu_tochuc" style="DISPLAY: none" width="180" border="0" cellpadding="5" cellspacing="0" onmouseover = Show_submenu('menu_tochuc','td_tochuc'); onmouseout = Hide_submenu('menu_tochuc','td_tochuc');>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);><a class="Menu" href="<?=$root_domain;?>index.php?fod=tch">- Q&#272; th&agrave;nh l&#7853;p &amp; T&ocirc;n ch&#7881; H&#272;</a></td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);><a class="Menu" href="<?=$root_domain;?>index.php?fod=tch&act=dstv&exe=dstv">- Danh s&aacute;ch th&agrave;nh vi&ecirc;n</a></td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);><a class="Menu" href="<?=$root_domain;?>index.php?fod=tch&act=tvsl&exe=tvsl">- Th&agrave;nh vi&ecirc;n s&aacute;ng l&#7853;p</a></td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);><a class="Menu" href="<?=$root_domain;?>index.php?fod=tch&act=hdcv&exe=hdcv">- H&#7897;i &#273;&#7891;ng c&#7889; v&#7845;n</a></td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);><a class="Menu" href="<?=$root_domain;?>index.php?fod=tch&act=hdqlq&exe=hdqlq">- H&#7897;i &#273;&#7891;ng qu&#7843;n l&yacute; qu&#7929;</a></td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);><a class="Menu" href="<?=$root_domain;?>index.php?fod=tch&act=bks&exe=bks">- Ban ki&#7875;m so&aacute;t</a></td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);><a class="Menu" href="<?=$root_domain;?>index.php?fod=tch&act=bdh&exe=bdh">- Ban Gi&aacute;m &#273;&#7889;c &#273;i&#7873;u h&agrave;nh</a></td>
  </tr>
</table>



<!-----------Dong Hanh-------
<table class="SubMenu" id="menu_donghanh" style="DISPLAY: none" width="180" border="0" cellpadding="5" cellspacing="0" onmouseover = Show_submenu('menu_donghanh','td_donghanh'); onmouseout = Hide_submenu('menu_donghanh','td_donghanh');>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- H&#7897;i AHQH &#272;&#7891;ng Kh&aacute;nh</td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- H&#7885;c b&#7893;ng Ph&#7841;m Ki&ecirc;m &Acirc;u</td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- Nh&oacute;m Thi&#7879;n nguy&#7879;n NN Hu&#7871;</td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- &#272;&#7891;ng h&#432;&#417;ng B&igrave;nh Ph&#432;&#7899;c</td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- H&#7885;c b&#7893;ng Sacramento</td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- Cty SXTM Thi&ecirc;n An </td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- Cty CP SX-XNK Ho&agrave;ng Vi&#7879;t</td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- Cty TNHH T&ocirc;n &#272;&ocirc;ng &Aacute;</td>
  </tr>
</table>

------->


<!-----------Bao Tro--------
<table class="SubMenu" id="menu_baotro" style="DISPLAY: none" width="180" border="0" cellpadding="5" cellspacing="0" onmouseover = Show_submenu('menu_baotro','td_baotro'); onmouseout = Hide_submenu('menu_baotro','td_baotro');>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- Danh s&aacute;ch &#273;&#417;n v&#7883; &#7911;ng h&#7897;</td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- Danh s&aacute;ch c&aacute; nh&acirc;n &#7911;ng h&#7897;</td>
  </tr>
</table>

--------------->

<!-----------Hoc Bong---------->
<table class="SubMenu" id="menu_hocbong" style="DISPLAY: none" width="180" border="0" cellpadding="5" cellspacing="0" onmouseover = Show_submenu('menu_hocbong','td_hocbong'); onmouseout = Hide_submenu('menu_hocbong','td_hocbong');>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- H&#7885;c b&#7893;ng Hu&#7871; Hi&#7871;u H&#7885;c</td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- H&#7885;c b&#7893;ng &#272;&#7891;ng h&agrave;nh</td>
  </tr>
  <tr>
    <td class="Sub_menutop1" height="20" onmouseover=Ovr_submenu(this); onmouseout=Out_submenu(this);>- K&#7871; ho&#7841;ch h&#7885;c b&#7893;ng</td>
  </tr>
</table>