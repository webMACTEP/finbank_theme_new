jQuery(function ($) {
  var pg = $(".comments-ajax-pagination");
  if (!pg.length) return;

  var container = $("#reviews");
  var ajaxUrl = load_more_params.ajax_url;
  var postId = parseInt(pg.data("post-id"), 10);
  var perPage = parseInt(pg.data("per-page"), 10);
  var totalPages = parseInt(pg.data("total-pages"), 10);
  var currentPage = parseInt(pg.data("current-page"), 10) || 1;

  function loadComments(page) {
    $.post(
      ajaxUrl,
      {
        action: "load_more_comments",
        page: page,
        post_id: postId,
        comments_per_page: perPage,
      },
      function (res) {
        if (res.success && res.data.html) {
          // дописываем следующие отзывы
          container.append(res.data.html);

          currentPage = page;
          pg.data("current-page", page);

          // обновляем data-page кнопки
          pg.find(".js-comments-next").data("page", page + 1);

          // если достигли последней страницы — прячем кнопку
          if (page >= totalPages) {
            pg.find(".js-comments-next").fadeOut();
          }
        } else {
          // ошибки / пусто — прячем кнопку
          pg.find(".js-comments-next").fadeOut();
        }
      },
      "json"
    );
  }

  // клик по «Загрузить ещё»
  pg.on("click", ".js-comments-next", function () {
    loadComments(currentPage + 1);
  });
});
