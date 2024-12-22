<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package finbank_theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> >

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/img/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url'); ?>/img/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url'); ?>/img/favicons/favicon-16x16.png">
<!-- <link rel="manifest" href="<?php bloginfo('template_url'); ?>/site.webmanifest"> -->
<link rel="mask-icon" href="<?php bloginfo('template_url'); ?>/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>

<?
$user_agent = $_SERVER["HTTP_USER_AGENT"];
if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";

    if(  $browser == 'Safari'|| ( wp_is_mobile() && preg_match( '/iPad|iPod|iPhone/', $_SERVER['HTTP_USER_AGENT'] ))){
?>

    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/iphone.css">

<? } ?>

</head>


<!--    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YBXNE6X5W1"></script>-->
    <script>
        // var fired = false;
        //
        // window.addEventListener('scroll', () => {
        //     if (fired === false) {
        //         fired = true;


                // if(window.location.origin == 'https://test.finabank.ru'){
                //     console.log( window.location.origin)
                // }else {
                    console.log( window.location.origin)
                    console.log( window.location.origin)
                    setTimeout(() => {
                        // Здесь все эти тормознутые трекеры, чаты и прочая ересь,
                        // без которой жить не может отдел маркетинга, и которые
                        // когда тот же маркетинг приходит
                        // с вопросом "почему сайт медленно грузится, нам гугл сказал"

                        // яндекс
                        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                            m[i].l=1*new Date();
                            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
                            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
                        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

                        ym(35020350, "init", {
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true,
                            webvisor:true
                        });


                        window.dataLayer = window.dataLayer || [];
                        function gtag(){dataLayer.push(arguments);}
                        gtag('js', new Date());

                        gtag('config', 'G-YBXNE6X5W1');

                        (function(e, x, pe, r, i, me, nt){
                            e[i]=e[i]||function(){(e[i].a=e[i].a||[]).push(arguments)},
                                me=x.createElement(pe),me.async=1,me.src=r,nt=x.getElementsByTagName(pe)[0],nt.parentNode.insertBefore(me,nt)})
                        (window, document, 'script', 'https://abt.s3.yandex.net/expjs/latest/exp.js', 'ymab');
                        ymab('metrika.35020350', 'init'/*, {clientFeatures}, {callback}*/);


                        (function(c,l,a,r,i,t,y){
                            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
                            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
                        })(window, document, "clarity", "script", "mxcdy2lut5");



                    }, 1000)

                // }


        //     }
        // });
    </script>

<? if(false): ?>



    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(35020350, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/35020350" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YBXNE6X5W1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-YBXNE6X5W1');
    </script>

    <!-- Varioqub experiments -->
    <script type="text/javascript">
        (function(e, x, pe, r, i, me, nt){
            e[i]=e[i]||function(){(e[i].a=e[i].a||[]).push(arguments)},
                me=x.createElement(pe),me.async=1,me.src=r,nt=x.getElementsByTagName(pe)[0],nt.parentNode.insertBefore(me,nt)})
        (window, document, 'script', 'https://abt.s3.yandex.net/expjs/latest/exp.js', 'ymab');
        ymab('metrika.35020350', 'init'/*, {clientFeatures}, {callback}*/);
    </script>

    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "mxcdy2lut5");
    </script>

<? else:?>


    <style>
        @media only screen and (max-width: 400px) {
            .slider__item {
                max-width: 400px !important;
            }
        }


    </style>


<? endif; ?>

<?
$main_link = '';
if($_SERVER['HTTP_HOST'] == 'test.finabank.ru'){
    $main_link = 'finabank.ru';
    $main_link_text = 'Главный сайт';
}elseif ($_SERVER['HTTP_HOST'] == 'finabank.ru'){
    $main_link = 'test.finabank.ru';
    $main_link_text = 'Тестовый сайт';
}
$url_for_admins = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $main_link . $_SERVER['REQUEST_URI'];
?>

<body  class="<?= strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') ? 'webp' : '' ?>">
<?php
    if (empty($_SESSION['titlepage'])){
        $_SESSION['titlepage'] = get_the_title();
    }
