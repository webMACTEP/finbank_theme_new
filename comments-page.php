<?php //session_start(); 
?>
<?php get_header() ?>

<?php

$ID = $post->ID;
//$TAX = $_SESSION['data_tax_reviews'];
//$DISPLAY = $_SESSION['display_type'];

$TAX = $_SESSION['data_tax_reviews'];
//$DISPLAY = $_SESSION['display_type'];
$DISPLAY = 'comments';
//echo 111111;
//echo $TAX;
//print_r2($_SESSION);
//echo 2222222;

$post_type = get_post_type($ID);
$tags = get_the_tags($ID);
$terms = wp_get_post_terms($ID, 'bankcards', array('fields' => 'all'));
$term_slug = $terms[0]->slug;
$term_id = $terms[0]->term_id;


//print_r2($term_id);


// Отзывы вариант 1
if ($TAX != '' && $DISPLAY == 'reviews'):
    switch ($TAX) {
        case 'debetcard':
            $tax_id = 7;
            $title_term1 = "Дебетовые карты";
            $title_term2 = "все дебетовые карты";
            $calc_link = get_page_link(157);
            $news_id = "13";
            $link = get_term_link($tax_id, '');
            break;
        case 'installmentcard':
            $tax_id = 8;
            $title_term1 = "Карты рассрочки";
            $title_term2 = "все карты рассрочки";
            $calc_link = get_page_link(149);
            $link = get_term_link($tax_id, '');
            $news_id = "15";
            break;
        case 'creditcard':
            $tax_id = 2;
            $title_term1 = "Кредитные карты";
            $title_term2 = "все кредитные карты";
            $calc_link = get_page_link(149);
            $link = get_term_link($tax_id, '');
            $news_id = "14";
            break;
        case 'banks':
            $tax_id = 2;
            $title_term1 = "Банки";
            $title_term2 = "все банки";
            $link = get_post_type_archive_link('banks');
            $calc_link = get_page_link(149);
            $news_id = "16";
            break;
        case 'kredity':
            $tax_id = 2;
            $title_term1 = "Кредиты";
            $title_term2 = "все кредиты";
            $calc_link = get_page_link(149);
            $link = get_post_type_archive_link('kredity');
            $news_id = "18";
            break;
        case 'zaimy':
            $tax_id = 2;
            $title_term1 = "Займы";
            $title_term2 = "все займы";
            $calc_link = get_page_link(159);
            $link = get_post_type_archive_link('zaimy');
            $news_id = "12";
            break;
        default:
            $tax_id = 2;
            $title_term1 = "Отзывы";
    }   ?>
    <main>
        <div class="container">
            <nav aria-label="breadcrumb" class="horizontal__scroll">
                <ol class="breadcrumb horizontal__scroll-container">
                    <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo $link ?>"><?php echo $title_term1 ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
                </ol>
            </nav>
        </div>
        <!-- page header -->
        <div class="page__heading mb-4">
            <div class="container">
                <div class="page__heading-top d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page__heading-title mb-0"><?php echo $title_term1;  ?></h1>
                        <h3 class="font-weight-semibold mt-2 mb-0">Благодаря честным отзывам вы сможете осуществить более разумный выбор</h3>
                    </div>
                    <div class="page__heading-icon"><img src="<?php bloginfo('template_url'); ?>/img/icon__title-like.png" alt=""></div>
                </div>
            </div>
        </div>
        <!-- / page header -->
        <!-- page nav -->
        <div class="page__nav">
            <div class="container">
                <div class="page__nav-container nav-tabs">
                    <div class="horizontal__scroll">
                        <div class="horizontal__scroll-container">
                            <a href="<?php echo $link ?>" class="nav-link"><?php echo $title_term2 ?></a>
                            <a href="" class="nav-link active">Отзывы</a>
                            <a href="<?php echo $calc_link ?>" class="nav-link">Калькулятор</a>
                            <a href="<?php echo get_category_link($news_id) ?>" class="nav-link">Статьи</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / page nav -->
        <div class="container">
            <div class="section">
                <div class="row reviews-page-list" id="reviews">
                    <?php if ($TAX == 'banks'): ?>
                        <?php

                        $ppp = 10; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                        $custom_offset = 0;

                        // fetch posts in all those categories
                        $posts = get_cpt_ids('banks');

                        $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
 FROM {$wpdb->comments} WHERE
 comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
 ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                        $comments_list = $wpdb->get_results($sql);

                        if (count($comments_list) > 0) {
                            foreach ($comments_list as $comm) {

                                $comment_id = $comm->comment_ID;
                                $comment = get_comment($comment_id);
                                $comment_post_id = $comment->comment_post_ID;
                                $parent_comment = $comment->comment_parent;
                                $user = get_userdata($comment->user_id);
                                $user_email = $user->user_email;
                                $author = get_comment_author($comment_id);
                                $user_role = $user->roles;
                                $city = get_comment_meta($comment_id, 'city', true); ?>
                                <?php if ($parent_comment == 0): ?>
                                    <!-- item -->
                                    <div class="reviews__item col-12 col-md-6 col-lg-4 mb-5 reviews__page-item">
                                        <div class="reviews__item-body">
                                            <div class="reviews__header d-flex align-items-center mb-2">
                                                <div class="reviews__header-logo"><img src="<?php echo the_field('bank_logo', $comment_post_id) ?>" alt=""></div>
                                                <div class="reviews__header-meta ml-3">
                                                    <a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($comment_post_id) ?></a>
                                                    <div class="d-flex">
                                                        <div class="card__rating d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo the_field('ratings_average', $comment_post_id); ?>
                                                        </div>
                                                        <div class="card__icon d-flex align-items-center">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo comments_number('0', '1', '%', $comment_post_id); ?>
                                                        </div>
                                                        <div class="card__date d-none d-sm-block ml-auto"><?php echo  get_comment_date('d.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reviews__item-content">
                                                <p><?php echo $comment->comment_content; ?></p>
                                            </div>
                                        </div>
                                        <div class="reviews__item-footer">
                                            <div class="reviews__author d-flex align-items-center mt-3">
                                                <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url($user_email, array(
                                                                                                    'size' => 60,
                                                                                                    'default' => 'identicon',
                                                                                                )); ?>" alt="<?php echo $author; ?>"></div>
                                                <div class="reviews__author-content">
                                                    <a href="" class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                                                    <div class="reviews__author-info d-flex">
                                                        <div class="card__icon d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php if ($user_role[0] == ''):
                                                                echo 'Гость';
                                                            endif;
                                                            if ($user_role[0] != ''):
                                                                echo $user_role[0];
                                                            endif; ?>
                                                        </div>
                                                        <?php if ($city != ''): ?>
                                                            <div class="card__icon d-flex align-items-center">
                                                                <div class="mr-2"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                                                    </svg></div>
                                                                <?php echo $city ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / item -->
                                <?php endif; ?>
                            <?php }
                        } else { ?>
                            <p class="col-12">Пока нет отзывов.</p>
                        <?php } ?>
                    <?php elseif ($TAX == 'zaimy'): ?>
                        <?php
                        $ppp = 10; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                        $custom_offset = 0;

                        // fetch posts in all those categories
                        $posts = get_cpt_ids('zaimy');

                        $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
 FROM {$wpdb->comments} WHERE
 comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
 ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                        $comments_list = $wpdb->get_results($sql);

                        if (count($comments_list) > 0) {
                            foreach ($comments_list as $comm) {

                                $comment_id = $comm->comment_ID;
                                $comment = get_comment($comment_id);
                                $comment_post_id = $comment->comment_post_ID;
                                $bank_id = get_field('product_bank', $comment_post_id);
                                $user = get_userdata($comment->user_id);
                                $user_email = $user->user_email;
                                $author = get_comment_author($comment_id);
                                $user_role = $user->roles;
                                $city = get_comment_meta($comment_id, 'city', true); ?>
                                <!-- item -->
                                <div class="reviews__item col-12 col-md-6 col-lg-4 mb-5 reviews__page-item">
                                    <div class="reviews__item-body">
                                        <div class="reviews__header d-flex align-items-center mb-2">
                                            <div class="reviews__header-logo"><img src="<?php echo the_field('z_organization_logo', $comment_post_id) ?>" alt=""></div>
                                            <div class="reviews__header-meta ml-3">
                                                <a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($comment_post_id) ?></a>
                                                <div class="d-flex">
                                                    <div class="card__rating d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php echo the_field('ratings_average', $comment_post_id); ?>
                                                    </div>
                                                    <div class="card__icon d-flex align-items-center">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php echo comments_number('0', '1', '%', $comment_post_id); ?>
                                                    </div>
                                                    <div class="card__date d-none d-md-block ml-auto"><?php echo  get_comment_date('d.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reviews__item-content">
                                            <p><?php echo $comment->comment_content; ?></p>
                                        </div>
                                    </div>
                                    <div class="reviews__item-footer">
                                        <div class="reviews__author d-flex align-items-center mt-3">
                                            <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url($user_email, array(
                                                                                                'size' => 60,
                                                                                                'default' => 'identicon',
                                                                                            )); ?>" alt="<?php echo $author; ?>"></div>
                                            <div class="reviews__author-content">
                                                <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                                                <div class="reviews__author-info d-flex">
                                                    <div class="card__icon d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php if ($user_role[0] == ''):
                                                            echo 'Гость';
                                                        endif;
                                                        if ($user_role[0] != ''):
                                                            echo $user_role[0];
                                                        endif; ?>
                                                    </div>
                                                    <?php if ($city != ''): ?>
                                                        <div class="card__icon d-flex align-items-center">
                                                            <div class="mr-2"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo $city ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- / item -->
                            <?php }
                        } else { ?>
                            <p class="col-12">Пока нет отзывов.</p>
                        <?php } ?>
                    <?php elseif ($TAX == 'creditcard' || $TAX == 'debetcard' || $TAX == 'installmentcard'): ?>
                        <?php

                        $ppp = 10; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                        $custom_offset = 0;

                        // fetch posts in all those categories
                        $posts = get_objects_in_term($tax_id, 'bankcards');

                        $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
 FROM {$wpdb->comments} WHERE
 comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1
 ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                        $comments_list = $wpdb->get_results($sql);

                        if (count($comments_list) > 0) {
                            foreach ($comments_list as $comm) {

                                $comment_id = $comm->comment_ID;
                                $comment = get_comment($comment_id);
                                $comment_post_id = $comment->comment_post_ID;
                                $parent_comment = $comment->comment_parent;
                                $bank_id = get_field('bank_choise', $comment_post_id);
                                $user = get_userdata($comment->user_id);
                                $user_email = $user->user_email;
                                $author = get_comment_author($comment_id);
                                $user_role = $user->roles;
                                $city = get_comment_meta($comment_id, 'city', true); ?>
                                <?php if ($parent_comment == 0): ?>
                                    <!-- item -->
                                    <div class="reviews__item col-12 col-md-6 col-lg-4 mb-5 reviews__page-item">
                                        <div class="reviews__item-body">
                                            <div class="reviews__header d-flex align-items-center mb-2">
                                                <div class="reviews__header-logo"><img src="<?php echo the_field('bank_logo', $bank_id) ?>" alt=""></div>
                                                <div class="reviews__header-meta ml-3">
                                                    <a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($bank_id) ?></a>
                                                    <div class="d-flex">
                                                        <div class="card__rating d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo the_field('ratings_average', $bank_id); ?>
                                                        </div>
                                                        <div class="card__icon d-flex align-items-center">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo comments_number('0', '1', '%', $bank_id); ?>
                                                        </div>
                                                        <div class="card__date d-none d-sm-block ml-auto"><?php echo  get_comment_date('d.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reviews__item-content">
                                                <p><?php echo $comment->comment_content; ?></p>
                                            </div>
                                        </div>
                                        <div class="reviews__item-footer">
                                            <div class="reviews__author d-flex align-items-center mt-3">
                                                <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url($user_email, array(
                                                                                                    'size' => 60,
                                                                                                    'default' => 'identicon',
                                                                                                )); ?>" alt="<?php echo $author; ?>"></div>
                                                <div class="reviews__author-content">
                                                    <a href="" class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                                                    <div class="reviews__author-info d-flex">
                                                        <div class="card__icon d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php if ($user_role[0] == ''):
                                                                echo 'Гость';
                                                            endif;
                                                            if ($user_role[0] != ''):
                                                                echo $user_role[0];
                                                            endif; ?>
                                                        </div>
                                                        <?php if ($city != ''): ?>
                                                            <div class="card__icon d-flex align-items-center">
                                                                <div class="mr-2"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                                                    </svg></div>
                                                                <?php echo $city ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / item -->
                                <?php endif; ?>
                            <?php }
                        } else { ?>
                            <p class="col-12">Пока нет отзывов.</p>
                        <?php } ?>
                    <?php elseif ($TAX == 'kredity'): ?>
                        <?php

                        $ppp = 10; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                        $custom_offset = 0;

                        // fetch posts in all those categories
                        $posts = get_cpt_ids('kredity');

                        $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
 FROM {$wpdb->comments} WHERE
 comment_post_ID in (" . implode(',', $posts) . ") AND comment_approved = 1 AND comment_parent = 0
 ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                        $comments_list = $wpdb->get_results($sql);

                        if (count($comments_list) > 0) {
                            foreach ($comments_list as $comm) {

                                $comment_id = $comm->comment_ID;
                                $comment = get_comment($comment_id);
                                $comment_post_id = $comment->comment_post_ID;
                                $bank_id = get_field('product_bank', $comment_post_id);
                                $parent_comment = $comment->comment_parent;
                                $user = get_userdata($comment->user_id);
                                $user_email = $user->user_email;
                                $author = get_comment_author($comment_id);
                                $user_role = $user->roles;
                                $city = get_comment_meta($comment_id, 'city', true); ?>
                                <?php if ($parent_comment == 0): ?>
                                    <!-- item -->
                                    <div class="reviews__item col-12 col-md-6 col-lg-4 mb-5 reviews__page-item">
                                        <div class="reviews__item-body">
                                            <div class="reviews__header d-flex align-items-center mb-2">
                                                <div class="reviews__header-logo"><img src="<?php echo the_field('bank_logo', $bank_id) ?>" alt=""></div>
                                                <div class="reviews__header-meta ml-3">
                                                    <a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($bank_id) ?></a>
                                                    <div class="d-flex">
                                                        <div class="card__rating d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo the_field('ratings_average', $bank_id); ?>
                                                        </div>
                                                        <div class="card__icon d-flex align-items-center">
                                                            <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo comments_number('0', '1', '%', $bank_id); ?>
                                                        </div>
                                                        <div class="card__date d-none d-sm-block ml-auto"><?php echo  get_comment_date('d.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reviews__item-content">
                                                <p><?php echo $comment->comment_content; ?></p>
                                            </div>
                                        </div>
                                        <div class="reviews__item-footer">
                                            <div class="reviews__author d-flex align-items-center mt-3">
                                                <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url($user_email, array(
                                                                                                    'size' => 60,
                                                                                                    'default' => 'identicon',
                                                                                                )); ?>" alt="<?php echo $author; ?>"></div>
                                                <div class="reviews__author-content">
                                                    <a href="" class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                                                    <div class="reviews__author-info d-flex">
                                                        <div class="card__icon d-flex align-items-center mr-3">
                                                            <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php if ($user_role[0] == ''):
                                                                echo 'Гость';
                                                            endif;
                                                            if ($user_role[0] != ''):
                                                                echo $user_role[0];
                                                            endif; ?>
                                                        </div>
                                                        <?php if ($city != ''): ?>
                                                            <div class="card__icon d-flex align-items-center">
                                                                <div class="mr-2"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                                                    </svg></div>
                                                                <?php echo $city ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / item -->
                                <?php endif; ?>
                            <?php }
                        } else { ?>
                            <p class="col-12">Пока нет отзывов.</p>
                        <?php } ?>
                    <?php endif; ?>
                </div>
                <!-- pagination -->
                <div class="pagination flex-column">
                    <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                        <div class="pagination__description mt-4 mt-sm-0">
                            Показано <span class="review-tax-count"></span> отзывов из <span class="review-tax-count-all"></span>
                        </div>
                    </div>
                </div>
                <!-- / pagination -->
            </div>
        </div>
    </main>
<?php endif; ?>






































<?php



$current_page_comments = (get_query_var('comments')) ? get_query_var('comments') : 1;
$current_page_comments = str_replace('page/', '', $current_page_comments);
$comments_per_page = 10;
$current_page = $current_page_comments;
$offset = (--$current_page) * $comments_per_page;
// Почему +1 ? ВОПРОСЫ
$current_page++;

//MYSQL: LIMIT offset, number
$params = array(
    'post_id' => $post->ID,
    'offset' => $offset,
    'status' => 'approve',
    'number' => $comments_per_page,
);

$comments = get_comments($params);
$count_items = count($comments);

//if($count_items < 1){
//    global $wp_query;
//    $url_clear = get_clear_url($_SERVER['REQUEST_URI']);
//    wp_redirect( $url_clear, 301 );
//    //$wp_query->set_404();
//    //status_header( 404 );
//    //nocache_headers();
//    //require get_404_template();
//}




$total_comments = get_comments(
    array_merge(
        $params,
        array(
            'count' => true,
            'offset' => 0,
            'number' => 0
        )
    )
);

$max_page = ceil($total_comments / $comments_per_page);


//$comments_per_page = count($comments);

// Комментарии вариант 2
if ($ID != ''  && $DISPLAY == 'comments'): ?>
    <?php if ($post_type == "bankcard"):
        switch ($term_slug) {
            case 'debetcard':
                $title_term = "дебетовой карте";
                $title_term1 = "Дебетовой карты";
                break;
            case 'installmentcard':
                $title_term = "карте рассрочки";
                $title_term1 = "Карты рассрочки";
                break;
            case 'creditcard':
                $title_term = "кредитной карте";
                $title_term1 = "Кредитные карты";
                break;
            default:
                $title_term = "банковской карте";
                $title_term1 = "Банковские карты";
        }

    ?>

        <main>
            <div class="container">
                <nav aria-label="breadcrumb" class="horizontal__scroll">
                    <ol class="breadcrumb horizontal__scroll-container">
                        <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo get_term_link($term_id, '') ?>"><?php echo $title_term1 ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo get_the_permalink($ID) ?>"><?php echo get_the_title($ID) ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
                    </ol>
                </nav>
                <div class="section">
                    <div class="section__header mb-4 d-sm-flex justify-content-between align-items-center">
                        <h1 class="title mb-0">Отзывы о <?php echo $title_term ?> "<?php echo get_the_title($ID) ?>"</h1>
                        <button class="btn btn-primary btn-sm btn-scroll section__header-btn mt-4 mt-sm-0" data-target="commentForm">Оставить отзыв</button>
                    </div>
                    <div class="comments comments-page-list 111" id="comments">
                        <?php comments_template('/comments2.php'); ?>
                    </div>


                    <!-- pagination -->
                    <div class="pagination flex-column mb-5 mb-md-0 ">

                        <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                            <div class="pagination__links">
                                <?php //echo $pagination = str_replace("next", "pagination__links-last", $pagination); 
                                ?>

                                <?php my_pagination($max_page, $current_page); ?>
                            </div>

                            <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
                            wp_reset_query(); ?>
                            <div class="pagination__description mt-4 mt-sm-0">
                                Показано <span class="count_view"><?php echo $count_items; ?></span>
                                отзывов из <span class="count_all"><?php echo $total_comments; ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- / pagination -->

                </div>
                <div class="section">
                    <!-- form -->
                    <div class="form" id="commentForm">

                        <div style="display:none;margin-top: 1rem;margin-bottom: 1rem;color: green;" class="response-for-comment">
                            Ваш комментарий ожидает проверки
                        </div>

                        <?php
                        // получим данные из куков
                        $commenter = wp_get_current_commenter();
                        $args = wp_parse_args($args);
                        if (! isset($args['format'])) {
                            $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
                        }
                        $html5 = 'html5' === $args['format'];
                        // определим поля которые нужно вывести
                        $req = get_option('require_name_email') ? ' <span class="required">*</span>' : '';

                        $aria_req = $req ? " aria-required='true'" : '';
                        $html_req = $req ? " required='required'"  : '';

                        $city =  do_shortcode("[wt_geotargeting get='city']");

                        if (!$city) {
                            $city = 'Пусто';
                        }

                        $defaults = [
                            'fields'               => [
                                'author' => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="author" class="form-control" placeholder="Имя"  name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . $html_req . ' required="required" />
                                                </div>
                                            </div>',
                                'email'  => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="email" class="form-control" placeholder="E-Mail" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' required="required"/>
                                                </div>
                                            </div>',
                                'city' => '<div class="col-12 col-md-6" style="display: none">
                                            <div class="mb-3">
                                                <input id="city" class="form-control" placeholder="Город"  name="city" type="text" value="' . $city . '" ' . $aria_req . $html_req . ' />
                                                </div>
                                            </div>',
                            ],
                            'comment_field'        => '<div class="col-12">
                                                        <textarea id="comment" name="comment" class="form-control" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
                                                    </div>',
                            'logged_in_as'         => '<div class="col-12 mb-2">' .
                                sprintf(__('<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($ID)))) . '
                         </div>',
                            'comment_notes_before'  => '',
                            'comment_notes_after'  => '',
                            'id_form'              => 'commentform',
                            'id_submit'            => 'submit',
                            'class_container'      => 'comment-respond',
                            'class_form'           => 'comment-form row',
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
                            'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5 reviews-page-link-submit mb-3" value="Отправить" />',
                            'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                            'format'               => 'xhtml',
                        ];
                        echo comment_form($defaults, $ID); ?>
                    </div>
                    <!-- / from -->
                </div>
                <div class="section">
                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0"> <a style="color: var(--black);" href="<?php echo get_term_link($term_id, '') ?>"> Лучшие предложения </a></h2>
                        <a href="<?php echo get_term_link($term_id, '') ?>" class="btn btn-primary btn-sm btn-all">
                            Все
                            <span class="icon ml-2">
                                <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type'             => 'bankcard',
                                'posts_per_page'        => 4,
                                'meta_key' => 'ratings_average',
                                'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                                'order' => 'DESC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'bankcards',
                                        'field'    => 'slug',
                                        'terms'    =>  $term_slug,
                                    ),
                                )
                            );

                            get_template_part('all_template/the_best_offers_list', null, $args); ?>


                        </div>
                    </div>
                </div>
            </div>
        </main>
    <?php endif; ?>



    <?php if ($post_type == 'collection'): ?>


        <main>
            <div class="container">
                <nav aria-label="breadcrumb" class="horizontal__scroll">
                    <ol class="breadcrumb horizontal__scroll-container">
                        <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('kredity'); ?>">Кредиты</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo get_the_permalink($ID) ?>"><?php echo get_the_title($ID) ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
                    </ol>
                </nav>
                <div class="section">
                    <div class="section__header mb-4 d-sm-flex justify-content-between align-items-center">
                        <h1 class="h1 title mb-0">Отзывы о кредите "<?php echo get_the_title($ID) ?>"</h1>
                        <button class="btn btn-primary btn-sm btn-scroll section__header-btn mt-4 mt-sm-0" data-target="commentForm">Оставить отзыв</button>
                    </div>
                    <div class="comments comments-page-list 222" id="comments">
                        <?php comments_template('/comments2.php'); ?>
                    </div>
                    <!-- pagination -->
                    <div class="pagination flex-column mb-5 mb-md-0 ">

                        <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                            <div class="pagination__links">
                                <?php //echo $pagination = str_replace("next", "pagination__links-last", $pagination); 
                                ?>

                                <?php my_pagination($max_page, $current_page); ?>
                            </div>

                            <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
                            wp_reset_query(); ?>
                            <div class="pagination__description mt-4 mt-sm-0">
                                Показано <span class="count_view"><?php echo $count_items; ?></span>
                                отзывов из <span class="count_all"><?php echo $total_comments; ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- / pagination -->
                </div>
                <div class="section">
                    <!-- form -->
                    <div class="form" id="commentForm">
                        <?php
                        // получим данные из куков
                        $commenter = wp_get_current_commenter();
                        $args = wp_parse_args($args);
                        if (! isset($args['format'])) {
                            $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
                        }
                        $html5 = 'html5' === $args['format'];
                        // определим поля которые нужно вывести
                        $req = get_option('require_name_email') ? ' <span class="required">*</span>' : '';

                        $aria_req = $req ? " aria-required='true'" : '';
                        $html_req = $req ? " required='required'"  : '';

                        $city =  do_shortcode("[wt_geotargeting get='city']");
                        $defaults = [
                            'fields'               => [
                                'author' => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="author" class="form-control" placeholder="Имя"  name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . $html_req . ' required="required" />
                                                </div>
                                            </div>',
                                'email'  => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="email" class="form-control" placeholder="E-Mail" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' required="required"/>
                                                </div>
                                            </div>',
                                'city' => '<div class="col-12 col-md-6" style="display: none;">
                                            <div class="mb-3">
                                                <input id="city" class="form-control" placeholder="Город"  name="city" type="text" value="' . $city . '" ' . $aria_req . $html_req . ' />
                                                </div>
                                            </div>',
                            ],
                            'comment_field'        => '<div class="col-12">
                                                        <textarea id="comment" name="comment" class="form-control" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
                                                    </div>',
                            'logged_in_as'         => '<div class="col-12 mb-2">' .
                                sprintf(__('<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($ID)))) . '
                         </div>',
                            'comment_notes_before'  => '',
                            'comment_notes_after'  => '',
                            'id_form'              => 'commentform',
                            'id_submit'            => 'submit',
                            'class_container'      => 'comment-respond',
                            'class_form'           => 'comment-form row',
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
                            'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5 reviews-page-link-submit mb-3" value="Отправить" />',
                            'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                            'format'               => 'xhtml',
                        ];
                        echo comment_form($defaults, $ID); ?>
                    </div>
                    <!-- / form -->
                </div>
                <div class="section">
                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0">Лучшие кредиты </h2>
                        <a href="<?php echo get_post_type_archive_link('kredity') ?>" class="btn btn-primary btn-sm btn-all">
                            Все
                            <span class="icon ml-2">
                                <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type'             => 'kredity',
                                'posts_per_page'        => 4,
                                'meta_key' => 'ratings_average',
                                'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                                'order' => 'DESC',
                            );

                            get_template_part('all_template/the_best_offers_list', null, $args); ?>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    <?php endif; ?>

    <?php if ($post_type == "banks"): ?>
        <main>
            <div class="container">
                <nav aria-label="breadcrumb" class="horizontal__scroll">
                    <ol class="breadcrumb horizontal__scroll-container">
                        <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('banks'); ?>">Банки</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo get_the_permalink($ID) ?>"><?php echo get_the_title($ID) ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
                    </ol>
                </nav>
                <div class="section">
                    <div class="section__header mb-4 d-sm-flex justify-content-between align-items-center">
                        <h1 class="title mb-0">Отзывы о банке "<?php echo get_the_title($ID) ?>"</h1>
                        <button class="btn btn-primary btn-sm btn-scroll section__header-btn mt-4 mt-sm-0" data-target="commentForm">Оставить отзыв</button>
                    </div>
                    <div class="comments comments-page-list 3333" id="comments">
                        <?php comments_template('/comments2.php'); ?>
                    </div>
                    <!-- pagination -->
                    <div class="pagination flex-column mb-5 mb-md-0 ">

                        <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                            <div class="pagination__links">
                                <?php //echo $pagination = str_replace("next", "pagination__links-last", $pagination); 
                                ?>

                                <?php my_pagination($max_page, $current_page); ?>
                            </div>

                            <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
                            wp_reset_query(); ?>
                            <div class="pagination__description mt-4 mt-sm-0">
                                Показано <span class="count_view"><?php echo $count_items; ?></span>
                                отзывов из <span class="count_all"><?php echo $total_comments; ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- / pagination -->
                </div>
                <div class="section">
                    <!-- form -->
                    <div class="form" id="commentForm">
                        <?php
                        // получим данные из куков
                        $commenter = wp_get_current_commenter();
                        $args = wp_parse_args($args);
                        if (! isset($args['format'])) {
                            $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
                        }
                        $html5 = 'html5' === $args['format'];
                        // определим поля которые нужно вывести
                        $req = get_option('require_name_email') ? ' <span class="required">*</span>' : '';

                        $aria_req = $req ? " aria-required='true'" : '';
                        $html_req = $req ? " required='required'"  : '';

                        $city =  do_shortcode("[wt_geotargeting get='city']");
                        $defaults = [
                            'fields'               => [
                                'author' => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="author" class="form-control" placeholder="Имя"  name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . $html_req . ' required="required" />
                                                </div>
                                            </div>',
                                'email'  => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="email" class="form-control" placeholder="E-Mail" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' required="required"/>
                                                </div>
                                            </div>',
                                'city' => '<div class="col-12 col-md-6" style="display: none;">
                                            <div class="mb-3">
                                                <input id="city" class="form-control" placeholder="Город"  name="city" type="text" value="' . $city . '" ' . $aria_req . $html_req . ' />
                                                </div>
                                            </div>',
                            ],
                            'comment_field'        => '<div class="col-12">
                                                        <textarea id="comment" name="comment" class="form-control" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
                                                    </div>',
                            'logged_in_as'         => '<div class="col-12 mb-2">' .
                                sprintf(__('<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($ID)))) . '
                         </div>',
                            'comment_notes_before'  => '',
                            'comment_notes_after'  => '',
                            'id_form'              => 'commentform',
                            'id_submit'            => 'submit',
                            'class_container'      => 'comment-respond',
                            'class_form'           => 'comment-form row',
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
                            'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5 reviews-page-link-submit mb-3" value="Отправить" />',
                            'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                            'format'               => 'xhtml',
                        ];
                        echo comment_form($defaults, $ID); ?>
                    </div>
                    <!-- / from -->
                </div>
                <div class="section">
                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0">Лучшие предложения </h2>
                        <a href="<?php echo get_the_permalink($ID) ?>" class="btn btn-primary btn-sm btn-all">
                            Все
                            <span class="icon ml-2">
                                <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="horizontal__scroll row">
                        <div id="response-bank-offers" class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type'             => array('bankcard', 'kredity'),
                                'posts_per_page'        => -1,
                                'meta_key' => 'ratings_average',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC',
                            );
                            $args['meta_query'] = array('relation' => 'OR');
                            $args['meta_query'][] = array(
                                'key' => 'bank_choise',
                                'value' => $ID,
                            );
                            $args['meta_query'][] = array(
                                'key' => 'product_bank',
                                'value' => $ID,
                            );


                            get_template_part('all_template/the_best_offers_list', null, $args);

                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <? endif; ?>
    <?php if ($post_type == "kredity"): ?>
        <main>
            <div class="container">
                <nav aria-label="breadcrumb" class="horizontal__scroll">
                    <ol class="breadcrumb horizontal__scroll-container">
                        <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('kredity'); ?>">Кредиты</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo get_the_permalink($ID) ?>"><?php echo get_the_title($ID) ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
                    </ol>
                </nav>
                <div class="section">
                    <div class="section__header mb-4 d-sm-flex justify-content-between align-items-center">
                        <h1 class="h1 title mb-0">Отзывы о кредите "<?php echo get_the_title($ID) ?>"</h1>
                        <button class="btn btn-primary btn-sm btn-scroll section__header-btn mt-4 mt-sm-0" data-target="commentForm">Оставить отзыв</button>
                    </div>
                    <div class="comments comments-page-list 444" id="comments">
                        <?php comments_template('/comments2.php'); ?>
                    </div>


                    <!-- pagination -->

                    <div class="pagination flex-column mb-5 mb-md-0 ">

                        <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                            <div class="pagination__links">
                                <?php //echo $pagination = str_replace("next", "pagination__links-last", $pagination); 
                                ?>

                                <?php my_pagination($max_page, $current_page); ?>
                            </div>

                            <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
                            wp_reset_query(); ?>
                            <div class="pagination__description mt-4 mt-sm-0">
                                Показано <span class="count_view"><?php echo $count_items; ?></span>
                                отзывов из <span class="count_all"><?php echo $total_comments; ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- / pagination -->




                </div>
                <div class="section">
                    <!-- form -->
                    <div class="form" id="commentForm">
                        <?php
                        // получим данные из куков
                        $commenter = wp_get_current_commenter();
                        $args = wp_parse_args($args);
                        if (! isset($args['format'])) {
                            $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
                        }
                        $html5 = 'html5' === $args['format'];
                        // определим поля которые нужно вывести
                        $req = get_option('require_name_email') ? ' <span class="required">*</span>' : '';

                        $aria_req = $req ? " aria-required='true'" : '';
                        $html_req = $req ? " required='required'"  : '';

                        $city =  do_shortcode("[wt_geotargeting get='city']");
                        $defaults = [
                            'fields'               => [
                                'author' => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="author" class="form-control" placeholder="Имя"  name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . $html_req . ' required="required" />
                                                </div>
                                            </div>',
                                'email'  => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="email" class="form-control" placeholder="E-Mail" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' required="required"/>
                                                </div>
                                            </div>',
                                'city' => '<div class="col-12 col-md-6" style="display: none;">
                                            <div class="mb-3">
                                                <input id="city" class="form-control" placeholder="Город"  name="city" type="text" value="' . $city . '" ' . $aria_req . $html_req . ' />
                                                </div>
                                            </div>',
                            ],
                            'comment_field'        => '<div class="col-12">
                                                        <textarea id="comment" name="comment" class="form-control" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
                                                    </div>',
                            'logged_in_as'         => '<div class="col-12 mb-2">' .
                                sprintf(__('<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($ID)))) . '
                         </div>',
                            'comment_notes_before'  => '',
                            'comment_notes_after'  => '',
                            'id_form'              => 'commentform',
                            'id_submit'            => 'submit',
                            'class_container'      => 'comment-respond',
                            'class_form'           => 'comment-form row',
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
                            'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5 reviews-page-link-submit mb-3" value="Отправить" />',
                            'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                            'format'               => 'xhtml',
                        ];
                        echo comment_form($defaults, $ID); ?>
                    </div>
                    <!-- / form -->
                </div>
                <div class="section">
                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0">Лучшие кредиты </h2>
                        <a href="<?php echo get_post_type_archive_link('kredity') ?>" class="btn btn-primary btn-sm btn-all">
                            Все
                            <span class="icon ml-2">
                                <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type'             => 'kredity',
                                'posts_per_page'        => 4,
                                'meta_key' => 'ratings_average',
                                'orderby' => array('meta_value_num' => 'desc', 'name' => 'desc'),
                                'order' => 'DESC',
                            );

                            get_template_part('all_template/the_best_offers_list', null, $args); ?>

                            <?php
                            wp_reset_query();
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    <? endif; ?>
    <?php if ($post_type == "zaimy"): ?>
        <main>
            <div class="container">
                <nav aria-label="breadcrumb" class="horizontal__scroll">
                    <ol class="breadcrumb horizontal__scroll-container">
                        <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('zaimy'); ?>">Займы</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo get_the_permalink($ID) ?>"><?php echo get_the_title($ID) ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
                    </ol>
                </nav>
                <div class="section">
                    <div class="section__header mb-4 d-sm-flex justify-content-between align-items-center">
                        <h1 class="title mb-0">Отзывы о займе "<?php echo get_the_title($ID) ?>"</h1>
                        <button class="btn btn-primary btn-sm btn-scroll section__header-btn mt-4 mt-sm-0" data-target="commentForm">Оставить отзыв</button>
                    </div>
                    <div class="comments comments-page-list 5555" id="comments">


                        <?php comments_template('/comments2.php'); ?>
                    </div>

                    <!-- pagination -->
                    <div class="pagination flex-column mb-5 mb-md-0 ">

                        <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                            <div class="pagination__links">
                                <?php //echo $pagination = str_replace("next", "pagination__links-last", $pagination); 
                                ?>

                                <?php my_pagination($max_page, $current_page); ?>
                            </div>

                            <?php // Возвращаем оригинальные данные поста. Сбрасываем $post.
                            wp_reset_query(); ?>
                            <div class="pagination__description mt-4 mt-sm-0">
                                Показано111 <span class="count_view"><?php echo $count_items; ?></span>
                                отзывов из <span class="count_all"><?php echo $total_comments; ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- / pagination -->





                </div>
                <div class="section">
                    <!-- form -->
                    <div class="form 2223" id="commentForm">
                        <?php
                        // получим данные из куков
                        $commenter = wp_get_current_commenter();
                        $args = wp_parse_args($args);
                        if (! isset($args['format'])) {
                            $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
                        }
                        $html5 = 'html5' === $args['format'];
                        // определим поля которые нужно вывести
                        $req = get_option('require_name_email') ? ' <span class="required">*</span>' : '';

                        $aria_req = $req ? " aria-required='true'" : '';
                        $html_req = $req ? " required='required'"  : '';

                        //$city =  do_shortcode( "[wt_geotargeting get='city']" );
                        $defaults = [
                            'fields'               => [
                                'author' => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="author" class="form-control" placeholder="Имя"  name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . $html_req . ' required="required" />
                                                </div>
                                            </div>',
                                'email'  => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="email" class="form-control" placeholder="E-Mail" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' required="required"/>
                                                </div>
                                            </div>',
                            ],
                            'comment_field'        => '<div class="col-12">
                                                        <textarea id="comment" name="comment" class="form-control" placeholder="Ваш комментарий / отзыв" rows="4"  aria-required="true" required="required"></textarea>
                                                    </div>',
                            'logged_in_as'         => '<div class="col-12 mb-2">' .
                                sprintf(__('<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($ID)))) . '
                         </div>',
                            'comment_notes_before'  => '',
                            'comment_notes_after'  => '',
                            'id_form'              => 'commentform',
                            'id_submit'            => 'submit',
                            'class_container'      => 'comment-respond',
                            'class_form'           => 'comment-form row',
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
                            'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary px-5 reviews-page-link-submit mb-3" value="Отправить" />',
                            'submit_field'         => '<div class="col-12"><div class="mt-3">%1$s %2$s</div></div>',
                            'format'               => 'xhtml',
                        ];
                        echo comment_form($defaults, $ID); ?>
                    </div>
                    <!-- / form -->
                </div>
                <div class="section">
                    <div class="section__header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="title mb-0">Лучшие займы </h2>
                        <a href="<?php echo get_post_type_archive_link('zaimy') ?>" class="btn btn-primary btn-sm btn-all">
                            Все
                            <span class="icon ml-2">
                                <svg width="21" height="12" viewBox="0 0 21 12" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.242 5.266A.738.738 0 0 0 .5 6c0 .406.332.734.742.734H11.38v2.07c0 2.233 2.59 3.495 4.379 2.132l3.68-2.803a2.674 2.674 0 0 0 0-4.266l-3.68-2.803c-1.789-1.363-4.38-.1-4.38 2.132v2.07H1.243Zm13.612 4.507c-.813.62-1.99.046-1.99-.97V3.197c0-1.015 1.177-1.588 1.99-.969l3.68 2.804c.643.49.643 1.449 0 1.939l-3.68 2.803Z"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="horizontal__scroll row">
                        <div class="horizontal__scroll-container">
                            <?php
                            $args = array(
                                'post_type'             => 'zaimy',
                                'posts_per_page'        => 4,
                                'meta_key' => 'ratings_average',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC',
                            );
                            get_template_part('all_template/the_best_offers_list', null, $args); ?>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    <? endif; ?>
<?php endif; ?>


















<!-- Все отзывы при пустых кукис -->

<?php if ($TAX == '' && $ID == ''): ?>
    <main>
        <div class="container">
            <nav aria-label="breadcrumb" class="horizontal__scroll">
                <ol class="breadcrumb horizontal__scroll-container">
                    <li class="breadcrumb-item"><a href="<?php echo get_home_url() ?>">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
                </ol>
            </nav>
        </div>
        <!-- page header -->
        <div class="page__heading mb-4">
            <div class="container">
                <div class="page__heading-top d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page__heading-title mb-0">Отзывы</h1>
                        <h3 class="font-weight-semibold mt-2 mb-0">Благодаря честным отзывам вы сможете осуществить более разумный выбор</h3>
                    </div>
                    <div class="page__heading-icon"><img src="<?php bloginfo('template_url'); ?>/img/icon__title-like.png" alt=""></div>
                </div>
            </div>
        </div>
        <!-- / page header -->
        <!-- page nav -->
        <div class="page__nav">
            <div class="container">
                <div class="page__nav-container nav-tabs">
                    <div class="horizontal__scroll">
                        <div class="horizontal__scroll-container">
                            <a href="<?php echo get_post_type_archive_link('banks'); ?>" class="nav-link">Все банки</a>
                            <a href="" class="nav-link active">Отзывы</a>
                            <a href="<?php echo get_page_link(149) ?>" class="nav-link">Калькулятор</a>
                            <a href="<?php echo get_category_link(9) ?>" class="nav-link">Статьи</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / page nav -->
        <div class="container">
            <div class="section">
                <div class="row reviews-page-list" id="reviews">
                    <?php

                    $ppp = 10; // either use the WordPress global Posts per page setting or set a custom one like $ppp = 10;
                    $custom_offset = 0;

                    // fetch posts in all those categories
                    $posts = get_cpt_ids('banks');
                    $posts2 = get_cpt_ids('bankcard');
                    $posts3 = get_cpt_ids('kredity');
                    $posts_merge =  array_merge($posts, $posts2, $posts3);

                    $sql = "SELECT comment_ID, comment_date, comment_content, comment_post_ID
 FROM {$wpdb->comments} WHERE
 comment_post_ID in (" . implode(',', $posts_merge) . ") AND comment_approved = 1 AND comment_parent = 0
 ORDER by comment_date DESC LIMIT $ppp OFFSET $custom_offset";

                    $comments_list = $wpdb->get_results($sql);

                    if (count($comments_list) > 0) {
                        foreach ($comments_list as $comm) {

                            $comment_id = $comm->comment_ID;
                            $comment = get_comment($comment_id);
                            $comment_post_id = $comment->comment_post_ID;
                            $parent_comment = $comment->comment_parent;
                            $user = get_userdata($comment->user_id);
                            $user_email = $user->user_email;
                            $author = get_comment_author($comment_id);
                            $user_role = $user->roles;
                            $city = get_comment_meta($comment_id, 'city', true);
                            $post_type = get_post_type($comment_post_id); ?>
                            <?php if ($parent_comment == 0): ?>
                                <!-- item -->
                                <div class="reviews__item col-12 col-md-6 col-lg-4 mb-5 reviews__page-item">
                                    <div class="reviews__item-body">
                                        <div class="reviews__header d-flex align-items-center mb-2">
                                            <div class="reviews__header-logo">
                                                <?php if ($post_type == 'banks'): ?>
                                                    <img src="<?php echo the_field('bank_logo', $comment_post_id) ?>" alt="">
                                                <?php endif; ?>
                                                <?php if ($post_type == 'bankcard'):
                                                    $bank_id = get_field('bank_choise', $comment_post_id) ?>
                                                    <img src="<?php echo the_field('bank_logo', $bank_id) ?>" alt="">
                                                <?php endif; ?>
                                                <?php if ($post_type == 'kredity'):
                                                    $bank_id = get_field('product_bank', $comment_post_id) ?>
                                                    <img src="<?php echo the_field('bank_logo', $bank_id) ?>" alt="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="reviews__header-meta ml-3">
                                                <a href="<?php echo get_comment_link($comment_id) ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo get_the_title($comment_post_id) ?></a>
                                                <div class="d-flex">
                                                    <div class="card__rating d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php echo the_field('ratings_average', $comment_post_id); ?>
                                                    </div>
                                                    <div class="card__icon d-flex align-items-center">
                                                        <div class="mr-2"><svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php if ($post_type == 'banks'): ?>
                                                            <?php echo comments_number('0', '1', '%', $comment_post_id); ?>
                                                        <?php endif; ?>
                                                        <?php if ($post_type == 'bankcard'):
                                                            $bank_id = get_field('bank_choise', $comment_post_id) ?>
                                                            <?php echo comments_number('0', '1', '%', $bank_id); ?>
                                                        <?php endif; ?>
                                                        <?php if ($post_type == 'kredity'):
                                                            $bank_id = get_field('product_bank', $comment_post_id) ?>
                                                            <?php echo comments_number('0', '1', '%', $bank_id); ?>
                                                        <?php endif; ?>

                                                    </div>
                                                    <div class="card__date d-none d-sm-block ml-auto"><?php echo  get_comment_date('d.m.y'); ?> / <?php echo get_comment_date('H:i') ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reviews__item-content">
                                            <p><?php echo $comment->comment_content; ?></p>
                                        </div>
                                    </div>
                                    <div class="reviews__item-footer">
                                        <div class="reviews__author d-flex align-items-center mt-3">
                                            <div class="reviews__author-img mr-3"><img src="<?php echo get_avatar_url($user_email, array(
                                                                                                'size' => 60,
                                                                                                'default' => 'identicon',
                                                                                            )); ?>" alt="<?php echo $author; ?>"></div>
                                            <div class="reviews__author-content">
                                                <a href="" class="reviews__author-title mb-2 d-block stretched-link"><?php echo $author; ?></a>
                                                <div class="reviews__author-info d-flex">
                                                    <div class="card__icon d-flex align-items-center mr-3">
                                                        <div class="mr-2"><svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#person" x="0" y="0"></use>
                                                            </svg></div>
                                                        <?php if ($user_role[0] == ''):
                                                            echo 'Гость';
                                                        endif;
                                                        if ($user_role[0] != ''):
                                                            echo $user_role[0];
                                                        endif; ?>
                                                    </div>
                                                    <?php if ($city != ''): ?>
                                                        <div class="card__icon d-flex align-items-center">
                                                            <div class="mr-2"><svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                                                </svg></div>
                                                            <?php echo $city ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- / item -->
                            <?php endif; ?>
                        <?php }
                    } else { ?>
                        <p class="col-12">Пока нет отзывов.</p>
                    <?php } ?>
                </div>
                <!-- pagination -->
                <div class="pagination flex-column">
                    <div class="pagination__container d-sm-flex justify-content-between align-items-center">
                        <div class="pagination__description mt-4 mt-sm-0">
                            Показано <span class="review-tax-count"></span> отзывов из <span class="review-tax-count-all"></span>
                        </div>
                    </div>
                </div>
                <!-- / pagination -->
            </div>
        </div>
    </main>
<?php endif; ?>

<?php get_footer() ?>