<?php
include('settings.php');

//use Carbon_Fields\Container;
//use Carbon_Fields\Field;
//
//add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
//function crb_attach_theme_options() {
//    Container::make( 'theme_options', __( 'Theme Options' ) )
//        ->add_fields( array(
//            Field::make( 'text', 'crb_text', 'Text Field' ),
//        ) );
//}
//
//
//add_action('carbon_fields_register_fields', 'crb_attach');
//function crb_attach()
//{
//    include __DIR__ . '/inc/theme_options.php';
//    include __DIR__ . '/inc/therm_meta.php';
//    include __DIR__ . '/inc/nav_menu.php';
//}
//
//add_action('after_setup_theme', 'crb_load');
//function crb_load()
//{
//    require_once('vendor/autoload.php');
//    Carbon_Fields\Carbon_Fields::boot();
//}


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

// register menu for header and footer
register_nav_menus(array(
    'header' => 'header menu',
    'footer' => 'Footer menu'
));

