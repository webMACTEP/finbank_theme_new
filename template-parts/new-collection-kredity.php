<?php
get_header();

$term = get_queried_object();
global  $wp_query;
$wp_query->get_queried_object_id();
// или с WordPress версии 3.1.0;
$ID = $wp_query->get_queried_object_id();
//echo '$ID: ' . $ID;


// Для коллекций
$main_type = $type = get_field('coll-type');
$otziv_title = 'Отзывы';
$show_last_bread = true;

if($type){

    // type single-collection.php
    //https://test.finabank.ru/collection/zajmy-s-plohoj-kreditnoj-istoriej/?change_template=1
    // Для коллекциц

    echo '$tt_main_type: ';
    print_r2($type);

    $tagslist = '';
    $tags = get_field('coll-tags');
    $ipost = 1;
    if (!empty($tags)):
        foreach ($tags as $tag):
            $tagslug = $tag->slug;
            if ($ipost == 1) {
                $tagslist .= $tagslug;
            } else {
                $tagslist .= ",".$tagslug;
            }
            $ipost++;
        endforeach;
    endif;
    $postsarray = [];

    global $allposts_collection;
    global $type_collection;

    switch ($type) {

        case 'creditcard':

            if (!empty($tagslist)) {
                $posts_arg = [
                    'posts_per_page'   => -1,
                    'post_type' => array('bankcard'),
                    'tag' => $tagslist,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'bankcards',
                            'field'    => 'slug',
                            'terms'    => 'creditcard',
                        ),
                    )
                ];

                $posts = get_posts( $posts_arg );
                foreach( $posts as $post ){
                    setup_postdata( $post );
                    $postsarray[] = $post->ID;
                }
                wp_reset_postdata();
            }
            //wp_reset_query();
            if (get_field('coll-creditcard')) {
                $products = get_field('coll-creditcard');
            } else {
                $products = [];
            }

            $allposts = array_merge($postsarray, $products);
            $allpostsjson = json_encode($allposts);
            $allposts_collection = $allposts;
            $type_collection = 'creditcard';

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args_for_items = array(
                'post_type' => array('bankcard'),
                'post__in' => $allposts,
                'orderby' => 'name',
                'order' => 'DESC',
                'post_status' => 'publish',
                'paged' => $paged,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'bankcards',
                        'field'    => 'slug',
                        'terms'    => 'creditcard',
                    ),
                )
            );

            $args_for_items['meta_query'][] = array(
                'key' => 'archive',
                'value' => '0'
            );

            break;
        case 'debatcard':

            $postsarray = [];
            if (!empty($tagslist)) {
                $posts_arg = [
                    'posts_per_page'   => -1,
                    'post_type' => array('bankcard'),
                    'tag' => $tagslist,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'bankcards',
                            'field'    => 'slug',
                            'terms'    => 'debetcard',
                        ),
                    )
                ];

                $posts = get_posts( $posts_arg );
                foreach( $posts as $post ){
                    setup_postdata( $post );
                    $postsarray[] = $post->ID;
                }
                wp_reset_postdata();
            }
            //wp_reset_query();
            if (get_field('coll-debatcard')) {
                $products = get_field('coll-debatcard');
            } else {
                $products = [];
            }

            $allposts = array_merge($postsarray, $products);

            $allpostsjson = json_encode($allposts);
            $allposts_collection = $allposts;
            $type_collection = 'debetcard';

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args_for_items = array(
                'post_type' => array('bankcard'),
                'post__in' => $allposts,
                'orderby' => 'name',
                'order' => 'DESC',
                'post_status' => 'publish',
                'paged' => $paged,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'bankcards',
                        'field'    => 'slug',
                        'terms'    => 'debetcard',
                    ),
                )
            );

            $args_for_items['meta_query'][] = array(
                'key' => 'archive',
                'value' => '0'
            );

            $bread = '<li class="breadcrumb-item" aria-current="page"><a href="' . get_term_link(7) . '">Дебетовые карты</a></li>';

            break;
        case 'installmentcard':

            // https://test.finabank.ru/collection/karty-rassrochki-bez-procentov/?change_template=1

            if (!empty($tagslist)) {
                $posts_arg = [
                    'posts_per_page'   => -1,
                    'post_type' => array('bankcard'),
                    'tag' => $tagslist,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'bankcards',
                            'field'    => 'slug',
                            'terms'    => 'installmentcard',
                        ),
                    )
                ];

                $posts = get_posts( $posts_arg );
                foreach( $posts as $post ){
                    setup_postdata( $post );
                    $postsarray[] = $post->ID;
                }
                wp_reset_postdata();
            }
            //wp_reset_query();
            if (get_field('coll-installmentcard')) {
                $products = get_field('coll-installmentcard');
            } else {
                $products = [];
            }

            $allposts = array_merge($postsarray, $products);
            $allpostsjson = json_encode($allposts);
            $allposts_collection = $allposts;
            $type_collection = 'installmentcard';


            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args_for_items = array(
                'post_type' => array('bankcard'),
                'post__in' => $allposts,
                'orderby' => 'name',
                'order' => 'DESC',
                'post_status' => 'publish',
                'paged' => $paged,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'bankcards',
                        'field'    => 'slug',
                        'terms'    => 'installmentcard',
                    ),
                )
            );

            $args_for_items['meta_query'][] = array(
                'key' => 'archive',
                'value' => '0'
            );


            $bread = '<li class="breadcrumb-item" aria-current="page"><a href="' . get_term_link(8)  . '">Карты Рассрочки</a></li>';

            break;
        case 'kredity':


            //https://test.finabank.ru/collection/kredit-pod-zalog-nedvizhimosti/?change_template=1
            if (!empty($tagslist)) {
                $posts_arg = [
                    'posts_per_page'   => -1,
                    'post_type' => array('kredity'),
                    'tag' => $tagslist
                ];

                $posts = get_posts( $posts_arg );
                foreach( $posts as $post ){
                    setup_postdata( $post );
                    $postsarray[] = $post->ID;
                }
                wp_reset_postdata();
            }
            //wp_reset_query();
            if (get_field('coll-kredity')) {
                $products = get_field('coll-kredity');
            } else {
                $products = [];
            }

            $allposts = array_merge($postsarray, $products);
            $allpostsjson = json_encode($allposts);
            $allposts_collection = $allposts;
            $type_collection = 'kredity';

            //print_r2($allposts);

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args_for_items = array(
                'post_type' => array('kredity'),
                'post__in' => $allposts,
                'orderby' => 'name',
                'order' => 'DESC',
                'post_status' => 'publish',
                'paged' => $paged,
            );
            $bread = '<li class="breadcrumb-item" aria-current="page"><a href="' . get_post_type_archive_link("kredity") . '">Кредиты</a></li>';

            break;
        case 'zaimy':

            if (!empty($tagslist)) {
                $posts_arg = [
                    'posts_per_page'   => -1,
                    'post_type' => array('zaimy'),
                    'tag' => $tagslist
                ];

                $posts = get_posts( $posts_arg );
                foreach( $posts as $post ){
                    setup_postdata( $post );
                    $postsarray[] = $post->ID;
                }
                wp_reset_postdata();
            }
            //wp_reset_query();
            if (get_field('coll-zaimy')) {
                $products = get_field('coll-zaimy');
            } else {
                $products = [];
            }

            $allposts = array_merge($postsarray, $products);
            $allpostsjson = json_encode($allposts);
            $allposts_collection = $allposts;
            $type_collection = 'zaimy';

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

            $args_for_items = array(
                'paged' => $paged,
                'orderby' => 'name',
                'order' => 'DESC',
                'post_type' => 'zaimy',
                'post_status' => 'publish',
                'post__in' => $allposts,
            );

            $args_for_items['meta_query'][] = array(
                'key' => 'archive',
                'value' => '0'
            );

            $bread = '<li class="breadcrumb-item" aria-current="page"><a href="' . get_post_type_archive_link("kredity") . '">Кредиты</a></li>';

            break;
        default:
            break;
    }


    if($main_type == 'debatcard'){
        $main_type = 'debetcard';
    }

}else{

    // taxonomy-bankcards-installmentcard.php
    // archive-kredity.php
    // archive-zaimy.php

    $terms = wp_get_post_terms( get_the_id(), 'bankcards', array('fields' => 'all') );
    $post_type = get_post_type(get_the_id());
    $term_slug = $terms[0]->slug;
    echo '$tt_main_post_type: ';
    $show_last_bread = false;

    print_r2($post_type);
    print_r2($term_slug);

    //  Вот тут если тип банковская карта, то сразу пихаем туда, какая именно карта
    if($post_type == 'bankcard'){
        $main_type = $term_slug;
    }else{
        $main_type = $post_type;
    }

    if($term_slug == 'debetcard'){
        $term_slug = 'debatcard';
    }

    if($post_type == 'kredity'){

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args_for_items = array(
            'orderby' => 'name',
            'order' => 'DESC',
            'post_type' => 'kredity',
            'post_status' => 'publish',
            'paged' => $paged,
        );

        $args_for_items['meta_query'][] = array(
            'key' => 'archive',
            'value' => '0'
        );

        $bread = '<li class="breadcrumb-item" aria-current="page"><a href="' . get_post_type_archive_link("kredity") . '">Кредиты</a></li>';
        $h1 = 'Кредиты';

        $args_archive = array(
            'post_type' => 'kredity',
            'posts_per_page' => -1,
            'meta_key'      => 'archive',
            'meta_value'    => true
        );
        $query_archive = new WP_Query( $args_archive );
        $query_archive_title = 'Архивные кредиты ' .  '('. $query_archive->found_posts . ')';

    }

    if($post_type == 'zaimy'){
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $args_for_items = array(
            'paged' => $paged,
            'orderby' => 'name',
            'order' => 'DESC',
            'post_type' => 'zaimy',
            'post_status' => 'publish',
        );
        $args_for_items['meta_query'][] = array(
            'key' => 'archive',
            'value' => '0'
        );

        $bread = '<li class="breadcrumb-item" aria-current="page"><a href="' . get_post_type_archive_link("kredity") . '">Займы</a></li>';
        $h1 = 'Займы';

        $args_archive = array(
            'post_type' => 'zaimy',
            'posts_per_page' => -1,
            'meta_key'      => 'archive',
            'meta_value'    => true
        );
        $query_archive = new WP_Query( $args_archive );
        $query_archive_title = 'Архивные ' .  '('. $query_archive->found_posts . ')';

    }



    switch ($term_slug) {
        case 'creditcard':


            $h1 = 'Кредитные карты';
            $bread = '  <li class="breadcrumb-item active" aria-current="page">Кредитные карты</li>';

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args_for_items = array(
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

            $args_for_items['meta_query'][] = array(
                'key' => 'archive',
                'value' => '0'
            );

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
            $query_archive = new WP_Query( $args_archive );
            $query_archive_title = 'Архивные кредитные карты ' .  '('. $query_archive->found_posts . ')';

            break;
        case 'debatcard':


            $h1 = 'Дебетовые карты';
            $bread = '  <li class="breadcrumb-item active" aria-current="page">Дебетовые карты</li>';

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

            $args_for_items = array(
                'paged' => $paged,
                'orderby' => 'name',
                'order' => 'DESC',
                'post_type'             => 'bankcard',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'bankcards',
                        'field'    => 'slug',
                        'terms'    => 'debetcard',
                    ),
                ),
                'post_status' => 'publish',
            );
            $args_for_items['meta_query'][] = array(
                'key' => 'archive',
                'value' => '0'
            );

            $args_archive = array(
                'post_type'             => 'bankcard',
                'posts_per_page'        => -1,
                'meta_key'      => 'archive',
                'meta_value'    => true,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'bankcards',
                        'field'    => 'slug',
                        'terms'    => 'debetcard',
                    ),
                )
            );
            $query_archive = new WP_Query( $args_archive );
            $query_archive_title = 'Архивные дебетовые карты ' .  '('. $query_archive->found_posts . ')';

            break;
        case 'installmentcard':

            $h1 = 'Карты Рассрочки';
            $bread = '  <li class="breadcrumb-item active" aria-current="page">Карты рассрочки</li>';

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args_for_items = array(
                'paged' => $paged,
                'orderby' => 'name',
                'order' => 'DESC',
                'post_type'             => 'bankcard',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'bankcards',
                        'field'    => 'slug',
                        'terms'    => 'installmentcard',
                    ),
                ),
                'post_status' => 'publish',
            );
            $args_for_items['meta_query'][] = array(
                'key' => 'archive',
                'value' => '0'
            );


            $args_archive = array(
                'post_type'             => 'bankcard',
                'posts_per_page'        => -1,
                'meta_key'      => 'archive',
                'meta_value'    => true,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'bankcards',
                        'field'    => 'slug',
                        'terms'    => 'installmentcard',
                    ),
                )
            );
            $query_archive = new WP_Query( $args_archive );
            $query_archive_title = 'Архивные карты рассрочки ' .  '('. $query_archive->found_posts . ')';

            break;
        default:
            break;
    }
}

