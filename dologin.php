<?php
/*
 *      dologin.php
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
 
include ("./trunk/include/core.php");
session_start();

$ulogin = trim(mysql_escape_string($_POST['login']));
$upass = trim(mysql_escape_string($_POST['pass']));

if($cAcc->CheckAccountExist($ulogin)) {
		$uarray = $cAcc->GetAccIdPassMail($ulogin);
		$pass = $uarray['sha_pass_hash'];
		$sph =  sha1(strtoupper("$ulogin") .":". strtoupper("$upass"));
		if($sph==$pass) {
				//if(GetGMLevel($uarray['id'])==4)
				//	{ $_SESSION["adminmode"]=1;}
				$_SESSION["loginmode"]=1;
				$_SESSION["realmid"]=1;
				$_SESSION["uid"]=$uarray['id'];
				$_SESSION["accname"]=$ulogin;
				header("Location: trunk/index.php");
		} else {
				sleep(2);
				header("Location: index.php?login=false");
		}
} else {
		sleep(2);
		header("Location: index.php?login=false");
}
?> 