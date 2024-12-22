<?php
    $show_in_page = 1;
    $show_in_page = $args['show_in_page'];

            $posttype = get_post_type(get_the_id());
            $present_link = get_page_link(5331);
            switch ($posttype) {
                case 'kredity':
                    $present_link = get_page_link(5333);
                    break;
                case 'zaimy':
                    $present_link = get_page_link(5331);
                    break;
                case 'bankcard':
                    $termpost = wp_get_post_terms(get_the_id(), 'bankcards');
                        if ($termpost[0]->slug == 'debetcard') {
                          $present_link = get_page_link(5337);
                        } elseif ($termpost[0]->slug == 'creditcard') {
                          $present_link = get_page_link(5339);
                        } elseif ($termpost[0]->slug == 'installmentcard') {
                          $present_link = get_page_link(5335);
                        }
                break;
                default:
                    $present_link = get_page_link(5331);
                break;
            }

?>

  <div class="present-block">
    <div data-show_in_page="<?= $show_in_page?>" class="present-content" style="display:none;">
      <div class="present-text">Мы подобрали для вас лучшие предложения</div>
      <div class="present-logo">
		<img loading="lazy" src=" <?php bloginfo('template_directory')?>/img/present-logo.png" alt="лучшие предложения" >
	  </div>
	  
	  <div class="present-button">
        <a href="<?= $present_link; ?>" onclick="ym(35020350,'reachGoal','PRESENT_CLICK_CTA'); return true;" >Посмотреть</a>
      </div>
    </div>
    <div class="present-icon">
      <img loading="lazy" src="/wp-content/themes/finbank_theme/img/icon-present.svg" alt="лучшие предложения подарок" class="present-icon-present">
      <img loading="lazy" src="/wp-content/themes/finbank_theme/img/icon-present-close.svg" alt="закрыть" class="present-icon-close" style="display: none;">
    </div>    
  </div>

