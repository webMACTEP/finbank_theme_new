<?php ?>
<?php get_header(); ?>

<main>
   <div class="container">
       <nav aria-label="breadcrumb" class="horizontal__scroll">
           <ol class="breadcrumb horizontal__scroll-container">
               <li class="breadcrumb-item"><a href="<?php echo get_home_url(); ?>">Главная</a></li>
               <li class="breadcrumb-item active" aria-current="page">Калькуляторы</li>
           </ol>
       </nav>
   </div>
   <!-- page header -->
   <div class="page__heading mb-4">
       <div class="container">
           <div class="page__heading-top d-flex pr-0 justify-content-between align-items-center">
               <div>
                   <h1 class="page__heading-title mb-0"><?php echo the_field('calc_title') ?></h1>
                   <h3 class="font-weight-semibold mt-2 mb-0"><?php echo the_field('calc_description') ?></h3>
               </div>
           </div>
       </div>
   </div>
   <!-- / page header -->
   <div class="container">
       <!-- calc page -->
       <div class="calc__page">
           <!-- calc -->
           <div class="section">
               <div class="horizontal__scroll py-3">
                   <div class="horizontal__scroll-container">
                       <a href="<?php echo get_page_link('149') ?>" class="btn calc__page-nav btn-light">Кредитный калькулятор</a>
                       <a href="" class="btn calc__page-nav btn-primary">Калькулятор кэшбэка</a>
                       <a href="<?php echo get_page_link('159') ?>" class="btn calc__page-nav btn-light">Калькулятор займов</a>
                   </div>
               </div>
               <div class="mt-4">
                   <div class="calc" id="calc" data-type="cashbackCalc">
                       <div class="calc__header d-flex justify-content-between align-items-center h3 m-0 p-3 px-md-4 py-md-3">
                           Выберите кэшбэк и укажите ежемесячные расходы
                           <div class="tooltip">
                               <div class="tooltip__trigger">
                                   <svg width="6" height="12" viewBox="0 0 6 12"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#question" width="6" height="12" x="0" y="0"></use></svg>
                               </div>
                               <div class="tooltip__drop">Введите все нужные вам параметры в калькулятори и получите точный ежемесячный платеж с процентной визуализацией выгоды</div>
                           </div>
                       </div>
                       <div class="calc__content p-3 p-md-4">
                           <div class="row align-items-center">
                               <div class="col-12 col-md-3">
                                   <div class="calc__field">
                                       <div class="calc__field-wrap">
                                           <div class="calc__field-label">Вид кэшбэка</div>
                                           <select name="" id="cashbackTypeSelect" class="styledSelect calc__input" placeholder="" data-field="type">
                                               <option value="20000">На всё</option>
                                               <option value="5000">АЗС</option>
                                               <option value="15000">Кафе и Рестораны</option>
                                               <option value="15000">Красота и здоровье</option>
                                               <option value="15000">Одежда и обувь</option>
                                               <option value="50000">Путешествия</option>
                                               <option value="10000">Развлечения</option>
                                               <option value="10000">Такси и каршеринг</option>
                                               <option value="10000">У партнеров</option>
                                           </select>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-12 col-md-3">
                                   <div class="calc__field">
                                       <div class="calc__field-wrap">
                                           <div class="calc__field-label">Ежемесячные расходы</div>
                                           <input type="text" class="range__value form-control calc__input " value="10000" min="0" max="200000" data-field="limit">
                                           <input class="range__input calc__input" name="range1" type="range" min="0" max="200000" value="10000" data-field="limit" style="--range-progress:10%;">
                                       </div>
                                   </div>
                               </div>
                               <div class="col-12 col-md-3">
                                   <div class="calc__field">
                                       <div class="calc__field-wrap">
                                           <div class="calc__field-label">Размер кэшбэка %</div>
                                           <input type="text" class="range__value form-control calc__input " value="1" min="0" max="100" data-field="percent">
                                           <input class="range__input calc__input" name="range1" type="range" min="0" max="100" value="1" data-field="percent" style="--range-progress:1%;">
                                       </div>
                                   </div>
                               </div>
                               <div class="col-12 col-md-3">
                                   <div class="calc__total">
                                       <div class="calc__total-field d-flex justify-content-between align-items-center">
                                           <div class="calc__total-label">Ежемесячные расходы</div>
                                           <div class="calc__value">
                                               <span id="calc__sum" class="calc__value-text">10 000</span>
                                               <span class="calc__value-char">₽</span>
                                           </div>
                                       </div>
                                       <div class="calc__total-field d-flex justify-content-between align-items-center">
                                           <div class="calc__total-label">Суммарный кэшбэк в рублях</div>
                                           <div class="calc__total-value">
                                               <span id="calc__cashbackSum" class="calc__value-text">70 031</span> 
                                               <span class="calc__value-char">₽</span>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <!-- / calc -->
           <!-- faq -->
           <div class="section">
               <div class="section__header d-flex justify-content-between align-items-center">
                   <h2 class="title mb-4">Часто задавемые вопросы</h2>
               </div>
               <!-- accordion -->
               <div class="accordion" id="accordion">
                  <?php if( have_rows('calc_questions') ): 
                     $counter = 0; ?>
                      <?php while( have_rows('calc_questions') ): the_row(); 
                          $question = get_sub_field('question');
                          $answer = get_sub_field('answer');
                          $counter+=1;
                          ?>
                          <div class="accordion__item">
                             <div class="accordion__header">
                                 <button class="accordion__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse__item-<?php echo $counter ?>" aria-expanded="false">
                                     <?php echo $question ?>
                                     <div class="accordion__button-icon"><svg width="12" height="6" viewBox="0 0 12 6"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use></svg></div>
                                 </button>
                             </div>
                             <div id="collapse__item-<?php echo $counter ?>" class="accordion__collapse collapse" data-bs-parent="#accordion">
                                 <div class="accordion__body wysiwyg">
                                     <?php echo $answer ?>
                                 </div>
                             </div>
                         </div>
                      <?php endwhile; ?>
                  <?php endif; ?>
               </div>
               <!-- / accordion -->
           </div>
           <!-- / faq -->
           <!-- best offers -->
           <div class="section">
               <div class="section__header d-flex justify-content-between align-items-center">
                   <h2 class="title mb-4">Лучшие предложения</h2>
               </div>
               <div class="horizontal__scroll">        
                   <div class="horizontal__scroll-container row">
                       <?php 
