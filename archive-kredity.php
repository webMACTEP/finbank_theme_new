<?php

if($_REQUEST['change_template']){
    get_template_part( 'template-parts/new-collection-kredity' );
}else {
    ?>

<?php get_header() ?>

<?php 
//$term = get_queried_object(); 
//$ID = get_queried_object()->ID; 
$summ_limit = 1000000;
$cred_summ_period = 24;
$summ_limit = 0;
$cred_summ_period = 0;
if(isset($_SESSION['filter_kredity']) && !empty($_SESSION['filter_kredity'])):
$mt = 1;
$summ_limit = $_SESSION['filter_kredity'][0];
$cred_summ_period = $_SESSION['filter_kredity'][1];
endif;
unset($_SESSION['filter_kredity']);
?>

    <?php if($mt): ?>
        <div class="start-func-credit-card-filter"></div>
    <?php endif; ?>



    <main term="kredity">
	<div class="container">
	    <nav aria-label="breadcrumb" class="horizontal__scroll">
	        <ol class="breadcrumb horizontal__scroll-container">
	            <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
	            <li class="breadcrumb-item active" aria-current="page">Кредиты</li>
	        </ol>
	    </nav>
	</div>
	<div class="page__heading">
	    <div class="container">
	        <div class="d-flex justify-content-between align-items-center">
	            <h1 class="page__heading-title mb-0">Кредиты</h1>
	            <?php $args = array(
					    'post_type'             => 'kredity', 
					    'posts_per_page'        => -1,
					    'orderby' => 'date',
					    'order' => 'ASC',
					);

$query = new WP_Query( $args );

// Цикл
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $date = get_the_date('d.m.y');
        ?>
     <?php } } wp_reset_query() ?>
	            <div class="page__heading-date">Обновлено: <?php echo $date ?></div>
	        </div>
	        <div class="page__heading-description mt-2 mb-4">
	            В данном разделе вы можете оформить кредит по вашим финансовым возможностям
	        </div>
	        <form id="credit-card-filter" action="" method="POST">
	        	<input type="hidden" name="action" value="cardfilter" />
	        	<input type="hidden" name="term" value="kredity" />
	            <div class="row">
	                <div class="col-12 col-md-6 col-lg-3 col-xl-4 order-1">
	                    <div class="range">
	                        <div class="d-flex justify-content-between">
	                            <div class="range__label">Сумма, ₽</div>
	                            <input max="<?= $filter_price['kredity_inputs_range']['max']; ?>" type="text" class="range__value cred_limit" value="<?php echo $summ_limit ?>" min="0">
	                        </div>
	                        <input max="<?= $filter_price['kredity_inputs_range']['max']; ?>" class="range__input" name="summ_limit" type="range" min="0"  value="<?php echo $summ_limit ?>">
	                    </div>
	                </div>
	                <div class="col-12 col-md-6 col-lg-3 col-xl-4 order-2">
	                    <div class="range">
	                        <div class="d-flex justify-content-between">
	                            <div class="range__label">Срок, месяцев</div>
	                            <input max="<?= $filter_price['kredity_inputs_range']['day_max']; ?>" type="text" class="range__value cred_trat" value="<?php echo $cred_summ_period ?>" min="0">
	                        </div>
	                        <input max="<?= $filter_price['kredity_inputs_range']['day_max']; ?>" class="range__input" name="cred_summ_period" type="range" min="0"  value="<?php echo $cred_summ_period ?>">
	                    </div>
	                </div>
	                <div class="col-12 col-md-6 col-lg-3 col-xl-2 mt-lg-0 order-5 order-md-3">
	                	<div class="btn btn-primary btn-block submit-button">Показать</div>
	                </div>
	                <div class="col-12 col-md-6 col-lg-3 col-xl-2 mt-3 mt-lg-0 order-3 order-md-4">
	                    <div class="filter__details">
	                        <a class="btn btn-outline-alternative btn-block" href="#filter__details" data-bs-toggle="collapse" aria-expanded="false">
	                            Еще условия
	                            <svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg"><path d="M6 6h-.4C4.4 5.8 3.5 5 2 3.5L.3 1.7C-.1 1.3-.1.7.3.3c.4-.4 1-.4 1.4 0l1.7 1.8C4.6 3.2 5.3 3.9 5.8 4h.4c.5-.1 1.2-.8 2.4-1.9L10.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L10 3.5C8.5 5 7.6 5.8 6.4 6H6Z"></path></svg>
	                        </a>
	                    </div>
	                </div>
	                <div id="filter__details" class="col-12 collapse mt-md-4 order-4 order-md-5">
	                    <div class="row pb-3 pb-md-0">
	                        <div class="col-12 col-md-4 banks_select">
	                            <label class="form-label" for="bankSelect">Банки</label>
	                            <select name="kreditbank" id="bankSelect" class="styledSelect" placeholder="">
	                            	<option value="">Любой</option>
	                        <?php 
