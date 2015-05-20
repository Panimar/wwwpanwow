<?php

include ("config.php");
include ("array.php");

function GetDataTime($timestamp = 0) {
if ($timestamp)
	return date("Y-m-d H:i:s", $timestamp);
else
	return date("Y-m-d H:i:s");
}

function gmtime() 
{
return strtotime(GetDataTime());
}

class Connect
{
	var $m_conf;
	var $b_conf;	
	function __construct() {
		global $mysql_conf,$db_conf;
		$this->m_conf = $mysql_conf;
		$this->b_conf = $db_conf;
	}
	function Query($query, $db) {
		$host = $this->m_conf['dbhost'];
		$port = $this->m_conf['dbport'];
		$conn_id = mysql_connect("$host:$port",$this->m_conf['dbuser'],$this->m_conf['dbpass']) or die("Could not Connect");
		mysql_select_db($this->b_conf["$db"]) or die("Could not select Database ".$db."!");
		$db_encode = $this->m_conf['dbencode'];
		mysql_query("SET CHARACTER SET $db_encode",$conn_id);
		mysql_query("SET NAMES $db_encode",$conn_id);
		return $do_query = mysql_query($query,$conn_id);
		settype($do_query, "null"); 
		mysql_close($conn_id); 
	}
}

class Character extends Connect
{
	function __construct() {
		parent::__construct();
	}
	function GetCharDB() {
		$db = sprintf("chardb%d",$_SESSION["realmid"]);
		return $db;
	}
	function GetBonusesCount($uid) {
		$q = "SELECT `bonuses` FROM `account` WHERE `id`='%d'";
		$query = sprintf($q,$uid);
		$select = $this->Query($query,"authdb");
		$array = mysql_fetch_array($select);
		$bonuses = $array['bonuses'];
		return $bonuses;
	}
	function ModBonusesCount($uid,$b_count,$op) {
		$q = "UPDATE `account` SET  `bonuses`=`bonuses`".$op."'%d' WHERE `id`='%d'";
		$query = sprintf($q,$b_count,$uid);
		$this->Query($query,"authdb");
	}
	function CheckPossChangeRaceClass($_race,$_class) {
		global $RaceClassArray;
		$data = $RaceClassArray[$_race][$_class];
		if($data==1) return true; else return false;		
	}
	function ChechCharInAcc($charguid, $uid) {
		$db = sprintf("chardb%d",$_SESSION["realmid"]);
		$q  = "SELECT 1 FROM `characters` WHERE `guid`='%d' AND `account`='%d'";
		$query = sprintf($q, $charguid, $uid);
		$select = $this->Query($query,$db);
		$count = mysql_num_rows($select);
		settype($select,"NULL");
		if($count==1) return true; else return false;
	}
	function CheckPossVote($topid, $accguid) {
		$select = $this->Query("SELECT * FROM `vote_var` WHERE `topid`='$topid' AND `accid`='$accguid'", "cpdb");
		$array = mysql_fetch_array($select);
		$count = mysql_num_rows($select);
		if ($count == 0) return "<input id='loginButton' class='pulseButton'  type='button' onclick=location.href='./module/dovote.php?tid=$topid' value='Проголосовать'>";
		else {
			$last_votetime = $array["votetime"];
			$time = GetDataTime(gmtime() - 86400);
			if($last_votetime < $time) return "<input id='loginButton' class='pulseButton' type='button' onclick=location.href='./module/dovote.php?tid=$topid' value='Проголосовать'>";
			else return "<i><font color='white'>Уже голосовали!</font></i>";
		}
		settype($select,"NULL");
	}
	function ChangeRace($uid,$charguid,$race) {
		global $price_conf;
		$current_bonuses = $this->GetBonusesCount($uid);
		if($current_bonuses>$price_conf['ch_race_cost']) {
			$db = $this->GetCharDB();
			$this->Query("DELETE FROM `group_member` WHERE `guid`=".$charguid."",$db);
			$this->Query("DELETE FROM `groups` WHERE `leaderGuid`=".$charguid."",$db);
			$this->Query("DELETE FROM `guild` WHERE `leaderguid`=".$charguid."",$db);
			$this->Query("DELETE FROM `guild_member` WHERE `guid`=".$charguid."",$db);
			$this->Query("DELETE FROM `character_aura` WHERE `guid`=".$charguid."",$db);
			$this->Query("DELETE FROM `character_homebind` WHERE `guid`=".$charguid."",$db);
			$this->Query("UPDATE `characters` SET `race`='".$race."' WHERE `guid`=".$charguid."",$db);
			$this->Query("UPDATE `characters` SET `at_login`=`at_login`+'8' WHERE `guid`=".$charguid."",$db);
			$this->ModBonusesCount($uid,$price_conf['ch_race_cost'],"-");
			return true;			
		} else return false;		
	}
	function ChangeClass($uid,$charguid,$class) {
		global $price_conf;
		$current_bonuses = $this->GetBonusesCount($uid);
		if($current_bonuses>$price_conf['ch_class_cost']) {
			$db = $this->GetCharDB();
			$this->Query("UPDATE `characters` SET `at_login`='6' WHERE `guid`=".$charguid."",$db);
			$this->Query("UPDATE `characters` SET `class`='".$class."' WHERE `guid`=".$charguid."",$db);
			$this->ModBonusesCount($uid,$price_conf['ch_class_cost'],"-");
			return true;
		} else return false;
	}
	function ChangeCharName($uid,$charguid) {
		global $price_conf;
		$current_bonuses = $this->GetBonusesCount($uid);
		if($current_bonuses>$price_conf['rename_char_cost']) {
			$db = $this->GetCharDB();
			$this->Query("UPDATE `characters` SET `at_login`='1' WHERE `guid`=".$charguid."",$db);
			$this->ModBonusesCount($uid,$price_conf['rename_char_cost'],"-");
			return true;
		} else return false;
	}
	function ModCharAcc($charguid,$accid) {
		$db = $this->GetCharDB();
		$q = "UPDATE `characters` SET `account`='%d' WHERE `guid`='%d'";
		$query = sprintf($q,$accid,$charguid);
		$this->Query($query,$db);
		return true;
	}
	function PrintCharslist($accguid) {
		$db = $this->GetCharDB();
		$q = "SELECT `guid`,`name`,`race`,`class`,`gender`,`level` FROM `characters` WHERE `account`='%d'";
		$query = sprintf($q, $accguid);
		$chararray = $this->Query($query, $db);
		echo "<table>";
		echo "<tr><td>Имя</td><td>Класс</td><td>Раса</td><td>Уровень</td></tr>";
		while($chars = mysql_fetch_array($chararray)) {
			echo "<tr><td><a href=?do=main&charguid=".$chars['guid'].">".$chars['name']."</a></td><td><img src=./template/default/img/class/".$chars['class'].".png></td><td><img src=./template/default/img/race/".$chars['race']."-".$chars['gender'].".png></td><td>".$chars['level']."</td></tr>";
		}
		echo "</table>"; 
		mysql_free_result($chararray);		
	}
	function GetCharSide($charguid) {
		// 0 - Ali; 1 - Horde;
		$char_race  = $this->GetCharStats($charguid,"race");
		$data = array ("1"=>"0","1","0","0","1","1","0","1","10"=>"1","11"=>"0");
		$side = $data[$char_race];
		return  $side;
	}
	function GetCharStats($charguid, $stat) {
	    error_reporting (0);
		$db = $this->GetCharDB();
		$q = "SELECT `%s` FROM `characters` WHERE `guid`='%d'";
		$query = sprintf($q,$stat,$charguid);
		$select = $this->Query($query,$db);
		$data = mysql_fetch_array($select);
		$char_stat = $data["$stat"];
		return  $char_stat;
	}
	function PrintCharGold($charguid) {
		$gold = $this->GetCharStats($charguid,"money");
		$money_g = (int)($gold/10000);
		$total_money = $gold - ($money_g*10000);
		$money_s = (int)($total_money/100);
		$money_c = $total_money - ($money_s*100);
		$print = "".$money_g."<img src=./template/default/img/money/g.png>".$money_s."<img src=./template/default/img/money/s.png>".$money_c."<img src=./template/default/img/money/c.png>";
		return $print;
	}
	function CharFix($charguid)	{
		$uid = $_SESSION["uid"];
		$db = $this->GetCharDB();
		$q  = "SELECT * FROM `character_homebind` WHERE `guid`='%d'";
		$query = sprintf($q, $charguid);
		$select = $this->Query($query,$db);
		$chars = mysql_fetch_array($select);
		$px = $chars['position_x']; $py = $chars['position_y']; $pz = $chars['position_z']; $pm = $chars['map'];
		if($this->ChechCharInAcc($charguid, $uid)) {
			$this->Query("UPDATE `characters` SET `position_x`='$px', `position_y`='$py', `position_z`='$pz', `map`='$pm' WHERE `guid`='$charguid'", $db);
			$this->Query("DELETE FROM `character_aura` WHERE `guid`='$charguid'", $db);
			$this->Query("DELETE FROM `group_member` WHERE `memberGuid`='$charguid'", $db);
			return true;
		} else return false;
		settype($select,"NULL");
	}
}

