<div class="contentBox"><div class="innerBox">
<?php
 
//include ("../inclide/core.php");

$uid = $_SESSION["uid"];

if(!isset($_GET['buy'])) {
	if(!isset($_GET['item'])) {
		if(!isset($_POST['itm'])) {
			?><form method="post" action="?do=store">
			<div align="center" style="padding:5px;">
			<b>ID ��������</b>
			<br>
			<input name="itm" type="text" size="5" maxlength="8">
			<input type="submit" value="������">
			<br>
			<p style="font-size: 11px; color: orange;">���������� �� ���������, ������� ������ � ������� <b><i><a href="?do=itemlist">���</a></i></b>.</p>
			</div>
			</form><?php
		} else {
			$tempitemid = intval($_POST['itm']);
			$cShop->PrintCharlist($uid,$tempitemid);
		}
	} else {
		$itemid = intval($_GET['item']);
		$charid = intval($_GET['char']);
		if($cShop->CheckItem($itemid)) {
			$itemarray = $cShop->ItemInfo($itemid);
			echo "<center>";
			echo "������ �������: <b>".$itemarray['name']."</b><br>";
			echo "���� ��������: <b>".$itemarray['price']."</b><br>";
			echo "<input type='button' onclick=location.href='?do=store&item=$itemid&char=$charid&buy=1' value='������'>";
			echo "</center>";
		} else echo "<center><b>���� ������� ���������� ������!</b></center>";
	}
} else {
	$buy = intval($_GET['buy']);
	$itemid = intval($_GET['item']);
	$charid = intval($_GET['char']);
	if(($buy==1) and ($itemid!="") and ($charid!="")) $cShop->BuyItem($itemid, $charid, $uid);
}
?>
</div></div>