<?php //session_start() 
?>
<?php

/* Template Name: Главная страница */

get_header(); ?>

<?php $credit_link =  get_term_link(2, '');
$debet_link = get_term_link(7, '');
$installment_link = get_term_link(8, '');
//$creditprod_link =  get_term_link('kredity', '');
$creditprod_link =  '/kredity/';
$zaim_link =  '/zaimy/';
?>

<h1 style="display:none;">Finabank – сервис по подбору финансовых услуг</h1>

<main id="primary" class="site-main">
    <div class="container">
        <!-- wellcome slider -->
        <?php if (have_rows('top_slider')): ?>
            <div class="section">
                <div class="wellcome__slider slider_init">
                    <div class="slider">
                        <?php
                        $count_slider = 1;
                        $countslide = count(get_field('top_slider'));
                        while (have_rows('top_slider')): the_row();

                            $title = get_sub_field('title');
                            $text = get_sub_field('text');
                            $link_text = get_sub_field('link_text');
                            $link_adress = get_sub_field('link_adress');
                            $image = get_sub_field('image');

                            //echo $count_slider;
                        ?>
                            <div class="slider__item">
                                <div class="slider__item-content">
                                    <div class="row">
                                        <div class="col-12 col-sm-5 col-lg-6 col-xl-5">
                                            <div class="slider__item-img h-100 d-flex align-items-end justify-content-center justify-content-sm-end">
                                                <img <?php if ($count_slider == 1 || $count_slider == 2): ?> fetchpriority="high" <?php else: ?> loading="lazy" <?php endif; ?> src="<?php echo $image ?>" alt="<?
                                                                                                                                                                                                                $bank_id = get_sub_field('image', false, false);
                                                                                                                                                                                                                $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                                                                                                                                                                                echo $bank_alt;
                                                                                                                                                                                                                ?>">

                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-7 col-lg-6 col-xl-7 align-self-center">
                                            <div class="px-3 pt-3 p-sm-3 p-md-4">
                                                <h2 class="mb-0"><?php echo $title ?></h2>
                                                <p><?php echo $text ?></p>
                                                <a href="<?php echo $link_adress ?>" class="btn btn-primary"><?php echo $link_text ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $count_slider++; ?>
                        <?php endwhile; ?>
                    </div>
                    <!-- slider prev/next buttons -->
                    <div class="slider__button_container">
                        <div class="slider__button slider__button-prev d-flex justify-content-center align-items-center">
                            <svg width="6" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.2 13.2" xml:space="preserve">
                                <path d="M5.6 0c.2 0 .3.1.4.2.3.2.3.6 0 .8L3.8 3.1C2.2 4.7 1.3 5.5 1.2 6.3v.6c.1.8.9 1.6 2.6 3.2L6 12.2c.2.2.2.6 0 .8-.2.2-.6.2-.8 0L3 10.9C1.1 9.2.2 8.3 0 7.1v-.9C.2 4.9 1.1 4 3 2.3L5.2.2c.1-.1.3-.2.4-.2z"></path>
                            </svg>
                        </div>
                        <div class="slider__button slider__button-next d-flex justify-content-center align-items-center">
                            <svg width="6" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.2 13.2" xml:space="preserve">
                                <path d="M.6 13.2c-.2 0-.3-.1-.4-.2-.2-.2-.2-.6 0-.8l2.2-2.1C4 8.5 4.9 7.7 5 6.9v-.6c-.1-.8-1-1.6-2.6-3.2L.2 1C0 .8 0 .4.2.2c.2-.2.6-.2.8 0l2.2 2.1C5.1 4 6 4.9 6.2 6.1V7c-.2 1.3-1.1 2.2-3 3.9L1 13c-.1.1-.3.2-.4.2z"></path>
                            </svg>
                        </div>
                    </div>
                    <!-- / slider prev/next buttons -->
                </div>
            </div>
        <?php endif; ?>
        <!-- / wellcome slider -->
        <!-- form & tags -->
        <div class="section">
            <!-- form  -->
            <div class="form mb-4">
                <form id="main-page-filter" action="" method="POST">
                    <div class="row align-items-end">
                        <div class="col-12 col-md-3 mb-3 mb-md-0">
                            <label class="form-label" for="creditCardSelect">Мне нужно</label>
                            <select name="" id="productTypeSelect" class="styledSelect" placeholder="">
                                <option value="credit_inputs_range" selected>Кредитные карты</option>
                                <option value="debet_inputs_range">Дебетовые карты</option>
                                <option value="install_inputs_range">Карты рассрочки</option>
                                <option value="kredity_inputs_range">Кредиты</option>
                                <option value="zaimy_inputs_range">Займы</option>
                            </select>
                        </div>
                        <!-- Кредитные карты-->
                        <div class="col-12 col-md-3 mb-3 mb-md-0 main_filter_input credit_inputs_range">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Кредитный лимит, ₽</div>
                                    <input type="text" class="range__value" <?php echo  $filter_price['credit_inputs_range']['attr_price']; ?>>
                                </div>
                                <input class="range__input" name="cred_limit" type="range" <?php echo $filter_price['credit_inputs_range']['attr_price']; ?>>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 mb-md-0 main_filter_input credit_inputs_range">
                            <div class="range debet_range_2">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Льготный период, дней</div>
                                    <input type="text" class="range__value" <?php echo $filter_price['credit_inputs_range']['attr_day']; ?>>
                                </div>
                                <input class="range__input" name="cred_day_period" type="range" <?php echo $filter_price['credit_inputs_range']['attr_day']; ?>>
                            </div>
                        </div>
                        <!-- Карты рассрочки -->
                        <div class="col-12 col-md-3 mb-3 mb-md-0 main_filter_input install_inputs_range d-none">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Кредитный лимит, ₽</div>
                                    <input type="text" class="range__value" <?php echo $filter_price['install_inputs_range']['attr_price']; ?>>
                                </div>
                                <input class="range__input" name="cred_limit_ins" type="range" <?php echo $filter_price['install_inputs_range']['attr_price']; ?>>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 mb-md-0 main_filter_input install_inputs_range d-none">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Льготный период, дней</div>
                                    <input type="text" class="range__value" <?php echo $filter_price['install_inputs_range']['attr_day']; ?>>
                                </div>
                                <input class="range__input" name="cred_day_period_ins" type="range" <?php echo $filter_price['install_inputs_range']['attr_day']; ?>>
                            </div>
                        </div>
                        <!-- Дебетовые карты -->
                        <div class="col-12 col-md-3 mb-3 mb-md-0 main_filter_input debet_inputs_range d-none">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Снятие без %, ₽</div>
                                    <input type="text" class="range__value" <?php echo $filter_price['debet_inputs_range']['attr_price']; ?>>
                                </div>
                                <input class="range__input" name="percent_limit" type="range" <?php echo $filter_price['debet_inputs_range']['attr_price']; ?>>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 mb-md-0 main_filter_input debet_inputs_range d-none">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Кэшбек, %</div>
                                    <input type="text" class="range__value" <?php echo $filter_price['debet_inputs_range']['attr_day']; ?>>
                                </div>
                                <input class="range__input" name="cashback_number" type="range" <?php echo $filter_price['debet_inputs_range']['attr_day']; ?>>
                            </div>
                        </div>
                        <!--Кредиты -->
                        <div class="col-12 col-md-3 mb-3 mb-md-0 main_filter_input kredity_inputs_range d-none">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Сумма, ₽</div>
                                    <input type="text" class="range__value" <?php echo $filter_price['kredity_inputs_range']['attr_price']; ?>>
                                </div>
                                <input class="range__input" name="summ_limit" type="range" <?php echo $filter_price['kredity_inputs_range']['attr_price']; ?>>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 mb-md-0 main_filter_input kredity_inputs_range d-none">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Срок, месяцев</div>
                                    <input type="text" class="range__value" <?php echo $filter_price['kredity_inputs_range']['attr_day']; ?>>
                                </div>
                                <input class="range__input" name="cred_summ_period" type="range" <?php echo $filter_price['kredity_inputs_range']['attr_day']; ?>>
                            </div>
                        </div>
                        <!-- займы -->
                        <div class="col-12 col-md-3 mb-3 mb-md-0 main_filter_input zaimy_inputs_range d-none">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Сумма, ₽</div>
                                    <input type="text" class="range__value" <?php echo $filter_price['zaimy_inputs_range']['attr_price']; ?>>
                                </div>
                                <input class="range__input" name="z_sum" type="range" <?php echo $filter_price['zaimy_inputs_range']['attr_price']; ?>>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 mb-md-0 main_filter_input zaimy_inputs_range d-none">
                            <div class="range">
                                <div class="d-flex justify-content-between">
                                    <div class="range__label">Срок, дней</div>
                                    <input type="text" class="range__value" <?php echo $filter_price['zaimy_inputs_range']['attr_day']; ?>>
                                </div>
                                <input class="range__input" name="z_time" type="range" <?php echo $filter_price['zaimy_inputs_range']['attr_day']; ?>>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <button onclick="ym(35020350,'reachGoal','click_pokazat_filtr'); ym(35020350,'reachGoal','filtr_knopka');" class="btn btn-primary btn-block main-submit-button">Варианты</button>

                        </div>
                    </div>
                </form>
            </div>
            <!-- / form -->
            <!-- tags -->
            <!--div class="tags__main horizontal__scroll">
		            <div class="horizontal__scroll-container">
		                <a href="<?php echo get_post_type_archive_link('zaimy'); ?>" class="tag__item">
		                    <svg width="24" height="32" viewBox="0 0 26 34" xmlns="http://www.w3.org/2000/svg">
		                        <path d="M7.31919 2.0613V1.4613C7.09442 1.4613 6.88851 1.58692 6.78567 1.78678C6.68284 1.98664 6.70033 2.22722 6.831 2.4101L7.31919 2.0613ZM10.1596 1V0.4V1ZM18.8086 2.0613L19.2899 2.41956C19.4253 2.23757 19.4465 1.99473 19.3447 1.792C19.2429 1.58926 19.0354 1.4613 18.8086 1.4613V2.0613ZM15.9681 1V0.4V1ZM21.5532 13.0603L21.8519 12.54L21.5532 13.0603ZM4.44681 13.0603L4.74547 13.5807L4.44681 13.0603ZM10.1543 9.53344V8.93344C10.0399 8.93344 9.92792 8.96614 9.83149 9.0277L10.1543 9.53344ZM16.1543 9.53344L16.4962 9.04034C16.3958 8.97073 16.2765 8.93344 16.1543 8.93344V9.53344ZM9.79173 24.1603C9.5489 24.3858 9.53484 24.7654 9.76032 25.0083C9.98581 25.2511 10.3654 25.2652 10.6083 25.0397L9.79173 24.1603ZM16.2083 19.8397C16.4511 19.6142 16.4652 19.2346 16.2397 18.9917C16.0142 18.7489 15.6346 18.7348 15.3917 18.9603L16.2083 19.8397ZM10.8597 5.98452L7.80738 1.71249L6.831 2.4101L9.88328 6.68213L10.8597 5.98452ZM7.31919 2.6613C8.25367 2.6613 8.84219 2.32614 9.2871 2.03024C9.75572 1.71858 9.90589 1.6 10.1596 1.6V0.4C9.45589 0.4 8.95181 0.812073 8.62256 1.03105C8.26959 1.2658 7.91662 1.4613 7.31919 1.4613V2.6613ZM10.1596 1.6C10.5687 1.6 10.8455 1.77623 11.2052 2.05386C11.5197 2.29656 12.0329 2.75778 12.7447 2.75778V1.55778C12.531 1.55778 12.374 1.4401 11.9385 1.10392C11.5482 0.802662 10.9952 0.4 10.1596 0.4V1.6ZM16.1099 6.69158L19.2899 2.41956L18.3273 1.70304L15.1473 5.97506L16.1099 6.69158ZM18.8086 1.4613C18.2111 1.4613 17.8581 1.2658 17.5052 1.03105C17.1759 0.812073 16.6718 0.4 15.9681 0.4V1.6C16.2219 1.6 16.372 1.71858 16.8406 2.03024C17.2855 2.32614 17.8741 2.6613 18.8086 2.6613V1.4613ZM15.9681 0.4C15.1325 0.4 14.5796 0.802662 14.1893 1.10392C13.7537 1.4401 13.5967 1.55778 13.383 1.55778V2.75778C14.0948 2.75778 14.6081 2.29656 14.9225 2.05386C15.2822 1.77623 15.5591 1.6 15.9681 1.6V0.4ZM12.7447 2.75778H13.383V1.55778H12.7447V2.75778ZM24.4 18.0943V29.0178H25.6V18.0943H24.4ZM21.0747 32.4H4.92533V33.6H21.0747V32.4ZM1.6 29.0178V18.0943H0.4V29.0178H1.6ZM4.74547 13.5807C5.66106 13.0552 7.09721 12.1676 8.29715 11.4162C8.89871 11.0395 9.44356 10.6953 9.838 10.4454C10.0352 10.3204 10.1949 10.2189 10.3054 10.1486C10.3606 10.1135 10.4035 10.0862 10.4326 10.0676C10.4472 10.0583 10.4583 10.0512 10.4658 10.0465C10.4695 10.0441 10.4723 10.0423 10.4743 10.041C10.4752 10.0404 10.4759 10.04 10.4764 10.0397C10.4767 10.0395 10.4768 10.0394 10.477 10.0393C10.477 10.0393 10.4771 10.0392 10.4771 10.0392C10.4772 10.0392 10.4772 10.0392 10.1543 9.53344C9.83149 9.0277 9.83148 9.0277 9.83146 9.02772C9.83143 9.02774 9.83139 9.02776 9.83134 9.0278C9.83122 9.02787 9.83105 9.02798 9.83082 9.02812C9.83036 9.02842 9.82967 9.02886 9.82874 9.02945C9.82689 9.03063 9.82411 9.03241 9.82042 9.03476C9.81305 9.03946 9.80205 9.04648 9.78761 9.05568C9.75874 9.07408 9.7161 9.10124 9.66116 9.1362C9.55128 9.20612 9.39222 9.3072 9.19566 9.43177C8.8025 9.68092 8.25953 10.0239 7.66025 10.3992C6.45851 11.1517 5.0409 12.0276 4.14814 12.54L4.74547 13.5807ZM16.1543 9.53344C15.8125 10.0265 15.8125 10.0266 15.8126 10.0266C15.8126 10.0266 15.8126 10.0266 15.8127 10.0267C15.8128 10.0268 15.813 10.0269 15.8132 10.0271C15.8137 10.0274 15.8144 10.0278 15.8153 10.0285C15.8171 10.0297 15.8197 10.0315 15.8232 10.0339C15.8301 10.0388 15.8404 10.0459 15.8539 10.0552C15.8809 10.0738 15.9206 10.1013 15.9717 10.1365C16.0739 10.2069 16.2218 10.3086 16.4049 10.4338C16.7709 10.6842 17.278 11.0289 17.8419 11.4063C18.9646 12.1577 20.3302 13.0502 21.2545 13.5807L21.8519 12.54C20.9678 12.0326 19.634 11.1617 18.5093 10.4091C17.9496 10.0345 17.446 9.69208 17.0823 9.44333C16.9005 9.31898 16.7538 9.2181 16.6526 9.14836C16.602 9.11349 16.5628 9.08641 16.5363 9.06809C16.523 9.05892 16.5129 9.05195 16.5062 9.04729C16.5028 9.04495 16.5003 9.0432 16.4986 9.04203C16.4978 9.04145 16.4972 9.04102 16.4967 9.04074C16.4965 9.04059 16.4964 9.04049 16.4963 9.04042C16.4962 9.04039 16.4962 9.04037 16.4962 9.04035C16.4962 9.04034 16.4962 9.04034 16.1543 9.53344ZM4.92533 32.4C3.09691 32.4 1.6 30.8939 1.6 29.0178H0.4C0.4 31.5403 2.41795 33.6 4.92533 33.6V32.4ZM24.4 29.0178C24.4 30.8939 22.9031 32.4 21.0747 32.4V33.6C23.582 33.6 25.6 31.5403 25.6 29.0178H24.4ZM25.6 18.0943C25.6 15.6707 23.7597 13.6349 21.8519 12.54L21.2545 13.5807C22.9803 14.5712 24.4 16.2826 24.4 18.0943H25.6ZM1.6 18.0943C1.6 16.2826 3.01967 14.5712 4.74547 13.5807L4.14814 12.54C2.24031 13.6349 0.4 15.6707 0.4 18.0943H1.6ZM10.3715 6.93332H15.6286V5.73332H10.3715V6.93332ZM15.6286 8.93332H10.3715V10.1333H15.6286V8.93332ZM10.3715 8.93332C9.83992 8.93332 9.39433 8.49377 9.39433 7.93332H8.19433C8.19433 9.14018 9.16096 10.1333 10.3715 10.1333V8.93332ZM16.6058 7.93332C16.6058 8.49377 16.1602 8.93332 15.6286 8.93332V10.1333C16.8391 10.1333 17.8058 9.14018 17.8058 7.93332H16.6058ZM15.6286 6.93332C16.1602 6.93332 16.6058 7.37287 16.6058 7.93332H17.8058C17.8058 6.72646 16.8391 5.73332 15.6286 5.73332V6.93332ZM10.3715 5.73332C9.16096 5.73332 8.19433 6.72646 8.19433 7.93332H9.39433C9.39433 7.37287 9.83992 6.93332 10.3715 6.93332V5.73332ZM19.5489 21.9367C19.5489 25.5883 16.6125 28.5407 13 28.5407V29.7407C17.2839 29.7407 20.7489 26.2424 20.7489 21.9367H19.5489ZM13 28.5407C9.38745 28.5407 6.45106 25.5883 6.45106 21.9367H5.25106C5.25106 26.2424 8.71604 29.7407 13 29.7407V28.5407ZM6.45106 21.9367C6.45106 18.2851 9.38745 15.3327 13 15.3327V14.1327C8.71604 14.1327 5.25106 17.631 5.25106 21.9367H6.45106ZM13 15.3327C16.6125 15.3327 19.5489 18.2851 19.5489 21.9367H20.7489C20.7489 17.631 17.2839 14.1327 13 14.1327V15.3327ZM15.9107 24.1879C15.9107 24.5714 15.6034 24.8743 15.2341 24.8743V26.0743C16.2748 26.0743 17.1107 25.2254 17.1107 24.1879H15.9107ZM15.2341 24.8743C14.8647 24.8743 14.5575 24.5714 14.5575 24.1879H13.3575C13.3575 25.2254 14.1933 26.0743 15.2341 26.0743V24.8743ZM14.5575 24.1879C14.5575 23.8036 14.8628 23.5015 15.2341 23.5015V22.3015C14.1898 22.3015 13.3575 23.1512 13.3575 24.1879H14.5575ZM15.2341 23.5015C15.6053 23.5015 15.9107 23.8036 15.9107 24.1879H17.1107C17.1107 23.1512 16.2784 22.3015 15.2341 22.3015V23.5015ZM11.5702 19.8139C11.5702 20.1974 11.2629 20.5004 10.8936 20.5004V21.7004C11.9343 21.7004 12.7702 20.8514 12.7702 19.8139H11.5702ZM10.8936 20.5004C10.5243 20.5004 10.217 20.1974 10.217 19.8139H9.01699C9.01699 20.8514 9.85284 21.7004 10.8936 21.7004V20.5004ZM10.217 19.8139C10.217 19.4305 10.5242 19.1275 10.8936 19.1275V17.9275C9.85284 17.9275 9.01699 18.7764 9.01699 19.8139H10.217ZM10.8936 19.1275C11.2629 19.1275 11.5702 19.4305 11.5702 19.8139H12.7702C12.7702 18.7764 11.9343 17.9275 10.8936 17.9275V19.1275ZM10.6083 25.0397L16.2083 19.8397L15.3917 18.9603L9.79173 24.1603L10.6083 25.0397ZM10.1543 10.1334H16.1543V8.93344H10.1543V10.1334Z"></path>
		                    </svg>
		                    <span class="tag__item-title">Займы</span>
		                </a>
		                <a href="<?php echo $debet_link ?>" class="tag__item">
		                    <svg width="29" height="28" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 29.5 26" style="enable-background:new 0 0 29.5 26" xml:space="preserve"><path d="M26.2 4.6h-2.7l-2-3.3C20.8 0 19.2-.4 18 .4l-7.1 4.2H3.3C1.5 4.6 0 6.1 0 7.9v14.8C0 24.5 1.5 26 3.3 26h22.9c1.8 0 3.3-1.5 3.3-3.3V7.9c0-1.8-1.5-3.3-3.3-3.3zm-7.8-2.9c.7-.4 1.7-.2 2.1.5l4.9 8.2c.4.7.2 1.7-.5 2.1l-10.2 6H7.9L4 11.9c-.4-.7-.2-1.7.5-2.1l13.9-8.1zM1.3 7.9c0-1.1.9-2 2-2h5.3l-5 3c-1.2.7-1.6 2.2-.9 3.4l3.7 6.2H1.3V7.9zm26.9 14.8c0 1.1-.9 2-2 2H3.3c-1.1 0-2-.9-2-2v-2.8h26.9v2.8zm0-4.1h-11l8.6-5.1c1.2-.7 1.6-2.3.9-3.5l-2.5-4.2h1.9c1.1 0 2 .9 2 2v10.8z"></path><path d="M8.2 14.7h-.3c-.3-.1-.6-.3-.8-.6l-1-1.7c-.4-.6-.1-1.4.5-1.8l3-1.8c.3-.2.7-.2 1-.1.3.1.6.3.8.6l1 1.7c.4.6.1 1.4-.5 1.8l-3 1.8c-.2 0-.5.1-.7.1zm-1-3.1 1 1.8 3-1.8-1-1.8-3 1.8z"></path></svg>
		                    <span class="tag__item-title">Дебетовые карты</span> 
		                </a>
		                <a href="<?php echo get_post_type_archive_link('kredity'); ?>" class="tag__item">
		                    <svg width="30" height="28" viewBox="0 0 30 28" xmlns="http://www.w3.org/2000/svg"><path d="M10.49 26.4a.6.6 0 0 0 0 1.2v-1.2ZM8.878 2.472l.6.023-.6-.023Zm6.895 8.361.39-.455-.39.455ZM9.29 5.263l-.391.455.39-.455Zm-1.024 0 .391.455-.391-.455Zm-6.483 5.57-.391-.455.39.455Zm1.62 12.234h-.6a.6.6 0 0 0 .6.6v-.6Zm10.749 0v.6a.6.6 0 0 0 .6-.6h-.6Zm6.552-18.243v-.6a.6.6 0 0 0-.6.6h.6Zm-1.815 4.83a.6.6 0 1 0 0 1.2v-1.2Zm1.215 5.875a.6.6 0 1 0 1.2 0h-1.2Zm3.192-2.037a.6.6 0 0 0 0-1.2v1.2Zm-4.407-1.2a.6.6 0 0 0 0 1.2v-1.2ZM10.433 1.6h17.011V.4H10.433v1.2Zm17.967.93v22.94h1.2V2.53h-1.2Zm-.956 23.87H10.49v1.2h16.954v-1.2ZM9.377 5.13l.1-2.635-1.198-.046-.1 2.636 1.198.045ZM28.4 25.47c0 .504-.418.93-.956.93v1.2c1.181 0 2.156-.944 2.156-2.13h-1.2ZM27.444 1.6c.538 0 .956.426.956.93h1.2c0-1.186-.975-2.13-2.156-2.13v1.2ZM10.433.4c-1.15 0-2.11.896-2.154 2.05l1.199.045a.944.944 0 0 1 .955-.895V.4Zm5.73 9.978-6.482-5.57-.782.91 6.483 5.57.782-.91Zm-8.288-5.57-6.483 5.57.782.91 6.483-5.57-.782-.91Zm-5.58 7.966h1.109v-1.2h-1.11v1.2Zm11.857 0h1.11v-1.2h-1.11v1.2Zm-11.348-.6v10.893h1.2V12.174h-1.2Zm10.748 0v10.893h1.2V12.174h-1.2Zm-10.148.6H6.09v-1.2H3.404v1.2Zm8.06 0h2.688v-1.2h-2.687v1.2Zm0 10.893h2.688v-1.2h-2.687v1.2Zm-8.06 0H6.09v-1.2H3.404v1.2ZM5.49 12.174v10.893h1.2V12.174h-1.2Zm5.374 0v10.893h1.2V12.174h-1.2ZM9.68 4.808a1.388 1.388 0 0 0-1.806 0l.782.91a.188.188 0 0 1 .242 0l.782-.91Zm5.7 6.48c.039.033.051.062.056.084a.174.174 0 0 1-.068.171.176.176 0 0 1-.108.03v1.2c1.253 0 1.883-1.553.903-2.395l-.782.91Zm-13.99-.91c-.98.842-.35 2.396.903 2.396v-1.2a.176.176 0 0 1-.108-.031.175.175 0 0 1-.068-.171.153.153 0 0 1 .056-.084l-.782-.91ZM1.39 23.776h14.778v-1.2H1.389v1.2ZM16.167 26.4H1.389v1.2h14.778v-1.2Zm-.212.218c0-.13.105-.218.212-.218v1.2c.536 0 .988-.43.988-.982h-1.2Zm.212-2.841a.214.214 0 0 1-.212-.218h1.2a.986.986 0 0 0-.988-.983v1.2ZM1.389 26.4c.107 0 .211.088.211.218H.4c0 .552.452.982.989.982v-1.2Zm0-3.823a.986.986 0 0 0-.989.982h1.2c0 .13-.104.217-.211.217v-1.2ZM20.704 5.424h2.423v-1.2h-2.423v1.2Zm.6 4.83v-5.43h-1.2v5.43h1.2Zm1.823-.6h-2.423v1.2h2.423v-1.2Zm-2.423 0h-1.815v1.2h1.815v-1.2Zm.6 5.875v-2.637h-1.2v2.637h1.2Zm0-2.637v-2.638h-1.2v2.638h1.2Zm-.6.6h2.592v-1.2h-2.592v1.2Zm0-1.2h-1.815v1.2h1.815v-1.2Zm4.585-4.753c0 1.158-.958 2.115-2.162 2.115v1.2c1.847 0 3.362-1.475 3.362-3.315h-1.2Zm-2.162-2.115c1.204 0 2.162.956 2.162 2.115h1.2c0-1.84-1.515-3.315-3.362-3.315v1.2Zm-17.036 7.35h5.374v-1.2H6.09v1.2Zm0 10.893h5.374v-1.2H6.09v1.2Zm9.864-.108v3.059h1.2v-3.059h-1.2ZM1.6 26.618v-3.06H.4v3.06h1.2Z"></path></svg>
		                    <span class="tag__item-title">Кредиты</span>
		                </a>
		                <a href="<?php echo get_post_type_archive_link('banks'); ?>" class="tag__item">
		                    <svg width="26" height="28" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg"><path d="M21.706 8.579v.5h.5v-.5h-.5Zm-15.53 2.526v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.294 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.295 0h-.5a.5.5 0 0 0 .5.5v-.5Zm14.236-8.842v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.295 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.294 0h-.5a.5.5 0 0 0 .5.5v-.5Zm.983-15.104.19-.463-.19.463Zm-9.584-3.766L12 1.54l-.19-.463Zm.378 0L12 1.54l.19-.463ZM2.605 4.843l-.19-.463.19.463Zm19.1 3.236H2.296v1h19.41v-1ZM2.796 5.306 12 1.54l-.379-.925L2.416 4.38l.378.926ZM12 1.54l9.206 3.766.378-.926L12.38.615 12 1.54ZM2.794 8.58V6.143h-1v2.436h1Zm0-2.436v-.837h-1v.837h1Zm18.412-.837v.837h1v-.837h-1Zm0 .837v2.436h1V6.143h-1Zm-18.912.5h19.412v-1H2.294v1Zm1.294 12.804H2.294v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027H6.176v1h1.295v-1Zm10.352 0H16.53v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027h-1.294v1h1.294v-1Zm0 3.527h.794v-1h-.794v1Zm.794 0V24.5h1v-1.526h-1Zm0 1.526h-21v1h21v-1Zm-21 0v-1.526h-1V24.5h1Zm0-1.526h.794v-1H1.5v1Zm2.088-12.369H1.5v1h2.088v-1Zm-2.088 0V9.08h-1v1.526h1Zm21-1.526v1.526h1V9.08h-1Zm0 1.526h-2.088v1H22.5v-1ZM1.5 9.08h.794v-1H1.5v1Zm.794 0H22.5v-1H2.294v1Zm3.382 2.026v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1Zm15.824-8.842v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1ZM7.47 22.974H12v-1H7.47v1Zm4.529 0h4.53v-1H12v1ZM6.176 11.605H12v-1H6.176v1Zm5.824 0h5.823v-1H12v1Zm.5 10.869V11.105h-1v11.369h1Zm10-11.869v1a1 1 0 0 0 1-1h-1Zm1-1.526a1 1 0 0 0-1-1v1h1Zm-22 0v-1a1 1 0 0 0-1 1h1Zm0 1.526h-1a1 1 0 0 0 1 1v-1Zm0 13.895h-1a1 1 0 0 0 1 1v-1ZM21.206 5.306h1a1 1 0 0 0-.622-.926l-.378.926ZM22.5 22.974h1a1 1 0 0 0-1-1v1Zm0 1.526v1a1 1 0 0 0 1-1h-1Zm-21-1.526v-1a1 1 0 0 0-1 1h1ZM12 1.54l.379-.925a1 1 0 0 0-.758 0L12 1.54ZM2.416 4.38a1 1 0 0 0-.622.926h1l-.378-.926Z"></path></svg>
		                    <span class="tag__item-title">Банки</span>
		                </a>
		                <a href="<?php echo $credit_link ?>" class="tag__item">
		                    <svg width="28" height="29" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 30.5 27" style="enable-background:new 0 0 30.5 27" xml:space="preserve">
		                        <path d="M9.9 22.7c0-.4-.3-.7-.7-.7v1.3c.4 0 .7-.3.7-.6zM3.9 22h5.3v1.3H3.9z"></path>
		                        <path d="M3.9 23.3V22c-.4 0-.7.3-.7.7.1.3.4.6.7.6z"></path>
		                        <path d="M30.4 15.3 28.3 2.7c-.1-.9-.6-1.6-1.3-2.1-.7-.5-1.6-.7-2.4-.6L4.7 3.4c-1.8.3-3 2-2.7 3.8l.1.7C.9 8.4 0 9.6 0 11v12.7C0 25.5 1.5 27 3.3 27h20.1c1.8 0 3.3-1.5 3.3-3.3v-4.5l1.2-.2c.9-.1 1.6-.6 2.1-1.3.4-.7.6-1.6.4-2.4zm-5.1 8.4c0 1.1-.9 2-2 2h-20c-1.1 0-2-.9-2-2v-6.5h24v6.5zm0-7.8h-24v-2.8h24v2.8zm0-4.1h-24V11c0-1.1.9-2 2-2h20.1c1.1 0 2 .9 2 2v.8zm3.5 5.1c-.3.4-.8.7-1.3.8l-1 .2V11c0-1.8-1.5-3.3-3.3-3.3H3.5L3.4 7c-.2-1.1.5-2.1 1.6-2.3l19.8-3.4c1.1-.2 2.1.5 2.3 1.6l2.1 12.5c0 .6-.1 1.1-.4 1.5z"></path>
		                    </svg>
		                    <span class="tag__item-title">Кредитные карты</span>
		                </a>
		                <a href="" class="tag__item btn__view-all">
		                    <svg width="26" height="26" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 22 22" style="enable-background:new 0 0 22 22" xml:space="preserve">
		                        <path d="M11 22C4.9 22 0 17.1 0 11S4.9 0 11 0s11 4.9 11 11-4.9 11-11 11zm0-20.8c-5.4 0-9.8 4.4-9.8 9.8s4.4 9.8 9.8 9.8 9.8-4.4 9.8-9.8-4.4-9.8-9.8-9.8z"></path>
		                        <circle cx="6.7" cy="11" r="1.2"></circle>
		                        <circle cx="11" cy="11" r="1.2"></circle>
		                        <circle cx="15.3" cy="11" r="1.2"></circle>
		                    </svg>
		                    <span class="tag__item-title">Все</span>
		                </a>
		                <a href="<?php echo $installment_link ?>" class="tag__item">
		                    <svg width="26" height="28" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg"><path d="M21.706 8.579v.5h.5v-.5h-.5Zm-15.53 2.526v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.294 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.295 0h-.5a.5.5 0 0 0 .5.5v-.5Zm14.236-8.842v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.295 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.294 0h-.5a.5.5 0 0 0 .5.5v-.5Zm.983-15.104.19-.463-.19.463Zm-9.584-3.766L12 1.54l-.19-.463Zm.378 0L12 1.54l.19-.463ZM2.605 4.843l-.19-.463.19.463Zm19.1 3.236H2.296v1h19.41v-1ZM2.796 5.306 12 1.54l-.379-.925L2.416 4.38l.378.926ZM12 1.54l9.206 3.766.378-.926L12.38.615 12 1.54ZM2.794 8.58V6.143h-1v2.436h1Zm0-2.436v-.837h-1v.837h1Zm18.412-.837v.837h1v-.837h-1Zm0 .837v2.436h1V6.143h-1Zm-18.912.5h19.412v-1H2.294v1Zm1.294 12.804H2.294v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027H6.176v1h1.295v-1Zm10.352 0H16.53v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027h-1.294v1h1.294v-1Zm0 3.527h.794v-1h-.794v1Zm.794 0V24.5h1v-1.526h-1Zm0 1.526h-21v1h21v-1Zm-21 0v-1.526h-1V24.5h1Zm0-1.526h.794v-1H1.5v1Zm2.088-12.369H1.5v1h2.088v-1Zm-2.088 0V9.08h-1v1.526h1Zm21-1.526v1.526h1V9.08h-1Zm0 1.526h-2.088v1H22.5v-1ZM1.5 9.08h.794v-1H1.5v1Zm.794 0H22.5v-1H2.294v1Zm3.382 2.026v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1Zm15.824-8.842v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1ZM7.47 22.974H12v-1H7.47v1Zm4.529 0h4.53v-1H12v1ZM6.176 11.605H12v-1H6.176v1Zm5.824 0h5.823v-1H12v1Zm.5 10.869V11.105h-1v11.369h1Zm10-11.869v1a1 1 0 0 0 1-1h-1Zm1-1.526a1 1 0 0 0-1-1v1h1Zm-22 0v-1a1 1 0 0 0-1 1h1Zm0 1.526h-1a1 1 0 0 0 1 1v-1Zm0 13.895h-1a1 1 0 0 0 1 1v-1ZM21.206 5.306h1a1 1 0 0 0-.622-.926l-.378.926ZM22.5 22.974h1a1 1 0 0 0-1-1v1Zm0 1.526v1a1 1 0 0 0 1-1h-1Zm-21-1.526v-1a1 1 0 0 0-1 1h1ZM12 1.54l.379-.925a1 1 0 0 0-.758 0L12 1.54ZM2.416 4.38a1 1 0 0 0-.622.926h1l-.378-.926Z"></path></svg>
		                    <span class="tag__item-title">Карты рассрочки</span>
		                </a>
		            </div>
		        </div-->
            <!-- / tags -->
        </div>
        <!-- / form & tags -->
        <!-- best offers -->
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
            <div class="tabs-new offer-tabs">
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
                                    'post_type'      => 'bankcard',
                                    'posts_per_page' => 4,
                                    'meta_key'       => 'ratings_average',
                                    'orderby'        => 'meta_value_num',
                                    'order'          => 'DESC',
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'bankcards',
                                            'field'    => 'slug',
                                            'terms'    => 'creditcard',
                                        ),
                                    ),
                                    'meta_query'     => array(
                                        // Только те записи, у которых поле "archive" = 0
                                        array(
                                            'key'   => 'archive',
                                            'value' => '0',
                                        ),
                                        // Только те записи, у которых поле "card_bank_link" не пустое
                                        array(
                                            'key'     => 'card_bank_link',
                                            'value'   => '',
                                            'compare' => '!=',
                                        ),
                                    ),
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
                                                    <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></div>
                                                </div>
                                                <div class="card__header-info d-flex align-items-center">
                                                    <div class="card__rating d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php echo the_field('ratings_average'); ?>
                                                    </div>
                                                    <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                        <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                                </svg></a></div>
                                                        <?php $comments_count = wp_count_comments(get_the_ID());
                                                        echo $comments_count->approved ?>
                                                    </div>
                                                    <div class="card__like d-flex align-items-center">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                    <div class="card__header-actions ml-auto">
                                                        <a href=""><svg width="20" height="20" viewBox="0 0 20 20">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use>
                                                            </svg></a>
                                                    </div>
                                                </div>
                                                <div class="card__image my-3">
                                                    <a href="<?php echo the_permalink() ?>">
                                                        <img loading="lazy" alt="<?
                                                                                    $bank_id = get_field('card_logo', false, false);
                                                                                    $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                                                    echo $bank_alt;
                                                                                    ?>"
                                                            src="<?php echo get_field('card_logo') ?>"></a>
                                                </div>

                                                <ul class="leaders">
                                                    <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">Лимит</div>
                                                            <div class="leaders__item-value"><?php echo number_format(get_field('card_cred_limit'), 0, '.', ' '); ?> ₽</div>
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
                                                            <div class="leaders__item-value"><?php echo get_field('card_cashback'); ?></div>
                                                        </li>
                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">Ставка</div>
                                                            <div class="leaders__item-value">от <?php echo get_field('card_stavka') ?>%</div>
                                                        </li>
                                                    </div>
                                                </ul>
                                                <div class="card__actions mt-3 d-flex">
                                                    <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                                                    <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'creditcard'; ?>">
                                                        <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="card__footer mt-3">
                                                    <p>
                                                        <span><?php echo the_field('bank_phone', $bank_choise_rel) ?></span>
                                                        <span><?php echo the_field('bank_email', $bank_choise_rel) ?></span>
                                                        <span><?php echo the_field('views', get_the_id()) ?> заявок</span>
                                                        <span class="display-block">Лицензия: <?php echo the_field('bank_license', $bank_choise_rel) ?></span>
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
                    <div class="tab-pane" id="mainOffers2">
                        <div class="horizontal__scroll row">
                            <div class="horizontal__scroll-container">
                                <?php
                                $args = array(
                                    'post_type'      => 'bankcard',
                                    'posts_per_page' => 4,
                                    'meta_key'       => 'ratings_average',
                                    'orderby'        => 'meta_value_num',
                                    'order'          => 'DESC',
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'bankcards',
                                            'field'    => 'slug',
                                            'terms'    => 'debetcard',
                                        ),
                                    ),
                                    'meta_query'     => array(
                                        // Только те записи, у которых поле "archive" = 0
                                        array(
                                            'key'   => 'archive',
                                            'value' => '0',
                                        ),
                                        // Только те записи, у которых поле "card_bank_link" не пустое
                                        array(
                                            'key'     => 'card_bank_link',
                                            'value'   => '',
                                            'compare' => '!=',
                                        ),
                                    ),
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
                                                    <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></div>
                                                </div>
                                                <div class="card__header-info d-flex align-items-center">
                                                    <div class="card__rating d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php echo the_field('ratings_average'); ?>
                                                    </div>
                                                    <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                        <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                                </svg></a></div>
                                                        <?php $comments_count = wp_count_comments(get_the_ID());
                                                        echo $comments_count->approved ?>
                                                    </div>
                                                    <div class="card__like d-flex align-items-center">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                    <div class="card__header-actions ml-auto">
                                                        <a href=""><svg width="20" height="20" viewBox="0 0 20 20">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use>
                                                            </svg></a>
                                                    </div>
                                                </div>
                                                <div class="card__image my-3">
                                                    <img loading="lazy"
                                                        src="<?php echo the_field('card_logo') ?>"
                                                        alt="<?
                                                                $bank_id = get_field('card_logo', get_the_ID(), false);
                                                                $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                                echo $bank_alt;
                                                                ?>">
                                                </div>

                                                <ul class="leaders">
                                                    <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">Снятие без %</div>
                                                            <div class="leaders__item-value">До <?php echo number_format(get_field('non_pecent_money'), 0, '.', ' '); ?> ₽</div>
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
                                                </ul>
                                                <div class="card__actions mt-3 d-flex">
                                                    <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                                                    <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'debetcard'; ?>">
                                                        <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use>
                                                        </svg>
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
                    <div class="tab-pane" id="mainOffers3">
                        <div class="horizontal__scroll row">
                            <div class="horizontal__scroll-container">
                                <?php
                                $args = array(
                                    'post_type'      => 'bankcard',
                                    'posts_per_page' => 4,
                                    'meta_key'       => 'ratings_average',
                                    'orderby'        => 'meta_value_num',
                                    'order'          => 'DESC',
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'bankcards',
                                            'field'    => 'slug',
                                            'terms'    => 'installmentcard',
                                        ),
                                    ),
                                    'meta_query'     => array(
                                        // Только те записи, у которых поле "archive" = 0
                                        array(
                                            'key'   => 'archive',
                                            'value' => '0',
                                        ),
                                        // Только те записи, у которых поле "card_bank_link" не пустое
                                        array(
                                            'key'     => 'card_bank_link',
                                            'value'   => '',
                                            'compare' => '!=',
                                        ),
                                    ),
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
                                                    <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></div>
                                                </div>
                                                <div class="card__header-info d-flex align-items-center">
                                                    <div class="card__rating d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php echo the_field('ratings_average'); ?>
                                                    </div>
                                                    <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                        <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                                </svg></a></div>
                                                        <?php $comments_count = wp_count_comments(get_the_ID());
                                                        echo $comments_count->approved ?>
                                                    </div>
                                                    <div class="card__like d-flex align-items-center">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                    <div class="card__header-actions ml-auto">
                                                        <a href=""><svg width="20" height="20" viewBox="0 0 20 20">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use>
                                                            </svg></a>
                                                    </div>
                                                </div>
                                                <div class="card__image my-3">
                                                    <img loading="lazy"
                                                        src="<?php echo the_field('card_logo') ?>"
                                                        alt="<?
                                                                $bank_id = get_field('card_logo', false, false);
                                                                $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                                echo $bank_alt;
                                                                ?>">
                                                </div>

                                                <ul class="leaders">
                                                    <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">Лимит</div>
                                                            <div class="leaders__item-value"><?php echo number_format(get_field('card_cred_limit'), 0, '.', ' '); ?> ₽</div>
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
                                                            <div class="leaders__item-value"><?php echo get_field('card_cashback');    ?></div>
                                                        </li>
                                                        <li class="leaders__item mb-1">
                                                            <div class="leaders__item-title">Ставка</div>
                                                            <div class="leaders__item-value">от <?php echo the_field('card_stavka') ?>%</div>
                                                        </li>
                                                    </div>
                                                </ul>
                                                <div class="card__actions mt-3 d-flex">
                                                    <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                                                    <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'installmentcard'; ?>">
                                                        <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use>
                                                        </svg>
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
                    <div class="tab-pane" id="mainOffers4">
                        <div class="horizontal__scroll row">
                            <div class="horizontal__scroll-container">
                                <?php
                                $args = array(
                                    'post_type'      => 'kredity',
                                    'posts_per_page' => 4,
                                    'meta_key'       => 'ratings_average',
                                    'orderby'        => array(
                                        'meta_value_num' => 'DESC',
                                        'name'            => 'DESC',
                                    ),
                                    'meta_query'     => array(
                                        // Только записи, у которых поле "archive" = 0
                                        array(
                                            'key'   => 'archive',
                                            'value' => '0',
                                        ),
                                        // Только записи, у которых поле "card_bank_link" не пустое
                                        array(
                                            'key'     => 'card_bank_link',
                                            'value'   => '',
                                            'compare' => '!=',
                                        ),
                                    ),
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
                                                    <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></div>
                                                </div>
                                                <div class="card__header-info d-flex align-items-center">
                                                    <div class="card__rating d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php echo the_field('ratings_average'); ?>
                                                    </div>
                                                    <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                        <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                                </svg></a></div>
                                                        <?php $comments_count = wp_count_comments(get_the_ID());
                                                        echo $comments_count->approved ?>
                                                    </div>
                                                    <div class="card__like d-flex align-items-center">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                    <div class="card__header-actions ml-auto">
                                                        <a href=""><svg width="20" height="20" viewBox="0 0 20 20">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use>
                                                            </svg></a>
                                                    </div>
                                                </div>
                                                <div class="card__image my-3">
                                                    <img loading="lazy"
                                                        src="<?php echo the_field('card_logo') ?>"
                                                        alt="
                                    <?
                                        $bank_id = get_field('card_logo', false, false);
                                        $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                        echo $bank_alt;
                                    ?>">
                                                </div>
                                                <ul class="leaders">
                                                    <li class="leaders__item mb-1">
                                                        <div class="leaders__item-title">Макс. сумма</div>
                                                        <div class="leaders__item-value"><?php echo number_format(get_field('credit_max_sum'), 0, '.', ' '); ?> ₽</div>
                                                    </li>
                                                    <li class="leaders__item mb-1">
                                                        <div class="leaders__item-title">Мин. сумма</div>
                                                        <div class="leaders__item-value"><?php echo number_format(get_field('credit_min_sum'), 0, '.', ' '); ?> ₽</div>
                                                    </li>
                                                    <li class="leaders__item mb-1">
                                                        <div class="leaders__item-title">% ставка</div>
                                                        <div class="leaders__item-value"><?php echo get_field('credit_stavka'); ?>%</div>
                                                    </li>
                                                    <li class="leaders__item mb-1">
                                                        <div class="leaders__item-title">Срок кредита</div>
                                                        <div class="leaders__item-value">до <?php
                                                                                            // Переменные
                                                                                            $field = get_field('credit_period');
                                                                                            //$value = $field['value'];
                                                                                            //$label = $field['choices'][ $value ];
                                                                                            echo $field['label'] ?></div>
                                                    </li>
                                                </ul>
                                                <div class="card__actions mt-3 d-flex">
                                                    <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                                                    <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'kredity'; ?>">
                                                        <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use>
                                                        </svg>
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
                    <div class="tab-pane" id="mainOffers5">
                        <div class="horizontal__scroll row">
                            <div class="horizontal__scroll-container">
                                <?php
                                $args = array(
                                    'post_type'      => 'zaimy',
                                    'posts_per_page' => 4,
                                    'meta_key'       => 'ratings_average',
                                    'orderby'        => 'meta_value_num',
                                    'order'          => 'DESC',
                                    'meta_query'     => array(
                                        // Только записи, у которых поле "archive" = 0
                                        array(
                                            'key'   => 'archive',
                                            'value' => '0',
                                        ),
                                        // Только записи, у которых поле "card_bank_link" не пустое
                                        array(
                                            'key'     => 'card_bank_link',
                                            'value'   => '',
                                            'compare' => '!=',
                                        ),
                                    ),
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
                                                    <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></div>
                                                </div>
                                                <div class="card__header-info d-flex align-items-center">
                                                    <div class="card__rating d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php echo the_field('ratings_average'); ?>
                                                    </div>
                                                    <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                        <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                                </svg></a></div>
                                                        <?php $comments_count = wp_count_comments(get_the_ID());
                                                        echo $comments_count->approved ?>
                                                    </div>
                                                    <div class="card__like d-flex align-items-center">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                    <div class="card__header-actions ml-auto">
                                                        <a href=""><svg width="20" height="20" viewBox="0 0 20 20">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use>
                                                            </svg></a>
                                                    </div>
                                                </div>
                                                <div class="card__image my-3">
                                                    <img loading="lazy"
                                                        src="<?php echo the_field('card_logo') ?>"
                                                        <?
                                                        $bank_id = get_field('card_logo',  get_the_ID(), false);
                                                        $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                        ?>
                                                        alt="<?php echo $bank_alt; ?>">
                                                </div>
                                                <ul class="leaders">
                                                    <li class="leaders__item mb-1">
                                                        <div class="leaders__item-title">Сумма займа</div>
                                                        <div class="leaders__item-value"><?php echo number_format(get_field('z_sum'), 0, '.', ' '); ?> ₽</div>
                                                    </li>
                                                    <li class="leaders__item mb-1">
                                                        <div class="leaders__item-title">Срок займа</div>
                                                        <div class="leaders__item-value">до <?php echo get_field('z_time') ?> дней</div>
                                                    </li>
                                                    <li class="leaders__item mb-1">
                                                        <div class="leaders__item-title">% ставка</div>
                                                        <div class="leaders__item-value">от <?php echo get_field('z_stavka'); ?>%</div>
                                                    </li>
                                                    <li class="leaders__item mb-1">
                                                        <div class="leaders__item-title">Кредитная история</div>
                                                        <div class="leaders__item-value"><?php echo get_field('z_history') ?></div>
                                                    </li>
                                                </ul>
                                                <div class="card__actions mt-3 d-flex">
                                                    <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                                                    <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'zaimy'; ?>">
                                                        <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="card__footer mt-3">
                                                    <p>
                                                        <span><?php echo get_field('z_organization_phone') ?></span>
                                                        <span><?php echo get_field('z_organization_email') ?></span>
                                                        <span><?php echo get_field('views', get_the_id()) ?> заявок</span>
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
            </div>
        </div>
        <!-- / best offers -->
        <!-- banks -->
        <div class="section">
            <div class="section__header mb-0 d-flex justify-content-between align-items-end align-items-md-center">
                <h2 class="title mb-0">Банки</h2>
                <a href="<?php echo get_post_type_archive_link('banks'); ?>" class="btn btn-primary btn-sm btn-all">
                    Все
                    <span class="icon ml-1 ml-md-2">
                        <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="row">
                <?php
                $args = array(
                    'post_type' => 'banks',
                    'meta_key' => 'ratings_average',
                    'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc',),
                    'order' => 'DESC',
                    'posts_per_page' => 8,
                );

                $wp_query = new WP_Query($args);

                // Цикл
                if ($wp_query->have_posts()) {
                    $counter = 0;
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                        $counter += 1;
                ?>
                        <div class="col-12 col-md-4 col-lg-4 col-xl-3 mt-3 mt-md-4">
                            <a href="<?php echo the_permalink() ?>" class="card card__horizontal bank__item">
                                <div class="card-container p-2">
                                    <div class="d-flex">
                                        <div class="bank__item-img mr-2">
                                            <img loading="lazy" src="<?php echo get_field('bank_logo') ?>"
                                                alt="<?
                                                        $bank_id = get_field('bank_logo', get_the_ID(), false);
                                                        $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                        echo $bank_alt;
                                                        ?>">
                                        </div>
                                        <div class="bank__item-content">
                                            <div class="card__header-title mt-1 mb-2"><?php echo get_the_title(get_the_ID()) ?></div>
                                            <div class="card__header-info d-flex align-items-center">
                                                <div class="card__rating d-flex align-items-center mr-3">
                                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                        </svg></div>
                                                    <?php echo get_field('ratings_average'); ?>
                                                </div>
                                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                            </svg></a></div>
                                                    <?php echo comments_number('0', '1', '%'); ?>
                                                </div>
                                                <div class="card__header-num">
                                                    №<?php echo $counter ?>
                                                </div>
                                            </div>
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
        <!-- / banks -->
        <!-- news -->
        <div class="section">
            <div class="section__header mb-4 d-flex justify-content-between align-items-end align-items-md-center">
                <h2 class="title mb-0">Новости на Finabank</h2>
                <a href="<?php echo get_category_link(10) ?>" class="btn btn-primary btn-sm btn-all">
                    Все
                    <span class="icon ml-1 ml-md-2">
                        <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="horizontal__scroll">
                <div class="main__news-wrap horizontal__scroll-container">
                    <?php
                    $exclude_id = 0;
                    $args = array(
                        'post_type' => 'post',
                        'cat' => 10,
                        'posts_per_page' => 5,
                        //    'meta_key' => 'views',
                        //    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
                        //    'order' => 'DESC'
                    );
                    $wp_query = new WP_Query($args);
                    $counter = 0;
                    if ($wp_query->have_posts()) {
                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
                            $counter += 1;

                    ?>
                            <div class="main__news-item news__item card div<?php echo $counter ?>">
                                <div class="news__item-wrap card-container h-100">
                                    <?php $news_image = get_the_post_thumbnail_url(); ?>
                                    <?php if ($news_image != ''): ?>
                                        <div class="news__item-img mb-3 mb-xl-2">
                                            <img loading="lazy" src="<?php echo the_post_thumbnail_url() ?>"
                                                alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
                                        </div>

                                    <?php endif; ?>

                                    <div class="card__date mb-2 pt-1"><span>Опубликовано: </span><?php echo get_the_date('d.m.y'); ?></div>
                                    <a href="<?php echo the_permalink() ?>" class="news__item-title h4"><?php echo the_title() ?></a>
                                    <div class="news__item-body d-xl-flex flex-xl-column">
                                        <div class="news__item-content pb-3">
                                            <?php if ($counter == 1): ?>
                                                <p><?php echo the_excerpt_max_charlength(360) ?></p>
                                            <?php else: ?>
                                                <p><?php echo the_excerpt_max_charlength(160) ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="news__item-footer mt-auto">
                                            <div class="d-flex align-items-center">
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
                                                <div class="card__like d-flex align-items-center ml-auto" style="pointer-events: none;">
                                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                </div>
                                            </div>
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
        <!-- / news -->
        <!-- main articles -->
        <div class="section">
            <div class="section__header mb-3 d-flex justify-content-between align-items-end align-items-md-center">
                <h2 class="title mb-0">Статьи</h2>
                <a href="/blog/" class="btn btn-primary btn-sm btn-all article-link-main">
                    Все
                    <span class="icon ml-1 ml-md-2">
                        <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="tabs article-tabs">
                <div class="horizontal__scroll">
                    <ul class="nav nav-tabs horizontal__scroll-container row mb-4" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#mainArticles1" aria-selected="true" data-link="<?php echo get_category_link(38) ?>">Займы</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainArticles2" aria-selected="false" data-link="<?php echo get_category_link(32) ?>">Банковские карты</button>
                        </li>
                        <!--li class="nav-item">
		                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainArticles3" aria-selected="false" data-link="<?php echo get_category_link(56) ?>">Кредитные карты</button>
		                    </li>
		                    <li class="nav-item">
		                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainArticles4" aria-selected="false" data-link="<?php echo get_category_link(57) ?>">Карты рассрочки</button>
		                    </li-->
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainArticles5" aria-selected="false" data-link="<?php echo get_category_link(37) ?>">Кредиты</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainArticles6" aria-selected="false" data-link="<?php echo get_category_link(40) ?>">Разное</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="mainArticles1">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type' => 'post',
                                'cat' => 38, //54
                                'posts_per_page' => 4,
                                'meta_key' => 'views',
                                'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                                'order' => 'DESC',
                            );
                            $wp_query = new WP_Query($args);
                            if ($wp_query->have_posts()) {
                                while ($wp_query->have_posts()) {
                                    $wp_query->the_post(); ?>
                                    <!-- item -->
                                    <div class="article__item card card__vertical size4 offer h-100">
                                        <div class="card-container p-3 d-xl-flex flex-xl-column">
                                            <?php if (get_the_post_thumbnail_url()): ?>
                                                <div class="card__image">
                                                    <img loading="lazy" src="<?php echo the_post_thumbnail_url() ?>"
                                                        alt="<?
                                                                $bank_id = get_post_thumbnail_id(get_the_ID());
                                                                $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                                echo $bank_alt;
                                                                ?>">
                                                </div>
                                            <?php endif; ?>
                                            <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                                            <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                                            <div class="mt-auto">
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
                                                    <div class="card__like d-flex align-items-center ml-auto">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                </div>
                                                <?php if (get_field('page_author')): ?>
                                                    <?php $author_id = get_field('page_author') ?>
                                                    <div class="card__author d-flex align-items-center mt-3">
                                                        <div class="card__author-img">
                                                            <?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                                        </div>
                                                        <div class="card__author-content">
                                                            <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                                                            <div class="rating d-flex align-items-center">
                                                                <?php echo do_shortcode('[ratings id="' . $author_id . '"]'); ?>
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
                            <?php wp_reset_query() ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mainArticles2">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type' => 'post',
                                'cat' => 32,
                                'posts_per_page' => 4,
                                'meta_key' => 'views',
                                'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                                'order' => 'DESC',
                            );
                            $wp_query = new WP_Query($args);
                            if ($wp_query->have_posts()) {
                                while ($wp_query->have_posts()) {
                                    $wp_query->the_post(); ?>
                                    <!-- item -->
                                    <div class="article__item card card__vertical size4 offer h-100">
                                        <div class="card-container p-3 d-xl-flex flex-xl-column">
                                            <?php if (get_the_post_thumbnail_url()): ?>
                                                <div class="card__image">
                                                    <img loading="lazy"
                                                        src="<?php echo the_post_thumbnail_url() ?>"
                                                        alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);  ?>">
                                                </div>
                                            <?php endif; ?>
                                            <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                                            <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                                            <div class="mt-auto">
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
                                                    <div class="card__like d-flex align-items-center ml-auto">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                </div>
                                                <?php if (get_field('page_author')): ?>
                                                    <?php $author_id = get_field('page_author') ?>
                                                    <div class="card__author d-flex align-items-center mt-3">
                                                        <div class="card__author-img">
                                                            <?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                                        </div>
                                                        <div class="card__author-content">
                                                            <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                                                            <div class="rating d-flex align-items-center">
                                                                <?php echo do_shortcode('[ratings id="' . $author_id . '"]'); ?>
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
                            <?php wp_reset_query() ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mainArticles3">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type' => 'post',
                                'cat' => 56,
                                'posts_per_page' => 4,
                                'meta_key' => 'views',
                                'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                                'order' => 'DESC',
                            );
                            $wp_query = new WP_Query($args);
                            if ($wp_query->have_posts()) {
                                while ($wp_query->have_posts()) {
                                    $wp_query->the_post(); ?>
                                    <!-- item -->
                                    <div class="article__item card card__vertical size4 offer h-100">
                                        <div class="card-container p-3 d-xl-flex flex-xl-column">
                                            <?php if (get_the_post_thumbnail_url()): ?>
                                                <div class="card__image">
                                                    <img loading="lazy"
                                                        src="<?php echo the_post_thumbnail_url() ?>"
                                                        alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);  ?>">
                                                </div>
                                            <?php endif; ?>
                                            <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                                            <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                                            <div class="mt-auto">
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
                                                    <div class="card__like d-flex align-items-center ml-auto">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                </div>
                                                <?php if (get_field('page_author')): ?>
                                                    <?php $author_id = get_field('page_author') ?>
                                                    <div class="card__author d-flex align-items-center mt-3">
                                                        <div class="card__author-img">
                                                            <?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                                        </div>
                                                        <div class="card__author-content">
                                                            <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                                                            <div class="rating d-flex align-items-center">
                                                                <?php echo do_shortcode('[ratings id="' . $author_id . '"]'); ?>
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
                            <?php wp_reset_query() ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mainArticles4">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type' => 'post',
                                'cat' => 57,
                                'posts_per_page' => 4,
                                'meta_key' => 'views',
                                'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                                'order' => 'DESC',
                            );
                            $wp_query = new WP_Query($args);
                            if ($wp_query->have_posts()) {
                                while ($wp_query->have_posts()) {
                                    $wp_query->the_post(); ?>
                                    <!-- item -->
                                    <div class="article__item card card__vertical size4 offer h-100">
                                        <div class="card-container p-3 d-xl-flex flex-xl-column">
                                            <?php if (get_the_post_thumbnail_url()): ?>
                                                <div class="card__image">
                                                    <img loading="lazy" src="<?php echo the_post_thumbnail_url() ?>"
                                                        alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);  ?>">
                                                </div>
                                            <?php endif; ?>
                                            <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                                            <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                                            <div class="mt-auto">
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
                                                    <div class="card__like d-flex align-items-center ml-auto">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                </div>
                                                <?php if (get_field('page_author')): ?>
                                                    <?php $author_id = get_field('page_author') ?>
                                                    <div class="card__author d-flex align-items-center mt-3">
                                                        <div class="card__author-img">
                                                            <?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                                        </div>
                                                        <div class="card__author-content">
                                                            <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                                                            <div class="rating d-flex align-items-center">
                                                                <?php echo do_shortcode('[ratings id="' . $author_id . '"]'); ?>
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
                            <?php wp_reset_query() ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mainArticles5">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type' => 'post',
                                'cat' => 37,
                                'posts_per_page' => 4,
                                'meta_key' => 'views',
                                'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                                'order' => 'DESC',
                            );
                            $wp_query = new WP_Query($args);
                            if ($wp_query->have_posts()) {
                                while ($wp_query->have_posts()) {
                                    $wp_query->the_post(); ?>
                                    <!-- item -->
                                    <div class="article__item card card__vertical size4 offer h-100">
                                        <div class="card-container p-3 d-xl-flex flex-xl-column">
                                            <?php if (get_the_post_thumbnail_url()): ?>
                                                <div class="card__image">
                                                    <img loading="lazy" src="<?php echo the_post_thumbnail_url() ?>"
                                                        alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);  ?>">
                                                </div>
                                            <?php endif; ?>
                                            <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                                            <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                                            <div class="mt-auto">
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
                                                    <div class="card__like d-flex align-items-center ml-auto">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                </div>
                                                <?php if (get_field('page_author')): ?>
                                                    <?php $author_id = get_field('page_author') ?>
                                                    <div class="card__author d-flex align-items-center mt-3">
                                                        <div class="card__author-img">
                                                            <?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                                        </div>
                                                        <div class="card__author-content">
                                                            <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                                                            <div class="rating d-flex align-items-center">
                                                                <?php echo do_shortcode('[ratings id="' . $author_id . '"]'); ?>
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
                            <?php wp_reset_query() ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mainArticles6">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type' => 'post',
                                'cat' => 40,
                                'posts_per_page' => 4,
                                'meta_key' => 'views',
                                'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                                'order' => 'DESC',
                            );
                            $wp_query = new WP_Query($args);
                            if ($wp_query->have_posts()) {
                                while ($wp_query->have_posts()) {
                                    $wp_query->the_post(); ?>
                                    <!-- item -->
                                    <div class="article__item card card__vertical size4 offer h-100">
                                        <div class="card-container p-3 d-xl-flex flex-xl-column">
                                            <?php if (get_the_post_thumbnail_url()): ?>
                                                <div class="card__image">
                                                    <img loading="lazy"
                                                        src="<?php echo the_post_thumbnail_url() ?>"
                                                        alt="<?php echo  get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);  ?>">
                                                </div>
                                            <?php endif; ?>
                                            <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
                                            <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                                            <div class="mt-auto">
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
                                                    <div class="card__like d-flex align-items-center ml-auto">
                                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                                    </div>
                                                </div>
                                                <?php if (get_field('page_author')): ?>
                                                    <?php $author_id = get_field('page_author') ?>
                                                    <div class="card__author d-flex align-items-center mt-3">
                                                        <div class="card__author-img">
                                                            <?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                                        </div>
                                                        <div class="card__author-content">
                                                            <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                                                            <div class="rating d-flex align-items-center">
                                                                <?php echo do_shortcode('[ratings id="' . $author_id . '"]'); ?>
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
                            <?php wp_reset_query() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / main articles -->
        <!-- reviews -->
        <div id="bankReviews" class="section">
            <div class="section__header mb-3 d-flex justify-content-between align-items-end align-items-md-center">
                <h2 class="title mb-0">Отзывы</h2>
                <a href="/reviews/"
                    class="btn btn-primary btn-sm btn-all  reviews-link-main" data-tax="creditcard">
                    Все
                    <span class="icon ml-1 ml-md-2">
                        <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="tabs">
                <div class="horizontal__scroll">
                    <ul class="nav nav-tabs horizontal__scroll-container row mb-4 reviews-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#mainReviews1" aria-selected="true"
                                data-tax="creditcard">Кредитные карты</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainReviews2" aria-selected="false" data-tax="debetcard">Дебетовые карты</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainReviews3" aria-selected="false" data-tax="installmentcard">Карты рассрочки</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainReviews4" aria-selected="false" data-tax="banks">Банки</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainReviews5" aria-selected="false" data-tax="kredity">Кредиты</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainReviews6" aria-selected="false" data-tax="zaimy">Займы</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="mainReviews1">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                            $custom_offset = 0;

                            // fetch posts in all those categories
                            $posts = get_objects_in_term(2, 'bankcards');

                            $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                                     FROM {$wpdb->comments} WHERE
                                     comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
                                     ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                            $comments_list = $wpdb->get_results($sql);
                            get_template_part(
                                'all_template/reviews_list',
                                null,
                                ['TYPE' => 'bankcards', 'DATA' => $comments_list, 'bank_id__field_name' => 'bank_choise']
                            );
                            ?>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mainReviews2">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php

                            $ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                            $custom_offset = 0;

                            // fetch posts in all those categories
                            $posts = get_objects_in_term(7, 'bankcards');

                            $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                                     FROM {$wpdb->comments} WHERE
                                     comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
                                     ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                            $comments_list = $wpdb->get_results($sql);

                            get_template_part('all_template/reviews_list', null, ['TYPE' => 'bankcards', 'DATA' => $comments_list, 'bank_id__field_name' => 'bank_choise']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mainReviews3">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php

                            $ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                            $custom_offset = 0;
                            $posts = get_objects_in_term(8, 'bankcards');
                            // fetch posts in all those categories
                            $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                                     FROM {$wpdb->comments} WHERE
                                     comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
                                     ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                            $comments_list = $wpdb->get_results($sql);

                            get_template_part('all_template/reviews_list', null, ['TYPE' => 'bankcards', 'DATA' => $comments_list, 'bank_id__field_name' => 'bank_choise']);
                            ?>



                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mainReviews4">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                            $custom_offset = 0;

                            // fetch posts in all those categories
                            $posts = get_cpt_ids('banks');

                            $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                                     FROM {$wpdb->comments} WHERE
                                     comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
                                     ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";
                            $comments_list = $wpdb->get_results($sql);

                            if (count($comments_list) > 0) {
                                foreach ($comments_list as $comm) {

                                    $comment_id = $comm->comment_ID;
                                    $comment = get_comment($comment_id);
                                    $comment_post_id = $comment->comment_post_ID;
                                    $user = get_userdata($comment->user_id);
                                    $user_email = '';
                                    $user_role = '';
                                    if (!empty($user)) {
                                        $user_email = $user->user_email;
                                        $user_role = $user->roles;
                                    }

                                    $author = get_comment_author($comment_id);
                                    $city = get_comment_meta($comment_id, 'city', true); ?>
                                    <!-- item -->
                                    <div class="reviews__item">
                                        <div class="reviews__item-body">
                                            <div class="reviews__header d-flex align-items-center mb-2">
                                                <div class="reviews__header-logo">
                                                    <img loading="lazy"
                                                        src="<?php echo the_field('bank_logo', $comment_post_id) ?>"
                                                        alt="<?
                                                                $bank_id = get_field('bank_logo', $comment_post_id, false);
                                                                $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                                echo $bank_alt;
                                                                ?>">
                                                </div>

                                                <div class="reviews__header-meta ml-3">
                                                    <a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($bank_id) ?></a>
                                                    <div class="d-flex">
                                                        <div class="card__rating d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo the_field('ratings_average', $comment_post_id); ?>
                                                        </div>
                                                        <div class="card__icon d-flex align-items-center">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo comments_number('0', '1', '%', $comment_post_id); ?>
                                                        </div>
                                                        <div class="card__date d-none d-md-block ml-auto"><?php echo  get_comment_date('d.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reviews__item-content">
                                                <p><?php echo $comment->comment_content; ?></p>
                                            </div>
                                        </div>
                                        <div class="reviews__item-footer">
                                            <div class="reviews__author d-flex align-items-center mt-3">
                                                <div class="reviews__author-img mr-3"><img loading="lazy" src="<?php echo get_avatar_url($comment, array(
                                                                                                                    'size' => 60,
                                                                                                                    'default' => 'identicon',
                                                                                                                )); ?>" alt="<?php echo $author; ?>"></div>
                                                <div class="reviews__author-content">
                                                    <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                                                    <div class="reviews__author-info d-flex">
                                                        <div class="card__icon d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php if (empty($user_role[0])):
                                                                echo 'Гость';
                                                            else:
                                                                echo $user_role[0];
                                                            endif; ?>
                                                        </div>
                                                        <?php if ($city != ''): ?>
                                                            <div class="card__icon d-flex align-items-center">
                                                                <div class="mr-2"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                                                    </svg></div>
                                                                <?php echo $city ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / item -->
                                <?php }
                            } else { ?>
                                <p class="col-12">Пока нет отзывов.</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mainReviews5">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                            $custom_offset = 0;

                            // fetch posts in all those categories
                            $posts = get_cpt_ids('kredity');

                            $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                                     FROM {$wpdb->comments} WHERE
                                     comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
                                     ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                            $comments_list = $wpdb->get_results($sql);


                            get_template_part('all_template/reviews_list', null, ['TYPE' => 'kredity', 'DATA' => $comments_list]);

                            ?>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="mainReviews6">
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                            $custom_offset = 0;

                            // fetch posts in all those categories
                            $posts = get_cpt_ids('zaimy');

                            $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                                     FROM {$wpdb->comments} WHERE
                                     comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
                                     ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                            $comments_list = $wpdb->get_results($sql);

                            get_template_part('all_template/reviews_list', null, ['TYPE' => 'zaimy', 'DATA' => $comments_list]);
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / reviews -->
    </div>
    <?php
    $about = get_field('about_block');
    if ($about): ?>
        <!-- main about -->
        <div class="section main__about about">
            <div class="container">
                <div class="row  justify-content-end">
                    <div class="col-12 col-md-6 col-xl-5">
                        <?php echo $about['верхний_текст']; ?>
                        <div class="about_custom_container row mt-2 mb-2">
                            <div class="col-4">
                                <div class="h1 font-weight-bold mb-0"><?php echo $about['f_val']; ?></div>
                                <p><?php echo $about['f_text']; ?></p>
                            </div>
                            <div class="col-4">
                                <div class="h1 font-weight-bold mb-0"><?php echo $about['d_val']; ?></div>
                                <p><?php echo $about['d_text']; ?></p>
                            </div>
                            <div class="col-4">
                                <div class="h1 font-weight-bold mb-0"><?php echo $about['t_val']; ?></div>
                                <p><?php echo $about['t_text']; ?></p>
                            </div>
                        </div>
                        <a href="<?php echo get_page_link(169) ?>" class="btn btn-primary w-100"><?php echo $about['about_link']; ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- / main about -->
    <?php endif; ?>

    <div class="container">
        <!-- main experts -->
        <div class="section">
            <div class="section__header mb-4 d-flex justify-content-between align-items-end align-items-md-center">
                <h2 class="title mb-0">Наши эксперты</h2>
                <a href="<?php echo get_post_type_archive_link('team'); ?>" class="btn btn-primary btn-sm btn-all">
                    Все
                    <span class="icon ml-1 ml-md-2">
                        <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="horizontal__scroll row">
                <div class="horizontal__scroll-container">

                    <?php
                    $args = array(
                        'post_type'             => 'team',
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
                            <div class="expert__card card size4 text-center">
                                <div class="card-container pt-0 pb-3 pb-md-4">
                                    <div class="expert__card-img mt-n6 mx-auto mb-3">
                                        <img loading="lazy" src="<?php echo the_field('expert_logo') ?>"
                                            alt="<?
                                                    $bank_id = get_field('expert_logo', get_the_ID(), false);
                                                    $bank_alt = get_post_meta($bank_id, '_wp_attachment_image_alt', true);
                                                    echo $bank_alt;
                                                    ?>">
                                    </div>
                                    <a href="<?php echo the_permalink() ?>" class="expert__card-title h4 stretched-link mb-2"><?php echo the_title() ?></a>
                                    <div class="my-3 d-flex justify-content-center">
                                        <div class="rating d-flex align-items-center">
                                            <?php if (function_exists('the_ratings')) {
                                                the_ratings();
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="expert__card-description">
                                        <?php if (have_rows('expert_position')): ?>
                                            <div class="expert__card-description">
                                                <?php while (have_rows('expert_position')): the_row();
                                                    $position = get_sub_field('position');
                                                ?>
                                                    <p><?php echo $position ?></p>
                                                <?php endwhile; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="expert__card-social mt-3 mb-2 d-flex justify-content-center">
                                        <?php if (have_rows('expert_socials')):
                                            while (have_rows('expert_socials')) : the_row();
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
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    // Возвращаем оригинальные данные поста. Сбрасываем $post.
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
        <!-- / main experts -->
        <!-- main text -->
        <div class="section">
            <div class="mb-6 wysiwyg">
                <?php echo the_content() ?>
            </div>
        </div>
        <!-- / main text -->
    </div>
</main><!-- #main -->

<?php get_footer();
