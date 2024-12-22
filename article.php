<?php get_header() ?>
<?php /* 
Template Name: Шаблон статьи или новостной записи
Template Post Type: post
*/ ?>
<?php 
$ID = get_queried_object()->ID;
$category   = get_the_category();
$cat_parent = $category[0]->category_parent;
$category_ID   = $cat_parent != 0 ? get_term($cat_parent, 'category')->term_id : $category[0]->term_id;
$category_slug = $cat_parent != 0 ? get_term($cat_parent, 'category')->slug : $category[0]->slug;
$category_name = $cat_parent != 0 ? get_term($cat_parent, 'category')->name : $category[0]->name;
?>

<?php //do_action( 'qm/debug', $category ); ?>

<?php foreach($category as $cat): 
if($cat->parent == 0):
    $cat_parent_id = $cat->term_id;
    $cat_parent_name = $cat->name;
endif;
if($cat->parent != 0):
    $cat_current_id = $cat->term_id;
    $cat_current_name = $cat->name;
endif;
endforeach; 

if($cat_current_id == ''):
$cat_current_id = $cat_parent_id;
endif;

if($_GET['test']){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

?> 


<?php //do_action( 'qm/debug', $cat_parent_name ); ?>

<main id="primary" class="site-main">

    <div class="container">
        <div class="section">
            <div class="article__container">
                <!-- sidebar left -->
                <div class="article__container-left order-xl-1">
                    <div class="article__nav">
                        <div class="article__nav-section">
                            <div class="article__nav-title article__container-title dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static">
                                Формат
                                <svg class="d-lg-none" width="12" height="6" viewBox="0 0 12 6">
                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                </svg>
                            </div>
                            <div class="article__nav-wrap dropdown-menu">
                               <?php $categories = get_terms( 
                                       'category', 
                                        array('parent' => 0, 
                                                'hide_empty' => true, 
                                                'exclude'       => array(1),
                                                 'orderby'       => 'id',
                                                 'order'         => 'ASC',)
                                    );
                                    foreach($categories as $cat): ?>
                                        <a class="article__nav-link" href="<?php echo get_term_link($cat->term_id) ?>">
                                    <span class="article__nav-icon">
                                        <?php echo the_field('cat_image', 'category_'.$cat->term_id); ?>
                                    </span>
                                    <?php echo $cat->name; ?>
                                </a>
                                    <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="article__nav-section">
                            <div class="article__nav-title article__container-title dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static">
                                Рубрика
                                <svg class="d-lg-none" width="12" height="6" viewBox="0 0 12 6">
                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                </svg>
                            </div>
                            <div class="article__nav-wrap dropdown-menu">
                                <?php if(!empty($cat_parent_id)):
                                    $categories = get_terms( 
                                               'category', 
                                                array('parent' => $cat_parent_id, 
                                                        'hide_empty' => true, 
                                                        'exclude'       => array(1),
                                                         'orderby'       => 'id',
                                                         'order'         => 'ASC',)
                                            );
                                            foreach($categories as $cat): ?>
                                        <a class="article__nav-link" href="<?php echo get_term_link($cat->term_id) ?>">
                                            <span class="article__nav-icon">
                                                <?php echo the_field('cat_image', 'category_'.$cat->term_id); ?>
                                            </span>
                                            <?php echo $cat->name; ?>
                                        </a>
                                            <?php endforeach; ?>
                                    <?php endif; ?>        
                            </div>
                        </div>
                    </div>
                        <?php if( have_rows('article_content') ): ?>
                        <noindex>
                        <div class="sticky-top">
                            <div class="article__one-contents" id="menutoc">
                                <div class="h4 mb-1">Содержание</div>
                                <ol class="">
                                <?php $counter = 0;
                                while( have_rows('article_content') ): the_row(); 
                                    $title = get_sub_field('title');
                                    $counter += 1;
                                    ?>
                                    <li><a class="btn-scroll stretched-link" href="#a<?php echo $counter ?>" data-target="a<?php echo $counter ?>"><?php echo $title ?></a></li>
                                <?php endwhile; ?>
                                </ol>
                            </div>
                        </div>
                        </noindex> 
                        <?php endif; ?> 
                        
                        <?php if( have_rows('article_content')): ?>
                        <noindex>
                        <div class="mob-menutoc">
                            <div class="tocdot"></div>
                            <div class="mob-menutoc-contents" id="menutocmob" >
                                <ul>
                                <?php $counter = 0;
                                while( have_rows('article_content') ): the_row(); 
                                    $title = get_sub_field('title');
                                    $counter += 1;
                                    ?>
                                    <li><a class="btn-scroll" href="#a<?php echo $counter ?>" data-target="a<?php echo $counter ?>"><?php echo $title ?></a></li>
                                <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                        </noindex> 
                        <?php endif; ?>                                             
                </div>
                <!-- / sidebar left -->
                <!-- sidebar right -->
                <div class="article__container-right d-none d-xl-block order-xl-3">
                    <div class="sticky-top">
                        <!-- article news -->
                        <div class="article__news mb-5">
                            <?php 
                                    if (!empty($cat_parent_name)) {
                                        $popular_name = $cat_parent_name;
                                    } else {
                                        $popular_name = 'Cтатьи';    
                                    }   
                                    
                                    if (!empty($cat_parent)) {
                                        $popular_id = $cat_parent;    
                                    } else {
                                        $popular_id = 9;
                                    }
                                    
                            ?>
                            <div class="h3 article__news-title article__container-title mb-3">Популярные <?php echo $popular_name ?></div>
                            <?php 
                                        $args = array(
                                            'posts_per_page' => 5,
                                            'post_type' => 'post',
                                            'post__not_in' => array($ID,),
                                            'meta_key' => 'views',
                                            'cat' => $popular_id,
                                            'orderby' => 'meta_value_num',
                                            'order' => 'DESC',
                                        );
                                        $wp_query = new WP_Query( $args );
                                        if ( $wp_query->have_posts() ) {
                                            while ( $wp_query->have_posts() ) {
                                                $wp_query->the_post(); ?>
                                        <div class="article__news-item">
                                    <?php $image = get_the_post_thumbnail_url(); ?>
                                            <?php if($image != ''): ?>
                                                <div class="article__news-img"><img style="width: 100%; height: 100%; object-fit: cover;" src="<?php echo the_post_thumbnail_url() ?>" alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>"></div>
                                            <?php endif; ?>
                                    <div class="article__news-body">
                                        <a class="stretched-link" href="<?php echo the_permalink() ?>"><span><?php echo the_title() ?></span></a>
                                        <div class="d-flex align-items-center mt-2">
                                            <div class="card__icon d-flex align-items-center mr-3">
                                                <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                                <?php echo the_field('views') ?>
                                            </div>
                                          <div class="position-relative card__icon d-flex align-items-center mr-3">
                                              <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                              <?php echo comments_number( '0', '1', '%'); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                        <?php
                                            }
                                        } ?>
                                        <?php wp_reset_query() ?>
                        </div>
                        <!-- / article news -->
                        <!-- best offers -->
                        <?php $featured_posts = get_field('cat_best_prod', 'category_'.$category_ID);
                        //$featured_posts = get_field('cat_best_prod', 'category_'.$cat_current_id);
                        
                                        if( $featured_posts ): ?>
                                            <div class="article__offers">
                                        <div class="h3 article__offers-title article__container-title">Лучшие предложения</div>
                                        <?php foreach( $featured_posts as $post ): 
                                                setup_postdata($post); 
                                                $loop_id = get_the_id(); 
                                                $post_type = get_post_type($loop_id);
                                                $logo_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
                                                switch ($post_type) {
                                                            case 'bankcard':
                                                               $bank_id = get_field('bank_choise', $loop_id);
                                                               $logo_img = get_field('bank_logo', $bank_id);
                                                                break;
                                                            case 'zaimy':
                                                               $logo_img = get_field('z_organization_logo', $loop_id);
                                                                break;
                                                            case 'kredity':
                                                               $bank_id = get_field('product_bank', $loop_id);
                                                               $logo_img =  get_field('bank_logo', $bank_id);
                                                                break;      
                                                            default:
                                                               //$logo_img = bloginfo('template_url') . '/img/alfabank.png';
                                                        }?>
                                                <div class="article__offers-item">
                                                    <div class="article__offers-img"><img src="<?php echo $logo_img ?>" alt="<?= $logo_alt?>"></div>
                                                    <a href="<?php the_permalink() ?>" class="stretched-link"><?php echo get_the_title($loop_id) ?></a>
                                                </div>
                                            <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php wp_reset_postdata() ?>
                        <!-- / best offers -->
                    </div>
                </div>
                <!-- / sidebar right -->
                <div class="article__container-center order-xl-2">
                    <!-- title -->
                    <div class="arcticle__title">
                        <a href="<?php echo get_term_link($cat_current_id) ?>" class="arcticle__title-back">
                            <svg width="12" height="6" viewBox="0 0 12 6">
                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                            </svg>
                            Назад к статьям
                        </a>
                    </div>
                    <!-- / title -->
                    <!-- item -->
                    <div class="article__one">
                        <!-- item header -->
                        <div class="article__one-header">
                            <div class="article__one-date"><?php echo get_the_date('d.m.y') ?>  <?php echo get_the_time('H:i') ?></div>
                            <div class="card__icon d-flex align-items-center">
                                <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                <?php echo the_field('views') ?>
                            </div>

                            <?php $date_actually = get_the_modified_date('d.m.Y', $ID);?>
                            <? if($date_actually): ?>
                                <div style="margin-left: 15px;" class="date_actually-article">Обновлено: <?//= $date_actually?> <?php the_date('d.m.Y'); ?></div>
                            <? endif; ?>

                            <a href="<?php echo get_category_link($cat_current_id) ?>" class="article__category">
                                <?php $cat_image = get_field('cat_image', 'category_'.$cat_current_id); ?>
                                <div class="article__category-icon">
                                    <?php echo $cat_image ?>
                                </div>
                                <?php echo $cat_current_name ?>
                            </a>
                        </div>
                        <!-- / item header -->
                        <!-- item img -->
                        <div class="article__one-img">
                            <?php
                                $posttags = get_the_tags();
                                if ($posttags): ?>
                                    <div class="article__tags">
                                  <?php foreach($posttags as $tag): ?>
                                    <a href="#" class="article__tags-item"><?php echo $tag->name ?></a>
                                  <?php endforeach; ?>
                                    </div>
                                <?php endif;
                                ?>
                            <?php if (get_the_post_thumbnail_url()): ?>    
                                <img src="<?php echo the_post_thumbnail_url() ?>" alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                        </div>
                        <!-- / item img -->
                        <!-- item body -->
                        <div class="article__one-body">
                            <h1 href="" class="article__one-link"><?php echo the_title() ?></h1>
                            <div class="article__one-description 1">

                                <?php echo get_the_excerpt() ?>

                                <?php

                                //if ( empty( $post->post_excerpt ) ) {
                                //    echo wp_kses_post( wp_trim_words( $post->post_content, 20 ) );
                                //} else {
                                //    echo wp_kses_post( $post->post_excerpt );
                                //}

                                ?>
                            </div>
                            <!-- item footer -->
                            <div class="article__one-footer px-0 pb-0 pt-4">
                                <div class="card__like d-flex align-items-center mr-3">
                                    <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().' button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                                <a class="card__icon d-flex align-items-center btn-scroll mr-3" href="" data-target="comments">
                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                    <?php echo comments_number( '0', '1', '%'); ?>
                                </a>
                                <div class="card__icon d-flex align-items-center mr-3" data-id="<?php echo get_the_id() ?>">
                                    <?php echo do_shortcode('[addtoany]'); ?>
                                </div>
                                <?php $author_id = get_field('page_author') ?>
                                <?php if($author_id): ?>
                                    <div class="article__one-footer-meta ml-md-auto">
                                        <div class="article__one-footer-img">
                                            <?php get_template_part( 'all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                        </div>
                                        <div class="article__one-footer-name">
                                            Автор Финабанка<br>
                                            <a class="article__one-footer-link stretched-link" href="<?php echo the_permalink($author_id) ?>">
                                                <?php echo get_the_title($author_id) ?>
                                            </a>
                                        </div>
                                    </div>
                                    <!--a class="article__one-footer-link ml-auto" href="<?php echo the_permalink($author_id) ?>">
                                        <?php echo get_the_title($author_id) ?>
                                    </a-->
                                <?php endif; ?>
                            </div>
                            <!-- / item footer -->
                        </div>
                        <!-- / item body -->
                        <!-- item contents -->
                        <?php if( have_rows('article_content') ): ?>
                            <div class="article__one-contents">
                                <div class="h4 mb-1">Содержание</div>
                                <ol class="">
                                <?php $counter = 0;
                                while( have_rows('article_content') ): the_row(); 
                                    $title = get_sub_field('title');
                                    $counter += 1;
                                    ?>
                                    <li><a class="btn-scroll stretched-link" href="" data-target="a<?php echo $counter ?>"><?php echo $title ?></a></li>
                                <?php endwhile; ?>
                                </ol>
                            </div>
                        <?php endif; ?>
                        <!-- / item contents -->
                        <!-- item text -->
                        <?php if( have_rows('article_content') ): ?>
                            <div class="article__one-text wysiwyg">
                            <?php $counter = 0;
                            while( have_rows('article_content') ): the_row(); 
                                $title = get_sub_field('title');
                                $text = get_sub_field('text');
                                $counter += 1;
                                ?>
                                <h2 id="a<?php echo $counter ?>"><?php echo $title ?></h2>
                                <?php echo $text ?>
                            <?php endwhile; ?>
                            </div>
                        <?php else: ?>
                            <div class="article__one-text wysiwyg">
                            <?php echo the_content() ?>
                            </div>
                        <?php endif; ?>
                        <!-- / item text -->
                        <div class="article__one-footer flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-start align-items-center">
                            <div class="card__like d-flex align-items-center mr-3">
                                <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().' button_type="image" style="wpulike-heart"]'); ?>
                            </div>
                            <a class="card__icon d-flex align-items-center btn-scroll mr-3" href="" data-target="comments">
                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                <?php echo comments_number( '0', '1', '%'); ?>
                            </a>
                            <div class="card__icon d-flex align-items-center mr-3" data-id="<?php echo get_the_id() ?>">
                                <?php echo do_shortcode('[addtoany]'); ?>
                            </div>
                            <?php
                                $posttags = get_the_tags();
                                if ($posttags): ?>
                                    <div class="article__badge ml-sm-auto">
                                  <?php foreach($posttags as $tag): ?>
                                    <a href="#" class="article__badge-item"><?php echo $tag->name ?></a>
                                  <?php endforeach; ?>
                                    </div>
                                <?php endif;
                                ?>
                        </div>
                    </div>
                    <!-- / item -->
                    <!-- comments -->
                    <div id="comments" class="article__comments">
               <div class="article__comments-header d-flex justify-content-between align-items-center">
                    <p class="article__comments-title">Комментарии</p>
                    <a href="" class="btn-scroll" data-target="commentForm">
                        Написать
                        <svg width="12" height="6" viewBox="0 0 12 6">
                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                        </svg>
                    </a>
                </div>
               <div class="comments article_comments">
            <?php
                    $comments = get_comments(array(
                        'post_id' => $ID,
                        'status' => 'approve',
                        'hierarchical' => 'threaded', ));
                    $counter = 0;
                    foreach($comments as $comment) { 
                        $comment_id = $comment->comment_ID;
                        $comment_post_id = $comment->comment_post_ID;
                        $user = get_userdata( $comment->user_id );
                         $user_email = '';
                         $user_role = '';
                         if (!empty($user)) {
                          $user_email = $user->user_email;
                          $user_role = $user->roles; 
                         }  
                        $counter++; 
                        $comments_children = get_comments(array(
                        'status' => 'approve',
                        'hierarchical' => 'true',
                        'parent' => $comment_id,));
                        $responses = count($comments_children); ?>
                               <!-- item -->
                               <div class="comments__item mb-3 article_comment" id="comment-<?php echo $comment_id ?>">
                                <!-- comment -->
                                   <div class="comment__one">
                                       <div class="comment__one-header d-flex align-items-center">
                                           <div class="comment__one-img mr-3">
                                               <img src="<?php echo get_avatar_url( $comment, array(
                   'default'=>'identicon',) ); ?>" alt="<?= $comment->comment_author ?>">
                                           </div>
                                           <div class="d-md-flex justify-content-md-between w-100">
                                               <div class="comment__one-title mb-2 mb-md-0">
                                                <?php echo $comment->comment_author; ?>
                                                </div>
                                               <div class="d-flex align-items-center">
                                                   <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                                                       <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                                                       <?php if(empty($user_role[0])):
                                                            echo 'Гость';
                                                        else:
                                                            echo $user_role[0];
                                                        endif; ?>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="comment__one-content">
                                           <?php echo $comment->comment_content; ?>
                                       </div>
                                       <div class="comment__one-footer d-flex flex-wrap align-items-center">
                                            <?php echo comment_reply_link( [ 'reply_text' => "Ответить", 'depth' => -1 ], $comment_id, ); ?>
                                           <div class="comment__one-date mr-md-4 order-md-1">
                                            <?php echo  get_comment_date( 'd.m.y'); ?> в
                                            <?php echo get_comment_date('H:i') ?>
                                            </div>
                                           <div class="comment__one-like order-md-4 ml-auto d-flex justify-content-between">
                                            <style>
                                                .comment__one-like{
                                                    width: fit-content;
                                                }
                                                .cld-like-dislike-wrap .cld-common-wrap{
                                                    margin-right: 0;
                                                }
                                                @media(max-width: 767px){
                                                    .comment__one-like{
                                                        width: fit-content;
                                                    }
                                                }
                                                .cld-template-1 {
                                                    width: 100px;
                                                    justify-content: space-around;
                                                }


                                            </style>
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
                                <div class="collapse comment__one-collapse" id="answ__<?php echo $counter ?>">
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
                                               </div>
                                           </div>
                                       </div>
                                       <div class="comment__one-content">
                                           <?php echo $comment_children->comment_content; ?>
                                       </div>
                                       <div class="comment__one-footer d-flex flex-wrap align-items-center">
                                           <div class="comment__one-date mr-md-4 order-md-1">
                                            <?php echo  get_comment_date('d.m.y', $comment_id_children); ?> в 
                                            <?php echo get_comment_date('H:i', $comment_id_children); ?>
                                            </div>
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
<!--                    <a class="btn__show-all mt-3" id="show__comments" style = "cursor: pointer;">
                        <div class="icon"><svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.5 19.5" xml:space="preserve"><path d="M578.1 252.7h4.3c1.3 0 2.2 1.4 1.6 2.6l-3.2 6.2c-.3.6-.9 1-1.6 1h-3.6c-.1 0-.3 0-.4-.1l-3.4-.8m6.3-8.9v-4.4c0-1-.8-1.8-1.8-1.8h-.1c-.4 0-.8.4-.8.8 0 .6-.2 1.3-.5 1.8l-3.1 4.5v8m6.3-8.9h-1.8m-4.5 8.9H570c-1 0-1.8-.8-1.8-1.8v-5.3c0-1 .8-1.8 1.8-1.8h2.3M9.8 0C4.4 0 0 4.4 0 9.7c0 5.4 4.4 9.8 9.8 9.8s9.8-4.4 9.8-9.8C19.5 4.4 15.1 0 9.8 0zm0 18c-4.6 0-8.2-3.7-8.2-8.2 0-4.6 3.7-8.2 8.2-8.2S18 5.2 18 9.7c0 4.6-3.7 8.3-8.2 8.3z"></path><path d="M13.5 9.7c0 .4-.3.8-.8.8h-2.2v2.2c0 .4-.3.8-.8.8s-.7-.3-.7-.8v-2.2H6.8c-.5 0-.8-.3-.8-.8 0-.4.3-.7.8-.7H9V6.7c0-.4.3-.7.8-.7s.8.3.8.8V9h2.2c.4 0 .7.3.7.7z"></path></svg></div>
                        Показать еще
                    </a> -->
              </div>
           </div>
           <!-- comments -->
           <div class="mb-3 mt-3">
                <!-- form -->
                <div class="form" id="commentForm">
                    <?php

                    $text_class_form = 'comment-form row';
                    if($_GET['test']){
                        $text_class_form = 'article_comment-form comment-form row';
                    }

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
                        'action' =>   $_GET['test'] ? 'javascript:void(0);' : '/wp-comments-post.php',
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
                                                        <textarea id="comment" post-id="'. $ID .'"  name="comment" class="form-control input-comment-trigger" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
                                                    </div>',
                        'logged_in_as'         => '<div class="col-12 mb-2">' .
                             sprintf( __( '<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $ID ) ) ) ) . '
                         </div>',
                        'comment_notes_before'  => '',
                        'comment_notes_after'  => '',
                        'id_form'              => 'commentform1',
                        'id_submit'            => 'submit',
                        'class_container'      => 'comment-respond',
                        'class_form'           => $text_class_form . ' validate-comment-form',
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
                        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5 w-100" value="Отправить" />',
                        'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                        'format'               => 'xhtml',
                    ];
                    echo comment_form( $defaults, $ID ); ?>


                    <div style="display:none;margin-top: 1rem;margin-bottom: 1rem;color: green;" class="response-for-comment">
                        Ваш комментарий ожидает проверки
                    </div>


                </div>
            </div>
<?php



$related_posts = get_field('cat_related_products_select_new', 'options');
$related_posts_ids = [];
foreach ($related_posts as $item){
    if($item['category'] == $cat_current_id){
        $related_posts_ids = $item['card'];
    }
}
// вывод из старого блока
if(empty($related_posts_ids)){
    $related_posts = get_field('cat_related_products', 'options');
}else{
    $related_posts = $related_posts_ids;
}
//$kod_btn = <<<HERE
//    onclick="ym(35020350,'reachGoal','click_oformit_vitrina_v_journale'); return true"
//HERE;




if( $related_posts): ?>
<div class="horizontal__scroll row mb-4">
    <div class="horizontal__scroll-container">


<?php foreach( $related_posts as $post ):
        setup_postdata($post);
        $loop_rel_id = get_the_id();
        $post_type = get_post_type($loop_rel_id);
        switch ($post_type) {
            case 'bankcard':
               $bank_id = get_field('bank_choise', $loop_rel_id);
               $logo_img = get_field('bank_logo', $bank_id);
                break;
            case 'zaimy':
               $logo_img = get_field('z_organization_logo', $loop_rel_id);
                break;
            case 'kredity':
               $bank_id = get_field('product_bank', $loop_rel_id);
               $logo_img =  get_field('bank_logo', $bank_id);
                break;
            default:
               $logo_img = bloginfo('template_url') . '/img/alfabank.png';
        }

        $logo_id = get_field('bank_logo',$bank_id , false);
        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);


            ?>
            <?php if($post_type == 'bankcard'): ?>
                <div class="horizontal__scroll-item size3">
                    <div class="offer__item">
                        <div class="offer__item-header">
                            <div class="d-flex align-items-center pb-1">
                                <div class="offer__item-img"><img src="<?php echo $logo_img ?>" alt="<?= $logo_alt?>"></div>
                                <div class="offer__item-title"><?php echo the_title() ?></div>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <div class="card__like d-flex align-items-center mr-3" style="pointer-events: none;">
                                    <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().'" button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                                <div class="card__icon d-flex align-items-center">
                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                    <?php echo comments_number( '0', '1', '%'); ?>
                                </div>
                                <div class="card__rating d-flex align-items-center ml-auto">
                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                    <?php echo the_field('ratings_average') ?>
                                </div>
                            </div>
                        </div>
                        <?php $loop_terms = wp_get_post_terms( get_the_ID(), 'bankcards', array('fields' => 'all') );
                                //do_action( 'qm/debug', $loop_terms['0']->slug );
                                    $loop_term_slug = $loop_terms[0]->slug;
                                    //$loop_term_id = $loop_terms[0]->term_id; 
                                 ?>
                            <?php if($loop_term_slug == 'creditcard'): ?>
                           <div class="offer__item-body">
                            <p class="txt1">Без % <?php echo the_field('card_period_reg') ?></p>
                                <p class="txt2">От <?php echo the_field('card_stavka') ?> %</p>
                                <p class="txt3">Лимит - до <?php echo the_field('card_cred_limit') ?> ₽</p>
                                <p class="txt3">Период - <?php echo the_field('card_day_period') ?> дней</p>
                            </div>
                            <?php endif; ?>
                            <?php if($loop_term_slug == 'installmentcard'): ?>
                           <div class="offer__item-body">
                            <p class="txt1">Без % <?php echo the_field('card_period_reg') ?></p>
                                <p class="txt2">От <?php echo the_field('card_stavka') ?> %</p>
                                <p class="txt3">Лимит - до <?php echo the_field('card_cred_limit') ?> ₽</p>
                                <p class="txt3">Период - <?php echo the_field('card_day_period') ?> дней</p>
                            </div>
                            <?php endif; ?>
                           <?php if($loop_term_slug == 'debetcard'): ?>
                           <div class="offer__item-body">
                            <p class="txt1">Снятие без % до <?php echo the_field('non_pecent_money') ?> ₽</p>
                                <p class="txt2">До <?php echo the_field('card_stavka_ostatok') ?> %</p>
                                <p class="txt3">Тип кешбэка - <?php $field = get_field('card_cashback_type');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?></p>
                                <p class="txt3">Кешбэк - <?php $field = get_field('card_cashback');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?></p>
                            </div>
                            <?php endif; ?>
                        <div class="offer__item-footer mt-auto">
                            <a onclick="<?= get_metrika_for_offers_in_article(get_field('card_bank_link')); ?>" href="<?php echo the_field('card_bank_link') ?>" class="btn btn-outline-main btn-block stretched-link"><span>Оформить</span></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($post_type == 'kredity'): ?>
                <div class="horizontal__scroll-item size3">
                    <div class="offer__item">
                        <div class="offer__item-header">
                            <div class="d-flex align-items-center pb-1">
                                <div class="offer__item-img"><img src="<?php echo $logo_img ?>" alt="<?= $logo_alt?>"></div>
                                <div class="offer__item-title"><?php echo the_title() ?></div>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <div class="card__like d-flex align-items-center mr-3" style="pointer-events: none;">
                                    <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().'" button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                                <div class="card__icon d-flex align-items-center">
                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                    <?php echo comments_number( '0', '1', '%'); ?>
                                </div>
                                <div class="card__rating d-flex align-items-center ml-auto">
                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                    <?php echo the_field('ratings_average') ?>
                                </div>
                            </div>
                        </div>
                        <div class="offer__item-body">
                            <p class="txt1">Срок кредита до <?php $field = get_field('credit_period');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?></p>
                            <p class="txt2">От <?php echo the_field('credit_stavka') ?> %</p>
                            <p class="txt3">Лимит - до <?php echo the_field('credit_max_sum') ?> ₽</p>
                            <p class="txt3">Минимум - от <?php echo the_field('credit_min_sum') ?> ₽</p>
                        </div>
                        <div class="offer__item-footer mt-auto">
                            <a onclick="<?= get_metrika_for_offers_in_article(get_field('card_bank_link')); ?>"  href="<?php echo the_field('card_bank_link') ?>" class="btn btn-outline-main btn-block stretched-link"><span>Оформить</span></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($post_type == 'zaimy'): ?>
                <div class="horizontal__scroll-item size3">
                    <div class="offer__item">
                        <div class="offer__item-header">
                            <div class="d-flex align-items-center pb-1">
                                <div class="offer__item-img"><img src="<?php echo $logo_img ?>" alt="<?= $logo_alt?>"></div>
                                <div class="offer__item-title"><?php echo the_title() ?></div>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <div class="card__like d-flex align-items-center mr-3" style="pointer-events: none;">
                                    <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().'" button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                                <div class="card__icon d-flex align-items-center">
                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                    <?php echo comments_number( '0', '1', '%'); ?>
                                </div>
                                <div class="card__rating d-flex align-items-center ml-auto">
                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                    <?php echo the_field('ratings_average') ?>
                                </div>
                            </div>
                        </div>
                        <div class="offer__item-body">
                            <p class="txt1">Срок займа до <?php echo the_field('z_time') ?> дней</p>
                            <p class="txt2">От <?php echo the_field('z_stavka') ?> %</p>
                            <p class="txt3">Сумма - до <?php echo the_field('z_sum') ?> ₽</p>
                            <p class="txt3">КИ - <?php echo the_field('z_history') ?></p>
                        </div>
                        <div class="offer__item-footer mt-auto">
                            <a onclick="<?= get_metrika_for_offers_in_article(get_field('card_bank_link')); ?>"  href="<?php echo the_field('card_bank_link') ?>" class="btn btn-outline-main btn-block stretched-link"><span>Оформить</span></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php wp_reset_postdata() ?>
    </div>
