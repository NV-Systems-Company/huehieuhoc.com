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
<? include ('./taichinh/index.tpl'); ?>
<br>			
<font class=sub_Title>Ho&#7841;t &#273;&#7897;ng t&agrave;i ch&iacute;nh Ti&#7873;n Chi </font><br> 
<form name="thu" method="POST" action="index.php?fod=taichinh&act=lst_chi&exe=taich&code=list" onsubmit="return check_find(this)">
<input name="loaiphieu" type="hidden" value="C">
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
</p>

<p class="sub_Title1">
L&yacute; do chi : 
  <input name="keyword" type="text" size="15" value="<?=$keyword?>">
<input type="submit" name="find" value="&nbsp;T&igrave;m&nbsp;">
</p>
</form>
<p class=showpage align="right"><?=$show_page?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="3">
		  <tr>
		  	<td class="title1" width="18">TT</td>
			<td class="title1" width="58">Ng&agrave;y</td>
			<td class="title1" width="155">L&yacute; do Chi </td>
			<td class="title1" width="95" align="right">S&#7889; ti&#7873;n</td>
			<td class="title1" width="31" align="right">&#272;VT</td>
			<td class="title1" width="60">Phi&#7871;u chi </td>
		  </tr>
<?php
if ($thuchi_count>0){
	for ($i=0;$i<$thuchi_count;$i++){
?>
		  <tr class="row_<?=$i%2?>">
			<td width="18" align="right"><?=$total_rows-(($thuchi_per_page*($page-1))+$i)?></td>
			<td width="58"><?=$thuchi["ngayphatsinh"][$i]?></td>
			<td width="155"><?=$thuchi["lydo"][$i]  ?></td>
			<td width="95" align="right"><?=$thuchi["sotien"][$i]  ?></td>
			<td width="31" align="right"><?=$thuchi["donvitien"][$i]  ?></td>
			<td width="60"><?=$thuchi["so_phieu"][$i]?></td>
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

