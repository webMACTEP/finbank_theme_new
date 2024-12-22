<?php //session_start(); ?>
<?php get_header(); ?>
<?php 
$queried_object = get_queried_object(); 
$ID = get_queried_object()->ID;
$tags = get_the_tags( $ID );
$terms = wp_get_post_terms( $post->ID, 'bankcards', array('fields' => 'all') );
$term_slug = $terms[0]->slug;
$term_id = $terms[0]->term_id;

switch ($term_slug) {
    case 'debetcard':
       $title_term = "дебетовые карты";
       $title_term1 = "Дебетовые карты";
       $title_term2 = "дебетовой карты";
        break;
    case 'installmentcard':
       $title_term = "карты рассрочки";
       $title_term1 = "Карты рассрочки";
       $title_term2 = "карты рассрочки";
        break;
    case 'creditcard':
       $title_term = "кредитные карты";
       $title_term1 = "Кредитные карты";
       $title_term2 = "кредитной карты";
        break;      
    default:
       $title_term1 = "Банковские карты";
       $title_term = "банковские карты";
       $title_term2 = "банковской карты";
}


?>
<main>
   <div class="container">
       <nav aria-label="breadcrumb" class="horizontal__scroll">
           <ol class="breadcrumb horizontal__scroll-container">
               <li class="breadcrumb-item"><a href="<?php echo get_home_url(); ?>">Главная</a></li>
               <?php if($term_id) : ?>
               <li class="breadcrumb-item"><a href="<?php echo get_term_link($term_id, '') ?>"><?php echo $title_term1 ?></a></li>
           <?php endif; ?>
               <li class="breadcrumb-item active" aria-current="page"><?php echo the_title() ?></li>
           </ol>
       </nav>
       <!-- card info -->
       <div class="credits__view section">
           <div class="row">
               <div class="col-12 col-md-6">
                   <h1 class="credits__view-title mb-1 mb-xl-4"><?php echo the_title() ?></h1>
                   <div class="credits__view-meta d-flex flex-wrap flex-xl-nowrap align-items-center">
                       <div class="credits__view-bank mt-3 mt-xl-0 mr-3">
                        <?php $bank_id = get_field('bank_choise', $ID); ?>
                        <?php echo get_the_title($bank_id); ?>
                        </div>
                       <div class="credits__view-type d-flex align-items-center mt-3 mt-xl-0 mr-3">
                           <?php $card_payment_sys = get_field('card_payment_sys', $ID) ?>
                           <?php if($card_payment_sys && in_array('ps1', $card_payment_sys)): ?>
                              <img class="mx-1" src="<?php bloginfo('template_url'); ?>/img/visa.png" alt="">
                            <?php endif; ?>
                            <?php if($card_payment_sys && in_array('ps2', $card_payment_sys)): ?>
                              <img class="mx-1" src="<?php bloginfo('template_url'); ?>/img/mastercard.png" alt="">
                            <?php endif; ?>
                            <?php if($card_payment_sys && in_array('ps3', $card_payment_sys)): ?>
                              <img class="mx-1" src="<?php bloginfo('template_url'); ?>/img/mastercard.png" alt="">
                            <?php endif; ?>
                            <?php if($card_payment_sys && in_array('ps4', $card_payment_sys)): ?>
                              <img class="mx-1" src="<?php bloginfo('template_url'); ?>/img/mastercard.png" alt="">
                            <?php endif; ?>
                            <?php if($card_payment_sys && in_array('ps5', $card_payment_sys)): ?>
                              <img class="mx-1" src="<?php bloginfo('template_url'); ?>/img/mastercard.png" alt="">
                            <?php endif; ?>
                       </div>
                       <div class="rating d-flex align-items-center mt-3 mt-xl-n1 mr-3">
                           <?php echo do_shortcode( '[ratings id="'.$ID.'"]' ); ?>
                       </div>
                       <div class="d-flex align-items-center mt-3 mt-xl-0">
                           <div class="card__icon d-flex align-items-center mr-3">
                               <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                               <?php echo get_post_meta( $ID, 'views', true ); ?>
                           </div>
                           <div class="card__icon d-flex align-items-center mr-3">
                               <div class="mr-2"><a href="#comments" data-target="comments" class="btn-scroll"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                               <?php echo comments_number( '0', '1', '%'); ?>
                           </div>
