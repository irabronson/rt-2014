<?php
/**
 *  Sub-Template:
 *  Loaded via page.php
 *  For displaying content on the About page.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<!-- Content-About Template -->
<section class="primary">
  <section class="section-inner">
    <h2><?php the_title(); ?></h2>
<?php
        // SUBTITLE
        if( get_field('about_subtitle') ) {
?>
        <h3><?php the_field('about_subtitle'); ?></h3>
<?php
        }
?>
    <div class="text"><?php echo apply_filters('the_content', $post->post_content); ?></div>
  </section><!-- .section-inner -->    
</section>

<section class="secondary">
  <section class="section-inner">
    
    <?php
        // LOGOS
        // Check for logos
        $logosOrFiles = get_field('about_logos_image_or_file');
        
        if( empty($logosOrFiles) != 1 ) :
    ?>
        <!-- Logos -->
        <div class="logos col-3">
            <h3>Corporate Logos</h3>
    <?php
            $i = 1;
            foreach( $logosOrFiles as $logoOrFile ) :
                
                $type = ( $logoOrFile['acf_fc_layout'] === 'about_logos_image_or_file_layout_images' ? 'image' : 'file' );
                
                if( $type === 'image' ) :
                    $image = $logoOrFile['about_logos_image_or_file_layout_images_image'];
                    
                elseif( $type === 'file' ) :
                    $file = $logoOrFile['about_logos_image_or_file_layout_files_file'];
                    $image = $logoOrFile['about_logos_image_or_file_layout_files_image'];
                    
                endif;
    ?>
                <!-- Logo <?php echo $i; ?> -->
                <div class="logo">
                    <img src="<?php echo $image['sizes']['medium']; ?>" width="<?php echo $image['sizes']['medium-width']; ?>" height="<?php echo $image['sizes']['medium-height']; ?>" alt="<?php echo $image['title']; ?>" />
                    
    <?php
                    if( $type === 'image' ) :
    ?>
                    <a href="<?php echo $image['sizes']['large']; ?>" target="_blank">Lo res</a>
                    <a href="<?php echo $image['url']; ?>" target="_blank">Hi res</a>
    <?php
                    elseif( $type === 'file' ) :
    ?>
                    <a href="<?php echo $file['url']; ?>" target="_blank">Download File</a>
    <?php
                    endif;
    ?>
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
        $pressAssets = get_field('about_press_assets_by_type');
        _log($pressAssets);
        if( empty($pressAssets) != 1 ) :
    ?>
        <!-- Press Assets -->
        <div class="press-assets col-3">
            <h3>Press Assets</h3>
            <ul class="press-assets-list">
    <?php
            $i = 1;
            foreach( $pressAssets as $pressAsset ) :
                
                $assetType = ( $pressAsset['acf_fc_layout'] === 'about_press_assets_by_type_file' ? 'file' : 'link' );
                
                if( $assetType === 'file' ) :
                    $displayType = $pressAsset['about_press_assets_by_type_file_type'];
                    $assetTitle = $pressAsset['about_press_assets_by_type_file_title'];
                    $assetDate = $pressAsset['about_press_assets_by_type_file_date'];
                    $assetURL = $pressAsset['about_press_assets_by_type_file_file']['url'];
                    
                elseif( $assetType === 'link' ) :
                    $displayType = 'link';
                    $assetTitle = $pressAsset['about_press_assets_by_type_link_title'];
                    $assetDate = $pressAsset['about_press_assets_by_type_link_date'];
                    $assetURL = $pressAsset['about_press_assets_by_type_link_link'];
                    
                endif;
    ?>
                <!-- Link for Press Material <?php echo $i; ?> -->
                <li>
                    <a href="<?php echo $assetURL; ?>" target="_blank">
                    
                        <?php
                            if( $assetDate != '' ) {
                                echo '<span class="date">';
                                echo date('F j, Y', strtotime($assetDate));
                                echo '</span>';
                            }
                            echo '<span class="title">';
                            echo $assetTitle;
                            echo ' (' . $displayType . ')';
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
        // CONTACTS
        // Check for contact name and email
    ?>
        <!-- About Contact -->
        <div class="contacts col-3">
            <h3>Contact</h3>
            
    <?php
            // ADDRESS
            if( get_field('about_address') ) {
    ?>
            <p class="address"><?php the_field('about_address'); ?></p>
    <?php
            }
            
            // PHONE
            if( get_field('about_phone_number') ) {
    ?>
            <p class="phone"><?php the_field('about_phone_number'); ?></p>
    <?php
            }
            // EMAIL
            if( get_field('about_email') ) {
    ?>
            <a href="mailto:<?php the_field('about_email'); ?>"><?php the_field('about_email'); ?></a>
    <?php
            }
    ?>
        </div>
    
    <?php
        // SOCIAL MEDIA LINKS
        // Create array of social media links
        $socials = array(
            'facebook' => array(
                'class' => 'facebook',
                'title' => 'Facebook',
                'link' => get_field('about_facebook')
            ),
            'twitter' => array(
                'class' => 'twitter',
                'title' => 'Twitter',
                'link' => get_field('about_twitter')
            ),
            'instagram'=> array(
                'class' => 'instagram',
                'title' => 'Instagram',
                'link' => get_field('about_instagram')
            )
        );
        
        // Check for social media links
        if( $socials ) :
    ?>
        <!-- Social Media Links -->
        <div class="social-media col-3">
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
    
  </section><!-- .section-inner -->    
</section>
