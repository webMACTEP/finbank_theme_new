<?php

    $type = get_field('coll-type');


    if($type){
        // СДЕЛАТЬ НАЗВАНИЯ ТАКИМИ ЖЕ
        //echo  'TYPE: ' .  print_r2($type);
        //switch ($type) {
        //    case 'creditcard':
        //        break;
        //    case 'debatcard':
        //        break;
        //    case 'installmentcard':
        //        break;
        //    case 'kredity':
        //        break;
        //    case 'zaimy':
        //        break;
        //    default:
        //        break;
        //}

        $tags_name = 'tags_menu_' . $type;

        //print_r2($type);

        $tags = get_field('tags_menu_' . $type , 'options');
        //echo $tags_name;
        //print_r2($type);
        //print_r2($tags);


    }else{



    $terms = wp_get_post_terms( get_the_id(), 'bankcards', array('fields' => 'all') );
    $term_slug = $terms[0]->slug;
    $term_id = $terms[0]->term_id;
    $post_type = get_post_type(get_the_id());

    //print_r2($post_type);
    //print_r2($term_slug);


    if($post_type == 'kredity'){

    }

    //switch ($term_slug) {
    //    case 'debetcard':
    //       break;
    //    case 'installmentcard':
    //        break;
    //    case 'creditcard':
    //        break;
    //}

}

?>

<?php if($tags):  ?>
<!--  tags__main_v2_slider -->
<div class="container"  >
    <div class="section_custom_v1">
        <div class="tags__main mb-4 horizontal__scroll tags__main_v2_slider">
            <div class="horizontal__scroll-container tags__main_v2_slider-container">

                <?php foreach ($tags as $tag): ?>

                    <a href="<?php echo $tag['link_addr']; ?>" class="tag__item"><span class="tag__item-title"><?php echo $tag['link_text']; ?></span></a>

                <?php endforeach; ?>

            </div>
            <!-- slider prev/next buttons -->
            <div class="slider__button_container">
                <div class="slider__button slider__button-prev d-flex justify-content-center align-items-center">
                    <svg width="6" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.2 13.2" xml:space="preserve"><path d="M5.6 0c.2 0 .3.1.4.2.3.2.3.6 0 .8L3.8 3.1C2.2 4.7 1.3 5.5 1.2 6.3v.6c.1.8.9 1.6 2.6 3.2L6 12.2c.2.2.2.6 0 .8-.2.2-.6.2-.8 0L3 10.9C1.1 9.2.2 8.3 0 7.1v-.9C.2 4.9 1.1 4 3 2.3L5.2.2c.1-.1.3-.2.4-.2z"></path></svg>
                </div>
                <div class="slider__button slider__button-next d-flex justify-content-center align-items-center">
                    <svg width="6" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.2 13.2" xml:space="preserve"><path d="M.6 13.2c-.2 0-.3-.1-.4-.2-.2-.2-.2-.6 0-.8l2.2-2.1C4 8.5 4.9 7.7 5 6.9v-.6c-.1-.8-1-1.6-2.6-3.2L.2 1C0 .8 0 .4.2.2c.2-.2.6-.2.8 0l2.2 2.1C5.1 4 6 4.9 6.2 6.1V7c-.2 1.3-1.1 2.2-3 3.9L1 13c-.1.1-.3.2-.4.2z"></path></svg>
                </div>
            </div>
            <!-- / slider prev/next buttons -->
        </div>
    </div>
</div>
<!--  tags__main_v2_slider END -->
<?php endif; ?>