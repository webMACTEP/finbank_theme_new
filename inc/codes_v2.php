<?php

function code_type_1v2($atts)
{
    global $wpdb;
    if (!empty($atts['id']) && !empty($atts['type'])):
        $meta = get_post_meta($atts['id']);
        $back = $atts['back'];

        // Получаем альтернативный заголовок для текущей записи
        $alter_title = get_field('alter_title', $atts['id']);
        $title = !empty($alter_title) ? esc_html($alter_title) : esc_html(get_the_title($atts['id']));

        $html = '<div class="code1wrapper">
                    <div class="code1 ' . esc_attr($back) . '">
                         <span class="frecom">Финабанк рекомендует!</span>
                         <div class="code1title">' . $title . '</div> 
                         <div class="code1body">
                             <div>';

        if (strlen($meta['card_logo'][0]) > 0) {
            $image = wp_get_attachment_image_src($meta['card_logo'][0], 'large');
            $html .= '<img src="' . esc_url($image[0]) . '" />';
        }

        $html .= '</div>    
                         <div class="code1bodytext">';
        $type = $atts['type'] ?: 'credit_card';

        if ($type == 'credit_card') {
            if (strlen($meta['card_cred_limit'][0]) > 0) {
                $html .= '<div>Кред. лимит: <span>' . number_format($meta['card_cred_limit'][0], 0, '', ' ') . ' ₽</span></div>';
            }
            if (strlen($meta['card_period'][0]) > 0) {
                $value = get_field("card_period", $atts['id']);
                $html .= '<div>Без процентов: <span>' . esc_html($value['label']) . '</span></div>';
            }
            if (strlen($meta['card_cost'][0]) > 0) {
                $html .= '<div>Стоимость: <span>От ' . esc_html($meta['card_cost'][0]) . ' ₽</span></div>';
            }
            if (strlen($meta['card_cashback'][0]) > 0) {
                $value = get_field("card_cashback", $atts['id']);
                $html .= '<div>Кэшбек: <span>' . esc_html($value) . '</span></div>';
            }
            if (strlen($meta['card_stavka'][0]) > 0) {
                $html .= '<div>Cтавка: <span>' . esc_html($meta['card_stavka'][0]) . ' %</span></div>';
            }
            if (strlen($meta['card_answ'][0]) > 0) {
                $html .= '<div>Решение: <span>' . esc_html($meta['card_answ'][0]) . '</span></div>';
            }
        }

        if ($type == 'zaim') {
            if (strlen($meta['z_sum'][0]) > 0) {
                $html .= '<div>Сумма: <span>' . number_format($meta['z_sum'][0], 0, '', ' ') . ' ₽</span></div>';
            }
            if (strlen($meta['z_history'][0]) > 0) {
                $html .= '<div>Кредитная история: <span>' . esc_html($meta['z_history'][0]) . '</span></div>';
            }
            if (strlen($meta['z_stavka'][0]) > 0) {
                $html .= '<div>% ставка: <span>От ' . esc_html($meta['z_stavka'][0]) . ' ₽</span></div>';
            }
            if (strlen($meta['z_time'][0]) > 0) {
                $html .= '<div>Срок: <span>' . esc_html($meta['z_time'][0]) . '</span></div>';
            }
            if (strlen($meta['z_oldness'][0]) > 0) {
                $html .= '<div>Возраст: <span>' . esc_html($meta['z_oldness'][0]) . '</span></div>';
            }
            if (strlen($meta['z_answer'][0]) > 0) {
                $html .= '<div>Решение: <span>' . esc_html($meta['z_answer'][0]) . '</span></div>';
            }
        }

        if ($type == 'kredit') {
            if (strlen($meta['credit_period'][0]) > 0) {
                $value = get_field("credit_period", $atts['id']);
                $html .= '<div>Срок: <span>' . esc_html($value['label']) . '</span></div>';
            }
            if (strlen($meta['credit_stavka'][0]) > 0) {
                $html .= '<div>% ставка : <span>' . esc_html($meta['credit_stavka'][0]) . '</span></div>';
            }
            if (strlen($meta['credit_min_sum'][0]) > 0) {
                $html .= '<div>Минимальная сумма: <span>' . number_format($meta['credit_min_sum'][0], 0, '', ' ') . ' ₽</span></div>';
            }
            if (strlen($meta['credit_max_sum'][0]) > 0) {
                $html .= '<div>Максимальная сумма: <span>' . number_format($meta['credit_max_sum'][0], 0, '', ' ') . ' ₽</span></div>';
            }
            if (strlen($meta['credit_oldness'][0]) > 0) {
                $html .= '<div>Возраст: <span>' . esc_html($meta['credit_oldness'][0]) . '</span></div>';
            }
            if (strlen($meta['credit_answer'][0]) > 0) {
                $html .= '<div>Решение: <span>' . esc_html($meta['credit_answer'][0]) . '</span></div>';
            }
        }

        if ($type == 'debit_card') {
            if (strlen($meta['card_cashback'][0]) > 0) {
                $value = get_field("card_cashback", $atts['id']);
                $html .= '<div>Кэшбек: <span>' . esc_html($value) . '</span></div>';
            }
            if (strlen($meta['card_stavka_ostatok'][0]) > 0) {
                $html .= '<div>% на остаток: <span>' . esc_html($meta['card_stavka_ostatok'][0]) . '</span></div>';
            }
            if (strlen($meta['non_pecent_money'][0]) > 0) {
                $html .= '<div>Снятие без %: <span>От ' . esc_html($meta['non_pecent_money'][0]) . ' ₽</span></div>';
            }
            if (strlen($meta['card_overdraft'][0]) > 0) {
                $html .= '<div>Овердрафт: <span>' . esc_html($meta['card_overdraft'][0]) . '</span></div>';
            }
            if (strlen($meta['card_cost'][0]) > 0) {
                $html .= '<div>Стоимость: <span>' . esc_html($meta['card_cost'][0]) . '</span></div>';
            }
            if (strlen($meta['card_answ'][0]) > 0) {
                $html .= '<div>Решение: <span>' . esc_html($meta['card_answ'][0]) . '</span></div>';
            }
        }
        $url = get_the_permalink($atts['id']);
        $html .= '<div class="morehref"><a target="_blank" href="' . esc_url($url) . '" class="more" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_product\'); return true;">Подробнее</a></div>';

        $html .=         '</div>
                     </div>
                 </div>
             </div>';

        return $html;
    endif;
}

