<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <?php wp_head(); ?>
</head>
<body <?php body_class( ); ?>>
<div class="wrapper">
    <header>
        <div class="container">
            <?php $options = get_option( 'theme_settings' ); ?>
            <a class="logo" href="#">
                <img src="<?php echo get_stylesheet_directory_uri() . $options['custom_logo'];?>" alt="">
            </a>
<!--            button for burger menu-->
            <input type="checkbox" id="hmt" class="hidden-menu-ticker">
            <label class="btn-menu" for="hmt">
                <span class="first"></span>
                <span class="second"></span>
                <span class="third"></span>
            </label>

<!--            dinamic header menu-->
            <?php
            wp_nav_menu( array(
                'menu' => 'header_catalog_menu',
                'menu_class'=>'menu',
                'theme_location'=>'header',
            ) );
            ?>

            <button id="authorization" type="button" >Authorization</button>
            <span class="x-off-canvas-bg open-close-menu"></span>
        </div>
    </header>
