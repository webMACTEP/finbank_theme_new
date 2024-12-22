<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$items_args = array(
    'paged' => $paged,
    'orderby' => 'name',
    'order' => 'DESC',
    'post_type' => 'zaimy',
    'post_status' => 'publish',
);
$items_args['meta_query'][] = array(
    'key' => 'archive',
    'value' => '0'
);

//$query_items = new WP_Query( $items_args );
//if ( !$query_items->have_posts() ) {
//    global $wp_query;
//    $url_clear = get_clear_url($_SERVER['REQUEST_URI']);
//    wp_redirect( $url_clear, 301 );
//    //$wp_query->set_404();
//    //status_header( 404 );
//    //nocache_headers();
//    //require get_404_template();
//}

if($_REQUEST['change_template']){
    get_template_part( 'template-parts/new-collection-kredity' );
}else {
    ?>

    <?php get_header() ?>

    <?php //$term = get_queried_object();
    //$ID = get_queried_object()->ID;
    $z_sum = 0;
    $z_time = 0;
    //$z_sum = 15000;
    //$z_time = 24;
    if(isset($_SESSION['filter_zaimy']) && !empty($_SESSION['filter_zaimy'])):
    $mt = 1;
    $z_sum = $_SESSION['filter_zaimy'][0];
    $z_time = $_SESSION['filter_zaimy'][1];
    endif;
    unset($_SESSION['filter_zaimy']);

    ?>

    <?php if($mt): ?>
        <div class="start-func-credit-card-filter"></div>
    <?php endif; ?>

    <main term="zaimy">
        <div class="container">
            <nav aria-label="breadcrumb" class="horizontal__scroll">
                <ol class="breadcrumb horizontal__scroll-container">
                    <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Займы</li>
                </ol>
            </nav>
        </div>
        <div class="page__heading">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="page__heading-title mb-0">Займы</h1>
                                    <?php $args = array(
                            'post_type'             => 'zaimy',
                            'posts_per_page'        => -1,
                            'orderby' => 'date',
                            'order' => 'ASC',
                        );

    $query = new WP_Query( $args );

    // Цикл
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $date = get_the_date('d.m.y');
            ?>
         <?php } } wp_reset_query() ?>
                    <div class="page__heading-date">Обновлено: <?php echo $date ?></div>
                </div>
                <div class="page__heading-description mt-2 mb-4">
                    В данном разделе вы можете оформить займ по вашим финансовым возможностям
                </div>

                <form id="credit-card-filter" action="" method="POST">
                    <input type="hidden" name="action" value="cardfilter" />
                    <input type="hidden" name="term" value="zaimy" />
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3 col-xl-4 order-1">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Сумма, ₽</div>
                                    <input type="text" class="range__value cred_limit" max="<?= $filter_price['zaimy_inputs_range']['max']; ?>"  value="<?php echo $z_sum ?>">
                                </div>
                                <input class="range__input" name="z_sum" type="range" max="<?= $filter_price['zaimy_inputs_range']['max']; ?>" value="<?php echo $z_sum ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 col-xl-4 order-2">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Срок, дней</div>
                                    <input type="text" class="range__value cred_trat" max="<?= $filter_price['zaimy_inputs_range']['day_max']; ?>" value="<?php echo $z_time ?>">
                                </div>
                                <input class="range__input" name="z_time" type="range" max="<?= $filter_price['zaimy_inputs_range']['day_max']; ?>" value="<?php echo $z_time ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 col-xl-2 mt-lg-0 order-5 order-md-3">
                            <div class="btn btn-primary btn-block submit-button">Показать</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--div class="container">
            <div class="section">
                <div class="tags__main my-5 horizontal__scroll">
                    <div class="horizontal__scroll-container">
                        <a href="" class="tag__item"><span class="tag__item-title">Все карты</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Для наличных</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">кэшбэк</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Мили</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">кэшбэк</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Для наличных</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Все карты</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Мили</span></a>
                        <a href="" class="tag__item btn__view-all"><span class="tag__item-title">ещё +</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Все карты</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Для наличных</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">кэшбэк</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Мили</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">кэшбэк</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Для наличных</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Все карты</span></a>
                        <a href="" class="tag__item"><span class="tag__item-title">Мили</span></a>
                    </div>
                </div>
                <div class="solution__links text-center">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <a href="" class="tag__item tag__item-link d-flex align-items-center">
                                <span class="tag__item-img mr-3">
                                    <img src="<?php bloginfo('template_url'); ?>/img/solution__img-1.png" alt="">
                                </span>
                                <span class="tag__item-title">Топ 5 ипотек с минимальной переплатой</span>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <a href="" class="tag__item tag__item-link d-flex align-items-center">
                                <span class="tag__item-img mr-3">
                                    <img src="<?php bloginfo('template_url'); ?>/img/solution__img-3.png" alt="">
                                </span>
                                <span class="tag__item-title">Топ 20 лучших кредитных карт</span>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <a href="" class="tag__item tag__item-link d-flex align-items-center">
                                <span class="tag__item-img mr-3">
                                    <img src="<?php bloginfo('template_url'); ?>/img/solution__img-4.png" alt="">
                                </span>
                                <span class="tag__item-title">5 Дебетовых карт с лучшим процентом на остаток</span>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <a href="" class="tag__item tag__item-link d-flex align-items-center">
                                <span class="tag__item-img mr-3">
                                    <img src="<?php bloginfo('template_url'); ?>/img/solution__img-2.png" alt="">
                                </span>
                                <span class="tag__item-title">Топ 7 банков свыгодным процентом по вкладам</span>
                            </a>
                        </div>
                    </div>
                    <a href="" class="btn btn-outline-alternative btn__view-all mt-3">
                        Больше готовы решений
                    </a>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <a href="" class="tag__item tag__item-link d-flex align-items-center">
                                <span class="tag__item-img mr-3">
                                    <img src="<?php bloginfo('template_url'); ?>/img/solution__img-1.png" alt="">
                                </span>
                                <span class="tag__item-title">Топ 5 ипотек с минимальной переплатой</span>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <a href="" class="tag__item tag__item-link d-flex align-items-center">
                                <span class="tag__item-img mr-3">
                                    <img src="<?php bloginfo('template_url'); ?>/img/solution__img-3.png" alt="">
                                </span>
                                <span class="tag__item-title">Топ 20 лучших кредитных карт</span>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <a href="" class="tag__item tag__item-link d-flex align-items-center">
                                <span class="tag__item-img mr-3">
                                    <img src="<?php bloginfo('template_url'); ?>/img/solution__img-4.png" alt="">
                                </span>
                                <span class="tag__item-title">5 Дебетовых карт с лучшим процентом на остаток</span>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <a href="" class="tag__item tag__item-link d-flex align-items-center">
                                <span class="tag__item-img mr-3">
                                    <img src="<?php bloginfo('template_url'); ?>/img/solution__img-2.png" alt="">
                                </span>
                                <span class="tag__item-title">Топ 7 банков свыгодным процентом по вкладам</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div-->
        <!-- page navigation -->
        <div class="page__nav">
            <div class="container">
                <div class="page__nav-container nav-tabs">
                    <div class="horizontal__scroll">
                        <div class="horizontal__scroll-container">
                            <a href="<?php echo get_post_type_archive_link('zaimy') ?>" class="nav-link active">Все займы</a>
                            <a href="<?php echo get_page_link(4975); //1503 tax-reviews?>" class="nav-link " data-tax="zaimy">Отзывы</a>
                            <a href="<?php echo get_page_link(159) ?>" class="nav-link">Калькулятор</a>
                            <a href="<?php echo get_category_link(38) ?>" class="nav-link">Статьи</a>
                            <a href="<?php echo get_page_link(1554) ?>" class="nav-link">сравнить</a>
                            <a href="#best-products" class="nav-link">Лучшие предложения</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / page navigation -->
        <div class="container">
            <!-- credits list -->
            <div class="credits section">
                <div class="row">
                    <!-- filter -->
                    <div class="col-12 col-lg-4 order-lg-2">
                        <div class="sticky-top">
                            <form id="credit-card-filter-aside">
                                <div class="filter mb-3">
                                    <div class="filter__section">
                                        <a class="filter__btn collapsed" data-bs-toggle="collapse" href="#filter1" role="button" aria-expanded="false">
                                            Компания
                                            <div class="filter__btn-icon"><svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg"><path d="M6 6h-.4C4.4 5.8 3.5 5 2 3.5L.3 1.7C-.1 1.3-.1.7.3.3c.4-.4 1-.4 1.4 0l1.7 1.8C4.6 3.2 5.3 3.9 5.8 4h.4c.5-.1 1.2-.8 2.4-1.9L10.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L10 3.5C8.5 5 7.6 5.8 6.4 6H6Z"></path></svg></div>
                                        </a>
                                        <div class="collapse" id="filter1">
                                            <div class="filter__content">
                                                <ul class="filter__list">
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="oz1">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Турбозайм
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="oz2">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Займер
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="oz3">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            E-капуста
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="oz4">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            MoneyMan
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="oz5">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Деньга
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="oz6">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Веб-займ
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter__section">
                                        <a class="filter__btn collapsed" data-bs-toggle="collapse" href="#filter2" role="button" aria-expanded="false">
                                            Способ получения
                                            <div class="filter__btn-icon"><svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg"><path d="M6 6h-.4C4.4 5.8 3.5 5 2 3.5L.3 1.7C-.1 1.3-.1.7.3.3c.4-.4 1-.4 1.4 0l1.7 1.8C4.6 3.2 5.3 3.9 5.8 4h.4c.5-.1 1.2-.8 2.4-1.9L10.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L10 3.5C8.5 5 7.6 5.8 6.4 6H6Z"></path></svg></div>
                                        </a>
                                        <div class="collapse" id="filter2">
                                            <div class="filter__content">
                                                <ul class="filter__list">
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zct1">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            На карту
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zct2">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Наличными
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zct3">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Юмани
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zct4">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            QIWI
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zct5">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Contact
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zct6">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Золотая корона
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zct7">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Банковский счет
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter__section">
                                        <a class="filter__btn collapsed" data-bs-toggle="collapse" href="#filter3" role="button" aria-expanded="false">
                                            Прочие условия
                                            <div class="filter__btn-icon"><svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg"><path d="M6 6h-.4C4.4 5.8 3.5 5 2 3.5L.3 1.7C-.1 1.3-.1.7.3.3c.4-.4 1-.4 1.4 0l1.7 1.8C4.6 3.2 5.3 3.9 5.8 4h.4c.5-.1 1.2-.8 2.4-1.9L10.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L10 3.5C8.5 5 7.6 5.8 6.4 6H6Z"></path></svg></div>
                                        </a>
                                        <div class="collapse" id="filter3">
                                            <div class="filter__content">
                                                <ul class="filter__list">
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zos1">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Под 0% первый займ
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zos2">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Моментальное решение
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zos3">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Без справок о доходах
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zos4">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            С 18 лет
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zos5">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            С любой КИ
                                                        </label>
                                                    </li>
                                                    <li class="filter__list-item">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="zos6">
                                                            <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
                                                            Под залог ПТС
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn btn-outline-primary btn-block submit-button">Применить фильтр</div>
                            </form>

                            <!--div class="filter mt-5 mb-3">
                                <?php
                                $massiv_vhodnih_parametrov = array(
                                'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                'depth' => 0,  // - глубина, уровень вложенности
                                'echo'            => false,
                                'link_class'   => 'filter__btn',
                                'theme_location'  => 'sidebar_menu_zaimy',
                                'before' => '<div class="filter__section" id="collist">',
                                'after' => '</div>',
                                ); ?>
                                <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<a>,' ); ?>
                            </div-->


                        <div class="d-none d-lg-block">
                            <?php
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
                                        'value'     => 'zaimy',
                                        'compare'   => '=',
                                    ),
                                )
                        );
                        $query = new WP_Query( $args_coll );
                        if ( $query->have_posts() ) { $current_id = $wp_query->get_queried_object_id(); ?>
                            <? get_template_part( 'all_template/filter_right', null, ['cat' => $cat, 'query' => $query]); ?>
                        <?php } wp_reset_query(); ?>
                        <?php		}
                            }
                            ?>
                        </div>


                        </div>
                    </div>
                    <!-- / filter -->

    <?php
        $counter = 0;
        if ( $query_items->have_posts() ) {
            $query = $query_items;
            $max_pages = $query->max_num_pages;
            $found_posts = $query->found_posts;

            if ($query->have_posts()) {
                ob_start();
                while ($query->have_posts()):
                    $query->the_post();
                    $counter++;
                    get_template_part('template-parts/filter-zaimy-posts');
                endwhile;

                $posts_html = ob_get_contents();
                ob_end_clean();
            }

        }else{
            $posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
        }

    ?>
    <!-- list -->
    <div class="col-12 col-lg-8 order-lg-1">
        <div class="credits__list">
                <div class="d-flex flex-wrap justify-content-between align-items-center mt-0 mt-md-5 mt-lg-0 mb-3">
                  <div class="h2 mt-5 mb-4 mt-md-0 mb-md-0"><span class="variants_count"><?php echo  $query->found_posts; ?></span> вариантов</div>
                  <div class="credits__list-dropdown dropdown mb-3 mb-md-0 col-12 col-md-5 col-lg-4 px-0">
                      <select name="" class="styledSelect cred-order-select">
                          <option value="" selected disabled>Сортировать</option>
                          <option value="ratings_average">По рейтингу</option>
                          <option value="views">По количеству заявок</option>
                          <option value="z_sum">По сумме займа</option>
                          <option value="z_stavka">По процентной ставке</option>
                      </select>
                  </div>
              </div>
            <div data-json='<?= json_encode($args); ?>'  class="list_posts" id="response-cred-card">
                <?
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
                    <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                         <div class="pagination__links">
                            <?php my_pagination($max_pages); ?>
                        </div>

                        <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
                        // wp_reset_query(); ?>
                        <div class="pagination__description mt-4 mt-sm-0">
                            Показано <span class="count_view"><?php echo $counter ?></span>
                            продуктов из <span class="count_all"><?php echo $query->found_posts;?></span>
                        </div>
                    </div>
                </div>

                            <!-- / pagination -->
                        <?php
                        $args_archive = array(
                            'post_type' => 'zaimy',
                            'posts_per_page' => -1,
                            'meta_key'      => 'archive',
                            'meta_value'    => true
                        );
                        $query_archive = new WP_Query( $args_archive );
                        if ( $query_archive->have_posts() ): ?>
                            <h2 class="title archive_title mt-5">Архивные займы (<?= $query_archive->found_posts; ?>)</h2>
                            <div class="list_posts archive_list archive_hide">
                            <?php while ( $query_archive->have_posts() ): $query_archive->the_post();?>
                                <?php get_template_part( 'template-parts/filter-zaimy-posts' ); ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="d-xs-block d-lg-none">
                            <?php
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
                                        'value'     => 'zaimy',
                                        'compare'   => '=',
                                    ),
                                )
                        );
                        $query = new WP_Query( $args_coll );
                        if ( $query->have_posts() ) { $current_id = $wp_query->get_queried_object_id(); ?>
                            <? get_template_part( 'all_template/filter_right', null, ['mobile' => 1, 'cat' => $cat, 'query' => $query]); ?>
                        <?php } wp_reset_query(); ?>
                        <?php		}
                            }
                            ?>
                        </div>


                        </div>
                    </div>
                    <!-- / list -->
                    <!-- / pagination -->
                </div>
            </div>
            <?php wp_reset_query(); ?>
            <!-- / credits list -->
            <!-- articles -->
            <div class="section">
                <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="title mb-0">Статьи о займах</h2>
                    <a href="<?php echo get_category_link('38') ?>" class="btn btn-primary btn-sm btn-all">
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
                                'cat' => 38,
                                'posts_per_page' => 4,
                                'meta_key' => 'views',
                                'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
                                'order' => 'DESC',
                            );
                            get_template_part( 'all_template/article_list', null, $args);
                        ?>
                    </div>
                </div>
            </div>
            <!-- / articles -->

            <!-- similar offers -->

            <!-- / similar offers -->
            <!-- card reviews -->
            <div class="section">
                <div class="section__header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="title mb-0">Отзывы о займах</h2>
                    <a href="<?php echo  get_page_link(4975); //1503 tax-reviews ?>" class="btn btn-primary btn-sm btn-all " data-tax="zaimy">
                        Все
                        <span class="icon ml-2">
                            <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
                        </span>
                    </a>
                </div>
                <div class="horizontal__scroll row">
                    <div class="horizontal__scroll-container">
                        <?php
                        $ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                        $custom_offset = 0;

                        // fetch posts in all those categories
                        $posts = get_cpt_ids('zaimy');

                        $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                         FROM {$wpdb->comments} WHERE
                         comment_post_ID in (".implode(',', $posts).") AND comment_approved = 1 AND comment_parent = 0
                         ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                        $comments_list = $wpdb->get_results( $sql );

                        get_template_part( 'all_template/reviews_list', null, ['TYPE' => 'zaimy', 'DATA' => $comments_list]);

                        ?>

                    </div>
                </div>
            </div>
            <!-- / card reviews -->
            <!-- best credit cards -->
           <div class="section" id="best-products">
               <div class="section__header d-flex justify-content-between align-items-center mb-4">
                   <h2 class="title mb-0">Лучшие предложения</h2>
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

                         get_template_part( 'all_template/the_best_offers_list', null, $args);
                     ?>

                   </div>
               </div>
           </div>
           <!-- / best credit cards -->
            <!-- faq -->


                <?php if( have_rows('zaimy_faq', 'options') ): ?>
                      <div class="section">
                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0">Часто задаваемые вопросы</h2>
                    </div>
                    <div class="accordion" id="accordion">
                    <?php $counter = 0; ?>
                    <?php while( have_rows('zaimy_faq', 'options') ): the_row();
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
            <!-- wysiwyg text -->
            <div class="section">
                <div class="wysiwyg">
                   <?php echo the_field('zaimy_desc', 'options') ?>
                </div>
            </div>
            <!-- / wysiwyg text -->
        </div>
    </main>

    <?php get_footer() ?>

<?php } ?>
