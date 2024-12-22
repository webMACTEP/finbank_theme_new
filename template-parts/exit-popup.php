  <?php  if(get_field('exit_popup_on', 'option')): //1912

            wp_enqueue_style( 'style',  get_template_directory_uri() .'/css/exit_popup.css');
            
            $titlepage = '';
            
            if (!empty($_SESSION['titlepage']) && $_SESSION['titlepage'] != 'Главная страница'){
                $titlepage = $_SESSION['titlepage'];  
            }

            $posttype = get_post_type(get_the_id());

            $metrika_for_offer = "ym(35020350,'reachGoal','1EX_POPUP_cr'); ym(35020350,'reachGoal','exit_popup_click'); ym(35020350,'reachGoal','exit_popup_click_test'); return true;";
            //$metrika_for_offer_with_tag = "ym(35020350,'reachGoal','2EX_POPUP_cr'); ym(35020350,'reachGoal','exit_popup_click'); ym(35020350,'reachGoal','exit_popup_click_test'); return true;";

            switch ($posttype) {

                case 'kredity':
                case 'bankcard': ?>
                
                <div data-popap="popap_witch_tag" class="popup_exit_wrap check_popap" style="display:none;">
                  <div class="popup_exit">
                    <div onclick="ym(35020350,'reachGoal','2EX_POPUP_X'); return true;" class="popup_exit_close"><img alt="Закрыть" src="/wp-content/themes/finbank_theme/img/close2.png"></div>
                    <div class="popup_exit_body">
                      <h2>Подождите! Мы покажем лучшие предложения</h2>

                      <?php if( have_rows('bank-exit', 'option') ): ?>
                          <div class="exit1_offers">
                        <?php while( have_rows('bank-exit', 'option') ) : the_row(); ?>

                              <?php $bank_exit_id = get_sub_field('bank-exit-offer'); ?>

                              <?php        
                                  $posttype = get_post_type($bank_exit_id);

                                  switch ($posttype) {
                                      case 'kredity': ?>

                                  <div class="exit1_offer position-relative">
                                    <div class="exit1_offer_logo">
                                      <img src="<?php $bank_choise_rel = get_field('product_bank', $bank_exit_id) ?>
                                                         <?= get_field('bank_logo', $bank_choise_rel) ?>"
                                           alt="<? echo get_post_meta(get_field('bank_logo', $bank_choise_rel, false), '_wp_attachment_image_alt', true);?>">
                                      <div class="exit1_offer_meta">
                                      <div class="exit1_offer_name"><?= get_the_title($bank_exit_id) ?></div>

                                         <div class="d-flex align-items-center">
                                             <div class="card__rating d-flex align-items-center mr-3">
                                                 <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                 <?= get_field('ratings_average', $bank_exit_id); ?>
                                              </div>
                                              <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                  <div class="mr-2"><a href="<?php the_permalink($bank_exit_id) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                    <?php $comments_count = wp_count_comments($bank_exit_id); echo $comments_count->approved ?>
                                              </div>                               
                                         </div>
                                      </div>
                                    </div>
                                          <?php if (get_field('pl-color', $bank_exit_id) && get_field('pl-text', $bank_exit_id)): ?>
                                            <div class="exit1_strip_<?= get_field('pl-color', $bank_exit_id); ?>"><span><?= get_field('pl-text', $bank_exit_id); ?></span></div>
                                          <?php endif; ?>  
                                          <div class="exit1_offer_params">
                                            <div class="exit1_offer_param">
                                              <div class="exit1_offer_param_label">Макс. сумма</div>
                                              <div class="exit1_offer_param_value"><?= get_field('credit_max_sum', $bank_exit_id) ?> ₽</div>
                                            </div>
                                            <div class="exit1_offer_param">
                                              <div class="exit1_offer_param_label">% ставка</div>
                                              <div class="exit1_offer_param_value"><?= get_field('credit_stavka', $bank_exit_id); ?></div>
                                            </div>
                                            <div class="exit1_offer_param">
                                              <div class="exit1_offer_param_label">Срок кредита</div>
                                              <div class="exit1_offer_param_value">до <?php $field = get_field('credit_period', $bank_exit_id); echo $field['label'] ?></div>
                                            </div>
                                          </div>
                                    <div class="exit1_offer_button">
                                      <?php if (get_field('card_bank_link', $bank_exit_id)): ?>
                                        <a href="<?= get_field('card_bank_link', $bank_exit_id) ?>"
                                           target="_blank" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                           onclick="<?= get_metrika_for_exit_popap_with_tag(get_field('card_bank_link', $bank_exit_id));  ?>">Подробнее</a>
                                      <?php else: ?>
                                        <a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                           onclick="<?= get_metrika_for_exit_popap_with_tag(get_field('card_bank_link', $bank_exit_id)); ?>">Подробнее</a>
                                      <?php endif; ?> 

                                      <!--a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link">Подробнее</a-->
                                    </div>              
                                  </div>

                                      <?php  break;
                                      case 'bankcard':
                                          $termpost = wp_get_post_terms($bank_exit_id, 'bankcards');
                                              if ($termpost[0]->slug == 'debetcard') { ?>

                                                  <div class="exit1_offer position-relative">
                                                    <div class="exit1_offer_logo">
                                                      <img src="<?php $bank_choise_rel = get_field('bank_choise', $bank_exit_id) ?>
                                                                         <?= get_field('bank_logo', $bank_choise_rel) ?>"
                                                           alt="<? echo get_post_meta(get_field('bank_logo', $bank_choise_rel, false), '_wp_attachment_image_alt', true);?>">
                                                      <div class="exit1_offer_meta">
                                                      <div class="exit1_offer_name"><?= get_the_title($bank_exit_id) ?></div>

                                                         <div class="d-flex align-items-center">
                                                             <div class="card__rating d-flex align-items-center mr-3">
                                                                 <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                                 <?= get_field('ratings_average', $bank_exit_id); ?>
                                                              </div>
                                                              <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                                  <div class="mr-2"><a href="<?php the_permalink($bank_exit_id) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                                    <?php $comments_count = wp_count_comments($bank_exit_id); echo $comments_count->approved ?>
                                                              </div>                               
                                                         </div>
                                                      </div>
                                                    </div>
                                                <?php if (get_field('pl-color', $bank_exit_id) && get_field('pl-text', $bank_exit_id)): ?>
                                                  <div class="exit1_strip_<?= get_field('pl-color', $bank_exit_id); ?>"><span><?= get_field('pl-text', $bank_exit_id); ?></span></div>
                                                <?php endif; ?>  
                                                  <div class="exit1_offer_params">
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Снятие без %</div>
                                                      <div class="exit1_offer_param_value">до <?= get_field('non_pecent_money', $bank_exit_id) ?> ₽</div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">% на остаток</div>
                                                      <div class="exit1_offer_param_value">до <?= get_field('card_stavka_ostatok', $bank_exit_id); ?></div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Кешбэк</div>
                                                      <div class="exit1_offer_param_value"><?php $field = get_field('card_cashback', $bank_exit_id); echo $field['label'] ?></div>
                                                    </div>
                                                  </div>
                                                    <div class="exit1_offer_button">
                                                    <?php if (get_field('card_bank_link', $bank_exit_id)): ?>
                                                      <a href="<?= get_field('card_bank_link', $bank_exit_id) ?>" target="_blank" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                         onclick="<?= get_metrika_for_exit_popap_with_tag(get_field('card_bank_link', $bank_exit_id)); ?>">Подробнее</a>
                                                    <?php else: ?>
                                                      <a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                         onclick="<?= get_metrika_for_exit_popap_with_tag(get_field('card_bank_link', $bank_exit_id)); ?>">Подробнее</a>
                                                    <?php endif; ?>                                                       
                                                      <!--a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link">Подробнее</a-->
                                                    </div>              
                                                  </div>
                                                  
                                              <?php } elseif ($termpost[0]->slug == 'creditcard') { ?>

                                                  <div class="exit1_offer position-relative">
                                                    <div class="exit1_offer_logo">
                                                      <img src="<?php $bank_choise_rel = get_field('bank_choise', $bank_exit_id) ?>
                                                            <?= get_field('bank_logo', $bank_choise_rel) ?>"
                                                           alt="<? echo get_post_meta(get_field('bank_logo', $bank_choise_rel, false), '_wp_attachment_image_alt', true);?>">
                                                      <div class="exit1_offer_meta">
                                                      <div class="exit1_offer_name"><?= get_the_title($bank_exit_id) ?></div>

                                                         <div class="d-flex align-items-center">
                                                             <div class="card__rating d-flex align-items-center mr-3">
                                                                 <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                                 <?= get_field('ratings_average', $bank_exit_id); ?>
                                                              </div>
                                                              <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                                  <div class="mr-2"><a href="<?php the_permalink($bank_exit_id) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                                    <?php $comments_count = wp_count_comments($bank_exit_id); echo $comments_count->approved ?>
                                                              </div>                               
                                                         </div>
                                                      </div>
                                                    </div>
                                                <?php if (get_field('pl-color', $bank_exit_id) && get_field('pl-text', $bank_exit_id)): ?>
                                                  <div class="exit1_strip_<?= get_field('pl-color', $bank_exit_id); ?>"><span><?= get_field('pl-text', $bank_exit_id); ?></span></div>
                                                <?php endif; ?>                                                  
                                                  <div class="exit1_offer_params">
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Лимит</div>
                                                      <div class="exit1_offer_param_value"><?= get_field('card_cred_limit', $bank_exit_id) ?> ₽</div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Без %</div>
                                                      <div class="exit1_offer_param_value"><?php $field = get_field('card_period', $bank_exit_id); echo $field['label'] ?></div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Ставка</div>
                                                      <div class="exit1_offer_param_value">от <?= get_field('card_stavka', $bank_exit_id); ?>%</div>
                                                    </div>
                                                  </div>
                                                    <div class="exit1_offer_button">
                                                      <!--a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link">Подробнее</a-->
                                                      <?php if (get_field('card_bank_link', $bank_exit_id)): ?>
                                                        <a href="<?= get_field('card_bank_link', $bank_exit_id) ?>" target="_blank" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                           onclick="<?= get_metrika_for_exit_popap_with_tag(get_field('card_bank_link', $bank_exit_id)); ?>">Подробнее</a>
                                                      <?php else: ?>
                                                        <a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                           onclick="<?= get_metrika_for_exit_popap_with_tag(get_field('card_bank_link', $bank_exit_id)); ?>">Подробнее</a>
                                                      <?php endif; ?>                                                       
                                                    </div>              
                                                  </div>
                                                 
                                              <?php } elseif ($termpost[0]->slug == 'installmentcard') { ?>

                                                  <div class="exit1_offer position-relative">
                                                    <div class="exit1_offer_logo">
                                                      <img src="<?php $bank_choise_rel = get_field('bank_choise', $bank_exit_id) ?>
                                                                         <?= get_field('bank_logo', $bank_choise_rel) ?>"
                                                           alt="<? echo get_post_meta(get_field('bank_logo', $bank_choise_rel, false), '_wp_attachment_image_alt', true);?>"
                                                      >
                                                      <div class="exit1_offer_meta">
                                                      <div class="exit1_offer_name"><?= get_the_title($bank_exit_id) ?></div>

                                                         <div class="d-flex align-items-center">
                                                             <div class="card__rating d-flex align-items-center mr-3">
                                                                 <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                                 <?= get_field('ratings_average', $bank_exit_id); ?>
                                                              </div>
                                                              <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                                  <div class="mr-2"><a href="<?php the_permalink($bank_exit_id) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                                    <?php $comments_count = wp_count_comments($bank_exit_id); echo $comments_count->approved ?>
                                                              </div>                               
                                                         </div>
                                                      </div>
                                                    </div>
                                                <?php if (get_field('pl-color', $bank_exit_id) && get_field('pl-text', $bank_exit_id)): ?>
                                                  <div class="exit1_strip_<?= get_field('pl-color', $bank_exit_id); ?>"><span><?= get_field('pl-text', $bank_exit_id); ?></span></div>
                                                <?php endif; ?>   
                                                  <div class="exit1_offer_params">
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Лимит</div>
                                                      <div class="exit1_offer_param_value"><?= get_field('card_cred_limit', $bank_exit_id) ?> ₽</div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Без %</div>
                                                      <div class="exit1_offer_param_value"><?php $field = get_field('card_period', $bank_exit_id); echo $field['label'] ?></div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Ставка</div>
                                                      <div class="exit1_offer_param_value">от <?= get_field('card_stavka', $bank_exit_id); ?>%</div>
                                                    </div>
                                                  </div>    
                                                    <div class="exit1_offer_button">
                                                      <?php if (get_field('card_bank_link', $bank_exit_id)): ?>
                                                        <a href="<?= get_field('card_bank_link', $bank_exit_id) ?>" target="_blank" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                           onclick="<?= get_metrika_for_exit_popap_with_tag(get_field('card_bank_link', $bank_exit_id)); ?>">Подробнее</a>
                                                      <?php else: ?>
                                                        <a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                           onclick="<?= get_metrika_for_exit_popap_with_tag(get_field('card_bank_link', $bank_exit_id));  ?>">Подробнее</a>
                                                      <?php endif; ?>                                                       
                                                      <!--a href="<?php the_permalink($bank_exit_id); ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link">Подробнее</a-->
                                                    </div>              
                                                  </div>
                                                  
                                              <?php } 
                                      break;
                                  }
                              ?>    
                            
                        <?php endwhile; wp_reset_postdata(); ?>

                        </div>

                      <?php endif; ?>


                      <?php // $banks_exit = get_field('bank-exit', 'option'); ?>
                      
                      <div class="exit_ili_block">
                        <div class="exit_ili"><span>или</span></div>
                      <div class="exit1_button">
                        <a onclick="ym(35020350,'reachGoal','2EX_POPUP_close'); return true;" href="https://www.google.ru/search?q=<?= $titlepage; ?>" class="btn btn-outline-primary exit1_btn">Спасибо, не надо, закрыть страницу</a>
                        <a href="https://www.google.ru/search?q=<?= $titlepage; ?>" class="btn btn-outline-primary exit1_btn_mob">Закрыть страницу</a>
                      </div>     
                        <div class="exit_ili"><span>или</span></div>
                      </div>

                      <div class="exit_banner">
                        <div class="exit_banner_logo">
                          <img src="/wp-content/themes/finbank_theme/img/exit_banner.jpg" alt="Баннер выхода">
                          <div class="exit_banner_text">
                            <div class="exit_banner_title">Не можете найти подходящее предложение?</div>
                            Посмотрите разделы на сайте
                          </div>
                        </div>
                        
                      <?php if( have_rows('menu-exit', 'option') ): ?>
                        <div class="exit_banner_menu">
                          <div class="exit_banner_menu_title">
                            <svg width="18" height="16" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 30.5 27" style="enable-background:new 0 0 30.5 27" xml:space="preserve">
                                <path d="M9.9 22.7c0-.4-.3-.7-.7-.7v1.3c.4 0 .7-.3.7-.6zM3.9 22h5.3v1.3H3.9z"></path>
                                <path d="M3.9 23.3V22c-.4 0-.7.3-.7.7.1.3.4.6.7.6z"></path>
                                <path d="M30.4 15.3 28.3 2.7c-.1-.9-.6-1.6-1.3-2.1-.7-.5-1.6-.7-2.4-.6L4.7 3.4c-1.8.3-3 2-2.7 3.8l.1.7C.9 8.4 0 9.6 0 11v12.7C0 25.5 1.5 27 3.3 27h20.1c1.8 0 3.3-1.5 3.3-3.3v-4.5l1.2-.2c.9-.1 1.6-.6 2.1-1.3.4-.7.6-1.6.4-2.4zm-5.1 8.4c0 1.1-.9 2-2 2h-20c-1.1 0-2-.9-2-2v-6.5h24v6.5zm0-7.8h-24v-2.8h24v2.8zm0-4.1h-24V11c0-1.1.9-2 2-2h20.1c1.1 0 2 .9 2 2v.8zm3.5 5.1c-.3.4-.8.7-1.3.8l-1 .2V11c0-1.8-1.5-3.3-3.3-3.3H3.5L3.4 7c-.2-1.1.5-2.1 1.6-2.3l19.8-3.4c1.1-.2 2.1.5 2.3 1.6l2.1 12.5c0 .6-.1 1.1-.4 1.5z"></path>
                            </svg>              
                            Кредитные карты
                          </div>
                          <div class="exit_banner_ul">
                            <ul>
                            <?php while( have_rows('menu-exit', 'option') ) : the_row(); ?>                              
                              <li><a href="<?= get_sub_field('exit-menu-link'); ?>"><?= get_sub_field('exit-menu-title'); ?></a></li>
                            <?php endwhile; ?>  
                            </ul>
                          </div>
                        </div>
                      <?php endif; ?>

                      </div>


                    </div> <!-- /popup_exit_body -->
                  </div>
                </div>

                <?php break;

                default: ?>
                <div data-popap="popap_best_offers" class="popup_exit_wrap check_popap" style="display:none;">
                    <div class="popup_exit">
                      <div onclick="ym(35020350,'reachGoal','1EX_POPUP_X'); return true;" class="popup_exit_close"><img alt="Закрыть" src="/wp-content/themes/finbank_theme/img/close2.png"></div>
                      <div class="popup_exit_body">
                        <h2>3 лучших предложения</h2>

                        <?php
                        $mfos_exit = get_field('mfo-exit', 'option');
                        if( $mfos_exit ): ?>
                            <div class="exit_offers">
                            <?php foreach( $mfos_exit as $mfo_exit ): ?>

                                                  <div class="exit1_offer position-relative">
                                                    <div class="exit1_offer_logo">
                                                      <img src="<?= get_field('z_organization_logo', $mfo_exit); ?>" alt="<?= get_field('z_organization_name', $mfo_exit); ?>">
                                                      <div class="exit1_offer_meta">
                                                      <div class="exit1_offer_name"><?= get_field('z_organization_name', $mfo_exit); ?></div>

                                                         <div class="d-flex align-items-center">
                                                             <div class="card__rating d-flex align-items-center mr-3">
                                                                 <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                                 <?= get_field('ratings_average', $mfo_exit); ?>
                                                              </div>
                                                              <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                                  <div class="mr-2"><a href="<?php the_permalink($mfo_exit) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                                    <?php $comments_count = wp_count_comments($mfo_exit); echo $comments_count->approved ?>
                                                              </div>                               
                                                         </div>
                                                      </div>
                                                    </div>
                                                <?php if (get_field('pl-color', $mfo_exit) && get_field('pl-text', $mfo_exit)): ?>
                                                  <div class="exit1_strip_<?= get_field('pl-color', $mfo_exit); ?>"><span><?= get_field('pl-text', $mfo_exit); ?></span></div>
                                                <?php else: ?>  
                                                  <div class="exit1_strip_red"><span>Лучшее предложение</span></div>
                                                <?php endif; ?>                                                 

                                                  <div class="exit1_offer_params">
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Сумма займа</div>
                                                      <div class="exit1_offer_param_value"><?= get_field('z_sum', $mfo_exit); ?> ₽</div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">% ставка</div>
                                                      <div class="exit1_offer_param_value"><?= get_field('z_stavka', $mfo_exit); ?>%</div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Кредитная история</div>
                                                      <div class="exit1_offer_param_value"><?= get_field('z_history', $mfo_exit); ?></div>
                                                    </div>
                                                    <div class="exit1_offer_param">
                                                      <div class="exit1_offer_param_label">Срок</div>
                                                      <div class="exit1_offer_param_value">От <?= get_field('z_time', $mfo_exit); ?> дней</div>
                                                    </div>                                                    
                                                  </div>
                                                    <div class="exit1_offer_button">
                                                    <?php if (get_field('card_bank_link', $mfo_exit)): ?>
                                                      <a href="<?= get_field('card_bank_link', $mfo_exit) ?>" target="_blank" class="btn btn-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                         onclick="<?= get_metrika_for_exit_popap(get_field('card_bank_link', $mfo_exit)); ?>">Оформить</a>
                                                    <?php else: ?>
                                                      <a href="<?php the_permalink($mfo_exit); ?>" class="btn btn-primary btn-sm btn-block font-weight-normal exit1_offer_btn stretched-link"
                                                         onclick="<?=  get_metrika_for_exit_popap(get_field('card_bank_link', $mfo_exit)); ?>">Оформить</a>
                                                    <?php endif; ?>                                                       
                                                    </div>              
                                                  </div>

                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="exit_button">
                          <a onclick="ym(35020350,'reachGoal','1EX_POPUP_close'); return true;" href="https://www.google.ru/search?q=<?= $titlepage; ?>" class="btn btn-outline-primary btn-block btn-sm exit_btn">Спасибо, не надо</a>

                        </div>         
                      </div>
                    </div>
                  </div>                     


                <?php break;
            }

?>

  <?php endif; ?> 