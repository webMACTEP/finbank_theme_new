jQuery(document).ready(function ($) {
  // Функция для проверки наличия куки
  function hasCookie(name) {
    return document.cookie
      .split(";")
      .some((item) => item.trim().startsWith(name + "="));
  }

  // Блокируем кнопки, если пользователь уже лайкнул/дизлайкнул
  $(".like-button, .dislike-button").each(function () {
    var commentId = $(this).data("comment-id");
    if (hasCookie("liked_comment_" + commentId)) {
      $(this).prop("disabled", true).addClass("disabled");
    }
    if (hasCookie("disliked_comment_" + commentId)) {
      $(this).prop("disabled", true).addClass("disabled");
    }
  });

  // Обработка клика по кнопке "Лайк"
  $(".like-button").on("click", function () {
    var commentId = $(this).data("comment-id");
    var likeButton = $(this);
    var dislikeButton = likeButton.siblings(".dislike-button");

    // Отправляем AJAX-запрос
    $.ajax({
      url: ajax_object_like_dislike.ajax_url,
      type: "POST",
      data: {
        action: "handle_like_dislike_ajax",
        comment_id: commentId,
        type: "like",
        nonce: ajax_object_like_dislike.like_dislike_nonce,
      },
      beforeSend: function () {
        // Можно добавить спиннер или индикатор загрузки
        likeButton.prop("disabled", true).html(`
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9063 7.22222H15.1965C16.5355 7.22222 17.4063 8.613 16.8075 9.79505L13.6555 16.0173C13.3504 16.6196 12.7268 17 12.0445 17H8.4263C8.27903 17 8.13232 16.9822 7.98946 16.9469L4.60228 16.1111M10.9063 7.22222V2.77778C10.9063 1.79594 10.0999 1 9.10514 1H9.01915C8.56927 1 8.20457 1.35997 8.20457 1.80402C8.20457 2.43896 8.01415 3.05969 7.65733 3.58799L4.60228 8.11111V16.1111M10.9063 7.22222H9.10514M4.60228 16.1111H2.80114C1.8064 16.1111 1 15.3152 1 14.3333V9C1 8.01816 1.8064 7.22222 2.80114 7.22222H5.05257" stroke="#7b8aa3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>`);
      },
      success: function (response) {
        if (response.success) {
          // Обновляем счетчик лайков
          likeButton.find(".like-count").text(response.data.likes);
          // Блокируем кнопку
          likeButton.prop("disabled", true).addClass("disabled").html(`
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9063 7.22222H15.1965C16.5355 7.22222 17.4063 8.613 16.8075 9.79505L13.6555 16.0173C13.3504 16.6196 12.7268 17 12.0445 17H8.4263C8.27903 17 8.13232 16.9822 7.98946 16.9469L4.60228 16.1111M10.9063 7.22222V2.77778C10.9063 1.79594 10.0999 1 9.10514 1H9.01915C8.56927 1 8.20457 1.35997 8.20457 1.80402C8.20457 2.43896 8.01415 3.05969 7.65733 3.58799L4.60228 8.11111V16.1111M10.9063 7.22222H9.10514M4.60228 16.1111H2.80114C1.8064 16.1111 1 15.3152 1 14.3333V9C1 8.01816 1.8064 7.22222 2.80114 7.22222H5.05257" stroke="#7b8aa3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        ${response.data.dislikes}
                    `);
          // Устанавливаем куки
          document.cookie =
            "liked_comment_" + commentId + "=1; path=/; max-age=31536000"; // 1 год
        } else {
          alert(response.data);
          likeButton.prop("disabled", false).html(`
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9063 7.22222H15.1965C16.5355 7.22222 17.4063 8.613 16.8075 9.79505L13.6555 16.0173C13.3504 16.6196 12.7268 17 12.0445 17H8.4263C8.27903 17 8.13232 16.9822 7.98946 16.9469L4.60228 16.1111M10.9063 7.22222V2.77778C10.9063 1.79594 10.0999 1 9.10514 1H9.01915C8.56927 1 8.20457 1.35997 8.20457 1.80402C8.20457 2.43896 8.01415 3.05969 7.65733 3.58799L4.60228 8.11111V16.1111M10.9063 7.22222H9.10514M4.60228 16.1111H2.80114C1.8064 16.1111 1 15.3152 1 14.3333V9C1 8.01816 1.8064 7.22222 2.80114 7.22222H5.05257" stroke="#7b8aa3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>`);
        }
      },
      error: function () {
        alert("Произошла ошибка. Пожалуйста, попробуйте снова.");
        likeButton.prop("disabled", false).html(`
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9063 7.22222H15.1965C16.5355 7.22222 17.4063 8.613 16.8075 9.79505L13.6555 16.0173C13.3504 16.6196 12.7268 17 12.0445 17H8.4263C8.27903 17 8.13232 16.9822 7.98946 16.9469L4.60228 16.1111M10.9063 7.22222V2.77778C10.9063 1.79594 10.0999 1 9.10514 1H9.01915C8.56927 1 8.20457 1.35997 8.20457 1.80402C8.20457 2.43896 8.01415 3.05969 7.65733 3.58799L4.60228 8.11111V16.1111M10.9063 7.22222H9.10514M4.60228 16.1111H2.80114C1.8064 16.1111 1 15.3152 1 14.3333V9C1 8.01816 1.8064 7.22222 2.80114 7.22222H5.05257" stroke="#7b8aa3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>`);
      },
    });
  });

  // Обработка клика по кнопке "Дизлайк"
  $(".dislike-button").on("click", function () {
    var commentId = $(this).data("comment-id");
    var dislikeButton = $(this);
    var likeButton = dislikeButton.siblings(".like-button");

    // Отправляем AJAX-запрос
    $.ajax({
      url: ajax_object_like_dislike.ajax_url,
      type: "POST",
      data: {
        action: "handle_like_dislike_ajax",
        comment_id: commentId,
        type: "dislike",
        nonce: ajax_object_like_dislike.like_dislike_nonce,
      },
      beforeSend: function () {
        // Можно добавить спиннер или индикатор загрузки
        dislikeButton.prop("disabled", true).html(`
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.09372 11.7778H3.80347C2.46453 11.7778 1.59368 10.387 2.19248 9.20495L5.34447 2.98273C5.64957 2.38045 6.27324 2 6.95546 2H10.5737C10.721 2 10.8677 2.01783 11.0105 2.05308L14.3977 2.88889M8.09372 11.7778V16.2222C8.09372 17.2041 8.90012 18 9.89486 18H9.98084C10.4307 18 10.7954 17.64 10.7954 17.196C10.7954 16.561 10.9858 15.9403 11.3427 15.412L14.3977 10.8889V2.88889M8.09372 11.7778H9.89486M14.3977 2.88889H16.1989C17.1936 2.88889 18 3.68483 18 4.66667V10C18 10.9818 17.1936 11.7778 16.1989 11.7778H13.9474" stroke="#7b8aa3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                `);
      },
      success: function (response) {
        if (response.success) {
          // Обновляем счетчик дизлайков
          dislikeButton.find(".dislike-count").text(response.data.dislikes);
          // Блокируем кнопку
          dislikeButton.prop("disabled", true).addClass("disabled").html(`
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.09372 11.7778H3.80347C2.46453 11.7778 1.59368 10.387 2.19248 9.20495L5.34447 2.98273C5.64957 2.38045 6.27324 2 6.95546 2H10.5737C10.721 2 10.8677 2.01783 11.0105 2.05308L14.3977 2.88889M8.09372 11.7778V16.2222C8.09372 17.2041 8.90012 18 9.89486 18H9.98084C10.4307 18 10.7954 17.64 10.7954 17.196C10.7954 16.561 10.9858 15.9403 11.3427 15.412L14.3977 10.8889V2.88889M8.09372 11.7778H9.89486M14.3977 2.88889H16.1989C17.1936 2.88889 18 3.68483 18 4.66667V10C18 10.9818 17.1936 11.7778 16.1989 11.7778H13.9474" stroke="#7b8aa3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        ${response.data.dislikes}
                    `);
          // Устанавливаем куки
          document.cookie =
            "disliked_comment_" + commentId + "=1; path=/; max-age=31536000"; // 1 год
        } else {
          alert(response.data);
          dislikeButton.prop("disabled", false).html(`
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.09372 11.7778H3.80347C2.46453 11.7778 1.59368 10.387 2.19248 9.20495L5.34447 2.98273C5.64957 2.38045 6.27324 2 6.95546 2H10.5737C10.721 2 10.8677 2.01783 11.0105 2.05308L14.3977 2.88889M8.09372 11.7778V16.2222C8.09372 17.2041 8.90012 18 9.89486 18H9.98084C10.4307 18 10.7954 17.64 10.7954 17.196C10.7954 16.561 10.9858 15.9403 11.3427 15.412L14.3977 10.8889V2.88889M8.09372 11.7778H9.89486M14.3977 2.88889H16.1989C17.1936 2.88889 18 3.68483 18 4.66667V10C18 10.9818 17.1936 11.7778 16.1989 11.7778H13.9474" stroke="#7b8aa3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                    `);
        }
      },
      error: function () {
        alert("Произошла ошибка. Пожалуйста, попробуйте снова.");
        dislikeButton.prop("disabled", false).html(`
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.09372 11.7778H3.80347C2.46453 11.7778 1.59368 10.387 2.19248 9.20495L5.34447 2.98273C5.64957 2.38045 6.27324 2 6.95546 2H10.5737C10.721 2 10.8677 2.01783 11.0105 2.05308L14.3977 2.88889M8.09372 11.7778V16.2222C8.09372 17.2041 8.90012 18 9.89486 18H9.98084C10.4307 18 10.7954 17.64 10.7954 17.196C10.7954 16.561 10.9858 15.9403 11.3427 15.412L14.3977 10.8889V2.88889M8.09372 11.7778H9.89486M14.3977 2.88889H16.1989C17.1936 2.88889 18 3.68483 18 4.66667V10C18 10.9818 17.1936 11.7778 16.1989 11.7778H13.9474" stroke="#7b8aa3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                `);
      },
    });
  });
});
