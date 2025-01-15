<?php
/*
 * Template Name: Zaimy Контакты
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

// Получаем ID текущей записи
$current_post_id = get_the_ID();

// Получаем ID родительской записи
$parent_id = wp_get_post_parent_id($current_post_id);

$apply_now = get_field('apply_now_select_products', $parent_id);

$data_source_id = $parent_id ? $parent_id : $current_post_id;

$bank_id = get_field('bank_id', $data_source_id);

$parent_title = get_the_title($parent_id);

$block_about_bank = get_field('block_about_bank', $data_source_id);

$acf_source_id = $parent_id;

?>



<?php // get_template_part('all_template/popap_apply_now', null, ['DATA' => $apply_now]); 
?>


<main class="zaimy-new">
    <!-- page head -->
    <div class="container">
        <nav aria-label="breadcrumb" class="horizontal__scroll">
            <ol class="breadcrumb horizontal__scroll-container">
                <!-- Главная -->
                <li class="breadcrumb-item">
                    <a href="<?php echo esc_url(home_url()); ?>">Главная</a>
                </li>

                <!-- Архив Займов -->
                <li class="breadcrumb-item">
                    <a href="<?php echo esc_url(get_post_type_archive_link('zaimy')); ?>">Займы</a>
                </li>

                <?php


                // Если родительская запись существует, добавляем её в хлебные крошки
                if ($parent_id) :
                    $parent_post = get_post($parent_id);
                    $parent_title = get_the_title($parent_post);
                    $parent_permalink = get_permalink($parent_post);
                ?>
                    <!-- Родительская Страница -->
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url($parent_permalink); ?>"><?php echo esc_html($parent_title); ?></a>
                    </li>
                <?php endif; ?>

                <!-- Текущая Страница -->
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo esc_html(get_the_title()); ?>
                </li>
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
            <h1 class="credits__view-title mb-1 mb-xl-4 heads-lk active">Контакты <?php echo $parent_title ?></h1>

            <div class="credits__view-mob-description">
                <?php echo the_field('product_text_desc_mob', $parent_id) ?>
            </div>

            <div class="row">
                <div class="col-12 col-md-9 col-lg-8 order-md-1">

                    <div class="credits__view-meta d-flex flex-wrap flex-xl-nowrap align-items-center">
                        <div class="credits__view-bank mt-3 mt-xl-0 mr-3">
                            <?php echo esc_html(get_field('z_organization_name', $data_source_id)); ?>
                        </div>
                        <div class="rating d-flex align-items-center mt-3 mt-xl-n1 mr-3">
                            <?php
                            // Проверяем, существует ли функция [ratings]
                            if (function_exists('do_shortcode')) {
                                echo do_shortcode('[ratings id="' . esc_attr($data_source_id) . '"]');
                            }
                            ?>
                        </div>
                        <div class="d-flex align-items-center mt-3 mt-xl-0">
                            <div class="card__icon d-flex align-items-center mr-3">
                                <div class="mr-2">
                                    <svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#eye" x="0" y="0"></use>
                                    </svg>
                                </div>
                                <?php echo esc_html(get_post_meta($data_source_id, 'views', true)); ?>
                            </div>
                            <div class="card__icon d-flex align-items-center mr-3">
                                <div class="mr-2">
                                    <a href="#comments" data-target="comments" class="btn-scroll">
                                        <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                            <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                        </svg>
                                    </a>
                                </div>
                                <?php echo esc_html(get_comments_number($current_post_id)); ?>
                            </div>

                            <div class="card__like d-flex align-items-center mr-3">
                                <?php
                                // Исправляем синтаксис шорткода и используем $data_source_id
                                echo do_shortcode('[wp_ulike for="post" id="' . esc_attr($data_source_id) . '" button_type="image" style="wpulike-heart"]');
                                ?>
                            </div>

                            <div class="card__header card__header-custom">
                                <a class="btn__compare <?php echo esc_attr(my_compare_btn($current_post_id)); ?>" data-id="<?php echo esc_attr($current_post_id); ?>" data-tax="zaimy">
                                    <svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m3.29 19.939.44-.607-.44.607Zm-1.229-1.23.607-.44-.607.44Zm17.878 0-.607-.44.607.44Zm-1.23 1.23-.44-.607.44.607Zm0-17.878-.44.607.44-.607Zm1.23 1.23-.607.44.607-.44ZM3.29 2.06l.44.607-.44-.607Zm-1.229 1.23.607.44-.607-.44Zm14.133 6.598a.75.75 0 1 0-1.5 0h1.5Zm-1.5 6.667a.75.75 0 0 0 1.5 0h-1.5ZM11.75 5.444a.75.75 0 0 0-1.5 0h1.5Zm-1.5 11.112a.75.75 0 0 0 1.5 0h-1.5ZM7.306 12.11a.75.75 0 0 0-1.5 0h1.5Zm-1.5 4.445a.75.75 0 0 0 1.5 0h-1.5ZM11 20.25c-2.1 0-3.615-.001-4.789-.128-1.16-.126-1.9-.368-2.48-.79l-.882 1.214c.88.639 1.913.928 3.2 1.067 1.274.138 2.885.137 4.951.137v-1.5ZM.25 11c0 2.066-.001 3.677.137 4.95.14 1.288.428 2.321 1.067 3.2l1.214-.88c-.422-.582-.664-1.32-.79-2.481-.127-1.174-.128-2.69-.128-4.789H.25Zm3.48 8.332a4.807 4.807 0 0 1-1.062-1.063l-1.214.882c.39.535.86 1.006 1.395 1.395l.882-1.214ZM20.25 11c0 2.1-.001 3.615-.128 4.789-.126 1.16-.368 1.9-.79 2.48l1.214.882c.639-.88.928-1.913 1.067-3.2.138-1.274.137-2.885.137-4.951h-1.5ZM11 21.75c2.066 0 3.677.001 4.95-.137 1.288-.14 2.321-.428 3.2-1.067l-.88-1.214c-.582.422-1.32.664-2.481.79-1.174.127-2.69.128-4.789.128v1.5Zm8.332-3.48a4.808 4.808 0 0 1-1.063 1.062l.882 1.214a6.304 6.304 0 0 0 1.395-1.395l-1.214-.882ZM11 1.75c2.1 0 3.615.001 4.789.128 1.16.126 1.9.368 2.48.79l.882-1.214c-.88-.639-1.913-.927-3.2-1.067C14.677.249 13.066.25 11 .25v1.5ZM21.75 11c0-2.066.001-3.677-.137-4.95-.14-1.288-.428-2.321-1.067-3.2l-1.214.88c.422.582.664 1.32.79 2.481.127 1.174.128 2.69.128 4.789h1.5Zm-3.48-8.332c.407.296.766.655 1.062 1.063l1.214-.882a6.305 6.305 0 0 0-1.395-1.395l-.882 1.214ZM11 .25C8.934.25 7.323.249 6.05.387c-1.288.14-2.321.428-3.2 1.067l.88 1.214c-.582-.422-1.32-.664-2.481-.79C7.385 1.751 8.901 1.75 11 1.75V.25ZM1.75 11c0-2.1.001-3.615.128-4.789.126-1.16.368-1.9.79-2.48l-1.214-.882C.815 3.73.527 4.762.387 6.05.249 7.324.25 8.934.25 11h1.5Zm1.1-9.546A6.306 6.306 0 0 0 1.453 2.85l1.214.882A4.805 4.805 0 0 1 3.73 2.668l-.882-1.214ZM14.693 9.89v6.667h1.5V9.889h-1.5ZM10.25 5.444v11.112h1.5V5.444h-1.5Zm-4.444 6.667v4.445h1.5V12.11h-1.5Z"></path>
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
                                    <div class="field__content-num"><?php echo the_field('z_sum', $parent_id) ?> ₽</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="credits__view-field field d-flex mt-3">
                                <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__fire.png" alt="% ставка"></div>
                                <div class="field__content">
                                    <div class="field__content-title">% ставка</div>
                                    <div class="field__content-num">От <?php echo the_field('z_stavka', $parent_id) ?>%</div>
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
                                            $z_oldness = get_field('z_oldness', $parent_id);
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
                                        <?php $card_period = get_field('z_history', $parent_id);
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
                                    <div class="field__content-num">до <?php echo the_field('z_time', $parent_id) ?> дней
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="credits__view-field field d-flex mt-3">
                                <div class="field__img mr-2"><img src="<?php bloginfo('template_url'); ?>/img/icon__decision.png" alt="Решение"></div>
                                <div class="field__content">
                                    <div class="field__content-title">Решение</div>
                                    <div class="field__content-num"><?php echo the_field('z_answer', $parent_id) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-4 order-md-2">
                    <div class="credits__view-img">
                        <img src="<?php echo the_field('card_logo', $parent_id) ?>" alt="<?php echo $parent_title ?>">
                        <div class="credits__view-buttons d-flex justify-content-center py-3 py-sm-4">
                            <?php //if(get_field('card_bank_link', $parent_id)):
                            ?>
                            <?php if (reclink($ID)): ?>
                                <a href="<?php echo the_field('card_bank_link', $parent_id) ?>" target="_blank" class="btn btn-primary mx-3"
                                    onclick="<?php get_metrika_for_detail_page(get_field('card_bank_link', $parent_id)) ?> return true;">Оформить сейчас</a>
                            <?php else: ?>
                                <a href="#" class="btn btn-primary mx-3 <?php if ($apply_now) { ?> apply_now_btm <?php } else { ?>out_exit_link<?php } ?>"
                                    onclick="<?php get_metrika_for_detail_page(get_field('card_bank_link', $parent_id)) ?> return false;">Оформить сейчас</a>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>

                <?php $date_actually = get_the_modified_date('d.m.Y', $parent_id); ?>
                <?php if ($date_actually): ?>

                    <div class="date_actually date_actually-single-kredity">Обновлено1: <?php $date_actually ?></div>

                <?php endif; ?>

            </div>
        </div>
        <!-- / card info -->

        <!-- similar -->
        <?php
        $featured_posts = get_field('related_products', $parent_id);

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
                                    <li><a href="<?php echo esc_url($parent_permalink); ?>" class="item-about ">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 17H16M11.0177 2.764L4.23539 8.03912C3.78202 8.39175 3.55534 8.56806 3.39203 8.78886C3.24737 8.98444 3.1396 9.20478 3.07403 9.43905C3 9.70352 3 9.9907 3 10.5651V17.8C3 18.9201 3 19.4801 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4801 21 18.9201 21 17.8V10.5651C21 9.9907 21 9.70352 20.926 9.43905C20.8604 9.20478 20.7526 8.98444 20.608 8.78886C20.4447 8.56806 20.218 8.39175 19.7646 8.03913L12.9823 2.764C12.631 2.49075 12.4553 2.35412 12.2613 2.3016C12.0902 2.25526 11.9098 2.25526 11.7387 2.3016C11.5447 2.35412 11.369 2.49075 11.0177 2.764Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Об МФО</a>
                                    </li>
                                    <li>
                                        
                                        <a href="<?php echo esc_url($parent_permalink); ?>goryachaya-liniya/">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.38028 8.85323C9.07627 10.3028 10.0251 11.6615 11.2266 12.8631C12.4282 14.0646 13.7869 15.0134 15.2365 15.7094C15.3612 15.7693 15.4235 15.7992 15.5024 15.8222C15.7828 15.904 16.127 15.8453 16.3644 15.6752C16.4313 15.6274 16.4884 15.5702 16.6027 15.4559C16.9523 15.1063 17.1271 14.9315 17.3029 14.8172C17.9658 14.3862 18.8204 14.3862 19.4833 14.8172C19.6591 14.9315 19.8339 15.1063 20.1835 15.4559L20.3783 15.6508C20.9098 16.1822 21.1755 16.448 21.3198 16.7333C21.6069 17.3009 21.6069 17.9712 21.3198 18.5387C21.1755 18.8241 20.9098 19.0898 20.3783 19.6213L20.2207 19.7789C19.6911 20.3085 19.4263 20.5733 19.0662 20.7756C18.6667 21 18.0462 21.1614 17.588 21.16C17.1751 21.1588 16.8928 21.0787 16.3284 20.9185C13.295 20.0575 10.4326 18.433 8.04466 16.045C5.65668 13.6571 4.03221 10.7947 3.17124 7.76131C3.01103 7.19687 2.93092 6.91464 2.9297 6.5017C2.92833 6.04347 3.08969 5.42298 3.31411 5.02348C3.51636 4.66345 3.78117 4.39863 4.3108 3.86901L4.46843 3.71138C4.99987 3.17993 5.2656 2.91421 5.55098 2.76987C6.11854 2.4828 6.7888 2.4828 7.35636 2.76987C7.64174 2.91421 7.90747 3.17993 8.43891 3.71138L8.63378 3.90625C8.98338 4.25585 9.15819 4.43065 9.27247 4.60643C9.70347 5.26932 9.70347 6.1239 9.27247 6.78679C9.15819 6.96257 8.98338 7.13738 8.63378 7.48698C8.51947 7.60129 8.46231 7.65845 8.41447 7.72526C8.24446 7.96269 8.18576 8.30695 8.26748 8.5873C8.29048 8.6662 8.32041 8.72854 8.38028 8.85323Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Горячая линия</a>
                                    </li>
                                    <?php
                                    // Получаем ID текущей страницы
                                    $current_page_id = get_the_ID();

                                    // Определяем ID родительской страницы
                                    $parent_page_id = wp_get_post_parent_id($current_page_id);

                                    // Если текущая страница не имеет родителя, считаем её родительской
                                    if (!$parent_page_id) {
                                        $parent_page_id = $current_page_id;
                                    }

                                    // Проверяем наличие дочерней страницы с slug 'lichnyy-kabinet' у родительской страницы
                                    $children = get_children(array(
                                        'post_parent' => $parent_page_id,
                                        'post_type'   => 'zaimy',
                                        'name'        => 'lichnyy-kabinet',
                                        'numberposts' => 1, // Ограничиваем до одной записи для производительности
                                    ));

                                    if (!empty($children)) {
                                        // Получаем первую (и единственную) дочернюю страницу
                                        $child = array_shift($children);
                                        // Получаем ссылку на дочернюю страницу
                                        $child_permalink = get_permalink($child);
                                    ?>
                                        <li>
                                            <a href="<?php echo esc_url($child_permalink); ?>" class="item-lk">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 20C5.33579 17.5226 8.50702 16 12 16C15.493 16 18.6642 17.5226 21 20M16.5 7.5C16.5 9.98528 14.4853 12 12 12C9.51472 12 7.5 9.98528 7.5 7.5C7.5 5.01472 9.51472 3 12 3C14.4853 3 16.5 5.01472 16.5 7.5Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                Личный кабинет
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>

                                    <li>
                                        <a href="<?php echo esc_url($parent_permalink); ?>#faq">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.09 9C9.3251 8.33167 9.78915 7.76811 10.4 7.40913C11.0108 7.05016 11.7289 6.91894 12.4272 7.03871C13.1255 7.15849 13.7588 7.52152 14.2151 8.06353C14.6713 8.60553 14.9211 9.29152 14.92 10C14.92 12 11.92 13 11.92 13M12 17H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Вопросы</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url($parent_permalink); ?>#comments">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 8.5H12M7 12H15M9.68375 18H16.2C17.8802 18 18.7202 18 19.362 17.673C19.9265 17.3854 20.3854 16.9265 20.673 16.362C21 15.7202 21 14.8802 21 13.2V7.8C21 6.11984 21 5.27976 20.673 4.63803C20.3854 4.07354 19.9265 3.6146 19.362 3.32698C18.7202 3 17.8802 3 16.2 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V20.3355C3 20.8684 3 21.1348 3.10923 21.2716C3.20422 21.3906 3.34827 21.4599 3.50054 21.4597C3.67563 21.4595 3.88367 21.2931 4.29976 20.9602L6.68521 19.0518C7.17252 18.662 7.41617 18.4671 7.68749 18.3285C7.9282 18.2055 8.18443 18.1156 8.44921 18.0613C8.74767 18 9.0597 18 9.68375 18Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Отзывы</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url($parent_permalink); ?>kontakty/" class="item-contacts active">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 2.26946V6.4C14 6.96005 14 7.24008 14.109 7.45399C14.2049 7.64215 14.3578 7.79513 14.546 7.89101C14.7599 8 15.0399 8 15.6 8H19.7305M20 9.98822V17.2C20 18.8802 20 19.7202 19.673 20.362C19.3854 20.9265 18.9265 21.3854 18.362 21.673C17.7202 22 16.8802 22 15.2 22H8.8C7.11984 22 6.27976 22 5.63803 21.673C5.07354 21.3854 4.6146 20.9265 4.32698 20.362C4 19.7202 4 18.8802 4 17.2V6.8C4 5.11984 4 4.27976 4.32698 3.63803C4.6146 3.07354 5.07354 2.6146 5.63803 2.32698C6.27976 2 7.11984 2 8.8 2H12.0118C12.7455 2 13.1124 2 13.4577 2.08289C13.7638 2.15638 14.0564 2.27759 14.3249 2.44208C14.6276 2.6276 14.887 2.88703 15.4059 3.40589L18.5941 6.59411C19.113 7.11297 19.3724 7.3724 19.5579 7.67515C19.7224 7.94356 19.8436 8.2362 19.9171 8.5423C20 8.88757 20 9.25445 20 9.98822Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Контакты</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url($parent_permalink); ?>promokody-skidki/" class="item-promo">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 8V7M8 12.5V11.5M8 17V16M6.8 20H17.2C18.8802 20 19.7202 20 20.362 19.673C20.9265 19.3854 21.3854 18.9265 21.673 18.362C22 17.7202 22 16.8802 22 15.2V8.8C22 7.11984 22 6.27976 21.673 5.63803C21.3854 5.07354 20.9265 4.6146 20.362 4.32698C19.7202 4 18.8802 4 17.2 4H6.8C5.11984 4 4.27976 4 3.63803 4.32698C3.07354 4.6146 2.6146 5.07354 2.32698 5.63803C2 6.27976 2 7.11984 2 8.8V15.2C2 16.8802 2 17.7202 2.32698 18.362C2.6146 18.9265 3.07354 19.3854 3.63803 19.673C4.27976 20 5.11984 20 6.8 20Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Промокоды, скидки</a>
                                    </li>
                                    <!-- <li>
                                        <a href="/blog/">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 9.25H15M21 4H3M21 14.75H15M21 20H3M4.6 16H9.4C9.96005 16 10.2401 16 10.454 15.891C10.6422 15.7951 10.7951 15.6422 10.891 15.454C11 15.2401 11 14.9601 11 14.4V9.6C11 9.03995 11 8.75992 10.891 8.54601C10.7951 8.35785 10.6422 8.20487 10.454 8.10899C10.2401 8 9.96005 8 9.4 8H4.6C4.03995 8 3.75992 8 3.54601 8.10899C3.35785 8.20487 3.20487 8.35785 3.10899 8.54601C3 8.75992 3 9.03995 3 9.6V14.4C3 14.9601 3 15.2401 3.10899 15.454C3.20487 15.6422 3.35785 15.7951 3.54601 15.891C3.75992 16 4.03995 16 4.6 16Z" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Новости и статьи</a>
                                    </li> -->
                                    <li>
                                        <a href="#best-offers">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 17C8.41015 17 5.5 14.0899 5.5 10.5V4.55556C5.5 4.03739 5.5 3.77831 5.59369 3.57738C5.69305 3.36431 5.86431 3.19305 6.07738 3.09369C6.27831 3 6.53739 3 7.05556 3H16.9444C17.4626 3 17.7217 3 17.9226 3.09369C18.1357 3.19305 18.3069 3.36431 18.4063 3.57738C18.5 3.77831 18.5 4.03739 18.5 4.55556V10.5C18.5 14.0899 15.5899 17 12 17ZM12 17V21M17 21H7M22 5V10M2 5V10" stroke="#1B2636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>Лучшие предложения</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- sidebar -->
                        <div class="sidebar mb-4">
                            <div class="sidebar__header sidebar__section p-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bank__item-img mr-3">
                                        <?php
                                        // Получаем URL изображения и alt-текст
                                        $logo_url = get_field('z_organization_logo', $data_source_id);
                                        $logo_id = get_field('z_organization_logo', $data_source_id, false);
                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                        ?>
                                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>">
                                    </div>
                                    <div class="bank__item-content">
                                        <div class="card__header-title mt-1 mb-2">
                                            <?php echo esc_html(get_field('z_organization_name', $data_source_id)); ?>
                                        </div>
                                        <div class="card__header-info d-flex align-items-center">
                                            <div class="card__rating d-flex align-items-center mr-3">
                                                <div class="mr-2">
                                                    <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                <?php echo esc_html(get_field('ratings_average', $data_source_id)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 sidebar__container">
                                        <!-- Организация -->
                                        <div class="sidebar__field mb-3">
                                            <div class="sidebar__field-title">Организация</div>
                                            <div class="sidebar__field-content">
                                                <?php echo esc_html(get_field('z_organization_name', $data_source_id)); ?>
                                            </div>
                                        </div>

                                        <!-- Телефон -->
                                        <?php if (get_field('z_organization_phone', $data_source_id)): ?>
                                            <div class="sidebar__field mb-3">
                                                <div class="sidebar__field-title">Телефон</div>
                                                <div class="sidebar__field-content">
                                                    <?php
                                                    // Получаем значение телефона
                                                    $phone = get_field('z_organization_phone', $data_source_id);
                                                    // Удаляем все символы, кроме цифр
                                                    $cleaned_phone = preg_replace('![^0-9]+!', '', $phone);
                                                    ?>
                                                    <a href="tel:<?php echo esc_attr($cleaned_phone); ?>">
                                                        <?php echo esc_html($phone); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Официальный сайт -->
                                        <div class="sidebar__field mb-3">
                                            <div class="sidebar__field-title">Официальный сайт</div>
                                            <div class="sidebar__field-content">
                                                <?php
                                                $bank_link = get_field('card_bank_link', $data_source_id);
                                                $organization_site = get_field('z_organization_site', $data_source_id);
                                                ?>
                                                <?php if (reclink($current_post_id)): ?>
                                                    <a href="<?php echo esc_url($bank_link); ?>" target="_blank"
                                                        onclick="<?php echo esc_js(get_metrika_for_detail_page($bank_link)); ?> return true;"
                                                        class="off_site_link">
                                                        <?php echo esc_html($organization_site); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="#" class="off_site_link <?php echo ($apply_now) ? 'apply_now_btm' : 'out_exit_link'; ?>"
                                                        onclick="<?php echo esc_js(get_metrika_for_detail_page($bank_link)); ?> return false;">
                                                        <?php echo esc_html($organization_site); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Электронная почта -->
                                        <?php if (get_field('z_organization_email', $data_source_id)): ?>
                                            <div class="sidebar__field mb-3">
                                                <div class="sidebar__field-title">Электронная почта</div>
                                                <div class="sidebar__field-content">
                                                    <?php
                                                    // Получаем значение электронной почты
                                                    $email = get_field('z_organization_email', $data_source_id);
                                                    ?>
                                                    <a href="mailto:<?php echo esc_attr($email); ?>">
                                                        <?php echo esc_html($email); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Дата обновления -->
                                        <?php
                                        $date_actually = get_the_modified_date('d.m.Y', $data_source_id);
                                        if ($date_actually):
                                        ?>
                                            <div class="text-left date_actually">Обновлено: <?php echo esc_html($date_actually); ?></div>
                                        <?php endif; ?>

                                        <!-- Кнопка Оформить сейчас -->
                                        <div class="wm-fixed-button sidebar__field mb-3">
                                            <?php if (reclink($current_post_id)): ?>
                                                <a href="<?php echo esc_url($bank_link); ?>" target="_blank"
                                                    onclick="<?php echo esc_js(get_metrika_for_detail_page($bank_link)); ?> return true;"
                                                    class="btn btn-primary">
                                                    Оформить сейчас
                                                </a>
                                            <?php else: ?>
                                                <a href="#" class="btn btn-primary <?php echo ($apply_now) ? 'apply_now_btm' : 'out_exit_link'; ?>"
                                                    onclick="<?php echo esc_js(get_metrika_for_detail_page($bank_link)); ?> return true;">
                                                    Оформить сейчас
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <?php if ($block_about_bank): ?>
                                <div class="sidebar__section h3 text-center py-3">
                                    <?php
                                    // Получаем название поля и его метку
                                    $block_about_bank_label = get_field_object('block_about_bank', $data_source_id)['label'];
                                    echo esc_html($block_about_bank_label);
                                    ?>
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
                                    $args_credit = array_merge($main_args, $custom_args);
                                    $args_debet = array_merge($main_args, $custom_args2);

                                    // Запросы
                                    $count_cred = count(get_posts($args_credit));
                                    $count_debet = count(get_posts($args_debet));
                                    ?>

                                    <?php foreach ($block_about_bank as $item): ?>
                                        <?php if ($item['name'] === 'Кредитные карты'): ?>
                                            <a href="<?php echo esc_url($item['value']); ?>" class="sidebar__links-item">
                                                <?php echo esc_html($item['name']); ?> (<?php echo esc_html($count_cred); ?>)
                                            </a>
                                        <?php elseif ($item['name'] === 'Дебетовые карты'): ?>
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
                        <!-- /sidebar -->

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

                <div id="content-contacts" class="content-block content-contacts col-12 col-md-9 col-lg-8 order-md-1 active">

                    <div class="section">
                        <div class="content-contacts__head block-bg p-4">
                            <div class="sidebar__header sidebar__section mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="bank__item-img mr-3">
                                        <?php
                                        // Получаем URL изображения и alt-текст из родительской страницы
                                        $logo_url = get_field('z_organization_logo', $acf_source_id);
                                        $logo_id = get_field('z_organization_logo', $acf_source_id, false);
                                        $logo_alt = $logo_id ? get_post_meta($logo_id, '_wp_attachment_image_alt', true) : '';
                                        ?>
                                        <?php if ($logo_url): ?>
                                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/default-logo.png'); ?>" alt="Логотип">
                                        <?php endif; ?>
                                    </div>
                                    <div class="bank__item-content">
                                        <div class="card__header-title mt-1 mb-2">
                                            <?php echo esc_html(get_field('z_organization_name', $acf_source_id)); ?>
                                        </div>
                                        <div class="card__header-info d-flex align-items-center">
                                            <div class="card__rating d-flex align-items-center mr-3">
                                                <div class="mr-2">
                                                    <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                <?php echo esc_html(get_field('ratings_average', $acf_source_id)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="title mb-4"><?php echo $parent_title ?> реквизиты и контакты</h2>
                            <div class="text mb-4">
                                <?php echo (get_field('about_contacts', $acf_source_id)); ?>
                            </div>
                            <div class="cc-row">
                                <div class="credits__view-field field d-flex">
                                    <div class="field__img mr-2">
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon__speed.png'); ?>" alt="Сумма займа">
                                    </div>
                                    <div class="field__content">
                                        <div class="field__content-title">Сумма</div>
                                        <div class="field__content-num"><?php echo esc_html(get_field('cc_sum', $acf_source_id)); ?></div>
                                    </div>
                                </div>
                                <div class="credits__view-field field d-flex">
                                    <div class="field__img mr-2">
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon__cashback.png'); ?>" alt="Срок займа">
                                    </div>
                                    <div class="field__content">
                                        <div class="field__content-title">Срок</div>
                                        <div class="field__content-num">до <?php echo esc_html(get_field('cc_srok', $acf_source_id)); ?> дней</div>
                                    </div>
                                </div>
                                <?php if (reclink($acf_source_id)): ?>
                                    <a href="<?php echo esc_url(get_field('card_bank_link', $acf_source_id)); ?>" target="_blank" class="btn btn-primary"
                                        onclick="<?php echo esc_js(get_metrika_for_detail_page(get_field('card_bank_link', $acf_source_id))); ?> return true;">
                                        Перейти на сайт
                                    </a>
                                <?php else: ?>
                                    <a href="#" class="btn btn-primary <?php echo (isset($apply_now) && $apply_now) ? 'apply_now_btm' : 'out_exit_link'; ?>"
                                        onclick="<?php echo esc_js(get_metrika_for_detail_page(get_field('card_bank_link', $acf_source_id))); ?> return false;">
                                        Перейти на сайт
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="block-bg p-4">
                            <div class="section__header d-flex justify-content-between align-items-center">
                                <h2 class="title mb-4"><?php echo $parent_title ?> реквизиты</h2>
                            </div>
                            <div class="content-contacts__wrapper">
                                <?php if (have_rows('tab_details', $acf_source_id)): ?>
                                    <?php while (have_rows('tab_details', $acf_source_id)): the_row(); ?>
                                        <?php
                                        $title = get_sub_field('title');
                                        $text = get_sub_field('text');
                                        ?>
                                        <div class="item">
                                            <div class="title"><?php echo esc_html($title); ?></div>
                                            <div class="text"><?php echo esc_html($text); ?></div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ accordion -->
                    <?php if (have_rows('product_faq', $acf_source_id)): ?>
                        <?php $counter_about = 0; // Инициализация переменной 
                        ?>
                        <div id="faq2" class="section">
                            <div class="section__header d-flex justify-content-between align-items-center">
                                <h2 class="title mb-4">Часто задаваемые вопросы</h2>
                            </div>

                            <div class="accordion mb-4" id="accordion">
                                <?php while (have_rows('product_faq', $acf_source_id)): the_row();
                                    $question = get_sub_field('question');
                                    $answer = get_sub_field('answer');
                                    $counter_about += 1;
                                ?>
                                    <div class="accordion__item">
                                        <div class="accordion__header">
                                            <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse__item-<?php echo esc_attr($counter_about); ?>" aria-expanded="false">
                                                <?php echo esc_html($question); ?>
                                                <div class="accordion__button-icon">
                                                    <svg width="12" height="6" viewBox="0 0 12 6">
                                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                        <div id="collapse__item-<?php echo esc_attr($counter_about); ?>" class="accordion__collapse collapse" data-bs-parent="#accordion">
                                            <div class="accordion__body wysiwyg">
                                                <p><?php echo esc_html($answer); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- /FAQ accordion -->

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
                                                        <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo $parent_title ?></a></div>
                                                    </div>



                                                    <ul class="leaders">
                                                        <div class="bank__item-footer text-center  pb-2 mx-n2 mt-2">
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
                                                        <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo $parent_title ?></a></div>
                                                    </div>


                                                    <ul class="leaders">
                                                        <div class="bank__item-footer text-center pb-2 mx-n2 mt-2">
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
                                                        <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo $parent_title ?></a></div>
                                                    </div>


                                                    <ul class="leaders">
                                                        <div class="bank__item-footer text-center pb-2 mx-n2 mt-2">
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
                                                        <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo $parent_title ?></a></div>
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
                                                        <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo $parent_title ?></a></div>
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

                    <!-- Главная -->
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url(home_url()); ?>">Главная</a>
                    </li>

                    <!-- Архив Займов -->
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url(get_post_type_archive_link('zaimy')); ?>">Займы</a>
                    </li>

                    <?php


                    // Если родительская запись существует, добавляем её в хлебные крошки
                    if ($parent_id) :
                        $parent_post = get_post($parent_id);
                        $parent_title = get_the_title($parent_post);
                        $parent_permalink = get_permalink($parent_post);
                    ?>
                        <!-- Родительская Страница -->
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url($parent_permalink); ?>"><?php echo esc_html($parent_title); ?></a>
                        </li>
                    <?php endif; ?>

                    <!-- Текущая Страница -->
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo esc_html(get_the_title()); ?>
                    </li>
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




<?php get_footer(); ?>