<?php


define( 'RATINGS_IMG_EXT', apply_filters( 'wp_postratings_image_extension', 'gif' ) );
//echo 'Danil';
global $wp_query;
//print_r2($wp_query);
//if(!$wp_query->have_posts()) {
//    status_header(404);
//    nocache_headers();
//    include( get_404_template() );
//    exit;
//}


function  get_clear_url($url = '')
{
    $url_new = explode('/', $url);
    $pageIndex = array_search('page', $url_new); // 3
    $url_arr = array_slice($url_new, 0, $pageIndex);
    $url_clear = implode('/', $url_arr);
    return $url_clear . '/';
}

