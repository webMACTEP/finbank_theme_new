<?php 
// Получение списка комментариев из переданных аргументов
$comments_list = $args['DATA'];

// Определение имени поля для получения bank_id, с возможностью переопределения через аргументы
$bank_id_field_name = 'product_bank'; // bank_choice
if ( isset($args['bank_id__field_name']) && !empty($args['bank_id__field_name']) ) {
    $bank_id_field_name = $args['bank_id__field_name'];
}
?>

<?php if ( count( $comments_list ) > 0 ): ?>

    <?php foreach ( $comments_list as $comm ): ?>

        <?php
            // Получение информации о комментарии
            $comment_id = $comm->comment_ID;
            $comment = get_comment($comment_id);
            $comment_post_id = $comment->comment_post_ID;

            // Получение bank_id с помощью ACF
            $bank_id = get_field($bank_id_field_name, $comment_post_id);

            // Получение данных пользователя
            $user = get_userdata( $comment->user_id );
            $user_email = '';
            $user_role = '';
            if ( ! empty($user) ) {
                $user_email = $user->user_email;
                $user_role = $user->roles;
            }

            // Получение автора комментария и города из метаданных
            $author = get_comment_author( $comment_id );
            $city = get_comment_meta( $comment_id, 'city', true );


        $user = get_userdata( $comment->user_id );
        $user_email = '';
        $user_role = '';
        if (!empty($user)) {
            $user_email = $user->user_email;
            $user_role = $user->roles;
        }
        $author = get_comment_author( $comment_id );
        $city = get_comment_meta( $comment_id, 'city', true );
    ?>



        <?php if( isset($args['TYPE']) && $args['TYPE'] === 'zaimy' ): ?>
            <!-- Отзывы типа "zaimy" -->
            <div class="reviews__item">

                <div class="reviews__item-body">
                    <div class="reviews__header d-flex align-items-center mb-2">
                        <div class="reviews__header-logo">
                            <img loading="lazy" src="<?php echo esc_url( get_field('z_organization_logo', $comment_post_id) ); ?>"
                                 alt="<?php
                                     $logo_id = get_field('z_organization_logo', $comment_post_id, false);
                                     $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                     echo esc_attr( $logo_alt );
                                 ?>">
                        </div>
                        <div class="reviews__header-meta ml-3">
                            <a href="<?php echo esc_url( get_comment_link($comment_id) ); ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo esc_html( get_the_title($comment_post_id) ); ?></a>
                            <div class="d-flex">
                                <div class="card__rating d-flex align-items-center mr-3">
                                    <div class="mr-2">
                                        <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                            <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                        </svg>
                                    </div>
                                    <?php echo esc_html( get_field('ratings_average', $comment_post_id) ); ?>
                                </div>
                                <div class="card__icon d-flex align-items-center">
                                    <div class="mr-2">
                                        <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                            <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                        </svg>
                                    </div>
                                    <?php echo esc_html( get_comments_number( $comment_post_id ) ); ?>
                                </div>
                                <div class="card__date d-none d-md-block ml-auto">
                                    <?php echo esc_html( get_comment_date( 'd.m.y', $comment_id ) ); ?> / <?php echo esc_html( get_comment_date('H:i', $comment_id ) ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="reviews__item-content">
                        <p><?php echo wp_kses_post( $comment->comment_content ); ?></p>
                    </div>
                </div>
                <div class="reviews__item-footer">
                    <div class="reviews__author d-flex align-items-center mt-3">
                        <div class="reviews__author-img mr-3">
                            <img loading="lazy" src="<?php echo esc_url( get_avatar_url( $comment, array('size' => 60, 'default' => 'identicon') ) ); ?>" alt="<?php echo esc_attr( $author ); ?>">
                        </div>
                        <div class="reviews__author-content">
                            <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo esc_html( $author ); ?></a>
                            <div class="reviews__author-info d-flex">
                                <div class="card__icon d-flex align-items-center mr-3">
                                    <div class="mr-2">
                                        <svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                            <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#person" x="0" y="0"></use>
                                        </svg>
                                    </div>
                                    <?php 
                                        if( empty( $user_role[0] ) ):
                                            echo 'Гость';
                                        else:
                                            echo esc_html( $user_role[0] );
                                        endif; 
                                    ?>
                                </div>
                                <?php if( ! empty( $city ) ): ?>
                                    <div class="card__icon d-flex align-items-center">
                                        <div class="mr-2">
                                            <svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                        <?php echo esc_html( $city ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / item -->
        <?php endif; ?>


        <?php if( isset($args['TYPE']) && $args['TYPE'] !== 'zaimy' ): ?>
            <!-- Отзывы других типов -->
            <div class="reviews__item">

                <div class="reviews__item-body">
                    <div class="reviews__header d-flex align-items-center mb-2">
                        <div class="reviews__header-logo">
                            <img loading="lazy" src="<?php echo esc_url( get_field('bank_logo', $bank_id) ); ?>"
                                 alt="<?php
                                     $logo_id = get_field('bank_logo', $bank_id, false);
                                     $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                                     echo esc_attr( $logo_alt );
                                 ?>">
                        </div>
                        <div class="reviews__header-meta ml-3">
                            <a href="<?php echo esc_url( get_comment_link($comment_id) ); ?>" class="reviews__header-title h4 mb-2 stretched-link"><?php echo esc_html( get_the_title($bank_id) ); ?></a>
                            <div class="d-flex">
                                <div class="card__rating d-flex align-items-center mr-3">
                                    <div class="mr-2">
                                        <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                            <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#starLine" x="0" y="0"></use>
                                        </svg>
                                    </div>
                                    <?php echo esc_html( get_field('ratings_average', $bank_id) ); ?>
                                </div>
                                <div class="card__icon d-flex align-items-center">
                                    <div class="mr-2">
                                        <svg width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve">
                                            <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#commentLine" x="0" y="0"></use>
                                        </svg>
                                    </div>
                                    <?php echo esc_html( get_comments_number( $bank_id ) ); ?>
                                </div>
                                <div class="card__date d-none d-md-block ml-auto">
                                    <?php echo esc_html( get_comment_date( 'd.m.y', $comment_id ) ); ?> / <?php echo esc_html( get_comment_date('H:i', $comment_id ) ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="reviews__item-content">
                        <p><?php echo wp_kses_post( $comment->comment_content ); ?></p>
                    </div>
                </div>
                <div class="reviews__item-footer">
                    <div class="reviews__author d-flex align-items-center mt-3">
                        <div class="reviews__author-img mr-3">
                            <img loading="lazy" src="<?php echo esc_url( get_avatar_url( $comment, array('size' => 60, 'default' => 'identicon') ) ); ?>" alt="<?php echo esc_attr( $author ); ?>">
                        </div>
                        <div class="reviews__author-content">
                            <a class="reviews__author-title mb-2 d-block stretched-link"><?php echo esc_html( $author ); ?></a>
                            <div class="reviews__author-info d-flex">
                                <div class="card__icon d-flex align-items-center mr-3">
                                    <div class="mr-2">
                                        <svg width="14" height="19" viewBox="0 0 16 21" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                            <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#person" x="0" y="0"></use>
                                        </svg>
                                    </div>
                                    <?php 
                                        if( empty( $user_role[0] ) ):
                                            echo 'Гость';
                                        else:
                                            echo esc_html( $user_role[0] );
                                        endif; 
                                    ?>
                                </div>
                                <?php if( ! empty( $city ) ): ?>
                                    <div class="card__icon d-flex align-items-center">
                                        <div class="mr-2">
                                            <svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                                <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#pointer" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                        <?php echo esc_html( $city ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / item -->
        <?php endif; ?>

    <?php endforeach; ?>

<?php else: ?>
    <p class="col-12">Пока нет отзывов.</p>
<?php endif; ?>