$args = array(
    'meta_key' => 'ratings_average',
    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
    'order' => 'DESC',
    'post_type' => 'bankcard',
    'tax_query' => array(
        array (
            'taxonomy' => 'bankcards',
            'field' => 'slug',
            'terms' => 'debetcard',
        )
    ),
);
$wp_query = new WP_Query( $args );
$counter = 0; ?>
<?php if ( $wp_query->have_posts() ) { ?>
    <?php while ( $wp_query->have_posts() ) {
        $wp_query->the_post(); 
        $loop_id = get_the_id(); ?>
        <!-- item -->
                   <div class="card card__horizontal bank__item h-100 size4">
                       <div class="card-container p-2">
                           <div class="d-flex">
                               <div class="bank__item-img mr-2">
                                   <img src="<?php $bank_choise_rel = get_field('bank_choise', get_the_ID()) ?>
                                   <?php echo the_field('bank_logo', $bank_choise_rel) ?>"
                                    alt="<?
                                    $logo_id = get_field('bank_logo',$bank_choise_rel , false);
                                    $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                    echo $logo_alt; ?>">
                               </div>
                               <div class="bank__item-content">
                                   <a href="<?php echo the_permalink() ?>" class="card__header-title stretched-link mt-1 mb-2"><?php echo the_title() ?></a>
                                   <div class="card__header-info d-flex align-items-center">
                                       <div class="card__rating d-flex align-items-center mr-3">
                                           <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                                           <?php echo the_field('ratings_average'); ?>
                                       </div>
                                      <div class="position-relative card__icon d-flex align-items-center mr-3">
                                          <div class="mr-2"><a href="<?php the_permalink() ?>#comments" data-target="comments" class="stretched-link"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></a></div>
                                          <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->approved ?>
                                      </div>

                                          <div class="card__like d-flex align-items-center">
                                            <?php echo do_shortcode('[wp_ulike for="post" id="'.$loop_id.'" button_type="image" style="wpulike-heart"]'); ?>
                                           </div>
                                   </div>
                               </div>
                           </div>
                           <div class="bank__item-footer text-center pt-3 pb-2 mx-n2 mt-2">
                               <p>Снятие без % до <?php echo the_field('non_pecent_money') ?> ₽</p>
                               <p>До <?php echo the_field('card_stavka_ostatok') ?> % годовых</p>
                               <p>Тип кешбэка: <?php $field = get_field('card_cashback_type');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?></p>
                               <p>Кешбэк <?php $field = get_field('card_cashback');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?></p>
                           </div>
                       </div>
                   </div>
                   <!-- / item -->
    <?php }
} ?>
<?php wp_reset_query(); ?>
                   </div>
               </div>
           </div>
           <!-- / best offers -->
           <!-- articles -->
           <div class="section">
               <div class="section__header mb-4 d-flex justify-content-between align-items-center">
                   <h2 class="title mb-0">Статьи из блога</h2>
                   <a href="<?php echo get_category_link(32) ?>" class="btn btn-primary btn-sm btn-all">
                       Все
                       <span class="icon ml-2">
                           <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
                       </span>
                   </a>
               </div>
               <div class="horizontal__scroll row">        
                   <div class="horizontal__scroll-container">
                                           <?php 