$args = array(
	'posts_per_page' => -1,
	'post_type' => 'banks',
//	'post_status' => 'publish',
	'orderby' => 'name',
	'order' => 'DESC',
);

$wp_query = new WP_Query( $args );

// Цикл
if ( $wp_query->have_posts() ) {
	$counter = 0;
	while ( $wp_query->have_posts() ) {
		$wp_query->the_post();
		$counter +=1;
		?>
		<option value="<?php echo get_the_id() ?>"><?php echo the_title() ?></option>
		<?php
	}
} ?>
<?php wp_reset_query() ?>
	                            </select>
	                        </div>
	                        <div class="col-12 col-md-4 card_cat_select">
	                            <label class="form-label" for="bankTop">Цель</label>
	                            <select name="kred_purpose" id="bankTop" class="styledSelect" placeholder="">
	                                <option value="">Любая</option>
	                		                                <?php
											$field = get_field_object('credit_porpose', 201);
											//$value = $field['value'];
											//$label = $field['choices'][ $value ];
											if( $field['choices'] ): ?>
											        <?php foreach( $field['choices'] as $value => $label ): ?>
											            <option value="<?php echo $value ?>"><?php echo $label ?></option>
											        <?php endforeach; ?>
											<?php endif; ?>

	                            </select>
	                        </div>
	                        <div class="col-12 col-md-4 grace_period_select">
	                            <label class="form-label" for="gracePeriod">Категория заемщика</label>
	                            <select name="cat_zaim" id="gracePeriod" class="styledSelect" placeholder="">
	                                <option value="">Не важно</option>
	                                <?php
											$field = get_field_object('credit_zaemshik', 201);
											//$value = $field['value'];
											//$label = $field['choices'][ $value ];
											if( $field['choices'] ): ?>
											        <?php foreach( $field['choices'] as $value => $label ): ?>
											            <option value="<?php echo $value ?>"><?php echo $label ?></option>
											        <?php endforeach; ?>
											<?php endif; ?>
	                            </select>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>

	<!-- page navigation -->
	<div class="page__nav">
	    <div class="container">
	        <div class="page__nav-container nav-tabs">
	            <div class="horizontal__scroll">
	                <div class="horizontal__scroll-container">
	                    <a href="<?php echo get_post_type_archive_link('kredity') ?>" class="nav-link active">Все кредиты</a>
	                    <a href="<?php echo get_page_link(4973); //1503 tax-reviews?>" class="nav-link " data-tax="kredity">Отзывы</a>
	                    <a href="<?php echo get_page_link(149) ?>" class="nav-link">Калькулятор</a>
	                    <a href="<?php echo get_category_link(37) //18 ?>" class="nav-link">Статьи</a>
	                    <a href="<?php echo get_page_link(1552) ?>" class="nav-link">сравнить</a>
	                    <a href="#best-products" class="nav-link">Лучшие предложения</a>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- / page navigation -->
	<div class="container">
	    <!-- credits list -->
	    <div class="credits section">
	        <div class="row">
	            <!-- filter -->
	            <div class="col-12 col-lg-4 order-lg-2">
	                <div class="sticky-top">
	                    <form id="credit-card-filter-aside">
	                        <div class="filter mb-3">
	                            <div class="filter__section">
	                                <a class="filter__btn collapsed" data-bs-toggle="collapse" href="#filter1" role="button" aria-expanded="false">
	                                    Способ получения
	                                    <div class="filter__btn-icon"><svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg"><path d="M6 6h-.4C4.4 5.8 3.5 5 2 3.5L.3 1.7C-.1 1.3-.1.7.3.3c.4-.4 1-.4 1.4 0l1.7 1.8C4.6 3.2 5.3 3.9 5.8 4h.4c.5-.1 1.2-.8 2.4-1.9L10.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L10 3.5C8.5 5 7.6 5.8 6.4 6H6Z"></path></svg></div>
	                                </a>
	                                <div class="collapse" id="filter1">
	                                    <div class="filter__content">
	                                        <ul class="filter__list">
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="cgt1">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    На карту
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="cgt2">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    Наличными
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="cgt3">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    На дом
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="cgt4">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    В банке
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="cgt5">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    На банковский счет
	                                                </label>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="filter__section">
	                                <a class="filter__btn collapsed" data-bs-toggle="collapse" href="#filter2" role="button" aria-expanded="false">
	                                    Прочие условия
	                                    <div class="filter__btn-icon"><svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg"><path d="M6 6h-.4C4.4 5.8 3.5 5 2 3.5L.3 1.7C-.1 1.3-.1.7.3.3c.4-.4 1-.4 1.4 0l1.7 1.8C4.6 3.2 5.3 3.9 5.8 4h.4c.5-.1 1.2-.8 2.4-1.9L10.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L10 3.5C8.5 5 7.6 5.8 6.4 6H6Z"></path></svg></div>
	                                </a>
	                                <div class="collapse" id="filter2">
	                                    <div class="filter__content">
	                                        <ul class="filter__list">
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="kos1">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    Без справок о доходе
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="kos2">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    Бесплатное снятие наличных
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="kos3">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    С кэшбеком
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="kos4">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    0 ₽ обслуживание
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="kos5">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    С 18 лет
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="kos6">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    Рассрочка 0 %
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="kos7">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    Срочное решение
	                                                </label>
	                                            </li>
	                                            <li class="filter__list-item">
	                                                <label class="checkbox">
	                                                    <input type="checkbox" name="kos8">
	                                                    <span class="checkbox__icon"><svg width="11" height="10" viewBox="0 0 11 10" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.576.483c-.566-.644-1.48-.644-2.045 0l-4.864 5.54-1.2-1.363c-.563-.644-1.479-.644-2.044 0-.564.642-.564 1.685 0 2.329l2.221 2.528c.564.644 1.48.644 2.045 0l5.887-6.705c.565-.642.565-1.685 0-2.329"></path></svg></span>
	                                                    % на остаток
	                                                </label>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="btn btn-outline-primary btn-block submit-button">Применить фильтр</div>
	                    </form>
						
						<!--div class="filter mt-5 mb-3">
							<?php
							$massiv_vhodnih_parametrov = array(
							'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
							'depth' => 0,  // - глубина, уровень вложенности
							'echo'            => false,
							'link_class'   => 'filter__btn',
							'theme_location'  => 'sidebar_menu_kredity',
							'before' => '<div class="filter__section" id="collist">',
							'after' => '</div>',
							); ?>
							<?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<a>,' ); ?>	
		                </div-->

					<div class="d-none d-lg-block">
						<?php
						$args = array(
							'hide_empty' => true,
							'taxonomy'     => 'tags-category',
						);

						$cats = get_categories( $args ); 
						if( $cats ){
							foreach( $cats as $cat ){
							$parent_category = array(81, 87, 99, 72);
							if (in_array($cat->term_id, $parent_category)) continue;

	                $args_coll = array(
					    'post_type' => 'collection',
					    'taxonomy' => 'tags-category',
						'tax_query' => [
							[
								'taxonomy' => 'tags-category',
								'terms' => $cat->term_id,
								'field' => 'id',
								'operator' => 'IN',
							]
						],					    	
					    'posts_per_page' => -1,
					    'orderby' => 'date',
					    'order' => 'DESC',
						'meta_query'    => array(
						        array(
						            'key'       => 'coll-type',
						            'value'     => 'kredity',
						            'compare'   => '=',
						        ),
						    )					    
					);
					$query = new WP_Query( $args_coll );
					if ( $query->have_posts() ) { $current_id = $wp_query->get_queried_object_id(); ?>
						<div class="filter mt-3 mb-2">
							<h3 class="pl-3 pt-3"><?= $cat->name; ?></h3>
							<div class="filter__section" id="collist_<?= $cat->term_id; ?>">
						<?php $counter_col = 0; ?>
						<?php while ( $query->have_posts() ) { $query->the_post(); $counter_col+=1; ?>
							<a class="filter__btn <?php if($counter_col > 4): echo 'coll_li coll__hidden'; endif; ?><?php if ($current_id == get_the_ID()) echo ' active_post'; ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>							
						<?php } ?>
							</div>
						</div>	
		             <?php if($counter_col > 4): ?>
		                <button class="btn__collmore_cat" data-text-open="Показать еще" data-text-hide="Скрыть" data-id="collist_<?= $cat->term_id; ?>">
		                    <span class="btn__collmore-icon"></span>
		                    <span class="btn__collmore-text">Показать еще</span>
		                </button>
		            <?php endif; ?>
					<?php } wp_reset_query(); ?>	

					<?php		}	
						}	
						?>
					</div>


	                </div>
	            </div>
	            <!-- / filter -->

                <?
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

                $args = array(
                    'orderby' => 'name',
                    'order' => 'DESC',
                    'post_type' => 'kredity',
                    'post_status' => 'publish',
                    'paged' => $paged,
                );
                $args['meta_query'][] = array(
                    'key' => 'archive',
                    'value' => '0'
                );

                $counter = 0;
                $query = new WP_Query( $args );

                if ( $query->have_posts() ) {

                    $max_pages = $query->max_num_pages;
                    $found_posts = $query->found_posts;

                    if ($query->have_posts()) {
                        ob_start();
                        while ($query->have_posts()):
                            $query->the_post();
                            $counter++;
                            get_template_part('template-parts/filter-kredity-posts');
                        endwhile;

                        $posts_html = ob_get_contents();
                        ob_end_clean();
                    }

                }else{
                    $posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
                }

                ?>

	            <!-- list -->
	            <div class="col-12 col-lg-8 order-lg-1">
	                <div class="credits__list">
