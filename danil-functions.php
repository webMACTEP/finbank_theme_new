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

/*
// 1. Перехват запроса к /zaimy-comments-sitemap.xml
add_action('template_redirect', function () {
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (preg_match('#/zaimy-comments-sitemap\.xml$#', $uri)) {
        render_zaimy_comments_sitemap();
    }
});

// 2. Генерация sitemap с пагинацией комментариев для zaimy
function render_zaimy_comments_sitemap()
{
    header('Content-Type: application/xml; charset=' . get_bloginfo('charset'), true);
    echo '<?xml version="1.0" encoding="' . get_bloginfo('charset') . "\"?>\n";
    // Добавляем XSLT-стилизацию как у Yoast SEO
    echo '<?xml-stylesheet type="text/xsl" href="' . esc_url(plugins_url('wordpress-seo/css/main-sitemap.xsl')) . '"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    $args = [
        'post_type'      => 'zaimy',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
    ];
    $posts = get_posts($args);

    foreach ($posts as $post_id) {
        $comments_count = get_comments_number($post_id);
        $comments_per_page = get_option('comments_per_page');
        $pages = max(1, ceil($comments_count / $comments_per_page));

        for ($i = 1; $i <= $pages; $i++) {
            $url = get_permalink($post_id) . 'comments/';
            if ($i > 1) {
                $url .= 'page/' . $i . '/';
            }
            // Убираем возможные анкоры из URL
            $url_parts = wp_parse_url($url);
            $clean_url = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'];
            if (isset($url_parts['query'])) {
                $clean_url .= '?' . $url_parts['query'];
            }
            $lastmod = get_post_modified_time('c', true, $post_id);
            echo "  <url>\n";
            echo "    <loc>" . esc_url($clean_url) . "</loc>\n";
            echo "    <lastmod>{$lastmod}</lastmod>\n";
            echo "  </url>\n";
        }
    }

    echo '</urlset>';
    exit;
}

// 3. Добавить ссылку на этот sitemap в индекс Yoast SEO
add_filter('wpseo_sitemap_index', function ($sitemap_index) {
    $sitemap_index .= "\n<sitemap>\n";
    $sitemap_index .= "<loc>" . esc_url(home_url('/zaimy-comments-sitemap.xml')) . "</loc>\n";
    $sitemap_index .= "<lastmod>" . date('c') . "</lastmod>\n";
    $sitemap_index .= "</sitemap>\n";
    return $sitemap_index;
});
*/