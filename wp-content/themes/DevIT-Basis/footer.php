<footer>
    <div class="footer-container">
        <?php
        wp_nav_menu( array(
            'menu' => 'footer-menu',
            'menu_class'=>'menu',
            'theme_location'=>'footer',
        ) );
        ?>

        <div id="middle_footer">
            <div id="left_box">
                <ul>
                    <li>
                        <a href="#">Courses</a>
                        <ul>
                            <li><a href="#">Project management</a></li>
                            <li><a href="#">Android development</a></li>
                            <li><a href="#">Online marketing</a></li>
                            <li><a href="#">Front-end developer</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <div id="center_box">
                <ul>
                    <li>
                        <a href="#">Interesting</a>
                        <ul>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Youtube</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Community</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <div id="right_box">
                <ul>
                    <li>
                        <a href="#">Social networks</a>
                        <ul>
                            <?php $options = get_option( 'theme_settings' ); ?>
                            <li><a href="<?php echo $options['link_twitter'];?>"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="<?php echo $options['link_linkedin'];?>"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="<?php echo $options['link_facebook'];?>"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="<?php echo $options['link_instagram'];?>"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <div id="bottom_footer">
            <div>Terms of Service</div>
            <div>Privacy policy</div>
        </div>
    </div>
</footer>
</div>
<!--<script type="text/javascript" src="script.js"></script>-->
<?php wp_footer() ?>
</body>
</html>