add_shortcode('code1v2', 'code_type_1v2');



function code_type_2v2($atts)
{
    if (!empty($atts['id'])):
        $meta = get_post_meta($atts['id']);
        $content_post = get_post($atts['id']);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        // Получаем альтернативный заголовок для текущей записи
        $alter_title = get_field('alter_title', $atts['id']);
        $title = !empty($alter_title) ? esc_html($alter_title) : esc_html(get_the_title($atts['id']));

        $html = '<div class="code2wrapper">
                    <div class="code2 ' . esc_attr($meta['background_type'][0]) . '">
                        <span class="frecom">Финабанк рекомендует!</span>  
                        <div class="code2title">' . $title . '</div>
                        <div class="code2bodytext">' . $content . '</div>';

        $url = get_the_permalink($atts['id']);
        $html .= '<div><a target="_blank" href="' . esc_url($url) . '" class="more" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_CTA_text\'); return true;">Подробнее</a></div>';

        $html .= '</div></div>';

        return $html;
    endif;
}

add_shortcode('code2v2', 'code_type_2v2');


function code_type_5v2($atts)
{
    // Проверяем наличие необходимых атрибутов
    if (!empty($atts['id']) && !empty($atts['type'])) {
        // Получаем метаданные поста
        $meta = get_post_meta($atts['id']);
        $back = isset($atts['back']) ? $atts['back'] : '';
        $content_post = get_post($atts['id']);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        // Получаем ссылку на пост
        $url = get_the_permalink($atts['id']);
        

        // Формируем кнопки
        $oform = '<a href="' . esc_url($url) . '" class="oform" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_CTA_product\'); return true;">Оформить</a>';
        $more = '<a href="' . esc_url($url) . '" class="code5more">Подробнее</a>';

        // Определяем тип
        $type = !empty($atts['type']) ? $atts['type'] : 'credit_card';

        // Получаем альтернативный заголовок для текущей записи
        $alter_title = get_field('alter_title', $atts['id']);
        $title = !empty($alter_title) ? esc_html($alter_title) : esc_html(get_the_title($atts['id']));

        // Начинаем формировать HTML-контент
        $html = '<div class="code5wrapper">
                    <span class="frecom">Финабанк рекомендует!</span>
                    <div class="code5block ' . esc_attr($back) . '">				            
                         <div class="code5text">                 
                             <div class="code5title">' . $title . '</div>
                             <div class="code5description">' . $content . '</div>
                             <div class="code5chars ">';

        // Обработка различных типов
        if ($type == 'credit_card') {
            if (!empty($meta['card_cred_limit'][0])) {
                $html .= '<div class="code5charblock code5charblock-mini">
                            <div class="code5charblock-row">
                                <span>' . number_format(intval($meta['card_cred_limit'][0]), 0, '', ' ') . ' </span>
                                <span class="mini">₽</span>
                            </div>
                             <div>Кред. лимит</div>
                         </div>';
            }
            if (!empty($meta['card_stavka'][0])) {
                $html .= '<div class="code5charblock code5charblock-mini">
                            <div class="code5charblock-row">
                                <span class="mini">От</span>
                                <span> ' . esc_html($meta['card_stavka'][0]) . ' </span>
                                <span class="mini">%</span>
                            </div>
                             <div>Cтавка</div>
                         </div>';
            }
            if (!empty($meta['card_period'][0])) {
                $value = get_field("card_period", $atts['id']);
                $html .= '<div class="code5charblock code5charblock-mini">
                         <span>' . esc_html($value['label']) . '</span>
                         <div>Без процентов</div>
                     </div>';
            }
        }

        if ($type == 'zaim') {
            if (!empty($meta['z_sum'][0])) {
                $html .= '<div class="code5charblock">
                         <span>' . number_format(intval($meta['z_sum'][0]), 0, '', ' ') . ' ₽</span>
                         <div>Сумма</div>
                     </div>';
            }
            if (!empty($meta['z_time'][0])) {
                $html .= '<div class="code5charblock">
                         <span>' . esc_html($meta['z_time'][0]) . '</span>
                         <div>Срок</div>
                     </div>';
            }
            if (!empty($meta['z_stavka'][0])) {
                $html .= '<div class="code5charblock">
                         <span>' . esc_html($meta['z_stavka'][0]) . ' %</span>
                         <div>% ставка</div>
                     </div>';
            }
        }

        if ($type == 'kredit') {
            if (!empty($meta['credit_min_sum'][0])) {
                $html .= '<div class="code5charblock">
                         <span>' . number_format(intval($meta['credit_min_sum'][0]), 0, '', ' ') . ' ₽</span>
                         <div>Минимальная сумма</div>
                     </div>';
            }
            if (!empty($meta['credit_period'][0])) {
                $value = get_field("credit_period", $atts['id']);
                $html .= '<div class="code5charblock">
                         <span>' . esc_html($value['label']) . '</span>
                         <div>Срок</div>
                     </div>';
            }
            if (!empty($meta['credit_stavka'][0])) {
                $html .= '<div class="code5charblock">
                         <span>' . esc_html($meta['credit_stavka'][0]) . '</span>
                         <div>% ставка</div>
                     </div>';
            }
        }

        if ($type == 'debit_card') {
            if (!empty($meta['card_cost'][0])) {
                $html .= '<div class="code5charblock">
                         <span>' . esc_html($meta['card_cost'][0]) . '</span>
                         <div>Стоимость</div>
                     </div>';
            }
            if (!empty($meta['card_stavka_ostatok'][0])) {
                $html .= '<div class="code5charblock">
                         <span>' . esc_html($meta['card_stavka_ostatok'][0]) . '</span>
                         <div>% на остаток</div>
                     </div>';
            }
            if (!empty($meta['card_cashback'][0])) {
                $value = get_field("card_cashback", $atts['id']);
                $html .= '<div class="code5charblock">
                         <span>' . esc_html($value['label']) . '</span>
                         <div>Кэшбек</div>
                     </div>';
            }
        }

        // Закрываем divs и добавляем футер
        $html .= '			
                 </div>
                 <div class="code5footer">';

        $html .= $oform;
        $html .= $more;
        $html .= '</div>
             </div>
             <div class="code5image">';

        if (!empty($meta['card_logo'][0])) {
            $logo_alt = get_post_meta($meta['card_logo'][0], '_wp_attachment_image_alt', true);
            $image = wp_get_attachment_image_src($meta['card_logo'][0], 'large');
            $html .= '<img alt="' . esc_attr($logo_alt) . '" src="' . esc_url($image[0]) . '" />';
        }

        $html .= '</div>
             
             <div class="code5footer_mobile"><div class="col5">';
        $html .= $oform;
        $html .= '</div><div class="col5 right">';
        $html .= $more;
        $html .= '</div></div>
             </div></div>';

        return $html;
    }

    // Возвращаем пустую строку, если условия не выполнены
    return '';
}