</div>
<?php endif; ?>


<?php
$args = array(
                'posts_per_page' => 3,
                'post_type' => 'post',
                'post__not_in' => array($ID,),
                'meta_key' => 'views',
                'cat' => $cat_current_id,
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            );
            $wp_query = new WP_Query( $args );
            if ( $wp_query->have_posts() ) { ?>

         <div class="arcticle__title">
            <div class="arcticle__title-icon">
                <svg width="24" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 22" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#news" x="0" y="0"></use></svg>
            </div>
            <p class="h1">Другие записи</p>
        </div>

        <div class="horizontal__scroll row">
            <div class="horizontal__scroll-container">

    <?php while ( $wp_query->have_posts() ) {
        $wp_query->the_post(); ?>

                <div class="horizontal__scroll-item size3 h-100">
                    <div class="article__similar offer__item d-xl-flex flex-xl-column h-100">
                        <div class="article__similar-body">
                            <div class="card__image">
                            <?php if(get_the_post_thumbnail_url()):?>
                                <img src="<?php echo the_post_thumbnail_url() ?>" alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            </div>
                            <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                            <a href="<?php echo the_permalink() ?>" class="article__title stretched-link d-block"><?php echo the_title() ?></a>
                        </div>
                        <div class="article__similar-footer d-flex align-items-center mt-auto">
                            <div class="card__icon d-flex align-items-center mr-3">
                                <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                <?php echo the_field('views') ?>
                            </div>
                              <div class="position-relative card__icon d-flex align-items-center mr-3">
                                  <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                  <?php echo comments_number( '0', '1', '%'); ?>
                              </div>
                            <div class="card__like d-flex align-items-center ml-auto">
                                <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().' button_type="image" style="wpulike-heart"]'); ?>
                            </div>
                        </div>
                    </div>
                </div>

    <?php } ?>

    </div>
</div>

<?php } ?>
<?php wp_reset_query() ?>

            </div>
        </div>
    </div>
</div>

</main>

<?php //get_footer('blog') ?>
<?php get_footer() ?>
