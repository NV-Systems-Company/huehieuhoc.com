<br>
<a name="view"></a>
<table width="100%" border="0" cellspacing="10" cellpadding="0">
  <tr>
    <td>
		<span class="news_title"><?=$title?></span><br>
		<span class="desc"><?=$post_date?> (GMT+7)</span>
	</td>
  </tr>
  <tr>
    <td class='news_chapo'>
		<b><em><?=$nguontin?></em></b>
		<?=$content_desc?>
	</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="10" cellpadding="0">
  <tr>
    <td class='news_body'>
		<? if ($imgname!='') { ?>
		<div align="left">
		<table border="0" align="left" cellspacing="0" cellpadding="0">
			<tr>
				<td><?=$imgname?></td>
			</tr>
		</table>
		</div>
		<? } ?>
		<?=$content_detail?>
	</td>
  </tr>
  <tr>
    <td class='news_author' align="right">
		<?=$author?>
	</td>
  </tr>
</table>
<p align="right"><a href="javascript:history.go(-1);">&lt;&lt;Quay lui</a> &nbsp; &nbsp;</p>
<br>

<?php if ($news_count>0) 
	{ ?>
<table width="460" border="0" cellspacing="0" cellpadding="0" bgcolor="#F0FFDD">
  <tr class="header1">
    <td>&nbsp;&nbsp; C&aacute;c tin &#273;&atilde; &#273;&#432;a:</td>
  </tr>
   <tr>
    <td height="5"></td>
  </tr>
	<?php
		for($i=0;$i<$news_count;$i++) 
		{ ?>
  <tr height="15">
    <td class="news_list_index"><font color="#990000">- </font><?=$news["title"][$i]?> <font class="desc1">(<?=$news["post_date"][$i]?>)</font></td>
  </tr>
  	<?php
		} ?>
  <tr>
    <td height="10"></td>
  </tr>
</table>
<?php } ?>
<br>