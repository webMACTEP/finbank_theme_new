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

// function handle_submit_rating()
// {
//     // Проверка nonce
//     $nonce = isset($_POST['security']) ? sanitize_text_field($_POST['security']) : '';
//     if (!wp_verify_nonce($nonce, 'submit-rating-nonce')) {
//         wp_send_json_error('Неверный токен безопасности.');
//         wp_die();
//     }

//     // Получение данных
//     $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
//     $rating_block = isset($_POST['rating_block']) ? sanitize_text_field($_POST['rating_block']) : '';
//     $rating_index = isset($_POST['rating_index']) ? intval($_POST['rating_index']) : -1;
//     $rating_value = isset($_POST['rating_value']) ? intval($_POST['rating_value']) : 0;

//     // Валидация данных
//     if ($post_id <= 0 || $rating_index < 0 || $rating_value < 1 || $rating_value > 5) {
//         wp_send_json_error('Некорректные данные рейтинга.');
//         wp_die();
//     }

//     // Проверка существования поста
//     if (!get_post($post_id)) {
//         wp_send_json_error('Пост не найден.');
//         wp_die();
//     }

//     // Получение Repeater полей на основе rating_block
//     $field_name = $rating_block; // Например, 'ratings_list' или 'additional_ratings_list'

//     if (have_rows($field_name, $post_id)) {
//         $rows = get_field($field_name, $post_id);
//         if (isset($rows[$rating_index])) {
//             // Получение текущих значений
//             $current_total = isset($rows[$rating_index]['rating_total']) ? intval($rows[$rating_index]['rating_total']) : 0;
//             $current_count = isset($rows[$rating_index]['rating_count']) ? intval($rows[$rating_index]['rating_count']) : 0;

//             // Обновление значений
//             $new_total = $current_total + $rating_value;
//             $new_count = $current_count + 1;
//             $new_average = $new_total / $new_count;
//             $new_average = round($new_average, 1);

//             // Обновление Repeater строки
//             $rows[$rating_index]['rating_total'] = $new_total;
//             $rows[$rating_index]['rating_count'] = $new_count;
//             $rows[$rating_index]['rating'] = $new_average;

//             // Сохранение обновлённых данных
//             update_field($field_name, $rows, $post_id);

//             // Возвращаем успешный ответ
//             wp_send_json_success(array('new_average' => $new_average));
//         } else {
//             wp_send_json_error('Неверный индекс рейтинга.');
//         }
//     } else {
//         wp_send_json_error('Рейтинги не найдены.');
//     }

//     wp_die();
// }

