
<?php


add_action('init', 'start_session', 1);

function start_session() {
	if(!session_id()) {
		session_start();
	}
}

add_action('wp_logout', 'end_session');
add_action('wp_login', 'end_session');
add_action('end_session_action', 'end_session');

function end_session() {
	session_destroy();
}

function print_r2($item) {
    echo '<pre>';
    print_r($item);
    echo '</pre>';
}






/**
 * finbank_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package finbank_theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

require_once __DIR__ . '/inc/codes_v1.php';
require_once __DIR__ . '/inc/codes_v2.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function finbank_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on finbank_theme, use a find and replace
		* to change 'finbank_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'finbank_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'finbank_theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'finbank_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'finbank_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function finbank_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'finbank_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'finbank_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function finbank_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'finbank_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'finbank_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'finbank_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function finbank_theme_scripts() {

    wp_enqueue_style( 'finbank_theme-style', get_stylesheet_uri(), array(), _S_VERSION );

    wp_enqueue_style( 'style',  get_template_directory_uri() .'/css/style.css');

    wp_enqueue_style( 'custom',  get_template_directory_uri() .'/css/custom.css', array(), '2.0.0');

    //Для шорткодов
    wp_enqueue_style( 'codes',  get_template_directory_uri() .'/css/codes.css?v=1');
    //Для шорткодов
    wp_enqueue_style( 'fancybox',  get_template_directory_uri() .'/css/fancybox.css?v=1');


    // если поставить defer или async то пиздец..
    wp_register_script('main-script', get_template_directory_uri() . '/js/test.js', array(), 14, [
            //'strategy' => 'defer'
    ]);




    wp_register_script('fancy-script', get_template_directory_uri() . '/js/fancybox.umd.js?v=1', [], false, [
        //'strategy' => 'async'
    ]);

    wp_register_script('fslightbox', get_template_directory_uri() . '/js/fslightbox_pro.js?v=2', [], false, [
        //'strategy' => 'async'
    ]);

    wp_enqueue_script('fancy-script');
    wp_enqueue_script('jquery');
    wp_enqueue_script('fslightbox');
    //wp_enqueue_script('image_script'); его вообще нету
    wp_enqueue_script('main-script');
}
add_action( 'wp_enqueue_scripts', 'finbank_theme_scripts' );

function style_loader_tag_filter_preload_custom($html, $handle) {
    if($handle === 'style' || $handle === 'custom') {
        $new_html = str_replace("text/css", "text/css", $html);
        return str_replace("rel='stylesheet'", "rel='preload' as='style' onload='this.onload=null;this.rel=\"stylesheet\"'  ", $new_html);
    }
    return $html;
}

add_filter('style_loader_tag', 'style_loader_tag_filter_preload_custom', 10, 2);


if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Настройки страниц',
		'menu_title'	=> 'Настройки страниц',
		'menu_slug' 	=> 'theme-contacts-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


// Регистрация менюшек

register_nav_menus(array(
    'kred_left' => ('Шапка кредиты левый блок'),
    'kred_right' => ('Шапка кредиты правый блок'),
    'card_left' => ('Шапка карты левый блок'),
    'card_center' => ('Шапка карты центральный блок'),
    'card_right' => ('Шапка карты правый блок'),
    'zaim_left' => ('Шапка займы левый блок'),
    'zaim_right' => ('Шапка займы правый блок'),
    'blog_block' => ('Шапка журнал'),
    'calc' => ('Шапка калькуляторы'),
    'more' => ('Шапка еще...'),
    'footer_menu' => ('Main pages footer'),
	'sidebar_menu_debetcard' => ('Меню в сайдбаре дебетовых карт'),
	'sidebar_menu_installmentcard' => ('Меню в сайдбаре карт рассрочки'),
	'sidebar_menu_creditcard' => ('Меню в сайдбаре кредитных карт'),
	'sidebar_menu_kredity' => ('Меню в сайдбаре кредитов'),
	'sidebar_menu_zaimy' => ('Меню в сайдбаре займов')
    ));

// function remove_wp_nav_menu_ul($menu){
//    return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#', '#^<li[^>]*>#', '#</li>$#' ), '', $menu );
// }
// add_filter( 'wp_nav_menu', 'remove_wp_nav_menu_ul' );

function cmswp_add_async_attribute($tag, $handle) {
   // Перечисляем название скриптов через запятую
   $scripts_to_async = array('cld-frontend-js');

   foreach($scripts_to_async as $async_script) {
      if ($async_script === $handle) {
         return str_replace(' src', ' async="async" src', $tag);
      }
   }
   return $tag;
}
add_filter('script_loader_tag', 'cmswp_add_async_attribute', 10, 2);


function add_menu_link_class( $atts, $item, $args ) {
  if (property_exists($args, 'link_class')) {
    $atts['class'] = $args->link_class;
  }
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

function add_menu_list_item_class($classes, $item, $args) {
  if (property_exists($args, 'list_item_class')) {
      $classes[] = $args->list_item_class;
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);

function the_excerpt_max_charlength( $charlength ){
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = preg_split('//', $subex, -1, PREG_SPLIT_NO_EMPTY);
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '... <span class="article__one-description-readmore">Продолжить читать</span>';
	} else {
		echo $excerpt;
	}
}
function the_excerpt_max_charlength_search( $charlength ){
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = preg_split('//', $subex, -1, PREG_SPLIT_NO_EMPTY);
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}

// Массив id кастомного типа записей
function get_cpt_ids( $post_type ){
	$args = array(
    'post_type'      => $post_type,
    'post_status'    => 'publish',
    'posts_per_page' => - 1,
);
$ids = array();
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        array_push($ids, get_the_id() );
    }
}

wp_reset_postdata();
return $ids;
}




function get_cpt2_ids( $id, $post_type ){
	$args = array(
    'post_type'      => $post_type,
    'post_status'    => 'publish',
    'posts_per_page' => - 1,
);
$args['meta_query'] = array('relation' => 'OR');
$args['meta_query'][] = array(
            'key' => 'bank_choise',
            'value' => $id,
            'compare' => 'LIKE',
        );
$args['meta_query'][] = array(
            'key' => 'product_bank',
            'value' => $id,
            'compare' => 'LIKE',
        );

$ids = array();
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        array_push($ids, get_the_id() );
    }
}

wp_reset_postdata();
return $ids;
}


// Массив id кастомного типа записей
function get_poducts_ids( $id, $tax, $term_ids){
$args = array(
    'post_type'             => array('bankcard', 'kredity'),
    'posts_per_page'        => -1,
    'meta_key' => 'ratings_average',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => $tax,
            'terms' => $term_ids
        )
    )
);
$args['meta_query'] = array('relation' => 'OR');
$args['meta_query'][] = array(
            'key' => 'bank_choise',
            'value' => $id,
            'compare' => 'LIKE',
        );
$args['meta_query'][] = array(
            'key' => 'product_bank',
            'value' => $id,
            'compare' => 'LIKE',
        );
$ids = array();
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        array_push($ids, get_the_id() );
    }
}

wp_reset_postdata();
return $ids;
}


// Cчетчик просмотров
function kama_postviews( $args = [] ){
	global $user_ID, $post, $wpdb;

	if( ! $post || ! is_singular() )
		return;

	$rg = (object) wp_parse_args( $args, [
		// Ключ мета поля поста, куда будет записываться количество просмотров.
		'meta_key' => 'views',
		// Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированных пользователей.
		'who_count' => 1,
		// Исключить ботов, роботов? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.
		'exclude_bots' => true,
	] );

	$do_count = false;
	switch( $rg->who_count ){

		case 0:
			$do_count = true;
			break;
		case 1:
			if( ! $user_ID )
				$do_count = true;
			break;
		case 2:
			if( $user_ID )
				$do_count = true;
			break;
	}

	if( $do_count && $rg->exclude_bots ){

		$notbot = 'Mozilla|Opera'; // Chrome|Safari|Firefox|Netscape - все равны Mozilla
		$bot = 'Bot/|robot|Slurp/|yahoo';
		if(
			! preg_match( "/$notbot/i", $_SERVER['HTTP_USER_AGENT'] ) ||
			preg_match( "~$bot~i", $_SERVER['HTTP_USER_AGENT'] )
		){
			$do_count = false;
		}

	}

	if( $do_count ){

		$up = $wpdb->query( $wpdb->prepare(
			"UPDATE $wpdb->postmeta SET meta_value = (meta_value+1) WHERE post_id = %d AND meta_key = %s",
			$post->ID, $rg->meta_key
		) );

		if( ! $up )
			add_post_meta( $post->ID, $rg->meta_key, 1, true );

		wp_cache_delete( $post->ID, 'post_meta' );
	}

}
// Конец счетчика просмотров


// Регистрация типов записей
add_action( 'init', 'true_register_post_type_init' ); // Использовать функцию только внутри хука init

function true_register_post_type_init() {

/*Банки*/
	$labels5 = array(
		'name' => 'Банки',
		'singular_name' => 'Банки', // админ панель Добавить->Функцию
		'add_new' => 'Добавить банк',
		'add_new_item' => 'Добавить новый банк', // заголовок тега <title>
		'edit_item' => 'Редактировать банк',
		'new_item' => 'Новый банк',
		'all_items' => 'Все банки',
		'view_item' => 'Просмотр банк на сайте',
		'search_items' => 'Искать банк',
		'not_found' =>  'Банк не найден.',
		'not_found_in_trash' => 'В корзине нет банков.',
		'menu_name' => 'Банки' // ссылка в меню в админке
	);
	$args5 = array(
		'labels' => $labels5,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true,
		'menu_icon' => 'dashicons-screenoptions', // иконка в меню
		'menu_position' => 20, // порядок в меню
		'show_tagcloud' => true,
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail', 'page-attributes'),
		//'taxonomies' => array(  )
	);
	register_post_type('banks', $args5);


	$labels = array(
		'name' => 'Короткие займы',
		'singular_name' => 'Короткие займы', // админ панель Добавить->Функцию
		'add_new' => 'Добавить займ',
		'add_new_item' => 'Добавить новый займ', // заголовок тега <title>
		'edit_item' => 'Редактировать займ',
		'new_item' => 'Новый займ',
		'all_items' => 'Все займы',
		'view_item' => 'Просмотр займа на сайте',
		'search_items' => 'Искать займ',
		'not_found' =>  'Займ не найден.',
		'not_found_in_trash' => 'В корзине нет займов.',
		'menu_name' => 'Короткие займы' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true,
		'menu_icon' => 'dashicons-star-empty', // иконка в меню
		'menu_position' => 21, // порядок в меню
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail'),
		'taxonomies' => array( 'post_tag' )
	);
	register_post_type('zaimy', $args);

	$labels2 = array(
		'name' => 'Кредиты',
		'singular_name' => 'Кредиты', // админ панель Добавить->Функцию
		'add_new' => 'Добавить кредит',
		'add_new_item' => 'Добавить новый кредит', // заголовок тега <title>
		'edit_item' => 'Редактировать кредит',
		'new_item' => 'Новый кредит',
		'all_items' => 'Все кредиты',
		'view_item' => 'Просмотр кредита на сайте',
		'search_items' => 'Искать кредит',
		'not_found' =>  'Кредит не найден.',
		'not_found_in_trash' => 'В корзине нет кредитов.',
		'menu_name' => 'Кредиты' // ссылка в меню в админке
	);
	$args2 = array(
		'labels' => $labels2,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true,
		'menu_icon' => 'dashicons-star-empty', // иконка в меню
		'menu_position' => 22, // порядок в меню
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail'),
		'taxonomies' => array( 'post_tag' )
	);
	register_post_type('kredity', $args2);


register_taxonomy('bankcards', array('bankcard'), array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'Тип карты',
			'singular_name'     => 'Тип карты',
			'search_items'      => 'Искать тип карты',
			'all_items'         => 'Все типы карт',
			'view_item '        => 'Просмотреть тип карты',
			'parent_item'       => 'Parent тип карты',
			'parent_item_colon' => 'Parent тип карты:',
			'edit_item'         => 'Ред. тип карты',
			'update_item'       => 'Обновить тип карты',
			'add_new_item'      => 'Добавить новый тип карты',
			'new_item_name'     => 'Имя нового типа карты',
			'menu_name'         => 'Тип карты',
		),
		'description'           => '', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_menu'          => true, // равен аргументу show_ui
		'show_tagcloud'         => true, // равен аргументу show_ui
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		'hierarchical'          => true,

		//'update_count_callback' => '_update_post_term_count',
		//'rewrite'               => true,
		'rewrite'               => array('slug'=>'bankcard', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false, 'pages'=>false),
		//'query_var'             => true, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	) );

	$labels3 = array(
		'name' => 'Банковские карты',
		'singular_name' => 'Банковские карты', // админ панель Добавить->Функцию
		'add_new' => 'Добавить карту',
		'add_new_item' => 'Добавить новую карту', // заголовок тега <title>
		'edit_item' => 'Редактировать карту',
		'new_item' => 'Новая карта',
		'all_items' => 'Все карты',
		'view_item' => 'Просмотр карты на сайте',
		'search_items' => 'Искать карту',
		'not_found' =>  'Карта не найден.',
		'not_found_in_trash' => 'В корзине нет карт.',
		'menu_name' => 'Банковские карты' // ссылка в меню в админке
	);
	$args3 = array(
		'labels' => $labels3,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true,
		'menu_icon' => 'dashicons-star-empty', // иконка в меню
		'menu_position' => 23, // порядок в меню
		'hierarchical'        => false,
		'rewrite'             => array( 'slug'=>'bankcard/%bankcards%', 'with_front'=>false, 'pages'=>true, 'feeds'=>false, 'feed'=>false ),
		//'rewrite'             => array( 'with_front'=>false, 'pages'=>true, 'feeds'=>false, 'feed'=>false ),
		'taxonomies'          => array( 'bankcards', 'post_tag'),
		'has_archive'         => 'bankcard',
		//'has_archive'         => true,
		//'query_var' => true,
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail')

	);
	register_post_type('bankcard', $args3);


