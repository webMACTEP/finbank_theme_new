<?php
// Начало PHP-кода
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Проверка наличия параметра 'change_template' в URL
if (isset($_GET['change_template']) && $_GET['change_template']):
    get_template_part('template-parts/new-collection-kredity');
else:
    get_header();

    // Получение текущего термина
    $term = get_queried_object();
    $ID = $term->ID;

    // Инициализация переменных
    $mt = false;
    $cred_limit = 0;
    $cred_day_period = 0;

    // Проверка наличия фильтра в сессии
    if (isset($_SESSION['filter_credit_card']) && !empty($_SESSION['filter_credit_card'])):
        $mt = 1;
        $cred_limit = $_SESSION['filter_credit_card'][0];
        $cred_day_period = $_SESSION['filter_credit_card'][1];
    endif;

    // Очистка фильтра из сессии
    unset($_SESSION['filter_credit_card']);
?>

    <?php if ($mt): ?>
        <div class="start-func-credit-card-filter"></div>
    <?php endif; ?>



    <main class="newlisting" term="creditcard">
        <div class="container">
            <nav aria-label="breadcrumb" class="horizontal__scroll">
                <ol class="breadcrumb horizontal__scroll-container">
                    <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Кредитные карты</li>
                </ol>
            </nav>
        </div>
        <div class="page__heading">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="page__heading-title mb-0">Кредитные карты</h1>
                    <?php $args = array(
                        'post_type'             => 'bankcard',
                        'posts_per_page'        => -1,
                        'orderby' => 'date',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'bankcards',
                                'field'    => 'slug',
                                'terms'    => 'creditcard',
                            ),
                        )
                    );
                    $query = new WP_Query($args);

                    // Цикл
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $date = get_the_date('d.m.y');
                    ?>
                    <?php }
                    }
                    wp_reset_query() ?>
                </div>
                <div class="row mb-4 flex-end">

                    <div class="page__heading-description col-lg-8 col-sm-12 mt-2">
                        В данном разделе вы можете оформить кредитную карту по вашим финансовым возможностям. Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis consequuntur, natus cum necessitatibus quos esse odit assumenda consequatur! At ipsam deserunt officia architecto et ullam, possimus ipsa! Neque, inventore illum?
                    </div>
                    <div class="page__heading-description-more col-lg-2 col-sm-12 mt-2">Развернуть</div>
                </div>

            </div>

        </div>

        <!-- page navigation -->
        <div class="page__nav">
            <div class="container">
                <div class="page__nav-container nav-tabs">
                    <div class="horizontal__scroll">
                        <div class="horizontal__scroll-container">
                            <a href="<?php echo get_term_link(2, '') ?>" class="nav-link active">Все кредитные карты</a>
                            <a href="<?php echo get_page_link(4969); //1503 tax-reviews
                                        ?>" class="nav-link " data-tax="creditcard">Отзывы</a>
                            <a href="<?php echo get_page_link(149) ?>" class="nav-link">Калькулятор</a>
                            <a href="<?php echo get_category_link(32) ?>" class="nav-link">Статьи</a>
                            <a href="<?php echo get_page_link(380) ?>" class="nav-link">сравнить</a>
                            <a href="#best-products" class="nav-link">Лучшие предложения</a>
                        </div>
                    </div>
                </div>
                <form id="credit-card-filter" action="" method="POST">
                    <input type="hidden" name="action" value="cardfilter" />
                    <input type="hidden" name="term" value="creditcard" />
                    <?php if (!empty($sessfiltercard)): ?>
                        <input type="hidden" name="sessfiltercard" value="<?= $sessfiltercard; ?>" />
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3 col-xl-4 order-1">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Кредитный лимит, ₽</div>
                                    <input max="<?= $filter_price['credit_inputs_range']['max']; ?>" type="text" class="range__value cred_limit" value="<?php echo $cred_limit ?>" min="0">
                                </div>
                                <input max="<?= $filter_price['credit_inputs_range']['max']; ?>" class="range__input" name="cred_limit" type="range" min="0" value="<?php echo $cred_limit ?>">

                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 col-xl-4 order-2">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Льготный период, дней</div>
                                    <input max="<?= $filter_price['credit_inputs_range']['day_max']; ?>" type="text" class="range__value cred_trat" value="<?php echo $cred_day_period ?>" min="0">
                                </div>
                                <input max="<?= $filter_price['credit_inputs_range']['day_max']; ?>" class="range__input" name="cred_day_period" type="range" min="0" value="<?php echo $cred_day_period ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 col-xl-2 mt-lg-0 order-5 order-md-3">
                            <div class="btn btn-primary btn-block submit-button">Показать</div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 col-xl-2 mt-3 mt-lg-0 order-3 order-md-4">
                            <div class="filter__details">
                                <a class="btn btn-outline-alternative btn-block" href="#filter__details" data-bs-toggle="collapse" aria-expanded="false">
                                    Еще условия
                                    <svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 6h-.4C4.4 5.8 3.5 5 2 3.5L.3 1.7C-.1 1.3-.1.7.3.3c.4-.4 1-.4 1.4 0l1.7 1.8C4.6 3.2 5.3 3.9 5.8 4h.4c.5-.1 1.2-.8 2.4-1.9L10.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L10 3.5C8.5 5 7.6 5.8 6.4 6H6Z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div id="filter__details" class="col-12 collapse mt-md-4 order-4 order-md-5">
                            <div class="row pb-3 pb-md-0">
                                <div class="col-12 col-md-4 banks_select">
                                    <label class="form-label" for="bankSelect">Банки</label>
                                    <select name="bank" id="bankSelect" class="styledSelect" placeholder="">
                                        <option value="">Любой</option>
                                        <?php
                                        $args = array(
                                            'posts_per_page' => -1,
                                            'post_type' => 'banks',
                                            'orderby' => 'name',
                                            'order' => 'DESC',
                                        );

                                        $wp_query = new WP_Query($args);

                                        // Цикл
                                        if ($wp_query->have_posts()) {
                                            $counter = 0;
                                            while ($wp_query->have_posts()) {
                                                $wp_query->the_post();
                                                $counter += 1;
                                        ?>
                                                <option value="<?php echo get_the_id() ?>"><?php echo the_title() ?></option>
                                        <?php
                                            }
                                        } ?>
                                        <?php wp_reset_query() ?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 card_cat_select">
                                    <label class="form-label" for="bankTop">Категория карты</label>
                                    <select name="cat_cards" id="bankTop" class="styledSelect" placeholder="">
                                        <option value="">Все</option>
                                        <?php
                                        $field = get_field_object('card_category', 95);
                                        //$value = $field['value'];
                                        //$label = $field['choices'][ $value ];
                                        if ($field['choices']): ?>
                                            <?php foreach ($field['choices'] as $value => $label): ?>
                                                <option value="<?php echo $value ?>"><?php echo $label ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </select>
                                </div>
                                <div class="col-12 col-md-4 grace_period_select">
                                    <label class="form-label" for="gracePeriod">Льготный период</label>
                                    <select name="period" id="gracePeriod" class="styledSelect" placeholder="">
                                        <option value="">Любой</option>
                                        <option value="grc20">до 100 дней</option>
                                        <option value="grc30">от 100 до 200 дней</option>
                                        <option value="grc40">более 200 дней</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
                    <a class="nav-link" href="/collection/onlajn/">Онлайн на карту</a>
                    <a class="nav-link" href="/collection/kreditnaya-karta-virtualnye/">Виртуальные</a>
                    <a class="nav-link" href="/collection/refinansirovanie-kreditnoy-karty/">Рефинансирование</a>
                    <a class="nav-link" href="/collection/dlja-snjatija-nalichnyh/">Для снятия наличных</a>
                    <a class="nav-link" href="/collection/bez-spravok-o-dohodah/">Без справок о доходах</a>
                    <a class="nav-link" href="/collection/s-plohoj-istoriej/">С плохой КИ</a>
                    <a class="nav-link" href="/collection/s-kjeshbek/">С кэшбеком</a>
                    <a class="nav-link" href="/collection/pod-nizkij-procent/">Под низкий процент</a>
                    <a class="nav-link" href="/collection/kreditnye-karty-s-besplatnym-snjatiem-nalichnyh-v-2024-godu/">С бесплатным снятием наличных</a>
                    <a class="nav-link" href="/collection/kreditnaya-karta-pensioneram/">Пенсионерам</a>
                    <a class="nav-link" href="/collection/onlajn/">Онлайн на карту</a>
                    <a class="nav-link" href="/collection/kreditnaya-karta-virtualnye/">Виртуальные</a>
                    <a class="nav-link" href="/collection/refinansirovanie-kreditnoy-karty/">Рефинансирование</a>
                    <a class="nav-link" href="/collection/dlja-snjatija-nalichnyh/">Для снятия наличных</a>
                    <a class="nav-link" href="/collection/bez-spravok-o-dohodah/">Без справок о доходах</a>
                    <a class="nav-link" href="/collection/s-plohoj-istoriej/">С плохой КИ</a>
                    <a class="nav-link" href="/collection/s-kjeshbek/">С кэшбеком</a>
                    <a class="nav-link" href="/collection/pod-nizkij-procent/">Под низкий процент</a>
                    <a class="nav-link" href="/collection/kreditnye-karty-s-besplatnym-snjatiem-nalichnyh-v-2024-godu/">С бесплатным снятием наличных</a>
                    <a class="nav-link" href="/collection/kreditnaya-karta-pensioneram/">Пенсионерам</a>
                </div>
                <div class="tags-list_next"><svg width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 1.5L3.15278 3.07258C4.47085 4.32668 5.12988 4.95373 5.23135 5.718C5.25622 5.90526 5.25622 6.09474 5.23135 6.282C5.12988 7.04627 4.47085 7.67332 3.15278 8.92742L1.5 10.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        </div>
        <!-- / tags -->
        <!-- banks 
        <div class="container">

            <div class="banks-wrapper mb-4">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $max_pages = $wp_query->max_num_pages;
                $args = array(
                    'post_type' => 'banks',
                    //'meta_key' => 'ratings_average',
                    'orderby' => array('ratings_average' => 'desc', 'name' => 'desc',),
                    'order' => 'DESC',
                    'paged' => $paged,
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => 'ratings_average',
                            'compare' => 'EXISTS', //or "NOT EXISTS", for non-existance of this key
                        ),
                        array(
                            'key' => 'ratings_average',
                            'compare' => 'NOT EXISTS', //or "NOT EXISTS", for non-existance of this key
                        ),
                    )
                );

                $wp_query = new WP_Query($args);

                // Цикл
                if ($wp_query->have_posts()) {
                    $counter = 0;
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                        $counter += 1;
                ?>

                        <a href="<?php echo the_permalink() ?>" class="bank-item">
                            <img src="<?php echo the_field('bank_logo') ?>"
                                alt="<?
                                        $bank_id = get_field('bank_logo', get_the_ID(), false);
                                        $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                        echo $bank_alt;
                                        ?>">
                            <?php echo the_title() ?>
                        </a>

                <?php
                    }
                } ?>
            </div>

            <?php wp_reset_query(); ?>



        </div>
         / banks -->
        <div class="container">
            <!-- credits list -->
            <div class="credits section">
                <div class="row">

                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'paged' => $paged,
                        'orderby' => 'name',
                        'order' => 'DESC',
                        'post_type'             => 'bankcard',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'bankcards',
                                'field'    => 'slug',
                                'terms'    => 'creditcard',
                            ),
                        ),
                        'post_status' => 'publish',
                    );

                    $args['meta_query'][] = array(
                        'key' => 'archive',
                        'value' => '0'
                    );

                    $counter = 0;
                    $query = new WP_Query($args);

                    if ($query->have_posts()) {

                        $max_pages = $query->max_num_pages;
                        $found_posts = $query->found_posts;

                        if ($query->have_posts()) {
                            ob_start();
                            while ($query->have_posts()):
                                $query->the_post();
                                $counter++;
                                get_template_part('template-parts/filter-cred-card-posts-new');
                            endwhile;

                            $posts_html = ob_get_contents();
                            ob_end_clean();
                        }
                    } else {
                        $posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
                    }

                    $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
                    $max_pages = $wp_query->max_num_pages;

                    ?>
                    <!-- list -->
                    <div class="col-12 col-lg-12 order-lg-1">
                        <div class="credits__list">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mt-0 mt-md-5 mt-lg-0 mb-3">
                                <div class="credits__list-buttons d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="mt-5 mb-4 mt-md-0 mb-md-0"><span class="variants_count"><?php echo $query->found_posts; ?></span> варианта</div>
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
                                    <div class="credits__list-dropdown dropdown mb-3 mb-md-0 px-0">
                                        <select name="" class="styledSelect cred-order-select">
                                            <option value="" selected disabled>Сортировать</option>
                                            <option value="ratings_average">По рейтингу</option>
                                            <option value="views">По количеству заявок</option>
                                            <option value="card_cred_limit">По кредитному лимиту</option>
                                            <option value="card_day_period">По льготному периоду</option>
                                            <option value="card_stavka">По процентной ставке</option>
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
                            <!-- pagination -->
                            <div class="pagination flex-column mb-5 mb-md-0">
                                <?php if ($paged < $max_pages): ?>
                                    <button class="btn btn-outline-gray btn-block load_more_btn"
                                        data-max_pages="<?php echo $max_pages ?>" data-paged="<?php echo $paged ?>">
                                        Больше решений000
                                    </button>
                                <?php endif; ?>
                                <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                                    <div class="pagination__links">
                                        <?php my_pagination(); ?>
                                    </div>

                                    <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
                                    wp_reset_query(); ?>
                                    <div class="pagination__description mt-4 mt-sm-0">
                                        Показано <span class="count_view"><?php echo $counter ?></span>
                                        продуктов из <span class="count_all"><?php echo $query->found_posts; ?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- / pagination -->

                            <?php

                            $args_archive = array(
                                'post_type'             => 'bankcard',
                                'posts_per_page'        => -1,
                                'meta_key'      => 'archive',
                                'meta_value'    => true,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'bankcards',
                                        'field'    => 'slug',
                                        'terms'    => 'creditcard',
                                    ),
                                )
                            );
                            $query_archive = new WP_Query($args_archive);
                            if ($query_archive->have_posts()): ?>
                                <h2 class="title archive_title mt-5">Архивные кредитные карты (<?= $query_archive->found_posts; ?>)</h2>
                                <div class="list_posts archive_list archive_hide">
                                    <?php while ($query_archive->have_posts()): $query_archive->the_post(); ?>
                                        <?php get_template_part('template-parts/filter-cred-card-posts'); ?>
                                    <?php endwhile;
                                    wp_reset_postdata(); ?>
                                </div>
                            <?php endif; ?>

                            <div class="d-xs-block d-lg-none">
                                <?php
                                $args = array(
                                    'hide_empty' => true,
                                    'taxonomy'     => 'tags-category',
                                );

                                $cats = get_categories($args);
                                if ($cats) {
                                    foreach ($cats as $cat) {
                                        $parent_category = array(81, 87, 99, 72);
                                        if (in_array($cat->term_id, $parent_category)) continue;

                                        $args_coll = array(
                                            'post_type' => 'collection',
                                            'taxonomy' => 'tags-category',
                                            'tax_query' => [
                                                [
                                                    'taxonomy' => 'tags-category',
                                                    'terms' => $cat->term_id,
                                                    'field' => 'id',
                                                    'operator' => 'IN',
                                                ]
                                            ],
                                            'posts_per_page' => -1,
                                            'orderby' => 'date',
                                            'order' => 'DESC',
                                            'meta_query'    => array(
                                                array(
                                                    'key'       => 'coll-type',
                                                    'value'     => 'creditcard',
                                                    'compare'   => '=',
                                                ),
                                            )
                                        );
                                        $query = new WP_Query($args_coll);
                                        if ($query->have_posts()) {
                                            $current_id = $wp_query->get_queried_object_id(); ?>
                                            <?php get_template_part('all_template/filter_right', null, ['cat' => $cat, 'query' => $query,  'mobile' => 1]); ?>
                                        <?php }
                                        wp_reset_query(); ?>

                                <?php        }
                                }
                                ?>
                            </div>



                        </div>
                    </div>
                    <!-- / list -->
                    <!-- / pagination -->
                </div>
            </div>
            <?php wp_reset_query(); ?>
            <!-- / credits list -->
            <!-- articles -->
            <div class="section">
                <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="title mb-0">Статьи о кредитных картах</h2>
                    <a href="<?php echo get_category_link('32') ?>" class="btn btn-primary btn-sm btn-all">
                        Все
                        <span class="icon ml-2">
                            <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="horizontal__scroll row mb-5 mb-md-6">
                    <div class="horizontal__scroll-container">
                        <?php
                        $args = array(
                            'post_type' => 'post',
                            'cat' => 32,
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
            </div>
            <!-- / articles -->

            <!-- similar offers -->

            <!-- / similar offers -->
            <!-- card reviews -->
            <div class="section">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Отзывы о кредитных картах</h2>
                    <a href="<?php echo  get_page_link(4969); //1503 tax-reviews 
                                ?>" class="btn btn-primary btn-sm btn-all" data-tax="creditcard">
                        Все
                        <span class="icon ml-2">
                            <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="horizontal__scroll row">
                    <div class="horizontal__scroll-container">
                        <?php

                        $ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                        $custom_offset = 0;

                        // fetch posts in all those categories
                        $posts = get_objects_in_term(2, 'bankcards');

                        $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                         FROM {$wpdb->comments} WHERE
                            comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
                            ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                        $comments_list = $wpdb->get_results($sql);

                        if (count($comments_list) > 0) {
                            foreach ($comments_list as $comm) {

                                $comment_id = $comm->comment_ID;
                                $comment = get_comment($comment_id);
                                $comment_post_id = $comment->comment_post_ID;
                                $bank_id = get_field('bank_choise', $comment_post_id);
                                $user = get_userdata($comment->user_id);
                                $user_email = '';
                                $user_role = '';
                                if (!empty($user)) {
                                    $user_email = $user->user_email;
                                    $user_role = $user->roles;
                                }
                                $author = get_comment_author($comment_id);
                                $city = get_comment_meta($comment_id, 'city', true); ?>
                                <!-- item -->
                                <div class="reviews__item">
                                    <div class="reviews__item-body">
                                        <div class="reviews__header d-flex align-items-center mb-2">
                                            <div class="reviews__header-logo">
                                                <img src="<?php echo the_field('bank_logo', $bank_id) ?>"
                                                    alt="<?
                                                            $logo_id = get_field('bank_logo', $bank_id, false);
                                                            $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                            echo $logo_alt;
                                                            ?>">
                                            </div>
                                            <div class="reviews__header-meta ml-3">
                                                <a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($bank_id) ?></a>
                                                <div class="d-flex">
                                                    <div class="card__rating d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php echo the_field('ratings_average', $bank_id); ?>
                                                    </div>
                                                    <div class="card__icon d-flex align-items-center">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php echo comments_number('0', '1', '%', $bank_id); ?>
                                                    </div>
                                                    <div class="card__date d-none d-md-block ml-auto"><?php echo  get_comment_date('d.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reviews__item-content">
                                            <p><?php echo $comment->comment_content; ?></p>
                                        </div>
                                    </div>
                                    <div class="reviews__item-footer">
                                        <div class="reviews__author d-flex align-items-center mt-3">
                                            <div class="reviews__author-img mr-3">
                                                <img src="<?php echo get_avatar_url($comment, array(
                                                                'size' => 60,
                                                                'default' => 'identicon',
                                                            )); ?>" alt="<?php echo $author; ?>">
                                            </div>
                                            <div class="reviews__author-content">
                                                <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                                                <div class="reviews__author-info d-flex">
                                                    <div class="card__icon d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php if (empty($user_role[0])):
                                                            echo 'Гость';
                                                        else:
                                                            echo $user_role[0];
                                                        endif; ?>
                                                    </div>
                                                    <?php if ($city != ''): ?>
                                                        <div class="card__icon d-flex align-items-center">
                                                            <div class="mr-2"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo $city ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- / item -->
                            <?php }
                        } else { ?>
                            <p class="col-12">Пока нет отзывов.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- / card reviews -->
            <!-- best offers -->
            <div class="section" id="best-products">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Лучшие предложения </h2>
                    <a href="" class="btn btn-primary btn-sm btn-all">
                        Все
                        <span class="icon ml-2">
                            <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="horizontal__scroll row">
                    <div class="horizontal__scroll-container">
                        <?php
                        $args = array(
                            'post_type'             => 'bankcard',
                            'posts_per_page'        => 4,
                            'meta_key' => 'ratings_average',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'bankcards',
                                    'field'    => 'slug',
                                    'terms'    =>  'creditcard',
                                ),
                            )
                        );

                        $query = new WP_Query($args);

                        // Цикл
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();


                                // if($_GET['test']){
                                //     $posttype = get_term(get_the_id());
                                //     print_r2($posttype);
                                //     echo 123;
                                // }

                        ?>
                                <!-- item -->
                                <div class="card card__vertical size4 offer h-100">
                                    <div class="card-container p-3">
                                        <div class="card__header mb-2 d-flex">
                                            <div class="card__header-img">
                                                <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                                <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                                    alt="<?
                                                            $logo_id = get_field('bank_logo', $bank_choise_rel, false);
                                                            $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                            echo $logo_alt;
                                                            ?>">
                                            </div>
                                            <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></div>
                                        </div>
                                        <div class="card__header-info d-flex align-items-center">
                                            <div class="card__rating d-flex align-items-center mr-3">
                                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                    </svg></div>
                                                <?php echo the_field('ratings_average'); ?>
                                            </div>
                                            <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                        </svg></a></div>
                                                <?php $comments_count = wp_count_comments(get_the_ID());
                                                echo $comments_count->approved ?>
                                            </div>
                                            <div class="card__like d-flex align-items-center">
                                                <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                            </div>
                                            <div class="card__header-actions ml-auto">
                                                <a href=""><svg width="20" height="20" viewBox="0 0 20 20">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use>
                                                    </svg></a>
                                            </div>
                                        </div>
                                        <div class="card__image my-3">
                                            <a href="<?php echo the_permalink() ?>">
                                                <img
                                                    src="<?php echo the_field('card_logo') ?>"
                                                    alt="<?
                                                            $logo_id = get_field('card_logo', get_the_ID(), false);
                                                            $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                            echo $logo_alt;
                                                            ?>"></a>
                                        </div>
                                        <ul class="leaders">
                                            <li class="leaders__item mb-1">
                                                <div class="leaders__item-title">Лимит</div>
                                                <div class="leaders__item-value"><?php echo the_field('card_cred_limit') ?> р</div>
                                            </li>
                                            <li class="leaders__item mb-1">
                                                <div class="leaders__item-title">Без %</div>
                                                <div class="leaders__item-value"><?php $field = get_field('card_period');
                                                                                    //$value = $field['value'];
                                                                                    //$label = $field['choices'][ $value ];
                                                                                    echo $field['label'] ?></div>
                                            </li>
                                            <li class="leaders__item mb-1">
                                                <div class="leaders__item-title">Кэшбек</div>
                                                <div class="leaders__item-value"><?= get_field('card_cashback'); ?></div>
                                            </li>
                                            <li class="leaders__item mb-1">
                                                <div class="leaders__item-title">Ставка</div>
                                                <div class="leaders__item-value">от <?php echo the_field('card_stavka') ?>%</div>
                                            </li>
                                        </ul>
                                        <div class="card__actions mt-3 d-flex">
                                            <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                                            <a class="btn__compare btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'creditcard'; ?>">
                                                <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve">
                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="card__footer mt-3">
                                            <p>
                                                <span><?php echo the_field('bank_phone', $bank_choise_rel) ?></span>
                                                <span><?php echo the_field('bank_email', $bank_choise_rel) ?></span>
                                                <span>Лицензия: <?php echo the_field('bank_license', $bank_choise_rel) ?></span>
                                                <span><?php echo the_field('views', get_the_id()) ?> заявок</span>
                                            </p>
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
            <!-- / best offers -->
            <!-- faq -->


            <?php if (have_rows('type_faq', $term)): ?>
                <div class="section">
                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0">Часто задавемые вопросы</h2>
                    </div>
                    <div class="accordion" id="accordion">
                        <?php $counter = 0; ?>
                        <?php while (have_rows('type_faq', $term)): the_row();
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
            <!-- wysiwyg text -->
            <div class="section">
                <div class="wysiwyg">
                    <?php echo the_field('type_desc', $term) ?>
                </div>
                <?php $date_actually = get_the_modified_date('d.m.Y', $ID); ?>
                <?php if ($date_actually): ?>
                    <div class="date_actually-article mb-2">Обновлено: <?= $date_actually; ?></div>
                <?php endif; ?>
            </div>
            <!-- / wysiwyg text -->
        </div>

    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const moreButton = document.querySelector('.page__heading-description-more');
            const descriptionElement = document.querySelector('.page__heading-description');

            if (moreButton && descriptionElement) {
                moreButton.addEventListener('click', () => {
                    const isActive = descriptionElement.classList.toggle('active'); // Переключаем класс active

                    // Меняем текст кнопки
                    moreButton.textContent = isActive ? 'Свернуть' : 'Развернуть';
                });
            }


        });
    </script>

    <?php get_footer(); ?>

<?php endif; ?>