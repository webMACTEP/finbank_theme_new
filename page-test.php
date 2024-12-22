<?php get_header(); ?>


<?php



$tagslist = '';
$tags = get_field('coll-tags');
$ipost = 1;
if (!empty($tags)):
    foreach ($tags as $tag):
        $tagslug = $tag->slug;
        if ($ipost == 1) {
            $tagslist .= $tagslug;
        } else {
            $tagslist .= ",".$tagslug;
        }
        $ipost++;
    endforeach;
endif;
$postsarray = [];
if (!empty($tagslist)) {
    $posts_arg = [
        'posts_per_page'   => -1,
        'post_type' => array('bankcard'),
        'tag' => $tagslist,
        'tax_query' => array(
            array(
                'taxonomy' => 'bankcards',
                'field'    => 'slug',
                'terms'    => 'creditcard',
            ),
        )
    ];

    $posts = get_posts( $posts_arg );
    foreach( $posts as $post ){
        setup_postdata( $post );
        $postsarray[] = $post->ID;
    }
    wp_reset_postdata();
}
//wp_reset_query();
if (get_field('coll-creditcard')) {
    $products = get_field('coll-creditcard');
} else {
    $products = [];
}

$allposts = array_merge($postsarray, $products);

$allpostsjson = json_encode($allposts);

global $allposts_collection;
global $type_collection;
$allposts_collection = $allposts;
$type_collection = 'creditcard';


$allposts = Array
(
    127,
    3099,
    3656,
    3692,
    3683,
    3689,
    1624,
    1855,
    1853,
    1869,
    1628,
    3659,
    4359,
    3703,
    3666,
    3678,
    3700,
    3698,
    1776,
    3685,
    3680,
    3675,
);




$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'post_type' => array('bankcard'),
    'post__in' => $allposts,
    'orderby' => 'name',
    'order' => 'DESC',
    'post_status' => 'publish',
    'paged' => $paged,
    'tax_query' => array(
        array(
            'taxonomy' => 'bankcards',
            'field'    => 'slug',
            'terms'    => 'creditcard',
        ),
    )
);

//$args['meta_query'][] = array(
//    'key' => 'archive',
//    'value' => '0'
//);


print_r2($args);


$counter = 0;
$query = new WP_Query( $args );

if ( $query->have_posts() ) {

    $max_pages = $query->max_num_pages;
    $found_posts = $query->found_posts;

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()):
            $query->the_post();
            $counter++;
            get_template_part('template-parts/filter-cred-card-posts');
        endwhile;


        $posts_html = ob_get_contents();
        ob_end_clean();
    }

}else{
    $posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
}
$GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

?>




<?php

//global $wp_query;
//print_r2($wp_query);

?>



<?php get_footer(); ?>

