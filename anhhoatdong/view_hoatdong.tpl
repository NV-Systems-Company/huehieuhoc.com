<br>
<table width="481" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
		&nbsp;&nbsp;<span class="news_title"><?=$title_hoatdong?></span><br>
		&nbsp;&nbsp;<span class="desc"><?=$ngay_capnhat?> (GMT+7)</span>
	</td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <td width="481">
		<?php 
			include("./file_hd/".$file_hoatdong);
		?>
	</td>
  </tr>
</table>

<br>
<?php if ($hoatdong_count>0) 
	{ ?>
<table width="460" border="0" cellspacing="0" cellpadding="0" bgcolor="#F0FFDD">
  <tr class="header1">
    <td>&nbsp;&nbsp; C&aacute;c &#7843;nh ho&#7841;t &#273;&#7897;ng &#273;&atilde; &#273;&#432;a:</td>
  </tr>
	<?php
		for($i=0;$i<$hoatdong_count;$i++) 
		{ ?>
  <tr>
    <td class="news_list_index"><font color="#990000">&#8226; </font><?=$hoatdong["hoatdong"][$i]?> <font class="desc1">(<?=$hoatdong["ngay_hd"][$i]?>)</font></td>
  </tr>
  <?php
		} ?>
  <tr>
    <td height="10"></td>
  </tr>
</table>
<? } ?>
<br>