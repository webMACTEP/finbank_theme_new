<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package finbank_theme
 */

get_header();
global $wp_query;
?>

	<main>
		<div class="section">
		    <div class="article__searchResult">
		        <div class="article__searchResult-header">
		            <div class="container">
		                <h1 class="article__searchResult-title"><?php printf( esc_html__( 'Результаты поиска “%s', 'finbank_theme' ), '<span>' . get_search_query() . '</span>”' ); ?></h1>

		                <p class="article__searchResult-total">Найдено результатов <?php echo $wp_query->found_posts; ?></p>
		            </div>
		        </div>
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post(); ?>
				<div class="article__searchResult-item">
		            <div class="container">
		                <a href="<?php echo the_permalink() ?>" class="article__searchResult-link"><span><?php echo the_title(); ?></span></a>
		                <p class="article__searchResult-description"><?php echo the_excerpt_max_charlength_search(135) ?></p>
		            </div>
		        </div>
			<?php endwhile;
		endif;
		?>
		        <div class="article__searchResult-pag">
		            <div class="container">
		                <div class="pagination__container mt-0 d-sm-flex justify-content-between align-items-center">
		                    <div class="pagination__links flex-wrap">
		                    	<style>
		                    		.next{
		                    			display: none!important;
		                    		}
		                    		.prev{
		                    			display: none!important;
		                    		}
		                    	</style>
		                        <?php my_pagination(); ?>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</main>

<?php
get_footer('blog');
