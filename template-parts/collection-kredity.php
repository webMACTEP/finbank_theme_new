<?php get_header() ?>

<?php $term = get_queried_object();
$ID = get_queried_object()->ID;

$summ_limit = 1000000;
$cred_summ_period = 24;
$summ_limit = 0;
$cred_summ_period = 0;
if (isset($_SESSION['filter_kredity']) && !empty($_SESSION['filter_kredity'])):
	$mt = 1;
	$summ_limit = $_SESSION['filter_kredity'][0];
	$cred_summ_period = $_SESSION['filter_kredity'][1];
endif;
unset($_SESSION['filter_kredity']);


$tagslist = '';
$tags = get_field('coll-tags');
$ipost = 1;
if (!empty($tags)):
	foreach ($tags as $tag):
		$tagslug = $tag->slug;
		if ($ipost == 1) {
			$tagslist .= $tagslug;
		} else {
			$tagslist .= "," . $tagslug;
		}
		$ipost++;
	endforeach;
endif;
$postsarray = [];
if (!empty($tagslist)) {
	$posts_arg = [
		'posts_per_page'   => -1,
		'post_type' => array('kredity'),
		'tag' => $tagslist
	];

	$posts = get_posts($posts_arg);
	foreach ($posts as $post) {
		setup_postdata($post);
		$postsarray[] = $post->ID;
	}
	wp_reset_postdata();
}
//wp_reset_query();
if (get_field('coll-kredity')) {
	$products = get_field('coll-kredity');
} else {
	$products = [];
}

$allposts = array_merge($postsarray, $products);
$allpostsjson = json_encode($allposts);

global $allposts_collection;
global $type_collection;
$allposts_collection = $allposts;
$type_collection = 'kredity';

//var_dump($allpostsjson);


?>

