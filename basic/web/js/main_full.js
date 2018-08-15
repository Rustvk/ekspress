$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
    	// showArrows: false
    });
    $('.ekko-lightbox').append('<div class="close_lightbox" tabindex="-1" data-dismiss="modal" aria-label="Close">✕</div>');
});

$(document).on('click', '.close_advert', function() {
	$('.advert').fadeOut(100);
});

$(document).ready(function(){
function rocketCSS(e) {
    var t = new XMLHttpRequest;
    t.onreadystatechange = function(){
        if(4==t.readyState && 200==t.status){
            var e = document.head||document.getElementsByTagName("head")[0];
            var n = document.createElement("style");
            n.type = "text/css";
            n.styleSheet
                ? n.styleSheet.cssText = t.responseText
                : n.appendChild(document.createTextNode(t.responseText));
            e.appendChild(n);
        }
    };
    t.open("GET",e,!0);
    t.send();
}

rocketCSS('../css/owl.carousel.css');
rocketCSS('../css/owl.theme.default.css');
});

$('body').on('click', '.newsletter_icon', function ( event ) {
	event.preventDefault();
	var email = $(this).parent('span').prev('input').val();
        if($('.newsletter_input').val() != '') {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if(pattern.test($('.newsletter_input').val())){            	
                $('.newsletter_input').css({'border' : '2px solid #74bf74'});
				$.ajax({
					url: '/site/newsletter',
					context: this,
					data: {mail: email},
					type: 'GET',
					success: function(res){
						if (res=='success') {
			                $('#valid').text('Вы успешно подписаны на рассылку Кафе "Экспресс"');
						}
						else if (res=='again') {
			                $('#valid').text('Вы уже подписаны на нашу рассылку');
						} else {
                			$('.newsletter_input').css({'border' : '2px solid #f97474'});
			                $('#valid').text('Возникла непредвиденная ошибка, пожалуйста попробуйте снова.');
						}
      					$('.newsletter_input').blur();
      					$('.newsletter_input').val('');
					},
					error: function() {
					}
				});                
            } else {
                $('.newsletter_input').css({'border' : '2px solid #f97474'});
                $('#valid').text('Поле email заполнено не верно');
            }
        } else {
            $('.newsletter_input').css({'border' : '2px solid #f97474'});
            $('#valid').text('Поле email не должно быть пустым');
        }
});