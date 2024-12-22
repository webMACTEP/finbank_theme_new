<?php
$cat = $args['cat'];
$query = $args['query'];

if(isset($args['mobile']) && $args['mobile'] == 1){
    $show_in_mobile = 1; // 1 or 0
}else{
    $just_show = 1;
}
$counter_col = 0;
if(isset($just_show) || (isset($show_in_mobile) && $show_in_mobile)):
?>

        <div class="accordion__item filter__section temp-filter_popular filter_popular_v1">
            <div class="accordion__header">
                <button class="accordion__button collapsed" >
                    <?= $cat->name; ?>
                    <div class="accordion__button-icon">
                        <svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg">
                            <use xlink:href="https://test.finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use>
                        </svg>
                    </div>
                </button>
            </div>
            <div class="accordion__collapse collapse">
                <div class="accordion__body">
                    <?php while ( $query->have_posts() ) { $query->the_post(); $counter_col+=1; ?>

                        <?php if($counter_col > 4): ?>

                            <div class="dop-box" style="display: none">
                                <a class="filter__btn" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>


                        <?php else: ?>

                            <a class="filter__btn <?php if($counter_col > 4): echo 'coll_li coll__hidden'; endif; ?>
                            <?php if ($current_id == get_the_ID()) echo ' active_post'; ?>"
                               href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                        <?php endif; ?>



                    <?php } ?>
                    <a class="show__siblilings__filter__btn" href="#"> Показать еще </a>
                </div>
            </div>
        </div>


<?php endif; ?>