<!--                            <div class="card__like d-flex align-items-center">
                               <div class="mr-2"><svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.5 17.6" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#heartLine" x="0" y="0"></use></svg></div>
                               658
                           </div> -->
                           <div class="card__like d-flex align-items-center">
                           <?php echo do_shortcode('[wp_ulike for="post" id="'.$ID.' button_type="image" style="wpulike-heart"]'); ?>
                           </div>
                       </div>
                   </div>
                   <div class="row my-2 my-sm-4 mb-md-0 credits__view-block">
                        <?php if($term_slug == 'creditcard'): ?>
                        <div class="col-6">
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__speed.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Кредитный лимит</div>
                                   <div class="field__content-num"><?php echo the_field('card_cred_limit', $ID) ?> ₽</div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__fire.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">% ставка</div>
                                   <div class="field__content-num"><?php echo the_field('card_stavka', $ID) ?>%</div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__hand.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Стоимость</div>
                                   <div class="field__content-num">От <?php echo the_field('card_cost', $ID) ?> ₽</div>
                               </div>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__off.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Без процентов</div>
                                   <div class="field__content-num">
                                       <?php $field = get_field('card_period');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?>
                                   </div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__cashback.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Кэшбэк</div>
                                   <div class="field__content-num"><?php $card_cashback = get_field('card_cashback', $ID); 
                                       echo $card_cashback; ?>
                                       </div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__cashback.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Решение</div>
                                   <div class="field__content-num"><?php echo the_field('card_answ', $ID) ?></div>
                               </div>
                           </div>
                       </div>
                        <?php endif; ?>
                        <?php if($term_slug == 'installmentcard'): ?>
                        <div class="col-6">
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__speed.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Кредитный лимит</div>
                                   <div class="field__content-num"><?php echo the_field('card_cred_limit', $ID) ?> ₽</div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__fire.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">% ставка</div>
                                   <div class="field__content-num"><?php echo the_field('card_stavka', $ID) ?>%</div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__hand.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Стоимость</div>
                                   <div class="field__content-num">От <?php echo the_field('card_cost', $ID) ?> ₽</div>
                               </div>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__off.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Без процентов</div>
                                   <div class="field__content-num">
                                       <?php $field = get_field('card_period');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?>
                                   </div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__cashback.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Кэшбэк</div>
                                   <div class="field__content-num"><?php $card_cashback = get_field('card_cashback', $ID); 
                                       echo $card_cashback; ?>
                                       </div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__cashback.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Решение</div>
                                   <div class="field__content-num"><?php echo the_field('card_answ', $ID) ?></div>
                               </div>
                           </div>
                       </div>
                        <?php endif; ?>
                       <?php if($term_slug == 'debetcard'): ?>
                        <div class="col-6">
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__speed.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Снятие без %</div>
                                   <div class="field__content-num">До <?php echo the_field('non_pecent_money', $ID) ?> ₽</div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__fire.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">% на остаток</div>
                                   <div class="field__content-num">До <?php echo the_field('card_stavka_ostatok', $ID) ?>%</div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__hand.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Стоимость</div>
                                   <div class="field__content-num"><?php echo the_field('card_cost', $ID) ?> ₽</div>
                               </div>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__off.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Овердрафт</div>
                                   <div class="field__content-num">
                                       <?php echo the_field('card_overdraft') ?>
                                   </div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__cashback.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Кэшбэк</div>
                                   <div class="field__content-num">
                                    <?php $field = get_field('card_cashback');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?>
                                       </div>
                               </div>
                           </div>
                           <div class="credits__view-field field d-flex mt-3">
                               <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__cashback.png" alt=""></div>
                               <div class="field__content">
                                   <div class="field__content-title">Решение</div>
                                   <div class="field__content-num"><?php echo the_field('card_answ', $ID) ?></div>
                               </div>
                           </div>
                       </div>
                       <?php endif; ?>
                   </div>
               </div>
               <div class="col-12 col-md-6">
                   <div class="credits__view-img">
                       <img src="<?php echo the_field('card_logo', $ID) ?>" alt="">
                       <div class="credits__view-buttons d-flex justify-content-center py-3 py-sm-4">
                           <a href="<?php echo the_field('card_bank_link', $ID) ?>" class="btn btn-light mx-3">Оформить сейчас</a>
                           <button class="btn btn-outline-dark btn-scroll mx-3" data-target="pageNav">Ещё условия</button>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- / card info -->
       <!-- credit cards -->
       <!--div class="section">
           <div class="section__header d-flex justify-content-between align-items-center">
               <h2 class="title mb-0">Подбор <?php echo $title_term2 ?></h2>
           </div>
           <div class="tags__main mt-4 mb-5 pb-2 horizontal__scroll">
               <div class="horizontal__scroll-container justify-content-between">
                   <a href="" class="tag__item"><span class="tag__item-title">Без отказа</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">Для москвы</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">С доставкой на дом</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">С плохой ки</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">виртуальные</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">Для наличных</span></a>
                   <a href="" class="tag__item primary btn__view-all"><span class="tag__item-title">ещё +</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">Без отказа</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">Для москвы</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">С доставкой на дом</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">С плохой ки</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">виртуальные</span></a>
                   <a href="" class="tag__item"><span class="tag__item-title">Для наличных</span></a>
               </div>
           </div>
       </div-->
       <!-- / credits cards -->
       <!-- similar -->
       <?php
        $featured_posts = get_field('related_products', $ID);
        if( $featured_posts ): ?>
        <div class="section">
           <div class="section__header d-flex justify-content-between align-items-center">
               <h2 class="title mb-4">Похожие <?php echo $title_term ?></h2>
           </div>
           <div class="horizontal__scroll">        
               <div class="horizontal__scroll-container row">
            <?php foreach( $featured_posts as $post ): 
                // Setup this post for WP functions (variable must be named $post).
                setup_postdata($post); 
                $loop_id = get_the_id(); ?>
                <!-- item -->
                   <div class="card card__horizontal bank__item h-100 size4">
                       <div class="card-container p-2">
                           <div class="d-flex">
                               <div class="bank__item-img mr-2">
                                   <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                               </div>
                               <div class="bank__item-content">
                                   <a href="<?php echo the_permalink() ?>" class="card__header-title stretched-link mt-1 mb-2"><?php echo the_title() ?></a>
                                   <div class="card__header-info d-flex align-items-center">
                                       <div class="card__rating d-flex align-items-center mr-3">
                                           <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                           <?php echo the_field('ratings_average'); ?>
                                       </div>
                                       <div class="card__icon d-flex align-items-center mr-3">
                                           <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                           <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->total_comments ?>
                                       </div>

                                          <div class="card__like d-flex align-items-center">
                                            <?php echo do_shortcode('[wp_ulike for="post" id="'.$loop_id.'" button_type="image" style="wpulike-heart"]'); ?>
                                           </div>
                                   </div>
                               </div>
                           </div>
                           <?php $loop_terms = wp_get_post_terms( get_the_ID(), 'bankcards', array('fields' => 'all') );
                                 $loop_term_slug = $loop_terms[0]->slug;
                                 $loop_term_id = $terms[0]->term_id; ?>
                            <?php if($loop_term_slug == 'creditcard'): ?>
                           <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                               <p><?php $field = get_field('card_period');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?> без процентов</p>
                               <p>От <?php echo the_field('card_stavka') ?> %</p>
                               <p>Лимит - до <?php echo the_field('card_cred_limit') ?> ₽</p>
                               <p>Период - <?php echo the_field('card_day_period') ?> дней</p>
                           </div>
                            <?php endif; ?>
                              <?php if($loop_term_slug == 'installmentcard'): ?>
                           <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                               <p><?php $field = get_field('card_period');
                                            //$value = $field['value'];
                                           //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?> без процентов</p>
                               <p>От <?php echo the_field('card_stavka') ?> %</p>
                               <p>Лимит - до <?php echo the_field('card_cred_limit') ?> ₽</p>
                               <p>Период - <?php echo the_field('card_day_period') ?> дней</p>
                           </div>
                            <?php endif; ?>
                           <?php if($loop_term_slug == 'debetcard'): ?>
                            <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                               <p>Снятие без % до <?php echo the_field('non_pecent_money') ?> ₽</p>
                               <p>До <?php echo the_field('card_stavka_ostatok') ?> %</p>
                               <p>Тип кешбэка: <?php $field = get_field('card_cashback_type');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?></p>
                               <p>Кешбэк <?php $field = get_field('card_cashback');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?></p>
                           </div>
                            <?php endif; ?>
                       </div>
                   </div>
                   <!-- / item -->
            <?php endforeach; ?>
                </div>
           </div>
       </div>
       <!-- / similar -->
            <?php 
            // Reset the global post object so that the rest of the page works correctly.
            wp_reset_postdata(); ?>
        <?php endif; ?>
   </div>
   <div class="page__wrapper">
       <!-- page nav -->
       <div id="pageNav" class="page__nav page__nav-scroll">
           <div class="container">
               <div class="page__nav-container nav-tabs">
                   <div class="horizontal__scroll">
                       <div class="horizontal__scroll-container">
                            <?php if(have_rows('product_about_tabs', $ID)): ?>
                                <button data-target="about" data-parent="pageNav" class="nav-link btn-pageNav active">О карте</button>
                            <?php endif; ?>
                            <?php if(have_rows('product_tar', $ID)): ?>
                                <button data-target="tariffs" data-parent="pageNav" class="nav-link btn-pageNav">Тарифы</button>
                            <?php endif; ?>
                                <button data-target="calculator" data-parent="pageNav" class="nav-link btn-pageNav">калькулятор</button>
                            <?php if(have_rows('product_faq', $ID)): ?>
                                <button data-target="faq" data-parent="pageNav" class="nav-link btn-pageNav">Вопрос - ответ</button>
                            <?php endif; ?>
                            <?php if(get_field('other_products', $ID)): ?>
                                <button data-target="offers" data-parent="pageNav" class="nav-link btn-pageNav">другие предложения</button>
                            <?php endif; ?>
                                <button data-target="comments" data-parent="pageNav" class="nav-link btn-pageNav">Отзывы</button>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- / page nav -->
       <div class="container">
           <div class="row section">
               <!-- sidebar -->
               <div class="col-12 col-md-3 col-lg-4 order-md-2">
                   <div class="sticky-top sticky-top-withnav top mb-5 mb-md-0">
                       <div class="sidebar">
                           <div class="sidebar__header sidebar__section p-4">
                               <div class="d-flex align-items-center mb-4">
                                   <div class="bank__item-img mr-3">
                                       <img src="<?php echo the_field('bank_logo', $bank_id) ?>" alt="">
                                   </div>
                                   <div class="bank__item-content">
                                       <div class="card__header-title  mt-1 mb-2"><?php echo get_the_title($bank_id) ?></div>
                                       <div class="card__header-info d-flex align-items-center">
                                           <div class="card__rating d-flex align-items-center mr-3">
                                               <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                               <?php echo the_field('ratings_average', $bank_id); ?>
                                           </div>
                                           <div class="card__icon d-flex align-items-center mr-3">
                                               <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                               <?php $comments_count = wp_count_comments($bank_id); echo $comments_count->total_comments ?>
                                           </div>
                                           <div class="card__header-num">№