/*Авторы*/
	$labels4 = array(
		'name' => 'Редакция',
		'singular_name' => 'Редакция', // админ панель Добавить->Функцию
		'add_new' => 'Добавить автора',
		'add_new_item' => 'Добавить нового автора', // заголовок тега <title>
		'edit_item' => 'Редактировать автора',
		'new_item' => 'Новый автор',
		'all_items' => 'Все авторы',
		'view_item' => 'Просмотр автора на сайте',
		'search_items' => 'Искать автора',
		'not_found' =>  'Автор не найден.',
		'not_found_in_trash' => 'В корзине нет авторов.',
		'menu_name' => 'Редакция' // ссылка в меню в админке
	);
	$args4 = array(
		'labels' => $labels4,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true,
		'menu_icon' => 'dashicons-universal-access', // иконка в меню
		'menu_position' => 24, // порядок в меню
		'show_tagcloud' => true,
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail'),
		//'taxonomies' => array(  )
	);
	register_post_type('team', $args4);

    /* Подборки */
	$labels6 = array(
		'name' => 'Подборки',
		'singular_name' => 'Подборка', // админ панель Добавить->Функцию
		'add_new' => 'Добавить подборку',
		'add_new_item' => 'Добавить новую подборку', // заголовок тега <title>
		'edit_item' => 'Редактировать подборку',
		'new_item' => 'Новая подборка',
		'all_items' => 'Все подборки',
		'view_item' => 'Просмотр подборку на сайте',
		'search_items' => 'Искать подборку',
		'not_found' =>  'Подборка не найдена.',
		'not_found_in_trash' => 'В корзине нет подборок.',
		'menu_name' => 'Подборка' // ссылка в меню в админке
	);
	$args6 = array(
		'labels' => $labels6,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true,
		'menu_icon' => 'dashicons-universal-access', // иконка в меню
		'menu_position' => 24, // порядок в меню
		'show_tagcloud' => true,
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail'),
		//'taxonomies'  => array( 'category' )
	);
	register_post_type('collection', $args6);

     /* Формы заявок */
	$labels7 = array(
		'name' => 'Формы заявок',
		'singular_name' => 'Заявка', // админ панель Добавить->Функцию
		'add_new' => 'Добавить заявку',
		'add_new_item' => 'Добавить новую заявку', // заголовок тега <title>
		'edit_item' => 'Редактировать заявку',
		'new_item' => 'Новая заявку',
		'all_items' => 'Все заявки',
		'view_item' => 'Просмотр заявку на сайте',
		'search_items' => 'Искать заявку',
		'not_found' =>  'Заявка не найдена.',
		'not_found_in_trash' => 'В корзине нет заявок.',
		'menu_name' => 'Формы заявок' // ссылка в меню в админке
	);
	$args7 = array(
		'labels' => $labels7,
		'public' => false,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true,
		'menu_icon' => 'dashicons-universal-access', // иконка в меню
		'menu_position' => 24, // порядок в меню
		'show_tagcloud' => true,
        'show_in_rest'  => true,
		'supports' => array( 'title', 'phone', 'url', 'email',  'text'),
        'taxonomies'          => array( 'forms_taxonomy',),
		//'taxonomies'  => array( 'category' ) comments author thumbnail editor

	);
	register_post_type('forms', $args7);

}

function tags_category_taxonomy() {

   register_taxonomy(
        'forms_taxonomy',
        'forms',
        array(
            'label' => __( 'Категория формы' ),
            //'rewrite' => array( 'slug' => 'tags-category' ),
            'hierarchical' => false,
            'show_ui'       => true,
            'query_var'     => true,
            'show_admin_column' => true,
        )
    );

    register_taxonomy(
        'tags-category',
        'collection',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'tags-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'tags_category_taxonomy' );

// Конец регистрации новых типов записей


	add_filter('post_type_link', 'bankcard_permalink', 1, 2);

	function bankcard_permalink( $permalink, $post ){
		// выходим если это не наш тип записи: без холдера %products%
		if( strpos($permalink, '%bankcards%') === false )
			return $permalink;

		// Получаем элементы таксы
		$terms = get_the_terms($post, 'bankcards');
		// если есть элемент заменим холдер
		if( ! is_wp_error($terms) && !empty($terms) && is_object($terms[0]) )
			$term_slug = array_pop($terms)->slug;
		// элемента нет, а должен быть...
		else
			$term_slug = 'no-bankcards';

		return str_replace('%bankcards%', $term_slug, $permalink );
	}



function wp_corenavi() {
  global $wp_query;
  $total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
  $a['total'] = $total;
  $a['mid_size'] = 3; // сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 1; // сколько ссылок показывать в начале и в конце
  $a['prev_text'] = '&laquo;'; // текст ссылки "Предыдущая страница"
  $a['next_text'] = '&raquo;'; // текст ссылки "Следующая страница"

  if ( $total > 1 ) echo '<nav class="pagination">';
  echo paginate_links( $a );
  if ( $total > 1 ) echo '</nav>';
}

function custom_rating_image_extension() {
    return 'svg';
}
add_filter( 'wp_postratings_image_extension', 'custom_rating_image_extension' );



function remove_page_from_query_string($query_string)
{
    if (!empty($query_string['name']) && $query_string['name'] == 'page' && isset($query_string['page'])) {
        unset($query_string['name']);
        $query_string['paged'] = $query_string['page'];
    }
    return $query_string;
}
add_filter('request', 'remove_page_from_query_string');


add_filter( 'upload_mimes', 'svg_upload_allow' );

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	// WP 5.1 +
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	}
	else {
		$dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
	}

	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if( $dosvg ){

		// разрешим
		if( current_user_can('manage_options') ){

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		// запретим
		else {
			$data['ext']  = false;
			$data['type'] = false;
		}

	}

	return $data;
}



function my_pagination($total = '', $currentPage = '')
{


    global $wp_query;

    if($currentPage == ''){
        if (is_front_page()) {
            $currentPage = (get_query_var("page")) ? get_query_var("page") : 1;
        } else {
            $currentPage = (get_query_var("paged")) ? get_query_var("paged") : 1;
        }

        $currentPage = max(1, $currentPage);
    }


    if($total == ''){
        $total = $wp_query->max_num_pages;
    }else{

        $wp_query->max_num_pages = $total;

    }



    $pagination = paginate_links([
        "base"      => str_replace(999999999, "%#%", get_pagenum_link(999999999)),
        "format"    => "",
        "current"   => $currentPage,
        "total"     => $total,
        "type"      => "plain",
        "prev_text" => 'Назад',
        "next_text" => 'Вперед',
    ]);

    if($currentPage > $total){
        $url_clear = get_clear_url($_SERVER['REQUEST_URI']);
        wp_redirect( $url_clear, 301 );
    }



    // ВОТ ТУТ УБИРАЕМ ссылку на 1 страницу, т.к серавно будет редирект
    $pagination = preg_replace( '~page/1/?([\'"])~', '\1', $pagination );


    $pagination = str_replace("page-numbers", "pagination__links-item", $pagination);
    $pagination = str_replace("prev", "pagination__links-first", $pagination);


    //$pagination = preg_replace( '~/page/1/?([\'"])~', '', $pagination );
    echo $pagination = str_replace("next", "pagination__links-last", $pagination);

}

function team_pagination()
{
    global $wp_query;

	$currentPage = (get_query_var("page")) ? get_query_var("page") : 1;

    $pagination = paginate_links([
        "base"      => str_replace(999999999, "%#%", get_pagenum_link(999999999)),
        "format"    => "",
        "current"   => max(1, $currentPage),
        "total"     => $wp_query->max_num_pages,
        "type"      => "plain",
        "prev_text" => 'Назад',
        "next_text" => 'Вперед',
    ]);
    //echo str_replace("page-numbers", "pagination__links-item", $pagination);
    $pagination = str_replace("page-numbers", "pagination__links-item", $pagination);
    $pagination = str_replace("prev", "pagination__links-first", $pagination);
    echo $pagination = str_replace("next", "pagination__links-last", $pagination);
}

// add_filter( 'category_link', function($a){
// 	return str_replace( 'category/', '', $a );
// }, 99 );

add_filter('redirect_canonical','pif_disable_redirect_canonical');

function pif_disable_redirect_canonical($redirect_url) {
    if ('team' == get_post_type()) $redirect_url = false;
	return $redirect_url;
}


// отключим редирект в записях потому что при /page/2 редиректит на /
add_filter( 'redirect_canonical', 'page_disable_redirect_canonical' );

function page_disable_redirect_canonical( $redirect_url ){

	if( is_paged() ){
		$redirect_url = false;
	}

	return $redirect_url;
}


## отключим редирект в записях потому что при /page/2 редиректит на /
//add_filter('redirect_canonical', 'page_disable_redirect_canonical');
//function page_disable_redirect_canonical( $redirect_url ){
//	if( is_page() ) $redirect_url = false;
//
//	return $redirect_url;
//}
//




add_action( 'wp_enqueue_scripts', 'card_script_and_styles');

function card_script_and_styles() {
	// absolutely need it, because we will get $wp_query->query_vars and $wp_query->max_num_pages from it.
	global $wp_query;


    wp_register_script(
        'slider',
        get_template_directory_uri() . '/js/tiny-slider.js',

        array() ,
        '2.9.2',
        array(
                'strategy' => 'defer'
            ),
     );

    //wp_register_script(
    //    'tiny_slider', get_template_directory_uri() . '/js/tinyslider.min.js',
    //    array() ,
    //    '2.9.2',
    //    array(
    //            'strategy' => 'async'
    //        ),
    // );


 wp_register_script(
    'input_mask',
        get_template_directory_uri() . '/js/jquery.inputmask.min.js',
            array() ,
            '5.0.5',
            array(
                'strategy' => 'defer'
            ),
     );




	// when you use wp_localize_script(), do not enqueue the target script immediately
	wp_register_script( 'card_scripts', get_template_directory_uri() . '/js/custom-script.js', array() , 2 ,
	array(
                'strategy' => 'defer'
        ),
        );


    wp_register_script( 'roman', get_template_directory_uri() . '/js/roman-script.js', array() , 2 ,
    array(
                'strategy' => 'defer'
        ),
        );




    	wp_register_script( 'danil', get_template_directory_uri() . '/js/danil-script.js', array() , 2 ,
	array(
                'strategy' => 'defer'
        ),
        );

	//wp_register_script( 'card_scripts', get_template_directory_uri() . '/js/custom-script.js', array() , rand(500, 2000) );


	// wp_register_script( 'validate',
   // get_template_directory_uri() . '/js/validate.min.js',
   // array() ,
   //'1.20.0',
   //    array(
   //             'strategy' => 'async'
   //     ),
   //  );
   //
   // wp_register_script(
   // 'input_mask',
   //     get_template_directory_uri() . '/js/inputmask.min.js',
   //         array() ,
   //         '5.0.5',
   //         array(
   //             'strategy' => 'async'
   //         ),
   //  );

    wp_register_script( 'validate',
    get_template_directory_uri() . '/js/jquery.validate.min.js',
    array() ,
   '1.20.0',
       array(
                'strategy' => 'defer'
        ),
     );





	// passing parameters here
	// actually the <script> tag will be created and the object "card_loadmore_params" will be inside it
	wp_localize_script( 'card_scripts', 'card_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
		'max_page' => $wp_query->max_num_pages
	) );
    wp_enqueue_script( 'input_mask' );
      wp_enqueue_script( 'validate' );
    wp_enqueue_script( 'slider' );
 	wp_enqueue_script( 'card_scripts' );
    wp_enqueue_script( 'roman' );
    wp_enqueue_script( 'danil' );



}


add_action('wp_ajax_loadmorebutton', 'card_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmorebutton', 'card_loadmore_ajax_handler');

