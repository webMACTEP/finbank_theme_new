<?php /* Template Name: Политика конфиденциальности */ ?>

<?php get_header(); ?>

<main>
	<div class="container">
	    <nav aria-label="breadcrumb" class="horizontal__scroll">
	        <ol class="breadcrumb horizontal__scroll-container">
	            <li class="breadcrumb-item"><a href="<?php echo get_home_url(); ?>">Главная</a></li>
	            <li class="breadcrumb-item active" aria-current="page"><?php echo the_field('shortname') ?></li>
	        </ol>
	    </nav>
	</div>
	<!-- page header -->
	<div class="page__heading mb-4">
	    <div class="container">
	        <h1 class="page__heading-title mb-0"><?php echo the_title() ?></h1>
	        <p class="font-weight-semibold mt-3 mb-0"><?php echo the_field('subtitle') ?></p>
	        <div class="d-flex align-items-center mt-3">
	            <!-- <div class="page__heading-date mr-2 mr-md-4"><?php echo get_the_date( 'd.m.Y', '', '' ); ?></div> -->
	            <div class="d-flex align-items-center">
	                <div class="card__icon d-flex align-items-center mr-3">
	                    <div class="mr-2"><svg width="19" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.5 17.2" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#eye" x="0" y="0"></use></svg></div>
	                    <?php echo get_post_meta( $post->ID, 'views', true ); ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- / page header -->
	<div class="container">
	    <div class="section pt-4">
	        <div class="wysiwyg">
	            <?php echo the_content(); ?>
	        </div>
	    </div>
	</div>
</main>

<?php get_footer(); ?>