<?php 
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'banks',
    'meta_key' => 'ratings_average',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
);

$wp_query = new WP_Query( $args );
// Цикл
if ( $wp_query->have_posts() ) {
    $counter = 0;
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $counter +=1;
        $search_ID = get_the_ID();
        if($search_ID == $bank_id): 
            echo $counter;
        endif; ?>

        <?php
    }
} ?>
                                           </div>                                
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-12">
                                       <div class="sidebar__field mb-3">
                                           <div class="sidebar__field-title">Организания</div>
                                           <div class="sidebar__field-content"><?php echo get_the_title($bank_id) ?></div>
                                       </div>
                                       <div class="sidebar__field mb-3">
                                           <div class="sidebar__field-title">Телефон</div>
                                           <div class="sidebar__field-content"><a href="tel:<?= preg_replace('![^0-9]+!', '', get_field('bank_phone', $bank_id)); ?>"><?php echo the_field('bank_phone', $bank_id)  ?></a></div>
                                       </div>
                                   <!--/div>
                                   <div class="col-6"-->
                                       <div class="sidebar__field mb-3">
                                           <div class="sidebar__field-title">Официальный сайт</div>
                                           <div class="sidebar__field-content">
                                            <?php if (get_field('card_bank_link', $ID)): ?>
                                                <a href="<?= get_field('card_bank_link', $ID); ?>" target="_blank">
                                                    <?= get_field('bank_email', $bank_id);  ?>
                                                </a>    
                                            <?php else: ?>    
                                                <a href="<?= get_field('bank_email', $bank_id); ?>" target="_blank">
                                                    <?= get_field('bank_email', $bank_id);  ?>
                                                </a> 
                                            <?php endif; ?>
                                            </div>    
                                       </div>
                                       <div class="sidebar__field mb-3">
                                           <div class="sidebar__field-title">Электронная почта</div>
                                           <div class="sidebar__field-content"><a href="mailto:<?php echo the_field('bank_e_mail_long', $bank_id)  ?>"><?php echo the_field('bank_e_mail_long', $bank_id)  ?></a></div>
                                       </div>
                                   </div>
                               </div>
                           </div>