<?php 
//$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
//$counter = 0; ?>
    <div class="d-flex flex-wrap justify-content-between align-items-center mt-0 mt-md-5 mt-lg-0 mb-3">
      <div class="h2 mt-5 mb-4 mt-md-0 mb-md-0"><span class="variants_count"><?php echo  $query->found_posts; ?></span> вариантов</div>
      <div class="credits__list-dropdown dropdown mb-3 mb-md-0 col-12 col-md-5 col-lg-4 px-0">
          <select name="" class="styledSelect cred-order-select">
          	  <option value="" selected disabled>Сортировать</option>
              <option value="ratings_average">По рейтингу</option>
              <option value="views">По количеству заявок</option>
              <option value="credit_max_sum">По сумме займа</option>
              <option value="credit_stavka">По процентной ставке</option>
          </select>
      </div>
  </div>
                        <div data-json='<?= json_encode($args); ?>'  class="list_posts" id="response-cred-card">
                            <?
                            echo $posts_html;
                            ?>
                        </div>

		                    <!-- pagination -->
		                    <div class="pagination flex-column mb-5 mb-md-0">
		                    	<?php if($paged < $max_pages): ?>
		                        <button class="btn btn-outline-gray btn-block load_more_btn"
		                         data-max_pages="<?php echo $max_pages ?>" data-paged="<?php echo $paged ?>">
		                      		Больше решений
		                   		</button>
		                     <?php endif; ?>
		                        <div class="pagination__container d-sm-flex justify-content-between align-items-center">
		                        	<div class="pagination__links">
		                        		<?php my_pagination($max_pages); ?>
		                        	</div>


		                            <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
		                            // wp_reset_query(); ?>
		                            <div class="pagination__description mt-4 mt-sm-0">
		                                Показано <span class="count_view"><?php echo $counter ?></span> 
		                                продуктов из <span class="count_all"><?php echo $query->found_posts;?></span>
		                            </div>
		                        </div>
		                    </div>
	                    <!-- / pagination -->

					<?php 
					$args_archive = array(
					    'post_type' => 'kredity',
					    'posts_per_page' => -1,
					    'meta_key'      => 'archive',
						'meta_value'    => true				    
					);
					$query_archive = new WP_Query( $args_archive );
					if ( $query_archive->have_posts() ): ?>
						<h2 class="title archive_title mt-5">Архивные кредиты (<?= $query_archive->found_posts; ?>)</h2>
						<div class="list_posts archive_list archive_hide">
						<?php while ( $query_archive->have_posts() ): $query_archive->the_post();?>
							<?php get_template_part( 'template-parts/filter-kredity-posts' ); ?>
						<?php endwhile; wp_reset_postdata(); ?>
						</div>
					<?php endif; ?>

					<div class="d-xs-block d-lg-none">
						<?php
						$args = array(
							'hide_empty' => true,
							'taxonomy'     => 'tags-category',
						);

						$cats = get_categories( $args ); 
						if( $cats ){
							foreach( $cats as $cat ){
							$parent_category = array(81, 87, 99, 72);
							if (in_array($cat->term_id, $parent_category)) continue;

	                $args_coll = array(
					    'post_type' => 'collection',
					    'taxonomy' => 'tags-category',
						'tax_query' => [
							[
								'taxonomy' => 'tags-category',
								'terms' => $cat->term_id,
								'field' => 'id',
								'operator' => 'IN',
							]
						],					    	
					    'posts_per_page' => -1,
					    'orderby' => 'date',
					    'order' => 'DESC',
						'meta_query'    => array(
						        array(
						            'key'       => 'coll-type',
						            'value'     => 'kredity',
						            'compare'   => '=',
						        ),
						    )					    
					);
					$query = new WP_Query( $args_coll );
					if ( $query->have_posts() ) { $current_id = $wp_query->get_queried_object_id(); ?>
						<div class="filter mt-3 mb-2">
							<h3 class="pl-3 pt-3"><?= $cat->name; ?></h3>
							<div class="filter__section" id="collist_mob_<?= $cat->term_id; ?>">
						<?php $counter_col = 0; ?>
						<?php while ( $query->have_posts() ) { $query->the_post(); $counter_col+=1; ?>
							<a class="filter__btn <?php if($counter_col > 4): echo 'coll_li  coll__hidden'; endif; ?><?php if ($current_id == get_the_ID()) echo ' active_post'; ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>							
						<?php } ?>
							</div>
						</div>	
		             <?php if($counter_col > 4): ?>
		                <button class="btn__collmore_cat" data-text-open="Показать еще" data-text-hide="Скрыть" data-id="collist_mob_<?= $cat->term_id; ?>">
		                    <span class="btn__collmore-icon"></span>
		                    <span class="btn__collmore-text">Показать еще</span>
		                </button>
		            <?php endif; ?>
					<?php } wp_reset_query(); ?>	

					<?php		}	
						}	
						?>
					</div>





	                </div>
	            </div>
	            <!-- / list -->
	            <!-- / pagination -->
	        </div>
	    </div>
	    <?php wp_reset_query(); ?>
	    <!-- / credits list -->
	    <!-- articles -->
	    <div class="section">
	        <div class="section__header mb-4 d-flex justify-content-between align-items-center">
	            <h2 class="title mb-0">Статьи о кредитах</h2>
	            <a href="<?php echo get_category_link('37') ?>" class="btn btn-primary btn-sm btn-all">
	                Все
	                <span class="icon ml-2">
	                    <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
	                </span>
	            </a>
	        </div>
	        <div class="horizontal__scroll row mb-5 mb-md-6">        
	            <div class="horizontal__scroll-container">
	                <?php 
                        $args = array(
                            'post_type' => 'post',
                            'cat' => 37,
                            'posts_per_page' => 4,
                        //    'meta_key' => 'views',
                        //    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
                        //    'order' => 'DESC',
                        );

                        get_template_part( 'all_template/article_list', null, $args);
                    ?>
	            </div>
	        </div>
	    </div>
	    <!-- / articles -->


	    <!-- similar offers -->

	    <!-- / similar offers -->
	    <!-- card reviews -->
	    <div class="section">
	        <div class="section__header d-flex justify-content-between align-items-center mb-4">
	            <h2 class="title mb-0">Отзывы о кредитах</h2>
	            <a href="<?php echo  get_page_link(4973); //1503 tax-reviews ?>" class="btn btn-primary btn-sm btn-all " data-tax="kredity">
	                Все
	                <span class="icon ml-2">
	                    <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
	                </span>
	            </a>
	        </div>
	        <div class="horizontal__scroll row">
	            <div class="horizontal__scroll-container">
                    <?php
                        $ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                        $custom_offset = 0;

                        // fetch posts in all those categories
                        $posts = get_cpt_ids('kredity');

                        $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
                         FROM {$wpdb->comments} WHERE
                         comment_post_ID in (".implode(',', $posts).") AND comment_approved = 1 AND comment_parent = 0
                         ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                        $comments_list = $wpdb->get_results( $sql );
                         get_template_part( 'all_template/reviews_list', null, ['TYPE' => 'kredity', 'DATA' => $comments_list]);
                    ?>
	            </div>
	        </div>
	    </div>
	    <!-- / card reviews -->
	    <!-- best credit cards -->
       <div class="section" id="best-products">
           <div class="section__header d-flex justify-content-between align-items-center mb-4">
               <h2 class="title mb-0">Лучшие предложения</h2>
               <a href="<?php echo get_post_type_archive_link('kredity') ?>" class="btn btn-primary btn-sm btn-all">
                   Все
                   <span class="icon ml-2">
                       <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
                   </span>
               </a>
           </div>
           <div class="horizontal__scroll row">
               <div class="horizontal__scroll-container">
                <?php 
