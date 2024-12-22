
<div class="col-12 col-md-6 mb-4">
    <div class="article__item card card__vertical offer h-100">
        <div class="card-container h-100 p-3">
            <div class="news__item-body d-xl-flex flex-xl-column">
                <div class="card__image">
                    <img src="<?php echo the_post_thumbnail_url() ?>" alt="">
                </div>
                <div class="card__date my-2"><?php echo get_the_date('d.m.y'); ?></div>
                <a href="<?php echo the_permalink() ?>" class="article__title h4 stretched-link"><?php echo the_title() ?></a>
                <div class="d-flex align-items-center mt-auto pt-2">
                    <div class="card__icon d-flex align-items-center mr-3">
                        <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
                        <?php echo the_field('views') ?>
                    </div>
                  <div class="position-relative card__icon d-flex align-items-center mr-3">
                      <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                      <?php echo comments_number( '0', '1', '%'); ?>
                  </div>
                    <div class="card__like d-flex align-items-center ml-auto">
                        <?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_id().' button_type="image" style="wpulike-heart"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

