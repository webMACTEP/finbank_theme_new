<?php

function code_type_1v2( $atts ) {
 
 global $wpdb;
 if (!empty($atts['id']) && !empty($atts['type'])):
 $meta = get_post_meta( $atts['id'] );
 $back = $atts['back'];
 $html = '<div class="code1wrapper"><div class="code1 '.$back.'">
             <span class="frecom">Финабанк рекомендует!</span>
             <div class="code1title">'.get_the_title($atts['id']).'</div> 
             <div class="code1body">
                 <div>';

                 if(strlen($meta['card_logo'][0]) > 0) {
                    $image = wp_get_attachment_image_src($meta['card_logo'][0], 'large'); 
                    $html .= '<img src="'.$image[0].'" />';
                }

                     //<img src="images/tinkoff.png" />
                 $html .='</div>    
                 <div class="code1bodytext">';
                 $type = $atts['type']?:'credit_card';	
                 
                 if ($type == 'credit_card')  {
                     if(strlen($meta['card_cred_limit'][0]) > 0) {
                         $html .= '<div>Кред. лимит: <span>'.number_format($meta['card_cred_limit'][0], 0, '', ' ').' ₽</span></div>';
                     }
                     if(strlen($meta['card_period'][0]) > 0) {
                        $value = get_field( "card_period", $atts['id'] );
                        $html .= '<div>Без процентов: <span>'.$value['label'].'</span></div>';
                     }
                     if(strlen($meta['card_cost'][0]) > 0) {
                         $html .= '<div>Стоимость: <span>От '.$meta['card_cost'][0].' ₽</span></div>';
                     }
                     if(strlen($meta['card_cashback'][0]) > 0) {
                        $value = get_field( "card_cashback", $atts['id'] );
                         $html .= '<div>Кэшбек: <span>'.$value.'</span></div>';
                     }
                     if(strlen($meta['card_stavka'][0]) > 0) {
                         $html .= '<div>Cтавка: <span>'.$meta['card_stavka'][0].' %</span></div>';
                     }

                     if(strlen($meta['card_answ'][0]) > 0) {
                         $html .= '<div>Решение: <span>'.$meta['card_answ'][0].'</span></div>';
                     }
                 }	

                 if ($type == 'zaim')  {
                     if(strlen($meta['z_sum'][0]) > 0) {
                         $html .= '<div>Сумма: <span>'.number_format($meta['z_sum'][0], 0, '', ' ').' ₽</span></div>';
                     }
                     if(strlen($meta['z_history'][0]) > 0) {
                         $html .= '<div>Кредитная история: <span>'.$meta['z_history'][0].'</span></div>';
                     }
                     if(strlen($meta['z_stavka'][0]) > 0) {
                         $html .= '<div>% ставка: <span>От '.$meta['z_stavka'][0].' ₽</span></div>';
                     }
                     if(strlen($meta['z_time'][0]) > 0) {
                         $html .= '<div>Срок: <span>'.$meta['z_time'][0].'</span></div>';
                     }
                     if(strlen($meta['z_oldness'][0]) > 0) {
                         $html .= '<div>Возраст: <span>'.$meta['z_oldness'][0].'</span></div>';
                     }
                     if(strlen($meta['z_answer'][0]) > 0) {
                         $html .= '<div>Решение: <span>'.$meta['z_answer'][0].'</span></div>';
                     }
                 }

                 if ($type == 'kredit')  {
                     if(strlen($meta['credit_period'][0]) > 0) {
                        $value = get_field( "credit_period", $atts['id'] );
                        $html .= '<div>Срок: <span>'.$value['label'].'</span></div>';
                     }
                     if(strlen($meta['credit_stavka'][0]) > 0) {
                         $html .= '<div>% ставка : <span>'.$meta['credit_stavka'][0].'</span></div>';
                     }
                     if(strlen($meta['credit_min_sum'][0]) > 0) {
                         $html .= '<div>Минимальная сумма: <span>'.$meta['credit_min_sum'][0].' ₽</span></div>';
                     }
                     if(strlen($meta['credit_max_sum'][0]) > 0) {
                         $html .= '<div>Максимальная сумма: <span>'.$meta['credit_max_sum'][0].' ₽</span></div>';
                     }
                     if(strlen($meta['credit_oldness'][0]) > 0) {
                         $html .= '<div>Возраст: <span>'.$meta['credit_oldness'][0].'</span></div>';
                     }
                     if(strlen($meta['credit_answer'][0]) > 0) {
                         $html .= '<div>Решение: <span>'.$meta['credit_answer'][0].'</span></div>';
                     }
                 }

                 if ($type == 'debit_card')  {
                     if(strlen($meta['card_cashback'][0]) > 0) {
                        $value = get_field( "card_cashback", $atts['id'] );
                         $html .= '<div>Кэшбек: <span>'.$value.'</span></div>';
                     }
                     if(strlen($meta['card_stavka_ostatok'][0]) > 0) {
                         $html .= '<div>% на остаток: <span>'.$meta['card_stavka_ostatok'][0].'</span></div>';
                     }
                     if(strlen($meta['non_pecent_money'][0]) > 0) {
                         $html .= '<div>Снятие без %: <span>От '.$meta['non_pecent_money'][0].' ₽</span></div>';
                     }
                     if(strlen($meta['card_overdraft'][0]) > 0) {
                         $html .= '<div>Овердрафт: <span>'.$meta['card_overdraft'][0].'</span></div>';
                     }
                     if(strlen($meta['card_cost'][0]) > 0) {
                         $html .= '<div>Стоимость: <span>'.$meta['card_cost'][0].'</span></div>';
                     }
                     if(strlen($meta['card_answ'][0]) > 0) {
                         $html .= '<div>Решение: <span>'.$meta['card_answ'][0].'</span></div>';
                     }
                 }
                $url = get_the_permalink($atts['id']); 
                $html .= '<div class="morehref"><a target="_blank" href="'.$url.'" class="more" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_product\'); return true;">Подробнее</a></div>';

 $html .= 		'</div>
             </div>
         </div></div>';
  
 return $html;
 endif;

}

