<?php
$type = $args['type'];

$filter_price = get_filter_price();

?>

<?php if($type == 'creditcard'):?>

    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-1">
        <div class="range">
            <div class="d-flex justify-content-between">
                <div class="range__label">Кредитный лимит, ₽</div>
                <input max="<?= $filter_price['install_inputs_range']['max']; ?>"  type="text" class="range__value cred_limit" min="0">
            </div>
            <input max="<?= $filter_price['install_inputs_range']['max']; ?>"  class="range__input" name="cred_limit" type="range" min="0" >
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-2">
        <div class="range">
            <div class="d-flex justify-content-between">
                <div class="range__label">Льготный период, дней</div>
                <input max="<?= $filter_price['install_inputs_range']['day_max']; ?>"  type="text" class="range__value cred_trat" value="" min="0">
            </div>
            <input max="<?= $filter_price['install_inputs_range']['day_max']; ?>"  class="range__input" name="cred_day_period" type="range" min="0" value="">
        </div>
    </div>

    <div id="filter__details" class="col-12 collapse show mt-md-4 order-4 order-md-5">
        <div class="row pb-3 pb-md-0">

            <div class="col-12 col-md-4 banks_select">
                <label class="form-label" for="bankSelect">Банки</label>
                <select name="kreditbank" id="bankSelect" class="styledSelect" placeholder="">
                    <option value="">Любой</option>
                    <?php
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'banks',
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
                <label class="form-label" for="bankTop">Категория карты</label>
                <select name="kred_purpose" id="bankTop" class="styledSelect" placeholder="">
                    <option value="">Любая</option>
                    <?php
                    $field = get_field_object('card_category', 95);
                    //$value = $field['value'];
                    //$label = $field['choices'][ $value ];
                    if(!empty($field['choices'])): ?>
                        <?php foreach( $field['choices'] as $value => $label ): ?>
                            <option value="<?php echo $value ?>"><?php echo $label ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>
            </div>

            <div class="col-12 col-md-4 grace_period_select">
                <label class="form-label" for="gracePeriod">Категория заемщика</label>
                <select name="cat_zaim" id="gracePeriod" class="styledSelect" placeholder="">
                    <option value="">Любой</option>
                    <option value="grc20">до 100 дней</option>
                    <option value="grc30">от 100 до 200 дней</option>
                    <option value="grc40">более 200 дней</option>
                </select>
            </div>

        </div>
    </div>

<?php endif; ?>


<?php if($type == 'debetcard' || $type == 'debatcard'):?>



    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-1">
        <div class="range">
            <div class="d-flex justify-content-between">
                <div class="range__label">Снятие без %, ₽</div>
                <input max="<?= $filter_price['debet_inputs_range']['max']; ?>"  type="text" class="range__value cred_limit" min="0">
            </div>
            <input max="<?= $filter_price['debet_inputs_range']['max']; ?>"  class="range__input" name="percent_limit" type="range" min="0" >
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-2">
        <div class="range">
            <div class="d-flex justify-content-between">
                <div class="range__label">Кэшбек, %</div>
                <input max="<?= $filter_price['debet_inputs_range']['day_max']; ?>"  type="text" class="range__value cred_trat" value="0" min="0">
            </div>
            <input max="<?= $filter_price['debet_inputs_range']['day_max']; ?>"  class="range__input" name="cashback_number" type="range" min="0" value="0">
        </div>
    </div>

    <div id="filter__details" class="col-12 collapse show mt-md-4 order-4 order-md-5">
        <div class="row pb-3 pb-md-0">

            <div class="col-12 col-md-4 banks_select">
                <label class="form-label" for="bankSelect">Банки</label>
                <select name="kreditbank" id="bankSelect" class="styledSelect" placeholder="">
                    <option value="">Любой</option>
                    <?php
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'banks',
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
                <label class="form-label" for="bankTop">Категория карты</label>
                <select name="kred_purpose" id="bankTop" class="styledSelect" placeholder="">
                    <option value="">Любая</option>
                    <?php
                    $field = get_field_object('card_category', 95);
                    //$value = $field['value'];
                    //$label = $field['choices'][ $value ];
                    if(!empty($field['choices'])): ?>
                        <?php foreach( $field['choices'] as $value => $label ): ?>
                            <option value="<?php echo $value ?>"><?php echo $label ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>
            </div>

            <div class="col-12 col-md-4 grace_period_select">
                <label class="form-label" for="gracePeriod">Кэшбек</label>
                <select name="cashback" id="gracePeriod" class="styledSelect" placeholder="">
                    <option value="">Любой</option>
                    <?php
                    $field = get_field_object('card_cashback', 167);
                    //$value = $field['value'];
                    //$label = $field['choices'][ $value ];
                    if( !empty($field['choices']) ): ?>
                        <?php foreach( $field['choices'] as $value => $label ): ?>
                            <option value="<?php echo $value ?>"><?php echo $label ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

        </div>
    </div>

<?php endif; ?>