function card_loadmore_ajax_handler(){

	// prepare our arguments for the query
	$params = json_decode( stripslashes( $_POST['query'] ), true ); // query_posts() takes care of the necessary sanitization
	$params['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$params['post_status'] = 'publish';
	$params['meta_key'] = $_POST['order'];
	$term = $_POST['term'];

    $view_template = null;
    if(isset($_POST['view_template'])){
        $view_template = $_POST['view_template'];
        $view_type = $_POST['view_type'];
    }

	//$params['orderby'] = array( 'meta_value_num' => 'desc', 'name' => 'desc' );

	if($term != "banks"){

        $params['orderby'] = array( 'meta_value_num' => 'desc', 'name' => 'desc' );
        $params['meta_query'][] = array(
            'key' => 'archive',
            'value' => '0'
        );

	}


	if($term == "banks"):
		//$params['meta_key'] = 'ratings_average';
		//$params['orderby'] = array( 'meta_value_num' => 'desc', 'name' => 'desc' );
		$params['orderby'] = array( 'ratings_average' => 'desc', 'name' => 'desc' );
		$params['order'] = 'DESC';

        $params['meta_query'] = array(
            'relation' => 'OR',
            array(
                'key' => 'ratings_average',
                'compare' => 'EXISTS', //or "NOT EXISTS", for non-existance of this key
            ),
            array(
                'key' => 'ratings_average',
                'compare' => 'NOT EXISTS', //or "NOT EXISTS", for non-existance of this key
            ),
        );


	endif;


    //$params['meta_query'][] = array(
    //    'key' => 'archive',
    //    'value' => '0'
    //);

	$params['post__not_in'] = array($_POST['exclude_post'],);
	// it is always better to use WP_Query but not here
	query_posts( $params );

	if( have_posts() ) :

		// run the loop
		while( have_posts() ): the_post();

			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme

			if($view_template){
                  get_template_part( 'template-parts/new-filter-bank-offers' , false , ['view_type' => $view_type]);
			}else{
                if($term == 'creditcard'):
                get_template_part( 'template-parts/filter-cred-card-posts' );
                endif;
                if($term == 'installmentcard'):
                get_template_part( 'template-parts/filter-cred-card-posts' );
                endif;
                if($term == 'article'):
                get_template_part( 'template-parts/cat-articles' );
                endif;
                if($term == 'debetcard'):
                get_template_part( 'template-parts/filter-debet-card-posts' );
                endif;
                if($term == 'banks'):
                get_template_part( 'template-parts/bank-posts' );
                endif;
                if($term == 'kredity'):
                get_template_part( 'template-parts/filter-kredity-posts' );
                endif;
                if($term == 'zaimy'):
                get_template_part( 'template-parts/filter-zaimy-posts' );
                endif;
                if($term == 'collection'):
                get_template_part( 'template-parts/collection-posts' );
                endif;
			}


			// for the test purposes comment the line above and uncomment the below one
			// the_title();
		endwhile;
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}



add_action('wp_ajax_cardfilter', 'card_filter_function');
add_action('wp_ajax_nopriv_cardfilter', 'card_filter_function');

function card_filter_function(){
	$term = $_POST['term'];
	$order = $_POST['order'];

    if($_POST['order_type']){
        $order_type = $_POST['order_type'];
    }else{
        $order_type = 'DESC';
    }

	$postarr = !empty($_POST['postarr']) ? json_decode( $_POST['postarr'], true ) : false;
	//$postarr = json_decode( $_POST['postarr'], true );


	if($term == 'creditcard' || $term == 'installmentcard' || $term == 'debetcard'):
		//$credLimit = !empty($_POST['cred_limit']) ? json_decode( $_POST['cred_limit'] ):false;
		//$cashback_number = !empty($_POST['cashback_number']) ? json_decode( $_POST['cashback_number'] ):false;
		//$percent_limit = !empty($_POST['percent_limit']) ? json_decode( $_POST['percent_limit'] ):false;
		//$cred_day_period = !empty($_POST['cred_day_period']) ? json_decode( $_POST['cred_day_period'] ):false;
		//$bank =  !empty($_POST['bank']) ? json_decode( $_POST['bank'] ):false;
		//$cat_cards = !empty($_POST['cat_cards']) ? $_POST['cat_cards']: false;
		//$gracePeriodSelect = !empty($_POST['period']) ? $_POST['period']: false;
		//$cashback = !empty($_POST['cashback']) ? $_POST['cashback'] : false;




        //$credLimit = !empty($_POST['cred_limit']) ? json_decode( $_POST['cred_limit'] ):false;
		//$cashback_number = !empty($_POST['cashback_number']) ? json_decode( $_POST['cashback_number'] ):false;
		//$percent_limit = !empty($_POST['percent_limit']) ? json_decode( $_POST['percent_limit'] ):false;
		//$cred_day_period = !empty($_POST['cred_day_period']) ? json_decode( $_POST['cred_day_period'] ): false;
		//$bank =  !empty($_POST['bank']) ? json_decode( $_POST['bank'] ): json_decode( null);


        //print_r2($_POST);
        //die;

        if(in_array( 'cashback_number', $_POST)){
            $cashback_number = json_decode( $_POST['cashback_number'] );
        }

        if(in_array( 'percent_limit', $_POST)){
            $percent_limit = json_decode( $_POST['percent_limit'] );
        }

        if(in_array( 'cashback', $_POST)){
           	$cashback = $_POST['cashback'];
        }


		$credLimit = json_decode( $_POST['cred_limit'] );
		$cred_day_period = json_decode( $_POST['cred_day_period'] );
		$bank = json_decode( $_POST['bank'] );

		$cat_cards = $_POST['cat_cards'];
		$gracePeriodSelect = $_POST['period'];




		$ps1 = !empty($_POST['ps1'])?$_POST['ps1']:'';
		$ps2 = !empty($_POST['ps2'])?$_POST['ps2']:'';
		$ps3 = !empty($_POST['ps3'])?$_POST['ps3']:'';
		$ps4 = !empty($_POST['ps4'])?$_POST['ps4']:'';
		$ps5 = !empty($_POST['ps5'])?$_POST['ps5']:'';
		$os1 = !empty($_POST['os1'])?$_POST['os1']:'';
		$os2 = !empty($_POST['os2'])?$_POST['os2']:'';
		$os3 = !empty($_POST['os3'])?$_POST['os3']:'';
		$os4 = !empty($_POST['os4'])?$_POST['os4']:'';
		$os5 = !empty($_POST['os5'])?$_POST['os5']:'';
		$os6 = !empty($_POST['os6'])?$_POST['os6']:'';
		$os7 = !empty($_POST['os7'])?$_POST['os7']:'';
		$os8 = !empty($_POST['os8'])?$_POST['os8']:'';
		$cdt1 = !empty($_POST['cdt1'])?$_POST['cdt1']:'';
		$cdt2 = !empty($_POST['cdt2'])?$_POST['cdt2']:'';
		$cdt3 = !empty($_POST['cdt3'])?$_POST['cdt3']:'';
		$cdt4 = !empty($_POST['cdt4'])?$_POST['cdt4']:'';
		if(isset( $order ) && $order != '' )
		$args = array(
			'meta_key' => $order,
			'orderby' => array( 'meta_value_num' => 'desc', 'title' => 'desc' ),
			//'orderby' => 'meta_value_num title',
			//'order' => 'DESC',
			'post_type' => 'bankcard',
			'post_status' => 'publish',
			'tax_query' => array(
	        array (
	            'taxonomy' => 'bankcards',
	            'field' => 'slug',
	            'terms' => $term,
	        )
	    ),
		);

		if( $order == '' )
            $args = array(
                'orderby' => 'name',
                'order' => $order_type,
                'post_type' => 'bankcard',
                'post_status' => 'publish',
                'tax_query' => array(
                array (
                    'taxonomy' => 'bankcards',
                    'field' => 'slug',
                    'terms' => $term,
                )
            ),
		);

	if ($postarr) $args['post__in'] = $postarr;
	endif;


	if($term == 'kredity'):
	$summ_limit = json_decode( $_POST['summ_limit'] );
	$cred_summ_period = json_decode( $_POST['cred_summ_period'] );
	$kreditbank = json_decode( $_POST['kreditbank'] );
	$kred_purpose = $_POST['kred_purpose'];
	$cat_zaim = $_POST['cat_zaim'];
	$cgt1 = !empty($_POST['cgt1'])?$_POST['cgt1']:'';
	$cgt2 = !empty($_POST['cgt2'])?$_POST['cgt2']:'';
	$cgt3 = !empty($_POST['cgt1'])?$_POST['cgt3']:'';
	$cgt4 = !empty($_POST['cgt4'])?$_POST['cgt4']:'';
	$cgt5 = !empty($_POST['cgt5'])?$_POST['cgt5']:'';
	$kos1 = !empty($_POST['kos1'])?$_POST['kos1']:'';
	$kos2 = !empty($_POST['kos2'])?$_POST['kos2']:'';
	$kos3 = !empty($_POST['kos3'])?$_POST['kos3']:'';
	$kos4 = !empty($_POST['kos4'])?$_POST['kos4']:'';
	$kos5 = !empty($_POST['kos5'])?$_POST['kos5']:'';
	$kos6 = !empty($_POST['kos6'])?$_POST['kos6']:'';
	$kos7 = !empty($_POST['kos7'])?$_POST['kos7']:'';
	$kos8 = !empty($_POST['kos8'])?$_POST['kos8']:'';
	$kos9 = !empty($_POST['kos9'])?$_POST['kos9']:'';
	$kos10 = !empty($_POST['kos10'])?$_POST['kos10']:'';


	//if(isset( $order  ) && $order != '' )
	if(!empty($order)):

		$args = array(
			'meta_key' => $order,
			//'orderby' => array( 'meta_value_num' => 'desc', 'title' => 'desc' ),
			'orderby' => 'meta_value_num',
			'post_status' => 'publish',
			'order' => $order_type,
			'post_type' => 'kredity',
		);

	else :
		$args = array(
			'orderby' => 'name',
			'post_status' => 'publish',
			'order' => $order_type,
			'post_type' => 'kredity',
		);
	endif;

	if ($postarr) $args['post__in'] = $postarr;
	endif;

	if($term == 'zaimy'):
	$z_sum = json_decode( $_POST['z_sum'] );
	$z_time = json_decode( $_POST['z_time'] );
	$oz1 = !empty($_POST['oz1'])?$_POST['oz1']:'';
	$oz2 = !empty($_POST['oz2'])?$_POST['oz2']:'';
	$oz3 = !empty($_POST['oz3'])?$_POST['oz3']:'';
	$oz4 = !empty($_POST['oz4'])?$_POST['oz4']:'';
	$oz5 = !empty($_POST['oz5'])?$_POST['oz5']:'';
	$oz6 = !empty($_POST['oz6'])?$_POST['oz6']:'';
	$zct1 = !empty($_POST['zct1'])?$_POST['zct1']:'';
	$zct2 = !empty($_POST['zct2'])?$_POST['zct2']:'';
	$zct3 = !empty($_POST['zct3'])?$_POST['zct3']:'';
	$zct4 = !empty($_POST['zct4'])?$_POST['zct4']:'';
	$zct5 = !empty($_POST['zct5'])?$_POST['zct5']:'';
	$zct6 = !empty($_POST['zct6'])?$_POST['zct6']:'';
	$zct7 = !empty($_POST['zct6'])?$_POST['zct6']:'';
	$zos1 = !empty($_POST['zos1'])?$_POST['zos1']:'';
	$zos2 = !empty($_POST['zos2'])?$_POST['zos2']:'';
	$zos3 = !empty($_POST['zos3'])?$_POST['zos3']:'';
	$zos4 = !empty($_POST['zos4'])?$_POST['zos4']:'';
	$zos5 = !empty($_POST['zos5'])?$_POST['zos5']:'';
	$zos6 = !empty($_POST['zos6'])?$_POST['zos6']:'';
	if(isset( $order  ) && $order != '' )
	$args = array(
		'meta_key' => $order,
		'orderby' => array( 'meta_value_num' => $order_type, 'name' => $order_type ),
		'post_type' => 'zaimy',
		'post_status' => 'publish',
	);
	if( $order == '' )
	$args = array(
		'orderby' => 'name',
		'order' => $order_type,
		'post_type' => 'zaimy',
		'post_status' => 'publish',
	);
if ($postarr) $args['post__in'] = $postarr;
	endif;

	$args['meta_query'] = array('relation' => 'AND');


	// начало фильтра кредитов
/*
	$args['meta_query'][] = array(
  		'key' => 'archive',
		'value' => '1',
		'compare' => 'NOT EXISTS'
	);

	$args['meta_query'][] = array(
  		'key' => 'archive',
		'value' => true,
		'compare' => 'NOT EXISTS'
	);
*/
	if( isset( $summ_limit ) )
		$args['meta_query'][] = array(
      'key' => 'credit_max_sum',
			'value' => $summ_limit ,
			'type' => 'numeric',
			'compare' => '>='
		);

	if( isset( $cred_summ_period  ) )
		$args['meta_query'][] = array(
            'key' => 'credit_period_month',
			'value' => $cred_summ_period,
			'type' => 'numeric',
			'compare' => '>='
		);

	if( isset( $kreditbank  ) && $kreditbank != '')
		$args['meta_query'][] = array(
            'key' => 'product_bank',
			'value' => $kreditbank,
			'compare' => '='
		);

	if( isset( $credLimit ) )

		$args['meta_query'][] = array(
            //'relation' => 'AND',
            'key' => 'card_cred_limit',
			'value' => $credLimit,
			'type' => 'numeric',
			'compare' => '<='
		);

	if( isset( $kred_purpose) && $kred_purpose != '' )
		$args['meta_query'][] = array(
            'key' => 'credit_porpose', // name of custom field
            'value' => $kred_purpose, // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $cat_zaim) && $cat_zaim != '' )
		$args['meta_query'][] = array(
            'key' => 'credit_zaemshik', // name of custom field
            'value' => $cat_zaim, // matches exactly "red"
            'compare' => 'LIKE',
	);

		if( isset( $cgt1 ) && $cgt1 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_get_type', // name of custom field
            'value' => 'cgt1', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $cgt2 ) && $cgt2 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_get_type', // name of custom field
            'value' => 'cgt2', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $cgt3 ) && $cgt3 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_get_type', // name of custom field
            'value' => 'cgt3', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $cgt4 ) && $cgt4 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_get_type', // name of custom field
            'value' => 'cgt4', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $cgt5 ) && $cgt5 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_get_type', // name of custom field
            'value' => 'cgt5', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $kos1 ) && $kos1 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_other_statements', // name of custom field
            'value' => 'kos1', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $kos2 ) && $kos2 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_other_statements', // name of custom field
            'value' => 'kos2', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $kos3 ) && $kos3 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_other_statements', // name of custom field
            'value' => 'kos3', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $kos4 ) && $kos4 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_other_statements', // name of custom field
            'value' => 'kos4', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $kos5 ) && $kos5 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_other_statements', // name of custom field
            'value' => 'kos5', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $kos6 ) && $kos6 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_other_statements', // name of custom field
            'value' => 'kos6', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $kos7 ) && $kos7 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_other_statements', // name of custom field
            'value' => 'kos7', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $kos8 ) && $kos8 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_other_statements', // name of custom field
            'value' => 'kos8', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $kos9 ) && $kos9 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_other_statements', // name of custom field
            'value' => 'kos9', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $kos10 ) && $kos10 == 'on')
		$args['meta_query'][] = array(
            'key' => 'credit_other_statements', // name of custom field
            'value' => 'kos10', // matches exactly "red"
            'compare' => 'LIKE',
	);

	// конец фильтра кредитов

	// начало фильтра займов

	if( isset( $z_sum ) )
		$args['meta_query'][] = array(
            'key' => 'z_sum',
			'value' => $z_sum ,
			'type' => 'numeric',
			'compare' => '>='
		);

	if( isset( $z_time  ) )
		$args['meta_query'][] = array(
            'key' => 'z_time',
			'value' => $z_time,
			'type' => 'numeric',
			'compare' => '>='
		);


		if( isset( $oz1 ) && $oz1 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_organization', // name of custom field
            'value' => 'oz1', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $oz2 ) && $oz2 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_organization', // name of custom field
            'value' => 'oz2', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $oz3 ) && $oz3 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_organization', // name of custom field
            'value' => 'oz3', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $oz4 ) && $oz4 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_organization', // name of custom field
            'value' => 'oz4', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $oz5 ) && $oz5 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_organization', // name of custom field
            'value' => 'oz5', // matches exactly "red"
            'compare' => 'LIKE',
	);

		if( isset( $oz6 ) && $oz6 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_organization', // name of custom field
            'value' => 'oz6', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zct1 ) && $zct1 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_get_type', // name of custom field
            'value' => 'zct1', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zct2 ) && $zct2 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_get_type', // name of custom field
            'value' => 'zct2', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zct3 ) && $zct3 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_get_type', // name of custom field
            'value' => 'zct3', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zct4 ) && $zct4 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_get_type', // name of custom field
            'value' => 'zct4', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zct5 ) && $zct5 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_get_type', // name of custom field
            'value' => 'zct5', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zct6 ) && $zct6 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_get_type', // name of custom field
            'value' => 'zct6', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zct7 ) && $zct7 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_get_type', // name of custom field
            'value' => 'zct7', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zos1 ) && $zos1 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_other_statements', // name of custom field
            'value' => 'zos1', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zos2 ) && $zos2 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_other_statements', // name of custom field
            'value' => 'zos2', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zos3 ) && $zos3 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_other_statements', // name of custom field
            'value' => 'zos3', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zos4 ) && $zos4 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_other_statements', // name of custom field
            'value' => 'zos4', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zos5 ) && $zos5 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_other_statements', // name of custom field
            'value' => 'zos5', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $zos6 ) && $zos6 == 'on')
		$args['meta_query'][] = array(
            'key' => 'z_other_statements', // name of custom field
            'value' => 'zos6', // matches exactly "red"
            'compare' => 'LIKE',
	);

	// конец фильтра займов

	// начало фильтра карт

	if( isset( $cashback_number ) )
		$args['meta_query'][] = array(
            'key' => 'card_cashbak_number',
			'value' => $cashback_number,
			'type' => 'numeric',
			'compare' => '<='
		);

	if( isset( $percent_limit ) )
		$args['meta_query'][] = array(
            'key' => 'non_pecent_money',
			'value' => $percent_limit,
			'type' => 'numeric',
			'compare' => '<='
		);

	if( isset( $cred_day_period ) )
		$args['meta_query'][] = array(
            //'relation' => 'AND',
            'key' => 'card_day_period',
			'value' => $cred_day_period,
			'type' => 'numeric',
			'compare' => '<'
		);



	if( isset( $bank  ) && $bank != '')
		$args['meta_query'][] = array(
            'key' => 'bank_choise',
			'value' => $bank,
			'compare' => '='
		);

	if( isset( $cat_cards  ) && $cat_cards != '')
		$args['meta_query'][] = array(
            'key' => 'card_category',
			'value' => $cat_cards,
			'compare' => '='
		);

	if( isset( $gracePeriodSelect) && $gracePeriodSelect != '')
		$args['meta_query'][] = array(
            'key' => 'card_period',
			'value' => $gracePeriodSelect,
			'compare' => '='
		);
		if( isset( $cashback) && $cashback != '')
		$args['meta_query'][] = array(
            'key' => 'card_cashback',
			'value' => $cashback,
			'compare' => '='
		);

	if( isset( $ps1 ) && $ps1 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_payment_sys', // name of custom field
            'value' => 'ps1', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $ps2 ) && $ps2 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_payment_sys', // name of custom field
            'value' => 'ps2', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $ps3 ) && $ps3 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_payment_sys', // name of custom field
            'value' => 'ps3', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $ps4 ) && $ps4 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_payment_sys', // name of custom field
            'value' => 'ps4', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $ps5 ) && $ps5 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_payment_sys', // name of custom field
            'value' => 'ps5', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $os1 ) && $os1 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_other_state', // name of custom field
            'value' => 'os1', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $os2 ) && $os2 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_other_state', // name of custom field
            'value' => 'os2', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $os3 ) && $os3 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_other_state', // name of custom field
            'value' => 'os3', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $os4 ) && $os4 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_other_state', // name of custom field
            'value' => 'os4', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $os5 ) && $os5 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_other_state', // name of custom field
            'value' => 'os5', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $os6 ) && $os6 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_other_state', // name of custom field
            'value' => 'os6', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $os7 ) && $os7 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_other_state', // name of custom field
            'value' => 'os7', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $os8 ) && $os8 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_other_state', // name of custom field
            'value' => 'os8', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $cdt1 ) && $cdt1 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_deliv_type', // name of custom field
            'value' => 'cdt1', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $cdt2 ) && $cdt2 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_deliv_type', // name of custom field
            'value' => 'cdt2', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $cdt3 ) && $cdt3 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_deliv_type', // name of custom field
            'value' => 'cdt3', // matches exactly "red"
            'compare' => 'LIKE',
	);

	if( isset( $cdt4 ) && $cdt4 == 'on')
		$args['meta_query'][] = array(
            'key' => 'card_deliv_type', // name of custom field
            'value' => 'cdt4', // matches exactly "red"
            'compare' => 'LIKE',
	);

	// конец фильтра карт

		$args['meta_query'][] = array(
		  		'key' => 'archive',
				'value' => '0'

        );

    //print_r2($args);


    $view_template = 1;

    $view_template = null;
    if(isset($_POST['view_template'])){
        $view_template = $_POST['view_template'];
        $view_type = $_POST['view_type'];
    }


	query_posts( $args );
    $item_count = 0;
	global $wp_query;
	$ii = 1;

	if( have_posts() ) : ?>
		<?php ob_start(); // start buffering because we do not need to print the posts now ?>
	<?php while( have_posts() ): the_post();

            $item_count++;

            if($view_template){

                get_template_part( 'template-parts/new-filter-bank-offers', false, ['view_type' => $view_type] );


            }else{
                if($term == 'creditcard' || $term == 'installmentcard' ):
                get_template_part( 'template-parts/filter-cred-card-posts' );
                endif;
                if($term == 'debetcard'):
                get_template_part( 'template-parts/filter-debet-card-posts' );
                endif;
                if($term == 'kredity'):
                get_template_part( 'template-parts/filter-kredity-posts' );
                endif;
                if($term == 'zaimy'):
                get_template_part( 'template-parts/filter-zaimy-posts' );
                endif;
            }



			if ($ii % 4 == 0) {
				//echo do_shortcode( '[code2 id="7672"]' );
			}
			$ii++;
		endwhile;
		$posts_html = ob_get_contents(); // we pass the posts to variable
		ob_end_clean(); // clear the buffer
	else:
		$posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
	endif;


	echo json_encode( array(
		'posts' => json_encode( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $posts_html,
		'item_count' => $item_count
	) );


	die();
}






