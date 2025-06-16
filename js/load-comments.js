jQuery(document).ready(function ($) {
  let currentPage = 1;
  const commentsPerPage = 10; // Количество комментариев на страницу

  const button = $("#load-more-comments");
  const totalComments = button.data("total-comments") || 0;

  // Скрываем кнопку, если комментариев меньше либо равно 10
  if (totalComments <= commentsPerPage) {
    button.hide();
    return;
  }

  button.on("click", function () {
    const postId = button.data("post-id"); // Получаем ID поста

    $.ajax({
      url: finbank_ajax.ajax_url, // URL для AJAX-запроса
      type: "POST",
      data: {
        action: "load_more_comments",
        page: currentPage + 1,
        post_id: postId,
        comments_per_page: commentsPerPage,
      },
      beforeSend: function () {
        button.text("Загрузка...");
      },
      success: function (response) {
        if (response) {
          $("#comments").append(response); // Добавляем новые комментарии
          currentPage++;

          // Обновляем счетчик показанных комментариев
          const shownComments = currentPage * commentsPerPage;
          $(".new-review-tax-count").text(Math.min(shownComments, totalComments));

          // Если все комментарии загружены, скрываем кнопку
          if (shownComments >= totalComments) {
            button.hide();
          } else {
            button.text("Загрузить еще");
          }
        } else {
          button.text("Больше комментариев нет").prop("disabled", true);
        }
      },
    });
  });
});
