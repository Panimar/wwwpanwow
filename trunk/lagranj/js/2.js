
//FOnction sur la page index

$(document).ready(function(){
	
	$("#allopassLink").click(function(){toggleAllopass();});
	$("#forgotPasswdLink").click(function(){toggleForgotPasswd();});
	$(".votepart").click(function(){toggleVoteDIV(0);});
	$("#voteBuffer").click(function(){toggleVoteDIV(0);});
	$("#banner_vote").click(function(){toggleVoteDIV(0);});
	$("#2v2link").click(function(){ displayArenaTop("2");});
	$("#3v3link").click(function(){ displayArenaTop("3");});
	$("#5v5link").click(function(){ displayArenaTop("5");});
	$("#monthClassement").click(function(){ displayVotes("running");});
	$("#lastMonthWinners").click(function(){ displayVotes("lastmonth");});
	
	$(".scrollable").scrollable({circular  : true}).navigator().autoscroll(5000, {autopause : true});
	//$(".scrollable").mouseover(function(){$(this).pause();});
	//$(".scrollable").mouseout(function(){$(this).play();});
	
	
	
});

function displayVotes(typeClassement)
{
	switch(typeClassement)
	{
		case "running":
			{
				
				$("#monthClassement").addClass("active");
				$("#lastMonthWinners").removeClass("active");
				$(".running-votes").show();
				$(".lastmonth-winnerlist").hide();
				
				
				break;
			}
		case "lastmonth":
			{
				$("#monthClassement").removeClass("active");
				$("#lastMonthWinners").addClass("active");
				$(".running-votes").hide();
				$(".lastmonth-winnerlist").show();
				
				break;
			}
	}
}

function displayArenaTop(typeTeam)
{
	
	switch(typeTeam)
	{
		case "2":
		{
			$(".arenaV a").removeClass("active");
			$("#2v2link").addClass("active");
			$(".arena-container").hide();
			$(".v2").show();
			break;
		}
		
		case "3":
		{
			$(".arenaV a").removeClass("active");
			$("#3v3link").addClass("active");
			$(".arena-container").hide();
			$(".v3").show();
			break;
		}
		
		case "5":
		{
			$(".arenaV a").removeClass("active");
			$("#5v5link").addClass("active");
			$(".arena-container").hide();
			$(".v5").show();
			break;
		}
	
	}
}

function toggleVoteDIV()
{
	$("#dynamicIndexBox1").fadeOut(300 , function(){showVoteDIV();} );
}
function showVoteDIV(pflag)
{
	$.ajax({
		   type: "POST",
		   async: true,
		   url: "ajax/ajax.voteSlider.php",
		   data : ({action :"init",
			   		flag: pflag
			   		
			   		}),
		   success: function(response) 
		   {
		 	$("#dynamicIndexBox1").html("");
		 	$("#dynamicIndexBox1").html(response);
			 $("#dynamicIndexBox1").fadeIn(350);
			 $(".gocaptcha").click(function(){verifCaptchaVote($("#incaptcha").val());});
			 $("#vote1").click(function(){launchVoteFor(1);});
			 $("#vote2").click(function(){launchVoteFor(2);});
		
			}
		
		});
}
function verifCaptchaVote(string)
{
	 $.ajax({
		   type: "POST",
		   async: true,
		   url: "../ajax/ajax.inscriptionVerif.php",
		   data : ({captcha : string,
			   		mode : "captchaTest"
			   		}),
		   success: function(response) {
		 
		 			if(response == "1")
		 			{
		 				//on fait le truc
		 				showVoteDIV(1);
		 			}
		 			else
		 			{
		 				 //on reset le champ
		 				$("#incaptcha").val("");
		 				
		 			}
		
									}
		  
		
		});
}
function launchVoteFor(pSiteID)
{
	$.ajax({
		   type: "POST",
		   async: true,
		   url: "ajax/ajax.voteSlider.php",
		   data : ({action :"vote",
			   		siteID : pSiteID
			   		
			   		}),
		   success: function(response) 
		   {
			
		 	$("#dyna3").html("");
		 	$("#dyna3").html(response);
			$("#dyna3").fadeIn(350);
			
		   }
			
		
		});
}
function toggleAllopass()
{
	//$("#dynamicIndexBox1").fadeOut( 300  , function(){showAllopassForm();} );
	window.location.href="acheter-des-points/formulaire.html";
}

function toggleForgotPasswd()
{
		$("#dynamicIndexBox1").fadeOut( 300 , function(){showForgotPasswdForm();} );
	  $("#fLink").attr("title","Lien desactivé pendant la procédure. Cliquez sur le menu d'accueil pour remettre à 0.");
}

function resetToForgotPasswd()
{
	$("#dynamicIndexBox1").fadeOut(350,function(){
		showForgotPasswdForm();
		$("#dynamicIndexBox1").fadeIn(350);
		  $("#forgotPasswdLink").unbind("click");
		  $("#fLink").css("color","#4f5557");
		  $("#fLink").attr("title","Lien desactivé pendant la procédure. Cliquez sur le menu d'accueil pour remettre à 0.");
			
	});
	  
}
function showAllopassForm()
{
	$.ajax({
		   type: "POST",
		   async: true,
		   url: "ajax/ajax.allopass.php",
		   data : ({action :"showform"
			   		
			   		}),
		   success: function(response) 
		   {
		 	$("#dynamicIndexBox1").html("");
		 	$("#dynamicIndexBox1").html(response);
			 $("#dynamicIndexBox1").fadeIn(350);
			 
		
			}
		
		});
}

function toggleValidButton( idButton, funcFire)
{
	 //gere la descativation et activation 
	 if($("#"+idButton).hasClass("disabledButton"))
	 {
		 	$("#"+idButton).removeClass("disabledButton");
		 	$("#"+idButton).addClass("pulseButton");
		 	$("#"+idButton).bind("click.myclick1", function(){ eval(funcFire) ;});
		 	
	 }
	 else
	 {
		 	$("#"+idButton).addClass("disabledButton");
		 	$("#"+idButton).removeClass("pulseButton");
		 	$("#"+idButton).unbind("click.myclick1");
	 }
}
function showForgotPasswdForm()
{
	
		
		$.ajax({
			   type: "POST",
			   async: true,
			   url: "ajax/ajax.forgotpasswd.php",
			   data : ({action :"showform"
				   		
				   		}),
			   success: function(response) 
			   {
			 	$("#dynamicIndexBox1").html("");
			 	$("#dynamicIndexBox1").html(response);
			 	$("#dynamicIndexBox1").fadeIn(350);
			 	$("#getNewPass").addClass("disabledButton");
			 	$("#getNewPass").removeClass("pulseButton");
				 $("#passChk_index").bind("click.passClick", function(){ toggleValidButton( "getNewPass", "sendNewPasswd()" ); });
				 
			
				}
			
			});
	
}

function sendNewPasswd()
{
	if($("#account").val() == "")
	{
			alert("Vous devez entrer votre nom de compte!");
			return false;
	}
	else
	{
		$.ajax({
				   type: "POST",
				   async: true,
				   url: "ajax/ajax.forgotpasswd.php",
				   data : ({action :"getnewpass",
					   		patternaccount : $("#account").val(),
				   		}),
			   success: function(response) 
			   {
					$("#dyna3").fadeOut(350, function(){
						$(this).html(response);
						$(this).fadeIn(350);
					});
				}
			
			});
	}
}

