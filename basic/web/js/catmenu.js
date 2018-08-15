
$(document).ready(function(){
	$('body').on('click', '.plus_cat', function(){
		$(this).parent('li').toggleClass('show_sub_cat');
	});
	$('body').on('click', '.show_cats_button', function(){
		$('.nav_menu').addClass('show_nav_menu');
		$('.overlay').fadeIn(300);
	});
	$('.close_nav, .overlay').click(function(){
		$('.nav_menu').removeClass('show_nav_menu');
		$('.overlay').fadeOut(300);
    });
    $(document).keyup(function(e) {
    if (e.keyCode === 27) {
      $('.nav_menu').removeClass('show_nav_menu');
    }
    });   
});

