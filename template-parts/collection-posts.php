		<?php  
              $posttype = get_post_type(get_the_id());

            switch ($posttype) {
                case 'kredity':
                    get_template_part( 'template-parts/filter-kredity-posts' );
                    break;
                case 'zaimy':
                    get_template_part( 'template-parts/filter-zaimy-posts' );
                    break;
                case 'bankcard':
                    $termpost = wp_get_post_terms(get_the_id(), 'bankcards');
                    //var_dump($termpost);
                    //echo "Тип: ".$termpost[0]->slug;
                    if ($termpost[0]->slug == 'debetcard') {
                        get_template_part( 'template-parts/filter-debet-card-posts' );
                    } else {
                        get_template_part( 'template-parts/filter-cred-card-posts' );
                    }
                    break;
            }

        ?>
