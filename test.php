<script>
	  $(".load_more_btn").click(function () {
    // console.log(card_loadmore_params);

    var parsedJson = $.parseJSON(card_loadmore_params.posts);

    console.log(card_loadmore_params);

    /// Зачем это было сделано ??
    // if($('#response-cred-card').data('json')){
    // 	card_loadmore_params.posts = JSON.stringify($('#response-cred-card').data('json'))
    // }

    var order = $(".cred-order-select").find("option").attr("value");
    var term = $("main").attr("term");
    var exclude_post = $(".article__item-first").attr("data-id");

    var view_template, view_type;

    if ($(".use_new_template_v1").length) {
      view_type = window.localStorage.getItem("view_type");
      if (!view_type) {
        view_type = "card_list";
      }
      view_template = 1;
    }

    $.ajax({
      url: card_loadmore_params.ajaxurl, // AJAX handler
      data: {
        action: "loadmorebutton", // the parameter for admin-ajax.php
        query: card_loadmore_params.posts, // loop parameters passed by wp_localize_script()
        page: card_loadmore_params.current_page, // current page
        order: order,
        term: term,
        exclude_post: exclude_post,
        view_template: view_template,
        view_type: view_type,
        posts_per_page: 4, // Указываем количество записей для подгрузки
      },
      type: "POST",
      beforeSend: function (xhr) {
        $(".load_more_btn").text("Загрузка..."); // some type of preloader
      },
      success: function (posts) {
        // console.log(posts)

        if (posts && posts != null && typeof posts !== "undefined") {
          $(".load_more_btn").text("Больше решений");
          $("#response-cred-card").append(posts); // insert new posts
          $(".pagination__description .count_view").html(
            $(".query__card").length
          );
          $(".pagination__description.article_desc .count_view").html(
            $(".query__card .col-12").length - 1
          );
          card_loadmore_params.current_page++;
          ajax_random_offers(0, card_loadmore_params.current_page);
          if (
            card_loadmore_params.current_page == card_loadmore_params.max_page
          )
            $(".load_more_btn").hide(); // if last page, HIDE the button
        } else {
          $(".load_more_btn").hide(); // if no data, HIDE the button as well
        }
        for (var i = 0; i < $(".query__card").length; i++) {
          var currentChild = $(".query__card").eq(i);
          currentChild.find(".bank_num").html("№" + (i + 1));
        }
        $(".btn__compare").append(
          '<span class="tool-add">Добавить в сравнение</span><span class="tool-remove">Удалить из сравнения</span>'
        );
      },
    });
    // Тут убираем кнопку показать еще, если 10 из 10
    setTimeout(function () {
      if (
        parseInt($(".count_view").text()) == parseInt($(".count_all").text())
      ) {
        $(".load_more_btn").hide();
      }
    }, 2000);

    return false;
  });
</script>