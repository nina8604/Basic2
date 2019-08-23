<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
<!--    <link href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" rel="stylesheet">-->
<!--    <style>-->
<!--        .sub-menu { opacity: 0;}-->
<!--        #authorization {-->
<!--            padding: 10px 22px 12px 21px;-->
<!--            background-color: #d92727;-->
<!--            border: 1px solid #d92727;-->
<!--            color: #fff;-->
<!--        }-->
<!--    </style>-->
<!--    <style>-->
<!--        @import url("/nina-iaremenko-jsfw1-basis/stage5/style/header.css");-->
<!--        @import url("/nina-iaremenko-jsfw1-basis/stage5/style/main.css");-->
<!--        @import url("/nina-iaremenko-jsfw1-basis/stage5/style/footer.css");-->
<!---->
<!--    </style>-->
<!--    <script-->
<!--        src="https://code.jquery.com/jquery-3.4.1.min.js"-->
<!--        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="-->
<!--        crossorigin="anonymous"></script>-->

    <?php wp_head(); ?>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="container">
            <?php $options = get_option( 'theme_settings' ); ?>
            <a class="logo" href="#">
                <img src="<?php echo get_stylesheet_directory_uri() . $options['custom_logo'];?>" alt="">
            </a>
            <input type="checkbox" id="hmt" class="hidden-menu-ticker">
            <label class="btn-menu" for="hmt">
                <span class="first"></span>
                <span class="second"></span>
                <span class="third"></span>
            </label>

            <?php
            wp_nav_menu( array(
                'menu' => 'header_catalog_menu',
                'menu_class'=>'menu',
                'theme_location'=>'header',
            ) );
            ?>


<!--            <nav class="header-menu">-->
<!--                <button id="auth" type="button" >Authorization</button>-->
<!--                <ul>-->
<!--                    <li><a href="#">Home</a></li>-->
<!--                    <li>-->
<!--                        <a id="course" href="#">Courses<img src="--><?php //echo get_stylesheet_directory_uri() . '/images/arrow_down.png';?><!--" alt=""></a>-->
<!--                        <ul class="sub-menu">-->
<!--                            <li><a href="#">Courses 1</a></li>-->
<!--                            <li><a href="#">Courses 2</a></li>-->
<!--                            <li><a href="#">Courses 3</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><a href="#">About</a></li>-->
<!--                    <li><a href="#">Video</a></li>-->
<!--                    <li>-->
<!--                        <a href="#">Interesting<img src="--><?php //echo get_stylesheet_directory_uri() . '/images/arrow_down.png';?><!--" alt=""></a>-->
<!--                        <ul class="sub-menu">-->
<!--                            <li><a href="#">Interesting 1</a></li>-->
<!--                            <li><a href="#">Interesting 2</a></li>-->
<!--                            <li><a href="#">Interesting 3</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </nav>-->
            <button id="authorization" type="button" >Authorization</button>
            <span class="x-off-canvas-bg open-close-menu"></span>
        </div>
    </header>
