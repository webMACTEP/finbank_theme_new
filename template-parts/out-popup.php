<?php //if(is_single() && get_field('archive')): // && is_single('395') ?>
<?php if(is_single()): ?>


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
  <div class="out_exit_wrap check_popap" style="display:none;">
    <div class="out_exit">
      <div class="out_exit_close"><img alt="Закрыть" src="/wp-content/themes/finbank_theme/img/close2.png"></div>
      <div class="out_exit_body">
        <div class="h2">К сожалению, "<?= get_the_title(); ?>" недоступен для оформления на Finabank. Предлагаем вам ознакомиться с лучшими предложениями этой категории.</div>
        <div class="out_exit_btn">
          <a href="<?= $present_link; ?>" target="_blank" class="btn btn-outline-primary btn-sm btn-block font-weight-normal">Перейти</a>
          <?php if (get_field('card_bank_link') && !reclink(get_the_id())): ?>  
            <a href="<?= get_field('card_bank_link'); ?>" target="_blank" class="out_exit_close2">Спасибо, не надо</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif;  ?> 