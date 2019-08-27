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

//create function show contact form
function show_form (){
    $src = get_stylesheet_directory_uri() . '/images/upload.png';
    $form = '<form class="form" action="" method="post" enctype = "multipart/form-data" >
            <fieldset>
                <label for="fio">ФИО </label><br>
                <input id="fio" type="text" name="fio" value="" >
                <span class="error"> </span>
                <br>
                <label for="email">E-mail </label><br>
                <input id="email" type="text" name="email" value="" >
                <span class="error"> </span>
                <br>
                <div id="phone_container">
                    <div class="form-group">
                        <div class="form-control">
                            <label for="phone0" >Телефон </label><br>
                            <input id="phone0" name="phone[]" class="phones" type="text" data-validate="0" value="">
                            <span class="error"> </span>
                        </div>
                        <div class="form-control">
                            <input id="plus" type="button" name="plus" value="+"><br>
                        </div>
                    </div>
                </div>

                <label for="age">Возраст </label><br>
                <input id="age" type="text" name="age" value="">
                <span class="error"> </span>
                <br>
                <div id="foto_container">
                    <span>Фотография </span><br>
                    <label for="photo">
                        <div id="label-photo-box">
                            <img src="'.$src.'" alt="Upload foto">
                        </div>

                    </label>
                    <input id="photo" type="file" name="photo" />
                    <span class="error"> </span>
                </div>
                <span class="error"> </span>
                <div id="resume_box">
                    <label for="resume">Резюме </label><br>
                    <textarea id="resume" name="resume" ></textarea>
                    <span class="error"> </span>
                    <br><br>
                </div>
                <input id="submit" type="submit" name="uploadBtn" value="Отправить" />
            </fieldset>
            </form>';
    return $form;
}

// add shortcode
add_shortcode ('devit_contact_form', 'show_form');

// register custom post type
add_action( 'init', 'create_custom_post_type' );
function create_custom_post_type() {
    register_post_type ('devit_contact_form', array(
        'label'  => null,
        'labels' => array(
            'name'               => __('Devit contact forms'), // основное название для типа записи
            'singular_name'      => __('devit_contact_form'), // название для одной записи этого типа
            'add_new'            => 'Add', // для добавления новой записи
            'add_new_item'       => 'Add new devit_contact_form', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Edit devit_contact_form', // для редактирования типа записи
            'new_item'           => 'New devit_contact_form', // текст новой записи
            'view_item'          => 'View devit_contact_form', // для просмотра записи этого типа.
            'search_items'       => 'Search devit_contact_form', // для поиска по этим типам записи
            'not_found'          => 'No devit_contact_form found', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'No devit_contact_form found in trash', // если не было найдено в корзине
        ),
        'description'         => '',
        'public'              => true,
        // 'publicly_queryable'  => null, // зависит от public
        // 'exclude_from_search' => null, // зависит от public
        // 'show_ui'             => null, // зависит от public
        // 'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu'        => null, // показывать ли в меню адмнки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => null,
        'menu_icon'           => null,
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => [],
        'has_archive'         => true,
        'rewrite'             => true,
        'query_var'           => true,
    ) );
}