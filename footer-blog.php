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
<footer class="footer footer-v2">
            <div class="footer__section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="footer__contact mb-4 mb-md-0 d-flex align-items-center">
                                <div class="footer__contact-icon d-flex align-items-center justify-content-center mr-3">
                                    <svg width="23" height="23" viewBox="0 0 22.9 22.9">
                                         <path d="m22.4 17.7-3.9-3.9c-.6-.6-1.6-.6-2.3 0l-1.6 1.6h-.1c-3-1.5-5.5-4-7-7.1v-.1l1.6-1.6c.6-.6.6-1.6 0-2.2L5.1.5c-.6-.6-1.6-.6-2.3 0l-.9 1c-2.3 2.3-2.6 6-.6 8.6L4.2 14c1.3 1.8 2.9 3.4 4.7 4.7l3.9 2.9c2.6 2 6.3 1.7 8.6-.6l.9-1c.7-.6.7-1.7.1-2.3zm-1.8 2.4c-1.9 1.9-4.9 2.1-7.1.5l-3.9-2.9c-1.7-1.3-3.2-2.8-4.5-4.5L2.3 9.3c-1.6-2.1-1.4-5.1.5-7l1-1c.1-.1.4-.1.6 0l3.9 3.9c.2.2.2.4 0 .6L6.6 7.4c-.4.4-.5 1-.2 1.5 1.6 3.3 4.3 5.9 7.6 7.6.5.2 1.1.1 1.5-.2l1.6-1.6c.2-.2.4-.2.6 0l3.9 3.9c.2.2.2.4 0 .6l-1 .9z"/>
                                     </svg>
                                </div>
                                <div class="footer__contact-field"><a class="stretched-link" href="tel:<?= preg_replace('![^0-9]+!', '', get_field('phone', 'option')); ?>"><?php echo the_field('phone', 'option'); ?></a></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="footer__contact mb-4 mb-md-0 d-flex align-items-center">
                                <div class="footer__contact-icon d-flex align-items-center justify-content-center mr-3">
                                    <svg width="26" height="20" viewBox="0 0 26.3 19.5">
                                         <path d="M23.7 0H2.6C1.2 0 0 1.2 0 2.6v14.3c0 1.4 1.2 2.6 2.6 2.6h21.1c1.4 0 2.6-1.2 2.6-2.6V2.6c0-1.4-1.1-2.6-2.6-2.6zM1.2 2.6c0-.8.6-1.4 1.4-1.4h21.1c.8 0 1.4.6 1.4 1.4v2.2L13.8 10c-.4.2-.8.2-1.2 0L1.2 4.8V2.6zm23.9 14.3c0 .8-.6 1.4-1.4 1.4H2.6c-.8 0-1.4-.6-1.4-1.4V6.1l10.9 5c.3.1.7.2 1.1.2s.7-.1 1.1-.2l10.9-5v10.8z"/>
                                     </svg>
                                </div>
                                <div class="footer__contact-field"><a class="stretched-link" href="mailto:<?php echo the_field('email', 'option'); ?>"><?php echo the_field('email', 'option'); ?></a></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="footer__contact d-flex align-items-center">
                                <div class="footer__contact-icon d-flex align-items-center justify-content-center mr-3">
                                    <svg width="25" height="28" viewBox="0 0 25.2 27.8">
                                      <path d="M12.6 0C7.2 0 2.8 4.4 2.8 9.8c0 3.6 1.9 6.5 3.9 8.5 2.1 2 4.3 3.3 5.3 3.8.4.2.9.2 1.3 0 .9-.5 3.2-1.7 5.3-3.8 2.1-2 4-4.9 4-8.5C22.4 4.4 18 0 12.6 0zm5.2 17.6c-2 1.9-4.1 3.1-5 3.6-.1.1-.2.1-.4 0-.9-.4-3.1-1.7-5-3.6-2-1.9-3.6-4.5-3.6-7.8C3.8 5 7.7 1 12.6 1s8.8 4 8.8 8.8c0 3.3-1.7 5.9-3.6 7.8z"/><path d="M12.6 5.3c-2.5 0-4.5 2-4.5 4.5s2 4.5 4.5 4.5 4.5-2 4.5-4.5-2-4.5-4.5-4.5zm0 8c-1.9 0-3.5-1.6-3.5-3.5s1.6-3.5 3.5-3.5 3.5 1.6 3.5 3.5c0 2-1.6 3.5-3.5 3.5zM12.6 27.8c-2.1 0-4.3-.2-6.1-.5-1.9-.4-3.5-.9-4.6-1.5-1.6-1-1.9-2-1.9-2.6s.3-1.6 1.9-2.5c.3-.2.7-.1.8.2.2.3.1.7-.2.8-.8.5-1.3 1-1.3 1.5s.5 1 1.3 1.5c1 .6 2.4 1.1 4.2 1.4 3.6.7 8.2.7 11.8 0 1.8-.3 3.2-.8 4.2-1.4.8-.5 1.3-1 1.3-1.5s-.5-1-1.3-1.5c-.3-.2-.4-.5-.2-.8.2-.3.5-.4.8-.2 1.6.9 1.9 1.9 1.9 2.5s-.3 1.6-1.9 2.5c-1.1.6-2.7 1.2-4.6 1.5-1.8.4-4 .6-6.1.6z"/>
                                  </svg>
                                </div>
                                <div class="footer__contact-field"><?php echo the_field('location', 'option'); ?></div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            <div class="footer__section">
                <div class="container">
                    <div class="row justify-content-between">
                        <?php if( have_rows('blog_menu_footer', 'options') ): ?>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="row">
                            <?php while( have_rows('blog_menu_footer', 'options') ): the_row(); 
                                $text = get_sub_field('text');
                                $link = get_sub_field('link');
                                $counter += 1;
                                ?>
                                <?php if($counter == 1 || $counter == 4 || $counter == 7): ?>
                                    <div class="col-4 col-sm-4">
                                <?php endif; ?>
                                  <a href="" class="footer__links-item mb-3 d-block"><?php echo $text; ?></a>
                                <?php if($counter == 3 || $counter == 6 || $counter == 9): ?>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="footer__form">
                                <h4 class="footer__form-title">Подпишитесь</h4>
                                <form action="">
                                    <div class="footer__form-wrap">
                                        <input class="footer__form-input form-control" type="text" placeholder="Введите ваш e-mail">
                                        <button class="footer__form-btn"><svg width="20" height="19" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.4 18.7" xml:space="preserve"><path d="M17.4 7 4.9 1.3C2.3.1 1.1-.4.3.4c-.8.8-.1 2 1.2 4.5l2.1 3.8c.2.3.3.5.3.6 0 .1-.1.3-.3.7l-2.1 3.8c-1.4 2.5-2 3.6-1.2 4.5.3.3.6.4 1 .4.8 0 1.9-.5 3.6-1.3l12.5-5.7c2-.9 2.9-1.3 2.9-2.4.1-1-.9-1.4-2.9-2.3zm-.5 3.6L4.4 16.3c-1.3.6-3 1.4-3.2 1.2-.2-.2.7-1.8 1.4-3.1l2.1-3.8c.3-.5.4-.8.4-1.3 0-.4-.2-.7-.5-1.2l-2-3.8C1.9 3 1 1.4 1.2 1.2c.2-.2 1.9.6 3.2 1.2l12.5 5.7c1.1.5 2.2 1 2.2 1.3.1.2-1.1.7-2.2 1.2z"></path></svg></button>
                                    </div>
                                </form>
                                <p class="footer__form-description mt-2 mb-0">Получайте певыми уведомления о акциях, нововведениях и изменениях</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__section">
                <div class="container">
                    <div class="footer__bottom d-flex flex-wrap align-items-center">
                        <div class="footer__bottom-logo order-1 order-md-2"><img src="<?php bloginfo('template_url'); ?>/img/logo__color.svg" alt=""></div>
                        <div class="footer__bottom-social order-2 order-md-1 d-flex justify-content-center">
                  <?php if (get_field('inst', 'option')): ?>                            
                            <a href="<?php echo the_field('inst', 'option'); ?>" class="footer__social-link"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 14.1c-1.125 0-2.1-.9-2.1-2.1 0-1.125.9-2.1 2.1-2.1 1.125 0 2.1.9 2.1 2.1 0 1.125-.975 2.1-2.1 2.1Z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M14.55 6.9h-5.1c-.6.075-.9.15-1.125.225-.3.075-.525.225-.75.45-.17804.17804-.26216.35608-.36384.57128-.02679.05671-.05488.11616-.08616.17872-.0116.03481-.025.07141-.03936.11064C7.00718 8.65 6.9 8.94282 6.9 9.45v5.1c.075.6.15.9.225 1.125.075.3.225.525.45.75.17804.178.35608.2622.57128.3638.05676.0269.11611.0549.17872.0862.03481.0116.07141.025.11064.0394.21436.0784.50718.1856 1.01436.1856h5.1c.6-.075.9-.15 1.125-.225.3-.075.525-.225.75-.45.178-.178.2622-.3561.3638-.5713.0268-.0567.0549-.1161.0862-.1787.0116-.0348.025-.0714.0394-.1106.0784-.2144.1856-.5072.1856-1.0144v-5.1c-.075-.6-.15-.9-.225-1.125-.075-.3-.225-.525-.45-.75-.178-.17804-.3561-.26216-.5713-.36384-.0567-.02677-.1162-.05491-.1787-.08616-.0348-.0116-.0714-.025-.1106-.03936C15.35 7.00718 15.0572 6.9 14.55 6.9ZM12 8.775c-1.8 0-3.225 1.425-3.225 3.225S10.2 15.225 12 15.225 15.225 13.8 15.225 12 13.8 8.775 12 8.775Zm4.05-.075c0 .41421-.3358.75-.75.75s-.75-.33579-.75-.75c0-.41422.3358-.75.75-.75s.75.33578.75.75Z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M0 3.75C0 1.67893 1.67893 0 3.75 0h16.5C22.3211 0 24 1.67893 24 3.75v16.5c0 2.0711-1.6789 3.75-3.75 3.75H3.75C1.67893 24 0 22.3211 0 20.25V3.75Zm9.45 2.025h5.1c.675.075 1.125.15 1.5.3.45.225.75.375 1.125.75s.6.75.75 1.125c.15.375.3.825.3 1.5v5.1c-.075.675-.15 1.125-.3 1.5-.225.45-.375.75-.75 1.125s-.75.6-1.125.75c-.375.15-.825.3-1.5.3h-5.1c-.675-.075-1.125-.15-1.5-.3-.45-.225-.75-.375-1.125-.75s-.6-.75-.75-1.125c-.15-.375-.3-.825-.3-1.5v-5.1c.075-.675.15-1.125.3-1.5.225-.45.375-.75.75-1.125s.75-.6 1.125-.75c.375-.15.825-.3 1.5-.3Z"></path></svg></a>
                   <?php endif; ?>                                
                  <?php if (get_field('tg', 'option')): ?>                           
                            <a href="<?php echo the_field('tg', 'option'); ?>" class="footer__social-link"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.75 0h16.5C22.3211 0 24 1.67893 24 3.75v16.5c0 2.0711-1.6789 3.75-3.75 3.75H3.75C1.67893 24 0 22.3211 0 20.25V3.75C0 1.67893 1.67893 0 3.75 0Zm8.7689 9.00553c-1.0748.44703-3.22274 1.37227-6.44396 2.77567-.52308.208-.79709.4115-.82203.6105-.04216.3363.37895.4687.95239.649.07801.0245.15883.0499.24169.0769.56418.1834 1.3231.3979 1.71763.4064.35788.0078.75731-.1398 1.1983-.4426 3.00968-2.0316 4.56328-3.0585 4.66088-3.0806.0688-.01564.1641-.03527.2287.0222.0646.0574.0583.1661.0514.1953-.0417.1779-1.6947 1.7146-2.5501 2.5099-.2667.248-.4559.4238-.4945.464-.0867.09-.1749.1751-.2598.2569-.5241.5052-.9172.8841.0218 1.5029.4512.2974.8123.5432 1.1725.7885.3934.2679.7857.5352 1.2934.8679.1293.0848.2529.1729.3732.2587.4578.3263.8691.6196 1.3772.5728.2953-.0272.6003-.3048.7552-1.1329.366-1.9569 1.0856-6.1969 1.2519-7.94415.0145-.15308-.0038-.34899-.0185-.43499-.0147-.086-.0455-.20854-.1573-.29924-.1324-.10743-.3367-.13008-.4282-.12855-.4156.0074-1.0532.22912-4.1218 1.50546Z"></path></svg></a>
                  <?php endif; ?>                                
                  <?php if (get_field('viber', 'option')): ?>                            
                            <a href="<?php echo the_field('viber', 'option'); ?>" class="footer__social-link"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.45 16.275c.75.45 1.65.675 2.55.675 2.775 0 4.95-2.25 4.95-4.875 0-1.35-.45-2.55-1.425-3.525-.975-.9-2.175-1.425-3.525-1.425-2.7 0-4.95 2.25-4.95 4.95 0 .9.225 1.8.75 2.625l.15.225-.525 1.8L9.3 16.2l.15.075Zm4.2-3.525c.15 0 .9.375 1.05.45.0234.0117.0467.0215.0698.0313.1251.0528.2419.1021.3052.4187.075 0 .075.3-.075.675-.075.3-.675.675-.975.675-.0508 0-.0995.0043-.1515.0089-.2549.0225-.5895.0522-1.6485-.3839-1.3144-.5257-2.22562-1.8001-2.48151-2.1579-.03614-.0506-.05921-.0828-.06849-.0921-.01278-.0255-.03859-.0663-.07264-.1201-.16592-.2619-.52736-.8326-.52736-1.4549 0-.75.37499-1.125.52499-1.275.15-.15.3-.15.375-.15h.30001c.075 0 .225 0 .3.225.15.3.45 1.05.45 1.125 0 .025.0083.05.0167.075.0166.05.0333.1-.0167.15-.0375.0375-.0562.075-.075.1125-.0187.0375-.0375.075-.075.1125l-.225.225c-.075.075-.15.15-.075.3s.375.675.825 1.05c.5063.443.9058.619 1.1084.7082.0374.0166.0682.0301.0916.0418.15 0 .225 0 .3-.075.0375-.075.1313-.1875.225-.3.0937-.1125.1875-.225.225-.3.075-.15.15-.15.3-.075Z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M0 3.75C0 1.67893 1.67893 0 3.75 0h16.5C22.3211 0 24 1.67893 24 3.75v16.5c0 2.0711-1.6789 3.75-3.75 3.75H3.75C1.67893 24 0 22.3211 0 20.25V3.75ZM12 6c1.575 0 3.075.6 4.2 1.725s1.8 2.625 1.8 4.2c0 3.3-2.7 6-6 6-.975 0-1.95-.3-2.84999-.75L6 18l.825-3C6.30001 14.1 6 13.05 6 12c0-3.3 2.7-6 6-6Z"></path></svg></a>
                  <?php endif; ?>                                
                  <?php if (get_field('vk', 'option')): ?>
                            <a href="<?php echo the_field('vk', 'option'); ?>" class="footer__social-link"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 3.75C0 1.67893 1.67893 0 3.75 0h16.5C22.3211 0 24 1.67893 24 3.75v16.5c0 2.0711-1.6789 3.75-3.75 3.75H3.75C1.67893 24 0 22.3211 0 20.25V3.75Zm6.84 3.09C6 7.688 6 9.044 6 11.76v.48c0 2.712 0 4.068.84 4.92.848.84 2.204.84 4.92.84h.48c2.712 0 4.068 0 4.92-.84.84-.848.84-2.204.84-4.92v-.48c0-2.712 0-4.068-.84-4.92C16.312 6 14.956 6 12.24 6h-.48c-2.712 0-4.068 0-4.92.84Z"></path><path d="M12.384 14.644c-2.736 0-4.296-1.872-4.36-4.99199H9.4C9.444 11.94 10.452 12.908 11.252 13.108V9.65201h1.292V11.624c.788-.084 1.62-.984 1.9-1.97599h1.288c-.105.51349-.3148.99979-.6163 1.42859-.3014.4288-.688.7908-1.1357 1.0634.4996.2487.9408.6004 1.2945 1.032s.6119.9333.7575 1.472h-1.42c-.304-.948-1.064-1.684-2.068-1.784v1.784h-.16Z"></path></svg></a>
                  <?php endif; ?>                                
                        </div>
                        <div class="footer__bottom-btn order-3 order-md-4">
                            <button id="btnScrollUp" class="btn-scrollUp" type="button">
                                <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" xml:space="preserve"><path d="M16 0C7.2 0 0 7.2 0 16s7.2 16 16 16 16-7.2 16-16S24.8 0 16 0zm0 31C7.7 31 1 24.3 1 16S7.7 1 16 1s15 6.7 15 15-6.7 15-15 15z"></path><path d="M19.3 12h-2.7v13c0 .3-.3.6-.6.6s-.6-.3-.6-.6V12h-2.7c-.7 0-1-.8-.6-1.3l3.5-4.2c.2-.2.6-.2.8 0l3.5 4.2c.4.5.1 1.3-.6 1.3z"></path></svg>
                            </button>
                        </div>
                        <div class="footer__bottom-meta order-4 order-md-3">
                            <p><?php echo the_field('footer_inn_kpp', 'option'); ?></p>
                            <a href="<?php echo get_page_link( 9 ); ?>">Политика конфиденциальности</a>
                            <a href="<?php echo get_page_link( 15 ); ?>">Пользовательское соглашение</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
   </body>
</html>