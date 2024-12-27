<?php
// Начало PHP-кода
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Проверка наличия параметра 'change_template' в URL
if(isset($_GET['change_template']) && $_GET['change_template']):
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
    if(isset($_SESSION['filter_credit_card']) && !empty($_SESSION['filter_credit_card'])):
        $mt = 1;
        $cred_limit = $_SESSION['filter_credit_card'][0];
        $cred_day_period = $_SESSION['filter_credit_card'][1];
    endif;

    // Очистка фильтра из сессии
    unset($_SESSION['filter_credit_card']);
    ?>

    <?php if($mt): ?>
        <div class="start-func-credit-card-filter"></div>
    <?php endif; ?>

    <main term="creditcard">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="horizontal__scroll">
                <ol class="breadcrumb horizontal__scroll-container">
                    <li class="breadcrumb-item"><a href="<?php echo esc_url(get_home_url()); ?>">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Кредитные карты</li>
                </ol>
            </nav>
        </div>

        <div class="page__heading">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="page__heading-title mb-0">Кредитные карты</h1>

                    <?php
                    // Получение даты последнего обновления
                    $args = array(
                        'post_type'      => 'bankcard',
                        'posts_per_page' => -1,
                        'orderby'        => 'date',
                        'order'          => 'ASC',
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'bankcards',
                                'field'    => 'slug',
                                'terms'    => 'creditcard',
                            ),
                        ),
                    );
                    $query = new WP_Query($args);

                    $date = '';
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $date = get_the_date('d.m.Y'); // Используйте полный формат даты
                        }
                    }
                    wp_reset_postdata();
                    ?>

                    <div class="page__heading-date">Обновлено: <?php echo esc_html($date); ?></div>
                </div>

                <div class="page__heading-description mt-2 mb-4">
                    В данном разделе вы можете оформить кредитную карту по вашим финансовым возможностям
                </div>

                <!-- Форма фильтрации -->
                <form id="credit-card-filter" action="" method="POST">
                    <input type="hidden" name="action" value="cardfilter" />
                    <input type="hidden" name="term" value="creditcard" />

                    <?php if(!empty($sessfiltercard)): ?>
                        <input type="hidden" name="sessfiltercard" value="<?php echo esc_attr($sessfiltercard); ?>" />
                    <?php endif; ?>

                    <div class="row">
                        <!-- Кредитный лимит -->
                        <div class="col-12 col-md-6 col-lg-3 col-xl-4 order-1">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Кредитный лимит, ₽</div>
                                    <input max="<?php echo esc_attr($filter_price['credit_inputs_range']['max']); ?>" type="text" class="range__value cred_limit" value="<?php echo esc_attr($cred_limit); ?>" min="0">
                                </div>
                                <input max="<?php echo esc_attr($filter_price['credit_inputs_range']['max']); ?>" class="range__input" name="cred_limit" type="range" min="0" value="<?php echo esc_attr($cred_limit); ?>">
                            </div>
                        </div>

                        <!-- Льготный период -->
                        <div class="col-12 col-md-6 col-lg-3 col-xl-4 order-2">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Льготный период, дней</div>
                                    <input max="<?php echo esc_attr($filter_price['credit_inputs_range']['day_max']); ?>" type="text" class="range__value cred_trat" value="<?php echo esc_attr($cred_day_period); ?>" min="0">
                                </div>
                                <input max="<?php echo esc_attr($filter_price['credit_inputs_range']['day_max']); ?>" class="range__input" name="cred_day_period" type="range" min="0" value="<?php echo esc_attr($cred_day_period); ?>">
                            </div>
                        </div>

                        <!-- Кнопка показать -->
                        <div class="col-12 col-md-6 col-lg-3 col-xl-2 mt-lg-0 order-5 order-md-3">
                            <div class="btn btn-primary btn-block submit-button">Показать</div>
                        </div>

                        <!-- Кнопка "Еще условия" -->
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

                        <!-- Дополнительные фильтры -->
                        <div id="filter__details" class="col-12 collapse mt-md-4 order-4 order-md-5">
                            <div class="row pb-3 pb-md-0">
                                <!-- Банки -->
                                <div class="col-12 col-md-4 banks_select">
                                    <label class="form-label" for="bankSelect">Банки</label>
                                    <select name="bank" id="bankSelect" class="styledSelect" placeholder="">
                                        <option value="">Любой</option>
                                        <?php
                                        $args = array(
                                            'posts_per_page' => -1,
                                            'post_type'      => 'banks',
                                            'orderby'        => 'name',
                                            'order'          => 'DESC',
                                        );

                                        $wp_query_banks = new WP_Query($args);

                                        if ($wp_query_banks->have_posts()) {
                                            while ($wp_query_banks->have_posts()) {
                                                $wp_query_banks->the_post();
                                                ?>
                                                <option value="<?php echo esc_attr(get_the_ID()); ?>"><?php echo esc_html(get_the_title()); ?></option>
                                                <?php
                                            }
                                        }
                                        wp_reset_postdata();
                                        ?>
                                    </select>
                                </div>

                                <!-- Категория карты -->
                                <div class="col-12 col-md-4 card_cat_select">
                                    <label class="form-label" for="bankTop">Категория карты</label>
                                    <select name="cat_cards" id="bankTop" class="styledSelect" placeholder="">
                                        <option value="">Все</option>
                                        <?php
                                        $field = get_field_object('card_category', 95);
                                        if ($field['choices']):
                                            foreach ($field['choices'] as $value => $label):
                                                ?>
                                                <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>

                                <!-- Льготный период -->
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

        <!-- Навигация страницы -->
        <div class="page__nav">
            <div class="container">
                <div class="page__nav-container nav-tabs">
                    <div class="horizontal__scroll">
                        <div class="horizontal__scroll-container">
                            <a href="<?php echo esc_url(get_term_link(2, 'bankcards')); ?>" class="nav-link active">Все кредитные карты</a>
                            <a href="<?php echo esc_url(get_page_link(4969)); ?>" class="nav-link" data-tax="creditcard">Отзывы</a>
                            <a href="<?php echo esc_url(get_page_link(149)); ?>" class="nav-link">Калькулятор</a>
                            <a href="<?php echo esc_url(get_category_link(32)); ?>" class="nav-link">Статьи</a>
                            <a href="<?php echo esc_url(get_page_link(380)); ?>" class="nav-link">Сравнить</a>
                            <a href="#best-products" class="nav-link">Лучшие предложения</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Навигация страницы -->

        <div class="container">
            <!-- Список кредитов -->
            <div class="credits section">
                <div class="row">
                    <!-- Фильтр -->
                    <div class="col-12 col-lg-4 order-lg-2">
                        <div class="sticky-top">
                            <form id="credit-card-filter-aside">
                                <div class="filter mb-3">
                                    <!-- Платежная система -->
                                    <div class="filter__section">
                                        <a class="filter__btn collapsed" data-bs-toggle="collapse" href="#filter1" role="button" aria-expanded="false">
                                            Платежная система
                                            <div class="filter__btn-icon">
                                                <svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 6h-.4C4.4 5.8 3.5 5 2 3.5L.3 1.7C-.1 1.3-.1.7.3.3c.4-.4 1-.4 1.4 0l1.7 1.8C4.6 3.2 5.3 3.9 5.8 4h.4c.5-.1 1.2-.8 2.4-1.9L10.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L10 3.5C8.5 5 7.6 5.8 6.4 6H6Z"></path>
                                                </svg>
                                            </div>
                                        </a>
                                        <div class="collapse" id="filter1">
                                            <div class="filter__content">
                                                <ul class="filter__list">
                                                    <?php
                                                    $payment_systems = [
                                                        'MasterCard',
                                                        'VISA',
                                                        'МИР',
                                                        'UnionPay',
                                                    ];
                                                    foreach ($payment_systems as $index => $ps):
                                                        ?>
                                                        <li class="filter__list-item">
                                                            <label class="checkbox">
                                                                <input type="checkbox" name="ps<?php echo $index + 1; ?>">
                                                                <span class="checkbox__icon">
                                                                    <svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path>
                                                                    </svg>
                                                                </span>
                                                                <?php echo esc_html($ps); ?>
                                                            </label>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Прочие условия -->
                                    <div class="filter__section">
                                        <a class="filter__btn collapsed" data-bs-toggle="collapse" href="#filter2" role="button" aria-expanded="false">
                                            Прочие условия
                                            <div class="filter__btn-icon">
                                                <svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 6h-.4C4.4 5.8 3.5 5 2 3.5L.3 1.7C-.1 1.3-.1.7.3.3c.4-.4 1-.4 1.4 0l1.7 1.8C4.6 3.2 5.3 3.9 5.8 4h.4c.5-.1 1.2-.8 2.4-1.9L10.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L10 3.5C8.5 5 7.6 5.8 6.4 6H6Z"></path>
                                                </svg>
                                            </div>
                                        </a>
                                        <div class="collapse" id="filter2">
                                            <div class="filter__content">
                                                <ul class="filter__list">
                                                    <?php
                                                    $other_conditions = [
                                                        'Без справок о доходе',
                                                        'Бесплатное снятие наличных',
                                                        'С кэшбеком',
                                                        '0 ₽ обслуживание',
                                                        'С 18 лет',
                                                        'Рассрочка 0 %',
                                                        'Срочное решение',
                                                        '% на остаток',
                                                    ];
                                                    foreach ($other_conditions as $index => $oc):
                                                        ?>
                                                        <li class="filter__list-item">
                                                            <label class="checkbox">
                                                                <input type="checkbox" name="os<?php echo $index + 1; ?>">
                                                                <span class="checkbox__icon">
                                                                    <svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path>
                                                                    </svg>
                                                                </span>
                                                                <?php echo esc_html($oc); ?>
                                                            </label>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="btn btn-outline-primary btn-block submit-button">Применить фильтр</div>
                            </form>

                            <!-- Дополнительные фильтры для десктопа -->
                            <div class="d-none d-lg-block">
                                <?php
                                $args = array(
                                    'hide_empty' => true,
                                    'taxonomy'  => 'tags-category',
                                );

                                $cats = get_categories($args);
                                if ($cats):
                                    foreach ($cats as $cat):
                                        $parent_category = [81, 87, 99, 72];
                                        if (in_array($cat->term_id, $parent_category)) continue;

                                        $args_coll = array(
                                            'post_type'      => 'collection',
                                            'taxonomy'       => 'tags-category',
                                            'tax_query'      => [
                                                [
                                                    'taxonomy' => 'tags-category',
                                                    'terms'    => $cat->term_id,
                                                    'field'    => 'id',
                                                    'operator' => 'IN',
                                                ]
                                            ],
                                            'posts_per_page' => -1,
                                            'orderby'        => 'date',
                                            'order'          => 'DESC',
                                            'meta_query'     => array(
                                                array(
                                                    'key'     => 'coll-type',
                                                    'value'   => 'creditcard',
                                                    'compare' => '=',
                                                ),
                                            )
                                        );
                                        $query_coll = new WP_Query($args_coll);
                                        if ($query_coll->have_posts()):
                                            ?>
                                            <?php get_template_part('all_template/filter_right', null, ['cat' => $cat, 'query' => $query_coll]); ?>
                                            <?php
                                        endif;
                                        wp_reset_postdata();
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- / Фильтр -->

                    <?php
                    // Пагинация
                    $paged = max(1, get_query_var('paged'));
                    $args_posts = array(
                        'paged'        => $paged,
                        'orderby'      => 'name',
                        'order'        => 'DESC',
                        'post_type'    => 'bankcard',
                        'tax_query'    => array(
                            array(
                                'taxonomy' => 'bankcards',
                                'field'    => 'slug',
                                'terms'    => 'creditcard',
                            ),
                        ),
                        'post_status'  => 'publish',
                        'meta_query'   => array(
                            array(
                                'key'   => 'archive',
                                'value' => '0',
                            ),
                        ),
                    );

                    $query_posts = new WP_Query($args_posts);

                    if ($query_posts->have_posts()):
                        $max_pages    = $query_posts->max_num_pages;
                        $found_posts  = $query_posts->found_posts;
                        $counter      = 0;
                        ob_start();
                        while ($query_posts->have_posts()):
                            $query_posts->the_post();
                            $counter++;
                            get_template_part('template-parts/filter-cred-card-posts');
                        endwhile;
                        $posts_html = ob_get_clean();
                    else:
                        $posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
                    endif;

                    // Установка глобальных переменных для пагинации
                    $GLOBALS['wp_query']->max_num_pages = $query_posts->max_num_pages;
                    $max_pages = $query_posts->max_num_pages;
                    ?>

                    <!-- Список кредитных карт -->
                    <div class="col-12 col-lg-8 order-lg-1">
                        <div class="credits__list">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mt-0 mt-md-5 mt-lg-0 mb-3">
                                <div class="h2 mt-5 mb-4 mt-md-0 mb-md-0">
                                    <span class="variants_count"><?php echo intval($query_posts->found_posts); ?></span> вариантов
                                </div>
                                <div class="credits__list-dropdown dropdown mb-3 mb-md-0 col-12 col-md-5 col-lg-4 px-0">
                                    <select name="" class="styledSelect cred-order-select">
                                        <option value="" selected disabled>Сортировать</option>
                                        <option value="ratings_average">По рейтингу</option>
                                        <option value="views">По количеству заявок</option>
                                        <option value="card_cred_limit">По кредитному лимиту</option>
                                        <option value="card_day_period">По льготному периоду</option>
                                        <option value="card_stavka">По процентной ставке</option>
                                    </select>
                                </div>
                            </div>

                            <div data-json='<?php echo json_encode($args_posts); ?>' class="list_posts" id="response-cred-card">
                                <?php echo $posts_html; ?>
                            </div>

                            <!-- Пагинация -->
                            <div class="pagination flex-column mb-5 mb-md-0">
                                <?php if($paged < $max_pages): ?>
                                    <button class="btn btn-outline-gray btn-block load_more_btn"
                                            data-max_pages="<?php echo intval($max_pages); ?>" data-paged="<?php echo intval($paged); ?>">
                                        Больше решений
                                    </button>
                                <?php endif; ?>
                                <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                                    <div class="pagination__links">
                                        <?php my_pagination(); ?>
                                    </div>

                                    <?php wp_reset_postdata(); ?>
                                    <div class="pagination__description mt-4 mt-sm-0">
                                        Показано <span class="count_view"><?php echo intval($counter); ?></span>
                                        продуктов из <span class="count_all"><?php echo intval($query_posts->found_posts); ?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- / Пагинация -->

                            <!-- Архивные кредитные карты -->
                            <?php
                            $args_archive = array(
                                'post_type'     => 'bankcard',
                                'posts_per_page'=> -1,
                                'meta_key'      => 'archive',
                                'meta_value'    => true,
                                'tax_query'     => array(
                                    array(
                                        'taxonomy' => 'bankcards',
                                        'field'    => 'slug',
                                        'terms'    => 'creditcard',
                                    ),
                                ),
                            );
                            $query_archive = new WP_Query($args_archive);
                            if ($query_archive->have_posts()):
                                ?>
                                <h2 class="title archive_title mt-5">Архивные кредитные карты (<?php echo intval($query_archive->found_posts); ?>)</h2>
                                <div class="list_posts archive_list archive_hide">
                                    <?php while ($query_archive->have_posts()): $query_archive->the_post(); ?>
                                        <?php get_template_part('template-parts/filter-cred-card-posts'); ?>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Дополнительные фильтры для мобильных устройств -->
                            <div class="d-xs-block d-lg-none">
                                <?php
                                $args_tags = array(
                                    'hide_empty' => true,
                                    'taxonomy'   => 'tags-category',
                                );

                                $cats = get_categories($args_tags);
                                if ($cats):
                                    foreach ($cats as $cat):
                                        $parent_category = [81, 87, 99, 72];
                                        if (in_array($cat->term_id, $parent_category)) continue;

                                        $args_coll = array(
                                            'post_type'      => 'collection',
                                            'taxonomy'       => 'tags-category',
                                            'tax_query'      => [
                                                [
                                                    'taxonomy' => 'tags-category',
                                                    'terms'    => $cat->term_id,
                                                    'field'    => 'id',
                                                    'operator' => 'IN',
                                                ]
                                            ],
                                            'posts_per_page' => -1,
                                            'orderby'        => 'date',
                                            'order'          => 'DESC',
                                            'meta_query'     => array(
                                                array(
                                                    'key'     => 'coll-type',
                                                    'value'   => 'creditcard',
                                                    'compare' => '=',
                                                ),
                                            )
                                        );
                                        $query_coll = new WP_Query($args_coll);
                                        if ($query_coll->have_posts()):
                                            ?>
                                            <?php get_template_part('all_template/filter_right', null, ['cat' => $cat, 'query' => $query_coll, 'mobile' => 1]); ?>
                                            <?php
                                        endif;
                                        wp_reset_postdata();
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- / Список кредитов -->

                    <!-- Лучшая коллекция -->
                    <div class="col-12 col-lg-8 order-lg-1">
                        <!-- Список кредитных карт уже представлен выше -->
                        <!-- Здесь может быть дополнительный контент -->
                    </div>
                    <!-- / Лучшая коллекция -->
                </div>
            </div>
            <!-- / Список кредитов -->

            <!-- Статьи о кредитных картах -->
            <div class="section">
                <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="title mb-0">Статьи о кредитных картах</h2>
                    <a href="<?php echo esc_url(get_category_link(32)); ?>" class="btn btn-primary btn-sm btn-all">
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
                        $args_articles = array(
                            'post_type'      => 'post',
                            'cat'            => 32,
                            'posts_per_page' => 4,
                        );
                        $query_articles = new WP_Query($args_articles);
                        if ($query_articles->have_posts()) {
                            while ($query_articles->have_posts()) {
                                $query_articles->the_post();
                                ?>
                                <!-- item -->
                                <div class="article__item card card__vertical size4 offer h-100">
                                    <div class="card-container p-3 d-xl-flex flex-xl-column">
                                        <?php if(get_the_post_thumbnail_url()): ?>
                                            <div class="card__image">
                                                <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"
                                                     alt="<?php echo esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="card__date my-2"><?php echo esc_html(get_the_date('d.m.Y')); ?></div>
                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="article__title h4 stretched-link"><?php echo esc_html(get_the_title()); ?></a>
                                        <div class="mt-auto">
                                            <div class="d-flex align-items-center mt-2">
                                                <div class="card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2">
                                                        <svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
                                                            <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#eye" x="0" y="0"></use>
                                                        </svg>
                                                    </div>
                                                    <?php echo intval(get_field('views')); ?>
                                                </div>
                                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2">
                                                        <a href="<?php echo esc_url(get_permalink()); ?>#comments" data-target="comments" class="stretched-link">
                                                            <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php echo esc_html(comments_number('0', '1', '%')); ?>
                                                </div>
                                                <div class="card__like d-flex align-items-center ml-auto">
                                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                </div>
                                            </div>
                                            <?php
                                            $author_id = get_field('page_author');
                                            if ($author_id):
                                                ?>
                                                <div class="card__author d-flex align-items-center mt-3">
                                                    <div class="card__author-img mr-3">
                                                        <?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                                    </div>
                                                    <div class="card__author-content">
                                                        <a href="<?php echo esc_url(get_permalink($author_id)); ?>" class="card__author-title"><?php echo esc_html(get_the_title($author_id)); ?></a>
                                                        <div class="rating d-flex align-items-center">
                                                            <?php echo do_shortcode('[ratings id="' . intval($author_id) . '"]'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- / item -->
                                <?php
                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
            <!-- / Статьи о кредитных картах -->

<!-- Отзывы о кредитных картах -->
<div class="section">
    <div class="section__header d-flex justify-content-between align-items-center mb-4">
        <h2 class="title mb-0">Отзывы о кредитных картах</h2>
        <a href="<?php echo esc_url(get_page_link(4969)); ?>" class="btn btn-primary btn-sm btn-all" data-tax="creditcard">
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
            global $wpdb; // Обязательно используйте глобальный объект $wpdb
            $ppp = 3; // Количество отзывов на страницу
            $custom_offset = 0;

            // Получение ID постов в термине 'creditcard'
            $posts = get_objects_in_term($term->term_id, 'bankcards');

            if (!empty($posts)) {
                $placeholders = implode(',', array_fill(0, count($posts), '%d'));
                $sql = $wpdb->prepare(
                    "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                     FROM {$wpdb->comments}
                     WHERE comment_post_ID IN ($placeholders)
                       AND comment_approved = 1
                       AND comment_parent = 0
                     ORDER BY comment_date DESC
                     LIMIT %d OFFSET %d",
                    array_merge($posts, [$ppp, $custom_offset])
                );

                $comments_list = $wpdb->get_results($sql);

                if (count($comments_list) > 0) {
                    foreach ($comments_list as $comm) {
                        $comment_id       = $comm->comment_ID;
                        $comment_post_id  = $comm->comment_post_ID;
                        $comment          = get_comment($comment_id);
                        $bank_id          = get_field('bank_choise', $comment_post_id);
                        $user             = get_userdata($comment->user_id);
                        $author           = get_comment_author($comment_id);
                        $city             = get_comment_meta($comment_id, 'city', true);
                        ?>
                        <!-- item -->
                        <div class="reviews__item">
                            <div class="reviews__item-body">
                                <div class="reviews__header d-flex align-items-center mb-2">
                                    <div class="reviews__header-logo">
                                        <img src="<?php echo esc_url(get_field('bank_logo', $bank_id)); ?>"
                                             alt="<?php echo esc_attr(get_post_meta(get_field('bank_logo', $bank_id), '_wp_attachment_image_alt', true)); ?>">
                                    </div>
                                    <div class="reviews__header-meta ml-3">
                                        <a href="<?php echo esc_url(get_comment_link($comment_id)); ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo esc_html(get_the_title($bank_id)); ?></a>
                                        <div class="d-flex">
                                            <div class="card__rating d-flex align-items-center mr-3">
                                                <div class="mr-2">
                                                    <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                <?php echo esc_html(get_field('ratings_average', $bank_id)); ?>
                                            </div>
                                            <div class="card__icon d-flex align-items-center">
                                                <div class="mr-2">
                                                    <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                <?php echo esc_html(comments_number('0', '1', '%', $bank_id)); ?>
                                            </div>
                                            <div class="card__date d-none d-md-block ml-auto">
                                                <?php echo esc_html(get_comment_date('d.m.Y', $comment_id)); ?> / <?php echo esc_html(get_comment_date('H:i', $comment_id)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="reviews__item-content">
                                    <p><?php echo esc_html($comment->comment_content); ?></p>
                                </div>
                            </div>
                            <div class="reviews__item-footer">
                                <div class="reviews__author d-flex align-items-center mt-3">
                                    <div class="reviews__author-img mr-3">
                                        <img src="<?php echo esc_url(get_avatar_url($comment, array('size' => 60, 'default' => 'identicon'))); ?>" alt="<?php echo esc_attr($author); ?>">
                                    </div>
                                    <div class="reviews__author-content">
                                        <a href="<?php echo esc_url(get_permalink($author_id)); ?>" class="reviews__author-title mb-2 d-block stretched-link"><?php echo esc_html($author); ?></a>
                                        <div class="reviews__author-info d-flex">
                                            <div class="card__icon d-flex align-items-center mr-3">
                                                <div class="mr-2">
                                                    <svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#person" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                <?php
                                                if(empty($user->roles[0])):
                                                    echo 'Гость';
                                                else:
                                                    echo esc_html($user->roles[0]);
                                                endif;
                                                ?>
                                            </div>
                                            <?php if(!empty($city)): ?>
                                                <div class="card__icon d-flex align-items-center">
                                                    <div class="mr-2">
                                                        <svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                            <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                                        </svg>
                                                    </div>
                                                    <?php echo esc_html($city); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / item -->
                        <?php
                    }
                } else {
                    ?>
                    <p class="col-12">Пока нет отзывов.</p>
                <?php
                }
            } else {
                ?>
                <p class="col-12">Пока нет отзывов.</p>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- / Отзывы о кредитных картах -->


            <!-- Лучшие предложения -->
            <div class="section" id="best-products">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Лучшие предложения</h2>
                    <a href="#" class="btn btn-primary btn-sm btn-all">
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
                        $args_best_offers = array(
                            'post_type'      => 'bankcard',
                            'posts_per_page' => 4,
                            'meta_key'       => 'ratings_average',
                            'orderby'        => 'meta_value_num',
                            'order'          => 'DESC',
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'bankcards',
                                    'field'    => 'slug',
                                    'terms'    => 'creditcard',
                                ),
                            ),
                        );
                        $query_best = new WP_Query($args_best_offers);

                        if ($query_best->have_posts()) {
                            while ($query_best->have_posts()) {
                                $query_best->the_post();

                                // Проверка параметра 'test'
                                if(isset($_GET['test']) && $_GET['test']):
                                    $posttype = get_term(get_the_ID());
                                    print_r2($posttype);
                                    echo 123;
                                endif;
                                ?>

                                <!-- item -->
                                <div class="card card__vertical size4 offer h-100">
                                    <div class="card-container p-3">
                                        <div class="card__header mb-2 d-flex">
                                            <div class="card__header-img">
                                                <img src="<?php echo esc_url(get_field('bank_logo', get_field('bank_choise'))); ?>"
                                                     alt="<?php echo esc_attr(get_post_meta(get_field('bank_logo', get_field('bank_choise')), '_wp_attachment_image_alt', true)); ?>">
                                            </div>
                                            <div class="card__header-title">
                                                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                            </div>
                                        </div>
                                        <div class="card__header-info d-flex align-items-center">
                                            <div class="card__rating d-flex align-items-center mr-3">
                                                <div class="mr-2">
                                                    <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                <?php echo esc_html(get_field('ratings_average')); ?>
                                            </div>
                                            <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                <div class="mr-2">
                                                    <a href="<?php echo esc_url(get_permalink()); ?>#comments" data-target="comments" class="stretched-link">
                                                        <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                            <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <?php 
                                                $comments_count_best = wp_count_comments(get_the_ID());
                                                echo intval($comments_count_best->approved);
                                                ?>
                                            </div>
                                            <div class="card__like d-flex align-items-center">
                                                <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                            </div>
                                            <div class="card__header-actions ml-auto">
                                                <a href="#">
                                                    <svg width="20" height="20" viewBox="0 0 20 20">
                                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#circledots" x="0" y="0"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="card__image my-3">
                                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                                <img src="<?php echo esc_url(get_field('card_logo')); ?>"
                                                     alt="<?php echo esc_attr(get_post_meta(get_field('card_logo'), '_wp_attachment_image_alt', true)); ?>">
                                            </a>
                                        </div>

                                        <ul class="leaders">
                                            <li class="leaders__item mb-1">
                                                <div class="leaders__item-title">Лимит</div>
                                                <div class="leaders__item-value"><?php echo esc_html(get_field('card_cred_limit')); ?> р</div>
                                            </li>
                                            <li class="leaders__item mb-1">
                                                <div class="leaders__item-title">Без %</div>
                                                <div class="leaders__item-value"><?php echo esc_html(get_field('card_period')['label'] ?? ''); ?></div>
                                            </li>
                                            <li class="leaders__item mb-1">
                                                <div class="leaders__item-title">Кэшбек</div>
                                                <div class="leaders__item-value"><?php echo esc_html(get_field('card_cashback')); ?></div>
                                            </li>
                                            <li class="leaders__item mb-1">
                                                <div class="leaders__item-title">Ставка</div>
                                                <div class="leaders__item-value">от <?php echo esc_html(get_field('card_stavka')); ?>%</div>
                                            </li>
                                        </ul>

                                        <div class="card__actions mt-3 d-flex">
                                            <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                                            <a href="#" class="btn__compare btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo esc_attr(get_the_ID()); ?>" data-tax="creditcard">
                                                <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve">
                                                    <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#stats" x="0" y="0"></use>
                                                </svg>
                                            </a>
                                        </div>

                                        <div class="card__footer mt-3">
                                            <p>
                                                <span><?php echo esc_html(get_field('bank_phone', get_field('bank_choise'))); ?></span>
                                                <span><?php echo esc_html(get_field('bank_email', get_field('bank_choise'))); ?></span>
                                                <span>Лицензия: <?php echo esc_html(get_field('bank_license', get_field('bank_choise'))); ?></span>
                                                <span><?php echo esc_html(get_field('views', get_the_ID())); ?> заявок</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- / item -->
                                <?php
                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
            <!-- / Лучшие предложения -->

            <!-- FAQ -->
            <?php if( have_rows('type_faq', $term) ): ?>
                <div class="section">
                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0">Часто задаваемые вопросы</h2>
                    </div>
                    <div class="accordion" id="accordion">
                        <?php 
                        $counter = 0; 
                        while( have_rows('type_faq', $term) ): the_row();
                            $question = get_sub_field('question');
                            $answer   = get_sub_field('answer');
                            $counter += 1;
                            ?>
                            <div class="accordion__item">
                                <div class="accordion__header">
                                    <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse__item-<?php echo intval($counter); ?>" aria-expanded="false">
                                        <?php echo esc_html($question); ?>
                                        <div class="accordion__button-icon">
                                            <svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                    </button>
                                </div>
                                <div id="collapse__item-<?php echo intval($counter); ?>" class="accordion__collapse collapse" data-bs-parent="#accordion">
                                    <div class="accordion__body">
                                        <p><?php echo esc_html($answer); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- / FAQ -->

            <!-- WYSIWYG текст -->
            <div class="section">
                <div class="wysiwyg">
                    <?php echo esc_html(get_field('type_desc', $term)); ?>
                </div>
                <?php
                $date_actually = get_the_modified_date('d.m.Y', $ID);
                if($date_actually):
                    ?>
                    <div class="date_actually-article mb-2">Обновлено: <?php echo esc_html($date_actually); ?></div>
                <?php endif; ?>
            </div>
            <!-- / WYSIWYG текст -->
        </div>
    </main>

    <?php get_footer(); ?>

<?php endif; ?>
