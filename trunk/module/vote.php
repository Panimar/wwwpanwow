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
<center><center><b> Голосование за бонусы. Один раз в 24часа</b></center><br></center>
<table width="600" align="center" style="padding: 5px;" border="1">
        <tr><td width="35%" style="padding:2px">&nbspРейтинг</td><td>&nbspДействие</td><td width="10%">Бонусов</td></tr>
<?php
        $serviseselect = $HOST->Query("SELECT * FROM `game_top`","cpdb");
        //  if(mysql_num_rows($serviseselect) != 0) {
                while($rov = mysql_fetch_array($serviseselect)) {
                        echo "<tr><td><center>".$rov['name']."</center></td><td><center>".$cChar->CheckPossVote($rov['id'], $uid)."</center></td><td><center>".$rov['cost']."</center></td></tr>"; 
                }
      //   }
      //   else echo "<td colspan=2>Администрация еще не добавила ТОПы в список!</td>";
        settype($serviseselect,"NULL");
        settype($rov,"NULL");           
?>
</table></div></div>