function handle_submit_rating()
{
    // Проверка nonce
    $nonce = isset($_POST['security']) ? sanitize_text_field($_POST['security']) : '';
    if (! wp_verify_nonce($nonce, 'submit-rating-nonce')) {
        wp_send_json_error('Неверный токен безопасности.');
        wp_die();
    }

    // Получение данных из AJAX
    $post_id       = isset($_POST['post_id'])       ? intval($_POST['post_id'])             : 0;
    $rating_block  = isset($_POST['rating_block'])  ? sanitize_text_field($_POST['rating_block']) : '';
    $rating_index  = isset($_POST['rating_index'])  ? intval($_POST['rating_index'])        : -1;
    $rating_value  = isset($_POST['rating_value'])  ? intval($_POST['rating_value'])        : 0;

    // Валидация
    if ($post_id <= 0 || $rating_index < 0 || $rating_value < 1 || $rating_value > 5) {
        wp_send_json_error('Некорректные данные рейтинга.');
        wp_die();
    }
    if (! get_post($post_id)) {
        wp_send_json_error('Пост не найден.');
        wp_die();
    }

    $field_name = $rating_block; // e.g. 'additional_ratings_list'

    // 1) Пытаемся получить значения у конкретного поста
    $rows    = get_field($field_name, $post_id);
    $context = $post_id;

    // 2) Если у поста нет своего Repeater — читаем из опций
    if (empty($rows) || ! is_array($rows)) {
        $rows    = get_field($field_name, 'option');
        $context = 'option';
    }

    // Проверяем, что такая строка действительно есть
    if (! is_array($rows) || ! isset($rows[$rating_index])) {
        wp_send_json_error('Рейтинги не найдены.');
        wp_die();
    }

    // Получаем текущие метрики
    $current_total  = isset($rows[$rating_index]['rating_total']) ? intval($rows[$rating_index]['rating_total']) : 0;
    $current_count  = isset($rows[$rating_index]['rating_count']) ? intval($rows[$rating_index]['rating_count']) : 0;

    // Пересчитываем
    $new_total   = $current_total + $rating_value;
    $new_count   = $current_count + 1;
    $new_average = round($new_total / $new_count, 1);

    // Обновляем массив строк
    $rows[$rating_index]['rating_total'] = $new_total;
    $rows[$rating_index]['rating_count'] = $new_count;
    $rows[$rating_index]['rating']       = $new_average;

    // Сохраняем обратно туда, где брали (в пост или в опции)
    update_field($field_name, $rows, $context);

    // Отдаем клиенту новый средний рейтинг
    wp_send_json_success(array('new_average' => $new_average));
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
            $comment_id    = get_the_ID();
            $author_name   = get_field('author_name');
            $author_email  = get_field('author_email');
            $comment_content = get_field('comment_content');
            $comment_date  = get_the_date();
            $comment_time  = get_the_time();

            // Извлечение лайков и дизлайков
            $likes    = intval(get_field('likes', $comment_id));
            $dislikes = intval(get_field('dislikes', $comment_id));

            // Получаем аватар автора (если поле задано, например 'author_avatar')
            $author_avatar = get_field('author_avatar');
            if (!$author_avatar) {
                // Если аватар не задан, выбираем случайное изображение из папки
                $random = rand(1, 444);
                // Если число меньше 10, добавляем ведущий ноль (например, 1 -> 01)
                $avatar_num = ($random < 10) ? sprintf("0%d", $random) : $random;
                // Формируем URL изображения; используем content_url(), чтобы получить URL к папке wp-content
                $author_avatar = content_url("avatars/avatar{$avatar_num}.jpg");
            } ?>

            <li class="additional-comment">
                <div class="additional-comment__header">
                    <div class="additional-comment__avatar">
                        <!-- Вывод аватара: -->
                        <!-- <img src="<?php echo esc_url($author_avatar); ?>" alt="avatar" /> -->
                    </div>

                    <div class="additional-row">
                        <div class="comment__one-title mb-2 mb-md-0"><?php echo esc_html($author_name); ?></div>
                        <div class="additional-status-date">
                            <div class="additional-status">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.4 7C15.4 8.87777 13.8778 10.4 12 10.4V11.6C14.5405 11.6 16.6 9.54051 16.6 7H15.4ZM12 10.4C10.1222 10.4 8.6 8.87777 8.6 7H7.4C7.4 9.54051 9.45949 11.6 12 11.6V10.4ZM8.6 7C8.6 5.12223 10.1222 3.6 12 3.6V2.4C9.45949 2.4 7.4 4.45949 7.4 7H8.6ZM12 3.6C13.8778 3.6 15.4 5.12223 15.4 7H16.6C16.6 4.45949 14.5405 2.4 12 2.4V3.6ZM9 14.6H15V13.4H9V14.6ZM15 21.4H9V22.6H15V21.4ZM9 21.4C7.12223 21.4 5.6 19.8778 5.6 18H4.4C4.4 20.5405 6.45949 22.6 9 22.6V21.4ZM18.4 18C18.4 19.8778 16.8778 21.4 15 21.4V22.6C17.5405 22.6 19.6 20.5405 19.6 18H18.4ZM15 14.6C16.8778 14.6 18.4 16.1222 18.4 18H19.6C19.6 15.4595 17.5405 13.4 15 13.4V14.6ZM9 13.4C6.45949 13.4 4.4 15.4595 4.4 18H5.6C5.6 16.1222 7.12223 14.6 9 14.6V13.4Z" fill="#9CA3AF" />
                                </svg>
                                Гость
                            </div>
                            <div class="comment__one-date-mob"><?php echo esc_html($comment_date); ?> в <?php echo esc_html($comment_time); ?></div>
                        </div>

                    </div>
                </div>
                <div class="additional-comment__content"><?php echo esc_html($comment_content); ?></div>
                <div class="additional-row additional-row-btns">
                    <div class="additional-btns">
                        <div class="comment__one-date mr-md-4 order-md-1"><?php echo esc_html($comment_date); ?> в <?php echo esc_html($comment_time); ?></div>
                        <button class="reply-button btn" data-comment-id="<?php echo esc_attr($comment_id); ?>">Ответить</button>
                    </div>

                    <div class="additional-comment__actions">
                        <button class="like-button btn btn-sm btn-outline-success" data-comment-id="<?php echo esc_attr($comment_id); ?>">
                            <!-- SVG иконка "Лайк" -->
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9063 7.22222H15.1965C16.5355 7.22222 17.4063 8.613 16.8075 9.79505L13.6555 16.0173C13.3504 16.6196 12.7268 17 12.0445 17H8.4263C8.27903 17 8.13232 16.9822 7.98946 16.9469L4.60228 16.1111M10.9063 7.22222V2.77778C10.9063 1.79594 10.0999 1 9.10514 1H9.01915C8.56927 1 8.20457 1.35997 8.20457 1.80402C8.20457 2.43896 8.01415 3.05969 7.65733 3.58799L4.60228 8.11111V16.1111M10.9063 7.22222H9.10514M4.60228 16.1111H2.80114C1.8064 16.1111 1 15.3152 1 14.3333V9C1 8.01816 1.8064 7.22222 2.80114 7.22222H5.05257" stroke="#7b8aa3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <span class="like-count"><?php echo $likes; ?></span>
                        </button>
                        <button class="dislike-button btn btn-sm btn-outline-danger" data-comment-id="<?php echo esc_attr($comment_id); ?>">
                            <!-- SVG иконка "Дизлайк" -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.09372 11.7778H3.80347C2.46453 11.7778 1.59368 10.387 2.19248 9.20495L5.34447 2.98273C5.64957 2.38045 6.27324 2 6.95546 2H10.5737C10.721 2 10.8677 2.01783 11.0105 2.05308L14.3977 2.88889M8.09372 11.7778V16.2222C8.09372 17.2041 8.90012 18 9.89486 18H9.98084C10.4307 18 10.7954 17.64 10.7954 17.196C10.7954 16.561 10.9858 15.9403 11.3427 15.412L14.3977 10.8889V2.88889M8.09372 11.7778H9.89486M14.3977 2.88889H16.1989C17.1936 2.88889 18 3.68483 18 4.66667V10C18 10.9818 17.1936 11.7778 16.1989 11.7778H13.9474" stroke="#7b8aa3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <span class="dislike-count"><?php echo $dislikes; ?></span>
                        </button>
                    </div>
                </div>

                <div class="reply-form-container" id="reply-form-container-<?php echo esc_attr($comment_id); ?>" style="display: none; margin-top: 15px;"></div>
                <?php
                // Рекурсивный вызов для отображения ответов
                display_additional_comments($post_id, $comment_id, $level + 1);
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

    // Валидация и санитизация данных
    $comment_id = intval($_POST['comment_id']);
    $type       = sanitize_text_field($_POST['type']);
    // Проверяем параметр cancel (он может быть строкой "true", числом или boolean)
    $cancel = (isset($_POST['cancel']) && $_POST['cancel']) ? true : false;

    // Проверка существования комментария
    $comment = get_post($comment_id);
    if (! $comment || get_post_type($comment_id) != 'additional_comment') {
        wp_send_json_error('Комментарий не найден.');
    }

    // Получение текущих значений лайков и дизлайков
    $likes    = intval(get_field('likes', $comment_id));
    $dislikes = intval(get_field('dislikes', $comment_id));

    // Определение типа действия с учётом отмены
    if ($type === 'like') {
        if ($cancel) {
            // Отмена лайка: уменьшаем значение, но не ниже 0
            $likes = max(0, $likes - 1);
        } else {
            // Добавление лайка
            $likes += 1;
        }
        update_field('likes', $likes, $comment_id);
    } elseif ($type === 'dislike') {
        if ($cancel) {
            // Отмена дизлайка
            $dislikes = max(0, $dislikes - 1);
        } else {
            // Добавление дизлайка
            $dislikes += 1;
        }
        update_field('dislikes', $dislikes, $comment_id);
    } else {
        wp_send_json_error('Неверный тип действия.');
    }

    // Возвращаем обновленные значения
    wp_send_json_success(array(
        'likes'    => $likes,
        'dislikes' => $dislikes,
    ));
}
add_action('wp_ajax_handle_like_dislike_ajax', 'handle_like_dislike_ajax');
add_action('wp_ajax_nopriv_handle_like_dislike_ajax', 'handle_like_dislike_ajax');





