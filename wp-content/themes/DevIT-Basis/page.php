<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */


get_header('without-menu');
?>

    <section id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php

            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                the_content();
//                ob_start('add_content_title');
//                $pageHtml = ob_get_contents();
//                ob_end_clean();

//                echo $pageHtml;

//                $content = apply_filters( 'the_content', 'add_content_title' );
//                function add_content_title($content) {
//                    $changes = [
//                        '<h1 .*>' => '<h1 .*>DevIT - ',
//                        '<h2 .*>' => '<h2 .*>DevIT - ',
//                        '<h3 .*>' => '<h3 .*>DevIT - ',
//                    ];
//                    foreach($changes as $found => $change){
//                        $content = str_ireplace($found, $change, $content);
//                    }
//                    return $content;
//                }


//                the_content();


            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_footer('without-footer');
