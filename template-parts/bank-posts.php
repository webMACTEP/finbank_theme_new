<div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-4 query__card">
 <a href="<?php echo the_permalink() ?>" class="card card__horizontal bank__item">
     <div class="card-container p-2">
         <div class="d-flex">
             <div class="bank__item-img mr-2">
                 <img src="<?= get_field('bank_logo'); ?>" alt="<?php the_title(); ?>">
             </div>
             <div class="bank__item-content">
                 <div class="card__header-title mt-1 mb-2"><?php echo the_title() ?></div>
                 <div class="card__header-info d-flex align-items-center">
                     <div class="card__rating d-flex align-items-center mr-3">
                         <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                         <?php echo the_field('ratings_average'); ?>

                     </div>
                      <div class="position-relative card__icon d-flex align-items-center mr-3">
                          <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                          <?php echo comments_number( '0', '1', '%'); ?>
                      </div>
                     <div class="card__header-num bank_num">
                     </div>                                
                 </div>
             </div>
         </div>
     </div>
 </a>
</div>