<main class="newlisting zaimy-new" term="kredity">

	<!-- Bread crumbs -->
	<div class="container">
		<nav aria-label="breadcrumb" class="horizontal__scroll">
			<ol class="breadcrumb horizontal__scroll-container">
				<li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo get_post_type_archive_link('kredity') ?>">Кредиты</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
			</ol>
		</nav>
	</div>
	<!-- /Bread crumbs -->

	<!-- title & description -->
	<div class="page__heading">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h1 class="page__heading-title">
					<?php if (get_field('col-h1')): ?>
						<?= get_field('col-h1'); ?>
					<?php else: ?>
						<?php the_title(); ?>
					<?php endif; ?>
				</h1>
			</div>

			<?php
			$type_desc_top = get_field('col-desc');
			if ($type_desc_top) :
			?>
				<!-- description -->
				<div class="row flex-end">
					<div class="page__heading-description col-lg-8 col-sm-12 mt-2">
						<?php echo $type_desc_top; ?>
					</div>
					<div class="page__heading-description-more col-lg-2 col-sm-12 mt-2">Развернуть</div>
				</div>
				<!-- /description -->
			<?php
			endif;
			?>

		</div>

	</div>
	<!-- /title & description -->

	<!-- page navigation -->
	<div class="page__nav">
		<div class="container">
			<!-- top tab -->
			<div class="page__nav-container ">
				<div class="horizontal__scroll">
					<div class="horizontal__scroll-container-top">
						<a href="#" class="nav-link-top active">Все кредиты</a>

						<a href="#top" class="nav-link-top">Сравнение</a>
						<a href="#popular" class="nav-link-top">Подборки</a>
						<a href="#reviews" class="nav-link-top">Отзывы</a>
						<a href="#faq" class="nav-link-top">FAQ</a>
						<a href="#comments" class="nav-link-top">Комментарии</a>
						<a href="#news" class="nav-link-top">Новости и статьи</a>
					</div>
				</div>
			</div>
			<!-- / top tab -->

			<!-- filter popup -->
			<div class="new-filter-modal">
				<div class="new-filter-modal-content">
					<div class="new-filter-modal-close">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M9 1L1 9M1 1L9 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</div>
					<form id="credit-card-filter" action="" method="POST">
						<input type="hidden" name="action" value="cardfilter" />
						<input type="hidden" name="term" value="kredity" />
						<input type="hidden" name="postarr" value="<?php echo htmlspecialchars($allpostsjson); ?>" />
						<?
						$filter_price = get_filter_price();
						?>

						<h2>Все фильтры</h2>
						<div class="row">
							<div class="col-12 col-md-6 col-lg-6 col-xl-6 order-1">
								<div class="range">
									<div class="d-flex justify-content-between">
										<div class="range__label">Сумма, ₽</div>
										<input max="<?= $filter_price['kredity_inputs_range']['max']; ?>" type="text" class="range__value cred_limit" value="<?php echo $summ_limit ?>" min="0">
									</div>
									<input max="<?= $filter_price['kredity_inputs_range']['max']; ?>" class="range__input" name="summ_limit" type="range" min="0" value="<?php echo $summ_limit ?>">
								</div>
							</div>
							<div class="col-12 col-md-6 col-lg-6 col-xl-6 order-2 ortamrg">
								<div class="range">
									<div class="d-flex justify-content-between">
										<div class="range__label">Срок, месяцев</div>
										<input max="<?= $filter_price['kredity_inputs_range']['day_max']; ?>" type="text" class="range__value cred_trat" value="<?php echo $cred_summ_period ?>" min="0">
									</div>
									<input max="<?= $filter_price['kredity_inputs_range']['day_max']; ?>" class="range__input" name="cred_summ_period" type="range" min="0" value="<?php echo $cred_summ_period ?>">
								</div>
							</div>


							<div id="filter__details" class="col-12 mt-md-4 order-4 order-md-5">
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

											$wp_query = new WP_Query($args);

											// Цикл
											if ($wp_query->have_posts()) {
												$counter = 0;
												while ($wp_query->have_posts()) {
													$wp_query->the_post();
													$counter += 1;
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
											if ($field['choices']): ?>
												<?php foreach ($field['choices'] as $value => $label): ?>
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
											if ($field['choices']): ?>
												<?php foreach ($field['choices'] as $value => $label): ?>
													<option value="<?php echo $value ?>"><?php echo $label ?></option>
												<?php endforeach; ?>
											<?php endif; ?>
										</select>
									</div>
								</div>
							</div>

							<div class="new-filter-modal-show col-12 col-md-6 col-lg-3 col-xl-2 mt-4 order-5 order-md-5">
								<div class="btn btn-primary btn-block submit-button">Показать</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- / filter popup -->

			<!-- calc popup -->
			<div class="new-calc-modal">
				<div class="new-calc-content">
					<div class="new-calc-close">
						<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M9 1L1 9M1 1L9 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</div>

					<h2>Кредитный калькулятор</h2>
					<!-- Блок калькулятора -->
					<div class="calc__content" id="calc" data-type="creditCalc">

						<div class="calc-row">
							<div class="row">
								<div class="calc__content-buttons d-flex">
									<label class="btn__radio">
										<input class="calc__input" type="radio" name="caclType" data-field="type" value="1" checked="">
										<span class="btn__radio-text">Аннуентный</span>
									</label>
									<label class="btn__radio">
										<input class="calc__input" type="radio" name="caclType" data-field="type" value="2">
										<span class="btn__radio-text">Дифференцированный</span>
									</label>
								</div>
							</div>

							<div class="c-row">
								<div class="c-col-1">

									<div class="calc__field">
										<div class="calc__field-wrap">
											<div class="calc__field-label">Кредитный лимит</div>
											<input type="text" class="range__value form-control calc__input" value="1000000" min="0" max="10000000" data-field="limit">
											<input class="range__input calc__input" name="range1" type="range" min="0" max="10000000" value="1000000" data-field="limit" style="--range-progress:10%;">
										</div>
									</div>
									<div class="calc__field d-flex">
										<div class="calc__field-wrap mt-3 mt-md-4 flex-grow-1">
											<div class="calc__field-label">Срок / месяц</div>
											<input type="text" class="range__value form-control calc__input" value="10" min="1" max="40" data-field="date">
											<input class="range__input calc__input" name="range2" type="range" min="1" max="40" value="10" data-field="date" style="--range-progress:25%;">
										</div>
										<div class="calc__field-wrap calc__field-min mt-3 mt-md-4 ml-3">
											<div class="calc__field-label">Ставка</div>
											<input type="text" class="range__value form-control calc__input" value="15%" maxlength="6" data-field="percent" pattern="[0-9]*">
										</div>
									</div>
								</div>
								<div class="c-col-2">
									<div class="calc-result-wrapp">

										<div class="calc__total">
											<div class="calc__total-field d-flex justify-content-between align-items-center">
												<div class="calc__total-label">Сумма займа</div>
												<div class="calc__value">
													<span id="calc__sum" class="calc__value-text">8 000 000</span>
													<span class="calc__value-char">₽</span>
												</div>
											</div>
											<div class="calc__total-field d-flex justify-content-between align-items-center">
												<div class="calc__total-label">Переплата</div>
												<div class="calc__total-value">
													<span id="calc__overpay" class="calc__value-text">1 000 000</span>
													<span class="calc__value-char">₽</span>
												</div>
											</div>
											<div class="calc__total-field d-flex justify-content-between align-items-center">
												<div class="calc__total-label">К возврату</div>
												<div class="calc__total-value">
													<span id="calc__total" class="calc__value-text">9 000 000</span>
													<span class="calc__value-char">₽</span>
												</div>
											</div>


											<div class="calc__total-field d-flex justify-content-between align-items-center">
												<div class="calc__total-label">Окончание кредита</div>
												<div class="calc__total-value">
													<span id="calc__dateEnd" class="calc__value-text">15.05.2022</span>
												</div>
											</div>
											<div class="calc__total-field d-flex justify-content-between align-items-center">
												<div class="calc__total-label">Платежи в месяц</div>
												<div class="calc__total-value">
													<span id="calc__payments" class="calc__value-text">500 000</span>
													<span class="calc__value-char">₽</span>
												</div>
											</div>


										</div>
									</div>
								</div>
								<div id="calc__progress" class="c-col-3 progress">


									<!-- <div class="progress__circle" style="--graph-danger: 5%;">
									<div class="progress__text">
										<span class="progress__percent">75</span>%
									</div>
								</div> -->



									<div class="benefit">
										<div class="b-lines">
											<div class="b-line active"></div>
											<div class="b-line active"></div>
											<div class="b-line active"></div>
											<div class="b-line active"></div>
											<div class="b-line active"></div>
											<div class="b-line active"></div>
											<div class="b-line active"></div>
											<div class="b-line"></div>
											<div class="b-line"></div>
											<div class="b-line"></div>
										</div>
										<p class="progress__description">
											По нашим подсчетам, рассчитанный
											кредит <span>на</span> <span class="progress__percent">80</span> <span>% выгоден</span>
										</p>
									</div>
								</div>


							</div>

						</div>

						<div class="c-line"></div>
						<div class="c-footer">
							<div class="btn btn-primary">Подобрать</div>
							<div class="new-calc-btn-close btn">Закрыть</div>
						</div>

					</div>


				</div>

			</div>
			<!-- / calc popup -->

		</div>
	</div>
	<!-- / page navigation -->
	<!-- tags -->
	<div class="container">
		<div class="tags-list mb-4">
			<div class="tags-list_prev"><svg width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4.5 1.5L2.84722 3.07258C1.52915 4.32668 0.870122 4.95373 0.768647 5.718C0.743785 5.90526 0.743785 6.09474 0.768647 6.282C0.870121 7.04627 1.52915 7.67332 2.84722 8.92742L4.5 10.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
				</svg>
			</div>
			<div class="tags-list_wrapper">
				<a class="nav-link" href="/collection/onlajn/">Онлайн на карту</a>
				<a class="nav-link" href="/collection/kreditnaya-karta-virtualnye/">Виртуальные</a>
				<a class="nav-link" href="/collection/refinansirovanie-kreditnoy-karty/">Рефинансирование</a>
				<a class="nav-link" href="/collection/dlja-snjatija-nalichnyh/">Для снятия наличных</a>
				<a class="nav-link" href="/collection/bez-spravok-o-dohodah/">Без справок о доходах</a>
				<a class="nav-link" href="/collection/s-plohoj-istoriej/">С плохой КИ</a>
				<a class="nav-link" href="/collection/s-kjeshbek/">С кэшбеком</a>
				<a class="nav-link" href="/collection/pod-nizkij-procent/">Под низкий процент</a>
				<a class="nav-link" href="/collection/kreditnye-karty-s-besplatnym-snjatiem-nalichnyh-v-2024-godu/">С бесплатным снятием наличных</a>
				<a class="nav-link" href="/collection/kreditnaya-karta-pensioneram/">Пенсионерам</a>
				<a class="nav-link" href="/collection/onlajn/">Онлайн на карту</a>
				<a class="nav-link" href="/collection/kreditnaya-karta-virtualnye/">Виртуальные</a>
				<a class="nav-link" href="/collection/refinansirovanie-kreditnoy-karty/">Рефинансирование</a>
				<a class="nav-link" href="/collection/dlja-snjatija-nalichnyh/">Для снятия наличных</a>
				<a class="nav-link" href="/collection/bez-spravok-o-dohodah/">Без справок о доходах</a>
				<a class="nav-link" href="/collection/s-plohoj-istoriej/">С плохой КИ</a>
				<a class="nav-link" href="/collection/s-kjeshbek/">С кэшбеком</a>
				<a class="nav-link" href="/collection/pod-nizkij-procent/">Под низкий процент</a>
				<a class="nav-link" href="/collection/kreditnye-karty-s-besplatnym-snjatiem-nalichnyh-v-2024-godu/">С бесплатным снятием наличных</a>
				<a class="nav-link" href="/collection/kreditnaya-karta-pensioneram/">Пенсионерам</a>
			</div>
			<div class="tags-list_next"><svg width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1.5 1.5L3.15278 3.07258C4.47085 4.32668 5.12988 4.95373 5.23135 5.718C5.25622 5.90526 5.25622 6.09474 5.23135 6.282C5.12988 7.04627 4.47085 7.67332 3.15278 8.92742L1.5 10.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
				</svg>
			</div>
		</div>
	</div>
	<!-- / tags -->

	<div class="container">
		<!-- credits list -->
		<div class="credits section">
			<div class="row">

				<?php

				//wp_reset_postdata();
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'post_type' => array('kredity'),
					'paged' => $paged,
					'post__in' => $allposts,
					'orderby' => 'name',
					'order' => 'DESC',
					'post_status' => 'publish',
					'paged' => $paged,
					//'tax_query' => array(
					//    array(
					//        'taxonomy' => 'bankcards',
					//        'field'    => 'slug',
					//        'terms'    => 'debetcard',
					//    ),
					//)
				);

				$args['meta_query'][] = array(
					'key' => 'archive',
					'value' => '0'
				);

				$counter = 0;
				$query = new WP_Query($args);

				if ($query->have_posts()) {

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
				} else {
					$posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
				}


				//$max_pages = $query->max_num_pages;
				$GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
				?>
				<!-- list -->
				<div class="col-12 col-lg-12 order-lg-1">
					<div class="credits__list">
						<div class="d-flex flex-wrap justify-content-between align-items-center credits__list-header">
							<div class="credits__list-buttons d-flex flex-wrap justify-content-between align-items-center">
								<div class="mt-5 mb-4 mt-md-0 mb-md-0 variants_count-container"><span class="variants_count"><?php echo $query->found_posts; ?></span> варианта</div>
								<div class="filtr-butt">
									<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1.25 3L10.25 3M10.25 3C10.25 4.24264 11.2574 5.25 12.5 5.25C13.7426 5.25 14.75 4.24264 14.75 3C14.75 1.75736 13.7426 0.75 12.5 0.75C11.2574 0.75 10.25 1.75736 10.25 3ZM5.75 9L14.75 9M5.75 9C5.75 10.2426 4.74264 11.25 3.5 11.25C2.25736 11.25 1.25 10.2426 1.25 9C1.25 7.75736 2.25736 6.75 3.5 6.75C4.74264 6.75 5.75 7.75736 5.75 9Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
									Фильтр
								</div>
								<div class="calc-butt">
									<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11.25 0.75L0.75 11.25M3.75 2.25C3.75 3.07843 3.07843 3.75 2.25 3.75C1.42157 3.75 0.75 3.07843 0.75 2.25C0.75 1.42157 1.42157 0.75 2.25 0.75C3.07843 0.75 3.75 1.42157 3.75 2.25ZM11.25 9.75C11.25 10.5784 10.5784 11.25 9.75 11.25C8.92157 11.25 8.25 10.5784 8.25 9.75C8.25 8.92157 8.92157 8.25 9.75 8.25C10.5784 8.25 11.25 8.92157 11.25 9.75Z" stroke="#14B8AD" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
									Калькулятор
								</div>
							</div>
							<div class="credits__list-right">
								<div class="variants_count-container-mob"><span class="variants_count"><?php echo $query->found_posts; ?></span> варианта</div>
								<div class="credits__list-dropdown dropdown  px-0">
									<select name="" class="styledSelect cred-order-select">
										<option value="" selected disabled>Сортировать</option>
										<option value="ratings_average">По рейтингу</option>
										<option value="views">По количеству заявок</option>
										<option value="credit_max_sum">По сумме займа</option>
										<option value="credit_stavka">По процентной ставке</option>
									</select>
								</div>
								<div class="views-buttons">
									<div class="horisont-butt active">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M15.8 8C16.9201 8 17.4802 8 17.908 7.78201C18.2843 7.59027 18.5903 7.28431 18.782 6.90798C19 6.48016 19 5.92011 19 4.8V4.2C19 3.0799 19 2.51984 18.782 2.09202C18.5903 1.7157 18.2843 1.40973 17.908 1.21799C17.4802 1 16.9201 1 15.8 1L4.2 1C3.0799 1 2.51984 1 2.09202 1.21799C1.71569 1.40973 1.40973 1.71569 1.21799 2.09202C1 2.51984 1 3.07989 1 4.2L1 4.8C1 5.9201 1 6.48016 1.21799 6.90798C1.40973 7.28431 1.71569 7.59027 2.09202 7.78201C2.51984 8 3.07989 8 4.2 8L15.8 8Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M15.8 19C16.9201 19 17.4802 19 17.908 18.782C18.2843 18.5903 18.5903 18.2843 18.782 17.908C19 17.4802 19 16.9201 19 15.8V15.2C19 14.0799 19 13.5198 18.782 13.092C18.5903 12.7157 18.2843 12.4097 17.908 12.218C17.4802 12 16.9201 12 15.8 12L4.2 12C3.0799 12 2.51984 12 2.09202 12.218C1.71569 12.4097 1.40973 12.7157 1.21799 13.092C1 13.5198 1 14.0799 1 15.2L1 15.8C1 16.9201 1 17.4802 1.21799 17.908C1.40973 18.2843 1.71569 18.5903 2.09202 18.782C2.51984 19 3.07989 19 4.2 19H15.8Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
										</svg>

									</div>
									<div class="cards-butt">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M6.4 1H2.6C2.03995 1 1.75992 1 1.54601 1.10899C1.35785 1.20487 1.20487 1.35785 1.10899 1.54601C1 1.75992 1 2.03995 1 2.6V6.4C1 6.96005 1 7.24008 1.10899 7.45399C1.20487 7.64215 1.35785 7.79513 1.54601 7.89101C1.75992 8 2.03995 8 2.6 8H6.4C6.96005 8 7.24008 8 7.45399 7.89101C7.64215 7.79513 7.79513 7.64215 7.89101 7.45399C8 7.24008 8 6.96005 8 6.4V2.6C8 2.03995 8 1.75992 7.89101 1.54601C7.79513 1.35785 7.64215 1.20487 7.45399 1.10899C7.24008 1 6.96005 1 6.4 1Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M17.4 1H13.6C13.0399 1 12.7599 1 12.546 1.10899C12.3578 1.20487 12.2049 1.35785 12.109 1.54601C12 1.75992 12 2.03995 12 2.6V6.4C12 6.96005 12 7.24008 12.109 7.45399C12.2049 7.64215 12.3578 7.79513 12.546 7.89101C12.7599 8 13.0399 8 13.6 8H17.4C17.9601 8 18.2401 8 18.454 7.89101C18.6422 7.79513 18.7951 7.64215 18.891 7.45399C19 7.24008 19 6.96005 19 6.4V2.6C19 2.03995 19 1.75992 18.891 1.54601C18.7951 1.35785 18.6422 1.20487 18.454 1.10899C18.2401 1 17.9601 1 17.4 1Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M17.4 12H13.6C13.0399 12 12.7599 12 12.546 12.109C12.3578 12.2049 12.2049 12.3578 12.109 12.546C12 12.7599 12 13.0399 12 13.6V17.4C12 17.9601 12 18.2401 12.109 18.454C12.2049 18.6422 12.3578 18.7951 12.546 18.891C12.7599 19 13.0399 19 13.6 19H17.4C17.9601 19 18.2401 19 18.454 18.891C18.6422 18.7951 18.7951 18.6422 18.891 18.454C19 18.2401 19 17.9601 19 17.4V13.6C19 13.0399 19 12.7599 18.891 12.546C18.7951 12.3578 18.6422 12.2049 18.454 12.109C18.2401 12 17.9601 12 17.4 12Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M6.4 12H2.6C2.03995 12 1.75992 12 1.54601 12.109C1.35785 12.2049 1.20487 12.3578 1.10899 12.546C1 12.7599 1 13.0399 1 13.6V17.4C1 17.9601 1 18.2401 1.10899 18.454C1.20487 18.6422 1.35785 18.7951 1.54601 18.891C1.75992 19 2.03995 19 2.6 19H6.4C6.96005 19 7.24008 19 7.45399 18.891C7.64215 18.7951 7.79513 18.6422 7.89101 18.454C8 18.2401 8 17.9601 8 17.4V13.6C8 13.0399 8 12.7599 7.89101 12.546C7.79513 12.3578 7.64215 12.2049 7.45399 12.109C7.24008 12 6.96005 12 6.4 12Z" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
										</svg>

									</div>
								</div>
							</div>
						</div>

						<div data-json='<?= json_encode($args); ?>' class="list_posts list_posts-horisontal" id="response-cred-card">
							<?
							echo $posts_html;
							?>
						</div>
						<?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
						wp_reset_query(); ?>
						<!-- <div class="pagination__description mt-4">
						Показано <span class="count_view"><?php // echo $counter 
															?></span>
						продуктов из <span class="count_all"><?php // echo $query->found_posts; 
																?></span>
					</div> -->
						<!-- pagination -->
						<div class="pagination flex-column mb-3">
							<?php if ($paged < $max_pages): ?>
								<button class="btn btn-outline-gray btn-block load_more_btn"
									data-max_pages="<?php echo $max_pages ?>" data-paged="<?php echo $paged ?>">
									Больше решений
								</button>

							<?php endif; ?>

						</div>


						<!-- archive posts -->
						<?php
						$args_archive = array(
							'post_type' => 'kredity',
							'posts_per_page' => -1,
							'meta_key'      => 'archive',
							'meta_value'    => true
						);
						$query_archive = new WP_Query($args_archive);
						if ($query_archive->have_posts()): ?>
							<button class="btn btn-outline-gray btn-block archive_title mb-4">
								Архивные оферы (<?= $query_archive->found_posts; ?>)
							</button>


							<div class="list_posts archive_list archive_hide">
								<?php while ($query_archive->have_posts()): $query_archive->the_post(); ?>
									<?php get_template_part('template-parts/filter-kredity-posts'); ?>
								<?php endwhile;
								wp_reset_postdata(); ?>
							</div>
						<?php endif; ?>
						<!-- /archive posts -->

					</div>
				</div>
				<!-- / list -->

				<!-- / pagination -->


			</div>
			<div class="section">
				<div class="list-info">
					<?php $date_actually = get_the_modified_date('d.m.Y', $ID); ?>
					<?php if ($date_actually): ?>
						<p>Дата обновления информации: <?= $date_actually ?></p>
					<?php endif; ?>
					<p>Наиболее актуальные условия и тарифы мы рекомендуем узнавать на официальном сайте банков и в отделениях</p>
				</div>
			</div>
		</div>
		<?php wp_reset_query(); ?>
		<!-- / credits list -->



		<!-- best offers month -->
		<div class="section" id="best-products">
			<div class="section__header d-flex justify-content-between align-items-center mb-4">
				<h2 class="title mb-0">Предложения месяца</h2>

			</div>
			<div class="best-offers-scroll horizontal__scroll row">
				<div class="horiz-prew offers-horiz-prew">
					<svg width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 1L3.79629 3.09677C2.03887 4.7689 1.16016 5.60497 1.02486 6.624C0.991713 6.87367 0.991713 7.12633 1.02486 7.376C1.16016 8.39503 2.03887 9.2311 3.79629 10.9032L6 13" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
					</svg>

				</div>
				<div class="horiz-next offers-horiz-next">
					<svg width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L3.20371 3.09677C4.96113 4.7689 5.83984 5.60497 5.97514 6.624C6.00829 6.87367 6.00829 7.12633 5.97514 7.376C5.83984 8.39503 4.96113 9.2311 3.20371 10.9032L1 13" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
					</svg>

				</div>
				<div class="horizontal__scroll-container best-offers-scroll-container">
					<?php
					$args = array(
						'post_type'             => 'kredity',
						'posts_per_page'        => 10,
						'meta_key' => 'ratings_average',
						'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
						'order' => 'DESC',
					);

					$query = new WP_Query($args);

					// Цикл
					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();

					?>
							<!-- item -->
							<div class="main-page card card__vertical size4 offer h-100">
								<div class="card-container p-3">
									<div class="card__header mb-2 d-flex">
										<div class="card__header-img">
											<img src="<?php $bank_choise_rel = get_field('product_bank', get_the_ID()) ?>
						   <?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
										</div>
										<div class="card__header-title"><a href="<?php echo the_permalink() ?>">
												<?php
												$alter_title1 = get_field('alter_title');

												if ($alter_title1) {
													echo $alter_title1;
												} else {
													echo get_the_title();
												}
												?>

											</a></div>
									</div>



									<ul class="leaders">
										<div class="bank__item-footer text-center  pb-2 mt-2">
											<li class="leaders__item mb-1">
												<div class="leaders__item-title">Макс. сумма:</div>
												<div class="leaders__item-value"><?php echo number_format(get_field('credit_max_sum'), 0, '.', ' '); ?> ₽</div>
											</li>
											<li class="leaders__item mb-1">
												<div class="leaders__item-title">Мин. сумма</div>
												<div class="leaders__item-value"><?php echo number_format(get_field('credit_min_sum'), 0, '.', ' '); ?> ₽</div>
											</li>
											<li class="leaders__item mb-1">
												<div class="leaders__item-title">% ставка</div>
												<div class="leaders__item-value">От <?php the_field('credit_stavka'); ?>%</div>
											</li>

										</div>
									</ul>
									<div class="card__actions mt-3 d-flex">
										<?php if ($card_bank_link): ?>
											<div class="card__actions-btns">
												<a href="<?php echo esc_url($card_bank_link); ?>"
													target="_blank"
													onclick="<?php echo esc_js(get_metrika_for_list($card_bank_link)); ?> return true;"
													class="apply_now_btm btn btn-primary btn-block">
													Оформить
												</a>
											</div>
										<?php else: ?>
											<div class="card__actions-btns">
												<a data-popap-apply-id="<?php echo esc_attr(get_the_ID()); ?>"
													target="_blank"
													onclick="<?php echo esc_js(get_metrika_for_list($card_bank_link)); ?> return true;"
													class="apply_now_btm btn btn-primary btn-block">
													Оформить
												</a>
											</div>
										<?php endif; ?>

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
		<!-- / best offers month -->

		<!-- top offers -->
		<div id="top" class="section anchor">
			<div class="section__header d-flex justify-content-between align-items-center mb-4">
				<h2 class="title mb-0">Сравнение условий ТОП предложений месяца</h2>
			</div>
			<div class="top-offers-wrapper">
				<div class="top-offers-head">
					<div class="item">Кредит</div>
					<div class="item">Макс. сумма</div>
					<div class="item">Мин. сумма</div>
					<div class="item">% ставка</div>
				</div>
				<ul>
					<?php
					$argstop = array(
						'post_type'             => 'kredity',
						'posts_per_page'        => 10,
						'meta_key' => 'ratings_average',
						'orderby' => 'meta_value_num',
						'order' => 'DESC',

					);

					$querytop = new WP_Query($argstop);

					// Цикл
					if ($querytop->have_posts()) {
						while ($querytop->have_posts()) {
							$querytop->the_post();

					?>
							<li>
								<div class="card__header-img">
									<img src="<?php $bank_choise_rel = get_field('product_bank', get_the_ID()) ?>
							<?php echo the_field('bank_logo', $bank_choise_rel) ?>" alt="">
									<a href="<?php echo the_permalink() ?>">
										<?php //echo get_the_title($bank_choise_rel) 
										?>
										<?php
										$alter_title1 = get_field('alter_title');

										if ($alter_title1) {
											echo $alter_title1;
										} else {
											echo get_the_title();
										}
										?>
									</a>
								</div>



								<div class="leaders__item-value">
									<div class="leaders__item-title">Макс. сумма</div><?php echo number_format(get_field('credit_max_sum'), 0, '.', ' '); ?> ₽
								</div>

								<div class="leaders__item-value">
									<div class="leaders__item-title">Мин. сумма</div><?php echo number_format(get_field('credit_min_sum'), 0, '.', ' '); ?> ₽
								</div>

								<div class="leaders__item-value">
									<div class="leaders__item-title">% ставка</div>От <?php the_field('credit_stavka'); ?>%
								</div>



							</li>





					<?php
						}
					}
					// Возвращаем оригинальные данные поста. Сбрасываем $post.
					wp_reset_postdata();
					?>
				</ul>
				<div class="btn btn-outline-gray mt-3 top-offers-more">Показать еще</div>
			</div>
		</div>





		<!-- Popular -->
		<div id="popular" class="section anchor">
			<div class="section__header d-flex justify-content-between align-items-center mb-4">
				<h2 class="title mb-0">Популярные категории</h2>
			</div>
			<div class="popular-products">

				<?php
				// Меню слева
				$massiv_vhodnih_parametrov = [
					'container'      => '',
					'depth'          => 0,
					'echo'           => false,
					'link_class'     => 'filter__btn',
					'theme_location' => 'sidebar_menu_kredity',
					'before'         => '<div class="filter__section" id="collist">',
					'after'          => '</div>',
				];
				echo strip_tags(wp_nav_menu($massiv_vhodnih_parametrov), '<a>,');
				?>

				<?php
				// Тут вручную задаёте три группы: в каждую — массив ID категорий
				$wrappers = [
					['cats' => [109]],
					['cats' => [107, 99, 104, 108, 101]],
					['cats' => [105, 102, 103, 106, 100]],
				];

				$visible_count = 0; // число элементов, показываемых по умолчанию
				?>

				<?php foreach ($wrappers as $wrapper_index => $wrapper) : ?>
					<div class="popular-products-wrapp">

						<?php foreach ($wrapper['cats'] as $cat_id) {
							$cat = get_term($cat_id, 'tags-category');
							if (! $cat || is_wp_error($cat)) continue;

							// Подготовка запроса
							$args_coll = [
								'post_type'      => 'collection',
								'tax_query'      => [[
									'taxonomy' => 'tags-category',
									'terms'    => $cat_id,
									'field'    => 'id',
								]],
								'posts_per_page' => -1,
								'orderby'        => 'date',
								'order'          => 'DESC',
								'meta_query'     => [[
									'key'     => 'coll-type',
									'value'   => 'kredity',
									'compare' => '=',
								]],
							];
							$query = new WP_Query($args_coll);

							if (! $query->have_posts()) {
								wp_reset_postdata();
								continue;
							}

							// Выводим блок категории
						?>
							<div class="filter">
								<div class="filter-title"><?= esc_html($cat->name); ?></div>
								<div class="filter__section" id="collist_<?= $cat_id; ?>">
									<?php
									$counter_col = 0;
									while ($query->have_posts()) {
										$query->the_post();
										$counter_col++;
										// Класс для ссылки
										$classes = 'filter__btn';
										if ($counter_col > $visible_count) {
											$classes .= ' coll_li';
											// для НЕ первой группы сразу скрываем
											if ($wrapper_index !== 0) {
												$classes .= ' coll__hidden';
											}
										}
										if (isset($current_id) && $current_id == get_the_ID()) {
											$classes .= ' active_post';
										}
									?>
										<a class="<?= $classes; ?>" href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									<?php } // конец цикла постов 
									?>
								</div>

								<?php if ($counter_col > $visible_count) : ?>
									<button class="btn__collmore_cat" data-text-open="" data-text-hide="" data-id="collist_<?= $cat_id; ?>">
										<span class="btn__collmore-icon">
											<svg width="14" height="7" viewBox="0 0 14 7" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M1 1L3.09677 3.20371C4.7689 4.96113 5.60497 5.83984 6.624 5.97514C6.87367 6.00829 7.12633 6.00829 7.376 5.97514C8.39503 5.83984 9.2311 4.96113 10.9032 3.20371L13 1" stroke="#1B2636" stroke-width="1.2" stroke-linecap="round" />
											</svg>
										</span>
										<span class="btn__collmore-text"></span>
									</button>
								<?php endif; ?>

							</div>
						<?php
							wp_reset_postdata();
						} // конец foreach категорий 
						?>
					</div>
				<?php endforeach; ?>

			</div>
		</div>
		<!-- / popular -->





		<!-- card reviews -->
		<div id="reviews" class="section anchor">
			<div class="section__header d-flex justify-content-between align-items-center mb-4">
				<h2 class="title mb-0">Отзывы о кредитах</h2>
				<a href="<?php echo  get_page_link(4973); //1503 tax-reviews 
							?>" class="btn btn-primary btn-sm btn-all" data-tax="kredity">
					Все
					<span class="icon ml-2">
						<svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
						</svg>
					</span>
				</a>
			</div>
			<div class="reviews-scroll horizontal__scroll row">
				<div class="horiz-prew reviews-horiz-prew">
					<svg width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 1L3.79629 3.09677C2.03887 4.7689 1.16016 5.60497 1.02486 6.624C0.991713 6.87367 0.991713 7.12633 1.02486 7.376C1.16016 8.39503 2.03887 9.2311 3.79629 10.9032L6 13" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"></path>
					</svg>

				</div>
				<div class="horiz-next reviews-horiz-next">
					<svg width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L3.20371 3.09677C4.96113 4.7689 5.83984 5.60497 5.97514 6.624C6.00829 6.87367 6.00829 7.12633 5.97514 7.376C5.83984 8.39503 4.96113 9.2311 3.20371 10.9032L1 13" stroke="#626B84" stroke-width="1.2" stroke-linecap="round"></path>
					</svg>

				</div>

				<div class="horizontal__scroll-container reviews-scroll-container">
					<?php
					$ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
					$custom_offset = 0;

					// fetch posts in all those categories
					$posts = get_cpt_ids('kredity');

					$sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
					FROM {$wpdb->comments} WHERE
					comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
					ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

					$comments_list = $wpdb->get_results($sql);

					if (count($comments_list) > 0) {
						foreach ($comments_list as $comm) {

							$comment_id = $comm->comment_ID;
							$comment = get_comment($comment_id);
							$comment_post_id = $comment->comment_post_ID;
							$bank_id = get_field('product_bank', $comment_post_id);
							$user = get_userdata($comment->user_id);

							$user_email = '';
							$user_role = '';
							if (!empty($user)) {
								$user_email = $user->user_email;
								$user_role = $user->roles;
							}

							$author = get_comment_author($comment_id);
							$city = get_comment_meta($comment_id, 'city', true); ?>
							<!-- item -->
							<div class="reviews__item">
								<div class="reviews__item-body">
									<div class="reviews__header d-flex align-items-center mb-2">
										<div class="reviews__header-logo">
											<img
												src="<?php echo the_field('bank_logo', $bank_id) ?>"
												alt="<?
														$logo_id = get_field('bank_logo', $bank_id, false);
														$logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
														echo $logo_alt;
														?>">
										</div>
										<div class="reviews__header-meta ml-3">
											<a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($bank_id) ?></a>
											<div class="d-flex">
												<div class="card__rating d-flex align-items-center mr-3">
													<div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
															<use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
														</svg></div>
													<?php echo the_field('ratings_average', $bank_id); ?>
												</div>
												<div class="card__icon d-flex align-items-center">
													<div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
															<use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
														</svg></div>
													<?php echo comments_number('0', '1', '%', $bank_id); ?>
												</div>
												<div class="card__date d-none d-md-block ml-auto"><?php echo  get_comment_date('d.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
											</div>
										</div>
									</div>
									<div class="reviews__item-content">
										<p><?php echo $comment->comment_content; ?></p>
									</div>
								</div>
								<div class="reviews__item-footer">
									<div class="reviews__author d-flex align-items-center mt-3">
										<div class="reviews__author-img mr-3">
											<img src="<?php echo get_avatar_url($comment, array(
															'size' => 60,
															'default' => 'identicon',
														)); ?>" alt="<?php echo $author; ?>">
										</div>
										<div class="reviews__author-content">
											<a class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
											<div class="reviews__author-info d-flex">
												<div class="card__icon d-flex align-items-center mr-3">
													<div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
															<use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use>
														</svg></div>
													<?php if (empty($user_role[0])):
														echo 'Гость';
													else:
														echo $user_role[0];
													endif; ?>
												</div>
												<?php if ($city != ''): ?>
													<div class="card__icon d-flex align-items-center">
														<div class="mr-2"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
																<use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#pointer" x="0" y="0"></use>
															</svg></div>
														<?php echo $city ?>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- / item -->
						<?php }
					} else { ?>
						<p class="col-12">Пока нет отзывов.</p>
					<?php } ?>
				</div>
			</div>
			<a href="<?php echo  get_page_link(4973); //1503 tax-reviews 
						?>" class="btn btn-primary btn-sm btn-all-mob" data-tax="kredity">
				Все
				<span class="icon ml-2">
					<svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
					</svg>
				</span>
			</a>
		</div>
		<!-- / card reviews -->

		<!-- faq -->
		<?php if (have_rows('type_faq')): ?>
			<div id="faq" class="section">
				<div class="section__header d-flex justify-content-between align-items-center mb-4">
					<h2 class="title mb-0">Часто задавемые вопросы</h2>
				</div>
				<div class="accordion" id="accordion">
					<?php $counter = 0; ?>
					<?php while (have_rows('type_faq')): the_row();
						$question = get_sub_field('question');
						$answer = get_sub_field('answer');
						$counter += 1;
					?>
						<div class="accordion__item">
							<div class="accordion__header">
								<button class="accordion__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse__item-<?php echo $counter ?>" aria-expanded="false">
									<?php echo $question ?>
									<div class="accordion__button-icon"><svg width="12" height="6" viewBox="0 0 12 6">
											<use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use>
										</svg></div>
								</button>
							</div>
							<div id="collapse__item-<?php echo $counter ?>" class="accordion__collapse collapse" data-bs-parent="#accordion">
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

		<!-- news -->
		<div id="news" class="section anchor">
			<div class="section__header mb-4 d-flex justify-content-between align-items-center">
				<h2 class="title mb-0">Новости о кредитах</h2>
				<a href="<?php echo get_category_link('46') ?>" class="btn btn-primary btn-sm btn-all">
					Все
					<span class="icon ml-2">
						<svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
						</svg>
					</span>
				</a>
			</div>
			<div class="horizontal__scroll row mb-md-6">
				<div class="horizontal__scroll-container">
					<?php
					$args = array(
						'post_type' => 'post',
						'cat' => 46,
						'posts_per_page' => 4,
						//    'meta_key' => 'views',
						//    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
						//    'order' => 'DESC',
					);
					$wp_query = new WP_Query($args);
					if ($wp_query->have_posts()) {
						while ($wp_query->have_posts()) {
							$wp_query->the_post(); ?>
							<!-- item -->
							<div class="article__item card card__vertical size4 offer h-100">
								<div class="card-container p-3 d-xl-flex flex-xl-column">
									<?php if (get_the_post_thumbnail_url()): ?>
										<div class="card__image">
											<img
												src="<?php echo the_post_thumbnail_url() ?>"
												alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
										</div>
									<?php endif; ?>
									<div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
									<a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
									<div class="mt-auto">
										<div class="d-flex align-items-center mt-2">
											<div class="card__icon d-flex align-items-center mr-3">
												<div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
														<use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use>
													</svg></div>
												<?php echo the_field('views') ?>
											</div>
											<div class="position-relative card__icon d-flex align-items-center mr-3">
												<div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
															<use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
														</svg></a></div>
												<?php echo comments_number('0', '1', '%'); ?>
											</div>
											<div class="card__like d-flex align-items-center ml-auto">
												<?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
											</div>
										</div>
										<?php $author_id = get_field('page_author');
										if ($author_id):
										?>
											<div class="card__author d-flex align-items-center mt-3">
												<div class="card__author-img">
													<?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
												</div>
												<div class="card__author-content">
													<a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
													<div class="rating d-flex align-items-center">
														<?php echo do_shortcode('[ratings id="' . $author_id . '"]'); ?>
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
			<a href="<?php echo get_category_link('46') ?>" class="btn btn-primary btn-sm btn-all-mob">
				Все
				<span class="icon ml-2">
					<svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
					</svg>
				</span>
			</a>
		</div>
		<!-- / news -->
		<!-- articles -->
		<div id="articles" class="section anchor">
			<div class="section__header mb-4 d-flex justify-content-between align-items-center">
				<h2 class="title mb-0">Статьи о кредитах</h2>
				<a href="<?php echo get_category_link('37') ?>" class="btn btn-primary btn-sm btn-all">
					Все
					<span class="icon ml-2">
						<svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
						</svg>
					</span>
				</a>
			</div>
			<div class="horizontal__scroll row mb-md-6">
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
					$wp_query = new WP_Query($args);
					if ($wp_query->have_posts()) {
						while ($wp_query->have_posts()) {
							$wp_query->the_post(); ?>
							<!-- item -->
							<div class="article__item card card__vertical size4 offer h-100">
								<div class="card-container p-3 d-xl-flex flex-xl-column">
									<?php if (get_the_post_thumbnail_url()): ?>
										<div class="card__image">
											<img
												src="<?php echo the_post_thumbnail_url() ?>"
												alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
										</div>
									<?php endif; ?>
									<div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
									<a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
									<div class="mt-auto">
										<div class="d-flex align-items-center mt-2">
											<div class="card__icon d-flex align-items-center mr-3">
												<div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve">
														<use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use>
													</svg></div>
												<?php echo the_field('views') ?>
											</div>
											<div class="position-relative card__icon d-flex align-items-center mr-3">
												<div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
															<use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
														</svg></a></div>
												<?php echo comments_number('0', '1', '%'); ?>
											</div>
											<div class="card__like d-flex align-items-center ml-auto">
												<?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
											</div>
										</div>
										<?php $author_id = get_field('page_author');
										if ($author_id):
										?>
											<div class="card__author d-flex align-items-center mt-3">
												<div class="card__author-img">
													<?php get_template_part('all_template/image_and_alt/card_author-img', null, $author_id); ?>
												</div>
												<div class="card__author-content">
													<a href="<?php echo get_permalink($author_id) ?>" class="card__author-title"><?php echo get_the_title($author_id) ?></a>
													<div class="rating d-flex align-items-center">
														<?php echo do_shortcode('[ratings id="' . $author_id . '"]'); ?>
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
			<a href="<?php echo get_category_link('37') ?>" class="btn btn-primary btn-sm btn-all-mob">
				Все
				<span class="icon ml-2">
					<svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
					</svg>
				</span>
			</a>
		</div>
		<!-- / articles -->

		<!-- new-comments -->
		<div id="comments" class="section">
			<h2 class="title mb-3">Комментарии</h2>
			<div class="additional-comments">
				<?php
				$current_post_id = get_the_ID();
				display_additional_comments($current_post_id);
				?>
			</div>
			<div class="btn btn-primary" id="openAdditionalCommentForm">
				Написать комментарий
			</div>

		</div>
		<div class="new-comment-form">
			<?php // if (is_user_logged_in()): 
			?>
			<!-- <h3>Оставить комментарий</h3> -->
			<form id="additional-comment-form" method="post" class="row additional-comment-form">
				<input type="hidden" name="action" value="handle_additional_comment_ajax">
				<input type="hidden" name="additional_comment_nonce" value="<?php echo wp_create_nonce('additional_comment_form'); ?>">
				<div class="form-group col-12 col-md-6">
					<!-- <label for="author_name">Имя</label> -->
					<div class="mb-3">
						<input type="text" id="author_name" name="acf[field_675ae76ee8992]" class="form-control" placeholder="Имя*" required>
					</div>

				</div>
				<div class="form-group col-12 col-md-6">
					<!-- <label for="author_email">E-Mail</label> -->
					<div class="mb-3">
						<input type="email" id="author_email" name="acf[field_675ae7d4b0bdc]" class="form-control" placeholder="E-Mail*" required>
					</div>

				</div>
				<div class="form-group col-12">
					<!-- <label for="comment_content">Комментарий</label> -->
					<textarea id="comment_content" name="acf[field_675ae80ab0bdd]" class="form-control" rows="4" placeholder="Ваш комментарий*" required></textarea>
				</div>
				<div class="form-comment__bottom">* - Обязательно заполнить</div>
				<input type="hidden" name="acf[field_related_post]" value="<?php echo get_the_ID(); ?>" />
				<div class="col-12">
					<div class="mt-3">
						<button type="submit" class="btn btn-primary px-5">Отправить</button>
					</div>
				</div>

			</form>


		</div>
		<!-- /new-comments -->

		<!-- wysiwyg text -->
		<div class="section">
			<div class="wysiwyg type-desc">
				<?php the_content(); ?>
			</div>
			<div class="type-desc-more">Раскрыть</div>
			<?php $date_actually = get_the_modified_date('d.m.Y', $ID); ?>
			<?php if ($date_actually): ?>
				<div class="date_actually-article mb-2">Обновлено: <?= $date_actually; ?></div>
			<?php endif; ?>
		</div>
		<!-- / wysiwyg text -->

		<!-- footer-raiting -->
		<div class="section">
			<div class="container">
				<div class="rating-footer client-rating" data-post-id="<?php echo get_the_ID(); ?>">
					<?php
					$title = get_sub_field('title');
					echo '<h3 class="rating-title">' . esc_html($title) . '</h3>';
					// Дополнительный рейтинговый блок
					if (have_rows('additional_ratings_list')) :
						$additional_index = 0;
						while (have_rows('additional_ratings_list')) : the_row();
							$title = get_sub_field('title');
							$rating_total = get_sub_field('rating_total');
							$rating_count = get_sub_field('rating_count');

							// Вычисляем средний рейтинг
							if ($rating_total && $rating_count) {
								$average_rating = $rating_total / $rating_count;
								$average_rating = round($average_rating, 1);
							} else {
								$average_rating = 0;
							}

							if ($title || $average_rating > 0) :
								echo '<div class="rating-item" data-rating-index="' . $additional_index . '" data-rating-block="additional_ratings_list">';
								if ($title) {
									echo '<h3 class="rating-title">' . esc_html($title) . '</h3>';
								}

								if ($average_rating > 0) {
									// Передаём правильный блок в функцию отображения рейтинга
									display_star_rating($average_rating, 'additional_ratings_list');
								} else {
									echo '<div class="stars">';
									for ($i = 1; $i <= 5; $i++) {
										echo '<span class="star" data-value="' . $i . '" data-rating-block="additional_ratings_list">☆</span>';
									}
									echo '</div>';
								}

								// Добавляем элемент для отображения числового рейтинга
								echo '<div class="rating-stat">';
								echo 'Оценок ' . ($rating_count > 0 ? $rating_count : '0') . ', ';
								echo 'среднее <span class="average-rating">' . ($average_rating > 0 ? $average_rating : '0') . '</span> из 5';
								echo '</div>';

							endif;

							$additional_index++;
						endwhile;
					endif;
					?>
				</div>


			</div>
		</div>
		<!-- / footer-raiting -->
	</div>

</main>
<script src="<?php echo get_template_directory_uri(); ?>/js/new-listing.js"></script>

<?php get_footer() ?>