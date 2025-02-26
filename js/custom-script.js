jQuery(function ($) {
  /*
   * Load More
   */

  $(document).on("click", ".popup_close", function () {
    $(".popup").fadeOut();
    $(".popup").attr("data-show", "N");
  });

  // КЛИК ВНЕ ЭЛЕМЕНТА И СКРЫТИЕ
  $(document).mouseup(function (e) {
    // var outside_element = $( ".popup .popup__inner" );
    // var outside_element1 = $( ".popup .choices__item" );
    var popup_apply_now = $(".popup");

    // console.log(e.target)

    var $target = $(e.target);
    if (
      !$target.closest(".popup__inner").length &&
      $(".popup__inner").is(":visible")
    ) {
      popup_apply_now.hide();
      popup_apply_now.attr("data-show", "N");
    }

    // if ((!outside_element1.is(e.target) && outside_element1.has(e.target).length === 0) && (!outside_element.is(e.target)
    // 	&& outside_element.has(e.target).length === 0) ) {
    //
    // 	popup_apply_now.hide();
    // 	popup_apply_now.attr('data-show', 'N');
    //
    //
    // 	//ym(35020350,'reachGoal','NOREF_POPUP_WRAPPER')
    // }
  });

  $("#checkpolicy").change(function () {
    var btn_send_form = $(".btn-send-form");
    if (!$(this).is(":checked")) {
      btn_send_form.addClass("need-checbox");
      btn_send_form.attr("disabled", "");
    } else {
      btn_send_form.removeClass("need-checbox");
      btn_send_form.attr("disabled", false);
    }
  });

  $(".rating-btn-open").on("click", function () {
    $(".input-select-star").show(500);
    $(this).hide(500);
  });

  $(".input-select-star .star .deactivate").on("click", function () {
    var need = $(this).parent().data("id");
    $("#input-select-star").val(need);
    for (let i = 0; i < need; i++) {
      $(".input-select-star .deactivate").eq(i).removeClass("show");
      $(".input-select-star .active").eq(i).addClass("show");
    }
  });

  $(".input-select-star .star .active").on("click", function () {
    var need = $(this).parent().data("id");
    $("#input-select-star").val(need);
    for (let i = need; i <= 10; i++) {
      $(".input-select-star .active").eq(i).removeClass("show");
      $(".input-select-star .deactivate").eq(i).addClass("show");
    }
  });

  // $('.js-phone').mask("+7(999)999-9999", {autoclear: false});

  // добавляем правило для валидации телефона
  // jQuery.validator.addMethod("checkMaskPhone", function(value, element) {
  // 	//	return /\+\d{1}\(\d{3}\)\d{3}-\d{4}/g.test(value);
  // 	return /\+\d{1}\(\d{3}\)\d{3}-\d{2}-\d{2}/g.test(value);
  // });

  $(".validate-footer").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      checkpolicy: {
        required: true,
        //checkpolicy: true,
      },
    },
    messages: {
      email: {
        required: "Обязательное поле",
        email:
          "Ваш адрес электронной почты должен быть в формате maksim1992@mail.ru",
      },
      checkpolicy: {
        required: "(Обязательное поле)",
        //checkpolicy: "Обязательное поле",
      },
    },
  });

  $(".validate-comment-form").validate({
    rules: {
      comment: {
        required: true,
      },
      author: {
        required: true,
        minlength: 2,
      },
      phone: {
        required: true,
        checkMaskPhone: true,
      },
      email: {
        required: true,
        email: true,
      },
      // checkpolicy: {
      // 	required: true,
      // }
    },
    messages: {
      comment: {
        required: "Обязательное поле",
      },
      author: {
        required: "Обязательное поле",
        minlength: "Минимум 2 символа",
      },
      email: {
        required: "Обязательное поле",
        email:
          "Ваш адрес электронной почты должен быть в формате maksim1992@mail.ru",
      },
      phone: {
        required: "Обязательное поле",
        minlength: "Минимум 2 символа",
        phone: "Обязательное поле",
        checkMaskPhone: "Обязательное поле",
      },
      // checkpolicy: {
      // 	required: "Обязательное поле",
      // }
    },
  });

  $(".range__value").on("input", function () {
    var max = parseInt($(this)[0].max);
    var val = parseInt($(this).val().replaceAll(" ", ""));

    if (val > max) {
      $(this).val(max);
    }
  });

  // FORM HELP BECOME BETTER
  $(".ajax-form-add").submit(function (e) {
    e.preventDefault();
    var form_data = $(this).serialize();
    var response = $(".response-for-form");

    $.ajax({
      type: "POST",
      url: "/ajax-form-add.php",
      data: form_data,
      dataType: "json",
      success: function (res) {
        console.log(res);
        response.show();

        if (res.success == true) {
          response.html(res.message);
        } else {
          response.text("");
          response.html(res.message);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        response.text("");
        response.html(jqXHR.responseJSON.message);
      },
    });
  });

  // FORM HELP BECOME BETTER
  $(".form-help-become-better").submit(function (e) {
    e.preventDefault();
    var form_data = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "/ajax-form-add.php",
      data: form_data,
      dataType: "json",
      success: function (res) {
        console.log(res);

        if (res.success == true) {
          $("#wrapper-form-help-become-better").hide(500);
          $("#thanks-form-help").show(500);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {},
    });
  });

  // COMMENT PAGE FORM
  $(".comment-form").submit(function (e) {
    e.preventDefault();
    var form_data = $(this).serialize();
    var response = $(".response-for-comment");

    // wp_handle_comment_submission( wp_unslash( $_POST ) ); --- Долго выполняется
    // поэтому сразу покажем что все успешно
    response.text("");
    response.show();
    $.ajax({
      type: "POST",
      url: "/custom-comments-post.php",
      data: form_data,
      dataType: "json",
      success: function (res) {
        response.html(res.message);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        response.text("");
        response.html(jqXHR.responseJSON.message);
      },
    });
  });

  // COMMENT FORM
  $(".article_comment-form").submit(function (e) {
    e.preventDefault();
    var form_data = $(this).serialize();
    var response = $(".response-for-comment");
    // wp_handle_comment_submission( wp_unslash( $_POST ) ); --- Долго выполняется
    // поэтому сразу покажем что все успешно
    response.show();
    $.ajax({
      type: "POST",
      url: "/custom-comments-post.php",
      data: form_data,
      dataType: "json",
      success: function (res) {
        response.text(res.message);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        response.text("");
        response.html(jqXHR.responseJSON.message);
      },
    });
  });

  $(".btn__compare").append(
    '<span class="tool-add">Добавить в сравнение</span><span class="tool-remove">Удалить из сравнения</span>'
  );

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

  $(".load_more_btn1").click(function () {
    var order = $(".collection-order").find("option").attr("value");
    //var term = $('main').attr('term');
    var exclude_post = $(".btn__compare ").attr("data-id");

    if ($("#response-cred-card").data("json")) {
      card_loadmore_params.posts = JSON.stringify(
        $("#response-cred-card").data("json")
      );
    }

    //console.log(exclude_post);
    $.ajax({
      url: card_loadmore_params.ajaxurl, // AJAX handler
      data: {
        action: "loadmorebutton", // the parameter for admin-ajax.php
        query: card_loadmore_params.posts, // loop parameters passed by wp_localize_script()
        //'query': parsedJson, // loop parameters passed by wp_localize_script()
        page: card_loadmore_params.current_page, // current page
        order: order,
        term: "collection",
        exclude_post: exclude_post,
      },
      type: "POST",
      beforeSend: function (xhr) {
        $(".load_more_btn1").text("Загрузка..."); // some type of preloader
      },
      success: function (posts) {
        if (posts) {
          $(".load_more_btn1").text("Больше решений");
          $("#response-cred-card").append(posts); // insert new posts
          $(".pagination__description .count_view").html(
            $(".query__card").length
          );
          $(".pagination__description.article_desc .count_view").html(
            $(".query__card .col-12").length - 1
          );
          card_loadmore_params.current_page++;
          if (
            card_loadmore_params.current_page == card_loadmore_params.max_page
          )
            $(".load_more_btn1").hide(); // if last page, HIDE the button
        } else {
          $(".load_more_btn1").hide(); // if no data, HIDE the button as well
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

    setTimeout(function () {
      if (
        parseInt($(".count_view").text()) == parseInt($(".count_all").text())
      ) {
        $(".load_more_btn1").hide();
      }
    }, 2000);

    return false;
  });

  /* Collection cards */

  if ($("#collection-card").length) {
    var filter = $("#collection-card");
    var order = $(".collection-order").find("option").attr("value");

    var mydata = filter.serialize();
    //var mydataArray = filter.serializeArray();
    //var mydataValues = {};
    //var mydata = $.param(mydataValues);

    mydata += "&order=" + encodeURIComponent(order);

    console.log("col_mydata= " + mydata);

    $.ajax({
      url: card_loadmore_params.ajaxurl, // обработчик
      data: mydata, // данные
      dataType: "json",
      type: "POST", // тип запроса
      beforeSend: function (xhr) {
        filter.find(".submit-button").text("Загрузка..."); // изменяем текст кнопки
      },
      success: function (data) {
        //console.log(data);
        filter.find(".submit-button").text("Показать"); // возвращаеи текст кнопки
        $("#response-cred-card.list_posts").html(data.content);
        $(".pagination__description .count_all").html(data.found_posts);
        $(".variants_count").html(data.found_posts);
        $(".pagination__description .count_view").html(
          $(".query__card").length
        );
        card_loadmore_params.current_page = 1;

        // set the new query parameters
        card_loadmore_params.posts = data.posts;

        // set the new max page parameter
        card_loadmore_params.max_page = data.max_page;
        if (data.max_page < 2) {
          $(".load_more_btn1").hide();
        } else {
          $(".load_more_btn1").show();
        }
        $(".btn__compare").append(
          '<span class="tool-add">Добавить в сравнение</span><span class="tool-remove">Удалить из сравнения</span>'
        );
      },
    });
  }

  $(".btn__collmore").click(function () {
    $(this).toggleClass("btn__collmore_visible");
    $("#collist").find(".coll_li").toggleClass("coll__hidden");
    $(".btn__collmore .btn__collmore-text").text(
      $(this).attr("data-text-open")
    );
    $(".btn__collmore.btn__collmore_visible .btn__collmore-text").text(
      $(this).attr("data-text-hide")
    );
  });

  $(".btn__collmore_cat").click(function () {
    let work = $(this).attr("data-click");
    let parent = $(this).parent();

    if (work == 0) {
    } else {
      $(this).toggleClass("btn__collmore_visible");
      // console.log($(parent).find('#' + $(this).attr('data-id')).find('.coll_li'))
      $(parent)
        .find("#" + $(this).attr("data-id"))
        .find(".coll_li")
        .toggleClass("coll__hidden");

      $(".btn__collmore_cat .btn__collmore-text").text(
        $(this).attr("data-text-open")
      );
      $(".btn__collmore_cat.btn__collmore_visible .btn__collmore-text").text(
        $(this).attr("data-text-hide")
      );
    }
  });

  /* Filter cards */

  if (
    $("#credit-card-filter").length &&
    !$("#response-cred-card .card").length
  ) {
    console.log("start-filter");

    var filter = $("#credit-card-filter");
    var order = $(".cred-order-select").find("option").attr("value");

    var mydata = filter.serialize();
    var checkboxes = $("#credit-card-filter-aside").serialize();
    //mydata += "&" + checkboxes;
    //mydata += "&order=" + encodeURIComponent(order);
    //mydata = "action=cardfilter&term=creditcard&cred_limit=&cred_day_period=&bank=&cat_cards=&period=";

    /*
		var mydataArray = filter.serializeArray();
		var mydataValues = {};
	    $.each(mydataArray, function(i, field){
	    	if ((this.name == 'cred_limit') || (this.name == 'cred_day_period') || (this.name == 'z_sum') || (this.name == 'z_time') || (this.name == 'summ_limit') || (this.name == 'cred_summ_period') || (this.name == 'percent_limit') || (this.name == 'cashback_number') ){
	    		mydataValues[this.name] = '';
	    	} else {
	    		mydataValues[this.name] = this.value;     	
	    	}
	    });
    
	    var mydata = $.param(mydataValues);
*/

    var mydataArray = filter.serializeArray();
    var mydataValues = {};
    $.each(mydataArray, function (i, field) {
      if (
        (this.name == "cred_limit" && this.value == 0) ||
        (this.name == "cred_day_period" && this.value == 0) ||
        (this.name == "z_sum" && this.value == 0) ||
        (this.name == "z_time" && this.value == 0) ||
        (this.name == "summ_limit" && this.value == 0) ||
        (this.name == "cred_summ_period" && this.value == 0) ||
        (this.name == "percent_limit" && this.value == 0) ||
        (this.name == "cashback_number" && this.value == 0)
      ) {
        mydataValues[this.name] = "";
      } else {
        mydataValues[this.name] = this.value;
      }
    });
    if (mydataValues["cred_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cred_day_period"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["z_sum"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["z_time"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["summ_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cred_summ_period"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["percent_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cashback_number"] == 0) {
      $(".cred_trat").val("Любой");
    }

    var mydata = $.param(mydataValues);
    if (checkboxes) {
      mydata += "&" + checkboxes;
    }
    mydata += "&order=" + encodeURIComponent(order);

    // console.log('mydata1= ' + mydata);

    $.ajax({
      url: card_loadmore_params.ajaxurl, // обработчик
      data: mydata, // данные
      dataType: "json",
      type: "POST", // тип запроса
      beforeSend: function (xhr) {
        filter.find(".submit-button").text("Загрузка..."); // изменяем текст кнопки
      },
      success: function (data) {
        filter.find(".submit-button").text("Показать"); // возвращаеи текст кнопки
        $("#response-cred-card.list_posts").html(data.content);
        $(".pagination__description .count_all").html(data.found_posts);
        $(".variants_count").html(data.found_posts);
        $(".pagination__description .count_view").html(
          $(".query__card").length
        );
        card_loadmore_params.current_page = 1;

        // set the new query parameters
        card_loadmore_params.posts = data.posts;
        // set the new max page parameter
        card_loadmore_params.max_page = data.max_page;
        if (data.max_page < 2) {
          $(".load_more_btn").hide();
        } else {
          $(".load_more_btn").show();
        }
        $(".btn__compare").append(
          '<span class="tool-add">Добавить в сравнение</span><span class="tool-remove">Удалить из сравнения</span>'
        );
      },
    });
  }

  setTimeout(function () {
    ajax_random_offers(4);
  }, 2000);

  function ajax_random_offers(after_item_count, page) {
    // if($('.ajax-random-offers').length){
    //
    // 	let $this = $('.ajax-random-offers');
    // 	let id = $this.data('id');
    // 	let current_cat_id = $this.data('current_cat_id');

    // Matches exactly 'tcol1'

    let term = "";

    if ($('input[name="term"]').length) {
      term = $('input[name="term"]').val();
    }

    // console.log(term)

    $.ajax({
      url: "/ajax-random-offers.php", // обработчик
      data: {
        id: "test",
        term: term,

        // 'current_cat_id': current_cat_id,
      }, // данные
      dataType: "json",
      type: "POST", // тип запроса
      success: function (data) {
        switch (after_item_count) {
          case 4:
            if (
              $("#response-cred-card.list_posts .card__horizontal:nth-child(4)")
                .length
            ) {
              $(
                "#response-cred-card.list_posts .card__horizontal:nth-child(3)"
              ).append(data.content);
            }
            ajax_random_offers(10);
            break;
          case 10:
            if (
              $("#response-cred-card.list_posts .card__horizontal:nth-child(9)")
                .length
            ) {
              $(
                "#response-cred-card.list_posts .card__horizontal:nth-child(9)"
              ).append(data.content);
            }
            break;
          default:
        }

        if (page) {
          let obj_page = {
            1: 9,
            2: 19,
            3: 29,
            4: 39,
          };

          let need_item = obj_page[page];
          // console.log(need_item)

          if (
            $(
              "#response-cred-card.list_posts .card__horizontal:nth-child(" +
                need_item +
                ")"
            ).length
          ) {
            $(
              "#response-cred-card.list_posts .card__horizontal:nth-child(" +
                need_item +
                ")"
            ).append(data.content);
          }
        }
      },
    });

    // }
  }

  // Запуск фильтров, если человек передал ssession, за это отвечает mt
  if ($(".start-func-credit-card-filter").length) {
    filter_main_start();
  }

  function filter_main_start() {
    var filter = $("#credit-card-filter");
    var order = $(".cred-order-select").find("option").attr("value");

    var mydata = filter.serialize();

    var checkboxes = $("#credit-card-filter-aside").serialize();

    // ВОТ ТУТ ВОЗМОЖНО ОШИБКА
    // mydata += "&" + checkboxes;
    // mydata += "&order=" + encodeURIComponent(order);

    var mydataArray = filter.serializeArray();
    // var mydataJson = JSON.stringify(mydataArray);
    // console.log(mydataJson)

    var mydataValues = {};
    $.each(mydataArray, function (i, field) {
      if (
        (this.name == "cred_limit" && this.value == 0) ||
        (this.name == "cred_day_period" && this.value == 0) ||
        (this.name == "z_sum" && this.value == 0) ||
        (this.name == "z_time" && this.value == 0) ||
        (this.name == "summ_limit" && this.value == 0) ||
        (this.name == "cred_summ_period" && this.value == 0) ||
        (this.name == "percent_limit" && this.value == 0) ||
        (this.name == "cashback_number" && this.value == 0)
      ) {
        mydataValues[this.name] = "";
      } else {
        mydataValues[this.name] = this.value;
      }
    });
    if (mydataValues["cred_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cred_day_period"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["z_sum"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["z_time"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["summ_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cred_summ_period"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["percent_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cashback_number"] == 0) {
      $(".cred_trat").val("Любой");
    }

    var mydata = $.param(mydataValues);
    if (checkboxes) {
      mydata += "&" + checkboxes;
    }

    if ($(".use_new_template_v1").length) {
      var view_type = window.localStorage.getItem("view_type");
      if (!view_type) {
        view_type = "card_list";
      }

      mydata += "&view_template=1&view_type=" + view_type;
    }

    mydata += "&order=" + encodeURIComponent(order);

    //console.log('mydata2= ' + mydata);
    $.ajax({
      url: card_loadmore_params.ajaxurl, // обработчик
      data: mydata, // данные
      dataType: "json",
      type: "POST", // тип запроса
      beforeSend: function (xhr) {
        filter.find(".submit-button").text("Загрузка..."); // изменяем текст кнопки
      },
      success: function (data) {
        filter.find(".submit-button").text("Показать"); // возвращаеи текст кнопки
        $("#response-cred-card.list_posts").html(data.content);
        $(".pagination__description .count_all").html(data.found_posts);
        $(".variants_count").html(data.found_posts);
        $(".pagination__description .count_view").html(
          $(".query__card").length
        );
        card_loadmore_params.current_page = 1;

        // set the new query parameters
        card_loadmore_params.posts = data.posts;

        // set the new max page parameter
        card_loadmore_params.max_page = data.max_page;
        if (data.max_page < 2) {
          $(".load_more_btn").hide();
        } else {
          $(".load_more_btn").show();
        }
        $(".btn__compare").append(
          '<span class="tool-add">Добавить в сравнение</span><span class="tool-remove">Удалить из сравнения</span>'
        );
      },
    });

    yandex_metrika_filter_click();

    // $('.pagination__container div').hide();

    return false;
  }

  function yandex_metrika_filter_click() {
    ym(35020350, "reachGoal", "click_pokazat_filtr");
    ym(35020350, "reachGoal", "filtr_knopka");
  }

  $(
    "#credit-card-filter .submit-button, #credit-card-filter-aside .submit-button"
  ).click(function () {
    filter_main_start();
  });

  // Фильтр сортировки коллекции
  $(".collection-order").change(function () {
    var order = $(".collection-order").find("option").attr("value");
    var filter = $("#collection-card");
    var mydata = filter.serialize();
    //var checkboxes = $('#credit-card-filter-aside').serialize();
    //mydata += "&" + checkboxes;
    mydata += "&order=" + encodeURIComponent(order);

    console.log("mydata_order= " + mydata);

    $.ajax({
      url: card_loadmore_params.ajaxurl, // обработчик
      data: mydata, // данные
      dataType: "json",
      type: "POST", // тип запроса
      beforeSend: function (xhr) {
        filter.find(".submit-button").text("Загрузка..."); // изменяем текст кнопки
      },
      success: function (data) {
        filter.find(".submit-button").text("Показать"); // возвращаеи текст кнопки
        $("#response-cred-card.list_posts").html(data.content);
        $(".pagination__description .count_all").html(data.found_posts);
        $(".variants_count").html(data.found_posts);
        $(".pagination__description .count_view").html(
          $(".query__card").length
        );
        card_loadmore_params.current_page = 1;
        // set the new query parameters
        card_loadmore_params.posts = data.posts;
        // set the new max page parameter
        card_loadmore_params.max_page = data.max_page;
        if (data.max_page < 2) {
          $(".load_more_btn1").hide();
        } else {
          $(".load_more_btn1").show();
        }
        $(".btn__compare").append(
          '<span class="tool-add">Добавить в сравнение</span><span class="tool-remove">Удалить из сравнения</span>'
        );
      },
    });
    return false;
  });

  // Фильтр сортировки
  $(".cred-order-select").change(function () {
    cred_order_select();
  });

  function cred_order_select() {
    var order = $(".cred-order-select").find("option").attr("value");
    var filter = $("#credit-card-filter");
    var mydata = filter.serialize();
    var checkboxes = $("#credit-card-filter-aside").serialize();
    //mydata += "&" + checkboxes;
    //mydata += "&order=" + encodeURIComponent(order);

    var mydataArray = filter.serializeArray();
    var mydataValues = {};
    $.each(mydataArray, function (i, field) {
      if (
        (this.name == "cred_limit" && this.value == 0) ||
        (this.name == "cred_day_period" && this.value == 0) ||
        (this.name == "z_sum" && this.value == 0) ||
        (this.name == "z_time" && this.value == 0) ||
        (this.name == "summ_limit" && this.value == 0) ||
        (this.name == "cred_summ_period" && this.value == 0) ||
        (this.name == "percent_limit" && this.value == 0) ||
        (this.name == "cashback_number" && this.value == 0)
      ) {
        mydataValues[this.name] = "";
      } else {
        mydataValues[this.name] = this.value;
      }
    });
    if (mydataValues["cred_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cred_day_period"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["z_sum"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["z_time"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["summ_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cred_summ_period"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["percent_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cashback_number"] == 0) {
      $(".cred_trat").val("Любой");
    }

    var mydata = $.param(mydataValues);
    if (checkboxes) {
      mydata += "&" + checkboxes;
    }

    if ($(".order_type").length) {
      var order_type = $(".order_type").attr("data-order_type");
      // ASC DESC
      mydata += "&order_type=" + order_type;
    }

    if ($(".use_new_template_v1").length) {
      var view_type = window.localStorage.getItem("view_type");
      if (!view_type) {
        view_type = "card_list";
      }

      mydata += "&view_template=1&view_type=" + view_type;
    }

    mydata += "&order=" + encodeURIComponent(order);

    //console.log('mydata3= ' + mydata);

    $.ajax({
      url: card_loadmore_params.ajaxurl, // обработчик
      data: mydata, // данные
      dataType: "json",
      type: "POST", // тип запроса
      beforeSend: function (xhr) {
        filter.find(".submit-button").text("Загрузка..."); // изменяем текст кнопки
      },
      success: function (data) {
        filter.find(".submit-button").text("Показать"); // возвращаеи текст кнопки
        $("#response-cred-card.list_posts").html(data.content);
        $(".pagination__description .count_all").html(data.found_posts);
        $(".variants_count").html(data.found_posts);
        $(".pagination__description .count_view").html(
          $(".query__card").length
        );
        card_loadmore_params.current_page = 1;
        // set the new query parameters
        card_loadmore_params.posts = data.posts;
        // set the new max page parameter
        card_loadmore_params.max_page = data.max_page;
        if (data.max_page < 2) {
          $(".load_more_btn").hide();
        } else {
          $(".load_more_btn").show();
        }
        $(".btn__compare").append(
          '<span class="tool-add">Добавить в сравнение</span><span class="tool-remove">Удалить из сравнения</span>'
        );
      },
    });
    return false;
  }

  // Боковой фильтр
  $("#credit-card-filter-aside .submit-button").click(function () {
    var filter = $("#credit-card-filter");
    var mydata = filter.serialize();
    var checkboxes = $("#credit-card-filter-aside").serialize();
    //mydata += "&" + checkboxes;

    var mydataArray = filter.serializeArray();
    var mydataValues = {};
    $.each(mydataArray, function (i, field) {
      if (
        (this.name == "cred_limit" && this.value == 0) ||
        (this.name == "cred_day_period" && this.value == 0) ||
        (this.name == "z_sum" && this.value == 0) ||
        (this.name == "z_time" && this.value == 0) ||
        (this.name == "summ_limit" && this.value == 0) ||
        (this.name == "cred_summ_period" && this.value == 0) ||
        (this.name == "percent_limit" && this.value == 0) ||
        (this.name == "cashback_number" && this.value == 0)
      ) {
        mydataValues[this.name] = "";
      } else {
        mydataValues[this.name] = this.value;
      }
    });
    if (mydataValues["cred_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cred_day_period"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["z_sum"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["z_time"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["summ_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cred_summ_period"] == 0) {
      $(".cred_trat").val("Любой");
    }
    if (mydataValues["percent_limit"] == 0) {
      $(".cred_limit").val("Любой");
    }
    if (mydataValues["cashback_number"] == 0) {
      $(".cred_trat").val("Любой");
    }

    var mydata = $.param(mydataValues);
    if (checkboxes) {
      mydata += "&" + checkboxes;
    }
    mydata += "&order=" + encodeURIComponent(order);

    //console.log('mydata4= ' + mydata);

    $.ajax({
      url: card_loadmore_params.ajaxurl, // обработчик
      data: mydata, // данные
      dataType: "json",
      type: "POST", // тип запроса
      beforeSend: function (xhr) {
        filter.find(".submit-button").text("Загрузка..."); // изменяем текст кнопки
      },
      success: function (data) {
        filter.find(".submit-button").text("Показать"); // возвращаеи текст кнопки
        $("#response-cred-card.list_posts").html(data.content);
        $(".pagination__description .count_all").html(data.found_posts);
        $(".variants_count").html(data.found_posts);
        $(".pagination__description .count_view").html(
          $(".query__card").length
        );
        card_loadmore_params.current_page = 1;

        // set the new query parameters
        card_loadmore_params.posts = data.posts;

        // set the new max page parameter
        card_loadmore_params.max_page = data.max_page;
        if (data.max_page < 2) {
          $(".load_more_btn").hide();
        } else {
          $(".load_more_btn").show();
        }
        $(".btn__compare").append(
          '<span class="tool-add">Добавить в сравнение</span><span class="tool-remove">Удалить из сравнения</span>'
        );
      },
    });
    return false;
  });

  // Фильтр на странице банка
  $("#bank-offer-filter .submit-button").click(function () {
    var filter = $("#bank-offer-filter");
    var mydata = filter.serialize();
    //console.log(mydata);
    $.ajax({
      url: card_loadmore_params.ajaxurl, // обработчик
      data: mydata, // данные
      dataType: "json",
      type: "POST", // тип запроса
      beforeSend: function (xhr) {
        filter.find(".submit-button").text("Загрузка..."); // изменяем текст кнопки
      },
      success: function (data) {
        filter.find(".submit-button").text("Показать"); // возвращаеи текст кнопки
        $("#response-bank-offers").html(data.content);
        card_loadmore_params.current_page = 1;
        // set the new query parameters
        card_loadmore_params.posts = data.posts;
        // set the new max page parameter
        card_loadmore_params.max_page = data.max_page;
        $(".btn__compare").append(
          '<span class="tool-add">Добавить в сравнение</span><span class="tool-remove">Удалить из сравнения</span>'
        );
      },
    });
    return false;
  });
  $(".bank_card_select .multipleSelect__item").click(function () {
    setTimeout(function () {
      if ($(".bank_card_select .multipleSelect__btn-count").text() != "") {
        $(".bank_kred_select button").addClass("disabled");
      }
      if ($(".bank_card_select .multipleSelect__btn-count").text() == "") {
        $(".bank_kred_select button").removeClass("disabled");
      }
    }, 50);
  });
  $(".kred_select .multipleSelect__item").click(function () {
    setTimeout(function () {
      if ($(".kred_select .multipleSelect__btn-count").text() != "") {
        $(".kred_select button").addClass("disabled");
      }
      if ($(".kred_select .multipleSelect__btn-count").text() == "") {
        $(".kred_select button").removeClass("disabled");
      }
    }, 50);
  });
  // Фильтр на главной странице

  $("#main-page-filter .main-submit-button").click(function () {
    var filter = $("#main-page-filter");
    var productType = $("#productTypeSelect").find("option").attr("value");
    var mydata = filter.serialize();
    mydata += "&product_type=" + productType;
    $.ajax({
      url: "/wp-content/themes/finbank_theme/session-main-filter.php", // обработчик
      data: mydata, // данные
      type: "POST", // тип запроса
      beforeSend: function (xhr) {},
      success: function (data) {
        console.log(data);
        filter.find(".main-submit-button").text("Варианты");
        window.location.href = data;
      },
    });
    //console.log(mydata);
    return false;
  });

  $(function () {
    $("#productTypeSelect").change(function () {
      $(".main_filter_input").addClass("d-none");
      $(".main_filter_input." + $(this).val()).removeClass("d-none");
    });
  });

  // Поиск в шапке
  const search_input = $(".header__search-input");
  search_input.keyup(function () {
    let search_value = $(this).val();
    //console.log(search_value);
    if (search_value.length > 2) {
      // кол-во символов
      $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: "POST",
        data: {
          action: "ajax_search", // functions.php
          term: search_value,
        },
        success: function (results) {
          $("#result_search_ajax").html(results);
        },
      });
    }
    if (search_value.length < 1) {
      $("#result_search_ajax").html("");
    }
  });
  $("#searchContainer .header__search-close").click(function () {
    $("#result_search_ajax").html("");
    $("#searchContainer .header__search-input").val("");
  });
  $(".search-form").keydown(function (event) {
    if (event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

  $(".best1-order-select").change(function () {
    var value = $(".best1-order-select option:selected").val();
    console.log(value);
    var GETR = "?order=" + value;
    window.location = window.location.pathname + GETR;
  });

  $(".best-order-select").change(function () {
    var value = $(".best-order-select option:selected").val();
    console.log(value);
    var GETR = "?order=" + value;
    window.location = window.location.pathname + GETR;
  });

  setTimeout(function () {
    var compare_link = window.sessionStorage.getItem("compare_link");

    // console.log(compare_link)

    if (compare_link) {
      $(".header-compare-link").attr("href", compare_link);
      $(".popup_compare_btn").attr("href", compare_link);
    }
  }, 1000);

  // order_type
  var rotation = 0;
  $(document).on("click", ".order_type", function () {
    // data-order_type="DESC"
    //data-order_type

    rotation += 180;
    $(this).css({
      "-webkit-transform": "rotate(" + rotation + "deg)",
      "-moz-transform": "rotate(" + rotation + "deg)",
      "-ms-transform": "rotate(" + rotation + "deg)",
      transform: "rotate(" + rotation + "deg)",
    });

    var sort = $(this).attr("data-order_type");

    if (sort == "DESC") {
      $(this).attr("data-order_type", "ASC");
    } else {
      $(this).attr("data-order_type", "DESC");
    }

    cred_order_select();
  });

  // Сравнение продуктов
  $(document).on("click", ".btn__compare", function () {
    var post_id = $(this).attr("data-id");
    var post_tax = $(this).attr("data-tax");
    //$(this).addClass("btn_compare_on");
    $(this).toggleClass("btn_compare_on");

    if ($(this).hasClass("btn_compare_on")) {
      $(".popup_compare").fadeIn();
    } else {
      $(".popup_compare").fadeOut();
    }

    // popup_compare_btn
    // header-compare-link

    var compare_link = "/compare-installment-cards/";

    switch (post_tax) {
      // карта рассрочки
      case "installmentcard":
        compare_link = "/compare-installment-cards/";
        break;
      case "zaimy":
        compare_link = "/compare-zaimy/";
        break;
      case "creditcard":
        compare_link = "/compare-cred-cards/";
        break;
      case "debetcard":
        compare_link = "/compare-debet-cards/";
        break;
      case "kredity":
        compare_link = "/compare-kredity/";

        break;
    }

    $(".header-compare-link").attr("href", compare_link);
    $(".popup_compare_btn").attr("href", compare_link);
    window.sessionStorage.setItem("compare_link", compare_link);

    $.ajax({
      url: "/wp-content/themes/finbank_theme/session-compare.php", // обработчик
      data: {
        post_id: post_id,
        post_tax: post_tax,
      }, // данные
      type: "POST", // тип запроса
      beforeSend: function (xhr) {},
      success: function (data) {
        //console.log(data);
        // if(data == 'redirect'){
        // 	$('.header-compare-link').removeAttr('href');
        // 	$('.header-compare-link').attr('href', 'http://'+ document.domain + '/compare-cred-cards');
        // }else{
        // 	$('.header-compare-link').removeAttr('href');
        // }
        //$('.tool-add').css('visibility','hidden');
        //$('.tool-remove').css('visibility','hidden');

        if (data > 0) {
          $(".header-compare-link .count").remove();
          $(".header-compare-link .header__links-icon").prepend(
            '<div class="count">' + data + "</div>"
          );
        } else {
          $(".header-compare-link .count").remove();
        }
      },
    });
    $.ajax({
      url: "/wp-content/themes/finbank_theme/get-compare-offer.php", // обработчик
      data: {
        post_id: post_id,
        post_tax: post_tax,
      }, // данные
      type: "POST", // тип запроса
      beforeSend: function (xhr) {},
      success: function (data) {
        $(".popup_compare_prod").html(data);
      },
    });
    /*	
	    setTimeout(function() { 
			$('.tool-add').css('visibility','hidden');
			$('.tool-remove').css('visibility','hidden');
	    }, 2000);
	*/
    return false;
  });

  //$('.btn__compare').append('<span class="tool-add">Добавить в сравнение</span><span class="tool-remove">Удалить из сравнения</span>');
  $(document).on("click", ".popup_compare_close", function () {
    $(".popup_compare").fadeOut();
  });

  $(document).on("click", ".delete_card", function () {
    var card_index = $(this).closest(".compare__item").attr("data-index");
    var card_type = $("main").attr("data-type");
    card_index = card_index - 1;
    //console.log(card_index, card_type);
    $.ajax({
      url: "/wp-content/themes/finbank_theme/session-compare.php", // обработчик
      data: {
        card_index: card_index,
        card_type: card_type,
      }, // данные
      type: "POST", // тип запроса
      beforeSend: function (xhr) {},
      success: function (data) {
        if (data == "redirect") {
          $(".header-compare-link").attr(
            "href",
            "http://" + document.domain + "/compare-cred-cards"
          );
        } else {
          $(".header-compare-link").removeAttr("href");
        }
        location.reload();
      },
    });
    return false;
  });

  // Отзывы
  $(document).on("click", ".reviews-link", function () {
    var post_id = $(this).attr("post-id");
    $.ajax({
      url: "/wp-content/themes/finbank_theme/session-reviews.php", // обработчик
      data: {
        post_id: post_id,
        display_type: "comments",
      }, // данные
      type: "POST", // тип запроса
      beforeSend: function (xhr) {},
      success: function (data) {
        //console.log(data);
        window.location.href = "http://" + document.domain + "/reviews";
      },
    });
    return false;
  });
  $(document).on("click", ".tax-reviews", function () {
    var data_tax = $(this).attr("data-tax");
    $.ajax({
      url: "/wp-content/themes/finbank_theme/session-reviews.php", // обработчик
      data: {
        data_tax: data_tax,
        display_type: "reviews",
      }, // данные
      type: "POST", // тип запроса
      beforeSend: function (xhr) {},
      success: function (data) {
        //console.log(data);
        window.location.href = "http://" + document.domain + "/reviews";
      },
    });
    return false;
  });
  $(document).on("click", ".input-comment-trigger", function () {
    var post_id = $(this).attr("post-id");
    $.ajax({
      url: "/wp-content/themes/finbank_theme/session-reviews.php", // обработчик
      data: {
        post_id: post_id,
        display_type: "comments",
      }, // данные
      type: "POST", // тип запроса
      beforeSend: function (xhr) {},
      success: function (data) {
        //console.log(data);
      },
    });
    return false;
  });
  setTimeout(function () {
    $(".pagination__description .review-count").html(
      $(
        ".comments-page-list .comments__item[style='display: block;'] .comment__one"
      ).length
    );
    $(document).on("click", "#loadMore", function () {
      $(".pagination__description .review-count").html(
        $(".comments-page-list .comments__item:visible .comment__one").length
      );
      setTimeout(function () {
        $(".pagination__description .review-count").html(
          $(
            ".comments-page-list .comments__item[style='display: block;'] .comment__one"
          ).length
        );
      }, 500);
    });
  }, 1000);
  setTimeout(function () {
    $(".pagination__description .review-tax-count").html(
      $(".reviews-page-list .reviews__page-item[style='display: block;']")
        .length
    );
    $(".pagination__description .review-tax-count-all").html(
      $(".reviews-page-list .reviews__page-item").length
    );
    $(document).on("click", "#loadMore", function () {
      setTimeout(function () {
        $(".pagination__description .review-tax-count").html(
          $(".reviews-page-list .reviews__page-item[style='display: block;']")
            .length
        );
        $(document).on("click", "#loadMore", function () {
          $(".pagination__description .review-tax-count").html(
            $(".reviews-page-list .reviews__page-item[style='display: block;']")
              .length
          );
        });
      }, 500);
    });
  }, 1000);

  $(".addtoany_shortcode a").click(function (e) {
    var count_id = $(this).closest(".card__icon").attr("data-id");
    var link = $(this).attr("href");

    console.log(link);
    e.preventDefault();
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      data: {
        action: "increment_counter",
        post_id: count_id,
      },
      type: "POST",
    })
      .done(function () {
        window.location.href = link;
      })
      .fail(function (xhr) {
        console.log(xhr);
      });
  });

  // Кастомные правки ссылок

  $(document).ready(function () {
    $(".offer-tabs .nav-link").click(function () {
      $(".offers-link-main").attr("href", $(this).attr("data-link"));
    });
    $(".article-tabs .nav-link").click(function () {
      $(".article-link-main").attr("href", $(this).attr("data-link"));
    });
    $(".reviews-tabs .nav-link").click(function () {
      //$( '.reviews-link-main' ).attr('data-tax', $(this).attr('data-tax'));
      var datatax = $(this).attr("data-tax");
      console.log(datatax);
      if (datatax == "banks")
        $(".reviews-link-main").attr(
          "href",
          "https://" + document.domain + "/reviews-banks"
        );
      if (datatax == "kredity")
        $(".reviews-link-main").attr(
          "href",
          "https://" + document.domain + "/reviews-kredity"
        );
      if (datatax == "creditcard")
        $(".reviews-link-main").attr(
          "href",
          "https://" + document.domain + "/reviews-creditcard"
        );
      if (datatax == "debetcard")
        $(".reviews-link-main").attr(
          "href",
          "https://" + document.domain + "/reviews-debetcard"
        );
      if (datatax == "installmentcard")
        $(".reviews-link-main").attr(
          "href",
          "https://" + document.domain + "/reviews-installmentcard"
        );
      if (datatax == "zaimy")
        $(".reviews-link-main").attr(
          "href",
          "https://" + document.domain + "/reviews-zaimy"
        );
    });
  });
});

jQuery(document).ready(function ($) {
  // Cache selectors
  var el = $(".article__one-contents, .mob-menutoc-contents");
  var topMenu = $("#menutoc, #menutocmob"),
    //topMenuHeight = topMenu.outerHeight()+25,
    //topMenuHeight = outerHeight()+15,
    topMenuHeight = 15;
  // All list items
  (menuItems = topMenu.find("li a")),
    // Anchors corresponding to menu items
    (scrollItems = menuItems.map(function () {
      var item = $($(this).attr("href"));
      if (item.length) {
        return item;
      }
    }));

  //console.log(topMenuHeight);

  // Bind to scroll
  $(window).scroll(function () {
    // Get container scroll position

    var fromTop = $(this).scrollTop() + topMenuHeight;
    // Get id of current scroll item
    var cur = scrollItems.map(function () {
      if ($(this).offset().top < fromTop) {
        //console.log($(this).offset().top +' --- '+fromTop);
        return this;
      }
    });

    // Get the id of the current element
    cur = cur[cur.length - 1];
    var id = cur && cur.length ? cur[0].id : "";
    // Set/remove active class
    //console.log(cur[0].offsetTop);
    //console.log(id);
    menuItems
      .parent()
      .removeClass("active")
      .end()
      .filter("[href='#" + id + "']")
      .parent()
      .addClass("active");
  });

  $(".tocdot").click(function () {
    $(".mob-menutoc-contents").toggleClass("open-tocdoc");
    $(".tocdot").toggleClass("tocopen");
  });
  $(".mob-menutoc-contents a").click(function () {
    $(".mob-menutoc-contents").toggleClass("open-tocdoc");
    $(".tocdot").toggleClass("tocopen");
  });

  $(".archive_title").click(function () {
    $(".archive_list").toggleClass("archive_hide");
  });

  $("#subscribe_action").submit(function () {
    var sub = false;
    if ($("#checkpolicy").is(":checked")) {
      sub = true;
    }

    if (sub) {
      $.ajax({
        url: "/subscribe.php",
        type: "POST",
        data: $(this).serialize(),
        beforeSend: function () {
          $(this).find("button[type=submit]").attr("disabled", true);
        },
        success: function (response) {
          if (response.success != false) {
            console.log("Good: " + response);
            $(this).find("button[type=submit]").attr("disabled", false);
            $(this).find("input").val("");
            $("#subscribe_action").css("display", "none");
            $("#subscribe_request").css("display", "block");
          } else {
            $("#email-error").html(response.data[0].message);
          }
        },
        error: function () {
          console.log("Error: " + response);
        },
      });
    }

    return false;
  });

  $(".present-icon").click(function () {
    ym(35020350, "reachGoal", "PRESENT_CLICK");
    $(".present-content").fadeToggle();
    $(".present-icon-present").fadeToggle("fast");
    $(".present-icon-close").fadeToggle("fast");
  });

  function present() {
    if ($(".present-content").is(":hidden")) {
      $(".present-content").fadeToggle();
      $(".present-icon-present").fadeToggle("fast");
      $(".present-icon-close").fadeToggle("fast");
    }
  }

  var presentwin = getCookie("popup_present");
  if (
    presentwin != "no" &&
    isMobileBrowser() == false &&
    $(".present-content").data("show_in_page") == 1
  ) {
    setTimeout(present, 10000);
    // записываем cookie на 1 день, с которой мы не показываем окно
    var date = new Date();
    date.setDate(date.getDate() + 1);
    document.cookie = "popup_present=no; path=/; expires=" + date.toUTCString();
  }

  $(".popup_exit_close").click(function () {
    $(".popup_exit_wrap").fadeOut();
  });

  $(".archive_exit_close").click(function () {
    $(".archive_exit_wrap").fadeOut();
    $(".archive_exit_wrap").attr("data-show", "N");
  });

  $(".out_exit_close, .out_exit_close2").click(function () {
    $(".out_exit_wrap").fadeOut();
  });

  $(".out_exit_link").click(function () {
    $(".popup_exit_wrap").fadeOut();
    $(".out_exit_wrap").fadeIn("fast");
  });

  // POPUP_APPLY

  // SLIDERS ALLL

  if ($(".slider").length) {
    tns({
      container: ".slider",
      // prev: ".slider__button-prev",
      // next: ".slider__button-next",
      pagination: ".slider__pagination",
      items: 1,
      autoplay: 1,
      // autoplayButtonOutput: !1,
      autoplayTimeout: 7110,
      mouseDrag: !0,
      speed: 1e3,
      // nav: !0,
      // navPosition: "bottom",
      controls: true,
      prevButton: ".slider__button-prev",
      nextButton: ".slider__button-next",
      autoplayButtonOutput: false,
      //preventScrollOnTouch: 'auto',

      responsive: {
        1200: {
          center: !0,
          edgePadding: 125,
          // controls: !0
        },
      },
      onInit: document
        .querySelector(".wellcome__slider")
        .classList.remove("slider_init"),
    });
  }

  if ($(".slider-new").length) {
    tns({
      container: ".slider-new",
      controlsContainer: ".slider__button_container",
      prev: ".slider__button-prev",
      next: ".slider__button-next",
      pagination: ".slider__pagination",
      items: 1,
      autoplay: !0,
      autoplay: !1,
      autoplayButtonOutput: !1,
      autoplayTimeout: 3e3,
      mouseDrag: !0,
      speed: 1e3,
      nav: !0,
      navPosition: "bottom",
      controls: !0,
      prevButton: ".slider__button-prev",
      nextButton: ".slider__button-next",
      responsive: {
        // 1200: {
        //     center: !0,
        //     edgePadding: 125,
        //     controls: !0
        // }
      },
    });
  }

  if ($(".expert__slider").length) {
    tns({
      container: ".container-elements",
      controlsContainer: ".slider__button_container",
      prev: ".slider__button-prev",
      next: ".slider__button-next",
      pagination: ".slider__pagination",
      items: 1,
      autoplay: !0,
      autoplay: !1,
      autoplayButtonOutput: !1,
      autoplayTimeout: 3e3,
      mouseDrag: !0,
      speed: 1e3,
      nav: !0,
      mode: "gallery",
      navPosition: "bottom",
      controls: !0,
      prevButton: ".slider__button-prev",
      nextButton: ".slider__button-next",
      responsive: {
        // 1200: {
        //     center: !0,
        //     edgePadding: 125,
        //     controls: !0
        // }
      },
    });
  }

  if ($(".tags__main_v2_slider").length) {
    tns({
      container: ".tags__main_v2_slider-container",
      controlsContainer: ".slider__button_container",
      prev: ".slider__button-prev",
      next: ".slider__button-next",
      // pagination: ".slider__pagination",
      nav: false,
      items: 8,
      autoplay: !0,
      autoplay: !1,
      autoplayButtonOutput: !1,
      autoplayTimeout: 3e3,
      mouseDrag: !0,
      speed: 1e3,
      nav: false,
      // mode: "gallery",
      // navPosition: "bottom",
      controls: !0,
      prevButton: ".slider__button-prev",
      nextButton: ".slider__button-next",
      responsive: {
        // 1200: {
        //     center: !0,
        //     edgePadding: 125,
        //     controls: !0
        // }
      },
    });
  }

  if ($(".expert__slider-container").length) {
    tns({
      container: ".expert__slider-container ",
      items: 1,
      pagination: ".slider__pagination",
      autoplay: !0,
      autoplay: !1,
      autoplayButtonOutput: !1,
      autoplayTimeout: 3e3,
      mouseDrag: !0,
      speed: 1e3,
      nav: !1,
      //mode: "gallery",
      navPosition: "bottom",
      //controls: !0,
      center: !1,
      edgePadding: 0,

      prevButton: ".expert__slider-nav .prev",
      nextButton: ".expert__slider-nav .next",
    });
  }

  var select_actual_products = false;

  // $('.apply_now_btm').click(function() {
  //
  //
  // 		if($(this).attr('data-popap-apply-id') && $(this).attr('data-popap-apply-id') !== ''){
  //
  // 			var parent_id =  $(this).attr('data-popap-apply-id');
  //
  // 			var title = $(this).parent().parent().parent().parent().parent().find('h4 a').text();
  //
  // 			var term = '';
  //
  // 			if($('input[name="term"]').length){
  // 				term = $('input[name="term"]').val();
  // 			}
  //
  //
  // 			//console.log('Title: ' + title)
  //
  // 			if($('#popap_apply_' + parent_id).length) {
  //
  // 				$('#popap_apply_' + parent_id + ' .popup_apply_now').fadeIn("fast");
  //
  // 			}else{
  //
  // 				$.ajax({
  // 					url : '/wp-admin/admin-ajax.php', // AJAX handler
  // 					data : {
  // 						'action': 'get_popap_apply', // the parameter for admin-ajax.php
  // 						'id': parent_id,
  // 						'title': title,
  // 						'term': term,
  // 					},
  // 					type : 'POST',
  // 					dataType: "json",
  // 					success: function (res) {
  //
  // 						console.log(res)
  //
  //
  // 						if(!$('#popap_apply_' + parent_id).length){
  //
  // 							$('.POPUP_APPLY_ALL').append("<div id='popap_apply_" + parent_id + "'></div>")
  // 							$('#popap_apply_' + parent_id).html(res.content)
  // 							$('#popap_apply_' + parent_id + ' .popup_apply_now').fadeIn("fast");
  //
  // 							var slider = tns({
  // 								container: '#popap_apply_' + parent_id + " .slider-new",
  // 								controlsContainer: '#popap_apply_' + parent_id + " .slider__button_container",
  // 								prev: '#popap_apply_' + parent_id + " .slider__button-prev",
  // 								next: '#popap_apply_' + parent_id + " .slider__button-next",
  // 								pagination: '#popap_apply_' + parent_id + " .slider__pagination",
  // 								prevButton: '#popap_apply_' + parent_id + " .slider__button-prev",
  // 								nextButton: '#popap_apply_' + parent_id + " .slider__button-next",
  // 							})
  //
  // 						}
  //
  // 					},
  // 					error: function (jqXHR, textStatus, errorThrown) {
  // 						console.log(jqXHR)
  // 						console.log(textStatus)
  // 						console.log(errorThrown)
  // 						/*response.text('')*/
  // 						// response.html(jqXHR.responseJSON.message)
  //
  // 					}
  // 				});
  // 			}
  //
  // 			select_actual_products = true;
  //
  // 		}else{
  // 			// Детальная страница
  // 			$('.popup_apply_now').fadeIn("fast");
  // 			$(".popup_apply_now").attr('data-show', 'Y');
  // 		}
  //
  // 		ym(35020350,'reachGoal','NOREF_POPUP_open')
  //
  // 	// check_popap();
  //
  // });

  $(document).on("click", ".apply_now_btm", function () {
    if (
      $(this).attr("data-popap-apply-id") &&
      $(this).attr("data-popap-apply-id") !== ""
    ) {
      var parent_id = $(this).attr("data-popap-apply-id");

      var title = $(this)
        .parent()
        .parent()
        .parent()
        .parent()
        .parent()
        .find("h4 a")
        .text();

      var term = "";

      if ($('input[name="term"]').length) {
        term = $('input[name="term"]').val();
      }

      //console.log('Title: ' + title)

      if ($("#popap_apply_" + parent_id).length) {
        $("#popap_apply_" + parent_id + " .popup_apply_now").fadeIn("fast");
      } else {
        $.ajax({
          url: "/wp-admin/admin-ajax.php", // AJAX handler
          data: {
            action: "get_popap_apply", // the parameter for admin-ajax.php
            id: parent_id,
            title: title,
            term: term,
          },
          type: "POST",
          dataType: "json",
          success: function (res) {
            console.log(res);

            if (!$("#popap_apply_" + parent_id).length) {
              $(".POPUP_APPLY_ALL").append(
                "<div id='popap_apply_" + parent_id + "'></div>"
              );
              $("#popap_apply_" + parent_id).html(res.content);
              $("#popap_apply_" + parent_id + " .popup_apply_now").fadeIn(
                "fast"
              );

              var slider = tns({
                container: "#popap_apply_" + parent_id + " .slider-new",
                controlsContainer:
                  "#popap_apply_" + parent_id + " .slider__button_container",
                prev: "#popap_apply_" + parent_id + " .slider__button-prev",
                next: "#popap_apply_" + parent_id + " .slider__button-next",
                pagination:
                  "#popap_apply_" + parent_id + " .slider__pagination",
                prevButton:
                  "#popap_apply_" + parent_id + " .slider__button-prev",
                nextButton:
                  "#popap_apply_" + parent_id + " .slider__button-next",
              });
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            /*response.text('')*/
            // response.html(jqXHR.responseJSON.message)
          },
        });
      }

      select_actual_products = true;
    } else {
      // Детальная страница
      $(".popup_apply_now").fadeIn("fast");
      $(".popup_apply_now").attr("data-show", "Y");
    }

    ym(35020350, "reachGoal", "NOREF_POPUP_open");
  });

  $(document).on("click", ".popup_apply_now_close", function () {
    $(".popup_apply_now").fadeOut();
    select_actual_products = false;
  });

  // КЛИК ВНЕ ЭЛЕМЕНТА И СКРЫТИЕ
  $(document).mouseup(function (e) {
    var outside_element = $(".popup_apply_now .out_exit");
    var popup_apply_now = $(".popup_apply_now");
    if (
      !outside_element.is(e.target) &&
      outside_element.has(e.target).length === 0
    ) {
      popup_apply_now.hide();
      select_actual_products = false;
      // включить
      // ym(35020350,'reachGoal','NOREF_POPUP_WRAPPER')
    }
  });

  function archive_popup() {
    var is_check_popap = check_popap();

    if (is_check_popap) {
      $(".popup_exit_wrap").fadeOut();
      $(".popup_exit_wrap").attr("data-show", "N");

      $(".archive_exit_wrap").fadeIn("fast");
      $(".archive_exit_wrap").attr("data-show", "Y");
    } else {
      setTimeout(archive_popup, 10000);
    }
  }

  // Показать 1 раз
  function help_become_better_popup(class_name) {
    var help_become_better_popup = window.localStorage.getItem(
      "help_become_better_popup"
    );

    console.log("from session value: " + help_become_better_popup);

    var is_check_popap = check_popap();
    if (help_become_better_popup != "Y" && is_check_popap) {
      $(".popup__form-help-become-better").fadeIn("fast");
      $(".popup__form-help-become-better").attr("data-show", "Y");
      window.localStorage.setItem("help_become_better_popup", "Y");
    }
  }

  // Показать попап "К сожалению, банк больше не выпускает"
  if (document.querySelector(".archive_exit_wrap")) {
    setTimeout(archive_popup, 10000);
  }

  // Показать попап HELP BECOME BETTER
  // if (document.querySelector('.popup__form-help-become-better')) {
  // 	setTimeout(help_become_better_popup, 60000);
  // }

  function check_popap() {
    var have_active_popap = false;
    var parent = $(".check_popap").parent();

    parent.find($(".check_popap")).each(function () {
      if ($(this).attr("data-show") == "Y") {
        have_active_popap = true;
      }
    });

    // если нету активных попапов, то должно возращать true
    if (have_active_popap == false && select_actual_products == false) {
      return true;
    } else {
      return false;
    }
  }

  //Функция вызова контрольного варианта
  function vq_call_block_a() {
    console.log("Эксперемент №1");
    var test = 0;

    if (isMobileBrowser() == false) {
      $(document).mouseleave(function (e) {
        var exit = window.sessionStorage.getItem("exit_popup");

        console.log(exit);

        if (e.clientY < 10 && exit != "1") {
          $(".archive_exit_wrap").fadeOut();
          $(".archive_exit_wrap").attr("data-show", "N");
          $(".out_exit_wrap").fadeOut();
          $(".out_exit_wrap").attr("data-show", "N");
          $(".popup_apply_now").fadeOut();
          $(".popup_apply_now").attr("data-show", "N");

          ym(35020350, "reachGoal", "exit_popup_open");
          $(".popup_exit_wrap").fadeIn("fast");

          $(".popup_exit_wrap").attr("data-show", "Y");

          var popap_name = $(".popup_exit_wrap").data("popap");
          if (popap_name == "popap_best_offers") {
            ym(35020350, "reachGoal", "1EX_POPUP_open");
          } else if (popap_name == "popap_witch_tag") {
            ym(35020350, "reachGoal", "2EX_POPUP_open");
          }

          window.sessionStorage.setItem("exit_popup", "1");
        }
      });
    }
  }
  //Функция вызова Варианта 1
  function vq_call_block_b() {
    console.log("Эксперемент №2");
  }
  //Функция вызова дефолтного варианта
  function vq_call_block_default() {
    console.log("Эксперимент завершен или не запущен на данной странице");
  }
  //Функция применения флагов
  function render_ab_answer(flags) {
    const flagVal = flags && flags.popap_show && flags.popap_show[0];

    // console.log(flagVal)

    switch (flagVal) {
      case "Y":
        vq_call_block_a();
        ym(35020350, "getClientID", function (clientID) {
          var client = clientID;
        });

        break;
      case "N":
        vq_call_block_b();
        ym(35020350, "getClientID", function (clientID) {
          var client = clientID;
        });
        break;
      default:
        vq_call_block_default();
        vq_call_block_a();
        break;
    }
  }

  //Функция получения значений из настроек запущенного эксперимента в Метрике с последующей передачей значений в функцию выше
  // ymab('metrika.35020350',

  // if(ymab){
  // 	ymab('metrika.35020350', 'init', function (answer) {
  // 		render_ab_answer(answer.flags);
  // 	})
  // }

  render_ab_answer("Y");

  $(document).click(function (e) {
    if (
      $(".popup_exit_wrap").is(":visible") &&
      !$(e.target).closest(".popup_exit_wrap .popup_exit_body").length
    ) {
      var popap_name = $(".popup_exit_wrap").data("popap");
      if (popap_name == "popap_best_offers") {
        ym(35020350, "reachGoal", "1EX_POPUP_WRAPPER");
      } else if (popap_name == "popap_witch_tag") {
        ym(35020350, "reachGoal", "2EX_POPUP_WRAPPER");
      }
      $(".popup_exit_wrap").remove();
    }
  });

  $(".exit_btn").click(function () {
    $(".popup_exit_wrap").remove();
    return true;
  });

  // функция возвращает cookie с именем name, если есть, если нет, то undefined
  function getCookie(name) {
    var matches = document.cookie.match(
      new RegExp(
        "(?:^|; )" +
          name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
          "=([^;]*)"
      )
    );
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }
});

// Проверяем, является ли браузер мобильным
function isMobileBrowser() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
    navigator.userAgent
  );
}

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 400 ||
    document.documentElement.scrollTop > 400
  ) {
    if (document.getElementById("myBtn") != null) {
      document.getElementById("myBtn").style.display = "block";
      document.getElementById("popup_compare").style.bottom = "130px";
    }
  } else {
    if (document.getElementById("myBtn") != null) {
      document.getElementById("myBtn").style.display = "none";
      document.getElementById("popup_compare").style.bottom = "60px";
    }
  }
}
/*
// When the user clicks on the button, scroll to the top of the document
function topUp() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
*/
jQuery(document).ready(function ($) {
  $("#myBtn").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 500);
    return false;
  });

  if (document.querySelector("#pageNav")) {
    $(function () {
      $("a[href*=#]:not([href=#])").click(function () {
        if (
          location.pathname.replace(/^\//, "") ==
            this.pathname.replace(/^\//, "") &&
          location.hostname == this.hostname
        ) {
          var t = $(this.hash);
          if (
            ((t = t.length ? t : $("[name=" + this.hash.slice(1) + "]")),
            t.length)
          )
            return (
              $("html,body").animate({ scrollTop: t.offset().top - 100 }, 500),
              !1
            );
        }
      });
    });
  } else {
    $(function () {
      $("a[href*=#]:not([href=#])").click(function () {
        if (
          location.pathname.replace(/^\//, "") ==
            this.pathname.replace(/^\//, "") &&
          location.hostname == this.hostname
        ) {
          var t = $(this.hash);
          if (
            ((t = t.length ? t : $("[name=" + this.hash.slice(1) + "]")),
            t.length)
          )
            return (
              $("html,body").animate({ scrollTop: t.offset().top - 50 }, 500),
              !1
            );
        }
      });
    });
  }
});
//sliderBlock = document.querySelector('.slider');

//console.log(tns.onInit());

//slider.events.on('transitionEnd', customizedFunction);


window.onload = function () {
  setTimeout(function () {
    document
      .querySelectorAll(".gallery img, figure img")
      .forEach((n) => {
        const link = document.createElement("a");
        link.setAttribute("data-fslightbox", "gallery");
        link.setAttribute("data-type", "image");

        if (n.hasAttribute("data-src")) {
          link.setAttribute("href", n.getAttribute("data-src"));
        } else {
          link.setAttribute("href", n.getAttribute("src"));
        }

        // Получаем текст из figcaption, если он есть, иначе alt
        let captionText = "";
        const figure = n.closest("figure");
        if (figure) {
          const figcaption = figure.querySelector("figcaption");
          if (figcaption && figcaption.textContent.trim() !== "") {
            captionText = figcaption.textContent;
          } else {
            captionText = n.getAttribute("alt");
          }
        } else {
          captionText = n.getAttribute("alt");
        }
        link.setAttribute("data-caption", captionText);

        n.parentNode.append(link);
        link.append(n);
      });
  }, 300);

  document.querySelectorAll("img.bigpic").forEach((n) => {
    const link = document.createElement("a");
    link.setAttribute("data-fslightbox", "gallery");
    link.setAttribute("data-type", "image");

    link.setAttribute("href", n.getAttribute("src"));

    // Для bigpic пробуем тоже получить текст из figcaption, иначе title
    let captionText = "";
    const figure = n.closest("figure");
    if (figure) {
      const figcaption = figure.querySelector("figcaption");
      if (figcaption && figcaption.textContent.trim() !== "") {
        captionText = figcaption.textContent;
      } else {
        captionText = n.getAttribute("title");
      }
    } else {
      captionText = n.getAttribute("title");
    }
    link.setAttribute("data-caption", captionText);

    n.parentNode.append(link);
    link.append(n);
  });

  setTimeout(function () {
    const lightbox = new FsLightbox();
    refreshFsLightbox();
  }, 500);
};

document.addEventListener("DOMContentLoaded", function () {
  const btnShow5 = (selector, hiddenTrClass) => {
    const btn = document.querySelectorAll(selector);

    btn.forEach((item) => {
      const target = document.getElementById(item.dataset.target);
      const arrTr = target.querySelectorAll(".code3text");
      let hiddenTr = [];
      let textShowHide = false;

      // create array of hidden elements
      arrTr.forEach((tr) => {
        if (tr.classList.contains(hiddenTrClass)) {
          hiddenTr.push(tr);
        }
      });

      item.addEventListener("click", (e) => {
        e.preventDefault();
        // toggle text onClick
        item.lastChild.previousSibling.innerText = textShowHide
          ? item.dataset.textOpen
          : item.dataset.textHide;
        textShowHide = !textShowHide;

        // toggle class onClick
        //item.classList.toggle('visible__items');
        //item.classList.toggle('12341234');
        //item.classList.add('123123');

        // toggle visible elements
        if (hiddenTr.length > 0) {
          hiddenTr.forEach((tr) => {
            tr.classList.toggle(hiddenTrClass);
          });
        }
      });
    });
  };

  btnShow5(".btn__details", "div__hidden");
});

var wt_gt_domain = "";
var wt_gt_protocol = "https";
var list_tag = "ul";
var column_class = "col-12 col-sm-6 col-md-3";
var type_select_location = "java_script";
jQuery(function ($) {
  $(document).on("click", ".popup_image_close", function () {
    $(".popup_image_wrap").fadeOut();
  });

  $(document).on("click", ".tabs-table .mobile div", function () {
    var parent = $(this).closest(".tabs-table");
    var data_class_item = $(this).attr("data-class-item");

    var all_items = parent.find(".item");

    all_items.each(function (i) {
      $(this).removeClass("show");
    });

    var need_item = parent.find("." + data_class_item);
    need_item.each(function (i) {
      $(this).addClass("show");
    });

    $(parent).find(".mobile div").removeClass("active");
    $(this).addClass("active");
  });

  $(document).on("click", ".tab-item", function () {
    var parent = $(this).parent().parent();

    var tabId = $(this).attr("data-tab");
    var content = $("#" + tabId);

    // Удаляем активный класс у текущих вкладок и контента
    if (parent.find(".tab-item.active")) {
      parent.find(".tab-item.active").removeClass("active");
    }
    if (parent.find(".tab-pane.active")) {
      parent.find(".tab-pane.active").removeClass("active");
    }

    // Добавляем активный класс для выбранной вкладки и контента
    $(this).addClass("active");
    $(content).addClass("active");
  });

  $("[data-fancybox]").click(function (e) {
    e.preventDefault();
    const src = $(this).attr("href");
    $(".popup_image_body").html('<img src="' + src + '" style="width:100%" />');
    $(".popup_image_wrap").fadeIn();
  });

  let citiesContainer = $("#all-cities");
  let citiesLoaded = false;

  $("#btn__region").click(function () {
    if (citiesLoaded) {
      return;
    }

    citiesLoaded = true;

    $.ajax({
      url: "/wp-admin/admin-ajax.php?action=get_cities",
      method: "get",
      cache: true,
      dataType: "json",
      success: function (cities) {
        let columns = [];
        for (let i = 0; i < 4; i++) {
          let div = document.createElement("div");
          div.classList.add("col-12", "col-sm-6", "col-md-3");
          let ul = document.createElement("ul");
          div.appendChild(ul);
          citiesContainer.get(0).appendChild(div);

          columns.push(ul);
        }

        let countInColumn = Math.ceil(Object.keys(cities).length / 4);
        let i = 0;
        for (let k in cities) {
          let li = document.createElement("li");
          let a = document.createElement("a");
          a.classList.add("location_child");
          a.onclick = function () {
            WtLocation.setValue(cities[k], "city", "reload");
          };
          a.innerHTML = cities[k];

          li.appendChild(a);
          columns[Math.floor(i / countInColumn)].appendChild(li);
          i++;
        }
      },
    });
  });

  if (!isMobileBrowser()) {
    $(document).on("mouseover", ".navigation__item", function () {
      $(".navigation__item").each(function (i) {
        $(this).find(".navigation__item-sub").removeClass("show_menu_items");
      });
      $(this).find(".navigation__item-sub").toggleClass("show_menu_items");
    });

    $(document).on("mouseleave", ".show_menu_items", function () {
      $(this).removeClass("show_menu_items");
    });
  }

  $(".js-phone").inputmask("+7(999)999-99-99");

  // change icon for pc ЗАМЕНА ИКОНКИ СВГ CVG и TITLE
  if ($(".breadcrumb-item").length) {
    // это может быт детальная страница
    var bread_name = $($(".breadcrumb-item")[1]).find("a").text();

    // если пусто, то берем без тега "а"
    if (bread_name == "") {
      bread_name = $($(".breadcrumb-item")[1]).text();
    }

    var title_old = $("title").text();
    var svg_old = $('link[rel="icon"], link[rel="shortcut icon"]').attr("href");

    var new_title = "";

    switch (bread_name) {
      case "Кредиты":
        new_title = "Не забудьте оформить кредит!";
        break;
      case "Займы":
        new_title = "Не забудьте оформить займ!";
        break;
      case "Кредитные карты":
      case "Карты рассрочки":
      case "Дебетовые карты":
        new_title = "Не забудьте оформить карту!";
        break;
      default:
    }

    if (new_title != "") {
      var start_show_new_title;

      // неактивно
      window.onblur = function () {
        start_show_new_title = setInterval(function () {
          if (document.title == new_title) {
            document.title = title_old;
          } else {
            document.title = new_title;
          }
        }, 1000);

        // const start_show_new_title = setInterval(() => {
        //
        // 	document.title= new_title
        //
        // 	setTimeout(function() {
        // 		document.title= title_old
        // 	}, 1000);
        //
        // }, 2000);
        //

        $('link[rel="icon"], link[rel="shortcut icon"]').attr(
          "href",
          "/red_icon.png"
        );
      };
      // активно
      window.onfocus = function () {
        if (start_show_new_title) {
          clearInterval(start_show_new_title);
        }

        document.title = title_old;
        $('link[rel="icon"], link[rel="shortcut icon"]').attr("href", svg_old);
      };
    }
  }

  // вопросы и ответы кастом

  $(document).on("click", ".question-wrapper .quest", function () {
    $(this).toggleClass("collapsed");
    $(this).siblings(".answer-faq").toggle("slow");
  });

  if ($(".use_new_template_v1").length) {
    var view_type = window.localStorage.getItem("view_type");

    if (view_type) {
      if (view_type == "card_list") {
      } else {
        $("#response-cred-card .card").removeClass("card_list");
        $("#response-cred-card .card").removeClass("card_grid");
        $("#response-cred-card .card").addClass(view_type);

        $(".template_view .card_list").removeClass("active");
        $(".template_view .card_grid").addClass("active");
      }
    }
  }

  // comment-reply-link
  // Цитировать функционал
  // Кнопка пожаловаться
  $(".comment__one-answer").click(function () {
    // console.log($(this))
    var this_text = $(this).text();
    var postid = $(this).attr("data-postid");
    var search = $("textarea[post-id='" + postid + "']");
    // console.log(this_text)
    if (this_text == "Цитировать") {
      // console.log($(this).attr('data-postid')
      // console.log(search)
      var search_text_comment = $(this)
        .parent()
        .parent()
        .find(".comment__one-content")
        .text();
      search.val($.trim(search_text_comment));
      // search.val('Новый текст');
      // console.log(search_text_comment)
      // найти post-id , равный вверхнему
      // $('[post-id="5141"]'){
      // 	$('[data-postid]'){
      //
      // 	}
      // }
    } else {
      // Очищаем
      search.val(" ");
    }
  });

  // Кнопка пожаловаться
  $(document).on("click", ".complain-btn", function () {
    var id = $(this).data("id");

    $.ajax({
      type: "POST",
      url: "/custom-comments-post.php",
      data: {
        complain: 1,
        id: id,
      },
      dataType: "json",
      success: function (res) {
        $(".popup_alert_body").text(res.message);
        $(".popup_alert_wrap").fadeIn();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseJSON.message);
      },
    });

    return false;
  });

  // Сменить шаблон отоброжения плитка и лист
  $(document).on("click", ".js_change_view_template", function () {
    var view = $(this).data("view");

    $(".js_change_view_template").removeClass("active");
    $(this).addClass("active");

    // $('.view_type').attr('data-view_type', view)
    window.localStorage.setItem("view_type", view);
    //var help_become_better_popup = window.localStorage.getItem('help_become_better_popup');

    $("#response-cred-card .card").removeClass("card_list");
    $("#response-cred-card .card").removeClass("card_grid");
    $("#response-cred-card .card").addClass(view);

    // console.log(view)

    $.ajax({
      type: "POST",
      url: "/ajax-settings-session.php",
      data: {
        view_type: view,
      },
      dataType: "json",
      success: function (res) {
        console.log(res);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      },
    });
  });

  function clear_form__filter_v1() {
    if ($(".filter_v1").length) {
      $(".filter_v1")[0].reset();
      $(".filter_v1 .range__input").css("--range-progress", "0%");
      $(".filter_v1 .styledSelect option").val("");
      $(".filter_v1 .choices__list--single .choices__item--selectable").text(
        "Любой"
      );

      $(".filter_v1 .range__value").attr("value", 0);
      $(".filter_v1 .range__input").attr("value", 0);

      let range_items = document.querySelectorAll('input[type="range"]');

      range_items.forEach((elem) => {
        elem.value = 0;
      });
    }
  }

  clear_form__filter_v1();

  $(document).on("click", ".clear_form__filter_v1", function () {
    clear_form__filter_v1();
  });

  $(document).on("click", ".show__detail_popup", function () {
    var $this = $(this);
    var id = $(this).attr("data-id");
    var was_loaded = $(this).attr("data-was_loaded");
    var popup = $this.siblings(".popup");

    if (!was_loaded) {
      $.ajax({
        /*type : 'GET',
				url: "/ajax-get-more-details.php",
				data: {
					id: id,
				},
				dataType : 'json',*/
        url: "/wp-admin/admin-ajax.php", // AJAX handler
        data: {
          action: "get_more_details", // the parameter for admin-ajax.php
          id: id,
        },
        type: "POST",
        dataType: "json",
        success: function (res) {
          // После Ajax получения делаем
          $this.attr("data-was_loaded", "1");
          popup.find(".detail_popup").html(res.content);
          popup.show();
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(textStatus);
        },
      });
    } else {
      popup.show();
    }
  });

  $(document).on("click", ".open__dop-btn", function () {
    var $this = $(this);
    var id = $(this).attr("data-id");
    var have_content_more_detail = $(this).attr(
      "data-have-content-more-detail"
    );
    var parent = $(this).closest(".tabs-and-btns");
    var btnText = parent.find(".open__dop-btn-text");
    var tabs = parent.parent().find(".tabs");

    // var popup = parent.parent().find('.popup_detail_wrap');
    // if(popup){
    // 	popup.show()
    // }
    if (!have_content_more_detail) {
      // console.log('Тут же ?')
      $.ajax({
        // type : 'GET',
        // url: "/ajax-get-more-details.php",
        // data: {
        // 	id: id,
        // },
        // dataType : 'json',
        url: "/wp-admin/admin-ajax.php", // AJAX handler
        data: {
          action: "get_more_details", // the parameter for admin-ajax.php
          id: id,
        },
        type: "POST",
        dataType: "json",
        success: function (res) {
          console.log(res);
          $this.attr("data-have-content-more-detail", "1");
          $(tabs).html(res.content);
          $(tabs).toggle("show");
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(jqXHR);
          console.log(textStatus);
          console.log(errorThrown);

          //response.text('')
          //esponse.html(jqXHR.responseJSON.message)
        },
      });
      // открываем/закрываем
      // setTimeout(function() {
      // 	$(tabs).toggle('show');
      // }, 500);
    } else {
      // console.log('какого ?')
      // открываем/закрываем

      $(tabs).toggle("show");
    }

    // замена текста
    // var open = $(this).attr("data-open");
    // var close = $(this).attr("data-close");
    // if (btnText.text() === close) {
    //   btnText.text(open);
    // } else {
    //   btnText.text(close);
    // }
  });

  // get_selected_value_v1'

  $("#select_item_otziv").on("change", function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

    console.log(valueSelected);

    $(".form_otziv #comment_post_ID").val(valueSelected);
  });

  // Закоментил, т.к где то  есть готовый функционал открытия и закрытия.
  $(document).on("click", ".accordion__header", function () {
    // $(this).hide();
    // $(this).siblings('.accordion__collapse').toggleClass('show');
    // $(this).siblings('.accordion__collapse').toggle('show');
  });

  $(document).on("click", ".show__popup_filter_wrap", function () {
    // $(this).hide();
    $(".popup_filter_wrap").show();
  });

  $(document).on("click", ".show__popup_calc_wrap", function () {
    // $(this).hide();
    $(".popup_calc_wrap").show();
  });

  $(document).on("click", ".show__custom_form_v1", function () {
    $(this).hide();
    $(".custom_form_v1").show();
  });

  $(document).on("click", ".show__custom_form_v2", function () {
    $(this).hide();
    $(".custom_form_v2").show();
  });

  $(document).on("click", ".page__heading-description---open", function () {
    $(".page__heading-description").toggleClass("active");

    // $(this).toggleClass('absol')

    if ($(this).text() == "Свернуть") {
      $(this).text("Развернуть");
    } else {
      $(this).text("Свернуть");
    }
  });

  // show__siblilings__filter__btn

  $(document).on("click", ".show__siblilings__filter__btn", function () {
    $(this).siblings(".dop-box").show(200);
    $(this).hide();

    return false;
  });

  // Чтоб не переписывать функционал, решил из калькулятора получить поля, и отправить их в
  // фильтр, но они немного различаются

  $(document).on("click", ".popup_calc_wrap .submit-button", function () {
    // в любом случае получаем переменные name="range1" name="range2"
    let calc_sum = $('input[name="range1"]').val();
    let calc_time = $('input[name="range2"]').val();

    let sum, time;

    // для займа
    if ($('input[name="z_sum"]').length) {
      sum = $('input[name="z_sum"]');
      time = $('input[name="z_time"]');
    }

    // для кредит
    if ($('input[name="summ_limit"]').length) {
      sum = $('input[name="summ_limit"]');
      time = $('input[name="cred_summ_period"]');
    }

    // кредитные карты cred_limit
    if ($('input[name="cred_limit"]').length) {
      sum = $('input[name="cred_limit"]');
      time = $('input[name="cred_day_period"]');
    }

    sum.val(calc_sum);
    time.val(calc_time);

    $(".filter_v1 .submit-button").click();
  });

  // submit-button
});
