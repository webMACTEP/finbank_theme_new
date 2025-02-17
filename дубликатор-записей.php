<?

add_action('init', 'create_child_pages_for_zaimy');
function create_child_pages_for_zaimy()
{
    // Выполняем скрипт только один раз
    if (get_option('child_pages_for_zaimy_created')) {
        return;
    }

    // Получаем все записи типа zaimy
    $parents = get_posts(array(
        'post_type'      => 'zaimy',
        'posts_per_page' => -1,
    ));

    if (! empty($parents)) {
        foreach ($parents as $parent) {

            // 1. Горячая линия
            $existing_hotline = get_posts(array(
                'post_parent'    => $parent->ID,
                'post_type'      => 'zaimy',
                'post_status'    => 'publish',
                'name'           => 'goryachaya-liniya',
                'posts_per_page' => 1,
            ));
            if (empty($existing_hotline)) {
                $child_post_hotline = array(
                    'post_title'   => 'Горячая линия',
                    'post_content' => '',
                    'post_status'  => 'publish',
                    'post_author'  => 14, // Измените ID автора при необходимости
                    'post_parent'  => $parent->ID,
                    'post_type'    => 'zaimy',
                    'post_name'    => 'goryachaya-liniya',
                );
                $child_id_hotline = wp_insert_post($child_post_hotline);
                if ($child_id_hotline && ! is_wp_error($child_id_hotline)) {
                    update_post_meta($child_id_hotline, '_wp_page_template', 'single-zaimy-child-gl.php');
                }
            }

            // 2. Контакты
            $existing_contacts = get_posts(array(
                'post_parent'    => $parent->ID,
                'post_type'      => 'zaimy',
                'post_status'    => 'publish',
                'name'           => 'kontakty',
                'posts_per_page' => 1,
            ));
            if (empty($existing_contacts)) {
                $child_post_contacts = array(
                    'post_title'   => 'Контакты',
                    'post_content' => '',
                    'post_status'  => 'publish',
                    'post_author'  => 14,
                    'post_parent'  => $parent->ID,
                    'post_type'    => 'zaimy',
                    'post_name'    => 'kontakty',
                );
                $child_id_contacts = wp_insert_post($child_post_contacts);
                if ($child_id_contacts && ! is_wp_error($child_id_contacts)) {
                    update_post_meta($child_id_contacts, '_wp_page_template', 'single-zaimy-child-contacts.php');
                }
            }

            // 3. Личный кабинет
            $existing_lk = get_posts(array(
                'post_parent'    => $parent->ID,
                'post_type'      => 'zaimy',
                'post_status'    => 'publish',
                'name'           => 'lichnyy-kabinet',
                'posts_per_page' => 1,
            ));
            if (empty($existing_lk)) {
                $child_post_lk = array(
                    'post_title'   => 'Личный кабинет',
                    'post_content' => '',
                    'post_status'  => 'publish',
                    'post_author'  => 14,
                    'post_parent'  => $parent->ID,
                    'post_type'    => 'zaimy',
                    'post_name'    => 'lichnyy-kabinet',
                );
                $child_id_lk = wp_insert_post($child_post_lk);
                if ($child_id_lk && ! is_wp_error($child_id_lk)) {
                    update_post_meta($child_id_lk, '_wp_page_template', 'single-zaimy-child-lk.php');
                }
            }

            // 4. Промокоды, скидки
            $existing_promo = get_posts(array(
                'post_parent'    => $parent->ID,
                'post_type'      => 'zaimy',
                'post_status'    => 'publish',
                'name'           => 'promokody-skidki',
                'posts_per_page' => 1,
            ));
            if (empty($existing_promo)) {
                $child_post_promo = array(
                    'post_title'   => 'Промокоды, скидки',
                    'post_content' => '',
                    'post_status'  => 'publish',
                    'post_author'  => 14,
                    'post_parent'  => $parent->ID,
                    'post_type'    => 'zaimy',
                    'post_name'    => 'promokody-skidki',
                );
                $child_id_promo = wp_insert_post($child_post_promo);
                if ($child_id_promo && ! is_wp_error($child_id_promo)) {
                    update_post_meta($child_id_promo, '_wp_page_template', 'single-zaimy-child-promo.php');
                }
            }
        }
    }

    // Помечаем, что скрипт уже выполнен
    update_option('child_pages_for_zaimy_created', true);
}
