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
            $comment_id    = get_the_ID();
            $author_name   = get_field('author_name');
            $author_email  = get_field('author_email');
            $comment_content = get_field('comment_content');
            $comment_date  = get_the_date();

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
            }
?>
            <li class="additional-comment">
                <div class="additional-comment__header">
                    <div class="additional-comment__avatar">
                        <!-- Вывод аватара: -->
                        <!-- <img src="<?php echo esc_url($author_avatar); ?>" alt="avatar" /> -->
                    </div>

                    <div class="additional-row">
                        <div class="comment__one-title mb-2 mb-md-0"><?php echo esc_html($author_name); ?></div>
                        <div class="additional-status">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.4 7C15.4 8.87777 13.8778 10.4 12 10.4V11.6C14.5405 11.6 16.6 9.54051 16.6 7H15.4ZM12 10.4C10.1222 10.4 8.6 8.87777 8.6 7H7.4C7.4 9.54051 9.45949 11.6 12 11.6V10.4ZM8.6 7C8.6 5.12223 10.1222 3.6 12 3.6V2.4C9.45949 2.4 7.4 4.45949 7.4 7H8.6ZM12 3.6C13.8778 3.6 15.4 5.12223 15.4 7H16.6C16.6 4.45949 14.5405 2.4 12 2.4V3.6ZM9 14.6H15V13.4H9V14.6ZM15 21.4H9V22.6H15V21.4ZM9 21.4C7.12223 21.4 5.6 19.8778 5.6 18H4.4C4.4 20.5405 6.45949 22.6 9 22.6V21.4ZM18.4 18C18.4 19.8778 16.8778 21.4 15 21.4V22.6C17.5405 22.6 19.6 20.5405 19.6 18H18.4ZM15 14.6C16.8778 14.6 18.4 16.1222 18.4 18H19.6C19.6 15.4595 17.5405 13.4 15 13.4V14.6ZM9 13.4C6.45949 13.4 4.4 15.4595 4.4 18H5.6C5.6 16.1222 7.12223 14.6 9 14.6V13.4Z" fill="#9CA3AF" />
                            </svg>
                            Гость
                        </div>
                    </div>
                </div>
                <div class="additional-comment__content"><?php echo esc_html($comment_content); ?></div>
                <div class="additional-row">
                    <div class="additional-btns">
                        <div class="comment__one-date mr-md-4 order-md-1"><?php echo esc_html($comment_date); ?></div>
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
    $uri = $_SERVER['REQUEST_URI'];
    if (preg_match('/\/page\/(\d+)(\/|$)/', $uri, $matches)) {
        return intval($matches[1]);
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
