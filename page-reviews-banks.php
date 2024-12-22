<?php session_start(); ?>
<?php get_header() ?>

<?php 
/*
$ID = $_SESSION['post_review_id'];
$TAX = $_SESSION['data_tax_reviews'];
$DISPLAY = $_SESSION['display_type'];

$post_type = get_post_type($ID);
$tags = get_the_tags( $ID );
$terms = wp_get_post_terms( $ID, 'bankcards', array('fields' => 'all') );
$term_slug = $terms[0]->slug;
$term_id = $terms[0]->term_id;

*/
// Отзывы вариант 1

 
       $tax_id = 2;
       $title_term1 = "Банки";
       $title_term2 = "все банки";
       $link = get_post_type_archive_link('banks');
       $calc_link = get_page_link(149);
       $news_id = "16";
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
                    <h3 class="font-weight-semibold mt-2 mb-0">Благодаря честным отзывам вы сможете осуществить более разумный выбор</h3>
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
$custom_offset = ($paged - 1)*$ppp;

// fetch posts in all those categories
$posts = get_cpt_ids('banks');

$sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
 FROM {$wpdb->comments} WHERE
 comment_post_ID in (".implode(',', $posts).") AND comment_approved = 1 AND comment_parent = 0
 ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

$sql_posts_total =  $wpdb->get_var("SELECT COUNT(*)  FROM {$wpdb->comments} WHERE
 comment_post_ID in (".implode(',', $posts).") AND comment_approved = 1 AND comment_parent = 0
 ORDER by comment_date DESC");


$max_num_pages = ceil($sql_posts_total / $ppp);
$comments_list = $wpdb->get_results( $sql );

$count_items = count( $comments_list );

//if($count_items < 1){
//    global $wp_query;
//    $url_clear = get_clear_url($_SERVER['REQUEST_URI']);
//    wp_redirect( $url_clear, 301 );
//    //$wp_query->set_404();
//    //status_header( 404 );
//    //nocache_headers();
//    //require get_404_template();
//}


if ( count( $comments_list ) > 0 ) {
 foreach ( $comments_list as $comm ) {

 $comment_id = $comm->comment_ID;
 $comment = get_comment($comment_id);
 $comment_post_id = $comment->comment_post_ID;
 $parent_comment = $comment->comment_parent; 
 $user = get_userdata( $comment->user_id );
 $user_email = $user->user_email;
 $author = get_comment_author( $comment_id );
 $user_role = $user->roles; 
 $city = get_comment_meta( $comment_id, 'city', true ); ?>
 <?php if($parent_comment == 0): ?>
 <!-- item -->
        <div class="reviews__item col-12 col-md-6 col-lg-4 mb-5 reviews__page-item">
            <div class="reviews__item-body">    
                <div class="reviews__header d-flex align-items-center mb-2">
                    <div class="reviews__header-logo">
                        <img src="<?php echo the_field('bank_logo', $comment_post_id) ?>"
                             alt="<?
                             $bank_id = get_field('bank_logo' , $comment_post_id, false);
                             $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                             echo $bank_alt;
                             ?>"
                        >
                    </div>
                    <div class="reviews__header-meta ml-3">
                        <a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($comment_post_id) ?></a>
                        <div class="d-flex">
                            <div class="card__rating d-flex align-items-center mr-3">
                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                <?php echo the_field('ratings_average', $comment_post_id); ?>  
                            </div>
                            <div class="card__icon d-flex align-items-center">
                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                <?php echo comments_number( '0', '1', '%', $comment_post_id); ?>
                            </div>
                            <div class="card__date d-none d-sm-block ml-auto"><?php echo  get_comment_date( 'd.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
                        </div>
                    </div>
                </div>
                <div class="reviews__item-content">
                    <p><?php echo $comment->comment_content; ?></p>
                </div>
            </div>
            <div class="reviews__item-footer">
                <div class="reviews__author d-flex align-items-center mt-3">
                    <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url( $comment, array('size' => 60,
                   'default'=>'identicon',) ); ?>" alt="<?php echo $author; ?>"></div>
                    <div class="reviews__author-content">
                        <a href="" class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                        <div class="reviews__author-info d-flex">
                            <div class="card__icon d-flex align-items-center mr-3">
                                <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                                <?php if($user_role[0] == ''):
                                    echo 'Гость';
                                endif; 
                                if($user_role[0] != ''):
                                    echo $user_role[0]; 
                                endif; ?>
                            </div>
                            <?php if($city != ''): ?>
                               <div class="card__icon d-flex align-items-center">
                                   <div class="mr-2"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#pointer" x="0" y="0"></use></svg></div>
                                   <?php echo $city ?>
                               </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / item -->
    <?php endif; ?>
<?php } 
}else{ ?>
<p class="col-12">Пока нет отзывов.</p>
<?php } ?>

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
                        из <span class="count_all"><?php echo $sql_posts_total;?></span>
                    </div>
                </div>
            </div>
            <!-- / pagination -->
        </div>
    </div>
</main>







































<?php 
// Комментарии вариант 2
if($ID != ''  && $DISPLAY == 'comments'): ?>
<?php if($post_type == "bankcard"):
switch ($term_slug) {
    case 'debetcard':
       $title_term = "дебетовой карте";
       $title_term1 = "Дебетовой карты";
        break;
    case 'installmentcard':
       $title_term = "карте рассрочки";
       $title_term1 = "Карты рассрочки";
        break;
    case 'creditcard':
       $title_term = "кредитной карте";
       $title_term1 = "Кредитные карты";
        break;      
    default:
       $title_term = "банковской карте";
       $title_term1 = "Банковские карты";
}
?>

<main>
    <div class="container">
        <nav aria-label="breadcrumb" class="horizontal__scroll">
            <ol class="breadcrumb horizontal__scroll-container">
                <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_term_link($term_id, '') ?>"><?php echo $title_term1 ?></a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_the_permalink($ID) ?>"><?php echo get_the_title($ID) ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
            </ol>
        </nav>
        <div class="section">
            <div class="section__header mb-4 d-sm-flex justify-content-between align-items-center">
                <h2 class="title mb-0">Отзывы о <?php echo $title_term ?> "<?php echo get_the_title($ID) ?>"</h2>
                <button class="btn btn-primary btn-sm btn-scroll section__header-btn mt-4 mt-sm-0" data-target="commentForm">Оставить отзыв</button>
            </div>
            <div class="comments comments-page-list" id="comments">
                    <?php comments_template(); ?>
            </div>
                <!-- pagination -->
              <div class="pagination flex-column">
                  <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                      <div class="pagination__description mt-4 mt-sm-0">
                          Показано <span class="review-count"> отзывов</span> из <?php echo get_comments_number($ID) ?>
                      </div>
                  </div>
              </div>
              <!-- / pagination -->
        </div>
        <div class="section">
            <!-- form -->
            <div class="form" id="commentForm">
                <?php 
                    // получим данные из куков
                    $commenter = wp_get_current_commenter();
                    $args = wp_parse_args( $args );
                    if ( ! isset( $args['format'] ) ) {
                        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
                    }
                    $html5 = 'html5' === $args['format'];
                    // определим поля которые нужно вывести
                    $req = get_option( 'require_name_email' ) ? ' <span class="required">*</span>' : '';

                    $aria_req = $req ? " aria-required='true'" : '';
                    $html_req = $req ? " required='required'"  : '';

                    $city =  do_shortcode( "[wt_geotargeting get='city']" ); 
                    $defaults = [
                        'fields'               => [
                            'author' => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="author" class="form-control" placeholder="Имя"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . $html_req . ' required="required" />
                                                </div>
                                            </div>',
                            'email'  => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="email" class="form-control" placeholder="E-Mail" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' required="required"/>
                                                </div>
                                            </div>',
                            'city' => '<div class="col-12 col-md-6" style="display: none">
                                            <div class="mb-3">
                                                <input id="city" class="form-control" placeholder="Город"  name="city" type="text" value="' . $city . '" ' . $aria_req . $html_req . ' />
                                                </div>
                                            </div>',
                        ],
                        'comment_field'        => '<div class="col-12">
                                                        <textarea id="comment" name="comment" class="form-control" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
                                                    </div>',
                        'logged_in_as'         => '<div class="col-12 mb-2">' .
                             sprintf( __( '<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $ID ) ) ) ) . '
                         </div>',
                        'comment_notes_before'  => '',
                        'comment_notes_after'  => '',
                        'id_form'              => 'commentform',
                        'id_submit'            => 'submit',
                        'class_container'      => 'comment-respond',
                        'class_form'           => 'comment-form row',
                        'class_submit'         => 'submit',
                        'name_submit'          => 'submit',
                        'title_reply'          => '',
                        'title_reply_to'       => '',
                        'title_reply_before'   => '',
                        'title_reply_after'    => '',
                        'cancel_reply_before'  => '',
                        'cancel_reply_after'   => '',
                        'cancel_reply_link'    => '',
                        'label_submit'         => '',
                        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5 reviews-page-link-submit mb-3" value="Отправить" />',
                        'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                        'format'               => 'xhtml',
                    ];
                    echo comment_form( $defaults, $ID); ?>
            </div>
            <!-- / from -->
        </div>
        <div class="section">
            <div class="section__header d-flex justify-content-between align-items-center mb-4">
               <h2 class="title mb-0">Лучшие предложения </h2>
               <a href="<?php echo get_term_link($term_id, '') ?>" class="btn btn-primary btn-sm btn-all">
                   Все
                   <span class="icon ml-2">
                       <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
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
    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
    'order' => 'DESC', 
    'tax_query' => array(
        array(
            'taxonomy' => 'bankcards',
            'field'    => 'slug',
            'terms'    =>  $term_slug,
        ),
    )
);

$query = new WP_Query( $args );
// Цикл
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        ?>
        <!-- item -->
                   <div class="card card__vertical size4 offer h-100">
                       <div class="card-container p-3">
                           <div class="card__header mb-2 d-flex">
                               <div class="card__header-img">
                                   <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                               </div>
                               <div class="card__header-title"><?php echo the_title() ?></div>
                           </div>
                           <div class="card__header-info d-flex align-items-center">
                               <div class="card__rating d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                   <?php echo the_field('ratings_average'); ?>
                               </div>
                               <div class="card__icon d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                  <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->approved ?>
                               </div>
                               <div class="card__like d-flex align-items-center">
                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                               <div class="card__header-actions ml-auto">
                                   <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                               </div>                                
                           </div>
                           <div class="card__image my-3">
                               <img src="<?php echo the_field('card_logo') ?>" alt="">
                           </div>

                           <ul class="leaders">
                            <?php $loop_terms = wp_get_post_terms( get_the_ID(), 'bankcards', array('fields' => 'all') );
                                 $loop_term_slug = $loop_terms[0]->slug;
                                 $$loop_term_id = $terms[0]->term_id; ?>
                            <?php if($loop_term_slug == 'creditcard'): ?>
                           <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Лимит</div>
                                   <div class="leaders__item-value"><?php echo the_field('card_cred_limit') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Без %</div>
                                   <div class="leaders__item-value"><?php $field = get_field('card_period');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Кэшбэк</div>
                                   <div class="leaders__item-value"><?php $card_cashback = get_field('card_cashback', $ID); 
                                       echo $card_cashback; ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Ставка</div>
                                   <div class="leaders__item-value">от <?php echo the_field('card_stavka') ?>%</div>
                               </li>
                           </div>
                            <?php endif; ?>
                            <?php if($loop_term_slug == 'installmentcard'): ?>
                           <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Лимит</div>
                                   <div class="leaders__item-value"><?php echo the_field('card_cred_limit') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Без %</div>
                                   <div class="leaders__item-value"><?php $field = get_field('card_period');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Кэшбэк</div>
                                   <div class="leaders__item-value"><?php $card_cashback = get_field('card_cashback', $ID); 
                                       echo $card_cashback; ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Ставка</div>
                                   <div class="leaders__item-value">от <?php echo the_field('card_stavka') ?>%</div>
                               </li>
                           </div>
                            <?php endif; ?>
                           <?php if($loop_term_slug == 'debetcard'): ?>
                            <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Снятие без %</div>
                                   <div class="leaders__item-value">До <?php echo the_field('non_pecent_money') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">% на остаток</div>
                                   <div class="leaders__item-value">До <?php echo the_field('card_stavka_ostatok') ?> %</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Тип кешбэка</div>
                                   <div class="leaders__item-value"><?php $field = get_field('card_cashback_type');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Кешбэк</div>
                                   <div class="leaders__item-value"><?php $field = get_field('card_cashback');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                           </div>
                            <?php endif; ?>
                               
                           </ul>
                           <div class="card__actions mt-3 d-flex">
                               <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                               <a class="btn__compare btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo $term_slug; ?>">
                                   <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use></svg>
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
    </div>
</main>
<?php endif; ?>
<?php if($post_type == "banks"): ?>
<main>
    <div class="container">
        <nav aria-label="breadcrumb" class="horizontal__scroll">
            <ol class="breadcrumb horizontal__scroll-container">
                <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('banks'); ?>">Банки</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_the_permalink($ID) ?>"><?php echo get_the_title($ID) ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
            </ol>
        </nav>
        <div class="section">
            <div class="section__header mb-4 d-sm-flex justify-content-between align-items-center">
                <h2 class="title mb-0">Отзывы о банке "<?php echo get_the_title($ID) ?>"</h2>
                <button class="btn btn-primary btn-sm btn-scroll section__header-btn mt-4 mt-sm-0" data-target="commentForm">Оставить отзыв</button>
            </div>
            <div class="comments comments-page-list" id="comments">
                    <?php comments_template(); ?>
            </div>
                <!-- pagination -->
              <div class="pagination flex-column">
                  <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                      <div class="pagination__description mt-4 mt-sm-0">
                          Показано <span class="review-count"> отзывов</span> из <?php echo get_comments_number($ID) ?>
                      </div>
                  </div>
              </div>
              <!-- / pagination -->
        </div>
        <div class="section">
            <!-- form -->
            <div class="form" id="commentForm">
                <?php 
                    // получим данные из куков
                    $commenter = wp_get_current_commenter();
                    $args = wp_parse_args( $args );
                    if ( ! isset( $args['format'] ) ) {
                        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
                    }
                    $html5 = 'html5' === $args['format'];
                    // определим поля которые нужно вывести
                    $req = get_option( 'require_name_email' ) ? ' <span class="required">*</span>' : '';

                    $aria_req = $req ? " aria-required='true'" : '';
                    $html_req = $req ? " required='required'"  : '';

                    $city =  do_shortcode( "[wt_geotargeting get='city']" ); 
                    $defaults = [
                        'fields'               => [
                            'author' => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="author" class="form-control" placeholder="Имя"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . $html_req . ' required="required" />
                                                </div>
                                            </div>',
                            'email'  => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="email" class="form-control" placeholder="E-Mail" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' required="required"/>
                                                </div>
                                            </div>',
                            'city' => '<div class="col-12 col-md-6" style="display: none;">
                                            <div class="mb-3">
                                                <input id="city" class="form-control" placeholder="Город"  name="city" type="text" value="' . $city . '" ' . $aria_req . $html_req . ' />
                                                </div>
                                            </div>',
                        ],
                        'comment_field'        => '<div class="col-12">
                                                        <textarea id="comment" name="comment" class="form-control" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
                                                    </div>',
                        'logged_in_as'         => '<div class="col-12 mb-2">' .
                             sprintf( __( '<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $ID ) ) ) ) . '
                         </div>',
                        'comment_notes_before'  => '',
                        'comment_notes_after'  => '',
                        'id_form'              => 'commentform',
                        'id_submit'            => 'submit',
                        'class_container'      => 'comment-respond',
                        'class_form'           => 'comment-form row',
                        'class_submit'         => 'submit',
                        'name_submit'          => 'submit',
                        'title_reply'          => '',
                        'title_reply_to'       => '',
                        'title_reply_before'   => '',
                        'title_reply_after'    => '',
                        'cancel_reply_before'  => '',
                        'cancel_reply_after'   => '',
                        'cancel_reply_link'    => '',
                        'label_submit'         => '',
                        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5 reviews-page-link-submit mb-3" value="Отправить" />',
                        'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                        'format'               => 'xhtml',
                    ];
                    echo comment_form( $defaults, $ID); ?>
            </div>
            <!-- / from -->
        </div>
        <div class="section">
            <div class="section__header d-flex justify-content-between align-items-center mb-4">
               <h2 class="title mb-0">Лучшие предложения </h2>
               <a href="<?php echo get_the_permalink($ID) ?>" class="btn btn-primary btn-sm btn-all">
                   Все
                   <span class="icon ml-2">
                       <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
                   </span>
               </a>
           </div>
            <div class="horizontal__scroll row">
            <div id="response-bank-offers" class="horizontal__scroll-container">
                <?php 
$args = array(
    'post_type'             => array('bankcard', 'kredity'), 
    'posts_per_page'        => -1,
    'meta_key' => 'ratings_average',
    'orderby' => 'meta_value_num',
    'order' => 'DESC', 
);
$args['meta_query'] = array('relation' => 'OR');
$args['meta_query'][] = array(
            'key' => 'bank_choise',
            'value' => $ID,
        );
$args['meta_query'][] = array(
            'key' => 'product_bank',
            'value' => $ID,
        );
$query = new WP_Query( $args );

// Цикл
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $terms = wp_get_post_terms( get_the_id(), 'bankcards', array('fields' => 'all') );
        $term_slug = $terms[0]->slug;
        $term_id = $terms[0]->term_id;
        $post_type = get_post_type(get_the_id());
        ?>
        <?php if($post_type == 'kredity') : ?>
            <div class="card card__vertical size4 offer h-100">
               <div class="card-container p-3">
                   <div class="card__header mb-2 d-flex">
                       <div class="card__header-img">
                           <img src="<?php $bank_choise_rel = get_field('product_bank', get_the_ID()) ?>
                           <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                       </div>
                       <div class="card__header-title"><?php echo the_title(); ?></div>
                   </div>
                   <div class="card__header-info d-flex align-items-center">
                       <div class="card__rating d-flex align-items-center mr-3">
                           <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                           <?php echo the_field('ratings_average'); ?>
                       </div>
                       <div class="card__icon d-flex align-items-center">
                           <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                          <?php wp_count_comments(); ?>
                       </div>
                       <div class="card__like d-flex align-items-center">
                            <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                        </div>
                       <div class="card__header-actions ml-auto">
                           <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                       </div>                                
                   </div>
                   <div class="card__image my-3">
                       <img src="<?php bloginfo('template_url'); ?>/img/credit_card_alfabank.png" alt="">
                   </div>
                   <ul class="leaders">
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Макс. сумма</div>
                                   <div class="leaders__item-value"><?php echo the_field('credit_max_sum') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Мин. сумма</div>
                                   <div class="leaders__item-value"><?php echo the_field('credit_min_sum') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">% ставка</div>
                                   <div class="leaders__item-value"><?php echo the_field('credit_stavka') ?>%</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Срок кредита</div>
                                   <div class="leaders__item-value">от <?php $field = get_field('credit_period');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                           </ul>
                   <div class="card__actions mt-3 d-flex">
                       <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                       <a class="btn__compare btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'kredity'; ?>">
                           <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use></svg>
                       </a>
                   </div>
                   <div class="card__footer mt-3">
                       <p>
                           <span><?php echo the_field('bank_phone', $bank_choise_rel) ?></span>
                           <span><?php echo the_field('bank_email', $bank_choise_rel) ?></span>
                           <span>Лицензия: <?php echo the_field('bank_license', $bank_choise_rel) ?></span>
                           <span><?php echo the_field('views') ?> заявок</span>
                       </p>
                   </div>
               </div>
           </div>
        <?php endif; ?>
        <?php 
        switch ($term_slug) {
            case 'debetcard': ?>
            <div class="card card__vertical size4 offer h-100">
                       <div class="card-container p-3">
                           <div class="card__header mb-2 d-flex">
                               <div class="card__header-img">
                                   <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                               </div>
                               <div class="card__header-title"><?php echo the_title() ?></div>
                           </div>
                           <div class="card__header-info d-flex align-items-center">
                               <div class="card__rating d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                   <?php echo the_field('ratings_average'); ?>
                               </div>
                               <div class="card__icon d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                  <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->approved ?>
                               </div>
                               <div class="card__like d-flex align-items-center">
                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                               <div class="card__header-actions ml-auto">
                                   <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                               </div>                                
                           </div>
                           <div class="card__image my-3">
                               <img src="<?php echo the_field('card_logo') ?>" alt="">
                           </div>

                           <ul class="leaders">
                           <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Снятие без %</div>
                                   <div class="leaders__item-value">До <?php echo the_field('non_pecent_money') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">% на остаток</div>
                                   <div class="leaders__item-value">До <?php echo the_field('card_stavka_ostatok') ?> %</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Тип кешбэка</div>
                                   <div class="leaders__item-value"><?php $field = get_field('card_cashback_type');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Кешбэк</div>
                                   <div class="leaders__item-value"><?php $field = get_field('card_cashback');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                           </div>
                           </ul>
                           <div class="card__actions mt-3 d-flex">
                               <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                               <a class="btn__compare btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'debetcard'; ?>">
                                   <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use></svg>
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
                <?php break;
            case 'installmentcard': ?>
               <div class="card card__vertical size4 offer h-100">
                       <div class="card-container p-3">
                           <div class="card__header mb-2 d-flex">
                               <div class="card__header-img">
                                   <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                               </div>
                               <div class="card__header-title"><?php echo the_title(); ?></div>
                           </div>
                           <div class="card__header-info d-flex align-items-center">
                               <div class="card__rating d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                   <?php echo the_field('ratings_average'); ?>
                               </div>
                               <div class="card__icon d-flex align-items-center">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                  <?php wp_count_comments(); ?>
                               </div>
                               <div class="card__like d-flex align-items-center">
                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                               <div class="card__header-actions ml-auto">
                                   <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                               </div>                                
                           </div>
                           <div class="card__image my-3">
                               <img src="<?php bloginfo('template_url'); ?>/img/credit_card_alfabank.png" alt="">
                           </div>
                           <ul class="leaders">
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Лимит</div>
                                   <div class="leaders__item-value"><?php echo the_field('card_cred_limit') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Без %</div>
                                   <div class="leaders__item-value"><?php $field = get_field('card_period');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Кэшбэк</div>
                                   <div class="leaders__item-value"><?php $card_cashback = get_field('card_cashback', get_the_ID()); 
                                       echo $card_cashback; ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Ставка</div>
                                   <div class="leaders__item-value">от <?php echo the_field('card_stavka') ?>%</div>
                               </li>
                           </ul>
                           <div class="card__actions mt-3 d-flex">
                               <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                               <a class="btn__compare btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'installmentcard'; ?>">
                                   <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use></svg>
                               </a>
                           </div>
                           <div class="card__footer mt-3">
                               <p>
                                   <span><?php echo the_field('bank_phone', $bank_choise_rel) ?></span>
                                   <span><?php echo the_field('bank_email', $bank_choise_rel) ?></span>
                                   <span>Лицензия: <?php echo the_field('bank_license', $bank_choise_rel) ?></span>
                                   <span><?php echo the_field('views') ?> заявок</span>
                               </p>
                           </div>
                       </div>
                   </div>
            <?php break;
            case 'creditcard': ?>
            <!-- item -->
                   <div class="card card__vertical size4 offer h-100">
                       <div class="card-container p-3">
                           <div class="card__header mb-2 d-flex">
                               <div class="card__header-img">
                                   <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                               </div>
                               <div class="card__header-title"><?php echo the_title(); ?></div>
                           </div>
                           <div class="card__header-info d-flex align-items-center">
                               <div class="card__rating d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                   <?php echo the_field('ratings_average'); ?>
                               </div>
                               <div class="card__icon d-flex align-items-center">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                  <?php wp_count_comments(); ?>
                               </div>
                               <div class="card__like d-flex align-items-center">
                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                               <div class="card__header-actions ml-auto">
                                   <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                               </div>                                
                           </div>
                           <div class="card__image my-3">
                               <img src="<?php bloginfo('template_url'); ?>/img/credit_card_alfabank.png" alt="">
                           </div>
                           <ul class="leaders">
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Лимит</div>
                                   <div class="leaders__item-value"><?php echo the_field('card_cred_limit') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Без %</div>
                                   <div class="leaders__item-value"><?php $field = get_field('card_period');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Кэшбэк</div>
                                   <div class="leaders__item-value"><?php $card_cashback = get_field('card_cashback', get_the_ID()); 
                                       echo $card_cashback; ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Ставка</div>
                                   <div class="leaders__item-value">от <?php echo the_field('card_stavka') ?>%</div>
                               </li>
                           </ul>
                           <div class="card__actions mt-3 d-flex">
                               <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                               <a class="btn__compare btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'creditcard'; ?>">
                                   <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use></svg>
                               </a>
                           </div>
                           <div class="card__footer mt-3">
                               <p>
                                   <span><?php echo the_field('bank_phone', $bank_choise_rel) ?></span>
                                   <span><?php echo the_field('bank_email', $bank_choise_rel) ?></span>
                                   <span>Лицензия: <?php echo the_field('bank_license', $bank_choise_rel) ?></span>
                                   <span><?php echo the_field('views') ?> заявок</span>
                               </p>
                           </div>
                       </div>
                   </div>
                   <!-- / item -->
            <?php break;      
            default:
        }
        ?>
        <?php
    }
}
// Возвращаем оригинальные данные поста. Сбрасываем $post.
wp_reset_query();
?>
            </div>
        </div>
        </div>
    </div>
</main>
<? endif; ?>
<?php if($post_type == "kredity"): ?>
<main>
    <div class="container">
        <nav aria-label="breadcrumb" class="horizontal__scroll">
            <ol class="breadcrumb horizontal__scroll-container">
                <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('kredity'); ?>">Кредиты</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_the_permalink($ID) ?>"><?php echo get_the_title($ID) ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
            </ol>
        </nav>
        <div class="section">
            <div class="section__header mb-4 d-sm-flex justify-content-between align-items-center">
                <h2 class="title mb-0">Отзывы о кредите "<?php echo get_the_title($ID) ?>"</h2>
                <button class="btn btn-primary btn-sm btn-scroll section__header-btn mt-4 mt-sm-0" data-target="commentForm">Оставить отзыв</button>
            </div>
            <div class="comments comments-page-list" id="comments">
                    <?php comments_template(); ?>
            </div>
                <!-- pagination -->
              <div class="pagination flex-column">
                  <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                      <div class="pagination__description mt-4 mt-sm-0">
                          Показано <span class="review-count"> отзывов</span> из <?php echo get_comments_number($ID) ?>
                      </div>
                  </div>
              </div>
              <!-- / pagination -->
        </div>
        <div class="section">
            <!-- form -->
            <div class="form" id="commentForm">
                <?php 
                    // получим данные из куков
                    $commenter = wp_get_current_commenter();
                    $args = wp_parse_args( $args );
                    if ( ! isset( $args['format'] ) ) {
                        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
                    }
                    $html5 = 'html5' === $args['format'];
                    // определим поля которые нужно вывести
                    $req = get_option( 'require_name_email' ) ? ' <span class="required">*</span>' : '';

                    $aria_req = $req ? " aria-required='true'" : '';
                    $html_req = $req ? " required='required'"  : '';

                    $city =  do_shortcode( "[wt_geotargeting get='city']" ); 
                    $defaults = [
                        'fields'               => [
                            'author' => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="author" class="form-control" placeholder="Имя"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . $html_req . ' required="required" />
                                                </div>
                                            </div>',
                            'email'  => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="email" class="form-control" placeholder="E-Mail" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' required="required"/>
                                                </div>
                                            </div>',
                            'city' => '<div class="col-12 col-md-6" style="display: none;">
                                            <div class="mb-3">
                                                <input id="city" class="form-control" placeholder="Город"  name="city" type="text" value="' . $city . '" ' . $aria_req . $html_req . ' />
                                                </div>
                                            </div>',
                        ],
                        'comment_field'        => '<div class="col-12">
                                                        <textarea id="comment" name="comment" class="form-control" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
                                                    </div>',
                        'logged_in_as'         => '<div class="col-12 mb-2">' .
                             sprintf( __( '<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $ID ) ) ) ) . '
                         </div>',
                        'comment_notes_before'  => '',
                        'comment_notes_after'  => '',
                        'id_form'              => 'commentform',
                        'id_submit'            => 'submit',
                        'class_container'      => 'comment-respond',
                        'class_form'           => 'comment-form row',
                        'class_submit'         => 'submit',
                        'name_submit'          => 'submit',
                        'title_reply'          => '',
                        'title_reply_to'       => '',
                        'title_reply_before'   => '',
                        'title_reply_after'    => '',
                        'cancel_reply_before'  => '',
                        'cancel_reply_after'   => '',
                        'cancel_reply_link'    => '',
                        'label_submit'         => '',
                        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5 reviews-page-link-submit mb-3" value="Отправить" />',
                        'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                        'format'               => 'xhtml',
                    ];
                    echo comment_form( $defaults, $ID); ?>
            </div>
            <!-- / form -->
        </div>
        <div class="section">
           <div class="section__header d-flex justify-content-between align-items-center mb-4">
               <h2 class="title mb-0">Лучшие кредиты </h2>
               <a href="<?php echo get_post_type_archive_link('kredity') ?>" class="btn btn-primary btn-sm btn-all">
                   Все
                   <span class="icon ml-2">
                       <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
                   </span>
               </a>
           </div>
           <div class="horizontal__scroll row">
               <div class="horizontal__scroll-container">
                <?php 
$args = array(
    'post_type'             => 'kredity', 
    'posts_per_page'        => 4,
    'meta_key' => 'ratings_average',
    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
    'order' => 'DESC', 
);

$query = new WP_Query( $args );

// Цикл
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        ?>
        <!-- item -->
                   <div class="card card__vertical size4 offer h-100">
                       <div class="card-container p-3">
                           <div class="card__header mb-2 d-flex">
                               <div class="card__header-img">
                                   <img src="<?php $bank_choise_rel = get_field('product_bank', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                               </div>
                               <div class="card__header-title"><?php echo the_title() ?></div>
                           </div>
                           <div class="card__header-info d-flex align-items-center">
                               <div class="card__rating d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                   <?php echo the_field('ratings_average'); ?>
                               </div>
                               <div class="card__icon d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                  <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->approved ?>
                               </div>
                               <div class="card__like d-flex align-items-center">
                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                               <div class="card__header-actions ml-auto">
                                   <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                               </div>                                
                           </div>
                           <div class="card__image my-3">
                               <img src="<?php echo the_field('card_logo') ?>" alt="">
                           </div>
                           <ul class="leaders">
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Макс. сумма</div>
                                   <div class="leaders__item-value"><?php echo the_field('credit_max_sum') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Мин. сумма</div>
                                   <div class="leaders__item-value"><?php $card_cashback = get_field('credit_min_sum'); 
                                       echo $card_cashback; ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">% ставка</div>
                                   <div class="leaders__item-value"><?php $card_period = get_field('credit_stavka'); 
                                       echo $card_period; ?>%</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Срок кредита</div>
                                   <div class="leaders__item-value">до <?php
                                            // Переменные
                                            $field = get_field('credit_period');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                           </ul>
                           <div class="card__actions mt-3 d-flex">
                               <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                               <a class="btn__compare btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'kredity'; ?>">
                                   <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use></svg>
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
    </div>
</main>
<? endif; ?>
<?php if($post_type == "zaimy"): ?>
<main>
    <div class="container">
        <nav aria-label="breadcrumb" class="horizontal__scroll">
            <ol class="breadcrumb horizontal__scroll-container">
                <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('zaimy'); ?>">Займы</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_the_permalink($ID) ?>"><?php echo get_the_title($ID) ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
            </ol>
        </nav>
        <div class="section">
            <div class="section__header mb-4 d-sm-flex justify-content-between align-items-center">
                <h2 class="title mb-0">Отзывы о займе "<?php echo get_the_title($ID) ?>"</h2>
                <button class="btn btn-primary btn-sm btn-scroll section__header-btn mt-4 mt-sm-0" data-target="commentForm">Оставить отзыв</button>
            </div>
            <div class="comments comments-page-list" id="comments">
                    <?php comments_template(); ?>
            </div>
                <!-- pagination -->
              <div class="pagination flex-column">
                  <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                      <div class="pagination__description mt-4 mt-sm-0">
                          Показано <span class="review-count"> отзывов</span> из <?php echo get_comments_number($ID) ?>
                      </div>
                  </div>
              </div>
              <!-- / pagination -->
        </div>
        <div class="section">
            <!-- form -->
            <div class="form" id="commentForm">
                <?php 
                    // получим данные из куков
                    $commenter = wp_get_current_commenter();
                    $args = wp_parse_args( $args );
                    if ( ! isset( $args['format'] ) ) {
                        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
                    }
                    $html5 = 'html5' === $args['format'];
                    // определим поля которые нужно вывести
                    $req = get_option( 'require_name_email' ) ? ' <span class="required">*</span>' : '';

                    $aria_req = $req ? " aria-required='true'" : '';
                    $html_req = $req ? " required='required'"  : '';

                    //$city =  do_shortcode( "[wt_geotargeting get='city']" ); 
                    $defaults = [
                        'fields'               => [
                            'author' => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="author" class="form-control" placeholder="Имя"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . $html_req . ' required="required" />
                                                </div>
                                            </div>',
                            'email'  => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="email" class="form-control" placeholder="E-Mail" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' required="required"/>
                                                </div>
                                            </div>',
                        ],
                        'comment_field'        => '<div class="col-12">
                                                        <textarea id="comment" name="comment" class="form-control" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
                                                    </div>',
                        'logged_in_as'         => '<div class="col-12 mb-2">' .
                             sprintf( __( '<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $ID ) ) ) ) . '
                         </div>',
                        'comment_notes_before'  => '',
                        'comment_notes_after'  => '',
                        'id_form'              => 'commentform',
                        'id_submit'            => 'submit',
                        'class_container'      => 'comment-respond',
                        'class_form'           => 'comment-form row',
                        'class_submit'         => 'submit',
                        'name_submit'          => 'submit',
                        'title_reply'          => '',
                        'title_reply_to'       => '',
                        'title_reply_before'   => '',
                        'title_reply_after'    => '',
                        'cancel_reply_before'  => '',
                        'cancel_reply_after'   => '',
                        'cancel_reply_link'    => '',
                        'label_submit'         => '',
                        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5 reviews-page-link-submit mb-3" value="Отправить" />',
                        'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                        'format'               => 'xhtml',
                    ];
                    echo comment_form( $defaults, $ID); ?>
            </div>
            <!-- / form -->
        </div>
        <div class="section">
           <div class="section__header d-flex justify-content-between align-items-center mb-4">
               <h2 class="title mb-0">Лучшие займы </h2>
               <a href="<?php echo get_post_type_archive_link('zaimy') ?>" class="btn btn-primary btn-sm btn-all">
                   Все
                   <span class="icon ml-2">
                       <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
                   </span>
               </a>
           </div>
           <div class="horizontal__scroll row">
               <div class="horizontal__scroll-container">
                <?php 
$args = array(
    'post_type'             => 'zaimy', 
    'posts_per_page'        => 4,
    'meta_key' => 'ratings_average',
    'orderby' => 'meta_value_num',
    'order' => 'DESC', 
);

$query = new WP_Query( $args );

// Цикл
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        ?>
        <!-- item -->
                   <div class="card card__vertical size4 offer h-100">
                       <div class="card-container p-3">
                           <div class="card__header mb-2 d-flex">
                               <div class="card__header-img">
                                   <img src="<?php echo the_field('z_organization_logo') ?>" alt="">
                               </div>
                               <div class="card__header-title"><?php echo the_title() ?></div>
                           </div>
                           <div class="card__header-info d-flex align-items-center">
                               <div class="card__rating d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                   <?php echo the_field('ratings_average'); ?>
                               </div>
                               <div class="card__icon d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                  <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->approved ?>
                               </div>
                               <div class="card__like d-flex align-items-center">
                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                               <div class="card__header-actions ml-auto">
                                   <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                               </div>                                
                           </div>
                           <div class="card__image my-3">
                               <img src="<?php echo the_field('card_logo') ?>" alt="">
                           </div>
                           <ul class="leaders">
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Сумма займа</div>
                                   <div class="leaders__item-value"><?php echo the_field('z_sum') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Срок займа</div>
                                   <div class="leaders__item-value">до <?php echo the_field('z_time') ?> дней</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">% ставка</div>
                                   <div class="leaders__item-value">от <?php $card_period = get_field('z_stavka'); 
                                       echo $card_period; ?>%</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Кредитная история</div>
                                   <div class="leaders__item-value"><?php echo the_field('z_history') ?></div>
                               </li>
                           </ul>
                           <div class="card__actions mt-3 d-flex">
                               <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                               <a class="btn__compare btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'zaimy'; ?>">
                                   <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use></svg>
                               </a>
                           </div>
                           <div class="card__footer mt-3">
                               <p>
                                   <span><?php echo the_field('z_organization_phone') ?></span>
                                   <span><?php echo the_field('z_organization_email') ?></span>
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
    </div>
</main>
<? endif; ?>
<?php endif; ?>


<?php get_footer() ?>