/**
 * Добавляем поле рейтинга (5 звёзд) к форме комментариев
 */
function mytheme_add_comment_rating_field()
{
    // Выводим блок звёзд. В данном случае используем обычные HTML-символы ★/☆,
    // но можно подставить иконки, SVG, Dashicons и т.д.
    // Также используем radio input, чтобы отловить конкретное числовое значение (1–5).
    ?>
    <div class="col-12 comment-form-rating">
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
    </div>
    <?php
}
// Подключаем поле для авторизованных пользователей
add_action('comment_form_logged_in_after', 'mytheme_add_comment_rating_field');
// И для неавторизованных (форма с полями «Имя», «Почта» и т.д.)
add_action('comment_form_after_fields', 'mytheme_add_comment_rating_field');

/**
 * Сохраняем рейтинг комментария
 */
function mytheme_save_comment_rating($comment_id)
{
    if (isset($_POST['comment_rating']) && !empty($_POST['comment_rating'])) {
        $rating = intval($_POST['comment_rating']);
        // Сохраняем рейтинг (число от 1 до 5) в метаполе comment_rating
        update_comment_meta($comment_id, 'comment_rating', $rating);
    }
}
add_action('comment_post', 'mytheme_save_comment_rating');

/**
 * Выводим звёзды перед текстом комментария
 */
