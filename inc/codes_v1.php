<?php

function code_type_1( $atts ) {
 if (!empty($atts['id']) && !empty($atts['type'])):
 $meta = get_post_meta( $atts['id'] );

 if(isset($atts['back'])){
     $back = $atts['back'];
 }else{
     $back = null;
 }


 $html = '<div class="code1wrapper"><div class="code1 '.$back.'">
             <span class="frecom">Финабанк рекомендует!</span>
             <div class="code1title">'.get_the_title($atts['id']).'</div> 
             <div class="code1body">
                 <div>';
                 if(strlen($meta['image'][0]) > 0) {
                     $image = wp_get_attachment_image_src($meta['image'][0], 'large'); 
                     $html .= '<img src="'.$image[0].'" />';
                 }	

                     //<img src="images/tinkoff.png" />
                 $html .='</div>    
                 <div class="code1bodytext">';
                 $type = $atts['type']?:'credit_card';	
                 
                 if ($type == 'credit_card')  {
                     if(strlen($meta['limit'][0]) > 0) {
                         $html .= '<div>Кред. лимит: <span>'.number_format($meta['limit'][0], 0, '', ' ').' ₽</span></div>';
                     }
                     if(strlen($meta['nopercents'][0]) > 0) {
                         $html .= '<div>Без процентов: <span>'.$meta['nopercents'][0].'</span></div>';
                     }
                     if(strlen($meta['cost'][0]) > 0) {
                         $html .= '<div>Стоимость: <span>От '.$meta['cost'][0].' ₽</span></div>';
                     }
                     if(strlen($meta['cashback'][0]) > 0) {
                         $html .= '<div>Кэшбек: <span>'.$meta['cashback'][0].'%</span></div>';
                     }
                     if(strlen($meta['stavka'][0]) > 0) {
                         $html .= '<div>Cтавка: <span>'.$meta['stavka'][0].'</span></div>';
                     }

                     if(strlen($meta['decision'][0]) > 0) {
                         $html .= '<div>Решение: <span>'.$meta['decision'][0].'</span></div>';
                     }
                 }	

                 if ($type == 'zaim')  {
                     if(strlen($meta['summa'][0]) > 0) {
                         $html .= '<div>Сумма: <span>'.number_format($meta['summa'][0], 0, '', ' ').' ₽</span></div>';
                     }
                     if(strlen($meta['history'][0]) > 0) {
                         $html .= '<div>Кредитная история: <span>'.$meta['history'][0].'</span></div>';
                     }
                     if(strlen($meta['stavka'][0]) > 0) {
                         $html .= '<div>% ставка: <span>От '.$meta['stavka'][0].' ₽</span></div>';
                     }
                     if(strlen($meta['srok'][0]) > 0) {
                         $html .= '<div>Срок: <span>'.$meta['srok'][0].'</span></div>';
                     }
                     if(strlen($meta['age'][0]) > 0) {
                         $html .= '<div>Возраст: <span>'.$meta['age'][0].'</span></div>';
                     }
                     if(strlen($meta['decision'][0]) > 0) {
                         $html .= '<div>Решение: <span>'.$meta['decision'][0].'</span></div>';
                     }
                 }

                 if ($type == 'kredit')  {
                     if(strlen($meta['srok'][0]) > 0) {
                         $html .= '<div>Срок: <span>'.$meta['srok'][0].'</span></div>';
                     }
                     if(strlen($meta['stavka'][0]) > 0) {
                         $html .= '<div>% ставка : <span>'.$meta['stavka'][0].'</span></div>';
                     }
                     if(strlen($meta['vznos'][0]) > 0) {
                         $html .= '<div>Минимальная сумма: <span>'.$meta['vznos'][0].' ₽</span></div>';
                     }
                     if(strlen($meta['summax'][0]) > 0) {
                         $html .= '<div>Максимальная сумма: <span>'.$meta['summax'][0].' ₽</span></div>';
                     }
                     if(strlen($meta['age'][0]) > 0) {
                         $html .= '<div>Возраст: <span>'.$meta['age'][0].'</span></div>';
                     }
                     if(strlen($meta['decision'][0]) > 0) {
                         $html .= '<div>Решение: <span>'.$meta['decision'][0].'</span></div>';
                     }
                 }

                 if ($type == 'debit_card')  {
                     if(strlen($meta['cashback'][0]) > 0) {
                         $html .= '<div>Кэшбек: <span>'.number_format(floatval($meta['cashback'][0]), 0, '', ' ').' ₽</span></div>';
                     }
                     if(strlen($meta['na_ostatok'][0]) > 0) {
                         $html .= '<div>% на остаток: <span>'.$meta['na_ostatok'][0].'</span></div>';
                     }
                     if(strlen($meta['nopercents'][0]) > 0) {
                         $html .= '<div>Снятие без %: <span>От '.$meta['nopercents'][0].' ₽</span></div>';
                     }
                     if(strlen($meta['overdraft'][0]) > 0) {
                         $html .= '<div>Овердрафт: <span>'.$meta['overdraft'][0].'</span></div>';
                     }
                     if(strlen($meta['cost'][0]) > 0) {
                         $html .= '<div>Стоимость: <span>'.$meta['cost'][0].'</span></div>';
                     }
                     if(strlen($meta['decision'][0]) > 0) {
                         $html .= '<div>Решение: <span>'.$meta['decision'][0].'</span></div>';
                     }
                 }

                     if(strlen($meta['link'][0]) > 0) {
                         $linkArray = unserialize($meta['link'][0]);
                         $html .= '<div class="morehref"><a target="_blank" href="'.$linkArray['url'].'" class="more" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_product\'); return true;">Подробнее</a></div>';
                     }	
 $html .= 		'</div>
             </div>
         </div></div>';
  
 return $html;
 endif;
}