<!--                            <div class="sidebar__section h3 text-center py-3">Продукты банка</div>
                           <div class="sidebar__links px-4 py-3">
                               <a href="" class="sidebar__links-item my-1">Подбор кредита</a>
                               <a href="" class="sidebar__links-item my-1">Вклады </a>
                               <a href="" class="sidebar__links-item my-1">Ипотека</a>
                               <a href="" class="sidebar__links-item my-1">Кредитные карты</a>
                               <a href="" class="sidebar__links-item my-1">Дебетовые карты</a>
                               <a href="" class="sidebar__links-item my-1">Автокредиты</a>
                               <a href="" class="sidebar__links-item my-1">Расчетно-кассовое обслуживание</a>
                           </div> -->
                       </div>
                   </div>
               </div>
               <!-- / sidebar -->
               <div class="col-12 col-md-9 col-lg-8 order-md-1">
                        <?php  if( have_rows('product_about_tabs', $ID) ): 
                            $counter_about = 0; ?>
                    <div id="about" class="section">
                       <div class="section__header d-flex justify-content-between align-items-center">
                           <h2 class="title mb-4">О карте</h2>
                       </div>
                       <div class="wysiwyg pb-4">
                           <?php echo the_field('product_text_desc', $ID) ?>
                       </div>
                       <!-- accordion -->
                            <div class="accordion mb-4" id="accordion">
                            <?php while( have_rows('product_about_tabs', $ID) ): the_row(); 
                                $title = get_sub_field('title');
                                $text = get_sub_field('text');
                                $counter_about+=1;
                                ?>
                                <div class="accordion__item">
                                   <div class="accordion__header">
                                       <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse__item-<?php echo $counter_about ?>" aria-expanded="false">
                                           <?php echo $title ?>
                                           <div class="accordion__button-icon"><svg width="12" height="6" viewBox="0 0 12 6"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use></svg></div>
                                       </button>
                                   </div>
                                   <div id="collapse__item-<?php echo $counter_about ?>" class="accordion__collapse collapse" data-bs-parent="#accordion">
                                       <div class="accordion__body wysiwyg">
                                           <?php echo $text ?>
                                       </div>
                                   </div>
                               </div>
                            <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- / accordion -->
                    <!-- tariffs -->
                   <?php if( have_rows('product_tar', $ID) ): ?>
                    <div id="tariffs" class="section">
                       <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                           <h2 class="title mb-0">Тарифы</h2>
                       </div>
                       <div class="tariffs__list">
                        <?php while( have_rows('product_tar', $ID) ): the_row(); 
                            $title = get_sub_field('title');
                            $text = get_sub_field('text');
                            ?>
                            <div class="tariffs__list-item">
                               <div class="row">
                                   <div class="tariffs__list-title col-6"><?php echo $title ?></div>
                                   <div class="tariffs__list-description col-6"><?php echo $text ?></div>
                               </div>
                           </div>
                        <?php endwhile; ?>
                           </div>
                       </div>
                    <?php endif; ?>
                    <!-- / tariffs -->

                   <!-- calc -->
                   <div id="calculator" class="section">
                       <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                           <h2 class="title mb-0">Калькулятор</h2>
                       </div>
                       <div class="calc" id="calc" data-type="creditCalc">
                           <div class="calc__header h3 m-0 p-3 px-md-4 py-md-3">Калькулятор кредитной карты</div>
                           <div class="calc__content p-3 p-md-4">
                               <div class="row">
                                   <div class="col-12 col-md-6">
                                       <div class="calc__content-buttons d-flex pb-3">
                                           <label class="btn__radio">
                                               <input class="calc__input" type="radio" name="caclType" data-field="type" value="1" checked="">
                                               <span class="btn__radio-text">Аннуентный</span>
                                           </label>
                                           <label class="btn__radio">
                                               <input class="calc__input" type="radio" name="caclType" data-field="type" value="2">
                                               <span class="btn__radio-text">Дифференцированный</span>
                                           </label>
                                       </div>
                                       <div class="calc__field mt-3 mt-md-4">
                                           <div class="calc__field-wrap">
                                               <div class="calc__field-label">Кредитный лимит</div>
                                               <input type="text" class="range__value form-control calc__input " value="1000000" min="0" max="10000000" data-field="limit">
                                               <input class="range__input calc__input" name="range1" type="range" min="0" max="10000000" value="1000000" data-field="limit" style="--range-progress:10%;">
                                           </div>
                                       </div>
                                       <div class="calc__field d-flex">
                                           <div class="calc__field-wrap mt-3 mt-md-4 flex-grow-1">
                                               <div class="calc__field-label">Срок / месяц</div>
                                               <input type="text" class="range__value form-control calc__input" value="10" min="1" max="40" data-field="date">
                                               <input class="range__input calc__input" name="range2" type="range" min="1" max="40" value="10" data-field="date" style="--range-progress:25%;">
                                           </div>
                                           <div class="calc__field-wrap calc__field-min mt-3 mt-md-4 ml-3">
                                               <div class="calc__field-label">Ставка</div>
                                               <input type="text" class="range__value form-control calc__input" value="15%" maxlength="6" data-field="percent" pattern="[0-9]*">
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-12 col-md-6">
                                       <div class="calc__total">
                                           <div class="calc__total-field d-flex justify-content-between align-items-center">
                                               <div class="calc__total-label">Сумма кредита</div>
                                               <div class="calc__value">
                                                   <span id="calc__sum" class="calc__value-text">8 000 000</span>
                                                   <span class="calc__value-char">₽</span>
                                               </div>
                                           </div>
                                           <div class="calc__total-field d-flex justify-content-between align-items-center">
                                               <div class="calc__total-label">Переплата</div>
                                               <div class="calc__total-value">
                                                   <span id="calc__overpay" class="calc__value-text">1 000 000</span> 
                                                   <span class="calc__value-char">₽</span>
                                               </div>
                                           </div>
                                           <div class="calc__total-field d-flex justify-content-between align-items-center">
                                               <div class="calc__total-label">Общая сумма выплат</div>
                                               <div class="calc__total-value">
                                                   <span id="calc__total" class="calc__value-text">9 000 000</span> 
                                                   <span class="calc__value-char">₽</span>
                                               </div>
                                           </div>
                                           <div class="calc__total-field d-flex justify-content-between align-items-center">
                                               <div class="calc__total-label">Окончание кредита</div>
                                               <div class="calc__total-value">
                                                   <span id="calc__dateEnd" class="calc__value-text">15.05.2022</span>
                                               </div>
                                           </div>
                                           <div class="calc__total-field d-flex justify-content-between align-items-center">
                                               <div class="calc__total-label">Платежи в месяц</div>
                                               <div class="calc__total-value">
                                                   <span id="calc__payments" class="calc__value-text">500 000</span>
                                                   <span class="calc__value-char">₽</span>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!-- / calc -->
                   <!-- faq list -->
                    <?php if( have_rows('product_faq', $ID) ): ?>
                       <div id="faq" class="section">
                           <div class="faq__list">
                               <div class="faq__list-item">
                                   <h2>Ответы на вопросы</h2>
                               </div>
                        <?php while( have_rows('product_faq', $ID) ): the_row(); 
                            $question = get_sub_field('question');
                            $answer = get_sub_field('answer');
                            ?>
                            <div class="faq__list-item">
                               <h3 class="faq__list-title mb-3"><?php echo $question ?></h3>
                               <p><?php echo $answer ?></p>
                           </div>
                        <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                   <!-- / faq list -->
                   <!-- author -->
                   <?php $author_id = get_field('page_author', $ID) ?>
                   <?php if($author_id): ?>
                   <div class="card expert__horizontal">
                       <div class="card-container">
                           <div class="d-flex flex-wrap">
                               <div class="expert__horizontal-title d-flex align-items-center mb-md-3 order-2 order-md-1">
                                   <span class="d-none d-md-block mr-2">Автор:</span>
                                   <a href="<?php echo get_permalink($author_id) ?>" class="stretched-link"><?php echo get_the_title($author_id) ?></a>
                               </div>
                               <div class="expert__card-social ml-md-auto d-flex justify-content-end mb-md-3 order-4 order-md-2">
                                   <?php if( have_rows('expert_socials', $author_id) ):
                    while( have_rows('expert_socials', $author_id) ) : the_row(); 
                        $socialname = get_sub_field('socialname');
                        $social_link = get_sub_field('social_link'); ?>
                        <?php if( $socialname == 'bc1' ): ?>
                            <a href="<?php echo $social_link ?>" class="social__link telegram d-flex justify-content-center align-items-center mx-2">
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.545295 6.26176L3.76396 7.46194L5.01869 11.4989C5.07324 11.7717 5.40057 11.8262 5.61878 11.6626L7.41904 10.1896C7.5827 10.026 7.85547 10.026 8.07369 10.1896L11.2923 12.5354C11.5106 12.6991 11.8379 12.59 11.8924 12.3172L14.2928 0.860961C14.3473 0.588194 14.0746 0.315429 13.8018 0.424536L0.545295 5.55257C0.217974 5.66167 0.217974 6.15265 0.545295 6.26176ZM4.85503 6.86185L11.1832 2.98855C11.2923 2.934 11.4014 3.09766 11.2923 3.15221L6.10976 8.00747C5.9461 8.17113 5.78243 8.38935 5.78243 8.66211L5.61878 9.9714C5.61878 10.1351 5.34601 10.1896 5.29146 9.9714L4.63681 7.57104C4.47315 7.29828 4.58227 6.97095 4.85503 6.86185Z" fill="white"></path>
                                </svg>    
                            </a>
                        <?php endif; ?>
                        <?php if( $socialname == 'bc2' ): ?>
                            <a href="<?php echo $social_link ?>" class="social__link vk d-flex justify-content-center align-items-center mx-2">
                                <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.8645 8.58097C14.8645 8.52285 14.8063 8.52286 14.8063 8.46474C14.5739 7.99981 14.0508 7.41865 13.3534 6.77938C13.0047 6.4888 12.8304 6.25633 12.7142 6.1401C12.5398 5.90763 12.5398 5.73329 12.5979 5.50083C12.656 5.32648 12.8885 5.03589 13.2953 4.51285C13.5278 4.22227 13.644 4.04792 13.8184 3.87358C14.6901 2.71125 15.0969 1.95574 14.9807 1.60704L14.9226 1.54893C14.8645 1.49082 14.8063 1.4327 14.6901 1.4327C14.5739 1.37459 14.3995 1.37459 14.2252 1.4327H12.0168C11.9587 1.4327 11.9586 1.4327 11.8424 1.4327C11.7843 1.4327 11.7262 1.4327 11.7262 1.4327H11.6681H11.61L11.5518 1.49081C11.4937 1.54893 11.4937 1.54893 11.4937 1.60704C11.2613 2.24632 10.9707 2.76937 10.6801 3.35053C10.5057 3.64111 10.3314 3.93169 10.1571 4.16416C9.9827 4.39662 9.86647 4.57096 9.75023 4.6872C9.634 4.80343 9.51777 4.86154 9.45965 4.97778C9.40154 5.03589 9.28531 5.09401 9.28531 5.0359C9.2272 5.0359 9.16907 5.03589 9.16907 4.97778C9.11096 4.91966 9.05285 4.86154 8.99473 4.80343C8.93662 4.74531 8.93661 4.62908 8.87849 4.51285C8.87849 4.39661 8.87849 4.28038 8.87849 4.22227C8.87849 4.16415 8.87849 3.98981 8.87849 3.87358C8.87849 3.69923 8.87849 3.58299 8.87849 3.52488C8.87849 3.35053 8.87849 3.11807 8.87849 2.8856C8.87849 2.65314 8.87849 2.47879 8.87849 2.36255C8.87849 2.24632 8.87849 2.07198 8.87849 1.95574C8.87849 1.7814 8.87849 1.66516 8.87849 1.60704C8.87849 1.54893 8.82039 1.4327 8.82039 1.37458C8.76227 1.31647 8.70415 1.25835 8.64603 1.20023C8.58792 1.14212 8.47169 1.14212 8.41357 1.084C8.12299 1.02589 7.7743 0.967773 7.36749 0.967773C6.43763 0.967773 5.79835 1.02589 5.56589 1.14212C5.44966 1.20024 5.33342 1.25835 5.27531 1.37458C5.15908 1.49082 5.15907 1.54893 5.21719 1.54893C5.50777 1.60705 5.74024 1.72328 5.85647 1.89762L5.91459 2.01386C5.9727 2.07198 5.97269 2.18821 6.03081 2.36255C6.08893 2.5369 6.08893 2.71125 6.08893 2.94372C6.08893 3.29241 6.08893 3.64111 6.08893 3.87358C6.08893 4.16416 6.03081 4.3385 6.03081 4.51285C6.03081 4.68719 5.9727 4.80343 5.91459 4.86155C5.85647 4.97778 5.85646 5.0359 5.79835 5.0359C5.79835 5.0359 5.79835 5.09401 5.74023 5.09401C5.68211 5.09401 5.624 5.15213 5.50777 5.15213C5.44965 5.15213 5.33342 5.09401 5.27531 5.0359C5.15908 4.97778 5.04284 4.86155 4.98473 4.74532C4.8685 4.62908 4.75226 4.45473 4.63603 4.22227C4.5198 3.9898 4.34544 3.75734 4.22921 3.40865L4.11299 3.17618C4.05487 3.05995 3.93864 2.82749 3.82241 2.5369C3.70617 2.24632 3.58994 2.01386 3.47371 1.72328C3.41559 1.60705 3.35748 1.54893 3.29937 1.49081H3.24125C3.24125 1.49081 3.18312 1.4327 3.12501 1.4327C3.06689 1.4327 3.00878 1.37458 2.95067 1.37458H0.858485C0.626021 1.37458 0.50979 1.4327 0.451674 1.49081L0.393555 1.54893C0.393555 1.54893 0.393555 1.60705 0.393555 1.66516C0.393555 1.72328 0.393558 1.78139 0.451674 1.89762C0.742255 2.59502 1.09095 3.29241 1.43965 3.98981C1.78834 4.62908 2.13704 5.21024 2.36951 5.61706C2.66009 6.02387 2.89255 6.43068 3.18313 6.77938C3.47371 7.12807 3.64805 7.36054 3.70617 7.47677C3.8224 7.593 3.88051 7.65111 3.93863 7.70923L4.11299 7.88358C4.22922 7.99981 4.40356 8.17416 4.63603 8.34851C4.86849 8.52286 5.15907 8.6972 5.44965 8.87155C5.74023 9.0459 6.08893 9.16214 6.43763 9.27837C6.84444 9.3946 7.19313 9.45272 7.54183 9.3946H8.41357C8.58792 9.3946 8.70416 9.33648 8.82039 9.22025L8.87849 9.16213C8.87849 9.10401 8.93661 9.10402 8.93661 9.0459C8.93661 8.98778 8.93661 8.92967 8.93661 8.81344C8.93661 8.58098 8.93662 8.40663 8.99473 8.23228C9.05285 8.05793 9.05285 7.9417 9.11097 7.82547C9.16909 7.70924 9.2272 7.65111 9.28531 7.593C9.34343 7.53488 9.40155 7.47677 9.40155 7.47677H9.45965C9.57588 7.41865 9.75024 7.47677 9.86647 7.593C10.0408 7.70923 10.2152 7.88358 10.3314 8.05793C10.4476 8.23228 10.622 8.40663 10.8545 8.63909C11.0869 8.87155 11.2613 9.0459 11.3775 9.10402L11.5518 9.22025C11.6681 9.27837 11.7843 9.33648 11.9587 9.3946C12.133 9.45272 12.2492 9.45271 12.3655 9.45271L14.3414 9.3946C14.5158 9.3946 14.6901 9.33648 14.8063 9.27837C14.9226 9.22025 14.9807 9.16213 14.9807 9.0459C14.9807 8.98778 14.9807 8.87156 14.9807 8.81344C14.8644 8.69721 14.8645 8.63909 14.8645 8.58097Z" fill="white"></path>
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if( $socialname == 'bc3' ): ?>
                            <a href="<?php echo $social_link ?>" class="social__link instagram d-flex justify-content-center align-items-center mx-2">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.6064 0.399902H2.09336C1.13221 0.399902 0.399902 1.13221 0.399902 2.09336V10.6064C0.399902 11.5676 1.13221 12.2999 2.09336 12.2999H10.6064C11.5676 12.2999 12.2999 11.5676 12.2999 10.6064V2.09336C12.2999 1.13221 11.5676 0.399902 10.6064 0.399902ZM6.3499 9.9199C8.31798 9.9199 9.9199 8.36375 9.9199 6.48721C9.9199 6.16683 9.87413 5.80067 9.78259 5.52606H10.7895V10.3776C10.7895 10.6064 10.6064 10.8353 10.3318 10.8353H2.36798C2.13913 10.8353 1.91029 10.6522 1.91029 10.3776V5.48029H2.96298C2.87144 5.80067 2.82567 6.12106 2.82567 6.44144C2.7799 8.36375 4.38183 9.9199 6.3499 9.9199ZM6.3499 8.54683C5.06836 8.54683 4.06144 7.5399 4.06144 6.30413C4.06144 5.06836 5.06836 4.06144 6.3499 4.06144C7.63144 4.06144 8.63836 5.06836 8.63836 6.30413C8.63836 7.58567 7.63144 8.54683 6.3499 8.54683ZM10.7438 3.64952C10.7438 3.92413 10.5149 4.15298 10.2403 4.15298H8.95875C8.68413 4.15298 8.45529 3.92413 8.45529 3.64952V2.41375C8.45529 2.13913 8.68413 1.91029 8.95875 1.91029H10.2403C10.5149 1.91029 10.7438 2.13913 10.7438 2.41375V3.64952Z" fill="white"></path>
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if( $socialname == 'bc4' ): ?>
                            <a href="<?php echo $social_link ?>" class="social__link mymir d-flex justify-content-center align-items-center mx-2">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.6065 1.91029C9.50799 0.903364 8.18067 0.399902 6.53298 0.399902C4.83952 0.399902 3.3749 0.949133 2.1849 2.09336C0.9949 3.2376 0.399902 4.65644 0.399902 6.3499C0.399902 7.9976 0.949139 9.37067 2.09337 10.5607C3.2376 11.7507 4.74799 12.2999 6.71607 12.2999C7.8603 12.2999 9.00453 12.0711 10.1488 11.5676C10.5149 11.4303 10.698 10.9726 10.5607 10.6064C10.4234 10.2403 9.96568 10.0572 9.59952 10.1945C8.63837 10.6064 7.67721 10.8353 6.76182 10.8353C5.29721 10.8353 4.15298 10.3776 3.32913 9.46221C2.50528 8.54683 2.09337 7.49413 2.09337 6.30413C2.09337 4.97683 2.55106 3.87836 3.3749 3.00875C4.24452 2.13913 5.29721 1.68144 6.57875 1.68144C7.72298 1.68144 8.7299 2.04759 9.55375 2.7799C10.3776 3.51221 10.7438 4.42759 10.7438 5.52606C10.7438 6.25836 10.5607 6.89913 10.1945 7.4026C9.82836 7.90606 9.46221 8.1349 9.05029 8.1349C8.82144 8.1349 8.72991 8.04336 8.72991 7.76875C8.72991 7.58567 8.72991 7.35683 8.77568 7.12798L9.23337 3.42067H7.67721L7.58568 3.78683C7.17376 3.46644 6.76182 3.28336 6.30413 3.28336C5.57182 3.28336 4.93106 3.60375 4.38183 4.19875C3.8326 4.79375 3.60375 5.57183 3.60375 6.48721C3.60375 7.4026 3.8326 8.1349 4.33606 8.7299C4.79375 9.27913 5.38876 9.55375 6.02953 9.55375C6.62453 9.55375 7.12798 9.3249 7.53991 8.82144C7.86029 9.27913 8.31799 9.55375 8.95876 9.55375C9.87414 9.55375 10.6522 9.14183 11.3387 8.36375C12.0253 7.58567 12.3457 6.62452 12.3457 5.48029C12.2084 4.10721 11.6591 2.87144 10.6065 1.91029ZM6.99067 7.49413C6.71605 7.86029 6.39568 8.04336 5.98376 8.04336C5.70914 8.04336 5.52607 7.90606 5.34299 7.63144C5.15991 7.35683 5.11414 7.03644 5.11414 6.62452C5.11414 6.12106 5.20567 5.70913 5.43452 5.43452C5.66336 5.11413 5.93799 4.97683 6.25837 4.97683C6.53299 4.97683 6.8076 5.06836 7.03644 5.34298C7.26529 5.57183 7.35683 5.89221 7.35683 6.25836C7.4026 6.71606 7.26529 7.12798 6.99067 7.49413Z" fill="white"></path>
                                </svg>    
                            </a>
                        <?php endif; ?>
                    <?php endwhile; endif; ?>
                                   <!-- rating mobile -->
                                   <div class="card__rating d-flex d-md-none align-items-center ml-auto">
                                       <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                       <?php echo the_field('ratings_average', $author_id); ?>
                                   </div>
                                   <!-- / rating mobile -->
                               </div>
                               <div class="expert__horizontal-picture mr-md-4 d-flex flex-column order-1 order-md-3">
                                   <div class="expert__horizontal-img">
                                       <img src="<?php echo the_field('expert_logo', $author_id ) ?>" alt="">
                                   </div>
                                   <div class="card__rating d-none d-md-flex align-items-center mx-auto mt-3">
                                       <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                       <?php echo the_field('ratings_average', $author_id); ?>
                                   </div>
                               </div>
                               <div class="expert__horizontal-content order-3 order-md-4">
                                   <?php $post_id = $author_id;
                                         $post_content = get_post($post_id);
                                         $content = $post_content->post_content;
                                         echo apply_filters('the_content',$content); ?>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!-- / author -->
               <?php endif; ?>
               </div>
           </div>
           <!-- other others -->
           <?php
        $other_products = get_field('other_products', $ID);
        if( $other_products ): ?>
        <div id="offers" class="section">
           <div class="section__header d-flex justify-content-between align-items-center">
               <h2 class="title mb-4">Другие предложения</h2>
           </div>
           <div class="horizontal__scroll">        
               <div class="horizontal__scroll-container row">
            <?php foreach( $other_products as $post ): 
                // Setup this post for WP functions (variable must be named $post).
                setup_postdata($post); ?>
                <!-- item -->
                   <div class="card card__horizontal bank__item h-100 size4">
                       <div class="card-container p-2">
                           <div class="d-flex">
                               <div class="bank__item-img mr-2">
                                   <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                               </div>
                               <div class="bank__item-content">
                                   <a href="<?php echo the_permalink() ?>" class="card__header-title stretched-link mt-1 mb-2"><?php echo the_title() ?></a>
                                   <div class="card__header-info d-flex align-items-center">
                                       <div class="card__rating d-flex align-items-center mr-3">
                                           <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                           <?php echo the_field('ratings_average'); ?>
                                       </div>
                                       <div class="card__icon d-flex align-items-center mr-3">
                                           <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                           <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->total_comments ?>
                                       </div>
                                       <div class="card__header-num">
                                           №1
                                       </div>                                
                                   </div>
                               </div>
                           </div>
                           <?php $loop_terms = wp_get_post_terms( get_the_ID(), 'bankcards', array('fields' => 'all') );
                                 $loop_term_slug = $loop_terms[0]->slug;
                                 $loop_term_id = $terms[0]->term_id; ?>
                            <?php if($loop_term_slug == 'creditcard'): ?>
                           <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                               <p><?php $field = get_field('card_period');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?> без процентов</p>
                               <p>От <?php echo the_field('card_stavka') ?> %</p>
                               <p>Лимит - до <?php echo the_field('card_cred_limit') ?> ₽</p>
                               <p>Период - <?php echo the_field('card_day_period') ?> дней</p>
                           </div>
                            <?php endif; ?>
                            <?php if($loop_term_slug == 'installmentcard'): ?>
                           <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                               <p><?php $field = get_field('card_period');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?> без процентов</p>
                               <p>От <?php echo the_field('card_stavka') ?> %</p>
                               <p>Лимит - до <?php echo the_field('card_cred_limit') ?> ₽</p>
                               <p>Период - <?php echo the_field('card_day_period') ?> дней</p>
                           </div>
                            <?php endif; ?>
                           <?php if($loop_term_slug == 'debetcard'): ?>
                            <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                               <p>Снятие без % до <?php echo the_field('non_pecent_money') ?> ₽</p>
                               <p>До <?php echo the_field('card_stavka_ostatok') ?> %</p>
                               <p>Тип кешбэка: <?php $field = get_field('card_cashback_type');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></p>
                               <p>Кешбэк <?php $field = get_field('card_cashback');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></p>
                           </div>
                            <?php endif; ?>
                       </div>
                   </div>
                   <!-- / item -->
            <?php endforeach; ?>
                </div>
           </div>
       </div>
       <!-- / similar -->
            <?php 
            // Reset the global post object so that the rest of the page works correctly.
            wp_reset_postdata(); ?>
        <?php endif; ?>
           <!-- / other offers -->
           <!-- comments -->
           <div id="comments" class="section">
                <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                   <h2 class="title mb-0">Отзывы клиентов </h2>
                   <button class="btn btn-primary btn-scroll btn-sm" data-target="commentForm">
                       Оставить отзыв
                   </button>
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
                   'default'=>'identicon',) ); ?>" alt="">
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
                                                   <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                                                       <div class="mr-2"><svg width="18" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#house" x="0" y="0"></use></svg></div>
                                                       <?php $bank_id = get_field('bank_choise', $comment_post_id); ?>
                                                        <?php echo get_the_title($bank_id); ?>
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
                                                   <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                                                       <div class="mr-2"><svg width="18" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#house" x="0" y="0"></use></svg></div>
                                                       <?php $bank_id = get_field('bank_choise', $comment_post_id); ?>
                                                        <?php echo get_the_title($bank_id); ?>
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
                   <?php if(count($comments) !="0"): ?>
                   <div class="comments__action text-center">
                        <a href="<?php echo  get_page_link(1503); ?>" class="btn btn-outline-alternative reviews-link" post-id="<?php echo $ID ?>">Больше отзывов</a>
                    </div>
                <?php endif; ?>
              </div>
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
                                                        <textarea id="comment" post-id="'. $ID .'"  name="comment" class="form-control input-comment-trigger" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
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
                        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5" value="Отправить" />',
                        'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                        'format'               => 'xhtml',
                    ];
                    echo comment_form( $defaults, $ID ); ?>
                </div>
            </div>
            <!-- / form and comments -->
       </div>
   </div>

   <div class="container">
       <!-- best credit cards -->
       <div class="section">
           <div class="section__header d-flex justify-content-between align-items-center mb-4">
               <h2 class="title mb-0">Лучшие <?php echo $title_term ?> </h2>
               <?php if($term_id) : ?>
               <a href="<?php echo get_term_link($term_id, '') ?>" class="btn btn-primary btn-sm btn-all">
                   Все
                   <span class="icon ml-2">
                       <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
                   </span>
               </a>
           <?php endif; ?>
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
                               <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></div>
                           </div>
                           <div class="card__header-info d-flex align-items-center">
                               <div class="card__rating d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                   <?php echo the_field('ratings_average'); ?>
                               </div>
                               <div class="card__icon d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                                  <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->total_comments ?>
                               </div>
                               <div class="card__like d-flex align-items-center">
                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                               <div class="card__header-actions ml-auto">
                                   <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                               </div>                                
                           </div>
                            <div class="card__image my-3">
                               <a href="<?php echo the_permalink() ?>"><img src="<?php echo the_field('card_logo') ?>" alt=""></a>
                           </div>

                           <ul class="leaders">
                            <?php $loop_terms = wp_get_post_terms( get_the_ID(), 'bankcards', array('fields' => 'all') );
                                 $loop_term_slug = $loop_terms[0]->slug;
                                 $loop_term_id = $terms[0]->term_id; ?>
                            <?php if($loop_term_slug == 'creditcard'): ?>
                           <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
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
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
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
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Кешбэк</div>
                                   <div class="leaders__item-value"><?php $field = get_field('card_cashback');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
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
       <!-- / best credit cards -->
   </div>
</main>

<?php get_footer(); ?>