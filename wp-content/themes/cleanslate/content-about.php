<?php
/**
 *  Sub-Template:
 *  Loaded via page.php
 *  For displaying content on the About page.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<!-- Content-About Template -->
<section class="primary">
    
    <h2><?php the_title(); ?></h2>
<?php
        // SUBTITLE
        if( get_field('about_subtitle') ) {
?>
        <h3><?php the_field('about_subtitle'); ?></h3>
<?php
        }
?>
    <div class="text"><?php echo $post->post_content; ?></div>
    
</section>

<section class="secondary">
    <?php
        // LOGOS
        // Check for logos
        $logos = get_field('about_logos');
            
        if( empty($logos) != 1 ) :
    ?>
        <!-- Logos -->
        <div class="logos">
            <h3>Logos</h3>
    <?php
            $i = 1;
            foreach( $logos as $logo ) :
                $logoImage = $logo['about_logo'];
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
        // PRESS ASSETS
        // Check for press assets
        $pressAssets = get_field('about_press_assets');
            
        if( empty($pressAssets) != 1 ) :
    ?>
        <!-- Press Assets -->
        <div class="press-assets">
            <h3>Press Assets</h3>
            <ul class="press-assets-list">
    <?php
            $i = 1;
            
            foreach( $pressAssets as $pressAsset ) :
                
                $assetURL = ( $pressAsset['about_press_asset_file'] ? $pressAsset['about_press_asset_file']['url'] : $pressAsset['about_press_asset_link'] );
    ?>
                <!-- Link for Press Material <?php echo $i; ?> -->
                <li>
                    <a href="<?php echo $assetURL; ?>" target="_blank">
                        
                        <?php
                            if( $pressAsset['about_press_asset_date'] ) {
                                echo '<span class="date">';
                                echo date('F j, Y', strtotime($pressAsset['about_press_asset_date']));
                                echo '</span>';
                            }
                            echo '<span class="title">';
                            echo $pressAsset['about_press_asset_title'];
                            echo '&nbsp;(' . $pressAsset['about_press_asset_type'] . ')';
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
        <div class="contacts">
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
    
</section>
