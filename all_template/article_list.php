<?php

$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post(); ?>
        <!-- item -->
        <div class="article__item card card__vertical size4 offer h-100">
            <div class="card-container p-3 d-xl-flex flex-xl-column">
                <?php if(get_the_post_thumbnail_url()): ?>
                    <div class="card__image">
                        <img src="<?php echo the_post_thumbnail_url() ?>" alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
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
                        <div class="position-relative card__icon d-flex align-items-center mr-3">
                            <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                            <?php echo comments_number( '0', '1', '%'); ?>
                        </div>
                        <div class="card__like d-flex align-items-center ml-auto">
                            <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
                        </div>
                    </div>
                    <?php $author_id = get_field('page_author');
                    if ($author_id): ?>
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