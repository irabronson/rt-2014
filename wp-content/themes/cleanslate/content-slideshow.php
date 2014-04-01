<?php
    if( get_field('slideshow') ) :
?>
<div id="slideshow">
    <div class="wrapper slides">
        
        <div id="slide_nav">
            <a href="#" class="arrow prev"></a>
            <a href="#" class="arrow next"></a>
        </div>
        
    <?php
        
        $index = 1;
        $slidePagers = array();
        
        while( has_sub_field('slideshow') ) :
            
            $slide = get_sub_field('slideshow_image');
            
            $slidePager = $slide['sizes']['small-thumbnail'];
            $slideCaption = $slide['caption'];
            
            array_push($slidePagers, array($index, $slidePager));
    ?>
            <div class="slide" data-index="<?php echo $index; ?>">
                <figure>
                    <img src="<?php echo $slide['sizes']['large']; ?>" width="<?php echo $slide['sizes']['large-width']; ?>" height="<?php echo $slide['sizes']['large-height']; ?>" alt="<?php echo $slide['title']; ?>">
                </figure>
            </div>
    <?php
            $index++;
        endwhile;
    ?>
    </div><!-- wrapper -->
    
    <div id="slide_pagers">
        <div class="wrapper pages">
    
    <?php
        foreach( $slidePagers as $slidePager ) :
    ?>
            <a href="#" class="slide-pager" data-index="<?php echo $slidePager[0]; ?>">
                <div class="border"></div>
                <img src="<?php echo $slidePager[1]; ?>" width="80" height="45" alt="slide preview">
            </a>
    <?php
        endforeach;
    ?>
        </div><!-- wrapper -->
    </div><!-- pager -->
    
</div><!-- slideshow -->
<?php
    endif;
?>