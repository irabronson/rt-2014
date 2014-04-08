<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

    </div><!-- #main -->
    <div class="push"></div>
</div><!-- #page -->

<footer role="contentinfo">
    <div class="border"></div>
    <div class="footer-wrapper">
        <div class="info">
        </div>
        
        <?php include('content-social.php'); ?>
    </div>
</footer><!-- #footer -->

<?php wp_footer(); ?>

<?php /*Custom JS Files*/ ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
    
<?php
    if( is_single() ) {
?>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/tour-dates.js"></script>
<?php
    }
?>

<?php
    if( is_home() ) {
?>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/filter.js"></script>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/get-news.js"></script>
<?php
    }
?>
</body>
</html>