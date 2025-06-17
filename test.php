<?

add_action('wp_ajax_load_more_reviews', 'load_more_reviews');
add_action('wp_ajax_nopriv_load_more_reviews', 'load_more_reviews');
function load_more_reviews()
{
    // не выводим лишнего
    @ini_set('display_errors', 0);
    while (ob_get_level()) ob_end_clean();

    global $wpdb;
    $page       = max(1, intval($_POST['page']));
    $per_page   = intval($_POST['per_page']);
    $offset     = ($page - 1) * $per_page;

    // ваши ID всех постов zaimy
    $posts = get_cpt_ids('zaimy');
    if (empty($posts)) {
        wp_die();
    }
    $in = implode(',', array_map('intval', $posts));

    // берём комментарии
    $comments = $wpdb->get_results(
        "SELECT comment_ID, comment_date, comment_content, comment_post_ID
     FROM {$wpdb->comments}
     WHERE comment_post_ID IN ({$in})
       AND comment_approved = 1
       AND comment_parent = 0
     ORDER BY comment_date DESC
     LIMIT {$per_page} OFFSET {$offset}"
    );

    if (!$comments) {
        echo '';
        wp_die();
    }

    // выводим точно тот же шаблон, что и в get_template_part('all_template/reviews_list', …)
    foreach ($comments as $comm) {
        // здесь можно подключить ту же логику, что в reviews_list.php
        // например:
        setup_postdata(get_post($comm->comment_post_ID));
        $comment = get_comment($comm->comment_ID);
        ?>
        <div class="reviews__item mt-4">
            <div class="reviews__item-body">
                <div class="reviews__header d-flex align-items-center mb-2">
                    <div class="reviews__header-logo"><img src="<?php echo the_field('z_organization_logo', $comm->comment_post_ID) ?>" alt=""></div>
                    <div class="reviews__header-meta ml-3">
                        <a href="<?php echo get_comment_link($comm->comment_ID) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($comm->comment_post_ID) ?></a>
                        <div class="d-flex">
                            <div class="card__rating d-flex align-items-center mr-3">
                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                    </svg></div>
                                <?php echo the_field('ratings_average', $comm->comment_post_ID); ?>
                            </div>
                            <div class="card__icon d-flex align-items-center">
                                <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                    </svg></div>
                                <?php echo comments_number('0', '1', '%', $comm->comment_post_ID); ?>
                            </div>
                            <div class="card__date d-none d-md-block ml-auto"><?php echo get_comment_date('d.m.y', $comm->comment_ID) ?> / <?php echo get_comment_date('H:i', $comm->comment_ID) ?></div>
                        </div>
                    </div>
                </div>
                <div class="reviews__item-content">
                    <p><?php echo wp_kses_post($comment->comment_content) ?></p>
                </div>
            </div>
            <div class="reviews__item-footer mb-3 ml-3">
                <div class="reviews__author d-flex align-items-center mt-3">
                    <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url($comment, ['size' => 60, 'default' => 'identicon']) ?>" alt=""></div>
                    <div class="reviews__author-content">
                        <span class="reviews__author-title d-block"><?php echo get_comment_author($comm->comment_ID) ?></span>
                        <div class="reviews__author-info d-flex">
                            <div class="card__icon d-flex align-items-center mr-3">
                                <div class="mr-2">
                                    <svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#person" x="0" y="0"></use>
                                    </svg>
                                </div>

                                <?php echo get_userdata($comment->user_id)->roles[0] ?: 'Гость' ?>
                            </div>
                            <?php if ($city = get_comment_meta($comm->comment_ID, 'city', true)): ?>
                                <div class="card__icon d-flex align-items-center"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                        <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                    </svg><?php echo esc_html($city) ?></div>
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


function reviews_enqueue_scripts()
{
    wp_enqueue_script('reviews-load-more', get_template_directory_uri() . '/js/load-reviews.js', ['jquery'], null, true);
    wp_localize_script('reviews-load-more', 'reviews_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'reviews_enqueue_scripts');