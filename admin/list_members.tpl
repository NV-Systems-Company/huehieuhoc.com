
<script language="javascript">
	function checkall(){
		for (var i = 0; i < document.memberlist.elements.length; i++) {
			if ( document.memberlist.all.checked==true ){
				document.memberlist.elements[i].checked = true;
			}
			else{
				document.memberlist.elements[i].checked = false;
			}
		}
	}
</script>

<center>
<table width="450" border="0" cellpadding="10" cellspacing="0">
	<tr>
		<td>
			<br> 
			<a class="menu_admin" href="index.php?fod=ad&act=notmem&exe=lstmem">Th&agrave;nh vi&ecirc;n &#273;&atilde; &#273;&#259;ng k&yacute; nh&#432;ng ch&#432;a x&aacute;c nh&#7853;n</a>
	  <br>	  </td>
	</tr>
</table>

<br>
<font class=Title>Th&agrave;nh vi&ecirc;n</font><br>
<br>
<p>
[ <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=A">A</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=B">B</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=C">C</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=D">D</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=&#272;">&#272;</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=E">E</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=F">F</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=G">G</a> |
 <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=H">H</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=I">I</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=J">J</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=K">K</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=L">L</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=M">M</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=N">N</a> ]<br>
[ <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=O">O</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=P">P</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=Q">Q</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=R">R</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=S">S</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=T">T</a> |
 <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=U">U</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=V">V</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=W">W</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=X">X</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=Y">Y</a> | <a href="index.php?fod=ad&exe=lstmem&act=lstmem&desc=Z">Z</a> ]
<br>[ <a href="index.php?fod=ad&exe=lstmem&act=lstmem">All</a> ]
<br>
</p>

<form name="memberlist" method="POST" action="index.php?fod=ad&exe=editmem&code=unapp">
<input type="hidden" name="users_count" value="<?=$users_count?>">
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="3">
		  <tr>
		  	<td class="title1" width="23">TT</td>
			<td class="title1" width="20">&nbsp;</td>
			<td class="title1" width="220">T&ecirc;n th&agrave;nh vi&ecirc;n</td>
			<td class="title1" width="117">C&#7845;m</td>
			<td class="title1" width="64">X&oacute;a</td>
		  </tr>
<?php
if ($users_count>0){
	for ($i=0;$i<$users_count;$i++){
?>
		  <tr>
			<td class="content" width="23" align="right"><?=($members_per_page*($page-1))+$i+1?></td>
			<td class="content" width="20"><? if (($users["id"][$i]!=$id_admin)&&($users["id"][$i]!=$id_admin2)){?><input type="checkbox" name="approve_user_<?=$i?>" value="<?=$users["id"][$i]?>"><? } ?>&nbsp;</td>
			<td class="content" width="220"><a href="index.php?fod=ad&act=lstmem&exe=editmem&code=edit&id=<?=$users['id'][$i]?>"><?=$users["realname"][$i]?></a> <font class=desc><?=$users["banned"][$i]?></font></td>
			<td class="content" width="117"><? if (($users["id"][$i]!=$id_admin)&&($users["id"][$i]!=$id_admin2)) echo $users["ban"][$i];?>&nbsp;</td>
			<td class="content" width="64"><? if (($users["id"][$i]!=$id_admin)&&($users["id"][$i]!=$id_admin2)) echo '<a href="index.php?fod=ad&act=lstmem&exe=editmem&code=del&id='.$users['id'][$i].'">X&oacute;a b&#7887;</a>';?>&nbsp;</td>
		  </tr>
<?php
	}
}
?>

		  <tr>
		  	<td class="content" >&nbsp;</td>
			<td class="content" colspan="4">
				<input type="checkbox" name="all" onclick="javascript:checkall();">
				<input class=submit type="submit" name="submit" value="H&#7911;y b&#7887; x&aacute;c nh&#7853;n th&agrave;nh vi&ecirc;n">
			</td>
		  </tr>
		</table>
    </td>
  </tr>
</table>
</form>
</center>

<br><p align="right"><font class=showpage><?=$show_page?></font></p>

<br>
<p align="left">
<font class=desc>
<br>&nbsp; &nbsp;+ Nh&#7919;ng th&agrave;nh vi&ecirc;n b&#7883; c&#7845;m s&#7869; kh&ocirc;ng th&#7875; &#273;&#259;ng nh&#7853;p.
<br>&nbsp; &nbsp;+ Th&agrave;nh vi&ecirc;n b&#7883; h&#7911;y b&#7887; x&aacute;c nh&#7853;n s&#7869; &#273;&#432;&#7907;c chuy&#7875;n qua th&agrave;nh vi&ecirc;n ch&#432;a &#273;&#432;&#7907;c x&aacute;c nh&#7853;n.
</font>
</p><br>