$args_for_items['posts_per_page'] = 12;


// ПОХОЖИЕ БЛОКИ




//if($main_type == 'debetcard'){
//    $main_type = 'debatcard';
//}
//



if($type){
    $main_type = $type;
}else{

}


if($main_type == 'debatcard'){
    $main_type = 'debetcard';
}


switch ($main_type){
    case 'creditcard': // Кредитные карты
        //$h1 = 'Кредитные карты';
        //$bread = '  <li class="breadcrumb-item active" aria-current="page">Кредитные карты</li>';
        $otziv =get_objects_in_term( 2, 'bankcards' );
        $otziv_dop = ['bank_id__field_name' => 'bank_choise'];
        $otziv_title = 'Отзывы о кредитных картах';
        $otziv_link = get_page_link(4969);

        $article_list_args  = array(
            'post_type' => 'post',
            'cat' => 32,
            'posts_per_page' => 4,
            //'meta_key' => 'views',
            //'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
            //'order' => 'DESC',
        );

        $article_list_args_title = 'Статьи о кредитных карт';
        $article_list_args_title1 = 'Новости о кредитных карт';
        $cat_for_news = 32;
        $article_list_args_link = get_category_link('32');

        break;
    case 'installmentcard':  // Карты Рассрочки
        //$h1 = 'Карты Рассрочки';
        //$bread = '  <li class="breadcrumb-item active" aria-current="page">Карты рассрочки</li>';
        $otziv = get_objects_in_term( 8, 'bankcards' );
        $otziv_dop = ['bank_id__field_name' => 'bank_choise'];
        $otziv_title = 'Отзывы о картах рассрочки';
        $otziv_link = get_page_link(4967);
        // одного и тоже

        $article_list_args  = array(
            'post_type' => 'post',
            'cat' => 32,
            'posts_per_page' => 4,
            //'meta_key' => 'views',
            //'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
            //'order' => 'DESC',
        );

        $article_list_args_title = 'Статьи о картах рассрочки';
        $article_list_args_title1 = 'Новости о картах рассрочки';
        $cat_for_news = 32;
        $article_list_args_link = get_category_link('32');

        break;
    case 'kredity': // КРЕДИТЫ
        $otziv = get_cpt_ids('kredity');
        $otziv_title = 'Отзывы о кредитах';
        $otziv_link = get_page_link(4973);

        $article_list_args = array(
            'post_type' => 'post',
            'cat' => 37,
            'posts_per_page' => 4,
            //    'meta_key' => 'views',
            //    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
            //    'order' => 'DESC',
        );
        $article_list_args_title = 'Статьи о кредитах';
        $article_list_args_title1 = 'Новости о кредитах';
        $cat_for_news = 37;
        $article_list_args_link = get_category_link('37');

        break;
    case 'zaimy': // ЗАЙМЫ
        $otziv = get_cpt_ids('zaimy');
        $otziv_title = 'Отзывы о займах';
        $otziv_link = get_page_link(4975);

        $article_list_args = array(
            'post_type' => 'post',
            'cat' => 38,
            'posts_per_page' => 4,
            'meta_key' => 'views',
            'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
            'order' => 'DESC',
        );
        $article_list_args_title = 'Статьи о займах';
        $article_list_args_title1 = 'Новости о займах';
        $cat_for_news = 38;
        $article_list_args_link = get_category_link('38');

        break;
    default:
}

if($main_type == 'debetcard' || $main_type == 'debatcard'){

    $otziv = get_objects_in_term( 7, 'bankcards' );
    $otziv_dop = ['bank_id__field_name' => 'bank_choise'];
    $otziv_title = 'Отзывы о дебетовых картах';
    $otziv_link = get_page_link(4965);

    $article_list_args  = array(
        'post_type' => 'post',
        'cat' => 32,
        'posts_per_page' => 4,
    );

    $article_list_args_title = 'Статьи о дебетовых карт';
    $article_list_args_title1 = 'Новости о дебетовых карт';
    $cat_for_news = 32;
    $article_list_args_link = get_category_link('32');
}

?>

<main term="kredity" class="use_new_template_v1">
	<div class="container">
	    <nav aria-label="breadcrumb" class="horizontal__scroll">
	        <ol class="breadcrumb horizontal__scroll-container">
	            <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>

                <?php echo $bread?>

                <?php if($show_last_bread):?>

	                <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>

                <?php endif; ?>


	        </ol>
	    </nav>
	</div>
	<div class="new-page__heading">

	    <div class="container">
	        <div class="d-flex justify-content-between align-items-center">
	          <h1 class="page__heading-title mb-0">
                    <?php if(isset($h1) && $h1 != false): ?>

                        <?php echo $h1; ?>

                    <?php else: ?>

                        <?php if(get_field('col-h1')): ?>
                            <?= get_field('col-h1'); ?>
                        <?php else: ?>
                            <?php the_title(); ?>
                        <?php endif; ?>

                    <?php endif; ?>
              </h1>
	        </div>
            <?php if(get_field('col-desc')): ?>
            <div class="d-flex position-relative flex-wrap">
                <div class="new-page__heading-description page__heading-description mt-2">
                    <?= get_field('col-desc'); ?>

                </div>
                <div class="page__heading-description---open">Развернуть</div>


            </div>
            <?php endif; ?>

	    </div>
	</div>

    <!-- page navigation -->
    <div class=" page__nav">
        <div class="container">
            <div class="page__nav-container nav-tabs">
                <div class="horizontal__scroll">
                    <div class="horizontal__scroll-container">
                        <a href="<?php echo get_post_type_archive_link('kredity') ?>" class="nav-link active">Все кредиты</a>
                        <a href="<?php echo get_page_link(4973); //1503 tax-reviews ?>" class="nav-link " data-tax="kredity">Отзывы</a>
                        <a href="<?php echo get_page_link(149) ?>" class="nav-link">Калькулятор</a>
                        <a href="<?php echo get_category_link(37) //18 ?>" class="nav-link">Статьи</a>
                        <a href="<?php echo get_page_link(1552) ?>" class="nav-link">сравнить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / page navigation -->


    <div class="popup_filter_wrap popup popup_v1" style="display: none">
        <div class="popup__inner">
            <div class="popup_close popup_close-css"><img src="/wp-content/themes/finbank_theme/img/close2.png" alt="Закрыть"></div>
            <div class="popup_body">
                <form class="filter_v1" id="credit-card-filter" action="" method="POST">
                    <input type="hidden" name="action" value="cardfilter" />



                    <input type="hidden" name="term" value="<?php echo $main_type; ?>"/>

                    <?php if($allpostsjson): ?>
                        <input type="hidden" name="postarr" value="<?php echo htmlspecialchars( $allpostsjson ); ?>" />
                    <?php endif; ?>


                    <div class="h2" style="text-align: left;">Все фильтры</div>

                    <div class="row  mt-4">

                        <?php



                        get_template_part( 'all_template/filters/filter_by_type_v1', false, ['type' => $main_type] );

                        ?>


                        <div class="order-7 row filter__main_bottom">
                            <div class="col-12 col-md-6 col-lg-3 col-xl-3 order-7 order-md-7 mt-4">
                                <input class="btn btn-outline-alternative btn-block clear_form__filter_v1" type="reset" value="Очистить фильтр"/>
