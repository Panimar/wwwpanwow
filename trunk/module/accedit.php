<div class="contentBox" style="width;600px;"><div class="innerBox" style="width;600px;">
<?php

$uid = $_SESSION["uid"];
@$opstat = intval($_GET['st']);

if(!isset($_GET['op'])) $_GET['op']="";

if($_GET['op']=="") {
	echo "<div align=center style=padding:5px;>
		<a class='navLinkInButton green century  size15' href=\"?do=edit&op=pchange\">����� ������</a><br><hr>
		<a class='navLinkInButton green century  size15' href=\"?do=edit&op=echange\">����� e-mail</a><br><hr>
		<a class='navLinkInButton green century  size15' href=\"?do=edit&op=unban\">������ ��������</a><br>
	</div>";
}
elseif($_GET['op']=="pchange") {
	if ($opstat==0) {
	
		echo "<center><form  method=\"post\" action=\"?do=edit&op=pchange&st=1\"><table>";
		echo "<tr><td>������ ������:</td><td><input name=\"oldpass\" type=\"password\" size=\"10\" maxlength=\"20\"></td></tr>";
		echo "<tr><td>����� ������:</td><td><input name=\"newpass\" type=\"password\" size=\"10\" maxlength=\"20\"></td></tr>";
		echo "<tr><td colspan=\"2\"  align=\"center\"><input type=\"submit\" value=\"�������\"></td></tr>";
		echo "</table></form></center>";
		
	}
	else {
		$np =  trim(mysql_escape_string($_POST['newpass']));
		$op =  trim(mysql_escape_string($_POST['oldpass']));
		$cAcc->ChangePassword($np,$op,$_SESSION["accname"],$_SESSION["uid"]);
	}
}
elseif($_GET['op']=="echange") {
	if ($opstat==0) {
		echo "<div align=center style=padding:5px><form  method=\"post\" action=\"?do=edit&op=echange&st=1\">";
		echo "����� e-mail: <input name=\"newemail\" type=\"text\" size=\"15\" maxlength=\"20\"><br>";
		echo "<input type=\"submit\" value=\"�������\">";
		echo "</form></div>";
	}
	else {
		$nm =  trim(mysql_escape_string($_POST['newemail']));
		if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $nm)) {
			echo "<center>";
			echo "<b><font color=\"#FF0000\">e-mail ������ �������!</font></b><br>";
			echo "<a href=\"?do=edit&op=echange\">�����</a>";
			echo "</center>";
		} else $cAcc->ChangeEmail($nm,$_SESSION["uid"]);
	}
}

elseif($_GET['op']=="unban") {
	if($opstat ==0) {
		if (!$cAcc->Checkban($uid))
			echo "<center><b><font color=\"#00FF00\">���� ������� ������ �� ��������!</font></b></center>";
		else {
			echo "<div align=center style=padding:5px;>���� ������ ����: <b>".$price_conf['unban_cost']."</b> �������<br>";
			echo "<input type='button' onclick=location.href='?do=edit&op=unban&st=1' value='����� ���'>";
		}
	} else $cAcc->Unban($uid);
}
?>
</div></div>