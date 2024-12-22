<?php session_start() ?>
<?php get_header() ?>

<?php 
	$term = get_queried_object(); 
	$ID = get_queried_object()->ID; 

	$tagslist = '';
	$tags = get_field('coll-tags');
	$ipost = 1;
	foreach ($tags as $tag):
		$tagslug = $tag->slug;
		if ($ipost == 1) {
			$tagslist .= $tagslug;
		} else {
			$tagslist .= ",".$tagslug;
		}
		$ipost++;
	endforeach;					
	$postsarray = [];
	if (!empty($tagslist)) {
	$posts_arg = [
		'posts_per_page'   => -1,
		'post_type' => array('kredity', 'zaimy', 'bankcard'),
		'tag' => $tagslist
	];
	
	$posts = get_posts( $posts_arg );
	foreach( $posts as $post ){
		setup_postdata( $post );
		$postsarray[] = $post->ID;			
	}
	wp_reset_postdata();
	}
	//wp_reset_query();
	if (get_field('coll-prod')) {
		$products = get_field('coll-prod');
	} else {
		$products = [];
	}
	
	$allposts = array_merge($postsarray, $products);
	

	$allpostsjson = json_encode($allposts); 
	
?>

<main term="kredity">
	<div class="container">
	    <nav aria-label="breadcrumb" class="horizontal__scroll">
	        <ol class="breadcrumb horizontal__scroll-container">
	            <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
	            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
	        </ol>
	    </nav>
	</div>
	<div class="page__heading">
	    <div class="container">
	        <div class="d-flex justify-content-between align-items-center">
	            <h1 class="page__heading-title mb-0">
	            	<?php if(get_field('col-h1')): ?>
	            		<?= get_field('col-h1'); ?>
	            	<?php else: ?>
	            		<?php the_title(); ?>
	            	<?php endif; ?>	
	            	</h1>
	        </div>
	        <div class="page__heading-description mt-2 mb-4">
	           <?= get_field('col-desc'); ?>
	        </div>
	        <form id="collection-card" action="" method="POST">
	        	<input type="hidden" name="action" value="collfilter" />
	        	<input type="hidden" name="term" value="collection" />
	        	<input type="hidden" name="postarr" value="<?php echo htmlspecialchars( $allpostsjson ); ?>" />
	        </form>		        
	    </div>
	</div>

	<div class="container">
	    <!-- credits list -->
	    <div class="credits section">
	        <div class="row">
	            <!-- filter -->
	            <div class="col-12 col-lg-4 order-lg-2">
	                <div class="sticky-top">
				<?php
	                $args_coll = array(
					    'post_type' => 'collection', 
					    'posts_per_page' => 15,
					    'orderby' => 'date',
					    'order' => 'DESC'
					);
					$query = new WP_Query( $args_coll );
					if ( $query->have_posts() ) { ?>
						<div class="filter mt-5 mb-3">
							<div class="filter__section">
						<?php while ( $query->have_posts() ) { $query->the_post(); ?>
							<a class="filter__btn" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>							
						<?php } ?>
							</div>
						</div>	
					<?php } wp_reset_query(); ?>	

	                </div>
	            </div>
	            <!-- / filter -->
	            <!-- list -->
	            <div class="col-12 col-lg-8 order-lg-1 pt-5">
	                <div class="credits__list">
                        <?php

                                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                                $args = array(
                                    'post_type' => array('kredity', 'zaimy', 'bankcard'),
                                    'posts_per_page' => 4,
                                    'post__in' => $allposts,
                                    'orderby' => 'name',
                                    'order' => 'DESC',
                                    'paged' => $paged,
                                );

                        $query = new WP_Query( $args );
                        //$GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;


                        if ( $query->have_posts() ) {
                                $max_pages = $query->max_num_pages;
                            } wp_reset_query(); wp_reset_postdata();



                        $counter = 0; ?>
                            <div class="d-flex flex-wrap justify-content-between align-items-center mt-0 mt-md-5 mt-lg-0 mb-3">
                              <div class="h2 mt-5 mb-4 mt-md-0 mb-md-0"><span class="variants_count"><?php echo $wp_query->found_posts;?></span> вариантов</div>
                              <div class="credits__list-dropdown dropdown mb-3 mb-md-0 col-12 col-md-5 col-lg-4 px-0">
                                  <select name="" class="styledSelect collection-order">
                                      <option value="" selected disabled>Сортировать</option>
                                      <option value="views">По популярности</option>
                                      <option value="ratings_average">По рейтингу</option>
                                  </select>
                              </div>
                          </div>
                          <div class="list_posts" id="response-cred-card">

                            <?php
                        /*
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                        get_template_part( 'template-parts/collection-posts' );
                                    $counter++;
                                     }
                            } wp_reset_query()
                        */
                            ?>

                         </div>
		                    <!-- pagination -->
		                    <div class="pagination flex-column mb-5 mb-md-0">
		                    	<?php if($paged < $max_pages): ?>
		                        <button class="btn btn-outline-gray btn-block load_more_btn1"
		                         data-max_pages="<?php echo $max_pages ?>" data-paged="<?php echo $paged ?>">
		                      		Больше решений
		                   		</button>
		                     <?php endif; ?>
		                        <div class="pagination__container d-sm-flex justify-content-between align-items-center">
		                        	<div class="pagination__links">
		                        		<?php my_pagination(); ?>
		                        	</div>

		                            <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
		                            // wp_reset_query(); ?>
		                            <div class="pagination__description mt-4 mt-sm-0">
		                                Показано <span class="count_view"><?php echo $counter ?></span> 
		                                продуктов из <span class="count_all"><?php echo $wp_query->found_posts;?></span>
		                            </div>
		                        </div>
		                    </div>
	                    <!-- / pagination -->
	                </div>
	            </div>
	            <!-- / list -->
	            <!-- / pagination -->
	        </div>
	    </div>
	    <?php wp_reset_query(); ?>
	    <!-- / credits list -->

		    <!-- main articles -->
		    <div class="section">
		        <div class="section__header mb-3 d-flex justify-content-between align-items-end align-items-md-center">
		            <h2 class="title mb-0">Авторские статьи</h2>
		            <a href="<?php echo get_category_link(9) ?>" class="btn btn-primary btn-sm btn-all article-link-main">
		                Все
		                <span class="icon ml-1 ml-md-2">
		                    <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
		                </span>
		            </a>
		        </div>
		        <div class="tabs article-tabs">
		            <div class="horizontal__scroll">
		                <ul class="nav nav-tabs horizontal__scroll-container row mb-4" role="tablist">
		                    <li class="nav-item">
		                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#mainArticles1" aria-selected="true" data-link="<?php echo get_category_link(54) ?>">Займы</button>
		                    </li>
		                    <li class="nav-item">
		                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainArticles2" aria-selected="false" data-link="<?php echo get_category_link(55) ?>">Дебетовые карты</button>
		                    </li>
		                    <li class="nav-item">
		                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainArticles3" aria-selected="false" data-link="<?php echo get_category_link(56) ?>">Кредитные карты</button>
		                    </li>
		                    <li class="nav-item">
		                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainArticles4" aria-selected="false" data-link="<?php echo get_category_link(57) ?>">Карты рассрочки</button>
		                    </li>
		                    <li class="nav-item">
		                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainArticles5" aria-selected="false" data-link="<?php echo get_category_link(58) ?>">Кредиты</button>
		                    </li>
		                </ul>
		            </div>
		        </div>

		        <div class="tab-content">
		            <div class="tab-pane active" id="mainArticles1">
		                <div class="horizontal__scroll row">
		                    <div class="horizontal__scroll-container">
