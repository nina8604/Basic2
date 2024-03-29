<?php
include('settings.php');
include('Contact_form.php');
add_theme_support('post-thumbnails');

// include Mailgun for send message
require 'vendor/autoload.php';
use Mailgun\Mailgun;


function registerStyles()
{
    wp_enqueue_style('icons_style', 'https://use.fontawesome.com/releases/v5.9.0/css/all.css', array(), '1.1.0');
    wp_enqueue_style('icons_style', 'https://use.fontawesome.com/releases/v5.9.0/css/v4-shims.css', array(), '1.1.0');
    wp_enqueue_style('main_style', get_stylesheet_directory_uri() . '/src/css/main.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'registerStyles');

function enqueue_scripts()
{
    wp_enqueue_script('jquery');

    wp_enqueue_script('theme_scripts', get_stylesheet_directory_uri() . '/src/js/script.js', array('jquery'), '1.1.0', true);
    wp_enqueue_script('jquery_ui_scripts', get_stylesheet_directory_uri() . '/src/js/jquery-ui.js', array('jquery'), '1.1.0', true);

}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){
    wp_localize_script( 'theme_scripts', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );
}

// register menu for header and footer
register_nav_menus(array(
    'header' => 'header menu',
    'footer' => 'Footer menu'
));

//create function show contact form for shortcode
function show_form (){
    $form = get_template_part( '/templates/Devit_form' );
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
            'name'               => 'Devit forms', // основное название для типа записи
            'singular_name'      => 'devit_contact_form', // название для одной записи этого типа
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
         'exclude_from_search' => true, // зависит от public
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
        'supports'            => array('title', 'editor', 'thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'register_meta_box_cb' => 'contact_user_data_boxes', // custom meta box
        'taxonomies'          => [],
        'has_archive'         => true,
        'rewrite'             => array( 'slug' => 'devit_contact_form' ),
        'query_var'           => true,
    ) );
}
//Action hook to register metaboxes for post types
add_action('add_meta_boxes','contact_user_data_boxes');

// Registers individual meta boxes for custom post type
function contact_user_data_boxes($post) {
    add_meta_box('email', 'Email', 'user_email_meta', 'devit_contact_form', 'normal', 'high');
    add_meta_box('phone', 'Phones', 'user_phone_meta', 'devit_contact_form', 'normal', 'high');
    add_meta_box('age', 'Age', 'user_age_meta', 'devit_contact_form', 'normal', 'high');
}
function user_email_meta() {
    global $post;

    wp_nonce_field( basename( __FILE__ ), 'email_fields' );

    //Get the contact data if it is already written
    $email = get_post_meta($post->ID, 'email', true);

    //Output the field

    echo '<div class=""><input type = "text" name="email" value="' .
        $email . '" class = "email" /></div>';
}
function user_phone_meta() {
    global $post;

    wp_nonce_field( basename( __FILE__ ), 'phone_fields' );

    //Get the contact data if it is already written
    $phone = get_post_meta($post->ID, 'phone', true);

    //Output the field

    echo '<div><input type = "text" name="phone" value="' .
        $phone . '" class = "phone" /></div>';
}
function user_age_meta() {
    global $post;

    wp_nonce_field( basename( __FILE__ ), 'age_fields' );

    //Get the contact data if it is already written
    $age = get_post_meta($post->ID, 'age', true);

    //Output the field

    echo '<div><input type = "text" name="age" value="' .
        $age . '" class = "age" /></div>';
}
// Action hook to save the post meta data
add_action('save_post', 'save_contact_user_email_meta', 1, 3);
add_action('save_post', 'save_contact_user_phone_meta', 1, 5);
add_action('save_post', 'save_contact_user_age_meta', 1, 7);