?>



        <header class="header">

            <?php

            if( current_user_can('administrator')) {
                echo "<a href='" . $url_for_admins ."' class='btn-danger btn mt-5'>". $main_link_text . "</a>";
            }

            ?>





            <?php if(false){ ?>
            <div class="header__top">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <!-- logo -->
                        <div class="header__logo">
                            <a href="<?php echo get_home_url(); ?>" class="logo d-flex align-items-center">
                                <div class="logo__icon">
                                    <svg width="42" height="46" viewBox="0 0 42 46" xmlns="http://www.w3.org/2000/svg"><path d="m22.309 34.102 5.234-13.514h7.85L22.31 34.102ZM16.638 20.588 21 31.486l3.49-10.898h-7.852ZM19.255 34.102l-5.234-13.514h-7.85l13.084 13.514ZM6.17 18.408l3.053-6.103 4.798 6.103h-7.85ZM11.404 10.997l3.926 5.232 3.925-5.232h-7.85ZM16.638 18.408l3.926-5.231 3.925 5.231h-7.85ZM21.872 10.997l3.926 5.232 3.925-5.232h-7.85ZM27.106 18.408l4.798-6.103 3.054 6.103h-7.852Z"></path><path d="m22.309 34.102-.467-.18a.5.5 0 0 0 .826.528l-.36-.348Zm5.234-13.514v-.5a.5.5 0 0 0-.467.32l.467.18Zm7.85 0 .36.348a.5.5 0 0 0-.36-.848v.5ZM19.256 34.102l-.359.348a.5.5 0 0 0 .825-.529l-.466.18Zm-5.234-13.514.466-.18a.5.5 0 0 0-.466-.32v.5Zm-7.85 0v-.5a.5.5 0 0 0-.36.848l.36-.348Zm20.935-2.18-.393-.309a.5.5 0 0 0 .393.81v-.5Zm4.798-6.103.448-.224a.5.5 0 0 0-.84-.085l.392.31Zm3.054 6.103v.5a.5.5 0 0 0 .447-.724l-.447.224Zm-13.086-7.41v-.5a.5.5 0 0 0-.4.8l.4-.3Zm3.926 5.23-.4.3a.5.5 0 0 0 .8 0l-.4-.3Zm3.925-5.23.4.3a.5.5 0 0 0-.4-.8v.5Zm-18.319 0v-.5a.5.5 0 0 0-.4.8l.4-.3Zm3.926 5.23-.4.3a.5.5 0 0 0 .8 0l-.4-.3Zm3.925-5.23.4.3a.5.5 0 0 0-.4-.8v.5Zm-2.617 7.41-.4-.3a.5.5 0 0 0 .4.8v-.5Zm3.926-5.231.4-.3a.5.5 0 0 0-.8 0l.4.3Zm3.925 5.231v.5a.5.5 0 0 0 .4-.8l-.4.3Zm-7.85 2.18v-.5a.5.5 0 0 0-.465.685l.464-.185Zm4.36 10.898-.463.186a.5.5 0 0 0 .94-.034L21 31.486Zm3.49-10.898.476.152a.5.5 0 0 0-.476-.652v.5ZM6.17 18.408l-.447-.224a.5.5 0 0 0 .447.724v-.5Zm3.053-6.103.393-.309a.5.5 0 0 0-.84.085l.447.224Zm4.798 6.103v.5a.5.5 0 0 0 .393-.809l-.393.31Zm6.043-13.92a.5.5 0 1 0 1 0h-1Zm1-3.488a.5.5 0 0 0-1 0h1Zm17.465 7.9a.5.5 0 0 0 .707.707L38.53 8.9Zm3.324-1.908a.5.5 0 1 0-.706-.708l.706.708ZM2.763 9.607A.5.5 0 0 0 3.47 8.9l-.706.707ZM.854 6.284a.5.5 0 1 0-.706.708l.706-.708Zm7.852 28.171a.5.5 0 1 0-.707-.707l.707.707ZM5.38 36.364a.5.5 0 1 0 .707.707l-.707-.707Zm28.621-2.616a.5.5 0 0 0-.707.707l.707-.707Zm1.91 3.323a.5.5 0 0 0 .707-.707l-.706.707ZM21.5 41.077a.5.5 0 0 0-1 0h1ZM20.5 45a.5.5 0 0 0 1 0h-1Zm2.275-10.718 5.234-13.513-.933-.362-5.234 13.514.933.361Zm4.768-13.194h7.85v-1h-7.85v1Zm7.492-.848L21.949 33.754l.719.696 13.085-13.514-.718-.696ZM19.721 33.921l-5.235-13.514-.932.361 5.234 13.514.932-.36Zm-5.7-13.833H6.17v1h7.851v-1Zm-8.211.848L18.896 34.45l.718-.696L6.53 20.24l-.718.696ZM27.5 18.717l4.797-6.103-.786-.618-4.798 6.103.787.618Zm3.957-6.188 3.053 6.103.895-.448-3.053-6.103-.895.448Zm3.5 5.38h-7.85v1h7.85v-1Zm-13.485-6.611 3.926 5.23.8-.6-3.926-5.23-.8.6Zm4.726 5.23 3.925-5.23-.8-.6-3.925 5.23.8.6Zm3.525-6.03h-7.85v1h7.85v-1Zm-18.719.8 3.926 5.23.8-.6-3.926-5.23-.8.6Zm4.726 5.23 3.925-5.23-.8-.6-3.925 5.23.8.6Zm3.525-6.03h-7.85v1h7.85v-1Zm-2.217 8.21 3.926-5.231-.8-.6-3.926 5.231.8.6Zm3.126-5.231 3.925 5.231.8-.6-3.925-5.231-.8.6Zm4.325 4.431h-7.85v1h7.85v-1Zm-8.315 2.865 4.362 10.899.928-.372-4.362-10.898-.928.371Zm5.302 10.865 3.49-10.898-.953-.305-3.49 10.899.953.304Zm3.013-11.55h-7.85v1h7.85v-1ZM6.617 18.632l3.054-6.103-.895-.448-3.053 6.103.894.448Zm2.213-6.018 4.798 6.103.786-.618-4.798-6.103-.786.618Zm5.191 5.294h-7.85v1h7.85v-1Zm7.043-13.42V1h-1v3.487h1Zm18.172 5.12 2.617-2.616-.706-.708L38.53 8.9l.706.707ZM3.47 8.9.853 6.284l-.706.708 2.617 2.615.706-.707Zm4.528 24.848L5.38 36.364l.707.707 2.617-2.616-.707-.707Zm25.297.707 2.617 2.616.707-.707-2.617-2.616-.707.707ZM20.5 41.077V45h1v-3.923h-1Z"></path></svg>
                                </div>
                                Finabank
                            </a>
                            <div id="btn__submenu-back">
                                <svg width="18" height="12" viewBox="0 0 18 12">
                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrowright" x="0" y="0"></use>
                                </svg>
                                Назад
                            </div>
                        </div>
                        <!-- / logo -->
                        <!-- header search -->
                        <?php
                        //$currencies = get_currencies();
                        ?>

<!--                        <div class="header__currency d-none d-md-flex">-->
<!--                            <div class="header__currency-item">usd/rub - --><?php //echo $currencies['USD'] ?? '' ?><!--</div>-->
<!--                            <div class="header__currency-item">eur/rub - --><?php //echo $currencies['EUR'] ?? '' ?><!--</div>-->
<!--                            <div class="header__currency-item">btc/usd - --><?php //echo $currencies['USDBTC'] ?? '' ?><!--</div>-->
<!--                        </div>-->
                        <!-- / header search -->
                        <!-- header links -->
                        <div class="header__links d-flex align-items-center ml-auto">
                            <div class="header__links-item d-none d-md-block">
                                <button id="btn__search" class="btn__modal-show d-flex align-items-center" data-target="searchContainer">
                                    <div class="header__links-icon mr-xl-2">
                                        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.7575 14.5757C15.5232 14.3414 15.1433 14.3414 14.909 14.5757C14.6746 14.81 14.6746 15.1899 14.909 15.4243L15.7575 14.5757ZM18.2422 18.7575C18.4765 18.9919 18.8564 18.9919 19.0907 18.7575C19.325 18.5232 19.3251 18.1433 19.0907 17.909L18.2422 18.7575ZM14.909 15.4243L18.2422 18.7575L19.0907 17.909L15.7575 14.5757L14.909 15.4243ZM8.6665 15.2332C4.85574 15.2332 1.7665 12.144 1.7665 8.33325H0.566504C0.566504 12.8068 4.193 16.4333 8.6665 16.4333V15.2332ZM15.5665 8.33325C15.5665 12.144 12.4773 15.2332 8.6665 15.2332V16.4333C13.14 16.4333 16.7665 12.8068 16.7665 8.33325H15.5665ZM8.6665 1.43325C12.4773 1.43325 15.5665 4.52249 15.5665 8.33325H16.7665C16.7665 3.85974 13.14 0.233252 8.6665 0.233252V1.43325ZM8.6665 0.233252C4.193 0.233252 0.566504 3.85974 0.566504 8.33325H1.7665C1.7665 4.52249 4.85574 1.43325 8.6665 1.43325V0.233252Z"></path></svg>
                                    </div>
                                    <div class="header__links-txt">Поиск</div>
                                </button>
                            </div>
                            <div class="header__links-item">
                                <a href="<?php echo get_page_link('380') ?>" class="d-flex align-items-center header-compare-link">
                                    <div class="header__links-icon mr-xl-2">
                                        <svg width="21" height="22" viewBox="0 0 21 22" xmlns="http://www.w3.org/2000/svg"><path d="m2.79 19.939.294-.404-.294.404Zm-1.229-1.23.405-.293-.405.294Zm17.878 0-.404-.293.404.294Zm-1.23 1.23-.293-.404.294.404Zm0-17.878-.293.405.294-.405Zm1.23 1.23-.404.293.404-.294ZM2.79 2.06l.294.405-.294-.405Zm-1.229 1.23.405.293-.405-.294Zm13.883 6.598a.5.5 0 1 0-1 0h1Zm-1 6.667a.5.5 0 0 0 1 0h-1ZM11 5.444a.5.5 0 0 0-1 0h1Zm-1 11.112a.5.5 0 0 0 1 0h-1ZM6.556 12.11a.5.5 0 0 0-1 0h1Zm-1 4.445a.5.5 0 0 0 1 0h-1ZM10.5 20.5c-2.094 0-3.625 0-4.816-.13-1.181-.128-1.97-.377-2.6-.835l-.588.808c.83.603 1.814.884 3.08 1.021 1.258.137 2.852.136 4.924.136v-1ZM0 11c0 2.072 0 3.666.136 4.924.137 1.266.418 2.25 1.02 3.08l.81-.588c-.459-.63-.708-1.419-.836-2.6C1 14.625 1 13.094 1 11H0Zm3.084 8.535a5.055 5.055 0 0 1-1.118-1.119l-.81.588c.374.514.826.966 1.34 1.34l.588-.81ZM20 11c0 2.094 0 3.625-.13 4.816-.128 1.181-.377 1.97-.835 2.6l.808.588c.603-.83.884-1.814 1.021-3.08.137-1.258.136-2.852.136-4.924h-1Zm-9.5 10.5c2.072 0 3.666 0 4.924-.136 1.266-.137 2.25-.418 3.08-1.02l-.588-.81c-.63.459-1.419.708-2.6.836-1.191.13-2.722.13-4.816.13v1Zm8.535-3.084c-.312.43-.69.807-1.119 1.119l.588.808a6.055 6.055 0 0 0 1.34-1.34l-.81-.587ZM10.5 1.5c2.094 0 3.625 0 4.816.13 1.181.128 1.97.377 2.6.836l.588-.81c-.83-.602-1.814-.883-3.08-1.02C14.166.499 12.572.5 10.5.5v1ZM21 11c0-2.072 0-3.666-.136-4.924-.137-1.266-.418-2.25-1.02-3.08l-.81.588c.459.63.708 1.419.836 2.6C20 7.375 20 8.906 20 11h1Zm-3.084-8.534c.43.311.807.689 1.119 1.118l.808-.588a6.055 6.055 0 0 0-1.34-1.34l-.587.81ZM10.5.5C8.428.5 6.834.5 5.576.636c-1.266.137-2.25.418-3.08 1.02l.588.81c.63-.459 1.419-.708 2.6-.836C6.875 1.5 8.406 1.5 10.5 1.5v-1ZM1 11c0-2.094 0-3.625.13-4.816.128-1.181.377-1.97.836-2.6l-.81-.588c-.602.83-.883 1.814-1.02 3.08C-.001 7.334 0 8.928 0 11h1Zm1.496-9.343a6.055 6.055 0 0 0-1.34 1.34l.81.587c.311-.43.689-.807 1.118-1.118l-.588-.81Zm11.948 8.232v6.667h1V9.889h-1ZM10 5.444v11.112h1V5.444h-1Zm-4.444 6.667v4.445h1V12.11h-1Z"></path></svg>
                                    <?php
$h_cred_cards = !empty($_SESSION['cred_cards']) ? $_SESSION['cred_cards'] : [];
$h_debet_cards = !empty($_SESSION['debet_cards']) ? $_SESSION['debet_cards'] : [];
$h_installment_cards = !empty($_SESSION['installment_cards']) ? $_SESSION['installment_cards'] : [];
$h_kredity = !empty($_SESSION['kredity']) ? $_SESSION['kredity'] : [];
$h_zaimy = !empty($_SESSION['zaimy']) ? $_SESSION['zaimy'] : [];

$count_compare_item = count($h_cred_cards) + count($h_debet_cards) + count($h_installment_cards) + count($h_kredity) + count($h_zaimy);

                                    if ($count_compare_item > 0) {
                                        echo '<div class="count">'.$count_compare_item.'</div>';
                                    }
                                    //$array_compare1 = array_merge($_SESSION['cred_cards'], $_SESSION['debet_cards'], $_SESSION['installment_cards'], $_SESSION['kredity'], $_SESSION['zaimy']);
                                    //var_dump($array_compare1);
                                    ?>
                                    </div>

                                    <div class="header__links-txt">Сравнить</div>
                                </a>
                            </div>
                            <div class="header__links-item">
                                <button id="btn__region" class="btn__modal-show d-flex align-items-center" data-target="regionContainer">
                                    <div class="header__links-icon mr-xl-2">
                                        <svg width="21" height="22" viewBox="0 0 21 22" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 11H6h.5Zm8 0h.5-.5Zm-4 4v.5-.5Zm2.07 5.786.102.489-.103-.49Zm-4.14 0-.102.489.103-.49ZM1.24 7.22l-.463-.189.463.19ZM.714 13.07l-.489.103.49-.103ZM8.431 1.214 8.328.725l.103.49Zm4.138 0 .103-.489-.103.49Zm7.112 6.043.145.479-.145-.479Zm-18.363 0 .145-.479-.145.479Zm17.982.156C19.75 8.519 20 9.73 20 11h1c0-1.402-.275-2.74-.775-3.965l-.925.378ZM20 11c0 .675-.07 1.332-.204 1.966l.979.206A10.54 10.54 0 0 0 21 11h-1Zm-.204 1.966a9.512 9.512 0 0 1-7.33 7.33l.206.979a10.513 10.513 0 0 0 8.103-8.103l-.979-.206Zm-7.33 7.33a9.544 9.544 0 0 1-1.966.204v1c.744 0 1.471-.078 2.172-.225l-.206-.979ZM10.5 20.5c-.675 0-1.332-.07-1.966-.204l-.206.979a10.54 10.54 0 0 0 2.172.225v-1ZM1 11c0-1.271.25-2.483.701-3.59l-.925-.378A10.471 10.471 0 0 0 0 11h1Zm7.534 9.296a9.513 9.513 0 0 1-7.33-7.33l-.979.206a10.513 10.513 0 0 0 8.103 8.103l.206-.979Zm-7.33-7.33A9.54 9.54 0 0 1 1 11H0c0 .744.078 1.471.225 2.172l.979-.206ZM1.7 7.41a9.518 9.518 0 0 1 6.833-5.706L8.328.725A10.518 10.518 0 0 0 .776 7.032l.925.378Zm6.833-5.706A9.541 9.541 0 0 1 10.5 1.5v-1c-.744 0-1.471.078-2.172.225l.206.979ZM10.5 1.5c.675 0 1.332.07 1.966.204l.206-.979A10.542 10.542 0 0 0 10.5.5v1Zm1.966.204A9.518 9.518 0 0 1 19.3 7.413l.925-.378a10.518 10.518 0 0 0-7.553-6.31l-.206.979Zm-.373-.338c.277.867 1.304 4.21 1.726 7.289l.99-.136c-.434-3.169-1.484-6.581-1.763-7.457l-.953.304Zm1.726 7.289C13.931 9.48 14 10.28 14 11h1c0-.78-.074-1.626-.19-2.48l-.992.135Zm5.717-1.876c-1.102.334-3.173.921-5.313 1.316l.182.984c2.192-.405 4.304-1.004 5.421-1.343l-.29-.957Zm-5.313 1.316c-1.297.24-2.602.405-3.723.405v1c1.208 0 2.58-.177 3.905-.421l-.182-.984ZM14 11c0 1.066-.15 2.299-.37 3.534l.984.176C14.84 13.446 15 12.15 15 11h-1Zm-.37 3.534c-.484 2.707-1.297 5.347-1.537 6.1l.953.304c.244-.766 1.072-3.455 1.568-6.228l-.984-.176Zm6.504-1.94c-.753.24-3.393 1.052-6.1 1.536l.176.984c2.773-.496 5.462-1.324 6.228-1.568l-.304-.953Zm-6.1 1.536c-1.235.22-2.468.37-3.534.37v1c1.15 0 2.446-.16 3.71-.386l-.176-.984Zm-3.534.37c-1.066 0-2.299-.15-3.534-.37l-.176.984c1.264.226 2.56.386 3.71.386v-1Zm-3.534-.37c-2.707-.484-5.347-1.297-6.1-1.537l-.304.953c.766.244 3.455 1.072 6.228 1.568l.176-.984ZM6 11c0 1.15.16 2.446.386 3.71l.984-.176C7.15 13.299 7 12.066 7 11H6Zm.386 3.71c.496 2.773 1.324 5.462 1.568 6.228l.953-.304c-.24-.753-1.053-3.393-1.537-6.1l-.984.176ZM7.954 1.062c-.28.876-1.33 4.288-1.763 7.457l.99.136c.422-3.079 1.45-6.422 1.726-7.289l-.953-.304ZM6.191 8.52C6.074 9.374 6 10.22 6 11h1c0-.72.068-1.519.181-2.345l-.99-.136ZM10.5 8.5c-1.121 0-2.426-.165-3.723-.405l-.182.984c1.325.244 2.697.421 3.905.421v-1Zm-3.723-.405c-2.14-.395-4.213-.983-5.314-1.317l-.29.957c1.117.34 3.23.939 5.422 1.344l.182-.984ZM19.532 6.78h.001l.003-.001.29.957a.975.975 0 0 0 .167-.068l-.46-.888ZM.978 7.648a.84.84 0 0 0 .195.087l.29-.957a.16.16 0 0 1 .036.017l-.521.853Z"></path></svg>
                                    </div>

                                    <div class="header__links-txt"><?php echo do_shortcode( "[wt_geotargeting get='city']" ); ?>
                                    </div>
                                </button>
                            </div>
                            <div class="header__links-item">
                                <div class="d-flex align-items-center themeBtn" id="themeBtn">

<!--                                    <input  type='checkbox' cl ass='ios8-switch ios8-switch-sm' id='checkbox-2'>-->
<!--                                    <label for='checkbox-2'></label>-->
<!---->
<!--                                    <svg id="icon__light" width="18" height="21" viewBox="0 0 18 21" xmlns="http://www.w3.org/2000/svg"><path d="M8.064 11.427c2.021 3.547 4.94 4.8 6.69 5.5.445.18.78.309 1.024.431.12.06.191.107.232.14.041.035.016.028 0-.027-.048-.156.092-.181-.132.026-.194.178-.546.42-1.12.757l.504.863c.581-.34 1.014-.628 1.293-.885.249-.228.55-.595.411-1.052a.956.956 0 0 0-.319-.452 2.244 2.244 0 0 0-.42-.263c-.293-.147-.686-.299-1.102-.466-1.696-.679-4.345-1.825-6.192-5.067l-.87.495Zm6.693 6.827c-4.383 2.564-9.99 1.045-12.525-3.403l-.869.496c2.807 4.925 9.03 6.618 13.899 3.77l-.505-.863ZM2.232 14.851C-.305 10.401 1.203 4.711 5.59 2.146l-.505-.863C.22 4.128-1.442 10.425 1.363 15.347l.869-.495ZM5.59 2.146c.575-.336.958-.523 1.207-.604.29-.094.19.02.073-.106-.039-.043-.031-.069-.022-.013.008.054.012.141.003.277-.017.276-.074.636-.144 1.115-.275 1.883-.664 5.068 1.357 8.613l.869-.495C7.084 7.69 7.429 4.788 7.697 2.96c.065-.449.132-.869.153-1.198.01-.167.01-.339-.015-.497a.959.959 0 0 0-.227-.505c-.327-.357-.8-.272-1.119-.17-.36.117-.823.353-1.404.693l.505.864Z"></path></svg>-->
<!---->


                                    <!-- <input  type="checkbox"> -->
                                    <div class="header__links-icon mr-xl-2">
                                        <svg id="icon__light" width="18" height="21" viewBox="0 0 18 21" xmlns="http://www.w3.org/2000/svg"><path d="M8.064 11.427c2.021 3.547 4.94 4.8 6.69 5.5.445.18.78.309 1.024.431.12.06.191.107.232.14.041.035.016.028 0-.027-.048-.156.092-.181-.132.026-.194.178-.546.42-1.12.757l.504.863c.581-.34 1.014-.628 1.293-.885.249-.228.55-.595.411-1.052a.956.956 0 0 0-.319-.452 2.244 2.244 0 0 0-.42-.263c-.293-.147-.686-.299-1.102-.466-1.696-.679-4.345-1.825-6.192-5.067l-.87.495Zm6.693 6.827c-4.383 2.564-9.99 1.045-12.525-3.403l-.869.496c2.807 4.925 9.03 6.618 13.899 3.77l-.505-.863ZM2.232 14.851C-.305 10.401 1.203 4.711 5.59 2.146l-.505-.863C.22 4.128-1.442 10.425 1.363 15.347l.869-.495ZM5.59 2.146c.575-.336.958-.523 1.207-.604.29-.094.19.02.073-.106-.039-.043-.031-.069-.022-.013.008.054.012.141.003.277-.017.276-.074.636-.144 1.115-.275 1.883-.664 5.068 1.357 8.613l.869-.495C7.084 7.69 7.429 4.788 7.697 2.96c.065-.449.132-.869.153-1.198.01-.167.01-.339-.015-.497a.959.959 0 0 0-.227-.505c-.327-.357-.8-.272-1.119-.17-.36.117-.823.353-1.404.693l.505.864Z"></path></svg>
                                        <svg id="icon__dark" width="22" height="22" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 19.5 19.5" xml:space="preserve"><path d="M552.1 253.3c0 2.8-2.2 5-5 5s-5-2.2-5-5 2.2-5 5-5 5 2.2 5 5z" fill="none" stroke="#9ca3af" stroke-width="1.5"></path><path class="st1" d="M552.9 246.4c-.3.3-.3.8 0 1.1s.8.3 1.1 0l-1.1-1.1zm1.2 1c.3-.3.3-.8 0-1.1-.3-.3-.8-.3-1.1 0l1.1 1.1zm-13.9 11.8c-.3.3-.3.8 0 1.1.3.3.8.3 1.1 0l-1.1-1.1zm1.2.9c.3-.3.3-.8 0-1.1-.3-.3-.8-.3-1.1 0l1.1 1.1zm5-15.8c0 .4.3.8.8.8.4 0 .8-.3.8-.8h-1.6zm1.5 0c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8h1.6zm-1.5 18c0 .4.3.8.8.8.4 0 .8-.3.8-.8h-1.6zm1.5-.1c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8h1.6zm-9.7-8.2c.4 0 .8-.3.8-.8s-.3-.8-.8-.8v1.6zm-.1-1.5c-.4 0-.8.3-.8.8s.3.8.8.8v-1.6zm18 1.5c.4 0 .8-.3.8-.8s-.3-.8-.8-.8v1.6zm0-1.5c-.4 0-.8.3-.8.8s.3.8.8.8v-1.6zm-15.8-5c.3.3.8.3 1.1 0 .3-.3.3-.8 0-1.1l-1.1 1.1zm.9-1.2c-.3-.3-.8-.3-1.1 0-.3.3-.3.8 0 1.1l1.1-1.1zm11.8 13.9c.3.3.8.3 1.1 0 .3-.3.3-.8 0-1.1l-1.1 1.1zm1-1.2c-.3-.3-.8-.3-1.1 0-.3.3-.3.8 0 1.1l1.1-1.1zm0-11.5.1-.1-1.1-1.1-.1.1 1.1 1.1zm-12.8 12.7.1-.1-1.1-1.1-.1.1 1.1 1.1zm6.7-15.9-1.5-.1v.1h1.5zm0 18-1.5-.1v.1h1.5zm-9.7-9.8-.1 1.5h.1v-1.5zm17.9 0-.1 1.5h.1v-1.5zm-14.7-6.1-.1-.1-1.1 1.1.1.1 1.1-1.1zm12.7 12.8-.1-.2-1.1 1.1.1.1 1.1-1zM9.8 15.5C6.6 15.5 4 12.9 4 9.8S6.6 4 9.8 4s5.8 2.6 5.8 5.8-2.7 5.7-5.8 5.7zm0-10c-2.3 0-4.2 1.9-4.2 4.2S7.4 14 9.8 14 14 12.1 14 9.8s-1.9-4.3-4.2-4.3zM4 16.6l-.1.1c-.3.3-.8.3-1.1 0-.3-.3-.3-.8 0-1.1l.1-.1c.3-.3.8-.3 1.1 0 .3.3.3.8 0 1.1zM10.5 18.7c0 .5-.3.8-.8.8-.4 0-.8-.3-.8-.8v-.1c0-.4.3-.8.8-.8.5.1.8.5.8.9zM16.7 16.7c-.3.3-.8.3-1.1 0l-.1-.1c-.3-.3-.3-.8 0-1.1.3-.3.8-.3 1.1 0l.1.1c.3.3.3.8 0 1.1zM19.5 9.8c0 .4-.3.8-.8.8h-.1c-.4 0-.8-.3-.8-.8 0-.4.3-.8.8-.8h.1c.5 0 .8.3.8.8zM16.7 3.8l-.1.2c-.3.3-.8.3-1.1 0-.3-.3-.3-.8 0-1.1l.1-.1c.3-.3.8-.3 1.1 0 .3.3.3.8 0 1zM10.5.8c0 .5-.3.8-.8.8-.4 0-.7-.4-.7-.8 0-.5.3-.8.8-.8.4 0 .7.3.7.8zM4 4c-.3.3-.8.3-1.1 0l-.1-.2c-.3-.3-.3-.8 0-1.1.3-.3.8-.3 1.1 0l.1.2c.3.3.3.8 0 1.1zM1.6 9.8c0 .4-.3.8-.8.8-.5-.1-.8-.4-.8-.8 0-.5.3-.8.8-.8h.1c.3 0 .7.3.7.8z"></path></svg>
                                    </div>
                                    <div class="header__links-txt">День/Ночь</div>
                                </div>
                            </div>
                            <!-- <div class="header__links-item">
                                <a href="" class="d-flex align-items-center">
                                    <div class="header__links-icon mr-xl-2">
                                        <svg width="15" height="21" viewBox="0 0 15 21" xmlns="http://www.w3.org/2000/svg"><path d="M11 5a3.5 3.5 0 0 1-3.5 3.5v1A4.5 4.5 0 0 0 12 5h-1ZM7.5 8.5A3.5 3.5 0 0 1 4 5H3a4.5 4.5 0 0 0 4.5 4.5v-1ZM4 5a3.5 3.5 0 0 1 3.5-3.5v-1A4.5 4.5 0 0 0 3 5h1Zm3.5-3.5A3.5 3.5 0 0 1 11 5h1A4.5 4.5 0 0 0 7.5.5v1Zm-3 11h6v-1h-6v1Zm6 7h-6v1h6v-1Zm-6 0A3.5 3.5 0 0 1 1 16H0a4.5 4.5 0 0 0 4.5 4.5v-1ZM14 16a3.5 3.5 0 0 1-3.5 3.5v1A4.5 4.5 0 0 0 15 16h-1Zm-3.5-3.5A3.5 3.5 0 0 1 14 16h1a4.5 4.5 0 0 0-4.5-4.5v1Zm-6-1A4.5 4.5 0 0 0 0 16h1a3.5 3.5 0 0 1 3.5-3.5v-1Z"></path></svg>
                                    </div>
                                    <div class="header__links-txt">Аккаунт</div>
                                </a>
                            </div> -->
                            <div id="btnMenu" class="header__burger d-md-none">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <!-- / header links -->
                    </div>
                </div>
            </div>



            <div class="header__bottom">
                <div class="header__bottom-wrap">
                    <!-- search form -->
                    <div id="searchContainer" class="header__search">
                        <div class="header__search-section">
                            <form class="search-form" role="search" method="get" id="searchform" action="<?php echo home_url('/') ?>">
                                <div class="container">
                                    <div class="header__search-form d-flex align-items-center">
                                        <div class="header__search-icon"><svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.7575 14.5757C15.5232 14.3414 15.1433 14.3414 14.909 14.5757C14.6746 14.81 14.6746 15.1899 14.909 15.4243L15.7575 14.5757ZM18.2422 18.7575C18.4765 18.9919 18.8564 18.9919 19.0907 18.7575C19.325 18.5232 19.3251 18.1433 19.0907 17.909L18.2422 18.7575ZM14.909 15.4243L18.2422 18.7575L19.0907 17.909L15.7575 14.5757L14.909 15.4243ZM8.6665 15.2332C4.85574 15.2332 1.7665 12.144 1.7665 8.33325H0.566504C0.566504 12.8068 4.193 16.4333 8.6665 16.4333V15.2332ZM15.5665 8.33325C15.5665 12.144 12.4773 15.2332 8.6665 15.2332V16.4333C13.14 16.4333 16.7665 12.8068 16.7665 8.33325H15.5665ZM8.6665 1.43325C12.4773 1.43325 15.5665 4.52249 15.5665 8.33325H16.7665C16.7665 3.85974 13.14 0.233252 8.6665 0.233252V1.43325ZM8.6665 0.233252C4.193 0.233252 0.566504 3.85974 0.566504 8.33325H1.7665C1.7665 4.52249 4.85574 1.43325 8.6665 1.43325V0.233252Z"></path></svg></div>
                                        <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" class="header__search-input form-control" placeholder="Поиск..." autocomplete="off">
                                        <div class="btn__modal-close header__search-close" data-dismiss="modal"></div>
                                    </div>
                                </div>
                                <div id="result_search_ajax">

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- / search form end -->
                    <!-- navigation -->
                    <div class="header__top container">
                        <div class="header__bottom-nav navigation">
                            <ul class="navigation__container">
                                <li class="navigation__item">
                                    <a class="navigation__item-link">
                                        <div class="navigation__item-icon">
                                            <svg width="18" height="16" viewBox="0 0 18 16">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#credits" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                        Кредиты
                                        <div class="navigation__item-arrow">
                                            <svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                    </a>
                                    <!-- submenu -->
                                    <div class="navigation__item-sub">
                                        <div class="container">
                                            <div class="navigation__sub">
                                                <div class="row mx-md-n4">
                                                    <div class="col-12 col-md-6 px-md-4 navigation__sub-col">
                                                        <a href="<?php echo get_post_type_archive_link('kredity') ?>" class="navigation__sub-title">
                                                            <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M13.4444 11.6667v.5c.2762 0 .5-.2239.5-.5h-.5Zm-.8888 0h-.5c0 .2761.2238.5.5.5v-.5Zm0-.8889v-.5c-.2762 0-.5.2238-.5.5h.5Zm.8888 0h.5c0-.2762-.2238-.5-.5-.5v.5ZM3.66667 3.61111c-.27615 0-.5.22386-.5.5s.22385.5.5.5v-1Zm10.66663 1c.2762 0 .5-.22386.5-.5s-.2238-.5-.5-.5v1ZM15 16.5H3v1h12v-1ZM3 1.5h12v-1H3v1ZM1.5 15.0013V6.33333h-1V15.0013h1Zm0-8.66797V2.9993h-1V6.33333h1ZM16.5 3v3.44444h1V3h-1Zm0 3.44444V15h1V6.44444h-1ZM.562921 6.57616C1.24349 7.80118 2.74527 8.3332 4.37628 8.53443c1.66489.20541 3.64323.08858 5.51998-.14952 1.88264-.23884 3.69134-.60356 5.02724-.90781.6686-.15227 1.2202-.28973 1.6053-.38928.1926-.04979.3435-.09012.4468-.1181.0516-.01399.0913-.0249.1182-.03237.0135-.00373.0238-.0066.0308-.00857.0036-.00098.0063-.00174.0081-.00226.001-.00027.0017-.00047.0022-.00062.0003-.00007.0005-.00013.0006-.00017.0002-.00005.0003-.00009-.1355-.48129-.1358-.48119-.1358-.4812-.1358-.48119-.0001.00002-.0002.00005-.0004.00009l-.0015.00045c-.0015.00041-.0038.00105-.0069.00193-.0063.00174-.0157.00438-.0284.00789-.0253.007-.0633.01744-.1131.03095-.0997.02703-.2469.06635-.4354.11509-.3771.09749-.9192.2326-1.577.38242-1.3169.29992-3.0916.65742-4.9311.89079-1.84547.23413-3.72824.33952-5.27168.1491-1.57732-.19461-2.6311-.67648-3.06164-1.45145l-.874159.48565ZM13.4444 11.1667h-.8888v1h.8888v-1Zm-.3888.5v-.8889h-1v.8889h1Zm-.5-.3889h.8888v-1h-.8888v1Zm.3888-.5v.8889h1v-.8889h-1ZM3.66667 4.61111H14.3333v-1H3.66667v1ZM15 1.5c.8284 0 1.5.67157 1.5 1.5h1c0-1.38071-1.1193-2.5-2.5-2.5v1ZM3 .5C1.61952.5.5 1.61836.5 2.9993h1C1.5 2.1711 2.17134 1.5 3 1.5v-1Zm0 16c-.82887 0-1.5-.6707-1.5-1.4987h-1C.5 16.3825 1.61973 17.5 3 17.5v-1Zm12 1c1.3807 0 2.5-1.1193 2.5-2.5h-1c0 .8284-.6716 1.5-1.5 1.5v1Z"></path></svg>
                                                            потребительские
                                                        </a>
                                                        <?php
                                                            $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'kred_left',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                            ); ?>
                                                            <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                    </div>
                                                    <!--div class="col-12 col-md-6 px-md-4 navigation__sub-col">
                                                        <a href="<?php echo get_post_type_archive_link('ipoteka') ?>" class="navigation__sub-title">
                                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 15c-.276142 0-.5.2239-.5.5s.223858.5.5.5v-1Zm16 1c.2761 0 .5-.2239.5-.5s-.2239-.5-.5-.5v1ZM5.64645 13.1464c-.19527.1953-.19527.5119 0 .7072.19526.1952.51184.1952.7071 0l-.7071-.7072Zm6.70715-5.29285c.1952-.19526.1952-.51184 0-.7071-.1953-.19527-.5119-.19527-.7072 0l.7072.7071ZM4 5.5l.35355.35355L4 5.5ZM4 1V.5c-.27614 0-.5.223858-.5.5H4Zm2 0h.5c0-.276142-.22386-.5-.5-.5V1Zm3.70711.20711-.35356.35355.35356-.35355Zm6.43929 6.43934L15.7929 8l.3535-.35355ZM15 16h2v-1h-2v1Zm.5-.5V8.75h-1v6.75h1ZM15.25 9h.5429V8H15.25v1Zm1.25-1.70711L10.0607.853553l-.70715.707107L15.7929 8l.7071-.70711ZM2.20711 9H2.75V8h-.54289v1ZM1 16h2v-1H1v1Zm2 0h12v-1H3v1Zm-.5-7.25v6.75h1V8.75h-1Zm3.85355 5.1036 6.00005-6.00005-.7072-.7071-5.99995 5.99995.7071.7072Zm-2.7071-8.70715L1.5 7.29289 2.20711 8l2.14644-2.14645-.7071-.7071ZM4.5 5.5V1h-1v4.5h1Zm-.5-4h2v-1H4v1ZM7.93934.853553 5.64645 3.14645l.7071.7071 2.2929-2.29289-.70711-.707107ZM5.64645 3.14645l-2 2 .7071.7071 2-2-.7071-.7071ZM5.5 1v2.5h1V1h-1Zm7 11.5c0-.8284-.6716-1.5-1.5-1.5v1c.2761 0 .5.2239.5.5h1ZM11 14c.8284 0 1.5-.6716 1.5-1.5h-1c0 .2761-.2239.5-.5.5v1Zm-1.5-1.5c0 .8284.6716 1.5 1.5 1.5v-1c-.2761 0-.5-.2239-.5-.5h-1Zm1 0c0-.2761.2239-.5.5-.5v-1c-.8284 0-1.5.6716-1.5 1.5h1Zm-2-4C8.5 7.67157 7.82843 7 7 7v1c.27614 0 .5.22386.5.5h1ZM2.75 9c-.13807 0-.25-.11193-.25-.25h1c0-.41421-.33579-.75-.75-.75v1ZM7 10c.82843 0 1.5-.67157 1.5-1.5h-1c0 .27614-.22386.5-.5.5v1ZM2.20711 8 1.5 7.29289C.870036 7.92286 1.3162 9 2.20711 9V8ZM5.5 8.5c0 .82843.67157 1.5 1.5 1.5V9c-.27614 0-.5-.22386-.5-.5h-1ZM10.0607.853553c-.58583-.585787-1.53557-.585786-2.12136 0l.70711.707107c.19526-.19526.51184-.19526.7071 0l.70715-.707107ZM6.5 8.5c0-.27614.22386-.5.5-.5V7c-.82843 0-1.5.67157-1.5 1.5h1Zm9.2929.5c.8909 0 1.3371-1.07714.7071-1.70711L15.7929 8v1ZM15.5 8.75c0 .13807-.1119.25-.25.25V8c-.4142 0-.75.33579-.75.75h1Z"></path></svg>
                                                            Ипотека
                                                        </a>
                                                        <?php
                                                            $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'kred_right',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                            ); ?>
                                                            <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                    </div-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / submenu -->
                                </li>
                                <li class="navigation__item">
                                    <a class="navigation__item-link" >
                                        <div class="navigation__item-icon">
                                            <svg width="18" height="16" viewBox="0 0 18 16">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#cards" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                        карты
                                        <div class="navigation__item-arrow">
                                            <svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                    </a>
                                    <!-- submenu -->
                                    <div class="navigation__item-sub">
                                        <div class="container">
                                            <div class="navigation__sub">
                                                <div class="row mx-md-n4">
                                                    <div class="col-12 col-md-4 col-lg-4 px-md-4 navigation__sub-col">
                                                        <a href="<?php echo get_term_link(7, '') ?>" class="navigation__sub-title">
                                                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 29.5 26" style="enable-background:new 0 0 29.5 26" xml:space="preserve"><path d="M26.2 4.6h-2.7l-2-3.3C20.8 0 19.2-.4 18 .4l-7.1 4.2H3.3C1.5 4.6 0 6.1 0 7.9v14.8C0 24.5 1.5 26 3.3 26h22.9c1.8 0 3.3-1.5 3.3-3.3V7.9c0-1.8-1.5-3.3-3.3-3.3zm-7.8-2.9c.7-.4 1.7-.2 2.1.5l4.9 8.2c.4.7.2 1.7-.5 2.1l-10.2 6H7.9L4 11.9c-.4-.7-.2-1.7.5-2.1l13.9-8.1zM1.3 7.9c0-1.1.9-2 2-2h5.3l-5 3c-1.2.7-1.6 2.2-.9 3.4l3.7 6.2H1.3V7.9zm26.9 14.8c0 1.1-.9 2-2 2H3.3c-1.1 0-2-.9-2-2v-2.8h26.9v2.8zm0-4.1h-11l8.6-5.1c1.2-.7 1.6-2.3.9-3.5l-2.5-4.2h1.9c1.1 0 2 .9 2 2v10.8z"></path><path d="M8.2 14.7h-.3c-.3-.1-.6-.3-.8-.6l-1-1.7c-.4-.6-.1-1.4.5-1.8l3-1.8c.3-.2.7-.2 1-.1.3.1.6.3.8.6l1 1.7c.4.6.1 1.4-.5 1.8l-3 1.8c-.2 0-.5.1-.7.1zm-1-3.1 1 1.8 3-1.8-1-1.8-3 1.8z"></path></svg>
                                                            дебетовые карты
                                                        </a>
                                                        <?php
                                                            $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'card_left',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                            ); ?>
                                                            <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                    </div>
                                                    <div class="col-12 col-md-4 col-lg-4 px-md-4 navigation__sub-col">
                                                        <a href="<?php echo get_term_link(2, '') ?>" class="navigation__sub-title">
                                                            <svg width="18" height="16" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 30.5 27" style="enable-background:new 0 0 30.5 27" xml:space="preserve">
                                                                <path d="M9.9 22.7c0-.4-.3-.7-.7-.7v1.3c.4 0 .7-.3.7-.6zM3.9 22h5.3v1.3H3.9z"></path>
                                                                <path d="M3.9 23.3V22c-.4 0-.7.3-.7.7.1.3.4.6.7.6z"></path>
                                                                <path d="M30.4 15.3 28.3 2.7c-.1-.9-.6-1.6-1.3-2.1-.7-.5-1.6-.7-2.4-.6L4.7 3.4c-1.8.3-3 2-2.7 3.8l.1.7C.9 8.4 0 9.6 0 11v12.7C0 25.5 1.5 27 3.3 27h20.1c1.8 0 3.3-1.5 3.3-3.3v-4.5l1.2-.2c.9-.1 1.6-.6 2.1-1.3.4-.7.6-1.6.4-2.4zm-5.1 8.4c0 1.1-.9 2-2 2h-20c-1.1 0-2-.9-2-2v-6.5h24v6.5zm0-7.8h-24v-2.8h24v2.8zm0-4.1h-24V11c0-1.1.9-2 2-2h20.1c1.1 0 2 .9 2 2v.8zm3.5 5.1c-.3.4-.8.7-1.3.8l-1 .2V11c0-1.8-1.5-3.3-3.3-3.3H3.5L3.4 7c-.2-1.1.5-2.1 1.6-2.3l19.8-3.4c1.1-.2 2.1.5 2.3 1.6l2.1 12.5c0 .6-.1 1.1-.4 1.5z"></path>
                                                            </svg>
                                                            кредитные карты
                                                        </a>
                                                       <?php
                                                            $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'card_center',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                            ); ?>
                                                            <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                    </div>
                                                    <div class="col-12 col-md-4 col-lg-4 px-md-4 navigation__sub-col">
                                                        <a href="<?php echo get_term_link(8, '') ?>" class="navigation__sub-title">
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="20" height="20" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24" xml:space="preserve"><path class="st1" d="M8.8 15.5c-.2 0-.4-.1-.5-.3L5.8 9.1c-.1-.3 0-.5.3-.7.3-.1.5 0 .7.3l2.6 6.1c.1.3 0 .5-.3.7h-.3zM10 11.5c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5 1.5.7 1.5 1.5-.7 1.5-1.5 1.5zm0-2c-.3 0-.5.2-.5.5s.2.5.5.5.5-.2.5-.5-.2-.5-.5-.5zM5 15.5c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5 1.5.7 1.5 1.5-.7 1.5-1.5 1.5zm0-2c-.3 0-.5.2-.5.5s.2.5.5.5.5-.2.5-.5-.2-.5-.5-.5z"/><path class="st1" d="M21.5 4.5h-7v-3c0-.3-.2-.6-.4-.7-.3-.2-.6-.2-.9-.1l-1.4.6-1.6-.7C9.8.4 9.4.4 9.1.6l-1.6.7L5.9.6C5.5.4 5.1.4 4.8.6l-1.6.7L1.8.7C1.5.6 1.2.6.9.8c-.2.1-.4.4-.4.7v21c0 .3.2.6.4.7.3.2.6.2.9.1l1.4-.6 1.6.7c.4.2.8.2 1.1 0l1.6-.7 1.6.7c.2.1.4.1.6.1.2 0 .4 0 .6-.1l1.6-.7 1.4.6c.3.1.6.1.9-.1.2-.2.4-.4.4-.7v-3h7c1.1 0 2-.9 2-2v-11c-.1-1.1-1-2-2.1-2zm-8 17.8-1.5-.6c-.1-.1-.3-.1-.4 0l-1.8.8h-.3l-1.8-.8h-.4l-1.8.8h-.3l-1.8-.8c-.1-.1-.3-.1-.4 0l-1.5.7V1.7l1.5.6c.1.1.3.1.4 0l1.8-.8h.3l1.8.8c.1.1.3.1.4 0l1.8-.8h.3l1.8.8c.1.1.3.1.4 0l1.5-.7v20.7zm9-4.8c0 .5-.5 1-1 1h-7v-6.6h8v5.6zm0-6.6h-8V8.7h8v2.2zm0-3.2h-8V5.5h7c.5 0 1 .5 1 1v1.2z"/></svg>
                                                            карты рассрочки
                                                        </a>
                                                       <?php
                                                            $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'card_right',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                            ); ?>
                                                            <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / submenu -->
                                </li>
                                <li class="navigation__item">
                                    <a class="navigation__item-link">
                                        <div class="navigation__item-icon">
                                            <svg width="16" height="22" viewBox="0 0 16 22">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#loans" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                        займы
                                        <div class="navigation__item-arrow">
                                            <svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                    </a>
                                    <div class="navigation__item-sub">
                                        <div class="container">
                                            <div class="navigation__sub">
                                                <div class="row mx-md-n4">
                                                    <div class="col-12 col-md-6 col-lg-4 px-md-4 navigation__sub-col">
                                                        <a href="<?php echo get_post_type_archive_link('zaimy') ?>" class="navigation__sub-title">
                                                            <svg width="24" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 17" xml:space="preserve"><path d="M14.6 17c-4.6 0-8.4-3.8-8.4-8.5S10 0 14.6 0C19.2 0 23 3.8 23 8.5S19.2 17 14.6 17zm0-16c-4.1 0-7.4 3.4-7.4 7.5s3.3 7.5 7.4 7.5S22 12.6 22 8.5 18.7 1 14.6 1zm2.3 10.9c-.1 0-.3 0-.4-.1l-2.3-2.3c-.1-.1-.1-.2-.1-.4v-4c0-.3.2-.5.5-.5s.5.2.5.5v3.8l2.1 2.1c.2.2.2.5 0 .7-.1.1-.2.2-.3.2zM5 11.3H2.8c-.3 0-.5-.2-.5-.5s.2-.5.5-.5H5c.3 0 .5.2.5.5s-.2.5-.5.5zM5 9H.5C.2 9 0 8.8 0 8.5S.2 8 .5 8H5c.3 0 .5.2.5.5S5.3 9 5 9zm0-2.3H2.8c-.3 0-.5-.2-.5-.5s.2-.5.5-.5H5c.3 0 .5.2.5.5s-.2.5-.5.5z"></path></svg>
                                                            Микрозаймы
                                                        </a>
                                                        <?php
                                                            $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'zaim_left',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                            ); ?>
                                                            <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                    </div>
                                                    <div class="col-12 col-md-6 px-md-4 navigation__sub-col">
                                                        <a href="<?php echo get_post_type_archive_link('zaimy') ?>" class="navigation__sub-title">
                                                            <svg width="16" height="18" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg"><path d="M21.706 8.579v.5h.5v-.5h-.5Zm-15.53 2.526v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.294 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.295 0h-.5a.5.5 0 0 0 .5.5v-.5Zm14.236-8.842v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.295 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.294 0h-.5a.5.5 0 0 0 .5.5v-.5Zm.983-15.104.19-.463-.19.463Zm-9.584-3.766L12 1.54l-.19-.463Zm.378 0L12 1.54l.19-.463ZM2.605 4.843l-.19-.463.19.463Zm19.1 3.236H2.296v1h19.41v-1ZM2.796 5.306 12 1.54l-.379-.925L2.416 4.38l.378.926ZM12 1.54l9.206 3.766.378-.926L12.38.615 12 1.54ZM2.794 8.58V6.143h-1v2.436h1Zm0-2.436v-.837h-1v.837h1Zm18.412-.837v.837h1v-.837h-1Zm0 .837v2.436h1V6.143h-1Zm-18.912.5h19.412v-1H2.294v1Zm1.294 12.804H2.294v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027H6.176v1h1.295v-1Zm10.352 0H16.53v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027h-1.294v1h1.294v-1Zm0 3.527h.794v-1h-.794v1Zm.794 0V24.5h1v-1.526h-1Zm0 1.526h-21v1h21v-1Zm-21 0v-1.526h-1V24.5h1Zm0-1.526h.794v-1H1.5v1Zm2.088-12.369H1.5v1h2.088v-1Zm-2.088 0V9.08h-1v1.526h1Zm21-1.526v1.526h1V9.08h-1Zm0 1.526h-2.088v1H22.5v-1ZM1.5 9.08h.794v-1H1.5v1Zm.794 0H22.5v-1H2.294v1Zm3.382 2.026v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1Zm15.824-8.842v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1ZM7.47 22.974H12v-1H7.47v1Zm4.529 0h4.53v-1H12v1ZM6.176 11.605H12v-1H6.176v1Zm5.824 0h5.823v-1H12v1Zm.5 10.869V11.105h-1v11.369h1Zm10-11.869v1a1 1 0 0 0 1-1h-1Zm1-1.526a1 1 0 0 0-1-1v1h1Zm-22 0v-1a1 1 0 0 0-1 1h1Zm0 1.526h-1a1 1 0 0 0 1 1v-1Zm0 13.895h-1a1 1 0 0 0 1 1v-1ZM21.206 5.306h1a1 1 0 0 0-.622-.926l-.378.926ZM22.5 22.974h1a1 1 0 0 0-1-1v1Zm0 1.526v1a1 1 0 0 0 1-1h-1Zm-21-1.526v-1a1 1 0 0 0-1 1h1ZM12 1.54l.379-.925a1 1 0 0 0-.758 0L12 1.54ZM2.416 4.38a1 1 0 0 0-.622.926h1l-.378-.926Z"></path></svg>
                                                            мфо
                                                        </a>
                                                        <?php
                                                            $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'zaim_right',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                            ); ?>
                                                            <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="navigation__item">
                                    <a class="navigation__item-link">
                                        <div class="navigation__item-icon">
                                            <svg width="16" height="18" viewBox="0 0 16 18">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#banks" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                        Банки
                                        <div class="navigation__item-arrow">
                                            <svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                    </a>
                                    <div class="navigation__item-sub">
                                        <div class="container">
                                            <div class="navigation__sub">
                                                <a href="<?php echo get_post_type_archive_link('banks') ?>" class="navigation__sub-title">
                                                    <svg width="16" height="18" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg"><path d="M21.706 8.579v.5h.5v-.5h-.5Zm-15.53 2.526v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.294 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.295 0h-.5a.5.5 0 0 0 .5.5v-.5Zm14.236-8.842v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.295 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.294 0h-.5a.5.5 0 0 0 .5.5v-.5Zm.983-15.104.19-.463-.19.463Zm-9.584-3.766L12 1.54l-.19-.463Zm.378 0L12 1.54l.19-.463ZM2.605 4.843l-.19-.463.19.463Zm19.1 3.236H2.296v1h19.41v-1ZM2.796 5.306 12 1.54l-.379-.925L2.416 4.38l.378.926ZM12 1.54l9.206 3.766.378-.926L12.38.615 12 1.54ZM2.794 8.58V6.143h-1v2.436h1Zm0-2.436v-.837h-1v.837h1Zm18.412-.837v.837h1v-.837h-1Zm0 .837v2.436h1V6.143h-1Zm-18.912.5h19.412v-1H2.294v1Zm1.294 12.804H2.294v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027H6.176v1h1.295v-1Zm10.352 0H16.53v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027h-1.294v1h1.294v-1Zm0 3.527h.794v-1h-.794v1Zm.794 0V24.5h1v-1.526h-1Zm0 1.526h-21v1h21v-1Zm-21 0v-1.526h-1V24.5h1Zm0-1.526h.794v-1H1.5v1Zm2.088-12.369H1.5v1h2.088v-1Zm-2.088 0V9.08h-1v1.526h1Zm21-1.526v1.526h1V9.08h-1Zm0 1.526h-2.088v1H22.5v-1ZM1.5 9.08h.794v-1H1.5v1Zm.794 0H22.5v-1H2.294v1Zm3.382 2.026v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1Zm15.824-8.842v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1ZM7.47 22.974H12v-1H7.47v1Zm4.529 0h4.53v-1H12v1ZM6.176 11.605H12v-1H6.176v1Zm5.824 0h5.823v-1H12v1Zm.5 10.869V11.105h-1v11.369h1Zm10-11.869v1a1 1 0 0 0 1-1h-1Zm1-1.526a1 1 0 0 0-1-1v1h1Zm-22 0v-1a1 1 0 0 0-1 1h1Zm0 1.526h-1a1 1 0 0 0 1 1v-1Zm0 13.895h-1a1 1 0 0 0 1 1v-1ZM21.206 5.306h1a1 1 0 0 0-.622-.926l-.378.926ZM22.5 22.974h1a1 1 0 0 0-1-1v1Zm0 1.526v1a1 1 0 0 0 1-1h-1Zm-21-1.526v-1a1 1 0 0 0-1 1h1ZM12 1.54l.379-.925a1 1 0 0 0-.758 0L12 1.54ZM2.416 4.38a1 1 0 0 0-.622.926h1l-.378-.926Z"></path></svg>
                                                    банки
                                                </a>
