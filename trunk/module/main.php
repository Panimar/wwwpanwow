<?php
/*
 *      main.php
 *      
 *      Copyright 2011 unro <unro.ua@gmail.com>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */ 

$uid = $_SESSION["uid"];

$select = $HOST->Query("SELECT `id`,`email`,`last_ip`,`bonuses` FROM `account` WHERE `id`='$uid'","authdb");
$accinfo = mysql_fetch_array($select);
?><div class="contentBox"><div class="innerBox">
<center><b> Информация </b></center><br>
<table width="600" align="center" border="1">
	<tr>
		<td>		
			<table>
			<tr><td> 
				<tr width="50"><td>Аккаунт:</td><td><b><?php print $_SESSION["accname"]; ?></b></td></tr>
				<tr><td>Бонусов:</td><td><font color="#00FF03"><?php echo $accinfo['bonuses']; ?></font></td></tr>
				<tr><td>E-mail:</td><td><?php echo $accinfo['email'];?></td></tr>
				<tr><td>Забанен:</td><td><?php if($cAcc->Checkban($uid)) echo "<font color=\"#FF0000\">Да</font>"; else echo "<font color=\"#00FF03\">Нет</font>";?></td></tr>
				<tr><td>IP-адрес:</td><td><?php echo $accinfo['last_ip']; ?></td></tr>				
			</td></tr>
			</table>
		
		</td>
		<td>
		<table id="charlist">
			<tr><td><?php $cChar->PrintCharslist($uid); ?></td></tr>
		</table>
		</td>
	</tr>
</table>
<?php
	if(isset($_GET['charguid'])) include ("character.php");
?></div></div>