<?php if($type == 'installmentcard'):?>


    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-1">
        <div class="range">
            <div class="d-flex justify-content-between">
                <div class="range__label">Кредитный лимит, ₽</div>
                <input max="<?= $filter_price['install_inputs_range']['max']; ?>"  type="text" class="range__value cred_limit" min="0">
            </div>
            <input max="<?= $filter_price['install_inputs_range']['max']; ?>"  class="range__input" name="cred_limit" type="range" min="0" >
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-2">
        <div class="range">
            <div class="d-flex justify-content-between">
                <div class="range__label">Льготный период, дней</div>
                <input max="<?= $filter_price['install_inputs_range']['day_max']; ?>"  type="text" class="range__value cred_trat" value="" min="0">
            </div>
            <input max="<?= $filter_price['install_inputs_range']['day_max']; ?>"  class="range__input" name="cred_day_period" type="range" min="0" value="">
        </div>
    </div>

    <div id="filter__details" class="col-12 collapse show mt-md-4 order-4 order-md-5">
        <div class="row pb-3 pb-md-0">

            <div class="col-12 col-md-4 banks_select">
                <label class="form-label" for="bankSelect">Банки</label>
                <select name="kreditbank" id="bankSelect" class="styledSelect" placeholder="">
                    <option value="">Любой</option>
                    <?php
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'banks',
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
                <label class="form-label" for="bankTop">Категория карты</label>
                <select name="kred_purpose" id="bankTop" class="styledSelect" placeholder="">
                    <option value="">Любая</option>
                    <?php
                    $field = get_field_object('card_category', 95);
                    //$value = $field['value'];
                    //$label = $field['choices'][ $value ];
                    if(!empty($field['choices'])): ?>
                        <?php foreach( $field['choices'] as $value => $label ): ?>
                            <option value="<?php echo $value ?>"><?php echo $label ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>
            </div>

            <div class="col-12 col-md-4 grace_period_select">
                <label class="form-label" for="gracePeriod">Категория заемщика</label>
                <select name="cat_zaim" id="gracePeriod" class="styledSelect" placeholder="">
                    <option value="">Любой</option>
                    <option value="grc20">до 100 дней</option>
                    <option value="grc30">от 100 до 200 дней</option>
                    <option value="grc40">более 200 дней</option>
                </select>
            </div>

        </div>
    </div>




<?php endif; ?>


<?php if($type == 'kredity'):?>

    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-1">
        <div class="range">
            <div class="d-flex justify-content-between">
                <div class="range__label">Сумма, ₽</div>
                <input max="<?= $filter_price['kredity_inputs_range']['max']; ?>"  type="text" class="range__value cred_limit" value="<?//php echo $summ_limit ?>" min="0">
            </div>
            <input max="<?= $filter_price['kredity_inputs_range']['max']; ?>"  class="range__input" name="summ_limit" type="range" min="0" value="<?//php echo $summ_limit ?>">
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-2">
        <div class="range">
            <div class="d-flex justify-content-between">
                <div class="range__label">Срок, месяцев</div>
                <input max="<?= $filter_price['kredity_inputs_range']['day_max']; ?>"  type="text" class="range__value cred_trat" value="<?//php echo $cred_summ_period ?>" min="0">
            </div>
            <input max="<?= $filter_price['kredity_inputs_range']['day_max']; ?>"  class="range__input" name="cred_summ_period" type="range" min="0" value="<?//php echo $cred_summ_period ?>">
        </div>
    </div>

    <div id="filter__details" class="col-12 collapse show mt-md-4 order-4 order-md-5">
        <div class="row pb-3 pb-md-0">

            <div class="col-12 col-md-4 banks_select">
                <label class="form-label" for="bankSelect">Банки</label>
                <select name="kreditbank" id="bankSelect" class="styledSelect" placeholder="">
                    <option value="">Любой</option>
                    <?php
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'banks',
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
                    if(!empty($field['choices'])): ?>
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
                    if(!empty($field['choices'])): ?>
                        <?php foreach( $field['choices'] as $value => $label ): ?>
                            <option value="<?php echo $value ?>"><?php echo $label ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

        </div>
    </div>

<?php endif; ?>



<?php if($type == 'zaimy'):?>

    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-1">
        <div class="range">
            <div class="d-flex justify-content-between">
                <div class="range__label">Сумма, ₽</div>
                <input max="<?= $filter_price['zaimy_inputs_range']['max']; ?>"  type="text" class="range__value cred_limit" min="0">
            </div>
            <input max="<?= $filter_price['zaimy_inputs_range']['max']; ?>"  class="range__input" name="z_sum" type="range" min="0" >
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-2">
        <div class="range">
            <div class="d-flex justify-content-between">
                <div class="range__label">Срок, дней</div>
                <input max="<?= $filter_price['zaimy_inputs_range']['day_max']; ?>"  type="text" class="range__value cred_trat" value="<?//php echo $cred_summ_period ?>" min="0">
            </div>
            <input max="<?= $filter_price['zaimy_inputs_range']['day_max']; ?>"  class="range__input" name="z_time" type="range" min="0" value="<?//php echo $cred_summ_period ?>">
        </div>
    </div>



<?php endif; ?>





