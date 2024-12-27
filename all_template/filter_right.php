<?php
$cat = isset($args['cat']) ? $args['cat'] : null;
$query = isset($args['query']) ? $args['query'] : null;
$current_id = isset($args['current_id']) ? $args['current_id'] : 0;

if (isset($args['mobile']) && $args['mobile'] == 1) {
    $show_in_mobile = 1; // 1 or 0
} else {
    $just_show = 1;
}

if (isset($just_show) || (isset($show_in_mobile) && $show_in_mobile)):
    $counter_col = 0;
?>
    <div class="filter mt-3 mb-2">
        <div class="h3 pl-3 pt-3"><?= esc_html($cat->name); ?></div>
        <div class="filter__section" id="collist_<?= esc_attr($cat->term_id); ?>">
            <?php while ($query->have_posts()) : $query->the_post();
                $counter_col += 1; ?>
                <a class="filter__btn 
                    <?php if ($counter_col > 4): echo 'coll_li coll__hidden ';
                    endif; ?>
                    <?php if ($current_id == get_the_ID()) echo 'active_post'; ?>"
                    href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
    <?php if ($counter_col > 4): ?>
        <button class="btn__collmore_cat" data-text-open="Показать еще" data-text-hide="Скрыть" data-id="collist_<?= esc_attr($cat->term_id); ?>">
            <span class="btn__collmore-icon"></span>
            <span class="btn__collmore-text">Показать еще</span>
        </button>
    <?php endif; ?>

<?php endif; ?>