<!--                                <div class="btn btn-outline-alternative btn-block clear_form__filter_v1">Очистить фильтр</div>-->
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 col-xl-2 order-7 order-md-7 mt-4">
                                <div class="btn btn-primary btn-block submit-button">Показать</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="popup_calc_wrap popup popup_v1" style="display: none">
        <div class="popup__inner">
            <div class="popup_close popup_close-css"><img src="/wp-content/themes/finbank_theme/img/close2.png" alt="Закрыть"></div>
            <div class="popup_body">

                <?php

                get_template_part( 'all_template/calc_by_type_v1', false, ['type' => $main_type] );

                ?>


            </div>
        </div>
    </div>


    <? get_template_part( 'all_template/tags__main_v2_slider' ); ?>


    <!-- /banks   -->
    <div class="banks_v1 container">
        <div class="d-flex flex-wrap">
            <?php
            $args_banks = array(
                'post_type' => 'banks',
                'meta_key' => 'ratings_average',
                'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc',),
                'order' => 'DESC',
                'posts_per_page' => 6,
            );

            $wp_query = new WP_Query( $args_banks );

            // Цикл
            if ( $wp_query->have_posts() ) {
                $counter = 0;
                while ( $wp_query->have_posts() ) {
                    $wp_query->the_post();
                    $counter +=1;
                    ?>
                    <div class="bank__wrapper_v1">
                        <a href="<?php echo the_permalink() ?>" class="card card__horizontal bank__item bank__item_v1">
                            <div class="bank-card-container">
                                <div class="d-flex">
                                    <div class="bank__item-img mr-2">
                                        <img loading="lazy" src="<?= get_field('bank_logo') ?>"
                                             alt="<?
                                             $bank_id = get_field('bank_logo',get_the_ID() , false);
                                             $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                             echo $bank_alt;
                                             ?>"
                                        >
                                    </div>
                                    <div class="bank__item-content">
                                        <div class="card__header-title mt-1 mb-2"><?php echo get_the_title(get_the_ID()) ?></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            } ?>
            <?php wp_reset_query() ?>
        </div>
    </div>
    <!-- / banks END -->

	<div class="container">
	    <!-- credits list -->
	    <div class="credits mt-4">
	        <div class="row_v1">

                <?php


                    $counter = 0;
                    $query = new WP_Query( $args_for_items );

                    if ( $query->have_posts() ) {

                        $max_pages = $query->max_num_pages;
                        $found_posts = $query->found_posts;

                        if ($query->have_posts()) {
                            ob_start();
                            while ($query->have_posts()):
                                $query->the_post();
                                $counter++;

                                if(!$_SESSION['view_type']){
                                    $_SESSION['view_type'] = 'card_list';
                                }

                                get_template_part( 'template-parts/new-filter-bank-offers', false, ['view_type' => $_SESSION['view_type']] );
                            endwhile;

                            $posts_html = ob_get_contents();
                            ob_end_clean();
                        }

                    }else{
                        $posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
                    }
                    $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;

                    if(false){
                                                    //
                            //                    $args_titles = $args;
                            //                    $args_titles['posts_per_page'] = -1;
                            //                    $args_titles['paged'] = 0;
                            //
                            //                    $query_titles = new WP_Query( $args_titles );
                            //
                            //                    if ( $query_titles->have_posts() ) {
                            //
                            //
                            //                        ob_start();
                            //                        while ($query_titles->have_posts()):
                            //                            $query_titles->the_post();
                            //                            ?>
                                                    <!--
                                                     <option class="query_titles" value="<?php ////echo get_the_id() ?>"><?php echo the_title() ?>/option>

                                                     --->
                                                    <?php
                            //
                            //                            //get_template_part( 'template-parts/new-filter-bank-offers', false, ['view_type' => $_SESSION['view_type']] );
                            //                        endwhile;
                            //
                            //                        $posts_html_titles = ob_get_contents();
                            //                        ob_end_clean();
                            //
                            //                    }

                    }

                    ?>

                <!-- list -->
                <div class="col-12 col-lg-12">
                    <div class="credits__list list_items_main">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mt-0 mt-md-5 mt-lg-0 mb-3">
<!--                             h2 mt-5 mb-4 mt-md-0 mb-md-0 -->
                            <div class="col-12  col-md-5 col-lg-4 mt-2 mb-2">

                                <div class="row d-flex flex-wrap justify-content-between">

                                    <div class="btn-custom-v1 btn btn-outline-primary btn-block submit-button col-md-5 col-12 c-pointer show__popup_filter_wrap">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.25 3L10.25 3M10.25 3C10.25 4.24264 11.2574 5.25 12.5 5.25C13.7426 5.25 14.75 4.24264 14.75 3C14.75 1.75736 13.7426 0.75 12.5 0.75C11.2574 0.75 10.25 1.75736 10.25 3ZM5.75 9L14.75 9M5.75 9C5.75 10.2426 4.74264 11.25 3.5 11.25C2.25736 11.25 1.25 10.2426 1.25 9C1.25 7.75736 2.25736 6.75 3.5 6.75C4.74264 6.75 5.75 7.75736 5.75 9Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div>Фильтр</div>
                                    </div>

                                    <div class="btn-custom-v1 btn btn-outline-primary btn-block submit-button col-md-6 col-12 c-pointer show__popup_calc_wrap">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.25 0.75L0.75 11.25M3.75 2.25C3.75 3.07843 3.07843 3.75 2.25 3.75C1.42157 3.75 0.75 3.07843 0.75 2.25C0.75 1.42157 1.42157 0.75 2.25 0.75C3.07843 0.75 3.75 1.42157 3.75 2.25ZM11.25 9.75C11.25 10.5784 10.5784 11.25 9.75 11.25C8.92157 11.25 8.25 10.5784 8.25 9.75C8.25 8.92157 8.92157 8.25 9.75 8.25C10.5784 8.25 11.25 8.92157 11.25 9.75Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div>Калькулятор</div>
                                    </div>
                                </div>



                            </div>
                            <div class="credits__list-dropdown dropdown mb-3 mb-md-0 col-12 col-md-5 col-lg-4 px-0 show choices_v1">

                                <div  data-order_type="DESC" class="order_type">
                                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.75 1V13M11.75 13L8.75 10M11.75 13L14.75 10M4.25 13V1M4.25 1L1.25 4M4.25 1L7.25 4" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                

                                <?php

                                get_template_part( 'all_template/template_v1/select', false, ['DATA' => '', 'type' => $main_type] );

                                ?>


                                <div class="template_view d-flex view_type">
                                    <div class="js_change_view_template card_list active" data-view="card_list">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.8 8C16.9201 8 17.4802 8 17.908 7.78201C18.2843 7.59027 18.5903 7.28431 18.782 6.90798C19 6.48016 19 5.92011 19 4.8V4.2C19 3.0799 19 2.51984 18.782 2.09202C18.5903 1.7157 18.2843 1.40973 17.908 1.21799C17.4802 1 16.9201 1 15.8 1L4.2 1C3.0799 1 2.51984 1 2.09202 1.21799C1.71569 1.40973 1.40973 1.71569 1.21799 2.09202C1 2.51984 1 3.07989 1 4.2L1 4.8C1 5.9201 1 6.48016 1.21799 6.90798C1.40973 7.28431 1.71569 7.59027 2.09202 7.78201C2.51984 8 3.07989 8 4.2 8L15.8 8Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.8 19C16.9201 19 17.4802 19 17.908 18.782C18.2843 18.5903 18.5903 18.2843 18.782 17.908C19 17.4802 19 16.9201 19 15.8V15.2C19 14.0799 19 13.5198 18.782 13.092C18.5903 12.7157 18.2843 12.4097 17.908 12.218C17.4802 12 16.9201 12 15.8 12L4.2 12C3.0799 12 2.51984 12 2.09202 12.218C1.71569 12.4097 1.40973 12.7157 1.21799 13.092C1 13.5198 1 14.0799 1 15.2L1 15.8C1 16.9201 1 17.4802 1.21799 17.908C1.40973 18.2843 1.71569 18.5903 2.09202 18.782C2.51984 19 3.07989 19 4.2 19H15.8Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="js_change_view_template card_grid" data-view="card_grid">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.4 1H2.6C2.03995 1 1.75992 1 1.54601 1.10899C1.35785 1.20487 1.20487 1.35785 1.10899 1.54601C1 1.75992 1 2.03995 1 2.6V6.4C1 6.96005 1 7.24008 1.10899 7.45399C1.20487 7.64215 1.35785 7.79513 1.54601 7.89101C1.75992 8 2.03995 8 2.6 8H6.4C6.96005 8 7.24008 8 7.45399 7.89101C7.64215 7.79513 7.79513 7.64215 7.89101 7.45399C8 7.24008 8 6.96005 8 6.4V2.6C8 2.03995 8 1.75992 7.89101 1.54601C7.79513 1.35785 7.64215 1.20487 7.45399 1.10899C7.24008 1 6.96005 1 6.4 1Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M17.4 1H13.6C13.0399 1 12.7599 1 12.546 1.10899C12.3578 1.20487 12.2049 1.35785 12.109 1.54601C12 1.75992 12 2.03995 12 2.6V6.4C12 6.96005 12 7.24008 12.109 7.45399C12.2049 7.64215 12.3578 7.79513 12.546 7.89101C12.7599 8 13.0399 8 13.6 8H17.4C17.9601 8 18.2401 8 18.454 7.89101C18.6422 7.79513 18.7951 7.64215 18.891 7.45399C19 7.24008 19 6.96005 19 6.4V2.6C19 2.03995 19 1.75992 18.891 1.54601C18.7951 1.35785 18.6422 1.20487 18.454 1.10899C18.2401 1 17.9601 1 17.4 1Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M17.4 12H13.6C13.0399 12 12.7599 12 12.546 12.109C12.3578 12.2049 12.2049 12.3578 12.109 12.546C12 12.7599 12 13.0399 12 13.6V17.4C12 17.9601 12 18.2401 12.109 18.454C12.2049 18.6422 12.3578 18.7951 12.546 18.891C12.7599 19 13.0399 19 13.6 19H17.4C17.9601 19 18.2401 19 18.454 18.891C18.6422 18.7951 18.7951 18.6422 18.891 18.454C19 18.2401 19 17.9601 19 17.4V13.6C19 13.0399 19 12.7599 18.891 12.546C18.7951 12.3578 18.6422 12.2049 18.454 12.109C18.2401 12 17.9601 12 17.4 12Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.4 12H2.6C2.03995 12 1.75992 12 1.54601 12.109C1.35785 12.2049 1.20487 12.3578 1.10899 12.546C1 12.7599 1 13.0399 1 13.6V17.4C1 17.9601 1 18.2401 1.10899 18.454C1.20487 18.6422 1.35785 18.7951 1.54601 18.891C1.75992 19 2.03995 19 2.6 19H6.4C6.96005 19 7.24008 19 7.45399 18.891C7.64215 18.7951 7.79513 18.6422 7.89101 18.454C8 18.2401 8 17.9601 8 17.4V13.6C8 13.0399 8 12.7599 7.89101 12.546C7.79513 12.3578 7.64215 12.2049 7.45399 12.109C7.24008 12 6.96005 12 6.4 12Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="variants_count_text"> <span class="variants_count"><?php echo $query->found_posts;?></span> вариантов</div>


                        <div data-json='<?= json_encode($args_for_items); ?>'  class="list_posts view-list" id="response-cred-card">
                            <?php
                            echo $posts_html;
                            ?>
                        </div>
                        <!-- pagination -->
                        <div class="pagination flex-column mb-5 mb-md-0">

                            <?php if($paged < $max_pages): ?>
                                <button class="btn btn-outline-gray btn-block load_more_btn"
                                 data-max_pages="<?php echo $max_pages ?>" data-paged="<?php echo $paged ?>">
                                    Больше решений
                                </button>
                            <?php endif; ?>

                            <div class="pagination__container d-sm-flex justify-content-center align-items-center">
                                <div class="pagination__links 123">
                                    <?php my_pagination(); ?>
                                </div>

                                <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
                                wp_reset_query();
                                ?>
                            </div>
                        </div>
                        <!-- / pagination -->

                        <?php if (isset($query_archive) && $query_archive != false): ?>
                            <h2 class="title archive_title mt-5"> <?php echo $query_archive_title; ?></h2>
                            <div class="list_posts view-list  archive_list archive_hide">
                                <?php while ( $query_archive->have_posts() ): $query_archive->the_post();?>
                                    <?php get_template_part( 'template-parts/new-filter-bank-offers' ,false, ['view_type' => 'card_grid']); ?>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        <?php endif; ?>


                        <?php $date_actually = get_the_modified_date('d.m.Y', $ID);?>
                        <?php if($date_actually): ?>
                            <div class="section">
                                <div class="date_actually">Дата обновления информации: <?= $date_actually?></div>
                                <div class="date_actually"> Наиболее актуальные условия и тарифы мы рекомендуем узнавать на официальном сайте банков и в отделениях</div>
                            </div>
                        <?php endif; ?>



                        <?php

                        print_r2($main_type);

                        ?>

                        <!-- Предложения месяца -->
                        <?php $offers_of_month = get_field('offers_of_month_' . $main_type , 'options'); ?>




                        <?php if($offers_of_month): ?>

                        <?php get_template_part( 'all_template/similar_list_v1', null, ['TITLE' => 'Предложения месяца', 'DATA' => $offers_of_month]); ?>
                        <!-- Предложения месяца -->

                        <?php endif;?>


                        <!-- similar -->
                        <?php echo do_shortcode('[new_table_collection]' ); ?>

	                </div>
	            </div>
	            <!-- / list -->

                <div id="popular-category" class="col-12 section ">

                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0">Популярные категории</h2>
                    </div>
                    <div class="popular-category-wrapper">

                        <div class="popular-category-left ">
                            <!-- /banks col-12 col-md-4   -->
                            <div class="popular__left-item">
                                <b style="color:var(--black)">Популярное</b>
                            </div>

                            <?php
                            $args = array(
                                'post_type' => 'banks',
                                'meta_key' => 'ratings_average',
                                'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc',),
                                'order' => 'DESC',
                                'posts_per_page' => 8,
                            );

                            $wp_query = new WP_Query( $args );

                            // Цикл
                            if ( $wp_query->have_posts() ) {
                                $counter = 0;
                                while ( $wp_query->have_posts() ) {
                                    $wp_query->the_post();
                                    $counter +=1;
                                    ?>
                                    <a href="<?php echo the_permalink() ?>"  class="popular__left-item">
                                        <?php echo get_the_title(get_the_ID()) ?>
                                    </a>
                                    <?php
                                }
                            } ?>
                            <?php wp_reset_query() ?>
                            <!-- / banks END -->
                        </div>
                        <div class="popular-category-right ">

                            <?php
                            //print_r2($main_type); col-12 col-md-8

                                $type_for_category = $main_type;

                                if($type_for_category == 'debetcard'){
                                    $type_for_category = 'debatcard';
                                }

                            $args = array(
                                'hide_empty' => true,
                                'taxonomy'     => 'tags-category',
                            );

                            $cats = get_categories( $args );

                            if( $cats ){
                                foreach( $cats as $cat ){
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
                                                'value'     => $type_for_category, // creditcard // kredity
                                                'compare'   => '=',
                                            ),
                                        )
                                    );
                                    $query = new WP_Query( $args_coll );

                                    if ( $query->have_posts() ) {
                                        $current_id = $wp_query->get_queried_object_id(); ?>


                                        <? get_template_part( 'all_template/filter_popular', null, ['cat' => $cat, 'query' => $query]); ?>

                                    <?php } wp_reset_query(); ?>


                                    <?php

                                }

                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- / filter -->

	        </div>
	    </div>
	    <?php wp_reset_query(); ?>
	    <!-- / credits list -->

        <!-- card reviews -->
        <div id="reviews" class="section">
            <div class="section__header d-flex justify-content-between align-items-center mb-4">
                <h2 class="title mb-0"><?= $otziv_title; ?></h2>
                <div class="d-flex">

                    <input class="d-none show__custom_form_v2 btn btn-outline-alternative btn-block" value="Оставить отзыв">

                    <a href="<?php echo $otziv_link; ?>" class="btn btn-primary btn-sm btn-all  btn-all-lg" data-tax="kredity">
                            Все
                            <span class="icon ml-2">
                            <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>


            <div id="form_otziv" class="form_otziv custom_form_v2 mb-4" style="display: none">

                    <div style="display:none;margin-top: 1rem;margin-bottom: 1rem;color: green;" class="response-for-comment">
                        Ваш комментарий ожидает проверки
                    </div>
                    <select name="comment_post_ID" id="select_item_otziv" class="get_selected_value_v1 styledSelect" required placeholder="">
                        <option selected disabled value="">выбрать </option>
                        <?
                        echo  $posts_html_titles;
                        ?>
                    </select>

                    <?
                    $new_args = $args + ['is_detail_page' => 'N'];
                    get_template_part( 'all_template/commentForm_v1', null, $args);

                    ?>

            </div>

            <div class="horizontal__scroll row">
                <div class="horizontal__scroll-container">
                    <?php
                    $ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                    $custom_offset = 0;

                    // fetch posts in all those categories

                    //print_r2($otziv);


                    if($otziv){
                        $posts = $otziv;

                        $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                                     FROM {$wpdb->comments} WHERE
                                     comment_post_ID in (".implode(',', $posts).") AND comment_approved = 1 AND comment_parent = 0
                                     ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                        $comments_list = $wpdb->get_results( $sql );

                        //print_r2($comments_list);

                        if($otziv_dop){

                            $args_for_reviews = ['TYPE' => $main_type, 'DATA' => $comments_list];
                            $args_for_reviews = array_merge($args_for_reviews, $otziv_dop);

                        }else{
                            $args_for_reviews = ['TYPE' => $main_type, 'DATA' => $comments_list];
                        }

                        get_template_part('all_template/reviews_list', null, $args_for_reviews);
                    }

                    ?>
                </div>

               <div class="container">
                   <a href="<?php echo $otziv_link; ?>" class="btn btn-primary btn-sm btn-all btn-all-mob mt-5" data-tax="kredity">
                       Все
                       <span class="icon ml-2">
                            <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.741793 5.26611C0.332112 5.26611 -2.58132e-07 5.59475 -2.40412e-07 6.00014C-2.22692e-07 6.40553 0.332112 6.73416 0.741793 6.73416L10.8796 6.73416L10.8796 8.80374C10.8796 11.0372 13.4701 12.2988 15.2587 10.9364L18.9392 8.13282C20.3536 7.05544 20.3536 4.94481 18.9392 3.86742L15.2587 1.0638C13.4701 -0.298586 10.8796 0.963051 10.8796 3.1965L10.8796 5.26611L0.741793 5.26611ZM14.3537 9.77315C13.5407 10.3924 12.3632 9.81895 12.3632 8.80374L12.3632 6.00501L12.3632 6.00013L12.3632 5.99526L12.3632 3.1965C12.3632 2.1813 13.5407 1.60782 14.3537 2.22709L18.0342 5.03071C18.6771 5.52043 18.6771 6.47981 18.0342 6.96953L14.3537 9.77315Z" fill="white"/>
                            </svg>
                        </span>
                   </a>
               </div>


            </div>





        </div>
        <!-- / card reviews -->

        <!-- faq zaimy_faq type_faq -->


        <?php if( have_rows($main_type . '_faq', 'options') ): ?>
            <div class="section container">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Часто задавемые вопросы</h2>
                </div>
                <div class="accordion" id="accordion">
                    <?php $counter = 0; ?>
                    <?php while( have_rows('type_faq', 'options') ): the_row();
                        $question = get_sub_field('question');
                        $answer = get_sub_field('answer');
                        $counter += 1;
                        ?>
                        <div class="accordion__item">
                            <div class="accordion__header">
                                <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse__item-<?php echo $counter?>" aria-expanded="false">
                                    <?php echo $question ?>
                                    <div class="accordion__button-icon"><svg width="12" height="6" viewBox="0 0 12 6"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use></svg></div>
                                </button>
                            </div>
                            <div id="collapse__item-<?php echo $counter?>" class="accordion__collapse collapse" data-bs-parent="#accordion">
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

        <!-- articles -->
        <div class="section article_about_kredity article_about_kredity_template_v1">
            <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                <h2 class="title mb-0"> <?php echo $article_list_args_title1; ?> </h2>
                <a href="<?php echo $article_list_args_link; ?>" class="btn btn-primary btn-sm btn-all btn-all-lg">
                    Все
                    <span class="icon ml-2">
	                    <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
	                </span>
                </a>

            </div>
            <div class="horizontal__scroll row mb-5 mb-md-6">
                <div class="horizontal__scroll-container">

                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'cat' => $cat_for_news,
                        'posts_per_page' => 4,
                        'meta_key' => 'views',
                        // desc
                        'orderby' => array( 'meta_value_num' => 'asc', 'name' => 'asc' ),
                        'order' => 'desc'
                    );
                    $wp_query = new WP_Query( $args );
                    if ( $wp_query->have_posts() ) {
                        while ( $wp_query->have_posts() ) {
                            $wp_query->the_post(); ?>
                            <!-- item -->
                            <div class="article__item card card__vertical size4 offer h-100">
                                <div class="card-container p-3 d-xl-flex flex-xl-column">
                                    <?php if(get_the_post_thumbnail_url()): ?>
                                        <div class="card__image">
                                            <img src="<?php echo the_post_thumbnail_url() ?>"
                                                 alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                                    <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                                    <div class="mt-auto">
                                        <div class="d-flex align-items-center mt-2">
                                            <div class="card__icon d-flex align-items-center mr-3">
                                                <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                                <?php echo the_field('views') ?>
                                            </div>
                                            <div class="card__icon d-flex align-items-center mr-3">
                                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                                <?php echo comments_number( '0', '1', '%'); ?>
                                            </div>
                                            <div class="card__like d-flex align-items-center ml-auto">
                                                <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- / item -->
                        <?php }
                    } ?>
                    <?php wp_reset_query() ?>
                </div>

               <div class="container">
                   <a href="<?php echo $article_list_args_link; ?>" class="btn btn-primary btn-sm btn-all btn-all-mob mt-4 ">

                       Все
                       <span class="icon ml-2">
                        <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.741793 5.26611C0.332112 5.26611 -2.58132e-07 5.59475 -2.40412e-07 6.00014C-2.22692e-07 6.40553 0.332112 6.73416 0.741793 6.73416L10.8796 6.73416L10.8796 8.80374C10.8796 11.0372 13.4701 12.2988 15.2587 10.9364L18.9392 8.13282C20.3536 7.05544 20.3536 4.94481 18.9392 3.86742L15.2587 1.0638C13.4701 -0.298586 10.8796 0.963051 10.8796 3.1965L10.8796 5.26611L0.741793 5.26611ZM14.3537 9.77315C13.5407 10.3924 12.3632 9.81895 12.3632 8.80374L12.3632 6.00501L12.3632 6.00013L12.3632 5.99526L12.3632 3.1965C12.3632 2.1813 13.5407 1.60782 14.3537 2.22709L18.0342 5.03071C18.6771 5.52043 18.6771 6.47981 18.0342 6.96953L14.3537 9.77315Z" fill="white"/>
                        </svg>
                    </span>
                   </a>
               </div>
            </div>



        </div>
        <!-- / articles -->

	    <!-- articles -->
	    <div class="section article_about_kredity">
	        <div class="section__header mb-4 d-flex justify-content-between align-items-center">
	            <h2 class="title mb-0"> <?php echo $article_list_args_title; ?> </h2>
	            <a href="<?php echo $article_list_args_link; ?>" class="btn btn-primary btn-sm btn-all btn-all-lg">
	                Все
	                <span class="icon ml-2">
	                    <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
	                </span>
	            </a>
	        </div>
	        <div class="horizontal__scroll row mb-5 mb-md-6">        
	            <div class="horizontal__scroll-container">

                <?php

                //get_template_part( 'inc/articles_about', null, $args);
                $wp_query = new WP_Query( $article_list_args );
                if ( $wp_query->have_posts() ) {
                    while ( $wp_query->have_posts() ) {
                        $wp_query->the_post(); ?>
                        <!-- item -->
                      <div class="article__item card card__vertical size4 offer h-100">
                          <div class="card-container p-3 d-xl-flex flex-xl-column">
                              <?php if(get_the_post_thumbnail_url()): ?>
                              <div class="card__image">
                                  <img src="<?php echo the_post_thumbnail_url() ?>"
                                       alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);?>">
                              </div>
                             <?php endif; ?>
                              <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                              <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                              <div class="mt-auto">
                                  <div class="d-flex align-items-center mt-2">
                                      <div class="card__icon d-flex align-items-center mr-3">
                                          <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                          <?php echo the_field('views') ?>
                                      </div>
                                      <div class="card__icon d-flex align-items-center mr-3">
                                          <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                          <?php echo comments_number( '0', '1', '%'); ?>
                                      </div>
                                      <div class="card__like d-flex align-items-center ml-auto">
                                          <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                      </div>
                                  </div>
                                  <?php $author_id = get_field('page_author');
                                  if ($author_id): ?>
                                  <div class="card__author d-flex align-items-center mt-3">
                                      <div class="card__author-img">
                                          <?php get_template_part( 'all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                      </div>
                                      <div class="card__author-content">
                                          <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                                          <div class="rating d-flex align-items-center">
                                           <?php echo do_shortcode( '[ratings id="'.$author_id.'"]' ); ?>
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

                        <?php wp_reset_query(); ?>
                </div>

                <div class="container">

                    <a href="<?php echo $article_list_args_link; ?>" class="btn btn-primary btn-sm btn-all btn-all-mob mt-4">
                        Все
                        <span class="icon ml-2">
                        <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.741793 5.26611C0.332112 5.26611 -2.58132e-07 5.59475 -2.40412e-07 6.00014C-2.22692e-07 6.40553 0.332112 6.73416 0.741793 6.73416L10.8796 6.73416L10.8796 8.80374C10.8796 11.0372 13.4701 12.2988 15.2587 10.9364L18.9392 8.13282C20.3536 7.05544 20.3536 4.94481 18.9392 3.86742L15.2587 1.0638C13.4701 -0.298586 10.8796 0.963051 10.8796 3.1965L10.8796 5.26611L0.741793 5.26611ZM14.3537 9.77315C13.5407 10.3924 12.3632 9.81895 12.3632 8.80374L12.3632 6.00501L12.3632 6.00013L12.3632 5.99526L12.3632 3.1965C12.3632 2.1813 13.5407 1.60782 14.3537 2.22709L18.0342 5.03071C18.6771 5.52043 18.6771 6.47981 18.0342 6.96953L14.3537 9.77315Z" fill="white"/>
                        </svg>
                    </span>
                    </a>

                </div>

            </div>



	    </div>
	    <!-- / articles -->

        <!-- comments -->
        <div id="comments" class="section comments_template_v1">
            <div class="container">
                <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="title mb-0">Комментарии</h2>
                    <!--button class="btn btn-primary btn-scroll btn-sm" data-target="commentForm">
                        Оставить отзыв
                    </button-->
                </div>
                <div class="comments">
                    <?php
                    $comments = get_comments(array(
                        'post_id' => $ID,
                        'status' => 'approve',
                        'hierarchical' => 'threaded',
                        'number' => 3, ));
                    $counter = 0;
                    foreach($comments as $comment) {
                        $comment_id = $comment->comment_ID;
                        $comment_post_id = $comment->comment_post_ID;
                        $user = get_userdata( $comment->user_id );
                        $user_role = $user->roles;
                        $user_email = $user->user_email;
                        $user_city = $user->user_city;
                        $counter++;
                        $comments_children = get_comments(array(
                            'status' => 'approve',
                            'hierarchical' => 'true',
                            'parent' => $comment_id,));
                        $responses = count($comments_children); ?>
                        <!-- item -->
                        <div class="comments__item mb-3 " id="comment-<?php echo $comment_id ?>">
                            <!-- comment -->
                            <div class="comment__one">
                                <div class="comment__one-header d-flex align-items-center">
                                    <div class="comment__one-img mr-3">
                                        <img src="<?php echo get_avatar_url( $comment, array(
                                            'default'=>'identicon',) ); ?>" alt="<?php echo $comment->comment_author; ?>">
                                    </div>
                                    <div class="d-md-flex justify-content-md-between w-100">
                                        <div class="comment__one-title mb-2 mb-md-0">
                                            <?php echo $comment->comment_author; ?>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                                                <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                                                <?php if($user_role[0] == ''):
                                                    echo 'Гость';
                                                endif;
                                                if($user_role[0] != ''):
                                                    echo $user_role[0];
                                                endif; ?>
                                            </div>

                                            <!--                                        <div class="d-none card__icon d-flex align-items-center ml-3 ml-sm-4">-->
                                            <!--                                            <div class="mr-2"><svg width="18" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="--><?php //bloginfo('template_url'); ?><!--/img/icons.svg#house" x="0" y="0"></use></svg></div>-->
                                            <!--                                            --><?php //$bank_id = get_field('product_bank', $comment_post_id); ?>
                                            <!--                                            --><?php //echo get_the_title($bank_id); ?>
                                            <!--                                        </div>-->

                                        </div>
                                    </div>
                                </div>
                                <div class="comment__one-content">
                                    <?php echo $comment->comment_content; ?>
                                </div>
                                <div class="comment__one-footer d-flex flex-wrap align-items-center">
                                    <?php echo comment_reply_link( [ 'reply_text' => "Ответить", 'depth' => -1 ], $comment_id, ); ?>

                                    <div class="comment-reply-link2">
                                        <?php echo comment_reply_link( [ 'reply_text' => "Цитировать", 'depth' => -1 , 'add_below' => 'comment' ], $comment_id, ); ?>
                                    </div>



                                    <a href="#" data-id="<?php echo $comment_id; ?>" class="complain-btn">

                                        <div class="tooltip">
                                            <div class="tooltip__trigger">

                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.0026 10.6666V7.99992M8.0026 5.33325H8.00927M14.6693 7.99992C14.6693 11.6818 11.6845 14.6666 8.0026 14.6666C4.32071 14.6666 1.33594 11.6818 1.33594 7.99992C1.33594 4.31802 4.32071 1.33325 8.0026 1.33325C11.6845 1.33325 14.6693 4.31802 14.6693 7.99992Z" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>

                                            </div>
                                            <div class="tooltip__drop">Введите все нужные вам параметры в калькулятори и получите точный ежемесячный платеж с процентной визуализацией выгоды</div>
                                        </div>

                                        Пожаловаться</a>

                                    <?//php echo comment_reply_link( [ 'reply_text' => "Пожаловаться", 'depth' => -1 ], $comment_id, ); ?>

                                    <div class="comment__one-date order-md-1">
                                        <?php echo  get_comment_date( 'd.m.y'); ?> в
                                        <?php echo get_comment_date('H:i') ?>
                                    </div>
                                    <div class="comment__one-like order-md-4 ml-auto d-flex justify-content-between">
                                        <?php comments_like_dislike($comment_id); ?>
                                    </div>
                                    <?php if($responses > 0): ?>
                                        <div class="comment__one-btn order-md-2 mr-md-4">
                                            <button class="btn btn-outline-light btn-xs collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answ__<?php echo $counter ?>" aria-expanded="false">
                                                <?php echo $responses ?>
                                                <?php if($responses == 1):
                                                    echo 'Ответ';
                                                endif;?>
                                                <?php if(2 <= $responses &&  $responses <= 4):
                                                    echo 'Ответа';
                                                endif;?>
                                                <?php if($responses >= 4):
                                                    echo 'Ответов';
                                                endif;?>
                                                <svg width="12" height="6" viewBox="0 0 12 6">
                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- comment -->
                            <?php if($responses > 0): ?>
                                <?php foreach($comments_children as $comment_children) {
                                    $comment_id_children = $comment_children->comment_ID;
                                    $comment_post_id = $comment_children->comment_post_ID;
                                    $user = get_userdata( $comment_children->user_id );
                                    $user_role = $user->roles;
                                    $user_email = $user->user_email; ?>
                                    <div class="collapse comment__one-collapse show" id="answ__<?php echo $counter ?>">
                                        <div class="comment__one-hidden">
                                            <!-- comment -->
                                            <div class="comment__one">
                                                <div class="comment__one-header d-flex align-items-center">
                                                    <div class="comment__one-img mr-3">
                                                        <img src="<?php echo get_avatar_url( $comment, array(
                                                            'default'=>'identicon',) ); ?>" alt="">
                                                    </div>
                                                    <div class="d-md-flex justify-content-md-between w-100">
                                                        <div class="comment__one-title mb-2 mb-md-0"><?php echo $comment_children->comment_author; ?></div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                                                                <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                                                                <?php if($user_role[0] == ''):
                                                                    echo 'Гость';
                                                                endif;
                                                                if($user_role[0] != ''):
                                                                    echo $user_role[0];
                                                                endif; ?>
                                                            </div>

                                                            <!--                                                        <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">-->
                                                            <!--                                                            <div class="mr-2"><svg width="18" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="--><?php //bloginfo('template_url'); ?><!--/img/icons.svg#house" x="0" y="0"></use></svg></div>-->
                                                            <!--                                                            --><?php //$bank_id = get_field('bank_choise', $comment_post_id); ?>
                                                            <!--                                                            --><?php //echo get_the_title($bank_id); ?>
                                                            <!--                                                        </div>-->

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="comment__one-content">
                                                    <?php echo $comment_children->comment_content; ?>
                                                </div>
                                                <div class="comment__one-footer d-flex flex-wrap align-items-center">
                                                    <div class="comment__one-date order-md-1">
                                                        <?php echo  get_comment_date('d.m.y', $comment_id_children); ?> в
                                                        <?php echo get_comment_date('H:i', $comment_id_children); ?>
                                                    </div>
                                                    <?php echo comment_reply_link( [ 'reply_text' => "Ответить", 'depth' => -1 ], $comment_id, ); ?>


                                                    <div class="comment-reply-link2">
                                                        <?php echo comment_reply_link( [ 'reply_text' => "Цитировать", 'depth' => -1, 'add_below' => 'comment' ], $comment_id, ); ?>

                                                    </div>


                                                    <a href="#" data-id="<?php echo $comment_id; ?>" class="complain-btn">

                                                        <div class="tooltip">
                                                            <div class="tooltip__trigger">

                                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M8.0026 10.6666V7.99992M8.0026 5.33325H8.00927M14.6693 7.99992C14.6693 11.6818 11.6845 14.6666 8.0026 14.6666C4.32071 14.6666 1.33594 11.6818 1.33594 7.99992C1.33594 4.31802 4.32071 1.33325 8.0026 1.33325C11.6845 1.33325 14.6693 4.31802 14.6693 7.99992Z" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>

                                                            </div>
                                                            <div class="tooltip__drop">Введите все нужные вам параметры в калькулятори и получите точный ежемесячный платеж с процентной визуализацией выгоды</div>
                                                        </div>

                                                        Пожаловаться

                                                    </a>
                                                    <div class="comment__one-like order-md-4 ml-auto d-flex justify-content-between">
                                                        <?php comments_like_dislike($comment_id_children); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- comment -->
                                        </div>
                                    </div>
                                <?php } endif; ?>
                        </div>
                        <!-- /item -->
                    <?php } ?>
                    <?php if(count($comments) !="0"): ?>
                        <div class="comments__action text-center">
                            <a href="<?php //echo  get_page_link(1503); ?><?php the_permalink(); ?>comments/" class="btn btn-outline-alternative" post-id="<?php echo $ID ?>">Больше отзывов</a>
                        </div>
                    <?php endif; ?>


                    <div class="mt-4">
                        <input class="show__custom_form_v1 btn btn-primary px-5" value="Оставить комментарий">
                    </div>

                </div>
            </div>
        </div>

        <div class="section">
            <div class="form custom_form_v1" id="commentForm" style="display: none">
                <?
                $new_args = $args + ['is_detail_page' => 'N'];
                get_template_part( 'all_template/commentForm', null, $args);
                ?>
            </div>
        </div>
        <!-- / comments -->



	    <!-- similar offers -->
	    <!-- / similar offers -->




	    <!-- wysiwyg text -->
	    <div class="section">
	        <div class="wysiwyg  ">
	           <?php the_content(); ?>
	        </div>

            <?php $date_actually = get_the_modified_date('d.m.Y', $ID); ?>
            <? if($date_actually): ?>
                <div class="date_actually-article mb-2">Обновлено: <?= $date_actually;?></div>
            <? endif; ?>


            <?php
            //wp_reset_postdata();

            $author_id = get_field('page_author_new', $ID); ?>


            <?php if($author_id): ?>
                <div class="article__one-footer-meta ml-md-auto">
                    <div class="article__one-footer-img">
                        <?php get_template_part( 'all_template/image_and_alt/card_author-img', null, $author_id); ?>
                    </div>
                    <div class="article__one-footer-name">
                        Автор <br>
                        <a class="article__one-footer-link stretched-link" href="<?php echo the_permalink($author_id) ?>">
                            <?php echo get_the_title($author_id) ?>
                        </a>
                    </div>
                </div>

            <?php endif; ?>

	    </div>
	    <!-- / wysiwyg text -->

        <section class="useful-information-form section">
                <div class="row">
                    <div class="title">Информация была полезна?</div>
                    <?php echo do_shortcode( '[ratings id="'.$ID.'"  ]' ); ?>
                </div>
        </section>


