<br>
<br>
<font class="Title">DANH S&Aacute;CH TH&Agrave;NH VI&Ecirc;N THAM GIA</font><br>
<p>
[ <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=A">A</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=B">B</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=C">C</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=D">D</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=&#272;">&#272;</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=E">E</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=F">F</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=G">G</a> |
 <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=H">H</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=I">I</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=J">J</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=K">K</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=L">L</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=M">M</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=N">N</a> ]<br>
[ <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=O">O</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=P">P</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=Q">Q</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=R">R</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=S">S</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=T">T</a> |
 <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=U">U</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=V">V</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=W">W</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=X">X</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=Y">Y</a> | <a href="index.php?fod=tch&act=dstv&exe=dstv&desc=Z">Z</a> ]
<br>[ <a href="index.php?fod=tch&act=dstv&exe=dstv">All</a> ]
<br>
</p>

<p><font class=showpage><?=$show_page?></font></p>
<br>
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="4">
		  <tr>
			<td class="title1" width="18">TT</td>
			<td class="title1" width="150">H&#7885; v&agrave; t&ecirc;n</td>
			<td class="title1" width="264">&#272;&#7883;a ch&#7881;</td>
		  </tr>
<?php
if ($users_tg_count>0){
	for ($i=0;$i<$users_tg_count;$i++){
?>
		  <tr class="row_content" <? if ($_SESSION["login"]=='logined'){ ?> onclick= window.open("index.php?fod=mem&act=infomem&exe=infomem&id=<?=$users_tg['id'][$i]?>","_self"); onmouseover=Ovr_row(this); onmouseout=Out_row(this); <? } ?> >
		  	<td width="18" align="right"><?=($members_per_page*($page-1))+$i+1?></td>
			<td width="150"><?=$users_tg["realname"][$i]?></td>
			<td width="264"><?=$users_tg["address"][$i]?></td>
		  </tr>
<?php
	}
}
?>

		</table>
    </td>
  </tr>
</table>
<br><p align="right"><font class=showpage><?=$show_page?></font></p>
