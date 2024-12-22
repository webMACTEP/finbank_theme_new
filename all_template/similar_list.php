<?

$featured_posts = $args['DATA'];


if( $featured_posts ): ?>
    <!-- similar -->
    <div class="section">
       <div class="section__header d-flex justify-content-between align-items-center">
           <h2 class="title mb-4"><?= $args['TITLE']?></h2>
       </div>

       <div class="horizontal__scroll">
           <div class="horizontal__scroll-container row">
                <?php foreach( $featured_posts as $post ):
                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post); ?>

                    <?  $post_type = get_post_type(get_the_id()); ?>

                    <?  switch($post_type){
                        case 'kredity':?>
                            <!-- item -->
                            <div class="card card__horizontal bank__item h-100 size4">
                                <div class="card-container p-2">
                                    <div class="d-flex">
                                        <div class="bank__item-img mr-2">
                                            <img src="<?php $bank_choise_rel = get_field('product_bank', get_the_ID()) ?>
                                           <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="
                                        <? echo get_post_meta(get_field('bank_logo', $bank_choise_rel, false), '_wp_attachment_image_alt', true);?>">
                                        </div>
                                        <div class="bank__item-content">
                                            <a href="<?php echo the_permalink() ?>" class="card__header-title stretched-link mt-1 mb-2"><?php echo the_title() ?></a>
                                            <div class="card__header-info d-flex align-items-center">
                                                <div class="card__rating d-flex align-items-center mr-3">
                                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                    <?php echo the_field('ratings_average'); ?>
                                                </div>
                                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                    <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->approved ?>
                                                </div>
                                                <div class="card__header-num">
                                                    <? if($all_banks_rating[$bank_choise_rel]):?>
                                                        №<?= $all_banks_rating[$bank_choise_rel]; ?>
                                                    <? endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">

                                        <p>Мин. сумма: <?php echo the_field('credit_min_sum') ?> ₽</p>
                                        <p>От <?php echo the_field('credit_stavka') ?> % годовых</p>
                                        <p>Макс. сумма: <?= number_format(get_field('credit_max_sum'), 0, '.', ' '); ?> ₽</p>
                                        <p>Срок кредита: до
                                            <?php
                                            // Переменные
                                            $field = get_field('credit_period');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?></p>

                                    </div>
                                    <div>
                                        <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal mt-3">Оформить</a>
                                    </div>
                                </div>
                            </div>
                            <!-- / item -->
                        <? break;?>

                        <? case 'bankcard':?>
                            <!-- item -->
                            <div class="card card__horizontal bank__item h-100 size4">
                                <div class="card-container p-2">
                                    <div class="d-flex">
                                        <div class="bank__item-img mr-2">
                                            <img
                                                    src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                               <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                                    alt="<?
                                                    $logo_id = get_field('bank_logo',$bank_choise_rel , false);
                                                    $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                    echo $logo_alt;
                                                    ?>">
                                        </div>
                                        <div class="bank__item-content">
                                            <a href="<?php echo the_permalink(); ?>" class="card__header-title stretched-link mt-1 mb-2"><?php echo the_title() ?></a>
                                            <div class="card__header-info d-flex align-items-center">
                                                <div class="card__rating d-flex align-items-center mr-3">
                                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                    <?php echo the_field('ratings_average'); ?>
                                                </div>
                                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                    <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->approved ?>
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
                                            <p>От <?php echo the_field('card_stavka') ?> % годовых</p>
                                            <p>Лимит - до <?= number_format(get_field('card_cred_limit'), 0, '.', ' '); ?> ₽</p>
                                            <p>Период - <?php echo the_field('card_day_period') ?> дней</p>
                                        </div>
                                        <div>
                                            <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal mt-3">Оформить</a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($loop_term_slug == 'installmentcard'): ?>
                                        <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                            <p><?php $field = get_field('card_period');
                                                //$value = $field['value'];
                                                //$label = $field['choices'][ $value ];
                                                echo $field['label'] ?> без процентов</p>
                                            <p>От <?php echo the_field('card_stavka') ?> % годовых</p>
                                            <p>Лимит - до <?= number_format(get_field('card_cred_limit'), 0, '.', ' '); ?> ₽</p>
                                            <p>Период - <?php echo the_field('card_day_period') ?> дней</p>
                                        </div>
                                        <div>
                                            <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal mt-3">Оформить</a>
                                        </div>
                                    <?php endif; ?>


                                    <?php if($loop_term_slug == 'debetcard'): ?>
                                        <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                            <p>Снятие без % до <?php echo the_field('non_pecent_money') ?> ₽</p>
                                            <p>До <?php echo the_field('card_stavka_ostatok') ?> % на остаток</p>
                                            <p>Тип кешбэка: <?php $field = get_field('card_cashback_type');
                                                //$value = $field['value'];
                                                //$label = $field['choices'][ $value ];
                                                echo $field['label'] ?></p>
                                            <p>Кешбэк <?php $field = get_field('card_cashback');
                                                //$value = $field['value'];
                                                //$label = $field['choices'][ $value ];
                                                echo $field['label'] ?></p>
                                        </div>
                                        <div>
                                            <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal mt-3">Оформить</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- / item -->
                        <? break;?>

                        <? case 'zaimy':?>
                            <!-- item -->
                            <div class="card card__horizontal bank__item h-100 size4">
                                <div class="card-container position-relative p-2">
                                    <div class="d-flex">
                                        <div class="bank__item-img mr-2">
                                            <img src="<?php echo the_field('z_organization_logo') ?>"
                                                 alt="<?
                                                 $logo_id = get_field('z_organization_logo',  get_the_ID(), false);
                                                 $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                 echo $logo_alt;
                                                 ?>">
                                        </div>

                                        <div class="bank__item-content">
                                            <a href="<?php echo the_permalink() ?>" class="card__header-title stretched-link mt-1 mb-2"><?php echo the_title() ?></a>
                                            <div class="card__header-info d-flex align-items-center">
                                                <div class="card__rating d-flex align-items-center mr-3">
                                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                    <?php echo the_field('ratings_average'); ?>
                                                </div>
                                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                    <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                    <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->approved ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">

                                        <p>Сумма займа: <?php echo price_format(get_field('z_sum')) ?> ₽</p>
                                        <p>От <?php echo the_field('z_stavka') ?> % в день</p>
                                        <p>Кредитная история: <?php $card_period = get_field('z_history');
                                            echo $card_period; ?></p>
                                        <p>Срок займа: до <?php echo the_field('z_time') ?> дней</p>

                                    </div>
                                    <div>
                                        <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal mt-3">Оформить</a>
                                    </div>
                                </div>
                            </div>
                            <!-- / item -->
                        <? break;?>

                        <? default:?>


                    <? } // switch?>

                <?php endforeach; ?>

            </div>
       </div>
    </div>
    <!-- / similar -->
    <?php
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
<?php endif; ?>