function mytheme_display_comment_rating($comment_text, $comment)
{
    // Получаем значение рейтинга из метаполя
    $rating = get_comment_meta($comment->comment_ID, 'comment_rating', true);

    if ($rating) {
        // Генерируем HTML для звёзд
        // (можно заменить HTML-символы другими иконками, например Dashicons)
        $stars_html = '<div class="comment-rating">';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
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
add_filter('comment_text', 'mytheme_display_comment_rating', 10, 2);



//Есть пагинация на страницах


function is_paginated()
{
    global $wp_query;



    if ($wp_query->max_num_pages > 1) {
        return $wp_query->max_num_pages;
    } else {
        return false;
    }
}



function is_reviews_page()
{
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[0];
    $findme   = 'reviews';

    return mb_substr_count($url, $findme);
}

function is_comments_page()
{
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[0];
    $findme   = 'comments';

    return mb_substr_count($url, $findme);
}
function is_collection_page()
{
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[0];
    $findme   = 'collection';

    return mb_substr_count($url, $findme);
}
function get_current_page_number_from_uri()
{
    if (is_paged()) {
        $uri = $_SERVER['REQUEST_URI'];
        if (preg_match('/\/page\/(\d+)(\/|$)/', $uri, $matches)) {
            return intval($matches[1]);
        }
    }
    return 1;
}



function prefix_filter_title_example($title)
{
    $paged = get_current_page_number_from_uri();

    // Если это пагинированная страница и номер больше 1 — добавляем суффикс
    if ((is_paginated() || is_reviews_page() || is_collection_page() || is_comments_page()) && $paged > 1) {
        $title .= ' — страница ' . $paged;
    }
    return $title;
}
add_filter('wpseo_title', 'prefix_filter_title_example');

function prefix_filter_description_example($description)
{
    $paged = get_current_page_number_from_uri();

    if ((is_paginated() || is_reviews_page() || is_collection_page() || is_comments_page()) && $paged > 1) {
        $description .= ' — страница ' . $paged;
    }
    return $description;
}
add_filter('wpseo_metadesc', 'prefix_filter_description_example');

// Фильтр для изменения метатега robots
add_filter('wpseo_robots', 'custom_robots_for_child_zaimy');
function custom_robots_for_child_zaimy($robots)
{
    if (is_singular('zaimy')) {
        $parent_id = wp_get_post_parent_id(get_the_ID());
        if ($parent_id && get_field('archive', $parent_id)) {
            $robots = 'noindex, nofollow, max-snippet:-1, max-image-preview:large, max-video-preview:-1';
        }
    }
    return $robots;
}

// Фильтр для исключения из карты сайта Yoast SEO (принимаем второй параметр — объект записи)
add_filter('wpseo_sitemap_exclude_post', 'custom_exclude_from_sitemap', 10, 2);
function custom_exclude_from_sitemap($exclude, $post)
{
    if ('zaimy' === $post->post_type) {
        $parent_id = wp_get_post_parent_id($post->ID);
        if ($parent_id && get_field('archive', $parent_id)) {
            return true;
        }
    }
    return $exclude;
}

add_filter('wpseo_xml_sitemap_post_url', 'remove_from_sitemap', 10, 2);
function remove_from_sitemap($url, $post)
{
    if ('zaimy' === $post->post_type) {
        $parent_id = wp_get_post_parent_id($post->ID);
        if ($parent_id) {
            $archive_value = get_field('archive', $parent_id);
            if ($archive_value == true || $archive_value === '1') {
                return '';
            }
        }
    }
    return $url;
}

add_filter('wpseo_sitemap_entry', 'remove_entry_from_sitemap', 10, 3);
function remove_entry_from_sitemap($entry, $type, $object)
{
    // Применяем для записей типа "zaimy"
    if ('zaimy' === get_post_type($object->ID)) {
        $parent_id = wp_get_post_parent_id($object->ID);
        // Проверяем, установлен ли переключатель archive у родительской записи.
        if ($parent_id && (get_field('archive', $parent_id) == true || get_field('archive', $parent_id) === '1')) {
            // Если условие выполняется, полностью исключаем запись из карты сайта.
            return false;
        }
    }
    return $entry;
}




function custom_zaimy_comments_rewrite()
{
    add_rewrite_rule(
        '^zaimy/([^/]+)/comments/page/([0-9]+)/?$',
        'index.php?post_type=zaimy&name=$matches[1]&comments=$matches[2]',
        'top'
    );
}
add_action('init', 'custom_zaimy_comments_rewrite');

function add_comments_query_var($vars)
{
    $vars[] = 'comments';
    return $vars;
}
add_filter('query_vars', 'add_comments_query_var');


// Принудительно включить комментарии в XML-карту сайта Yoast SEO
add_filter('wpseo_xml_sitemaps_exclude_comments', '__return_false');



// Убираем любой query-стринг (включая ?v=...) из URL изображений
function remove_image_version_query(string $url): string
{
    // Если нужно удалять только параметр v:
    // return remove_query_arg( 'v', $url );
    // А если убрать всё, что после знака ?:
    return strtok($url, '?');
}

// Применяем фильтр ко всем URL вложений
add_filter('wp_get_attachment_url', 'remove_image_version_query', 10, 1);

// Для srcset (мобильная/десктопная подгрузка)
add_filter('wp_calculate_image_srcset', function (array $sources): array {
    foreach ($sources as &$src) {
        $src['url'] = remove_image_version_query($src['url']);
    }
    return $sources;
}, 10, 1);

// Для фоновых изображений и прочих случаев, когда используется wp_get_attachment_image_src()
add_filter('wp_get_attachment_image_src', function ($image): array {
    if (is_array($image) && ! empty($image[0])) {
        $image[0] = remove_image_version_query($image[0]);
    }
    return $image;
}, 10, 1);


/**
 * Перехватим прямой запрос к /comments-sitemap.xml
 * и отдадим наш sitemap — без всяких правил перезаписи.
 */
add_action('template_redirect', function () {
    // Берём текущий URI
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    // Если он точно кончается на /comments-sitemap.xml
    if (preg_match('#/comments-sitemap\.xml$#', $uri)) {
        // Выводим карту сразу и выходим
        render_comments_sitemap();
    }
});

/**
 * Функция, генерирующая XML-сайтмап комментариев.
 */
function render_comments_sitemap()
{
    header('Content-Type: application/xml; charset=' . get_bloginfo('charset'), true);

    echo '<?xml version="1.0" encoding="' . get_bloginfo('charset') . '"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    $comments = get_comments([
        'status' => 'approve',
        'parent' => 0,
        'type'   => 'comment',
        'number' => 5000,
    ]);

    foreach ($comments as $c) {
        $link = esc_url(get_comment_link($c));
        $mod  = get_comment_date('c', $c);
        echo "  <url>\n";
        echo "    <loc>{$link}</loc>\n";
        echo "    <lastmod>{$mod}</lastmod>\n";
        echo "  </url>\n";
    }

    echo '</urlset>';
    exit;
}