add_shortcode('code5v2', 'code_type_5v2');




function code_type_31v2($atts)
{
    if (!empty($atts['ids']) && !empty($atts['type'])):

        $idArray = explode(',', $atts['ids']);

        $back = $atts['back'];
        $type = $atts['type'] ?: 'kredit';
        $html = '<div class="code31wrapper"><span class="frecom">Финабанк рекомендует!</span>';
        if ($type == 'kredit') {
            foreach ($idArray as $id) {
                $meta = get_post_meta($id);
                $url = get_the_permalink($id);
                $html .= '<div style="width:100%" class="strong td2"><a href="' . $url . '">' . get_the_title($id) . '</a></div>';

                $html .= '<div class="code3 code31 ' . $back . '"><span class="frecom">Финабанк рекомендует!</span>';
                $html .= '
         <div class="code3head">            
             <div class="erst">Макс. сумма</div>
             <div class="text-center">Ставка</div>
             <div class="text-center">Срок</div>
             <div class="text-center">Первонач.<br/> взнос</div>
             <div class="text-center">Рейтинг</div>
         </div>';

                $html .= '<div class="code3text">';
                if (strlen($meta['credit_max_sum'][0]) > 0) {
                    $html .= '<div class="td erst"><div class="hidden-lg">Макс. сумма</div><div class="td-val">' . number_format($meta['credit_max_sum'][0], 0, '', ' ') . ' ₽</div></div>';
                }
                if (strlen($meta['credit_stavka'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Ставка</div><div class="td-val">' . $meta['credit_stavka'][0] . '%</div></div>';
                }
                if (strlen($meta['credit_period'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">до ' . $meta['credit_period'][0] . '</div></div>';
                }
                $html .= '<div class="td text-center"><div class="hidden-lg">Первонач. взнос</div><div class="td-val">' . ((int)$meta['vznos'][0] > 0 ? $meta['vznos'][0] : 'Отсутствует') . '</div></div>';
                if (strlen($meta['rating'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>' . $meta['rating'][0] . '</div></div></div>';
                }
                $html .= '</div>';
                $html .= '</div>';
            }
        }

        if ($type == 'zaim') {
            foreach ($idArray as $id) {
                $meta = get_post_meta($id);
                $url = get_the_permalink($id);
                $html .= '<div style="width:100%" class="strong td2"><a href="' . $url . '">' . get_the_title($id) . '</a></div>';

                $html .= '<div class="code3 code31 ' . $back . '"><span class="frecom">Финабанк рекомендует!</span>';
                $html .= '
         <div class="code3head">            
             <div class="erst">Сумма</div>
             <div class="text-center">Кредитная<br/> история</div>
             <div class="text-center">% ставка</div>
             <div class="text-center">Срок</div>
             <div class="text-center">Рейтинг</div>
         </div>';

                $html .= '<div class="code3text">';

                if (strlen($meta['z_sum'][0]) > 0) {
                    $html .= '<div class="td erst"><div class="hidden-lg">Сумма</div><div class="td-val">' . number_format($meta['z_sum'][0], 0, '', ' ') . ' ₽</div></div>';
                }
                if (strlen($meta['z_history'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Кредитная история</div><div class="td-val">' . $meta['z_history'][0] . '</div></div>';
                }
                if (strlen($meta['z_stavka'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до ' . $meta['z_stavka'][0] . '</div></div>';
                }
                $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">до ' . $meta['z_time'][0] . ' дней</div></div>';
                if (strlen($meta['ratings_average'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>' . $meta['ratings_average'][0] . '</div></div></div>';
                }

                $html .= '</div>';
                $html .= '</div>';
            }
        }


        if ($type == 'credit_card') {
            foreach ($idArray as $id) {
                $meta = get_post_meta($id);
                $url = get_the_permalink($id);
                $html .= '<div style="width:100%" class="strong td2"><a href="' . $url . '">' . get_the_title($id) . '</a></div>';

                $html .= '<div class="code3 code31 ' . $back . '"><span class="frecom">Финабанк рекомендует!</span>
             <div class="code3head">
                 <div class="erst">Кредитный<br/>лимит</div>
                 <div class="text-center">Льготный<br/>период</div>
                 <div class="text-center">% ставка</div>
                 <div class="text-center">Кэшбек</div>
                 <div class="text-center">Стоимость</div>
                 <div class="text-center">Рейтинг</div>
             </div>';


                $html .= '<div class="code3text">';

                if (strlen($meta['card_cred_limit'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Кредитный лимит</div><div class="td-val">' . number_format($meta['card_cred_limit'][0], 0, '', ' ') . ' ₽</div></div>';
                }
                if (strlen($meta['card_period'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Льготный период</div><div class="td-val">' . $meta['card_period'][0] . '</div></div>';
                }
                if (strlen($meta['card_stavka'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до ' . $meta['card_stavka'][0] . '</div></div>';
                }
                if (strlen($meta['card_cashback'][0]) > 0) {
                    $value = get_field("card_cashback", $atts['id']);
                    $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val srok1">' . $value . '</div></div>';
                }
                if (strlen($meta['card_cost'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">до ' . $meta['card_cost'][0] . '</div></div>';
                }
                if (strlen($meta['ratings_average'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>' . $meta['ratings_average'][0] . '</div></div></div>';
                }
                $html .= '</div>';
                $html .= '</div>';
            }
        }


        if ($type == 'debit_card') {
            foreach ($idArray as $id) {
                $meta = get_post_meta($id);
                $url = get_the_permalink($id);
                $html .= '<div style="width:100%" class="strong td2"><a href="' . $url . '">' . get_the_title($id) . '</a></div>';

                $html .= '<div class="code3 code31 ' . $back . '"><span class="frecom">Финабанк рекомендует!</span>
             <div class="code3head">
                 <div class="erst">Кэшбек</div>
                 <div class="text-center">% на остаток</div>
                 <div class="text-center">Снятие без %</div>
                 <div class="text-center">Овердрафт</div>
                 <div class="text-center">Стоимость</div>
                 <div class="text-center">Рейтинг</div>
             </div>';

                $html .= '<div class="code3text">';
                if (strlen($meta['card_cashback'][0]) > 0) {
                    $value = get_field("card_cashback", $atts['id']);
                    $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val">' . $value . '</div></div>';
                }
                if (strlen($meta['card_stavka_ostatok'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">% на остаток</div><div class="td-val">' . $meta['card_stavka_ostatok'][0] . '</div></div>';
                }
                if (strlen($meta['non_pecent_money'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Снятие без %</div><div class="td-val srok1">' . $meta['non_pecent_money'][0] . '</div></div>';
                }
                if (strlen($meta['card_overdraft'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Овердрафт</div><div class="td-val srok1">' . $meta['card_overdraft'][0] . '</div></div>';
                }
                if (strlen($meta['card_cost'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">' . $meta['card_cost'][0] . '</div></div>';
                }
                if (strlen($meta['ratings_average'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>' . $meta['ratings_average'][0] . '</div></div></div>';
                }
                $html .= '</div>';
                $html .= '</div>';
            }
        }


        $html .= '</div>';

        return $html;
    endif;
}

add_shortcode('code31v2', 'code_type_31v2');


function code_type_3v2($atts)
{
    if (!empty($atts['ids']) && !empty($atts['type'])):

        $type = $atts['type'] ?: 'kredit';
        $idArray = explode(',', $atts['ids']);
        $back = $atts['back'];

        $html = '<div class="code3wrapper">';
        if ($type == 'kredit') {
            $html .= '<div class="code3 ' . $back . '"><span class="frecom">Финабанк рекомендует!</span>
         <div class="code3head">
             <div class="w30">Предложение</div>
             <div class="text-center">Макс. сумма</div>
             <div class="text-center">Ставка</div>
             <div class="text-center">Срок</div>
             <div class="text-center">Первонач.<br/> взнос</div>
             <div class="text-center">Рейтинг</div>
         </div>';

            $metas = [];



            foreach ($idArray as $id) {
                $meta = get_post_meta($id);
                $url = get_the_permalink($id);
                $html .= '<div class="code3text">';
                $html .= '<div class="w30 strong td2"><span><a href="' . $url . '" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">' . get_the_title($id) . '</a></span></div>';
                if (strlen($meta['credit_max_sum'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Макс. сумма</div><div class="td-val">' . number_format($meta['credit_max_sum'][0], 0, '', ' ') . ' ₽</div></div>';
                }
                if (strlen($meta['credit_stavka'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Ставка</div><div class="td-val">' . $meta['credit_stavka'][0] . '%</div></div>';
                }
                if (strlen($meta['credit_period'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">до ' . $meta['credit_period'][0] . '</div></div>';
                }
                //$html .= '<div class="td text-center"><div class="hidden-lg">Первонач. взнос</div><div class="td-val">'.((int)$meta['vznos'][0] > 0 ? $meta['vznos'][0] : 'Отсутствует').'</div></div>';
                if (strlen($meta['rating'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 td-val text-center"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>' . $meta['rating'][0] . '</div></div></div>';
                }
                $html .= '</div>';
            }
            $html .= '</div>';
        }

        if ($type == 'zaim') {
            $html .= '<div class="code3 ' . $back . '"><span class="frecom">Финабанк рекомендует!</span>
         <div class="code3head">
             <div class="w30">Предложение</div>
             <div class="text-center">Сумма</div>
             <div class="text-center">Кредитная<br/> история</div>
             <div class="text-center">% ставка</div>
             <div class="text-center">Срок</div>
             <div class="text-center">Рейтинг</div>
         </div>';

            $metas = [];

            foreach ($idArray as $id) {
                $meta = get_post_meta($id);
                $url = get_the_permalink($id);
                $html .= '<div class="code3text">';
                $html .= '<div class="w30 strong td2"><a href="' . $url . '" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">' . get_the_title($id) . '</a></div>';
                if (strlen($meta['z_sum'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Сумма</div><div class="td-val">' . number_format($meta['z_sum'][0], 0, '', ' ') . ' ₽</div></div>';
                }
                if (strlen($meta['z_history'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Кредитная история</div><div class="td-val">' . $meta['z_history'][0] . '</div></div>';
                }
                if (strlen($meta['z_stavka'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до ' . $meta['z_stavka'][0] . '</div></div>';
                }
                $html .= '<div class="td text-center"><div class="hidden-lg">Срок</div><div class="td-val">' . $meta['z_time'][0] . '</div></div>';
                if (strlen($meta['ratings_average'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>' . $meta['ratings_average'][0] . '</div></div></div>';
                }
                $html .= '</div>';
            }
            $html .= '</div>';
        }

        if ($type == 'credit_card') {
            $html .= '<div class="code3 ' . $back . '"><span class="frecom">Финабанк рекомендует!</span>
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

            foreach ($idArray as $id) {
                $meta = get_post_meta($id);
                $url = get_the_permalink($id);
                $html .= '<div class="code3text">';
                $html .= '<div class="w30 strong td2"><a href="' . $url . '" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">' . get_the_title($id) . '</a></div>';
                if (strlen($meta['card_cred_limit'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Кредитный лимит</div><div class="td-val">' . number_format($meta['card_cred_limit'][0], 0, '', ' ') . ' ₽</div></div>';
                }
                if (strlen($meta['card_period'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Льготный период</div><div class="td-val">' . $meta['card_period'][0] . '</div></div>';
                }
                if (strlen($meta['card_stavka'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">% ставка</div><div class="td-val srok1">до ' . $meta['card_stavka'][0] . '</div></div>';
                }
                if (strlen($meta['card_cashback'][0]) > 0) {
                    $value = get_field("card_cashback", $atts['id']);
                    $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val srok1">до ' . $value . '</div></div>';
                }
                if (strlen($meta['card_stavka'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">до ' . $meta['card_stavka'][0] . '</div></div>';
                }
                if (strlen($meta['ratings_average'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>' . $meta['ratings_average'][0] . '</div></div></div>';
                }
                $html .= '</div>';
            }
            $html .= '</div>';
        }


        if ($type == 'debit_card') {
            $html .= '<div class="code3 ' . $back . '"><span class="frecom">Финабанк рекомендует!</span>
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

            foreach ($idArray as $id) {
                $meta = get_post_meta($id);
                $url = get_the_permalink($id);
                $html .= '<div class="code3text">';
                $html .= '<div class="w30 strong td2"><a href="' . $url . '" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_sheet\'); return true;">' . get_the_title($id) . '</a></div>';
                if (strlen($meta['card_cashback'][0]) > 0) {
                    $value = get_field("card_cashback", $atts['id']);
                    $html .= '<div class="td text-center"><div class="hidden-lg">Кэшбек</div><div class="td-val">' . $value . ' %</div></div>';
                }
                if (strlen($meta['card_stavka_ostatok'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">% на остаток</div><div class="td-val">' . $meta['card_stavka_ostatok'][0] . '</div></div>';
                }
                if (strlen($meta['non_pecent_money'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Снятие без %</div><div class="td-val srok1">' . $meta['non_pecent_money'][0] . '</div></div>';
                }
                if (strlen($meta['card_overdraft'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Овердрафт</div><div class="td-val srok1">' . $meta['card_overdraft'][0] . '</div></div>';
                }
                if (strlen($meta['card_cost'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Стоимость</div><div class="td-val srok1">' . $meta['card_cost'][0] . '</div></div>';
                }
                if (strlen($meta['ratings_average'][0]) > 0) {
                    $html .= '<div class="td text-center"><div class="hidden-lg">Рейтинг</div><div class="rate3 text-center td-val"><div>
             <svg style="margin-right:5px;fill:var(--warning)" width="18" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17" xml:space="preserve"><use xlink:href="https://finabank.ru/wp-content/themes/finbank_theme/img/icons.svg#starLine" x="0" y="0"></use></svg>			
             </div> <div>' . $meta['ratings_average'][0] . '</div></div></div>';
                }
                $html .= '</div>';
            }
            $html .= '</div>';
        }


        $html .= '</div>';

        return $html;
    endif;
}

add_shortcode('code3v2', 'code_type_3v2');

function code_type_4v2($atts)
{
    if (empty($atts['ids']) || empty($atts['type'])) {
        return '';
    }

    global $wpdb;

    $back = isset($atts['back']) ? sanitize_html_class($atts['back']) : '';
    $idArray = array_map('intval', explode(',', $atts['ids']));
    $html = '<div class="code4wrapper"><span class="frecom">' . esc_html__('Финабанк рекомендует!', 'text-domain') . '</span><div class="code4">';
    $type = !empty($atts['type']) ? sanitize_text_field($atts['type']) : 'credit_card';

    foreach ($idArray as $id) {
        // Получение необходимых метаданных
        $meta = get_post_meta($id);

        // Подготовленный запрос для получения лайков
        $query = $wpdb->prepare(
            "SELECT SUM(meta_value) as value 
             FROM {$wpdb->prefix}commentmeta
             LEFT JOIN {$wpdb->prefix}comments 
               ON {$wpdb->prefix}comments.comment_ID = {$wpdb->prefix}commentmeta.comment_id
             WHERE comment_approved = 1 
               AND comment_post_ID = %d 
               AND meta_key = 'cld_like_count'",
            $id
        );
        $likesQuery = $wpdb->get_results($query);
        $likes = isset($likesQuery[0]->value) ? (int) $likesQuery[0]->value : 0;

        // Получение количества комментариев
        $comment_counts = get_comment_count($id);
        $approved_comments = isset($comment_counts['approved']) ? $comment_counts['approved'] : 0;

        // Начало блока
        $html .= '<div class="code4block ' . esc_attr($back) . '">
                    <div class="code4title">
                        <div>';

        $bank_choice = get_field('bank_choise', $id);

        switch ($type) {
            case 'credit_card':
            case 'debit_card':
                $bank_choice = get_field('bank_choise', $id);
                $img = $bank_choice ? get_field('bank_logo', $bank_choice) : '';
                break;

            case 'zaim':
                // Логотип хранится в текущем посте
                $img = get_field('z_organization_logo', $id);
                break;
            case 'kredit':
                // Логотип хранится в текущем посте
                $img = get_field('card_logo', $id);
                break;

            default:
                $img = '';
        }

        // Выводим, если логотип есть
        if ($img) {
            $html .= '<img src="' . esc_url($img) . '" alt="' . esc_attr(get_the_title($id)) . '" />';
        }


        $alter_title = get_field('alter_title', $id);

        $html .= '</div>
          <div>' . (!empty($alter_title) ? esc_html($alter_title) : esc_html(get_the_title($id))) . '</div>
        </div>
        <div class="code4data">
            <div class="d-flex align-center">
                <div><img src="/codes/heart.svg" alt="' . esc_attr__('Likes', 'text-domain') . '" /></div>
                <div>' . esc_html($likes) . '</div>
            </div>
            <div class="d-flex align-center">
                <div><img src="/codes/feeds.svg" alt="' . esc_attr__('Comments', 'text-domain') . '" /></div>
                <div>' . esc_html($approved_comments) . '</div>
            </div>
            <div class="d-flex align-center">
                <div><img src="/codes/star.svg" alt="' . esc_attr__('Rating', 'text-domain') . '" /></div>
                <div>' . esc_html((int) $meta['ratings_average'][0]) . '</div>
            </div>
        </div>';


        // Обработка типов
        switch ($type) {
            case 'credit_card':
                // if (!empty($meta['card_period'][0])) {
                //     $value = get_field("card_period", $id);
                //     if ($value && isset($value['label'])) {
                //         $html .= '<div class="code4till">' . esc_html($value['label']) . '</div>';
                //     }
                // }
                if (intval($meta['card_stavka'][0]) > 0) {
                    $html .= 'Ставка <div class="code4big">От ' . intval($meta['card_stavka'][0]) . ' %</div>';
                }
                break;

            case 'zaim':
            case 'kredit':
            case 'debit_card':
                // if (!empty($meta['card_period'][0])) {
                //     $value = get_field("card_period", $id);
                //     if ($value && isset($value['label'])) {
                //         $html .= '<div class="code4till">' . esc_html($value['label']) . '</div>';
                //     }
                // }
                // if (!empty($meta['from'][0])) {
                //     $html .= '<div class="code4big">От ' . esc_html($meta['from'][0]) . ' %</div>';
                // }
                break;
        }

        // Блок лимитов
        $html .= '<div class="code4limit">';
        switch ($type) {
            case 'credit_card':
                if (!empty($meta['card_cred_limit'][0])) {
                    $html .= '<div>Лимит - до ' . number_format(floatval($meta['card_cred_limit'][0]), 0, '', ' ') . ' ₽</div>';
                }
                if (!empty($meta['card_period'][0])) {
                    $value = get_field("card_period", $id);
                    if ($value && isset($value['label'])) {
                        $html .= '<div>Период - ' . esc_html($value['label']) . '</div>';
                    }
                }
                break;

            case 'zaim':
                // if (!empty($meta['z_stavka'][0])) {
                //     $html .= '<div>Сумма - ' . number_format(floatval($meta['z_stavka'][0]), 0, '', ' ') . ' ₽</div>';
                // }
                // if (!empty($meta['z_time'][0])) {
                //     $value = get_field("z_time", $id);
                //     if ($value && isset($value['label'])) {
                //         $html .= '<div>Срок - ' . esc_html($value['label']) . '</div>';
                //     }
                // }

                if (strlen($meta['z_sum'][0]) > 0) {
                    $html .= '<div class="code5charblock">
                    <div>Сумма 
                    <span>' . number_format($meta['z_sum'][0], 0, '', ' ') . ' ₽</span>
                         </div></div>';
                }
                if (strlen($meta['z_time'][0]) > 0) {

                    $html .= '<div class="">
                    <div>Срок - 
                    <span>' . $meta['z_time'][0] . ' дней</span>
                         </div></div>';
                }
                if (strlen($meta['z_stavka'][0]) > 0) {
                    $html .= '<div class="">
                     <div>% ставка - 
                    <span>' . $meta['z_stavka'][0] . ' %</span>
                         </div></div>';
                }
                break;

            case 'kredit':
                if (strlen($meta['credit_min_sum'][0]) > 0) {
                    $html .= '<div class="code5charblock">
                    <div>Минимальная сумма</div>
                             <span>' . number_format($meta['credit_min_sum'][0], 0, '', ' ') . ' ₽</span>
                         </div>';
                }
                if (!empty($meta['credit_period'][0])) {
                    $value = get_field("credit_period", $id);
                    if ($value && isset($value['label'])) {
                        $html .= '<div>Срок - ' . esc_html($value['label']) . '</div>';
                    }
                }
                if (!empty($meta['credit_stavka'][0])) {
                    $html .= '<div>% ставка - ' . esc_html($meta['credit_stavka'][0]) . ' %</div>';
                }
                break;

            case 'debit_card':

                if (strlen($meta['card_cost'][0]) > 0) {
                    $html .= '<div>
                    <div>Стоимость - 
                    <span>' . $meta['card_cost'][0] . ' ₽</span>
                                         
                            </div></div>';
                }
                if (strlen($meta['card_stavka_ostatok'][0]) > 0) {
                    $html .= '<div>
                    <div>% на остаток - 
                                         <span>' . $meta['card_stavka_ostatok'][0] . '%</span>
                                         
                                     </div></div>';
                }
                if (!empty($meta['card_cashback'][0])) {
                    $value = get_field("card_cashback", $id);
                    if ($value && isset($value['label'])) {
                        // $html .= '<div>Кэшбек - ' . esc_html($value['label']) . '</div>';

                        $html .= '<div class="code5charblock">
                         <div>Кэшбек </div>
                        <span>' . esc_html($value['label']) . '</span>
                       
                    </div>';
                    }
                }

                // if (!empty($meta['non_pecent_money'][0])) {
                //     $html .= '<div>Снятие без % - ' . esc_html($meta['non_pecent_money'][0]) . '</div>';
                // }

                break;
        }
        $html .= '</div>'; // Закрытие code4limit

        // Ссылка "Подробнее"
        $url = get_permalink($id);
        $html .= '<a class="code4v2-butt" target="_blank" href="' . esc_url($url) . '" onclick="ym(35020350,\'reachGoal\',\'click_shortcode_showcase\'); return true;">' . esc_html__('Подробнее', 'text-domain') . '</a>';

        $html .= '</div>'; // Закрытие code4block
    }

    $html .= '</div></div>';

    return $html;
}
add_shortcode('code4v2', 'code_type_4v2');
