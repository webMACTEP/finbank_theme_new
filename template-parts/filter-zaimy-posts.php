<?php $query__card = ''; if (get_field('archive') != true) $query__card = 'query__card';?>
<?php $apply_now = get_field('apply_now_select_products', get_the_id()); ?>
        <div class="card card__horizontal mb-4 <?= $query__card; ?>">
         <div class="card-container d-flex flex-wrap">
             <div class="card__header d-flex justify-content-between align-items-center mb-3 flex-grow-1 order-1">
                 <h4 class="mb-0"><a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></h4>
                  <div class="card__header_right">   
                <?php if (get_field('archive') == true): ?>
                     <div class="card__archive">Архив</div>
                <?php endif; ?>
                 <a class="btn__compare <?php echo my_compare_btn(get_the_id()); ?> " data-id="<?php echo get_the_id() ?>" data-tax="zaimy">
                     <svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg"><path d="m3.29 19.939.44-.607-.44.607Zm-1.229-1.23.607-.44-.607.44Zm17.878 0-.607-.44.607.44Zm-1.23 1.23-.44-.607.44.607Zm0-17.878-.44.607.44-.607Zm1.23 1.23-.607.44.607-.44ZM3.29 2.06l.44.607-.44-.607Zm-1.229 1.23.607.44-.607-.44Zm14.133 6.598a.75.75 0 1 0-1.5 0h1.5Zm-1.5 6.667a.75.75 0 0 0 1.5 0h-1.5ZM11.75 5.444a.75.75 0 0 0-1.5 0h1.5Zm-1.5 11.112a.75.75 0 0 0 1.5 0h-1.5ZM7.306 12.11a.75.75 0 0 0-1.5 0h1.5Zm-1.5 4.445a.75.75 0 0 0 1.5 0h-1.5ZM11 20.25c-2.1 0-3.615-.001-4.789-.128-1.16-.126-1.9-.368-2.48-.79l-.882 1.214c.88.639 1.913.928 3.2 1.067 1.274.138 2.885.137 4.951.137v-1.5ZM.25 11c0 2.066-.001 3.677.137 4.95.14 1.288.428 2.321 1.067 3.2l1.214-.88c-.422-.582-.664-1.32-.79-2.481-.127-1.174-.128-2.69-.128-4.789H.25Zm3.48 8.332a4.807 4.807 0 0 1-1.062-1.063l-1.214.882c.39.535.86 1.006 1.395 1.395l.882-1.214ZM20.25 11c0 2.1-.001 3.615-.128 4.789-.126 1.16-.368 1.9-.79 2.48l1.214.882c.639-.88.928-1.913 1.067-3.2.138-1.274.137-2.885.137-4.951h-1.5ZM11 21.75c2.066 0 3.677.001 4.95-.137 1.288-.14 2.321-.428 3.2-1.067l-.88-1.214c-.582.422-1.32.664-2.481.79-1.174.127-2.69.128-4.789.128v1.5Zm8.332-3.48a4.808 4.808 0 0 1-1.063 1.062l.882 1.214a6.304 6.304 0 0 0 1.395-1.395l-1.214-.882ZM11 1.75c2.1 0 3.615.001 4.789.128 1.16.126 1.9.368 2.48.79l.882-1.214c-.88-.639-1.913-.927-3.2-1.067C14.677.249 13.066.25 11 .25v1.5ZM21.75 11c0-2.066.001-3.677-.137-4.95-.14-1.288-.428-2.321-1.067-3.2l-1.214.88c.422.582.664 1.32.79 2.481.127 1.174.128 2.69.128 4.789h1.5Zm-3.48-8.332c.407.296.766.655 1.062 1.063l1.214-.882a6.305 6.305 0 0 0-1.395-1.395l-.882 1.214ZM11 .25C8.934.25 7.323.249 6.05.387c-1.288.14-2.321.428-3.2 1.067l.88 1.214c.582-.422 1.32-.664 2.481-.79C7.385 1.751 8.901 1.75 11 1.75V.25ZM1.75 11c0-2.1.001-3.615.128-4.789.126-1.16.368-1.9.79-2.48l-1.214-.882C.815 3.73.527 4.762.387 6.05.249 7.324.25 8.934.25 11h1.5Zm1.1-9.546A6.306 6.306 0 0 0 1.453 2.85l1.214.882A4.805 4.805 0 0 1 3.73 2.668l-.882-1.214ZM14.693 9.89v6.667h1.5V9.889h-1.5ZM10.25 5.444v11.112h1.5V5.444h-1.5Zm-4.444 6.667v4.445h1.5V12.11h-1.5Z"></path></svg>    
                 </a>
                 </div>
             </div>
             <div class="card__footer mb-md-3 flex-grow-1 order-3 order-md-2">
                 <p>
                     <span class="mr-2 mr-md-5">
                        <?php //echo the_field('z_organization_phone') ?>
                        <a href="tel:<?= preg_replace('![^0-9]+!', '', get_field('z_organization_phone')); ?>"><?php echo the_field('z_organization_phone') ?></a>                         
                     </span>
                     <span class="mr-2 mr-md-5">



                         <?php if (get_field('card_bank_link')): ?>

                             <a href="<?= get_field('card_bank_link'); ?>"
                                onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;"
                                target="_blank">
                                <?= get_field('z_organization_site');  ?>
                            </a>

                         <?php else: ?>

                             <a data-popap-apply-id="<?= get_the_id(); ?>" class="off_site_link <?if($apply_now){ ?> apply_now_btm <? }else {?> out_exit_link <?}?>"
                                onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;"
                             >
                                <?= get_field('z_organization_site');  ?>
                            </a>

                         <?php endif; ?>



                     </span>                          
                     <span><?php echo get_post_meta( get_the_id(), 'views', true ); ?> заявок</span>
                 </p>
             </div>
             <div class="row flex-grow-1 order-2 order-md-3">
                 <div class="col-12 col-md-6 col-lg-5 mb-3 mb-md-0">
                     <div class="card__image">
                         <a href="<?php echo the_permalink() ?>">
                             <img src="<?php echo the_field('card_logo') ?>"
                                  alt="<?
                                  $logo_id = get_field('card_logo',get_the_ID() , false);
                                  $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                  echo $logo_alt;
                                  ?>">
                         </a>
                     </div>
                 </div>
                 <div class="col-12 col-md-6 col-lg-7">
                     <div class="row">
                         <div class="col-12 col-md-7">
                             <div class="card__field my-1">
                                 <span class="card__field-title">Сумма:</span> 
                                 <span class="card__field-num"><?= number_format(get_field('z_sum'), 0, '.', ' '); ?> ₽</span>
                             </div>
                             <div class="card__field my-1">
                                 <span class="card__field-title">Кредитная история:</span> 
                                 <span class="card__field-num"><?php echo the_field('z_history') ?></span>
                             </div>
                             <div class="card__field my-1">
                                 <span class="card__field-title">% ставка:</span> 
                                 <span class="card__field-num">От <?php echo the_field('z_stavka') ?>%</span>
                             </div>
                         </div>
                         <div class="col-12 col-md-5">
                             <div class="card__field my-1">
                                 <span class="card__field-title">Возраст:</span> 
                                 <span class="card__field-num">От <?= get_field('z_oldness'); ?> <?= YearTextArg(get_field('z_oldness')); ?></span>
                             </div>
                             <div class="card__field my-1">
                                 <span class="card__field-title">Срок:</span> 
                                 <span class="card__field-num">до <?php echo the_field('z_time'); ?> дней
                                </span>
                             </div>
                             <div class="card__field my-1">
                                 <span class="card__field-title">Решение:</span> 
                                 <span class="card__field-num"><?php echo the_field('z_answer') ?></span>
                             </div>
                         </div>
                     </div>
                     <div class="row mt-3 mx-n1 mx-md-n3">
                         <? if( get_field('card_bank_link')):?>
                             <div class="col-6 px-1 px-md-2">
                                 <a href="<?php echo the_field('card_bank_link') ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="btn btn-primary btn-block">Оформить</a>
                             </div>
                         <? else: ?>
                             <div class="col-6 px-1 px-md-2">
                                 <a data-popap-apply-id="<?= get_the_id(); ?>" target="_blank" onclick="<?echo get_metrika_for_list(get_field('card_bank_link')); ?> return true;" class="apply_now_btm btn btn-primary btn-block">Оформить</a>
                             </div>
                         <?endif; ?>

                         <div class="col-6 px-1 px-md-2">
                             <a href="<?php echo the_permalink() ?>" class="btn btn-outline-alternative btn-block">Подробнее</a>
                         </div>
                     </div>
                     <div class="d-sm-flex flex-wrap justify-content-between align-items-center mt-3">
                         <a href="<?php the_permalink($bank_id); ?>" class="font-weight-semibold"><?php echo the_field('z_organization_name'); ?></a>
                         <div class="ml-xl-auto d-flex align-items-center my-2 my-sm-0">
                             <div class="card__rating d-flex align-items-center mr-3">
                                 <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                 <?php echo the_field('ratings_average'); ?>
                             </div>
                             <div class="card__icon d-flex align-items-center mr-3">
                                 <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                                 <?php echo get_post_meta( get_the_id(), 'views', true ); ?>
                             </div>
                              <div class="position-relative card__icon d-flex align-items-center mr-3">
                                  <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                  <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->approved ?>
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
                         <div data-id='<?= get_the_id()?>' data-close="Скрыть" data-open="Подробнее" class="open__dop-btn">
                             <div class="open__dop-btn-text">Подробнее</div>
                             <div class="navigation__item-arrow">
                                 <svg width="12" height="6" viewBox="0 0 12 6">
                                     <use xlink:href="/wp-content/themes/finbank_theme/img/icons.svg#arrow" x="0" y="0"></use>
                                 </svg>
                             </div>
                         </div>
                     <? endif; ?>

                     <?php $date_actually =  get_the_modified_date('d.m.Y', $bank_id);  ?>
                     <? if($date_actually): ?>
                         <div class="date_actually">Обновлено: <?= $date_actually?></div>
                     <? endif; ?>
                 </div>

                 <div class="tabs">
                 </div>
             </div>

            <?php if(get_the_ID() == 5637): ?>
             <!--div class="row flex-grow-1 order-3">
                 <div class="col-12">
                    <div class="post-more">
                        <div class="post-more-link">Подробнее</div>
                        <div class="post-more-content" style="display:none;">
                            “Надо Денег” — онлайн-сервис по выдаче микрозаймов. Здесь заемщики могут получить на прозрачных условиях до 30 тысяч рублей на срок от 7 до 30 дней. Как и во многих других компаниях, здесь действует специальное предложение для новых заемщиков — они могут оформить свой первый заем под 0% в день.
                        </div>
                    </div>
                 </div>
             </div-->
            <?php endif; ?>    
         </div>
     </div>