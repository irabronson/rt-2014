<?php
/**
 * The general template for displaying content.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php
    $postTitle = ( in_category('news') ? 'News' : get_the_title() );
?>

<section id="primary">
    
    <?php include('content-slideshow.php'); ?>
    
    <div class="title">
        <div class="wrapper">
            <h2><?php echo $postTitle; ?></h2>
        </div>
    </div>
</section>

<section id="secondary">
    <?php
        // PROJECTS POSTS ONLY
        if( in_category('projects') ) :
            include('content-projects.php');
        endif;
        
        // NEWS POSTS ONLY
        if( in_category('news') ) :
    ?>
        <div class="single-row">
            <?php include('content-news.php'); ?>
        </div>
    <?php
        endif;
    ?>
</section>