$args = array(
    'post_type'             => 'kredity', 
    'posts_per_page'        => 4,
    'meta_key' => 'ratings_average',
    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
    'order' => 'DESC', 
);

$query = new WP_Query( $args );

// Цикл
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();

        if($_GET['test']){
            $posttype = get_post_type(get_the_id());
            print_r2($posttype);
        }

        ?>
        <!-- item -->
                   <div class="card card__vertical size4 offer h-100">
                       <div class="card-container p-3">
                           <div class="card__header mb-2 d-flex">
                               <div class="card__header-img">
                                   <img src="<?php $bank_choise_rel = get_field('product_bank', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
                               </div>
                               <div class="card__header-title"><a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></div>
                           </div>
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
                                    <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                                </div>
                               <div class="card__header-actions ml-auto">
                                   <a href=""><svg width="20" height="20" viewBox="0 0 20 20"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" x="0" y="0"></use></svg></a>
                               </div>                                
                           </div>
                           <div class="card__image my-3">
                               <a href="<?php echo the_permalink() ?>">
                                   <img src="<?php echo the_field('card_logo') ?>"
                                        alt="<?
                                        $logo_id = get_field('card_logo', get_the_ID(), false);
                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                        echo $logo_alt;
                                        ?>">
                               </a>
                           </div>
                           <ul class="leaders">
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Макс. сумма</div>
                                   <div class="leaders__item-value"><?php echo the_field('credit_max_sum') ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Мин. сумма</div>
                                   <div class="leaders__item-value"><?php $card_cashback = get_field('credit_min_sum'); 
                                       echo $card_cashback; ?> р</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">% ставка</div>
                                   <div class="leaders__item-value"><?php $card_period = get_field('credit_stavka'); 
                                       echo $card_period; ?>%</div>
                               </li>
                               <li class="leaders__item mb-1">
                                   <div class="leaders__item-title">Срок кредита</div>
                                   <div class="leaders__item-value">до <?php
											// Переменные
											$field = get_field('credit_period');
											//$value = $field['value'];
											//$label = $field['choices'][ $value ];
											echo $field['label'] ?></div>
                               </li>
                           </ul>
                           <div class="card__actions mt-3 d-flex">
                               <a href="<?php echo the_permalink() ?>" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Подробнее</a>
                               <a class="btn__compare btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center ml-3" data-id="<?php echo get_the_id() ?>" data-tax="<?php echo 'kredity'; ?>">
                                   <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use></svg>
                               </a>
                           </div>
                           <div class="card__footer mt-3">
                               <p>
                                   <span><?php echo the_field('bank_phone', $bank_choise_rel) ?></span>
                                   <span><?php echo the_field('bank_email', $bank_choise_rel) ?></span>
                                   <span>Лицензия: <?php echo the_field('bank_license', $bank_choise_rel) ?></span>
                                   <span><?php echo the_field('views', get_the_id()) ?> заявок</span>
                               </p>
                           </div>
                       </div>
                   </div>
                   <!-- / item -->
        <?php
    }
}
// Возвращаем оригинальные данные поста. Сбрасываем $post.
wp_reset_postdata();
?>
               </div>
           </div>
       </div>
       <!-- / best credit cards -->
	    <!-- faq -->

	        
	        <?php if( have_rows('type_faq', 'options') ): ?>
	        	  <div class="section">
		        <div class="section__header d-flex justify-content-between align-items-center mb-4">
		            <h2 class="title mb-0">Часто задавемые вопросы</h2>
		        </div>
			    <div class="accordion" id="accordion">
			    <?php $counter = 0; ?> 
			    <?php while( have_rows('type_faq', 'options') ): the_row(); 
			        $question = get_sub_field('question');
			        $answer = get_sub_field('answer');
			        $counter += 1;
			        ?>
			        <div class="accordion__item">
	                <div class="accordion__header">
	                    <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse__item-<?php echo $counter?>" aria-expanded="false">
	                        <?php echo $question ?>
	                        <div class="accordion__button-icon"><svg width="12" height="6" viewBox="0 0 12 6"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use></svg></div>
	                    </button>
	                </div>
	                <div id="collapse__item-<?php echo $counter?>" class="accordion__collapse collapse" data-bs-parent="#accordion">
	                    <div class="accordion__body">
	                        <p><?php echo $answer ?></p>
	                    </div>
	                </div>
	            </div>
			    <?php endwhile; ?>
			   </div>
	    	</div>
			<?php endif; ?>
	    <!-- / faq -->
	    <!-- wysiwyg text -->
	    <div class="section">
	        <div class="wysiwyg">
	           <?php echo the_field('type_desc', 'options') ?>
	        </div>
	    </div>
	    <!-- / wysiwyg text -->
	</div>
</main>

<?php get_footer() ?>


<?php } ?>
