<?php ?>
<?php get_header() ?>
	<main term="banks">
		<div class="container">
		    <nav aria-label="breadcrumb" class="horizontal__scroll">
		        <ol class="breadcrumb horizontal__scroll-container">
		            <li class="breadcrumb-item"><a href="<?php echo get_home_url(); ?>">Главная</a></li>
		            <li class="breadcrumb-item active" aria-current="page">Архивные Банки</li>
		        </ol>
		    </nav>
		</div>
		<!-- page header -->
		<div class="page__heading mb-4">
		    <div class="container">
		        <div class="page__heading-top d-flex justify-content-between align-items-center">
		            <div>
		                <h1 class="page__heading-title mb-0">Архивные Банки России</h1>
		            </div>
		            <div class="page__heading-icon"><img src="<?php bloginfo('template_url'); ?>/img/icon__title-shield.png" alt="Архивные Банки России"></div>
		        </div>
		    </div>
		</div>
		<!-- / page header -->
		<div class="page__wrapper">
		    <!-- page nav -->
		    <div id="pageNav" class="page__nav page__nav-scroll">
		        <div class="container">
		            <div class="page__nav-container nav-tabs">
		                <div class="horizontal__scroll">
		                    <div class="horizontal__scroll-container">
		                        <button data-target="bankList" data-parent="pageNav" class="nav-link btn-pageNav active">Все банки</button>
		                        <button data-target="bankReviews" data-parent="pageNav" class="nav-link btn-pageNav">Отзывы</button>
		                        <button data-target="bankRating" data-parent="pageNav" class="nav-link btn-pageNav">Рейтинг</button>
		                        <button data-target="bankNews" data-parent="pageNav" class="nav-link btn-pageNav">Новости</button>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <!-- / page nav -->
		    <div class="container">
		        <!-- bank list -->
		        <div id="bankList" class="section">
		            <div class="bank__list">
		                <div class="row" id="response-cred-card">
<?php 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$max_pages = $wp_query->max_num_pages;
$args = array(
	'post_type' => 'banks',
	//'meta_key' => 'ratings_average',
	'orderby' => array( 'ratings_average' => 'desc', 'name' => 'desc',),
	'order' => 'DESC',
    'meta_key'      => 'archive',
	'meta_value'    => true,	
	'posts_per_page'  => -1,
	'meta_query' => array(
		'relation' => 'OR',
	    array(
	        'key' => 'ratings_average',
	        'compare' => 'EXISTS', //or "NOT EXISTS", for non-existance of this key
	    ),
	    array(
	        'key' => 'ratings_average',
	        'compare' => 'NOT EXISTS', //or "NOT EXISTS", for non-existance of this key
	    ),	    
	)	
);

$wp_query = new WP_Query( $args );

// Цикл
if ( $wp_query->have_posts() ) {
	$counter = 0;
	while ( $wp_query->have_posts() ) {
		$wp_query->the_post();
		$counter +=1;
		?>
		<div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-4 query__card">
         <a href="<?php echo the_permalink() ?>" class="card card__horizontal bank__item">
             <div class="card-container p-2">
                 <div class="d-flex">
                     <div class="bank__item-img mr-2">
                         <img src="<?php echo the_field('bank_logo') ?>" alt="">
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
                                 №<?php echo $counter ?>
                             </div>                                
                         </div>
                     </div>
                 </div>
             </div>
         </a>
     </div>
		<?php
	}
} ?>
</div>
<!-- pagination -->
<!--div class="pagination flex-column">
	<?php if($paged < $max_pages): ?>
        <button class="btn btn-outline-gray btn-block load_more_btn"
         data-max_pages="<?php echo $max_pages ?>" data-paged="<?php echo $paged ?>">
      		Больше решений
   		</button>
     <?php endif; ?>
  <div class="pagination__container d-sm-flex justify-content-between align-items-center">
      <div class="pagination__description mt-4 mt-sm-0">
          Показано <span class="count_view"><?php echo $counter ?></span> продукта из 
          <span class="count_all"><?php echo $wp_query->found_posts;?></span>
      </div>
  </div>