<?php 
$args = array(
    'post_type' => 'post',
    'cat' => 54,
    'posts_per_page' => 4,
    'meta_key' => 'views',
    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
    'order' => 'DESC',
);
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post(); ?>
		<!-- item -->
      <div class="article__item card card__vertical size4 offer h-100">
          <div class="card-container p-3 d-xl-flex flex-xl-column">
          	<?php if(get_the_post_thumbnail_url()): ?>
              <div class="card__image">
                  <img src="<?php echo the_post_thumbnail_url() ?>"
                   alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);?>">
              </div>
             <?php endif; ?>
              <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
              <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
              <div class="mt-auto">
                  <div class="d-flex align-items-center mt-2">
                      <div class="card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                          <?php echo the_field('views') ?>
                      </div>
                      <div class="card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                          <?php echo comments_number( '0', '1', '%'); ?>
                      </div>
                      <div class="card__like d-flex align-items-center ml-auto">
                          <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                      </div>
                  </div>
                  <?php if (get_field('page_author')): ?>
                  <?php $author_id = get_field('page_author') ?>
                  <div class="card__author d-flex align-items-center mt-3">
                      <div class="card__author-img">
                          <?php get_template_part( 'all_template/image_and_alt/card_author-img', null, $author_id); ?>
                      </div>
                      <div class="card__author-content">
                          <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                          <div class="rating d-flex align-items-center">
                           <?php echo do_shortcode( '[ratings id="'.$author_id.'"]' ); ?>
                          </div>
                      </div>
                  </div>
              <?php endif; ?>
              </div>
          </div>
      </div>
      <!-- / item -->
     <?php }
} ?>
<?php wp_reset_query() ?>
		                    </div>
		                </div>
		            </div>
		            <div class="tab-pane" id="mainArticles2">
		                <div class="horizontal__scroll row">
		                    <div class="horizontal__scroll-container">
		                        <?php 
