<?php
/**
 * The general template used for displaying page content in page.php.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>


<section class="primary">
    
    <h2><?php the_title(); ?></h2>
    
    <div class="text"><?php the_content(); ?></div>
    
</section>

<section class="secondary">
    <?php
        // SOCIAL MEDIA LINKS
        // Create array of social media links
        $socials = array(
            'facebook' => array(
                'class' => 'facebook',
                'title' => 'Facebook',
                'link' => get_field('artist_facebook')
            ),
            'twitter' => array(
                'class' => 'twitter',
                'title' => 'Twitter',
                'link' => get_field('artist_twitter')
            ),
            'instagram'=> array(
                'class' => 'instagram',
                'title' => 'Instagram',
                'link' => get_field('artist_instagram')
            )
        );
        
        // Check for social media links
        if( $socials ) :
    ?>
        <!-- Social Media Links -->
        <div class="social-media">
            <h3>Social Media</h3>
            <ul class="social-links">
    <?php
                $socialCount = 1;
                foreach( $socials as $social ) :
                    
                    // Display Links
                    // Only allow up to six social links
                    if( $social['link'] ) {
    ?>
                    <!-- <?php echo $social['class']; ?> Link -->
                    <li>
                        <a href="<?php echo $social['link']; ?>" class="social-icon <?php echo $social['class']; ?>" title="<?php echo $social['title']; ?>"></a>
                    </li>
                    
    <?php
                        $socialCount++;
                    }
                
                endforeach;
    ?>
            </ul>
        </div>
    <?php
        endif;
    ?>
    
    <?php
        // PRESS PHOTOS
        // Check for press photos
        $pressPhotos = get_field('artist_press_photos');
            
        if( empty($pressPhotos) != 1 ) :
    ?>
        <!-- Press Materials -->
        <h3>Press Photos</h3>
        <div class="press-photos">
    <?php
            $i = 1;
            
            foreach( $pressPhotos as $pressPhoto ) :
                $photo = $pressPhoto['artist_press_photo'];
    ?>
                <!-- Press Photo <?php echo $i; ?> -->
                <div class="press-photo">
                    <img src="<?php echo $photo['sizes']['small-thumbnail']; ?>" width="<?php echo $photo['sizes']['small-thumbnail-width']; ?>" height="<?php echo $photo['sizes']['small-thumbnail-height']; ?>" alt="<?php echo $photo['title']; ?>" />
                    <a href="<?php echo $photo['sizes']['large']; ?>" target="_blank">Lo res</a>
                    <a href="<?php echo $photo['url']; ?>" target="_blank">Hi res</a>
                </div>
    <?php
                $i++;
            endforeach;
    ?>
        </div>
    <?php
        endif;
    ?>
    
    <?php
        // PRESS ASSETS
        // Check for press assets
        $pressAssets = get_field('artist_press_assets');
            
        if( empty($pressAssets) != 1 ) :
    ?>
        <!-- Press Materials -->
        <h3>Press Assets</h3>
        <ul class="press-assets">
    <?php
            $i = 1;
            
            foreach( $pressAssets as $pressAsset ) :
                
                $assetURL = ( $pressAsset['artist_press_asset_file'] ? $pressAsset['artist_press_asset_file']['url'] : $pressAsset['artist_press_asset_link'] );
    ?>
                <!-- Link for Press Material <?php echo $i; ?> -->
                <li>
                    <a href="<?php echo $assetURL; ?>" target="_blank">
                        
                        <?php 
                            echo $pressAsset['artist_press_asset_title'];
                            echo '&nbsp;(' . $pressAsset['artist_press_asset_type'] . ')';
                        ?>
                        
                    </a>
                </li>
                
    <?php
                $i++;
            endforeach;
    ?>
        </ul>
    <?php
        endif;
    ?>
    
    <?php
        // COVER ART
        // Check for album covers/info
        $albums = get_field('artist_album');
            
        if( empty($albums) != 1 ) :
    ?>
        <!-- Cover Art -->
        <h3>Cover Art</h3>
        <div class="albums">
    <?php
            $i = 1;
            foreach( $albums as $album ) :
                $albumImage = $album['artist_album_image'];
    ?>
                <!-- Album <?php echo $i; ?> -->
                <div class="album">
                    <img src="<?php echo $albumImage['sizes']['small-thumbnail']; ?>" width="<?php echo $albumImage['sizes']['small-thumbnail-width']; ?>" height="<?php echo $albumImage['sizes']['small-thumbnail-height']; ?>" alt="<?php echo $albumImage['title']; ?>" />
                    <p><?php echo $album['artist_album_title']; ?></p>
                    <p><?php echo date('F j, Y', strtotime($album['artist_album_date'])); ?></p>
                    <a href="<?php echo $albumImage['sizes']['large']; ?>" target="_blank">Lo res</a>
                    <a href="<?php echo $albumImage['url']; ?>" target="_blank">Hi res</a>
                </div>
    <?php
                $i++;
            endforeach;
    ?>
        </div>
    <?php
        endif;
    ?>
</section>

<section class="tertiary">
    <?php
        // AUDIO EMBEDS
        // Check for audio
        $audio = get_field('artist_audio');
            
        if( empty($audio) != 1 ) :
    ?>
        <div class="audio">
            <!-- Videos -->
            <h3>Audio</h3>
    <?php
                $i = 1;
                
                foreach( $audio as $track ) :
    ?>
                <div class="track">
                    <!-- Track <?php echo $i; ?> -->
                    <?php echo $track['artist_audio_embed_code']; ?>
                </div>
    <?php
                    $i++;
                endforeach;
    ?>
        </div>
    <?php
        endif;
    ?>
    
    <?php
        // VIDEO EMBEDS
        // Check for video
        $videos = get_field('artist_video');
            
        if( empty($videos) != 1 ) :
    ?>
        <div class="videos">
            <!-- Videos -->
            <h3>Videos</h3>
    <?php
                $i = 1;
                
                foreach( $videos as $video ) :
    ?>
                <div class="video">
                    <!-- Video <?php echo $i; ?> -->
                    <?php echo $video['artist_video_embed_code']; ?>
                </div>
    <?php
                    $i++;
                endforeach;
    ?>
        </div>
    <?php
        endif;
    ?>
    
    <?php
        // TOUR
        // Content filled dynamically
        //
        // Tour column is hidden by CSS
        // Unless there are tweets
    ?>
        <!-- Tour Dates Column -->
        <div class="tour">
        <!-- Header -->
        <h3>Tour</h3>
        
        <div class="tour-dates"></div>
        
        </div>
</section><!-- tertiary -->