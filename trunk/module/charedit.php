<div class="contentBox"><div class="innerBox">
<?php
if(isset($_GET['op'])) {
	$option = trim(mysql_escape_string($_GET['op']));
	$charguid  = intval($_GET['charguid']);
	$uid = $_SESSION["uid"];

	if($cChar->ChechCharInAcc($charguid, $uid)) {
		
		if($option=="chrace") {
			if(isset($_GET['race'])) {
				$new_race = intval($_GET['race']);
				if($cChar->CheckPossChangeRaceClass($new_race,$cChar->GetCharStats($charguid,"class"))) {
					if($cChar->ChangeRace($uid,$charguid,$new_race))
						echo "<center><b>Успешно!</b></center>";
					else echo "<center><b>Ошибка!</b></center>";
				} else { echo "<center><b>Ошибка!</b></center>"; exit;}				
			} else {
				$cur_class = $cChar->GetCharStats($charguid,"class");
				echo "<table align=\"center\">";
				echo "<tr><td>Персонаж:</td><td><b>".$cChar->GetCharStats($charguid,"name")."</b></td></tr>";
				echo "<tr><td>Раса:</td><td>".$RaceImgArray[$cChar->GetCharStats($charguid,"race")]."</td></tr>";
				echo "</table><br><center>";
				echo "Цена услуги <b>".$price_conf['ch_race_cost']."</b> бонусов<br>";
				echo "Вы можете выбрать одну из следующих рас:<br>";
				switch ($cur_class) {
				case '1': echo "
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=1\">".$RaceImgArray['1']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=2\">".$RaceImgArray['2']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=3\">".$RaceImgArray['3']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=4\">".$RaceImgArray['4']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=5\">".$RaceImgArray['5']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=6\">".$RaceImgArray['6']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=7\">".$RaceImgArray['7']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=8\">".$RaceImgArray['8']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=11\">".$RaceImgArray['11']."</a>
				" ; break;
				case '2': echo "
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=1\">".$RaceImgArray['1']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=3\">".$RaceImgArray['3']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=10\">".$RaceImgArray['10']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=11\">".$RaceImgArray['11']."</a>
				" ; break;
				case '3': echo "
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=2\">".$RaceImgArray['2']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=3\">".$RaceImgArray['3']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=4\">".$RaceImgArray['4']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=6\">".$RaceImgArray['6']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=8\">".$RaceImgArray['8']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=10\">".$RaceImgArray['10']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=11\">".$RaceImgArray['11']."</a>
				" ; break;
				case '4': echo "
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=1\">".$RaceImgArray['1']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=2\">".$RaceImgArray['2']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=3\">".$RaceImgArray['3']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=4\">".$RaceImgArray['4']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=5\">".$RaceImgArray['5']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=7\">".$RaceImgArray['7']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=8\">".$RaceImgArray['8']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=10\">".$RaceImgArray['10']."</a>
				" ; break;
				case '5': echo "
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=1\">".$RaceImgArray['1']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=3\">".$RaceImgArray['3']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=4\">".$RaceImgArray['4']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=5\">".$RaceImgArray['5']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=8\">".$RaceImgArray['8']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=10\">".$RaceImgArray['10']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=11\">".$RaceImgArray['11']."</a>
				" ; break;
				case '6': echo "
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=1\">".$RaceImgArray['1']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=2\">".$RaceImgArray['2']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=3\">".$RaceImgArray['3']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=4\">".$RaceImgArray['4']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=5\">".$RaceImgArray['5']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=6\">".$RaceImgArray['6']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=7\">".$RaceImgArray['7']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=8\">".$RaceImgArray['8']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=10\">".$RaceImgArray['10']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=11\">".$RaceImgArray['11']."</a>
				" ; break;
				case '7': echo "
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=2\">".$RaceImgArray['2']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=6\">".$RaceImgArray['6']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=8\">".$RaceImgArray['8']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=11\">".$RaceImgArray['11']."</a>
				"; break;
				case '8': echo "
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=1\">".$RaceImgArray['1']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=5\">".$RaceImgArray['5']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=7\">".$RaceImgArray['7']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=8\">".$RaceImgArray['8']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=10\">".$RaceImgArray['10']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=11\">".$RaceImgArray['11']."</a>
				"; break;
				case '9': echo "
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=1\">".$RaceImgArray['1']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=2\">".$RaceImgArray['2']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=5\">".$RaceImgArray['5']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=7\">".$RaceImgArray['7']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=10\">".$RaceImgArray['10']."</a>		
				"; break;
				case '11': echo "
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=4\">".$RaceImgArray['4']."</a>
					<a href=\"?do=charedit&charguid=$charguid&op=chrace&race=6\">".$RaceImgArray['6']."</a>
				"; break;
		} echo "</center>";
			}
		} elseif($option=="chclass") {
			if(isset($_GET['class'])) {
				$new_class = intval($_GET['class']);
				if($cChar->CheckPossChangeRaceClass($cChar->GetCharStats($charguid,"race"),$new_class)) {
					if($cChar->ChangeClass($uid,$charguid,$new_class))
						echo "<center><b>Успешно!</b></center>";
					else echo "<center><b>Ошибка!</b></center>";
				} else { echo "<center><b>Ошибка!</b></center>"; exit;}	
			} else {
				$cur_race = $cChar->GetCharStats($charguid,"race");
				echo "<table align=\"center\">";
				echo "<tr><td>Персонаж:</td><td><b>".$cChar->GetCharStats($charguid,"name")."</b></td></tr>";
				echo "<tr><td>Класс:</td><td>".$ClassImgArray[$cChar->GetCharStats($charguid,"class")]."</td></tr>";
				echo "</table><br><center>";
				echo "Цена услуги <b>".$price_conf['ch_class_cost']."</b> бонусов<br>";
				echo "Вы можете выбрать один из следующих классов:<br>";
				switch ($cur_race) {
					case '1': echo "
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=1\">".$ClassImgArray['1']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=2\">".$ClassImgArray['2']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=4\">".$ClassImgArray['4']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=5\">".$ClassImgArray['5']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=6\">".$ClassImgArray['6']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=8\">".$ClassImgArray['8']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=9\">".$ClassImgArray['9']."</a>
					"; break;
					case '2': echo "
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=1\">".$ClassImgArray['1']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=3\">".$ClassImgArray['3']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=4\">".$ClassImgArray['4']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=6\">".$ClassImgArray['6']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=7\">".$ClassImgArray['7']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=9\">".$ClassImgArray['9']."</a>
					"; break;
					case '3': echo "
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=1\">".$ClassImgArray['1']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=2\">".$ClassImgArray['2']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=3\">".$ClassImgArray['3']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=4\">".$ClassImgArray['4']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=5\">".$ClassImgArray['5']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=6\">".$ClassImgArray['6']."</a>
					"; break;
					case '4': echo "
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=1\">".$ClassImgArray['1']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=3\">".$ClassImgArray['3']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=4\">".$ClassImgArray['4']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=5\">".$ClassImgArray['5']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=6\">".$ClassImgArray['6']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=11\">".$ClassImgArray['11']."</a>
					"; break;
					case '5': echo "
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=1\">".$ClassImgArray['1']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=4\">".$ClassImgArray['4']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=5\">".$ClassImgArray['5']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=6\">".$ClassImgArray['6']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=8\">".$ClassImgArray['8']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=9\">".$ClassImgArray['9']."</a> 
					"; break;
					case '6': echo "
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=1\">".$ClassImgArray['1']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=3\">".$ClassImgArray['3']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=6\">".$ClassImgArray['6']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=7\">".$ClassImgArray['7']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=11\">".$ClassImgArray['11']."</a>
					"; break;
					case '7': echo "
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=1\">".$ClassImgArray['1']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=4\">".$ClassImgArray['4']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=6\">".$ClassImgArray['6']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=8\">".$ClassImgArray['8']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=9\">".$ClassImgArray['9']."</a>
					"; break;
					case '8': echo "
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=1\">".$ClassImgArray['1']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=3\">".$ClassImgArray['3']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=4\">".$ClassImgArray['4']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=5\">".$ClassImgArray['5']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=6\">".$ClassImgArray['6']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=7\">".$ClassImgArray['7']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=8\">".$ClassImgArray['8']."</a>
					"; break;
					case '10': echo "
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=2\">".$ClassImgArray['2']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=3\">".$ClassImgArray['3']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=4\">".$ClassImgArray['4']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=5\">".$ClassImgArray['5']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=6\">".$ClassImgArray['6']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=9\">".$ClassImgArray['9']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=8\">".$ClassImgArray['8']."</a>
					"; break;
					case '11': echo "
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=1\">".$ClassImgArray['1']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=2\">".$ClassImgArray['2']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=3\">".$ClassImgArray['3']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=5\">".$ClassImgArray['5']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=6\">".$ClassImgArray['6']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=7\">".$ClassImgArray['7']."</a>
						<a href=\"?do=charedit&charguid=$charguid&op=chclass&class=8\">".$ClassImgArray['8']."</a>
					"; break;
				}
			}
		} elseif($option=="mv") {
			if(isset($_POST['newacc']) and isset($_POST['email'])) {
				$newacc = trim(mysql_escape_string($_POST['newacc']));
				$email = trim(mysql_escape_string($_POST['email']));
				if($cAcc->CheckAccountExist($newacc)) {
					$data = $cAcc->GetAccIdPassMail($newacc);
					$acc_email = $data['email'];
					if($acc_email==$email) {
						$current_bonuses = $cChar->GetBonusesCount($uid);
						if($current_bonuses>$price_conf['mv_char_cost']) {
							$cChar->ModCharAcc($charguid,$data['id']);
							$cChar->ModBonusesCount($uid,$price_conf['mv_char_cost'],"-");
							echo "<center><b>Успешно!</b></center>";
						} else echo "<center><b>Недостаточно бонусов!</b></center>";
					} else echo "<center><b>E-mail введен не верно!</b></center>";
				} else echo "<center><b>Учётная запись не найдена!</b></center>";
			} else {
				echo "<form method=\"post\" action=\"?do=charedit&charguid=2&op=mv\">
					<center>Цена услуги: <b>".$price_conf['mv_char_cost']."</b> бонусов</center></br>
					<center>Новый аккаунт: </br><input name=\"newacc\" type=\"text\" size=\"20\" maxlength=\"20\"></center>
					<center>E-mail нового аккаунта: </br><input name=\"email\" type=\"text\" size=\"20\" maxlength=\"30\"></center>
					</br><center><input type=\"submit\" value=\"Перенести\"></center>
					</form>";
			}
		}
	} else echo "<center><b>Ошибка!</b></center>";
}
?></div></div>