<?php
$args1 = array(
    'posts_per_page' => 6,
    'post_type' => 'banks',
    'meta_key' => 'ratings_average',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
);

$banks_table = new WP_Query( $args1 );
if ( $banks_table->have_posts() ) : ?>
    <?php while ( $banks_table->have_posts() ) : $banks_table->the_post(); ?>
        <div class="navigation__sub-item"><a href="<?php echo the_permalink(); ?>" class="navigation__sub-link">
                <img loading="lazy" src="<?php echo the_field('bank_logo') ?>" alt="<?php echo the_title() ?>">
                <?php echo the_title() ?></a></div>
    <?php endwhile; ?>
    <!-- конец цикла -->
    <?php wp_reset_postdata(); //очищаем результат запроса?>
<?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="navigation__item">
                                    <a class="navigation__item-link">
                                        <div class="navigation__item-icon">
                                            <svg width="16" height="16" viewBox="0 0 17 17">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#news" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                        Журнал
                                        <div class="navigation__item-arrow">
                                            <svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                    </a>
                                    <div class="navigation__item-sub">
                                        <div class="container">
                                            <div class="navigation__sub">
                                                <a href="<?php echo get_category_link(9) ?>" class="navigation__sub-title">
                                                    <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17" xml:space="preserve"><path d="M14.1 17H1.5C.7 17 0 16.3 0 15.5v-14C0 .7.7 0 1.5 0h9.8c.8 0 1.5.7 1.5 1.5v.9h2.7c.8 0 1.5.6 1.5 1.5v9.8c0 1.1-.6 3.3-2.9 3.3zM12.8 3.4v10.3s0 2.3 1.4 2.3c1.8 0 1.9-2.1 1.9-2.3V3.9c0-.3-.2-.5-.5-.5h-2.8zM1.5 1c-.3 0-.5.2-.5.5v14c0 .3.2.5.5.5h10.9c-.5-.7-.6-1.7-.6-2.3V1.5c0-.3-.2-.5-.5-.5H1.5zm8.9 13.2H2.9c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h7.5c.3 0 .5.2.5.5s-.2.5-.5.5zm0-2.4H2.9c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h7.5c.3 0 .5.2.5.5s-.2.5-.5.5zm0-2.8H2.9c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h7.5c.3 0 .5.2.5.5s-.2.5-.5.5zm0-2.8H8c-.2 0-.5-.2-.5-.5s.3-.5.5-.5h2.4c.3 0 .5.2.5.5s-.2.5-.5.5zm-4.7 0H2.9c-.3 0-.5-.2-.5-.5V2.9c0-.3.2-.5.5-.5h2.8c.3 0 .5.2.5.5v2.8c0 .3-.2.5-.5.5zm-2.3-1h1.8V3.4H3.4v1.8zm7-1.4H8c-.3 0-.5-.2-.5-.5s.3-.5.5-.5h2.4c.3 0 .5.2.5.5s-.2.5-.5.5z"></path></svg>
                                                    журнал
                                                </a>
                                                <?php
                                                            $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'blog_block',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                            ); ?>
                                                            <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="navigation__item">
                                    <a class="navigation__item-link">
                                        <div class="navigation__item-icon">
                                            <svg width="16" height="16" viewBox="0 0 17 17">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#calc" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                        ЕЩЕ
                                        <div class="navigation__item-arrow">
                                            <svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                    </a>
                                    <div class="navigation__item-sub">
                                        <div class="container">
                                            <div class="navigation__sub">
                                                <a href="<?php echo get_page_link('149') ?>" class="navigation__sub-title">
                                                    <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17" xml:space="preserve"><path class="st0" d="M15.5 17h-14C.7 17 0 16.3 0 15.5v-14C0 .7.7 0 1.5 0h14c.8 0 1.5.7 1.5 1.5v14c0 .8-.7 1.5-1.5 1.5zM9 16h6.5c.3 0 .5-.2.5-.5V9H9v7zM1 9v6.5c0 .3.2.5.5.5H8V9H1zm8-1h7V1.5c0-.3-.2-.5-.5-.5H9v7zM1 8h7V1H1.5c-.3 0-.5.2-.5.5V8zm5 6.5c-.1 0-.3 0-.4-.1l-1.1-1.1-1.1 1.1c-.2.2-.5.2-.7 0s-.2-.5 0-.7l1.1-1.1-1.1-1.1c-.2-.2-.2-.5 0-.7s.5-.2.7 0l1.1 1.1 1.1-1.1c.2-.2.5-.2.7 0s.2.5 0 .7l-1.1 1.1 1.1 1.1c.2.2.2.5 0 .7 0 .1-.2.1-.3.1zm8-.5h-3c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h3c.3 0 .5.2.5.5s-.2.5-.5.5zm0-2h-3c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h3c.3 0 .5.2.5.5s-.2.5-.5.5zM4.5 6.5c-.3 0-.5-.2-.5-.5V5H3c-.3 0-.5-.2-.5-.5S2.7 4 3 4h1V3c0-.3.2-.5.5-.5s.5.2.5.5v1h1c.3 0 .5.2.5.5S6.3 5 6 5H5v1c0 .3-.2.5-.5.5zM14 5h-3c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h3c.3 0 .5.2.5.5s-.2.5-.5.5z"></path></svg>
                                                    калькуляторы
                                                </a>
                                                <?php
                                                            $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'calc',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                            ); ?>
                                                            <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!--li class="navigation__item">
                                    <a class="navigation__item-link" href="">
                                        <div class="navigation__item-icon">
                                            <svg width="18" height="18" viewBox="0 0 18 18">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" width="18" height="18" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                        Еще
                                        <div class="navigation__item-arrow">
                                            <svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                    </a>
                                    <div class="navigation__item-sub"></div>
                                </li-->
                            </ul>
                        </div>
                    </div>
                    <!-- / navigation -->
                </div>
            </div>

            <?php } ?>


            <div class="header__top header__normal ">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <div class="header__logo">
                            <a href="<?php echo get_home_url(); ?>" class="logo d-flex align-items-center">
                                <div class="logo__icon">
                                    <svg width="42" height="46" viewBox="0 0 42 46" xmlns="http://www.w3.org/2000/svg"><path d="m22.309 34.102 5.234-13.514h7.85L22.31 34.102ZM16.638 20.588 21 31.486l3.49-10.898h-7.852ZM19.255 34.102l-5.234-13.514h-7.85l13.084 13.514ZM6.17 18.408l3.053-6.103 4.798 6.103h-7.85ZM11.404 10.997l3.926 5.232 3.925-5.232h-7.85ZM16.638 18.408l3.926-5.231 3.925 5.231h-7.85ZM21.872 10.997l3.926 5.232 3.925-5.232h-7.85ZM27.106 18.408l4.798-6.103 3.054 6.103h-7.852Z"></path><path d="m22.309 34.102-.467-.18a.5.5 0 0 0 .826.528l-.36-.348Zm5.234-13.514v-.5a.5.5 0 0 0-.467.32l.467.18Zm7.85 0 .36.348a.5.5 0 0 0-.36-.848v.5ZM19.256 34.102l-.359.348a.5.5 0 0 0 .825-.529l-.466.18Zm-5.234-13.514.466-.18a.5.5 0 0 0-.466-.32v.5Zm-7.85 0v-.5a.5.5 0 0 0-.36.848l.36-.348Zm20.935-2.18-.393-.309a.5.5 0 0 0 .393.81v-.5Zm4.798-6.103.448-.224a.5.5 0 0 0-.84-.085l.392.31Zm3.054 6.103v.5a.5.5 0 0 0 .447-.724l-.447.224Zm-13.086-7.41v-.5a.5.5 0 0 0-.4.8l.4-.3Zm3.926 5.23-.4.3a.5.5 0 0 0 .8 0l-.4-.3Zm3.925-5.23.4.3a.5.5 0 0 0-.4-.8v.5Zm-18.319 0v-.5a.5.5 0 0 0-.4.8l.4-.3Zm3.926 5.23-.4.3a.5.5 0 0 0 .8 0l-.4-.3Zm3.925-5.23.4.3a.5.5 0 0 0-.4-.8v.5Zm-2.617 7.41-.4-.3a.5.5 0 0 0 .4.8v-.5Zm3.926-5.231.4-.3a.5.5 0 0 0-.8 0l.4.3Zm3.925 5.231v.5a.5.5 0 0 0 .4-.8l-.4.3Zm-7.85 2.18v-.5a.5.5 0 0 0-.465.685l.464-.185Zm4.36 10.898-.463.186a.5.5 0 0 0 .94-.034L21 31.486Zm3.49-10.898.476.152a.5.5 0 0 0-.476-.652v.5ZM6.17 18.408l-.447-.224a.5.5 0 0 0 .447.724v-.5Zm3.053-6.103.393-.309a.5.5 0 0 0-.84.085l.447.224Zm4.798 6.103v.5a.5.5 0 0 0 .393-.809l-.393.31Zm6.043-13.92a.5.5 0 1 0 1 0h-1Zm1-3.488a.5.5 0 0 0-1 0h1Zm17.465 7.9a.5.5 0 0 0 .707.707L38.53 8.9Zm3.324-1.908a.5.5 0 1 0-.706-.708l.706.708ZM2.763 9.607A.5.5 0 0 0 3.47 8.9l-.706.707ZM.854 6.284a.5.5 0 1 0-.706.708l.706-.708Zm7.852 28.171a.5.5 0 1 0-.707-.707l.707.707ZM5.38 36.364a.5.5 0 1 0 .707.707l-.707-.707Zm28.621-2.616a.5.5 0 0 0-.707.707l.707-.707Zm1.91 3.323a.5.5 0 0 0 .707-.707l-.706.707ZM21.5 41.077a.5.5 0 0 0-1 0h1ZM20.5 45a.5.5 0 0 0 1 0h-1Zm2.275-10.718 5.234-13.513-.933-.362-5.234 13.514.933.361Zm4.768-13.194h7.85v-1h-7.85v1Zm7.492-.848L21.949 33.754l.719.696 13.085-13.514-.718-.696ZM19.721 33.921l-5.235-13.514-.932.361 5.234 13.514.932-.36Zm-5.7-13.833H6.17v1h7.851v-1Zm-8.211.848L18.896 34.45l.718-.696L6.53 20.24l-.718.696ZM27.5 18.717l4.797-6.103-.786-.618-4.798 6.103.787.618Zm3.957-6.188 3.053 6.103.895-.448-3.053-6.103-.895.448Zm3.5 5.38h-7.85v1h7.85v-1Zm-13.485-6.611 3.926 5.23.8-.6-3.926-5.23-.8.6Zm4.726 5.23 3.925-5.23-.8-.6-3.925 5.23.8.6Zm3.525-6.03h-7.85v1h7.85v-1Zm-18.719.8 3.926 5.23.8-.6-3.926-5.23-.8.6Zm4.726 5.23 3.925-5.23-.8-.6-3.925 5.23.8.6Zm3.525-6.03h-7.85v1h7.85v-1Zm-2.217 8.21 3.926-5.231-.8-.6-3.926 5.231.8.6Zm3.126-5.231 3.925 5.231.8-.6-3.925-5.231-.8.6Zm4.325 4.431h-7.85v1h7.85v-1Zm-8.315 2.865 4.362 10.899.928-.372-4.362-10.898-.928.371Zm5.302 10.865 3.49-10.898-.953-.305-3.49 10.899.953.304Zm3.013-11.55h-7.85v1h7.85v-1ZM6.617 18.632l3.054-6.103-.895-.448-3.053 6.103.894.448Zm2.213-6.018 4.798 6.103.786-.618-4.798-6.103-.786.618Zm5.191 5.294h-7.85v1h7.85v-1Zm7.043-13.42V1h-1v3.487h1Zm18.172 5.12 2.617-2.616-.706-.708L38.53 8.9l.706.707ZM3.47 8.9.853 6.284l-.706.708 2.617 2.615.706-.707Zm4.528 24.848L5.38 36.364l.707.707 2.617-2.616-.707-.707Zm25.297.707 2.617 2.616.707-.707-2.617-2.616-.707.707ZM20.5 41.077V45h1v-3.923h-1Z"></path></svg>
                                </div>
                                Finabank
                            </a>
                            <div id="btn__submenu-back">
                                <svg width="18" height="12" viewBox="0 0 18 12">
                                    <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrowright" x="0" y="0"></use>
                                </svg>
                                Назад
                            </div>
                        </div>

                        <div class="header__bottom">
                            <div class="header__bottom-wrap">
                                <!-- search form -->
                                <div id="searchContainer" class="header__search">
                                    <div class="header__search-section">
                                        <form class="search-form" role="search" method="get" id="searchform" action="<?php echo home_url('/') ?>">
                                            <div class="container">
                                                <div class="header__search-form d-flex align-items-center">
                                                    <div class="header__search-icon"><svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.7575 14.5757C15.5232 14.3414 15.1433 14.3414 14.909 14.5757C14.6746 14.81 14.6746 15.1899 14.909 15.4243L15.7575 14.5757ZM18.2422 18.7575C18.4765 18.9919 18.8564 18.9919 19.0907 18.7575C19.325 18.5232 19.3251 18.1433 19.0907 17.909L18.2422 18.7575ZM14.909 15.4243L18.2422 18.7575L19.0907 17.909L15.7575 14.5757L14.909 15.4243ZM8.6665 15.2332C4.85574 15.2332 1.7665 12.144 1.7665 8.33325H0.566504C0.566504 12.8068 4.193 16.4333 8.6665 16.4333V15.2332ZM15.5665 8.33325C15.5665 12.144 12.4773 15.2332 8.6665 15.2332V16.4333C13.14 16.4333 16.7665 12.8068 16.7665 8.33325H15.5665ZM8.6665 1.43325C12.4773 1.43325 15.5665 4.52249 15.5665 8.33325H16.7665C16.7665 3.85974 13.14 0.233252 8.6665 0.233252V1.43325ZM8.6665 0.233252C4.193 0.233252 0.566504 3.85974 0.566504 8.33325H1.7665C1.7665 4.52249 4.85574 1.43325 8.6665 1.43325V0.233252Z"></path></svg></div>
                                                    <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" class="header__search-input form-control" placeholder="Поиск..." autocomplete="off">
                                                    <div class="btn__modal-close header__search-close" data-dismiss="modal"></div>
                                                </div>
                                            </div>
                                            <div id="result_search_ajax">

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="header__bottom-nav navigation">
                                    <ul class="navigation__container">
                                        <li class="navigation__item">
                                            <a class="navigation__item-link">
                                                <div class="navigation__item-icon">
                                                    <svg width="18" height="16" viewBox="0 0 18 16">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#credits" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                Кредиты
                                                <div class="navigation__item-arrow">
                                                    <svg width="12" height="6" viewBox="0 0 12 6">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                            </a>
                                            <!-- submenu -->
                                            <div class="navigation__item-sub">
                                                <div class="container">
                                                    <div class="navigation__sub">
                                                        <div class="row mx-md-n4">
                                                            <div class="col-12 col-md-6 px-md-4 navigation__sub-col">
                                                                <a href="<?php echo get_post_type_archive_link('kredity') ?>" class="navigation__sub-title">
                                                                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M13.4444 11.6667v.5c.2762 0 .5-.2239.5-.5h-.5Zm-.8888 0h-.5c0 .2761.2238.5.5.5v-.5Zm0-.8889v-.5c-.2762 0-.5.2238-.5.5h.5Zm.8888 0h.5c0-.2762-.2238-.5-.5-.5v.5ZM3.66667 3.61111c-.27615 0-.5.22386-.5.5s.22385.5.5.5v-1Zm10.66663 1c.2762 0 .5-.22386.5-.5s-.2238-.5-.5-.5v1ZM15 16.5H3v1h12v-1ZM3 1.5h12v-1H3v1ZM1.5 15.0013V6.33333h-1V15.0013h1Zm0-8.66797V2.9993h-1V6.33333h1ZM16.5 3v3.44444h1V3h-1Zm0 3.44444V15h1V6.44444h-1ZM.562921 6.57616C1.24349 7.80118 2.74527 8.3332 4.37628 8.53443c1.66489.20541 3.64323.08858 5.51998-.14952 1.88264-.23884 3.69134-.60356 5.02724-.90781.6686-.15227 1.2202-.28973 1.6053-.38928.1926-.04979.3435-.09012.4468-.1181.0516-.01399.0913-.0249.1182-.03237.0135-.00373.0238-.0066.0308-.00857.0036-.00098.0063-.00174.0081-.00226.001-.00027.0017-.00047.0022-.00062.0003-.00007.0005-.00013.0006-.00017.0002-.00005.0003-.00009-.1355-.48129-.1358-.48119-.1358-.4812-.1358-.48119-.0001.00002-.0002.00005-.0004.00009l-.0015.00045c-.0015.00041-.0038.00105-.0069.00193-.0063.00174-.0157.00438-.0284.00789-.0253.007-.0633.01744-.1131.03095-.0997.02703-.2469.06635-.4354.11509-.3771.09749-.9192.2326-1.577.38242-1.3169.29992-3.0916.65742-4.9311.89079-1.84547.23413-3.72824.33952-5.27168.1491-1.57732-.19461-2.6311-.67648-3.06164-1.45145l-.874159.48565ZM13.4444 11.1667h-.8888v1h.8888v-1Zm-.3888.5v-.8889h-1v.8889h1Zm-.5-.3889h.8888v-1h-.8888v1Zm.3888-.5v.8889h1v-.8889h-1ZM3.66667 4.61111H14.3333v-1H3.66667v1ZM15 1.5c.8284 0 1.5.67157 1.5 1.5h1c0-1.38071-1.1193-2.5-2.5-2.5v1ZM3 .5C1.61952.5.5 1.61836.5 2.9993h1C1.5 2.1711 2.17134 1.5 3 1.5v-1Zm0 16c-.82887 0-1.5-.6707-1.5-1.4987h-1C.5 16.3825 1.61973 17.5 3 17.5v-1Zm12 1c1.3807 0 2.5-1.1193 2.5-2.5h-1c0 .8284-.6716 1.5-1.5 1.5v1Z"></path></svg>
                                                                    потребительские
                                                                </a>
                                                                <?php
                                                                $massiv_vhodnih_parametrov = array(
                                                                    'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                                    'depth' => 0,  // - глубина, уровень вложенности
                                                                    'echo'            => false,
                                                                    'link_class'   => 'navigation__sub-link',
                                                                    'theme_location'  => 'kred_left',
                                                                    'before' => '<div class="navigation__sub-item">',
                                                                    'after' => '</div>',
                                                                ); ?>
                                                                <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                            </div>
                                                            <!--div class="col-12 col-md-6 px-md-4 navigation__sub-col">
                                                        <a href="<?php echo get_post_type_archive_link('ipoteka') ?>" class="navigation__sub-title">
                                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 15c-.276142 0-.5.2239-.5.5s.223858.5.5.5v-1Zm16 1c.2761 0 .5-.2239.5-.5s-.2239-.5-.5-.5v1ZM5.64645 13.1464c-.19527.1953-.19527.5119 0 .7072.19526.1952.51184.1952.7071 0l-.7071-.7072Zm6.70715-5.29285c.1952-.19526.1952-.51184 0-.7071-.1953-.19527-.5119-.19527-.7072 0l.7072.7071ZM4 5.5l.35355.35355L4 5.5ZM4 1V.5c-.27614 0-.5.223858-.5.5H4Zm2 0h.5c0-.276142-.22386-.5-.5-.5V1Zm3.70711.20711-.35356.35355.35356-.35355Zm6.43929 6.43934L15.7929 8l.3535-.35355ZM15 16h2v-1h-2v1Zm.5-.5V8.75h-1v6.75h1ZM15.25 9h.5429V8H15.25v1Zm1.25-1.70711L10.0607.853553l-.70715.707107L15.7929 8l.7071-.70711ZM2.20711 9H2.75V8h-.54289v1ZM1 16h2v-1H1v1Zm2 0h12v-1H3v1Zm-.5-7.25v6.75h1V8.75h-1Zm3.85355 5.1036 6.00005-6.00005-.7072-.7071-5.99995 5.99995.7071.7072Zm-2.7071-8.70715L1.5 7.29289 2.20711 8l2.14644-2.14645-.7071-.7071ZM4.5 5.5V1h-1v4.5h1Zm-.5-4h2v-1H4v1ZM7.93934.853553 5.64645 3.14645l.7071.7071 2.2929-2.29289-.70711-.707107ZM5.64645 3.14645l-2 2 .7071.7071 2-2-.7071-.7071ZM5.5 1v2.5h1V1h-1Zm7 11.5c0-.8284-.6716-1.5-1.5-1.5v1c.2761 0 .5.2239.5.5h1ZM11 14c.8284 0 1.5-.6716 1.5-1.5h-1c0 .2761-.2239.5-.5.5v1Zm-1.5-1.5c0 .8284.6716 1.5 1.5 1.5v-1c-.2761 0-.5-.2239-.5-.5h-1Zm1 0c0-.2761.2239-.5.5-.5v-1c-.8284 0-1.5.6716-1.5 1.5h1Zm-2-4C8.5 7.67157 7.82843 7 7 7v1c.27614 0 .5.22386.5.5h1ZM2.75 9c-.13807 0-.25-.11193-.25-.25h1c0-.41421-.33579-.75-.75-.75v1ZM7 10c.82843 0 1.5-.67157 1.5-1.5h-1c0 .27614-.22386.5-.5.5v1ZM2.20711 8 1.5 7.29289C.870036 7.92286 1.3162 9 2.20711 9V8ZM5.5 8.5c0 .82843.67157 1.5 1.5 1.5V9c-.27614 0-.5-.22386-.5-.5h-1ZM10.0607.853553c-.58583-.585787-1.53557-.585786-2.12136 0l.70711.707107c.19526-.19526.51184-.19526.7071 0l.70715-.707107ZM6.5 8.5c0-.27614.22386-.5.5-.5V7c-.82843 0-1.5.67157-1.5 1.5h1Zm9.2929.5c.8909 0 1.3371-1.07714.7071-1.70711L15.7929 8v1ZM15.5 8.75c0 .13807-.1119.25-.25.25V8c-.4142 0-.75.33579-.75.75h1Z"></path></svg>
                                                            Ипотека
                                                        </a>
                                                        <?php
                                                            $massiv_vhodnih_parametrov = array(
                                                                'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                                'depth' => 0,  // - глубина, уровень вложенности
                                                                'echo'            => false,
                                                                'link_class'   => 'navigation__sub-link',
                                                                'theme_location'  => 'kred_right',
                                                                'before' => '<div class="navigation__sub-item">',
                                                                'after' => '</div>',
                                                            ); ?>

                                                            <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                    </div-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / submenu -->
                                        </li>
                                        <li class="navigation__item">
                                            <a class="navigation__item-link" >
                                                <div class="navigation__item-icon">
                                                    <svg width="18" height="16" viewBox="0 0 18 16">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#cards" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                карты
                                                <div class="navigation__item-arrow">
                                                    <svg width="12" height="6" viewBox="0 0 12 6">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                            </a>
                                            <!-- submenu -->
                                            <div class="navigation__item-sub">
                                                <div class="container">
                                                    <div class="navigation__sub">
                                                        <div class="row mx-md-n4">
                                                            <div class="col-12 col-md-4 col-lg-4 px-md-4 navigation__sub-col">
                                                                <a href="<?php echo get_term_link(7, '') ?>" class="navigation__sub-title">
                                                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 29.5 26" style="enable-background:new 0 0 29.5 26" xml:space="preserve"><path d="M26.2 4.6h-2.7l-2-3.3C20.8 0 19.2-.4 18 .4l-7.1 4.2H3.3C1.5 4.6 0 6.1 0 7.9v14.8C0 24.5 1.5 26 3.3 26h22.9c1.8 0 3.3-1.5 3.3-3.3V7.9c0-1.8-1.5-3.3-3.3-3.3zm-7.8-2.9c.7-.4 1.7-.2 2.1.5l4.9 8.2c.4.7.2 1.7-.5 2.1l-10.2 6H7.9L4 11.9c-.4-.7-.2-1.7.5-2.1l13.9-8.1zM1.3 7.9c0-1.1.9-2 2-2h5.3l-5 3c-1.2.7-1.6 2.2-.9 3.4l3.7 6.2H1.3V7.9zm26.9 14.8c0 1.1-.9 2-2 2H3.3c-1.1 0-2-.9-2-2v-2.8h26.9v2.8zm0-4.1h-11l8.6-5.1c1.2-.7 1.6-2.3.9-3.5l-2.5-4.2h1.9c1.1 0 2 .9 2 2v10.8z"></path><path d="M8.2 14.7h-.3c-.3-.1-.6-.3-.8-.6l-1-1.7c-.4-.6-.1-1.4.5-1.8l3-1.8c.3-.2.7-.2 1-.1.3.1.6.3.8.6l1 1.7c.4.6.1 1.4-.5 1.8l-3 1.8c-.2 0-.5.1-.7.1zm-1-3.1 1 1.8 3-1.8-1-1.8-3 1.8z"></path></svg>
                                                                    дебетовые карты
                                                                </a>
                                                                <?php
                                                                $massiv_vhodnih_parametrov = array(
                                                                    'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                                    'depth' => 0,  // - глубина, уровень вложенности
                                                                    'echo'            => false,
                                                                    'link_class'   => 'navigation__sub-link',
                                                                    'theme_location'  => 'card_left',
                                                                    'before' => '<div class="navigation__sub-item">',
                                                                    'after' => '</div>',
                                                                ); ?>
                                                                <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                            </div>
                                                            <div class="col-12 col-md-4 col-lg-4 px-md-4 navigation__sub-col">
                                                                <a href="<?php echo get_term_link(2, '') ?>" class="navigation__sub-title">
                                                                    <svg width="18" height="16" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 30.5 27" style="enable-background:new 0 0 30.5 27" xml:space="preserve">
                                                                <path d="M9.9 22.7c0-.4-.3-.7-.7-.7v1.3c.4 0 .7-.3.7-.6zM3.9 22h5.3v1.3H3.9z"></path>
                                                                        <path d="M3.9 23.3V22c-.4 0-.7.3-.7.7.1.3.4.6.7.6z"></path>
                                                                        <path d="M30.4 15.3 28.3 2.7c-.1-.9-.6-1.6-1.3-2.1-.7-.5-1.6-.7-2.4-.6L4.7 3.4c-1.8.3-3 2-2.7 3.8l.1.7C.9 8.4 0 9.6 0 11v12.7C0 25.5 1.5 27 3.3 27h20.1c1.8 0 3.3-1.5 3.3-3.3v-4.5l1.2-.2c.9-.1 1.6-.6 2.1-1.3.4-.7.6-1.6.4-2.4zm-5.1 8.4c0 1.1-.9 2-2 2h-20c-1.1 0-2-.9-2-2v-6.5h24v6.5zm0-7.8h-24v-2.8h24v2.8zm0-4.1h-24V11c0-1.1.9-2 2-2h20.1c1.1 0 2 .9 2 2v.8zm3.5 5.1c-.3.4-.8.7-1.3.8l-1 .2V11c0-1.8-1.5-3.3-3.3-3.3H3.5L3.4 7c-.2-1.1.5-2.1 1.6-2.3l19.8-3.4c1.1-.2 2.1.5 2.3 1.6l2.1 12.5c0 .6-.1 1.1-.4 1.5z"></path>
                                                            </svg>
                                                                    кредитные карты
                                                                </a>
                                                                <?php
                                                                $massiv_vhodnih_parametrov = array(
                                                                    'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                                    'depth' => 0,  // - глубина, уровень вложенности
                                                                    'echo'            => false,
                                                                    'link_class'   => 'navigation__sub-link',
                                                                    'theme_location'  => 'card_center',
                                                                    'before' => '<div class="navigation__sub-item">',
                                                                    'after' => '</div>',
                                                                ); ?>
                                                                <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                            </div>
                                                            <div class="col-12 col-md-4 col-lg-4 px-md-4 navigation__sub-col">
                                                                <a href="<?php echo get_term_link(8, '') ?>" class="navigation__sub-title">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="20" height="20" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24" xml:space="preserve"><path class="st1" d="M8.8 15.5c-.2 0-.4-.1-.5-.3L5.8 9.1c-.1-.3 0-.5.3-.7.3-.1.5 0 .7.3l2.6 6.1c.1.3 0 .5-.3.7h-.3zM10 11.5c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5 1.5.7 1.5 1.5-.7 1.5-1.5 1.5zm0-2c-.3 0-.5.2-.5.5s.2.5.5.5.5-.2.5-.5-.2-.5-.5-.5zM5 15.5c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5 1.5.7 1.5 1.5-.7 1.5-1.5 1.5zm0-2c-.3 0-.5.2-.5.5s.2.5.5.5.5-.2.5-.5-.2-.5-.5-.5z"/><path class="st1" d="M21.5 4.5h-7v-3c0-.3-.2-.6-.4-.7-.3-.2-.6-.2-.9-.1l-1.4.6-1.6-.7C9.8.4 9.4.4 9.1.6l-1.6.7L5.9.6C5.5.4 5.1.4 4.8.6l-1.6.7L1.8.7C1.5.6 1.2.6.9.8c-.2.1-.4.4-.4.7v21c0 .3.2.6.4.7.3.2.6.2.9.1l1.4-.6 1.6.7c.4.2.8.2 1.1 0l1.6-.7 1.6.7c.2.1.4.1.6.1.2 0 .4 0 .6-.1l1.6-.7 1.4.6c.3.1.6.1.9-.1.2-.2.4-.4.4-.7v-3h7c1.1 0 2-.9 2-2v-11c-.1-1.1-1-2-2.1-2zm-8 17.8-1.5-.6c-.1-.1-.3-.1-.4 0l-1.8.8h-.3l-1.8-.8h-.4l-1.8.8h-.3l-1.8-.8c-.1-.1-.3-.1-.4 0l-1.5.7V1.7l1.5.6c.1.1.3.1.4 0l1.8-.8h.3l1.8.8c.1.1.3.1.4 0l1.8-.8h.3l1.8.8c.1.1.3.1.4 0l1.5-.7v20.7zm9-4.8c0 .5-.5 1-1 1h-7v-6.6h8v5.6zm0-6.6h-8V8.7h8v2.2zm0-3.2h-8V5.5h7c.5 0 1 .5 1 1v1.2z"/></svg>
                                                                    карты рассрочки
                                                                </a>
                                                                <?php
                                                                $massiv_vhodnih_parametrov = array(
                                                                    'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                                    'depth' => 0,  // - глубина, уровень вложенности
                                                                    'echo'            => false,
                                                                    'link_class'   => 'navigation__sub-link',
                                                                    'theme_location'  => 'card_right',
                                                                    'before' => '<div class="navigation__sub-item">',
                                                                    'after' => '</div>',
                                                                ); ?>
                                                                <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / submenu -->
                                        </li>
                                        <li class="navigation__item">
                                            <a class="navigation__item-link">
                                                <div class="navigation__item-icon">
                                                    <svg width="16" height="22" viewBox="0 0 16 22">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#loans" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                займы
                                                <div class="navigation__item-arrow">
                                                    <svg width="12" height="6" viewBox="0 0 12 6">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                            </a>
                                            <div class="navigation__item-sub">
                                                <div class="container">
                                                    <div class="navigation__sub">
                                                        <div class="row mx-md-n4">
                                                            <div class="col-12 col-md-6 col-lg-4 px-md-4 navigation__sub-col">
                                                                <a href="<?php echo get_post_type_archive_link('zaimy') ?>" class="navigation__sub-title">
                                                                    <svg width="24" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 17" xml:space="preserve"><path d="M14.6 17c-4.6 0-8.4-3.8-8.4-8.5S10 0 14.6 0C19.2 0 23 3.8 23 8.5S19.2 17 14.6 17zm0-16c-4.1 0-7.4 3.4-7.4 7.5s3.3 7.5 7.4 7.5S22 12.6 22 8.5 18.7 1 14.6 1zm2.3 10.9c-.1 0-.3 0-.4-.1l-2.3-2.3c-.1-.1-.1-.2-.1-.4v-4c0-.3.2-.5.5-.5s.5.2.5.5v3.8l2.1 2.1c.2.2.2.5 0 .7-.1.1-.2.2-.3.2zM5 11.3H2.8c-.3 0-.5-.2-.5-.5s.2-.5.5-.5H5c.3 0 .5.2.5.5s-.2.5-.5.5zM5 9H.5C.2 9 0 8.8 0 8.5S.2 8 .5 8H5c.3 0 .5.2.5.5S5.3 9 5 9zm0-2.3H2.8c-.3 0-.5-.2-.5-.5s.2-.5.5-.5H5c.3 0 .5.2.5.5s-.2.5-.5.5z"></path></svg>
                                                                    Микрозаймы
                                                                </a>
                                                                <?php
                                                                $massiv_vhodnih_parametrov = array(
                                                                    'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                                    'depth' => 0,  // - глубина, уровень вложенности
                                                                    'echo'            => false,
                                                                    'link_class'   => 'navigation__sub-link',
                                                                    'theme_location'  => 'zaim_left',
                                                                    'before' => '<div class="navigation__sub-item">',
                                                                    'after' => '</div>',
                                                                ); ?>
                                                                <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                            </div>
                                                            <div class="col-12 col-md-6 px-md-4 navigation__sub-col">
                                                                <a href="<?php echo get_post_type_archive_link('zaimy') ?>" class="navigation__sub-title">
                                                                    <svg width="16" height="18" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg"><path d="M21.706 8.579v.5h.5v-.5h-.5Zm-15.53 2.526v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.294 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.295 0h-.5a.5.5 0 0 0 .5.5v-.5Zm14.236-8.842v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.295 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.294 0h-.5a.5.5 0 0 0 .5.5v-.5Zm.983-15.104.19-.463-.19.463Zm-9.584-3.766L12 1.54l-.19-.463Zm.378 0L12 1.54l.19-.463ZM2.605 4.843l-.19-.463.19.463Zm19.1 3.236H2.296v1h19.41v-1ZM2.796 5.306 12 1.54l-.379-.925L2.416 4.38l.378.926ZM12 1.54l9.206 3.766.378-.926L12.38.615 12 1.54ZM2.794 8.58V6.143h-1v2.436h1Zm0-2.436v-.837h-1v.837h1Zm18.412-.837v.837h1v-.837h-1Zm0 .837v2.436h1V6.143h-1Zm-18.912.5h19.412v-1H2.294v1Zm1.294 12.804H2.294v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027H6.176v1h1.295v-1Zm10.352 0H16.53v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027h-1.294v1h1.294v-1Zm0 3.527h.794v-1h-.794v1Zm.794 0V24.5h1v-1.526h-1Zm0 1.526h-21v1h21v-1Zm-21 0v-1.526h-1V24.5h1Zm0-1.526h.794v-1H1.5v1Zm2.088-12.369H1.5v1h2.088v-1Zm-2.088 0V9.08h-1v1.526h1Zm21-1.526v1.526h1V9.08h-1Zm0 1.526h-2.088v1H22.5v-1ZM1.5 9.08h.794v-1H1.5v1Zm.794 0H22.5v-1H2.294v1Zm3.382 2.026v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1Zm15.824-8.842v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1ZM7.47 22.974H12v-1H7.47v1Zm4.529 0h4.53v-1H12v1ZM6.176 11.605H12v-1H6.176v1Zm5.824 0h5.823v-1H12v1Zm.5 10.869V11.105h-1v11.369h1Zm10-11.869v1a1 1 0 0 0 1-1h-1Zm1-1.526a1 1 0 0 0-1-1v1h1Zm-22 0v-1a1 1 0 0 0-1 1h1Zm0 1.526h-1a1 1 0 0 0 1 1v-1Zm0 13.895h-1a1 1 0 0 0 1 1v-1ZM21.206 5.306h1a1 1 0 0 0-.622-.926l-.378.926ZM22.5 22.974h1a1 1 0 0 0-1-1v1Zm0 1.526v1a1 1 0 0 0 1-1h-1Zm-21-1.526v-1a1 1 0 0 0-1 1h1ZM12 1.54l.379-.925a1 1 0 0 0-.758 0L12 1.54ZM2.416 4.38a1 1 0 0 0-.622.926h1l-.378-.926Z"></path></svg>
                                                                    мфо
                                                                </a>
                                                                <?php
                                                                $massiv_vhodnih_parametrov = array(
                                                                    'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                                    'depth' => 0,  // - глубина, уровень вложенности
                                                                    'echo'            => false,
                                                                    'link_class'   => 'navigation__sub-link',
                                                                    'theme_location'  => 'zaim_right',
                                                                    'before' => '<div class="navigation__sub-item">',
                                                                    'after' => '</div>',
                                                                ); ?>
                                                                <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="navigation__item">
                                            <a class="navigation__item-link">
                                                <div class="navigation__item-icon">
                                                    <svg width="16" height="18" viewBox="0 0 16 18">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#banks" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                Банки
                                                <div class="navigation__item-arrow">
                                                    <svg width="12" height="6" viewBox="0 0 12 6">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                            </a>
                                            <div class="navigation__item-sub">
                                                <div class="container">
                                                    <div class="navigation__sub">
                                                        <a href="<?php echo get_post_type_archive_link('banks') ?>" class="navigation__sub-title">
                                                            <svg width="16" height="18" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg"><path d="M21.706 8.579v.5h.5v-.5h-.5Zm-15.53 2.526v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.294 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.295 0h-.5a.5.5 0 0 0 .5.5v-.5Zm14.236-8.842v-.5a.5.5 0 0 0-.5.5h.5Zm-2.588 0h.5a.5.5 0 0 0-.5-.5v.5Zm0 8.842v.5a.5.5 0 0 0 .5-.5h-.5Zm-1.295 0v-.5a.5.5 0 0 0-.5.5h.5Zm0 2.527v.5a.5.5 0 0 0 .5-.5h-.5Zm5.177 0h-.5a.5.5 0 0 0 .5.5v-.5Zm0-2.527h.5a.5.5 0 0 0-.5-.5v.5Zm-1.294 0h-.5a.5.5 0 0 0 .5.5v-.5Zm.983-15.104.19-.463-.19.463Zm-9.584-3.766L12 1.54l-.19-.463Zm.378 0L12 1.54l.19-.463ZM2.605 4.843l-.19-.463.19.463Zm19.1 3.236H2.296v1h19.41v-1ZM2.796 5.306 12 1.54l-.379-.925L2.416 4.38l.378.926ZM12 1.54l9.206 3.766.378-.926L12.38.615 12 1.54ZM2.794 8.58V6.143h-1v2.436h1Zm0-2.436v-.837h-1v.837h1Zm18.412-.837v.837h1v-.837h-1Zm0 .837v2.436h1V6.143h-1Zm-18.912.5h19.412v-1H2.294v1Zm1.294 12.804H2.294v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027H6.176v1h1.295v-1Zm10.352 0H16.53v1h1.294v-1Zm-1.794.5v2.527h1v-2.527h-1Zm6.177 2.527v-2.527h-1v2.527h1Zm-.5-3.027h-1.294v1h1.294v-1Zm0 3.527h.794v-1h-.794v1Zm.794 0V24.5h1v-1.526h-1Zm0 1.526h-21v1h21v-1Zm-21 0v-1.526h-1V24.5h1Zm0-1.526h.794v-1H1.5v1Zm2.088-12.369H1.5v1h2.088v-1Zm-2.088 0V9.08h-1v1.526h1Zm21-1.526v1.526h1V9.08h-1Zm0 1.526h-2.088v1H22.5v-1ZM1.5 9.08h.794v-1H1.5v1Zm.794 0H22.5v-1H2.294v1Zm3.382 2.026v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1Zm15.824-8.842v8.842h1v-8.842h-1Zm-1.588 8.842v-8.842h-1v8.842h1ZM7.47 22.974H12v-1H7.47v1Zm4.529 0h4.53v-1H12v1ZM6.176 11.605H12v-1H6.176v1Zm5.824 0h5.823v-1H12v1Zm.5 10.869V11.105h-1v11.369h1Zm10-11.869v1a1 1 0 0 0 1-1h-1Zm1-1.526a1 1 0 0 0-1-1v1h1Zm-22 0v-1a1 1 0 0 0-1 1h1Zm0 1.526h-1a1 1 0 0 0 1 1v-1Zm0 13.895h-1a1 1 0 0 0 1 1v-1ZM21.206 5.306h1a1 1 0 0 0-.622-.926l-.378.926ZM22.5 22.974h1a1 1 0 0 0-1-1v1Zm0 1.526v1a1 1 0 0 0 1-1h-1Zm-21-1.526v-1a1 1 0 0 0-1 1h1ZM12 1.54l.379-.925a1 1 0 0 0-.758 0L12 1.54ZM2.416 4.38a1 1 0 0 0-.622.926h1l-.378-.926Z"></path></svg>
                                                            банки
                                                        </a>
                                                        <?php
                                                        $args1 = array(
                                                            'posts_per_page' => 6,
                                                            'post_type' => 'banks',
                                                            'meta_key' => 'ratings_average',
                                                            'orderby' => 'meta_value_num',
                                                            'order' => 'DESC',
                                                        );

                                                        $banks_table = new WP_Query( $args1 );
                                                        if ( $banks_table->have_posts() ) : ?>
                                                            <?php while ( $banks_table->have_posts() ) : $banks_table->the_post(); ?>
                                                                <div class="navigation__sub-item"><a href="<?php echo the_permalink(); ?>" class="navigation__sub-link">
                                                                        <img loading="lazy" src="<?php echo the_field('bank_logo') ?>" alt="<?php echo the_title() ?>">
                                                                        <?php echo the_title() ?></a></div>
                                                            <?php endwhile; ?>
                                                            <!-- конец цикла -->
                                                            <?php wp_reset_postdata(); //очищаем результат запроса?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="navigation__item">
                                            <a class="navigation__item-link">
                                                <div class="navigation__item-icon">
                                                    <svg width="16" height="16" viewBox="0 0 17 17">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#news" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                Журнал
                                                <div class="navigation__item-arrow">
                                                    <svg width="12" height="6" viewBox="0 0 12 6">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                            </a>
                                            <div class="navigation__item-sub">
                                                <div class="container">
                                                    <div class="navigation__sub">
                                                        <a href="<?php echo get_category_link(9) ?>" class="navigation__sub-title">
                                                            <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17" xml:space="preserve"><path d="M14.1 17H1.5C.7 17 0 16.3 0 15.5v-14C0 .7.7 0 1.5 0h9.8c.8 0 1.5.7 1.5 1.5v.9h2.7c.8 0 1.5.6 1.5 1.5v9.8c0 1.1-.6 3.3-2.9 3.3zM12.8 3.4v10.3s0 2.3 1.4 2.3c1.8 0 1.9-2.1 1.9-2.3V3.9c0-.3-.2-.5-.5-.5h-2.8zM1.5 1c-.3 0-.5.2-.5.5v14c0 .3.2.5.5.5h10.9c-.5-.7-.6-1.7-.6-2.3V1.5c0-.3-.2-.5-.5-.5H1.5zm8.9 13.2H2.9c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h7.5c.3 0 .5.2.5.5s-.2.5-.5.5zm0-2.4H2.9c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h7.5c.3 0 .5.2.5.5s-.2.5-.5.5zm0-2.8H2.9c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h7.5c.3 0 .5.2.5.5s-.2.5-.5.5zm0-2.8H8c-.2 0-.5-.2-.5-.5s.3-.5.5-.5h2.4c.3 0 .5.2.5.5s-.2.5-.5.5zm-4.7 0H2.9c-.3 0-.5-.2-.5-.5V2.9c0-.3.2-.5.5-.5h2.8c.3 0 .5.2.5.5v2.8c0 .3-.2.5-.5.5zm-2.3-1h1.8V3.4H3.4v1.8zm7-1.4H8c-.3 0-.5-.2-.5-.5s.3-.5.5-.5h2.4c.3 0 .5.2.5.5s-.2.5-.5.5z"></path></svg>
                                                            журнал
                                                        </a>
                                                        <?php
                                                        $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'blog_block',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                        ); ?>
                                                        <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="navigation__item">
                                            <a class="navigation__item-link">
                                                <div class="navigation__item-icon">
                                                    <svg width="16" height="16" viewBox="0 0 17 17">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#calc" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                                еще
                                                <div class="navigation__item-arrow">
                                                    <svg width="12" height="6" viewBox="0 0 12 6">
                                                        <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" x="0" y="0"></use>
                                                    </svg>
                                                </div>
                                            </a>
                                            <div class="navigation__item-sub">
                                                <div class="container">
                                                    <div class="navigation__sub">
                                                        <a href="<?php echo get_page_link('149') ?>" class="navigation__sub-title">
                                                            <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17" xml:space="preserve"><path class="st0" d="M15.5 17h-14C.7 17 0 16.3 0 15.5v-14C0 .7.7 0 1.5 0h14c.8 0 1.5.7 1.5 1.5v14c0 .8-.7 1.5-1.5 1.5zM9 16h6.5c.3 0 .5-.2.5-.5V9H9v7zM1 9v6.5c0 .3.2.5.5.5H8V9H1zm8-1h7V1.5c0-.3-.2-.5-.5-.5H9v7zM1 8h7V1H1.5c-.3 0-.5.2-.5.5V8zm5 6.5c-.1 0-.3 0-.4-.1l-1.1-1.1-1.1 1.1c-.2.2-.5.2-.7 0s-.2-.5 0-.7l1.1-1.1-1.1-1.1c-.2-.2-.2-.5 0-.7s.5-.2.7 0l1.1 1.1 1.1-1.1c.2-.2.5-.2.7 0s.2.5 0 .7l-1.1 1.1 1.1 1.1c.2.2.2.5 0 .7 0 .1-.2.1-.3.1zm8-.5h-3c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h3c.3 0 .5.2.5.5s-.2.5-.5.5zm0-2h-3c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h3c.3 0 .5.2.5.5s-.2.5-.5.5zM4.5 6.5c-.3 0-.5-.2-.5-.5V5H3c-.3 0-.5-.2-.5-.5S2.7 4 3 4h1V3c0-.3.2-.5.5-.5s.5.2.5.5v1h1c.3 0 .5.2.5.5S6.3 5 6 5H5v1c0 .3-.2.5-.5.5zM14 5h-3c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h3c.3 0 .5.2.5.5s-.2.5-.5.5z"></path></svg>
                                                            калькуляторы
                                                        </a>
                                                        <?php
                                                        $massiv_vhodnih_parametrov = array(
                                                            'container' => '', // - без предварительной обёртки тегом(можно написать 'nav')
                                                            'depth' => 0,  // - глубина, уровень вложенности
                                                            'echo'            => false,
                                                            'link_class'   => 'navigation__sub-link',
                                                            'theme_location'  => 'calc',
                                                            'before' => '<div class="navigation__sub-item">',
                                                            'after' => '</div>',
                                                        ); ?>
                                                        <?php echo strip_tags(wp_nav_menu( $massiv_vhodnih_parametrov ), '<div><a>,' ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <!--li class="navigation__item">
                                    <a class="navigation__item-link" href="">
                                        <div class="navigation__item-icon">
                                            <svg width="18" height="18" viewBox="0 0 18 18">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#circledots" width="18" height="18" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                        Еще
                                        <div class="navigation__item-arrow">
                                            <svg width="12" height="6" viewBox="0 0 12 6">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#arrow" width="12" height="6" x="0" y="0"></use>
                                            </svg>
                                        </div>
                                    </a>
                                    <div class="navigation__item-sub"></div>
                                </li-->
                                    </ul>
                                </div>
                            </div>
                        </div>




                        <div class="header__links d-flex align-items-center ml-auto">
                            <div class="header__links-item d-none d-md-block">
                                <button id="btn__search" class="btn__modal-show d-flex align-items-center" data-target="searchContainer">
                                    <div class="header__links-icon ">

                                        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.7575 14.5757C15.5232 14.3414 15.1433 14.3414 14.909 14.5757C14.6746 14.81 14.6746 15.1899 14.909 15.4243L15.7575 14.5757ZM18.2422 18.7575C18.4765 18.9919 18.8564 18.9919 19.0907 18.7575C19.325 18.5232 19.3251 18.1433 19.0907 17.909L18.2422 18.7575ZM14.909 15.4243L18.2422 18.7575L19.0907 17.909L15.7575 14.5757L14.909 15.4243ZM8.6665 15.2332C4.85574 15.2332 1.7665 12.144 1.7665 8.33325H0.566504C0.566504 12.8068 4.193 16.4333 8.6665 16.4333V15.2332ZM15.5665 8.33325C15.5665 12.144 12.4773 15.2332 8.6665 15.2332V16.4333C13.14 16.4333 16.7665 12.8068 16.7665 8.33325H15.5665ZM8.6665 1.43325C12.4773 1.43325 15.5665 4.52249 15.5665 8.33325H16.7665C16.7665 3.85974 13.14 0.233252 8.6665 0.233252V1.43325ZM8.6665 0.233252C4.193 0.233252 0.566504 3.85974 0.566504 8.33325H1.7665C1.7665 4.52249 4.85574 1.43325 8.6665 1.43325V0.233252Z"></path></svg>
                                    </div>
                                    <div class="header__links-txt">Поиск</div>
                                </button>
                            </div>
                            <div class="header__links-item">
                                <a href="<?php echo get_page_link('380') ?>" class="d-flex align-items-center header-compare-link">
                                    <div class="header__links-icon ">
                                        <svg width="21" height="22" viewBox="0 0 21 22" xmlns="http://www.w3.org/2000/svg"><path d="m2.79 19.939.294-.404-.294.404Zm-1.229-1.23.405-.293-.405.294Zm17.878 0-.404-.293.404.294Zm-1.23 1.23-.293-.404.294.404Zm0-17.878-.293.405.294-.405Zm1.23 1.23-.404.293.404-.294ZM2.79 2.06l.294.405-.294-.405Zm-1.229 1.23.405.293-.405-.294Zm13.883 6.598a.5.5 0 1 0-1 0h1Zm-1 6.667a.5.5 0 0 0 1 0h-1ZM11 5.444a.5.5 0 0 0-1 0h1Zm-1 11.112a.5.5 0 0 0 1 0h-1ZM6.556 12.11a.5.5 0 0 0-1 0h1Zm-1 4.445a.5.5 0 0 0 1 0h-1ZM10.5 20.5c-2.094 0-3.625 0-4.816-.13-1.181-.128-1.97-.377-2.6-.835l-.588.808c.83.603 1.814.884 3.08 1.021 1.258.137 2.852.136 4.924.136v-1ZM0 11c0 2.072 0 3.666.136 4.924.137 1.266.418 2.25 1.02 3.08l.81-.588c-.459-.63-.708-1.419-.836-2.6C1 14.625 1 13.094 1 11H0Zm3.084 8.535a5.055 5.055 0 0 1-1.118-1.119l-.81.588c.374.514.826.966 1.34 1.34l.588-.81ZM20 11c0 2.094 0 3.625-.13 4.816-.128 1.181-.377 1.97-.835 2.6l.808.588c.603-.83.884-1.814 1.021-3.08.137-1.258.136-2.852.136-4.924h-1Zm-9.5 10.5c2.072 0 3.666 0 4.924-.136 1.266-.137 2.25-.418 3.08-1.02l-.588-.81c-.63.459-1.419.708-2.6.836-1.191.13-2.722.13-4.816.13v1Zm8.535-3.084c-.312.43-.69.807-1.119 1.119l.588.808a6.055 6.055 0 0 0 1.34-1.34l-.81-.587ZM10.5 1.5c2.094 0 3.625 0 4.816.13 1.181.128 1.97.377 2.6.836l.588-.81c-.83-.602-1.814-.883-3.08-1.02C14.166.499 12.572.5 10.5.5v1ZM21 11c0-2.072 0-3.666-.136-4.924-.137-1.266-.418-2.25-1.02-3.08l-.81.588c.459.63.708 1.419.836 2.6C20 7.375 20 8.906 20 11h1Zm-3.084-8.534c.43.311.807.689 1.119 1.118l.808-.588a6.055 6.055 0 0 0-1.34-1.34l-.587.81ZM10.5.5C8.428.5 6.834.5 5.576.636c-1.266.137-2.25.418-3.08 1.02l.588.81c.63-.459 1.419-.708 2.6-.836C6.875 1.5 8.406 1.5 10.5 1.5v-1ZM1 11c0-2.094 0-3.625.13-4.816.128-1.181.377-1.97.836-2.6l-.81-.588c-.602.83-.883 1.814-1.02 3.08C-.001 7.334 0 8.928 0 11h1Zm1.496-9.343a6.055 6.055 0 0 0-1.34 1.34l.81.587c.311-.43.689-.807 1.118-1.118l-.588-.81Zm11.948 8.232v6.667h1V9.889h-1ZM10 5.444v11.112h1V5.444h-1Zm-4.444 6.667v4.445h1V12.11h-1Z"></path></svg>
                                        <?php
                                        $h_cred_cards = !empty($_SESSION['cred_cards']) ? $_SESSION['cred_cards'] : [];
                                        $h_debet_cards = !empty($_SESSION['debet_cards']) ? $_SESSION['debet_cards'] : [];
                                        $h_installment_cards = !empty($_SESSION['installment_cards']) ? $_SESSION['installment_cards'] : [];
                                        $h_kredity = !empty($_SESSION['kredity']) ? $_SESSION['kredity'] : [];
                                        $h_zaimy = !empty($_SESSION['zaimy']) ? $_SESSION['zaimy'] : [];

                                        $count_compare_item = count($h_cred_cards) + count($h_debet_cards) + count($h_installment_cards) + count($h_kredity) + count($h_zaimy);

                                        if ($count_compare_item > 0) {
                                            echo '<div class="count">'.$count_compare_item.'</div>';
                                        }
                                        //$array_compare1 = array_merge($_SESSION['cred_cards'], $_SESSION['debet_cards'], $_SESSION['installment_cards'], $_SESSION['kredity'], $_SESSION['zaimy']);
                                        //var_dump($array_compare1);
                                        ?>
                                    </div>

                                    <div class="header__links-txt">Сравнить</div>
                                </a>
                            </div>
                            <div class="header__links-item">
                                <button id="btn__region" class="btn__modal-show d-flex align-items-center" data-target="regionContainer">
                                    <div class="header__links-icon ">
                                        <svg width="21" height="22" viewBox="0 0 21 22" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 11H6h.5Zm8 0h.5-.5Zm-4 4v.5-.5Zm2.07 5.786.102.489-.103-.49Zm-4.14 0-.102.489.103-.49ZM1.24 7.22l-.463-.189.463.19ZM.714 13.07l-.489.103.49-.103ZM8.431 1.214 8.328.725l.103.49Zm4.138 0 .103-.489-.103.49Zm7.112 6.043.145.479-.145-.479Zm-18.363 0 .145-.479-.145.479Zm17.982.156C19.75 8.519 20 9.73 20 11h1c0-1.402-.275-2.74-.775-3.965l-.925.378ZM20 11c0 .675-.07 1.332-.204 1.966l.979.206A10.54 10.54 0 0 0 21 11h-1Zm-.204 1.966a9.512 9.512 0 0 1-7.33 7.33l.206.979a10.513 10.513 0 0 0 8.103-8.103l-.979-.206Zm-7.33 7.33a9.544 9.544 0 0 1-1.966.204v1c.744 0 1.471-.078 2.172-.225l-.206-.979ZM10.5 20.5c-.675 0-1.332-.07-1.966-.204l-.206.979a10.54 10.54 0 0 0 2.172.225v-1ZM1 11c0-1.271.25-2.483.701-3.59l-.925-.378A10.471 10.471 0 0 0 0 11h1Zm7.534 9.296a9.513 9.513 0 0 1-7.33-7.33l-.979.206a10.513 10.513 0 0 0 8.103 8.103l.206-.979Zm-7.33-7.33A9.54 9.54 0 0 1 1 11H0c0 .744.078 1.471.225 2.172l.979-.206ZM1.7 7.41a9.518 9.518 0 0 1 6.833-5.706L8.328.725A10.518 10.518 0 0 0 .776 7.032l.925.378Zm6.833-5.706A9.541 9.541 0 0 1 10.5 1.5v-1c-.744 0-1.471.078-2.172.225l.206.979ZM10.5 1.5c.675 0 1.332.07 1.966.204l.206-.979A10.542 10.542 0 0 0 10.5.5v1Zm1.966.204A9.518 9.518 0 0 1 19.3 7.413l.925-.378a10.518 10.518 0 0 0-7.553-6.31l-.206.979Zm-.373-.338c.277.867 1.304 4.21 1.726 7.289l.99-.136c-.434-3.169-1.484-6.581-1.763-7.457l-.953.304Zm1.726 7.289C13.931 9.48 14 10.28 14 11h1c0-.78-.074-1.626-.19-2.48l-.992.135Zm5.717-1.876c-1.102.334-3.173.921-5.313 1.316l.182.984c2.192-.405 4.304-1.004 5.421-1.343l-.29-.957Zm-5.313 1.316c-1.297.24-2.602.405-3.723.405v1c1.208 0 2.58-.177 3.905-.421l-.182-.984ZM14 11c0 1.066-.15 2.299-.37 3.534l.984.176C14.84 13.446 15 12.15 15 11h-1Zm-.37 3.534c-.484 2.707-1.297 5.347-1.537 6.1l.953.304c.244-.766 1.072-3.455 1.568-6.228l-.984-.176Zm6.504-1.94c-.753.24-3.393 1.052-6.1 1.536l.176.984c2.773-.496 5.462-1.324 6.228-1.568l-.304-.953Zm-6.1 1.536c-1.235.22-2.468.37-3.534.37v1c1.15 0 2.446-.16 3.71-.386l-.176-.984Zm-3.534.37c-1.066 0-2.299-.15-3.534-.37l-.176.984c1.264.226 2.56.386 3.71.386v-1Zm-3.534-.37c-2.707-.484-5.347-1.297-6.1-1.537l-.304.953c.766.244 3.455 1.072 6.228 1.568l.176-.984ZM6 11c0 1.15.16 2.446.386 3.71l.984-.176C7.15 13.299 7 12.066 7 11H6Zm.386 3.71c.496 2.773 1.324 5.462 1.568 6.228l.953-.304c-.24-.753-1.053-3.393-1.537-6.1l-.984.176ZM7.954 1.062c-.28.876-1.33 4.288-1.763 7.457l.99.136c.422-3.079 1.45-6.422 1.726-7.289l-.953-.304ZM6.191 8.52C6.074 9.374 6 10.22 6 11h1c0-.72.068-1.519.181-2.345l-.99-.136ZM10.5 8.5c-1.121 0-2.426-.165-3.723-.405l-.182.984c1.325.244 2.697.421 3.905.421v-1Zm-3.723-.405c-2.14-.395-4.213-.983-5.314-1.317l-.29.957c1.117.34 3.23.939 5.422 1.344l.182-.984ZM19.532 6.78h.001l.003-.001.29.957a.975.975 0 0 0 .167-.068l-.46-.888ZM.978 7.648a.84.84 0 0 0 .195.087l.29-.957a.16.16 0 0 1 .036.017l-.521.853Z"></path></svg>
                                    </div>
                                    <div class="header__links-txt"><?php echo do_shortcode( "[wt_geotargeting get='city']" ); ?></div>
                                </button>
                            </div>
                            <div class="header__links-item">
                                <div class="d-flex align-items-center" id="themeBtn1">
                                    <div class=" d-flex align-items-center ">
                                        <div class="header__links-icon_del mr-15">
                                            <svg id="icon__light" width="18" height="21" viewBox="0 0 18 21" xmlns="http://www.w3.org/2000/svg"><path d="M8.064 11.427c2.021 3.547 4.94 4.8 6.69 5.5.445.18.78.309 1.024.431.12.06.191.107.232.14.041.035.016.028 0-.027-.048-.156.092-.181-.132.026-.194.178-.546.42-1.12.757l.504.863c.581-.34 1.014-.628 1.293-.885.249-.228.55-.595.411-1.052a.956.956 0 0 0-.319-.452 2.244 2.244 0 0 0-.42-.263c-.293-.147-.686-.299-1.102-.466-1.696-.679-4.345-1.825-6.192-5.067l-.87.495Zm6.693 6.827c-4.383 2.564-9.99 1.045-12.525-3.403l-.869.496c2.807 4.925 9.03 6.618 13.899 3.77l-.505-.863ZM2.232 14.851C-.305 10.401 1.203 4.711 5.59 2.146l-.505-.863C.22 4.128-1.442 10.425 1.363 15.347l.869-.495ZM5.59 2.146c.575-.336.958-.523 1.207-.604.29-.094.19.02.073-.106-.039-.043-.031-.069-.022-.013.008.054.012.141.003.277-.017.276-.074.636-.144 1.115-.275 1.883-.664 5.068 1.357 8.613l.869-.495C7.084 7.69 7.429 4.788 7.697 2.96c.065-.449.132-.869.153-1.198.01-.167.01-.339-.015-.497a.959.959 0 0 0-.227-.505c-.327-.357-.8-.272-1.119-.17-.36.117-.823.353-1.404.693l.505.864Z"></path></svg>
                                        </div>
                                        <input checked type='checkbox' class='ios8-switch ios8-switch-sm themeBtn_input' id='themeBtn'>

                                        <label class="themeBtn" for='themeBtn'></label>
                                        <div class="header__links-icon_del ml-15">
                                            <svg id="icon__dark" width="22" height="22" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 19.5 19.5" xml:space="preserve"><path d="M552.1 253.3c0 2.8-2.2 5-5 5s-5-2.2-5-5 2.2-5 5-5 5 2.2 5 5z" fill="none" stroke="#9ca3af" stroke-width="1.5"></path><path class="st1" d="M552.9 246.4c-.3.3-.3.8 0 1.1s.8.3 1.1 0l-1.1-1.1zm1.2 1c.3-.3.3-.8 0-1.1-.3-.3-.8-.3-1.1 0l1.1 1.1zm-13.9 11.8c-.3.3-.3.8 0 1.1.3.3.8.3 1.1 0l-1.1-1.1zm1.2.9c.3-.3.3-.8 0-1.1-.3-.3-.8-.3-1.1 0l1.1 1.1zm5-15.8c0 .4.3.8.8.8.4 0 .8-.3.8-.8h-1.6zm1.5 0c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8h1.6zm-1.5 18c0 .4.3.8.8.8.4 0 .8-.3.8-.8h-1.6zm1.5-.1c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8h1.6zm-9.7-8.2c.4 0 .8-.3.8-.8s-.3-.8-.8-.8v1.6zm-.1-1.5c-.4 0-.8.3-.8.8s.3.8.8.8v-1.6zm18 1.5c.4 0 .8-.3.8-.8s-.3-.8-.8-.8v1.6zm0-1.5c-.4 0-.8.3-.8.8s.3.8.8.8v-1.6zm-15.8-5c.3.3.8.3 1.1 0 .3-.3.3-.8 0-1.1l-1.1 1.1zm.9-1.2c-.3-.3-.8-.3-1.1 0-.3.3-.3.8 0 1.1l1.1-1.1zm11.8 13.9c.3.3.8.3 1.1 0 .3-.3.3-.8 0-1.1l-1.1 1.1zm1-1.2c-.3-.3-.8-.3-1.1 0-.3.3-.3.8 0 1.1l1.1-1.1zm0-11.5.1-.1-1.1-1.1-.1.1 1.1 1.1zm-12.8 12.7.1-.1-1.1-1.1-.1.1 1.1 1.1zm6.7-15.9-1.5-.1v.1h1.5zm0 18-1.5-.1v.1h1.5zm-9.7-9.8-.1 1.5h.1v-1.5zm17.9 0-.1 1.5h.1v-1.5zm-14.7-6.1-.1-.1-1.1 1.1.1.1 1.1-1.1zm12.7 12.8-.1-.2-1.1 1.1.1.1 1.1-1zM9.8 15.5C6.6 15.5 4 12.9 4 9.8S6.6 4 9.8 4s5.8 2.6 5.8 5.8-2.7 5.7-5.8 5.7zm0-10c-2.3 0-4.2 1.9-4.2 4.2S7.4 14 9.8 14 14 12.1 14 9.8s-1.9-4.3-4.2-4.3zM4 16.6l-.1.1c-.3.3-.8.3-1.1 0-.3-.3-.3-.8 0-1.1l.1-.1c.3-.3.8-.3 1.1 0 .3.3.3.8 0 1.1zM10.5 18.7c0 .5-.3.8-.8.8-.4 0-.8-.3-.8-.8v-.1c0-.4.3-.8.8-.8.5.1.8.5.8.9zM16.7 16.7c-.3.3-.8.3-1.1 0l-.1-.1c-.3-.3-.3-.8 0-1.1.3-.3.8-.3 1.1 0l.1.1c.3.3.3.8 0 1.1zM19.5 9.8c0 .4-.3.8-.8.8h-.1c-.4 0-.8-.3-.8-.8 0-.4.3-.8.8-.8h.1c.5 0 .8.3.8.8zM16.7 3.8l-.1.2c-.3.3-.8.3-1.1 0-.3-.3-.3-.8 0-1.1l.1-.1c.3-.3.8-.3 1.1 0 .3.3.3.8 0 1zM10.5.8c0 .5-.3.8-.8.8-.4 0-.7-.4-.7-.8 0-.5.3-.8.8-.8.4 0 .7.3.7.8zM4 4c-.3.3-.8.3-1.1 0l-.1-.2c-.3-.3-.3-.8 0-1.1.3-.3.8-.3 1.1 0l.1.2c.3.3.3.8 0 1.1zM1.6 9.8c0 .4-.3.8-.8.8-.5-.1-.8-.4-.8-.8 0-.5.3-.8.8-.8h.1c.3 0 .7.3.7.8z"></path></svg>
                                        </div>
                                    </div>



<!--                                    <div class="header__links-icon mr-xl-2">-->
<!--                                        <svg id="icon__light" width="18" height="21" viewBox="0 0 18 21" xmlns="http://www.w3.org/2000/svg"><path d="M8.064 11.427c2.021 3.547 4.94 4.8 6.69 5.5.445.18.78.309 1.024.431.12.06.191.107.232.14.041.035.016.028 0-.027-.048-.156.092-.181-.132.026-.194.178-.546.42-1.12.757l.504.863c.581-.34 1.014-.628 1.293-.885.249-.228.55-.595.411-1.052a.956.956 0 0 0-.319-.452 2.244 2.244 0 0 0-.42-.263c-.293-.147-.686-.299-1.102-.466-1.696-.679-4.345-1.825-6.192-5.067l-.87.495Zm6.693 6.827c-4.383 2.564-9.99 1.045-12.525-3.403l-.869.496c2.807 4.925 9.03 6.618 13.899 3.77l-.505-.863ZM2.232 14.851C-.305 10.401 1.203 4.711 5.59 2.146l-.505-.863C.22 4.128-1.442 10.425 1.363 15.347l.869-.495ZM5.59 2.146c.575-.336.958-.523 1.207-.604.29-.094.19.02.073-.106-.039-.043-.031-.069-.022-.013.008.054.012.141.003.277-.017.276-.074.636-.144 1.115-.275 1.883-.664 5.068 1.357 8.613l.869-.495C7.084 7.69 7.429 4.788 7.697 2.96c.065-.449.132-.869.153-1.198.01-.167.01-.339-.015-.497a.959.959 0 0 0-.227-.505c-.327-.357-.8-.272-1.119-.17-.36.117-.823.353-1.404.693l.505.864Z"></path></svg>-->
<!--                                        <svg id="icon__dark" width="22" height="22" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 19.5 19.5" xml:space="preserve"><path d="M552.1 253.3c0 2.8-2.2 5-5 5s-5-2.2-5-5 2.2-5 5-5 5 2.2 5 5z" fill="none" stroke="#9ca3af" stroke-width="1.5"></path><path class="st1" d="M552.9 246.4c-.3.3-.3.8 0 1.1s.8.3 1.1 0l-1.1-1.1zm1.2 1c.3-.3.3-.8 0-1.1-.3-.3-.8-.3-1.1 0l1.1 1.1zm-13.9 11.8c-.3.3-.3.8 0 1.1.3.3.8.3 1.1 0l-1.1-1.1zm1.2.9c.3-.3.3-.8 0-1.1-.3-.3-.8-.3-1.1 0l1.1 1.1zm5-15.8c0 .4.3.8.8.8.4 0 .8-.3.8-.8h-1.6zm1.5 0c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8h1.6zm-1.5 18c0 .4.3.8.8.8.4 0 .8-.3.8-.8h-1.6zm1.5-.1c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8h1.6zm-9.7-8.2c.4 0 .8-.3.8-.8s-.3-.8-.8-.8v1.6zm-.1-1.5c-.4 0-.8.3-.8.8s.3.8.8.8v-1.6zm18 1.5c.4 0 .8-.3.8-.8s-.3-.8-.8-.8v1.6zm0-1.5c-.4 0-.8.3-.8.8s.3.8.8.8v-1.6zm-15.8-5c.3.3.8.3 1.1 0 .3-.3.3-.8 0-1.1l-1.1 1.1zm.9-1.2c-.3-.3-.8-.3-1.1 0-.3.3-.3.8 0 1.1l1.1-1.1zm11.8 13.9c.3.3.8.3 1.1 0 .3-.3.3-.8 0-1.1l-1.1 1.1zm1-1.2c-.3-.3-.8-.3-1.1 0-.3.3-.3.8 0 1.1l1.1-1.1zm0-11.5.1-.1-1.1-1.1-.1.1 1.1 1.1zm-12.8 12.7.1-.1-1.1-1.1-.1.1 1.1 1.1zm6.7-15.9-1.5-.1v.1h1.5zm0 18-1.5-.1v.1h1.5zm-9.7-9.8-.1 1.5h.1v-1.5zm17.9 0-.1 1.5h.1v-1.5zm-14.7-6.1-.1-.1-1.1 1.1.1.1 1.1-1.1zm12.7 12.8-.1-.2-1.1 1.1.1.1 1.1-1zM9.8 15.5C6.6 15.5 4 12.9 4 9.8S6.6 4 9.8 4s5.8 2.6 5.8 5.8-2.7 5.7-5.8 5.7zm0-10c-2.3 0-4.2 1.9-4.2 4.2S7.4 14 9.8 14 14 12.1 14 9.8s-1.9-4.3-4.2-4.3zM4 16.6l-.1.1c-.3.3-.8.3-1.1 0-.3-.3-.3-.8 0-1.1l.1-.1c.3-.3.8-.3 1.1 0 .3.3.3.8 0 1.1zM10.5 18.7c0 .5-.3.8-.8.8-.4 0-.8-.3-.8-.8v-.1c0-.4.3-.8.8-.8.5.1.8.5.8.9zM16.7 16.7c-.3.3-.8.3-1.1 0l-.1-.1c-.3-.3-.3-.8 0-1.1.3-.3.8-.3 1.1 0l.1.1c.3.3.3.8 0 1.1zM19.5 9.8c0 .4-.3.8-.8.8h-.1c-.4 0-.8-.3-.8-.8 0-.4.3-.8.8-.8h.1c.5 0 .8.3.8.8zM16.7 3.8l-.1.2c-.3.3-.8.3-1.1 0-.3-.3-.3-.8 0-1.1l.1-.1c.3-.3.8-.3 1.1 0 .3.3.3.8 0 1zM10.5.8c0 .5-.3.8-.8.8-.4 0-.7-.4-.7-.8 0-.5.3-.8.8-.8.4 0 .7.3.7.8zM4 4c-.3.3-.8.3-1.1 0l-.1-.2c-.3-.3-.3-.8 0-1.1.3-.3.8-.3 1.1 0l.1.2c.3.3.3.8 0 1.1zM1.6 9.8c0 .4-.3.8-.8.8-.5-.1-.8-.4-.8-.8 0-.5.3-.8.8-.8h.1c.3 0 .7.3.7.8z"></path></svg>-->
<!--                                    </div>-->
<!--                                    <div class="header__links-txt">День/Ночь</div>-->
                                </div>
                            </div>
                            <!-- <div class="header__links-item">
                                <a href="" class="d-flex align-items-center">
                                    <div class="header__links-icon mr-xl-2">
                                        <svg width="15" height="21" viewBox="0 0 15 21" xmlns="http://www.w3.org/2000/svg"><path d="M11 5a3.5 3.5 0 0 1-3.5 3.5v1A4.5 4.5 0 0 0 12 5h-1ZM7.5 8.5A3.5 3.5 0 0 1 4 5H3a4.5 4.5 0 0 0 4.5 4.5v-1ZM4 5a3.5 3.5 0 0 1 3.5-3.5v-1A4.5 4.5 0 0 0 3 5h1Zm3.5-3.5A3.5 3.5 0 0 1 11 5h1A4.5 4.5 0 0 0 7.5.5v1Zm-3 11h6v-1h-6v1Zm6 7h-6v1h6v-1Zm-6 0A3.5 3.5 0 0 1 1 16H0a4.5 4.5 0 0 0 4.5 4.5v-1ZM14 16a3.5 3.5 0 0 1-3.5 3.5v1A4.5 4.5 0 0 0 15 16h-1Zm-3.5-3.5A3.5 3.5 0 0 1 14 16h1a4.5 4.5 0 0 0-4.5-4.5v1Zm-6-1A4.5 4.5 0 0 0 0 16h1a3.5 3.5 0 0 1 3.5-3.5v-1Z"></path></svg>
                                    </div>
                                    <div class="header__links-txt">Аккаунт</div>
                                </a>
                            </div> -->
                            <div id="btnMenu" class="header__burger d-md-none">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>




            </div>


            <!-- / header bottom -->
            <!-- header search -->
<!--            <div class="header__currency d-block d-md-none  horizontal__scroll">-->
<!--                <div class="horizontal__scroll-container d-flex justify-content-between">-->
<!--                    <div class="header__currency-item">usd/rub - --><?php //echo $currencies['USD'] ?? '' ?><!--</div>-->
<!--                    <div class="header__currency-item">eur/rub - --><?php //echo $currencies['EUR'] ?? '' ?><!--</div>-->
<!--                    <div class="header__currency-item">btc/usd - --><?php //echo $currencies['USDBTC'] ?? '' ?><!--</div>-->
<!--                </div>-->
<!--            </div>-->
            <!-- / header search -->
            <!-- header region -->

            <div id="regionContainer" class="header__region">
                <div class="header__region-wrapper">
                    <div class="container">
                        <div class="d-flex align-items-center mb-4">
                            <div class="header__region-title w-100 h2 mb-0">Выберите город</div>
                            <div class="btn__modal-close header__search-close d-block" data-dismiss="modal"></div>
                        </div>
                        <form>
                            <div class="search__field">
                                <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.7575 14.5757C15.5232 14.3414 15.1433 14.3414 14.909 14.5757C14.6746 14.81 14.6746 15.1899 14.909 15.4243L15.7575 14.5757ZM18.2422 18.7575C18.4765 18.9919 18.8564 18.9919 19.0907 18.7575C19.325 18.5232 19.3251 18.1433 19.0907 17.909L18.2422 18.7575ZM14.909 15.4243L18.2422 18.7575L19.0907 17.909L15.7575 14.5757L14.909 15.4243ZM8.6665 15.2332C4.85574 15.2332 1.7665 12.144 1.7665 8.33325H0.566504C0.566504 12.8068 4.193 16.4333 8.6665 16.4333V15.2332ZM15.5665 8.33325C15.5665 12.144 12.4773 15.2332 8.6665 15.2332V16.4333C13.14 16.4333 16.7665 12.8068 16.7665 8.33325H15.5665ZM8.6665 1.43325C12.4773 1.43325 15.5665 4.52249 15.5665 8.33325H16.7665C16.7665 3.85974 13.14 0.233252 8.6665 0.233252V1.43325ZM8.6665 0.233252C4.193 0.233252 0.566504 3.85974 0.566504 8.33325H1.7665C1.7665 4.52249 4.85574 1.43325 8.6665 1.43325V0.233252Z" fill="#7B879D"></path>
                                </svg>
                                <input id="search_location_name" name="search_location_name" type="text" class="search__field-input pl-5 form-control city_search">
                            </div>

                            <div class="tags__list mt-4">
                                <a onclick="WtLocation.setValue('Москва', 'city',  'reload')" class="tag__item">Москва</a>
                                <a onclick="WtLocation.setValue('Санкт-Петербург', 'city',  'reload')"  class="tag__item">Санкт-Петербург</a>
                                <a onclick="WtLocation.setValue('Екатеринбург', 'city',  'reload')"  class="tag__item">Екатеринбург</a>
                                <a onclick="WtLocation.setValue('Казань', 'city',  'reload')" class="tag__item">Казань</a>
                                <a onclick="WtLocation.setValue('Воронеж', 'city',  'reload')" class="tag__item">Воронеж</a>
                                <a onclick="WtLocation.setValue('Белгород', 'city',  'reload')" class="tag__item">Белгород</a>
                            </div>
                            <div class="header__region-list pt-4 mt-3" id='search_location_result'>
                                <div class="row" id="all-cities"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- / header region -->
            <div id="backdrop" class="header__overlay"></div>
        </header>
        <div class="POPUP_APPLY_ALL"></div>
        <?//php get_template_part( 'all_template/forms/help-become-better', null, ['show' => 'Y']); ?>
