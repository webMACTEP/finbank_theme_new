<?
add_action('wp_ajax_cardfilter', 'card_filter_function');
add_action('wp_ajax_nopriv_cardfilter', 'card_filter_function');

function card_filter_function()
{
	$term = $_POST['term'];
	$order = $_POST['order'];

	if ($_POST['order_type']) {
		$order_type = $_POST['order_type'];
	} else {
		$order_type = 'DESC';
	}

	$postarr = !empty($_POST['postarr']) ? json_decode($_POST['postarr'], true) : false;
	//$postarr = json_decode( $_POST['postarr'], true );


	if ($term == 'creditcard' || $term == 'installmentcard' || $term == 'debetcard'):
		//$credLimit = !empty($_POST['cred_limit']) ? json_decode( $_POST['cred_limit'] ):false;
		//$cashback_number = !empty($_POST['cashback_number']) ? json_decode( $_POST['cashback_number'] ):false;
		//$percent_limit = !empty($_POST['percent_limit']) ? json_decode( $_POST['percent_limit'] ):false;
		//$cred_day_period = !empty($_POST['cred_day_period']) ? json_decode( $_POST['cred_day_period'] ):false;
		//$bank =  !empty($_POST['bank']) ? json_decode( $_POST['bank'] ):false;
		//$cat_cards = !empty($_POST['cat_cards']) ? $_POST['cat_cards']: false;
		//$gracePeriodSelect = !empty($_POST['period']) ? $_POST['period']: false;
		//$cashback = !empty($_POST['cashback']) ? $_POST['cashback'] : false;




		//$credLimit = !empty($_POST['cred_limit']) ? json_decode( $_POST['cred_limit'] ):false;
		//$cashback_number = !empty($_POST['cashback_number']) ? json_decode( $_POST['cashback_number'] ):false;
		//$percent_limit = !empty($_POST['percent_limit']) ? json_decode( $_POST['percent_limit'] ):false;
		//$cred_day_period = !empty($_POST['cred_day_period']) ? json_decode( $_POST['cred_day_period'] ): false;
		//$bank =  !empty($_POST['bank']) ? json_decode( $_POST['bank'] ): json_decode( null);


		//print_r2($_POST);
		//die;

		if (in_array('cashback_number', $_POST)) {
			$cashback_number = json_decode($_POST['cashback_number']);
		}

		if (in_array('percent_limit', $_POST)) {
			$percent_limit = json_decode($_POST['percent_limit']);
		}

		if (in_array('cashback', $_POST)) {
			$cashback = $_POST['cashback'];
		}


		$credLimit = json_decode($_POST['cred_limit']);
		$cred_day_period = json_decode($_POST['cred_day_period']);
		$bank = json_decode($_POST['bank']);

		$cat_cards = $_POST['cat_cards'];
		$gracePeriodSelect = $_POST['period'];

		// Получаем значение платежной системы из POST-запроса
		$payment_system = !empty($_POST['ps']) ? $_POST['ps'] : '';


		$os1 = !empty($_POST['os1']) ? $_POST['os1'] : '';
		$os2 = !empty($_POST['os2']) ? $_POST['os2'] : '';
		$os3 = !empty($_POST['os3']) ? $_POST['os3'] : '';
		$os4 = !empty($_POST['os4']) ? $_POST['os4'] : '';
		$os5 = !empty($_POST['os5']) ? $_POST['os5'] : '';
		$os6 = !empty($_POST['os6']) ? $_POST['os6'] : '';
		$os7 = !empty($_POST['os7']) ? $_POST['os7'] : '';
		$os8 = !empty($_POST['os8']) ? $_POST['os8'] : '';
		$cdt1 = !empty($_POST['cdt1']) ? $_POST['cdt1'] : '';
		$cdt2 = !empty($_POST['cdt2']) ? $_POST['cdt2'] : '';
		$cdt3 = !empty($_POST['cdt3']) ? $_POST['cdt3'] : '';
		$cdt4 = !empty($_POST['cdt4']) ? $_POST['cdt4'] : '';



		if (isset($order) && $order != '')
			$args = array(
				'meta_key' => $order,
				'orderby' => array('meta_value_num' => 'desc', 'title' => 'desc'),
				//'orderby' => 'meta_value_num title',
				//'order' => 'DESC',
				'post_type' => 'bankcard',
				'post_status' => 'publish',
				'tax_query' => array(
					array(
						'taxonomy' => 'bankcards',
						'field' => 'slug',
						'terms' => $term,
					)
				),
			);

		if ($order == '')
			$args = array(
				'orderby' => 'name',
				'order' => $order_type,
				'post_type' => 'bankcard',
				'post_status' => 'publish',
				'tax_query' => array(
					array(
						'taxonomy' => 'bankcards',
						'field' => 'slug',
						'terms' => $term,
					)
				),
			);

		if ($postarr) $args['post__in'] = $postarr;
	endif;


	if ($term == 'kredity'):
		$summ_limit = json_decode($_POST['summ_limit']);
		$cred_summ_period = json_decode($_POST['cred_summ_period']);
		$kreditbank = json_decode($_POST['kreditbank']);
		$kred_purpose = $_POST['kred_purpose'];
		$cat_zaim = $_POST['cat_zaim'];
		$cgt1 = !empty($_POST['cgt1']) ? $_POST['cgt1'] : '';
		$cgt2 = !empty($_POST['cgt2']) ? $_POST['cgt2'] : '';
		$cgt3 = !empty($_POST['cgt1']) ? $_POST['cgt3'] : '';
		$cgt4 = !empty($_POST['cgt4']) ? $_POST['cgt4'] : '';
		$cgt5 = !empty($_POST['cgt5']) ? $_POST['cgt5'] : '';
		$kos1 = !empty($_POST['kos1']) ? $_POST['kos1'] : '';
		$kos2 = !empty($_POST['kos2']) ? $_POST['kos2'] : '';
		$kos3 = !empty($_POST['kos3']) ? $_POST['kos3'] : '';
		$kos4 = !empty($_POST['kos4']) ? $_POST['kos4'] : '';
		$kos5 = !empty($_POST['kos5']) ? $_POST['kos5'] : '';
		$kos6 = !empty($_POST['kos6']) ? $_POST['kos6'] : '';
		$kos7 = !empty($_POST['kos7']) ? $_POST['kos7'] : '';
		$kos8 = !empty($_POST['kos8']) ? $_POST['kos8'] : '';
		$kos9 = !empty($_POST['kos9']) ? $_POST['kos9'] : '';
		$kos10 = !empty($_POST['kos10']) ? $_POST['kos10'] : '';


		//if(isset( $order  ) && $order != '' )
		if (!empty($order)):

			$args = array(
				'meta_key' => $order,
				//'orderby' => array( 'meta_value_num' => 'desc', 'title' => 'desc' ),
				'orderby' => 'meta_value_num',
				'post_status' => 'publish',
				'order' => $order_type,
				'post_type' => 'kredity',
			);

		else :
			$args = array(
				'orderby' => 'name',
				'post_status' => 'publish',
				'order' => $order_type,
				'post_type' => 'kredity',
			);
		endif;

		if ($postarr) $args['post__in'] = $postarr;
	endif;

	if ($term == 'zaimy'):
		$z_sum = json_decode($_POST['z_sum']);
		$z_time = json_decode($_POST['z_time']);
		$oz1 = !empty($_POST['oz1']) ? $_POST['oz1'] : '';
		$oz2 = !empty($_POST['oz2']) ? $_POST['oz2'] : '';
		$oz3 = !empty($_POST['oz3']) ? $_POST['oz3'] : '';
		$oz4 = !empty($_POST['oz4']) ? $_POST['oz4'] : '';
		$oz5 = !empty($_POST['oz5']) ? $_POST['oz5'] : '';
		$oz6 = !empty($_POST['oz6']) ? $_POST['oz6'] : '';
		$zct1 = !empty($_POST['zct1']) ? $_POST['zct1'] : '';
		$zct2 = !empty($_POST['zct2']) ? $_POST['zct2'] : '';
		$zct3 = !empty($_POST['zct3']) ? $_POST['zct3'] : '';
		$zct4 = !empty($_POST['zct4']) ? $_POST['zct4'] : '';
		$zct5 = !empty($_POST['zct5']) ? $_POST['zct5'] : '';
		$zct6 = !empty($_POST['zct6']) ? $_POST['zct6'] : '';
		$zct7 = !empty($_POST['zct6']) ? $_POST['zct6'] : '';
		$zos1 = !empty($_POST['zos1']) ? $_POST['zos1'] : '';
		$zos2 = !empty($_POST['zos2']) ? $_POST['zos2'] : '';
		$zos3 = !empty($_POST['zos3']) ? $_POST['zos3'] : '';
		$zos4 = !empty($_POST['zos4']) ? $_POST['zos4'] : '';
		$zos5 = !empty($_POST['zos5']) ? $_POST['zos5'] : '';
		$zos6 = !empty($_POST['zos6']) ? $_POST['zos6'] : '';
		if (isset($order) && $order != '')
			$args = array(
				'meta_key' => $order,
				'orderby' => array('meta_value_num' => $order_type, 'name' => $order_type),
				'post_type' => 'zaimy',
				'post_status' => 'publish',
			);
		if ($order == '')
			$args = array(
				'orderby' => 'name',
				'order' => $order_type,
				'post_type' => 'zaimy',
				'post_status' => 'publish',
			);
		if ($postarr) $args['post__in'] = $postarr;

		// Получаем значение способа получения из POST-запроса
		$zct = !empty($_POST['zct']) ? sanitize_text_field($_POST['zct']) : '';

		// Получаем значение организации займов из POST-запроса
		$oz = !empty($_POST['oz']) ? sanitize_text_field($_POST['oz']) : '';

		// Получаем значение "Прочие условия" из POST-запроса
		$zos = !empty($_POST['zos']) ? sanitize_text_field($_POST['zos']) : '';

		$args = array(
			'post_type' => 'zaimy',
			'post_status' => 'publish',
			'orderby' => 'name',
			'order' => $order_type,
			'meta_query' => array(
				'relation' => 'AND',
			),
		);

		// Добавляем фильтр по способу получения, если значение указано
		if (!empty($zct)) {
			$args['meta_query'][] = array(
				'key' => 'z_get_type', // Ключ мета-поля ACF
				'value' => $zct,       // Значение, переданное из формы
				'compare' => 'LIKE',   // Используем LIKE, так как это поле ACF Checkbox
			);
		}

		// Добавляем фильтр по организации займов, если значение указано
		if (!empty($oz)) {
			$args['meta_query'][] = array(
				'key' => 'z_organization', // Ключ мета-поля ACF
				'value' => $oz,           // Значение, переданное из формы
				'compare' => 'LIKE',      // Используем LIKE, так как это поле ACF Checkbox
			);
		}

		// Добавляем фильтр по "Прочим условиям", если значение указано
		if (!empty($zos)) {
			$args['meta_query'][] = array(
				'key' => 'z_other_statements', // Ключ мета-поля ACF
				'value' => $zos,             // Значение, переданное из формы
				'compare' => 'LIKE',         // Используем LIKE, так как это поле ACF Checkbox
			);
		}

		if ($postarr) {
			$args['post__in'] = $postarr;
		}

		query_posts($args);
		$item_count = 0;
		global $wp_query;
		$ii = 1;

		if (have_posts()) : ?>
			<?php ob_start(); // start buffering because we do not need to print the posts now 
			?>
			<?php while (have_posts()): the_post();

				$item_count++;

				get_template_part('template-parts/filter-zaimy-posts');

				$ii++;
			endwhile;
			$posts_html = ob_get_contents(); // we pass the posts to variable
			ob_end_clean(); // clear the buffer
		else:
			$posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
		endif;

		echo json_encode(array(
			'posts' => json_encode($wp_query->query_vars),
			'max_page' => $wp_query->max_num_pages,
			'found_posts' => $wp_query->found_posts,
			'content' => $posts_html,
			'item_count' => $item_count
		));

		die();
	endif;

	$args['meta_query'] = array('relation' => 'AND');


	// начало фильтра кредитов
	/*	
	$args['meta_query'][] = array(
  		'key' => 'archive',
		'value' => '1',
		'compare' => 'NOT EXISTS'
	);

	$args['meta_query'][] = array(
  		'key' => 'archive',
		'value' => true,
		'compare' => 'NOT EXISTS'
	);
	*/
	if (isset($summ_limit))
		$args['meta_query'][] = array(
			'key' => 'credit_max_sum',
			'value' => $summ_limit,
			'type' => 'numeric',
			'compare' => '>='
		);

	if (isset($cred_summ_period))
		$args['meta_query'][] = array(
			'key' => 'credit_period_month',
			'value' => $cred_summ_period,
			'type' => 'numeric',
			'compare' => '>='
		);

	if (isset($kreditbank) && $kreditbank != '')
		$args['meta_query'][] = array(
			'key' => 'product_bank',
			'value' => $kreditbank,
			'compare' => '='
		);

	if (isset($credLimit))

		$args['meta_query'][] = array(
			//'relation' => 'AND',
			'key' => 'card_cred_limit',
			'value' => $credLimit,
			'type' => 'numeric',
			'compare' => '<='
		);

	if (isset($kred_purpose) && $kred_purpose != '')
		$args['meta_query'][] = array(
			'key' => 'credit_porpose', // name of custom field
			'value' => $kred_purpose, // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($cat_zaim) && $cat_zaim != '')
		$args['meta_query'][] = array(
			'key' => 'credit_zaemshik', // name of custom field
			'value' => $cat_zaim, // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($cgt1) && $cgt1 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_get_type', // name of custom field
			'value' => 'cgt1', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($cgt2) && $cgt2 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_get_type', // name of custom field
			'value' => 'cgt2', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($cgt3) && $cgt3 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_get_type', // name of custom field
			'value' => 'cgt3', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($cgt4) && $cgt4 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_get_type', // name of custom field
			'value' => 'cgt4', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($cgt5) && $cgt5 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_get_type', // name of custom field
			'value' => 'cgt5', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($kos1) && $kos1 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_other_statements', // name of custom field
			'value' => 'kos1', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($kos2) && $kos2 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_other_statements', // name of custom field
			'value' => 'kos2', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($kos3) && $kos3 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_other_statements', // name of custom field
			'value' => 'kos3', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($kos4) && $kos4 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_other_statements', // name of custom field
			'value' => 'kos4', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($kos5) && $kos5 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_other_statements', // name of custom field
			'value' => 'kos5', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($kos6) && $kos6 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_other_statements', // name of custom field
			'value' => 'kos6', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($kos7) && $kos7 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_other_statements', // name of custom field
			'value' => 'kos7', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($kos8) && $kos8 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_other_statements', // name of custom field
			'value' => 'kos8', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($kos9) && $kos9 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_other_statements', // name of custom field
			'value' => 'kos9', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($kos10) && $kos10 == 'on')
		$args['meta_query'][] = array(
			'key' => 'credit_other_statements', // name of custom field
			'value' => 'kos10', // matches exactly "red"
			'compare' => 'LIKE',
		);

	// конец фильтра кредитов

	// начало фильтра займов

	if (isset($z_sum))
		$args['meta_query'][] = array(
			'key' => 'z_sum',
			'value' => $z_sum,
			'type' => 'numeric',
			'compare' => '>='
		);

	if (isset($z_time))
		$args['meta_query'][] = array(
			'key' => 'z_time',
			'value' => $z_time,
			'type' => 'numeric',
			'compare' => '>='
		);


	if (isset($oz1) && $oz1 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_organization', // name of custom field
			'value' => 'oz1', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($oz2) && $oz2 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_organization', // name of custom field
			'value' => 'oz2', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($oz3) && $oz3 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_organization', // name of custom field
			'value' => 'oz3', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($oz4) && $oz4 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_organization', // name of custom field
			'value' => 'oz4', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($oz5) && $oz5 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_organization', // name of custom field
			'value' => 'oz5', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($oz6) && $oz6 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_organization', // name of custom field
			'value' => 'oz6', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zct1) && $zct1 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_get_type', // name of custom field
			'value' => 'zct1', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zct2) && $zct2 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_get_type', // name of custom field
			'value' => 'zct2', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zct3) && $zct3 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_get_type', // name of custom field
			'value' => 'zct3', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zct4) && $zct4 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_get_type', // name of custom field
			'value' => 'zct4', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zct5) && $zct5 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_get_type', // name of custom field
			'value' => 'zct5', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zct6) && $zct6 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_get_type', // name of custom field
			'value' => 'zct6', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zct7) && $zct7 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_get_type', // name of custom field
			'value' => 'zct7', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zos1) && $zos1 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_other_statements', // name of custom field
			'value' => 'zos1', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zos2) && $zos2 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_other_statements', // name of custom field
			'value' => 'zos2', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zos3) && $zos3 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_other_statements', // name of custom field
			'value' => 'zos3', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zos4) && $zos4 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_other_statements', // name of custom field
			'value' => 'zos4', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zos5) && $zos5 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_other_statements', // name of custom field
			'value' => 'zos5', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($zos6) && $zos6 == 'on')
		$args['meta_query'][] = array(
			'key' => 'z_other_statements', // name of custom field
			'value' => 'zos6', // matches exactly "red"
			'compare' => 'LIKE',
		);

	// конец фильтра займов

	// начало фильтра карт

	if (isset($cashback_number))
		$args['meta_query'][] = array(
			'key' => 'card_cashbak_number',
			'value' => $cashback_number,
			'type' => 'numeric',
			'compare' => '<='
		);

	if (isset($percent_limit))
		$args['meta_query'][] = array(
			'key' => 'non_pecent_money',
			'value' => $percent_limit,
			'type' => 'numeric',
			'compare' => '<='
		);

	if (isset($cred_day_period))
		$args['meta_query'][] = array(
			//'relation' => 'AND',
			'key' => 'card_day_period',
			'value' => $cred_day_period,
			'type' => 'numeric',
			'compare' => '<'
		);



	if (isset($bank) && $bank != '')
		$args['meta_query'][] = array(
			'key' => 'bank_choise',
			'value' => $bank,
			'compare' => '='
		);

	if (isset($cat_cards) && $cat_cards != '')
		$args['meta_query'][] = array(
			'key' => 'card_category',
			'value' => $cat_cards,
			'compare' => '='
		);

	if (isset($gracePeriodSelect) && $gracePeriodSelect != '')
		$args['meta_query'][] = array(
			'key' => 'card_period',
			'value' => $gracePeriodSelect,
			'compare' => '='
		);
	if (isset($cashback) && $cashback != '')
		$args['meta_query'][] = array(
			'key' => 'card_cashback',
			'value' => $cashback,
			'compare' => '='
		);

	// Добавляем фильтр по платежной системе, если значение указано
	if (!empty($payment_system)) {
		$args['meta_query'][] = array(
			'key' => 'card_payment_sys', // Ключ мета-поля ACF
			'value' => $payment_system, // Значение, переданное из формы
			'compare' => 'LIKE' // Используем LIKE, так как это поле ACF Checkbox
		);
	}

	if (isset($os1) && $os1 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_other_state', // name of custom field
			'value' => 'os1', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($os2) && $os2 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_other_state', // name of custom field
			'value' => 'os2', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($os3) && $os3 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_other_state', // name of custom field
			'value' => 'os3', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($os4) && $os4 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_other_state', // name of custom field
			'value' => 'os4', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($os5) && $os5 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_other_state', // name of custom field
			'value' => 'os5', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($os6) && $os6 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_other_state', // name of custom field
			'value' => 'os6', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($os7) && $os7 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_other_state', // name of custom field
			'value' => 'os7', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($os8) && $os8 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_other_state', // name of custom field
			'value' => 'os8', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($cdt1) && $cdt1 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_deliv_type', // name of custom field
			'value' => 'cdt1', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($cdt2) && $cdt2 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_deliv_type', // name of custom field
			'value' => 'cdt2', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($cdt3) && $cdt3 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_deliv_type', // name of custom field
			'value' => 'cdt3', // matches exactly "red"
			'compare' => 'LIKE',
		);

	if (isset($cdt4) && $cdt4 == 'on')
		$args['meta_query'][] = array(
			'key' => 'card_deliv_type', // name of custom field
			'value' => 'cdt4', // matches exactly "red"
			'compare' => 'LIKE',
		);

	// конец фильтра карт

	$args['meta_query'][] = array(
		'key' => 'archive',
		'value' => '0'

	);

	//print_r2($args);


	$view_template = 1;

	$view_template = null;
	if (isset($_POST['view_template'])) {
		$view_template = $_POST['view_template'];
		$view_type = $_POST['view_type'];
	}


	query_posts($args);
	$item_count = 0;
	global $wp_query;
	$ii = 1;

	if (have_posts()) : ?>
		<?php ob_start(); // start buffering because we do not need to print the posts now 
		?>
		<?php while (have_posts()): the_post();

			$item_count++;

			if ($view_template) {

				get_template_part('template-parts/new-filter-bank-offers', false, ['view_type' => $view_type]);
			} else {
				if ($term == 'creditcard' || $term == 'installmentcard'):
					get_template_part('template-parts/filter-cred-card-posts');
				endif;
				if ($term == 'debetcard'):
					get_template_part('template-parts/filter-debet-card-posts');
				endif;
				if ($term == 'kredity'):
					get_template_part('template-parts/filter-kredity-posts');
				endif;
				if ($term == 'zaimy'):
					get_template_part('template-parts/filter-zaimy-posts');
				endif;
			}



			if ($ii % 4 == 0) {
				//echo do_shortcode( '[code2 id="7672"]' );
			}
			$ii++;
		endwhile;
		$posts_html = ob_get_contents(); // we pass the posts to variable
		ob_end_clean(); // clear the buffer
	else:
		$posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
	endif;


	echo json_encode(array(
		'posts' => json_encode($wp_query->query_vars),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $posts_html,
		'item_count' => $item_count
	));


	die();
}
