<script language="javascript">
	function checkall(){
		for (var i = 0; i < document.POSTS.elements.length; i++) {
			if ( document.POSTS.all.checked==true ){
				document.POSTS.elements[i].checked = true;
			}
			else{
				document.POSTS.elements[i].checked = false;
			}
		}
	}
</script>

<br><br>

<span class=Title><?=$subject?></span>
<br><br>
<form name="POSTS" method="POST" action="index.php?fod=ad&act=lst_news&exe=news&code=app_sm&app=<?=$app?>" enctype="multipart/form-data">
<input type="hidden" name="number_news" value="<?=$posts_count?>">
<table border="0" width="481" bgcolor="#81819B" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%">
		<table border="0" width="100%" cellspacing="1" cellpadding="2">
			<tr class="header">
				<td width="5%">TT</td>
				<td width="5%">&nbsp;</td>
				<td width="40%">Ti&ecirc;u &#273;&#7873;</td>
				<td width="21%">Ng&#432;&#7901;i nh&#7853;p</td>
				<td width="17%" align="center">Ng&agrave;y nh&#7853;p</td>
				<td width="6%">Edit</td>
				<td width="6%">X&oacute;a</td>
			</tr>
			<?php
			if ($posts_count>0)
			{	
				for($i=0;$i<$posts_count;$i++)
				{ ?>
			<tr class="row_content">
				<td width="5%" align="center"><?=$total_rows-(($posts_per_page*($page-1))+$i)?></td>
			    <td width="5%" align="center" valign="middle"><input type="checkbox" name="id_post_<?=$i?>" value="<?=$posts['id_post'][$i]?>"></td>
				<td class=tb_news width="40%"><?=$posts['title'][$i]?></td>
				<td width="21%" valign="middle"><?=$posts["realname"][$i]?></td>
				<td width="17%" align="center" valign="middle"><?=$posts["post_date"][$i]?></td>
				<td width="6%" align="center" valign="middle"><?=$posts["edit"][$i]?></td>
				<td width="6%" align="center" valign="middle"><?=$posts["del"][$i]?></td>
			</tr>

				<?php
				} ?>
				
			<tr class="row_content">
				<td colspan="7">
					<input type="checkbox" name="all" onclick="javascript:checkall();">
					<?php if ($app==0){?>
					<input class=submit type="submit" name="submit" value="Duy&#7879;t tin"> 
					<?php } else {?>
					<input class=submit type="submit" name="submit" value="Kh&ocirc;ng duy&#7879;t">
					<?php }?>
				</td>
			</tr>
			<?php  
			}
			else
			{ ?>
			<tr class="row_content">
				<td height="20" colspan="7" align="center">Kh&ocirc;ng c&oacute; b&agrave;i vi&#7871;t n&agrave;o</td>
			</tr>
			<?php
			}
			?>
	  </table>
    </td>
  </tr>
</table>

<br><p align="right"><font class=showpage><?=$show_page?></font></p>

</center>
