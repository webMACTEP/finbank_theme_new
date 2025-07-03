document.addEventListener("DOMContentLoaded", () => {
  function toggleModal(modalSelector) {
    var modal = document.querySelector(modalSelector);
    if (modal) {
      modal.classList.toggle("active");
    }
  }

  function closeModal(modalSelector) {
    var modal = document.querySelector(modalSelector);
    if (modal) {
      modal.classList.remove("active");
    }
  }

  // Универсальная функция для кликов по кнопкам
  function setupModalToggle(buttonSelector, modalSelector) {
    document.querySelectorAll(buttonSelector).forEach(function (btn) {
      btn.addEventListener("click", function () {
        toggleModal(modalSelector);
      });
    });
  }

  function setupModalClose(buttonSelector, modalSelector) {
    document.querySelectorAll(buttonSelector).forEach(function (btn) {
      btn.addEventListener("click", function () {
        closeModal(modalSelector);
      });
    });
  }

  // Фильтр
  setupModalToggle(".filtr-butt", ".new-filter-modal");
  setupModalClose(".new-filter-modal-close", ".new-filter-modal");
  setupModalClose(".submit-button", ".new-filter-modal");

  // Калькулятор
  setupModalToggle(".calc-butt", ".new-calc-modal");
  setupModalClose(".new-calc-close, .new-calc-btn-close", ".new-calc-modal");

  // Закрытие модального окна при клике вне области .new-calc-content и .new-filter-content
  document.addEventListener("click", function (event) {
    document
      .querySelectorAll(".new-filter-modal, .new-calc-modal")
      .forEach(function (modal) {
        let isClickInsideContent = event.target.closest(
          ".new-filter-modal-content, .new-calc-content"
        );
        let isClickInsideModal = event.target.closest(
          ".new-filter-modal, .new-calc-modal"
        );
        let isClickOnButton = event.target.closest(".filtr-butt, .calc-butt");

        if (
          modal.classList.contains("active") &&
          !isClickInsideContent &&
          isClickInsideModal &&
          !isClickOnButton
        ) {
          modal.classList.remove("active");
        }
      });
  });

  var topmoreButton = document.querySelector(".top-offers-more");
  var topulElement = document.querySelector(".top-offers-wrapper ul");

  if (topmoreButton && topulElement) {
    topmoreButton.addEventListener("click", function () {
      topulElement.classList.add("active");
      topmoreButton.classList.add("hide");
    });
  }

  // Первый блок
  const moreButton = document.querySelector(".page__heading-description-more");
  const descriptionEl = document.querySelector(".page__heading-description");

  if (moreButton && descriptionEl) {
    moreButton.addEventListener("click", () => {
      const isActive = descriptionEl.classList.toggle("active");
      moreButton.textContent = isActive ? "Свернуть" : "Развернуть";
    });
  }

  // Второй блок
  const moreButtonff = document.querySelector(".type-desc-more");
  const descriptionElff = document.querySelector(".type-desc");

  // Здесь исправлено условие на проверку именно ff-переменных
  if (moreButtonff && descriptionElff) {
    moreButtonff.addEventListener("click", () => {
      const isActive = descriptionElff.classList.toggle("active");
      moreButtonff.textContent = isActive ? "Свернуть" : "Раскрыть";
    });
  }

  const openAdCommentForm = document.getElementById(
    "openAdditionalCommentForm"
  );

  const adCommentForm = document.getElementById("additional-comment-form");

  openAdCommentForm.addEventListener("click", () => {
    adCommentForm.classList.add("active");
  });

  const openCommentForm = document.getElementById("openCommentForm");

  const commentForm = document.getElementById("commentForm");

  openCommentForm.addEventListener("click", () => {
    commentForm.classList.add("active");
  });
});

document.addEventListener("DOMContentLoaded", () => {
  // Получаем контейнер скролла
  // const scrollContainer = document.querySelector(
  //   ".best-offers-scroll-container"
  // );

  // // Обработчик для кнопки "horiz-next": прокручиваем вправо (scrollLeft увеличивается)
  // document.querySelector(".offers-horiz-next").addEventListener("click", () => {
  //   scrollContainer.scrollBy({
  //     left: 300,
  //     behavior: "smooth",
  //   });
  // });

  // // Обработчик для кнопки "horiz-prew": прокручиваем влево (scrollLeft уменьшается)
  // document.querySelector(".offers-horiz-prew").addEventListener("click", () => {
  //   scrollContainer.scrollBy({
  //     left: -300,
  //     behavior: "smooth",
  //   });
  // });

  // Получаем контейнер скролла
  const scrollContainer2 = document.querySelector(".reviews-scroll-container");

  // Обработчик для кнопки "horiz-next": прокручиваем вправо (scrollLeft увеличивается)
  document
    .querySelector(".reviews-horiz-next")
    .addEventListener("click", () => {
      scrollContainer2.scrollBy({
        left: 400,
        behavior: "smooth",
      });
    });

  // Обработчик для кнопки "horiz-prew": прокручиваем влево (scrollLeft уменьшается)
  document
    .querySelector(".reviews-horiz-prew")
    .addEventListener("click", () => {
      scrollContainer2.scrollBy({
        left: -400,
        behavior: "smooth",
      });
    });

  const wrapper = document.querySelector(".tags-list_wrapper");

  // При клике на кнопку "предыдущий" прокручиваем влево на 200px
  document
    .querySelector(".tags-list_prev")
    .addEventListener("click", function () {
      wrapper.scrollBy({
        left: -200,
        behavior: "smooth",
      });
    });

  // При клике на кнопку "следующий" прокручиваем вправо на 200px
  document
    .querySelector(".tags-list_next")
    .addEventListener("click", function () {
      wrapper.scrollBy({
        left: 200,
        behavior: "smooth",
      });
    });
});