/**
 * Фильтр для модификации sitemap_index в Yoast SEO
 * Название хука может меняться в зависимости от версии плагина.
 * В старых версиях он назывался 'wpseo_sitemap_index', 
 * в новых — 'wpseo_sitemap_index_xml'
 */
add_filter('wpseo_sitemap_index', 'add_comments_sitemap', 10, 1);
function add_comments_sitemap($sitemap_index)
{
    $sitemap_index .= "\n<sitemap>\n";
    $sitemap_index .= "<loc>" . esc_url(home_url('/comments-sitemap.xml')) . "</loc>\n";
    $sitemap_index .= "<lastmod>" . date('c') . "</lastmod>\n";
    $sitemap_index .= "</sitemap>\n";
    return $sitemap_index;
}


add_action('wp_ajax_load_more_banks',       'load_more_banks_callback');
add_action('wp_ajax_nopriv_load_more_banks', 'load_more_banks_callback');

function load_more_banks_callback()
{
    // 1) Получаем страницу
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    // 2) Сколько выводим за раз — дублируем из шаблона
    $posts_per_page = 20;

    // 3) Сразу вычисляем стартовую величину для нумерации
    $start_index = ($paged - 1) * $posts_per_page;
    $counter     = $start_index;

    // 4) Собираем запрос
    $args = [
        'post_type'      => 'banks',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'orderby'        => [
            'ratings_average' => 'DESC',
            'name'            => 'DESC',
        ],
        'order'          => 'DESC',
        'meta_query'     => [
            'relation' => 'OR',
            [
                'key'     => 'ratings_average',
                'compare' => 'EXISTS',
            ],
            [
                'key'     => 'ratings_average',
                'compare' => 'NOT EXISTS',
            ],
        ],
    ];

    $query = new WP_Query($args);
    $html  = '';

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            // 5) Увеличиваем счётчик и выводим
            $counter++;
    ?>
            <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-4 query__card">
                <a href="<?php the_permalink() ?>" class="card card__horizontal bank__item">
                    <div class="card-container p-2">
                        <div class="d-flex">
                            <div class="bank__item-img mr-2">
                                <img src="<?php echo esc_url(get_field('bank_logo')); ?>"
                                    alt="<?php echo esc_attr(get_post_meta(get_field('bank_logo', false), '_wp_attachment_image_alt', true)); ?>">
                            </div>
                            <div class="bank__item-content">
                                <div class="card__header-title mt-1 mb-2"><?php the_title() ?></div>
                                <div class="card__header-info d-flex align-items-center">
                                    <div class="card__rating d-flex align-items-center mr-3">
                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                            </svg></div>
                                        <?php echo esc_html(get_field('ratings_average')); ?>
                                    </div>
                                    <div class="position-relative card__icon d-flex align-items-center mr-3">
                                        <a href="<?php the_permalink() ?>#comments" class="stretched-link mr-2">
                                            <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                            </svg>
                                        </a>
                                        <?php echo esc_html(get_comments_number(get_the_ID())); ?>
                                    </div>
                                    <div class="card__header-num bank_num">
                                        №<?php echo $counter; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        }
        wp_reset_postdata();
        $html = ob_get_clean();
    }

    wp_send_json_success([
        'html'     => $html,
        'max_page' => $query->max_num_pages,
    ]);
}


