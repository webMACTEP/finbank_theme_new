<?php
$query__card = '';
if (!get_field('archive')) {
    $query__card = 'query__card';
}

$bank_id = get_field('product_bank');
$apply_now = get_field('apply_now_select_products', get_the_ID());
$ID = get_the_ID();
?>
<div data-id="<?php echo esc_attr($ID); ?>" class="123 card card__horizontal mb-4 <?php echo esc_attr($query__card); ?>">
    <div class="card-container d-flex flex-wrap">
        <div class="card__header d-flex justify-content-between align-items-center mb-3 flex-grow-1 order-1">
            <div class="mb-0">
                <a class="h4" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</div>
            <div class="card__header_right">
                <?php if (get_field('archive')): ?>
                    <div class="card__archive">Архив</div>
                <?php endif; ?>
                <a class="btn__compare <?php echo esc_attr(my_compare_btn($ID)); ?>" data-id="<?php echo esc_attr($ID); ?>" data-tax="kredity">
                    <svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                        <!-- SVG Path -->
                    </svg>
                </a>
            </div>
        </div>
        <div class="card__footer mb-md-3 flex-grow-1 order-3 order-md-2">
            <p>
                <span class="mr-2 mr-md-5">
                    <a href="tel:<?php echo esc_attr(preg_replace('![^0-9]+!', '', get_field('bank_phone', $bank_id))); ?>">
                        <?php the_field('bank_phone', $bank_id); ?>
                    </a>
                </span>
                <span class="mr-2 mr-md-5">
                    <?php if (get_field('card_bank_link')): ?>
                        <a href="<?php echo esc_url(get_field('card_bank_link')); ?>"
                            onclick="<?php echo esc_attr(get_metrika_for_list(get_field('card_bank_link'))); ?> return true;"
                            target="_blank">
                            <?php echo esc_html(get_field('bank_email', $bank_id)); ?>
                        </a>
                    <?php else: ?>
                        <a href="#"
                            data-popap-apply-id="<?php echo esc_attr($ID); ?>"
                            class="off_site_link <?php echo $apply_now ? 'apply_now_btm' : 'out_exit_link'; ?>"
                            onclick="<?php echo esc_attr(get_metrika_for_list(get_field('card_bank_link'))); ?> return true;">
                            <?php echo esc_html(get_field('bank_email', $bank_id)); ?>
                        </a>
                    <?php endif; ?>
                </span>
                <span class="mr-2 mr-md-5">Лицензия: <?php the_field('bank_license', $bank_id); ?></span>
                <span><?php echo esc_html(get_post_meta($ID, 'views', true)); ?> заявок</span>
            </p>
        </div>
        <div class="row flex-grow-1 order-2 order-md-3">
            <div class="col-12 col-md-6 col-lg-5 mb-3 mb-md-0">
                <div class="card__image">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url(get_field('card_logo')); ?>"
                            alt="<?php
                                    $logo_id = get_field('card_logo', $ID, false);
                                    $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                    echo esc_attr($logo_alt);
                                    ?>">
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="card__field my-1">
                            <span class="card__field-title">Макс. сумма:</span>
                            <span class="card__field-num"><?php echo number_format(get_field('credit_max_sum'), 0, '.', ' '); ?> ₽</span>
                        </div>
                        <div class="card__field my-1">
                            <span class="card__field-title">Мин. сумма</span>
                            <span class="card__field-num"><?php echo number_format(get_field('credit_min_sum'), 0, '.', ' '); ?> ₽</span>
                        </div>
                        <div class="card__field my-1">
                            <span class="card__field-title">% ставка</span>
                            <span class="card__field-num">От <?php the_field('credit_stavka'); ?>%</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="card__field my-1">
                            <span class="card__field-title">Возраст:</span>
                            <span class="card__field-num">От <?php echo esc_html(get_field('credit_oldness')); ?> <?php echo esc_html(YearTextArg(get_field('credit_oldness'))); ?></span>
                        </div>
                        <div class="card__field my-1">
                            <span class="card__field-title">Срок:</span>
                            <span class="card__field-num">до <?php
                                                                $field = get_field('credit_period');
                                                                if (is_array($field) && isset($field['label'])) {
                                                                    echo esc_html($field['label']);
                                                                }
                                                                ?></span>
                        </div>
                        <div class="card__field my-1">
                            <span class="card__field-title">Решение:</span>
                            <span class="card__field-num"><?php the_field('credit_answer'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mx-n1 mx-md-n3">
                    <?php if (reclink($ID)): ?>
                        <div class="col-6 px-1 px-md-2">
                            <a href="<?php echo esc_url(get_field('card_bank_link')); ?>"
                                target="_blank"
                                onclick="<?php echo esc_attr(get_metrika_for_list(get_field('card_bank_link'))); ?> return true;"
                                class="btn btn-primary btn-block">Оформить</a>
                        </div>
                    <?php else: ?>
                        <div class="col-6 px-1 px-md-2">
                            <a href="#"
                                data-popap-apply-id="<?php echo esc_attr($ID); ?>"
                                target="_blank"
                                onclick="<?php echo esc_attr(get_metrika_for_list(get_field('card_bank_link'))); ?> return true;"
                                class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                        </div>
                    <?php endif; ?>
                    <div class="col-6 px-1 px-md-2">
                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-alternative btn-block">Подробнее</a>
                    </div>
                </div>
                <div class="d-sm-flex flex-wrap justify-content-between align-items-center mt-3">
                    <a href="<?php echo esc_url(get_permalink($bank_id)); ?>" class="font-weight-semibold"><?php echo esc_html(get_the_title($bank_id)); ?></a>
                    <div class="ml-xl-auto d-flex align-items-center my-2 my-sm-0">
                        <div class="card__rating d-flex align-items-center mr-3">
                            <div class="mr-2">
                                <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                </svg>
                            </div>
                            <?php the_field('ratings_average'); ?>
                        </div>
                        <div class="card__icon d-flex align-items-center mr-3">
                            <div class="mr-2">
                                <svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use>
                                </svg>
                            </div>
                            <?php echo esc_html(get_post_meta($ID, 'views', true)); ?>
                        </div>
                        <div class="position-relative card__icon d-flex align-items-center mr-3">
                            <div class="mr-2">
                                <a href="<?php the_permalink(); ?>#comments" data-target="comments" class="stretched-link">
                                    <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                    </svg>
                                </a>
                            </div>
                            <?php comments_number('0', '1', '%'); ?>
                        </div>
                        <div class="position-relative card__like d-flex align-items-center">
                            <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tabs-and-btns w-100">
            <div class="card__footer-new w-100 d-flex justify-content-between align-items-center">
                <?php
                $about_item = get_field('about_item', $ID);
                $if_in_tab = get_field('if_in_tab', $ID);
                $plus_and_minus_tab = get_field('plus_and_minus_tab', $ID);
                $show_btn_detail = false;
                if (have_rows('product_tar', $ID) || $about_item || $if_in_tab || $plus_and_minus_tab) {
                    $show_btn_detail = true;
                }
                ?>

                <?php if ($show_btn_detail): ?>
                    <div data-id="<?php echo esc_attr($ID); ?>" data-close="Скрыть" data-open="Подробнее" class="open__dop-btn">
                        <div class="open__dop-btn-text">Подробнее</div>
                        <div class="navigation__item-arrow">
                            <svg width="12" height="6" viewBox="0 0 12 6">
                                <use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/img/icons.svg#arrow'); ?>" x="0" y="0"></use>
                            </svg>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                $date_actually = get_the_modified_date('d.m.Y', $bank_id);
                ?>
                <?php if ($date_actually): ?>
                    <div class="date_actually">Обновлено: <?php echo esc_html($date_actually); ?></div>
                <?php endif; ?>
            </div>

            <div class="tabs">
                <!-- Возможно, здесь будет динамический контент -->
            </div>
        </div>

    </div>
</div>