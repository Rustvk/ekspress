$(document).on('click', '.lightbox', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
    	// showArrows: false
    });
    $('.ekko-lightbox').append('<div class="close_lightbox" tabindex="-1" data-dismiss="modal" aria-label="Close">✕</div>');
});


$(document).ready(function(){
	$('body').on('click', '.show_ingred', function(){
		$(this).next('.ingred').addClass('ingred_sh');
		$('.overlay').fadeIn(300);
	});
	$('.close_ing, .overlay').click(function(){
		$('.ingred').removeClass('ingred_sh');
		$('.overlay').fadeOut(300);
    });
    $(document).keyup(function(e) {
    if (e.keyCode === 27) {
		$('.ingred').removeClass('ingred_sh');
		$('.overlay').fadeOut(300);
    }
    });   
	$('body').on('click', '.delimglunch', function ( event ) {
		event.preventDefault();
		var id = $(this).attr('id');
		$.ajax({
			url: 'delimage',
			context: this,
			data: {id: id},
			type: 'GET',
			success: function(res){
				// addbybutton($others);
				$('.content').prepend(res);
				$('.upd_img').empty();
			},
			error: function() {
				$this=$(this);
				setTimeout(function(){
					$this.html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>');
					$this.addClass('added-red');
				}, 300);		
			}
		});
	});
	$('body').on('click', '.cdelimg', function ( event ) {
		event.preventDefault();
		var id = $(this).attr('id');
		var image = $(this).data('image');
		$.ajax({
			url: 'delimage',
			context: this,
			data: {id: id, image: image},
			type: 'GET',
			success: function(res){
				// addbybutton($others);
				$('.content').prepend(res);
				if (image=='image') {
					$('.upd_img1').empty();
				} else {
					$('.upd_img2').empty();
				}
			},
			error: function() {
				$this=$(this);
				setTimeout(function(){
					$this.html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>');
					$this.addClass('added-red');
				}, 300);		
			}
		});
	});
	$('body').on('click', '.delimg', function ( event ) {
		event.preventDefault();
		var id = $(this).attr('id');
		$.ajax({
			url: 'delimage',
			context: this,
			data: {id: id},
			type: 'GET',
			success: function(res){
				// addbybutton($others);
				$('.content').prepend(res);
				$('.upd_img').empty();
			},
			error: function() {
				$this=$(this);
				setTimeout(function(){
					$this.html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>');
					$this.addClass('added-red');
				}, 300);		
			}
		});
	});

	$('body').on('click', '.remove_daughter', function ( event ) {
		event.preventDefault();
		var id = $(this).attr('id');
		$.ajax({
			url: 'delete',
			context: this,
			data: {id: id},
			type: 'GET',
			success: function(res){
				$('.daughter_container').prepend(res);
				$(this).parent('.daughter').parent('.daughter_block').remove();
			},
			error: function() {
				$this=$(this);
				setTimeout(function(){
					$this.html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>');
					$this.addClass('added-red');
				}, 300);		
			}
		});
	});	
	$('body').on('click', '.getorderitems', function ( event ) {
		event.preventDefault();
		var id = $(this).attr('id');
		$.ajax({
			url: 'editproducts',
			context: this,
			data: {id: id},
			type: 'GET',
			success: function(res){
				$('.orderitems').empty();
				$('.orderitems').prepend(res).fadeIn(300);
				$('.overlay').fadeIn(300);
				// $(this).parent('.daughter').parent('.daughter_block').remove();
			},
			error: function() {
				$this=$(this);
				setTimeout(function(){
					$this.html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>');
				}, 300);		
			}
		});
	});	
	$('body').on('click', '.savecheckproducts', function ( event ) {
		event.preventDefault();
		var id = $(this).attr('id');
		var products = [];
		i =0;
		$("input:checked").each(function() {
			products[i] = {
				"id":$(this).val(),
				"name":$(this).next('label').html(),	
				"text":$(this).nextAll('.checktext').val(),	
				"price":$(this).nextAll('.checkprice').val(),	
			};
			i++;
		});
		$.ajax({
			url: 'saveproducts',
			context: this,
			data: {id: id, products: products},
			type: 'GET',
			success: function(res){
				if (res=='success') {
					$(this).html('Сохранено <i class="fa fa-check" aria-hidden="true"></i>').addClass('btn-success').removeClass('btn-default');
					setTimeout(function(){
						$('.savecheckproducts').html('Сохранить набор').addClass('btn-default').removeClass('btn-success');
						$('.orderitems').fadeOut(500);
						$('.overlay').fadeOut(600);
					}, 1000);		
				} else {
					$(this).html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>').addClass('btn-danger').removeClass('btn-default');
				}
				// $('.orderitems').prepend(res).fadeIn(300);
				// $(this).parent('.daughter').parent('.daughter_block').remove();
			},
			error: function() {
				$(this).html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>').addClass('btn-danger').removeClass('btn-default');
			}
		});
	});		
	$('body').on('click', '.close_orderitems, .overlay', function ( event ) {
		$('.orderitems').fadeOut(300);
		$('.overlay').fadeOut(300);
    });
    $(document).keyup(function(e) {
    if (e.keyCode === 27) {
		$('.orderitems').fadeOut(300);
    }
    });
	$('body').on('click', '.checkcategories li', function ( event ) {
		event.stopPropagation();
		$(this).children('.checkproducts').slideToggle(300);
    });

});

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }
    function Popup(data)
    {
        var mywindow = window.open('', '', 'height=800,width=1366');
        // mywindow.document.write('<link rel="stylesheet" href="../css/print.css" type="text/css"/>');
        mywindow.document.write('</head><body style="position:relative">');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
 
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
 
        mywindow.print();
        mywindow.close();
        return true;
    }
	$('body').on('click', '.printlunch', function ( event ) {
		PrintElem('.lunchmenupage');
	});

	$('body').on('click', '.printcheck', function ( event ) {
		PrintElem('.wishcheck');
	});

$(document).on("click", '.remove_gallery_image', function (e) {
	e.preventDefault();
	var isTrue = confirm("Удалить изображение?");
	var image = $(this).data('image');
	var id = $(this).data('id');
	var g = $(this).data('g');
	if(isTrue==true){
		$.ajax({
			url: 'deletephoto',
			context: this,
			data: {id: id, image: image, g: g},
			type: 'GET',
			success: function(res){
				if (res=='success') {
					$(this).parent('div').remove();
				} else {
					$(this).html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>').addClass('btn-danger').removeClass('btn-default');
				}
			},
			error: function() {
				$(this).html('Ошибка <i class="fa fa-close" aria-hidden="true"></i>').addClass('btn-danger').removeClass('btn-default');
			}
		});
	}	
});
