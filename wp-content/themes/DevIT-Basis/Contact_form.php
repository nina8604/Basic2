<?php
add_action( 'admin_menu', 'register_my_contact_form_menu_page' );
function register_my_contact_form_menu_page(){
    add_menu_page( 'Contact form', 'Contact form', 'manage_options', 'contact_form_page', 'contact_form_menu_page', 6 );
}

function contact_form_menu_page(){
    global $post;
    $args = ['post_type' => 'devit_contact_form', 'post_status' => 'private'];
    $post_list = get_posts( $args );
    echo '<ul>';
    foreach ( $post_list as $post ) {
        setup_postdata($post);
        echo '<li><a href="'. get_permalink().'">'.get_the_title().'</a></li>';
    }
    echo '</ul>';
}


