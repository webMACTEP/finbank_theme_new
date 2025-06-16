<?php get_header(); ?>

<?php
// Параметры страницы
$tax_id       = 2;
$title_term1  = "Отзывы о микрозаймах";
$title_term2  = "все займы";
$calc_link    = get_page_link(159);
$link         = get_post_type_archive_link('zaimy');
$news_id      = "12";
?>

<main>
    <div class="container">
        <nav aria-label="breadcrumb" class="horizontal__scroll">
            <ol class="breadcrumb horizontal__scroll-container">
                <li class="breadcrumb-item"><a href="<?php echo esc_url(get_home_url()); ?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title_term1); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
            </ol>
        </nav>
    </div>

    <!-- page header -->
    <div class="page__heading mb-4">
        <div class="container">
            <div class="page__heading-top d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page__heading-title mb-0"><?php echo esc_html($title_term1); ?></h1>
                    <div class="font-weight-semibold mt-2 mb-0">Благодаря честным отзывам вы сможете осуществить более разумный выбор</div>
                </div>
                <div class="page__heading-icon"><img src="<?php bloginfo('template_url'); ?>/img/icon__title-like.png" alt=""></div>
            </div>
        </div>
    </div>
    <!-- / page header -->

    <div class="container">
        <div class="row reviews-page-list" id="reviews">
            <?php
            // Получаем первую "партию" комментариев
            $paged  = max(1, get_query_var('paged'));
            $ppp    = 15;
            $offset = ($paged - 1) * $ppp;

            global $wpdb;
            $posts = get_cpt_ids('zaimy');
            $in    = implode(',', array_map('absint', $posts));

            $sql = "
                SELECT comment_ID, comment_date, comment_content, comment_post_ID
                FROM {$wpdb->comments}
                WHERE comment_post_ID IN ({$in})
                  AND comment_approved = 1
                  AND comment_parent = 0
                ORDER BY comment_date DESC
                LIMIT %d OFFSET %d
            ";
            $first_comments_batch = $wpdb->get_results($wpdb->prepare($sql, $ppp, $offset));

            // Подключаем шаблон списка
            get_template_part('all_template/reviews_list', null, [
                'TYPE' => 'zaimy',
                'DATA' => $first_comments_batch,
            ]);
            ?>
        </div>

        <?php
        // Рендерим AJAX-пагинацию

        my_comments_ajax_pagination(null, $paged, $ppp);

        ?>
       

    </div>
</main>

<?php get_footer(); ?>