</div-->
<!-- / pagination -->
<?php wp_reset_query(); ?>
		            </div>
		        </div>
		        <!-- / bank list -->
		        <!-- reviews -->
		        <div id="bankReviews" class="section">
		            <div class="section__header mb-3 d-flex justify-content-between align-items-end align-items-md-center">
		                <h2 class="title mb-0">Отзывы</h2>
		                <a href="<?php echo get_page_link(4971); //1503 ?>" 
		                	class="btn btn-primary btn-sm btn-all  reviews-link-main" data-tax="banks">
		                    Все
		                    <span class="icon ml-1 ml-md-2">
		                        <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path></svg>
		                    </span>
		                </a>
		            </div>
		            <div class="tabs">
		                <div class="horizontal__scroll">
		                    <ul class="nav nav-tabs horizontal__scroll-container row mb-4 reviews-tabs" role="tablist">
		                        <li class="nav-item">
		                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#mainReviews4" aria-selected="false" data-tax="banks">Банки</button>
		                        </li>
		                        <li class="nav-item">
		                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainReviews5" aria-selected="false" data-tax="kredity">Кредиты</button>
		                        </li>		                        		                    	
		                        <li class="nav-item">
		                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainReviews1" aria-selected="true"
		                            data-tax="creditcard">Кредитные карты</button>
		                        </li>
		                        <li class="nav-item">
		                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainReviews2" aria-selected="false" data-tax="debetcard">Дебетовые карты</button>
		                        </li>
		                        <li class="nav-item">
		                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mainReviews3" aria-selected="false" data-tax="installmentcard">Карты рассрочки</button>
		                        </li>
		                    </ul>
		                </div>
		            </div>
		            <div class="tab-content">
		                <div class="tab-pane" id="mainReviews1">
		                    <div class="horizontal__scroll row">
		                        <div class="horizontal__scroll-container">
		                            <?php 
$ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
$custom_offset = 0;

// fetch posts in all those categories
$posts = get_objects_in_term( 2, 'bankcards' );

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
 $user_email = $user->user_email;
 $author = get_comment_author( $comment_id );
 $user_role = $user->roles; 
 $city = get_comment_meta( $comment_id, 'city', true ); ?>
 <!-- item -->
       <div class="reviews__item">
           <div class="reviews__item-body">    
               <div class="reviews__header d-flex align-items-center mb-2">
                   <div class="reviews__header-logo"><img src="<?php echo the_field('bank_logo', $bank_id) ?>" alt=""></div>
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
               <div class="reviews__item-content position-relative">
				<a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h5 mb-2 stretched-link"><?php echo get_the_title($comment_post_id) ?></a>               	
                   <p><?php echo $comment->comment_content; ?></p>
               </div>
           </div>
           <div class="reviews__item-footer">
               <div class="reviews__author d-flex align-items-center mt-3">
                   <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url( $comment, array('size' => 60,
                   'default'=>'identicon',) ); ?>" alt="<?php echo $author; ?>"></div>
                   <div class="reviews__author-content">
                       <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                       <div class="reviews__author-info d-flex">
                           <div class="card__icon d-flex align-items-center mr-3">
                               <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                               <?php if($user_role[0] == ''):
                                	echo 'Гость';
                                endif; 
                                if($user_role[0] != ''):
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
		                <div class="tab-pane" id="mainReviews2">
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
 $user_email = $user->user_email;
 $author = get_comment_author( $comment_id );
 $user_role = $user->roles; 
 $city = get_comment_meta( $comment_id, 'city', true ); ?>
 <!-- item -->
       <div class="reviews__item">
           <div class="reviews__item-body">    
               <div class="reviews__header d-flex align-items-center mb-2">
                   <div class="reviews__header-logo"><img src="<?php echo the_field('bank_logo', $bank_id) ?>" alt=""></div>
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
               <div class="reviews__item-content position-relative">
				<a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h5 mb-2 stretched-link"><?php echo get_the_title($comment_post_id) ?></a>               	
                   <p><?php echo $comment->comment_content; ?></p>
               </div>
           </div>
           <div class="reviews__item-footer">
               <div class="reviews__author d-flex align-items-center mt-3">
                   <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url( $comment, array('size' => 60,
                   'default'=>'identicon',) ); ?>" alt="<?php echo $author; ?>"></div>
                   <div class="reviews__author-content">
                       <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                       <div class="reviews__author-info d-flex">
                           <div class="card__icon d-flex align-items-center mr-3">
                               <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                               <?php if($user_role[0] == ''):
                                	echo 'Гость';
                                endif; 
                                if($user_role[0] != ''):
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
		                <div class="tab-pane" id="mainReviews3">
		                    <div class="horizontal__scroll row">
		                        <div class="horizontal__scroll-container">
		                            <?php 

$ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
$custom_offset = 0;
$posts = get_objects_in_term( 8, 'bankcards' );
// fetch posts in all those categories
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
 $user_email = $user->user_email;
 $author = get_comment_author( $comment_id );
 $user_role = $user->roles; 
 $city = get_comment_meta( $comment_id, 'city', true ); ?>
 <!-- item -->
       <div class="reviews__item">
           <div class="reviews__item-body">    
               <div class="reviews__header d-flex align-items-center mb-2">
                   <div class="reviews__header-logo"><img src="<?php echo the_field('bank_logo', $bank_id) ?>" alt=""></div>
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
               <div class="reviews__item-content position-relative">
				<a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h5 mb-2 stretched-link"><?php echo get_the_title($comment_post_id) ?></a>               	
                   <p><?php echo $comment->comment_content; ?></p>
               </div>
           </div>
           <div class="reviews__item-footer">
               <div class="reviews__author d-flex align-items-center mt-3">
                   <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url( $comment, array('size' => 60,
                   'default'=>'identicon',) ); ?>" alt="<?php echo $author; ?>"></div>
                   <div class="reviews__author-content">
                       <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                       <div class="reviews__author-info d-flex">
                           <div class="card__icon d-flex align-items-center mr-3">
                               <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                               <?php if($user_role[0] == ''):
                                	echo 'Гость';
                                endif; 
                                if($user_role[0] != ''):
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
		                <div class="tab-pane active" id="mainReviews4">
		                    <div class="horizontal__scroll row">
		                        <div class="horizontal__scroll-container">
<?php 
$ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
$custom_offset = 0;

// fetch posts in all those categories
$posts = get_cpt_ids('banks');

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
 $user = get_userdata( $comment->user_id );
 $user_email = $user->user_email;
 $author = get_comment_author( $comment_id );
 $user_role = $user->roles; 
 $city = get_comment_meta( $comment_id, 'city', true ); ?>
 <!-- item -->
       <div class="reviews__item">
           <div class="reviews__item-body">    
               <div class="reviews__header d-flex align-items-center mb-2">
                   <div class="reviews__header-logo"><img src="<?php echo the_field('bank_logo', $comment_post_id) ?>" alt=""></div>
                   <div class="reviews__header-meta ml-3">
                       <a href="<?php echo get_the_permalink($comment_post_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($comment_post_id) ?></a>
                       <div class="d-flex">
                           <div class="card__rating d-flex align-items-center mr-3">
                               <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use></svg></div>
                               <?php echo the_field('ratings_average', $comment_post_id); ?> 
                           </div>
                           <div class="card__icon d-flex align-items-center">
                               <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use></svg></div>
                               <?php echo comments_number( '0', '1', '%', $comment_post_id); ?>
                           </div>
                           <div class="card__date d-none d-md-block ml-auto"><?php echo  get_comment_date( 'd.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
                       </div>
                   </div>
               </div>
               <div class="reviews__item-content position-relative">
				<a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h5 mb-2 stretched-link"><?php echo get_the_title($comment_post_id) ?></a>               	
                   <p><?php echo $comment->comment_content; ?></p>
               </div>
           </div>
           <div class="reviews__item-footer">
               <div class="reviews__author d-flex align-items-center mt-3">
                   <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url( $comment, array('size' => 60,
                   'default'=>'identicon',) ); ?>" alt="<?php echo $author; ?>"></div>
                   <div class="reviews__author-content">
                       <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                       <div class="reviews__author-info d-flex">
                           <div class="card__icon d-flex align-items-center mr-3">
                               <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                               <?php if($user_role[0] == ''):
                                	echo 'Гость';
                                endif; 
                                if($user_role[0] != ''):
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
		                <div class="tab-pane" id="mainReviews5">
		                    <div class="horizontal__scroll row">
		                        <div class="horizontal__scroll-container">
<?php 
$ppp = 3; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
$custom_offset = 0;

// fetch posts in all those categories
$posts = get_cpt_ids('kredity');

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
 $bank_id = get_field('product_bank', $comment_post_id);
 $user = get_userdata( $comment->user_id );
 $user_email = $user->user_email;
 $author = get_comment_author( $comment_id );
 $user_role = $user->roles; 
 $city = get_comment_meta( $comment_id, 'city', true ); ?>
 <!-- item -->
       <div class="reviews__item">
           <div class="reviews__item-body">    
               <div class="reviews__header d-flex align-items-center mb-2">
                   <div class="reviews__header-logo"><img src="<?php echo the_field('bank_logo', $bank_id) ?>" alt=""></div>
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
               <div class="reviews__item-content position-relative">
				<a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h5 mb-2 stretched-link"><?php echo get_the_title($comment_post_id) ?></a>               	
                   <p><?php echo $comment->comment_content; ?></p>
               </div>
           </div>
           <div class="reviews__item-footer">
               <div class="reviews__author d-flex align-items-center mt-3">
                   <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url( $comment, array('size' => 60,
                   'default'=>'identicon',) ); ?>" alt="<?php echo $author; ?>"></div>
                   <div class="reviews__author-content">
                       <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                       <div class="reviews__author-info d-flex">
                           <div class="card__icon d-flex align-items-center mr-3">
                               <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                               <?php if($user_role[0] == ''):
                                    echo 'Гость';
                                endif; 
                                if($user_role[0] != ''):
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
		            </div>
		        </div>
		        <!-- / reviews -->
		        <!-- rating -->
		        <div id="bankRating" class="section">
		            <div class="section__header">
		                <h2 class="title">Рейтинг банков</h2>
		            </div>
		            <div class="bank__list-rating">
		                <div class="table__component mb-3">
		                    <table id="ratingTable">
		                        <thead>
		                            <tr>
		                                <th>№</th>
		                                <th>Банк</th>
		                                <th>Почта</th>
		                                <th>Номер</th>
		                                <th>Сайт</th>
		                                <th>Рейтинг</th>
		                            </tr>
		                        </thead>
		                        <tbody>
<?php 
$args1 = array(
	'posts_per_page' => 6,
	'post_type' => 'banks',
	'meta_key' => 'ratings_average',
	'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc',),
	'order' => 'DESC'
);

