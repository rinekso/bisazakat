$(document).ready(function(){

	let menu = Number($("#idMenuForActive").val())
	$(".nav.navbar-nav.navbar-right li.menu-top:eq("+menu+")").addClass('active')
	// slide(0)
	$(".percent").map(function(){
		let p = $(this).attr("data-percent")
		var bar = $(this).children('.bar')
		var text = $(this).children('.bar').children('span')
		bar.css('width',p+'%')
		text.text(p+'%')
		if(p == 100){
			bar.css('background','rgba(102,212,118,0.8)')
			text.css('margin-left',-45+'px')
		}else if(p > 20){
			bar.css('background','rgba(76,140,238,0.8)')
		}else{
			bar.css('background','rgba(222,86,86,0.8)')
		}
		if(p <= 10){
			text.css({
				'left':0,
				'margin-left' : 0
			});
		}
	})
	imgSize();
	bgSize();
})
$(window).resize(function(){
	imgSize();
	bgSize();
	})
function imgSize(){
	$(".img-res").map(function(){
		var con = $(this).parent()
		if(con.width() > con.height()){
			$(this).css({
				width : '100%',
				height : 'auto'
			})
		}else{
			$(this).css({
				width : 'auto',
				height : '100%'
			})			
		}
	})
}
function bgSize(){
	$(".bg-res").map(function(){
		var con = $(this)
		if(con.width() > con.height()){
			$(this).css('background-size','100% auto')
		}else{
			$(this).css('background-size','auto 100%')
		}
	})
}
// slide
function slide(ke){
	$("header .slide .container-slide").css("transform","translateX("+ke*-33.33+"%)")
	if(ke==2){
		ke = 0
	}else{
		ke += 1
	}
	setTimeout("slide("+ke+")",10000)
}


