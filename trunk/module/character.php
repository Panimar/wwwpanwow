<?php

$uid = $_SESSION["uid"];
 
$charguid = intval($_GET['charguid']);

if($cChar->ChechCharInAcc($charguid,$uid)) {
	if(isset($_GET['op'])) {
		$_do = intval($_GET['op']);
		switch ($_do) {
			case '1': if($cChar->CharFix($charguid)) $result = "<left><b><font color=#00FF00>���������!</font></b></left>"; break;
			case '2': if($cChar->ChangeCharName($uid,$charguid)) $result = "<left><b><font color=#00FF00>��� ����� �������� ��� ��������� ����� � ����!</font></b></left>"; else echo $result="<left><b><font color=#FF0000>����� ".$price_conf['rename_char_cost']."</font></b></left>" ; break;
		}
	}
	echo $result;
	echo "<fieldset><legend><font size=\"4\">&nbsp;<b>".$cChar->GetCharStats($charguid,"name")."</b>&nbsp;</font></legend>";
	echo "<table width=auto align=left border=0>";
	echo "<tr>
			<td rowspan=\"2\"><img src=./template/default/img/side/".$cChar->GetCharSide($charguid).".gif align=absmiddle></td>
			<td><img src=./template/default/img/race/".$cChar->GetCharStats($charguid,"race")."-".$cChar->GetCharStats($charguid,"gender").".png align=right></td>
			<td><img src=./template/default/img/class/".$cChar->GetCharStats($charguid,"class").".png align=\"left\"></td>
		 </tr>";
	echo "<tr><td colspan=\"2\"><img src=./template/default/img/status/".$cChar->GetCharStats($charguid,"online").".png align=absmiddle></td></tr>";
	echo "</table>";
	echo "</fieldset>";
	echo "<fieldset><legend><font size=\"3\">&nbsp;������&nbsp;</font></legend>
		�����: ".$cChar->GetCharStats($charguid,"health")."<br>
		�������: ".$cChar->GetCharStats($charguid,"level")."<br>
		������: ".$cChar->PrintCharGold($charguid)."<br>		
		</fieldset>";
	echo "<fieldset><legend><font size=\"3\">&nbsp;PvP&nbsp;</font></legend>
		������� �����: ".$cChar->GetCharStats($charguid,"totalKills")."<br>
		������� �������: ".$cChar->GetCharStats($charguid,"todayKills")."<br>
		������� �����: ".$cChar->GetCharStats($charguid,"yesterdayKills")."<br>
		����� �����: ".$cChar->GetCharStats($charguid,"totalHonorPoints")."<br>
		����� �����: ".$cChar->GetCharStats($charguid,"arenaPoints")."<br>
		</fieldset>";
	echo "<fieldset><legend><font size=\"3\">&nbsp;���������� ����������&nbsp;</font></legend>
		<input type='button' onclick=location.href=\"?do=main&charguid=$charguid&op=1\" value=\"���������\">
		<input type='button' onclick=location.href=\"?do=main&charguid=$charguid&op=2\" value=\"������� ��� (".$price_conf['rename_char_cost']." �������)\">
		<input type='button' onclick=location.href=\"?do=charedit&charguid=$charguid&op=chrace\"  value=\"������� ����\">	
<input type='button' onclick=location.href=\"?do=charedit&charguid=$charguid&op=chclass\"  value=\"������� �����\">	
<input type='button' onclick=location.href=\"?do=charedit&charguid=$charguid&op=mv\"  value=\"���������\">
		</fieldset>";
} else echo "<center><b>������!</b></center>";
?>