<!--        <div class="input-select-star">-->
<!--            <div data-id="1" class="star">-->
<!--                <div class="active">-->
<!--                    <svg width="25" height="25" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M17.5653 1.90663C18.0263 0.972754 18.2568 0.505815 18.5697 0.356628C18.8419 0.226827 19.1582 0.226827 19.4304 0.356628C19.7433 0.505815 19.9738 0.972754 20.4348 1.90663L24.8081 10.7666C24.9442 11.0423 25.0123 11.1801 25.1117 11.2872C25.1997 11.3819 25.3053 11.4587 25.4226 11.5132C25.5551 11.5748 25.7072 11.5971 26.0114 11.6415L35.794 13.0714C36.8241 13.222 37.3392 13.2973 37.5776 13.5489C37.785 13.7678 37.8825 14.0686 37.843 14.3675C37.7976 14.7112 37.4247 15.0744 36.6789 15.8008L29.6029 22.6928C29.3823 22.9077 29.272 23.0151 29.2009 23.1429C29.1378 23.2561 29.0974 23.3804 29.0818 23.509C29.0642 23.6542 29.0902 23.806 29.1423 24.1095L30.8119 33.8442C30.988 34.871 31.0761 35.3844 30.9106 35.689C30.7666 35.9541 30.5107 36.14 30.2141 36.1949C29.8732 36.2581 29.4122 36.0157 28.4902 35.5308L19.7448 30.9317C19.4723 30.7884 19.336 30.7167 19.1925 30.6886C19.0654 30.6636 18.9347 30.6636 18.8076 30.6886C18.664 30.7167 18.5278 30.7884 18.2553 30.9317L9.50985 35.5308C8.58783 36.0157 8.12682 36.2581 7.78594 36.1949C7.48936 36.14 7.23344 35.9541 7.08947 35.689C6.924 35.3844 7.01205 34.871 7.18815 33.8442L8.85777 24.1095C8.90982 23.806 8.93585 23.6542 8.91824 23.509C8.90265 23.3804 8.86222 23.2561 8.79921 23.1429C8.72804 23.0151 8.61775 22.9077 8.39717 22.6928L1.32112 15.8008C0.575326 15.0744 0.202429 14.7112 0.157053 14.3675C0.117572 14.0686 0.215107 13.7678 0.422501 13.5489C0.66087 13.2973 1.17594 13.222 2.20609 13.0714L11.9886 11.6415C12.2928 11.5971 12.445 11.5748 12.5774 11.5132C12.6947 11.4587 12.8003 11.3819 12.8884 11.2872C12.9878 11.1801 13.0559 11.0423 13.1919 10.7666L17.5653 1.90663Z" fill="#14B8AD"/>-->
<!--                    </svg>-->
<!--                </div>-->
<!--                <div class="show deactivate">-->
<!--                    <svg width="25" height="25" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M18.5653 2.90663C19.0263 1.97275 19.2568 1.50582 19.5697 1.35663C19.8419 1.22683 20.1582 1.22683 20.4304 1.35663C20.7433 1.50582 20.9738 1.97275 21.4348 2.90663L25.8081 11.7666C25.9442 12.0423 26.0123 12.1801 26.1117 12.2872C26.1997 12.3819 26.3053 12.4587 26.4226 12.5132C26.5551 12.5748 26.7072 12.5971 27.0114 12.6415L36.794 14.0714C37.8241 14.222 38.3392 14.2973 38.5776 14.5489C38.785 14.7678 38.8825 15.0686 38.843 15.3675C38.7976 15.7112 38.4247 16.0744 37.6789 16.8008L30.6029 23.6928C30.3823 23.9077 30.272 24.0151 30.2009 24.1429C30.1378 24.2561 30.0974 24.3804 30.0818 24.509C30.0642 24.6542 30.0902 24.806 30.1423 25.1095L31.8119 34.8442C31.988 35.871 32.0761 36.3844 31.9106 36.689C31.7666 36.9541 31.5107 37.14 31.2141 37.1949C30.8732 37.2581 30.4122 37.0157 29.4902 36.5308L20.7448 31.9317C20.4723 31.7884 20.336 31.7167 20.1925 31.6886C20.0654 31.6636 19.9347 31.6636 19.8076 31.6886C19.664 31.7167 19.5278 31.7884 19.2553 31.9317L10.5098 36.5308C9.58783 37.0157 9.12682 37.2581 8.78594 37.1949C8.48936 37.14 8.23344 36.9541 8.08947 36.689C7.924 36.3844 8.01205 35.871 8.18815 34.8442L9.85777 25.1095C9.90982 24.806 9.93585 24.6542 9.91824 24.509C9.90265 24.3804 9.86222 24.2561 9.79921 24.1429C9.72804 24.0151 9.61775 23.9077 9.39717 23.6928L2.32112 16.8008C1.57533 16.0744 1.20243 15.7112 1.15705 15.3675C1.11757 15.0686 1.21511 14.7678 1.4225 14.5489C1.66087 14.2973 2.17594 14.222 3.20609 14.0714L12.9886 12.6415C13.2928 12.5971 13.445 12.5748 13.5774 12.5132C13.6947 12.4587 13.8003 12.3819 13.8884 12.2872C13.9878 12.1801 14.0559 12.0423 14.1919 11.7666L18.5653 2.90663Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    </svg>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div data-id="2" class="star">-->
<!--                <div class="active">-->
<!--                    <svg width="25" height="25" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M17.5653 1.90663C18.0263 0.972754 18.2568 0.505815 18.5697 0.356628C18.8419 0.226827 19.1582 0.226827 19.4304 0.356628C19.7433 0.505815 19.9738 0.972754 20.4348 1.90663L24.8081 10.7666C24.9442 11.0423 25.0123 11.1801 25.1117 11.2872C25.1997 11.3819 25.3053 11.4587 25.4226 11.5132C25.5551 11.5748 25.7072 11.5971 26.0114 11.6415L35.794 13.0714C36.8241 13.222 37.3392 13.2973 37.5776 13.5489C37.785 13.7678 37.8825 14.0686 37.843 14.3675C37.7976 14.7112 37.4247 15.0744 36.6789 15.8008L29.6029 22.6928C29.3823 22.9077 29.272 23.0151 29.2009 23.1429C29.1378 23.2561 29.0974 23.3804 29.0818 23.509C29.0642 23.6542 29.0902 23.806 29.1423 24.1095L30.8119 33.8442C30.988 34.871 31.0761 35.3844 30.9106 35.689C30.7666 35.9541 30.5107 36.14 30.2141 36.1949C29.8732 36.2581 29.4122 36.0157 28.4902 35.5308L19.7448 30.9317C19.4723 30.7884 19.336 30.7167 19.1925 30.6886C19.0654 30.6636 18.9347 30.6636 18.8076 30.6886C18.664 30.7167 18.5278 30.7884 18.2553 30.9317L9.50985 35.5308C8.58783 36.0157 8.12682 36.2581 7.78594 36.1949C7.48936 36.14 7.23344 35.9541 7.08947 35.689C6.924 35.3844 7.01205 34.871 7.18815 33.8442L8.85777 24.1095C8.90982 23.806 8.93585 23.6542 8.91824 23.509C8.90265 23.3804 8.86222 23.2561 8.79921 23.1429C8.72804 23.0151 8.61775 22.9077 8.39717 22.6928L1.32112 15.8008C0.575326 15.0744 0.202429 14.7112 0.157053 14.3675C0.117572 14.0686 0.215107 13.7678 0.422501 13.5489C0.66087 13.2973 1.17594 13.222 2.20609 13.0714L11.9886 11.6415C12.2928 11.5971 12.445 11.5748 12.5774 11.5132C12.6947 11.4587 12.8003 11.3819 12.8884 11.2872C12.9878 11.1801 13.0559 11.0423 13.1919 10.7666L17.5653 1.90663Z" fill="#14B8AD"/>-->
<!--                    </svg>-->
<!--                </div>-->
<!--                <div class="show deactivate">-->
<!--                    <svg width="25" height="25" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M18.5653 2.90663C19.0263 1.97275 19.2568 1.50582 19.5697 1.35663C19.8419 1.22683 20.1582 1.22683 20.4304 1.35663C20.7433 1.50582 20.9738 1.97275 21.4348 2.90663L25.8081 11.7666C25.9442 12.0423 26.0123 12.1801 26.1117 12.2872C26.1997 12.3819 26.3053 12.4587 26.4226 12.5132C26.5551 12.5748 26.7072 12.5971 27.0114 12.6415L36.794 14.0714C37.8241 14.222 38.3392 14.2973 38.5776 14.5489C38.785 14.7678 38.8825 15.0686 38.843 15.3675C38.7976 15.7112 38.4247 16.0744 37.6789 16.8008L30.6029 23.6928C30.3823 23.9077 30.272 24.0151 30.2009 24.1429C30.1378 24.2561 30.0974 24.3804 30.0818 24.509C30.0642 24.6542 30.0902 24.806 30.1423 25.1095L31.8119 34.8442C31.988 35.871 32.0761 36.3844 31.9106 36.689C31.7666 36.9541 31.5107 37.14 31.2141 37.1949C30.8732 37.2581 30.4122 37.0157 29.4902 36.5308L20.7448 31.9317C20.4723 31.7884 20.336 31.7167 20.1925 31.6886C20.0654 31.6636 19.9347 31.6636 19.8076 31.6886C19.664 31.7167 19.5278 31.7884 19.2553 31.9317L10.5098 36.5308C9.58783 37.0157 9.12682 37.2581 8.78594 37.1949C8.48936 37.14 8.23344 36.9541 8.08947 36.689C7.924 36.3844 8.01205 35.871 8.18815 34.8442L9.85777 25.1095C9.90982 24.806 9.93585 24.6542 9.91824 24.509C9.90265 24.3804 9.86222 24.2561 9.79921 24.1429C9.72804 24.0151 9.61775 23.9077 9.39717 23.6928L2.32112 16.8008C1.57533 16.0744 1.20243 15.7112 1.15705 15.3675C1.11757 15.0686 1.21511 14.7678 1.4225 14.5489C1.66087 14.2973 2.17594 14.222 3.20609 14.0714L12.9886 12.6415C13.2928 12.5971 13.445 12.5748 13.5774 12.5132C13.6947 12.4587 13.8003 12.3819 13.8884 12.2872C13.9878 12.1801 14.0559 12.0423 14.1919 11.7666L18.5653 2.90663Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    </svg>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div data-id="3" class="star">-->
<!--                <div class="active">-->
<!--                    <svg width="25" height="25" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M17.5653 1.90663C18.0263 0.972754 18.2568 0.505815 18.5697 0.356628C18.8419 0.226827 19.1582 0.226827 19.4304 0.356628C19.7433 0.505815 19.9738 0.972754 20.4348 1.90663L24.8081 10.7666C24.9442 11.0423 25.0123 11.1801 25.1117 11.2872C25.1997 11.3819 25.3053 11.4587 25.4226 11.5132C25.5551 11.5748 25.7072 11.5971 26.0114 11.6415L35.794 13.0714C36.8241 13.222 37.3392 13.2973 37.5776 13.5489C37.785 13.7678 37.8825 14.0686 37.843 14.3675C37.7976 14.7112 37.4247 15.0744 36.6789 15.8008L29.6029 22.6928C29.3823 22.9077 29.272 23.0151 29.2009 23.1429C29.1378 23.2561 29.0974 23.3804 29.0818 23.509C29.0642 23.6542 29.0902 23.806 29.1423 24.1095L30.8119 33.8442C30.988 34.871 31.0761 35.3844 30.9106 35.689C30.7666 35.9541 30.5107 36.14 30.2141 36.1949C29.8732 36.2581 29.4122 36.0157 28.4902 35.5308L19.7448 30.9317C19.4723 30.7884 19.336 30.7167 19.1925 30.6886C19.0654 30.6636 18.9347 30.6636 18.8076 30.6886C18.664 30.7167 18.5278 30.7884 18.2553 30.9317L9.50985 35.5308C8.58783 36.0157 8.12682 36.2581 7.78594 36.1949C7.48936 36.14 7.23344 35.9541 7.08947 35.689C6.924 35.3844 7.01205 34.871 7.18815 33.8442L8.85777 24.1095C8.90982 23.806 8.93585 23.6542 8.91824 23.509C8.90265 23.3804 8.86222 23.2561 8.79921 23.1429C8.72804 23.0151 8.61775 22.9077 8.39717 22.6928L1.32112 15.8008C0.575326 15.0744 0.202429 14.7112 0.157053 14.3675C0.117572 14.0686 0.215107 13.7678 0.422501 13.5489C0.66087 13.2973 1.17594 13.222 2.20609 13.0714L11.9886 11.6415C12.2928 11.5971 12.445 11.5748 12.5774 11.5132C12.6947 11.4587 12.8003 11.3819 12.8884 11.2872C12.9878 11.1801 13.0559 11.0423 13.1919 10.7666L17.5653 1.90663Z" fill="#14B8AD"/>-->
<!--                    </svg>-->
<!--                </div>-->
<!--                <div class="show deactivate">-->
<!--                    <svg width="25" height="25" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M18.5653 2.90663C19.0263 1.97275 19.2568 1.50582 19.5697 1.35663C19.8419 1.22683 20.1582 1.22683 20.4304 1.35663C20.7433 1.50582 20.9738 1.97275 21.4348 2.90663L25.8081 11.7666C25.9442 12.0423 26.0123 12.1801 26.1117 12.2872C26.1997 12.3819 26.3053 12.4587 26.4226 12.5132C26.5551 12.5748 26.7072 12.5971 27.0114 12.6415L36.794 14.0714C37.8241 14.222 38.3392 14.2973 38.5776 14.5489C38.785 14.7678 38.8825 15.0686 38.843 15.3675C38.7976 15.7112 38.4247 16.0744 37.6789 16.8008L30.6029 23.6928C30.3823 23.9077 30.272 24.0151 30.2009 24.1429C30.1378 24.2561 30.0974 24.3804 30.0818 24.509C30.0642 24.6542 30.0902 24.806 30.1423 25.1095L31.8119 34.8442C31.988 35.871 32.0761 36.3844 31.9106 36.689C31.7666 36.9541 31.5107 37.14 31.2141 37.1949C30.8732 37.2581 30.4122 37.0157 29.4902 36.5308L20.7448 31.9317C20.4723 31.7884 20.336 31.7167 20.1925 31.6886C20.0654 31.6636 19.9347 31.6636 19.8076 31.6886C19.664 31.7167 19.5278 31.7884 19.2553 31.9317L10.5098 36.5308C9.58783 37.0157 9.12682 37.2581 8.78594 37.1949C8.48936 37.14 8.23344 36.9541 8.08947 36.689C7.924 36.3844 8.01205 35.871 8.18815 34.8442L9.85777 25.1095C9.90982 24.806 9.93585 24.6542 9.91824 24.509C9.90265 24.3804 9.86222 24.2561 9.79921 24.1429C9.72804 24.0151 9.61775 23.9077 9.39717 23.6928L2.32112 16.8008C1.57533 16.0744 1.20243 15.7112 1.15705 15.3675C1.11757 15.0686 1.21511 14.7678 1.4225 14.5489C1.66087 14.2973 2.17594 14.222 3.20609 14.0714L12.9886 12.6415C13.2928 12.5971 13.445 12.5748 13.5774 12.5132C13.6947 12.4587 13.8003 12.3819 13.8884 12.2872C13.9878 12.1801 14.0559 12.0423 14.1919 11.7666L18.5653 2.90663Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    </svg>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div data-id="4" class="star">-->
<!--                <div class="active">-->
<!--                    <svg width="25" height="25" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M17.5653 1.90663C18.0263 0.972754 18.2568 0.505815 18.5697 0.356628C18.8419 0.226827 19.1582 0.226827 19.4304 0.356628C19.7433 0.505815 19.9738 0.972754 20.4348 1.90663L24.8081 10.7666C24.9442 11.0423 25.0123 11.1801 25.1117 11.2872C25.1997 11.3819 25.3053 11.4587 25.4226 11.5132C25.5551 11.5748 25.7072 11.5971 26.0114 11.6415L35.794 13.0714C36.8241 13.222 37.3392 13.2973 37.5776 13.5489C37.785 13.7678 37.8825 14.0686 37.843 14.3675C37.7976 14.7112 37.4247 15.0744 36.6789 15.8008L29.6029 22.6928C29.3823 22.9077 29.272 23.0151 29.2009 23.1429C29.1378 23.2561 29.0974 23.3804 29.0818 23.509C29.0642 23.6542 29.0902 23.806 29.1423 24.1095L30.8119 33.8442C30.988 34.871 31.0761 35.3844 30.9106 35.689C30.7666 35.9541 30.5107 36.14 30.2141 36.1949C29.8732 36.2581 29.4122 36.0157 28.4902 35.5308L19.7448 30.9317C19.4723 30.7884 19.336 30.7167 19.1925 30.6886C19.0654 30.6636 18.9347 30.6636 18.8076 30.6886C18.664 30.7167 18.5278 30.7884 18.2553 30.9317L9.50985 35.5308C8.58783 36.0157 8.12682 36.2581 7.78594 36.1949C7.48936 36.14 7.23344 35.9541 7.08947 35.689C6.924 35.3844 7.01205 34.871 7.18815 33.8442L8.85777 24.1095C8.90982 23.806 8.93585 23.6542 8.91824 23.509C8.90265 23.3804 8.86222 23.2561 8.79921 23.1429C8.72804 23.0151 8.61775 22.9077 8.39717 22.6928L1.32112 15.8008C0.575326 15.0744 0.202429 14.7112 0.157053 14.3675C0.117572 14.0686 0.215107 13.7678 0.422501 13.5489C0.66087 13.2973 1.17594 13.222 2.20609 13.0714L11.9886 11.6415C12.2928 11.5971 12.445 11.5748 12.5774 11.5132C12.6947 11.4587 12.8003 11.3819 12.8884 11.2872C12.9878 11.1801 13.0559 11.0423 13.1919 10.7666L17.5653 1.90663Z" fill="#14B8AD"/>-->
<!--                    </svg>-->
<!--                </div>-->
<!--                <div class="show deactivate">-->
<!--                    <svg width="25" height="25" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M18.5653 2.90663C19.0263 1.97275 19.2568 1.50582 19.5697 1.35663C19.8419 1.22683 20.1582 1.22683 20.4304 1.35663C20.7433 1.50582 20.9738 1.97275 21.4348 2.90663L25.8081 11.7666C25.9442 12.0423 26.0123 12.1801 26.1117 12.2872C26.1997 12.3819 26.3053 12.4587 26.4226 12.5132C26.5551 12.5748 26.7072 12.5971 27.0114 12.6415L36.794 14.0714C37.8241 14.222 38.3392 14.2973 38.5776 14.5489C38.785 14.7678 38.8825 15.0686 38.843 15.3675C38.7976 15.7112 38.4247 16.0744 37.6789 16.8008L30.6029 23.6928C30.3823 23.9077 30.272 24.0151 30.2009 24.1429C30.1378 24.2561 30.0974 24.3804 30.0818 24.509C30.0642 24.6542 30.0902 24.806 30.1423 25.1095L31.8119 34.8442C31.988 35.871 32.0761 36.3844 31.9106 36.689C31.7666 36.9541 31.5107 37.14 31.2141 37.1949C30.8732 37.2581 30.4122 37.0157 29.4902 36.5308L20.7448 31.9317C20.4723 31.7884 20.336 31.7167 20.1925 31.6886C20.0654 31.6636 19.9347 31.6636 19.8076 31.6886C19.664 31.7167 19.5278 31.7884 19.2553 31.9317L10.5098 36.5308C9.58783 37.0157 9.12682 37.2581 8.78594 37.1949C8.48936 37.14 8.23344 36.9541 8.08947 36.689C7.924 36.3844 8.01205 35.871 8.18815 34.8442L9.85777 25.1095C9.90982 24.806 9.93585 24.6542 9.91824 24.509C9.90265 24.3804 9.86222 24.2561 9.79921 24.1429C9.72804 24.0151 9.61775 23.9077 9.39717 23.6928L2.32112 16.8008C1.57533 16.0744 1.20243 15.7112 1.15705 15.3675C1.11757 15.0686 1.21511 14.7678 1.4225 14.5489C1.66087 14.2973 2.17594 14.222 3.20609 14.0714L12.9886 12.6415C13.2928 12.5971 13.445 12.5748 13.5774 12.5132C13.6947 12.4587 13.8003 12.3819 13.8884 12.2872C13.9878 12.1801 14.0559 12.0423 14.1919 11.7666L18.5653 2.90663Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    </svg>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div data-id="5" class="star">-->
<!--                <div class="active">-->
<!--                    <svg width="25" height="25" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M17.5653 1.90663C18.0263 0.972754 18.2568 0.505815 18.5697 0.356628C18.8419 0.226827 19.1582 0.226827 19.4304 0.356628C19.7433 0.505815 19.9738 0.972754 20.4348 1.90663L24.8081 10.7666C24.9442 11.0423 25.0123 11.1801 25.1117 11.2872C25.1997 11.3819 25.3053 11.4587 25.4226 11.5132C25.5551 11.5748 25.7072 11.5971 26.0114 11.6415L35.794 13.0714C36.8241 13.222 37.3392 13.2973 37.5776 13.5489C37.785 13.7678 37.8825 14.0686 37.843 14.3675C37.7976 14.7112 37.4247 15.0744 36.6789 15.8008L29.6029 22.6928C29.3823 22.9077 29.272 23.0151 29.2009 23.1429C29.1378 23.2561 29.0974 23.3804 29.0818 23.509C29.0642 23.6542 29.0902 23.806 29.1423 24.1095L30.8119 33.8442C30.988 34.871 31.0761 35.3844 30.9106 35.689C30.7666 35.9541 30.5107 36.14 30.2141 36.1949C29.8732 36.2581 29.4122 36.0157 28.4902 35.5308L19.7448 30.9317C19.4723 30.7884 19.336 30.7167 19.1925 30.6886C19.0654 30.6636 18.9347 30.6636 18.8076 30.6886C18.664 30.7167 18.5278 30.7884 18.2553 30.9317L9.50985 35.5308C8.58783 36.0157 8.12682 36.2581 7.78594 36.1949C7.48936 36.14 7.23344 35.9541 7.08947 35.689C6.924 35.3844 7.01205 34.871 7.18815 33.8442L8.85777 24.1095C8.90982 23.806 8.93585 23.6542 8.91824 23.509C8.90265 23.3804 8.86222 23.2561 8.79921 23.1429C8.72804 23.0151 8.61775 22.9077 8.39717 22.6928L1.32112 15.8008C0.575326 15.0744 0.202429 14.7112 0.157053 14.3675C0.117572 14.0686 0.215107 13.7678 0.422501 13.5489C0.66087 13.2973 1.17594 13.222 2.20609 13.0714L11.9886 11.6415C12.2928 11.5971 12.445 11.5748 12.5774 11.5132C12.6947 11.4587 12.8003 11.3819 12.8884 11.2872C12.9878 11.1801 13.0559 11.0423 13.1919 10.7666L17.5653 1.90663Z" fill="#14B8AD"/>-->
<!--                    </svg>-->
<!--                </div>-->
<!--                <div class="show deactivate">-->
<!--                    <svg width="25" height="25" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M18.5653 2.90663C19.0263 1.97275 19.2568 1.50582 19.5697 1.35663C19.8419 1.22683 20.1582 1.22683 20.4304 1.35663C20.7433 1.50582 20.9738 1.97275 21.4348 2.90663L25.8081 11.7666C25.9442 12.0423 26.0123 12.1801 26.1117 12.2872C26.1997 12.3819 26.3053 12.4587 26.4226 12.5132C26.5551 12.5748 26.7072 12.5971 27.0114 12.6415L36.794 14.0714C37.8241 14.222 38.3392 14.2973 38.5776 14.5489C38.785 14.7678 38.8825 15.0686 38.843 15.3675C38.7976 15.7112 38.4247 16.0744 37.6789 16.8008L30.6029 23.6928C30.3823 23.9077 30.272 24.0151 30.2009 24.1429C30.1378 24.2561 30.0974 24.3804 30.0818 24.509C30.0642 24.6542 30.0902 24.806 30.1423 25.1095L31.8119 34.8442C31.988 35.871 32.0761 36.3844 31.9106 36.689C31.7666 36.9541 31.5107 37.14 31.2141 37.1949C30.8732 37.2581 30.4122 37.0157 29.4902 36.5308L20.7448 31.9317C20.4723 31.7884 20.336 31.7167 20.1925 31.6886C20.0654 31.6636 19.9347 31.6636 19.8076 31.6886C19.664 31.7167 19.5278 31.7884 19.2553 31.9317L10.5098 36.5308C9.58783 37.0157 9.12682 37.2581 8.78594 37.1949C8.48936 37.14 8.23344 36.9541 8.08947 36.689C7.924 36.3844 8.01205 35.871 8.18815 34.8442L9.85777 25.1095C9.90982 24.806 9.93585 24.6542 9.91824 24.509C9.90265 24.3804 9.86222 24.2561 9.79921 24.1429C9.72804 24.0151 9.61775 23.9077 9.39717 23.6928L2.32112 16.8008C1.57533 16.0744 1.20243 15.7112 1.15705 15.3675C1.11757 15.0686 1.21511 14.7678 1.4225 14.5489C1.66087 14.2973 2.17594 14.222 3.20609 14.0714L12.9886 12.6415C13.2928 12.5971 13.445 12.5748 13.5774 12.5132C13.6947 12.4587 13.8003 12.3819 13.8884 12.2872C13.9878 12.1801 14.0559 12.0423 14.1919 11.7666L18.5653 2.90663Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    </svg>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <input type="hidden" id="input-select-star" name="star" value="">-->





<!-- CONTAINER -->
    </div>
</main>

<?php get_footer() ?>