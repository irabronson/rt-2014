<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

    </div><!-- #main -->
    <div class="push"></div>
</div><!-- #page -->

<footer role="contentinfo">
    <div class="footer-wrapper">
        <div class="footer-links">
            <?php
                // default menu
                wp_nav_menu( array( 'theme_location' => 'footer' ) );
            ?>
        </div>
        <ul class="info">
            <li class="home">
                <a href="/">Razor &amp; Tie</a>
            </li>
            <li class="copyright">
                <span>Copyright ©2014 Razor &amp; Tie Direct, L.L.C. All rights reserved.</span>
                <span>All trademarks and registered trademarks are property of their respective owners.</span>
            </li>
        </ul>
    </div>
</footer><!-- #footer -->

<?php wp_footer(); ?>

<?php /*Custom JS Files*/ ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
    
<?php
    if( is_single() ) {
?>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
<?php
    }
?>

<?php
    if( is_home() ) {
?>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/home.js"></script>
<?php
    }
?>
</body>
</html>