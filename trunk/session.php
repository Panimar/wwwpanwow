<?php
session_start();
	if ($_SESSION["loginmode"]!=1) {
		sleep(2);
		header("Location: /trunk/index.php");
		exit;
	}
?>