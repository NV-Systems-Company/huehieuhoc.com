
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
			<a class="menu_admin" href="index.php?fod=ad&act=lstmem&exe=lstmem">Danh s&aacute;ch th&agrave;nh vi&ecirc;n</a>
		</td>
	</tr>
</table>
<br>
<font class=Title>Th&agrave;nh vi&ecirc;n ch&#432;a &#273;&#432;&#7907;c x&aacute;c nh&#7853;n </font><br>
<br>
<p>
[ <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=A">A</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=B">B</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=C">C</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=D">D</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=&#272;">&#272;</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=E">E</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=F">F</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=G">G</a> |
 <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=H">H</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=I">I</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=J">J</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=K">K</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=L">L</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=M">M</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=N">N</a> ]<br>
[ <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=O">O</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=P">P</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=Q">Q</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=R">R</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=S">S</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=T">T</a> |
 <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=U">U</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=V">V</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=W">W</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=X">X</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=Y">Y</a> | <a href="index.php?fod=ad&exe=lstmem&act=notmem&desc=Z">Z</a> ]
<br>[ <a href="index.php?fod=ad&exe=lstmem&act=notmem">All</a> ]
<br>
</p>

<form name="memberlist" method="POST" action="index.php?fod=ad&exe=editmem&code=app">
<input type="hidden" name="users_count" value="<?=$users_count?>">
<table border="0" width="460" bgcolor="#6B9800" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table border="0" width="460" cellspacing="1" cellpadding="1">
		  <tr>
			<td class="title1" width="30">&nbsp;</td>
			<td class="title1" width="341">T&ecirc;n th&agrave;nh vi&ecirc;n</td>
			<td class="title1" width="79">X&oacute;a</td>
		  </tr>
<?php
if ($users_count>0){
	for ($i=0;$i<$users_count;$i++){
?>
		  <tr>
			<td class="content" width="30"><? if (($users["id"][$i]!=$id_admin)&&($users["id"][$i]!=$id_admin2)){?><input type="checkbox" name="approve_user_<?=$i?>" value="<?=$users["id"][$i]?>"><? } ?>&nbsp;</td>
			<td class="content" width="341"><a href="index.php?fod=ad&act=notmem&exe=editmem&code=edit&id=<?=$users['id'][$i]?>"><?=$users["realname"][$i]?></a> <font class=desc><?=$users["banned"][$i]?></font></td>
			<td class="content" width="79"><? if (($users["id"][$i]!=$id_admin)&&($users["id"][$i]!=$id_admin2)) echo '<a href="index.php?fod=ad&act=notmem&exe=editmem&code=del&id='.$users['id'][$i].'">X&oacute;a b&#7887;</a>';?>&nbsp;</td>
		  </tr>
<?php
	}
}
?>

		  <tr>
			<td class="content" colspan="3">
				<input type="checkbox" name="all" onclick="javascript:checkall();">
				<input class=submit type="submit" name="submit" value="X&aacute;c nh&#7853;n th&agrave;nh vi&ecirc;n">
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
