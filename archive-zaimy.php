<?php
// Инициализация переменной $query__card
$query__card = get_field('archive') ? '' : 'query__card';

// Получение поля 'apply_now_select_products'
$apply_now = get_field('apply_now_select_products', get_the_ID());

// Инициализация пагинации
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Аргументы для WP_Query
$items_args = array(
    'paged' => $paged,
    'orderby' => 'name',
    'order' => 'DESC',
    'post_type' => 'zaimy',
    'post_status' => 'publish',
    'meta_query' => array(
        array(
            'key' => 'archive',
            'value' => '0',
            'compare' => '=', // Рекомендуется явно указать оператор сравнения
        )
    )
);

// Создание нового запроса
$query_items = new WP_Query( $items_args );

// Проверка наличия постов
if ( !$query_items->have_posts() ) {
    global $wp_query;
    $url_clear = get_clear_url( $_SERVER['REQUEST_URI'] );
    wp_redirect( $url_clear, 301 );
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

    if ( isset($_SESSION['filter_zaimy']) && !empty($_SESSION['filter_zaimy']) ) {
        $mt = 1;
        $z_sum = sanitize_text_field($_SESSION['filter_zaimy'][0]);
        $z_time = sanitize_text_field($_SESSION['filter_zaimy'][1]);
    }
    unset($_SESSION['filter_zaimy']);
    ?>

    <?php if (isset($mt) && $mt): ?>
        <div class="start-func-credit-card-filter"></div>
    <?php endif; ?>

    <main term="zaimy">
        <div class="container">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" class="horizontal__scroll">
                <ol class="breadcrumb horizontal__scroll-container">
                    <li class="breadcrumb-item"><a href="<?php echo esc_url( get_home_url() ); ?>">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Займы</li>
                </ol>
            </nav>
        </div>
        <div class="page__heading">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="page__heading-title mb-0">Займы</h1>
                    <?php
                    // Получение последней даты обновления
                    $args = array(
                        'post_type'      => 'zaimy',
                        'posts_per_page' => 1,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        $query->the_post();
                        $date = get_the_date('d.m.Y');
                        wp_reset_postdata();
                    }
                    ?>
                    <div class="page__heading-date">Обновлено: <?php echo esc_html( $date ); ?></div>
                </div>
                <div class="page__heading-description mt-2 mb-4">
                    В данном разделе вы можете оформить займ по вашим финансовым возможностям
                </div>

                <!-- Форма фильтрации -->
                <form id="credit-card-filter" action="" method="POST">
                    <input type="hidden" name="action" value="cardfilter" />
                    <input type="hidden" name="term" value="zaimy" />
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3 col-xl-4 order-1">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Сумма, ₽</div>
                                    <input type="text" class="range__value cred_limit" max="<?php echo esc_attr( $filter_price['zaimy_inputs_range']['max'] ); ?>" value="<?php echo esc_attr( $z_sum ); ?>">
                                </div>
                                <input class="range__input" name="z_sum" type="range" max="<?php echo esc_attr( $filter_price['zaimy_inputs_range']['max'] ); ?>" value="<?php echo esc_attr( $z_sum ); ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 col-xl-4 order-2">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Срок, дней</div>
                                    <input type="text" class="range__value cred_trat" max="<?php echo esc_attr( $filter_price['zaimy_inputs_range']['day_max'] ); ?>" value="<?php echo esc_attr( $z_time ); ?>">
                                </div>
                                <input class="range__input" name="z_time" type="range" max="<?php echo esc_attr( $filter_price['zaimy_inputs_range']['day_max'] ); ?>" value="<?php echo esc_attr( $z_time ); ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 col-xl-2 mt-lg-0 order-5 order-md-3">
                            <button type="submit" class="btn btn-primary btn-block submit-button">Показать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Page Navigation -->
        <div class="page__nav">
            <div class="container">
                <div class="page__nav-container nav-tabs">
                    <div class="horizontal__scroll">
                        <div class="horizontal__scroll-container">
                            <a href="<?php echo esc_url( get_post_type_archive_link('zaimy') ); ?>" class="nav-link active">Все займы</a>
                            <a href="<?php echo esc_url( get_page_link(4975) ); ?>" class="nav-link" data-tax="zaimy">Отзывы</a>
                            <a href="<?php echo esc_url( get_page_link(159) ); ?>" class="nav-link">Калькулятор</a>
                            <a href="<?php echo esc_url( get_category_link(38) ); ?>" class="nav-link">Статьи</a>
                            <a href="<?php echo esc_url( get_page_link(1554) ); ?>" class="nav-link">Сравнить</a>
                            <a href="#best-products" class="nav-link">Лучшие предложения</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Page Navigation -->

        <div class="container">
            <!-- Credits List -->
            <div class="credits section">
                <div class="row">
                    <!-- Фильтр -->
                    <div class="col-12 col-lg-4 order-lg-2">
                        <div class="sticky-top">
                            <!-- Форма фильтрации в боковой панели -->
                            <form id="credit-card-filter-aside">
                                <!-- Ваши фильтры -->
                                <!-- ... -->
                                <div class="btn btn-outline-primary btn-block submit-button">Применить фильтр</div>
                            </form>

                            <!-- Дополнительные фильтры -->
                            <div class="d-none d-lg-block">
                                <?php
                                $args = array(
                                    'hide_empty' => true,
                                    'taxonomy'  => 'tags-category',
                                );

                                $cats = get_categories($args);
                                if ($cats) {
                                    foreach ($cats as $cat) {
                                        $parent_category = array(81, 87, 99, 72);
                                        if (in_array($cat->term_id, $parent_category)) continue;

                                        $args_coll = array(
                                            'post_type'      => 'collection',
                                            'tax_query'      => array(
                                                array(
                                                    'taxonomy' => 'tags-category',
                                                    'terms'    => $cat->term_id,
                                                    'field'    => 'term_id',
                                                    'operator' => 'IN',
                                                )
                                            ),
                                            'posts_per_page' => -1,
                                            'orderby'        => 'date',
                                            'order'          => 'DESC',
                                            'meta_query'     => array(
                                                array(
                                                    'key'     => 'coll-type',
                                                    'value'   => 'zaimy',
                                                    'compare' => '=',
                                                ),
                                            )
                                        );
                                        $query = new WP_Query($args_coll);
                                        if ($query->have_posts()) {
                                            ?>
                                            <?php get_template_part('all_template/filter_right', null, ['cat' => $cat, 'query' => $query]); ?>
                                            <?php
                                        }
                                        wp_reset_postdata();
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- / Фильтр -->

                    <?php
                    // Инициализация счетчика
                    $counter = 0;

                    // Проверяем, есть ли посты в запросе
                    if ( $query_items->have_posts() ) {
                        // Используем существующий объект запроса
                        $query = $query_items;
                        $max_pages   = $query->max_num_pages;
                        $found_posts = $query->found_posts;

                        // Начинаем буферизацию вывода
                        ob_start();

                        // Проходим по всем постам в запросе
                        while ( $query->have_posts() ) {
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

                    <!-- Список кредитных предложений -->
                    <div class="col-12 col-lg-8 order-lg-1">
                        <div class="credits__list">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mt-0 mt-md-5 mt-lg-0 mb-3">
                                <div class="h2 mt-5 mb-4 mt-md-0 mb-md-0">
                                    <span class="variants_count"><?php echo esc_html( $query->found_posts ); ?></span> вариантов
                                </div>
                                <div class="credits__list-dropdown dropdown mb-3 mb-md-0 col-12 col-md-5 col-lg-4 px-0">
                                    <select name="order" class="styledSelect cred-order-select">
                                        <option value="" selected disabled>Сортировать</option>
                                        <option value="ratings_average">По рейтингу</option>
                                        <option value="views">По количеству заявок</option>
                                        <option value="z_sum">По сумме займа</option>
                                        <option value="z_stavka">По процентной ставке</option>
                                    </select>
                                </div>
                            </div>
                            <div data-json='<?php echo json_encode($args); ?>' class="list_posts" id="response-cred-card">
                                <?php
                                // Используйте полный тег PHP
                                echo $posts_html;
                                ?>
                            </div>

                            <!-- Пагинация -->
                            <div class="pagination flex-column mb-5 mb-md-0">
                                <?php if ( $paged < $max_pages ): ?>
                                    <button class="btn btn-outline-gray btn-block load_more_btn"
                                        data-max_pages="<?php echo esc_attr( $max_pages ); ?>" data-paged="<?php echo esc_attr( $paged ); ?>">
                                        Больше решений
                                    </button>
                                <?php endif; ?>
                                <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                                    <div class="pagination__links">
                                        <?php my_pagination( $max_pages ); ?>
                                    </div>
                                    <div class="pagination__description mt-4 mt-sm-0">
                                        Показано <span class="count_view"><?php echo esc_html( $counter ); ?></span>
                                        продуктов из <span class="count_all"><?php echo esc_html( $query->found_posts ); ?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- / Пагинация -->

                            <?php
                            // Запрос архивных займов
                            $args_archive = array(
                                'post_type'      => 'zaimy',
                                'posts_per_page' => -1,
                                'meta_key'       => 'archive',
                                'meta_value'     => true,
                            );
                            $query_archive = new WP_Query( $args_archive );
                            if ( $query_archive->have_posts() ): ?>
                                <h2 class="title archive_title mt-5">Архивные займы (<?php echo esc_html( $query_archive->found_posts ); ?>)</h2>
                                <div class="list_posts archive_list archive_hide">
                                    <?php while ( $query_archive->have_posts() ): $query_archive->the_post(); ?>
                                        <?php get_template_part('template-parts/filter-zaimy-posts'); ?>
                                    <?php endwhile;
                                    wp_reset_postdata(); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Дополнительные фильтры для мобильных -->
                            <div class="d-xs-block d-lg-none">
                                <?php
                                $args = array(
                                    'hide_empty' => true,
                                    'taxonomy'  => 'tags-category',
                                );

                                $cats = get_categories($args);
                                if ($cats) {
                                    foreach ($cats as $cat) {
                                        $parent_category = array(81, 87, 99, 72);
                                        if (in_array($cat->term_id, $parent_category)) continue;

                                        $args_coll = array(
                                            'post_type'      => 'collection',
                                            'tax_query'      => array(
                                                array(
                                                    'taxonomy' => 'tags-category',
                                                    'terms'    => $cat->term_id,
                                                    'field'    => 'term_id',
                                                    'operator' => 'IN',
                                                )
                                            ),
                                            'posts_per_page' => -1,
                                            'orderby'        => 'date',
                                            'order'          => 'DESC',
                                            'meta_query'     => array(
                                                array(
                                                    'key'     => 'coll-type',
                                                    'value'   => 'zaimy',
                                                    'compare' => '=',
                                                ),
                                            )
                                        );
                                        $query = new WP_Query($args_coll);
                                        if ($query->have_posts()) {
                                            ?>
                                            <?php get_template_part('all_template/filter_right', null, ['mobile' => 1, 'cat' => $cat, 'query' => $query]); ?>
                                            <?php
                                        }
                                        wp_reset_postdata();
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- / Список кредитных предложений -->

                </div>
            </div>
            <?php wp_reset_postdata(); ?>
            <!-- / Credits List -->

            <!-- Articles Section -->
            <div class="section">
                <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="title mb-0">Статьи о займах</h2>
                    <a href="<?php echo esc_url( get_category_link(38) ); ?>" class="btn btn-primary btn-sm btn-all">
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
                            'post_type'      => 'post',
                            'cat'            => 38,
                            'posts_per_page' => 4,
                            'meta_key'       => 'views',
                            'orderby'        => array(
                                'meta_value_num' => 'DESC',
                                'name'           => 'DESC',
                            ),
                            'order'          => 'DESC',
                        );
                        get_template_part('all_template/article_list', null, $args);
                        ?>
                    </div>
                </div>
            </div>
            <!-- / Articles Section -->

            <!-- Reviews Section -->
            <div class="section">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Отзывы о займах</h2>
                    <a href="<?php echo esc_url( get_page_link(4975) ); ?>" class="btn btn-primary btn-sm btn-all" data-tax="zaimy">
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
                        $ppp = 3; // Количество отзывов
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
            </div>
            <!-- / Reviews Section -->

            <!-- Best Offers Section -->
            <div class="section" id="best-products">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Лучшие предложения</h2>
                    <a href="<?php echo esc_url( get_post_type_archive_link('zaimy') ); ?>" class="btn btn-primary btn-sm btn-all">
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
                            'post_type'       => 'zaimy',
                            'posts_per_page'  => 4,
                            'meta_key'        => 'ratings_average',
                            'orderby'         => 'meta_value_num',
                            'order'           => 'DESC',
                        );

                        get_template_part('all_template/the_best_offers_list', null, $args);
                        ?>
                    </div>
                </div>
            </div>
            <!-- / Best Offers Section -->

            <!-- FAQ Section -->
            <?php if ( have_rows('zaimy_faq', 'options') ): ?>
                <div class="section">
                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0">Часто задаваемые вопросы</h2>
                    </div>
                    <div class="accordion" id="accordion">
                        <?php $faq_counter = 0; ?>
                        <?php while ( have_rows('zaimy_faq', 'options') ): the_row();
                            $question = get_sub_field('question');
                            $answer = get_sub_field('answer');
                            $faq_counter++;
                        ?>
                            <div class="accordion__item">
                                <div class="accordion__header">
                                    <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse__item-<?php echo esc_attr( $faq_counter ); ?>" aria-expanded="false">
                                        <?php echo esc_html( $question ); ?>
                                        <div class="accordion__button-icon">
                                            <svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/img/icons.svg#arrow' ); ?>" width="12" height="6" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                    </button>
                                </div>
                                <div id="collapse__item-<?php echo esc_attr( $faq_counter ); ?>" class="accordion__collapse collapse" data-bs-parent="#accordion">
                                    <div class="accordion__body">
                                        <p><?php echo esc_html( $answer ); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- / FAQ Section -->

            <!-- WYSIWYG Text Section -->
            <div class="section">
                <div class="wysiwyg">
                    <?php echo wp_kses_post( get_field('zaimy_desc', 'options') ); ?>
                </div>
            </div>
            <!-- / WYSIWYG Text Section -->
        </div>
    </main>

    <?php get_footer(); ?>

<?php } ?>
