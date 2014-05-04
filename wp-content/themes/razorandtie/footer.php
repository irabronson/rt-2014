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
    <div class="section-inner">
        <div class="footer-links">
          <?php
              // default menu
              wp_nav_menu( array( 'theme_location' => 'footer' ) );
          ?>
        </div>
        <div class="copyright">
          <p>&copy;<?php echo date('Y'); ?> Razor &amp; Tie Direct, L.L.C. All rights reserved.</p>
          <p>All trademarks and registered trademarks are property of their respective owners.</p>
        </div>
        <p class="credits">Site by <a href="http://blackdaycreative.com" target="_blank" title="Black Day Creative">Black Day Creative</a></p>
    </div><!-- .section-inner -->
</footer><!-- #footer -->

<?php wp_footer(); ?>

<?php /*Custom JS Files*/ ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
</body>
</html>