add_action('wp_ajax_bankfilter', 'bank_filter_function');
add_action('wp_ajax_nopriv_bankfilter', 'bank_filter_function');

function bank_filter_function(){
	$bank_id = $_POST['bank'];
	$debetcard = $_POST['debetcard'];
	$creditcard = $_POST['creditcard'];
	$installmentcard = $_POST['installmentcard'];
	$cp1 = !empty($_POST['oz1'])?$_POST['oz1']:'';
	$cp2 = !empty($_POST['cp2'])?$_POST['cp2']:'';
	$cp3 = !empty($_POST['cp3'])?$_POST['cp3']:'';
	$cp4 = !empty($_POST['cp4'])?$_POST['cp4']:'';
	$cp5 = !empty($_POST['cp5'])?$_POST['cp5']:'';
	$cp6 = !empty($_POST['cp6'])?$_POST['cp6']:'';

	$args = array(
    'post_type'             => array('bankcard', 'kredity'),
    'posts_per_page'        => -1,
    'meta_key' => 'ratings_average',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'post_status' => 'publish'
	);

	$args['meta_query'] = array('relation' => 'OR');
		$args['meta_query'][] = array(
	    'key' => 'bank_choise',
	    'value' => $bank_id,
	    'compare' => 'LIKE',
		);
		$args['meta_query'][] = array(
	    'key' => 'product_bank',
	    'value' => $bank_id,
	    'compare' => 'LIKE',
		);


	if(isset($creditcard) || isset($debetcard)  || isset($installmentcard)):
		$args['meta_query'] = array('relation' => 'AND');
		$args['meta_query'][] = array(
	    'key' => 'bank_choise',
	    'value' => $bank_id,
	    'compare' => 'LIKE',
		);
		$args['tax_query'] = array('relation' => 'OR');
		if( isset( $creditcard ) && $creditcard == 'on')
		$args['tax_query'][] = array(
		    'taxonomy' => 'bankcards',
			'field'    => 'slug',
			'terms'    => 'creditcard',
		);

		if( isset( $debetcard ) && $debetcard == 'on')
		$args['tax_query'][] = array(
		  'taxonomy' => 'bankcards',
			'field'    => 'slug',
			'terms'    => 'debetcard',
		);

		if( isset( $installmentcard ) && $installmentcard == 'on')
		$args['tax_query'][] = array(
		  'taxonomy' => 'bankcards',
			'field'    => 'slug',
			'terms'    => 'installmentcard',
		);
	endif;

	if(isset($cp1) || isset($cp2) || isset($cp3) || isset($cp4) || isset($cp5) || isset($cp6)):
		$args['post_type'] = 'kredity';
		$args['meta_query'] = array('relation' => 'AND');
		$args['meta_query'][] = array(
	    'key' => 'product_bank',
	    'value' => $bank_id,
	    'compare' => 'LIKE',
		);

		if( isset( $cp1 ) && $cp1 == 'on')
		$args['meta_query'][] = array(
	      'key' => 'credit_porpose', // name of custom field
	      'value' => 'cp1', // matches exactly "red"
	      'compare' => 'LIKE',
		);

		if( isset( $cp2 ) && $cp2 == 'on')
		$args['meta_query'][] = array(
	      'key' => 'credit_porpose', // name of custom field
	      'value' => 'cp2', // matches exactly "red"
	      'compare' => 'LIKE',
		);

		if( isset( $cp3 ) && $cp3 == 'on')
		$args['meta_query'][] = array(
	      'key' => 'credit_porpose', // name of custom field
	      'value' => 'cp3', // matches exactly "red"
	      'compare' => 'LIKE',
		);

		if( isset( $cp4 ) && $cp4 == 'on')
		$args['meta_query'][] = array(
	      'key' => 'credit_porpose', // name of custom field
	      'value' => 'cp4', // matches exactly "red"
	      'compare' => 'LIKE',
		);

		if( isset( $cp5 ) && $cp5 == 'on')
		$args['meta_query'][] = array(
	      'key' => 'credit_porpose', // name of custom field
	      'value' => 'cp5', // matches exactly "red"
	      'compare' => 'LIKE',
		);

		if( isset( $cp6 ) && $cp6 == 'on')
		$args['meta_query'][] = array(
	      'key' => 'credit_porpose', // name of custom field
	      'value' => 'cp6', // matches exactly "red"
	      'compare' => 'LIKE',
		);
	endif;


	query_posts( $args );
	global $wp_query;

	if( have_posts() ) : ?>
		<?php ob_start(); // start buffering because we do not need to print the posts now ?>
	<?php while( have_posts() ): the_post();
			get_template_part( 'template-parts/filter-bank-offers' );
		endwhile;
		$posts_html = ob_get_contents(); // we pass the posts to variable
		ob_end_clean(); // clear the buffer
	else:
		$posts_html = '<p style="padding: 0 14px">Ничего не найдено по заданым фильтрам.</p>';
	endif;
	echo json_encode( array(
		'posts' => json_encode( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $posts_html,
	) );
	die();
}






add_action('wp_ajax_collfilter', 'collfilter_function');
add_action('wp_ajax_nopriv_collfilter', 'collfilter_function');

function collfilter_function(){
	$term = $_POST['term'];
	$order = $_POST['order'];

	$postarr = json_decode( $_POST['postarr'], true );

	if(!empty($order)):
		$args = array(
				'meta_key' => $order,
		    'post_type' => array('kredity', 'zaimy', 'bankcard'),
		    'posts_per_page' => 4,
		    //'post__in' => $postarr,
		    //'orderby' => 'name',
		    'orderby' => array( 'meta_value_num' => 'desc', 'name' => 'desc' ),
		    'order' => 'DESC'
		);
	else:
		$args = array(
		    'post_type' => array('kredity', 'zaimy', 'bankcard'),
		    'posts_per_page' => 4,
		    //'post__in' => $postarr,
		    'orderby' => 'name',
		    'order' => 'DESC'
		);
	endif;
	$args['post__in'] = $postarr;

	query_posts( $args );
	global $wp_query;

	if( have_posts() ) : ?>
		<?php ob_start(); // start buffering because we do not need to print the posts now ?>
	<?php while( have_posts() ): the_post();
			get_template_part( 'template-parts/collection-posts' );
		endwhile;
		$posts_html = ob_get_contents(); // we pass the posts to variable
		ob_end_clean(); // clear the buffer
	else:
		$posts_html = '<p>Ничего не найдено по заданым фильтрам.</p>';
	endif;
	echo json_encode( array(
		'posts' => json_encode( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $posts_html,
	) );
	die();
}




// ajax поиск по сайту
add_action("wp_ajax_nopriv_ajax_search", "ajax_search");
add_action("wp_ajax_ajax_search", "ajax_search");
function ajax_search()
{
    $args = array(
        "post_type"      => "any", // Тип записи: post, page, кастомный тип записи
        "post_status"    => "publish",
        "order"          => "DESC",
        "orderby"        => "views",
        "s"              => $_POST["term"],
        "posts_per_page" => -1,
    );
    $wp_query = new WP_Query($args);
    if ($wp_query->have_posts()) {
        while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
        	<div class="header__search-result">
                <div class="container">
                    <a href="<?php echo the_permalink() ?>" class="header__search-link"><?php echo the_title() ?></a>
                    <div class="header__search-description">
                    	<?php $terms = wp_get_post_terms( get_the_id(), 'bankcards', array('fields' => 'all') );
                    	$term_slug = $terms[0]->slug;
                    	$post_type = get_post_type( get_the_id() );
                    	if($term_slug == 'creditcard'):
                    	echo 'Кредитные карты'; endif;
                    	if($term_slug == 'debetcard'):
                    	echo 'Дебетовые карты'; endif;
                    	if($term_slug == 'installmentcard'):
                    	echo 'Карты рассрочки'; endif;
                    	if($post_type == 'banks'):
                    	echo 'Банки'; endif;
                    	if($post_type == 'zaimy'):
                    	echo 'Займы'; endif;
                    	if($post_type == 'kredity'):
                    	echo 'Кредиты'; endif;
                    	if($post_type == 'page'):
                    	echo 'Страница'; endif;
                    	if(in_category( 'blog' )):
                    	echo 'Журнал'; endif;
                    	if(in_category( 'news' )):
                    	echo 'Новости'; endif;
                    	if($post_type == 'collection'):
                    	//if($post_type( 'collection' )):
                    	echo 'Подборка'; endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile;
    }
    exit;
}








add_filter('comment_form_fields', 'kama_reorder_comment_fields' );
function kama_reorder_comment_fields( $fields ){
	// die(print_r( $fields )); // посмотрим какие поля есть

	$new_fields = array(); // сюда соберем поля в новом порядке

	//$myorder = array('city', 'author','email', 'cookies', 'comment'); // нужный порядок
	$myorder = array('author','email', 'cookies', 'comment'); // нужный порядок

	foreach( $myorder as $key ){
		if (isset($fields[ $key ])) {
			$new_fields[ $key ] = $fields[ $key ];
			unset( $fields[ $key ] );
		}
	}

	// если остались еще какие-то поля добавим их в конец
	if( $fields )
		foreach( $fields as $key => $val )
			$new_fields[ $key ] = $val;

	return $new_fields;
}


function enqueue_comment_reply() {
	if( is_singular() )
		wp_enqueue_script('comment-reply');
}
add_action( 'wp_enqueue_scripts', 'enqueue_comment_reply' );


function custom_comment_reply_link($content) {
    $extra_classes = 'comment__one-answer order-md-3 mr-4 mr-md-0';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $content);
}

add_filter('comment_reply_link', 'custom_comment_reply_link', 99);

function c_parent_comment_counter($id){
    global $wpdb;
    $query = "SELECT COUNT(comment_post_id) AS count FROM $wpdb->comments WHERE `comment_approved` = 1 AND `comment_post_ID` = $id AND `comment_parent` = 0";
    $parents = $wpdb->get_row($query);
    return $parents->count;
}

/*
function wph_save_city_field($comment_id) {
    add_comment_meta($comment_id, 'city', $_POST['city']);
}
add_action('comment_post', 'wph_save_city_field');
*/
add_filter( 'comment_post_redirect', function ( $location ) {
    return get_page_link($_SESSION['post_review_id']);
} );


add_action('wp_ajax_increment_counter', 'my_increment_counter');
add_action('wp_ajax_nopriv_increment_counter', 'my_increment_counter');

function my_increment_counter(){
    $count = get_post_meta( $_POST['post_id'], 'share_clicks', true );
    update_post_meta( $_POST['post_id'], 'share_clicks', ( $count === '' ? 1 : $count + 1 ) );
}

function my_compare_btn( $post_id ) {
	$cred_cards = (!empty($_SESSION['cred_cards']) && is_array($_SESSION['cred_cards'])) ? $_SESSION['cred_cards'] : [];
	$debet_cards = (!empty($_SESSION['debet_cards']) && is_array($_SESSION['debet_cards'])) ? $_SESSION['debet_cards'] : [];
	$installment_cards = (!empty($_SESSION['installment_cards']) && is_array($_SESSION['installment_cards'])) ? $_SESSION['installment_cards'] : [];
	$kredity = (!empty($_SESSION['kredity']) && is_array($_SESSION['kredity'])) ? $_SESSION['kredity'] : [];
	$zaimy = (!empty($_SESSION['zaimy']) && is_array($_SESSION['zaimy'])) ? $_SESSION['zaimy'] : [];

	$array_compare = array_merge($cred_cards, $debet_cards, $installment_cards, $kredity, $zaimy);


	//$array_compare = array_merge($_SESSION['cred_cards'], $_SESSION['debet_cards'], $_SESSION['installment_cards'], $_SESSION['kredity'], $_SESSION['zaimy']);
	if (in_array($post_id, $array_compare)) {
		return 'btn_compare_on';
	}
}

function error_report_log_customize(){
    //error_reporting(E_ALL);
    //error_reporting(E_ERROR);
    // error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);
}
add_action('init','error_report_log_customize');



function myown_comment($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    $comment_id = $comment->comment_ID;
    $user = get_userdata( $comment->user_id );
    $user_role = $user->roles;
    $user_email = $user->user_email;
    $parent_comment = $comment->comment_parent;
    $comment_post_id = $comment->comment_post_ID;
    $comments_children = get_comments(array(
    'status' => 'approve',
    'hierarchical' => 'true',
    'parent' => $comment_id,));
    $responses = count($comments_children); ?>
<?php if($parent_comment == "0"): ?>
 <div class="comments__item mb-3" id="comment-<?php echo $comment_id ?>">
  <!-- comment -->
     <div class="comment__one">
         <div class="comment__one-header d-flex align-items-center">
             <div class="comment__one-img mr-3">
                 <img src="<?php echo get_avatar_url( $comment, array(
                   'default'=>'identicon',) ); ?>" alt="<?php echo $comment->comment_author; ?>">
             </div>
             <div class="d-md-flex justify-content-md-between w-100">
                 <div class="comment__one-title mb-2 mb-md-0"><?php echo $comment->comment_author; ?></div>
                 <div class="d-flex align-items-center">
                     <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                         <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                         <?php if($user_role[0] == ''):
                          echo 'Гость';
                          endif;
                          if($user_role[0] != ''):
                          echo $user_role[0];
                          endif; ?>
                     </div>
                     <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                         <div class="mr-2"><svg width="18" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#house" x="0" y="0"></use></svg></div>
                         <?php if(get_post_type($comment_post_id) == 'bankcard'): ?>
                            <?php $bank_id = get_field('bank_choise', $comment_post_id); ?>
                            <?php echo get_the_title($bank_id); ?>
                         <?php endif; ?>
                         <?php if(get_post_type($comment_post_id) == 'banks'): ?>
                            <?php echo get_the_title($comment_post_id); ?>
                         <?php endif; ?>
                         <?php if(get_post_type($comment_post_id) == 'team'): ?>
                            <?php echo get_the_title($comment_post_id); ?>
                         <?php endif; ?>
                         <?php if(get_post_type($comment_post_id) == 'kredity'): ?>
                            <?php $bank_id = get_field('product_bank', $comment_post_id); ?>
                            <?php echo get_the_title($bank_id); ?>
                         <?php endif; ?>
                         <?php if(get_post_type($comment_post_id) == 'zaimy'): ?>
                                <?= get_field('z_organization_name', $comment_post_id); ?>
                         <?php endif; ?>
                     </div>
                 </div>
             </div>
         </div>
         <div class="comment__one-content">
             <?php echo $comment->comment_content; ?>
         </div>
         <div class="comment__one-footer d-flex flex-wrap align-items-center">
              <?php echo comment_reply_link( [ 'reply_text' => "Ответить", 'depth' => -1 ], $comment_id, $comment_post_id); ?>
             <div class="comment__one-date mr-md-4 order-md-1">
              <?php echo  get_comment_date( 'd.m.y'); ?> в
              <?php echo get_comment_date('H:i') ?>
              </div>
             <div class="comment__one-like order-md-4 ml-auto d-flex justify-content-between">
                 <?php comments_like_dislike($comment_id); ?>
             </div>
              <?php if($responses > 0): ?>
                  <div class="comment__one-btn order-md-2 mr-md-4">
                      <button class="btn btn-outline-light btn-xs collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answ__<?php echo $comment_id ?>" aria-expanded="false">
                          <?php echo $responses ?>
                          <?php if($responses == 1):
                           echo 'Ответ';
                          endif;?>
                          <?php if(2 <= $responses &&  $responses <= 4):
                           echo 'Ответа';
                          endif;?>
                          <?php if($responses >= 4):
                           echo 'Ответов';
                          endif;?>
                          <svg width="12" height="6" viewBox="0 0 12 6">
                              <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                          </svg>
                      </button>
                  </div>
              <?php endif; ?>
         </div>
     </div>
     <!-- comment -->
 <!-- /item -->
