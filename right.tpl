<center>
<!----------------- Quang cao ---------------------------->
<hr size="1" color="#3C9D41">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="vinhet_qc" align="center" height="25">LI&Ecirc;N K&#7870;T</td>
  </tr>
</table>

<table border="0" width="100%" cellspacing="0" cellpadding="2">

		<?php
		if ($global_logo_count>0)
		{
			for ($i=0;$i<$global_logo_count;$i++)
			{
		?>
			  <tr>
				<td width="100%" align="center"><a href="<?=$global_logo['website'][$i]?>" target="_plank"><img src="<?=$path?>quangcao/img_logo/<?=$global_logo['logo'][$i]?>" width='110' ALT="<?=$global_logo['tendonvi'][$i]?>" border="0"></a></td>
			  </tr>
		<?php
			}
		}
		?>

</table>
<!----------------- ---------------------------->
</center>