add_shortcode( 'code1v2', 'code_type_1v2' );

function code_type_2v2( $atts ) {
 if (!empty($atts['id'])):
 $meta = get_post_meta( $atts['id'] );
 $content_post = get_post($atts['id']);
 $content = $content_post->post_content;
 $content = apply_filters('the_content', $content);
 $content = str_replace(']]>', ']]&gt;', $content);

 $html = '<div class="code2wrapper"><div class="code2 '.$meta['background_type'][0].'">
             <span class="frecom">Финабанк рекомендует!</span>	
             <div class="code2title">'.get_the_title($atts['id']).'</div>
             <div class="code2bodytext">'.$content.'</div>';
             
             $url = get_the_permalink($atts['id']); 
             $html .= '<div><a target="_blank" href="'.$url.'" class="more" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_CTA_text\'); return true;">Подробнее</a></div>';
             
 $html .= '</div></div>';

 return $html;
 endif;
}

add_shortcode( 'code2v2', 'code_type_2v2' );

function code_type_5v2( $atts ) {
 if (!empty($atts['id']) && !empty($atts['type'])):
 $meta = get_post_meta( $atts['id'] );
 $back = $atts['back'];
 $content_post = get_post($atts['id']);
 $content = $content_post->post_content;
 $content = apply_filters('the_content', $content);
 $content = str_replace(']]>', ']]&gt;', $content);

 $oform = '';
 $more = '';

 $url = get_the_permalink($atts['id']); 

 $oform .= '<a href="'.$url.'" class="oform" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_CTA_product\'); return true;">Оформить</a>';
 
 /*echo '<pre>'; 
 var_dump($meta);
 echo '</pre>';*/

 $more .= '<a href="'.$url.'" class="code5more">Подробнее</a>';

 $type = $atts['type']?:'credit_card';	
 //$html .= $type;
 $html .= '<div class="code5wrapper"><span class="frecom">Финабанк рекомендует!</span><div class="code5block '.$back.'">				            
             <div class="code5text">                 
                 <div class="code5title">'.get_the_title($atts['id']).'</div>
                 <div class="code5description">				
                     '.$content.'
                 </div>
                 <div class="code5chars">';
                 if ($type == 'credit_card')  {
                     if(strlen($meta['card_cred_limit'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.number_format($meta['card_cred_limit'][0], 0, '', ' ').' ₽</span>
                         <div>Кред. лимит</div>
                     </div>';

                     }
                     if(intval($meta['card_period'][0]) > 0) {
                         $value = get_field( "card_period", $atts['id'] );
                         $html .= '<div class="code5charblock">
                         <span>'.$value['label'].'</span>
                         <div>Без процентов</div>
                     </div>';
                     }
                     if(strlen($meta['card_cost'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>От '.$meta['card_cost'][0].' ₽</span>
                         <div>Стоимость</div>
                     </div>';
                     }
                     if(strlen($meta['card_cashback'][0]) > 0) {
                        $value = get_field( "card_cashback", $atts['id'] );
                         $html .= '<div class="code5charblock">
                         <span>'.$value.'</span>
                         <div>Кэшбек</div>
                     </div>';
                     }
                     if(strlen($meta['card_stavka'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>От '.$meta['card_stavka'][0].' %</span>
                         <div>Cтавка</div>
                     </div>';
                     }

                     if(strlen($meta['card_answ'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['card_answ'][0].'</span>
                                     <div>Решение</div>
                                 </div>';
                     }
                 }	

                 if ($type == 'zaim')  {
                     if(strlen($meta['z_sum'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.number_format($meta['z_sum'][0], 0, '', ' ').' ₽</span>
                         <div>Сумма</div>
                     </div>';
                     }
                     if(strlen($meta['z_history'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.$meta['z_history'][0].'</span>
                         <div>Кредитная история</div>
                     </div>';
                     }
                     if(strlen($meta['z_stavka'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.$meta['z_stavka'][0].' %</span>
                         <div>% ставка</div>
                     </div>';
                     }

                     if(strlen($meta['z_oldness'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['z_oldness'][0].'</span>
                                     <div>Возраст</div>
                                 </div>';
                     }
                     
                     if(strlen($meta['z_time'][0]) > 0) {
                            
                         $html .= '<div class="code5charblock">
                         <span>'.$meta['z_time'][0].'</span>
                         <div>Срок</div>
                     </div>';
                     }

                     if(strlen($meta['z_answer'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['z_answer'][0].'</span>
                                     <div>Решение</div>
                                 </div>';
                     }

                 }

                 if ($type == 'kredit')  {
                     if(strlen($meta['credit_max_sum'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                 <span>'.number_format($meta['credit_max_sum'][0], 0, '', ' ').' ₽</span>
                                 <div>Макс. сумма</div>
                             </div>';
                     }
                     if(strlen($meta['credit_min_sum'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.number_format($meta['credit_min_sum'][0], 0, '', ' ').' ₽</span>
                         <div>Минимальная сумма</div>
                     </div>';
                     }

                     if(strlen($meta['credit_stavka'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.$meta['credit_stavka'][0].'</span>
                         <div>% ставка</div>
                     </div>';

                     }
                     
                     if(strlen($meta['credit_oldness'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                             <span>'.$meta['credit_oldness'][0].'</span>
                             <div>Возраст</div>
                         </div>';

                     }

                     if(strlen($meta['credit_period'][0]) > 0) {
                         $value = get_field( "credit_period", $atts['id'] );

                         $html .= '<div class="code5charblock">
                         <span>'.$value['label'].'</span>
                         <div>Срок</div>
                     </div>';

                     }
                     
                     if(strlen($meta['credit_answer'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['credit_answer'][0].'</span>
                                     <div>Решение</div>
                                 </div>';
                     }
                 }

                 if ($type == 'debit_card')  {
                     if(strlen($meta['non_pecent_money'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['non_pecent_money'][0].'</span>
                                     <div>Снятие без %</div>
                                 </div>';
                     }
                     if(strlen($meta['card_stavka_ostatok'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['card_stavka_ostatok'][0].'</span>
                                     <div>% на остаток</div>
                                 </div>';
                     }

                     if(strlen($meta['card_cashback'][0]) > 0) {
                        $value = get_field( "card_cashback", $atts['id'] );
                         $html .= '<div class="code5charblock">
                         <span>'.$value['label'].'</span>
                         <div>Кэшбек</div>
                     </div>';
                         
                     }
                     
                     
                     if(strlen($meta['card_overdraft'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['card_overdraft'][0].'</span>
                                     <div>Овердрафт</div>
                                 </div>';
                     }
                     if(strlen($meta['card_cost'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['card_cost'][0].'</span>
                                     <div>Стоимость</div>
                                 </div>';
                     }
                     if(strlen($meta['card_answ'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['card_answ'][0].'</span>
                                     <div>Решение</div>
                                 </div>';
                     
                     }
                 }


                 
                     /*if(strlen($meta['no_percents'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                         <span>От '.$meta['no_percents'][0].' ₽</span>
                                         <div>Дней без процентов</div>
                                     </div>';

                     }
                     if(strlen($meta['cashback'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                         <span>От '.$meta['cashback'][0].' ₽</span>
                                         <div>Кэшбэк</div>
                                     </div>';

                     }
                     if(strlen($meta['maintenance'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                         <span>От '.$meta['maintenance'][0].' ₽</span>
                                         <div>Обслуживание</div>
                                     </div>';

                     }*/

 $html .= '			
                 </div>
                 <div class="code5footer">';
                     
 $html .= 	$oform;
 $html .= 	$more;
 
 $html .= 	'</div>
             </div>
             <div class="code5image">';
             if(strlen($meta['card_logo'][0]) > 0) {
                 $logo_alt = get_post_meta($meta['card_logo'][0], '_wp_attachment_image_alt', true);
                $image = wp_get_attachment_image_src($meta['card_logo'][0], 'large'); 
                $html .= '<img alt="' . $logo_alt . '"  src="'.$image[0].'" />';
            }
             /*if(strlen($meta['picture'][0]) > 0) {
                 $image = wp_get_attachment_image_src($meta['picture'][0], 'large'); 
                 $html .= '<img src="'.$image[0].'" />';
             }*/
            //$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($atts['id']), 'medium' );             
            //$html .= '<img src="'.$thumbnail_attributes[0].'" />';		


 $html .= 	'</div>
             
             <div class="code5footer_mobile"><div class="col5">';
 
             $html .= 	$oform;
             $html .= '</div><div class="col5 right">';
             $html .= 	$more;

 $html .= 	'</div></div>
         </div></div>';

 return $html;
 endif;
}

add_shortcode( 'code5v2', 'code_type_5v2' );



function code_type_31v2( $atts ) {
 if (!empty($atts['ids']) && !empty($atts['type'])):

 $idArray = explode(',', $atts['ids']);

 $back = $atts['back'];
 $type = $atts['type']?:'kredit';	
 $html = '<div class="code31wrapper"><span class="frecom">Финабанк рекомендует!</span>';
 if ($type == 'kredit') {
     foreach($idArray as $id) {
         $meta = get_post_meta( $id );		
         $url = get_the_permalink($id); 
         $html .= '<div style="width:100%" class="strong td2"><a href="'.$url.'">'.get_the_title($id).'</a></div>';

         $html .= '<div class="code3 code31 '.$back.'"><span class="frecom">Финабанк рекомендует!</span>';
         $html .= '
         <div class="code3head">            
             <div class="erst">Макс. сумма</div>
             <div class="text-center">Ставка</div>
             <div class="text-center">Срок</div>
             <div class="text-center">Первонач.<br/> взнос</div>
             <div class="text-center">Рейтинг</div>
         </div>';

         $html .= '<div class="code3text">';		
         if(strlen($meta['credit_max_sum'][0]) > 0) {		
             $html .= '<div class="td erst"><div class="hidden-lg">Макс. сумма</div><div class="td-val">'.number_format($meta['credit_max_sum'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['credit_stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Ставка</div><div class="td-val">'.$meta['credit_stavka'][0].'%</div></div>';
         }	
         if(strlen($meta['credit_period'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">до '.$meta['credit_period'][0].'</div></div>';
         }	
         $html .= '<div class="td text-center"><div class="hidden-lg">Первонач. взнос</div><div class="td-val">'.((int)$meta['vznos'][0] > 0 ? $meta['vznos'][0] : 'Отсутствует').'</div></div>';
         if(strlen($meta['rating'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['rating'][0].'</div></div></div>';
         }	
         $html .= '</div>';
         $html .= '</div>';
     }	
 }
 
 if ($type == 'zaim') {
     foreach($idArray as $id) {
         $meta = get_post_meta( $id );		
         $url = get_the_permalink($id); 
         $html .= '<div style="width:100%" class="strong td2"><a href="'.$url.'">'.get_the_title($id).'</a></div>';

         $html .= '<div class="code3 code31 '.$back.'"><span class="frecom">Финабанк рекомендует!</span>';
         $html .= '
         <div class="code3head">            
             <div class="erst">Сумма</div>
             <div class="text-center">Кредитная<br/> история</div>
             <div class="text-center">% ставка</div>
             <div class="text-center">Срок</div>
             <div class="text-center">Рейтинг</div>
         </div>';

         $html .= '<div class="code3text">';		
         
         if(strlen($meta['z_sum'][0]) > 0) {		
             $html .= '<div class="td erst"><div class="hidden-lg">Сумма</div><div class="td-val">'.number_format($meta['z_sum'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['z_history'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Кредитная история</div><div class="td-val">'.$meta['z_history'][0].'</div></div>';
         }	
         if(strlen($meta['z_stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до '.$meta['z_stavka'][0].'</div></div>';
         }	
         $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">до '.$meta['z_time'][0].' дней</div></div>';
         if(strlen($meta['ratings_average'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['ratings_average'][0].'</div></div></div>';
         }	

         $html .= '</div>';
         $html .= '</div>';
     }
 }
 

 if ($type == 'credit_card') {
     foreach($idArray as $id) {
         $meta = get_post_meta( $id );		
         $url = get_the_permalink($id); 
         $html .= '<div style="width:100%" class="strong td2"><a href="'.$url.'">'.get_the_title($id).'</a></div>';

         $html .= '<div class="code3 code31 '.$back.'"><span class="frecom">Финабанк рекомендует!</span>
             <div class="code3head">
                 <div class="erst">Кредитный<br/>лимит</div>
                 <div class="text-center">Льготный<br/>период</div>
                 <div class="text-center">% ставка</div>
                 <div class="text-center">Кэшбек</div>
                 <div class="text-center">Стоимость</div>
                 <div class="text-center">Рейтинг</div>
             </div>';


         $html .= '<div class="code3text">';
         
         if(strlen($meta['card_cred_limit'][0]) > 0) {		
             $html .= '<div class="td text-center"><div class="hidden-lg">Кредитный лимит</div><div class="td-val">'.number_format($meta['card_cred_limit'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['card_period'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Льготный период</div><div class="td-val">'.$meta['card_period'][0].'</div></div>';
         }	
         if(strlen($meta['card_stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до '.$meta['card_stavka'][0].'</div></div>';
         }
         if(strlen($meta['card_cashback'][0]) > 0) {
            $value = get_field( "card_cashback", $atts['id'] );
             $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val srok1">'.$value.'</div></div>';
         }	
         if(strlen($meta['card_cost'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">до '.$meta['card_cost'][0].'</div></div>';
         }
         if(strlen($meta['ratings_average'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['ratings_average'][0].'</div></div></div>';
         }	
         $html .= '</div>';
         $html .= '</div>';
     }			
 }

 
 if ($type == 'debit_card') {
     foreach($idArray as $id) {
         $meta = get_post_meta( $id );		
         $url = get_the_permalink($id); 
         $html .= '<div style="width:100%" class="strong td2"><a href="'.$url.'">'.get_the_title($id).'</a></div>';

         $html .= '<div class="code3 code31 '.$back.'"><span class="frecom">Финабанк рекомендует!</span>
             <div class="code3head">
                 <div class="erst">Кэшбек</div>
                 <div class="text-center">% на остаток</div>
                 <div class="text-center">Снятие без %</div>
                 <div class="text-center">Овердрафт</div>
                 <div class="text-center">Стоимость</div>
                 <div class="text-center">Рейтинг</div>
             </div>';

         $html .= '<div class="code3text">';
         if(strlen($meta['card_cashback'][0]) > 0) {		
            $value = get_field( "card_cashback", $atts['id'] );
             $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val">'.$value.'</div></div>';
         }	
         if(strlen($meta['card_stavka_ostatok'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% на остаток</div><div class="td-val">'.$meta['card_stavka_ostatok'][0].'</div></div>';
         }	
         if(strlen($meta['non_pecent_money'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Снятие без %</div><div class="td-val srok1">'.$meta['non_pecent_money'][0].'</div></div>';
         }
         if(strlen($meta['card_overdraft'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Овердрафт</div><div class="td-val srok1">'.$meta['card_overdraft'][0].'</div></div>';
         }
         if(strlen($meta['card_cost'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">'.$meta['card_cost'][0].'</div></div>';
         }
         if(strlen($meta['ratings_average'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['ratings_average'][0].'</div></div></div>';
         }	
         $html .= '</div>';
         $html .= '</div>';
     }			
 }


 $html .= '</div>';

 return $html;
 endif;
}

add_shortcode( 'code31v2', 'code_type_31v2' );


function code_type_3v2( $atts ) {
 if (!empty($atts['ids']) && !empty($atts['type'])):

 $type = $atts['type']?:'kredit';	
 $idArray = explode(',', $atts['ids']);
 $back = $atts['back'];

 $html = '<div class="code3wrapper">';
 if ($type == 'kredit') {
     $html .= '<div class="code3 '.$back.'"><span class="frecom">Финабанк рекомендует!</span>
         <div class="code3head">
             <div class="w30">Предложение</div>
             <div class="text-center">Макс. сумма</div>
             <div class="text-center">Ставка</div>
             <div class="text-center">Срок</div>
             <div class="text-center">Первонач.<br/> взнос</div>
             <div class="text-center">Рейтинг</div>
         </div>';

     $metas = [];	
     


     foreach($idArray as $id) {
         $meta = get_post_meta( $id );		
         $url = get_the_permalink($id); 
         $html .= '<div class="code3text">';
         $html .= '<div class="w30 strong td2"><span><a href="'.$url.'" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">'.get_the_title($id).'</a></span></div>';
         if(strlen($meta['credit_max_sum'][0]) > 0) {		
             $html .= '<div class="td text-center"><div class="hidden-lg">Макс. сумма</div><div class="td-val">'.number_format($meta['credit_max_sum'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['credit_stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Ставка</div><div class="td-val">'.$meta['credit_stavka'][0].'%</div></div>';
         }	
         if(strlen($meta['credit_period'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">до '.$meta['credit_period'][0].'</div></div>';
         }	
         //$html .= '<div class="td text-center"><div class="hidden-lg">Первонач. взнос</div><div class="td-val">'.((int)$meta['vznos'][0] > 0 ? $meta['vznos'][0] : 'Отсутствует').'</div></div>';
         if(strlen($meta['rating'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 td-val text-center"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['rating'][0].'</div></div></div>';
         }	
         $html .= '</div>';
     }	
     $html .= '</div>';
 }	

 if ($type == 'zaim') {
     $html .= '<div class="code3 '.$back.'"><span class="frecom">Финабанк рекомендует!</span>
         <div class="code3head">
             <div class="w30">Предложение</div>
             <div class="text-center">Сумма</div>
             <div class="text-center">Кредитная<br/> история</div>
             <div class="text-center">% ставка</div>
             <div class="text-center">Срок</div>
             <div class="text-center">Рейтинг</div>
         </div>';

     $metas = [];	

     foreach($idArray as $id) {
         $meta = get_post_meta( $id );		
         $url = get_the_permalink($id); 
         $html .= '<div class="code3text">';
         $html .= '<div class="w30 strong td2"><a href="'.$url.'" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">'.get_the_title($id).'</a></div>';
         if(strlen($meta['z_sum'][0]) > 0) {		
             $html .= '<div class="td text-center"><div class="hidden-lg">Сумма</div><div class="td-val">'.number_format($meta['z_sum'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['z_history'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Кредитная история</div><div class="td-val">'.$meta['z_history'][0].'</div></div>';
         }	
         if(strlen($meta['z_stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до '.$meta['z_stavka'][0].'</div></div>';
         }	
         $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">'.$meta['z_time'][0].'</div></div>';
         if(strlen($meta['ratings_average'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['ratings_average'][0].'</div></div></div>';
         }	
         $html .= '</div>';
     }	
     $html .= '</div>';
 }	

 if ($type == 'credit_card') {
     $html .= '<div class="code3 '.$back.'"><span class="frecom">Финабанк рекомендует!</span>
         <div class="code3head">
             <div class="w30">Предложение</div>
             <div class="text-center">Кредитный<br/>лимит</div>
             <div class="text-center">Льготный<br/>период</div>
             <div class="text-center">% ставка</div>
             <div class="text-center">Кэшбек</div>
             <div class="text-center">Стоимость</div>
             <div class="text-center">Рейтинг</div>
         </div>';

     $metas = [];	

     foreach($idArray as $id) {
         $meta = get_post_meta( $id );		
         $url = get_the_permalink($id); 
         $html .= '<div class="code3text">';
         $html .= '<div class="w30 strong td2"><a href="'.$url.'" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">'.get_the_title($id).'</a></div>';
         if(strlen($meta['card_cred_limit'][0]) > 0) {		
             $html .= '<div class="td text-center"><div class="hidden-lg">Кредитный лимит</div><div class="td-val">'.number_format($meta['card_cred_limit'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['card_period'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Льготный период</div><div class="td-val">'.$meta['card_period'][0].'</div></div>';
         }	
         if(strlen($meta['card_stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до '.$meta['card_stavka'][0].'</div></div>';
         }
         if(strlen($meta['card_cashback'][0]) > 0) {
            $value = get_field( "card_cashback", $atts['id'] );
             $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val srok1">до '.$value.'</div></div>';
         }	
         if(strlen($meta['card_stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">до '.$meta['card_stavka'][0].'</div></div>';
         }
         if(strlen($meta['ratings_average'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['ratings_average'][0].'</div></div></div>';
         }	
         $html .= '</div>';
     }	
     $html .= '</div>';
 }

 
 if ($type == 'debit_card') {
     $html .= '<div class="code3 '.$back.'"><span class="frecom">Финабанк рекомендует!</span>
         <div class="code3head">
             <div class="w30">Предложение</div>
             <div class="text-center">Кэшбек</div>
             <div class="text-center">% на остаток</div>
             <div class="text-center">Снятие без %</div>
             <div class="text-center">Овердрафт</div>
             <div class="text-center">Стоимость</div>
             <div class="text-center">Рейтинг</div>
         </div>';

     $metas = [];	

     foreach($idArray as $id) {
         $meta = get_post_meta( $id ); 		
         $url = get_the_permalink($id); 
         $html .= '<div class="code3text">';
         $html .= '<div class="w30 strong td2"><a href="'.$url.'" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">'.get_the_title($id).'</a></div>';
         if(strlen($meta['card_cashback'][0]) > 0) {		
            $value = get_field( "card_cashback", $atts['id'] );
             $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val">'.$value.' %</div></div>';
         }	
         if(strlen($meta['card_stavka_ostatok'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% на остаток</div><div class="td-val">'.$meta['card_stavka_ostatok'][0].'</div></div>';
         }	
         if(strlen($meta['non_pecent_money'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Снятие без %</div><div class="td-val srok1">'.$meta['non_pecent_money'][0].'</div></div>';
         }
         if(strlen($meta['card_overdraft'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Овердрафт</div><div class="td-val srok1">'.$meta['card_overdraft'][0].'</div></div>';
         }
         if(strlen($meta['card_cost'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">'.$meta['card_cost'][0].'</div></div>';
         }
         if(strlen($meta['ratings_average'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['ratings_average'][0].'</div></div></div>';
         }	
         $html .= '</div>';
     }	
     $html .= '</div>';
 }


 $html .= '</div>';

 return $html;
 endif;
}

add_shortcode( 'code3v2', 'code_type_3v2' );

function code_type_4v2( $atts ) {

 if (!empty($atts['ids']) && !empty($atts['type'])):

 global $wpdb; 
 $back = $atts['back'];
 $idArray = explode(',', $atts['ids']);
 $html = '<div class="code4wrapper"><span class="frecom">Финабанк рекомендует!</span><div class="code4">';
 $type = $atts['type']?:'credit_card';	
 foreach($idArray as $id) {
     $meta = get_post_meta( $id );
     /*echo '<pre>';
     var_dump($meta);
     echo '</pre>';*/

    $query = "SELECT sum(`meta_value`) as value FROM ".$wpdb->prefix."commentmeta
     left join ".$wpdb->prefix."comments on (".$wpdb->prefix."comments.comment_ID = ".$wpdb->prefix."commentmeta.comment_id)
     WHERE comment_approved=1 and `comment_post_ID`='".$id."' `meta_key`='cld_like_count'";    
    $likesQuery = $wpdb->get_results( $query);      
    $likes = $likesQuery[0]->value;

     $html .= '<div class="code4block '.$back.'">
                 <div class="code4title">';
     $html .= '<div>';
     
     $img = get_field('bank_logo', get_field('bank_choise', $id));
     if($img) {         
         $html .= '<img src="'.$img.'" />';
     }
     $html .= '</div>
                     <div>'.get_the_title($id).'</div>
                 </div>
                 <div class="code4data">
                     <div class="d-flex align-center"><div><img src="/codes/heart.svg" /></div><div>'.(int)$likes.'</div></div>
                     <div class="d-flex align-center"><div><img src="/codes/feeds.svg" /></div><div>'.(int)get_comment_count($id).'</div></div>
                     <div class="d-flex align-center"><div><img src="/codes/star.svg" /></div><div>'.(int)$meta['ratings_average'][0].'</div></div>
                 </div>';
                 

                 if ($type == 'credit_card')  {
                    if(strlen($meta['card_period'][0]) > 0) {
                        $value = get_field( "card_period", $id );
                        $html .= '<div class="code4till">
                        '.$value['label'].'
                    </div>';
                    }

                    if(intval($meta['card_stavka'][0]) > 0) {
                    $html .= '<div class="code4big">
                            От '.$meta['card_stavka'][0].' %
                        </div>';
                    }
                }
                if ($type == 'zaim')  {
                    if(strlen($meta['card_period'][0]) > 0) {
                        $value = get_field( "card_period", $id );
                        $html .= '<div class="code4till">
                        '.$value['label'].'
                    </div>';
                    }

                    if(strlen($meta['from'][0]) > 0) {
                    $html .= '<div class="code4big">
                            От '.$meta['from'][0].' %
                        </div>';
                    }
                }

                if ($type == 'kredit')  {
                    if(strlen($meta['card_period'][0]) > 0) {
                        $value = get_field( "card_period", $id );
                        $html .= '<div class="code4till">
                        '.$value['label'].'
                    </div>';
                    }

                    if(strlen($meta['from'][0]) > 0) {
                    $html .= '<div class="code4big">
                            От '.$meta['from'][0].' %
                        </div>';
                    }
                }

                if ($type == 'debit_card')  {
                    if(strlen($meta['card_period'][0]) > 0) {
                        $value = get_field( "card_period", $id );
                        $html .= '<div class="code4till">
                        '.$value['label'].'
                    </div>';
                    }

                    if(strlen($meta['from'][0]) > 0) {
                    $html .= '<div class="code4big">
                            От '.$meta['from'][0].' %
                        </div>';
                    }
                }

                 $html .= '<div class="code4limit">';
                 
                 
                 if ($type == 'credit_card')  {
                     if(strlen($meta['card_cred_limit'][0]) > 0) {
                         $html .= '<div>Лимит - до '.number_format($meta['card_cred_limit'][0], 0, '', ' ').' ₽</div>';
                     }	
                     if(strlen($meta['card_period'][0]) > 0) {
                        $value = get_field( "card_period", $id );
                         $html .= '<div>Срок - '.$value['label'].'</div>';
                     }							
                 }	

                 if ($type == 'zaim')  {
                     if(strlen($meta['z_stavka'][0]) > 0) {
                         $html .= '<div>Сумма - '.number_format($meta['z_stavka'][0], 0, '', ' ').' ₽</div>';
                     }	
                     if(strlen($meta['z_time'][0]) > 0) {
                        $value = get_field( "z_time", $id );
                         $html .= '<div>Срок - '.$value['label'].'</div>';
                     }	
                 }

                 if ($type == 'kredit')  {
                     if(strlen($meta['credit_stavka'][0]) > 0) {
                         $html .= '<div>% ставка - '.$meta['credit_stavka'][0].'</div>';
                     }	
                     if(strlen($meta['credit_period'][0]) > 0) {
                        $value = get_field( "credit_period", $id );
                         $html .= '<div>Срок - '.$value['label'].'</div>';
                     }	
                 }

                 if ($type == 'debit_card')  {
                     if(strlen($meta['non_pecent_money'][0]) > 0) {
                         $html .= '<div>Снятие без % - '.$meta['non_pecent_money'][0].'</div>';
                     }	
                     if(strlen($meta['card_cashback'][0]) > 0) {
                        $value = get_field( "card_cashback", $atts['id'] );
                         $html .= '<div>Кэшбек - '.$value['label'].'</div>';
                     }	
                 }

                 $html .= '</div>';

                 $url = get_the_permalink($id);    
                 $html .= '<a target="_blank" href="'.$url.'" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_showcase\'); return true;">Подробнее</a>';

                 $html .= '</div>';
 }
 $html .= '</div></div>';

 return $html;
 endif;
}
add_shortcode( 'code4v2', 'code_type_4v2' );