add_shortcode( 'code1', 'code_type_1' );

function code_type_2( $atts ) {
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
             if(strlen($meta['link'][0]) > 0) {
                 $linkArray = unserialize($meta['link'][0]);
                 $html .= '<div><a target="_blank" href="'.$linkArray['url'].'" class="more" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_CTA_text\'); return true;">Подробнее</a></div>';
             }				
 $html .= '</div></div>';

 return $html;
 endif;
}

add_shortcode( 'code2', 'code_type_2' );

function code_type_5( $atts ) {
 if (!empty($atts['id']) && !empty($atts['type'])):
 $meta = get_post_meta( $atts['id'] );
 $back = $atts['back'];
 $content_post = get_post($atts['id']);
 $content = $content_post->post_content;
 $content = apply_filters('the_content', $content);
 $content = str_replace(']]>', ']]&gt;', $content);

 $oform = '';
 $more = '';

 if(strlen($meta['oformit'][0]) > 0) {
     $linkArray = unserialize($meta['oformit'][0]);
     $oform .= '<a href="'.$linkArray['url'].'" class="oform" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_CTA_product\'); return true;">Оформить</a>';
 }	

 if(strlen($meta['more'][0]) > 0) {
     $linkArray = unserialize($meta['more'][0]);
     $more .= '<a href="'.$linkArray['url'].'" class="code5more">Подробнее</a>';
 }	

 $type = $atts['type']?:'credit_card';	

 $html = '<div class="code5wrapper"><div class="code5block '.$back.'">				
             <div class="code5text">
                 <span class="frecom">Финабанк рекомендует!</span>
                 <div class="code5title">'.get_the_title($atts['id']).'</div>
                 <div class="code5description">				
                     '.$content.'
                 </div>
                 <div class="code5chars">';
                 
                 if ($type == 'credit_card')  {
                     if(strlen($meta['limit'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.number_format($meta['limit'][0], 0, '', ' ').' ₽</span>
                         <div>Кред. лимит</div>
                     </div>';

                     }
                     if(strlen($meta['nopercents'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.number_format($meta['nopercents'][0], 0, '', ' ').' ₽</span>
                         <div>Без процентов</div>
                     </div>';
                     }
                     if(strlen($meta['cost'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>От '.$meta['cost'][0].' ₽</span>
                         <div>Стоимость</div>
                     </div>';
                     }
                     if(strlen($meta['cashback'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>От '.$meta['cashback'][0].' ₽</span>
                         <div>Кэшбек</div>
                     </div>';
                     }
                     if(strlen($meta['stavka'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>От '.$meta['stavka'][0].' ₽</span>
                         <div>Cтавка</div>
                     </div>';
                     }

                     if(strlen($meta['decision'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['decision'][0].'</span>
                                     <div>Решение</div>
                                 </div>';
                     }
                 }	

                 if ($type == 'zaim')  {
                     if(strlen($meta['summa'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.number_format($meta['summa'][0], 0, '', ' ').' ₽</span>
                         <div>Сумма</div>
                     </div>';
                     }
                     if(strlen($meta['history'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.$meta['history'][0].'</span>
                         <div>Кредитная история</div>
                     </div>';
                     }
                     if(strlen($meta['stavka'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.$meta['stavka'][0].'</span>
                         <div>% ставка</div>
                     </div>';
                     }

                     if(strlen($meta['age'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['age'][0].'</span>
                                     <div>Возраст</div>
                                 </div>';
                     }

                     if(strlen($meta['srok'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.$meta['srok'][0].'</span>
                         <div>Срок</div>
                     </div>';
                     }

                     if(strlen($meta['decision'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['decision'][0].'</span>
                                     <div>Решение</div>
                                 </div>';
                     }

                 }

                 if ($type == 'kredit')  {
                     if(strlen($meta['summax'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                 <span>'.number_format($meta['summax'][0], 0, '', ' ').' ₽</span>
                                 <div>Макс. сумма</div>
                             </div>';
                     }
                     if(strlen($meta['vznos'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.number_format($meta['vznos'][0], 0, '', ' ').' ₽</span>
                         <div>Минимальная сумма</div>
                     </div>';
                     }

                     if(strlen($meta['stavka'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.$meta['stavka'][0].'</span>
                         <div>% ставка</div>
                     </div>';

                     }
                     
                     if(strlen($meta['age'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                             <span>'.$meta['age'][0].'</span>
                             <div>Возраст</div>
                         </div>';

                     }

                     if(strlen($meta['srok'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.$meta['srok'][0].'</span>
                         <div>Срок</div>
                     </div>';

                     }
                     
                     if(strlen($meta['decision'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['decision'][0].'</span>
                                     <div>Решение</div>
                                 </div>';
                     }
                 }

                 if ($type == 'debit_card')  {
                     if(strlen($meta['nopercents'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['nopercents'][0].'</span>
                                     <div>Снятие без %</div>
                                 </div>';
                     }
                     if(strlen($meta['na_ostatok'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['na_ostatok'][0].'</span>
                                     <div>% на остаток</div>
                                 </div>';
                     }

                     if(strlen($meta['cashback'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                         <span>'.number_format($meta['cashback'][0], 0, '', ' ').' ₽</span>
                         <div>Кэшбек</div>
                     </div>';
                         
                     }
                     
                     
                     if(strlen($meta['overdraft'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['overdraft'][0].'</span>
                                     <div>Овердрафт</div>
                                 </div>';
                     }
                     if(strlen($meta['cost'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['cost'][0].'</span>
                                     <div>Стоимость</div>
                                 </div>';
                     }
                     if(strlen($meta['decision'][0]) > 0) {
                         $html .= '<div class="code5charblock">
                                     <span>'.$meta['decision'][0].'</span>
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
             if(strlen($meta['picture'][0]) > 0) {


                 $logo_alt = get_post_meta($meta['picture'][0], '_wp_attachment_image_alt', true);

                 $image = wp_get_attachment_image_src($meta['picture'][0], 'large'); 
                 $html .= '<img alt="' . $logo_alt . '" src="'.$image[0].'" />';
             }		


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

add_shortcode( 'code5', 'code_type_5' );



function code_type_31( $atts ) {
 if (!empty($atts['ids']) && !empty($atts['type'])):
 $idArray = explode(',', $atts['ids']);

 $back = $atts['back'];
 $type = $atts['type']?:'kredit';	
 $html = '<div class="code31wrapper"><span class="frecom">Финабанк рекомендует!</span>';
 if ($type == 'kredit') {
     foreach($idArray as $id) {
         $meta = get_post_meta( $id );		
         $html .= '<div style="width:100%" class="strong td2"><a href="'.$meta['product_link'][0].'">'.get_the_title($id).'</a></div>';

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
         if(strlen($meta['max_sum'][0]) > 0) {		
             $html .= '<div class="td erst"><div class="hidden-lg">Макс. сумма</div><div class="td-val">'.number_format($meta['max_sum'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Ставка</div><div class="td-val">'.$meta['stavka'][0].'%</div></div>';
         }	
         if(strlen($meta['srok'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">до '.$meta['srok'][0].'</div></div>';
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
         $html .= '<div style="width:100%" class="strong td2"><a href="'.$meta['product_link'][0].'">'.get_the_title($id).'</a></div>';

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
         
         if(strlen($meta['sumzaim'][0]) > 0) {		
             $html .= '<div class="td erst"><div class="hidden-lg">Сумма</div><div class="td-val">'.number_format($meta['sumzaim'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['history'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Кредитная история</div><div class="td-val">'.$meta['history'][0].'</div></div>';
         }	
         if(strlen($meta['stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до '.$meta['stavka'][0].'</div></div>';
         }	
         $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">'.$meta['srok'][0].'</div></div>';
         if(strlen($meta['rating'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['rating'][0].'</div></div></div>';
         }	

         $html .= '</div>';
         $html .= '</div>';
     }
 }
 

 if ($type == 'credit_card') {
     foreach($idArray as $id) {
         $meta = get_post_meta( $id );		
         $html .= '<div style="width:100%" class="strong td2"><a href="'.$meta['product_link'][0].'">'.get_the_title($id).'</a></div>';

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
         
         if(strlen($meta['limit'][0]) > 0) {		
             $html .= '<div class="td text-center"><div class="hidden-lg">Кредитный лимит</div><div class="td-val">'.number_format($meta['limit'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['lgot'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Льготный период</div><div class="td-val">'.$meta['lgot'][0].'</div></div>';
         }	
         if(strlen($meta['stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до '.$meta['stavka'][0].'</div></div>';
         }
         if(strlen($meta['cachback'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val srok1">до '.$meta['cachback'][0].'</div></div>';
         }	
         if(strlen($meta['stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">до '.$meta['stavka'][0].'</div></div>';
         }
         if(strlen($meta['rating'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['rating'][0].'</div></div></div>';
         }	
         $html .= '</div>';
         $html .= '</div>';
     }			
 }

 
 if ($type == 'debit_card') {
     foreach($idArray as $id) {
         $meta = get_post_meta( $id );		
         $html .= '<div style="width:100%" class="strong td2"><a href="'.$meta['product_link'][0].'">'.get_the_title($id).'</a></div>';

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
         if(strlen($meta['cachback'][0]) > 0) {		
             $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val">'.number_format($meta['cachback'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['percent'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% на остаток</div><div class="td-val">'.$meta['percent'][0].'</div></div>';
         }	
         if(strlen($meta['nopercents'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Снятие без %</div><div class="td-val srok1">'.$meta['nopercents'][0].'</div></div>';
         }
         if(strlen($meta['overdraft'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Овердрафт</div><div class="td-val srok1">'.$meta['overdraft'][0].'</div></div>';
         }
         if(strlen($meta['debet_cost'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">'.$meta['debet_cost'][0].'</div></div>';
         }
         if(strlen($meta['rating'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['rating'][0].'</div></div></div>';
         }	
         $html .= '</div>';
         $html .= '</div>';
     }			
 }


 $html .= '</div>';

 return $html;
 endif;
}

add_shortcode( 'code31', 'code_type_31' );


function code_type_3( $atts ) {
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
         $html .= '<div class="code3text">';
         $html .= '<div class="w30 strong td2"><span><a href="'.$meta['product_link'][0].'" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">'.get_the_title($id).'</a></span></div>';
         if(strlen($meta['max_sum'][0]) > 0) {		
             $html .= '<div class="td text-center"><div class="hidden-lg">Макс. сумма</div><div class="td-val">'.number_format($meta['max_sum'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Ставка</div><div class="td-val">'.$meta['stavka'][0].'%</div></div>';
         }	
         if(strlen($meta['srok'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">до '.$meta['srok'][0].'</div></div>';
         }	
         $html .= '<div class="td text-center"><div class="hidden-lg">Первонач. взнос</div><div class="td-val">'.((int)$meta['vznos'][0] > 0 ? $meta['vznos'][0] : 'Отсутствует').'</div></div>';
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
         $html .= '<div class="code3text">';
         $html .= '<div class="w30 strong td2"><a href="'.$meta['product_link'][0].'" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">'.get_the_title($id).'</a></div>';
         if(strlen($meta['sumzaim'][0]) > 0) {		
             $html .= '<div class="td text-center"><div class="hidden-lg">Сумма</div><div class="td-val">'.number_format($meta['sumzaim'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['history'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Кредитная история</div><div class="td-val">'.$meta['history'][0].'</div></div>';
         }	
         if(strlen($meta['stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до '.$meta['stavka'][0].'</div></div>';
         }	
         $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">'.$meta['srok'][0].'</div></div>';
         if(strlen($meta['rating'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['rating'][0].'</div></div></div>';
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
         $html .= '<div class="code3text">';
         $html .= '<div class="w30 strong td2"><a href="'.$meta['product_link'][0].'" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">'.get_the_title($id).'</a></div>';
         if(strlen($meta['limit'][0]) > 0) {		
             $html .= '<div class="td text-center"><div class="hidden-lg">Кредитный лимит</div><div class="td-val">'.number_format($meta['limit'][0], 0, '', ' ').' ₽</div></div>';
         }	
         if(strlen($meta['lgot'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Льготный период</div><div class="td-val">'.$meta['lgot'][0].'</div></div>';
         }	
         if(strlen($meta['stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до '.$meta['stavka'][0].'</div></div>';
         }
         if(strlen($meta['cachback'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val srok1">до '.$meta['cachback'][0].'</div></div>';
         }	
         if(strlen($meta['stavka'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">до '.$meta['stavka'][0].'</div></div>';
         }
         if(strlen($meta['rating'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['rating'][0].'</div></div></div>';
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
         $html .= '<div class="code3text">';
         $html .= '<div class="w30 strong td2"><a href="'.$meta['product_link'][0].'" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">'.get_the_title($id).'</a></div>';
         if(strlen($meta['cachback'][0]) > 0) {		
             $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val">'.number_format($meta['cachback'][0], 0, '', ' ').' %</div></div>';
         }	
         if(strlen($meta['percent'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">% на остаток</div><div class="td-val">'.$meta['percent'][0].'</div></div>';
         }	
         if(strlen($meta['nopercents'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Снятие без %</div><div class="td-val srok1">'.$meta['nopercents'][0].'</div></div>';
         }
         if(strlen($meta['overdraft'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Овердрафт</div><div class="td-val srok1">'.$meta['overdraft'][0].'</div></div>';
         }
         if(strlen($meta['debet_cost'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">'.$meta['debet_cost'][0].'</div></div>';
         }
         if(strlen($meta['rating'][0]) > 0) {
             $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>'.$meta['rating'][0].'</div></div></div>';
         }	
         $html .= '</div>';
     }	
     $html .= '</div>';
 }


 $html .= '</div>';

 return $html;
 endif;
}

add_shortcode( 'code3', 'code_type_3' );

function code_type_4( $atts ) {
 if (!empty($atts['ids']) && !empty($atts['type'])):
 $back = $atts['back'];
 $idArray = explode(',', $atts['ids']);
 $html = '<div class="code4wrapper"><span class="frecom">Финабанк рекомендует!</span><div class="code4">';
 foreach($idArray as $id) {
     $meta = get_post_meta( $id );
     /*echo '<pre>';
     var_dump($meta);
     echo '</pre>';*/


     $html .= '<div class="code4block '.$back.'">
                 <div class="code4title">';
     $html .= '<div>';
     if(strlen($meta['logotype'][0]) > 0) {
         $image = wp_get_attachment_image_src($meta['logotype'][0], 'large'); 
         $html .= '<img src="'.$image[0].'" />';
     }
     $html .= '</div>
                     <div>'.get_the_title($id).'</div>
                 </div>
                 <div class="code4data">
                     <div class="d-flex align-center"><div><img src="/codes/heart.svg" /></div><div>'.(int)$meta['likes'][0].'</div></div>
                     <div class="d-flex align-center"><div><img src="/codes/feeds.svg" /></div><div>'.(int)$meta['feeds'][0].'</div></div>
                     <div class="d-flex align-center"><div><img src="/codes/star.svg" /></div><div>'.(int)$meta['rating'][0].'</div></div>
                 </div>';
                 if(strlen($meta['nopercents'][0]) > 0) {
                 $html .= '<div class="code4till">
                     До '.$meta['nopercents'][0].' дней без процентов    
                 </div>';
                 }
                 if(strlen($meta['from'][0]) > 0) {
                 $html .= '<div class="code4big">
                         От '.$meta['from'][0].' %
                     </div>';
                 }

                 $html .= '<div class="code4limit">';
                 $type = $atts['type']?:'credit_card';	
                 
                 if ($type == 'credit_card')  {
                     if(strlen($meta['limit'][0]) > 0) {
                         $html .= '<div>Лимит - до '.number_format($meta['limit'][0], 0, '', ' ').' ₽</div>';
                     }	
                     if(strlen($meta['srok'][0]) > 0) {
                         $html .= '<div>Срок - '.$meta['srok'][0].'</div>';
                     }							
                 }	

                 if ($type == 'zaim')  {
                     if(strlen($meta['stavka'][0]) > 0) {
                         $html .= '<div>Сумма - '.number_format($meta['summa'][0], 0, '', ' ').' ₽</div>';
                     }	
                     if(strlen($meta['srok'][0]) > 0) {
                         $html .= '<div>Срок - '.$meta['srok'][0].'</div>';
                     }	
                 }

                 if ($type == 'kredit')  {
                     if(strlen($meta['stavka'][0]) > 0) {
                         $html .= '<div>% ставка - '.$meta['stavka'][0].'</div>';
                     }	
                     if(strlen($meta['srok'][0]) > 0) {
                         $html .= '<div>Срок - '.$meta['srok'][0].'</div>';
                     }	
                 }

                 if ($type == 'debit_card')  {
                     if(strlen($meta['nopercents'][0]) > 0) {
                         $html .= '<div>Снятие без % - '.$meta['nopercents'][0].'</div>';
                     }	
                     if(strlen($meta['cashback'][0]) > 0) {
                         $html .= '<div>Кэшбек - '.$meta['cashback'][0].'%</div>';
                     }	
                 }

                 $html .= '</div>';

                 if(strlen($meta['link'][0]) > 0) {
                     $linkArray = unserialize($meta['link'][0]);
                     $html .= '<a target="_blank" href="'.$linkArray['url'].'" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_showcase\'); return true;">Подробнее</a>';
                 }	

                 $html .= '</div>';
 }
 $html .= '</div></div>';

 return $html;
 endif;
}
add_shortcode( 'code4', 'code_type_4' );
