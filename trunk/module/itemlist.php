<? error_reporting (0); include "trunk/lagranj/config.php"; include "lagranj/config.php"; ?>
<?php
/*
 *      vote.php
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
?><div class="contentBox"><div class="innerBox">
<center><center><b> Вещи за бонусы</b></center><br></center>
<table width="600" align="center" style="padding: 5px;" border="1">
        <tr><td width="10%" style="padding:2px">&nbsp ID</td><td>&nbspНазвание</td><td width="20%">Цена</td></tr>

<? 
 mysql_connect ("$dbip:$dbport","$dblogin","$dbpass");
 mysql_selectdb (imwcp); 
 mysql_query ('set names cp1251'); 
 $result = mysql_query ("select item_id, name, price from item_list"); 
 while ($row = mysql_fetch_array ($result)) 
 { 
 $id = $row['item_id']; 
 $name = $row['name']; 
 $price = $row['price']; 

 echo "<tr><td><center><div class='navLinkInButton century  size14'>$id</div></center></td><td><center><a class='navLinkInButton blue century  size15' target=blank href=http://ru.wowhead.com/item=$id>$name</a></center></td><td><center><div class='navLinkInButton century  size14'>$price бонусов</div></center></td></tr>"; 
 } 
 ?>	

</table></div></div>