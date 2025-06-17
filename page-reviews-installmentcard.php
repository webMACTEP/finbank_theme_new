<?php get_header() ?>

<?php
$tax_id = 8; // Таксономия для карт рассрочки
$title_term1 = "Отзывы о картах рассрочки";
$title_term2 = "все карты рассрочки";
$calc_link = get_page_link(149);  // Страница калькулятора
$news_id = "15"; // ID категории для статей
$link = get_term_link($tax_id, 'bankcards');  // Получаем ссылку на таксономию
$bank_field = 'bank_choise';  // Поле для баннеров или логотипов банков
?>

<main>
    <div class="container">
        <nav aria-label="breadcrumb" class="horizontal__scroll">
            <ol class="breadcrumb horizontal__scroll-container">
                <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $link ?>"><?php echo $title_term1 ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
            </ol>
        </nav>
    </div>

    <div class="page__heading mb-4">
        <div class="container">
            <div class="page__heading-top d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page__heading-title mb-0"><?php echo $title_term1 ?></h1>
                    <div class="font-weight-semibold mt-2 mb-0">Благодаря честным отзывам вы сможете осуществить более разумный выбор</div>
                </div>
                <div class="page__heading-icon"><img src="<?php bloginfo('template_url'); ?>/img/icon__title-like.png" alt=""></div>
            </div>
        </div>
    </div>

    <div class="page__nav">
        <div class="container">
            <div class="page__nav-container nav-tabs">
                <div class="horizontal__scroll">
                    <div class="horizontal__scroll-container">
                        <a href="<?php echo $link ?>" class="nav-link"><?php echo $title_term2 ?></a>
                        <a href="" class="nav-link active">Отзывы</a>
                        <a href="<?php echo $calc_link ?>" class="nav-link">Калькулятор</a>
                        <a href="<?php echo get_category_link($news_id) ?>" class="nav-link">Статьи</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $ppp = 15;  // Количество постов на странице
    $offset = ($paged - 1) * $ppp;

    // Получаем посты для карт рассрочки
    $posts = get_objects_in_term($tax_id, 'bankcards');

    // Проверка, получаем ли посты
    if (empty($posts)) {
        echo 'Нет постов для карт рассрочки.';
    }

    $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
            FROM {$wpdb->comments} WHERE
            comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1
            ORDER by comment_date DESC LIMIT $ppp OFFSET $offset";

    $sql_posts_total = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->comments} WHERE
            comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1");

    $max_num_pages = ceil($sql_posts_total / $ppp);
    $comments_list = $wpdb->get_results($sql);

    $count_items = count($comments_list);
    ?>

    <div class="container">
        <div class="section">
            <div class="row reviews-page-list" id="reviews">
                <?php
                if ($comments_list) {
                    get_template_part('all_template/reviews_list', null, ['TYPE' => 'bankcards', 'DATA' => $comments_list, 'bank_id__field_name' => 'bank_choise']);
                } else {
                    echo 'Нет отзывов для карт рассрочки.';
                }
                ?>
            </div>

            <!-- pagination -->
            <button
                id="load-more-reviews"
                class="btn btn-outline-gray btn-block mt-5"
                data-page="1"
                data-per-page="<?php echo $ppp; ?>"
                data-total="<?php echo $sql_posts_total; ?>"
                data-taxonomy="installmentcard" 
                data-term-id="<?php echo intval($tax_id); ?>"
                data-field-name="bank_choise">
                Загрузить ещё
            </button>
            <div class="pagination flex-column mb-5 mb-md-0">
                <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                    <div class="pagination__description mt-4 mt-sm-0">
                        Показано <span class="reviews-shown"><?php echo $count_items; ?></span> отзывов из <span class="reviews-total"><?php echo $sql_posts_total; ?></span>
                    </div>
                </div>
            </div>
            <!-- / pagination -->
        </div>
    </div>
</main>

<?php get_footer() ?>
