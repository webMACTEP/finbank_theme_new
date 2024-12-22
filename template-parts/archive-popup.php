<?php if(is_single() && get_field('archive')): // && is_single('2065') ?>

<?php
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
  <div class="archive_exit_wrap check_popap" style="display:none;">
    <div class="archive_exit">
      <div class="archive_exit_close"><img alt="Закрыть" src="/wp-content/themes/finbank_theme/img/close2.png"></div>
      <div class="archive_exit_body">
        <div class="h2"> К сожалению, банк больше не выпускает "<?= get_the_title(); ?>".<br>
Вы можете ознакомиться с лучшими предложениями в этой категории.</div>
        <div class="archive_exit_btn">
          <a href="<?= $present_link; ?>" target="_blank" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Посмотреть</a> 
        </div>
      </div>
    </div>
  </div>      


<?php endif;  ?> 