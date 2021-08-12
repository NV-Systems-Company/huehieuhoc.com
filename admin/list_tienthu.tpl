<script language="javascript">
	function check_find(the_form)
	{	//String.fromCharCode(0xE1)
		if (the_form.month.value!=0)
		{
			if (the_form.year.value==0)
			{
				alert("Nam tim kiem chua co!");
				the_form.year.focus();
				return false;
			}
		}
		return true;
	}
</script>
<center>
<br><br>
<p>
<a class="menu_admin" href="index.php?fod=ad&act=add_thu&exe=thuchi&code=add">Ph&aacute;t sinh ti&#7873;n Thu </a> 
&nbsp;&nbsp;
<a class="menu_admin" href="index.php?fod=ad&act=lst_chi&exe=thuchi&code=list">Qu&#7843;n l&yacute;  ti&#7873;n Chi</a> 
&nbsp;&nbsp;
<a class="menu_admin" href="index.php?fod=ad&act=tk_tc&exe=tk_tc">T&#7893;ng k&#7871;t n&#259;m t&agrave;i ch&iacute;nh</a> 
</p>
<hr color="#B91200" size="1">
<br>			
<font class=Title>Qu&#7843;n l&yacute; ti&#7873;n Thu</font>
<p>S&#7889; li&#7879;u &#273;&#432;&#7907;c c&#7853;p nh&#7853;t m&#7899;i nh&#7845;t v&agrave;o l&uacute;c: <?=$last_update?></p>
<br> 
<form name="thu" method="POST" action="index.php?fod=ad&act=lst_thu&exe=thuchi&code=list" onsubmit="return check_find(this)">
<input name="loaiphieu" type="hidden" value="T">
<p class="sub_Title1">
Th&aacute;ng:
  <select class="form" name="month">
  	<option value="0" <? if ($month==0) echo 'selected';?>>T&#7845;t c&#7843;</option>
	<option value="1" <? if ($month==1) echo 'selected';?>>01</option>
	<option value="2" <? if ($month==2) echo 'selected';?>>02</option>
	<option value="3" <? if ($month==3) echo 'selected';?>>03</option>
	<option value="4" <? if ($month==4) echo 'selected';?>>04</option>
	<option value="5" <? if ($month==5) echo 'selected';?>>05</option>
	<option value="6" <? if ($month==6) echo 'selected';?>>06</option>
	<option value="7" <? if ($month==7) echo 'selected';?>>07</option>
	<option value="8" <? if ($month==8) echo 'selected';?>>08</option>
	<option value="9" <? if ($month==9) echo 'selected';?>>09</option>
	<option value="10" <? if ($month==10) echo 'selected';?>>10</option>
	<option value="11" <? if ($month==11) echo 'selected';?>>11</option>
	<option value="12" <? if ($month==12) echo 'selected';?>>12</option>
  </select>
  
 &nbsp;&nbsp;N&#259;m:
  <select class="form" name="year">
  	<option value="0" <? if ($year==0) echo 'selected';?>>T&#7845;t c&#7843;</option>
<?php
if ($lst_year_count>0){
	for ($i=0;$i<$lst_year_count;$i++){
?>
	<option value="<?=$lst_year['year'][$i]?>" <? if ($year==$lst_year['year'][$i]) echo 'selected';?>><?=$lst_year['year'][$i]?></option>
<?php
	}
}?>
  </select>
&nbsp;
 <input class="form" type="submit" name="find" value="T&igrave;m"> 
</p>

</form>
<p class=showpage align="right"><?=$show_page?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="3">
		  <tr>
		  	<td class="title1" width="19">TT</td>
			<td class="title1" width="61">Phi&#7871;u thu </td>
			<td class="title1" width="56">Ng&agrave;y</td>
			<td class="title1" width="114">Ng&#432;&#7901;i n&#7897;p</td>
			<td class="title1" width="75" align="right">S&#7889; ti&#7873;n</td>
			<td class="title1" width="31" align="right">&#272;VT</td>
			<td class="title1" width="54" align="right">&nbsp;</td>
		  </tr>
<?php
if ($thuchi_count>0){
	for ($i=0;$i<$thuchi_count;$i++){
?>
		  <tr class="row_<?=$i%2?>" title="<?=$thuchi['nguoi_capnhat'][$i]?>">
			<td width="19" align="right"><?=($thuchi_per_page*($page-1))+$i+1?></td>
			<td width="61"><?=$thuchi["so_phieu"][$i]?></td>
			<td width="56"><?=$thuchi["ngayphatsinh"][$i]?></td>
			<td width="114"><?=$thuchi["nguoi_nop_nhan"][$i]  ?></td>
			<td width="75" align="right"><?=$thuchi["sotien"][$i]  ?></td>
			<td width="31" align="right"><?=$thuchi["donvitien"][$i]  ?></td>
			<td width="54" align="right"><a href="index.php?fod=ad&act=edit_thu&exe=thuchi&code=edit&id=<?=$thuchi['id_thuchi'][$i]?>">S&#7917;a</a> : : <a href="index.php?fod=ad&act=lst_thu&exe=thuchi&code=del&id=<?=$thuchi['id_thuchi'][$i]?>">X&oacute;a</a></td>
		  </tr>
<?php
	}
}
else {
?>
		 <tr>
		  	<td class="content" align="center" colspan="7">Kh&ocirc;ng t&igrave;m th&#7845;y th&ocirc;ng tin c&#7847;n t&igrave;m!</td>
		  </tr>
<? } ?>
		</table>
    </td>
  </tr>
</table>
<p class=showpage align="right"><?=$show_page?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
<br>
</center>

