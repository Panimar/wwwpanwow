<?php
/*
 *      dovote.php
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
 
include ("../session.php");
include ("../include/core.php");

if(isset($_GET['tid'])) {
$tid = intval($_GET['tid']);
$uid = $_SESSION["uid"];
$cur_time = GetDataTime();

$selectvv = $HOST->Query("SELECT * FROM `vote_var` WHERE `topid`='$tid' AND `accid`='$uid'","cpdb");
$vva_ = mysql_fetch_array($selectvv);

$selectgt = $HOST->Query("SELECT * FROM `game_top` WHERE `id`='$tid'","cpdb");
$gta_ = mysql_fetch_array($selectgt);
$vote_link = $gta_["link"];
$bonuses = $gta_['cost'];

$vvc = mysql_num_rows($selectvv);
if ($vvc == 0) {
	$HOST->Query("INSERT INTO `vote_var` VALUES ('$tid','$uid','$cur_time')","cpdb");
	$cChar->ModBonusesCount($uid,$bonuses,"+");
	header("Location: $vote_link ");
} else {
	$last_votetime = $vva_['votetime'];
	$time = GetDataTime(gmtime() - 86400);
	if ($last_votetime < $time) {
		$HOST->Query("REPLACE INTO `vote_var` VALUES ('$tid','$uid','$cur_time')","cpdb");
		$cChar->ModBonusesCount($uid,$bonuses,"+");
		header("Location: $vote_link");
	} else {  header("Location: ../index.php"); }
  }
 }
?>