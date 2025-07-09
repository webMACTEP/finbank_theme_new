jQuery(function($){
  var btn       = $('#load-more-all-reviews'),
      container = $('#reviews'),
      shownEl   = $('.reviews-shown'),
      totalEl   = $('.reviews-total'),
      page      = parseInt(btn.data('page')),
      perPage   = parseInt(btn.data('per-page')),
      total     = parseInt(btn.data('total'));

  if ( shownEl.text() >= total ) {
    btn.hide();
  }

  btn.on('click', function(e){
    e.preventDefault();
    btn.prop('disabled', true).text('Загрузка…');

    $.post(ajaxurl, {
      action:   'load_more_reviews_all',
      page:     page,
      per_page: perPage
    }, function(resp){
      if ( resp.success ) {
        var html = resp.data.html.trim();
        if ( ! html ) {
          btn.hide();
          return;
        }
        container.append(html);
        page++;
        var shownNow = container.find('.reviews__page-item').length;
        shownEl.text(shownNow);
        totalEl.text(total);
        if ( shownNow >= total ) {
          btn.hide();
        } else {
          btn.prop('disabled', false).text('Загрузить ещё');
          btn.data('page', page);
        }
      } else {
        btn.hide();
      }
    });
  });
});