class Account extends Connect
{
	function __construct() {
		parent::__construct();
	}
	function CheckAccountExist($accname) {
		$q = "SELECT 1 FROM `account` WHERE `username` = '%s'";
		$query = sprintf($q,$accname);
		$result = $this->Query($query,"authdb");
		if (mysql_num_rows($result)==1) return true; else return false;
	}
	function GetAccIdPassMail($accname) {
		$q = "SELECT `id`,`sha_pass_hash`,`email` FROM `account` WHERE `username` = '%s'";
		$query = sprintf($q, $accname);
		$data = $this->Query($query, "authdb");
		$result = mysql_fetch_array($data);
		return $result;
	}
	function Checkban($accguid) {
	$select = $this->Query("SELECT `active` FROM `account_banned` WHERE `id`=$accguid","authdb");
		if(mysql_num_rows($select)!=0) {
			$array = mysql_fetch_array($select);
			$active = $array['active'];
			if($active==0) return false;
			else return true;
		}
		else return false;
	}
	function ChangePassword($newp,$oldp,$accname,$accguid) {
		$q = "SELECT `sha_pass_hash` FROM `account` WHERE `id` = '%d'";
		$query = sprintf($q, $accguid);
		$user_a = mysql_fetch_array($this->Query($query,"authdb"));
		$pass = $user_a['sha_pass_hash'];
		$sph =  sha1(strtoupper("$accname") .":". strtoupper("$oldp"));
		if ($sph==$pass) {
			$newsph = sha1(strtoupper("$accname") .":". strtoupper("$newp"));
			$q = "UPDATE `account` SET `sha_pass_hash`='%s' WHERE `id`='%d'";
			$query = sprintf($q, $newsph, $accguid);
			$this->Query($query,"authdb");
			echo "<center><b><font color=\"#00FF00\">Пароль изменен!</font></b></center>";
		} else {
			echo "<center><b><font color=\"#FF0000\">Ошибка!</font></b><br>";
			echo "<a href=\"?do=edit&op=pchange\">Назад</a></center>";
		}
	}
	function ChangeEmail($newemail,$accguid) {
			$q = "UPDATE `account` SET `email`='%s' WHERE `id`='%d'";
			$query = sprintf($q, $newemail, $accguid);
			$this->Query($query,"authdb");
			echo "<center><b><font color=\"#00FF00\">e-mail изменен!</font></b></center>";		
	}
	function Unban($accguid) {
		global $price_conf;
		if(!$this->Checkban($accguid))
			echo "<center><b><font color=\"#00FF00\">Ваша учетная запись не забанена!</font></b></center>";
		else {
			$q =  "SELECT `bonuses` FROM `account` WHERE `id`='%d'";
			$query = sprintf($q, $accguid);
			$user_a = mysql_fetch_array($this->Query($query,"authdb"));
			$bonuses = $user_a['bonuses'];
			if($bonuses<$price_conf['unban_cost'])
				echo "<center><b><font color=\"#FF0000\">У Вас недостаточно бонусов для совершения этой операции!</font></b></center>";
			else {
				$this->Query("UPDATE `account` SET `bonuses`=bonuses-".$price_conf['unban_cost']." WHERE `id`='$accguid'","authdb");
				$this->Query("DELETE FROM `account_banned` WHERE `id`='$accguid'","authdb");
				echo "<center><b><font color=\"#00FF00\">Учетная запись разбанена!</font></b></center>";
			}
		}
	}
	function SetRealmID($realmid) {
		if($this->CheckRealm($realmid))
			$_SESSION["realmid"] = $realmid;
	}
	function GetRealmsID () {
		$q = "SELECT `id`,`name` FROM `realmlist`";
		return $getrealms = $this->Query($q,"authdb");
	}
	function CheckRealm ($realmid) {
		$q = "SELECT 1 FROM `realmlist` WHERE `id`='%d'";
		$query = sprintf($q,$realmid);
		$get = $this->Query($query,"authdb");
		if(mysql_num_rows($get)==1) return true; else return false;
	}
	function PrintRealms() {
		$getrealms = $this->GetRealmsID ();
		echo "<form method=\"get\">";
		echo "<select name=\"realmid\" id=\"realmid\" size=\"1\">";
		echo "<option value=\"0\">Выберите Реалм</option>";
		while($realms = mysql_fetch_array($getrealms)) { 
			echo "<option value=".$realms['id'].">".$realms['name']."</option>";
		}
		echo "</select>";
		echo "<input type=submit value=\"Сменить\">";
		settype($getrealms,"null");		
	}
}
	
	
class Shop extends Character
{
	function __construct() {
		parent::__construct();
	}
	function GetMaxMailID() {
		$db = $this->GetCharDB();
		$s_mailid = mysql_fetch_array($this->Query("SELECT MAX(id) FROM `mail` LIMIT 1",$db));
		$mailid = $s_mailid['MAX(id)'];
		$temp_mid = ($mailid+5);
		return $temp_mid;
	}
	function GetMaxItemID() {
		$db = $this->GetCharDB();
		$s_itemidarray = mysql_fetch_array($this->Query("SELECT MAX(guid) FROM `item_instance` LIMIT 1",$db));
		$temp_itemid = $s_itemidarray['MAX(guid)'];
		$itemguid = ($temp_itemid+10);
		return $itemguid;
	}
	function SendItem ($maxitem, $itemid, $db) {
		$send_item = "INSERT INTO `item_instance` (`guid`,`itemEntry`) VALUES ('$maxitem','$itemid')";
		$this->Query($send_item,$db);
	}
	function SendMail($maxmail, $maxitem, $itemid, $charguid) {
		$db = $this->GetCharDB();
		$mail_items = "INSERT INTO `mail_items` VALUES ('$maxmail','$maxitem','$charguid')";
		$mail = "INSERT INTO `mail` (`id`,`messageType`,`stationery`,`receiver`,`subject`,`body`,`has_items`) VALUES ('$maxmail',0,61,'$charguid','Donate!','Спасибо за помощь серверу!','1')";
		$this->SendItem($maxitem, $itemid,$db);
		$this->Query($mail_items,$db);
		$this->Query($mail,$db);		
	}
	function BuyItem($itemid,$charguid, $uid) {
		if($this->CheckItem($itemid)) {
			if($this->ChechCharInAcc($charguid,$uid)) {
				$bonuses = $this->GetBonusesCount($uid);
				$itemarray = $this->ItemInfo($itemid);
				$itemprice = $itemarray['price'];
				if($bonuses>$itemprice) {
					$maxitem = $this->GetMaxItemID();
					$maxmail = $this->GetMaxMailID();
					$this->SendMail($maxmail, $maxitem, $itemid, $charguid);
					$bon = ($bonuses-$itemprice);
					$upd_bonuses = "UPDATE `account` SET `bonuses`='$bon' WHERE `id`='$uid'";
					$this->Query($upd_bonuses,"authdb");
					echo "<center>Предмет отправлен выбраному персонажу на почту! У вас снято <b>".$itemprice."</b> бонусов!</center>";
				} else echo "<center>У вас недостаточно бонусов!</center>";
			} else echo "<center><b>Ошибка!</b></center>";
		} else echo "<center><b>Этот предмет невозможно купить!</b></center>";
	}
	function ItemInfo($itemid) {
		$q = "SELECT * FROM `item_list` WHERE `item_id`='%d'";
		$query = sprintf($q,$itemid);
		$iteminfo = $this->Query($query,"cpdb");
		$itemarray = mysql_fetch_array($iteminfo);
		return $itemarray;
	}
	function CheckItem($itemid) {
		$q = "SELECT 1 FROM `item_list` WHERE `item_id`='%d'";
		$query = sprintf($q, $itemid);
		$select = $this->Query($query,"cpdb");
		$count = mysql_num_rows($select);
		if($count==1) return true; else return false;
	}
	function PrintCharlist($accguid,$itemid) {
		$db = $this->GetCharDB();
		$q  = "SELECT `guid`,`name` FROM `characters` WHERE `account`='$accguid'";
		$select = $this->Query($q,$db);
		echo "<center>";
		echo "Выберите персонажа<br>";
			while($chars = mysql_fetch_array($select)) {
				echo "<a href=?do=store&item=$itemid&char=".$chars['guid'].">".$chars['name']."</a><br>";
			}
		mysql_free_result($select);
		echo "</center>";
	}
}	
	
$HOST = new Connect;		
$cChar = new Character;
$cAcc = new Account;
$cShop = new Shop;

?>