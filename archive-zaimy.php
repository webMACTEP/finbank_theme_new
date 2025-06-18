<?php
// Инициализация переменной $query__card
$query__card = get_field('archive') ? '' : 'query__card';

// Получение поля 'apply_now_select_products'
$apply_now = get_field('apply_now_select_products', get_the_ID());

// Инициализация пагинации
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Аргументы для WP_Query
// $items_args = array(
//     'paged' => $paged,
//     'orderby' => 'name',
//     'order' => 'DESC',
//     'post_type' => 'zaimy',
//     'posts_per_page' => 20,
//     'post_status' => 'publish',
//     'post_parent' => 0, // Только родительские записи
//     'meta_query' => array(
//         array(
//             'key' => 'archive',
//             'value' => '0',
//             'compare' => '=', // Рекомендуется явно указать оператор сравнения
//         )
//     )
// );

$items_args = array(
    'paged' => $paged,
    'post_type' => 'zaimy',
    'posts_per_page' => 20,
    'post_status' => 'publish',
    'post_parent' => 0, // Только родительские записи
    'orderby' => 'meta_value', // Сортировка по мета-полю
    'order' => 'DESC', // Сначала выводим те записи, у которых есть card_bank_link
    'meta_query' => array(
        'relation' => 'AND', // Для объединения условий
        array(
            'key' => 'archive',
            'value' => '0',
            'compare' => '=', // Условие для поля archive
        ),
        array(
            'key' => 'card_bank_link', // Ключ мета-поля
            'value' => '', // Пропускаем пустые значения
            'compare' => '!=', // Значение не должно быть пустым
        ),
    ),
);




// Создание нового запроса
$query_items = new WP_Query($items_args);

// Проверка наличия постов
if (!$query_items->have_posts()) {
    global $wp_query;
    $url_clear = get_clear_url($_SERVER['REQUEST_URI']);
    wp_redirect($url_clear, 301);
    exit; // Всегда используйте exit после wp_redirect
}

// Продолжение выполнения, если посты найдены
?>

