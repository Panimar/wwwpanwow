<div class="contentBox"><div class="innerBox">
<?php 
/*
 *      ticket.php
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

@$topic = trim(mysql_escape_string($_POST['topic']));
@$message = trim(mysql_escape_string($_POST['message']));


if($topic!="" and $message!="")	{
	$author = $_SESSION["uid"];
	$q = "INSERT INTO `ticket` (`topic`,`message`,`author`) VALUES ('%s','%s','%d')";
	$query = sprintf($q,$topic,$message,$author);
	$HOST->Query($query,"cpdb");
	$result = "<font color=\"#00FF07\"><b>Запрос отправлен</b></font>";		
}
else $result = "";
?>
<form method="post">
<table border="0" align="center" width="600">
<tr><td colspan="2"><center>Тема:<br><input name="topic" type="text" size="50" maxlength="200"></center></td></tr>
<tr><td colspan="2"><center>Сообщение:<br><textarea name="message" cols="50" rows="15" maxlength="1000"></textarea></center></td></tr>
<tr><td align="center"><input type="submit" value="Отправить"> <input type=reset value="Очистить"></td></tr>
</table>
<center><?php print $result; ?></center>
</form><br>
</div>