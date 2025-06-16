<?php

function new_table_collection_func($atts)
	{
		ob_start();
		global $allposts_collection;
		global $type_collection;

		$type = $type_collection; ?>

			<?php if ($type) { ?>

				<div class="section__header d-flex justify-content-between align-items-center mb-4">
					<h2 class="title mb-0">Сравнение условий ТОП предложений месяца</h2>
				</div>

			<?php } ?>



			<div class="code3wrapper  new_table_collection_func" id="table_collection">

				<?php if ($type == 'kredity') { ?>
					<div class="code3">
						<!--     <span class="frecom">Финабанк рекомендует!</span>-->
						<div class="code3head">
							<div class="w30">Кредит/ Банк</div>
							<div class="text-center">Сумма</div>
							<div class="text-center">Срок</div>
							<div class="text-center">ПСК</div>
						</div>
						<?php
						$query = new WP_Query(
							array(
								'posts_per_page' => -1,
								'post_type' => $type,
								'post__in' => $allposts_collection,
								'meta_key' => 'ratings_average',
								'orderby' => 'meta_value_num',
								'order' => 'DESC',
								'post_status' => 'publish',
								'meta_query' => array(
									array(
										'key' => 'archive',
										'value'    => '0'
									),
								)
							)
						);

						while ($query->have_posts()) {
							$query->the_post(); ?>
							<div class="code3text">
								<div class="w30 strong td2">
									<a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_table_collection'); return true;">
										<img src="<?php echo get_field('bank_logo', get_field('product_bank', get_the_ID())); ?>" alt="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</div>
								<div class="w30 td text-center">
									<div class="hidden-lg">Сумма</div>
									<div class="td-val"><?php echo number_format(get_field('credit_min_sum'), 0, '.', ' '); ?> - <?php echo number_format(get_field('credit_max_sum'), 0, '.', ' '); ?> ₽</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Срок</div>
									<div class="td-val">до <?php $field = get_field('credit_period');
															echo $field['label']; ?></div>
								</div>

								<?php if (get_field('opisanie_psk_1')): ?>

									<div class="w30 td text-center">
										<div class="hidden-lg">ПСК</div>
										<div class="td-val"><?php echo get_field('opisanie_psk_1'); ?>% - <?php echo get_field('opisanie_psk_2'); ?>%</div>
									</div>

								<?php endif; ?>

							</div>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if ($type == 'zaimy') { ?>
					<div class="code3"><span class="frecom">Финабанк рекомендует!</span>
						<div class="code3head">
							<div class="w30">Предложение</div>
							<div class="text-center">Сумма</div>
							<div class="text-center">Кредитная<br /> история</div>
							<div class="text-center">% ставка</div>
							<div class="text-center">Срок</div>
							<div class="text-center">Рейтинг</div>
						</div>

						<?php
						$query = new WP_Query(
							array(
								'posts_per_page' => -1,
								'post_type' => $type,
								'post__in' => $allposts_collection,
								'meta_key' => 'ratings_average',
								'orderby' => 'meta_value_num',
								'order' => 'DESC',
								'post_status' => 'publish',
								'meta_query' => array(
									array(
										'key' => 'archive',
										'value'    => '0'
									),
								)
							)
						);
						$counter_prod = 1;
						while ($query->have_posts()) {
							$query->the_post(); ?>
							<div class="code3text <?php if ($counter_prod > 10) {
														echo 'div__hidden';
													} ?>">
								<div class="w30 strong td2">
									<a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_shortcode_sheet'); return true;">
										<img src="<?php echo get_field('z_organization_logo'); ?>" alt="<?php the_title(); ?>">
										<?php the_title(); ?>

									</a>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Сумма</div>
									<div class="td-val"><?php echo number_format(get_field('z_sum'), 0, '.', ' '); ?> ₽</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Кредитная история</div>
									<div class="td-val"><?php echo get_field('z_history'); ?></div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">% ставка</div>
									<div class="td-val srok1">От <?php echo get_field('z_stavka'); ?>%</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Срок</div>
									<div class="td-val">до <?php echo get_field('z_time'); ?> дней</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Рейтинг</div>
									<div class="rate3 text-center td-val">
										<div>
											<svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
												<use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use>
											</svg>
										</div>
										<div><?php echo get_field('ratings_average'); ?></div>
									</div>
								</div>
							</div>
						<?php $counter_prod++;
						} ?>
						<button class="btn__details" data-target="table_collection" data-text-open="Показать еще" data-text-hide="Скрыть">
							<span class="btn__details-icon"></span>
							<span class="btn__details-text">Показать еще</span>
						</button>
					</div>
				<?php } ?>

				<?php if ($type == 'creditcard' || $type == 'installmentcard') { ?>
					<div class="code3"><span class="frecom">Финабанк рекомендует!</span>
						<div class="code3head">
							<div class="w30">Предложение</div>
							<div class="text-center">Кредитный<br />лимит</div>
							<div class="text-center">Льготный<br />период</div>
							<div class="text-center">% ставка</div>
							<div class="text-center">Кэшбек</div>
							<div class="text-center">Стоимость</div>
							<div class="text-center">Рейтинг</div>
						</div>
						<?php
						$query = new WP_Query(
							array(
								'posts_per_page' => -1,
								'post_type' => array('bankcard'),
								'post__in' => $allposts_collection,
								'meta_key' => 'ratings_average',
								'orderby' => 'meta_value_num',
								'order' => 'DESC',
								'post_status' => 'publish',
								'meta_query' => array(
									array(
										'key' => 'archive',
										'value'    => '0'
									),
								)
							)
						);

						while ($query->have_posts()) {
							$query->the_post(); ?>
							<div class="code3text">
								<div class="w30 strong td2">
									<a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_table_collection'); return true;">
										<img src="<?php echo get_field('bank_logo', get_field('bank_choise', get_the_ID())); ?>" alt="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Кредитный лимит</div>
									<div class="td-val"><?php echo number_format(get_field('card_cred_limit'), 0, '.', ' '); ?> ₽</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Льготный период</div>
									<div class="td-val">
										<?php
										$field = get_field('card_period');
										$value = $field['value'];
										$label = $field['choices'][$value];
										echo $label;
										?>
									</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">% ставка</div>
									<div class="td-val srok1">От <?php echo get_field('card_stavka'); ?>%</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Кэшбек</div>
									<div class="td-val srok1"><?php echo get_field('card_cashback'); ?></div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Стоимость</div>
									<div class="td-val srok1">От <?php echo get_field('card_cost'); ?> ₽</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Рейтинг</div>
									<div class="rate3 text-center td-val">
										<div>
											<svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
												<use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use>
											</svg>
										</div>
										<div><?php echo get_field('ratings_average'); ?></div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>


				<?php if ($type == 'debetcard') { ?>
					<div class="code3"><span class="frecom">Финабанк рекомендует!</span>
						<div class="code3head">
							<div class="w30">Предложение</div>
							<div class="text-center">Кэшбек</div>
							<div class="text-center">% на остаток</div>
							<div class="text-center">Снятие без %</div>
							<div class="text-center">Овердрафт</div>
							<div class="text-center">Стоимость</div>
							<div class="text-center">Рейтинг</div>
						</div>

						<?php
						$query = new WP_Query(
							array(
								'posts_per_page' => -1,
								'post_type' => array('bankcard'),
								'post__in' => $allposts_collection,
								'meta_key' => 'ratings_average',
								'orderby' => 'meta_value_num',
								'order' => 'DESC',
								'post_status' => 'publish',
								'meta_query' => array(
									array(
										'key' => 'archive',
										'value'    => '0'
										),
									array(
										'key' => 'card_type',
										'value' => 'debetcard',
										'compare' => '='
									),
								)
							)
						);

						while ($query->have_posts()) {
							$query->the_post(); ?>
							<div class="code3text">
								<div class="w30 strong td2">
									<a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_table_collection'); return true;">
										<img src="<?php echo get_field('bank_logo', get_field('bank_choise', get_the_ID())); ?>" alt="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Кэшбек</div>
									<div class="td-val">
										<?php
										$field = get_field('card_cashback');
										$value = $field['value'];
										echo $field['label'];
										?>
									</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">% на остаток</div>
									<div class="td-val">до <?php echo get_field('card_stavka_ostatok'); ?>%</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Снятие без %</div>
									<div class="td-val srok1">до <?php echo number_format(get_field('non_pecent_money'), 0, '.', ' '); ?> ₽</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Овердрафт</div>
									<div class="td-val srok1"><?php echo get_field('card_overdraft'); ?></div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Стоимость</div>
									<div class="td-val srok1"><?php echo get_field('card_cost'); ?> ₽</div>
								</div>
								<div class="td text-center">
									<div class="hidden-lg">Рейтинг</div>
									<div class="rate3 text-center td-val">
										<div>
											<svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
												<use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use>
											</svg>
										</div>
										<div><?php echo get_field('ratings_average'); ?></div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>

		<?php
		$table_collection = ob_get_clean();
		return $table_collection;
	}
