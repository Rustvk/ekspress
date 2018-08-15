$(document).ready(function($){
	/* Функция показа  формы заказа */
	function showOrder() {
		$('.overlay').fadeIn(300);
		$('.order').fadeIn(300);
	}
	function closeOrder() {
		$('.overlay').fadeOut(100);
		$('.order').fadeOut(100);
	}
	/* Функция показа списка пожеланий */
	function loadWishlist(wishlist) {
		$('.wishlist').html(wishlist);
	}

	/* Функция закрытия списка пожеланий */
	function closeWishlist() {
		$('.overlay').fadeOut(100);
		$('.wishlist .dropdown .dropdown-menu').fadeOut(100);
	}	
	function showWishlist(){
		$('.wishlist .dropdown-menu').fadeIn(100);
		$('.overlay').fadeIn(100);
	}
	function add_top_icon_animation(){
		setTimeout(function(){
			$('.is_added').fadeIn(300);
			// $('.wish_icon').addClass('wish_icon_add');
		}, 50);
		setTimeout(function(){
			$('.is_added').fadeOut(300);
			// $('.wish_icon').removeClass('wish_icon_add');
		}, 1500);
	}
	function remove_top_icon_animation(){
		setTimeout(function(){
			$('.is_removed').fadeIn(300);
			// $('.wish_icon').addClass('wish_icon_add');
		}, 50);
		setTimeout(function(){
			$('.is_removed').fadeOut(300);
			// $('.wish_icon').removeClass('wish_icon_add');
		}, 1500);
	}
	function removebybutton($remove) {
		$remove.addClass("added0");
		setTimeout(function(){
			$remove.html('<span>Запомнить </span><i class="fa fa-heart-o" aria-hidden="true"></i>');
			$remove.addClass('add_to_cart');
			$remove.removeClass('added0');
			$remove.removeClass('added');
		}, 300);	
	}
	function addbybutton($add) {
		$add.html('<i class="fa fa-check" aria-hidden="true"></i>');
		$add.addClass("added0");
		setTimeout(function(){
			$add.html('<i class="fa fa-check" aria-hidden="true"></i>');
			$add.addClass('added');
			$add.removeClass('added0');
			$add.removeClass('add_to_cart');
		}, 300);
	}
	/* Загрузка данных в список пожеланий при загрузке страницы */
	$.ajax({
		url: '/wishlist/add',
		data: {id: 'load'},
		type: 'GET',
		success: function(res){
			loadWishlist(res);
		},
		error: function() {
		}
	});

	$('.wishlist').on('click', '.dropdown-toggle', function(){
		showWishlist();
		event.preventDefault();

	});

	$('body').on('click', '.close_wish', function(){
		closeWishlist();
	});

	$(document).keyup(function(e) {
		if (e.keyCode === 27) closeWishlist();   // esc
	});  		

	$('body').on('click', '.add_to_cart', function ( event ) {
		event.preventDefault();
		var id = $(this).data('id');
		$others=$('.prod_list_item_buttons').find("[data-id='" + id + "']");			
		$.ajax({
			url: '/wishlist/add',
			context: this,
			data: {id: id},
			type: 'GET',
			success: function(res){
				if (!res) {alert('Такого товара не существует'); }
				else {
					loadWishlist(res);
					add_top_icon_animation();
					addbybutton($(this));
					addbybutton($others);
				}
			},
			error: function() {
				$this=$(this);
				$(this).addClass("added0");
				setTimeout(function(){
					$this.html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>');
					$this.addClass('added-red');
					$this.removeClass('added0');
				}, 300);		
			}
		});
	});

	$('body').on('click', '.wish_remove', function ( event ) {
		var id = $(this).data('id');
		$others=$('.prod_list_item_buttons').find("[data-id='" + id + "']");			
		$.ajax({
			url: '/wishlist/delete',
			data: {id: id},
			type: 'GET',
			success: function(res){
				if (!res) { alert('Такого товара не существует'); }
				else {
					loadWishlist(res);
					remove_top_icon_animation();		
					removebybutton($others);
					showWishlist();
				}
			},
			error: function() {
				$this=$(this);
				$(this).addClass("added0");
				setTimeout(function(){
					$this.html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>');
					$this.addClass('added-red');
					$this.removeClass('added0');
				}, 300);
				loadWishlist(res);

			}
		});	
		event.preventDefault();

	});
	$('body').on('click', '.added', function ( event ) {
		var id = $(this).data('id');
		$others=$('.prod_list_item_buttons').find("[data-id='" + id + "']");			
		$.ajax({
			url: '/wishlist/delete',
			context: this,
			data: {id: id},
			type: 'GET',
			success: function(res){
				if (!res) {alert('Такого товара не существует');}
				else {
					loadWishlist(res);
					remove_top_icon_animation();
					removebybutton($(this));
					removebybutton($others);
				}
			},
			error: function() {
				$this=$(this);
				$(this).addClass("added0");
				setTimeout(function(){
					$this.html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>');
					$this.addClass('added-red');
					$this.removeClass('added0');
				}, 300);
			}
		});	
		event.preventDefault();

	});
	$('body').on('click', '.clear_wishlilst', function ( event ) {
		$.ajax({
			url: '/wishlist/clear',
			type: 'GET',
			success: function(res){
				if (!res) {alert('Пусто');}
				else {
					loadWishlist(res);
					top_icon_animation();
					removebybutton($('.added'));
					showWishlist(res);
				}
				},
			error: function() {
				alert('Непредвиденная ошибка');
			}
		});
		event.preventDefault();

	});	
	var url = document.URL;
	var id = url.substring(url.lastIndexOf('#') + 1);
	if (id == 'send-wishlist') {
		setTimeout(function(){
			showOrder();			
			event.preventDefault();
		}, 500);
	}
	$('body').on('click', '.send_list', function () {
			showOrder();			
			event.preventDefault();
		});		
		$('body').on('click', '.overlay', function () {
			closeOrder();
		});	
		$('body').on('click', '.close_order', function () {
			closeOrder();
		});	
		$(document).keyup(function(e) {
			if (e.keyCode === 27) closeOrder();   // esc
		}); 
});

$(document).ready(function(){
	$("#myWish").affix({
		offset: {
		top: 320
	}
	});
});


		$('body').on('click', '.print', function () {
			$.ajax({
				url: '/wishlist/print',
				context: this,
				type: 'GET',
				success: function(res){
					if (!res) {alert('Списка не существует');}
					else {
						$('.wishlist_print').html(res);
						PrintElem('.wishlist_print');
						$('.wishlist_print').empty();

					}
				},
				error: function() {
					error('Ошибка печати');
				}
			});		
			event.preventDefault();
				
		});


    function PrintElem(elem)
    {
        Popup($(elem).html());
    }
    function Popup(data)
    {
        var mywindow = window.open('', 'my div', 'height=800,width=1366');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
 
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
 
        mywindow.print();
        mywindow.close();
        return true;
    }
