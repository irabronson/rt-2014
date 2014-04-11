<?php
/**
 *  Sub-Template:
 *  Loaded via single.php
 *  For displaying info on an individual Artist post.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<!-- Content-Artist-Detail Template -->
<section class="primary">
    
    <div class="artist-header">
        <!-- Artist Title -->
        <h2><?php the_title(); ?></h2>
        
        <select id="artist-detail-nav">
            <option value="all-artists" selected="selected">All Artists</option>
            <?php
                // Define global args for artist_query
                $args = array(
                    'post_type' => 'artist',
                    'orderby' => 'meta_value',
                    'meta_key' => 'artist_list_display_name',
                    'order' =>  'ASC',
                    'posts_per_page' => -1
                );
                
                // BEGIN: Razor & Tie Artists Option Group
                $args['artists'] = 'razor-tie';
                $title = 'RAZOR &amp; TIE ---------------';
                
                // Query Artist Post Type
                $artist_cat_query = new WP_Query( $args );
                
                include('content-optgroup.php');
                // END: Razor & Tie
                
                // BEGIN: Washington Square Artists Option Group
                $args['artists'] = 'washington-square';
                $title = 'WASHINGTON SQUARE ---------------';
                
                // Query Artist Post Type
                $artist_cat_query = new WP_Query( $args );
                
                include('content-optgroup.php');
                // END: Washington Square
                
                // BEGIN: Razor & Tie Kids Artists Option Group
                $args['artists'] = 'razor-tie-kids';
                $title = 'RAZOR &amp; TIE KIDS ---------------';
                
                // Query Artist Post Type
                $artist_cat_query = new WP_Query( $args );
                
                include('content-optgroup.php');
                // END: Razor & Tie Kids
            ?>
        </select>
    </div><!-- .artist-header -->
    
    <div class="artist-featured">
        
        <!-- Artist Image -->
        <figure>
        <?php
            $thumb = get_thumbnail_custom($post->ID, 'large');
        
            if( $thumb ) {
                echo '<img src="' . $thumb[0] . '" width="' . $thumb[1] . '" height="' . $thumb[2] . '" alt="' . get_the_title() . '"/>';
            }
        ?>
        </figure>
        
        <div class="artist-info">
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
                ),
                'youtube' => array(
                    'class' => 'youtube',
                    'title' => 'YouTube',
                    'link' => get_field('artist_youtube')
                ),
                'tumblr' => array(
                    'class' => 'tumblr',
                    'title' => 'Tumblr',
                    'link' => get_field('artist_tumblr')
                ),
                'google' => array(
                    'class' => 'google',
                    'title' => 'Google+',
                    'link' => get_field('artist_google')
                ),
                'spotify' => array(
                    'class' => 'spotify',
                    'title' => 'Spotify',
                    'link' => get_field('artist_spotify')
                ),
                'itunes' => array(
                    'class' => 'itunes',
                    'title' => 'iTunes',
                    'link' => get_field('artist_itunes')
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
            // CONTACTS
            // Check for contact name and email
            $contacts = get_field('artist_contacts');
            
            if( empty($contacts) != 1 ) :
        ?>
            <!-- Artist Contacts -->
            <div class="contacts">
                <h3>Contacts</h3>
                
                <ul>
                    <?php
                        foreach( $contacts as $contact ) :
                    ?>
                        <li>
                            <p><?php echo $contact['artist_contact_name']; ?></p>
                            <a href="mailto:<?php echo $contact['artist_contact_email']; ?>"><?php echo $contact['artist_contact_email']; ?></a>
                        </li>
                    <?php
                        endforeach;
                    ?>
                </ul>
            </div>
        <?php
            endif;
        ?>
        
        <?php
            // WEBSITE
            // Check for website URL
            if( get_field('artist_website') ) :
        ?>
            <!-- Artist Website -->
            <div class="website">
                <h3>Website</h3>
                <a href="<?php the_field('artist_website'); ?>"><?php the_field('artist_website'); ?></a>
            </div>
        <?php
            endif;
        ?>
        
        </div><!-- .artist-info -->
    </div><!-- .artist-featured -->
    
</section>

<section class="secondary">
    <?php        
        // PRESS PHOTOS
        // Check for press photos
        $pressPhotos = get_field('artist_press_photos');
            
        if( empty($pressPhotos) != 1 ) :
    ?>
        <!-- Press Photos -->
        <div class="press-photos">
            <h3>Press Photos</h3>
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
        <!-- Press Assets -->
        <div class="press-assets">
            <h3>Press Assets</h3>
            <ul class="press-assets-list">
    <?php
            $i = 1;
            
            foreach( $pressAssets as $pressAsset ) :
                
                $assetURL = ( $pressAsset['artist_press_asset_file'] ? $pressAsset['artist_press_asset_file']['url'] : $pressAsset['artist_press_asset_link'] );
    ?>
                <!-- Link for Press Material <?php echo $i; ?> -->
                <li>
                    <a href="<?php echo $assetURL; ?>" target="_blank">
                        
                        <?php
                            if( $pressAsset['artist_press_asset_date'] ) {
                                echo '<span class="date">';
                                echo date('F j, Y', strtotime($pressAsset['artist_press_asset_date']));
                                echo '</span>';
                            }
                            echo '<span class="title">';
                            echo $pressAsset['artist_press_asset_title'];
                            echo '&nbsp;(' . $pressAsset['artist_press_asset_type'] . ')';
                            echo '</span>';
                        ?>
                        
                    </a>
                </li>
                
    <?php
                $i++;
            endforeach;
    ?>
            </ul>
        </div>
    <?php
        endif;
    ?>
    
    <?php
        // LOGOS
        // Check for logos
        $logos = get_field('artist_logos');
            
        if( empty($logos) != 1 ) :
    ?>
        <!-- Logos -->
        <div class="logos">
            <h3>Logos</h3>
    <?php
            $i = 1;
            foreach( $logos as $logo ) :
                $logoImage = $logo['artist_logo'];
    ?>
                <!-- Logo <?php echo $i; ?> -->
                <div class="logo">
                    <img src="<?php echo $logoImage['sizes']['medium']; ?>" width="<?php echo $logoImage['sizes']['medium-width']; ?>" height="<?php echo $logoImage['sizes']['medium-height']; ?>" alt="<?php echo $logoImage['title']; ?>" />
                    <a href="<?php echo $logoImage['sizes']['large']; ?>" target="_blank">Lo res</a>
                    <a href="<?php echo $logoImage['url']; ?>" target="_blank">Hi res</a>
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
        // COVER ART
        // Check for album covers/info
        $albums = get_field('artist_album');
            
        if( empty($albums) != 1 ) :
    ?>
        <!-- Cover Art -->
        <div class="albums">
            <h3>Cover Art</h3>
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
    <div class="column">
    <?php
        // AUDIO EMBEDS
        // Check for audio
        $audio = get_field('artist_audio');
            
        if( empty($audio) != 1 ) :
    ?>
        <!-- Audio -->
        <div class="audio">
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
        <!-- Videos -->
        <div class="videos">
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
    </div><!-- .column -->
    
    <div class="column">
    <?php
        // TOUR
        // Content filled dynamically
        //
        // Tour column is hidden by CSS
        // Unless there are tweets
    ?>
        <!-- Tour Dates Column -->
        <div class="tour">
            
            <h3>Tour</h3>
            
            <div id="tour-dates"></div>
            
        </div>
    </div><!-- .column -->
</section><!-- .tertiary -->