$(document).ready(function($){

	function showAssort(id){
		// $('.assort').addClass('show_assort');
		$('*[data-assort="'+ id +'"]').addClass('show_assort');
		$('.overlay').fadeIn(100);
		$(".owl-carousel").owlCarousel({    
		  // loop:true,
		    margin:10,
		    // nav:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:4
		        }
		    }
		})		
	}
	function showAjaxAssort(id){
		$('.search_list').find('*[data-ajaxAssort="'+ id +'"]').addClass('show_assort');
		$('.overlay').fadeIn(100);
		$(".owl-carousel").owlCarousel({    
		  // loop:true,
		    margin:10,
		    // nav:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:4
		        }
		    }
		})		
	}
	function closeAssort(){
		$('.assort').removeClass('show_assort');
		if ($('.search_list').hasClass('search_list_focus')) {

		} else {
		$('.overlay').fadeOut(100);
		}
	}
	$('.search_list').on('click', '.kinds', function(){
		var subs = $(this).data('id');
		showAjaxAssort(subs);
	});
	$('#list').on('click', '.kinds', function(){
		var subs = $(this).data('id');
		showAssort(subs);
	});	
	$('#page_assort').on('click', '.kinds', function(){
		var subs = $(this).data('id');
		showAssort(subs);
	});
	$('body').on('click', '.close_assort', function(){
		closeAssort();
	});
	$('body').on('click', '.overlay', function(){
		closeAssort();
	});		

	$(document).keyup(function(e) {
		if (e.keyCode === 27) closeAssort();   // esc
	});
});