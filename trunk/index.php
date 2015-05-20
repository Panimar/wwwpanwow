<?php
@include ("session.php");
@include ("./include/core.php");
?>
<? include "lagranj/header.php"?> 
<div class="blockFull">
				<h1><span class="blue4">Личный кабинет</span> <span class="red bold" style="font-size:13px;">Ваш сервер</span>
</h1>				
			</div>

<div class="lContent">
    
<div id="newsBlock"><center>
										
							
								<table>
		<tr><td><center>

		<tr><td><div class=b_b>
				<?php
				switch($_GET['do']) {
					case 'vote': include ("module/vote.php"); break;
					case 'store': include ("module/shop.php"); break;
					case 'edit': include ("module/accedit.php"); break;
					case 'charedit': include ("module/charedit.php"); break;	
					case 'ticket': include ("module/ticket.php"); break;
					case 'about': include ("module/about.php"); break;
					case 'itemlist': include ("module/itemlist.php"); break;
					default: include ("module/main.php");
				}
			?>

</div>
			
</td></tr>
	</table>
								
							 </center></div>												
				 
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



</div>
<? include "lagranj/m.php"?>   
<? include "lagranj/footer.php"?> 
</body>

</html>

