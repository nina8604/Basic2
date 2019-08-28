<?php
include('settings.php');
include('Contact_form.php');
add_theme_support('post-thumbnails');


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

    wp_enqueue_script('theme_scripts', get_stylesheet_directory_uri() . '/src/js/script.js', array('jquery'), '1.1.0', true);
    wp_enqueue_script('jquery_ui_scripts', get_stylesheet_directory_uri() . '/src/js/jquery-ui.js', array('jquery'), '1.1.0', true);
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
    $form = '<form class="form" action="" method="post" enctype = "multipart/form-data" data-ajax-url="' . admin_url('admin-ajax.php') . '" >
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
        'supports'            => array('title','thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
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
    add_meta_box('fio', 'Name', 'user_fio_meta', 'devit_contact_form', 'side', 'default');
    add_meta_box('email', 'Email', 'user_email_meta', 'devit_contact_form', 'normal', 'default');
    add_meta_box('phone', 'Phone', 'user_phone_meta', 'devit_contact_form', 'normal', 'default');
    add_meta_box('age', 'Age', 'user_age_meta', 'devit_contact_form', 'normal', 'default');
    add_meta_box('resume', 'Resume', 'user_resume_meta', 'devit_contact_form', 'normal', 'default');
}

function user_fio_meta() {
    global $post;

    wp_nonce_field( basename( __FILE__ ), 'devit_contact_form_fields' );

    //Get the contact data if it is already written
    $fio = get_post_meta($post->ID, 'fio', true);

    //Output the field

    echo '<input type = "text" name="fio" value="' .
        $fio . '" class = "fio" ';
}
function user_email_meta() {
    global $post;

    wp_nonce_field( basename( __FILE__ ), 'devit_contact_form_fields' );

    //Get the contact data if it is already written
    $email = get_post_meta($post->ID, 'email', true);

    //Output the field

    echo '<input type = "text" name="email" value="' .
        $email . '" class = "email" ';
}
function user_phone_meta() {
    global $post;

    wp_nonce_field( basename( __FILE__ ), 'devit_contact_form_fields' );

    //Get the contact data if it is already written
    $phone = get_post_meta($post->ID, 'phone', true);

    //Output the field

    echo '<input type = "text" name="phone" value="' .
        $phone . '" class = "phone" ';
}
function user_age_meta() {
    global $post;

    wp_nonce_field( basename( __FILE__ ), 'devit_contact_form_fields' );

    //Get the contact data if it is already written
    $age = get_post_meta($post->ID, 'age', true);

    //Output the field

    echo '<input type = "text" name="age" value="' .
        $age . '" class = "age" ';
}
function user_resume_meta() {
    global $post;

    wp_nonce_field( basename( __FILE__ ), 'devit_contact_form_fields' );

    //Get the contact data if it is already written
    $resume = get_post_meta($post->ID, 'resume', true);

    //Output the field

    echo '<textarea type="textarea" name="resume" class = "resume">'.$resume.'</textarea>';
}

// Action hook to save the post meta data
add_action('save_post', 'save_contact_user_fio_meta', 1, 2);
add_action('save_post', 'save_contact_user_email_meta', 1, 3);
add_action('save_post', 'save_contact_user_phone_meta', 1, 4);
add_action('save_post', 'save_contact_user_age_meta', 1, 5);
add_action('save_post', 'save_contact_user_resume_meta', 1, 6);

function save_contact_user_fio_meta($post_id, $post) {

    //Check if the current user can edit the post
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if ( ! isset( $_POST['fio'] ) || ! wp_verify_nonce( $_POST['devit_contact_form_fields'], basename(__FILE__) ) ) {
        return $post_id;
    }

    //Add values to custom fields
    $devit_contact_form_meta['fio'] = $_POST['fio'];

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
function save_contact_user_email_meta($post_id, $post) {

    //Check if the current user can edit the post
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if ( ! isset( $_POST['email'] ) || ! wp_verify_nonce( $_POST['devit_contact_form_fields'], basename(__FILE__) ) ) {
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
    if ( ! isset( $_POST['phone'] ) || ! wp_verify_nonce( $_POST['devit_contact_form_fields'], basename(__FILE__) ) ) {
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
    if ( ! isset( $_POST['age'] ) || ! wp_verify_nonce( $_POST['devit_contact_form_fields'], basename(__FILE__) ) ) {
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
function save_contact_user_resume_meta($post_id, $post) {

    //Check if the current user can edit the post
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if ( ! isset( $_POST['resume'] ) || ! wp_verify_nonce( $_POST['devit_contact_form_fields'], basename(__FILE__) ) ) {
        return $post_id;
    }

    //Add values to custom fields
    $devit_contact_form_meta['resume'] = $_POST['resume'];

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



// add link on admin-ajax.php
add_action('wp_head', 'myplugin_ajaxurl');
function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
var ajaxurl = "' . admin_url('admin-ajax.php') . '";
</script>';
}

// save posts if it is ajax
//if (wp_doing_ajax()) {
    add_action('wp_ajax_save_custom_post', 'save_devit_post_type');
    add_action('wp_ajax_nopriv_save_custom_post', 'save_devit_post_type');
//}

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
        'post_type' => 'devit_contact_form',
        'post_status' => 'private',
        'meta_input' => array(
            'fio' => $_POST['fio'],
            'email' => $_POST['email'],
            'phone' => implode(', ', $_POST['phone']),
            'age' => $_POST['age'],
            'resume' => $_POST['resume'],
            ),
    );

// Save data to database
    $post_id = wp_insert_post( wp_slash($post_data) );

// Connect custom post type with attach_id
    set_post_thumbnail($post_id, $attach_id);

    wp_die();
}