<?php endif; ?>
<?php if($parent_comment != '0'): ?>
<div class="collapse comment__one-collapse" id="answ__<?php echo $parent_comment ?>">
  <div class="comment__one-hidden">
      <!-- comment -->
 <div class="comment__one">
     <div class="comment__one-header d-flex align-items-center">
         <div class="comment__one-img mr-3">
             <img src="<?php echo get_avatar_url( $comment, array(
                   'default'=>'identicon',) ); ?>" alt="">
         </div>
         <div class="d-md-flex justify-content-md-between w-100">
             <div class="comment__one-title mb-2 mb-md-0"><?php echo $comment->comment_author; ?></div>
             <div class="d-flex align-items-center">
                 <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                     <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use></svg></div>
                     <?php if($user_role[0] == ''):
                      echo 'Гость';
                      endif;
                      if($user_role[0] != ''):
                      echo $user_role[0];
                      endif; ?>
                 </div>
                 <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                     <div class="mr-2"><svg width="18" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#house" x="0" y="0"></use></svg></div>
                     <?php $bank_id = get_field('bank_choise', $comment_post_id); ?>
                      <?php if(get_post_type($comment_post_id) == 'bankcard'): ?>
                            <?php $bank_id = get_field('bank_choise', $comment_post_id); ?>
                            <?php echo get_the_title($bank_id); ?>
                         <?php endif; ?>
                         <?php if(get_post_type($comment_post_id) == 'banks'): ?>
                            <?php echo get_the_title($comment_post_id); ?>
                         <?php endif; ?>
                         <?php if(get_post_type($comment_post_id) == 'team'): ?>
                            <?php echo get_the_title($comment_post_id); ?>
                         <?php endif; ?>
                         <?php if(get_post_type($comment_post_id) == 'kredity'): ?>
                            <?php $bank_id = get_field('product_bank', $comment_post_id); ?>
                            <?php echo get_the_title($bank_id); ?>
                         <?php endif; ?>
                         <?php if(get_post_type($comment_post_id) == 'zaimy'): ?>
                            <?= get_field('z_organization_name', $comment_post_id); ?>
                         <?php endif; ?>
                 </div>
             </div>
         </div>
     </div>
     <div class="comment__one-content">
         <?php echo $comment->comment_content; ?>
     </div>
     <div class="comment__one-footer d-flex flex-wrap align-items-center">
         <div class="comment__one-date mr-md-4 order-md-1">
          <?php echo  get_comment_date('d.m.y'); ?> в
          <?php echo get_comment_date('H:i'); ?>
          </div>
         <div class="comment__one-like order-md-4 ml-auto d-flex justify-content-between">
             <?php comments_like_dislike($comment_id); ?>
         </div>
     </div>
 </div>
 <!-- comment -->
</div>
<?php endif; ?>
 <?php
 }


function wpse16119876_init_session() {
    if ( ! session_id() ) {
        session_start();
    }
}
// Start session on init hook.
add_action( 'init', 'wpse16119876_init_session' );




























/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Подсчет количества посещений страниц
add_action( 'wp_head', 'kama_postviews' );

