jQuery(function($){
  const btn = $('#load-more-reviews');
  let page    = +btn.data('page');
  const per   = +btn.data('per-page');
  const total = +btn.data('total');
  const taxonomy  = btn.data('taxonomy');  // Передаем 'debetcard'
  const termId    = btn.data('term-id');
  const fieldName = btn.data('field-name');

  if (total <= per) { btn.hide(); return; }

  btn.on('click', function(){
    btn.prop('disabled', true).text('Загрузка…');

    $.post(reviews_ajax.ajax_url, {
      action:     'load_more_reviews',
      page:       page + 1,
      per_page:   per,
      taxonomy:   taxonomy,  // Передаем правильную таксономию
      term_id:    termId,
      field_name: fieldName
    }, function(html){
      if (html.trim()) {
        $('#reviews').append(html);
        page++;
        const shown = page * per;
        $('.reviews-shown').text(Math.min(shown, total));
        if (shown >= total) btn.hide();
        else btn.prop('disabled', false).text('Загрузить ещё');
      } else {
        btn.text('Больше нет').prop('disabled', true);
      }
    });
  });
});


