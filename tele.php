<? include "trunk/lagranj/header.php"?> 
<? include "trunk/lagranj/top.php"?>  
<div class="lContent">
    
<div id="newsBlock">
				<h1> Персонаж должен не должен находиться в игре</h1>
				<div id="newsContainer">


							<div id="n1" class="news  opened" rel="news-1">
								<h2>Телепорт</h2>
								<div align="center" class="newscontent" >								
								<table width="650">	
<?
include("lang.php");
include("trunk/lagranj/config.php");
echo "<center><title>$C_title</title>";
$account=$_POST['account'];
$pass=$_POST['pass'];
$character=$_POST['character'];
$teleport=$_POST['teleport'];
$act=$_GET['act'];

echo "<center>";
switch($act)
	{
	case teleport:
		if(($account==null) or ($pass==null) or ($character==null))
			{
			echo "<font color=red><b>$L_errorline!</b></font><br><br>";
			}
		else
			{
			$link = @mysql_connect($db_host, $db_user, $db_pass) or die("$L_error $L_errormysql");
			mysql_select_db($db_realmd, $link) or die("$L_error $L_errorselectbase $db_realmd");
			
			$passhash = sha1(strtoupper($account).":".strtoupper($pass));
			
            $sql = mysql_query ("SELECT * FROM `account` WHERE `username`='$account';");
			while ($row = mysql_fetch_array($sql))
				{
				$accountid = $row['id'];
				$username = $row['username'];
				$password = $row['sha_pass_hash'];
				}

			mysql_select_db($db_characters, $link) or die("$L_error $L_errorselectbase $db_characters");
			$sql = mysql_query ("SELECT * FROM `characters` WHERE `name`='$character';");
			while ($row = mysql_fetch_array($sql))
				{
				$tempguid = $row['guid'];
				$tempaccount = $row['account'];
				$online = $row['online'];
				$getrace = $row['race'];
				}
			if (($getrace == 1) or ($getrace == 3) or ($getrace == 4) or ($getrace == 7) or ($getrace == 11))
				$race = 1; //Alliance
            if (($getrace == 2) or ($getrace == 5) or ($getrace == 6) or ($getrace == 8) or ($getrace == 10))
				$race = 2; //Horde
			if ($username == null)
			    {
			    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_erroraccount.<br><br><a href=tele.php>$L_back</a></table>";
			    }
			else
			    {
				if ($passhash == $password)
					{
					if ($tempaccount == $accountid)
					    {
						if ($online == 0)
						    {
						    switch($teleport)
						        {
						        case 1:
						            {
						            if ($race == 1)
						                {
						                mysql_query ("UPDATE `characters` SET `position_x`=-8833.38, `position_y`=628.628, `position_z`=94.0066, `map`=0, `orientation`=1.06535 WHERE `name`='$character';");
						                echo "<table width='650'>$L_character $character $L_telein <b>$L_Stormwind</b>.<br><br><a href=tele.php>$L_back</a></table>";
						                }
                                    else
                                        {
									    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_telewar <font color=blue><b>$L_alliance</b></font>.<br><br><a href=tele.php>$L_back</a></table>";
									    }
                                    break;
						            }
								case 2:
								    {
						            if ($race == 1)
						                {
						                mysql_query ("UPDATE `characters` SET `position_x`=-4918.88, `position_y`=-940.406, `position_z`=501.564, `map`=0, `orientation`=5.42347 WHERE `name`='$character';");
						                echo "$L_character $character $L_telein <b>$L_Ironforge</b>.<br><br><a href=tele.php>$L_back</a>";
						                }
                                    else
                                        {
									    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_telewar <font color=blue><b>$L_alliance</b></font>.<br><br><a href=tele.php>$L_back</a></table>";
									    }
                                    break;
						            }
								case 3:
								    {
						            if ($race == 1)
						                {
						                mysql_query ("UPDATE `characters` SET `position_x`=9949.56, `position_y`=2284.21, `position_z`=1341.4, `map`=1, `orientation`=1.59587 WHERE `name`='$character';");
						                echo "<table width='650'>$L_character $character $L_telein <b>$L_Darnassus</b>.<br><br><a href=tele.php>$L_back</a></table>";
						                }
                                    else
                                        {
									    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_telewar <font color=blue><b>$L_alliance</b></font>.<br><br><a href=tele.php>$L_back</a></table>";
									    }
                                    break;
						            }
								case 4:
								    {
						            if ($race == 1)
						                {
						                mysql_query ("UPDATE `characters` SET `position_x`=-3965.7, `position_y`=-11653.6, `position_z`=-138.844, `map`=530, `orientation`=0.852154 WHERE `name`='$character';");
						                echo "<table width='650'>$L_character $character $L_telein <b>$L_Exodar</b>.<br><br><a href=tele.php>$L_back</a></table>";
						                }
									else
									    {
									    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_telewar <font color=blue><b>$L_alliance</b></font>.<br><br><a href=tele.php>$L_back</a></table>";
									    }
                                    break;
						            }

                                case 5:
						            {
						            if ($race == 2)
						                {
						                mysql_query ("UPDATE `characters` SET `position_x`=1629.36, `position_y`=-4373.39, `position_z`=31.2564, `map`=1, `orientation`=3.54839 WHERE `name`='$character';");
						                echo "<table width='650'>$L_character $character $L_telein <b>$L_Orgrimmar</b>.<br><br><a href=tele.php>$L_back</a></table>";
						                }
                                    else
                                        {
									    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_telewar <font color=red><b>$L_horde.</b></font><br><br><a href=tele.php>$L_back</a></table>";
									    }
                                    break;
						            }
								case 6:
								    {
						            if ($race == 2)
						                {
						                mysql_query ("UPDATE `characters` SET `position_x`=-1277.37, `position_y`=124.804, `position_z`=131.287, `map`=1, `orientation`=5.22274 WHERE `name`='$character';");
						                echo "<table width='650'>$L_character $character $L_telein <b>$L_Thunder_Bluff</b>.<br><br><a href=tele.php>$L_back</a></table>";
						                }
                                    else
                                        {
									    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_telewar <font color=red><b>$L_horde.</b></font><br><br><a href=tele.php>$L_back</a></table>";
									    }
                                    break;
						            }
								case 7:
								    {
						            if ($race == 2)
						                {
						                mysql_query ("UPDATE `characters` SET `position_x`=1584.07, `position_y`=241.987, `position_z`=-52.1534, `map`=0, `orientation`=0.049647 WHERE `name`='$character';");
						                echo "<table width='650'>$L_character $character $L_telein <b>$L_Undercity</b>.<br><br><a href=tele.php>$L_back</a></table>";
						                }
                                    else
                                        {
									    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_telewar <font color=red><b>$L_horde.</b></font><br><br><a href=tele.php>$L_back</a></table>";
									    }
                                    break;
						            }
								case 8:
								    {
						            if ($race == 2)
						                {
						                mysql_query ("UPDATE `characters` SET `position_x`=9487.69, `position_y`=-7279.2, `position_z`=14.2866, `map`=530, `orientation`=6.16478 WHERE `name`='$character';");
						                echo "<table width='650'>$L_character $character $L_telein <b>$L_Silvermoon</b>.<br><br><a href=tele.php>$L_back</a></table>";
						                }
									else
									    {
									    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_telewar <font color=red><b>$L_horde.</b></font><br><br><a href=tele.php>$L_back</a></table>";
									    }
                                    break;
						            }
						            
                                case 9:
								    {
						            if (($race == 1) or ($race == 2))
						                {
						                mysql_query ("UPDATE `characters` SET `position_x`=-1838.16, `position_y`=5301.79, `position_z`=-12.428, `map`=530, `orientation`=5.9517 WHERE `name`='$character';");
						                echo "<table width='650'>$L_character $character $L_telein <b>$L_Shattrath</b>.<br><br><a href=tele.php>$L_back</a></table>";
						                }
                                    else
                                        {
									    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_telewar <font color=blue><b>$L_alliance</b></font> $L_or <font color=red><b>$L_horde</b></font>.<br><br><a href=tele.php>$L_back</a></table>";
									    }
                                    break;
						            }
								case 10:
								    {
						            if (($race == 1) or ($race == 2))
						                {
						                mysql_query ("UPDATE `characters` SET `position_x`=5804.15, `position_y`=624.771, `position_z`=647.767, `map`=571, `orientation`=1.64 WHERE `name`='$character';");
						                echo "<table width='650'>$L_character $character $L_telein <b>$L_Dalaran</b>.<br><br><a href=tele.php>$L_back</a></table>";
						                }
									else
									    {
									    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_telewar <font color=blue><b>$L_alliance</b></font> $L_or <font color=red><b>$L_horde</b></font>.<br><br><a href=tele.php>$L_back</a></table>";
									    }
                                    break;
						            }
								case '---------':
								    {
								    header("Location: tele.php");
								    break;
								    }
						        }
						    }
						else
						    {
						    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_erroronline.<br><br><a href=tele.php>$L_back</a></table>";
						    }
					    }
					else
					    {
					    echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_errorcharacter.<br><br><a href=tele.php>$L_back</a></table>";
					    }
					}
				else
					{
					echo "<table width='650'><font color=red><b>$L_error.</b></font> $L_errorpassword.<br><br><a href=tele.php>$L_back</a></table>";
					}
				}
			break;
			}
	default:
	    {
		?>
         <table border=1>
		 
		 </table>
		 <br>
		 <center>
		 <form action=tele.php?act=teleport method=post>
		 <table border=1 align=center>
		 <tr><td><? echo "$L_account" ?>:</td>
		     <td><input name=account type=text></td>
		 </tr>
		 <tr><td><? echo "$L_password" ?>:</td>
		     <td><input type=password name=pass type=text></td>
		 </tr>
		 <tr><td><? echo "$L_character" ?>:</td>
		     <td><input name=character type=text></td>
		 </tr>
		 <tr><td colspan="2" align=center>
         <select name="teleport">
		 <option value=1><? echo "$L_Stormwind" ?></option>
		 <option value=2><? echo "$L_Ironforge" ?></option>
		 <option value=3><? echo "$L_Darnassus" ?></option>
		 <option value=4><? echo "$L_Exodar" ?></option>
		    <option value='---------'>------------------</option>
		 <option value=5><? echo "$L_Orgrimmar" ?></option>
		 <option value=6><? echo "$L_Thunder_Bluff" ?></option>
		 <option value=7><? echo "$L_Undercity" ?></option>
		 <option value=8><? echo "$L_Silvermoon" ?></option>
		    <option value='---------'>------------------</option>
		 <option value=9><? echo "$L_Shattrath" ?></option>
		 <option value=10><? echo "$L_Dalaran" ?></option>
		 </select>
		 </td></tr>
		 <tr><td colspan="2" align=center>
		 <input value="<? echo "$L_teleporting" ?>" type=submit>
		 </td></tr>
		 </table><br><br><br>
		 </center>
		<?
		}
		break;
	}
	?>
	
	</div>
							 </div>



				 </div>
			</div>
<div class="spacer"></div>
<? include "trunk/lagranj/rek.php"?>
<? include "trunk/lagranj/menu.php"?>   
<? include "trunk/lagranj/footer.php"?> 
</body>

</html>