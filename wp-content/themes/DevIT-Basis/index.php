<?php

if ( is_front_page() ){
    get_header();
?>

<div class="main" style='background-image: url(" <?php echo get_stylesheet_directory_uri() . '/images/main.png';?> ")'>

    <!--            add shortcode - show contact form-->
    <?php echo do_shortcode( '[devit_contact_form]' ); ?>


</div>
<?php

    get_footer();
}

