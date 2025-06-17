<?php get_header() ?>

<?php 

$ID = $_SESSION['post_review_id'];
$TAX = $_SESSION['data_tax_reviews'];
$DISPLAY = $_SESSION['display_type'];

$post_type = get_post_type($ID);
$tags = get_the_tags( $ID );
$terms = wp_get_post_terms( $ID, 'bankcards', array('fields' => 'all') );
if (!empty($terms)):
$term_slug = $terms[0]->slug;
$term_id = $terms[0]->term_id;
endif;

// Отзывы вариант 1

$tax_id = 7;
$title_term1 = "Отзывы о дебетовых картах";
$title_term2 = "все дебетовые карты";
$calc_link = get_page_link(157);
$news_id = "13";
$link = get_term_link($tax_id, '');

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
    <!-- page header -->
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
    <!-- / page header -->
    <!-- page nav -->
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
    <!-- / page nav -->
    <div class="container">
        <div class="section">
            <div class="row reviews-page-list" id="reviews">
                <?php

                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $ppp = 15; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                $offset = ($paged - 1)*$ppp;

                // fetch posts in all those categories
                $posts = get_objects_in_term( $tax_id, 'bankcards' );

                $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                 FROM {$wpdb->comments} WHERE
                 comment_post_ID in (".implode(',', $posts).") AND comment_approved = 1
                 ORDER by comment_date DESC LIMIT $ppp OFFSET $offset";

                $sql_posts_total = $wpdb->get_var( "SELECT  COUNT(*)  FROM {$wpdb->comments} WHERE
                 comment_post_ID in (".implode(',', $posts).") AND comment_approved = 1
                 ORDER by comment_date DESC LIMIT 0, 15");
                $max_num_pages = ceil($sql_posts_total / $ppp);
                $comments_list = $wpdb->get_results( $sql );

                $count_items = count($comments_list);

                get_template_part('all_template/reviews_list', null,
                    ['TYPE' => 'bankcards', 'DATA' => $comments_list, 'bank_id__field_name' => 'bank_choise']); ?>

            </div>
            <!-- pagination -->

            <div class="pagination flex-column mb-5 mb-md-0">

                <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                    <div class="pagination__links">
                        <?php my_pagination($max_num_pages); ?>
                    </div>

                    <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
                    wp_reset_query(); ?>
                    <div class="pagination__description mt-4 mt-sm-0">
                        Показано <span class="count_view"><?php echo $count_items; ?></span>
                        отзывов из <span class="count_all"><?php echo $sql_posts_total;?></span>
                    </div>
                </div>
            </div>
            <!-- / pagination -->
        </div>
    </div>
</main>



<?php get_footer() ?>
