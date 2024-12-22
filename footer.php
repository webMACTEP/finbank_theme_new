<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package finbank_theme
 */

?>

<footer class="footer">
    <div class="container">
        <!-- footer services -->
        <div class="footer__services">
            <h2 class="d-none d-sm-block">Продукты и услуги Finabank</h2>
            <div class="row">
                <?php if (have_rows('menu_1', 'option')): ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="h3 footer__services-title">
                            <?php echo the_field('f_t_1', 'option') ?>
                            <button class="footer__services-title-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f1" aria-expanded="false">
                                <span class="footer__services-icon"></span>
                            </button>
                        </div>
                        <div id="f1" class="footer__services-wrap collapse">
                            <?php $counter = 0; ?>
                            <?php while (have_rows('menu_1', 'option')): the_row();
                                $link_text = get_sub_field('link_text');
                                $link_addr = get_sub_field('link_addr'); ?>
                                <?php if ($counter == 8): ?>
                                    <div class="footer__services-item show__all btn__view-all visible">
                                        <svg width="26" height="5" viewBox="0 0 26 5" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="3" cy="2.5" r="2.5"></circle>
                                            <circle cx="13" cy="2.5" r="2.5"></circle>
                                            <circle cx="23" cy="2.5" r="2.5"></circle>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="footer__services-item"><a href="<?php echo $link_addr ?>"><?php echo $link_text ?></a></div>
                                <?php $counter += 1; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('menu_2', 'option')): ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="h3 footer__services-title">
                            <?php echo the_field('f_t_2', 'option') ?>
                            <button class="footer__services-title-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f2" aria-expanded="false">
                                <span class="footer__services-icon"></span>
                            </button>
                        </div>
                        <div id="f2" class="footer__services-wrap collapse">
                            <?php $counter = 0; ?>
                            <?php while (have_rows('menu_2', 'option')): the_row();
                                $link_text = get_sub_field('link_text');
                                $link_addr = get_sub_field('link_addr'); ?>
                                <?php if ($counter == 8): ?>
                                    <div class="footer__services-item show__all btn__view-all visible">
                                        <svg width="26" height="5" viewBox="0 0 26 5" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="3" cy="2.5" r="2.5"></circle>
                                            <circle cx="13" cy="2.5" r="2.5"></circle>
                                            <circle cx="23" cy="2.5" r="2.5"></circle>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="footer__services-item"><a href="<?php echo $link_addr ?>"><?php echo $link_text ?></a></div>
                                <?php $counter += 1; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('menu_3', 'option')): ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="h3 footer__services-title">
                            <?php echo the_field('f_t_3', 'option') ?>
                            <button class="footer__services-title-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f3" aria-expanded="false">
                                <span class="footer__services-icon"></span>
                            </button>
                        </div>
                        <div id="f3" class="footer__services-wrap collapse">
                            <?php $counter = 0; ?>
                            <?php while (have_rows('menu_3', 'option')): the_row();
                                $link_text = get_sub_field('link_text');
                                $link_addr = get_sub_field('link_addr'); ?>
                                <?php if ($counter == 8): ?>
                                    <div class="footer__services-item show__all btn__view-all visible">
                                        <svg width="26" height="5" viewBox="0 0 26 5" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="3" cy="2.5" r="2.5"></circle>
                                            <circle cx="13" cy="2.5" r="2.5"></circle>
                                            <circle cx="23" cy="2.5" r="2.5"></circle>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="footer__services-item"><a href="<?php echo $link_addr ?>"><?php echo $link_text ?></a></div>
                                <?php $counter += 1; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('menu_4', 'option')): ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="h3 footer__services-title">
                            <?php echo the_field('f_t_4', 'option') ?>
                            <button class="footer__services-title-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f4" aria-expanded="false">
                                <span class="footer__services-icon"></span>
                            </button>
                        </div>
                        <div id="f4" class="footer__services-wrap collapse">
                            <?php $counter = 0; ?>
                            <?php while (have_rows('menu_4', 'option')): the_row();
                                $link_text = get_sub_field('link_text');
                                $link_addr = get_sub_field('link_addr'); ?>
                                <?php if ($counter == 8): ?>
                                    <div class="footer__services-item show__all btn__view-all visible">
                                        <svg width="26" height="5" viewBox="0 0 26 5" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="3" cy="2.5" r="2.5"></circle>
                                            <circle cx="13" cy="2.5" r="2.5"></circle>
                                            <circle cx="23" cy="2.5" r="2.5"></circle>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="footer__services-item"><a href="<?php echo $link_addr ?>"><?php echo $link_text ?></a></div>
                                <?php $counter += 1; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <button class="footer__btnShow btn__view-all mt-sm-4">
                <span class="footer__btnShow-icon"></span>
                <span class="footer__btnShow-text">Показать еще</span>
            </button>
            <div class="row mt-sm-4">
                <?php if (have_rows('menu_5', 'option')): ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <h4 class="footer__services-title">
                            <?php echo the_field('f_t_5', 'option') ?>
                            <button class="footer__services-title-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f5" aria-expanded="false">
                                <span class="footer__services-icon"></span>
                            </button>
                        </h4>
                        <div id="f5" class="footer__services-wrap collapse">
                            <?php $counter = 0; ?>
                            <?php while (have_rows('menu_5', 'option')): the_row();
                                $link_text = get_sub_field('link_text');
                                $link_addr = get_sub_field('link_addr'); ?>
                                <?php if ($counter == 8): ?>
                                    <div class="footer__services-item show__all btn__view-all visible">
                                        <svg width="26" height="5" viewBox="0 0 26 5" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="3" cy="2.5" r="2.5"></circle>
                                            <circle cx="13" cy="2.5" r="2.5"></circle>
                                            <circle cx="23" cy="2.5" r="2.5"></circle>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="footer__services-item"><a href="<?php echo $link_addr ?>"><?php echo $link_text ?></a></div>
                                <?php $counter += 1; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('menu_6', 'option')): ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <h4 class="footer__services-title">
                            <?php echo the_field('f_t_6', 'option') ?>
                            <button class="footer__services-title-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f6" aria-expanded="false">
                                <span class="footer__services-icon"></span>
                            </button>
                        </h4>
                        <div id="f6" class="footer__services-wrap collapse">
                            <?php $counter = 0; ?>
                            <?php while (have_rows('menu_6', 'option')): the_row();
                                $link_text = get_sub_field('link_text');
                                $link_addr = get_sub_field('link_addr'); ?>
                                <?php if ($counter == 8): ?>
                                    <div class="footer__services-item show__all btn__view-all visible">
                                        <svg width="26" height="5" viewBox="0 0 26 5" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="3" cy="2.5" r="2.5"></circle>
                                            <circle cx="13" cy="2.5" r="2.5"></circle>
                                            <circle cx="23" cy="2.5" r="2.5"></circle>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="footer__services-item"><a href="<?php echo $link_addr ?>"><?php echo $link_text ?></a></div>
                                <?php $counter += 1; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('menu_7', 'option')): ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <h4 class="footer__services-title">
                            <?php echo the_field('f_t_7', 'option') ?>
                            <button class="footer__services-title-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f7" aria-expanded="false">
                                <span class="footer__services-icon"></span>
                            </button>
                        </h4>
                        <div id="f7" class="footer__services-wrap collapse">
                            <?php $counter = 0; ?>
                            <?php while (have_rows('menu_7', 'option')): the_row();
                                $link_text = get_sub_field('link_text');
                                $link_addr = get_sub_field('link_addr'); ?>
                                <?php if ($counter == 8): ?>
                                    <div class="footer__services-item show__all btn__view-all visible">
                                        <svg width="26" height="5" viewBox="0 0 26 5" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="3" cy="2.5" r="2.5"></circle>
                                            <circle cx="13" cy="2.5" r="2.5"></circle>
                                            <circle cx="23" cy="2.5" r="2.5"></circle>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="footer__services-item"><a href="<?php echo $link_addr ?>"><?php echo $link_text ?></a></div>
                                <?php $counter += 1; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('menu_8', 'option')): ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <h4 class="footer__services-title">
                            <?php echo the_field('f_t_8', 'option') ?>
                            <button class="footer__services-title-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f8" aria-expanded="false">
                                <span class="footer__services-icon"></span>
                            </button>
                        </h4>
                        <div id="f8" class="footer__services-wrap collapse">
                            <?php $counter = 0; ?>
                            <?php while (have_rows('menu_8', 'option')): the_row();
                                $link_text = get_sub_field('link_text');
                                $link_addr = get_sub_field('link_addr'); ?>
                                <?php if ($counter == 8): ?>
                                    <div class="footer__services-item show__all btn__view-all visible">
                                        <svg width="26" height="5" viewBox="0 0 26 5" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="3" cy="2.5" r="2.5"></circle>
                                            <circle cx="13" cy="2.5" r="2.5"></circle>
                                            <circle cx="23" cy="2.5" r="2.5"></circle>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="footer__services-item"><a href="<?php echo $link_addr ?>"><?php echo $link_text ?></a></div>
                                <?php $counter += 1; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- / footer services -->
        <!-- footer subsribe -->
        <div class="footer__subscribe">
            <div class="d-flex">
                <div class="footer__subscribe-form">
                    <h2 class="footer__subscribe-title">Подпишитесь на нашу рассылку</h2>
                    <p>Получайте бонусы первыми и будьте вкурсе последних новостей</p>
                    <form id="subscribe_action" class="d-sm-flex validate-footer">
                        <div>
                            <input required type="email" name="email" class="required form-control mb-3 mb-sm-0" placeholder="Введите ваш E-mail">
                            <div class="form-check mt-1 pl-1">
                                <label class="form-check-label" for="checkpolicy">
                                    <input name="checkpolicy" required type="checkbox" class="form-check-input required" id="checkpolicy" checked>
                                    Я принимаю условия обработки персональных данных, указанных в <a href="https://finabank.ru/privacy-policy/" target="_blank">Политике конфиденциальности</a></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ml-sm-4">Отправить</button>
                    </form>
                    <div id="subscribe_request" style="display:none; color:green">Вы подписались на рассылку!</div>
                </div>
                <div class="footer__subscribe-icon d-none">
                    <svg width="159" height="136" viewBox="0 0 159 136" xmlns="http://www.w3.org/2000/svg">
                        <path d="m31.146 38.145 1.414-1.414-1.414 1.414ZM17 24l-1.414 1.414L17 24Zm58.667 108a2 2 0 1 0 0 4v-4Zm73.664-13.115-1.618-1.175 1.618 1.175Zm-8.112 8.112-1.176-1.618 1.176 1.618Zm0-117.994 1.176-1.618-1.176 1.618Zm8.112 8.111-1.618 1.176 1.618-1.175ZM24.781 9.003l-1.175-1.618 1.175 1.618ZM7.667 68a2 2 0 1 0 4 0h-4Zm9.002-50.886-1.617-1.175 1.617 1.175ZM2.334 117.333a2 2 0 0 0 0 4v-4Zm44 4a2 2 0 1 0 0-4v4Zm-44-26a2 2 0 0 0 0 4v-4Zm22 4a2 2 0 1 0 0-4v4ZM14.22 21.221l-1.802-.868 1.802.868ZM32.56 36.73 19.304 23.475l-2.828 2.829L29.732 39.56l2.828-2.829Zm114.136-13.256L133.44 36.731l2.829 2.829 13.256-13.256-2.829-2.828ZM29.731 39.56c12.183 12.182 21.459 21.464 29.6 27.675 8.188 6.247 15.462 9.577 23.67 9.577v-4c-6.982 0-13.412-2.781-21.244-8.757-7.877-6.01-16.935-15.062-29.197-27.324L29.73 39.56ZM133.44 36.73c-12.262 12.262-21.319 21.314-29.197 27.324-7.832 5.976-14.262 8.757-21.243 8.757v4c8.207 0 15.482-3.33 23.669-9.576 8.142-6.212 17.418-15.494 29.6-27.676l-2.829-2.829Zm-100.88 0L18.414 22.586l-2.828 2.828L29.732 39.56l2.828-2.829Zm115.026-14.145L133.44 36.73l2.829 2.829 14.145-14.146-2.828-2.828ZM75.666 4h14.668V0H75.666v4Zm14.668 128H75.666v4h14.666v-4Zm64-64c0 13.794-.003 23.978-.864 31.925-.857 7.909-2.545 13.363-5.757 17.785l3.236 2.351c3.79-5.217 5.604-11.456 6.498-19.705.889-8.212.887-18.651.887-32.356h-4Zm-64 68c13.704 0 24.143.003 32.355-.887 8.25-.894 14.489-2.707 19.706-6.498l-2.352-3.236c-4.421 3.213-9.876 4.9-17.785 5.757-7.946.861-18.131.864-31.924.864v4Zm57.379-18.29a34.659 34.659 0 0 1-7.67 7.669l2.352 3.236a38.67 38.67 0 0 0 8.554-8.554l-3.236-2.351ZM90.333 4c13.794 0 23.979.003 31.925.864 7.909.857 13.364 2.544 17.785 5.757l2.352-3.236c-5.217-3.79-11.456-5.604-19.706-6.498C114.477-.003 104.038 0 90.334 0v4Zm49.71 6.62a34.667 34.667 0 0 1 7.67 7.67l3.236-2.351a38.68 38.68 0 0 0-8.554-8.554l-2.352 3.236ZM75.667 0C61.962 0 51.523-.003 43.31.887c-8.25.894-14.488 2.707-19.705 6.498l2.35 3.236c4.422-3.213 9.877-4.9 17.786-5.757C51.69 4.003 61.873 4 75.667 4V0ZM23.606 7.385a38.668 38.668 0 0 0-8.555 8.554l3.237 2.351a34.668 34.668 0 0 1 7.669-7.67l-2.351-3.235ZM2.333 121.333h44v-4h-44v4Zm0-22h22v-4h-22v4ZM11.668 68c0-11.94.001-21.186.563-28.629.562-7.438 1.675-12.887 3.793-17.282l-3.604-1.736c-2.436 5.056-3.6 11.084-4.177 18.717-.576 7.628-.575 17.047-.575 28.93h4Zm4.356-45.91a24.571 24.571 0 0 1 2.265-3.8l-3.236-2.351a28.567 28.567 0 0 0-2.633 4.414l3.604 1.736Zm2.391.496-2.779-2.78-2.828 2.83 2.779 2.778 2.828-2.828ZM158.334 68c0-11.883.001-21.302-.575-28.93-.577-7.633-1.742-13.661-4.178-18.717l-3.603 1.736c2.117 4.395 3.23 9.844 3.792 17.282.562 7.443.564 16.688.564 28.629h4Zm-4.753-47.647a28.55 28.55 0 0 0-2.632-4.414l-3.236 2.351a24.636 24.636 0 0 1 2.265 3.8l3.603-1.737Zm-3.167 5.061 2.78-2.779-2.829-2.828-2.779 2.779 2.828 2.828Z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <!-- / footer subsribe -->
        <!-- footer social & logo -->
        <div class="footer__logoSocial d-flex justify-content-between justify-content-md-start align-items-center">
            <!-- footer logo -->
            <a href="<?php echo get_home_url(); ?>" class="logo d-flex align-items-center">
                <div class="logo__icon">
                    <svg width="42" height="46" viewBox="0 0 42 46" xmlns="http://www.w3.org/2000/svg">
                        <path d="m22.309 34.102 5.234-13.514h7.85L22.31 34.102ZM16.638 20.588 21 31.486l3.49-10.898h-7.852ZM19.255 34.102l-5.234-13.514h-7.85l13.084 13.514ZM6.17 18.408l3.053-6.103 4.798 6.103h-7.85ZM11.404 10.997l3.926 5.232 3.925-5.232h-7.85ZM16.638 18.408l3.926-5.231 3.925 5.231h-7.85ZM21.872 10.997l3.926 5.232 3.925-5.232h-7.85ZM27.106 18.408l4.798-6.103 3.054 6.103h-7.852Z"></path>
                        <path d="m22.309 34.102-.467-.18a.5.5 0 0 0 .826.528l-.36-.348Zm5.234-13.514v-.5a.5.5 0 0 0-.467.32l.467.18Zm7.85 0 .36.348a.5.5 0 0 0-.36-.848v.5ZM19.256 34.102l-.359.348a.5.5 0 0 0 .825-.529l-.466.18Zm-5.234-13.514.466-.18a.5.5 0 0 0-.466-.32v.5Zm-7.85 0v-.5a.5.5 0 0 0-.36.848l.36-.348Zm20.935-2.18-.393-.309a.5.5 0 0 0 .393.81v-.5Zm4.798-6.103.448-.224a.5.5 0 0 0-.84-.085l.392.31Zm3.054 6.103v.5a.5.5 0 0 0 .447-.724l-.447.224Zm-13.086-7.41v-.5a.5.5 0 0 0-.4.8l.4-.3Zm3.926 5.23-.4.3a.5.5 0 0 0 .8 0l-.4-.3Zm3.925-5.23.4.3a.5.5 0 0 0-.4-.8v.5Zm-18.319 0v-.5a.5.5 0 0 0-.4.8l.4-.3Zm3.926 5.23-.4.3a.5.5 0 0 0 .8 0l-.4-.3Zm3.925-5.23.4.3a.5.5 0 0 0-.4-.8v.5Zm-2.617 7.41-.4-.3a.5.5 0 0 0 .4.8v-.5Zm3.926-5.231.4-.3a.5.5 0 0 0-.8 0l.4.3Zm3.925 5.231v.5a.5.5 0 0 0 .4-.8l-.4.3Zm-7.85 2.18v-.5a.5.5 0 0 0-.465.685l.464-.185Zm4.36 10.898-.463.186a.5.5 0 0 0 .94-.034L21 31.486Zm3.49-10.898.476.152a.5.5 0 0 0-.476-.652v.5ZM6.17 18.408l-.447-.224a.5.5 0 0 0 .447.724v-.5Zm3.053-6.103.393-.309a.5.5 0 0 0-.84.085l.447.224Zm4.798 6.103v.5a.5.5 0 0 0 .393-.809l-.393.31Zm6.043-13.92a.5.5 0 1 0 1 0h-1Zm1-3.488a.5.5 0 0 0-1 0h1Zm17.465 7.9a.5.5 0 0 0 .707.707L38.53 8.9Zm3.324-1.908a.5.5 0 1 0-.706-.708l.706.708ZM2.763 9.607A.5.5 0 0 0 3.47 8.9l-.706.707ZM.854 6.284a.5.5 0 1 0-.706.708l.706-.708Zm7.852 28.171a.5.5 0 1 0-.707-.707l.707.707ZM5.38 36.364a.5.5 0 1 0 .707.707l-.707-.707Zm28.621-2.616a.5.5 0 0 0-.707.707l.707-.707Zm1.91 3.323a.5.5 0 0 0 .707-.707l-.706.707ZM21.5 41.077a.5.5 0 0 0-1 0h1ZM20.5 45a.5.5 0 0 0 1 0h-1Zm2.275-10.718 5.234-13.513-.933-.362-5.234 13.514.933.361Zm4.768-13.194h7.85v-1h-7.85v1Zm7.492-.848L21.949 33.754l.719.696 13.085-13.514-.718-.696ZM19.721 33.921l-5.235-13.514-.932.361 5.234 13.514.932-.36Zm-5.7-13.833H6.17v1h7.851v-1Zm-8.211.848L18.896 34.45l.718-.696L6.53 20.24l-.718.696ZM27.5 18.717l4.797-6.103-.786-.618-4.798 6.103.787.618Zm3.957-6.188 3.053 6.103.895-.448-3.053-6.103-.895.448Zm3.5 5.38h-7.85v1h7.85v-1Zm-13.485-6.611 3.926 5.23.8-.6-3.926-5.23-.8.6Zm4.726 5.23 3.925-5.23-.8-.6-3.925 5.23.8.6Zm3.525-6.03h-7.85v1h7.85v-1Zm-18.719.8 3.926 5.23.8-.6-3.926-5.23-.8.6Zm4.726 5.23 3.925-5.23-.8-.6-3.925 5.23.8.6Zm3.525-6.03h-7.85v1h7.85v-1Zm-2.217 8.21 3.926-5.231-.8-.6-3.926 5.231.8.6Zm3.126-5.231 3.925 5.231.8-.6-3.925-5.231-.8.6Zm4.325 4.431h-7.85v1h7.85v-1Zm-8.315 2.865 4.362 10.899.928-.372-4.362-10.898-.928.371Zm5.302 10.865 3.49-10.898-.953-.305-3.49 10.899.953.304Zm3.013-11.55h-7.85v1h7.85v-1ZM6.617 18.632l3.054-6.103-.895-.448-3.053 6.103.894.448Zm2.213-6.018 4.798 6.103.786-.618-4.798-6.103-.786.618Zm5.191 5.294h-7.85v1h7.85v-1Zm7.043-13.42V1h-1v3.487h1Zm18.172 5.12 2.617-2.616-.706-.708L38.53 8.9l.706.707ZM3.47 8.9.853 6.284l-.706.708 2.617 2.615.706-.707Zm4.528 24.848L5.38 36.364l.707.707 2.617-2.616-.707-.707Zm25.297.707 2.617 2.616.707-.707-2.617-2.616-.707.707ZM20.5 41.077V45h1v-3.923h-1Z"></path>
                    </svg>
                </div>
                Finabank
            </a>
            <!-- / footer logo -->
            <!-- footer rating -->
            <div class="footer__rating d-none d-md-flex align-items-center ml-4">
                <div class="mr-2">
                    <svg width="24" height="24" viewBox="0 0 17 16">
                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#ratingStar" x="0" y="0"></use>
                    </svg>
                </div>
                5
            </div>
            <!-- / footer rating -->
            <!-- footer social -->
            <div class="footer__social">
                <?php if (get_field('tg', 'option')): ?>
                    <a href="<?php echo the_field('tg', 'option'); ?>" class="social__link d-flex justify-content-center align-items-center">
                        <img src="<?php bloginfo('template_url'); ?>/img/telegram.svg" alt="">
                    </a>
                <?php endif; ?>
                <?php if (get_field('vk', 'option')): ?>
                    <a href="<?php echo the_field('vk', 'option'); ?>" class="social__link d-flex justify-content-center align-items-center">
                        <img src="<?php bloginfo('template_url'); ?>/img/vk.svg" alt="мы в Вконтакте">
                    </a>
                <?php endif; ?>
                <?php if (get_field('viber', 'option')): ?>
                    <a href="<?php echo the_field('viber', 'option'); ?>" class="social__link d-flex justify-content-center align-items-center">
                        <img src="<?php bloginfo('template_url'); ?>/img/viber.svg" alt="">
                    </a>
                <?php endif; ?>
                <?php if (get_field('inst', 'option')): ?>
                    <a href="<?php echo the_field('inst', 'option'); ?>" class="social__link d-flex justify-content-center align-items-center">
                        <img src="<?php bloginfo('template_url'); ?>/img/instagram.svg" alt="">
                    </a>
                <?php endif; ?>
                <?php if (get_field('ok', 'option')): ?>
                    <a href="<?php echo the_field('ok', 'option'); ?>" class="social__link mymir d-flex justify-content-center align-items-center">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.6065 1.91029C9.50799 0.903364 8.18067 0.399902 6.53298 0.399902C4.83952 0.399902 3.3749 0.949133 2.1849 2.09336C0.9949 3.2376 0.399902 4.65644 0.399902 6.3499C0.399902 7.9976 0.949139 9.37067 2.09337 10.5607C3.2376 11.7507 4.74799 12.2999 6.71607 12.2999C7.8603 12.2999 9.00453 12.0711 10.1488 11.5676C10.5149 11.4303 10.698 10.9726 10.5607 10.6064C10.4234 10.2403 9.96568 10.0572 9.59952 10.1945C8.63837 10.6064 7.67721 10.8353 6.76182 10.8353C5.29721 10.8353 4.15298 10.3776 3.32913 9.46221C2.50528 8.54683 2.09337 7.49413 2.09337 6.30413C2.09337 4.97683 2.55106 3.87836 3.3749 3.00875C4.24452 2.13913 5.29721 1.68144 6.57875 1.68144C7.72298 1.68144 8.7299 2.04759 9.55375 2.7799C10.3776 3.51221 10.7438 4.42759 10.7438 5.52606C10.7438 6.25836 10.5607 6.89913 10.1945 7.4026C9.82836 7.90606 9.46221 8.1349 9.05029 8.1349C8.82144 8.1349 8.72991 8.04336 8.72991 7.76875C8.72991 7.58567 8.72991 7.35683 8.77568 7.12798L9.23337 3.42067H7.67721L7.58568 3.78683C7.17376 3.46644 6.76182 3.28336 6.30413 3.28336C5.57182 3.28336 4.93106 3.60375 4.38183 4.19875C3.8326 4.79375 3.60375 5.57183 3.60375 6.48721C3.60375 7.4026 3.8326 8.1349 4.33606 8.7299C4.79375 9.27913 5.38876 9.55375 6.02953 9.55375C6.62453 9.55375 7.12798 9.3249 7.53991 8.82144C7.86029 9.27913 8.31799 9.55375 8.95876 9.55375C9.87414 9.55375 10.6522 9.14183 11.3387 8.36375C12.0253 7.58567 12.3457 6.62452 12.3457 5.48029C12.2084 4.10721 11.6591 2.87144 10.6065 1.91029ZM6.99067 7.49413C6.71605 7.86029 6.39568 8.04336 5.98376 8.04336C5.70914 8.04336 5.52607 7.90606 5.34299 7.63144C5.15991 7.35683 5.11414 7.03644 5.11414 6.62452C5.11414 6.12106 5.20567 5.70913 5.43452 5.43452C5.66336 5.11413 5.93799 4.97683 6.25837 4.97683C6.53299 4.97683 6.8076 5.06836 7.03644 5.34298C7.26529 5.57183 7.35683 5.89221 7.35683 6.25836C7.4026 6.71606 7.26529 7.12798 6.99067 7.49413Z" fill="white"></path>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
            <!-- / footer social -->
        </div>
        <!-- / footer social -->
        <!-- footer navigation -->
        <nav class="footer__nav d-lg-flex justify-content-md-between">
            <?php
            $massiv_vhodnih_parametrov = array(
                'container' => false, // - без предварительной обёртки тегом(можно написать 'nav')
                'echo' => false,  // - вернуть меню для предварительной обработки средствами PHP
                'items_wrap' => '%3$s',  // - аргумент функции формата строки sprintf()
                'depth' => 0,  // - глубина, уровень вложенности
                'link_class'   => 'footer__nav-link',
                'theme_location'  => 'footer_menu',
            );

            print strip_tags(wp_nav_menu($massiv_vhodnih_parametrov), '<a>;') ?>
        </nav>

        <!-- / footer navigation -->
        <!-- footer contacts -->
        <div class="footer__contacts d-md-flex">
            <div class="mr-xl-4 mr-lg-3 mr-md-1">Наша почта:
                <a href="mailto:<?php echo the_field('email', 'option'); ?>"><?php echo the_field('email', 'option'); ?></a>
            </div>
            <div class="mr-xl-4 mr-lg-3 mr-md-1">Телефон:
                <a href="tel:<?= preg_replace('![^0-9]+!', '', get_field('phone', 'option')); ?>"><?php echo the_field('phone', 'option'); ?></a>
            </div>
            <div class="mr-xl-4 mr-lg-3 mr-md-1">Режим работы: <?php echo the_field('work_time', 'option'); ?></div>
            <div class="mr-xl-4 mr-lg-3 mr-md-1"><?php echo the_field('location', 'option'); ?></div>
        </div>
        <!-- / footer contacts -->
        <!-- footer copyright  -->
        <div class="footer__copyright">
            <?php echo the_field('footer_text', 'option'); ?>
            <p>
                <?php echo the_field('footer_inn_kpp', 'option'); ?>
                <a href="<?php echo get_page_link(9); ?>" class="d-block d-md-inline ml-md-4">Политика конфиденциальности</a>
                <a href="<?php echo get_page_link(15); ?>" class="d-block d-md-inline ml-md-4">Пользовательское соглашение</a>
            </p>
        </div>
        <!-- / footer copyright -->

        <div class="btn-up" id="myBtn" style="display:none"></div>

    </div>
