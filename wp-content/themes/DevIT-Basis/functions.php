<?php
function registerStyles()
{
//    wp_register_style ('main_style', get_stylesheet_directory_uri() . '/src/css/main.css', array(), '1.0.0');
//    wp_enqueue_style('main_style');
    wp_enqueue_style('icons_style', 'https://use.fontawesome.com/releases/v5.9.0/css/all.css', array(), '1.1.0');
    wp_enqueue_style('icons_style', 'https://use.fontawesome.com/releases/v5.9.0/css/v4-shims.css', array(), '1.1.0');
    wp_enqueue_style('main_style', get_stylesheet_directory_uri() . '/src/css/main.css', array(), '1.0.0');
//    wp_enqueue_style('jquery_ui_style', get_stylesheet_directory_uri() . '/assets/css/jquery-ui.css', array(), '1.1.0');
}
add_action('wp_enqueue_scripts', 'registerStyles');

function enqueue_scripts()
{
    wp_enqueue_script('jquery');

//    wp_enqueue_script('theme_scripts', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), '1.1.0', true);
//    wp_enqueue_script('jquery_ui_scripts', get_stylesheet_directory_uri() . '/src/js/jquery-ui.js', array('jquery'), '1.1.0', true);
//    wp_enqueue_script('bootstrap_scripts', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), '3.3.7', true);

}

add_action('wp_enqueue_scripts', 'enqueue_scripts');

