<?php

$data = $args['DATA'];
$ID = $args['ID'];

$about_item = get_field('product_tar', $ID);
$if_in_tab = get_field('if_in_tab', $ID);
$bank_id = get_field('bank_choise', $ID);
$bank_logo = get_field('bank_logo', $bank_id);
$plus_and_minus_tab = get_field('product_plus_minus', $ID);
$tab_details = get_field('tab_details', $ID);
$post_type = get_post_type($ID);
$card_bank_link = get_field('card_bank_link', $ID);

$active_first = $active_three = '';

if ($about_item) {
    $active_first = 'active';
}

if (!$about_item && !$if_in_tab) {
    $active_three = 'active';
}

$title_tab_text = 'О карте';

switch ($post_type) {
    case 'bankcard':
        $title_tab_text = 'О карте';
        break;
    case 'zaimy':
        $title_tab_text = 'О займе';
        break;
    case 'kredity':
        $title_tab_text = 'О кредите';
        break;
}


?>
<div class="new-tab-wrapp">
    <div class="new-tab-content">
        <div class="listing-modal-close">
            <div data-id="<?php echo esc_attr($ID); ?>" data-close="Скрыть" data-open="Подробнее" class="open__dop-btn">
                <div class="listing-modal-close-btn">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 1L1 9M1 1L9 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>

            </div>
        </div>
        <div class="new-tab-head">
            <div class="new-tab-logo">
                <img src="<?php echo $bank_logo ?>">
            </div>
            <div class="colmn">
                <a href="<?php the_permalink($bank_id); ?>"><?php echo get_the_title($bank_id) ?></a>
                <div class="card__rating d-flex align-items-center mr-3">
                    <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                        </svg></div>
                    <?php echo the_field('ratings_average', $bank_id); ?>
                </div>
            </div>
        </div>

        <ul class="tab-list">
            <!-- "О карте", "О микрозайме", "О кредите"-->
            <?php if ($about_item): ?>
                <li class="tab-item <?= $active_first ?>" data-tab="<?= $ID; ?>tab1"><?= $title_tab_text ?></li>
            <?php endif; ?>

            <?php if ($if_in_tab): ?>
                <li class="tab-item" data-tab="<?= $ID; ?>tab2">Условия</li>
            <?php endif; ?>

            <?php if (have_rows('product_tar_2', $ID)): ?>
                <li class="tab-item <?= $active_three ?>" data-tab="<?= $ID; ?>tab3">Требования</li>
            <?php endif; ?>

            <?php if ($tab_details): ?>
                <li class="tab-item" data-tab="<?= $ID; ?>tab5">О банке</li>
            <?php endif; ?>

            <?php if ($plus_and_minus_tab): ?>
                <li class="tab-item" data-tab="<?= $ID; ?>tab4">Преимущества и недостатки</li>
            <?php endif; ?>


        </ul>
        <div class="forline"></div>
        <div class="tab-content">

            <?php if ($about_item): ?>
                <div class="tab-pane <?= $active_first ?>" id="<?= $ID; ?>tab1">
                    <div class="descrip">
                        <p>
                            Сервис осуществляет подбор кредита с учетом ваших финансовых возможностей и желаний. Наши подборки состоят из самых выгодных предложений от банков, микрофинансовых организаций и страховых компаний.
                        </p>
                    </div>

                    <h2>Условия</h2>
                    <div class="tariffs__list">
                        <?php while (have_rows('product_tar', $ID)): the_row();
                            $title = get_sub_field('title');
                            $text = get_sub_field('text');
                        ?>
                            <div class="tariffs__list-item">
                                <div class="row">
                                    <div class="tariffs__list-title col-6"><?php echo $title ?></div>
                                    <div class="tariffs__list-description col-6"><?php echo $text ?></div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($if_in_tab): ?>
                <div class="tab-pane" id="<?= $ID; ?>tab2">
                    <?= $if_in_tab ?>
                </div>
            <?php endif; ?>

            <?php if (have_rows('product_tar', $ID)): ?>
                <div class="tab-pane <?= $active_three ?>" id="<?= $ID; ?>tab3">
                    <div id="tariffs" class="section">
                        <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                            <h2 class="title mb-0">Требования</h2>
                        </div>
                        <div class="tariffs__list">
                            <?php while (have_rows('product_tar_2', $ID)): the_row();
                                $title = get_sub_field('title');
                                $text = get_sub_field('text');
                            ?>
                                <div class="tariffs__list-item">
                                    <div class="row">
                                        <div class="tariffs__list-title col-6"><?php echo $title ?></div>
                                        <div class="tariffs__list-description col-6"><?php echo $text ?></div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($plus_and_minus_tab): ?>
                <div class="tab-pane" id="<?= $ID; ?>tab4">


                    <div class='tabs-table'>
                        <div class="mobile">
                            <div data-class-item="item-plus" class="left active">Преимущества</div>
                            <div data-class-item="item-minus" class="right">Недостатки</div>
                        </div>
                        <div class="content">

                            <?php foreach ($plus_and_minus_tab as $item): ?>

                                <div class="item-wrap">

                                    <?php if ($item['plus']): ?>
                                        <div class="item item-plus show">
                                            <div data-click="0" class="btn__collmore_cat">
                                                <span class="btn__collmore-icon"></span>
                                            </div>
                                            <div><?= $item['plus'] ?></div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($item['minus']): ?>
                                        <div class="item item-minus">
                                            <div data-click="0" class="btn__collmore_cat btn__collmore_visible">
                                                <span class="btn__collmore-icon"></span>
                                            </div>
                                            <div><?= $item['minus'] ?></div>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php endforeach; ?>


                        </div>


                    </div>



                </div>
            <?php endif; ?>

            <?php if (have_rows('tab_details', $ID)): ?>
                <div class="tab-pane <?= $active_three ?>" id="<?= $ID; ?>tab5">
                    <div class="section">
                        <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                            <h2 class="title mb-0">Реквизиты</h2>
                        </div>
                        <div class="tariffs__list">
                            <?php while (have_rows('tab_details', $ID)): the_row();
                                $title = get_sub_field('title');
                                $text = get_sub_field('text');
                            ?>
                                <div class="tariffs__list-item">
                                    <div class="row">
                                        <div class="tariffs__list-title col-6"><?php echo $title ?></div>
                                        <div class="tariffs__list-description col-6"><?php echo $text ?></div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="new-tab-footer">
            <div class="new-tab-footer-close">
                <div data-id="<?php echo esc_attr($ID); ?>" class="open__dop-btn btn btn-outline-primary">Закрыть</div>
            </div>
            <div class="new-tab-footer-btns">
                <?php if ($card_bank_link): ?>
                    <div class="">
                        <a href="<?php echo esc_url($card_bank_link); ?>"
                            target="_blank"
                            onclick="<?php echo esc_js(get_metrika_for_list($card_bank_link)); ?> return true;"
                            class="btn btn-primary btn-block">
                            Оформить
                        </a>
                    </div>
                <?php else: ?>
                    <div class="">
                        <a data-popap-apply-id="<?php echo esc_attr(get_the_ID()); ?>"
                            target="_blank"
                            onclick="<?php echo esc_js(get_metrika_for_list($card_bank_link)); ?> return true;"
                            class="apply_now_btm btn btn-primary btn-block">
                            Оформить 0
                        </a>
                    </div>
                <?php endif; ?>
                <a class="btn__compare <?php echo my_compare_btn($ID); ?> btn btn-outline-primary btn-sm btn-icon d-flex align-items-center justify-content-center" data-id="<?php echo $ID; ?>" data-tax="<?php echo 'creditcard'; ?>">
                    <svg width="13" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 17" xml:space="preserve">
                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#stats" x="0" y="0"></use>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</div>