</footer>

<div id="popup_compare" class="popup_compare" style="display:none;">
    <div class="popup_compare_close"><img src="/wp-content/themes/finbank_theme/img/close.png" alt=Закрыть"></div>

    <div class="popup_compare_body">
        <div class="popup_compare_icon">
            <img src="/wp-content/themes/finbank_theme/img/btn-compare.png" alt="Сравнить">
        </div>
        <div class="popup_compare_prod">

        </div>
    </div>
    <div class="popup_compare_button">
        <a href="<?php echo get_page_link('380') ?>" class="popup_compare_btn">
            Перейти в сравнения
        </a>
    </div>
</div>


<div class="popup_alert_wrap popup" style="display:none;">
    <div class="popup_alert popup__inner">
        <div class="popup_alert_close"><img src="/wp-content/themes/finbank_theme/img/close2.png" alt="Закрыть"></div>
        <div class="popup_alert_body">

        </div>
    </div>
</div>


<div class="popup_image_wrap" style="display:none;">
    <div class="popup_image">
        <div class="popup_image_close"><img src="/wp-content/themes/finbank_theme/img/close2.png" alt="Закрыть"></div>
        <div class="popup_image_body">

        </div>
    </div>
</div>

<?php
if (!session_id()) {
    session_start();
}

if (array_key_exists('titlepage', $_SESSION)) {
    $titlepage = urlencode($_SESSION['titlepage']);
}
?>




<?php //include get_template_directory() . '/template-parts/exit-popup.php'; 

get_template_part('template-parts/exit-popup');
get_template_part('template-parts/archive-popup');
get_template_part('template-parts/out-popup');
?>

<?php



global $template;
if (strpos($template, '/') !== false) {
    $gwp_my_template_file = ltrim(strrchr($template, '/'), '/');
} else {
    $gwp_my_template_file = $template;
}

$arr_best_pages_templates = [
    'page-best-zaimy.php',
    'page-best-kredity.php',
    'page-best-creditcard.php',
    'page-best-installmentcard.php',
    'page-best-debetcard.php'
];

if (in_array($gwp_my_template_file, $arr_best_pages_templates)) {
    get_template_part('template-parts/present', null, ['show_in_page' => 0]);
} else {
    get_template_part('template-parts/present', null, ['show_in_page' => 1]);
}

?>





<?php wp_footer(); ?>
</body>

</html>