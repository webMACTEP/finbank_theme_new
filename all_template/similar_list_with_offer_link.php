<?php
$featured_posts = isset($args['DATA']) ? $args['DATA'] : [];
$title = isset($args['TITLE']) ? esc_html($args['TITLE']) : '';

if (!empty($featured_posts)){ ?>
    <!-- Similar Section -->
    <div class="section">
        <div class="section__header d-flex justify-content-between align-items-center">
            <h2 class="title mb-4"><?php echo $title; ?></h2>
        </div>

        <div class="horizontal__scroll">
            <div class="horizontal__scroll-container row">
                <?php foreach ($featured_posts as $post):
                    setup_postdata($post);

                    $post_id = get_the_ID();
                    $post_type = get_post_type($post_id);
                    $permalink = get_permalink($post_id);

                    // Переопределение ссылки, если задано поле 'card_bank_link'
                    $card_bank_link = get_field('card_bank_link', $post_id);
                    if (!empty($card_bank_link)) {
                        $link = esc_url($card_bank_link);
                    } else {
                        $link = esc_url($permalink);
                    }

                    // Получение рейтинга и комментариев
                    $ratings_average = esc_html(get_field('ratings_average', $post_id));
                    $comments_count = wp_count_comments($post_id)->approved;
                    $comments_link = esc_url($permalink . '#comments');

                    // Получение идентификатора для кнопки лайка (предполагается, что это ID поста)
                    $loop_id = isset($loop_id) ? intval($loop_id) : $post_id;

                    switch ($post_type) {
                        case 'kredity':
                            // Получение необходимых полей для типа 'kredity'
                            $bank_choice = get_field('product_bank', $post_id);
                            $bank_logo = get_field('bank_logo', $bank_choice);
                            $bank_logo_url = esc_url($bank_logo['url'] ?? $bank_logo);
                            $bank_logo_alt = esc_attr(get_post_meta($post_id, '_wp_attachment_image_alt', true));


                            //print_r2($bank_logo);


                            // Получение полей кредита
                            $credit_min_sum = number_format(get_field('credit_min_sum', $post_id), 0, '.', ' ');
                            $credit_max_sum = number_format(get_field('credit_max_sum', $post_id), 0, '.', ' ');
                            $credit_stavka = esc_html(get_field('credit_stavka', $post_id));
                            $credit_period = esc_html(get_field('credit_period', $post_id)['label'] ?? '');

                            // Получение рейтинга банка, если он существует
                            $bank_rating_number = isset($all_banks_rating[$bank_choice]) ? intval($all_banks_rating[$bank_choice]) : '';

                ?>
                            <!-- Карточка Kredity -->
                            <div class="card card__horizontal bank__item h-100 size4">
                                <div class="card-container p-2">
                                    <div class="d-flex">
                                        <div class="bank__item-img mr-2">
                                            <img src="<?php echo $bank_logo_url; ?>" alt="<?php echo $bank_logo_alt; ?>">
                                        </div>
                                        <div class="bank__item-content">
                                            <a href="<?php echo $link; ?>" class="card__header-title stretched-link mt-1 mb-2"><?php the_title(); ?></a>
                                            <div class="card__header-info d-flex align-items-center">
                                                <div class="card__rating d-flex align-items-center mr-3">
                                                    <div class="mr-2">
                                                        <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                        </svg>
                                                    </div>
                                                    <?php echo $ratings_average; ?>
                                                </div>
                                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2">
                                                        <a href="<?php echo $comments_link; ?>" data-target="comments" class="stretched-link">
                                                            <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php echo intval($comments_count); ?>
                                                </div>
                                                <?php if ($bank_rating_number): ?>
                                                    <div class="card__header-num">
                                                        №<?php echo $bank_rating_number; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                        <p>Мин. сумма: <?php echo $credit_min_sum; ?> ₽</p>
                                        <p>От <?php echo $credit_stavka; ?> % годовых</p>
                                        <p>Макс. сумма: <?php echo $credit_max_sum; ?> ₽</p>
                                        <p>Срок кредита: до <?php echo $credit_period; ?></p>
                                    </div>
                                    <div>
                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal mt-3">Оформить</a>
                                    </div>
                                </div>
                            </div>
                            <!-- / Карточка Kredity -->
                        <?php
                            break;

                        case 'bankcard':
                            // Получение необходимых полей для типа 'bankcard'
                            $bank_choice = get_field('bank_choise', $post_id);
                            $bank_logo = get_field('bank_logo', $bank_choice);
                            $bank_logo_url = esc_url($bank_logo['url'] ?? $bank_logo);

                            //print_r2($bank_logo);
                            //echo $bank_logo['id'];
                            //die;



                            $bank_logo_alt = esc_attr(get_post_meta($post_id, '_wp_attachment_image_alt', true));

                            // Получение полей карты
                            $card_stavka = esc_html(get_field('card_stavka', $post_id));
                            $card_period = esc_html(get_field('card_period', $post_id)['label'] ?? '');
                            $card_cred_limit = number_format(get_field('card_cred_limit', $post_id), 0, '.', ' ');
                            $card_day_period = esc_html(get_field('card_day_period', $post_id));

                            // Получение терминов таксономии 'bankcards'
                            $loop_terms = wp_get_post_terms($post_id, 'bankcards', ['fields' => 'all']);
                            $loop_term = !empty($loop_terms) ? $loop_terms[0] : null;
                            $loop_term_slug = $loop_term ? sanitize_title($loop_term->slug) : '';
                            $loop_term_id = $loop_term ? intval($loop_term->term_id) : 0;

                        ?>
                            <!-- Карточка Bankcard -->
                            <div class="card card__horizontal bank__item h-100 size4">
                                <div class="card-container p-2">
                                    <div class="d-flex">
                                        <div class="bank__item-img mr-2">
                                            <img src="<?php echo $bank_logo_url; ?>" alt="<?php echo $bank_logo_alt; ?>">
                                        </div>
                                        <div class="bank__item-content">
                                            <a href="<?php echo $link; ?>" class="card__header-title stretched-link mt-1 mb-2"><?php the_title(); ?></a>
                                            <div class="card__header-info d-flex align-items-center">
                                                <div class="card__rating d-flex align-items-center mr-3">
                                                    <div class="mr-2">
                                                        <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                        </svg>
                                                    </div>
                                                    <?php echo $ratings_average; ?>
                                                </div>
                                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2">
                                                        <a href="<?php echo $comments_link; ?>" data-target="comments" class="stretched-link">
                                                            <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php echo intval($comments_count); ?>
                                                </div>
                                                <div class="card__like d-flex align-items-center">
                                                    <?php echo do_shortcode('[wp_ulike for="post" id="' . esc_attr($loop_id) . '" button_type="image" style="wpulike-heart"]'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (in_array($loop_term_slug, ['creditcard', 'installmentcard'])): ?>
                                        <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                            <p><?php echo esc_html($card_period); ?> без процентов</p>
                                            <p>От <?php echo esc_html($card_stavka); ?> % годовых</p>
                                            <p>Лимит - до <?php echo $card_cred_limit; ?> ₽</p>
                                            <p>Период - <?php echo esc_html($card_day_period); ?> дней</p>
                                        </div>
                                        <div>
                                            <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal mt-3">Оформить</a>
                                        </div>
                                    <?php elseif ($loop_term_slug === 'debetcard'): ?>
                                        <?php
                                        // Получение полей для дебетовой карты
                                        $non_percent_money = number_format(get_field('non_percent_money', $post_id), 0, '.', ' ');
                                        $card_stavka_ostatok = esc_html(get_field('card_stavka_ostatok', $post_id));
                                        $card_cashback_type = esc_html(get_field('card_cashback_type', $post_id)['label'] ?? '');
                                        $card_cashback = esc_html(get_field('card_cashback', $post_id)['label'] ?? '');
                                        ?>
                                        <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                            <p>Снятие без % до <?php echo $non_percent_money; ?> ₽</p>
                                            <p>До <?php echo $card_stavka_ostatok; ?> % на остаток</p>
                                            <p>Тип кешбэка: <?php echo $card_cashback_type; ?></p>
                                            <p>Кешбэк <?php echo $card_cashback; ?></p>
                                        </div>
                                        <div>
                                            <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal mt-3">Оформить</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- / Карточка Bankcard -->
                        <?php
                            break;

                        case 'zaimy':
                            // Получение необходимых полей для типа 'zaimy'
                            $z_organization_logo = get_field('z_organization_logo', $post_id);

                            if (is_array($z_organization_logo)) {
                                // Если возвращается массив
                                $logo_id = isset($z_organization_logo['id']) ? $z_organization_logo['id'] : 0;
                                $logo_url = isset($z_organization_logo['url']) ? esc_url($z_organization_logo['url']) : '';
                                $logo_alt = esc_attr(get_post_meta($logo_id, '_wp_attachment_image_alt', true));
                            } elseif (is_numeric($z_organization_logo)) {
                                // Если возвращается только ID
                                $logo_id = intval($z_organization_logo);
                                $logo_url = esc_url(wp_get_attachment_url($logo_id));
                                $logo_alt = esc_attr(get_post_meta($logo_id, '_wp_attachment_image_alt', true));
                            } else {
                                // Если возвращается URL или ничего
                                $logo_id = 0;
                                $logo_url = esc_url($z_organization_logo);
                                $logo_alt = '';
                            }

                            // Получение полей займа
                            $z_sum = number_format(get_field('z_sum', $post_id), 0, '.', ' ');
                            $z_stavka = esc_html(get_field('z_stavka', $post_id));
                            $z_history = esc_html(get_field('z_history', $post_id));
                            $z_time = esc_html(get_field('z_time', $post_id));
                        ?>
                            <!-- Карточка Zaimy -->
                            <div class="card card__horizontal bank__item h-100 size4">
                                <div class="card-container position-relative p-2">
                                    <div class="d-flex">
                                        <div class="bank__item-img mr-2">
                                            <img src="<?php echo $logo_url; ?>" alt="<?php echo $logo_alt; ?>">
                                        </div>

                                        <div class="bank__item-content">
                                            <a href="<?php echo $link; ?>" class="card__header-title stretched-link mt-1 mb-2"><?php the_title(); ?></a>
                                            <div class="card__header-info d-flex align-items-center">
                                                <div class="card__rating d-flex align-items-center mr-3">
                                                    <div class="mr-2">
                                                        <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                        </svg>
                                                    </div>
                                                    <?php echo $ratings_average; ?>
                                                </div>
                                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2">
                                                        <a href="<?php echo $comments_link; ?>" data-target="comments" class="stretched-link">
                                                            <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php echo intval($comments_count); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                        <p>Сумма займа: <?php echo $z_sum; ?> ₽</p>
                                        <p>От <?php echo $z_stavka; ?> % в день</p>
                                        <p>Кредитная история: <?php echo $z_history; ?></p>
                                        <p>Срок займа: до <?php echo $z_time; ?> дней</p>
                                    </div>
                                    <div>
                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal mt-3">Оформить</a>
                                    </div>
                                </div>
                            </div>
                            <!-- / Карточка Zaimy -->
                <?php
                            break;

                        default:
                            // Обработка других типов записей, если необходимо
                            break;
                    } // Конец switch

                endforeach; ?>
            </div>
        </div>
    </div>
    <!-- / Similar Section -->
<?php
    wp_reset_postdata();
};

?>