$args = array(
    'post_type' => 'post',
    'cat' => 55,
    'posts_per_page' => 4,
    'meta_key' => 'views',
    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
    'order' => 'DESC',
);
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post(); ?>
		<!-- item -->
      <div class="article__item card card__vertical size4 offer h-100">
          <div class="card-container p-3 d-xl-flex flex-xl-column">
              <?php if(get_the_post_thumbnail_url()): ?>
              <div class="card__image">
                  <img src="<?php echo the_post_thumbnail_url() ?>" alt="">
              </div>
             <?php endif; ?>
              <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
              <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
              <div class="mt-auto">
                  <div class="d-flex align-items-center mt-2">
                      <div class="card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                          <?php echo the_field('views') ?>
                      </div>
                      <div class="card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                          <?php echo comments_number( '0', '1', '%'); ?>
                      </div>
                      <div class="card__like d-flex align-items-center ml-auto">
                          <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                      </div>
                  </div>
                  <?php if (get_field('page_author')): ?>
                  <?php $author_id = get_field('page_author') ?>
                  <div class="card__author d-flex align-items-center mt-3">
                      <div class="card__author-img">
                          <?php get_template_part( 'all_template/image_and_alt/card_author-img', null, $author_id); ?>
                      </div>
                      <div class="card__author-content">
                          <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                          <div class="rating d-flex align-items-center">
                           <?php echo do_shortcode( '[ratings id="'.$author_id.'"]' ); ?>
                          </div>
                      </div>
                  </div>
              <?php endif; ?>
              </div>
          </div>
      </div>
      <!-- / item -->
     <?php }
} ?>
<?php wp_reset_query() ?>
		                    </div>
		                </div>
		            </div>
		            <div class="tab-pane" id="mainArticles3">
		                <div class="horizontal__scroll row">
		                    <div class="horizontal__scroll-container">
		                        <?php 
$args = array(
    'post_type' => 'post',
    'cat' => 56,
    'posts_per_page' => 4,
    'meta_key' => 'views',
    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
    'order' => 'DESC',
);
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post(); ?>
		<!-- item -->
      <div class="article__item card card__vertical size4 offer h-100">
          <div class="card-container p-3 d-xl-flex flex-xl-column">
              <?php if(get_the_post_thumbnail_url()): ?>
              <div class="card__image">
                  <img src="<?php echo the_post_thumbnail_url() ?>" alt="">
              </div>
             <?php endif; ?>
              <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
              <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
              <div class="mt-auto">
                  <div class="d-flex align-items-center mt-2">
                      <div class="card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                          <?php echo the_field('views') ?>
                      </div>
                      <div class="card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                          <?php echo comments_number( '0', '1', '%'); ?>
                      </div>
                      <div class="card__like d-flex align-items-center ml-auto">
                          <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                      </div>
                  </div>
                  <?php if (get_field('page_author')): ?>
                  <?php $author_id = get_field('page_author') ?>
                  <div class="card__author d-flex align-items-center mt-3">
                      <div class="card__author-img">
                          <?php get_template_part( 'all_template/image_and_alt/card_author-img', null, $author_id); ?>
                      </div>
                      <div class="card__author-content">
                          <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                          <div class="rating d-flex align-items-center">
                           <?php echo do_shortcode( '[ratings id="'.$author_id.'"]' ); ?>
                          </div>
                      </div>
                  </div>
              <?php endif; ?>
              </div>
          </div>
      </div>
      <!-- / item -->
     <?php }
} ?>
<?php wp_reset_query() ?>
		                    </div>
		                </div>
		            </div>
		            <div class="tab-pane" id="mainArticles4">
		                <div class="horizontal__scroll row">
		                    <div class="horizontal__scroll-container">
