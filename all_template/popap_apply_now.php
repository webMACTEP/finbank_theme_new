
<?php $apply_now = $args['DATA']; ?>

<?php if($apply_now): ?>
<div class="check_popap popup_apply_now <?php if(wp_is_mobile()): ?> popup_apply_now-mob <?php else:?> popup_apply_now-desktop <?php endif;?>" style="display:none">
    <div class="out_exit">
        <div onclick="ym(35020350,'reachGoal','NOREF_POPUP_X'); return true;" class="out_exit_close popup_apply_now_close">
            <img alt="Закрыть" src="/wp-content/themes/finbank_theme/img/close2.png">
        </div>
        <div class="out_exit_body">

            <div class="h2">Выбирайте актуальные продукты!</div>
            <?php if(!wp_is_mobile()): ?>

                <?php

                if($args['title']){
                    $title = $args['title'];
                }else{
                    $title = get_the_title();
                }


                ?>

                <div class="exit1_offer_param_label">
                    К сожалению, "<?php echo $title; ?>" больше не доступен для оформления на Finabank.
                    <br>Предлагаем ознакомиться с похожими предложениями.
                    </div>
            <?php endif;?>

            <div class="popup-slider-apply-new">
                <div class="<?php if(wp_is_mobile()): ?> wellcome__slider  <?php endif;?>">
                    <div class="popup-slider-apply-wrapper <?php if(wp_is_mobile()): ?> slider-new  <?php endif;?>">


                        <?php foreach($apply_now as $item_apply): ?>



                            <?php $bank_exit_id = $item_apply; ?>
                            <?php $bank_choise_rel = get_field('product_bank', $bank_exit_id); ?>

                            <div class="slider__item" <?php if(!wp_is_mobile() && !$bank_choise_rel): ?>style="min-height: 280px" <?php endif;?>>

                                <?php if($bank_choise_rel): ?>



                                <?php endif; ?>

                                <?php
                                $posttype = get_post_type($bank_exit_id);



                                switch ($posttype) {
                                    case 'kredity': ?>

                                        <?php if(wp_is_mobile()): ?>

                                            <div class="out_exit_btn link_like">
                                                <a target="_blank" href="/best-kredity/" class=" btn btn-outline-primary btn-sm btn-block font-weight-normal">Похожие предложения</a>
                                            </div>
                                        <?php endif; ?>

                                        <div class=" position-relative">
                                            <div class="exit1_offer_logo">
                                                <img src="<?php $bank_choise_rel = get_field('product_bank', $bank_exit_id) ?>
                                                         <?php get_field('bank_logo', $bank_choise_rel) ?>"
                                                     alt="<?php echo get_post_meta(get_field('bank_logo', $bank_choise_rel, false), '_wp_attachment_image_alt', true);?>">
                                                <div class="exit1_offer_meta">
                                                    <div class="exit1_offer_name"><?php get_the_title($bank_exit_id) ?></div>

                                                    <div class="d-flex align-items-center">
                                                        <div class="card__rating d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                            <?php get_field('ratings_average', $bank_exit_id); ?>
                                                        </div>
                                                        <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                            <div class="mr-2"><a href="<?php the_permalink($bank_exit_id) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                            <?php $comments_count = wp_count_comments($bank_exit_id); echo $comments_count->approved ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php //if (get_field('pl-color', $bank_exit_id) && get_field('pl-text', $bank_exit_id)): ?>
                                            <!--    <div class="exit1_strip_--><?php //= get_field('pl-color', $bank_exit_id); ?><!--"><span>--><?php //= get_field('pl-text', $bank_exit_id); ?><!--</span></div>-->
                                            <?php //endif; ?>

                                            <div class="exit1_strip_red"><span>Лучшее предложение</span></div>

                                            <div class="exit1_offer_params">
                                                <div class="exit1_offer_param">
                                                    <div class="exit1_offer_param_label">Макс. сумма</div>
                                                    <div class="exit1_offer_param_value"><?php get_field('credit_max_sum', $bank_exit_id) ?> ₽</div>
                                                </div>
                                                <div class="exit1_offer_param">
                                                    <div class="exit1_offer_param_label">% ставка</div>
                                                    <div class="exit1_offer_param_value"><?php get_field('credit_stavka', $bank_exit_id); ?></div>
                                                </div>
                                                <div class="exit1_offer_param">
                                                    <div class="exit1_offer_param_label">Срок кредита</div>
                                                    <div class="exit1_offer_param_value">до <?php $field = get_field('credit_period', $bank_exit_id); echo $field['label'] ?></div>
                                                </div>
                                            </div>
                                            <div class="exit1_offer_button">
                                                <?php if (get_field('card_bank_link', $bank_exit_id)): ?>
                                                    <a href="<?php get_field('card_bank_link', $bank_exit_id) ?>" target="_blank"
                                                       class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                       onclick="<?php get_metrika_for_popap_apply(get_field('card_bank_link', $bank_exit_id)); ?> return true;">Подробнее</a>
                                                <?php else: ?>
                                                    <a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                       onclick="<?php get_metrika_for_popap_apply(get_permalink($bank_exit_id)); ?> return true;">Подробнее</a>
                                                <?php endif; ?>

                                            </div>
                                        </div>

                                        <?php  break;
                                    case 'bankcard':

                                        $termpost = wp_get_post_terms($bank_exit_id, 'bankcards');
                                        if ($termpost[0]->slug == 'debetcard') { ?>

                                            <?php if(wp_is_mobile()): ?>

                                                <div class="out_exit_btn link_like">
                                                    <a target="_blank" href="/best-debetcard/" class=" btn btn-outline-primary btn-sm btn-block font-weight-normal">Похожие предложения</a>
                                                </div>

                                            <?php endif; ?>


                                            <div class=" position-relative">
                                                <div class="exit1_offer_logo">
                                                    <img src="<?php $bank_choise_rel = get_field('bank_choise', $bank_exit_id) ?>
                                                                         <?php get_field('bank_logo', $bank_choise_rel) ?>"
                                                         alt="<?php echo get_post_meta(get_field('bank_logo', $bank_choise_rel, false), '_wp_attachment_image_alt', true);?>">
                                                    <div class="exit1_offer_meta">
                                                        <div class="exit1_offer_name"><?php get_the_title($bank_exit_id) ?></div>

                                                        <div class="d-flex align-items-center">
                                                            <div class="card__rating d-flex align-items-center mr-3">
                                                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                                <?php get_field('ratings_average', $bank_exit_id); ?>
                                                            </div>
                                                            <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                                <div class="mr-2"><a href="<?php the_permalink($bank_exit_id) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                                <?php $comments_count = wp_count_comments($bank_exit_id); echo $comments_count->approved ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php //if (get_field('pl-color', $bank_exit_id) && get_field('pl-text', $bank_exit_id)): ?>
                                                <!--    <div class="exit1_strip_--><?php //= get_field('pl-color', $bank_exit_id); ?><!--"><span>--><?php //= get_field('pl-text', $bank_exit_id); ?><!--</span></div>-->
                                                <?php //endif; ?>

                                                <div class="exit1_strip_red"><span>Лучшее предложение</span></div>

                                                <div class="exit1_offer_params">
                                                    <div class="exit1_offer_param">
                                                        <div class="exit1_offer_param_label">Снятие без %</div>
                                                        <div class="exit1_offer_param_value">до <?php get_field('non_pecent_money', $bank_exit_id) ?> ₽</div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                        <div class="exit1_offer_param_label">% на остаток</div>
                                                        <div class="exit1_offer_param_value">до <?php get_field('card_stavka_ostatok', $bank_exit_id); ?></div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                        <div class="exit1_offer_param_label">Кешбэк</div>
                                                        <div class="exit1_offer_param_value"><?php $field = get_field('card_cashback', $bank_exit_id); echo $field['label'] ?></div>
                                                    </div>
                                                </div>
                                                <div class="exit1_offer_button">
                                                    <?php if (get_field('card_bank_link', $bank_exit_id)): ?>
                                                        <a href="<?php get_field('card_bank_link', $bank_exit_id) ?>" target="_blank"
                                                           class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                           onclick="<?php get_metrika_for_popap_apply(get_field('card_bank_link', $bank_exit_id)); ?> return true;">Подробнее</a>
                                                    <?php else: ?>
                                                        <a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                           onclick="<?php get_metrika_for_popap_apply(get_permalink($bank_exit_id)); ?> return true;">Подробнее</a>
                                                    <?php endif; ?>
                                                 </div>
                                            </div>

                                        <?php } elseif ($termpost[0]->slug == 'creditcard') { ?>

                                            <?php if(wp_is_mobile()): ?>

                                                <div class="out_exit_btn link_like">
                                                    <a target="_blank" href="/best-creditcard/" class=" btn btn-outline-primary btn-sm btn-block font-weight-normal">Похожие предложения</a>
                                                </div>

                                            <?php endif; ?>

                                            <div class=" position-relative">
                                                <div class="exit1_offer_logo">
                                                    <img src="<?php $bank_choise_rel = get_field('bank_choise', $bank_exit_id) ?>
                                                                         <?php get_field('bank_logo', $bank_choise_rel) ?>" alt="<?php echo get_post_meta(get_field('bank_logo', $bank_choise_rel, false), '_wp_attachment_image_alt', true);?>">
                                                    <div class="exit1_offer_meta">
                                                        <div class="exit1_offer_name"><?php get_the_title($bank_exit_id) ?></div>

                                                        <div class="d-flex align-items-center">
                                                            <div class="card__rating d-flex align-items-center mr-3">
                                                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                                <?php get_field('ratings_average', $bank_exit_id); ?>
                                                            </div>
                                                            <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                                <div class="mr-2"><a href="<?php the_permalink($bank_exit_id) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                                <?php $comments_count = wp_count_comments($bank_exit_id); echo $comments_count->approved ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php //if (get_field('pl-color', $bank_exit_id) && get_field('pl-text', $bank_exit_id)): ?>
                                                <!--    <div class="exit1_strip_--><?php //= get_field('pl-color', $bank_exit_id); ?><!--"><span>--><?php //= get_field('pl-text', $bank_exit_id); ?><!--</span></div>-->
                                                <?php //endif; ?>

                                                <div class="exit1_strip_red"><span>Лучшее предложение</span></div>

                                                <div class="exit1_offer_params">
                                                    <div class="exit1_offer_param">
                                                        <div class="exit1_offer_param_label">Лимит</div>
                                                        <div class="exit1_offer_param_value"><?php get_field('card_cred_limit', $bank_exit_id) ?> ₽</div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                        <div class="exit1_offer_param_label">Без %</div>
                                                        <div class="exit1_offer_param_value"><?php $field = get_field('card_period', $bank_exit_id); echo $field['label'] ?></div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                        <div class="exit1_offer_param_label">Ставка</div>
                                                        <div class="exit1_offer_param_value">от <?php get_field('card_stavka', $bank_exit_id); ?>%</div>
                                                    </div>
                                                </div>
                                                <div class="exit1_offer_button">
                                                    <?php if (get_field('card_bank_link', $bank_exit_id)): ?>
                                                        <a href="<?php get_field('card_bank_link', $bank_exit_id) ?>" target="_blank"
                                                           class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                           onclick="<?php get_metrika_for_popap_apply(get_field('card_bank_link', $bank_exit_id)); ?> return true;">Подробнее</a>
                                                    <?php else: ?>
                                                        <a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                           onclick="<?php get_metrika_for_popap_apply(get_permalink($bank_exit_id)); ?> return true;">Подробнее</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        <?php } elseif ($termpost[0]->slug == 'installmentcard') { ?>

                                            <?php if(wp_is_mobile()): ?>

                                                <div class="out_exit_btn link_like">
                                                    <a target="_blank" href="/best-installmentcard/" class=" btn btn-outline-primary btn-sm btn-block font-weight-normal">Похожие предложения</a>
                                                </div>

                                            <?php endif; ?>

                                            <div class=" position-relative">
                                                <div class="exit1_offer_logo">
                                                    <img src="<?php $bank_choise_rel = get_field('bank_choise', $bank_exit_id) ?>
                                                         <?php get_field('bank_logo', $bank_choise_rel) ?>"
                                                         alt="<?php echo get_post_meta(get_field('bank_logo', $bank_choise_rel, false), '_wp_attachment_image_alt', true);?>">
                                                    <div class="exit1_offer_meta">
                                                        <div class="exit1_offer_name"><?php get_the_title($bank_exit_id) ?></div>

                                                        <div class="d-flex align-items-center">
                                                            <div class="card__rating d-flex align-items-center mr-3">
                                                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                                <?php get_field('ratings_average', $bank_exit_id); ?>
                                                            </div>
                                                            <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                                <div class="mr-2"><a href="<?php the_permalink($bank_exit_id) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                                <?php $comments_count = wp_count_comments($bank_exit_id); echo $comments_count->approved ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php //if (get_field('pl-color', $bank_exit_id) && get_field('pl-text', $bank_exit_id)): ?>
                                                <!--    <div class="exit1_strip_--><?php //= get_field('pl-color', $bank_exit_id); ?><!--"><span>--><?php //= get_field('pl-text', $bank_exit_id); ?><!--</span></div>-->
                                                <?php //endif; ?>

                                                <div class="exit1_strip_red"><span>Лучшее предложение</span></div>

                                                <div class="exit1_offer_params">
                                                    <div class="exit1_offer_param">
                                                        <div class="exit1_offer_param_label">Лимит</div>
                                                        <div class="exit1_offer_param_value"><?php get_field('card_cred_limit', $bank_exit_id) ?> ₽</div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                        <div class="exit1_offer_param_label">Без %</div>
                                                        <div class="exit1_offer_param_value"><?php $field = get_field('card_period', $bank_exit_id); echo $field['label'] ?></div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                        <div class="exit1_offer_param_label">Ставка</div>
                                                        <div class="exit1_offer_param_value">от <?php get_field('card_stavka', $bank_exit_id); ?>%</div>
                                                    </div>
                                                </div>
                                                <div class="exit1_offer_button">
                                                    <?php if (get_field('card_bank_link', $bank_exit_id)): ?>
                                                        <a href="<?php get_field('card_bank_link', $bank_exit_id) ?>" target="_blank"
                                                           class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                           onclick="<?php get_metrika_for_popap_apply(get_field('card_bank_link', $bank_exit_id)); ?> return true;">Подробнее</a>
                                                    <?php else: ?>
                                                        <a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                           onclick="<?php get_metrika_for_popap_apply(get_permalink($bank_exit_id)); ?> return true;">Подробнее</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        <?php }
                                        break;
                                    default: ?>

                                         <?php if(wp_is_mobile()): ?>

                                            <div class="out_exit_btn link_like">
                                                <a target="_blank" href="/best-kredity/" class=" btn btn-outline-primary btn-sm btn-block font-weight-normal">Похожие предложения</a>
                                            </div>

                                        <?php endif;?>

                                        <div class=" position-relative">
                                            <div class="exit1_offer_logo">
                                                <img src="<?php get_field('z_organization_logo', $bank_exit_id); ?>"
                                                     alt="<?php echo get_post_meta(get_field('z_organization_logo', $bank_exit_id, false), '_wp_attachment_image_alt', true);?>">
                                                <div class="exit1_offer_meta">
                                                    <div class="exit1_offer_name"><?php get_the_title($bank_exit_id) ?></div>

                                                    <div class="d-flex align-items-center">
                                                        <div class="card__rating d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                            <?php get_field('ratings_average', $bank_exit_id); ?>
                                                        </div>
                                                        <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                            <div class="mr-2"><a href="<?php the_permalink($bank_exit_id) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                            <?php $comments_count = wp_count_comments($bank_exit_id); echo $comments_count->approved ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php //if (get_field('pl-color', $bank_exit_id) && get_field('pl-text', $bank_exit_id)): ?>
                                            <!--    <div class="exit1_strip_--><?php //= get_field('pl-color', $bank_exit_id); ?><!--"><span>--><?php //= get_field('pl-text', $bank_exit_id); ?><!--</span></div>-->
                                            <?php //endif; ?>

                                            <div class="exit1_strip_red"><span>Лучшее предложение</span></div>

                                            <div class="exit1_offer_params">
                                                <div class="exit1_offer_param">
                                                    <div class="exit1_offer_param_label">Сумма займа</div>
                                                    <div class="exit1_offer_param_value"><?php get_field('z_sum', $bank_exit_id); ?> ₽</div>
                                                </div>
                                                <div class="exit1_offer_param">
                                                    <div class="exit1_offer_param_label">% ставка</div>
                                                    <div class="exit1_offer_param_value"><?php get_field('z_stavka', $bank_exit_id); ?>%</div>
                                                </div>
                                                <div class="exit1_offer_param">
                                                    <div class="exit1_offer_param_label">Срок кредита</div>
                                                    <div class="exit1_offer_param_value">От <?php get_field('z_time', $bank_exit_id); ?> дней</div>
                                                </div>
                                            </div>
                                            <div class="exit1_offer_button">
                                                <?php if (get_field('card_bank_link', $bank_exit_id)): ?>
                                                    <a href="<?php get_field('card_bank_link', $bank_exit_id) ?>" target="_blank"
                                                       class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                       onclick="<?php get_metrika_for_popap_apply(get_field('card_bank_link', $bank_exit_id)); ?> return true;">Подробнее</a>
                                                <?php else: ?>
                                                    <a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                       onclick="<?php get_metrika_for_popap_apply(get_permalink($bank_exit_id)); ?> return true;">Подробнее</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    <?php } ?>


                            </div>

                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>

                    <?php if(wp_is_mobile()): ?>

                        <!-- slider prev/next buttons -->
                        <div class="slider__button_container">
                            <div class="slider__button slider__button-prev d-flex justify-content-center align-items-center">
                                <svg width="6" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.2 13.2" xml:space="preserve"><path d="M5.6 0c.2 0 .3.1.4.2.3.2.3.6 0 .8L3.8 3.1C2.2 4.7 1.3 5.5 1.2 6.3v.6c.1.8.9 1.6 2.6 3.2L6 12.2c.2.2.2.6 0 .8-.2.2-.6.2-.8 0L3 10.9C1.1 9.2.2 8.3 0 7.1v-.9C.2 4.9 1.1 4 3 2.3L5.2.2c.1-.1.3-.2.4-.2z"></path></svg>
                            </div>
                            <div class="slider__button slider__button-next d-flex justify-content-center align-items-center">
                                <svg width="6" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.2 13.2" xml:space="preserve"><path d="M.6 13.2c-.2 0-.3-.1-.4-.2-.2-.2-.2-.6 0-.8l2.2-2.1C4 8.5 4.9 7.7 5 6.9v-.6c-.1-.8-1-1.6-2.6-3.2L.2 1C0 .8 0 .4.2.2c.2-.2.6-.2.8 0l2.2 2.1C5.1 4 6 4.9 6.2 6.1V7c-.2 1.3-1.1 2.2-3 3.9L1 13c-.1.1-.3.2-.4.2z"></path></svg>
                            </div>
                        </div>
                        <!-- / slider prev/next buttons -->
                    <?php endif;?>


                </div>
            </div>

            <div class="exit1_button">

                <?php if(!wp_is_mobile()): ?>

                    <div class="not_is_mobile out_exit_btn">
                        <a target="_blank" href="/best-kredity/" class=" btn btn-outline-primary btn-sm btn-block font-weight-normal">Похожие предложения</a>
                    </div>

                <?php endif;?>


                <?php if (get_field('card_bank_link') && !reclink(get_the_id())): ?>
                    <a onclick="ym(35020350,'reachGoal','NOREF_POPUP_close');" href="<?php get_field('card_bank_link'); ?>" target="_blank" class="btn btn-outline-primary exit1_btn">Спасибо, не надо</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php endif;?>
