<?php get_header() ?>
<?php 
$category = get_queried_object();
$current_cat_id = $category->term_id;
$current_cat_name = $category->name;
$current_cat_slug = $category->slug;
$current_cat = get_term($current_cat_id);
$parent_cat_id = $current_cat->parent;
?>

    <main id="primary" class="site-main">

    <div class="container">
	    <div class="section">
	        <div class="article__container">
	            <!-- sidebar left -->
	            <div class="article__container-left order-xl-1">
	                <div class="article__nav sticky-top">
	                    <div class="article__nav-section">
	                        <div class="article__nav-title article__container-title dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static">
	                            Формат
	                            <svg class="d-lg-none" width="12" height="6" viewBox="0 0 12 6">
	                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
	                            </svg>
	                        </div>
	                        <div class="article__nav-wrap dropdown-menu">
	                        	<?php $categories = get_terms( 
													   'category', 
													    array('parent' => 0, 
													    	    'hide_empty' => true, 
													    	    'exclude'       => array(1),
													    	     'orderby'       => 'id',
													    	     'order'         => 'ASC',)
													);
													foreach($categories as $cat): ?>
														<a class="article__nav-link" href="<?php echo get_term_link($cat->term_id) ?>">
					                                <span class="article__nav-icon">
					                                    <?php echo the_field('cat_image', 'category_'.$cat->term_id); ?>
					                                </span>
					                                <?php echo $cat->name; ?>
					                            </a>
													<?php endforeach; ?>
	                        </div>
	                    </div>
	                    <div class="article__nav-section">
	                        <div class="article__nav-title article__container-title dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static">
	                            Рубрика
	                            <svg class="d-lg-none" width="12" height="6" viewBox="0 0 12 6">
	                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
	                            </svg>
	                        </div>
	                        <div class="article__nav-wrap dropdown-menu">
	                            <?php 
	                            if($parent_cat_id == 0): 
	                            	$categories = get_terms( 
											   'category', 
											    array('parent' => $current_cat_id, 
											    	    'hide_empty' => true, 
											    	    'exclude'       => array(1),
											    	     'orderby'       => 'id',
											    	     'order'         => 'ASC',)
											);
	                            else:
	                            	$categories = get_terms( 
											   'category', 
											    array('parent' => $parent_cat_id, 
											    	    'hide_empty' => true, 
											    	    'exclude'       => array(1),
											    	     'orderby'       => 'id',
											    	     'order'         => 'ASC',)
											);
	                            endif;
											foreach($categories as $cat): ?>
			                            <a class="article__nav-link" href="<?php echo get_term_link($cat->term_id) ?>">
			                                <span class="article__nav-icon">
			                                    <?php echo the_field('cat_image', 'category_'.$cat->term_id); ?>
			                                </span>
			                                <?php echo $cat->name; ?>
			                            </a>
											<?php endforeach; ?>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- / sidebar left -->
	            <!-- sidebar right -->
	            <div class="article__container-right d-none d-xl-block order-xl-3">
	                <div class="sticky-top">
	                    <!-- article news -->
	                    <div class="article__news mb-5">
	                    		<?php 
	                            if($parent_cat_id == 0): 
	                            	$popular_name = $category->name;
	                            	$popular_id = $current_cat_id;
	                            else: 
	                            	$popular_name = get_category_parents($parent_cat_id, '', '');
	                            	$popular_id = $category->parent;
	                            endif; ?>
	                        <h3 class="article__news-title article__container-title mb-3">Популярные <?php echo $popular_name ?></h3>
	                        <?php 
										$args = array(
										    'posts_per_page' => 5,
										    'post_type' => 'post',
										    'meta_key' => 'views',
										    'cat' => $popular_id,
										    'orderby' => 'meta_value_num',
										    'order' => 'DESC',
										);
										$wp_query = new WP_Query( $args );
										if ( $wp_query->have_posts() ) {
										    while ( $wp_query->have_posts() ) {
										        $wp_query->the_post(); ?>
										<div class="article__news-item">
		                            <?php $image = get_the_post_thumbnail_url(); ?>
											<?php if($image != ''): ?>
												<div class="article__news-img">
                                                    <img style="width: 100%; height: 100%; object-fit: cover;" src="<?php echo the_post_thumbnail_url() ?>"
                                                         alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);?>">
                                                </div>
											<?php endif; ?>
		                            <div class="article__news-body">
		                                <a class="stretched-link" href="<?php echo the_permalink() ?>"><span><?php echo the_title() ?></span></a>
		                                <div class="d-flex align-items-center mt-2">
		                                    <div class="card__icon d-flex align-items-center mr-3">
		                                        <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
		                                        <?php echo the_field('views') ?>
		                                    </div>
					                      <div class="position-relative card__icon d-flex align-items-center mr-3">
					                          <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
					                          <?php echo comments_number( '0', '1', '%'); ?>
					                      </div>
		                                </div>
		                            </div>
		                        </div>
										<?php
										    }
										} ?>
										<?php wp_reset_query() ?>
	                    </div>
	                    <!-- / article news -->
	                    <!-- best offers -->
	                    <?php $featured_posts = get_field('cat_best_prod', 'category_'.$current_cat_id);
	                    // var_dump($featured_posts);
        								if( $featured_posts ): ?>
        									<div class="article__offers">
	                        			<h3 class="article__offers-title article__container-title">Лучшие предложения</h3>
	                        			<?php foreach( $featured_posts as $post ): 
								                setup_postdata($post); 
								                $loop_id = get_the_id(); 
								                $post_type = get_post_type($loop_id); 
								                switch ($post_type) {
														    case 'bankcard':
														       $bank_id = get_field('bank_choise', $loop_id);
														       $logo_img = get_field('bank_logo', $bank_id);
                                                               $logo_id = get_field('bank_logo', $bank_id, false);
														        break;
														    case 'zaimy':
														       $logo_img = get_field('z_organization_logo', $loop_id);
                                                               $logo_id = get_field('z_organization_logo', $loop_id, false);
														        break;
														    case 'kredity':
														       $bank_id = get_field('product_bank', $loop_id);
														       $logo_img =  get_field('bank_logo', $bank_id);
                                                                $logo_id = get_field('bank_logo', $bank_id, false);
														        break;      

														}?>
								                <div class="article__offers-item">
						                            <div class="article__offers-img">
                                                        <img src="<?php echo $logo_img ?>"
                                                             alt="<?
                                                             $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                             echo $logo_alt; ?>">
                                                    </div>
						                            <a href="<?php echo the_permalink() ?>" class="stretched-link"><?php echo get_the_title($loop_id) ?></a>
						                        </div>
								            <?php endforeach; ?>
	                        		</div>
        							<?php endif; ?>
	                </div>
	            </div>
	            <!-- / sidebar right -->
	            <div class="article__container-center order-xl-2">
	                <!-- title -->
	                <div class="arcticle__title">
	                    <div class="arcticle__title-icon">
	                        <svg width="24" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 22" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#news" x="0" y="0"></use></svg>
	                    </div>
	                    <?php 
	                        if($parent_cat_id == 0): 
	                        	$page_name = $category->name;
	                        else: 
	                        	//$page_name = get_category_parents($parent_cat_id, '', '');
	                        	$page_name = $current_cat_name;
	                        endif; ?>
	                    <h1><?php  echo $page_name ?></h1>
	                </div>
	                <!-- / title -->
	                <!-- item -->
	                <div class="<?= $current_cat_id?>" id="response-cred-card">
	                <?php 
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$max_pages = $wp_query->max_num_pages;
						$counter = 0;
						$args = array(
						    'post_type' => 'post',
						    'cat' => $current_cat_id,
						    // 'meta_key' => 'views',
						    // 'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
						    'orderby' => 'date',
						    'order' => 'DESC',
						    'paged' => $paged ,
						);


                        $related_posts = get_field('cat_related_products_select_new', 'options');
                        $related_posts_ids = [];
                        foreach ($related_posts as $item){
                            if($item['category'] == $current_cat_id){
                                $related_posts_ids = $item['card'];
                            }
                        }


						$wp_query = new WP_Query( $args );
						if ( $wp_query->have_posts() ) {
						    while ( $wp_query->have_posts() ) {
						        $wp_query->the_post(); 
						        $counter += 1; ?>
						        <?php if($counter == 3): ?>

						            <?php

                                    if(empty($related_posts_ids)){
                                        $related_posts = get_field('cat_related_products', 'options');
                                    }else{
                                        $related_posts = $related_posts_ids;
                                    }

        								if( $related_posts): ?>

        								<div class="horizontal__scroll row mt-4 1">

				                    		<div class="horizontal__scroll-container">
                                                <?php
                                                foreach( $related_posts as $post ):
                                                        setup_postdata($post);
                                                        $loop_rel_id = get_the_id();
                                                        $post_type = get_post_type($loop_rel_id);
                                                        switch ($post_type) {
                                                                    case 'bankcard':
                                                                       $bank_id = get_field('bank_choise', $loop_rel_id);
                                                                       $logo_img = get_field('bank_logo', $bank_id);
                                                                        break;
                                                                    case 'zaimy':
                                                                       $logo_img = get_field('z_organization_logo', $loop_rel_id);
                                                                        break;
                                                                    case 'kredity':
                                                                       $bank_id = get_field('product_bank', $loop_rel_id);
                                                                       $logo_img =  get_field('bank_logo', $bank_id);
                                                                        break;
                                                                    default:
                                                                       $logo_img = bloginfo('template_url') . '/img/alfabank.png';
                                                                }?>
                                                <?php if($post_type == 'bankcard'): ?>
                                                    <div class="horizontal__scroll-item size3">
                                                        <div class="offer__item">
                                                            <div class="offer__item-header">
                                                                <div class="d-flex align-items-center pb-1">
                                                                    <div class="offer__item-img">
                                                                        <img src="<?php echo $logo_img ?>"
                                                                             alt="<?
                                                                             $logo_id = get_field('bank_logo',$bank_id , false);
                                                                             $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                                             echo $logo_alt; ?>">
                                                                    </div>
                                                                    <div class="offer__item-title"><?php echo the_title() ?></div>
                                                                </div>
                                                                <div class="d-flex align-items-center mt-2">
                                                                    <div class="card__like d-flex align-items-center mr-3" style="pointer-events: none;">
                                                                        <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().'" button_type="image" style="wpulike-heart"]'); ?>
                                                                    </div>
                                                                  <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                                      <div class="mr-2"><a href="<?php the_permalink(get_the_id()) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                                      <?php echo comments_number( '0', '1', '%'); ?>
                                                                  </div>
                                                                    <div class="card__rating d-flex align-items-center ml-auto">
                                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                                        <?php echo the_field('ratings_average') ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php $loop_terms = wp_get_post_terms( get_the_ID(), 'bankcards', array('fields' => 'all') );
                                                                     $loop_term_slug = $loop_terms[0]->slug;
                                                                     //$loop_term_id = $terms[0]->term_id;
                                                                     $loop_term_id = $loop_terms[0]->term_id;
                                                                     ?>
                                                                <?php if($loop_term_slug == 'creditcard'): ?>
                                                               <div class="offer__item-body">
                                                                <p class="txt1">Без % <?php echo the_field('card_period_reg') ?></p>
                                                                    <p class="txt2">до <span><?php echo the_field('card_stavka') ?>%</span>   годовых</p>
                                                                    <p class="txt3">Лимит - до <?php echo the_field('card_cred_limit') ?> ₽</p>
                                                                    <p class="txt3">Период - <?php echo the_field('card_day_period') ?> дней</p>
                                                                </div>
                                                                <?php endif; ?>
                                                                <?php if($loop_term_slug == 'installmentcard'): ?>
                                                               <div class="offer__item-body">
                                                                <p class="txt1">Без % <?php echo the_field('card_period_reg') ?></p>
                                                                    <p class="txt2">до <span><?php echo the_field('card_stavka') ?>%</span> годовых</p>
                                                                    <p class="txt3">Лимит - до <?php echo the_field('card_cred_limit') ?> ₽</p>
                                                                    <p class="txt3">Период - <?php echo the_field('card_day_period') ?> дней</p>
                                                                </div>
                                                                <?php endif; ?>
                                                               <?php if($loop_term_slug == 'debetcard'): ?>
                                                               <div class="offer__item-body">
                                                                <p class="txt1">Снятие без % до <?php echo the_field('non_pecent_money') ?> ₽</p>
                                                                    <p class="txt2">до <span><?php echo the_field('card_stavka_ostatok') ?>%</span> на остаток</p>
                                                                    <p class="txt3">Тип кешбэка - <?php $field = get_field('card_cashback_type');
                                                                                //$value = $field['value'];
                                                                                //$label = $field['choices'][ $value ];
                                                                                echo $field['label'] ?></p>
                                                                    <p class="txt3">Кешбэк - <?php $field = get_field('card_cashback');
                                                                                //$value = $field['value'];
                                                                                //$label = $field['choices'][ $value ];
                                                                                echo $field['label'] ?></p>
                                                                </div>
                                                                <?php endif; ?>
                                                            <div class="offer__item-footer mt-auto">
                                                                <!-- <a href="<?php echo the_field('card_bank_link') ?>" class="btn btn-outline-main btn-block stretched-link"><span>Оформить</span></a> -->
                                                                <a onclick="<?= get_metrika_for_offers_in_article(get_permalink(get_the_id())); ?>" href="<?php echo the_permalink(get_the_id()); ?>" class="btn btn-outline-main btn-block stretched-link"><span>Оформить</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($post_type == 'kredity'): ?>
                                                    <div class="horizontal__scroll-item size3">
                                                        <div class="offer__item">
                                                            <div class="offer__item-header">
                                                                <div class="d-flex align-items-center pb-1">
                                                                    <div class="offer__item-img">
                                                                        <img src="<?php echo $logo_img ?>" alt="<?
                                                                        $logo_id = get_field('bank_logo',$bank_id , false);
                                                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                                        echo $logo_alt; ?>">
                                                                    </div>
                                                                    <div class="offer__item-title"><?php echo the_title() ?></div>
                                                                </div>
                                                                <div class="d-flex align-items-center mt-2">
                                                                    <div class="card__like d-flex align-items-center mr-3" style="pointer-events: none;">
                                                                        <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().'" button_type="image" style="wpulike-heart"]'); ?>
                                                                    </div>
                                                                  <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                                      <div class="mr-2"><a href="<?php the_permalink(get_the_id()) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                                      <?php echo comments_number( '0', '1', '%'); ?>
                                                                  </div>
                                                                    <div class="card__rating d-flex align-items-center ml-auto">
                                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                                        <?php echo the_field('ratings_average') ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="offer__item-body">
                                                                <p class="txt1">Срок кредита до <?php $field = get_field('credit_period');
                                                                                //$value = $field['value'];
                                                                                //$label = $field['choices'][ $value ];
                                                                                echo $field['label'] ?></p>
                                                                <p class="txt2">до <span><?php echo the_field('credit_stavka') ?>%</span> годовых</p>
                                                                <p class="txt3">Лимит - до <?php echo the_field('credit_max_sum') ?> ₽</p>
                                                                <p class="txt3">Минимум - от <?php echo the_field('credit_min_sum') ?> ₽</p>
                                                            </div>
                                                            <div class="offer__item-footer mt-auto">
                                                                <!--a href="<?php echo the_field('card_bank_link') ?>" class="btn btn-outline-main btn-block stretched-link"><span>Оформить</span></a-->
                                                                <a onclick="<?= get_metrika_for_offers_in_article(get_permalink(get_the_id())); ?>" href="<?php echo the_permalink(get_the_id()); ?>" class="btn btn-outline-main btn-block stretched-link"><span>Оформить</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($post_type == 'zaimy'): ?>
                                                    <div class="horizontal__scroll-item size3">
                                                        <div class="offer__item">
                                                            <div class="offer__item-header">
                                                                <div class="d-flex align-items-center pb-1">
                                                                    <div class="offer__item-img">
                                                                        <img src="<?php echo $logo_img ?>"
                                                                        alt="<?
                                                                        $logo_id = get_field('bank_logo',$bank_id , false);
                                                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                                                        echo $logo_alt; ?>">
                                                                    </div>
                                                                    <div class="offer__item-title"><?php echo the_title() ?></div>
                                                                </div>
                                                                <div class="d-flex align-items-center mt-2">
                                                                    <div class="card__like d-flex align-items-center mr-3" style="pointer-events: none;">
                                                                        <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().'" button_type="image" style="wpulike-heart"]'); ?>
                                                                    </div>
                                                                  <div class="position-relative card__icon d-flex align-items-center mr-3">
                                                                      <div class="mr-2"><a href="<?php the_permalink(get_the_id()) ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                                                      <?php echo comments_number( '0', '1', '%'); ?>
                                                                  </div>
                                                                    <div class="card__rating d-flex align-items-center ml-auto">
                                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                                                        <?php echo the_field('ratings_average') ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="offer__item-body">
                                                                <p class="txt1">Срок займа до <?php echo the_field('z_time') ?> дней</p>
                                                                <p class="txt2">от <span><?php echo the_field('z_stavka') ?>%</span> в день</p>
                                                                <p class="txt3">Сумма - до <?php echo the_field('z_sum') ?> ₽</p>
                                                                <p class="txt3">Кредитная история - <?php echo the_field('z_history') ?></p>
                                                            </div>
                                                            <div class="offer__item-footer mt-auto">
                                                                <!--a href="<?php echo the_field('card_bank_link') ?>" class="btn btn-outline-main btn-block stretched-link"><span>Оформить</span></a-->
                                                                <a onclick="<?= get_metrika_for_offers_in_article(get_permalink(get_the_id())); ?>" href="<?php echo the_permalink(get_the_id()); ?>" class="btn btn-outline-main btn-block stretched-link"><span>Оформить</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
								            <?php endforeach; ?>
								            <?php wp_reset_postdata() ?>
								        </div>
	                        		</div>
        							<?php endif; ?>
						        <?php endif; ?>
						        <?php if(($counter+1) % 3 == 0): ?>
                                <?php
                                $banner1 = get_field('cat_banner', 'options');
                                $banner2 = get_field('cat_banner_2', 'options');
                                $banner3 = get_field('cat_banner_3', 'options');

                                $items = array('cat_banner' => $banner1['percent_in'], 'cat_banner_2' => $banner2['percent_in'], 'cat_banner_3' => $banner3['percent_in']);
                                ?>

						        <?php $banner = get_field(roulette($items), 'options'); ?>
						        <?php if($banner): 
						        	$title = $banner['title'];
						        	$subtitle = $banner['subtitle'];
						        	$img = $banner['img'];
						        	$offer_link = $banner['offer_link'];
						        	$product_link = $banner['product_link'];
						        	$description = $banner['description'];

                                    /*if($_GET['test']){
                                        print_r2($banner);
                                    }*/

						        	?>
						        	<!-- banner -->
						                <div class="article__bnr-mob article__bnr d-block d-md-flex">
						                    <div class="article__bnr-img ml-md-2 order-md-2 text-center"><img src="<?= $img; ?>" alt="<?php echo $title ?>"></div>
						                    <div class="article__bnr-content order-md-1">
						                        <h4 class="article__bnr-title"><?php echo $title ?></h4>
						                        <p class="article__bnr-description"><?php echo $subtitle ?></p>
												    <div class="article__counter mb-4 d-flex">
												    <?php foreach( $description as $row ): 
												        $val = $row['val'];
												        $val_desc = $row['val_desc'];
												        ?>
												        <div class="article__counter-item">
							                                <p class="article__counter-title"><?php echo $val ?></p>
							                                <p class="article__counter-content"><?php echo $val_desc ?></p>
							                            </div>
												    <?php endforeach; ?>
												    </div>
						                        <div class="d-flex">
						                            <a href="<?php echo $offer_link ?>" onclick="<?=  get_metrika_for_category_offer($offer_link);?> ym(35020350,'reachGoal','click_oformit_journal'); return true;" class="btn btn-primary btn-radius-sm mr-3">Оформить</a>
						                            <a href="<?php echo $product_link ?>" class="btn btn-gray btn-radius-sm">Подробнее</a>
						                        </div>
						                    </div>
						                </div>
						                <!-- / banner -->
                                <?php endif; ?>

                            <?php endif; ?>

                    <div class="article__one">
	                    <!-- item header -->
	                    <div class="article__one-header">
	                        <div class="article__one-date"><?php echo get_the_date('d.m.y') ?>  <?php echo get_the_time('H:i') ?></div>
	                        <div class="card__icon d-flex align-items-center">
	                            <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
	                            <?php echo the_field('views') ?>
	                        </div>
	                        <?php $post_cats = get_the_category();

	                        if($post_cats[0]->parent == 0):
	                            $loop_cat_name = $post_cats[1]->name;
	                            $loop_cat_id = $post_cats[1]->term_id;
	                            $loop_cat_image = get_field('cat_image', 'category_'.$loop_cat_id);
	                            $loop_cat_link = get_category_link($loop_cat_id);
	                            else: 
	                            //$loop_cat_name = $post_cats[0]->name;
	                            //$loop_cat_id = $post_cats[0]->term_id;
	                            $loop_cat_name = $page_name;	                            
								$loop_cat_id = $current_cat_id;
	                            $loop_cat_image = get_field('cat_image', 'category_'.$loop_cat_id);
	                            $loop_cat_link = get_category_link($loop_cat_id);
	                        endif; ?>
	                        <a href="<?php echo $loop_cat_link ?>" class="article__category">
	                            <span class="article__category-icon">
	                                <?php echo $loop_cat_image ?>
	                            </span>
	                            <?php echo $loop_cat_name ?>
	                        </a>
	                    </div>
	                    <!-- / item header -->
	                    <!-- item img -->

	                    <div class="article__one-img">
	                        <?php
                                $posttags = get_the_tags();
                                if ($posttags): ?>
                                    <div class="article__tags">
                                  <?php foreach($posttags as $tag): ?>
                                    <a href="#" class="article__tags-item"><?php echo $tag->name ?></a>
                                  <?php endforeach; ?>
                                    </div>
                                <?php endif;
                                ?>
	                        <img src="<?php echo the_post_thumbnail_url() ?>"
                                 alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);?>">
	                    </div>
	                    <!-- / item img -->
	                    <!-- item body -->
	                    <div class="article__one-body">
	                        <a href="<?php the_permalink(); ?>" class="article__one-link stretched-link"><?php echo the_title() ?></a>
	                        <div class="article__one-description">
	                            <?php echo the_excerpt_max_charlength(110) ?>
	                        </div>
	                    </div>
	                    <!-- / item body -->
	                    <!-- item footer -->
	                    <div class="article__one-footer">
	                        <div class="card__like d-flex align-items-center mr-3">
	                            <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().'" button_type="image" style="wpulike-heart"]'); ?>
	                        </div>
		                      <div class="position-relative card__icon d-flex align-items-center mr-3">
		                          <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
		                          <?php echo comments_number( '0', '1', '%'); ?>
		                      </div>
	                        <div class="card__icon d-flex align-items-center mr-3">
	                            <div class="mr-2"><svg width="17" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.2 12.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#share" x="0" y="0"></use></svg></div>
	                            <?php $shares = get_field('share_clicks');
	                            if($shares == ''):
	                            echo '0';
	                            else: 
	                            echo the_field('share_clicks'); 
	                        	endif; ?>
	                        </div>
	                        <?php $author_id = get_field('page_author') ?>
	                        <?php if($author_id): ?>
                                   <div class="article__one-footer-meta ml-md-auto">
                                        <div class="article__one-footer-img">
                                            <?php get_template_part( 'all_template/image_and_alt/card_author-img', null, $author_id); ?>
                                        </div>
                                        <div class="article__one-footer-name">
                                            Автор Финабанка<br>
                                            <a class="article__one-footer-link stretched-link" href="<?php echo the_permalink($author_id) ?>">
                                                <?php echo get_the_title($author_id) ?>
                                            </a>
                                        </div>
                                    </div>	                        	
	                        	<!--a class="article__one-footer-link ml-auto" href="<?php echo the_permalink($author_id) ?>">
	                        		<?php echo get_the_title($author_id) ?>
	                        	</a-->
	                        <?php endif; ?>
	                    </div>
	                    <!-- / item footer -->
	                </div>
						        <?php
						    } 
						} ?>
	                </div>
	                <!-- / item -->
	            </div>
	        </div>

	        <div class="pagination flex-column mb-5 mt-4 mb-md-0">
	            <!-- <button class="btn btn-outline-gray btn-block">Больше решений</button> -->
	            <div class="pagination__container d-sm-flex justify-content-between align-items-center">
	                <div class="pagination__links">
	                	<?php my_pagination(); ?>
	                </div>
	                <div class="pagination__description mt-4 mt-sm-0">
	                	<?php $total_count = get_category($current_cat_id)->category_count; ?>
	                	<?php $count = $paged*4 ?>
	                	<?php if($count > $total_count): 
	                		$count = $total_count - $count + $count; 
	                	endif; ?>
	                    Показано <?php echo $count ?> записи из <?php echo $total_count ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

    </main>

<?php //get_footer('blog') ?>
<?php get_footer() ?>