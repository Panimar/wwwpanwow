<? error_reporting (0); include "trunk/lagranj/config.php"; include "lagranj/config.php"; ?>

<div class="rightCol">	
<div class="rightBox">
					<h1> Статистика сервера</h1>
					<div class="contentBox">


						<div class="innerBox bg_1C1D1F">
							<img class="realmstatusicon" src="img/icons/status_1.png"/> <span class="realmname "> Название реалма</span>
							<span class="details"> &nbsp;&nbsp;&nbsp;Fun</span>
		<? error_reporting (0);				
					mysql_connect ("$dbip:$dbport","$dblogin","$dbpass"); 
					
 mysql_selectdb ("$cdb"); 
 $online = mysql_query ("select count(*) from characters where online = 1"); 
 $online = mysql_result ($online,0); 
 $allianceonline = mysql_query ("select count(*) from characters where online = 1 and race in (1,3,4,7,11)"); 
 $allianceonline = mysql_result ($allianceonline,0); 
 $hordeonline = mysql_query ("select count(*) from characters where online = 1 and race in (2,5,6,8,10)"); 
 $hordeonline = mysql_result ($hordeonline,0); 
 mysql_selectdb ("$rdb"); 
 $max = mysql_query ("select max(`maxplayers`) from uptime");         
 $max = mysql_result ($max,0); 
 echo "
 <div class='barBg'>
								<div style='width: 0%;' class='barFull'></div>
								<div class='nbPers'> $online / 1000</div>
							</div>

							<div class='factionRepart'>
								<img src='img/icons/mini_faction_1.png'/> <span class='percent'><b>Alliance :</b> <span class='blue4'>$allianceonline</span> </span>
								<img src='img/icons/mini_faction_0.png'/> <span class='percent'><b>Horde :</b> <span class='blue4'>$hordeonline</span> </span>
								<div class='spacer'></div>

							</div>
"; 

 ?>					
						
							<div>
								<input type="text" class="realmlist"  readonly="true" value="set realmlist xxxxxxxxxxxxxxxxxxxxx" />
							</div>							
						</div>
<div>
					<div class="spacer"></div>

						</div>						
					</div>
				</div>
				<div class="rightBox">
					<h1> Навигация</h1>
					<div class="contentBox">
						<div class="innerBox">
							
		<a class="block" href="/">Главная</a>
		<a class="block" href="/reg.php">Создать аккаунт</a>
		<a class="block" href="/tele.php">Телепорт</a>
		<a class="block" href="">Форум</a>
						</div>
					<div>
					<div class="spacer"></div>

						</div>

					</div>
				</div>
				<div class="spacer"></div><br><center>
<img src="./trunk/img/layout/joinus.png">
			</div>