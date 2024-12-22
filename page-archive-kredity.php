<?php get_header() ?>

<main data-type="creditcard">
	<div class="container">
	    <nav aria-label="breadcrumb" class="horizontal__scroll">
	        <ol class="breadcrumb horizontal__scroll-container">
	            <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
	            <li class="breadcrumb-item active" aria-current="page">Архивные предложения</li>
	        </ol>
	    </nav>
	</div>
	<!-- page header -->
	<div class="page__heading mb-sm-4">
	    <div class="container">
	        <div class="page__heading-top d-flex justify-content-between align-items-center">
	            <div>
	                <h1 class="page__heading-title mb-0">Архивные предложения</h1>
	            </div>
	            <div class="page__heading-icon"><img src="<?php bloginfo('template_url'); ?>/img/icon__title-hand.png" alt="Архивные предложения"></div>
	        </div>
	    </div>
	</div>
	<!-- / page header -->
	<!-- page nav -->
	<div class="page__nav">
	    <div class="container">
	        <div class="page__nav-container nav-tabs">
	            <div class="horizontal__scroll">
	                <div class="horizontal__scroll-container">
	                    <a href="<?php echo get_page_link(6272) ?>" class="nav-link">Займы</a>
	                    <a href="<?php echo get_page_link(6278) ?>" class="nav-link active">Кредиты</a>
	                    <a href="<?php echo get_page_link(6276) ?>" class="nav-link">Кредитные карты</a>
	                    <a href="<?php echo get_page_link(6274) ?>" class="nav-link">Карты рассрочки</a>
	                    <a href="<?php echo get_page_link(6270) ?>" class="nav-link">Дебетовые карты</a>
	                    <!--a href="<?php echo get_page_link(6281) ?>" class="nav-link">Банки</a-->
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- / page nav -->
	<div class="container">
	    <!-- credits list -->
	    <div class="credits section">
	        <div class="row">	
	            <!-- list -->
	            <div class="col-12">
	                <div class="credits__list">
	                	<?php $products = get_field('best-products'); 
	                	?>
	                	
							    <div class="d-flex flex-wrap justify-content-between align-items-center mt-0 mt-md-5 mt-lg-0 mb-3">
							      <h2 class="mt-5 mb-4 mt-md-0 mb-md-0">Архивные предложения кредитов</h2>
							      <!--div class="credits__list-dropdown dropdown mb-3 mb-md-0 col-12 col-md-5 col-lg-3 px-0">
							          <select name="" class="styledSelect best1-order-select">

					          		<?php 
							          			$selected = 'selected';
							          			if (!empty($_GET['order'])) {
								          			$order = $_GET['order'];
								          			$selected = '';
							          			}

							          		?>
							          	  <option value="" <?= $selected; ?> disabled>Сортировать</option>
							              <option value="ratings_average" <?= ($order == 'ratings_average') ? selected :''; ?>>По рейтингу</option>
							              <option value="views" <?= ($order == 'views') ? selected :''; ?>>По количеству заявок</option>
							              <option value="credit_max_sum" <?= ($order == 'credit_max_sum') ? selected :''; ?>>По сумме кредита</option>
							              <option value="credit_stavka" <?= ($order == 'credit_stavka') ? selected :''; ?>>По процентной ставке</option>
							          </select>
							      </div-->
							  </div>
						
                          	<div class="best1_offers">

		                      <div class="best1_banner">
		                        <div class="best1_banner_logo">
		                          <img src="/wp-content/themes/finbank_theme/img/best_banner.png" alt="Посмотреть все">
		                          <div class="best1_banner_text">
		                            <div class="best1_banner_title">Не можете найти подходящее предложение?</div>
		                            Посмотрите разделы на сайте
		                          </div>
		                        </div>
		                        
		                      <?php if( have_rows('best-menu') ): ?>
		                        <div class="best1_banner_menu">
		                          <div class="best1_banner_menu_title">
		                            <svg width="18" height="16" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 30.5 27" style="enable-background:new 0 0 30.5 27" xml:space="preserve">
		                                <path d="M9.9 22.7c0-.4-.3-.7-.7-.7v1.3c.4 0 .7-.3.7-.6zM3.9 22h5.3v1.3H3.9z"></path>
		                                <path d="M3.9 23.3V22c-.4 0-.7.3-.7.7.1.3.4.6.7.6z"></path>
		                                <path d="M30.4 15.3 28.3 2.7c-.1-.9-.6-1.6-1.3-2.1-.7-.5-1.6-.7-2.4-.6L4.7 3.4c-1.8.3-3 2-2.7 3.8l.1.7C.9 8.4 0 9.6 0 11v12.7C0 25.5 1.5 27 3.3 27h20.1c1.8 0 3.3-1.5 3.3-3.3v-4.5l1.2-.2c.9-.1 1.6-.6 2.1-1.3.4-.7.6-1.6.4-2.4zm-5.1 8.4c0 1.1-.9 2-2 2h-20c-1.1 0-2-.9-2-2v-6.5h24v6.5zm0-7.8h-24v-2.8h24v2.8zm0-4.1h-24V11c0-1.1.9-2 2-2h20.1c1.1 0 2 .9 2 2v.8zm3.5 5.1c-.3.4-.8.7-1.3.8l-1 .2V11c0-1.8-1.5-3.3-3.3-3.3H3.5L3.4 7c-.2-1.1.5-2.1 1.6-2.3l19.8-3.4c1.1-.2 2.1.5 2.3 1.6l2.1 12.5c0 .6-.1 1.1-.4 1.5z"></path>
		                            </svg>              
		                            <?= get_field('best-banner-title'); ?>
		                          </div>
		                          <div class="best1_banner_ul">
		                            <ul>
		                            <?php while( have_rows('best-menu') ) : the_row(); ?>                              
		                              <li><a href="<?= get_sub_field('best-menu-link'); ?>"><?= get_sub_field('best-menu-title'); ?></a></li>
		                            <?php endwhile; ?>  
		                            </ul>
		                          </div>
		                        </div>
		                      <?php endif; ?>

		                      </div>


		                      <?php 
								$args = array(
								    'post_type' => 'kredity',
								    'posts_per_page' => -1,
								    'meta_key'      => 'archive',
    								'meta_value'    => true
								);
								if (!empty($_GET['order'])) $order = $_GET['order'];

								switch ($order) {
									case 'ratings_average':
										//$args['meta_key'] = 'ratings_average';
										$args['orderby'] = array( 'ratings_average' => 'desc', 'name' => 'desc' );
										$args['order'] = 'DESC';
										$args['meta_query'] = array(
											'relation' => 'OR',
										    array(
										        'key' => 'ratings_average',
										        'compare' => 'EXISTS', //or "NOT EXISTS", for non-existance of this key
										    ),
										    array(
										        'key' => 'ratings_average',
										        'compare' => 'NOT EXISTS', //or "NOT EXISTS", for non-existance of this key
										    ),	    
										);										
										break;
									case 'views':
									    $args['meta_key'] = 'views';
									    $args['orderby'] = array( 'meta_value_num' => 'desc', 'name' => 'desc' );
									    $args['order'] = 'DESC';
										break;
									case 'credit_max_sum':
									    $args['meta_key'] = 'credit_max_sum';
									    $args['orderby'] = array( 'meta_value_num' => 'desc', 'name' => 'desc' );
									    $args['order'] = 'DESC';
										break;
									case 'credit_stavka':
									    $args['meta_key'] = 'credit_stavka';
									    $args['orderby'] = array( 'meta_value_num' => 'desc', 'name' => 'desc' );
									    $args['order'] = 'DESC';
										break;
									default:
										$args['orderby'] = 'post_in';
										break;
								}
								$query = new WP_Query( $args );
								if ( $query->have_posts() ):
									$io = 0;
								    while ( $query->have_posts() ): $query->the_post(); $best_id = get_the_id(); $best_bank_id = get_field('product_bank', $best_id)?>
									
                                  <div class="best1_offer position-relative" style="order: <?= $io; ?>">
                                    <div class="best1_offer_logo">
                                      <img src="<?= get_field('card_logo', $best_id); ?>" alt="">
                                      <div class="best1_offer_meta">
                                      <div class="best1_offer_bankname"><?= get_the_title($best_bank_id) ?></div>
                                      <div class="best1_offer_name"><?= get_the_title($best_id) ?></div>

                                         <div class="d-flex align-items-center">
                                             <div class="card__rating d-flex align-items-center mr-3">
                                                 <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                 <?= get_field('ratings_average', $best_id); ?>
                                              </div>
                                              <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                  <div class="mr-2"><a href="<?php the_permalink($best_id) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                    <?php $comments_count = wp_count_comments($best_id); echo $comments_count->approved ?>
                                              </div>                               
                                         </div>
                                      </div>
                                    </div>
                                    <?php if (get_field('pl-color', $best_id) && get_field('pl-text', $best_id)): ?>
                                      <div class="best_strip_<?= get_field('pl-color', $best_id); ?>"><span><?= get_field('pl-text', $best_id); ?></span></div>
                                    <?php endif; ?>

                                          <div class="best1_offer_params">
                                            <div class="best1_offer_param">
                                              <div class="best1_offer_param_label">Макс. сумма</div>
                                              <div class="best1_offer_param_value"><?= get_field('credit_max_sum', $best_id) ?> ₽</div>
                                            </div>
                                            <div class="best1_offer_param">
                                              <div class="best1_offer_param_label">Ставка</div>
                                              <div class="best1_offer_param_value"><?= get_field('credit_stavka', $best_id); ?>%</div>
                                            </div>
                                            <div class="best1_offer_param">
                                              <div class="best1_offer_param_label">Срок кредита</div>
                                              <div class="best1_offer_param_value">до <?php $field = get_field('credit_period', $best_id); echo $field['label'] ?></div>
                                            </div>
                                          </div>                                          
                                    <div class="best1_offer_button">
                                      	<a href="<?php the_permalink($best_id); ?>" onclick="ym(35020350,'reachGoal','OFFERWALL_CLICK_OFFER'); return true;" class="btn btn-primary btn-block font-weight-normal best1_offer_btn stretched-link">Оформить</a> 
                                    </div>              
                                  </div>


	                        	<?php $io++; endwhile; ?>
	                        <?php endif; ?>
                        	</div>	


	                </div>
	            </div>
	            <!-- / list -->
	    </div>
	</div>
</div>	            
</main>


<?php get_footer() ?>