<?php 
$args = array(
    'post_type' => 'post',
    'cat' => 57,
    'posts_per_page' => 4,
    'meta_key' => 'views',
    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
    'order' => 'DESC',
);
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post(); ?>
		<!-- item -->
      <div class="article__item card card__vertical size4 offer h-100">
          <div class="card-container p-3 d-xl-flex flex-xl-column">
              <?php if(get_the_post_thumbnail_url()): ?>
              <div class="card__image">
                  <img src="<?php echo the_post_thumbnail_url() ?>" alt="">
              </div>
             <?php endif; ?>
              <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
              <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
              <div class="mt-auto">
                  <div class="d-flex align-items-center mt-2">
                      <div class="card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                          <?php echo the_field('views') ?>
                      </div>
                      <div class="card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                          <?php echo comments_number( '0', '1', '%'); ?>
                      </div>
                      <div class="card__like d-flex align-items-center ml-auto">
                          <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                      </div>
                  </div>
                  <?php if (get_field('page_author')): ?>
                  <?php $author_id = get_field('page_author') ?>
                  <div class="card__author d-flex align-items-center mt-3">
                      <div class="card__author-img">
                          <?php get_template_part( 'all_template/image_and_alt/card_author-img', null, $author_id); ?>
                      </div>
                      <div class="card__author-content">
                          <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                          <div class="rating d-flex align-items-center">
                           <?php echo do_shortcode( '[ratings id="'.$author_id.'"]' ); ?>
                          </div>
                      </div>
                  </div>
              <?php endif; ?>
              </div>
          </div>
      </div>
      <!-- / item -->
     <?php }
} ?>
<?php wp_reset_query() ?>
		                    </div>
		                </div>
		            </div>
		            <div class="tab-pane" id="mainArticles5">
		                <div class="horizontal__scroll row">
		                    <div class="horizontal__scroll-container">
		                        <?php 
$args = array(
    'post_type' => 'post',
    'cat' => 58,
    'posts_per_page' => 4,
    'meta_key' => 'views',
    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
    'order' => 'DESC',
);
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post(); ?>
		<!-- item -->
      <div class="article__item card card__vertical size4 offer h-100">
          <div class="card-container p-3 d-xl-flex flex-xl-column">
              <?php if(get_the_post_thumbnail_url()): ?>
              <div class="card__image">
                  <img src="<?php echo the_post_thumbnail_url() ?>" alt="">
              </div>
             <?php endif; ?>
              <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
              <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
              <div class="mt-auto">
                  <div class="d-flex align-items-center mt-2">
                      <div class="card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                          <?php echo the_field('views') ?>
                      </div>
                      <div class="card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                          <?php echo comments_number( '0', '1', '%'); ?>
                      </div>
                      <div class="card__like d-flex align-items-center ml-auto">
                          <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                      </div>
                  </div>
                  <?php if (get_field('page_author')): ?>
                  <?php $author_id = get_field('page_author') ?>
                  <div class="card__author d-flex align-items-center mt-3">
                      <div class="card__author-img">
                          <?php get_template_part( 'all_template/image_and_alt/card_author-img', null, $author_id); ?>
                      </div>
                      <div class="card__author-content">
                          <a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
                          <div class="rating d-flex align-items-center">
                           <?php echo do_shortcode( '[ratings id="'.$author_id.'"]' ); ?>
                          </div>
                      </div>
                  </div>
              <?php endif; ?>
              </div>
          </div>
      </div>
      <!-- / item -->
     <?php }
} ?>
<?php wp_reset_query() ?>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <!-- / main articles -->

	    <!-- wysiwyg text -->
	    <div class="section">
	        <div class="wysiwyg">
	           <?php the_content(); ?>
	        </div>
            <?php $date_actually = get_the_modified_date('d.m.Y', $ID); ?>
            <? if($date_actually): ?>
                <div class="date_actually-article mb-2">Обновлено: <?= $date_actually;?></div>
            <? endif; ?>


            <?php
            //wp_reset_postdata();

            $author_id = get_field('page_author_new', $ID); ?>


            <?php if($author_id): ?>
                <div class="article__one-footer-meta ml-md-auto">
                    <div class="article__one-footer-img">
                        <?php get_template_part( 'all_template/image_and_alt/card_author-img', null, $author_id); ?>
                    </div>
                    <div class="article__one-footer-name">
                        Автор <br>
                        <a class="article__one-footer-link stretched-link" href="<?php echo the_permalink($author_id) ?>">
                            <?php echo get_the_title($author_id) ?>
                        </a>
                    </div>
                </div>

            <?php endif; ?>
	    </div>
	    <!-- / wysiwyg text -->
	</div>
</main>

<?php get_footer() ?>