$args = array(
    'post_type' => 'post',
    'cat' => 32,
    'posts_per_page' => 4,
    'meta_key' => 'views',
    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
    'order' => 'DESC',
);
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post(); ?>
        <!-- item -->
      <div class="article__item card card__vertical size4 offer h-100">
          <div class="card-container p-3 d-xl-flex flex-xl-column">
              <?php if(get_the_post_thumbnail_url()): ?>
              <div class="card__image">
                  <img src="<?php echo the_post_thumbnail_url() ?>"
                       alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);?>">
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
                  <?php if (get_field('page_author')): ?>
                  <?php $author_id = get_field('page_author') ?>
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
                   </div>
               </div>
           </div>
           <!-- / articles -->
           <!-- card reviews -->
        <div class="section">
            <div class="section__header d-flex justify-content-between align-items-center mb-4">
                <h2 class="title mb-0">Отзывы о дебетовых картах</h2>
                <a href="<?php echo  get_page_link(1503); ?>" class="btn btn-primary btn-sm btn-all tax-reviews" data-tax="debetcard">
                    Все
                    <span class="icon ml-2">
                        <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
                    </span>
                </a>
            </div>
            <div class="horizontal__scroll row">
                <div class="horizontal__scroll-container">
                                <?php 

$ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
$custom_offset = 0;

// fetch posts in all those categories
$posts = get_objects_in_term( 7, 'bankcards' );

$sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
 FROM {$wpdb->comments} WHERE
 comment_post_ID in (".implode(',', $posts).") AND comment_approved = 1 AND comment_parent = 0
 ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

$comments_list = $wpdb->get_results( $sql );

if ( count( $comments_list ) > 0 ) {
 foreach ( $comments_list as $comm ) {

 $comment_id = $comm->comment_ID;
 $comment = get_comment($comment_id);
 $comment_post_id = $comment->comment_post_ID; 
 $bank_id = get_field('bank_choise', $comment_post_id); 
 $user = get_userdata( $comment->user_id );

 $user_email = '';
 $user_role = '';
 if (!empty($user)) {
  $user_email = $user->user_email;
  $user_role = $user->roles; 
 }  

 $author = get_comment_author( $comment_id );
 $city = get_comment_meta( $comment_id, 'city', true ); ?>
 <!-- item -->
       <div class="reviews__item">
           <div class="reviews__item-body">    
               <div class="reviews__header d-flex align-items-center mb-2">
                   <div class="reviews__header-logo">
                       <img src="<?php echo the_field('bank_logo', $bank_id) ?>"
                            alt="<?
                            $logo_id = get_field('bank_logo',$bank_id , false);
                            $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                            echo $logo_alt; ?>">
                   </div>
                   <div class="reviews__header-meta ml-3">
                       <a href="<?php echo get_the_permalink($bank_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($bank_id) ?></a>
                       <div class="d-flex">
                           <div class="card__rating d-flex align-items-center mr-3">
                               <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                               <?php echo the_field('ratings_average', $bank_id); ?> 
                           </div>
                           <div class="card__icon d-flex align-items-center">
                               <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                               <?php echo comments_number( '0', '1', '%', $bank_id); ?>
                           </div>
                           <div class="card__date d-none d-md-block ml-auto"><?php echo  get_comment_date( 'd.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
                       </div>
                   </div>
               </div>
               <div class="reviews__item-content">
                   <p><?php echo $comment->comment_content; ?></p>
               </div>
           </div>
           <div class="reviews__item-footer">
               <div class="reviews__author d-flex align-items-center mt-3">
                   <div class="reviews__author-img mr-3">
                       <img src="<?php echo get_avatar_url( $comment, array('size' => 60,
                   'default'=>'identicon',) ); ?>" alt="<?php echo $author; ?>">
                   </div>
                   <div class="reviews__author-content">
                       <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                       <div class="reviews__author-info d-flex">
                           <div class="card__icon d-flex align-items-center mr-3">
                               <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                               <?php if(empty($user_role[0])):
                                    echo 'Гость';
                                else: 
                                    echo $user_role[0]; 
                                endif; ?>
                           </div>
                           <?php if($city != ''): ?>
                           <div class="card__icon d-flex align-items-center">
                               <div class="mr-2"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#pointer" x="0" y="0"></use></svg></div>
                               <?php echo $city ?>
                           </div>
                        <?php endif; ?>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- / item -->
<?php } 
}else{ ?>
<p class="col-12">Пока нет отзывов.</p>
<?php } ?>
                </div>
            </div>
        </div>
        <!-- / card reviews -->
       </div> 
       <!-- / calc page -->
   </div>
</main>

<?php get_footer(); ?>