<?php
add_action( 'admin_menu', 'register_my_contact_form_menu_page' );
function register_my_contact_form_menu_page(){
    add_menu_page( 'Contact form', 'Contact form', 'manage_options', 'contact_form_page', 'contact_form_menu_page', 6 );
}

function contact_form_menu_page(){
    global $post;
    $args = ['post_type' => 'devit_contact_form', 'post_status' => 'private'];
    $post_list = get_posts( $args );
    if ($_GET['dcf_id'] !== NULL) {
        $post_id = (int)$_GET['dcf_id'];
        $query = new WP_Query([
            'p' => $post_id,
            'post_type' => 'devit_contact_form',
            'post_status' => 'private',
            ]);
        while ( $query->have_posts() ) {
            $query->the_post();
            echo '<h1>Contact form: '.get_the_title().'</h1>
                  <ol>
                        <li>ФИО: '.get_post_meta($post_id, 'fio', true).'</li>
                        <li>Email: '.get_post_meta($post_id, 'email', true).'</li>
                        <li>Телефон: '.get_post_meta($post_id, 'phone', true).'</li>
                        <li>Возраст: '.get_post_meta($post_id, 'age', true).'</li>
                        <li>Фотография: <img src="'.get_the_post_thumbnail_url($post_id).'" width="200"></li>
                        <li>Резюме: '.get_post_meta($post_id, 'resume', true).'</li>
                  </ol>';
        }
    } else {
        echo '<ul>';
        foreach ( $post_list as $post ) {
            setup_postdata($post);
            echo '<li><a href="'.get_admin_url(null, "admin.php?page=contact_form_page&dcf_id=$post->ID").'">'.get_the_title().'</a></li>';
        }
        echo '</ul>';
    }
}


