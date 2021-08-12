<br>
<a name="view"></a>
<table width="481" border="0" cellspacing="10" cellpadding="0">
  <tr>
    <td>
		<span class="news_title"><?=$title?></span><br>
		<span class="desc"><?=$post_date?> (GMT+7)</span>
	</td>
  </tr>
  <tr>
    <td class='news_chapo'>
		<?php if ($nguontin!='') { ?> <em><a href="<?=$link_nguontin?>" target="_blank">(<?=$nguontin?>)</a></em> <?php } ?>
		<?=$content_desc?>
	</td>
  </tr>
</table>

<table width="481" border="0" cellspacing="10" cellpadding="0">
  <tr>
    <td class='news_body'>
		<? if ($v_img!='') { ?>
		<div align="left">
		<table border="0" align="left" cellspacing="0" cellpadding="0">
			<tr>
				<td><?=$v_img?></td>
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
<tr>
  <td class="name_item" align="center" colspan="2">
  	<hr size="1"/>
		<input type="button" name="button" value="Quay l&#7841;i" onclick= "window.open('javascript:history.go(-1);','_self')">
	</td>
  </tr>
</table>