/**
 * @param array $args
 *
 * @return null
 */
//Регистрируем типы данных для шорткодов

function code1_register_cpt() {

	$args = array(
		'labels' => array(
			'menu_name' => 'Продукт'
		),
		'public' => true,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-admin-tools',
		'show_in_menu' => 'shortcodes'
	);
	register_post_type( 'code1', $args );
}


add_action( 'init', 'code1_register_cpt' );


function code2_register_cpt() {

	$args = array(
		'labels' => array(
			'menu_name' => 'СТА-блок с текстом'
		),
		'public' => true,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-admin-tools',
		'show_in_menu' => 'shortcodes'
	);
	register_post_type( 'code2', $args );
}


add_action( 'init', 'code2_register_cpt' );


function code3_register_cpt() {

	$args = array(
		'labels' => array(
			'menu_name' => 'Таблица офферов'
		),
		'public' => true,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-admin-tools',
		'show_in_menu' => 'shortcodes'
	);
	register_post_type( 'code3', $args );
}


add_action( 'init', 'code3_register_cpt' );


function code4_register_cpt() {

	$args = array(
		'labels' => array(
			'menu_name' => 'Витрина офферов'
		),
		'public' => true,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-admin-tools',
		'show_in_menu' => 'shortcodes'
	);
	register_post_type( 'code4', $args );
}


add_action( 'init', 'code4_register_cpt' );


function code5_register_cpt() {

	$args = array(
		'labels' => array(
			'menu_name' => 'СТА-блок с продуктом'
		),
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'menu_icon' => 'dashicons-admin-tools',
		'show_in_menu' => 'shortcodes'
	);
	register_post_type( 'code5', $args );
}

add_action( 'init', 'code5_register_cpt' );

function create_menupages() {

		add_menu_page(
			'Шорткоды',
			'Шорткоды',
			'manage_options',
			'shortcodes', // слаг
			'mycustompage',
			'dashicons-format-aside', // иконка
			10 // выбираем позицию
		);

}

add_action('admin_menu', 'create_menupages');



add_shortcode( 'table_collection', 'table_collection_func' );

add_shortcode( 'new_table_collection', 'new_table_collection_func' );

function new_table_collection_func( $atts ){
    ob_start();
    global $allposts_collection;
    global $type_collection;

    $type = $type_collection; ?>

    <?php if ($type) { ?>

        <div class="section__header d-flex justify-content-between align-items-center mb-4">
            <h2 class="title mb-0">Сравнение условий ТОП предложений месяца</h2>
        </div>

    <?php } ?>



    <div class="code3wrapper new_table_collection_func" id="table_collection">

     <?php if ($type == 'kredity') { ?>
         <div class="code3">
    <!--     <span class="frecom">Финабанк рекомендует!</span>-->
             <div class="code3head">
                 <div class="w30">Кредит/ Банк</div>
                 <div class="text-center">Сумма</div>
                 <div class="text-center">Срок</div>
                 <div class="text-center">ПСК</div>
             </div>
    <?php
    $query = new WP_Query(
        array(
            'posts_per_page' => -1,
            'post_type' => $type,
            'post__in' => $allposts_collection,
            'meta_key' => 'ratings_average',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'archive',
                    'value'    => '0'
                ),
            )
        )
    );

    while( $query->have_posts() ){ $query->the_post(); ?>
             <div class="code3text">
                 <div class="w30 strong td2">
                    <a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_table_collection'); return true;">
                        <img src="<?php echo get_field('bank_logo', get_field('product_bank', get_the_ID())); ?>" alt="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                </div>
                 <div class="w30 td text-center">
                     <div class="hidden-lg">Сумма</div>
                     <div class="td-val"><?php echo number_format(get_field('credit_min_sum'), 0, '.', ' '); ?> - <?php echo number_format(get_field('credit_max_sum'), 0, '.', ' '); ?> ₽</div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Срок</div>
                     <div class="td-val">до <?php $field = get_field('credit_period'); echo $field['label']; ?></div>
                 </div>

                 <?php if(get_field('opisanie_psk_1')): ?>

                 <div class="w30 td text-center">
                     <div class="hidden-lg">ПСК</div>
                     <div class="td-val"><?php echo get_field('opisanie_psk_1'); ?>% - <?php echo get_field('opisanie_psk_2'); ?>%</div>
                 </div>

                 <?php endif; ?>

             </div>
         <?php } ?>
         </div>
    <?php } ?>

    <?php if ($type == 'zaimy') { ?>
         <div class="code3"><span class="frecom">Финабанк рекомендует!</span>
             <div class="code3head">
                 <div class="w30">Предложение</div>
                 <div class="text-center">Сумма</div>
                 <div class="text-center">Кредитная<br/> история</div>
                 <div class="text-center">% ставка</div>
                 <div class="text-center">Срок</div>
                 <div class="text-center">Рейтинг</div>
             </div>

    <?php
    $query = new WP_Query(
        array(
            'posts_per_page' => -1,
            'post_type' => $type,
            'post__in' => $allposts_collection,
            'meta_key' => 'ratings_average',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'archive',
                    'value'    => '0'
                ),
            )
        )
    );
    $counter_prod = 1;
    while( $query->have_posts() ){ $query->the_post(); ?>
             <div class="code3text <?php if($counter_prod > 10){ echo 'div__hidden'; } ?>">
                 <div class="w30 strong td2">
                     <a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_shortcode_sheet'); return true;">
                         <img src="<?php echo get_field('z_organization_logo'); ?>" alt="<?php the_title(); ?>">
                         <?php the_title(); ?>
                     </a>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Сумма</div>
                     <div class="td-val"><?php echo number_format(get_field('z_sum'), 0, '.', ' '); ?> ₽</div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Кредитная история</div>
                     <div class="td-val"><?php echo get_field('z_history'); ?></div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">% ставка</div>
                     <div class="td-val srok1">От <?php echo get_field('z_stavka'); ?>%</div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Срок</div>
                     <div class="td-val">до <?php echo get_field('z_time'); ?> дней</div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Рейтинг</div>
                     <div class="rate3 text-center td-val">
                         <div>
                             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                 <use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use>
                             </svg>
                         </div>
                         <div><?php echo get_field('ratings_average'); ?></div>
                     </div>
                 </div>
             </div>
        <?php $counter_prod++; } ?>
        <button class="btn__details" data-target="table_collection" data-text-open="Показать еще" data-text-hide="Скрыть">
            <span class="btn__details-icon"></span>
            <span class="btn__details-text">Показать еще</span>
        </button>
        </div>
    <?php } ?>

    <?php if ($type == 'creditcard' || $type == 'installmentcard') { ?>
         <div class="code3"><span class="frecom">Финабанк рекомендует!</span>
             <div class="code3head">
                 <div class="w30">Предложение</div>
                 <div class="text-center">Кредитный<br/>лимит</div>
                 <div class="text-center">Льготный<br/>период</div>
                 <div class="text-center">% ставка</div>
                 <div class="text-center">Кэшбек</div>
                 <div class="text-center">Стоимость</div>
                 <div class="text-center">Рейтинг</div>
             </div>
    <?php
    $query = new WP_Query(
        array(
            'posts_per_page' => -1,
            'post_type' => array('bankcard'),
            'post__in' => $allposts_collection,
            'meta_key' => 'ratings_average',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'archive',
                    'value'    => '0'
                ),
            )
        )
    );

    while( $query->have_posts() ){ $query->the_post(); ?>
             <div class="code3text">
                 <div class="w30 strong td2">
                     <a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_table_collection'); return true;">
                         <img src="<?php echo get_field('bank_logo', get_field('bank_choise', get_the_ID())); ?>" alt="<?php the_title(); ?>">
                         <?php the_title(); ?>
                     </a>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Кредитный лимит</div>
                     <div class="td-val"><?php echo number_format(get_field('card_cred_limit'), 0, '.', ' '); ?> ₽</div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Льготный период</div>
                     <div class="td-val">
                         <?php
                             $field = get_field('card_period');
                             $value = $field['value'];
                             $label = $field['choices'][ $value ];
                             echo $label;
                         ?>
                     </div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">% ставка</div>
                     <div class="td-val srok1">От <?php echo get_field('card_stavka'); ?>%</div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Кэшбек</div>
                     <div class="td-val srok1"><?php echo get_field('card_cashback'); ?></div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Стоимость</div>
                     <div class="td-val srok1">От <?php echo get_field('card_cost'); ?> ₽</div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Рейтинг</div>
                     <div class="rate3 text-center td-val">
                         <div>
                             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                 <use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use>
                             </svg>
                         </div>
                         <div><?php echo get_field('ratings_average'); ?></div>
                     </div>
                 </div>
             </div>
        <?php } ?>
         </div>
     <?php } ?>


     <?php if ($type == 'debetcard') { ?>
         <div class="code3"><span class="frecom">Финабанк рекомендует!</span>
             <div class="code3head">
                 <div class="w30">Предложение</div>
                 <div class="text-center">Кэшбек</div>
                 <div class="text-center">% на остаток</div>
                 <div class="text-center">Снятие без %</div>
                 <div class="text-center">Овердрафт</div>
                 <div class="text-center">Стоимость</div>
                 <div class="text-center">Рейтинг</div>
             </div>

    <?php
    $query = new WP_Query(
        array(
            'posts_per_page' => -1,
            'post_type' => array('bankcard'),
            'post__in' => $allposts_collection,
            'meta_key' => 'ratings_average',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'archive',
                    'value'    => '0'
                ),
            )
         )
    );

    while( $query->have_posts() ){ $query->the_post(); ?>
             <div class="code3text">
                 <div class="w30 strong td2">
                     <a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_table_collection'); return true;">
                         <img src="<?php echo get_field('bank_logo', get_field('bank_choise', get_the_ID())); ?>" alt="<?php the_title(); ?>">
                         <?php the_title(); ?>
                     </a>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Кэшбек</div>
                     <div class="td-val">
                         <?php
                             $field = get_field('card_cashback');
                             $value = $field['value'];
                             echo $field['label'];
                         ?>
                     </div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">% на остаток</div>
                     <div class="td-val">до <?php echo get_field('card_stavka_ostatok'); ?>%</div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Снятие без %</div>
                     <div class="td-val srok1">до <?php echo number_format(get_field('non_pecent_money'), 0, '.', ' '); ?> ₽</div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Овердрафт</div>
                     <div class="td-val srok1"><?php echo get_field('card_overdraft'); ?></div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Стоимость</div>
                     <div class="td-val srok1"><?php echo get_field('card_cost'); ?> ₽</div>
                 </div>
                 <div class="td text-center">
                     <div class="hidden-lg">Рейтинг</div>
                     <div class="rate3 text-center td-val">
                         <div>
                             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                 <use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use>
                             </svg>
                         </div>
                         <div><?php echo get_field('ratings_average'); ?></div>
                     </div>
                 </div>
             </div>
         <?php } ?>
         </div>
     <?php } ?>
    </div>

    <?php
    $table_collection = ob_get_clean();
    return $table_collection;
}


