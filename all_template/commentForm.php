<?php
// Получение ID текущего поста
$post_id = get_queried_object_id();

// Получение данных комментатора
$commenter = wp_get_current_commenter();

// Проверка и установка значений $args с дефолтными параметрами
$args = isset($args) && is_array($args) ? $args : [];
$args = wp_parse_args($args, array(
    'is_detail_page' => 'N', // Значение по умолчанию
    'format'         => current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml',
));

$html5 = 'html5' === $args['format'];

// Проверка необходимости ввода имени и email
$req = get_option('require_name_email');
$required_text = $req ? ' <span class="required">*</span>' : '';
$aria_req = $req ? " aria-required='true'" : '';
$html_req = $req ? " required='required'" : '';

// Получение идентификатора пользователя, если он вошёл в систему
if (is_user_logged_in()) {
    $current_user  = wp_get_current_user();
    $user_identity = $current_user->display_name;
} else {
    $user_identity = '';
}
?>

<!-- Отображение сообщения для страниц, отличных от детальной -->
<?php if (isset($args['is_detail_page']) && $args['is_detail_page'] !== 'Y'): ?>
    <div class="response-for-comment" style="display:none; margin-top: 1rem; margin-bottom: 1rem; color: green;">
        Ваш комментарий ожидает проверки
    </div>
<?php endif; ?>

<?php
// Настройка параметров формы комментариев
$defaults = [
    'fields'               => [
        'author' => '<div class="col-12 col-md-6">
                        <div class="mb-3">
                            <input id="author" class="form-control" placeholder="Имя*" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . $html_req . ' />
                        </div>
                    </div>',
        'email'  => '<div class="col-12 col-md-6">
                        <div class="mb-3">
                            <input id="email" class="form-control" placeholder="E-Mail*" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" aria-describedby="email-notes" ' . $aria_req . $html_req . ' />
                        </div>
                    </div>',
    ],
    'comment_field'        => '<div class="col-12">
                                    <textarea id="comment" post-id="' . esc_attr($post_id) . '" name="comment" class="form-control input-comment-trigger" placeholder="Ваш отзыв*" rows="4" aria-required="true" required="required"></textarea>
                                    <div class="form-comment__bottom">* - Обязательно заполнить</div>
                                </div>',
    'logged_in_as'         => is_user_logged_in() ? '<div class="col-12 mb-2">' .
        sprintf(
            /* translators: 1: URL to edit profile, 2: user name, 3: logout URL */
            __('<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>'),
            esc_url(get_edit_user_link()),
            esc_html($user_identity),
            esc_url(wp_logout_url(apply_filters('the_permalink', get_permalink($post_id))))
        ) . '</div>' : '',
    'comment_notes_before' => '',
    'comment_notes_after'  => '',
    'id_form'              => 'commentform',
    'id_submit'            => 'submit',
    'class_container'      => 'comment-respond',
    'class_form'           => 'comment-form row validate-comment-form',
    'class_submit'         => 'submit',
    'name_submit'          => 'submit',
    'title_reply'          => '',
    'title_reply_to'       => '',
    'title_reply_before'   => '',
    'title_reply_after'    => '',
    'cancel_reply_before'  => '',
    'cancel_reply_after'   => '',
    'cancel_reply_link'    => '',
    'label_submit'         => '',
    'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5" value="Отправить" />',
    'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
    'format'               => 'xhtml',
];

// Вывод формы комментариев
comment_form($defaults, $post_id);
?>

<!-- Отображение сообщения для детальной страницы -->
<?php if (isset($args['is_detail_page']) && $args['is_detail_page'] === 'Y'): ?>
    <div class="response-for-comment" style="display:none; margin-top: 1rem; margin-bottom: 1rem; color: green;">
        Ваш комментарий ожидает проверки
    </div>
<?php endif; ?>