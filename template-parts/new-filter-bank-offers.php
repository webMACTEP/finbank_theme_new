<?php 

    $terms = wp_get_post_terms( get_the_id(), 'bankcards', array('fields' => 'all') );
    $term_slug = $terms[0]->slug;
    $term_id = $terms[0]->term_id;
    $post_type = get_post_type(get_the_id());
    $view_type = $args['view_type'];
    // view_typelist grid

    $ID = get_the_id();

    //print_r2($post_type);


        ?>

        <?php if($post_type == 'kredity') : ?>
            <!-- card_list  card_grid -->
            <div class="card card__vertical size4 offer h-100 card_custom_v1 <?= $view_type ?> ">
               <div class="card-container p-3">

                   <div class="card__header mb-2 d-flex">

                       <div class="card__header-left">
                           <div class="card__header-img">
                               <img src="<?php $bank_choise_rel = get_field('product_bank', get_the_id()) ?>
                           <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                           </div>
                       </div>
                       <div class="card__header-right">
                           <div class="card__header-title">

                               <div class="card__header-title_v1">
                                   <a href="<?php the_permalink($bank_choise_rel);?>"><?php echo get_the_title($bank_choise_rel); ?></a>
                               </div>
                               <div class="card__header-title_v2">
                                   <a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
                               </div>


                           </div>
                           <div class="card__header-info d-flex align-items-center">
                               <div class="card__rating d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                   <?php echo the_field('ratings_average'); ?>
                               </div>
                               <div class="position-relative card__icon d-flex align-items-center mr-3">
                                   <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                   <?php echo comments_number( '0', '1', '%'); ?>
                               </div>
                               <div class="card__icon d-flex align-items-center mr-3">
                                   <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                   <?php echo get_post_meta( get_the_id(), 'views', true ); ?>
                               </div>
                               <div class="card__like d-flex align-items-center">
                                   <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                               </div>
                               <div class="card__header-actions ml-auto">
                                   <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                               </div>
                           </div>
                       </div>




                   </div>




                   <ul class="leaders">

                       <li class="leaders__item mb-1">
                           <div class="leaders__item-title">Сумма</div>
                           <div class="leaders__item-value">
                               <?= number_format(get_field('credit_min_sum'), 0, '.', ' '); ?>
                               -
                               <?php

                               $max_sum = get_field('credit_max_sum');

                               if ($max_sum >= 1000000 && $max_sum < 1000000000) {
                                   $max_sum = $max_sum / 1000000;
                               }else{
                                   $max_sum = number_format(get_field('credit_max_sum'), 0, '.', ' ');
                               }

                               ?>
                               <?= $max_sum ?> млн ₽
                           </div>
                       </li>

                       <li class="leaders__item mb-1">
                           <div class="leaders__item-title">Срок</div>
                           <div class="leaders__item-value">от <?php $field = get_field('credit_period');
                               $value = $field['value'];
                               $label = $field['choices'][ $value ];
                               echo $field['label'] ?></div>
                       </li>

                       <?php if(get_field('opisanie_psk')): ?>

                           <li class="leaders__item mb-1">
                               <div class="leaders__item-title">ПСК



                                   <div class="tooltip">
                                       <div class="tooltip__trigger">
                                           <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                               <path d="M6 8V6M6 4H6.005M11 6C11 8.76142 8.76142 11 6 11C3.23858 11 1 8.76142 1 6C1 3.23858 3.23858 1 6 1C8.76142 1 11 3.23858 11 6Z" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                           </svg>


                                       </div>
                                       <div class="tooltip__drop">Полная стоимость кредита</div>

                                   </div>
                               </div>
                               <div class="leaders__item-value">
                                   <?php echo the_field('opisanie_psk'); ?>% - <?php echo the_field('opisanie_psk_2'); ?> %</div>
                           </li>

                        <?php endif; ?>

                   </ul>

                   <div class="card__actions d-flex">
                       <?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
                       <? if(!$apply_now):?>
                           <div class="col-9 px-1 px-md-2">
                               <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                           </div>
                       <? else: ?>
                           <div class="col-9 px-1 px-md-2">
                               <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                           </div>
                       <?endif; ?>
                       <div class="btn__compare_v1">
                           <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="kredity">
                               <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path d="M10.5 13V5.5M6 13V1M1.5 13V8.5" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                               </svg>
                           </a>
                       </div>
                   </div>

                   <div class="tabs-and-btns w-100">

                       <div class="card-tags">
                           <?php
                           // card_other_state
                           $z_other_statements = get_field('credit_other_statements', $ID); ?>

                           <?php foreach ($z_other_statements as $item): ?>
                               <a href="#" class="btn calc__page-nav btn-light"><?php echo $item; ?></a>
                           <?php endforeach; ?>
                       </div>


                       <div class="card__footer-new">
                           <?
                           $ID = get_the_id();
                           $about_item = get_field('about_item', $ID);
                           $if_in_tab = get_field('if_in_tab', $ID);
                           $plus_and_minus_tab = get_field('plus_and_minus_tab', $ID);
                           $show_btn_detail = false;
                           if( have_rows('product_tar', $ID) || $about_item || $if_in_tab || $plus_and_minus_tab){
                               $show_btn_detail = true;
                           }
                           ?>
                           <? if($show_btn_detail): ?>
                               <div data-id='<?= get_the_id()?>' data-close="Скрыть" data-open="Подробнее" class="show__detail_popup">
                                   <div class="svg">
                                       <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <g clip-path="url(#clip0_4056_3857)">
                                               <path d="M9 12V9M9 6H9.0075M16.5 9C16.5 13.1421 13.1421 16.5 9 16.5C4.85786 16.5 1.5 13.1421 1.5 9C1.5 4.85786 4.85786 1.5 9 1.5C13.1421 1.5 16.5 4.85786 16.5 9Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                           </g>
                                           <defs>
                                               <clipPath id="clip0_4056_3857">
                                                   <rect width="18" height="18" fill="white"/>
                                               </clipPath>
                                           </defs>
                                       </svg>

                                   </div>
                                   <div class="open__dop-btn-text">Подробнее</div>
                               </div>
                           <? endif; ?>


                           <div class="popup_detail_wrap popup popup_v1" style="display: none">
                               <div class="popup__inner">
                                   <div class="popup_close popup_close-css"><img src="/wp-content/themes/finbank_theme/img/close2.png" alt="Закрыть"></div>
                                   <div class="popup_body">

                                       <div class="card__header mb-2 d-flex">
                                           <div class="card__header-left">
                                               <div class="card__header-img">
                                                   <img src="<?php $bank_choise_rel = get_field('product_bank', get_the_ID()) ?>
                                                        <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                                               </div>
                                           </div>
                                           <div class="card__header-right">
                                               <div class="card__header-title">
                                                   <div class="card__header-title_v1">
                                                       <a href="<?php the_permalink($bank_choise_rel);?>"><?php echo get_the_title($bank_choise_rel); ?></a>
                                                   </div>
                                                   <div class="card__header-title_v2">
                                                       <a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
                                                   </div>

                                               </div>
                                               <div class="d-flex align-items-center mt-2">
                                                   <div class="card__rating d-flex align-items-center mr-3">
                                                       <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                       <?php echo the_field('ratings_average'); ?>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>

                                       <div class="detail_popup detail_popup_v1">
                                       </div>

                                       <div class="order-7 row filter__main_bottom d-flex justify-content-between align-items-center">
                                           <div class="col-12 col-md-6 col-lg-2 mt-4">
                                               <input class="popup_close btn btn-outline-alternative btn-block" value="Закрыть">
                                           </div>
                                           <div class="col-12 col-md-7 col-lg-3 mt-4">
                                               <div class="d-flex">
                                                   <?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
                                                   <? if(!$apply_now):?>
                                                       <div class="col-10 px-1 px-md-2">
                                                           <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                                                       </div>
                                                   <? else: ?>
                                                       <div class="col-10 px-1 px-md-2">
                                                           <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                                                       </div>
                                                   <?endif; ?>
                                                   <div class="btn__compare_v1">
                                                       <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="kredity">
                                                           <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                               <path d="M10.5 13V5.5M6 13V1M1.5 13V8.5" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                           </svg>
                                                       </a>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>


                                   </div>
                               </div>
                           </div>

                       </div>
                   </div>


               </div>
           </div>
        <?php endif; ?>





        <?php if($post_type == 'zaimy') : ?>
            <!-- card_list  card_grid -->
            <div class="card card__vertical size4 offer h-100 card_custom_v1 <?= $view_type ?> ">
                <div class="card-container p-3">

                    <div class="card__header mb-2 d-flex">

                        <div class="card__header-left">
                            <div class="card__header-img">
                                <img src="<?php echo the_field('z_organization_logo', $ID) ?>"
                                 alt="<?
                                 $logo_id = get_field('z_organization_logo', $ID , false);
                                 $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                 echo $logo_alt;
                                 ?>">
                            </div>
                        </div>
                        <div class="card__header-right">
                            <div class="card__header-title">

                                <div class="card__header-title_v1">
                                    <a href="<?php the_permalink($bank_choise_rel);?>"><?php echo get_the_title($bank_choise_rel); ?></a>
                                </div>

                            </div>
                            <div class="card__header-info d-flex align-items-center">
                                <div class="card__rating d-flex align-items-center mr-3">
                                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                    <?php echo the_field('ratings_average'); ?>
                                </div>
                                <div class="position-relative card__icon d-flex align-items-center mr-3">
                                    <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                    <?php echo comments_number( '0', '1', '%'); ?>
                                </div>
                                <div class="card__icon d-flex align-items-center mr-3">
                                    <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                    <?php echo get_post_meta( get_the_id(), 'views', true ); ?>
                                </div>
                                <div class="card__like d-flex align-items-center">
                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                                <div class="card__header-actions ml-auto">
                                    <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="leaders">


                        <li class="leaders__item mb-1">
                            <div class="leaders__item-title">Сумма</div>
                            <div class="leaders__item-value">
                                <?= number_format(get_field('z_sum'), 0, '.', ' '); ?> ₽
                            </div>
                        </li>
                        <li class="leaders__item mb-1">
                            <div class="leaders__item-title">% ставка:</div>
                            <div class="leaders__item-value">От <?php echo the_field('z_stavka') ?>%</div>
                        </li>
                        <li class="leaders__item mb-1">
                            <div class="leaders__item-title">Срок:</div>
                            <div class="leaders__item-value">до <?php echo the_field('z_time'); ?> дней</div>
                        </li>


                    </ul>

                    <div class="card__actions d-flex">
                        <?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
                        <? if(!$apply_now):?>
                            <div class="col-9 px-1 px-md-2">
                                <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                            </div>
                        <? else: ?>
                            <div class="col-9 px-1 px-md-2">
                                <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                            </div>
                        <?endif; ?>
                        <div class="btn__compare_v1">
                            <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="kredity">
                                <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5 13V5.5M6 13V1M1.5 13V8.5" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="tabs-and-btns w-100">



                        <div class="card-tags">
                            <?php
                            // card_other_state
                            $z_other_statements = get_field('z_other_statements', $ID); ?>

                            <?php foreach ($z_other_statements as $item): ?>
                                <a href="#" class="btn calc__page-nav btn-light"><?php echo $item; ?></a>
                            <?php endforeach; ?>

                        </div>


                        <div class="card__footer-new">
                            <?
                            $ID = get_the_id();
                            $about_item = get_field('about_item', $ID);
                            $if_in_tab = get_field('if_in_tab', $ID);
                            $plus_and_minus_tab = get_field('plus_and_minus_tab', $ID);
                            $show_btn_detail = false;
                            if( have_rows('product_tar', $ID) || $about_item || $if_in_tab || $plus_and_minus_tab){
                                $show_btn_detail = true;
                            }
                            ?>
                            <? if($show_btn_detail): ?>
                                <div data-id='<?= get_the_id()?>' data-close="Скрыть" data-open="Подробнее" class="show__detail_popup">
                                    <div class="svg">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_4056_3857)">
                                                <path d="M9 12V9M9 6H9.0075M16.5 9C16.5 13.1421 13.1421 16.5 9 16.5C4.85786 16.5 1.5 13.1421 1.5 9C1.5 4.85786 4.85786 1.5 9 1.5C13.1421 1.5 16.5 4.85786 16.5 9Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_4056_3857">
                                                    <rect width="18" height="18" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </div>
                                    <div class="open__dop-btn-text">Подробнее</div>
                                </div>
                            <? endif; ?>


                            <div class="popup_detail_wrap popup popup_v1" style="display: none">
                                <div class="popup__inner">
                                    <div class="popup_close popup_close-css"><img src="/wp-content/themes/finbank_theme/img/close2.png" alt="Закрыть"></div>
                                    <div class="popup_body">

                                        <div class="card__header mb-2 d-flex">
                                            <div class="card__header-left">
                                                <div class="card__header-img">
                                                    <img src="<?php echo the_field('z_organization_logo', $ID) ?>"
                                                         alt="<?
                                                         $logo_id = get_field('z_organization_logo', $ID , false);
                                                         $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                         echo $logo_alt;
                                                         ?>">
                                                </div>
                                            </div>
                                            <div class="card__header-right">
                                                <div class="card__header-title">
                                                    <div class="card__header-title_v1">
                                                        <a href="<?php the_permalink($bank_choise_rel);?>"><?php echo get_the_title($bank_choise_rel); ?></a>
                                                    </div>

                                                </div>
                                                <div class="d-flex align-items-center mt-2">
                                                    <div class="card__rating d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                        <?php echo the_field('ratings_average'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="detail_popup detail_popup_v1">
                                        </div>

                                        <div class="order-7 row filter__main_bottom d-flex justify-content-between align-items-center">
                                            <div class="col-12 col-md-6 col-lg-2 mt-4">
                                                <input class="popup_close btn btn-outline-alternative btn-block" value="Закрыть">
                                            </div>
                                            <div class="col-12 col-md-7 col-lg-3 mt-4">
                                                <div class="d-flex">
                                                    <?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
                                                    <? if(!$apply_now):?>
                                                        <div class="col-10 px-1 px-md-2">
                                                            <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                                                        </div>
                                                    <? else: ?>
                                                        <div class="col-10 px-1 px-md-2">
                                                            <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                                                        </div>
                                                    <?endif; ?>
                                                    <div class="btn__compare_v1">
                                                        <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="kredity">
                                                            <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.5 13V5.5M6 13V1M1.5 13V8.5" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

        <?php endif; ?>


        <?php 
        switch ($term_slug) {
            case 'debetcard': ?>

            <!-- card_list  card_grid -->
            <div class="card card__vertical size4 offer h-100 card_custom_v1 <?= $view_type ?> ">
                    <div class="card-container p-3">
                        <div class="card__header mb-2 d-flex">
                            <div class="card__header-left">
                                <div class="card__header-img">
                                    <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                    <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                     alt="<?
                                     $logo_id = get_field('bank_logo',$bank_choise_rel , false);
                                     $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                     echo $logo_alt;
                                     ?>">
                                </div>
                            </div>
                            <div class="card__header-right">
                                <div class="card__header-title">
                                    <div class="card__header-title_v1">
                                        <a href="<?php the_permalink($bank_choise_rel);?>"><?php echo get_the_title($bank_choise_rel); ?></a>
                                    </div>
                                    <div class="card__header-title_v2">
                                        <a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
                                    </div>
                                </div>
                                <div class="card__header-info d-flex align-items-center">
                                    <div class="card__rating d-flex align-items-center mr-3">
                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                        <?php echo the_field('ratings_average'); ?>
                                    </div>
                                    <div class="position-relative card__icon d-flex align-items-center mr-3">
                                        <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                        <?php echo comments_number( '0', '1', '%'); ?>
                                    </div>
                                    <div class="card__icon d-flex align-items-center mr-3">
                                        <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                        <?php echo get_post_meta( get_the_id(), 'views', true ); ?>
                                    </div>
                                    <div class="card__like d-flex align-items-center">
                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                    </div>
                                    <div class="card__header-actions ml-auto">
                                        <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="leaders">


                            <li class="leaders__item mb-1">
                                <div class="leaders__item-title">Кэшбэк:</div>
                                <div class="leaders__item-value">
                                    <?php $field = get_field('card_cashback');
                                    echo $field['label'] ?? ''; ?>
                                </div>
                            </li>
                            <li class="leaders__item mb-1">
                                <div class="leaders__item-title">Стоимость:</div>
                                <div class="leaders__item-value"><?php echo the_field('card_cost') ?> ₽</div>
                            </li>

                            <li class="leaders__item mb-1">
                                <div class="leaders__item-title">% на остаток:</div>
                                <div class="leaders__item-value">
                                    до <?php echo the_field('card_stavka_ostatok') ?> %
                                </div>
                            </li>


                        </ul>

                        <div class="card__actions d-flex">
                            <?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
                            <? if(!$apply_now):?>
                                <div class="col-9 px-1 px-md-2">
                                    <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                                </div>
                            <? else: ?>
                                <div class="col-9 px-1 px-md-2">
                                    <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                                </div>
                            <?endif; ?>
                            <div class="btn__compare_v1">
                                <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="kredity">
                                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5 13V5.5M6 13V1M1.5 13V8.5" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="tabs-and-btns w-100">

                            <div class="card-tags">
                                <?php
                                // card_other_state
                                $z_other_statements = get_field('card_other_state', $ID); ?>

                                <?php foreach ($z_other_statements as $item): ?>
                                    <a href="#" class="btn calc__page-nav btn-light"><?php echo $item; ?></a>
                                <?php endforeach; ?>
                            </div>


                            <div class="card__footer-new">
                                <?
                                $ID = get_the_id();
                                $about_item = get_field('about_item', $ID);
                                $if_in_tab = get_field('if_in_tab', $ID);
                                $plus_and_minus_tab = get_field('plus_and_minus_tab', $ID);
                                $show_btn_detail = false;
                                if( have_rows('product_tar', $ID) || $about_item || $if_in_tab || $plus_and_minus_tab){
                                    $show_btn_detail = true;
                                }
                                ?>
                                <? if($show_btn_detail): ?>
                                    <div data-id='<?= get_the_id()?>' data-close="Скрыть" data-open="Подробнее" class="show__detail_popup">
                                        <div class="svg">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_4056_3857)">
                                                    <path d="M9 12V9M9 6H9.0075M16.5 9C16.5 13.1421 13.1421 16.5 9 16.5C4.85786 16.5 1.5 13.1421 1.5 9C1.5 4.85786 4.85786 1.5 9 1.5C13.1421 1.5 16.5 4.85786 16.5 9Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_4056_3857">
                                                        <rect width="18" height="18" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                        </div>
                                        <div class="open__dop-btn-text">Подробнее</div>
                                    </div>
                                <? endif; ?>


                                <div class="popup_detail_wrap popup popup_v1" style="display: none">
                                    <div class="popup__inner">
                                        <div class="popup_close popup_close-css"><img src="/wp-content/themes/finbank_theme/img/close2.png" alt="Закрыть"></div>
                                        <div class="popup_body">

                                            <div class="card__header mb-2 d-flex">
                                                <div class="card__header-left">
                                                    <div class="card__header-img">
                                                        <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                                         <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                                             alt="<?
                                                             $logo_id = get_field('bank_logo',$bank_choise_rel , false);
                                                             $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                             echo $logo_alt;
                                                             ?>">
                                                    </div>
                                                </div>
                                                <div class="card__header-right">
                                                    <div class="card__header-title">
                                                        <div class="card__header-title_v1">
                                                            <a href="<?php the_permalink($bank_choise_rel);?>"><?php echo get_the_title($bank_choise_rel); ?></a>
                                                        </div>
                                                        <div class="card__header-title_v2">
                                                            <a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mt-2">
                                                        <div class="card__rating d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                            <?php echo the_field('ratings_average'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="detail_popup detail_popup_v1">
                                            </div>

                                            <div class="order-7 row filter__main_bottom d-flex justify-content-between align-items-center">
                                                <div class="col-12 col-md-6 col-lg-2 mt-4">
                                                    <input class="popup_close btn btn-outline-alternative btn-block" value="Закрыть">
                                                </div>
                                                <div class="col-12 col-md-7 col-lg-3 mt-4">
                                                    <div class="d-flex">
                                                        <?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
                                                        <? if(!$apply_now):?>
                                                            <div class="col-10 px-1 px-md-2">
                                                                <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                                                            </div>
                                                        <? else: ?>
                                                            <div class="col-10 px-1 px-md-2">
                                                                <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                                                            </div>
                                                        <?endif; ?>
                                                        <div class="btn__compare_v1">
                                                            <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="kredity">
                                                                <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10.5 13V5.5M6 13V1M1.5 13V8.5" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

                <?php break;
            case 'installmentcard': ?>

                <!-- card_list  card_grid -->
                <div class="card card__vertical size4 offer h-100 card_custom_v1 <?= $view_type ?> ">
                    <div class="card-container p-3">
                        <div class="card__header mb-2 d-flex">
                            <div class="card__header-left">
                                <div class="card__header-img">
                                    <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                    <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                         alt="<?
                                         $logo_id = get_field('bank_logo',$bank_choise_rel , false);
                                         $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                         echo $logo_alt;
                                         ?>">
                                </div>
                            </div>
                            <div class="card__header-right">
                                <div class="card__header-title">
                                    <div class="card__header-title_v1">
                                        <a href="<?php the_permalink($bank_choise_rel);?>"><?php echo get_the_title($bank_choise_rel); ?></a>
                                    </div>
                                    <div class="card__header-title_v2">
                                        <a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
                                    </div>
                                </div>
                                <div class="card__header-info d-flex align-items-center">
                                    <div class="card__rating d-flex align-items-center mr-3">
                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                        <?php echo the_field('ratings_average'); ?>
                                    </div>
                                    <div class="position-relative card__icon d-flex align-items-center mr-3">
                                        <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                        <?php echo comments_number( '0', '1', '%'); ?>
                                    </div>
                                    <div class="card__icon d-flex align-items-center mr-3">
                                        <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                        <?php echo get_post_meta( get_the_id(), 'views', true ); ?>
                                    </div>
                                    <div class="card__like d-flex align-items-center">
                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                    </div>
                                    <div class="card__header-actions ml-auto">
                                        <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="leaders">
                            <li class="leaders__item mb-1">
                                <div class="leaders__item-title">Лимит</div>
                                <div class="leaders__item-value"><?php echo the_field('card_cred_limit') ?> р</div>
                            </li>
                            <li class="leaders__item mb-1">
                                <div class="leaders__item-title">Без %</div>
                                <div class="leaders__item-value"><?php $field = get_field('card_period');
                                    $value = $field['value'];
                                    $label = $field['choices'][ $value ];
                                    echo $field['label'] ?></div>
                            </li>
                            <li class="leaders__item mb-1">
                                <div class="leaders__item-title">Ставка</div>
                                <div class="leaders__item-value">от <?php echo the_field('card_stavka') ?>%</div>
                            </li>
                        </ul>



                        <div class="card__actions d-flex">
                            <?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
                            <? if(!$apply_now):?>
                                <div class="col-9 px-1 px-md-2">
                                    <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                                </div>
                            <? else: ?>
                                <div class="col-9 px-1 px-md-2">
                                    <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                                </div>
                            <?endif; ?>
                            <div class="btn__compare_v1">
                                <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="kredity">
                                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5 13V5.5M6 13V1M1.5 13V8.5" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="tabs-and-btns w-100">

                            <div class="card-tags">
                                <?php
                                // card_other_state
                                $z_other_statements = get_field('card_other_state', $ID); ?>

                                <?php foreach ($z_other_statements as $item): ?>
                                    <a href="#" class="btn calc__page-nav btn-light"><?php echo $item; ?></a>
                                <?php endforeach; ?>
                            </div>


                            <div class="card__footer-new">
                                <?
                                $ID = get_the_id();
                                $about_item = get_field('about_item', $ID);
                                $if_in_tab = get_field('if_in_tab', $ID);
                                $plus_and_minus_tab = get_field('plus_and_minus_tab', $ID);
                                $show_btn_detail = false;
                                if( have_rows('product_tar', $ID) || $about_item || $if_in_tab || $plus_and_minus_tab){
                                    $show_btn_detail = true;
                                }
                                ?>
                                <? if($show_btn_detail): ?>
                                    <div data-id='<?= get_the_id()?>' data-close="Скрыть" data-open="Подробнее" class="show__detail_popup">
                                        <div class="svg">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_4056_3857)">
                                                    <path d="M9 12V9M9 6H9.0075M16.5 9C16.5 13.1421 13.1421 16.5 9 16.5C4.85786 16.5 1.5 13.1421 1.5 9C1.5 4.85786 4.85786 1.5 9 1.5C13.1421 1.5 16.5 4.85786 16.5 9Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_4056_3857">
                                                        <rect width="18" height="18" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                        </div>
                                        <div class="open__dop-btn-text">Подробнее</div>
                                    </div>
                                <? endif; ?>


                                <div class="popup_detail_wrap popup popup_v1" style="display: none">
                                    <div class="popup__inner">
                                        <div class="popup_close popup_close-css"><img src="/wp-content/themes/finbank_theme/img/close2.png" alt="Закрыть"></div>
                                        <div class="popup_body">

                                            <div class="card__header mb-2 d-flex">
                                                <div class="card__header-left">
                                                    <div class="card__header-img">
                                                        <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                                         <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                                             alt="<?
                                                             $logo_id = get_field('bank_logo',$bank_choise_rel , false);
                                                             $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                             echo $logo_alt;
                                                             ?>">
                                                    </div>
                                                </div>
                                                <div class="card__header-right">
                                                    <div class="card__header-title">
                                                        <div class="card__header-title_v1">
                                                            <a href="<?php the_permalink($bank_choise_rel);?>"><?php echo get_the_title($bank_choise_rel); ?></a>
                                                        </div>
                                                        <div class="card__header-title_v2">
                                                            <a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mt-2">
                                                        <div class="card__rating d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                            <?php echo the_field('ratings_average'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="detail_popup detail_popup_v1">
                                            </div>

                                            <div class="order-7 row filter__main_bottom d-flex justify-content-between align-items-center">
                                                <div class="col-12 col-md-6 col-lg-2 mt-4">
                                                    <input class="popup_close btn btn-outline-alternative btn-block" value="Закрыть">
                                                </div>
                                                <div class="col-12 col-md-7 col-lg-3 mt-4">
                                                    <div class="d-flex">
                                                        <?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
                                                        <? if(!$apply_now):?>
                                                            <div class="col-10 px-1 px-md-2">
                                                                <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                                                            </div>
                                                        <? else: ?>
                                                            <div class="col-10 px-1 px-md-2">
                                                                <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                                                            </div>
                                                        <?endif; ?>
                                                        <div class="btn__compare_v1">
                                                            <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="kredity">
                                                                <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10.5 13V5.5M6 13V1M1.5 13V8.5" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

            <?php break;
            case 'creditcard': ?>
            
                <!-- card_list  card_grid -->
                <div class="card card__vertical size4 offer h-100 card_custom_v1 <?= $view_type ?> ">
                    <div class="card-container p-3">
                        <div class="card__header mb-2 d-flex">
                            <div class="card__header-left">
                                <div class="card__header-img">
                                    <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                    <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                         alt="<?
                                         $logo_id = get_field('bank_logo',$bank_choise_rel , false);
                                         $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                         echo $logo_alt;
                                         ?>">
                                </div>
                            </div>
                            <div class="card__header-right">
                                <div class="card__header-title">
                                    <div class="card__header-title_v1">
                                        <a href="<?php the_permalink($bank_choise_rel);?>"><?php echo get_the_title($bank_choise_rel); ?></a>
                                    </div>
                                    <div class="card__header-title_v2">
                                        <a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
                                    </div>
                                </div>
                                <div class="card__header-info d-flex align-items-center">
                                    <div class="card__rating d-flex align-items-center mr-3">
                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                        <?php echo the_field('ratings_average'); ?>
                                    </div>
                                    <div class="position-relative card__icon d-flex align-items-center mr-3">
                                        <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                        <?php echo comments_number( '0', '1', '%'); ?>
                                    </div>
                                    <div class="card__icon d-flex align-items-center mr-3">
                                        <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                        <?php echo get_post_meta( get_the_id(), 'views', true ); ?>
                                    </div>
                                    <div class="card__like d-flex align-items-center">
                                        <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                    </div>
                                    <div class="card__header-actions ml-auto">
                                        <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="leaders">
                            <li class="leaders__item mb-1">
                                <div class="leaders__item-title">Лимит</div>
                                <div class="leaders__item-value"><?php echo the_field('card_cred_limit') ?> р</div>
                            </li>
                            <li class="leaders__item mb-1">
                                <div class="leaders__item-title">Без %</div>
                                <div class="leaders__item-value"><?php $field = get_field('card_period');
                                    $value = $field['value'];
                                    $label = $field['choices'][ $value ];
                                    echo $field['label'] ?></div>
                            </li>
                            <li class="leaders__item mb-1">
                                <div class="leaders__item-title">Ставка</div>
                                <div class="leaders__item-value">от <?php echo the_field('card_stavka') ?>%</div>
                            </li>
                        </ul>



                        <div class="card__actions d-flex">
                            <?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
                            <? if(!$apply_now):?>
                                <div class="col-9 px-1 px-md-2">
                                    <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                                </div>
                            <? else: ?>
                                <div class="col-9 px-1 px-md-2">
                                    <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                                </div>
                            <?endif; ?>
                            <div class="btn__compare_v1">
                                <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="kredity">
                                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5 13V5.5M6 13V1M1.5 13V8.5" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="tabs-and-btns w-100">

                            <div class="card-tags">
                                <?php
                                // card_other_state
                                $z_other_statements = get_field('card_other_state', $ID); ?>

                                <?php foreach ($z_other_statements as $item): ?>
                                    <a href="#" class="btn calc__page-nav btn-light"><?php echo $item; ?></a>
                                <?php endforeach; ?>
                            </div>


                            <div class="card__footer-new">
                                <?
                                $ID = get_the_id();
                                $about_item = get_field('about_item', $ID);
                                $if_in_tab = get_field('if_in_tab', $ID);
                                $plus_and_minus_tab = get_field('plus_and_minus_tab', $ID);
                                $show_btn_detail = false;
                                if( have_rows('product_tar', $ID) || $about_item || $if_in_tab || $plus_and_minus_tab){
                                    $show_btn_detail = true;
                                }
                                ?>
                                <? if($show_btn_detail): ?>
                                    <div data-id='<?= get_the_id()?>' data-close="Скрыть" data-open="Подробнее" class="show__detail_popup">
                                        <div class="svg">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_4056_3857)">
                                                    <path d="M9 12V9M9 6H9.0075M16.5 9C16.5 13.1421 13.1421 16.5 9 16.5C4.85786 16.5 1.5 13.1421 1.5 9C1.5 4.85786 4.85786 1.5 9 1.5C13.1421 1.5 16.5 4.85786 16.5 9Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_4056_3857">
                                                        <rect width="18" height="18" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                        </div>
                                        <div class="open__dop-btn-text">Подробнее</div>
                                    </div>
                                <? endif; ?>


                                <div class="popup_detail_wrap popup popup_v1" style="display: none">
                                    <div class="popup__inner">
                                        <div class="popup_close popup_close-css"><img src="/wp-content/themes/finbank_theme/img/close2.png" alt="Закрыть"></div>
                                        <div class="popup_body">

                                            <div class="card__header mb-2 d-flex">
                                                <div class="card__header-left">
                                                    <div class="card__header-img">
                                                        <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                                         <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                                             alt="<?
                                                             $logo_id = get_field('bank_logo',$bank_choise_rel , false);
                                                             $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                             echo $logo_alt;
                                                             ?>">
                                                    </div>
                                                </div>
                                                <div class="card__header-right">
                                                    <div class="card__header-title">
                                                        <div class="card__header-title_v1">
                                                            <a href="<?php the_permalink($bank_choise_rel);?>"><?php echo get_the_title($bank_choise_rel); ?></a>
                                                        </div>
                                                        <div class="card__header-title_v2">
                                                            <a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mt-2">
                                                        <div class="card__rating d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                            <?php echo the_field('ratings_average'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="detail_popup detail_popup_v1">
                                            </div>

                                            <div class="order-7 row filter__main_bottom d-flex justify-content-between align-items-center">
                                                <div class="col-12 col-md-6 col-lg-2 mt-4">
                                                    <input class="popup_close btn btn-outline-alternative btn-block" value="Закрыть">
                                                </div>
                                                <div class="col-12 col-md-7 col-lg-3 mt-4">
                                                    <div class="d-flex">
                                                        <?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
                                                        <? if(!$apply_now):?>
                                                            <div class="col-10 px-1 px-md-2">
                                                                <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                                                            </div>
                                                        <? else: ?>
                                                            <div class="col-10 px-1 px-md-2">
                                                                <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                                                            </div>
                                                        <?endif; ?>
                                                        <div class="btn__compare_v1">
                                                            <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="kredity">
                                                                <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10.5 13V5.5M6 13V1M1.5 13V8.5" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>


            <?php break; }