jQuery(function ($) {
  const $slider = $(".best-offers-slider");
  if (!$slider.length) return;

  $slider.slick({
    infinite: true, // бесконечная прокрутка
    slidesToShow: 4, // кол-во видимых карточек
    slidesToScroll: 1, // кол-во прокручиваемых за раз
    arrows: true, // покажем стрелки
    prevArrow: $(".offers-horiz-prew"),
    nextArrow: $(".offers-horiz-next"),
    responsive: [
      {
        breakpoint: 1200,
        settings: { slidesToShow: 3 },
      },
      {
        breakpoint: 768,
        settings: { slidesToShow: 2 },
      },
      {
        breakpoint: 480,
        settings: { slidesToShow: 1 },
      },
    ],
  });

  // слушаем именно кнопку "Подобрать" в вашем попапе калькулятора
  $(".new-calc-modal .c-footer .btn.btn-primary").on("click", function (e) {
    e.preventDefault();

    // // 1) Считываем значения из калькулятора
    // var limit = $('#calc input[data-field="limit"]').val();
    // var period = $('#calc input[data-field="date"]').val();

    // // 2) Находим форму фильтрации
    // var form = $("#credit-card-filter");
    // // определяем, что у нас за термин (чтобы понять, какие имена полей ставить)
    // var term = form.find('[name="term"]').val();
    // // для кредитных карт — cred_limit / cred_day_period
    // // для займов (term=="zaimy")  — z_sum / z_time
    // var nameLimit = term === "zaimy" ? "z_sum" : "cred_limit";
    // var namePeriod = term === "zaimy" ? "z_time" : "cred_day_period";

    // // 3) Если скрытых полей ещё нет — создаём их
    // if (!form.find('[name="' + nameLimit + '"]').length) {
    //   form.append('<input type="hidden" name="' + nameLimit + '" />');
    // }
    // if (!form.find('[name="' + namePeriod + '"]').length) {
    //   form.append('<input type="hidden" name="' + namePeriod + '" />');
    // }
    // // 4) Кладём туда значения
    // form.find('[name="' + nameLimit + '"]').val(limit);
    // form.find('[name="' + namePeriod + '"]').val(period);

    // 5) Скрываем попап
    $(".new-calc-modal").removeClass("active");

    // 6) Триггерим клик на существующую кнопку фильтра (она же вызывает filter_main_start)
    //form.find(".submit-button").trigger("click");
  });

  var itemsPerPage = 20; // Количество элементов, которые показываются за раз
  var totalItems = $(".list_posts .card").length; // Общее количество элементов
  var shownItems = itemsPerPage; // Сколько элементов показываем (начиная с 20)

  // Скрываем все элементы, кроме первых 20
  $(".list_posts .card").slice(itemsPerPage).hide();

  // Показываем кнопку, если есть еще элементы для загрузки
  if (shownItems < totalItems) {
    $(".load-daha").show();
  }

  // Обработчик клика по кнопке
  $(".load-daha").on("click", function () {
    // Показать следующие 20 элементов
    $(".list_posts .card")
      .slice(shownItems, shownItems + itemsPerPage)
      .fadeIn();

    // Обновить количество отображаемых элементов
    shownItems += itemsPerPage;

    // Если все элементы показаны, скрыть кнопку
    if (shownItems >= totalItems) {
      $(this).hide();
    }
  });

  // Функция для установки режима отображения
  function setLayout(layout) {
    const listPosts = $(".list_posts");

    // Проверяем, какой режим активирован
    if (layout === "horisont") {
      $(".horisont-butt").addClass("active");
      $(".cards-butt").removeClass("active");
      listPosts.addClass("horisont").removeClass("cards");

      // Убираем ограничение символов при горизонтальном режиме
      $(".archive__card .font-weight-semibold").each(function () {
        var text = $(this).text(); // Получаем исходный текст
        $(this).text(text); // Восстанавливаем весь текст
      });
    } else if (layout === "cards") {
      $(".cards-butt").addClass("active");
      $(".horisont-butt").removeClass("active");
      listPosts.addClass("cards").removeClass("horisont");

      // Применяем ограничение по символам для карточного режима
      $(".archive__card .font-weight-semibold").each(function () {
        var text = $(this).text().trim(); // Получаем текст элемента и удаляем лишние пробелы

        // Если текст длиннее 10 символов, обрезаем его
        if (text.length > 10) {
          text = text.substring(0, 10) + "..."; // Обрезаем и добавляем многоточие
          $(this).text(text); // Обновляем текст в элементе
        }
      });
    }
  }

  // При загрузке страницы проверяем сохранённый режим
  var savedLayout = localStorage.getItem("layout");
  if (savedLayout) {
    setLayout(savedLayout);
  }

  // Обработчик для кнопки с классом horisont-butt
  $(".horisont-butt").on("click", function () {
    setLayout("horisont");
    localStorage.setItem("layout", "horisont");
  });

  // Обработчик для кнопки с классом cards-butt
  $(".cards-butt").on("click", function () {
    setLayout("cards");
    localStorage.setItem("layout", "cards");
  });
});
