<?php
/*
 * Template Name: Zaimy New
 * Template Post Type: zaimy
 */

get_header(); ?>
<?php
$queried_object = get_queried_object();
$ID = get_queried_object()->ID;
$tags = get_the_tags($ID);

$credit_link =  get_term_link(2, '');
$debet_link = get_term_link(7, '');
$installment_link = get_term_link(8, '');
//$creditprod_link =  get_term_link('kredity', '');
$creditprod_link =  '/kredity/';
$zaim_link =  '/zaimy/';

$apply_now = get_field('apply_now_select_products', $ID);

$current_url = get_permalink();

?>
<?php // get_template_part('all_template/popap_apply_now', null, ['DATA' => $apply_now]); 
?>


<main class="zaimy-new">
    <!-- page head -->
    <div class="container">
        <nav aria-label="breadcrumb" class="horizontal__scroll">
            <ol class="breadcrumb horizontal__scroll-container">
                <!-- <li class="breadcrumb-item"><a href="<?php echo get_home_url(); ?>">Главная</a></li> -->
                <li class="breadcrumb-item">
                    <svg width="8" height="20" viewBox="0 0 8 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.35355 5.64645C6.54882 5.84171 6.54882 6.15829 6.35355 6.35355L2.70711 10L6.35355 13.6464C6.54882 13.8417 6.54882 14.1583 6.35355 14.3536C6.15829 14.5488 5.84171 14.5488 5.64645 14.3536L1.64645 10.3536C1.45119 10.1583 1.45119 9.84171 1.64645 9.64645L5.64645 5.64645C5.84171 5.45118 6.15829 5.45118 6.35355 5.64645Z" fill="#0A0D13" fill-opacity="0.55"></path>
                    </svg>
                    <a href="<?php echo get_post_type_archive_link('zaimy'); ?>">Все МФО</a>
                </li>
                <!-- <li class="breadcrumb-item active" aria-current="page"><?php echo the_title() ?></li> -->
            </ol>
        </nav>
        <!-- card info -->
        <div class="credits__view section">
            <div class="row">
                <div class="col-12">
                    <?php if (get_field('archive') == true): ?>
                        <div class="card__archive mb-2">Архив</div>
                    <?php endif; ?>
                </div>
            </div>
            <h1 class="credits__view-title mb-1 mb-xl-4 heads-about active">Займ в <?php echo the_title() ?></h1>


            <div class="credits__view-mob-description">
                <?php echo the_field('product_text_desc_mob', $ID) ?>
            </div>

            <div class="row">
                <div class="col-12 col-md-9 col-lg-8 order-md-1">
                    <div class="credits__view-meta d-flex flex-wrap flex-xl-nowrap align-items-center">
                        <div class="credits__view-bank mt-3 mt-xl-0 mr-3">

                            <?php echo esc_html(get_field('z_organization_name')); ?>

                        </div>
                        <div class="rating d-flex align-items-center mt-3 mt-xl-n1 mr-3">
                            <?php echo do_shortcode('[ratings id="' . $ID . '"]'); ?>
                        </div>
                        <div class="d-flex align-items-center mt-3 mt-xl-0">
                            <div class="card__icon d-flex align-items-center mr-3">
                                <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use>
                                    </svg></div>
                                <?php echo get_post_meta($ID, 'views', true); ?>
                            </div>
                            <div class="card__icon d-flex align-items-center mr-3">
                                <div class="mr-2"><a href="#comments" data-target="comments" class="btn-scroll"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                        </svg></a></div>
                                <?php echo comments_number('0', '1', '%'); ?>
                            </div>
                            <!--                            <div class="card__like d-flex align-items-center">
                               <div class="mr-2"><svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.5 17.6" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#heartLine" x="0" y="0"></use></svg></div>
                               658
                           </div> -->
                            <div class="card__like d-flex align-items-center mr-3">
                                <?php echo do_shortcode('[wp_ulike for="post" id="' . $ID . ' button_type="image" style="wpulike-heart"]'); ?>
                            </div>

                            <div class="card__header card__header-custom">
                                <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="zaimy">
                                    <svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m3.29 19.939.44-.607-.44.607Zm-1.229-1.23.607-.44-.607.44Zm17.878 0-.607-.44.607.44Zm-1.23 1.23-.44-.607.44.607Zm0-17.878-.44.607.44-.607Zm1.23 1.23-.607.44.607-.44ZM3.29 2.06l.44.607-.44-.607Zm-1.229 1.23.607.44-.607-.44Zm14.133 6.598a.75.75 0 1 0-1.5 0h1.5Zm-1.5 6.667a.75.75 0 0 0 1.5 0h-1.5ZM11.75 5.444a.75.75 0 0 0-1.5 0h1.5Zm-1.5 11.112a.75.75 0 0 0 1.5 0h-1.5ZM7.306 12.11a.75.75 0 0 0-1.5 0h1.5Zm-1.5 4.445a.75.75 0 0 0 1.5 0h-1.5ZM11 20.25c-2.1 0-3.615-.001-4.789-.128-1.16-.126-1.9-.368-2.48-.79l-.882 1.214c.88.639 1.913.928 3.2 1.067 1.274.138 2.885.137 4.951.137v-1.5ZM.25 11c0 2.066-.001 3.677.137 4.95.14 1.288.428 2.321 1.067 3.2l1.214-.88c-.422-.582-.664-1.32-.79-2.481-.127-1.174-.128-2.69-.128-4.789H.25Zm3.48 8.332a4.807 4.807 0 0 1-1.062-1.063l-1.214.882c.39.535.86 1.006 1.395 1.395l.882-1.214ZM20.25 11c0 2.1-.001 3.615-.128 4.789-.126 1.16-.368 1.9-.79 2.48l1.214.882c.639-.88.928-1.913 1.067-3.2.138-1.274.137-2.885.137-4.951h-1.5ZM11 21.75c2.066 0 3.677.001 4.95-.137 1.288-.14 2.321-.428 3.2-1.067l-.88-1.214c-.582.422-1.32.664-2.481.79-1.174.127-2.69.128-4.789.128v1.5Zm8.332-3.48a4.808 4.808 0 0 1-1.063 1.062l.882 1.214a6.304 6.304 0 0 0 1.395-1.395l-1.214-.882ZM11 1.75c2.1 0 3.615.001 4.789.128 1.16.126 1.9.368 2.48.79l.882-1.214c-.88-.639-1.913-.927-3.2-1.067C14.677.249 13.066.25 11 .25v1.5ZM21.75 11c0-2.066.001-3.677-.137-4.95-.14-1.288-.428-2.321-1.067-3.2l-1.214.88c.422.582.664 1.32.79 2.481.127 1.174.128 2.69.128 4.789h1.5Zm-3.48-8.332c.407.296.766.655 1.062 1.063l1.214-.882a6.305 6.305 0 0 0-1.395-1.395l-.882 1.214ZM11 .25C8.934.25 7.323.249 6.05.387c-1.288.14-2.321.428-3.2 1.067l.88 1.214c.582-.422 1.32-.664 2.481-.79C7.385 1.751 8.901 1.75 11 1.75V.25ZM1.75 11c0-2.1.001-3.615.128-4.789.126-1.16.368-1.9.79-2.48l-1.214-.882C.815 3.73.527 4.762.387 6.05.249 7.324.25 8.934.25 11h1.5Zm1.1-9.546A6.306 6.306 0 0 0 1.453 2.85l1.214.882A4.805 4.805 0 0 1 3.73 2.668l-.882-1.214ZM14.693 9.89v6.667h1.5V9.889h-1.5ZM10.25 5.444v11.112h1.5V5.444h-1.5Zm-4.444 6.667v4.445h1.5V12.11h-1.5Z"></path>
                                    </svg>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="row my-2 my-sm-4 mb-md-0 credits__view-block">
                        <div class="col-6 col-md-4">
                            <div class="credits__view-field field d-flex mt-3">
                                <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__speed.png" alt="Сумма займа"></div>
                                <div class="field__content">
                                    <div class="field__content-title">Сумма займа</div>
                                    <div class="field__content-num"><?php echo the_field('z_sum', $ID) ?> ₽</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="credits__view-field field d-flex mt-3">
                                <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__fire.png" alt="% ставка"></div>
                                <div class="field__content">
                                    <div class="field__content-title">% ставка</div>
                                    <div class="field__content-num">От <?php echo the_field('z_stavka', $ID) ?>%</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="credits__view-field field d-flex mt-3">
                                <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__hand.png" alt="Возраст"></div>
                                <div class="field__content">
                                    <div class="field__content-title">Возраст</div>
                                    <div class="field__content-num">
                                        От <?php
                                            $z_oldness = get_field('z_oldness', $ID);
                                            if ($z_oldness !== false && $z_oldness !== '') { // Проверяем, что значение существует
                                                echo esc_html($z_oldness) . ' ' . ($z_oldness == 1 ? 'года' : 'лет');
                                            } else {
                                                echo 'Не указано'; // Или любое другое значение по умолчанию
                                            }
                                            ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="credits__view-field field d-flex mt-3">
                                <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__off.png" alt="Кредитная история<"></div>
                                <div class="field__content">
                                    <div class="field__content-title">Кредитная история</div>
                                    <div class="field__content-num">
                                        <?php $card_period = get_field('z_history', $ID);
                                        echo $card_period; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="credits__view-field field d-flex mt-3">
                                <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__cashback.png" alt="Срок займа"></div>
                                <div class="field__content">
                                    <div class="field__content-title">Срок займа</div>
                                    <div class="field__content-num">до <?php echo the_field('z_time', $ID) ?> дней
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="credits__view-field field d-flex mt-3">
                                <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__decision.png" alt="Решение"></div>
                                <div class="field__content">
                                    <div class="field__content-title">Решение</div>
                                    <div class="field__content-num"><?php echo the_field('z_answer', $ID) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-4 order-md-2">
                    <div class="credits__view-img">
                        <img src="<?php echo the_field('card_logo', $ID) ?>" alt="<?php echo the_title() ?>">
                        <div class="credits__view-buttons d-flex justify-content-center py-3 py-sm-4">
                            <?php //if(get_field('card_bank_link', $ID)):
                            ?>
                            <?php if (reclink($ID)): ?>
                                <a href="<?php echo the_field('card_bank_link', $ID) ?>" target="_blank" class="btn btn-primary mx-3"
                                    onclick="<?php get_metrika_for_detail_page(get_field('card_bank_link', $ID)) ?> return true;">Оформить сейчас</a>
                            <?php else: ?>
                                <a href="#" class="btn btn-primary mx-3 <?php if ($apply_now) { ?> apply_now_btm <?php } else { ?>out_exit_link<?php } ?>"
                                    onclick="<?php get_metrika_for_detail_page(get_field('card_bank_link', $ID)) ?> return false;">Оформить сейчас</a>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>

                <?php $date_actually = get_the_modified_date('d.m.Y', $ID); ?>
                <?php if ($date_actually): ?>

                    <div class="date_actually date_actually-single-kredity">Обновлено1: <?php $date_actually ?></div>

                <?php endif; ?>

            </div>
        </div>
        <!-- / card info -->

        <!-- similar -->
        <?php
        $featured_posts = get_field('related_products', $ID);

        if ($featured_posts): ?>
            <?php // get_template_part('all_template/similar_list', null, ['TITLE' => 'Похожие займы', 'DATA' => $featured_posts]); 
            ?>
        <?php endif; ?>
    </div>
    <!-- / page head -->

    <div class="page__wrapper">
        <!-- content -->
        <div class="container">
            <div class="row section">
                <!-- sidebar -->
                <div class="col-12 col-md-3 col-lg-4 order-md-2">
                    <div class="sticky-top sticky-top-withnav top mb-5 mb-md-0">
                        <div class="sidebar sidebar-nav mb-4 p-4 order-md-2">
                            <div class="forline">
                                <ul class="sidebar__menu">
                                    <li><a href="#content-about" class="item-about active">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 17H16M11.0177 2.764L4.23539 8.03912C3.78202 8.39175 3.55534 8.56806 3.39203 8.78886C3.24737 8.98444 3.1396 9.20478 3.07403 9.43905C3 9.70352 3 9.9907 3 10.5651V17.8C3 18.9201 3 19.4801 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4801 21 18.9201 21 17.8V10.5651C21 9.9907 21 9.70352 20.926 9.43905C20.8604 9.20478 20.7526 8.98444 20.608 8.78886C20.4447 8.56806 20.218 8.39175 19.7646 8.03913L12.9823 2.764C12.631 2.49075 12.4553 2.35412 12.2613 2.3016C12.0902 2.25526 11.9098 2.25526 11.7387 2.3016C11.5447 2.35412 11.369 2.49075 11.0177 2.764Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            Об МФО</a>
                                    </li>
                                    <li>

                                        <a href="<?= esc_url($current_url); ?>goryachaya-liniya/"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.38028 8.85323C9.07627 10.3028 10.0251 11.6615 11.2266 12.8631C12.4282 14.0646 13.7869 15.0134 15.2365 15.7094C15.3612 15.7693 15.4235 15.7992 15.5024 15.8222C15.7828 15.904 16.127 15.8453 16.3644 15.6752C16.4313 15.6274 16.4884 15.5702 16.6027 15.4559C16.9523 15.1063 17.1271 14.9315 17.3029 14.8172C17.9658 14.3862 18.8204 14.3862 19.4833 14.8172C19.6591 14.9315 19.8339 15.1063 20.1835 15.4559L20.3783 15.6508C20.9098 16.1822 21.1755 16.448 21.3198 16.7333C21.6069 17.3009 21.6069 17.9712 21.3198 18.5387C21.1755 18.8241 20.9098 19.0898 20.3783 19.6213L20.2207 19.7789C19.6911 20.3085 19.4263 20.5733 19.0662 20.7756C18.6667 21 18.0462 21.1614 17.588 21.16C17.1751 21.1588 16.8928 21.0787 16.3284 20.9185C13.295 20.0575 10.4326 18.433 8.04466 16.045C5.65668 13.6571 4.03221 10.7947 3.17124 7.76131C3.01103 7.19687 2.93092 6.91464 2.9297 6.5017C2.92833 6.04347 3.08969 5.42298 3.31411 5.02348C3.51636 4.66345 3.78117 4.39863 4.3108 3.86901L4.46843 3.71138C4.99987 3.17993 5.2656 2.91421 5.55098 2.76987C6.11854 2.4828 6.7888 2.4828 7.35636 2.76987C7.64174 2.91421 7.90747 3.17993 8.43891 3.71138L8.63378 3.90625C8.98338 4.25585 9.15819 4.43065 9.27247 4.60643C9.70347 5.26932 9.70347 6.1239 9.27247 6.78679C9.15819 6.96257 8.98338 7.13738 8.63378 7.48698C8.51947 7.60129 8.46231 7.65845 8.41447 7.72526C8.24446 7.96269 8.18576 8.30695 8.26748 8.5873C8.29048 8.6662 8.32041 8.72854 8.38028 8.85323Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Горячая линия</a>
                                    </li>
                                    <?php
                                    $current_page_id = get_the_ID();
                                    $children = get_children(array(
                                        'post_parent' => $current_page_id,
                                        'post_type'   => 'zaimy',
                                        'name'        => 'lichnyy-kabinet',
                                        'numberposts' => 1
                                    ));

                                    if (!empty($children)) :
                                        // Получаем первый (и единственный) дочерний объект
                                        $child = array_shift($children);
                                    ?>
                                        <li>
                                            <a href="<?= esc_url(get_permalink($child)); ?>" class="item-lk">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 20C5.33579 17.5226 8.50702 16 12 16C15.493 16 18.6642 17.5226 21 20M16.5 7.5C16.5 9.98528 14.4853 12 12 12C9.51472 12 7.5 9.98528 7.5 7.5C7.5 5.01472 9.51472 3 12 3C14.4853 3 16.5 5.01472 16.5 7.5Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                Личный кабинет
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <li>
                                        <a href="#faq"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.09 9C9.3251 8.33167 9.78915 7.76811 10.4 7.40913C11.0108 7.05016 11.7289 6.91894 12.4272 7.03871C13.1255 7.15849 13.7588 7.52152 14.2151 8.06353C14.6713 8.60553 14.9211 9.29152 14.92 10C14.92 12 11.92 13 11.92 13M12 17H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Вопросы</a>
                                    </li>
                                    <li>
                                        <a href="#comments"> <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 8.5H12M7 12H15M9.68375 18H16.2C17.8802 18 18.7202 18 19.362 17.673C19.9265 17.3854 20.3854 16.9265 20.673 16.362C21 15.7202 21 14.8802 21 13.2V7.8C21 6.11984 21 5.27976 20.673 4.63803C20.3854 4.07354 19.9265 3.6146 19.362 3.32698C18.7202 3 17.8802 3 16.2 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V20.3355C3 20.8684 3 21.1348 3.10923 21.2716C3.20422 21.3906 3.34827 21.4599 3.50054 21.4597C3.67563 21.4595 3.88367 21.2931 4.29976 20.9602L6.68521 19.0518C7.17252 18.662 7.41617 18.4671 7.68749 18.3285C7.9282 18.2055 8.18443 18.1156 8.44921 18.0613C8.74767 18 9.0597 18 9.68375 18Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Отзывы</a>
                                    </li>
                                    <li>
                                        <a href="<?= esc_url($current_url); ?>kontakty/" class="item-contacts"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 2.26946V6.4C14 6.96005 14 7.24008 14.109 7.45399C14.2049 7.64215 14.3578 7.79513 14.546 7.89101C14.7599 8 15.0399 8 15.6 8H19.7305M20 9.98822V17.2C20 18.8802 20 19.7202 19.673 20.362C19.3854 20.9265 18.9265 21.3854 18.362 21.673C17.7202 22 16.8802 22 15.2 22H8.8C7.11984 22 6.27976 22 5.63803 21.673C5.07354 21.3854 4.6146 20.9265 4.32698 20.362C4 19.7202 4 18.8802 4 17.2V6.8C4 5.11984 4 4.27976 4.32698 3.63803C4.6146 3.07354 5.07354 2.6146 5.63803 2.32698C6.27976 2 7.11984 2 8.8 2H12.0118C12.7455 2 13.1124 2 13.4577 2.08289C13.7638 2.15638 14.0564 2.27759 14.3249 2.44208C14.6276 2.6276 14.887 2.88703 15.4059 3.40589L18.5941 6.59411C19.113 7.11297 19.3724 7.3724 19.5579 7.67515C19.7224 7.94356 19.8436 8.2362 19.9171 8.5423C20 8.88757 20 9.25445 20 9.98822Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Контакты</a>
                                    </li>
                                    <li>
                                        <a href="<?= esc_url($current_url); ?>promokody-skidki/" class="item-promo"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 8V7M8 12.5V11.5M8 17V16M6.8 20H17.2C18.8802 20 19.7202 20 20.362 19.673C20.9265 19.3854 21.3854 18.9265 21.673 18.362C22 17.7202 22 16.8802 22 15.2V8.8C22 7.11984 22 6.27976 21.673 5.63803C21.3854 5.07354 20.9265 4.6146 20.362 4.32698C19.7202 4 18.8802 4 17.2 4H6.8C5.11984 4 4.27976 4 3.63803 4.32698C3.07354 4.6146 2.6146 5.07354 2.32698 5.63803C2 6.27976 2 7.11984 2 8.8V15.2C2 16.8802 2 17.7202 2.32698 18.362C2.6146 18.9265 3.07354 19.3854 3.63803 19.673C4.27976 20 5.11984 20 6.8 20Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Промокоды, скидки</a>
                                    </li>
                                    <!-- <li>
                                        <a href="/blog/"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 9.25H15M21 4H3M21 14.75H15M21 20H3M4.6 16H9.4C9.96005 16 10.2401 16 10.454 15.891C10.6422 15.7951 10.7951 15.6422 10.891 15.454C11 15.2401 11 14.9601 11 14.4V9.6C11 9.03995 11 8.75992 10.891 8.54601C10.7951 8.35785 10.6422 8.20487 10.454 8.10899C10.2401 8 9.96005 8 9.4 8H4.6C4.03995 8 3.75992 8 3.54601 8.10899C3.35785 8.20487 3.20487 8.35785 3.10899 8.54601C3 8.75992 3 9.03995 3 9.6V14.4C3 14.9601 3 15.2401 3.10899 15.454C3.20487 15.6422 3.35785 15.7951 3.54601 15.891C3.75992 16 4.03995 16 4.6 16Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Новости и статьи</a>
                                    </li> -->
                                    <li>
                                        <a href="#best-offers"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 17C8.41015 17 5.5 14.0899 5.5 10.5V4.55556C5.5 4.03739 5.5 3.77831 5.59369 3.57738C5.69305 3.36431 5.86431 3.19305 6.07738 3.09369C6.27831 3 6.53739 3 7.05556 3H16.9444C17.4626 3 17.7217 3 17.9226 3.09369C18.1357 3.19305 18.3069 3.36431 18.4063 3.57738C18.5 3.77831 18.5 4.03739 18.5 4.55556V10.5C18.5 14.0899 15.5899 17 12 17ZM12 17V21M17 21H7M22 5V10M2 5V10" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Лучшие предложения</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="sidebar mb-4">
                            <div class="sidebar__header sidebar__section p-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bank__item-img mr-3">
                                        <img src="<?php echo the_field('z_organization_logo', $ID) ?>"
                                            alt="<?
                                                    $logo_id = get_field('z_organization_logo', $ID, false);
                                                    $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                    echo $logo_alt;
                                                    ?>">
                                    </div>
                                    <div class="bank__item-content">
                                        <div class="card__header-title  mt-1 mb-2"><?php echo the_field('z_organization_name') ?></div>
                                        <div class="card__header-info d-flex align-items-center">
                                            <div class="card__rating d-flex align-items-center mr-3">
                                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                    </svg></div>
                                                <?php echo the_field('ratings_average'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 sidebar__container">
                                        <div class="sidebar__field mb-3">
                                            <div class="sidebar__field-title">Организация</div>
                                            <div class="sidebar__field-content"><?php echo the_field('z_organization_name') ?></div>
                                        </div>
                                        <?php if (get_field('z_organization_phone')): ?>
                                            <div class="sidebar__field mb-3">
                                                <div class="sidebar__field-title">Телефон</div>
                                                <div class="sidebar__field-content">
                                                    <?php
                                                    // Получаем значение телефона
                                                    $phone = get_field('z_organization_phone');
                                                    // Удаляем все символы, кроме цифр
                                                    $cleaned_phone = preg_replace('![^0-9]+!', '', $phone);
                                                    ?>
                                                    <a href="tel:<?php echo esc_attr($cleaned_phone); ?>">
                                                        <?php echo esc_html($phone); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>


                                        <div class="sidebar__field mb-3">
                                            <div class="sidebar__field-title">Официальный сайт</div>
                                            <div class="sidebar__field-content">


                                                <?php if (reclink($ID)): ?>
                                                    <a href="<?php echo esc_url(get_field('card_bank_link', $ID)); ?>"
                                                        target="_blank"
                                                        onclick="<?php echo esc_js(get_metrika_for_detail_page(get_field('card_bank_link', $ID))); ?> return true;"
                                                        class="off_site_link">
                                                        <?php echo esc_html(get_field('z_organization_site', $ID)); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="#"
                                                        class="off_site_link <?php echo ($apply_now) ? 'apply_now_btm' : 'out_exit_link'; ?>"
                                                        onclick="<?php echo esc_js(get_metrika_for_detail_page(get_field('card_bank_link', $ID))); ?> return true;">
                                                        <?php echo esc_html(get_field('z_organization_site', $ID)); ?>
                                                    </a>
                                                <?php endif; ?>





                                            </div>
                                        </div>

                                        <?php if (get_field('z_organization_email')): ?>
                                            <div class="sidebar__field mb-3">
                                                <div class="sidebar__field-title">Электронная почта</div>
                                                <div class="sidebar__field-content">
                                                    <?php
                                                    // Получаем значение электронной почты
                                                    $email = get_field('z_organization_email');
                                                    ?>
                                                    <a href="mailto:<?php echo esc_attr($email); ?>">
                                                        <?php echo esc_html($email); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php $date_actually = get_the_modified_date('d.m.Y', $ID); ?>
                                        <?php if ($date_actually): ?>

                                            <div class=" text-left date_actually">Обновлено: <?= $date_actually ?></div>

                                        <?php endif; ?>


                                        <div class="wm-fixed-button sidebar__field mb-3">
                                            <?php //if(get_field('card_bank_link', $ID)):
                                            ?>
                                            <?php if (reclink($ID)): ?>
                                                <a href="<?php echo the_field('card_bank_link', $ID) ?>" target="_blank"
                                                    onclick="<?php get_metrika_for_detail_page(get_field('card_bank_link', $ID)) ?> return true;"
                                                    class="btn btn-primary">Оформить сейчас</a>
                                            <?php else: ?>
                                                <a href="#" class="btn btn-primary <?php if ($apply_now) { ?> apply_now_btm <?php } else { ?>out_exit_link<?php } ?>"
                                                    onclick="<?php get_metrika_for_detail_page(get_field('card_bank_link', $ID)) ?> return true;">
                                                    Оформить сейчас</a>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $block_about_bank = get_field('block_about_bank', $ID); ?>

                            <?php if ($block_about_bank): ?>
                                <div class="sidebar__section h3 text-center py-3">
                                    <?php echo esc_html(get_field_object('block_about_bank', $ID)['label']); ?>
                                </div>
                                <div style="padding-top: 0 !important;" class="sidebar__links px-4 py-3">

                                    <?php
                                    // Основные параметры для запроса
                                    $main_args = array(
                                        'post_type'      => array('bankcard', 'kredity'),
                                        'posts_per_page' => -1,
                                        'meta_key'       => 'ratings_average',
                                        'orderby'        => 'meta_value_num',
                                        'order'          => 'DESC',
                                        'post_status'    => 'publish',
                                        'meta_query'     => array(
                                            'relation' => 'OR',
                                            array(
                                                'key'     => 'bank_choise',
                                                'value'   => $bank_id,
                                                'compare' => 'LIKE',
                                            ),
                                            array(
                                                'key'     => 'product_bank',
                                                'value'   => $bank_id,
                                                'compare' => 'LIKE',
                                            ),
                                        ),
                                    );

                                    // Кредитные карты
                                    $custom_args = array(
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'bankcards',
                                                'field'    => 'slug',
                                                'terms'    => 'creditcard',
                                            ),
                                        ),
                                    );

                                    // Дебетовые карты
                                    $custom_args2 = array(
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'bankcards',
                                                'field'    => 'slug',
                                                'terms'    => 'debetcard',
                                            ),
                                        ),
                                    );

                                    // Объединение параметров
                                    $args = array_merge($main_args, $custom_args);
                                    $args2 = array_merge($main_args, $custom_args2);

                                    // Запросы
                                    $count_cred = count(get_posts($args));
                                    $count_debet = count(get_posts($args2));
                                    ?>

                                    <?php foreach ($block_about_bank as $item): ?>
                                        <?php if ($item['name'] == 'Кредитные карты'): ?>
                                            <a href="<?php echo esc_url($item['value']); ?>" class="sidebar__links-item">
                                                <?php echo esc_html($item['name']); ?> (<?php echo esc_html($count_cred); ?>)
                                            </a>
                                        <?php elseif ($item['name'] == 'Дебетовые карты'): ?>
                                            <a href="<?php echo esc_url($item['value']); ?>" class="sidebar__links-item">
                                                <?php echo esc_html($item['name']); ?> (<?php echo esc_html($count_debet); ?>)
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo esc_url($item['value']); ?>" class="sidebar__links-item">
                                                <?php echo esc_html($item['name']); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </div>
                            <?php endif; ?>

                        </div>
                        <div class="article__news mb-5 p-4">
                            <h3 class="article__news-title article__container-title mb-3">Статьи о займах</h3>
                            <?php
                            $args = array(
                                'posts_per_page' => 5,
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'orderby' => 'rand',
                                //'meta_key' => 'views',
                                'cat' => 38,
                                //'orderby' => 'meta_value_num',
                                //'order' => 'DESC',
                            );
                            $wp_query = new WP_Query($args);
                            if ($wp_query->have_posts()) {
                                while ($wp_query->have_posts()) {
                                    $wp_query->the_post(); ?>
                                    <div class="article__news-item">
                                        <?php $image = get_the_post_thumbnail_url(); ?>
                                        <?php if ($image != ''): ?>
                                            <div class="article__news-img">
                                                <img style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="<?php echo the_post_thumbnail_url() ?>"
                                                    alt="<?php get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="article__news-body">
                                            <a class="stretched-link" href="<?php echo the_permalink() ?>"><span><?php echo the_title() ?></span></a>
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
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } ?>
                            <?php wp_reset_query() ?>
                        </div>
                    </div>
                </div>
                <!-- / sidebar -->
                <!-- page content -->

                <div id="content-about" class="content-block content-about col-12 col-md-9 col-lg-8 order-md-1 active">
                    <!-- about -->
                    <?php if (have_rows('product_about_tabs', $ID)):
                        $counter_about = 0; ?>
                        <div id="about" class="section">
                            <div class="info-about-zaim p-4 mb-4">
                                <div class="section__header d-flex justify-content-between align-items-center">
                                    <h2 class="title mb-4">Информация о компании <?php echo the_title() ?></h2>
                                </div>
                                <div class="wysiwyg pb-4">
                                    <?php echo the_field('product_text_desc', $ID) ?>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>
                    <!-- / about -->

                    <!-- tariffs-cards  -->
                    <?php if (have_rows('tarifs_new', $ID)): ?>
                        <div class="section">
                            <div class="section__header d-flex justify-content-between align-items-center">
                                <h2 class="title mb-4">Актуальные предложения</h2>
                            </div>
                            <div class="tariffs-cards">
                                <?php while (have_rows('tarifs_new', $ID)): the_row();
                                    $title = get_sub_field('title');
                                    $summa = get_sub_field('summa');
                                    $time = get_sub_field('time');
                                    $psk = get_sub_field('psk');
                                    $text = get_sub_field('text');
                                ?>
                                    <div class="item p-4">
                                        <div class="head">
                                            <img src="<?php echo the_field('z_organization_logo', $ID) ?>"
                                                alt="<?
                                                        $logo_id = get_field('z_organization_logo', $ID, false);
                                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                        echo $logo_alt;
                                                        ?>">
                                            <div class="">
                                                <?php echo the_title() ?>
                                                <span><?php echo $title ?></span>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <div class="info-item">
                                                <div class="info-title">Сумма</div>
                                                <div class="info-text"> <?php echo $summa ?></div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-title">Срок</div>
                                                <div class="info-text"> <?php echo $time ?></div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-title">ПСК</div>
                                                <div class="info-text"> <?php echo $psk ?></div>
                                            </div>

                                        </div>

                                        <?php if (reclink($ID)): ?>
                                            <a href="<?php echo the_field('card_bank_link', $ID) ?>" target="_blank" class="btn btn-primary "
                                                onclick="<?php get_metrika_for_detail_page(get_field('card_bank_link', $ID)) ?> return true;">Перейти на сайт</a>
                                        <?php else: ?>
                                            <a href="#" class="btn btn-primary  <?php if ($apply_now) { ?> apply_now_btm <?php } else { ?>out_exit_link<?php } ?>"
                                                onclick="<?php get_metrika_for_detail_page(get_field('card_bank_link', $ID)) ?> return false;">Перейти на сайт</a>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- / tariffs-cards  -->

                    <!-- terms -->
                    <?php if (have_rows('product_tar_0', $ID)): ?>
                        <div id="tariffs" class="section">
                            <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                                <h2 class="title mb-0">Условия оформления займа в <?php echo the_title() ?></h2>
                            </div>
                            <div class="tariffs__list">
                                <div class="forline">
                                    <div class="tariffs__list-menu">
                                        <ul>
                                            <li class="active">Условия</li>
                                            <li>Требования</li>
                                            <li>Выдача и погашение</li>
                                            <li>Контакты</li>
                                            <li>Документы</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item active">
                                    <?php while (have_rows('product_tar_0', $ID)): the_row();
                                        $title = get_sub_field('title');
                                        $text = get_sub_field('text');
                                    ?>
                                        <div class="tariffs__list-item">
                                            <div class="row">
                                                <div class="tariffs__list-title col-4"><?php echo $title ?></div>
                                                <div class="tariffs__list-description col-8"><?php echo $text ?></div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <div class="item">
                                    <?php while (have_rows('product_tar_2', $ID)): the_row();
                                        $title = get_sub_field('title');
                                        $text = get_sub_field('text');
                                    ?>
                                        <div class="tariffs__list-item">
                                            <div class="row">
                                                <div class="tariffs__list-title col-4"><?php echo $title ?></div>
                                                <div class="tariffs__list-description col-8"><?php echo $text ?></div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <div class="item">
                                    <?php while (have_rows('product_tar_3', $ID)): the_row();
                                        $title = get_sub_field('title');
                                        $text = get_sub_field('text');
                                    ?>
                                        <div class="tariffs__list-item">
                                            <div class="row">
                                                <div class="tariffs__list-title col-4"><?php echo $title ?></div>
                                                <div class="tariffs__list-description col-8"><?php echo $text ?></div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <div class="item">
                                    <?php while (have_rows('product_tar_4', $ID)): the_row();
                                        $title = get_sub_field('title');
                                        $text = get_sub_field('text');
                                    ?>
                                        <div class="tariffs__list-item">
                                            <div class="row">
                                                <div class="tariffs__list-title col-4"><?php echo $title ?></div>
                                                <div class="tariffs__list-description col-8"><?php echo $text ?></div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <div class="item">
                                    <?php while (have_rows('product_tar_5', $ID)): the_row();
                                        $title = get_sub_field('title');
                                        $file = get_sub_field('file');
                                    ?>
                                        <div class="tariffs__list-item files">
                                            <div class="row">

                                                <a target="_blank" href="<?php echo $file ?>" class="tariffs__list-title col-12">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M21 15V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V15M17 10L12 15M12 15L7 10M12 15V3" stroke="#14B8AD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <?php echo $title ?></a>

                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Выбираем основной контейнер
                                    const tariffsList = document.querySelector('.tariffs__list');
                                    if (!tariffsList) return; // Выход, если контейнер не найден

                                    // Выбираем все пункты меню
                                    const menuItems = tariffsList.querySelectorAll('.tariffs__list-menu ul li');

                                    // Выбираем все блоки item
                                    const itemBlocks = tariffsList.querySelectorAll('.item');

                                    // Проверяем, что количество пунктов меню соответствует количеству блоков item
                                    if (menuItems.length !== itemBlocks.length) {
                                        console.warn('Количество пунктов меню и блоков item не совпадает.');
                                    }

                                    // Добавляем обработчик события клика для каждого пункта меню
                                    menuItems.forEach(function(menuItem, index) {
                                        menuItem.addEventListener('click', function() {
                                            // Удаляем класс 'active' у всех пунктов меню
                                            menuItems.forEach(function(item) {
                                                item.classList.remove('active');
                                            });

                                            // Добавляем класс 'active' к кликнутому пункту меню
                                            menuItem.classList.add('active');

                                            // Удаляем класс 'active' у всех блоков item
                                            itemBlocks.forEach(function(block) {
                                                block.classList.remove('active');
                                            });

                                            // Добавляем класс 'active' к соответствующему блоку item
                                            if (itemBlocks[index]) {
                                                itemBlocks[index].classList.add('active');
                                            } else {
                                                console.warn(`Блок item с индексом ${index} не найден.`);
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                    <?php endif; ?>
                    <!-- / terms -->

                    <!-- banner-how -->
                    <div class="section">
                        <div class="how">
                            <div class="how__row">
                                <h3>Как оформить займ
                                    в Займере?</h3>
                                <img src="<?php bloginfo('template_url'); ?>/img/how-img.svg" alt="">
                                <a id="additional-button" href="<?= esc_url(get_permalink($child)); ?>" class="btn btn-primary">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <!-- / banner-how -->

                    <!-- information -->
                    <?php if (have_rows('product_about_tabs', $ID)): ?>
                        <div id="method" class="section">
                            <div class="information p-4">
                                <?php while (have_rows('product_about_tabs', $ID)): the_row();
                                    $title = get_sub_field('title');
                                    $text = get_sub_field('text');

                                ?>

                                    <div class="wysiwyg pb-4">
                                        <h2><?php echo $title ?></h2>
                                        <?php echo $text ?>
                                    </div>

                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- information -->

                    <!-- tariffs-rows  -->
                    <?php if (have_rows('tarifs_new', $ID)): ?>
                        <div class="section">
                            <div class="section__header d-flex justify-content-between align-items-center">
                                <h2 class="title mb-4">Тарифы <?php echo the_title() ?></h2>
                            </div>

                            <div class="tariffs-rows">
                                <?php while (have_rows('tarifs_new', $ID)): the_row();
                                    $title = get_sub_field('title');
                                    $summa = get_sub_field('summa');
                                    $time = get_sub_field('time');
                                    $psk = get_sub_field('psk');
                                    $text = get_sub_field('text');
                                ?>
                                    <div class="item p-4">
                                        <div class="head">
                                            <div class="organization">
                                                <img src="<?php echo the_field('z_organization_logo', $ID) ?>"
                                                    alt="<?
                                                            $logo_id = get_field('z_organization_logo', $ID, false);
                                                            $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                            echo $logo_alt;
                                                            ?>">

                                                <span><?php echo $title ?></span>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-title">Сумма</div>
                                                <div class="info-text"> <?php echo $summa ?></div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-title">Срок</div>
                                                <div class="info-text"> <?php echo $time ?></div>
                                            </div>


                                            <?php if (reclink($ID)): ?>
                                                <a href="<?php echo the_field('card_bank_link', $ID) ?>" target="_blank" class="btn btn-primary "
                                                    onclick="<?php get_metrika_for_detail_page(get_field('card_bank_link', $ID)) ?> return true;">Подробнее</a>
                                            <?php else: ?>
                                                <a href="#" class="btn btn-primary  <?php if ($apply_now) { ?> apply_now_btm <?php } else { ?>out_exit_link<?php } ?>"
                                                    onclick="<?php get_metrika_for_detail_page(get_field('card_bank_link', $ID)) ?> return false;">Подробнее</a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="info">
                                            <?php echo $text ?>


                                        </div>

                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- / tariffs-rows  -->

                    <!-- plus-minus -->
                    <?php if (have_rows('product_plus_minus', $ID)): ?>
                        <div class="section plus-minus">
                            <div class="section__header d-flex justify-content-between align-items-center">
                                <h2 class="title mb-4">Плюсы и Минусы оформления займа в <?php echo the_title() ?></h2>
                            </div>
                            <div class="plus-minus__wrapper p-4">
                                <div class="plus-minus__row headers">
                                    <div class="plus-minus__column-header">Плюсы</div>
                                    <div class="plus-minus__column-header">Минусы</div>
                                </div>
                                <div class="plus-minus__items">
                                    <?php while (have_rows('product_plus_minus', $ID)): the_row();
                                        $plus = get_sub_field('plus');
                                        $minus = get_sub_field('minus');
                                    ?>
                                        <div class="plus-minus__row">
                                            <div class="plus-minus__item plus">
                                                <?php if (!empty($plus)): ?>
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_4843_6537)">
                                                            <path d="M8.0026 5.33337V10.6667M5.33594 8.00004H10.6693M14.6693 8.00004C14.6693 11.6819 11.6845 14.6667 8.0026 14.6667C4.32071 14.6667 1.33594 11.6819 1.33594 8.00004C1.33594 4.31814 4.32071 1.33337 8.0026 1.33337C11.6845 1.33337 14.6693 4.31814 14.6693 8.00004Z" stroke="#14B8AD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_4843_6537">
                                                                <rect width="16" height="16" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                <?php endif; ?>
                                                <?php echo $plus ?>
                                            </div>
                                            <div class="plus-minus__item minus">
                                                <?php if (!empty($minus)): ?>
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_4843_6540)">
                                                            <path d="M5.33594 8.00004H10.6693M14.6693 8.00004C14.6693 11.6819 11.6845 14.6667 8.0026 14.6667C4.32071 14.6667 1.33594 11.6819 1.33594 8.00004C1.33594 4.31814 4.32071 1.33337 8.0026 1.33337C11.6845 1.33337 14.6693 4.31814 14.6693 8.00004Z" stroke="#EF3124" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_4843_6540">
                                                                <rect width="16" height="16" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                <?php endif; ?>
                                                <?php echo $minus ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>


                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- / plus-minus -->

                    <!-- client rating -->
                    <?php if (have_rows('ratings_list', $ID)): ?>
                        <div class="section">
                            <div class="section__header d-flex justify-content-between align-items-center">
                                <h2 class="title mb-4">Клиентский рейтинг</h2>
                            </div>
                            <div class="rating-rows client-rating p-4" data-post-id="<?php echo get_the_ID(); ?>">
                                <?php
                                // Основной рейтинговый блок
                                if (have_rows('ratings_list')) :
                                    $index = 0; // Для уникальной идентификации каждой строки Repeater
                                    while (have_rows('ratings_list')) : the_row();
                                        $title = get_sub_field('title');
                                        $rating_total = get_sub_field('rating_total');
                                        $rating_count = get_sub_field('rating_count');

                                        // Вычисляем средний рейтинг
                                        if ($rating_total && $rating_count) {
                                            $average_rating = $rating_total / $rating_count;
                                            $average_rating = round($average_rating, 1); // Округляем до одного знака после запятой
                                        } else {
                                            $average_rating = 0;
                                        }

                                        if ($title || $average_rating > 0) :
                                            echo '<div class="rating-item" data-rating-index="' . $index . '" data-rating-block="ratings_list">';
                                            if ($title) {
                                                echo '<div class="rating-title">' . esc_html($title) . '</div>';
                                            }

                                            if ($average_rating > 0) {
                                                display_star_rating($average_rating);
                                            } else {
                                                echo '<div class="stars">';
                                                for ($i = 1; $i <= 5; $i++) {
                                                    echo '<span class="star" data-value="' . $i . '">☆</span>';
                                                }
                                                echo '</div>';
                                            }
                                            // Добавляем элемент для отображения числового рейтинга
                                            echo '<span class="average-rating">' . ($average_rating > 0 ? $average_rating : '0') . '</span>';

                                            echo '</div>';
                                        endif;

                                        $index++;
                                    endwhile;
                                else :
                                    echo '<p>Нет рейтингов для отображения.</p>';
                                endif;

                                ?>
                            </div>


                        </div>
                    <?php endif; ?>
                    <!-- / client rating -->

                    <!-- FAQ accordion -->
                    <?php if (have_rows('product_faq', $ID)): ?>
                        <div id="faq" class="section">
                            <div class="section__header d-flex justify-content-between align-items-center">
                                <h2 class="title mb-4">Часто задавемые вопросы</h2>
                            </div>

                            <div class="accordion mb-4" id="accordion">
                                <?php while (have_rows('product_faq', $ID)): the_row();
                                    $question = get_sub_field('question');
                                    $answer = get_sub_field('answer');
                                    $counter_about += 1;
                                ?>

                                    <div class="accordion__item">
                                        <div class="accordion__header">
                                            <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse__item-<?php echo $counter_about ?>" aria-expanded="false">
                                                <?php echo $question ?>
                                                <div class="accordion__button-icon"><svg width="12" height="6" viewBox="0 0 12 6">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use>
                                                    </svg></div>
                                            </button>
                                        </div>
                                        <div id="collapse__item-<?php echo $counter_about ?>" class="accordion__collapse collapse" data-bs-parent="#accordion">
                                            <div class="accordion__body wysiwyg">
                                                <p><?php echo $answer ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- / FAQ accordion -->

                    <div class="section">
                        <div class="quiz-calc">
                            <div class="h3 m-0 p-3 px-md-4 py-md-3">Калькулятор процентов</div>
                            <div class="forline px-md-4">
                                <div class="tariffs__list-menu">
                                    <ul>
                                        <li class="active" data-target="calc">Проценты</li>
                                        <li data-target="quiz">Сколько одобрят</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Блок калькулятора -->
                            <div class="calc active" id="calc" data-type="creditCalc">
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
                                                    <input type="text" class="range__value form-control calc__input" value="1000000" min="0" max="10000000" data-field="limit">
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

                            <!-- Блок квиза -->
                            <div class="quiz" id="quiz">
                                <!-- Индикатор прогресса -->
                                <div class="progress-container">
                                    <div class="progress-text">
                                        Вопрос <span id="currentStep">1</span> из <span id="totalSteps">19</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-filled" id="progressFilled"></div>
                                    </div>
                                </div>


                                <form id="quizForm">
                                    <!-- ВОПРОС 1 -->
                                    <div class="quiz-question active" data-question="1">
                                        <p><strong>1. Сколько Вам лет?</strong></p>
                                        <input type="radio" id="age1" name="age" value="1" required>
                                        <label for="age1">18-22</label><br>

                                        <input type="radio" id="age2" name="age" value="2">
                                        <label for="age2">23-27</label><br>

                                        <input type="radio" id="age3" name="age" value="3">
                                        <label for="age3">28-35</label><br>

                                        <input type="radio" id="age4" name="age" value="4">
                                        <label for="age4">36-45</label><br>

                                        <input type="radio" id="age5" name="age" value="5">
                                        <label for="age5">46-60</label><br>

                                        <input type="radio" id="age6" name="age" value="6">
                                        <label for="age6">Более 60</label><br>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 2 -->
                                    <div class="quiz-question" data-question="2">
                                        <p><strong>2. Ваш пол?</strong></p>
                                        <input type="radio" id="genderMale" name="gender" value="male" required>
                                        <label for="genderMale">Мужчина</label><br>

                                        <input type="radio" id="genderFemale" name="gender" value="female">
                                        <label for="genderFemale">Женщина</label><br>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 3 -->
                                    <div class="quiz-question" data-question="3">
                                        <p><strong>3. Семейное положение?</strong></p>
                                        <input type="radio" id="maritalMarried" name="maritalStatus" value="married" required>
                                        <label for="maritalMarried">Женат/Замужем</label><br>

                                        <input type="radio" id="maritalSingle" name="maritalStatus" value="single">
                                        <label for="maritalSingle">Холост/Не замужем</label><br>

                                        <input type="radio" id="maritalCivilUnion" name="maritalStatus" value="civilUnion">
                                        <label for="maritalCivilUnion">Гражданский брак</label><br>

                                        <input type="radio" id="maritalDivorced" name="maritalStatus" value="divorced">
                                        <label for="maritalDivorced">В разводе</label><br>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 4 -->
                                    <div class="quiz-question" data-question="4">
                                        <p><strong>4. У вас есть гражданство РФ?</strong></p>
                                        <input type="radio" id="citizenshipYes" name="citizenship" value="yes" required>
                                        <label for="citizenshipYes">Да</label><br>

                                        <input type="radio" id="citizenshipNo" name="citizenship" value="no">
                                        <label for="citizenshipNo">Нет</label><br>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 5 -->
                                    <div class="quiz-question" data-question="5">
                                        <p><strong>5. Где вы проживаете?</strong></p>
                                        <input type="radio" id="residenceOwn" name="residence" value="own" required>
                                        <label for="residenceOwn">Собственное жилье</label><br>

                                        <input type="radio" id="residenceRental" name="residence" value="rental">
                                        <label for="residenceRental">Съемное жилье</label><br>

                                        <input type="radio" id="residenceDormitory" name="residence" value="dormitory">
                                        <label for="residenceDormitory">Общежитие</label><br>

                                        <input type="radio" id="residenceRelatives" name="residence" value="relatives">
                                        <label for="residenceRelatives">Жилье родственников</label><br>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 6: Доход + доп. доход -->
                                    <div class="quiz-question" data-question="6">
                                        <p><strong>6. Ваш доход в месяц?</strong></p>
                                        <input type="radio" id="income1" name="income" value="1" required>
                                        <label for="income1">Менее 10 000</label><br>

                                        <input type="radio" id="income2" name="income" value="2">
                                        <label for="income2">10-20 000</label><br>

                                        <input type="radio" id="income3" name="income" value="3">
                                        <label for="income3">20-30 000</label><br>

                                        <input type="radio" id="income4" name="income" value="4">
                                        <label for="income4">30-40 000</label><br>

                                        <input type="radio" id="income5" name="income" value="5">
                                        <label for="income5">40-60 000</label><br>

                                        <input type="radio" id="income6" name="income" value="6">
                                        <label for="income6">Более 60 000</label><br>

                                        <hr />

                                        <p><strong>Есть ли у Вас дополнительный доход?</strong></p>
                                        <input type="radio" id="additionalIncomeYes" name="additionalIncome" value="yes" required>
                                        <label for="additionalIncomeYes">Да</label><br>

                                        <input type="radio" id="additionalIncomeNo" name="additionalIncome" value="no">
                                        <label for="additionalIncomeNo">Нет</label><br>

                                        <!-- Блок, который показывается, если выбран "Доп. доход = Да" -->
                                        <div class="conditional-block" data-condition="additionalIncomeYes" style="display:none; margin-top:10px;">
                                            <p><strong>В каком размере дополнительный доход?</strong></p>

                                            <input type="radio" id="additionalIncomeSize1" name="additionalIncomeSize" value="1">
                                            <label for="additionalIncomeSize1">Менее 10 000</label><br>

                                            <input type="radio" id="additionalIncomeSize2" name="additionalIncomeSize" value="2">
                                            <label for="additionalIncomeSize2">10-20 000</label><br>

                                            <input type="radio" id="additionalIncomeSize3" name="additionalIncomeSize" value="3">
                                            <label for="additionalIncomeSize3">20-30 000</label><br>

                                            <input type="radio" id="additionalIncomeSize4" name="additionalIncomeSize" value="4">
                                            <label for="additionalIncomeSize4">30-40 000</label><br>

                                            <input type="radio" id="additionalIncomeSize5" name="additionalIncomeSize" value="5">
                                            <label for="additionalIncomeSize5">40-60 000</label><br>

                                            <input type="radio" id="additionalIncomeSize6" name="additionalIncomeSize" value="6">
                                            <label for="additionalIncomeSize6">Более 60 000</label><br>
                                        </div>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 7 -->
                                    <div class="quiz-question" data-question="7">
                                        <p><strong>7. Стаж работы на последнем месте?</strong></p>
                                        <input type="radio" id="workExp1" name="workExperience" value="1" required>
                                        <label for="workExp1">Менее полугода</label><br>

                                        <input type="radio" id="workExp2" name="workExperience" value="2">
                                        <label for="workExp2">До 1 года</label><br>

                                        <input type="radio" id="workExp3" name="workExperience" value="3">
                                        <label for="workExp3">1-3 года</label><br>

                                        <input type="radio" id="workExp4" name="workExperience" value="4">
                                        <label for="workExp4">3-5 лет</label><br>

                                        <input type="radio" id="workExp5" name="workExperience" value="5">
                                        <label for="workExp5">5-7 лет</label><br>

                                        <input type="radio" id="workExp6" name="workExperience" value="6">
                                        <label for="workExp6">Более 7 лет</label><br>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 8 -->
                                    <div class="quiz-question" data-question="8">
                                        <p><strong>8. Какая у вас должность?</strong></p>
                                        <input type="radio" id="positionManager" name="position" value="manager" required>
                                        <label for="positionManager">Руководитель</label><br>

                                        <input type="radio" id="positionEmployee" name="position" value="employee">
                                        <label for="positionEmployee">Работник</label><br>

                                        <input type="radio" id="positionEntrepreneur" name="position" value="entrepreneur">
                                        <label for="positionEntrepreneur">Предприниматель</label><br>

                                        <input type="radio" id="positionPensioner" name="position" value="pensioner">
                                        <label for="positionPensioner">Пенсионер</label><br>

                                        <input type="radio" id="positionStudent" name="position" value="student">
                                        <label for="positionStudent">Студент</label><br>

                                        <input type="radio" id="positionUnemployed" name="position" value="unemployed">
                                        <label for="positionUnemployed">Не работаю</label><br>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 9 -->
                                    <div class="quiz-question" data-question="9">
                                        <p><strong>9. Есть ли у вас иждивенцы (дети, инвалиды)?</strong></p>
                                        <input type="radio" id="dependents0" name="dependents" value="0" required>
                                        <label for="dependents0">Нет</label><br>

                                        <input type="radio" id="dependents1" name="dependents" value="1">
                                        <label for="dependents1">1</label><br>

                                        <input type="radio" id="dependents2" name="dependents" value="2">
                                        <label for="dependents2">2</label><br>

                                        <input type="radio" id="dependents3" name="dependents" value="3">
                                        <label for="dependents3">3 и более</label><br>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 10: Кредитовались ли вы ранее? -->
                                    <div class="quiz-question" data-question="10">
                                        <p><strong>10. Кредитовались ли вы ранее?</strong></p>
                                        <input type="radio" id="previousCreditYes" name="previousCredit" value="yes" required>
                                        <label for="previousCreditYes">Да</label><br>

                                        <input type="radio" id="previousCreditNo" name="previousCredit" value="no">
                                        <label for="previousCreditNo">Нет</label><br>

                                        <!-- Появляется, если выбрано "Да" -->
                                        <div class="conditional-block" data-condition="previousCreditYes" style="display:none; margin-top:10px;">
                                            <p><strong>Есть ли открытые кредиты?</strong></p>
                                            <input type="radio" id="openCreditsYes" name="openCredits" value="yes">
                                            <label for="openCreditsYes">Да</label><br>

                                            <input type="radio" id="openCreditsNo" name="openCredits" value="no">
                                            <label for="openCreditsNo">Нет</label><br>

                                            <!-- Появляется, если выбрано "Есть открытые кредиты?" = Да -->
                                            <div class="conditional-block" data-condition="openCreditsYes" style="display:none; margin-top:10px;">
                                                <p><strong>Сколько платите в месяц по кредитам?</strong></p>
                                                <input type="radio" id="monthlyPayment1" name="monthlyPayment" value="1">
                                                <label for="monthlyPayment1">Менее 10 000</label><br>

                                                <input type="radio" id="monthlyPayment2" name="monthlyPayment" value="2">
                                                <label for="monthlyPayment2">10-20 000</label><br>

                                                <input type="radio" id="monthlyPayment3" name="monthlyPayment" value="3">
                                                <label for="monthlyPayment3">20-30 000</label><br>

                                                <input type="radio" id="monthlyPayment4" name="monthlyPayment" value="4">
                                                <label for="monthlyPayment4">30-40 000</label><br>

                                                <input type="radio" id="monthlyPayment5" name="monthlyPayment" value="5">
                                                <label for="monthlyPayment5">40-60 000</label><br>

                                                <input type="radio" id="monthlyPayment6" name="monthlyPayment" value="6">
                                                <label for="monthlyPayment6">Более 60 000</label><br>
                                            </div>
                                        </div>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 11: Кредитная история -->
                                    <div class="quiz-question" data-question="11">
                                        <p><strong>11. Какая у вас кредитная история?</strong></p>
                                        <input type="radio" id="creditHistoryPositive" name="creditHistory" value="positive" required>
                                        <label for="creditHistoryPositive">Положительная</label><br>

                                        <input type="radio" id="creditHistoryNegative" name="creditHistory" value="negative">
                                        <label for="creditHistoryNegative">Негативная</label><br>

                                        <input type="radio" id="creditHistoryZero" name="creditHistory" value="zero">
                                        <label for="creditHistoryZero">Нулевая</label><br>

                                        <input type="radio" id="creditHistoryDelayed" name="creditHistory" value="delayed">
                                        <label for="creditHistoryDelayed">Были просрочки</label><br>

                                        <!-- Появляется, если "Были просрочки" -->
                                        <div class="conditional-block" data-condition="creditHistoryDelayed" style="display:none; margin-top:10px;">
                                            <p><strong>На сколько дней просрочили?</strong></p>
                                            <input type="radio" id="overdueDays1" name="overdueDays" value="1">
                                            <label for="overdueDays1">До 10 дней</label><br>

                                            <input type="radio" id="overdueDays2" name="overdueDays" value="2">
                                            <label for="overdueDays2">До 30 дней</label><br>

                                            <input type="radio" id="overdueDays3" name="overdueDays" value="3">
                                            <label for="overdueDays3">Более 30 дней</label><br>

                                            <input type="radio" id="overdueDays4" name="overdueDays" value="4">
                                            <label for="overdueDays4">Не помню</label><br>
                                        </div>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 12 -->
                                    <div class="quiz-question" data-question="12">
                                        <p><strong>12. Какое у вас образование?</strong></p>
                                        <input type="radio" id="educationHigher" name="education" value="higher" required>
                                        <label for="educationHigher">Высшее</label><br>

                                        <input type="radio" id="educationIncompleteHigher" name="education" value="incompleteHigher">
                                        <label for="educationIncompleteHigher">Неоконченное высшее</label><br>

                                        <input type="radio" id="educationSecondarySpecial" name="education" value="secondarySpecial">
                                        <label for="educationSecondarySpecial">Среднее специальное</label><br>

                                        <input type="radio" id="educationGeneralSecondary" name="education" value="generalSecondary">
                                        <label for="educationGeneralSecondary">Среднее общее</label><br>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 13: Автомобиль -->
                                    <div class="quiz-question" data-question="13">
                                        <p><strong>13. У вас есть автомобиль?</strong></p>
                                        <input type="radio" id="carYes" name="car" value="yes" required>
                                        <label for="carYes">Да</label><br>

                                        <input type="radio" id="carNo" name="car" value="no">
                                        <label for="carNo">Нет</label><br>

                                        <!-- Появляется, если "Да" -->
                                        <div class="conditional-block" data-condition="carYes" style="display:none; margin-top:10px;">
                                            <p><strong>Какой именно?</strong></p>
                                            <input type="radio" id="carTypeNewForeign" name="carType" value="newForeign">
                                            <label for="carTypeNewForeign">Новая иномарка</label><br>

                                            <input type="radio" id="carTypeOldForeign" name="carType" value="oldForeign">
                                            <label for="carTypeOldForeign">Старая иномарка</label><br>

                                            <input type="radio" id="carTypeNewDomestic" name="carType" value="newDomestic">
                                            <label for="carTypeNewDomestic">Новый отечественный</label><br>

                                            <input type="radio" id="carTypeOldDomestic" name="carType" value="oldDomestic">
                                            <label for="carTypeOldDomestic">Старый отечественный</label><br>
                                        </div>

                                        <button type="button" class="next-btn">Продолжить</button>
                                    </div>

                                    <!-- ВОПРОС 14: кнопка отправки -->
                                    <div class="quiz-question" data-question="14">
                                        <button type="submit" class="submit-btn">Показать результат</button>
                                    </div>
                                </form>


                                <!-- Модальное окно для результата -->
                                <div id="quizResult" class="quiz-result">
                                    <div class="quiz-content">
                                        <span class="quiz-close">&times;</span>
                                        <p id="quizResultText"></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <script>
                      document.addEventListener('DOMContentLoaded', function() {
    const quizForm = document.getElementById('quizForm');
    const quizResultModal = document.getElementById('quizResult');
    const quizResultText = document.getElementById('quizResultText');
    const quizClose = document.querySelector('.quiz-close');

    // Получаем все блоки вопросов
    const questions = document.querySelectorAll('.quiz-question');

    // Индикатор прогресса
    const currentStepElement = document.getElementById('currentStep');
    const totalStepsElement = document.getElementById('totalSteps');
    const progressFilled = document.getElementById('progressFilled');

    // Последний блок - это кнопка "Отправить"
    // поэтому считаем общее количество "шагов" = кол-во .quiz-question - 1
    totalStepsElement.textContent = questions.length - 1;

    // Показ вопроса по индексу
    function showQuestion(index) {
        questions.forEach((question, i) => {
            if (i === index) {
                question.classList.add('active');
                // Включаем поля
                const inputs = question.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.disabled = false;
                });
            } else {
                question.classList.remove('active');
                // Выключаем поля
                const inputs = question.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.disabled = true;
                });
            }
        });
        // Обновляем счетчик шагов
        currentStepElement.textContent = index + 1;
        // Обновляем прогресс
        updateProgress(index + 1, totalStepsElement.textContent);
    }

    // Расчёт процента прохождения
    function updateProgress(current, total) {
        const percentage = (current / total) * 100;
        progressFilled.style.width = `${percentage}%`;
    }

    // Переход к следующему вопросу
    function getNextQuestionIndex(currentIndex) {
        let nextIndex = currentIndex + 1;
        if (nextIndex >= questions.length) {
            return questions.length - 1; // последний
        }
        return nextIndex;
    }

    // Обработчики кнопок "Продолжить" — переключение шагов
    questions.forEach((question, index) => {
        const nextBtn = question.querySelector('.next-btn');
        if (nextBtn) {
            nextBtn.addEventListener('click', function(event) {
                // Проверка, является ли текущий вопрос последним
                if (index === questions.length - 1) {
                    // Если это последний вопрос, ничего не делать
                    event.preventDefault();
                    return;
                }

                // Проверка, выбран ли вариант (только если есть радио/чекбоксы)
                const inputs = question.querySelectorAll('input[type="radio"], input[type="checkbox"]');
                if (inputs.length > 0) {
                    let isChecked = false;
                    inputs.forEach(input => {
                        if (input.checked) isChecked = true;
                    });
                    if (!isChecked) {
                        alert('Пожалуйста, выберите один из вариантов ответа.');
                        return;
                    }
                }
                // Следующий вопрос
                const nextIndex = getNextQuestionIndex(index);
                showQuestion(nextIndex);
            });
        }
    });

    // Обработка кликов по радио, чтобы показывать/скрывать .conditional-block
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Определяем ближайший контейнер (.quiz-question или .conditional-block)
            const parentContainer = radio.closest('.quiz-question, .conditional-block');
            if (!parentContainer) return;

            // Находим все непосредственные .conditional-block внутри этого контейнера
            const allConditionalBlocks = Array.from(parentContainer.children).filter(child => child.classList.contains('conditional-block'));
            allConditionalBlocks.forEach(block => {
                block.style.display = 'none';
                // Также скрываем все вложенные блоки внутри скрываемых блоков
                const nestedBlocks = block.querySelectorAll('.conditional-block');
                nestedBlocks.forEach(nested => {
                    nested.style.display = 'none';
                });
            });

            // Показываем блок, чей data-condition совпадает с id выбранного radio
            const targetBlock = parentContainer.querySelector(`.conditional-block[data-condition="${radio.id}"]`);
            if (targetBlock) {
                targetBlock.style.display = 'flex';
            }
        });
    });

    // Отправка формы (последний экран)
    quizForm.addEventListener('submit', function(event) {
        event.preventDefault();
        // Демонстрация: случайная сумма
        const randomAmount = Math.floor(Math.random() * (15000 - 10000 + 1)) + 10000;
        const message = `Вам могут одобрить сумму от ${randomAmount.toLocaleString('ru-RU')} ₽`;
        quizResultText.textContent = message;
        quizResultModal.style.display = 'block';
    });

    // Закрытие модалки
    quizClose.addEventListener('click', function() {
        quizResultModal.style.display = 'none';
    });
    window.addEventListener('click', function(e) {
        if (e.target === quizResultModal) {
            quizResultModal.style.display = 'none';
        }
    });

    // Старт
    showQuestion(0); // Показать первый вопрос
});






                        // Обработчики вкладок калькулятора и квиза
                        document.addEventListener('DOMContentLoaded', function() {
                            // Получаем все элементы вкладок
                            const tabs = document.querySelectorAll('.tariffs__list-menu ul li');

                            // Получаем все блоки контента
                            const contentBlocks = document.querySelectorAll('.calc, .quiz');

                            tabs.forEach(function(tab) {
                                tab.addEventListener('click', function() {
                                    // Удаляем класс 'active' у всех вкладок
                                    tabs.forEach(function(item) {
                                        item.classList.remove('active');
                                    });

                                    // Добавляем класс 'active' к кликнутой вкладке
                                    this.classList.add('active');

                                    // Получаем целевой блок из data-target
                                    const target = this.getAttribute('data-target');

                                    // Скрываем все блоки контента
                                    contentBlocks.forEach(function(block) {
                                        block.classList.remove('active');
                                    });

                                    // Показываем целевой блок
                                    const activeBlock = document.getElementById(target);
                                    if (activeBlock) {
                                        activeBlock.classList.add('active');
                                    }
                                });
                            });
                        });
                    </script>
                    <!-- / calc -->

                    <!-- author -->
                    <?php $author_id = get_field('page_author', $ID) ?>
                    <?php if ($author_id): ?>
                        <div class="section card expert__horizontal">
                            <div class="card-container">
                                <div class="d-flex flex-wrap">
                                    <div class="expert__horizontal-title d-flex align-items-center mb-md-3 order-2 order-md-1">
                                        <span class="d-none d-md-block mr-2">Автор:</span>
                                        <a href="<?php echo get_permalink($author_id) ?>" class="stretched-link"><?php echo get_the_title($author_id) ?></a>
                                    </div>
                                    <div class="expert__card-social ml-md-auto d-flex justify-content-end mb-md-3 order-4 order-md-2">
                                        <?php if (have_rows('expert_socials', $author_id)):
                                            while (have_rows('expert_socials', $author_id)) : the_row();
                                                $socialname = get_sub_field('socialname');
                                                $social_link = get_sub_field('social_link'); ?>
                                                <?php if ($socialname == 'bc1'): ?>
                                                    <a href="<?php echo $social_link ?>" class="social__link telegram d-flex justify-content-center align-items-center mx-2">
                                                        <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M0.545295 6.26176L3.76396 7.46194L5.01869 11.4989C5.07324 11.7717 5.40057 11.8262 5.61878 11.6626L7.41904 10.1896C7.5827 10.026 7.85547 10.026 8.07369 10.1896L11.2923 12.5354C11.5106 12.6991 11.8379 12.59 11.8924 12.3172L14.2928 0.860961C14.3473 0.588194 14.0746 0.315429 13.8018 0.424536L0.545295 5.55257C0.217974 5.66167 0.217974 6.15265 0.545295 6.26176ZM4.85503 6.86185L11.1832 2.98855C11.2923 2.934 11.4014 3.09766 11.2923 3.15221L6.10976 8.00747C5.9461 8.17113 5.78243 8.38935 5.78243 8.66211L5.61878 9.9714C5.61878 10.1351 5.34601 10.1896 5.29146 9.9714L4.63681 7.57104C4.47315 7.29828 4.58227 6.97095 4.85503 6.86185Z" fill="white"></path>
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if ($socialname == 'bc2'): ?>
                                                    <a href="<?php echo $social_link ?>" class="social__link vk d-flex justify-content-center align-items-center mx-2">
                                                        <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.8645 8.58097C14.8645 8.52285 14.8063 8.52286 14.8063 8.46474C14.5739 7.99981 14.0508 7.41865 13.3534 6.77938C13.0047 6.4888 12.8304 6.25633 12.7142 6.1401C12.5398 5.90763 12.5398 5.73329 12.5979 5.50083C12.656 5.32648 12.8885 5.03589 13.2953 4.51285C13.5278 4.22227 13.644 4.04792 13.8184 3.87358C14.6901 2.71125 15.0969 1.95574 14.9807 1.60704L14.9226 1.54893C14.8645 1.49082 14.8063 1.4327 14.6901 1.4327C14.5739 1.37459 14.3995 1.37459 14.2252 1.4327H12.0168C11.9587 1.4327 11.9586 1.4327 11.8424 1.4327C11.7843 1.4327 11.7262 1.4327 11.7262 1.4327H11.6681H11.61L11.5518 1.49081C11.4937 1.54893 11.4937 1.54893 11.4937 1.60704C11.2613 2.24632 10.9707 2.76937 10.6801 3.35053C10.5057 3.64111 10.3314 3.93169 10.1571 4.16416C9.9827 4.39662 9.86647 4.57096 9.75023 4.6872C9.634 4.80343 9.51777 4.86154 9.45965 4.97778C9.40154 5.03589 9.28531 5.09401 9.28531 5.0359C9.2272 5.0359 9.16907 5.03589 9.16907 4.97778C9.11096 4.91966 9.05285 4.86154 8.99473 4.80343C8.93662 4.74531 8.93661 4.62908 8.87849 4.51285C8.87849 4.39661 8.87849 4.28038 8.87849 4.22227C8.87849 4.16415 8.87849 3.98981 8.87849 3.87358C8.87849 3.69923 8.87849 3.58299 8.87849 3.52488C8.87849 3.35053 8.87849 3.11807 8.87849 2.8856C8.87849 2.65314 8.87849 2.47879 8.87849 2.36255C8.87849 2.24632 8.87849 2.07198 8.87849 1.95574C8.87849 1.7814 8.87849 1.66516 8.87849 1.60704C8.87849 1.54893 8.82039 1.4327 8.82039 1.37458C8.76227 1.31647 8.70415 1.25835 8.64603 1.20023C8.58792 1.14212 8.47169 1.14212 8.41357 1.084C8.12299 1.02589 7.7743 0.967773 7.36749 0.967773C6.43763 0.967773 5.79835 1.02589 5.56589 1.14212C5.44966 1.20024 5.33342 1.25835 5.27531 1.37458C5.15908 1.49082 5.15907 1.54893 5.21719 1.54893C5.50777 1.60705 5.74024 1.72328 5.85647 1.89762L5.91459 2.01386C5.9727 2.07198 5.97269 2.18821 6.03081 2.36255C6.08893 2.5369 6.08893 2.71125 6.08893 2.94372C6.08893 3.29241 6.08893 3.64111 6.08893 3.87358C6.08893 4.16416 6.03081 4.3385 6.03081 4.51285C6.03081 4.68719 5.9727 4.80343 5.91459 4.86155C5.85647 4.97778 5.85646 5.0359 5.79835 5.0359C5.79835 5.0359 5.79835 5.09401 5.74023 5.09401C5.68211 5.09401 5.624 5.15213 5.50777 5.15213C5.44965 5.15213 5.33342 5.09401 5.27531 5.0359C5.15908 4.97778 5.04284 4.86155 4.98473 4.74532C4.8685 4.62908 4.75226 4.45473 4.63603 4.22227C4.5198 3.9898 4.34544 3.75734 4.22921 3.40865L4.11299 3.17618C4.05487 3.05995 3.93864 2.82749 3.82241 2.5369C3.70617 2.24632 3.58994 2.01386 3.47371 1.72328C3.41559 1.60705 3.35748 1.54893 3.29937 1.49081H3.24125C3.24125 1.49081 3.18312 1.4327 3.12501 1.4327C3.06689 1.4327 3.00878 1.37458 2.95067 1.37458H0.858485C0.626021 1.37458 0.50979 1.4327 0.451674 1.49081L0.393555 1.54893C0.393555 1.54893 0.393555 1.60705 0.393555 1.66516C0.393555 1.72328 0.393558 1.78139 0.451674 1.89762C0.742255 2.59502 1.09095 3.29241 1.43965 3.98981C1.78834 4.62908 2.13704 5.21024 2.36951 5.61706C2.66009 6.02387 2.89255 6.43068 3.18313 6.77938C3.47371 7.12807 3.64805 7.36054 3.70617 7.47677C3.8224 7.593 3.88051 7.65111 3.93863 7.70923L4.11299 7.88358C4.22922 7.99981 4.40356 8.17416 4.63603 8.34851C4.86849 8.52286 5.15907 8.6972 5.44965 8.87155C5.74023 9.0459 6.08893 9.16214 6.43763 9.27837C6.84444 9.3946 7.19313 9.45272 7.54183 9.3946H8.41357C8.58792 9.3946 8.70416 9.33648 8.82039 9.22025L8.87849 9.16213C8.87849 9.10401 8.93661 9.10402 8.93661 9.0459C8.93661 8.98778 8.93661 8.92967 8.93661 8.81344C8.93661 8.58098 8.93662 8.40663 8.99473 8.23228C9.05285 8.05793 9.05285 7.9417 9.11097 7.82547C9.16909 7.70924 9.2272 7.65111 9.28531 7.593C9.34343 7.53488 9.40155 7.47677 9.40155 7.47677H9.45965C9.57588 7.41865 9.75024 7.47677 9.86647 7.593C10.0408 7.70923 10.2152 7.88358 10.3314 8.05793C10.4476 8.23228 10.622 8.40663 10.8545 8.63909C11.0869 8.87155 11.2613 9.0459 11.3775 9.10402L11.5518 9.22025C11.6681 9.27837 11.7843 9.33648 11.9587 9.3946C12.133 9.45272 12.2492 9.45271 12.3655 9.45271L14.3414 9.3946C14.5158 9.3946 14.6901 9.33648 14.8063 9.27837C14.9226 9.22025 14.9807 9.16213 14.9807 9.0459C14.9807 8.98778 14.9807 8.87156 14.9807 8.81344C14.8644 8.69721 14.8645 8.63909 14.8645 8.58097Z" fill="white"></path>
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if ($socialname == 'bc3'): ?>
                                                    <a href="<?php echo $social_link ?>" class="social__link instagram d-flex justify-content-center align-items-center mx-2">
                                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.6064 0.399902H2.09336C1.13221 0.399902 0.399902 1.13221 0.399902 2.09336V10.6064C0.399902 11.5676 1.13221 12.2999 2.09336 12.2999H10.6064C11.5676 12.2999 12.2999 11.5676 12.2999 10.6064V2.09336C12.2999 1.13221 11.5676 0.399902 10.6064 0.399902ZM6.3499 9.9199C8.31798 9.9199 9.9199 8.36375 9.9199 6.48721C9.9199 6.16683 9.87413 5.80067 9.78259 5.52606H10.7895V10.3776C10.7895 10.6064 10.6064 10.8353 10.3318 10.8353H2.36798C2.13913 10.8353 1.91029 10.6522 1.91029 10.3776V5.48029H2.96298C2.87144 5.80067 2.82567 6.12106 2.82567 6.44144C2.7799 8.36375 4.38183 9.9199 6.3499 9.9199ZM6.3499 8.54683C5.06836 8.54683 4.06144 7.5399 4.06144 6.30413C4.06144 5.06836 5.06836 4.06144 6.3499 4.06144C7.63144 4.06144 8.63836 5.06836 8.63836 6.30413C8.63836 7.58567 7.63144 8.54683 6.3499 8.54683ZM10.7438 3.64952C10.7438 3.92413 10.5149 4.15298 10.2403 4.15298H8.95875C8.68413 4.15298 8.45529 3.92413 8.45529 3.64952V2.41375C8.45529 2.13913 8.68413 1.91029 8.95875 1.91029H10.2403C10.5149 1.91029 10.7438 2.13913 10.7438 2.41375V3.64952Z" fill="white"></path>
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if ($socialname == 'bc4'): ?>
                                                    <a href="<?php echo $social_link ?>" class="social__link mymir d-flex justify-content-center align-items-center mx-2">
                                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.6065 1.91029C9.50799 0.903364 8.18067 0.399902 6.53298 0.399902C4.83952 0.399902 3.3749 0.949133 2.1849 2.09336C0.9949 3.2376 0.399902 4.65644 0.399902 6.3499C0.399902 7.9976 0.949139 9.37067 2.09337 10.5607C3.2376 11.7507 4.74799 12.2999 6.71607 12.2999C7.8603 12.2999 9.00453 12.0711 10.1488 11.5676C10.5149 11.4303 10.698 10.9726 10.5607 10.6064C10.4234 10.2403 9.96568 10.0572 9.59952 10.1945C8.63837 10.6064 7.67721 10.8353 6.76182 10.8353C5.29721 10.8353 4.15298 10.3776 3.32913 9.46221C2.50528 8.54683 2.09337 7.49413 2.09337 6.30413C2.09337 4.97683 2.55106 3.87836 3.3749 3.00875C4.24452 2.13913 5.29721 1.68144 6.57875 1.68144C7.72298 1.68144 8.7299 2.04759 9.55375 2.7799C10.3776 3.51221 10.7438 4.42759 10.7438 5.52606C10.7438 6.25836 10.5607 6.89913 10.1945 7.4026C9.82836 7.90606 9.46221 8.1349 9.05029 8.1349C8.82144 8.1349 8.72991 8.04336 8.72991 7.76875C8.72991 7.58567 8.72991 7.35683 8.77568 7.12798L9.23337 3.42067H7.67721L7.58568 3.78683C7.17376 3.46644 6.76182 3.28336 6.30413 3.28336C5.57182 3.28336 4.93106 3.60375 4.38183 4.19875C3.8326 4.79375 3.60375 5.57183 3.60375 6.48721C3.60375 7.4026 3.8326 8.1349 4.33606 8.7299C4.79375 9.27913 5.38876 9.55375 6.02953 9.55375C6.62453 9.55375 7.12798 9.3249 7.53991 8.82144C7.86029 9.27913 8.31799 9.55375 8.95876 9.55375C9.87414 9.55375 10.6522 9.14183 11.3387 8.36375C12.0253 7.58567 12.3457 6.62452 12.3457 5.48029C12.2084 4.10721 11.6591 2.87144 10.6065 1.91029ZM6.99067 7.49413C6.71605 7.86029 6.39568 8.04336 5.98376 8.04336C5.70914 8.04336 5.52607 7.90606 5.34299 7.63144C5.15991 7.35683 5.11414 7.03644 5.11414 6.62452C5.11414 6.12106 5.20567 5.70913 5.43452 5.43452C5.66336 5.11413 5.93799 4.97683 6.25837 4.97683C6.53299 4.97683 6.8076 5.06836 7.03644 5.34298C7.26529 5.57183 7.35683 5.89221 7.35683 6.25836C7.4026 6.71606 7.26529 7.12798 6.99067 7.49413Z" fill="white"></path>
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>
                                        <?php endwhile;
                                        endif; ?>
                                        <!-- rating mobile -->
                                        <div class="card__rating d-flex d-md-none align-items-center ml-auto">
                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                </svg></div>
                                            5.5
                                        </div>
                                        <!-- / rating mobile -->
                                    </div>
                                    <div class="expert__horizontal-picture mr-md-4 d-flex flex-column order-1 order-md-3">
                                        <div class="expert__horizontal-img">
                                            <img src="<?php echo the_field('expert_logo', $author_id) ?>" alt="">
                                        </div>
                                        <div class="card__rating d-none d-md-flex align-items-center mx-auto mt-3">
                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                </svg></div>
                                            <?php echo the_field('ratings_average', $author_id); ?>
                                        </div>
                                    </div>
                                    <div class="expert__horizontal-content order-3 order-md-4">
                                        <?php $post_id = $author_id;
                                        $post_content = get_post($post_id);
                                        $content = $post_content->post_content;
                                        echo apply_filters('the_content', $content); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- / author -->

                    <!-- reviews -->
                    <div id="comments" class="section">
                        <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                            <h2 class="title mb-0">Отзывы пользователей и должников</h2>
                        </div>
                        <div class="comments reviews mb-4">
                            <?php
                            $comments = get_comments(array(
                                'post_id' => $ID,
                                'status' => 'approve',
                                'hierarchical' => 'threaded',
                                'number' => 3,
                            ));
                            $counter = 0;
                            foreach ($comments as $comment) {
                                $comment_id = $comment->comment_ID;
                                $comment_post_id = $comment->comment_post_ID;
                                $user = get_userdata($comment->user_id);
                                $user_email = '';
                                $user_role = '';
                                $user_city = '';
                                if (!empty($user)) {
                                    $user_email = $user->user_email;
                                    $user_role = $user->roles;
                                    $user_city = $user->user_city;
                                }
                                $counter++;
                                $comments_children = get_comments(array(
                                    'status' => 'approve',
                                    'hierarchical' => 'true',
                                    'parent' => $comment_id,
                                ));
                                $responses = count($comments_children); ?>
                                <!-- item -->
                                <div class="comment__one p-4" id="comment-<?php echo $comment_id ?>">
                                    <!-- comment -->

                                    <div class="comment__one-header">
                                        <div class="comment__one-info">
                                            <div class=""><?php echo the_title() ?></div>
                                            <div class="rew-rating d-flex align-items-center ">
                                                <?php

                                                $rating     = get_comment_meta($comment_id, 'comment_rating', true);

                                                if ($rating) {
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $rating) {
                                                            echo '<span style="color: #f5b301;">★</span>';
                                                        } else {
                                                            echo '<span style="color: #ccc;">★</span>';
                                                        }
                                                    }
                                                } else {
                                                    // Рейтинг отсутствует, генерируем случайное число 4 или 5
                                                    $rating = mt_rand(4, 5);

                                                    // Сохраняем его, чтобы в будущем не генерировать заново
                                                    update_comment_meta($comment_id, 'comment_rating', $rating);

                                                    // Выводим звёзды согласно этому случайному рейтингу
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $rating) {
                                                            echo '<span style="color: #f5b301;">★</span>';
                                                        } else {
                                                            echo '<span style="color: #ccc;">★</span>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>

                                        </div>

                                        <div class="comment__one-img">
                                            <img src="<?php the_field('z_organization_logo', get_the_ID()); ?>"
                                                alt="<?php
                                                        $logo_id = get_field('z_organization_logo', get_the_ID(), false);
                                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                        echo esc_attr($logo_alt);
                                                        ?>">
                                        </div>

                                    </div>
                                    <div class="comment__one-title">
                                        <?php echo $comment->comment_author; ?>
                                    </div>
                                    <div class="comment__one-content">
                                        <?php echo $comment->comment_content; ?>
                                    </div>
                                    <div class="comment__one-footer">

                                        <div class="comment__one-date mr-md-4 order-md-1">
                                            <?php echo  get_comment_date('d.m.y'); ?> в
                                            <?php echo get_comment_date('H:i') ?>
                                        </div>


                                    </div>

                                    <!-- comment -->

                                </div>
                                <!-- /item -->
                            <?php } ?>
                        </div>
                        <?php if (count($comments) != "0"): ?>
                            <div class="comments__action">
                                <a class="btn btn-primary" id="openCommentForm">
                                    Оставить отзыв
                                </a>
                                <a href="<?php //echo  get_page_link(1503); 
                                            ?><?php the_permalink(); ?>comments/" class="btn btn-outline-alternative" post-id="<?php echo $ID ?>">Все отзывы</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="section">
                        <!-- form -->
                        <div class="form commentForm" id="commentForm">
                            <?php
                            $new_args = $args + ['is_detail_page' => 'Y'];
                            get_template_part('all_template/commentForm', null, $new_args);
                            ?>

                        </div>
                    </div>
                    <!-- / form and reviews -->


                    <!-- new-comments -->
                    <div class="section">
                        <h2 class="title mb-3">Комментарии</h2>
                        <div class="additional-comments">
                            <?php
                            $current_post_id = get_the_ID();
                            display_additional_comments($current_post_id);
                            ?>
                        </div>
                        <div class="btn btn-primary" id="openAdditionalCommentForm">
                            Написать комментарий
                        </div>

                    </div>
                    <div class="new-comment-form">
                        <?php // if (is_user_logged_in()): 
                        ?>
                        <!-- <h3>Оставить комментарий</h3> -->
                        <form id="additional-comment-form" method="post" class="row additional-comment-form">
                            <input type="hidden" name="action" value="handle_additional_comment_ajax">
                            <input type="hidden" name="additional_comment_nonce" value="<?php echo wp_create_nonce('additional_comment_form'); ?>">
                            <div class="form-group col-12 col-md-6">
                                <!-- <label for="author_name">Имя</label> -->
                                <div class="mb-3">
                                    <input type="text" id="author_name" name="acf[field_675ae76ee8992]" class="form-control" placeholder="Имя*" required>
                                </div>

                            </div>
                            <div class="form-group col-12 col-md-6">
                                <!-- <label for="author_email">E-Mail</label> -->
                                <div class="mb-3">
                                    <input type="email" id="author_email" name="acf[field_675ae7d4b0bdc]" class="form-control" placeholder="E-Mail*" required>
                                </div>

                            </div>
                            <div class="form-group col-12">
                                <!-- <label for="comment_content">Комментарий</label> -->
                                <textarea id="comment_content" name="acf[field_675ae80ab0bdd]" class="form-control" rows="4" placeholder="Ваш комментарий*" required></textarea>
                            </div>
                            <div class="form-comment__bottom">* - Обязательно заполнить</div>
                            <input type="hidden" name="acf[field_related_post]" value="<?php echo get_the_ID(); ?>" />
                            <div class="col-12">
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary px-5">Отправить</button>
                                </div>
                            </div>

                        </form>

                        <?php // else: 
                        ?>
                        <!-- <p>Пожалуйста, <a href="<?php // echo esc_url(wp_login_url()); 
                                                        ?>">войдите</a>, чтобы оставить комментарий.</p> -->
                        <?php // endif; 
                        ?>
                    </div>

                    <!-- /new-comments -->

                </div>
                <!-- / page content -->
            </div>
        </div>
        <!-- / content -->



        <!-- best offers -->
        <div class="container" id="best-offers">
            <div class="section main-page-offers">
                <div class="section__header mb-3 d-flex justify-content-between align-items-end align-items-md-center">
                    <h2 class="title mb-0">Лучшие предложения</h2>
                    <a href="<?php echo $credit_link ?>" class="btn btn-primary btn-sm btn-all offers-link-main">
                        Все
                        <span class="icon ml-1 ml-md-2">
                            <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="tabs offer-tabs">
                    <div class="forline">
                        <div class="horizontal__scroll">
                            <ul class="nav nav-tabs horizontal__scroll-container row mb-4" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#mainOffers1" aria-selected="true" data-link="<?php echo $credit_link ?>">Кредитные карты</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainOffers2" aria-selected="false" data-link="<?php echo $debet_link ?>">Дебетовые карты</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainOffers3" aria-selected="false" data-link="<?php echo $installment_link ?>">Карты рассрочки</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainOffers4" aria-selected="false" data-link="<?php echo $creditprod_link ?>">Кредиты</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainOffers5" aria-selected="false" data-link="<?php echo $zaim_link ?>">Займы</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="mainOffers1">
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
                                            //array(
                                            //    'meta_key'      => 'archive',
                                            //    'meta_value'    => false
                                            //),
                                        )
                                    );

                                    $args['meta_query'][] = array(
                                        'key' => 'archive',
                                        'value' => '0'
                                    );
                                    $args['meta_query'][] = array(
                                        'key' => 'card_bank_link',
                                        'value' => '/recommends/',
                                        'compare' => 'LIKE',
                                    );





                                    $query = new WP_Query($args);

                                    // Цикл
                                    if ($query->have_posts()) {
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                    ?>
                                            <!-- item -->
                                            <div class="main-page card card__vertical size4 offer h-100">
                                                <div class="card-container p-3">
                                                    <div class="card__header mb-2 d-flex">
                                                        <div class="card__header-img">
                                                            <img loading="lazy" src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                                                alt="<?
                                                                        $bank_id = get_field('bank_logo', $bank_choise_rel, false);
                                                                        $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                                        echo $bank_alt;
                                                                        ?>">
                                                        </div>
                                                        <div class="card__header-title"><a href="<?php echo the_permalink() ?>">
                                                                <?php
                                                                $alter_title = get_field('alter_title');
                                                                echo $alter_title ?></a></div>
                                                    </div>



                                                    <ul class="leaders">
                                                        <div class="bank__item-footer text-center  pb-2 mt-2">
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Лимит</div>
                                                                <div class="leaders__item-value"><?= number_format(get_field('card_cred_limit'), 0, '.', ' '); ?> ₽</div>
                                                            </li>
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Обслуживание</div>
                                                                <div class="leaders__item-value"><?php echo the_field('card_cost') ?> ₽</div>
                                                            </li>
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Без %</div>
                                                                <div class="leaders__item-value"><?php $field = get_field('card_period');
                                                                                                    //$value = $field['value'];
                                                                                                    //$label = $field['choices'][ $value ];
                                                                                                    echo $field['label'] ?></div>
                                                            </li>
                                                            <!-- <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Кэшбэк</div>
                                                                <div class="leaders__item-value"><?= get_field('card_cashback'); ?></div>
                                                            </li>
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Ставка</div>
                                                                <div class="leaders__item-value">от <?= get_field('card_stavka') ?>%</div>
                                                            </li> -->
                                                        </div>
                                                    </ul>
                                                    <div class="card__actions mt-3 d-flex">
                                                        <a href="<?php echo the_permalink() ?>" class="btn btn-primary btn-sm btn-block font-weight-normal">Подробнее</a>

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
                        <div class="tab-pane" id="mainOffers2">
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
                                                'terms'    =>  'debetcard',
                                            ),
                                        )
                                    );

                                    $args['meta_query'][] = array(
                                        'key' => 'archive',
                                        'value' => '0'
                                    );
                                    $args['meta_query'][] = array(
                                        'key' => 'card_bank_link',
                                        'value' => '/recommends/',
                                        'compare' => 'LIKE',
                                    );

                                    $query = new WP_Query($args);

                                    // Цикл
                                    if ($query->have_posts()) {
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                    ?>
                                            <!-- item -->
                                            <div class="card card__vertical size4 offer h-100">
                                                <div class="card-container p-3">
                                                    <div class="card__header mb-2 d-flex">
                                                        <div class="card__header-img">

                                                            <?php $bank_choise_rel = get_field('bank_choise', get_the_ID()); ?>

                                                            <img loading="lazy"
                                                                alt="<?php echo get_post_meta(get_field('bank_logo', $bank_choise_rel, false), '_wp_attachment_image_alt', true); ?>"
                                                                src="<?php echo the_field('bank_logo', $bank_choise_rel) ?>">
                                                        </div>
                                                        <div class="card__header-title"><a href="<?php echo the_permalink() ?>"> <?php
                                                                                                                                    $alter_title = get_field('alter_title');
                                                                                                                                    echo $alter_title ?></a></div>
                                                    </div>


                                                    <ul class="leaders">
                                                        <div class="bank__item-footer text-center pb-2 mt-2">
                                                            <!-- <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Снятие без %</div>
                                                                <div class="leaders__item-value">До <?= number_format(get_field('non_pecent_money'), 0, '.', ' '); ?> ₽</div>
                                                            </li> -->

                                                            <!-- <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Тип кешбэка</div>
                                                                <div class="leaders__item-value"><?php $field = get_field('card_cashback_type');
                                                                                                    //$value = $field['value'];
                                                                                                    //$label = $field['choices'][ $value ];
                                                                                                    echo $field['label'] ?></div>
                                                            </li> -->
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Обслуживание</div>
                                                                <div class="leaders__item-value"><?php echo the_field('card_cost') ?> ₽</div>
                                                            </li>
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Кешбэк</div>
                                                                <div class="leaders__item-value"><?php $field = get_field('card_cashback');
                                                                                                    //$value = $field['value'];
                                                                                                    //$label = $field['choices'][ $value ];
                                                                                                    echo $field['label'] ?></div>
                                                            </li>
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">% на остаток</div>
                                                                <div class="leaders__item-value">До <?php echo the_field('card_stavka_ostatok') ?> %</div>
                                                            </li>
                                                        </div>
                                                    </ul>
                                                    <div class="card__actions mt-3 d-flex">
                                                        <a href="<?php echo the_permalink() ?>" class="btn btn-primary btn-sm btn-block font-weight-normal">Подробнее</a>

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
                        <div class="tab-pane" id="mainOffers3">
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
                                                'terms'    =>  'installmentcard',
                                            ),
                                        )
                                    );

                                    $args['meta_query'][] = array(
                                        'key' => 'archive',
                                        'value' => '0'
                                    );
                                    $args['meta_query'][] = array(
                                        'key' => 'card_bank_link',
                                        'value' => '/recommends/',
                                        'compare' => 'LIKE',
                                    );

                                    $query = new WP_Query($args);

                                    // Цикл
                                    if ($query->have_posts()) {
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                    ?>
                                            <!-- item -->
                                            <div class="card card__vertical size4 offer h-100">
                                                <div class="card-container p-3">
                                                    <div class="card__header mb-2 d-flex">
                                                        <div class="card__header-img">
                                                            <img loading="lazy" src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                                                alt="<?
                                                                        $bank_id = get_field('bank_logo', $bank_choise_rel, false);
                                                                        $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                                        echo $bank_alt;
                                                                        ?>">
                                                        </div>
                                                        <div class="card__header-title"><a href="<?php echo the_permalink() ?>"> <?php
                                                                                                                                    $alter_title = get_field('alter_title');
                                                                                                                                    echo $alter_title ?></a></div>
                                                    </div>


                                                    <ul class="leaders">
                                                        <div class="bank__item-footer text-center pb-2 mt-2">
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Лимит</div>
                                                                <div class="leaders__item-value"><?= number_format(get_field('card_cred_limit'), 0, '.', ' '); ?> ₽</div>
                                                            </li>
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Обслуживание</div>
                                                                <div class="leaders__item-value"><?php echo the_field('card_cost') ?> ₽</div>
                                                            </li>
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Без %</div>
                                                                <div class="leaders__item-value"><?php $field = get_field('card_period');
                                                                                                    //$value = $field['value'];
                                                                                                    //$label = $field['choices'][ $value ];
                                                                                                    echo $field['label'] ?></div>
                                                            </li>
                                                            <!-- <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Кэшбэк</div>
                                                                <div class="leaders__item-value"><?= get_field('card_cashback'); ?></div>
                                                            </li>
                                                            <li class="leaders__item mb-1">
                                                                <div class="leaders__item-title">Ставка</div>
                                                                <div class="leaders__item-value">от <?= get_field('card_stavka') ?>%</div>
                                                            </li> -->
                                                        </div>
                                                    </ul>
                                                    <div class="card__actions mt-3 d-flex">
                                                        <a href="<?php echo the_permalink() ?>" class="btn btn-primary btn-sm btn-block font-weight-normal">Подробнее</a>

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
                        <div class="tab-pane" id="mainOffers4">
                            <div class="horizontal__scroll row">
                                <div class="horizontal__scroll-container">
                                    <?php
                                    $args = array(
                                        'post_type'             => 'kredity',
                                        'posts_per_page'        => 4,
                                        'meta_key' => 'ratings_average',
                                        'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                                        'order' => 'DESC',
                                    );

                                    $args['meta_query'][] = array(
                                        'key' => 'archive',
                                        'value' => '0'
                                    );
                                    $args['meta_query'][] = array(
                                        'key' => 'card_bank_link',
                                        'value' => '/recommends/',
                                        'compare' => 'LIKE',
                                    );

                                    $query = new WP_Query($args);

                                    // Цикл
                                    if ($query->have_posts()) {
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                    ?>
                                            <!-- item -->
                                            <div class="card card__vertical size4 offer h-100">
                                                <div class="card-container p-3">
                                                    <div class="card__header mb-2 d-flex">
                                                        <div class="card__header-img">
                                                            <?php $bank_choise_rel = get_field('product_bank', get_the_ID()) ?>
                                                            <img loading="lazy" src="<?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                                                alt="<?
                                                                        $bank_id = get_field('bank_logo', $bank_choise_rel, false);
                                                                        $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                                        echo $bank_alt;
                                                                        ?>">
                                                        </div>
                                                        <div class="card__header-title"><a href="<?php echo the_permalink() ?>"> <?php
                                                                                                                                    $alter_title = get_field('alter_title');
                                                                                                                                    echo $alter_title ?></a></div>
                                                    </div>

                                                    <ul class="leaders">
                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">Сумма</div>
                                                            <div class="leaders__item-value"><?= number_format(get_field('credit_max_sum'), 0, '.', ' '); ?> ₽</div>
                                                        </li>
                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">Срок</div>
                                                            <div class="leaders__item-value">до <?php
                                                                                                // Переменные
                                                                                                $field = get_field('credit_period');
                                                                                                //$value = $field['value'];
                                                                                                //$label = $field['choices'][ $value ];
                                                                                                echo $field['label'] ?></div>
                                                        </li>

                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">ПСК</div>
                                                            <?php if (get_field('opisanie_psk')): ?>
                                                                <div class="leaders__item-value">
                                                                    <?= get_field('opisanie_psk') ?>% - <?= get_field('opisanie_psk_2') ?>%
                                                                </div>
                                                            <?php endif; ?>
                                                        </li>


                                                    </ul>
                                                    <div class="card__actions mt-3 d-flex">
                                                        <a href="<?php echo the_permalink() ?>" class="btn btn-primary btn-sm btn-block font-weight-normal">Подробнее</a>

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
                        <div class="tab-pane" id="mainOffers5">
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

                                    $query = new WP_Query($args);

                                    // Цикл
                                    if ($query->have_posts()) {
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                    ?>
                                            <!-- item -->
                                            <div class="card card__vertical size4 offer h-100">
                                                <div class="card-container p-3">
                                                    <div class="card__header mb-2 d-flex">
                                                        <div class="card__header-img">
                                                            <img loading="lazy" src="<?php echo the_field('z_organization_logo') ?>"
                                                                alt="<?
                                                                        $logo_id = get_field('z_organization_logo',  get_the_ID(), false);
                                                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                                        echo $logo_alt;
                                                                        ?>">

                                                        </div>
                                                        <div class="card__header-title"><a href="<?php echo the_permalink() ?>"> <?php
                                                                                                                                    $alter_title = get_field('alter_title');
                                                                                                                                    echo $alter_title ?></a></div>
                                                    </div>

                                                    <ul class="leaders">
                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">Сумма</div>
                                                            <div class="leaders__item-value"><?= number_format(get_field('z_sum'), 0, '.', ' '); ?> ₽</div>
                                                        </li>
                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">Срок</div>
                                                            <div class="leaders__item-value">до <?= get_field('z_time') ?> дней</div>
                                                        </li>
                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">ПСК</div>
                                                            <?php if (get_field('z_psk_1')) : ?>
                                                                <div class="leaders__item-value">
                                                                    <?= get_field('z_psk_1') ?>% - <?= get_field('z_psk_2') ?>%
                                                                </div>
                                                            <?php endif; ?>

                                                        </li>

                                                    </ul>
                                                    <div class="card__actions mt-3 d-flex">
                                                        <a href="<?php echo the_permalink() ?>" class="btn btn-primary btn-sm btn-block font-weight-normal">Подробнее</a>

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
                </div>
            </div>
        </div>

        <!-- / best offers -->

        <!-- breadcrumb2 -->
        <div class="container">
            <nav aria-label="breadcrumb" class="horizontal__scroll">
                <ol class="breadcrumb horizontal__scroll-container">
                    <li class="breadcrumb-item"><a href="<?php echo get_home_url(); ?>">Главная</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('zaimy'); ?>">Займы</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo the_title() ?></li>
                </ol>
            </nav>
        </div>
        <!-- / breadcrumb2 -->

        <!-- footer-raiting -->
        <div class="section">
            <div class="container">
                <div class="rating-footer client-rating" data-post-id="<?php echo get_the_ID(); ?>">
                    <?php
                    // Дополнительный рейтинговый блок
                    if (have_rows('additional_ratings_list')) :
                        $additional_index = 0;
                        while (have_rows('additional_ratings_list')) : the_row();
                            $title = get_sub_field('title');
                            $rating_total = get_sub_field('rating_total');
                            $rating_count = get_sub_field('rating_count');

                            // Вычисляем средний рейтинг
                            if ($rating_total && $rating_count) {
                                $average_rating = $rating_total / $rating_count;
                                $average_rating = round($average_rating, 1);
                            } else {
                                $average_rating = 0;
                            }

                            if ($title || $average_rating > 0) :
                                echo '<div class="rating-item" data-rating-index="' . $additional_index . '" data-rating-block="additional_ratings_list">';
                                if ($title) {
                                    echo '<h3 class="rating-title">' . esc_html($title) . '</h3>';
                                }

                                if ($average_rating > 0) {
                                    // Передаём правильный блок в функцию отображения рейтинга
                                    display_star_rating($average_rating, 'additional_ratings_list');
                                } else {
                                    echo '<div class="stars">';
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '<span class="star" data-value="' . $i . '" data-rating-block="additional_ratings_list">☆</span>';
                                    }
                                    echo '</div>';
                                }

                                // Добавляем элемент для отображения числового рейтинга
                                echo '<div class="rating-stat">';
                                echo 'Оценок ' . ($rating_count > 0 ? $rating_count : '0') . ', ';
                                echo 'среднее <span class="average-rating">' . ($average_rating > 0 ? $average_rating : '0') . '</span> из 5';
                                echo '</div>';

                            endif;

                            $additional_index++;
                        endwhile;
                    endif;
                    ?>
                </div>


            </div>
        </div>
        <!-- / footer-raiting -->
    </div>
</main>
<script>
    jQuery(document).ready(function($) {
        // Инициализация Slick Slider для каждой галереи
        $('.gallery').each(function() {
            $(this).slick({
                dots: true, // Показать навигационные точки
                infinite: true, // Бесконечная прокрутка
                speed: 300, // Скорость анимации
                slidesToShow: 1, // Количество видимых слайдов
                adaptiveHeight: true, // Автоматическая высота слайдера
                autoplay: false, // Автопрокрутка
                autoplaySpeed: 3000, // Скорость автопрокрутки (в миллисекундах)
                arrows: true, // Показать стрелки навигации
                // Дополнительные настройки при необходимости
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const openAdCommentForm = document.getElementById("openAdditionalCommentForm");

        const adCommentForm = document.getElementById("additional-comment-form");

        openAdCommentForm.addEventListener("click", () => {
            adCommentForm.classList.add("active");
        });




        const openCommentForm = document.getElementById("openCommentForm");

        const commentForm = document.getElementById("commentForm");

        openCommentForm.addEventListener("click", () => {
            commentForm.classList.add("active");
        });

        // Получаем все элементы меню
        // const menuItems = document.querySelectorAll('.sidebar__menu > li > a');

        // // Если есть дополнительные кнопки, получаем их (иначе удалите эти строки)
        // const additionalButton = document.getElementById('additional-button');
        // const scrollCommentsButton = document.getElementById('scroll-comments-button');
        // const scrollFaqButton = document.getElementById('scroll-faq-button');

        // // Функция для удаления класса 'active' у всех пунктов меню, заголовков и контентных блоков
        // function removeActiveClasses() {
        //     // Удаляем 'active' у пунктов меню
        //     menuItems.forEach(item => item.classList.remove('active'));

        //     // Удаляем 'active' у всех heads-*
        //     const allHeads = document.querySelectorAll('.heads-about, .heads-lk, .heads-contacts, .heads-promo');
        //     allHeads.forEach(head => head.classList.remove('active'));

        //     // Удаляем 'active' у контентных блоков
        //     const contentBlocks = document.querySelectorAll('.content-block');
        //     contentBlocks.forEach(block => block.classList.remove('active'));
        // }

        // // Функция для добавления класса 'active' выбранному пункту меню, соответствующему заголовку и контентному блоку
        // function setActive(itemClass) {
        //     // Активируем соответствующий заголовок: заменим 'item-' на 'heads-'
        //     const headsClass = itemClass.replace('item-', 'heads-');
        //     const headsElement = document.querySelector('.' + headsClass);
        //     if (headsElement) {
        //         headsElement.classList.add('active');
        //     }

        //     // Активируем соответствующий контентный блок: заменим 'item-' на 'content-'
        //     const contentClass = itemClass.replace('item-', 'content-');
        //     const selectedContent = document.querySelector(`.${contentClass}`);
        //     if (selectedContent) {
        //         selectedContent.classList.add('active');
        //     }

        //     // Подсвечиваем сам пункт меню
        //     const selectedItem = document.querySelector(`.${itemClass}`);
        //     if (selectedItem) {
        //         selectedItem.classList.add('active');
        //     }
        // }

        // // Добавляем обработчик события клика на каждый пункт меню
        // menuItems.forEach(item => {
        //     item.addEventListener('click', function(event) {
        //         const classes = this.className.split(' ');
        //         const itemClass = classes.find(cls => cls.startsWith('item-'));

        //         if (itemClass) {
        //             event.preventDefault();
        //             removeActiveClasses();
        //             setActive(itemClass);
        //         }
        //     });
        // });

        // // Обработчик для additionalButton (при наличии)
        // if (additionalButton) {
        //     additionalButton.addEventListener('click', function() {
        //         removeActiveClasses();
        //         setActive('item-lk');
        //     });
        // }

        // // Обработчики для кнопок "Комментарии" и "FAQ" (при наличии)
        // if (scrollCommentsButton) {
        //     scrollCommentsButton.addEventListener('click', function() {
        //         activateFirstMenuItem();
        //         scrollToSection('comments');
        //     });
        // }

        // if (scrollFaqButton) {
        //     scrollFaqButton.addEventListener('click', function() {
        //         activateFirstMenuItem();
        //         scrollToSection('faq');
        //     });
        // }

        // // Вспомогательная функция для активации первого пункта меню и контентного блока
        // function activateFirstMenuItem() {
        //     const firstMenuItem = menuItems[0];
        //     if (firstMenuItem) {
        //         const classes = firstMenuItem.className.split(' ');
        //         const firstItemClass = classes.find(cls => cls.startsWith('item-'));
        //         if (firstItemClass) {
        //             removeActiveClasses();
        //             setActive(firstItemClass);
        //         }
        //     }
        // }

        // // Вспомогательная функция для прокрутки до заданного раздела с учётом фиксированного хедера
        // function scrollToSection(sectionId) {
        //     const targetSection = document.getElementById(sectionId);
        //     if (targetSection) {
        //         targetSection.scrollIntoView({
        //             behavior: 'smooth',
        //             block: 'start'
        //         });
        //     }
        // }

        // Логика для кнопок "Открыть/Закрыть" внутри .content-promo .items .item
        // const items = document.querySelectorAll('.content-promo .items .item');

        // items.forEach(function(item) {
        //     const openBtn = item.querySelector('.open');
        //     const closeBtn = item.querySelector('.close');
        //     const textBlock = item.querySelector('.text');

        //     if (openBtn && closeBtn && textBlock) {
        //         openBtn.addEventListener('click', function() {
        //             openBtn.classList.remove('active');
        //             closeBtn.classList.add('active');
        //             textBlock.classList.add('active');
        //         });

        //         closeBtn.addEventListener('click', function() {
        //             closeBtn.classList.remove('active');
        //             textBlock.classList.remove('active');
        //             openBtn.classList.add('active');
        //         });
        //     }
        // });
    });
</script>



<?php get_footer(); ?>