function save_contact_user_email_meta($post_id, $post) {

    //Check if the current user can edit the post
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if ( ! isset( $_POST['email'] ) || ! wp_verify_nonce( $_POST['email_fields'], basename(__FILE__) ) ) {
        return $post_id;
    }

    //Add values to custom fields
    $devit_contact_form_meta['email'] = $_POST['email'];

    //Add values to custom fields
    foreach ($devit_contact_form_meta as $key => $value) {
        if ($post->post_type == "revision")
            return;
        $value = implode(',', (array) $value);

        if (get_post_meta($post->ID, $key, FALSE)) {
            update_post_meta($post->ID, $key, $value);
        } else {
            add_post_meta($post->ID, $key, $value);
        }
        if (!$value) {
            delete_post_meta($post->ID, $key);
        }
    }
}
function save_contact_user_phone_meta($post_id, $post) {

    //Check if the current user can edit the post
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if ( ! isset( $_POST['phone'] ) || ! wp_verify_nonce( $_POST['phone_fields'], basename(__FILE__) ) ) {
        return $post_id;
    }

    //Add values to custom fields
    $devit_contact_form_meta['phone'] = $_POST['phone'];

    //Add values to custom fields
    foreach ($devit_contact_form_meta as $key => $value) {
        if ($post->post_type == "revision")
            return;
        $value = implode(',', (array) $value);

        if (get_post_meta($post->ID, $key, FALSE)) {
            update_post_meta($post->ID, $key, $value);
        } else {
            add_post_meta($post->ID, $key, $value);
        }
        if (!$value) {
            delete_post_meta($post->ID, $key);
        }
    }
}
function save_contact_user_age_meta($post_id, $post) {

    //Check if the current user can edit the post
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if ( ! isset( $_POST['age'] ) || ! wp_verify_nonce( $_POST['age_fields'], basename(__FILE__) ) ) {
        return $post_id;
    }

    //Add values to custom fields
    $devit_contact_form_meta['age'] = $_POST['age'];

    //Add values to custom fields
    foreach ($devit_contact_form_meta as $key => $value) {
        if ($post->post_type == "revision")
            return;
        $value = implode(',', (array) $value);

        if (get_post_meta($post->ID, $key, FALSE)) {
            update_post_meta($post->ID, $key, $value);
        } else {
            add_post_meta($post->ID, $key, $value);
        }
        if (!$value) {
            delete_post_meta($post->ID, $key);
        }
    }
}


// save posts if it is ajax
if (wp_doing_ajax()) {
    add_action('wp_ajax_save_custom_post', 'save_devit_post_type');
    add_action('wp_ajax_nopriv_save_custom_post', 'save_devit_post_type');
}

function save_devit_post_type() {

    $image_url = $_FILES['photo']['tmp_name'] ;
    $upload_dir = wp_upload_dir();
    $filename = $_FILES['photo']['name'];
    if ( wp_mkdir_p( $upload_dir['path'] ) ) {
        $file = $upload_dir['path'] . '/' . $filename;
    }
    else {
        $file = $upload_dir['basedir'] . '/' . $filename;
    }
    // move file from temporary dir to created dir
    move_uploaded_file($image_url, $file);
    $wp_filetype = wp_check_filetype( $filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name( $filename ),
        'post_content' => '',
        'post_status' => 'publish'
    );
    $attach_id = wp_insert_attachment( $attachment, $file );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    $post_data = array(
        'post_title' => $_POST['fio'],
        'post_content' => $_POST['resume'],
        'post_type' => 'devit_contact_form',
        'post_status' => 'private',
        'meta_input' => array(
            'email' => $_POST['email'],
            'phone' => implode(', ', $_POST['phone']),
            'age' => $_POST['age'],
            ),
    );

    // Save data to database
    $post_id = wp_insert_post( wp_slash($post_data) );

    // Connect custom post type with attach_id
    set_post_thumbnail($post_id, $attach_id);



    // Instantiate the client
    $mgClient = new Mailgun('6260bbad5306a21de1c887bafb002e3e-19f318b0-49151fcc');
    $domain = "sandboxd13dc54904624cc09780251581f72f8b.mailgun.org";

    $userName = $_POST['fio'];
    // enabling output buffer
    ob_start();
    // include templates our message
    include( 'templates/message.php' );
    // get output buffer contents
    $html = ob_get_contents();
    // Clear (erase) the output buffer and disable output buffering
    ob_end_clean();


    // Make the call to the client.
    $result = $mgClient->sendMessage($domain, array(
        'from'	=> 'Excited User <mailgun@sandboxd13dc54904624cc09780251581f72f8b.mailgun.org>',
        'to'	=> 'Baz <nina.yaremenko@devit-team.com>',
        'subject' => "Пользователь $userName отправил(а) вам заявку",
        'html'    => $html,
    ));

    return $success = "Ваша заявка отправленна успешно";
}

// add class 'devit-element' to element has class - 'elementor-element'
add_action('elementor/element/after_add_attributes', 'add_new_class', 10, 2);
function add_new_class($element) {
    if (get_the_ID() == 192) {
        $element->add_render_attribute( '_wrapper', 'class', 'devit-element' );
    }
}
// add content to H-elements
add_action( 'elementor/widget/render_content', function( $content, $widget ) {
    if (get_the_ID() == 192) {
        if ( 'heading' === $widget->get_name() || 'icon-box' === $widget->get_name()) {
            $content = preg_replace('/(<h[1-6].*">)([\S\s]*)(<\/h[1-6]>)/', '${1}DevIT - ${2}${3}', $content);
        }
    }
    return $content;
}, 10, 2 );
