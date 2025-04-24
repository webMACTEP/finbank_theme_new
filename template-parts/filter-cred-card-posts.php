<?php
// Инициализация переменных
$query__card = get_field('archive') != true ? 'query__card' : '';
$bank_id = get_field('bank_choise');
$terms = wp_get_post_terms(get_the_ID(), 'bankcards', array('fields' => 'all'));
$term_slug = '';

if (!empty($terms) && !is_wp_error($terms)) {
    $term_slug = esc_attr($terms[0]->slug);
}

$apply_now = get_field('apply_now_select_products', get_the_ID());

// Дополнительные переменные для удобства
$bank_phone = get_field('bank_phone', $bank_id);

//$card_bank_link = get_field('card_bank_link');

$encoded_link = get_field('card_bank_link');
$card_bank_link = base64_encode($encoded_link);


$bank_email = get_field('bank_email', $bank_id);
$bank_license = get_field('bank_license', $bank_id);
$card_logo = get_field('card_logo');
$bank_logo = get_field('bank_logo', $bank_id);
$card_cred_limit = get_field('card_cred_limit');
$card_period = get_field('card_period');
$card_cost = get_field('card_cost');
$card_stavka = get_field('card_stavka');
$card_answ = get_field('card_answ');
$card_cashback = get_field('card_cashback');
$ratings_average = get_field('ratings_average');
$views = get_post_meta(get_the_ID(), 'views', true);
$comments_count = wp_count_comments(get_the_ID());
$about_item = get_field('about_item', get_the_ID());
$if_in_tab = get_field('if_in_tab', get_the_ID());
$plus_and_minus_tab = get_field('plus_and_minus_tab', get_the_ID());
//$card_other_state = get_field('card_other_state');
$card_other_state =  get_field('card_other_state', $ID);


// Определение необходимости отображения кнопки "Подробнее"
$show_btn_detail = have_rows('product_tar', get_the_ID()) || $about_item || $if_in_tab || $plus_and_minus_tab;
?>

