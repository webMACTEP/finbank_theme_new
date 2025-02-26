<?php

$data = $args['DATA'];
$ID = $args['ID'];

$about_item = get_field('product_tar', $ID);
$if_in_tab = get_field('if_in_tab', $ID);
//$plus_and_minus_tab = get_field('plus_and_minus_tab', $ID);
$plus_and_minus_tab = get_field('product_plus_minus', $ID);
$post_type = get_post_type($ID);

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
        <div class="my-open__dop-btn">
            <div data-id="<?php echo esc_attr($ID); ?>" data-close="Скрыть" data-open="Подробнее" class="open__dop-btn">
                <div class="open__dop-btn-text">Скрыть</div>
                <div class="navigation__item-arrow">
                    <svg width="12" height="6" viewBox="0 0 12 6">
                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                    </svg>
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

            <?php if ($plus_and_minus_tab): ?>
                <li class="tab-item" data-tab="<?= $ID; ?>tab4">Преимущества и недостатки</li>
            <?php endif; ?>
        </ul>

        <div class="tab-content">

            <?php if ($about_item): ?>
                <div class="tab-pane <?= $active_first ?>" id="<?= $ID; ?>tab1">
                    <div class="descrip">
                        <p>
                            Сервис осуществляет подбор кредита с учетом ваших финансовых возможностей и желаний. Наши подборки состоят из самых выгодных предложений от банков, микрофинансовых организаций и страховых компаний.
                        </p>
                    </div>
                    <!-- <div class="wysiwyg pb-4">
                <?php foreach ($about_item as $item): ?>
                    
                        <h2><?= $item['title'] ?></h2>
                        <?= $item['text'] ?>
                   
                    
                <?php endforeach; ?>
          </div> -->
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
        </div>
    </div>
</div>