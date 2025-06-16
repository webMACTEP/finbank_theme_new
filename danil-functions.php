<?php


define('RATINGS_IMG_EXT', apply_filters('wp_postratings_image_extension', 'gif'));
//echo 'Danil';
//global $wp_query;
//print_r2($wp_query);
//if(!$wp_query->have_posts()) {
//    status_header(404);
//    nocache_headers();
//    include( get_404_template() );
//    exit;
//}


/**
 * Очищает URL от пагинации /page/N/ (и любых query-строк),
 * возвращая путь с завершающим слешем.
 *
 * @param  string $url Полный или относительный URL.
 * @return string      Очищённый URL.
 */
function get_clear_url(string $url = ''): string
{
    // Отделяем чистый путь от query-строки
    $path = parse_url($url, PHP_URL_PATH);

    // Убираем '/page/число/' в конце (если есть)
    $path = preg_replace('#/page/\d+/?$#i', '/', $path);

    // Гарантируем завершающий слеш
    if (substr($path, -1) !== '/') {
        $path .= '/';
    }

    return $path;
}