function theme_enqueue_load_more()
{
    // регистрируем и локализуем
    wp_register_script(
        'load-more-banks',
        get_template_directory_uri() . '/js/load-more-banks.js',
        ['jquery'],
        null,
        true
    );
    wp_localize_script('load-more-banks', 'load_more_banks', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
    wp_enqueue_script('load-more-banks');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_load_more');

/**
 * Редирект всех пагинированных страниц архива banks на первую страницу
 */
function fb_redirect_banks_paged_to_root()
{
    // проверяем, что это архив кастомного типа записей "banks"
    // и что мы находимся не на первой странице
    if (is_post_type_archive('banks') && is_paged()) {
        // получаем URL корневой страницы архива banks
        $archive_url = get_post_type_archive_link('banks');
        // делаем 301-редирект
        wp_redirect($archive_url, 301);
        exit;
    }
}
add_action('template_redirect', 'fb_redirect_banks_paged_to_root');

/**
 * Редирект всех пагинированных таксономий bankcards на их корневую страницу
 */
function fb_redirect_bankcards_taxonomy_paged()
{
    if (is_tax('bankcards') && is_paged()) {
        // Получаем текущий объект терма
        $term = get_queried_object();
        if ($term && ! is_wp_error($term)) {
            // Ссылка на первую страницу архива терма
            $term_link = get_term_link($term);
            if (! is_wp_error($term_link)) {
                wp_redirect($term_link, 301);
                exit;
            }
        }
    }
}
add_action('template_redirect', 'fb_redirect_bankcards_taxonomy_paged');



function finbank_enqueue_scripts()
{
    wp_enqueue_script('finbank-scripts', get_template_directory_uri() . '/js/load-comments.js', array('jquery'), null, true);
    wp_localize_script('finbank-scripts', 'finbank_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'post_id' => get_the_ID(),
    ));
}
add_action('wp_enqueue_scripts', 'finbank_enqueue_scripts');




add_action('wp_ajax_load_more_comments', 'load_more_comments');
add_action('wp_ajax_nopriv_load_more_comments', 'load_more_comments');

function load_more_comments()
{
    // убираем вывод ошибок в AJAX
    @ini_set('display_errors', 0);
    @error_reporting(0);
    while (ob_get_level()) {
        ob_end_clean();
    }

    $page              = max(1, intval($_POST['page']));
    $post_id           = intval($_POST['post_id']);
    $comments_per_page = intval($_POST['comments_per_page']);
    $offset            = ($page - 1) * $comments_per_page;

    $root_comments = get_comments([
        'post_id'      => $post_id,
        'status'       => 'approve',
        'number'       => $comments_per_page,
        'offset'       => $offset,
        'hierarchical' => false,  // только корневые
    ]);

    if ($root_comments) {
        foreach ($root_comments as $comment) {
            $comment_id      = $comment->comment_ID;
            $comment_post_id = $comment->comment_post_ID;

            // собираем ответы
            $children = get_comments([
                'status'       => 'approve',
                'parent'       => $comment_id,
                'hierarchical' => false,
            ]);
            $responses = count($children);

            // user info
            $user      = get_userdata($comment->user_id);
            $user_role = $user ? ($user->roles[0] ?? 'Гость') : 'Гость';

            // --- открыли контейнер комментария ---
        ?>
            <div class="comments__item mb-3" id="comment-<?php echo $comment_id; ?>">
                <div class="comment__one">
                    <div class="comment__one-header d-flex align-items-center">
                        <div class="comment__one-img mr-3">
                            <img src="<?php echo esc_url(get_avatar_url($comment, ['default' => 'identicon'])); ?>"
                                alt="<?php echo esc_attr($comment->comment_author); ?>">
                        </div>
                        <div class="d-md-flex justify-content-md-between w-100">
                            <div class="comment__one-title mb-2 mb-md-0"><?php echo esc_html($comment->comment_author); ?></div>
                            <div class="d-flex align-items-center">
                                <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                                    <div class="mr-2">
                                        <svg width="14" height="19">
                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person"></use>
                                        </svg>
                                    </div>
                                    <?php echo esc_html($user_role); ?>
                                </div>
                                <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                                    <div class="mr-2">
                                        <svg width="18" height="19">
                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#house"></use>
                                        </svg>
                                    </div>
                                    <?php echo esc_html(get_the_title($comment_post_id)); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment__one-content">
                        <?php echo wp_kses_post($comment->comment_content); ?>
                    </div>
                    <div class="comment__one-footer d-flex flex-wrap align-items-center">
                        <?php
                        // ссылка «Ответить»
                        echo comment_reply_link([
                            'reply_text' => 'Ответить',
                            'depth'      => 1,
                            'max_depth'  => 5
                        ], $comment_id, $comment_post_id);
                        ?>
                        <div class="comment__one-date mr-md-4 order-md-1">
                            <?php echo get_comment_date('d.m.y', $comment_id); ?> в <?php echo get_comment_date('H:i', $comment_id); ?>
                        </div>
                        <div class="comment__one-like order-md-4 ml-auto d-flex justify-content-between">
                            <?php comments_like_dislike($comment_id); ?>
                        </div>
                        <?php if ($responses > 0): ?>
                            <div class="comment__one-btn order-md-2 mr-md-4">
                                <button class="btn btn-outline-light btn-xs collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#answ__<?php echo $comment_id; ?>"
                                    aria-expanded="false">
                                    <?php echo $responses; ?>
                                    <?php
                                    if ($responses === 1) {
                                        echo 'Ответ';
                                    } elseif ($responses <= 4) {
                                        echo 'Ответа';
                                    } else {
                                        echo 'Ответов';
                                    }
                                    ?>
                                    <svg width="12" height="6">
                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow"></use>
                                    </svg>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($responses > 0): // здесь ваши ответы 
                ?>
                    <div class="comment__one-collapse collapse" id="answ__<?php echo $comment_id; ?>">
                        <div class="comment__one-hidden">
                            <?php foreach ($children as $reply):
                                $reply_id       = $reply->comment_ID;
                                $reply_date     = get_comment_date('d.m.y', $reply_id);
                                $reply_time     = get_comment_date('H:i', $reply_id);
                                $reply_user     = get_userdata($reply->user_id);
                                $reply_role     = $reply_user ? ($reply_user->roles[0] ?? 'Гость') : 'Гость';
                            ?>
                                <div class="comment__one">
                                    <div class="comment__one-header d-flex align-items-center">
                                        <div class="comment__one-img mr-3">
                                            <img src="<?php echo esc_url(get_avatar_url($reply, ['default' => 'identicon'])); ?>" alt="">
                                        </div>
                                        <div class="d-md-flex justify-content-md-between w-100">
                                            <div class="comment__one-title mb-2 mb-md-0">
                                                <?php echo esc_html($reply->comment_author); ?>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                                                    <div class="mr-2">
                                                        <svg width="14" height="19">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person"></use>
                                                        </svg>
                                                    </div>
                                                    <?php echo esc_html($reply_role); ?>
                                                </div>
                                                <div class="card__icon d-flex align-items-center ml-3 ml-sm-4">
                                                    <div class="mr-2">
                                                        <svg width="18" height="19">
                                                            <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#house"></use>
                                                        </svg>
                                                    </div>
                                                    <?php echo esc_html(get_the_title($comment_post_id)); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment__one-content">
                                        <?php echo wp_kses_post($reply->comment_content); ?>
                                    </div>
                                    <div class="comment__one-footer d-flex flex-wrap align-items-center">
                                        <div class="comment__one-date mr-md-4 order-md-1">
                                            <?php echo "{$reply_date} в {$reply_time}"; ?>
                                        </div>
                                        <div class="comment__one-like order-md-4 ml-auto d-flex justify-content-between">
                                            <?php comments_like_dislike($reply_id); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div><!-- /.comments__item -->
        <?php
        } // endforeach root_comments
    } else {
        echo '<p>Больше комментариев нет.</p>';
    }

    wp_die();
}



// Универсальный AJAX-обработчик "Загрузить ещё"
// Универсальный AJAX-обработчик "Загрузить ещё"
// Универсальный AJAX-обработчик "Загрузить ещё"
// Универсальный AJAX-обработчик "Загрузить ещё"
add_action('wp_ajax_load_more_reviews', 'load_more_reviews');
add_action('wp_ajax_nopriv_load_more_reviews', 'load_more_reviews');
function load_more_reviews()
{
    @ini_set('display_errors', 0);
    while (ob_get_level()) ob_end_clean();
    global $wpdb;

    $page      = max(1, intval($_POST['page']    ?? 1));
    $per_page  = intval($_POST['per_page'] ?? 15);
    $offset    = ($page - 1) * $per_page;

    $taxonomy  = sanitize_text_field($_POST['taxonomy']   ?? '');
    $term_id   = intval($_POST['term_id']    ?? 0);
    $field_name = sanitize_text_field($_POST['field_name'] ?? 'bank_logo');

    // Фильтрация для банков
    if ($taxonomy === 'banks') {  // Если это банки
        $posts = get_cpt_ids('banks');  // Получаем посты для банков
    } elseif ($taxonomy === 'installmentcard') {  // Карты рассрочки
        $posts = get_objects_in_term($term_id, 'bankcards');
    } elseif ($taxonomy === 'creditcard') {  // Кредитные карты
        $posts = get_objects_in_term($term_id, 'bankcards');
    } elseif ($taxonomy === 'debetcard') {  // Дебетовые карты
        $posts = get_objects_in_term($term_id, 'bankcards');
    } elseif ($taxonomy === 'kredity') {  // Кредиты
        $posts = get_cpt_ids('kredity');
    } elseif ($taxonomy === 'zaimy') {  // Займы
        $posts = get_cpt_ids('zaimy');
    } else {
        // По умолчанию выбираем все одобренные комментарии
        $posts = $wpdb->get_col("SELECT DISTINCT comment_post_ID FROM {$wpdb->comments} WHERE comment_approved=1");
    }

    if (empty($posts)) wp_die();

    $in = implode(',', array_map('intval', $posts));

    // Получаем отзывы
    $comments = $wpdb->get_results("
      SELECT comment_ID, comment_post_ID
      FROM {$wpdb->comments}
      WHERE comment_post_ID IN ({$in})
        AND comment_approved = 1
        AND comment_parent  = 0
      ORDER BY comment_date DESC
      LIMIT {$per_page} OFFSET {$offset}
    ");

    if (empty($comments)) {
        echo '';
        wp_die();
    }

    foreach ($comments as $comm) {
        $comment    = get_comment($comm->comment_ID);
        $post_id    = $comm->comment_post_ID;
        $author     = esc_html($comment->comment_author);
        $content    = wp_kses_post($comment->comment_content);
        $date       = get_comment_date('d.m.y', $comm->comment_ID);
        $time       = get_comment_date('H:i',  $comm->comment_ID);
        $rating     = esc_html(get_field('ratings_average', $post_id));
        $cnt        = get_comments_number($post_id);
        $user       = get_userdata($comment->user_id);
        $role       = $user->roles[0] ?? 'Гость';
        $city       = get_comment_meta($comm->comment_ID, 'city', true);










        // Выводим данные для каждого комментария
        ?>
        <div class="reviews__item col-12 col-md-6 col-lg-4 mb-5 reviews__page-item">
            <div class="reviews__item-body">
                <div class="reviews__header d-flex align-items-center mb-2">
                    <div class="reviews__header-logo">
                        <?php if ($taxonomy === 'zaimy'): ?>
                            <!-- Логотип для займов -->
                            <img src="<?php echo esc_url(get_field('z_organization_logo', $comm->comment_post_ID)); ?>"
                                alt="<?php
                                        $logo_id = get_field('z_organization_logo', $comm->comment_post_ID, false);
                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                        echo esc_attr($logo_alt);
                                        ?>">
                        <?php elseif ($taxonomy === 'banks'): ?>
                            <!-- Логотип для банков -->
                            <img src="<?php echo esc_url(get_field('bank_logo', $comm->comment_post_ID)); ?>"
                                alt="<?php
                                        $logo_id = get_field('bank_logo', $comm->comment_post_ID, false);
                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                        echo esc_attr($logo_alt);
                                        ?>">
                        <?php elseif ($taxonomy === 'kredity'): ?>
                            <!-- Логотип для кредиты -->
                            <?php $bank_choise_rel = get_field('product_bank', $comm->comment_post_ID) ?>
                            <img src="<?php echo esc_url(get_field('bank_logo', $bank_choise_rel)); ?>"
                                alt="<?php
                                        $logo_id = get_field('bank_logo', $bank_choise_rel, false);
                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                        echo esc_attr($logo_alt);
                                        ?>
                            ">
                        <?php else: ?>
                            <?php $bank_choise_rel = get_field('bank_choise', $comm->comment_post_ID) ?>
                            <img src="<?php echo esc_url(get_field('bank_logo', $bank_choise_rel)); ?>"
                                alt="<?php
                                        $logo_id = get_field('bank_logo', $bank_choise_rel, false);
                                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                        echo esc_attr($logo_alt);
                                        ?>">
                        <?php endif; ?>


                    </div>
                    <div class="reviews__header-meta ml-3">
                        <a href="<?php echo esc_url(get_comment_link($comm->comment_ID)); ?>" class="reviews__header-title h4 mb-2 stretched-link">
                            <?php if ($taxonomy === 'zaimy'): ?>
                                <?php echo esc_html(get_the_title($post_id)); ?>
                            <?php elseif ($taxonomy === 'banks'): ?>
                                <?php echo esc_html(get_the_title($post_id)); ?>
                            <?php elseif ($taxonomy === 'kredity'): ?>
                                <?php echo esc_html(get_the_title($bank_choise_rel)); ?>
                            <?php else: ?>
                                <?php echo esc_html(get_the_title($bank_choise_rel)); ?>
                            <?php endif; ?>

                        </a>
                        <div class="d-flex">
                            <div class="card__rating d-flex align-items-center mr-3">
                                <div class="mr-2">
                                    <svg width="18" height="17">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#starLine"></use>
                                    </svg>
                                </div>
                                <?php echo $rating; ?>
                            </div>
                            <div class="card__icon d-flex align-items-center">
                                <div class="mr-2">
                                    <svg width="18" height="17">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#commentLine"></use>
                                    </svg>
                                </div>
                                <?php echo $cnt; ?>
                            </div>
                            <div class="card__date d-none d-md-block ml-auto">
                                <?php echo "{$date} / {$time}"; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="reviews__item-content">
                    <p><?php echo $content; ?></p>
                </div>
            </div>
            <div class="reviews__item-footer mb-2 ml-3">
                <div class="reviews__author d-flex align-items-center mt-3">
                    <div class="reviews__author-img mr-3">
                        <img loading="lazy" src="<?php echo esc_url(get_avatar_url($comment, ['size' => 60, 'default' => 'identicon'])); ?>" alt="">
                    </div>
                    <div class="reviews__author-content">
                        <span class="reviews__author-title d-block"><?php echo $author; ?></span>
                        <div class="reviews__author-info d-flex">
                            <div class="card__icon d-flex align-items-center mr-3">
                                <div class="mr-2">
                                    <svg width="14" height="19">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#person"></use>
                                    </svg>
                                </div>
                                <?php echo esc_html($role); ?>
                            </div>
                            <?php if ($city): ?>
                                <div class="card__icon d-flex align-items-center">
                                    <svg width="16" height="20">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#pointer"></use>
                                    </svg>
                                    <?php echo esc_html($city); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
    wp_die();
}






// Подключаем скрипт загрузки
function reviews_enqueue_scripts()
{
    wp_enqueue_script(
        'reviews-load-more',
        get_template_directory_uri() . '/js/load-reviews.js',
        ['jquery'],
        null,
        true
    );
    wp_localize_script('reviews-load-more', 'reviews_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'reviews_enqueue_scripts');





// add_action('init', 'fill_default_order_priority', 20);
// function fill_default_order_priority()
// {
//     // Удаляем старый флаг — так мы гарантированно запустим цикл заново
//     delete_transient('filled_order_priority');

//     // Если у нас стоит флаг, выходим
//     if (get_transient('filled_order_priority')) {
//         return;
//     }

//     // Раз в сутки, чтобы не гонять каждый запрос
//     if (get_transient('filled_order_priority')) {
//         return;
//     }

//     $args = [
//         'post_type'      => 'kredity',
//         'posts_per_page' => -1,
//         'fields'         => 'ids',
//     ];
//     $q = new WP_Query($args);
//     if ($q->have_posts()) {
//         foreach ($q->posts as $post_id) {
//             // именно пустая строка, а не отсутствие
//             $val = get_post_meta($post_id, 'order_priority', true);
//             if ($val === '') {
//                 update_post_meta($post_id, 'order_priority', -1);
//             }
//         }
//     }
//     // и в конце
//     set_transient('filled_order_priority', 1, DAY_IN_SECONDS);
// }
