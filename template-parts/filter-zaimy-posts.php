<?php
$query__card = get_field('archive') ? '' : 'query__card';
$apply_now = get_field('apply_now_select_products', get_the_ID());
$organization_phone = get_field('z_organization_phone');
$organization_site = get_field('z_organization_site');
$card_bank_link = get_field('card_bank_link');
$z_sum = get_field('z_sum');
$z_history = get_field('z_history');
$z_stavka = get_field('z_stavka');
$z_oldness = get_field('z_oldness');
$z_time = get_field('z_time');
$z_answer = get_field('z_answer');
$z_organization_name = get_field('z_organization_name');
$ratings_average = get_field('ratings_average');
$views = get_post_meta(get_the_ID(), 'views', true);
$logo_id = get_field('card_logo', get_the_ID(), false);
$logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
$date_actually = get_the_modified_date('d.m.Y', get_the_ID());

// Функция YearTextArg должна быть определена ранее в коде
// function YearTextArg($number) { /* реализация */ }

?>
<div class="card card__horizontal mb-4 <?= esc_attr($query__card); ?>">
    <div class="card-container d-flex flex-wrap">
        <div class="card__header d-flex justify-content-between align-items-center mb-3 flex-grow-1 order-1">
            <h4 class="mb-0">
                <a href="<?= esc_url(get_the_permalink()); ?>">
                    <?= esc_html(get_the_title()); ?>
                </a>
            </h4>
            <div class="card__header_right">
                <?php if (get_field('archive') === true): ?>
                    <div class="card__archive">Архив</div>
                <?php endif; ?>
                <a class="btn__compare <?= esc_attr(my_compare_btn(get_the_ID())); ?>" data-id="<?= esc_attr(get_the_ID()); ?>" data-tax="zaimy">
                    <!-- SVG код -->
                </a>
            </div>
        </div>
        <div class="card__footer mb-md-3 flex-grow-1 order-3 order-md-2">
            <p>
                <span class="mr-2 mr-md-5">
                    <?php if ($organization_phone): ?>
                        <a href="tel:<?= esc_attr(preg_replace('/\D/', '', $organization_phone)); ?>">
                            <?= esc_html($organization_phone); ?>
                        </a>
                    <?php endif; ?>
                </span>
                <span class="mr-2 mr-md-5">
                    <?php if ($card_bank_link): ?>
                        <a href="<?= esc_url($card_bank_link); ?>"
                            onclick="<?= esc_attr(get_metrika_for_list($card_bank_link)); ?> return true;"
                            target="_blank">
                            <?= esc_html($organization_site); ?>
                        </a>
                    <?php else: ?>
                        <a data-popap-apply-id="<?= esc_attr(get_the_ID()); ?>"
                            class="off_site_link <?= $apply_now ? 'apply_now_btm' : 'out_exit_link'; ?>"
                            onclick="<?= esc_attr(get_metrika_for_list($card_bank_link)); ?> return true;">
                            <?= esc_html($organization_site); ?>
                        </a>
                    <?php endif; ?>
                </span>
                <span><?= intval($views); ?> заявок</span>
            </p>
        </div>
        <div class="row flex-grow-1 order-2 order-md-3">
            <div class="col-12 col-md-6 col-lg-5 mb-3 mb-md-0">
                <div class="card__image">
                    <a href="<?= esc_url(get_the_permalink()); ?>">
                        <?php if ($logo_id): ?>
                            <img src="<?= esc_url(get_field('card_logo')); ?>"
                                alt="<?= esc_attr($logo_alt); ?>">
                        <?php else: ?>
                            <img src="<?= esc_url(get_template_directory_uri() . '/path/to/default-image.jpg'); ?>"
                                alt="Default Alt Text">
                        <?php endif; ?>
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="card__field my-1">
                            <span class="card__field-title">Сумма:</span>
                            <span class="card__field-num"><?= number_format($z_sum, 0, '.', ' '); ?> ₽</span>
                        </div>
                        <div class="card__field my-1">
                            <span class="card__field-title">Кредитная история:</span>
                            <span class="card__field-num"><?= esc_html($z_history); ?></span>
                        </div>
                        <div class="card__field my-1">
                            <span class="card__field-title">% ставка:</span>
                            <span class="card__field-num">От <?= esc_html($z_stavka); ?>%</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="card__field my-1">
                            <span class="card__field-title">Возраст:</span>
                            <span class="card__field-num">От <?= intval($z_oldness); ?> <?= esc_html(YearTextArg($z_oldness)); ?></span>
                        </div>
                        <div class="card__field my-1">
                            <span class="card__field-title">Срок:</span>
                            <span class="card__field-num">до <?= esc_html($z_time); ?> дней</span>
                        </div>
                        <div class="card__field my-1">
                            <span class="card__field-title">Решение:</span>
                            <span class="card__field-num"><?= esc_html($z_answer); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mx-n1 mx-md-n3">
                    <?php if ($card_bank_link): ?>
                        <div class="col-6 px-1 px-md-2">
                            <a href="<?= esc_url($card_bank_link); ?>"
                                target="_blank"
                                onclick="<?= esc_attr(get_metrika_for_list($card_bank_link)); ?> return true;"
                                class="btn btn-primary btn-block">
                                Оформить
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="col-6 px-1 px-md-2">
                            <a data-popap-apply-id="<?= esc_attr(get_the_ID()); ?>"
                                target="_blank"
                                onclick="<?= esc_attr(get_metrika_for_list($card_bank_link)); ?> return true;"
                                class="apply_now_btm btn btn-primary btn-block">
                                Оформить
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="col-6 px-1 px-md-2">
                        <a href="<?= esc_url(get_the_permalink()); ?>" class="btn btn-outline-alternative btn-block">
                            Подробнее
                        </a>
                    </div>
                </div>
                <div class="d-sm-flex flex-wrap justify-content-between align-items-center mt-3">
                    <a href="<?= esc_url(get_the_permalink()); ?>" class="font-weight-semibold">
                        <?= esc_html($z_organization_name); ?>
                    </a>
                    <div class="ml-xl-auto d-flex align-items-center my-2 my-sm-0">
                        <div class="card__rating d-flex align-items-center mr-3">
                            <div class="mr-2">
                                <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                    <use xlink:href="<?= esc_url(get_template_directory_uri() . '/img/icons.svg#starLine'); ?>" x="0" y="0"></use>
                                </svg>
                            </div>
                            <?= esc_html($ratings_average); ?>
                        </div>
                        <div class="card__icon d-flex align-items-center mr-3">
                            <div class="mr-2">
                                <svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
                                    <use xlink:href="<?= esc_url(get_template_directory_uri() . '/img/icons.svg#eye'); ?>" x="0" y="0"></use>
                                </svg>
                            </div>
                            <?= intval($views); ?>
                        </div>
                        <div class="position-relative card__icon d-flex align-items-center mr-3">
                            <div class="mr-2">
                                <a href="<?= esc_url(get_the_permalink()); ?>#comments" data-target="comments" class="stretched-link">
                                    <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                        <use xlink:href="<?= esc_url(get_template_directory_uri() . '/img/icons.svg#commentLine'); ?>" x="0" y="0"></use>
                                    </svg>
                                </a>
                            </div>
                            <?php
                            $comments_count = wp_count_comments(get_the_ID());
                            echo intval($comments_count->approved);
                            ?>
                        </div>
                        <div class="position-relative card__like d-flex align-items-center">
                            <?= do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tabs-and-btns w-100">
            <div class="card__footer-new w-100 d-flex justify-content-between align-items-center">
                <?php
                $ID = get_the_ID();
                $about_item = get_field('about_item', $ID);
                $if_in_tab = get_field('if_in_tab', $ID);
                $plus_and_minus_tab = get_field('plus_and_minus_tab', $ID);
                $show_btn_detail = false;
                if (have_rows('product_tar', $ID) || $about_item || $if_in_tab || $plus_and_minus_tab) {
                    $show_btn_detail = true;
                }
                ?>

                <?php if ($show_btn_detail): ?>
                    <div data-id="<?= esc_attr($ID); ?>" data-close="Скрыть" data-open="Подробнее" class="open__dop-btn">
                        <div class="open__dop-btn-text">Подробнее</div>
                        <div class="navigation__item-arrow">
                            <svg width="12" height="6" viewBox="0 0 12 6">
                                <use xlink:href="<?= esc_url(get_template_directory_uri() . '/img/icons.svg#arrow'); ?>" x="0" y="0"></use>
                            </svg>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($date_actually): ?>
                    <div class="date_actually">Обновлено: <?= esc_html($date_actually); ?></div>
                <?php endif; ?>
            </div>

            <div class="tabs">
                <!-- Здесь можно добавить содержимое вкладок -->
            </div>
        </div>

        <?php if (get_the_ID() == 5637): ?>
            <!--
            <div class="row flex-grow-1 order-3">
                <div class="col-12">
                    <div class="post-more">
                        <div class="post-more-link">Подробнее</div>
                        <div class="post-more-content" style="display:none;">
                            “Надо Денег” — онлайн-сервис по выдаче микрозаймов. Здесь заемщики могут получить на прозрачных условиях до 30 тысяч рублей на срок от 7 до 30 дней. Как и во многих других компаниях, здесь действует специальное предложение для новых заемщиков — они могут оформить свой первый заем под 0% в день.
                        </div>
                    </div>
                </div>
            </div>
            -->
        <?php endif; ?>
    </div>
</div>