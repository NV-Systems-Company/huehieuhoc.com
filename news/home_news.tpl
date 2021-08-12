<br>
<?php 
if ($news_count>0) 
	{
		for($i=0;($i<$news_count)&&($i<$num_news_intro);$i++) 
		{ ?>
<hr size="1"/>
<table width="100%" border="0" cellspacing="10" cellpadding="0">
  <tr>
    <td>
		<span class="news_title1"><?=$news["title"][$i] ?></span><br>
		<span class="desc"><?=$news["post_date"][$i]?> (GMT+7)</span>
	</td>
  </tr>
  <tr>
    <td class='news_body'>
		<? if ($news["imgname"][$i]!='') { ?>
		<div align="left">
		<table border="0" align="left" cellspacing="0" cellpadding="0">
			<tr>
				<td><?=$news["imgname"][$i]?></td>
			</tr>
		</table>
		</div>
		<? } ?>
		<b><em><?=$news['nguontin'][$i] ?></em></b>
		<?=$news["content_desc"][$i]?>
		<? if($news["content_detail"][$i]!=''){ ?><p align="right"><?=$news['chitiet'][$i]?></p> <?}?>
	</td>
  </tr>
</table>
	<?php 
		} ?>		
<br>
<table width="460" border="0" cellspacing="0" cellpadding="0" bgcolor="#F0FFDD">
  <tr class="header1">
    <td>&nbsp;&nbsp; C&aacute;c tin &#273;&atilde; &#273;&#432;a:</td>
  </tr>
	<?php
		for($i;$i<$news_count;$i++) 
		{ ?>
  <tr>
    <td class="news_list_index"><font color="#990000">&#8226; </font><?=$news["title"][$i]?> <font class="desc1">(<?=$news["post_date"][$i]?>)</font></td>
  </tr>
  <?php
		} ?>
  <tr>
    <td height="10"></td>
  </tr>
</table>
		
<?php
	} ?>
<br>