function table_collection_func( $atts ){
ob_start();
global $allposts_collection;
global $type_collection;

$type = $type_collection; ?>

<div class="code3wrapper" id="table_collection">

 <?php if ($type == 'kredity') { ?>
     <div class="code3"><span class="frecom">Финабанк рекомендует!</span>
         <div class="code3head">
             <div class="w30">Предложение</div>
             <div class="text-center">Мин. сумма</div>
             <div class="text-center">Макс. сумма</div>
             <div class="text-center">Ставка</div>
             <div class="text-center">Срок</div>
             <div class="text-center">Рейтинг</div>
         </div>
<?php
$query = new WP_Query(
    array(
    	'posts_per_page' => -1,
    	'post_type' => $type,
    	'post__in' => $allposts_collection,
    	'meta_key' => 'ratings_average',
    	'orderby' => 'meta_value_num',
    	'order' => 'DESC',
    	'post_status' => 'publish',
    	'meta_query' => array(
	        array(
	            'key' => 'archive',
	            'value'    => '0'
	        ),
	    )
    )
);

while( $query->have_posts() ){ $query->the_post(); ?>
         <div class="code3text">
         <div class="w30 strong td2"><a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_table_collection'); return true;">
         	<img src="<?= get_field('bank_logo', get_field('product_bank', get_the_ID())) ?>" alt="<?php the_title(); ?>">
         	<?php the_title(); ?>
         	</a></div>
             <div class="td text-center"><div class="hidden-lg">Мин. сумма</div><div class="td-val"><?= number_format(get_field('credit_min_sum'), 0, '.', ' '); ?> ₽</div></div>
             <div class="td text-center"><div class="hidden-lg">Макс. сумма</div><div class="td-val"><?= number_format(get_field('credit_max_sum'), 0, '.', ' '); ?> ₽</div></div>
             <div class="td text-center"><div class="hidden-lg">Ставка</div><div class="td-val">От <?php echo the_field('credit_stavka') ?>%</div></div>
             <div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">до <?php $field = get_field('credit_period');
                                            //$value = $field['value'];
                                            //$label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div></div>
             <div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 td-val text-center"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>
             </div> <div><?= get_field('ratings_average'); ?></div></div></div>
         </div>
     <?php } ?>
     </div>
<?php } ?>

<?php if ($type == 'zaimy') { ?>
     <div class="code3"><span class="frecom">Финабанк рекомендует!</span>
         <div class="code3head">
             <div class="w30">Предложение</div>
             <div class="text-center">Сумма</div>
             <div class="text-center">Кредитная<br/> история</div>
             <div class="text-center">% ставка</div>
             <div class="text-center">Срок</div>
             <div class="text-center">Рейтинг</div>
         </div>

<?php
$query = new WP_Query(
    array(
    	'posts_per_page' => -1,
    	'post_type' => $type,
    	'post__in' => $allposts_collection,
    	'meta_key' => 'ratings_average',
    	'orderby' => 'meta_value_num',
    	'order' => 'DESC',
    	'post_status' => 'publish',
    	'meta_query' => array(
	        array(
	            'key' => 'archive',
	            'value'    => '0'
	        ),
	    )
   	)
);
$counter_prod = 1;
while( $query->have_posts() ){ $query->the_post(); ?>
         <div class="code3text <?php if($counter_prod >10): echo 'div__hidden'; endif; ?>">
         <div class="w30 strong td2">
         	<a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_shortcode_sheet'); return true;">
				<img src="<?= get_field('z_organization_logo') ?>" alt="<?php the_title(); ?>">
         		<?php the_title(); ?>

         		</a>
         </div>
         <div class="td text-center"><div class="hidden-lg">Сумма</div><div class="td-val"><?= number_format(get_field('z_sum'), 0, '.', ' '); ?> ₽</div></div>
		 <div class="td text-center"><div class="hidden-lg">Кредитная история</div><div class="td-val"><?=get_field('z_history') ?></div></div>
         <div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">От <?= get_field('z_stavka') ?>%</div></div>
         <div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">до <?= get_field('z_time'); ?> дней</div></div>
         <div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>
             </div> <div><?= get_field('ratings_average'); ?></div></div></div>
         </div>
    <?php $counter_prod++; } ?>
    <button class="btn__details" data-target="table_collection" data-text-open="Показать еще" data-text-hide="Скрыть">
        <span class="btn__details-icon"></span>
        <span class="btn__details-text">Показать еще</span>
    </button>
	</div>
<?php }	?>

<?php if ($type == 'creditcard' || $type == 'installmentcard') { ?>
     <div class="code3"><span class="frecom">Финабанк рекомендует!</span>
         <div class="code3head">
             <div class="w30">Предложение</div>
             <div class="text-center">Кредитный<br/>лимит</div>
             <div class="text-center">Льготный<br/>период</div>
             <div class="text-center">% ставка</div>
             <div class="text-center">Кэшбек</div>
             <div class="text-center">Стоимость</div>
             <div class="text-center">Рейтинг</div>
         </div>
<?php
$query = new WP_Query(
    array(
    	'posts_per_page' => -1,
    	'post_type' => array('bankcard'),
    	'post__in' => $allposts_collection,
    	'meta_key' => 'ratings_average',
    	'orderby' => 'meta_value_num',
    	'order' => 'DESC',
    	'post_status' => 'publish',
    	'meta_query' => array(
	        array(
	            'key' => 'archive',
	            'value'    => '0'
	        ),
	    )
    )
);

while( $query->have_posts() ){ $query->the_post(); ?>
         <div class="code3text">
         <div class="w30 strong td2"><a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_table_collection'); return true;">
         	<img src="<?= get_field('bank_logo', get_field('bank_choise', get_the_ID())) ?>" alt="<?php the_title(); ?>">
         	<?php the_title(); ?>
         	</a></div>
             <div class="td text-center"><div class="hidden-lg">Кредитный лимит</div><div class="td-val"><?= number_format(get_field('card_cred_limit'), 0, '.', ' '); ?> ₽</div></div>
             <div class="td text-center"><div class="hidden-lg">Льготный период</div><div class="td-val"><?php $field = get_field('card_period');
                                            $value = $field['value'];
                                            $label = $field['choices'][ $value ];
                                            echo $field['label'] ?></div></div>
             <div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">От <?php echo the_field('card_stavka') ?>%</div></div>
             <div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val srok1"><?php $card_cashback = get_field('card_cashback');
                                       echo $card_cashback; ?></div></div>
             <div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">От <?php echo the_field('card_cost') ?> ₽</div></div>
             <div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>
             </div> <div><?= get_field('ratings_average'); ?></div></div></div>
        </div>
    <?php }	?>
     </div>
 <?php } ?>


 <?php if ($type == 'debetcard') { ?>
     <div class="code3"><span class="frecom">Финабанк рекомендует!</span>
         <div class="code3head">
             <div class="w30">Предложение</div>
             <div class="text-center">Кэшбек</div>
             <div class="text-center">% на остаток</div>
             <div class="text-center">Снятие без %</div>
             <div class="text-center">Овердрафт</div>
             <div class="text-center">Стоимость</div>
             <div class="text-center">Рейтинг</div>
         </div>

<?php
$query = new WP_Query(
    array(
    	'posts_per_page' => -1,
    	'post_type' => array('bankcard'),
    	'post__in' => $allposts_collection,
    	'meta_key' => 'ratings_average',
    	'orderby' => 'meta_value_num',
    	'order' => 'DESC',
    	'post_status' => 'publish',
    	'meta_query' => array(
	        array(
	            'key' => 'archive',
	            'value'    => '0'
	        ),
	    )
     )
);

while( $query->have_posts() ){ $query->the_post(); ?>
         <div class="code3text">
         <div class="w30 strong td2"><a href="<?php the_permalink(); ?>" class="stretched-link" onclick="ym(35020350,'reachGoal','click_table_collection'); return true;">
         	<img src="<?= get_field('bank_logo', get_field('bank_choise', get_the_ID())) ?>" alt="<?php the_title(); ?>">
         	<?php the_title(); ?>
         	</a></div>
             <div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val"><?php $field = get_field('card_cashback');
                                            $value = $field['value'];
                                            echo $field['label'] ?></div></div>
             <div class="td text-center"><div class="hidden-lg">% на остаток</div><div class="td-val">до <?php echo the_field('card_stavka_ostatok') ?> %</div></div>
             <div class="td text-center"><div class="hidden-lg">Снятие без %</div><div class="td-val srok1">до <?= number_format(get_field('non_pecent_money'), 0, '.', ' '); ?> ₽</div></div>
             <div class="td text-center"><div class="hidden-lg">Овердрафт</div><div class="td-val srok1"><?php echo the_field('card_overdraft') ?></div></div>
             <div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1"><?php echo the_field('card_cost') ?> ₽</div></div>
             <div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>
             </div> <div><?= get_field('ratings_average'); ?></div></div></div>
         </div>
     <?php } ?>
     </div>
 <?php } ?>
</div>

<?php
$table_collection = ob_get_clean();
return $table_collection;

}



function YearTextArg($year) {
    $year = abs($year);
    $t1 = $year % 10;
    $t2 = $year % 100;
    return ($t1 == 1 && $t2 != 11 ? "года" : "лет");
}

function reclink($ID) {

	if (strpos(get_field('card_bank_link', $ID), 'finabank.ru/recommends/') === false) return false;

	return true;

}


function numberOfDecimals($value)
{
    if ((int)$value == $value)
    {
        return 0;
    }
    else if (! is_numeric($value))
    {
        // throw new Exception('numberOfDecimals: ' . $value . ' is not a number!');
        return false;
    }

    return strlen($value) - strrpos($value, '.') - 1;
}

function roulette($items)
{
	$sumOfPercents = 0;
	foreach($items as $itemsPercent)
	{
		$sumOfPercents += $itemsPercent;
	}

	$decimals = numberOfDecimals($sumOfPercents);
	$multiplier = 1;
	for ($i=0; $i < $decimals; $i++)
	{
		$multiplier *= 10;
	}

    $sumOfPercents *= $multiplier;
	$rand = rand(1, $sumOfPercents);
	//echo "max percent = {$sumOfPercents}\n";
	//echo "rand = $rand\n";

	$rangeStart = 1;
	foreach($items as $itemKey => $itemsPercent)
	{
		$rangeFinish = $rangeStart + ($itemsPercent * $multiplier);
		//echo "$itemKey in [$rangeStart, $rangeFinish]\n";
		if($rand >= $rangeStart && $rand <= $rangeFinish)
		{
			return $itemKey;
		}

		$rangeStart = $rangeFinish + 1;
	}

}

function db_cache_add(string $key, string $value, int $ttl = null)
{
    global $wpdb;

    $wpdb->replace('wp_dbcache', [
        'key' => $key,
        'value' => $value,
        'expired_at' => $ttl ? time() + $ttl : null
    ]);
}

function db_cache_get(string $key)
{
    global $wpdb;

    return $wpdb->get_var(
        $wpdb->prepare('SELECT `value` FROM `wp_dbcache` WHERE `key` = %s', $key)
    );
}

function cron_finabank_currencies(): void
{
    $list = [];

    $xml = new DOMDocument();
    $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d.m.Y');

    try {
        if ($xml->load($url)) {
            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');

            foreach ($items as $item) {
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $list[$code] = floatval(str_replace(',', '.', $curs));
            }
        }
    } catch (Exception $e) {
        error_log($e->getMessage() . PHP_EOL . PHP_EOL . $e->getTraceAsString());
    }

    try {
        $url = 'https://bitpay.com/api/rates';
        $json = json_decode(file_get_contents($url));
        foreach($json as $obj) {
            if ($obj->code === 'USD') {
                $list['USDBTC'] = $obj->rate;
            }
        }
    } catch (Exception $e) {
        error_log($e->getMessage() . PHP_EOL . PHP_EOL . $e->getTraceAsString());
    }

    db_cache_add('cbr_currencies', json_encode($list), 2 * 60 * 60);
}

add_action('cron_finabank_currencies', 'cron_finabank_currencies');

function get_currencies(): array
{
    $value = db_cache_get('cbr_currencies');

    return $value ? json_decode($value, true) : [];
}

add_action('wp_ajax_nopriv_get_cities', 'ajax_get_cities');

function ajax_get_cities(): void
{
    $cities = Wt::$obj->contacts->getRegionsArray();
    sort($cities);

    header('Content-Type: application/json');
    echo json_encode($cities, JSON_UNESCAPED_UNICODE);
    exit();
}


function remove_global_styles_and_svg_filters() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}
add_action('init', 'remove_global_styles_and_svg_filters');

add_action('wp_enqueue_scripts', function() {
    wp_dequeue_style('classic-theme-styles');
}, 20);




// NEED FIELD WITCH IDS, NAME IS : carusel_item_for_article_1 or carusel_item_for_article_2
add_shortcode( 'show_table_plus_and_minus', 'show_table_plus_and_minus_shortcode' );
function show_table_plus_and_minus_shortcode( $atts ) {
    //if (!empty($atts['plus1']) && !empty($atts['minus1'])){


        $plus_and_minus_tab = array();
        for ($i = 1; $i< 10; $i++){

            if(isset($atts['plus' . $i])){
                $plus_and_minus_tab[$i]['plus'] = $atts['plus' . $i];
            }

            if(isset($atts['minus' . $i])){
                $plus_and_minus_tab[$i]['minus'] = $atts['minus' . $i];
            }

        }


        $params  = $plus_and_minus_tab;

        ob_start();
        get_template_part( 'inc/table_shortkode', null, $params);
        $html = ob_get_contents();
        ob_end_clean();

        return $html;

}


add_shortcode( 'faq', 'faq_shortcode' );
function faq_shortcode( $atts ) {

        $plus_and_minus_tab = array();
        for ($i = 1; $i< 10; $i++){

            if(isset($atts['name' . $i])){
                $plus_and_minus_tab[$i]['name'] = $atts['name' . $i];
            }

            if(isset($atts['content' . $i])){
                $plus_and_minus_tab[$i]['content'] = $atts['content' . $i];
            }

        }

        $params['DATA']  = $plus_and_minus_tab;

        if($atts['title']){
            $params['title'] = $atts['title'];
        }

        ob_start();
        get_template_part( 'inc/faq_shortcode', null, $params);
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
}

function get_all_banks_rating() {

     $args1 = array(
       'posts_per_page' => -1,
       'post_type' => 'banks',
       'orderby' => array( 'ratings_average' => 'desc', 'name' => 'desc' ),
       'order' => 'DESC',
       'meta_query' =>  array(
           'relation' => 'OR',
           array(
               'key' => 'ratings_average',
               'compare' => 'EXISTS',
           ),
           array(
               'key' => 'ratings_average',
               'compare' => 'NOT EXISTS',
           )
       )
    );

    $banks_table = new WP_Query( $args1 );
    $counter_banks = 0;
    $all_banks_rating = [];
    if ( $banks_table->have_posts() ){
       while ( $banks_table->have_posts() ){
           $banks_table->the_post();
           $counter_banks+=1;
           $all_banks_rating[get_the_ID()] = $counter_banks;

       }
    }

    wp_reset_postdata();

    return $all_banks_rating;
}

//$test1 = false;
//if($_REQUEST['test1']){
//    $test1 = true;
//}

function get_metrika_for_list($field){

    $arr_link = explode('/',$field);

    $with_referal = false;

    if(isset($arr_link[3]) && $arr_link[3] == 'recommends'){
        $with_referal = true;
    }

    if($with_referal == true){
        $metrika = "
        ym(35020350,'reachGoal','click_oformit_listing');
        ym(35020350,'reachGoal','click_na_vse_oformit_s_referalkoy');
        ";

    }else{
        $metrika = "
        ym(35020350,'reachGoal','click_oformit_listing'); 
        ym(35020350,'reachGoal','click_na_oformit_listing_bez_referalki');
        ym(35020350,'reachGoal','click_na_vse_oformit_bez_referalki');
        ";

    }

    return  $metrika;

}

