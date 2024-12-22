

<?php

$ID = get_queried_object()->ID;

// получим данные из куков
$commenter = wp_get_current_commenter();
$args = wp_parse_args( $args );
if ( ! isset( $args['format'] ) ) {
    $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
}
$html5 = 'html5' === $args['format'];
// определим поля которые нужно вывести
$req = get_option( 'require_name_email' ) ? ' <span class="required">*</span>' : '';

$aria_req = $req ? " aria-required='true'" : '';
$html_req = $req ? " required='required'"  : '';


//$city =  do_shortcode( "[wt_geotargeting get='city']" );
$defaults = [
    'fields'               => [



        'author' => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="author" class="form-control" placeholder="Имя*"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . $html_req . ' required="required" />
                                                </div>
                                            </div>',
        'email'  => '<div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <input id="email" class="form-control" placeholder="E-Mail*" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' required="required"/>
                                                </div>
                                            </div>',

    ],
    'comment_field'        => '<div class="col-12">
                                                        <textarea id="comment" post-id="'. $ID .'"  name="comment" class="form-control input-comment-trigger" placeholder="Ваш комментарий / отзыв*" rows="4"  aria-required="true" required="required"></textarea>
                                                        <div class="form-comment__bottom">* - Обязательно заполнить</div>
                                                    </div>',
    'logged_in_as'         => '<div class="col-12 mb-2">' .
        sprintf( __( '<a href="%1$s" aria-label="Вы вошли как %2$s. Edit your profile.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $ID ) ) ) ) . '
                         </div>',
    'comment_notes_before'  => '',
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
echo comment_form( $defaults, $ID );

?>