<?php if ($_REQUEST['change_template']) {
    get_template_part('template-parts/new-collection-kredity');
} else { ?>

    <?php get_header(); ?>

    <?php
    // Инициализация переменных
    $z_sum = 0;
    $z_time = 0;

    if (isset($_SESSION['filter_zaimy']) && !empty($_SESSION['filter_zaimy'])) {
        $mt = 1;
        $z_sum = sanitize_text_field($_SESSION['filter_zaimy'][0]);
        $z_time = sanitize_text_field($_SESSION['filter_zaimy'][1]);
    }
    unset($_SESSION['filter_zaimy']);
    ?>

    <?php if (isset($mt) && $mt): ?>
        <div class="start-func-credit-card-filter"></div>
    <?php endif; ?>

    <main class="newlisting zaimy-new" term="zaimy">

        <!-- Bread crumbs -->
        <div class="container">
            <nav aria-label="breadcrumb" class="horizontal__scroll">
                <ol class="breadcrumb horizontal__scroll-container">
                    <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>

                </ol>
            </nav>
        </div>
        <!-- /Bread crumbs -->

        <!-- title & description -->
        <div class="page__heading">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="page__heading-title">Займы</h1>
                </div>

                <?php
                $type_desc_top = get_field('zaimy_desc_top', 'options');
                if ($type_desc_top) :
                ?>
                    <!-- description -->
                    <div class="row flex-end">
                        <div class="page__heading-description col-lg-8 col-sm-12 mt-2">
                            <?php echo $type_desc_top; ?>
                        </div>
                        <div class="page__heading-description-more col-lg-2 col-sm-12 mt-2">Развернуть</div>
                    </div>
                    <!-- /description -->
                <?php
                endif;
                ?>

            </div>

        </div>
        <!-- /title & description -->

        <!-- page navigation -->
        <div class="page__nav">
            <div class="container">
                <!-- top tab -->
                <div class="page__nav-container ">
                    <div class="horizontal__scroll">
                        <div class="horizontal__scroll-container-top">


                            <a href="#top" class="nav-link-top">Сравнение</a>
                            <a href="#popular" class="nav-link-top">Подборки</a>
                            <a href="#reviews" class="nav-link-top">Отзывы</a>
                            <a href="#faq" class="nav-link-top">FAQ</a>
                            <a href="#comments" class="nav-link-top">Комментарии</a>
                            <a href="#news" class="nav-link-top">Новости и статьи</a>
                        </div>
                    </div>
                </div>
                <!-- / top tab -->

                <!-- filter popup -->
                <div class="new-filter-modal">
                    <div class="new-filter-modal-content">
                        <div class="new-filter-modal-close">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 1L1 9M1 1L9 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <form id="credit-card-filter" action="" method="POST">
                            <input type="hidden" name="action" value="cardfilter" />
                            <input type="hidden" name="term" value="zaimy" />

                            <h2>Все фильтры</h2>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-1">
                                    <div class="range">
                                        <div class="d-flex justify-content-between">
                                            <div class="range__label">Сумма, ₽</div>
                                            <input type="text" class="range__value cred_limit" max="<?php echo esc_attr($filter_price['zaimy_inputs_range']['max']); ?>" value="<?php echo esc_attr($z_sum); ?>">
                                        </div>
                                        <input class="range__input" name="z_sum" type="range" max="<?php echo esc_attr($filter_price['zaimy_inputs_range']['max']); ?>" value="<?php echo esc_attr($z_sum); ?>">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-2 ortamrg">
                                    <div class="range">
                                        <div class="d-flex justify-content-between">
                                            <div class="range__label">Срок, дней</div>
                                            <input type="text" class="range__value cred_trat" max="<?php echo esc_attr($filter_price['zaimy_inputs_range']['day_max']); ?>" value="<?php echo esc_attr($z_time); ?>">
                                        </div>
                                        <input class="range__input" name="z_time" type="range" max="<?php echo esc_attr($filter_price['zaimy_inputs_range']['day_max']); ?>" value="<?php echo esc_attr($z_time); ?>">
                                    </div>
                                </div>

                                <div id="filter__details" class="col-12 mt-md-4 order-4 order-md-5">
                                    <div class="row pb-3 pb-md-0">

                                        <div class="col-12 col-md-4 zct_select">
                                            <label class="form-label" for="zct">Способ получения</label>
                                            <select name="zct" id="zct" class="styledSelect" placeholder="">
                                                <option value="">Любой</option>
                                                <option value="zct1">На карту</option>
                                                <option value="zct2">Наличными</option>
                                                <option value="zct3">Юмани</option>
                                                <option value="zct4">Золотая корона</option>
                                                <option value="zct5">Банковский счет</option>


                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4 oz_select">
                                            <label class="form-label" for="oz">Компания</label>
                                            <select name="oz" id="oz" class="styledSelect" placeholder="">
                                                <option value="">Любая</option>
                                                <option value="oz1">Турбозайм</option>
                                                <option value="oz2">Займер</option>
                                                <option value="oz3">E-капуста</option>
                                                <option value="oz4">MoneyMan</option>
                                                <option value="oz5">Деньга</option>
                                                <option value="oz6">Веб-займ</option>
                                                <option value="oz7">Zaymigo</option>
                                                <option value="oz8">WEBBANKIR</option>
                                                <option value="oz9">СМСФинанс</option>
                                                <option value="oz10">Срочноденьги</option>
                                                <option value="oz11">Platiza</option>
                                                <option value="oz12">Pay P S</option>
                                                <option value="oz13">Отличные наличные</option>
                                                <option value="oz14">OneClickMoney</option>
                                                <option value="oz15">МИГКРЕДИТ</option>
                                                <option value="oz16">Лови займ</option>
                                                <option value="oz17">Лига денег</option>
                                                <option value="oz18">Кредито24</option>
                                                <option value="oz19">CreditPlus</option>
                                                <option value="oz20">Конга</option>
                                                <option value="oz21">GreenMoney</option>
                                                <option value="oz22">ГлавФинанс</option>
                                                <option value="oz23">Ezaem</option>
                                                <option value="oz24">JoyMoney</option>
                                                <option value="oz25">До зарплаты</option>
                                                <option value="oz26">Деньги Сразу</option>
                                                <option value="oz27">Честное слово</option>
                                                <option value="oz28">Быстроденьги</option>
                                                <option value="oz30">Умные наличные</option>
                                                <option value="oz31">Свои Люди</option>
                                                <option value="oz32">Привет, сосед!</option>
                                                <option value="oz33">Небус</option>
                                                <option value="oz34">Надо денег</option>
                                                <option value="oz35">Moneza</option>
                                                <option value="oz36">Мир денег</option>
                                                <option value="oz37">MFOБанк</option>
                                                <option value="oz38">Max.Credit</option>
                                                <option value="oz39">Lime</option>
                                                <option value="oz40">Кнопка Деньги</option>
                                                <option value="oz41">Финтерра</option>
                                                <option value="oz42">Финансовая Розница</option>
                                                <option value="oz43">FastMoney</option>
                                                <option value="oz44">ДоброЗайм</option>
                                                <option value="oz45">Creditter</option>
                                                <option value="oz46">Credit7</option>
                                                <option value="oz47">Целевые финансы</option>
                                                <option value="oz48">Cashtoyou</option>
                                                <option value="oz49">CarMoney</option>
                                                <option value="oz50">Boostra</option>
                                                <option value="oz51">БериБеру</option>
                                                <option value="oz52">Белка Кредит</option>
                                                <option value="oz53">АЛИЗАЙМ</option>
                                                <option value="oz54">А Деньги</option>
                                                <option value="oz55">495 кредит</option>
                                                <option value="oz56">Viva Деньги</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-4 zos_select">
                                            <label class="form-label" for="zos">Прочие условия</label>
                                            <select name="zos" id="zos" class="styledSelect" placeholder="">
                                                <option value="">Любой</option>
                                                <option value="zos1">Под 0% первый займ</option>
                                                <option value="zos2">Моментальное решение</option>
                                                <option value="zos3">Без справок о доходах</option>
                                                <option value="zos4">С 18 лет</option>
                                                <option value="zos5">С любой КИ</option>
                                                <option value="zos6">Под залог ПТС</option>
                                            </select>
                                        </div>



                                    </div>
                                </div>

                                <div class="new-filter-modal-show col-12 col-md-6 col-lg-3 col-xl-2 mt-4 order-5 order-md-5">
                                    <div class="btn btn-primary btn-block submit-button" onclick="ym(35020350,'reachGoal','filtr_listing');">Показать</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- / filter popup -->

                <!-- calc popup -->
                <div class="new-calc-modal">
                    <div class="new-calc-content">
                        <div class="new-calc-close">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 1L1 9M1 1L9 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <h2>Калькулятор займов</h2>
                        <!-- Блок калькулятора -->
                        <form id="calc-credit-card-filter" action="" method="POST">
                            <input type="hidden" name="action" value="cardfilter" />
                            <input type="hidden" name="term" value="zaimy" />

                            <div class="calc__content" id="calc" data-type="loanCalc">

                                <div class="calc-row mt-5">


                                    <div class="c-row">
                                        <div class="c-col-1">

                                            <div class="calc__field">
                                                <div class="calc__field-wrap">
                                                    <div class="calc__field-label">Сумма займа</div>
                                                    <input type="text" class="range__value form-control calc__input" value="1000" min="1000" max="<?php echo esc_attr($filter_price['zaimy_inputs_range']['max']); ?>" data-field="limit">
                                                    <input class="range__input calc__input" name="clc_z_sum" type="range" min="1000" max="<?php echo esc_attr($filter_price['zaimy_inputs_range']['max']); ?>" value="<?php echo esc_attr($z_sum); ?>" data-field="limit" style="--range-progress:10%;">
                                                </div>
                                            </div>
                                            <div class="calc__field d-flex">
                                                <div class="calc__field-wrap mt-3 mt-md-4 flex-grow-1">
                                                    <div class="calc__field-label">Срок / дней</div>
                                                    <input type="text" class="range__value form-control calc__input" value="14" min="1" max="1095" data-field="date">
                                                    <input class="range__input calc__input" name="calc_z_time" type="range" min="1" max="1095" value="14" data-field="date" style="--range-progress:23.0769%;">
                                                </div>
                                                <div class="calc__field-wrap calc__field-min mt-3 mt-md-4 ml-3">
                                                    <div class="calc__field-label">Ставка</div>
                                                    <input type="text" class="range__value form-control calc__input" value="0.5%" maxlength="6" data-field="percent" pattern="[0-9]*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-col-2">
                                            <div class="calc-result-wrapp">

                                                <div class="calc__total">
                                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                                        <div class="calc__total-label">Сумма кредита</div>
                                                        <div class="calc__value">
                                                            <span id="calc__sum" class="calc__value-text">10 000</span>
                                                            <span class="calc__value-char">₽</span>
                                                        </div>
                                                    </div>
                                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                                        <div class="calc__total-label">Переплата</div>
                                                        <div class="calc__total-value">
                                                            <span id="calc__overpay" class="calc__value-text">70 031</span>
                                                            <span class="calc__value-char">₽</span>
                                                        </div>
                                                    </div>
                                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                                        <div class="calc__total-label">Общая сумма выплат</div>
                                                        <div class="calc__total-value">
                                                            <span id="calc__total" class="calc__value-text">1 070 031</span>
                                                            <span class="calc__value-char">₽</span>
                                                        </div>
                                                    </div>
                                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                                        <div class="calc__total-label">Полная стоимость займа</div>
                                                        <div class="calc__total-value">
                                                            <span id="calc__psk" class="calc__value-text">182.5</span>
                                                            <span class="calc__value-char">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div id="calc__progress" class="progress">
                                        <div class="progress__circle" style="--graph-warning: 10%; --graph-danger: 5%;">
                                            <div class="progress__text">
                                                <span class="progress__percent">75</span>%
                                            </div>
                                        </div>
                                        <div class="progress__description">По нашим подсчетам, расчитанный кредит на <span class="progress__percent">75</span>% выгоден</div>
                                    </div> -->
                                        <div id="calc__progress" class="progress">

                                            <div class="benefit">
                                                <div class="b-lines">
                                                    <div class="b-line active"></div>
                                                    <div class="b-line active"></div>
                                                    <div class="b-line active"></div>
                                                    <div class="b-line active"></div>
                                                    <div class="b-line active"></div>
                                                    <div class="b-line active"></div>
                                                    <div class="b-line active"></div>
                                                    <div class="b-line"></div>
                                                    <div class="b-line"></div>
                                                    <div class="b-line"></div>
                                                </div>
                                                <div class="progress__circle d-none" style="--graph-warning: 10%; --graph-danger: 5%;">
                                                    <div class="progress__text">
                                                        <span class="progress__percent">75</span>%
                                                    </div>
                                                </div>
                                                <div class="progress__description">По нашим подсчетам, расчитанный кредит на <span class="progress__percent">75</span><span>%</span> выгоден</div>
                                            </div>
                                        </div>


                                    </div>

                                </div>

                                <div class="c-line"></div>
                                <div class="c-footer">
                                    <div class="btn btn-primary submit-button">Подобрать</div>
                                    <div class="new-calc-btn-close btn">Закрыть</div>
                                </div>

                            </div>
                        </form>


                    </div>

                </div>
                <!-- / calc popup -->

            </div>
        </div>
        <!-- / page navigation -->
        <!-- tags -->
        <div class="container">
            <div class="tags-list mb-4">
                <div class="tags-list_prev"><svg width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.5 1.5L2.84722 3.07258C1.52915 4.32668 0.870122 4.95373 0.768647 5.718C0.743785 5.90526 0.743785 6.09474 0.768647 6.282C0.870121 7.04627 1.52915 7.67332 2.84722 8.92742L4.5 10.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="tags-list_wrapper">
                    <?php
                    $args = [
                        'post_type' => 'collection', // Укажите ваш тип записи
                        'tax_query' => [
                            [
                                'taxonomy' => 'tags-category', // Укажите вашу таксономию
                                'field'    => 'id',
                                'terms'    => 76, // ID категории
                            ],
                        ],
                        'posts_per_page' => -1, // Получаем все записи
                    ];
                    $query = new WP_Query($args);

                    // Проверяем, есть ли записи
                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                    ?>
                            <a class="nav-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <?php
                        endwhile;
                        wp_reset_postdata(); // Сбрасываем данные запроса
                    else :
                        ?>
                        <p>Нет записей в этой категории.</p>
                    <?php endif; ?>
                </div>
                <div class="tags-list_next"><svg width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 1.5L3.15278 3.07258C4.47085 4.32668 5.12988 4.95373 5.23135 5.718C5.25622 5.90526 5.25622 6.09474 5.23135 6.282C5.12988 7.04627 4.47085 7.67332 3.15278 8.92742L1.5 10.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        </div>
        <!-- / tags -->

        <div class="container">
            <!-- credits list -->
            <div class="credits section">
                <div class="row">

                    <?php
                    // Инициализация счетчика
                    $counter = 0;

                    // Проверяем, есть ли посты в запросе
                    if ($query_items->have_posts()) {
                        // Используем существующий объект запроса
                        $query = $query_items;
                        $max_pages   = $query->max_num_pages;
                        $found_posts = $query->found_posts;

                        // Начинаем буферизацию вывода
                        ob_start();

                        // Проходим по всем постам в запросе
                        while ($query->have_posts()) {
                            $query->the_post();
                            $counter++;
                            // Подключаем шаблон для каждого поста
                            get_template_part('template-parts/filter-zaimy-posts');
                        }

                        // Получаем содержимое буфера и очищаем его
                        $posts_html = ob_get_clean();

                        // Сбрасываем глобальные данные поста
                        wp_reset_postdata();
                    } else {
                        // Сообщение, если посты не найдены
                        $posts_html = '<p>Ничего не найдено по заданным фильтрам.</p>';
                    }

                    // Выводим HTML контент
                    ?>
                    <!-- list -->
                    <div class="col-12 col-lg-12 order-lg-1">
                        <div class="credits__list">
                            <div class="d-flex flex-wrap justify-content-between align-items-center credits__list-header">
                                <div class="credits__list-buttons d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="mt-5 mb-4 mt-md-0 mb-md-0 variants_count-container"><span class="variants_count"><?php echo $query->found_posts; ?></span> варианта</div>
                                    <div class="filtr-butt">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.25 3L10.25 3M10.25 3C10.25 4.24264 11.2574 5.25 12.5 5.25C13.7426 5.25 14.75 4.24264 14.75 3C14.75 1.75736 13.7426 0.75 12.5 0.75C11.2574 0.75 10.25 1.75736 10.25 3ZM5.75 9L14.75 9M5.75 9C5.75 10.2426 4.74264 11.25 3.5 11.25C2.25736 11.25 1.25 10.2426 1.25 9C1.25 7.75736 2.25736 6.75 3.5 6.75C4.74264 6.75 5.75 7.75736 5.75 9Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Фильтр
                                    </div>
                                    <div class="calc-butt">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.25 0.75L0.75 11.25M3.75 2.25C3.75 3.07843 3.07843 3.75 2.25 3.75C1.42157 3.75 0.75 3.07843 0.75 2.25C0.75 1.42157 1.42157 0.75 2.25 0.75C3.07843 0.75 3.75 1.42157 3.75 2.25ZM11.25 9.75C11.25 10.5784 10.5784 11.25 9.75 11.25C8.92157 11.25 8.25 10.5784 8.25 9.75C8.25 8.92157 8.92157 8.25 9.75 8.25C10.5784 8.25 11.25 8.92157 11.25 9.75Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Калькулятор
                                    </div>
                                </div>
                                <div class="credits__list-right">
                                    <div class="variants_count-container-mob"><span class="variants_count"><?php echo $query->found_posts; ?></span> варианта</div>

                                    <div class="credits__list-dropdown dropdown px-0">
                                        <select name="order" class="styledSelect cred-order-select">
                                            <option value="" selected disabled>Сортировать</option>
                                            <option value="">Сбросить сортировку</option>
                                            <option value="ratings_average">По рейтингу</option>
                                            <option value="views">По количеству заявок</option>
                                            <option value="z_sum">По сумме займа</option>
                                            <option value="z_time">По сроку</option>
                                            <option value="z_stavka">По процентной ставке</option>
                                        </select>

                                    </div>

                                    <div class="views-buttons">
                                        <div class="horisont-butt active">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8 8C16.9201 8 17.4802 8 17.908 7.78201C18.2843 7.59027 18.5903 7.28431 18.782 6.90798C19 6.48016 19 5.92011 19 4.8V4.2C19 3.0799 19 2.51984 18.782 2.09202C18.5903 1.7157 18.2843 1.40973 17.908 1.21799C17.4802 1 16.9201 1 15.8 1L4.2 1C3.0799 1 2.51984 1 2.09202 1.21799C1.71569 1.40973 1.40973 1.71569 1.21799 2.09202C1 2.51984 1 3.07989 1 4.2L1 4.8C1 5.9201 1 6.48016 1.21799 6.90798C1.40973 7.28431 1.71569 7.59027 2.09202 7.78201C2.51984 8 3.07989 8 4.2 8L15.8 8Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M15.8 19C16.9201 19 17.4802 19 17.908 18.782C18.2843 18.5903 18.5903 18.2843 18.782 17.908C19 17.4802 19 16.9201 19 15.8V15.2C19 14.0799 19 13.5198 18.782 13.092C18.5903 12.7157 18.2843 12.4097 17.908 12.218C17.4802 12 16.9201 12 15.8 12L4.2 12C3.0799 12 2.51984 12 2.09202 12.218C1.71569 12.4097 1.40973 12.7157 1.21799 13.092C1 13.5198 1 14.0799 1 15.2L1 15.8C1 16.9201 1 17.4802 1.21799 17.908C1.40973 18.2843 1.71569 18.5903 2.09202 18.782C2.51984 19 3.07989 19 4.2 19H15.8Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>

                                        </div>
                                        <div class="cards-butt">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.4 1H2.6C2.03995 1 1.75992 1 1.54601 1.10899C1.35785 1.20487 1.20487 1.35785 1.10899 1.54601C1 1.75992 1 2.03995 1 2.6V6.4C1 6.96005 1 7.24008 1.10899 7.45399C1.20487 7.64215 1.35785 7.79513 1.54601 7.89101C1.75992 8 2.03995 8 2.6 8H6.4C6.96005 8 7.24008 8 7.45399 7.89101C7.64215 7.79513 7.79513 7.64215 7.89101 7.45399C8 7.24008 8 6.96005 8 6.4V2.6C8 2.03995 8 1.75992 7.89101 1.54601C7.79513 1.35785 7.64215 1.20487 7.45399 1.10899C7.24008 1 6.96005 1 6.4 1Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M17.4 1H13.6C13.0399 1 12.7599 1 12.546 1.10899C12.3578 1.20487 12.2049 1.35785 12.109 1.54601C12 1.75992 12 2.03995 12 2.6V6.4C12 6.96005 12 7.24008 12.109 7.45399C12.2049 7.64215 12.3578 7.79513 12.546 7.89101C12.7599 8 13.0399 8 13.6 8H17.4C17.9601 8 18.2401 8 18.454 7.89101C18.6422 7.79513 18.7951 7.64215 18.891 7.45399C19 7.24008 19 6.96005 19 6.4V2.6C19 2.03995 19 1.75992 18.891 1.54601C18.7951 1.35785 18.6422 1.20487 18.454 1.10899C18.2401 1 17.9601 1 17.4 1Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M17.4 12H13.6C13.0399 12 12.7599 12 12.546 12.109C12.3578 12.2049 12.2049 12.3578 12.109 12.546C12 12.7599 12 13.0399 12 13.6V17.4C12 17.9601 12 18.2401 12.109 18.454C12.2049 18.6422 12.3578 18.7951 12.546 18.891C12.7599 19 13.0399 19 13.6 19H17.4C17.9601 19 18.2401 19 18.454 18.891C18.6422 18.7951 18.7951 18.6422 18.891 18.454C19 18.2401 19 17.9601 19 17.4V13.6C19 13.0399 19 12.7599 18.891 12.546C18.7951 12.3578 18.6422 12.2049 18.454 12.109C18.2401 12 17.9601 12 17.4 12Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6.4 12H2.6C2.03995 12 1.75992 12 1.54601 12.109C1.35785 12.2049 1.20487 12.3578 1.10899 12.546C1 12.7599 1 13.0399 1 13.6V17.4C1 17.9601 1 18.2401 1.10899 18.454C1.20487 18.6422 1.35785 18.7951 1.54601 18.891C1.75992 19 2.03995 19 2.6 19H6.4C6.96005 19 7.24008 19 7.45399 18.891C7.64215 18.7951 7.79513 18.6422 7.89101 18.454C8 18.2401 8 17.9601 8 17.4V13.6C8 13.0399 8 12.7599 7.89101 12.546C7.79513 12.3578 7.64215 12.2049 7.45399 12.109C7.24008 12 6.96005 12 6.4 12Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div data-json='<?= json_encode($args); ?>' class="list_posts list_posts-horisontal" id="response-cred-card">
                                <?
                                echo $posts_html;
                                ?>
                            </div>
                            <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
                            wp_reset_query(); ?>

                            <div class="pagination flex-column mb-3">
                                <?php if ($paged < $max_pages): ?>
                                    <button
                                        class="btn btn-outline-gray btn-block load_more_btn"
                                        data-max_pages="<?= $max_pages ?>"
                                        data-paged="<?= $paged ?>"
                                        data-posts_per_page="<?= $ppp ?>">
                                        Больше решений
                                    </button>

                                <?php endif; ?>

                            </div>


                            

                        </div>
                    </div>
                    <!-- / list -->

                    <!-- / pagination -->


                </div>
                <div class="section">
                    <div class="list-info">
                        <?php $date_actually = get_the_modified_date('d.m.Y', $ID); ?>
                        <?php if ($date_actually): ?>
                            <p>Дата обновления информации: <?= $date_actually ?></p>
                        <?php endif; ?>
                        <p>Наиболее актуальные условия и тарифы мы рекомендуем узнавать на официальном сайте банков и в отделениях</p>
                    </div>
                </div>
            </div>
            <?php wp_reset_query(); ?>
            <!-- / credits list -->



            <!-- best offers month -->
            <div class="section" id="best-products">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Предложения месяца</h2>

                </div>
                <div class="best-offers-scroll horizontal__scroll row">
                    <div class="horiz-prew offers-horiz-prew">
                        <svg width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 1L3.79629 3.09677C2.03887 4.7689 1.16016 5.60497 1.02486 6.624C0.991713 6.87367 0.991713 7.12633 1.02486 7.376C1.16016 8.39503 2.03887 9.2311 3.79629 10.9032L6 13" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
                        </svg>

                    </div>
                    <div class="horiz-next offers-horiz-next">
                        <svg width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L3.20371 3.09677C4.96113 4.7689 5.83984 5.60497 5.97514 6.624C6.00829 6.87367 6.00829 7.12633 5.97514 7.376C5.83984 8.39503 4.96113 9.2311 3.20371 10.9032L1 13" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
                        </svg>

                    </div>
                    <div class="best-offers-slider horizontal__scroll-container best-offers-scroll-container">
                        <?php



                        $args = array(
                            'post_type'             => 'zaimy',
                            'posts_per_page'        => 10,
                            'meta_key' => 'ratings_average',
                            'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                            'order' => 'DESC',
                            'meta_query'     => array(
                                array(
                                    'key'     => 'card_bank_link',
                                    'value'   => '',
                                    'compare' => '!=',  // выбираем только те записи, у которых в postmeta card_bank_link не пустая строка
                                ),
                            ),

                        );

                        $query = new WP_Query($args);

                        // Цикл
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();

                        ?>
                                <!-- item -->
                                <div class="main-page card card__vertical size4 offer h-100">
                                    <div class="card-container p-3">
                                        <div class="card__header mb-2 d-flex">
                                            <div class="card__header-img">
                                                <img src="<?= esc_url(get_field('card_logo')); ?>"
                                                    alt="<?= esc_attr($logo_alt); ?>">
                                            </div>
                                            <div class="card__header-title"><a href="<?php echo the_permalink() ?>">
                                                    <?php
                                                    $alter_title1 = get_field('alter_title');

                                                    if ($alter_title1) {
                                                        echo $alter_title1;
                                                    } else {
                                                        echo get_the_title();
                                                    }
                                                    ?>

                                                </a></div>
                                        </div>



                                        <ul class="leaders">
                                            <div class="bank__item-footer text-center  pb-2 mt-2">
                                                <li class="leaders__item mb-1">
                                                    <div class="leaders__item-title">Сумма:</div>
                                                    <div class="leaders__item-value"><?= number_format((get_field('z_sum')), 0, '.', ' '); ?> ₽</div>
                                                </li>
                                                <li class="leaders__item mb-1">
                                                    <div class="leaders__item-title">Срок:</div>
                                                    <div class="leaders__item-value">до <?= esc_html((get_field('z_time'))); ?> дней</div>
                                                </li>
                                                <li class="leaders__item mb-1">
                                                    <div class="leaders__item-title">% ставка:</div>
                                                    <div class="leaders__item-value">От <?= esc_html((get_field('z_stavka'))); ?>%</div>
                                                </li>

                                            </div>
                                        </ul>
                                        <div class="card__actions mt-3 d-flex">
                                            <?php
                                            $encoded_link = get_field('card_bank_link');
                                            $card_bank_link = base64_encode($encoded_link);

                                            if ($card_bank_link): ?>
                                                <div class="card__actions-btns">

                                                    <span
                                                        class="link-data btn btn-primary btn-block"
                                                        data-link="<?= esc_attr($card_bank_link); ?>"
                                                        onclick="<?php echo esc_js(get_metrika_for_list($card_bank_link)); ?> return true;">
                                                        Оформить
                                                    </span>
                                                </div>
                                            <?php else: ?>
                                                <div class="card__actions-btns">
                                                    <span data-popap-apply-id="<?php echo esc_attr(get_the_ID()); ?>"
                                                        onclick="<?php echo esc_js(get_metrika_for_list($card_bank_link)); ?> return true;"
                                                        class="apply_now_btm btn btn-primary btn-block">
                                                        Оформить
                                                    </span>
                                                </div>
                                            <?php endif; ?>

                                        </div>

                                    </div>
                                </div>
                                <!-- / item -->
                        <?php
                            }
                        }
                        // Возвращаем оригинальные данные поста. Сбрасываем $post.
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
            <!-- / best offers month -->

            <!-- top offers -->
            <div id="top" class="section anchor">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Сравнение условий ТОП предложений месяца</h2>
                </div>
                <div class="top-offers-wrapper">
                    <div class="top-offers-head">
                        <div class="item">Займ</div>
                        <div class="item">Сумма</div>
                        <div class="item">Срок</div>
                        <div class="item">% ставка</div>
                    </div>
                    <ul>
                        <?php
                        $argstop = array(
                            'post_type'             => 'zaimy',
                            'posts_per_page'        => 10,
                            'meta_key' => 'ratings_average',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'meta_query'     => array(
                                array(
                                    'key'     => 'card_bank_link',
                                    'value'   => '',
                                    'compare' => '!=',  // выбираем только те записи, у которых в postmeta card_bank_link не пустая строка
                                ),
                            ),

                        );

                        $querytop = new WP_Query($argstop);

                        // Цикл
                        if ($querytop->have_posts()) {
                            while ($querytop->have_posts()) {
                                $querytop->the_post();

                        ?>
                                <li>
                                    <div class="card__header-img">
                                        <img src="<?= esc_url(get_field('card_logo')); ?>"
                                            alt="<?= esc_attr($logo_alt); ?>">
                                        <a href="<?php echo the_permalink() ?>">
                                            <?php //echo get_the_title($bank_choise_rel) 
                                            ?>
                                            <?php
                                            $alter_title1 = get_field('alter_title');

                                            if ($alter_title1) {
                                                echo $alter_title1;
                                            } else {
                                                echo get_the_title();
                                            }
                                            ?>
                                        </a>
                                    </div>



                                    <div class="leaders__item-value">
                                        <div class="leaders__item-title">Сумма</div><?= number_format((get_field('z_sum')), 0, '.', ' '); ?> ₽
                                    </div>

                                    <div class="leaders__item-value">
                                        <div class="leaders__item-title">Срок</div>до <?= esc_html((get_field('z_time'))); ?> дней
                                    </div>

                                    <div class="leaders__item-value">
                                        <div class="leaders__item-title">% ставка</div>От <?= esc_html((get_field('z_stavka'))); ?>%
                                    </div>



                                </li>





                        <?php
                            }
                        }
                        // Возвращаем оригинальные данные поста. Сбрасываем $post.
                        wp_reset_postdata();
                        ?>
                    </ul>
                    <div class="btn btn-outline-gray mt-3 top-offers-more">Показать еще</div>
                </div>
            </div>



            <!-- Popular -->
            <div id="popular" class="section anchor">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Популярные категории</h2>
                </div>
                <div class="popular-products">

                    <?php
                    // Меню слева
                    $massiv_vhodnih_parametrov = [
                        'container'      => '',
                        'depth'          => 0,
                        'echo'           => false,
                        'link_class'     => 'filter__btn',
                        'theme_location' => 'sidebar_menu_zaimy',
                        'before'         => '<div class="filter__section" id="collist">',
                        'after'          => '</div>',
                    ];
                    echo strip_tags(wp_nav_menu($massiv_vhodnih_parametrov), '<a>,');
                    ?>

                    <?php
                    // Тут вручную задаёте три группы: в каждую — массив ID категорий
                    $wrappers = [
                        ['cats' => [75]],
                        ['cats' => [76, 74, 80]],
                        ['cats' => [73, 77, 78]],
                    ];

                    $visible_count = 0; // число элементов, показываемых по умолчанию
                    ?>

                    <?php foreach ($wrappers as $wrapper_index => $wrapper) : ?>
                        <div class="popular-products-wrapp">

                            <?php foreach ($wrapper['cats'] as $cat_id) {
                                $cat = get_term($cat_id, 'tags-category');
                                if (! $cat || is_wp_error($cat)) continue;

                                // Подготовка запроса
                                $args_coll = [
                                    'post_type'      => 'collection',
                                    'tax_query'      => [[
                                        'taxonomy' => 'tags-category',
                                        'terms'    => $cat_id,
                                        'field'    => 'id',
                                    ]],
                                    'posts_per_page' => -1,
                                    'orderby'        => 'date',
                                    'order'          => 'DESC',
                                    'meta_query'     => [[
                                        'key'     => 'coll-type',
                                        'value'   => 'zaimy',
                                        'compare' => '=',
                                    ]],
                                ];
                                $query = new WP_Query($args_coll);

                                if (! $query->have_posts()) {
                                    wp_reset_postdata();
                                    continue;
                                }

                                // Выводим блок категории
                            ?>
                                <div class="filter">
                                    <div class="filter-title"><?= esc_html($cat->name); ?></div>
                                    <div class="filter__section" id="collist_<?= $cat_id; ?>">
                                        <?php
                                        $counter_col = 0;
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                            $counter_col++;
                                            // Класс для ссылки
                                            $classes = 'filter__btn';
                                            if ($counter_col > $visible_count) {
                                                $classes .= ' coll_li';
                                                // для НЕ первой группы сразу скрываем
                                                if ($wrapper_index !== 0) {
                                                    $classes .= ' coll__hidden';
                                                }
                                            }
                                            if (isset($current_id) && $current_id == get_the_ID()) {
                                                $classes .= ' active_post';
                                            }
                                        ?>
                                            <a class="<?= $classes; ?>" href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        <?php } // конец цикла постов 
                                        ?>
                                    </div>

                                    <?php if ($counter_col > $visible_count) : ?>
                                        <button class="btn__collmore_cat" data-text-open="" data-text-hide="" data-id="collist_<?= $cat_id; ?>">
                                            <span class="btn__collmore-icon">
                                                <svg width="14" height="7" viewBox="0 0 14 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 1L3.09677 3.20371C4.7689 4.96113 5.60497 5.83984 6.624 5.97514C6.87367 6.00829 7.12633 6.00829 7.376 5.97514C8.39503 5.83984 9.2311 4.96113 10.9032 3.20371L13 1" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" />
                                                </svg>
                                            </span>
                                            <span class="btn__collmore-text"></span>
                                        </button>
                                    <?php endif; ?>

                                </div>
                            <?php
                                wp_reset_postdata();
                            } // конец foreach категорий 
                            ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <!-- / popular -->









            <!-- card reviews -->
            <div id="reviews" class="section anchor">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Отзывы о Займах</h2>
                    <a href="<?php echo  get_page_link(4975); //1503 tax-reviews 
                                ?>" class="btn btn-primary btn-sm btn-all" data-tax="zaimy">
                        Все
                        <span class="icon ml-2">
                            <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="reviews-scroll horizontal__scroll row">
                    <div class="horiz-prew reviews-horiz-prew">
                        <svg width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 1L3.79629 3.09677C2.03887 4.7689 1.16016 5.60497 1.02486 6.624C0.991713 6.87367 0.991713 7.12633 1.02486 7.376C1.16016 8.39503 2.03887 9.2311 3.79629 10.9032L6 13" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"></path>
                        </svg>

                    </div>
                    <div class="horiz-next reviews-horiz-next">
                        <svg width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L3.20371 3.09677C4.96113 4.7689 5.83984 5.60497 5.97514 6.624C6.00829 6.87367 6.00829 7.12633 5.97514 7.376C5.83984 8.39503 4.96113 9.2311 3.20371 10.9032L1 13" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"></path>
                        </svg>

                    </div>
                    <div class="horizontal__scroll-container reviews-scroll-container">
                        <?php
                        $ppp = 10; // Количество отзывов
                        $custom_offset = 0;

                        // Получение всех постов типа 'zaimy'
                        $posts = get_cpt_ids('zaimy'); // Убедитесь, что функция get_cpt_ids() определена

                        global $wpdb; // Необходимо для использования $wpdb
                        $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                                FROM {$wpdb->comments} 
                                WHERE comment_post_ID IN (" . implode(',', array_map('intval', $posts)) . ") 
                                  AND comment_approved = 1 
                                  AND comment_parent = 0
                                ORDER BY comment_date DESC 
                                LIMIT $ppp OFFSET $custom_offset";

                        $comments_list = $wpdb->get_results($sql);

                        get_template_part('all_template/reviews_list', null, ['TYPE' => 'zaimy', 'DATA' => $comments_list]);
                        ?>
                    </div>
                </div>
                <a href="<?php echo  get_page_link(4975); //1503 tax-reviews 
                            ?>" class="btn btn-primary btn-sm btn-all-mob" data-tax="zaimy">
                    Все
                    <span class="icon ml-2">
                        <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <!-- / card reviews -->

            <!-- faq -->
            <?php if (have_rows('zaimy_faq', 'options')): ?>
                <div id="faq" class="section">
                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0">Часто задавемые вопросы</h2>
                    </div>
                    <div class="accordion" id="accordion">
                        <?php $counter = 0; ?>
                        <?php while (have_rows('zaimy_faq', 'options')): the_row();
                            $question = get_sub_field('question');
                            $answer = get_sub_field('answer');
                            $counter += 1;
                        ?>
                            <div class="accordion__item">
                                <div class="accordion__header">
                                    <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse__item-<?php echo $counter ?>" aria-expanded="false">
                                        <?php echo $question ?>
                                        <div class="accordion__button-icon"><svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use>
                                            </svg></div>
                                    </button>
                                </div>
                                <div id="collapse__item-<?php echo $counter ?>" class="accordion__collapse collapse" data-bs-parent="#accordion">
                                    <div class="accordion__body">
                                        <p><?php echo $answer ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- / faq -->

            <!-- news -->
            <div id="news" class="section anchor">
                <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="title mb-0">Новости о займах</h2>
                    <a href="<?php echo get_category_link('47') ?>" class="btn btn-primary btn-sm btn-all">
                        Все
                        <span class="icon ml-2">
                            <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="horizontal__scroll row mb-md-6">
                    <div class="horizontal__scroll-container">
                        <?php
                        $args = array(
                            'post_type' => 'post',
                            'cat' => 47,
                            'posts_per_page' => 4,
                            //    'meta_key' => 'views',
                            //    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
                            //    'order' => 'DESC',
                        );
                        $wp_query = new WP_Query($args);
                        if ($wp_query->have_posts()) {
                            while ($wp_query->have_posts()) {
                                $wp_query->the_post(); ?>
                                <!-- item -->
                                <div class="article__item card card__vertical size4 offer h-100">
                                    <div class="card-container p-3 d-xl-flex flex-xl-column">
                                        <?php if (get_the_post_thumbnail_url()): ?>
                                            <div class="card__image">
                                                <img
                                                    src="<?php echo the_post_thumbnail_url() ?>"
                                                    alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                                        <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                                        <div class="mt-auto">
                                            <div class="d-flex align-items-center mt-2">
                                                <div class="card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use>
                                                        </svg></div>
                                                    <?php echo the_field('views') ?>
                                                </div>
                                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                            </svg></a></div>
                                                    <?php echo comments_number('0', '1', '%'); ?>
                                                </div>
                                                <div class="card__like d-flex align-items-center ml-auto">
                                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                </div>
                                            </div>
                                            <?php $author_id = get_field('page_author');
                                            if ($author_id):
                                            ?>
                                                <div class="card__author d-flex align-items-center mt-3">
                                                    <div class="card__author-img">
                                                        <?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                                    </div>
                                                    <div class="card__author-content">
                                                        <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                                                        <div class="rating d-flex align-items-center">
                                                            <?php echo do_shortcode('[ratings id="' . $author_id . '"]'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- / item -->
                        <?php }
                        } ?>
                        <?php wp_reset_query() ?>
                    </div>
                </div>
                <a href="<?php echo get_category_link('47') ?>" class="btn btn-primary btn-sm btn-all-mob">
                    Все
                    <span class="icon ml-2">
                        <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <!-- / news -->
            <!-- articles -->
            <div id="articles" class="section anchor">
                <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="title mb-0">Статьи о займах</h2>
                    <a href="<?php echo get_category_link('38') ?>" class="btn btn-primary btn-sm btn-all">
                        Все
                        <span class="icon ml-2">
                            <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="horizontal__scroll row mb-md-6">
                    <div class="horizontal__scroll-container">
                        <?php
                        $args = array(
                            'post_type' => 'post',
                            'cat' => 38,
                            'posts_per_page' => 4,
                            //    'meta_key' => 'views',
                            //    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
                            //    'order' => 'DESC',
                        );
                        $wp_query = new WP_Query($args);
                        if ($wp_query->have_posts()) {
                            while ($wp_query->have_posts()) {
                                $wp_query->the_post(); ?>
                                <!-- item -->
                                <div class="article__item card card__vertical size4 offer h-100">
                                    <div class="card-container p-3 d-xl-flex flex-xl-column">
                                        <?php if (get_the_post_thumbnail_url()): ?>
                                            <div class="card__image">
                                                <img
                                                    src="<?php echo the_post_thumbnail_url() ?>"
                                                    alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                                        <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                                        <div class="mt-auto">
                                            <div class="d-flex align-items-center mt-2">
                                                <div class="card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use>
                                                        </svg></div>
                                                    <?php echo the_field('views') ?>
                                                </div>
                                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                            </svg></a></div>
                                                    <?php echo comments_number('0', '1', '%'); ?>
                                                </div>
                                                <div class="card__like d-flex align-items-center ml-auto">
                                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                </div>
                                            </div>
                                            <?php $author_id = get_field('page_author');
                                            if ($author_id):
                                            ?>
                                                <div class="card__author d-flex align-items-center mt-3">
                                                    <div class="card__author-img">
                                                        <?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                                    </div>
                                                    <div class="card__author-content">
                                                        <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                                                        <div class="rating d-flex align-items-center">
                                                            <?php echo do_shortcode('[ratings id="' . $author_id . '"]'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- / item -->
                        <?php }
                        } ?>
                        <?php wp_reset_query() ?>
                    </div>
                </div>
                <a href="<?php echo get_category_link('38') ?>" class="btn btn-primary btn-sm btn-all-mob">
                    Все
                    <span class="icon ml-2">
                        <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <!-- / articles -->

            <!-- new-comments -->
            <div id="comments" class="section">
                <h2 class="title mb-3">Комментарии</h2>
                <div class="additional-comments">
                    <?php
                    $current_post_id = get_the_ID();
                    display_additional_comments($current_post_id);
                    ?>
                </div>
                <div class="btn btn-primary" id="openAdditionalCommentForm">
                    Написать комментарий
                </div>

            </div>
            <div class="new-comment-form">
                <?php // if (is_user_logged_in()): 
                ?>
                <!-- <h3>Оставить комментарий</h3> -->
                <form id="additional-comment-form" method="post" class="row additional-comment-form">
                    <input type="hidden" name="action" value="handle_additional_comment_ajax">
                    <input type="hidden" name="additional_comment_nonce" value="<?php echo wp_create_nonce('additional_comment_form'); ?>">
                    <div class="form-group col-12 col-md-6">
                        <!-- <label for="author_name">Имя</label> -->
                        <div class="mb-3">
                            <input type="text" id="author_name" name="acf[field_675ae76ee8992]" class="form-control" placeholder="Имя*" required>
                        </div>

                    </div>
                    <div class="form-group col-12 col-md-6">
                        <!-- <label for="author_email">E-Mail</label> -->
                        <div class="mb-3">
                            <input type="email" id="author_email" name="acf[field_675ae7d4b0bdc]" class="form-control" placeholder="E-Mail*" required>
                        </div>

                    </div>
                    <div class="form-group col-12">
                        <!-- <label for="comment_content">Комментарий</label> -->
                        <textarea id="comment_content" name="acf[field_675ae80ab0bdd]" class="form-control" rows="4" placeholder="Ваш комментарий*" required></textarea>
                    </div>
                    <div class="form-comment__bottom">* - Обязательно заполнить</div>
                    <input type="hidden" name="acf[field_related_post]" value="<?php echo get_the_ID(); ?>" />
                    <div class="col-12">
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary px-5">Отправить</button>
                        </div>
                    </div>

                </form>


            </div>
            <!-- /new-comments -->

            <!-- wysiwyg text -->
            <div class="section">
                <div class="wysiwyg type-desc">
                    <?php echo the_field('zaimy_desc', 'options') ?>
                </div>
                <div class="type-desc-more">Раскрыть</div>
                <?php $date_actually = get_the_modified_date('d.m.Y', $ID); ?>
                <?php if ($date_actually): ?>
                    <div class="date_actually-article mb-2">Обновлено: <?= $date_actually; ?></div>
                <?php endif; ?>
            </div>
            <!-- / wysiwyg text -->

            <!-- footer-raiting -->
            <?php if (have_rows('rz_additional_ratings_list', 'options')) : ?>
                <div class="section">
                    <div class="container">
                        <div class="rating-footer client-rating" data-post-id="<?php echo get_the_ID(); ?>">
                            <?php
                            $title = get_sub_field('rz_title', 'options');
                            echo '<h3 class="rating-title">' . esc_html($title) . '</h3>';
                            // Дополнительный рейтинговый блок

                            $additional_index = 0;
                            while (have_rows('rz_additional_ratings_list', 'options')) : the_row();
                                $title = get_sub_field('title', 'options');
                                $rating_total = get_sub_field('rating_total', 'options');
                                $rating_count = get_sub_field('rating_count', 'options');

                                // Вычисляем средний рейтинг
                                if ($rating_total && $rating_count) {
                                    $average_rating = $rating_total / $rating_count;
                                    $average_rating = round($average_rating, 1);
                                } else {
                                    $average_rating = 0;
                                }

                                if ($title || $average_rating > 0) :
                                    echo '<div class="rating-item" data-rating-index="' . $additional_index . '" data-rating-block="rz_additional_ratings_list">';
                                    if ($title) {
                                        echo '<h3 class="rating-title">' . esc_html($title) . '</h3>';
                                    }

                                    if ($average_rating > 0) {
                                        // Передаём правильный блок в функцию отображения рейтинга
                                        display_star_rating($average_rating, 'rz_additional_ratings_list');
                                    } else {
                                        echo '<div class="stars">';
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo '<span class="star" data-value="' . $i . '" data-rating-block="rz_additional_ratings_list">☆</span>';
                                        }
                                        echo '</div>';
                                    }

                                    // Добавляем элемент для отображения числового рейтинга
                                    echo '<div class="rating-stat">';
                                    echo 'Оценок ' . ($rating_count > 0 ? $rating_count : '0') . ', ';
                                    echo 'среднее <span class="average-rating">' . ($average_rating > 0 ? $average_rating : '0') . '</span> из 5';
                                    echo '</div>';

                                endif;

                                $additional_index++;
                            endwhile;

                            ?>
                        </div>


                    </div>
                </div>
            <?php endif; ?>
            <!-- / footer-raiting -->
        </div>

    </main>
    <script src="<?php echo get_template_directory_uri(); ?>/js/new-listing.js"></script>


    <?php get_footer(); ?>

<?php } ?>