function get_metrika_for_best_pages($field){

    $arr_link = explode('/',$field);

    $with_referal = false;

    if(isset($arr_link[3]) && $arr_link[3] == 'recommends'){
        $with_referal = true;
    }

    if($with_referal == true){
        $metrika = "ym(35020350,'reachGoal','OFFERWALL_CLICK_OFFER');";
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_s_referalkoy');";
    }else{
        $metrika = "ym(35020350,'reachGoal','click_na_oformit_luchshee_bez_referalki');";
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_bez_referalki');";
    }

    return $metrika;

}

function get_metrika_for_detail_page($field){

    $arr_link = explode('/',$field);

    $with_referal = false;

    if(isset($arr_link[3]) && $arr_link[3] == 'recommends'){
        $with_referal = true;
    }

    if($with_referal == true){
        $metrika = "ym(35020350,'reachGoal','click_oformit_seychas', {URL: document.location.href});";
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_s_referalkoy');";
    }else{
        $metrika = "ym(35020350,'reachGoal','click_oformit_seychas', {URL: document.location.href});";
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_bez_referalki');";
    }

    return $metrika;
}

function get_metrika_for_ajax_random_offers($field){

    $arr_link = explode('/',$field);

    $with_referal = false;

    if(isset($arr_link[3]) && $arr_link[3] == 'recommends'){
        $with_referal = true;
    }

    if($with_referal == true){
        $metrika = "ym(35020350,'reachGoal','click_na_vse_oformit_s_referalkoy');";
        $metrika .= " ym(35020350,'reachGoal','oformit_vitrina_v_listningah');";
    }else{
        $metrika = " ym(35020350,'reachGoal','Click_na_oformit_seychas_bez_referalki');";
        $metrika .= " ym(35020350,'reachGoal','oformit_vitrina_v_listningah')";
    }

    return $metrika;
}

function get_metrika_for_popap_apply($field){

    $arr_link = explode(    '/',$field);

    $with_referal = false;

    if(isset($arr_link[3]) && $arr_link[3] == 'recommends'){
        $with_referal = true;
    }


    if($with_referal == true){
        $metrika = "ym(35020350,'reachGoal','exit_popup_click');";
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_s_referalkoy'); ";
    }else{
        $metrika = "ym(35020350,'reachGoal','exit_popup_click');";
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_bez_referalki'); ";
    }

    return $metrika;
}

function get_metrika_for_offers_in_article($field){

    $arr_link = explode(    '/',$field);

    $with_referal = false;

    if(isset($arr_link[3]) && $arr_link[3] == 'recommends'){
        $with_referal = true;
    }


    if($with_referal == true){
        $metrika = "ym(35020350,'reachGoal','click_oformit_vitrina_v_journale');";
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_s_referalkoy'); ";
    }else{
        $metrika = "ym(35020350,'reachGoal','click_oformit_vitrina_v_journale');";
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_bez_referalki'); ";
    }

    return $metrika;
}

function get_metrika_for_category_offer($field){
    $arr_link = explode('/',$field);
    $with_referal = false;
    if(isset($arr_link[3]) && $arr_link[3] == 'recommends'){
        $with_referal = true;
    }
    if($with_referal == true){
        $metrika = " ym(35020350,'reachGoal','click_na_vse_oformit_s_referalkoy'); ";
    }else{
        $metrika = " ym(35020350,'reachGoal','click_na_vse_oformit_bez_referalki'); ";
    }

    return $metrika;
}




function get_metrika_for_exit_popap($field){
    $arr_link = explode('/',$field);
    $with_referal = false;
    if(isset($arr_link[3]) && $arr_link[3] == 'recommends'){
        $with_referal = true;
    }

    $metrika = "ym(35020350,'reachGoal','1EX_POPUP_cr'); ym(35020350,'reachGoal','exit_popup_click'); ym(35020350,'reachGoal','exit_popup_click_test'); return true;";

    if($with_referal == true){
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_s_referalkoy'); ";
    }else{
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_bez_referalki'); ";
    }

    return $metrika;
}


function get_metrika_for_exit_popap_with_tag($field){
    $arr_link = explode('/',$field);
    $with_referal = false;
    if(isset($arr_link[3]) && $arr_link[3] == 'recommends'){
        $with_referal = true;
    }

    $metrika = "ym(35020350,'reachGoal','2EX_POPUP_cr'); ym(35020350,'reachGoal','exit_popup_click'); ym(35020350,'reachGoal','exit_popup_click_test'); return true;";

    if($with_referal == true){
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_s_referalkoy'); ";
    }else{
        $metrika .= " ym(35020350,'reachGoal','click_na_vse_oformit_bez_referalki'); ";
    }

    return $metrika;
}



/** @var WP_Post $obj */
//add_filter( 'wpseo_sitemap_entry', function ( $url, $string, $obj ) {
//	/** @var WP_Term $category */
//	$category = get_the_category( $obj->ID )[0];
//	if ( $category->slug !== 'bankcard' ) {
//		return $url;
//	}
//
//	return null;
//}, 10, 3 );

    	/* Exclude One Taxonomy From Yoast SEO Sitemap */
//function sitemap_exclude_taxonomy( $value, $taxonomy) {
//if ($taxonomy == 'bankcard') return true;
//}
//add_filter( 'wpseo_sitemap_exclude_taxonomy', 'sitemap_exclude_taxonomy', 10, 2 );

function price_format($num){
    if($num){
        return number_format($num, 0, '.', ' ');
    }
}

//<option value="credit_inputs_range" selected>Кредитные карты</option>
//<option value="debet_inputs_range">Дебетовые карты</option>
//<option value="install_inputs_range">Карты рассрочки</option>
//<option value="kredity_inputs_range">Кредиты</option>
//<option value="zaimy_inputs_range">Займы</option>


$filter_price = [
    'credit_inputs_range' => [
        'max' => 2000000,
        'day_max' => 365,
        'attr_price' => 'max="2000000" value="2 000 000" min="0"',
        'attr_day' => 'max="365" value="365" min="0"',
    ],
    'debet_inputs_range' => [
        'max' => 600000,
        'day_max' => 50,
        'attr_price' => 'max="600000" value="600000" min="0"',
        'attr_day' => 'max="50" value="30" min="0"',
    ],
    // карты рассрочки
    'install_inputs_range' => [
        'max' => 1000000,
        'day_max' => 730,
        'attr_price' => 'max="1000000" value="1000000" min="0"',
        'attr_day' => 'max="730" value="730" min="0"',
    ],
    'kredity_inputs_range' => [
        'max' => 40000000,
        'day_max' => 180,
        'attr_price' => 'max="40000000" value="40000000" min="0"',
        'attr_day' => 'max="180" value="24" min="0"',
    ],
    // займы
    'zaimy_inputs_range' => [
        'max' => 1000000,
        'day_max' => 1095,
        'attr_price' => 'max="1000000" value="15000" min="0"',
        'attr_day' => 'max="1095" value="24" min="0"',
    ]
];
function get_filter_price(){
    return [
    'credit_inputs_range' => [
        'max' => 2000000,
        'day_max' => 365,
        'attr_price' => 'max="2000000" value="2 000 000" min="0"',
        'attr_day' => 'max="365" value="365" min="0"',
    ],
    'debet_inputs_range' => [
        'max' => 600000,
        'day_max' => 50,
        'attr_price' => 'max="600000" value="600000" min="0"',
        'attr_day' => 'max="50" value="30" min="0"',
    ],
    // карты рассрочки
    'install_inputs_range' => [
        'max' => 1000000,
        'day_max' => 730,
        'attr_price' => 'max="1000000" value="1000000" min="0"',
        'attr_day' => 'max="730" value="730" min="0"',
    ],
    'kredity_inputs_range' => [
        'max' => 40000000,
        'day_max' => 180,
        'attr_price' => 'max="40000000" value="40000000" min="0"',
        'attr_day' => 'max="180" value="24" min="0"',
    ],
    // займы
    'zaimy_inputs_range' => [
        'max' => 1000000,
        'day_max' => 1095,
        'attr_price' => 'max="1000000" value="15000" min="0"',
        'attr_day' => 'max="1095" value="24" min="0"',
    ]
];
}



add_action('wpseo_register_extra_replacements', 'register_custom_yoast_variables');
function get_page_from_url() {
    global $wp_query;
   if (is_front_page()) {
        $currentPage = (get_query_var("page")) ? get_query_var("page") : 1;
    } else {
        $currentPage = (get_query_var("paged")) ? get_query_var("paged") : 1;
    }
    return $currentPage;
}
function register_custom_yoast_variables() {
    wpseo_register_var_replacement('%%page_main%%', 'get_page_from_url', 'advanced', 'Значение текущий странице');
}

function register_my_session(){
    if( ! session_id() ) {
        session_start();
    }
}

add_action('init', 'register_my_session');


//add_rewrite_rule( '^(parent/slug)/([^/]*)', 'index.php?pagename=$matches[1]&foo=$matches[2]', 'top' );
//add_rewrite_rule( '^(banki/vtb)/([^/]*)', 'index.php?pagename=$matches[1]&foo=$matches[2]', 'top' );


add_action('init', 'do_rewrite');
function do_rewrite(){

    	// скажем WP, что есть новые параметры запроса
	add_filter( 'query_vars', function( $vars ){
		$vars[] = 'food';
		$vars[] = 'variety';
		return $vars;
	} );


    // Правило перезаписи
	add_rewrite_rule( '^(nutrition)/([^/]*)/([^/]*)/?', 'index.php?pagename=$matches[1]&food=$matches[2]&variety=$matches[3]', 'top' );
	// нужно указать ?p=123 если такое правило создается для записи 123
	// первый параметр для записей: p или name, для страниц: page_id или pagename






}


add_action('wp_ajax_get_popap_apply', 'get_popap_apply_handler');
add_action('wp_ajax_nopriv_get_popap_apply', 'get_popap_apply_handler');
function get_popap_apply_handler(){


     $ID = $_REQUEST['id'];

     if($_REQUEST['title']){
         $title = $_REQUEST['title'];
     }else{
         $title = false;
     }

     $apply_now = get_field('apply_now_select_products', $ID);

     // Если нету привязки, то берем с админ настроек
     if(!$apply_now){

        $term = $_REQUEST['term'];

        if ($term == 'debetcard' || $term == 'debatcard'){
            $term = 'debetcard';
        }

        $apply_now = get_field('random_select_offers_in_list_get_link_from_api_' . $term, 'option');

     }


     ob_start();

     get_template_part( 'all_template/popap_apply_now', null, ['DATA' => $apply_now , 'title' => $title]);


    $posts_html = ob_get_contents();
    ob_end_clean();


    echo json_encode(
        array(
            'id' => $ID,
            'content' => $posts_html,
        )
    );

    die();

}



add_action('wp_ajax_get_more_details', 'get_more_details_handler');
add_action('wp_ajax_nopriv_get_more_details', 'get_more_details_handler');
function get_more_details_handler(){


    $ID = $_REQUEST['id'];

    ob_start();
    get_template_part( 'all_template/get_more_details', null, ['DATA' => [] , 'ID' => $ID]);
    $posts_html = ob_get_contents();
    ob_end_clean();

    echo json_encode(
        array(
            'id' => $ID,
            'content' => $posts_html,
        )
    );

    die();

}
//
//remove_filter( 'get_the_excerpt', 'wp_trim_excerpt', 10, 2 );
//
//add_filter( 'get_the_excerpt', function ( $excerpt, $post ) {
//
//    return wp_trim_words( the_content(), 50, ' ...' );
//    //wp_trim_excerpt( '', $post_id )
//    //return $post->post_excerpt ?
//    //    'Has custom excerpt: ' . $excerpt :
//    //    'Here, create your own excerpt.';
//}, 10, 2 );


//if( get_previous_posts_link() and get_next_posts_link() ){
//    function custom_document_title( $title ) {
//        return 'Here is the new title';
//    }
//
//    add_filter( 'pre_get_document_title', 'custom_document_title', 10 );
//
//
//}

//add_filter('pre_get_document_title', 'change_404_title');

//add_filter('pre_get_document_title', 'change_404_title', 50);
//function change_404_title($title) {
//if (is_paged()) {
//    return 'My Custom Title';
//}
//return $title;
//}




//Есть пагинация на страницах
function is_paginated() {
    global $wp_query;
    if ( $wp_query->max_num_pages > 1 ) {
        return $wp_query->max_num_pages;
    } else {
        return false;
    }
}

function prefix_filter_title_example( $title ) {


        global $wp_query;

        //print_r2($wp_query);

  if (is_paginated() ||  is_reviews_page() ) {

      //print_r2($GLOBALS);

      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
      $all_page_count = is_paginated();

      //if($all_page_count == false){
      //
      //    if(isset($_SESSION['glob_max_num_pages'])) {
      //          $all_page_count = $_SESSION['glob_max_num_pages'];
      //    }
      //
      //}



      $title = $title . ' — страница ' . $paged . ' из ' . $all_page_count;

  }

  return $title;
}
add_filter( 'wpseo_title', 'prefix_filter_title_example');


function prefix_filter_description_example( $description ) {
    if (is_paginated() ||  is_reviews_page() ) {

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $all_page_count = is_paginated();
        $description = $description . ' — страница ' . $paged . ' из ' . $all_page_count;

    }

    return $description;
}
add_filter( 'wpseo_metadesc', 'prefix_filter_description_example');


function is_reviews_page() {
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[0];
    $findme   = 'reviews';

    return mb_substr_count($url, $findme);
}


require_once __DIR__ . '/roman-functions.php';
require_once __DIR__ . '/danil-functions.php';



