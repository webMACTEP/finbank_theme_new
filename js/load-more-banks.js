(function ($) {
    $(document).ready(function () {
      const $btn = $(".load_more_btn_banks");
      const $container = $("#response-cred-card");
  
      $btn.on("click", function (e) {
        e.preventDefault();
  
        let paged = parseInt($btn.data("paged")) + 1;
        const max = parseInt($btn.data("max_pages"));
  
        if (paged > max) {
          $btn.hide();
          return;
        }
  
        $.ajax({
          url: load_more_banks.ajax_url,
          type: "POST",
          dataType: "json",
          data: {
            action: "load_more_banks",
            paged: paged,
          },
          beforeSend() {
            $btn.text("Загрузка…");
          },
          success(res) {
            if (res.success && res.data.html) {
              $container.append(res.data.html);
              $btn.data("paged", paged);
              if (paged >= res.data.max_page) {
                $btn.hide();
              } else {
                $btn.text("Больше решений");
              }
            } else {
              $btn.hide();
            }
          },
          error() {
            $btn.text("Ошибка. Попробуйте ещё раз");
          },
        });
      });
    });
  })(jQuery);