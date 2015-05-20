
//fonctions pour el slideur des news

$(document).ready(function(){
	var newsTextList = $(".newscontent");
	$(".newscontent").each(function(){$(this).hide();});
	$('.news> h2').each(function(){$(this).addClass("hoverAction");});
	
	$('.news').each(function(){$(this).children("h2").mouseover(function(){if($(this).parent("div").hasClass("disabled")){$(this).children("span").addClass("hoverDate");}});});
	$('.news').each(function(){$(this).children("h2").mouseleave(function(){if($(this).parent("div").hasClass("disabled")){$(this).children("span").removeClass("hoverDate");}});});
	$('.news> h2').each(function(){$(this).mouseleave(function(){$(this).children("span").removeClass("hoverDate");});});
	$('.news> h2').click(function() {
		
		if($(this).parent('div').hasClass("opened"))//se lance quand on clik sur un titre OUVERT
		{	
			//on ne fait rien
		}
		else//se lance quand on clik sur un titre FERME
		{	$(this).children("span").removeClass("hoverDate");
			//on ferme les contenurs encor eouverts
			$(".newscontent").each(function(){
				if($(this).parent("div").hasClass("opened"))
				{	
					$(this).slideToggle(300, function(){
						$(this).parent('div').removeClass("opened");
						$(this).parent('div').addClass("disabled")
					});
				}
			});
			
			$(this).parent('div').removeClass("disabled");
			$(this).parent('div').addClass("opened");
			$(this).next('div').slideToggle(350);
		}
	});
	
	$("#n1").removeClass("disabled");
	$("#n1").addClass("opened");
	$("#n1").children("div").show();
	
});