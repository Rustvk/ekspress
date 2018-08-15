  function showSearch(results) {
    $('.search_list').html(results);
  }

  $('#search-input').keyup(function(event) {
  if (event.keyCode !== 27) {
    var q = $(this).val();
    $.ajax({
      url: '/menu/search',
      data: {q: q},
      type: 'GET',
      beforeSend: function(){
          showSearch('<img src="/img/oval.svg" width="50" alt="">');
        },

      success: function(res){
        // if (!res) alert('По данному запросу ничего не найдено');
        showSearch(res);
        $('.search_ajax_header').addClass('search_ajax_header_focus');
      },
      error: function() {

      }
    });
    }

  });
function closeSearch() {
      $('.search_ajax_header').removeClass('search_ajax_header_focus');
      $('.search').removeClass('search_focus');
      $('.search_list').removeClass('search_list_focus'); 
      $('.overlay').fadeOut(300);
      $('.close_search').removeClass('close_search_focus');
      $('.search_input').blur();
}
$(document).ready(function($){
    $("#search-input").focus(function(){
      $('.search').addClass('search_focus');
      $('.search_list').addClass('search_list_focus');
      $('.close_search').addClass('close_search_focus');
      $('.overlay').fadeIn(300);
      $('.search_ajax_header').addClass('search_ajax_header_focus');
    });

    $('.overlay, .close_search').click(function(){
        closeSearch();
    });
    $(document).keyup(function(e) {
      if (e.keyCode === 27) {
        closeSearch();
      }
    });
});