<div class="card mb-4 <?php echo esc_attr($query__card); ?>">
    <div class="card-container">
        <div class="item-content">
            <div class="item-about">
                <!-- Изображение -->
                <div class="item-image">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <?php if ($card_logo):
                            $logo_alt = get_post_meta($card_logo, '_wp_attachment_image_alt', true);
                        ?>
                            <img src="<?php echo $card_logo ?>" alt="<?php echo esc_attr($logo_alt); ?>">
                        <?php endif; ?>
                    </a>
                </div>

                <div class="item-info">

                    <a href="<?php echo esc_url(get_permalink()); ?>" class="font-weight-semibold">
                        <?php echo esc_html(get_the_title($bank_id)); ?>
                    </a>
                    <span class="item-title">
                        <?php
                        $alter_title = get_field('alter_title');
                        echo esc_html(!empty($alter_title) ? $alter_title : get_the_title());
                        ?>
                    </span>

                    <!-- Рейтинги hor-->
                    <div class="rait-hor rait-panel flex-wrap justify-content-between align-items-center">
                        <div class="d-flex align-items-center my-2 my-sm-0 ">
                            <div class="card__rating d-flex align-items-center mr-3">
                                <div class="mr-2">
                                    <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                    </svg>
                                </div>
                                <?php echo esc_html($ratings_average); ?>
                            </div>
                            <div class="card__icon d-flex align-items-center mr-3">
                                <div class="mr-2">
                                    <svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#eye" x="0" y="0"></use>
                                    </svg>
                                </div>
                                <?php echo intval($views); ?>
                            </div>
                            <div class="position-relative card__icon d-flex align-items-center mr-3">
                                <div class="mr-2">
                                    <a href="<?php echo esc_url(get_permalink()); ?>#comments" data-target="comments" class="stretched-link">
                                        <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                            <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                        </svg>
                                    </a>
                                </div>
                                <?php
                                if ($comments_count && isset($comments_count->approved)) {
                                    echo intval($comments_count->approved);
                                }
                                ?>
                            </div>
                            <div class="position-relative card__like d-flex align-items-center">
                                <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
            <!-- Рейтинги cards-->
            <div class="rait-cards rait-panel  flex-wrap justify-content-between align-items-center">
                <div class="d-flex align-items-center my-2 my-sm-0 subraitings">
                    <div class="card__rating d-flex align-items-center mr-3">
                        <div class="mr-2">
                            <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                            </svg>
                        </div>
                        <?php echo esc_html($ratings_average); ?>
                    </div>
                    <div class="card__icon d-flex align-items-center mr-3">
                        <div class="mr-2">
                            <svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
                                <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#eye" x="0" y="0"></use>
                            </svg>
                        </div>
                        <?php echo intval($views); ?>
                    </div>
                    <div class="position-relative card__icon d-flex align-items-center mr-3">
                        <div class="mr-2">
                            <a href="<?php echo esc_url(get_permalink()); ?>#comments" data-target="comments" class="stretched-link">
                                <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                    <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                </svg>
                            </a>
                        </div>
                        <?php
                        if ($comments_count && isset($comments_count->approved)) {
                            echo intval($comments_count->approved);
                        }
                        ?>
                    </div>
                    <div class="position-relative card__like d-flex align-items-center">
                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                    </div>
                </div>
            </div>

            <div class="item-column">
                <span class="card__field-title">Кред. лимит:</span>
                <span class="card__field-num"><?php echo number_format(intval($card_cred_limit), 0, '.', ' '); ?> ₽</span>
            </div>
            <div class="item-column">
                <span class="card__field-title">Без процентов:</span>
                <span class="card__field-num"><?php echo esc_html($card_period['label'] ?? ''); ?></span>
            </div>
            <div class="item-column">
                <span class="card__field-title">Стоимость:</span>
                <span class="card__field-num">От <?php echo esc_html($card_cost); ?> ₽</span>
            </div>

            <!-- Кнопка оформить -->
            <div class="item-buttons">
                <?php if ($card_bank_link): ?>
                    <div class="item-buttons-cont">

                        <span
                            class="link-data btn btn-primary btn-block"
                            data-link="<?= esc_attr($card_bank_link); ?>"
                            onclick="<?php echo esc_js(get_metrika_for_list($card_bank_link)); ?> return true;">
                            Оформить
                        </span>
                    </div>
                <?php else: ?>
                    <div class="item-buttons-cont">
                        <span data-popap-apply-id="<?php echo esc_attr(get_the_ID()); ?>"
                            onclick="<?php echo esc_js(get_metrika_for_list($card_bank_link)); ?> return true;"
                            class="apply_now_btm btn btn-primary btn-block">
                            Оформить
                        </span>
                    </div>
                <?php endif; ?>

                <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'creditcard'; ?>">
                    <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve">
                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use>
                    </svg>
                </a>
            </div>

        </div>
        <div class="item-footer">

            <!-- метки -->



            <div class="other-param">

                <ul>
                    <?php foreach ($card_other_state as $item): ?>
                        <li><?php echo $item; ?></li>
                    <?php endforeach; ?>
                </ul>

            </div>



            <div class="tabs-and-btns w-100">
                <div class="card__footer-new d-flex justify-content-between align-items-center">
                    <?php
                    $ID = get_the_ID();
                    // Повторная инициализация переменных (можно оптимизировать)
                    $about_item = get_field('about_item', $ID);
                    $if_in_tab = get_field('if_in_tab', $ID);
                    $plus_and_minus_tab = get_field('plus_and_minus_tab', $ID);
                    $show_btn_detail = have_rows('product_tar', $ID) || $about_item || $if_in_tab || $plus_and_minus_tab;
                    ?>

                    <?php if ($show_btn_detail): ?>
                        <div data-id="<?php echo esc_attr($ID); ?>" data-close="Скрыть" data-open="Подробнее" class="open__dop-btn">

                            <div class="navigation__item-arrow">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12V9M9 6H9.0075M16.5 9C16.5 13.1421 13.1421 16.5 9 16.5C4.85786 16.5 1.5 13.1421 1.5 9C1.5 4.85786 4.85786 1.5 9 1.5C13.1421 1.5 16.5 4.85786 16.5 9Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </div>
                            <div class="open__dop-btn-text">Подробнее</div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="tabs">
                    <!-- Здесь можно добавить содержимое вкладок -->
                </div>
            </div>
        </div>



    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Функция для установки режима отображения
            function setLayout(layout) {
                const listPosts = document.querySelectorAll(".list_posts");
                if (layout === "horisont") {
                    document.querySelectorAll(".horisont-butt").forEach(function(el) {
                        el.classList.add("active");
                    });
                    document.querySelectorAll(".cards-butt").forEach(function(el) {
                        el.classList.remove("active");
                    });
                    listPosts.forEach(function(el) {
                        el.classList.add("horisont");
                        el.classList.remove("cards");
                    });
                } else if (layout === "cards") {
                    document.querySelectorAll(".cards-butt").forEach(function(el) {
                        el.classList.add("active");
                    });
                    document.querySelectorAll(".horisont-butt").forEach(function(el) {
                        el.classList.remove("active");
                    });
                    listPosts.forEach(function(el) {
                        el.classList.add("cards");
                        el.classList.remove("horisont");
                    });
                }
            }

            // При загрузке страницы проверяем сохранённый режим
            var savedLayout = localStorage.getItem("layout");
            if (savedLayout) {
                setLayout(savedLayout);
            }

            // Обработчик для кнопки с классом horisont-butt
            var horisontButtons = document.querySelectorAll(".horisont-butt");
            horisontButtons.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    setLayout("horisont");
                    localStorage.setItem("layout", "horisont");
                });
            });

            // Обработчик для кнопки с классом cards-butt
            var cardsButtons = document.querySelectorAll(".cards-butt");
            cardsButtons.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    setLayout("cards");
                    localStorage.setItem("layout", "cards");
                });
            });
        });
    </script>

</div>