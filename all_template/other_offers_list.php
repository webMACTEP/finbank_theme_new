<?php
$other_products = $args;

$all_banks_rating = get_all_banks_rating();
// Цикл
 foreach( $other_products as $post ): ?>

        <?php

        setup_postdata($post);

        $post_type = get_post_type($post);

        switch ($post_type){
            case 'bankcard':
                        ?>
                <!-- item -->
                <div class="card card__horizontal bank__item h-100 size4">
                    <div class="card-container p-2">
                        <div class="d-flex">
                            <div class="bank__item-img mr-2">
                                <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                           <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                     alt="<?
                                     $logo_id = get_field('bank_logo',$bank_choise_rel , false);
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
                                    <div class="card__header-num">
                                        <? if($all_banks_rating[$bank_choise_rel]):?>
                                            №<?= $all_banks_rating[$bank_choise_rel]; ?>
                                        <? endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $loop_terms = wp_get_post_terms( get_the_ID(), 'bankcards', array('fields' => 'all') );
                        $loop_term_slug = $loop_terms[0]->slug;
                        $loop_term_id = $terms[0]->term_id;
                        ?>
                        <?php if($loop_term_slug == 'creditcard'): ?>
                            <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                <p><?php $field = get_field('card_period');
                                    //$value = $field['value'];
                                    //$label = $field['choices'][ $value ];
                                    echo $field['label'] ?> без процентов</p>
                                <p>От <?php echo the_field('card_stavka') ?> %</p>
                                <p>Лимит - до <?php echo number_format(get_field('card_cred_limit'), 0, '.', ' ') ?> ₽</p>
                                <p>Период - <?php echo the_field('card_day_period') ?> дней</p>
                            </div>
                        <?php endif; ?>
                        <?php if($loop_term_slug == 'installmentcard'): ?>
                            <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                <p><?php $field = get_field('card_period');
                                    $value = $field['value'];
                                    $label = $field['choices'][ $value ];
                                    echo $field['label'] ?> без процентов</p>
                                <p>От <?php echo the_field('card_stavka') ?> %</p>
                                <p>Лимит - до <?php echo number_format(get_field('card_cred_limit'), 0, '.', ' ') ?> ₽</p>
                                <p>Период - <?php echo the_field('card_day_period') ?> дней</p>
                            </div>
                        <?php endif; ?>
                        <?php if($loop_term_slug == 'debetcard'): ?>
                            <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                                <p>Снятие без % до <?= number_format(get_field('non_pecent_money'), 0, '.', ' '); ?> ₽</p>
                                <p>До <?php echo the_field('card_stavka_ostatok') ?> %</p>
                                <p>Тип кешбэка: <?php $field = get_field('card_cashback_type');
                                    //$value = $field['value'];
                                    //$label = $field['choices'][ $value ];
                                    echo $field['label'] ?></p>
                                <p>Кешбэк <?php $field = get_field('card_cashback');
                                    //$value = $field['value'];
                                    //$label = $field['choices'][ $value ];
                                    echo $field['label'] ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- / item -->
            <?php
                break;
            case 'kredity':
                ?>
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

                            <p>Мин. сумма: <?php echo number_format(get_field('credit_min_sum'), 0 , '.', ' '); ?> ₽</p>
                            <p>От <?php echo the_field('credit_stavka') ?> %</p>
                            <p>Макс. сумма: <?php $card_period = get_field('credit_max_sum');
                                echo number_format($card_period, 0 , '.' , ' '); ?> ₽</p>
                            <p>Срок кредита: до
                                <?php
                                // Переменные
                                $field = get_field('credit_period');
                                //$value = $field['value'];
                                //$label = $field['choices'][ $value ];
                                echo $field['label'] ?></p>

                        </div>
                    </div>
                </div>
                <!-- / item -->
                <?php
                break;
            case 'zaimy':
                ?>
                <!-- item -->
                <div class="card card__horizontal bank__item h-100 size4">
                    <div class="card-container p-2">
                        <div class="d-flex">
                            <div class="bank__item-img mr-2">
                                <img
                                        src="<?php echo the_field('z_organization_logo') ?>"
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

                            <p>Сумма займа: <?php echo number_format(get_field('z_sum'), 0, '.', ' ') ?> ₽</p>
                            <p>От <?php echo the_field('z_stavka') ?> %</p>
                            <p>Кредитная история: <?php $card_period = get_field('z_history');
                                echo $card_period; ?></p>
                            <p>Срок займа: до <?php echo the_field('z_time') ?> дней</p>

                        </div>
                    </div>
                </div>
                <!-- / item -->
                <?php
                break;
            default:
                ?>

                <!-- item -->
                <div class="card card__horizontal bank__item h-100 size4">
                   <div class="card-container p-2">
                       <div class="d-flex">
                           <div class="bank__item-img mr-2">
                               <?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                               <img src="<?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                alt="<?
                                $logo_id = get_field('bank_logo',$bank_choise_rel , false);
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
                                   <div class="card__header-num">
                                       <? if($all_banks_rating[$bank_choise_rel]):?>
                                           №<?= $all_banks_rating[$bank_choise_rel]; ?>
                                       <? endif;?>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <?php $loop_terms = wp_get_post_terms( get_the_ID(), 'bankcards', array('fields' => 'all') );
                             $loop_term_slug = $loop_terms[0]->slug;
                             $loop_term_id = $terms[0]->term_id;
                             ?>
                        <?php if($loop_term_slug == 'creditcard'): ?>
                       <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                           <p><?php $field = get_field('card_period');
                                        //$value = $field['value'];
                                        //$label = $field['choices'][ $value ];
                                        echo $field['label'] ?> без процентов</p>
                           <p>От <?php echo the_field('card_stavka') ?> %</p>
                           <p>Лимит - до <?php echo the_field('card_cred_limit') ?> ₽</p>
                           <p>Период - <?php echo the_field('card_day_period') ?> дней</p>
                       </div>
                        <?php endif; ?>
                        <?php if($loop_term_slug == 'installmentcard'): ?>
                       <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                           <p><?php $field = get_field('card_period');
                                        $value = $field['value'];
                                        $label = $field['choices'][ $value ];
                                        echo $field['label'] ?> без процентов</p>
                           <p>От <?php echo the_field('card_stavka') ?> %</p>
                           <p>Лимит - до <?php echo the_field('card_cred_limit') ?> ₽</p>
                           <p>Период - <?php echo the_field('card_day_period') ?> дней</p>
                       </div>
                        <?php endif; ?>
                       <?php if($loop_term_slug == 'debetcard'): ?>
                        <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                           <p>Снятие без % до <?= number_format(get_field('non_pecent_money'), 0, '.', ' '); ?> ₽</p>
                           <p>До <?php echo the_field('card_stavka_ostatok') ?> %</p>
                           <p>Тип кешбэка: <?php $field = get_field('card_cashback_type');
                                        //$value = $field['value'];
                                        //$label = $field['choices'][ $value ];
                                        echo $field['label'] ?></p>
                           <p>Кешбэк <?php $field = get_field('card_cashback');
                                        //$value = $field['value'];
                                        //$label = $field['choices'][ $value ];
                                        echo $field['label'] ?></p>
                       </div>
                        <?php endif; ?>
                   </div>
               </div>
                <!-- / item -->

        <?php
        }

        ?>

        <?php
//    }
//}
    endforeach;

// Возвращаем оригинальные данные поста. Сбрасываем $post.
wp_reset_postdata();
?>


