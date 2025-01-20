<?php

//echo 'ROMAN';

function enqueue_slick_slider_assets()
{
    // Подключение CSS Slick Slider
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');

    // Подключение JS Slick Slider
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider_assets');



function display_star_rating($rating, $rating_block = 'ratings_list')
{
    $output = '<div class="stars">';
    $full_stars = floor($rating);
    $half_star = ($rating - $full_stars) >= 0.5 ? true : false;
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $full_stars) {
            $output .= '<span class="star filled" data-value="' . $i . '" data-rating-block="' . esc_attr($rating_block) . '">★</span>';
        } elseif ($half_star && $i == $full_stars + 1) {
            $output .= '<span class="star half" data-value="' . $i . '" data-rating-block="' . esc_attr($rating_block) . '">★</span>'; // Можно заменить на ползвёздочки
        } else {
            $output .= '<span class="star" data-value="' . $i . '" data-rating-block="' . esc_attr($rating_block) . '">☆</span>';
        }
    }
    $output .= '</div>';
    echo $output;
}

function enqueue_ratings_scripts()
{
    // Подключаем основной скрипт
    wp_enqueue_script('ratings-script', get_template_directory_uri() . '/js/ratings.js', array(), '1.0', true);

    // Локализуем скрипт для передачи AJAX URL и nonce
    wp_localize_script('ratings-script', 'my_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('submit-rating-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ratings_scripts');



// AJAX обработчики
add_action('wp_ajax_submit_rating', 'handle_submit_rating');
add_action('wp_ajax_nopriv_submit_rating', 'handle_submit_rating');

function handle_submit_rating()
{
    // Проверка nonce
    $nonce = isset($_POST['security']) ? sanitize_text_field($_POST['security']) : '';
    if (!wp_verify_nonce($nonce, 'submit-rating-nonce')) {
        wp_send_json_error('Неверный токен безопасности.');
        wp_die();
    }

    // Получение данных
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $rating_block = isset($_POST['rating_block']) ? sanitize_text_field($_POST['rating_block']) : '';
    $rating_index = isset($_POST['rating_index']) ? intval($_POST['rating_index']) : -1;
    $rating_value = isset($_POST['rating_value']) ? intval($_POST['rating_value']) : 0;

    // Валидация данных
    if ($post_id <= 0 || $rating_index < 0 || $rating_value < 1 || $rating_value > 5) {
        wp_send_json_error('Некорректные данные рейтинга.');
        wp_die();
    }

    // Проверка существования поста
    if (!get_post($post_id)) {
        wp_send_json_error('Пост не найден.');
        wp_die();
    }

    // Получение Repeater полей на основе rating_block
    $field_name = $rating_block; // Например, 'ratings_list' или 'additional_ratings_list'

    if (have_rows($field_name, $post_id)) {
        $rows = get_field($field_name, $post_id);
        if (isset($rows[$rating_index])) {
            // Получение текущих значений
            $current_total = isset($rows[$rating_index]['rating_total']) ? intval($rows[$rating_index]['rating_total']) : 0;
            $current_count = isset($rows[$rating_index]['rating_count']) ? intval($rows[$rating_index]['rating_count']) : 0;

            // Обновление значений
            $new_total = $current_total + $rating_value;
            $new_count = $current_count + 1;
            $new_average = $new_total / $new_count;
            $new_average = round($new_average, 1);

            // Обновление Repeater строки
            $rows[$rating_index]['rating_total'] = $new_total;
            $rows[$rating_index]['rating_count'] = $new_count;
            $rows[$rating_index]['rating'] = $new_average;

            // Сохранение обновлённых данных
            update_field($field_name, $rows, $post_id);

            // Возвращаем успешный ответ
            wp_send_json_success(array('new_average' => $new_average));
        } else {
            wp_send_json_error('Неверный индекс рейтинга.');
        }
    } else {
        wp_send_json_error('Рейтинги не найдены.');
    }

    wp_die();
}



// Регистрация Типа Записи additional_comment с поддержкой иерархии
function register_additional_comment_post_type()
{
    $labels = array(
        'name'                  => _x('Дополнительные комментарии', 'Post type general name', 'finabank.ru'),
        'singular_name'         => _x('Дополнительный комментарий', 'Post type singular name', 'finabank.ru'),
        'menu_name'             => _x('Доп. Комментарии', 'Admin Menu text', 'finabank.ru'),
        'name_admin_bar'        => _x('Доп. Комментарий', 'Add New on Toolbar', 'finabank.ru'),
        'add_new'               => __('Добавить новый', 'finabank.ru'),
        'add_new_item'          => __('Добавить новый комментарий', 'finabank.ru'),
        'new_item'              => __('Новый комментарий', 'finabank.ru'),
        'edit_item'             => __('Редактировать комментарий', 'finabank.ru'),
        'view_item'             => __('Просмотреть комментарий', 'finabank.ru'),
        'all_items'             => __('Все комментарии', 'finabank.ru'),
        'search_items'          => __('Найти комментарии', 'finabank.ru'),
        'not_found'             => __('Комментариев не найдено.', 'finabank.ru'),
        'not_found_in_trash'    => __('В корзине комментариев не найдено.', 'finabank.ru'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false, // Сделать тип записи невидимым на фронтенде
        'publicly_queryable' => false,
        'show_ui'            => true, // Отображать в админке
        'show_in_menu'       => true,
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => true, // Сделать тип записи иерархическим
        'menu_position'      => 20,
        'supports'           => array('title', 'editor', 'author', 'page-attributes'), // Добавить 'page-attributes' для поддержки порядка
    );

    register_post_type('additional_comment', $args);
}
add_action('init', 'register_additional_comment_post_type');

// Функция для отображения комментариев и ответов
function display_additional_comments($post_id, $parent = 0, $level = 0)
{
    $args = array(
        'post_type'      => 'additional_comment',
        'post_parent'    => $parent,
        'meta_query'     => array(
            array(
                'key'     => 'related_post',
                'value'   => $post_id,
                'compare' => '=',
                'type'    => 'NUMERIC',
            ),
        ),
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    );

    $comments = new WP_Query($args);

    if ($comments->have_posts()) {
        echo '<ul class="additional-comments-level-' . esc_attr($level) . '">';
        while ($comments->have_posts()) {
            $comments->the_post();
            $comment_id = get_the_ID();
            $author_name = get_field('author_name');
            $author_email = get_field('author_email');
            $comment_content = get_field('comment_content');
            $comment_date = get_the_date();

            // Извлечение лайков и дизлайков
            $likes = intval(get_field('likes', $comment_id));
            $dislikes = intval(get_field('dislikes', $comment_id));

?>
            <li class="additional-comment">
                <div class="additional-comment__header">
                    <div class="additional-comment__avatar"></div>
                    <div class="">

                        <div class="comment__one-title mb-2 mb-md-0"><?php echo esc_html($author_name); ?></div>
                        <div class="comment__one-date mr-md-4 order-md-1"><?php echo esc_html($comment_date); ?></div>
                    </div>
                </div>
                <div class="additional-comment__content"><?php echo esc_html($comment_content); ?></div>
                <div class="additional-comment__actions">
                    <button class="like-button btn btn-sm btn-outline-success" data-comment-id="<?php echo esc_attr($comment_id); ?>">
                        <!-- SVG иконка "Лайк" -->
                        <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.75 4.5L2.32258 2.84722C3.57668 1.52915 4.20373 0.870122 4.968 0.768647C5.15526 0.743785 5.34474 0.743785 5.532 0.768647C6.29627 0.870122 6.92332 1.52915 8.17742 2.84722L9.75 4.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
                        </svg>
                        <span class="like-count"><?php echo $likes; ?></span>
                    </button>
                    <button class="dislike-button btn btn-sm btn-outline-danger" data-comment-id="<?php echo esc_attr($comment_id); ?>">
                        <!-- SVG иконка "Дизлайк" -->
                        <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.25 1.5L8.67742 3.15278C7.42332 4.47085 6.79627 5.12988 6.032 5.23135C5.84474 5.25621 5.65526 5.25621 5.468 5.23135C4.70373 5.12988 4.07668 4.47085 2.82258 3.15278L1.25 1.5" stroke="#626B84" stroke-width="1.2" stroke-linecap="round" />
                        </svg>
                        <span class="dislike-count"><?php echo $dislikes; ?></span>
                    </button>
                    <button class="reply-button btn" data-comment-id="<?php echo esc_attr($comment_id); ?>">Ответить</button>
                </div>
                <div class="reply-form-container" id="reply-form-container-<?php echo esc_attr($comment_id); ?>" style="display: none; margin-top: 15px;"></div>
                <?php
                // Рекурсивный вызов для отображения ответов
                display_additional_comments(get_the_ID(), $comment_id, $level + 1);
                ?>
            </li>
<?php
        }
        echo '</ul>';
        wp_reset_postdata();
    }
}

// Функция для установки заголовка комментария после сохранения через ACF
function set_additional_comment_title($post_id)
{
    // Проверяем, что это наш тип записи
    if (get_post_type($post_id) != 'additional_comment') return;

    // Получаем значения полей
    $author_name = get_field('author_name', $post_id);
    $author_email = get_field('author_email', $post_id);

    // Формируем новый заголовок
    $new_title = $author_name . ' (' . $author_email . ')';

    // Обновляем post_title только если он не установлен или изменился
    $current_title = get_the_title($post_id);
    if ($current_title != $new_title) {
        wp_update_post(array(
            'ID'         => $post_id,
            'post_title' => $new_title,
        ));
    }
}
add_action('acf/save_post', 'set_additional_comment_title', 20);

// Регистрация Скриптов для AJAX
function enqueue_additional_comment_scripts()
{
    // Скрипт для отправки комментариев
    wp_enqueue_script('additional-comment-ajax', get_template_directory_uri() . '/js/additional-comment-ajax.js', array('jquery'), '1.0', true);

    wp_localize_script('additional-comment-ajax', 'ajax_object_comment', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'current_post_id' => get_the_ID(),
        'comment_nonce' => wp_create_nonce('additional_comment_form'),
    ));

    // Скрипт для обработки ответов на комментарии
    wp_enqueue_script('additional-comment-reply-ajax', get_template_directory_uri() . '/js/additional-comment-reply-ajax.js', array('jquery'), '1.0', true);

    wp_localize_script('additional-comment-reply-ajax', 'ajax_object_reply', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'current_post_id' => get_the_ID(),
        'reply_nonce' => wp_create_nonce('additional_comment_reply_form'),
    ));

    // Скрипт для лайков и дизлайков
    wp_enqueue_script('additional-comment-like-dislike', get_template_directory_uri() . '/js/additional-comment-like-dislike.js', array('jquery'), '1.0', true);

    wp_localize_script('additional-comment-like-dislike', 'ajax_object_like_dislike', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'like_dislike_nonce' => wp_create_nonce('like_dislike_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_additional_comment_scripts');

// AJAX Обработчик для создания комментариев
function handle_additional_comment_ajax()
{
    // Проверка nonce
    if (!isset($_POST['additional_comment_nonce']) || !wp_verify_nonce($_POST['additional_comment_nonce'], 'additional_comment_form')) {
        wp_send_json_error('Ошибка безопасности.');
    }

    // Валидация и Санитизация данных
    $author_name = sanitize_text_field($_POST['acf']['field_675ae76ee8992']); // Замените 'field_675ae76ee8992' на ваш реальный ключ поля
    $author_email = sanitize_email($_POST['acf']['field_675ae7d4b0bdc']); // Замените 'field_675ae7d4b0bdc' на ваш реальный ключ поля
    $comment_content = sanitize_textarea_field($_POST['acf']['field_675ae80ab0bdd']); // Замените 'field_675ae80ab0bdd' на ваш реальный ключ поля
    $related_post = intval($_POST['acf']['field_related_post']); // Замените 'field_related_post' на ваш реальный ключ поля

    // Проверка существования связанного поста
    if (!get_post($related_post)) {
        wp_send_json_error('Указанный пост не найден.');
    }

    // Создание новой записи комментария без установки post_title
    $new_comment = array(
        'post_content'  => $comment_content,
        'post_status'   => 'pending', // Или 'publish' сразу
        'post_type'     => 'additional_comment',
        'post_author'   => get_current_user_id(),
    );

    $comment_id = wp_insert_post($new_comment);

    if ($comment_id) {
        // Добавление метаполей
        update_field('author_name', $author_name, $comment_id);
        update_field('author_email', $author_email, $comment_id);
        update_field('related_post', $related_post, $comment_id);
        update_field('comment_content', $comment_content, $comment_id);
        // Инициализация полей лайков и дизлайков
        update_field('likes', 0, $comment_id);
        update_field('dislikes', 0, $comment_id);
        // Добавьте другие мета-поля при необходимости

        // Установка post_title после обновления метаполей
        $new_title = $author_name . ' (' . $author_email . ')';
        wp_update_post(array(
            'ID'         => $comment_id,
            'post_title' => $new_title,
        ));

        wp_send_json_success('Ваш комментарий успешно отправлен и ожидает модерации.');
    } else {
        wp_send_json_error('Произошла ошибка при отправке комментария.');
    }
}

add_action('wp_ajax_handle_additional_comment_ajax', 'handle_additional_comment_ajax');
add_action('wp_ajax_nopriv_handle_additional_comment_ajax', 'handle_additional_comment_ajax');

// AJAX Обработчик для ответов на комментарии
function handle_additional_comment_reply_ajax()
{
    // Проверка nonce
    if (! isset($_POST['additional_comment_reply_nonce']) || ! wp_verify_nonce($_POST['additional_comment_reply_nonce'], 'additional_comment_reply_form')) {
        wp_send_json_error('Ошибка безопасности.');
    }

    // Валидация и Санитизация данных
    $author_name = sanitize_text_field($_POST['reply_author_name']);
    $author_email = sanitize_email($_POST['reply_author_email']);
    $comment_content = sanitize_textarea_field($_POST['reply_comment_content']);
    $related_post = intval($_POST['reply_related_post']);
    $parent_comment = intval($_POST['reply_parent_comment']);

    // Проверка существования связанного поста
    if (! get_post($related_post)) {
        wp_send_json_error('Указанный пост не найден.');
    }

    // Проверка существования родительского комментария
    if (! get_post($parent_comment) || get_post_type($parent_comment) != 'additional_comment') {
        wp_send_json_error('Родительский комментарий не найден.');
    }

    // Создание новой записи ответа
    $new_comment = array(
        'post_content'  => $comment_content,
        'post_status'   => 'pending', // Или 'publish' сразу
        'post_type'     => 'additional_comment',
        'post_author'   => get_current_user_id(),
        'post_parent'   => $parent_comment, // Установка родительского комментария
    );

    $comment_id = wp_insert_post($new_comment);

    if ($comment_id) {
        // Добавление метаполей
        update_field('author_name', $author_name, $comment_id);
        update_field('author_email', $author_email, $comment_id);
        update_field('related_post', $related_post, $comment_id);
        update_field('comment_content', $comment_content, $comment_id);
        // Инициализация полей лайков и дизлайков
        update_field('likes', 0, $comment_id);
        update_field('dislikes', 0, $comment_id);
        // Добавьте другие метаполя при необходимости

        // Установка post_title после обновления метаполей
        $new_title = $author_name . ' (' . $author_email . ')';
        wp_update_post(array(
            'ID'         => $comment_id,
            'post_title' => $new_title,
        ));

        // Форматируем дату для вывода
        $comment_date = get_the_date('', $comment_id);

        // Возвращаем данные для отображения
        wp_send_json_success(array(
            'author_name' => $author_name,
            'author_email' => $author_email,
            'comment_content' => $comment_content,
            'comment_date' => $comment_date,
            'comment_id' => $comment_id,
        ));
    } else {
        wp_send_json_error('Произошла ошибка при отправке комментария.');
    }
}
add_action('wp_ajax_handle_additional_comment_reply_ajax', 'handle_additional_comment_reply_ajax');
add_action('wp_ajax_nopriv_handle_additional_comment_reply_ajax', 'handle_additional_comment_reply_ajax');

// AJAX Обработчик для Лайков и Дизлайков
function handle_like_dislike_ajax()
{
    // Проверка nonce
    if (! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'like_dislike_nonce')) {
        wp_send_json_error('Ошибка безопасности.');
    }

    // Валидация и Санитизация данных
    $comment_id = intval($_POST['comment_id']);
    $type = sanitize_text_field($_POST['type']);

    // Проверка существования комментария
    $comment = get_post($comment_id);
    if (!$comment || get_post_type($comment_id) != 'additional_comment') {
        wp_send_json_error('Комментарий не найден.');
    }

    // Получение текущих значений лайков и дизлайков
    $likes = intval(get_field('likes', $comment_id));
    $dislikes = intval(get_field('dislikes', $comment_id));

    // Определение типа действия
    if ($type === 'like') {
        $likes += 1;
        update_field('likes', $likes, $comment_id);
    } elseif ($type === 'dislike') {
        $dislikes += 1;
        update_field('dislikes', $dislikes, $comment_id);
    } else {
        wp_send_json_error('Неверный тип действия.');
    }

    // Возвращаем обновленные значения
    wp_send_json_success(array(
        'likes' => $likes,
        'dislikes' => $dislikes,
    ));
}
add_action('wp_ajax_handle_like_dislike_ajax', 'handle_like_dislike_ajax');
add_action('wp_ajax_nopriv_handle_like_dislike_ajax', 'handle_like_dislike_ajax');

/**
 * Фильтр для модификации sitemap_index в Yoast SEO
 * Название хука может меняться в зависимости от версии плагина.
 * В старых версиях он назывался 'wpseo_sitemap_index', 
 * в новых — 'wpseo_sitemap_index_xml'
 */
add_filter('wpseo_sitemap_index', 'add_comments_sitemap');

function add_comments_sitemap($sitemap_index)
{
    // Вставляем нужную строку со своей картой
    // Важно: синтаксис XML должен быть корректен.
    $new_sitemap = "\n<sitemap>\n<loc>" . home_url('comments-sitemap.xml') . "</loc>\n</sitemap>\n";

    // Добавляем в конец существующего индекса
    $sitemap_index .= $new_sitemap;

    return $sitemap_index;
}

/**
 * Добавляем поле рейтинга (5 звёзд) к форме комментариев
 */
function mytheme_add_comment_rating_field() {
    // Выводим блок звёзд. В данном случае используем обычные HTML-символы ★/☆,
    // но можно подставить иконки, SVG, Dashicons и т.д.
    // Также используем radio input, чтобы отловить конкретное числовое значение (1–5).
    ?>
    <p class="comment-form-rating">
        <label for="rating"><?php _e('Ваш рейтинг'); ?></label>
        <span id="rating-stars">
            <input type="radio" name="comment_rating" value="5" id="rating-5">
            <label for="rating-5" title="5 звёзд">★</label>
            
            <input type="radio" name="comment_rating" value="4" id="rating-4">
            <label for="rating-4" title="4 звезды">★</label>
            
            <input type="radio" name="comment_rating" value="3" id="rating-3">
            <label for="rating-3" title="3 звезды">★</label>
            
            <input type="radio" name="comment_rating" value="2" id="rating-2">
            <label for="rating-2" title="2 звезды">★</label>
            
            <input type="radio" name="comment_rating" value="1" id="rating-1">
            <label for="rating-1" title="1 звезда">★</label>
        </span>
    </p>
    <?php
}
// Подключаем поле для авторизованных пользователей
add_action( 'comment_form_logged_in_after', 'mytheme_add_comment_rating_field' );
// И для неавторизованных (форма с полями «Имя», «Почта» и т.д.)
add_action( 'comment_form_after_fields', 'mytheme_add_comment_rating_field' );

/**
 * Сохраняем рейтинг комментария
 */
function mytheme_save_comment_rating( $comment_id ) {
    if ( isset($_POST['comment_rating']) && !empty($_POST['comment_rating']) ) {
        $rating = intval($_POST['comment_rating']);
        // Сохраняем рейтинг (число от 1 до 5) в метаполе comment_rating
        update_comment_meta( $comment_id, 'comment_rating', $rating );
    }
}
add_action( 'comment_post', 'mytheme_save_comment_rating' );

/**
 * Выводим звёзды перед текстом комментария
 */
function mytheme_display_comment_rating( $comment_text, $comment ) {
    // Получаем значение рейтинга из метаполя
    $rating = get_comment_meta( $comment->comment_ID, 'comment_rating', true );

    if ( $rating ) {
        // Генерируем HTML для звёзд
        // (можно заменить HTML-символы другими иконками, например Dashicons)
        $stars_html = '<div class="comment-rating">';
        for ( $i = 1; $i <= 5; $i++ ) {
            if ( $i <= $rating ) {
                $stars_html .= '<span style="color: #f5b301;">★</span>';
            } else {
                $stars_html .= '<span style="color: #ccc;">★</span>';
            }
        }
        $stars_html .= '</div>';

        // Приклеиваем блок со звёздами к тексту комментария
        $comment_text = $stars_html . $comment_text;
    }

    return $comment_text;
}
add_filter( 'comment_text', 'mytheme_display_comment_rating', 10, 2 );