$banks_table = new WP_Query( $args1 );
if ( $banks_table->have_posts() ) : ?>
    <!-- цикл -->
    <?php $counter_banks = 0; ?>
    <?php while ( $banks_table->have_posts() ) : $banks_table->the_post(); $counter_banks+=1; ?>
        <tr  class="<?php if($counter_banks >3): echo 'tr__hidden'; endif; ?>">
		      <td class="td__num td__min"><?php echo $counter_banks ?></td>
		                                <td>
		                                    <a href="<?php the_permalink(); ?>" class="bank__link d-flex align-items-center">
		                                        <span class="bank__link-img">
		                                            <img src="<?php echo the_field('bank_logo') ?>" alt="<?php the_title() ?>">
		                                        </span>
		                                        <span class="bank__link-title"><?php the_title() ?></span>
		                                    </a>
		                                </td>
		                                <td class="td__leaders">
		                                    <div class="table__title d-md-none">Почта</div>
		                                    <div class="table__value"><a href="mailto:<?php the_field('bank_e_mail_long') ?>"><?php echo the_field('bank_e_mail_long') ?></a></div>
		                                </td>
		                                <td class="td__leaders">
		                                    <div class="table__title d-md-none">Номер</div>
		                                    <div class="table__value"><a href="tel:<?= preg_replace('![^0-9]+!', '', get_field('bank_phone')); ?>"><?php echo the_field('bank_phone') ?></a></div>
		                                </td>
		                                <td class="td__leaders">
		                                    <div class="table__title d-md-none">Сайт</div>
		                                    <div class="table__value"><a href="https://<?php the_field('bank_email') ?>" target="_blank"><?php echo the_field('bank_email') ?></a></div>
		                                </td>
		                                <td class="td__leaders td__min">
		                                    <div class="table__title d-md-none">Рейтинг</div>
		                                    <div class="table__value">
		                                        <div class="rating d-flex align-items-center" style="pointer-events: none;">
		                                            <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
		                                        </div>
		                                    </div>
		                                </td>
		                            </tr>
    <?php endwhile; ?>
    <!-- конец цикла -->
    <?php wp_reset_postdata(); //очищаем результат запроса?>
<?php endif; ?>
		                        </tbody>
		                    </table>
		                </div>
		                <button class="btn__details" data-target="ratingTable" data-text-open="Показать еще" data-text-hide="Скрыть">
		                    <span class="btn__details-icon"></span>
		                    <span class="btn__details-text">Показать еще</span>
		                </button>
		            </div>
		        </div>
		        <!-- / rating -->
		        <!-- bank news -->
		        <div id="bankNews" class="section">
		            <div class="section__header">
		                <h2 class="title">Подборка новостей</h2>
		            </div>
		            <div class="horizontal__scroll">
		                <div class="horizontal__scroll-container row">
<?php 
$args = array(
    //'post_type' => 'post',
    //'cat' => 10, //19
    //'posts_per_page' => 4,

    'posts_per_page' => 4,
    'post_type' => 'post',
    'meta_key' => 'views',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',

//    'meta_key' => 'views',
//    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
//    'order' => 'DESC',
);
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post(); ?>
        <!-- item -->
	        <div class="article__item card card__vertical size4 offer h-100">
	            <div class="card-container h-100 p-3">
	                <div class="news__item-body d-xl-flex flex-xl-column">
	                    <div class="card__image">
	                        <img src="<?php echo the_post_thumbnail_url() ?>" alt="">
	                    </div>
	                    <div class="card__date my-2"><?php echo get_the_date('d.m.y') ?></div>
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
	                             <?php echo do_shortcode('[wp_ulike button_type="image" style="wpulike-heart"]'); ?>
	                        </div>
	                    </div>
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
		        <!-- / bank news -->
		    </div>
		</div>
		<div class="container">
		    <div class="section">
		        <!-- text -->
		        <div class="wysiwyg">
		            <?php echo the_field('banks_tetx', 'option'); ?>
		        </div>
		        <!-- / text -->
		    </div>
		</div>
	</main>
<?php get_footer() ?>