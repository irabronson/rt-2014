    <?php
        // Get current date for New York
        // Previously used _log(date('Y-m-d',strtotime("today")));
        $getToday = new DateTime('now', new DateTimeZone('America/New_York'));
        $today = $getToday->format('Y-m-d');
        
        // get all rows from the postmeta table where the sub_field (type) equals 'type_3'
        // - http://codex.wordpress.org/Class_Reference/wpdb#SELECT_Generic_Results
        $upcomingRows = $wpdb->get_results($wpdb->prepare( 
            "
            SELECT * 
            FROM wp_postmeta
            WHERE meta_key LIKE %s
                AND meta_value > %s ORDER BY meta_value ASC
            ",
            'artist_album_%_artist_album_date', // meta_name: $ParentName_$RowNumber_$ChildName
             $today // meta_value: 'type_3' for example
        ));
        
        if( $upcomingRows ) :
    ?>
    <section class="primary">
      <section class="section-inner">
        <div class="upcoming-releases">
            <h2>Upcoming Releases</h2>
            <div class="releases">
    <?php
            foreach( $upcomingRows as $upcomingRow ) :
                
                $post = get_post($upcomingRow->post_id);
                
                // Exclude password-protected posts
                if ( empty($post->post_password) || is_user_logged_in() === true ) :
                    
                    // for each result, find the 'repeater row number' and use it to load the image sub field!
                    preg_match('_([0-9]+)_', $upcomingRow->meta_key, $matches); // $matches[0] contains the row number!
                    $albumTitleKey = 'artist_album_' . $matches[0] . '_artist_album_title';
                    $albumDateKey = 'artist_album_' . $matches[0] . '_artist_album_date';
                    $albumImageKey = 'artist_album_' . $matches[0] . '_artist_album_image';
                    
                    //  use get_post_meta to load the image sub field
                    // - http://codex.wordpress.org/Function_Reference/get_post_meta
                    $albumTitle = get_post_meta( $upcomingRow->post_id, $albumTitleKey );
                    $albumDate = get_post_meta( $upcomingRow->post_id, $albumDateKey );
                    $imageID = get_post_meta( $upcomingRow->post_id, $albumImageKey, true );
                    
                    // load image src
                    // - http://www.advancedcustomfields.com/resources/field-types/image/
                    $image = wp_get_attachment_image_src( $imageID, 'thumbnail' );
    ?>
                    <div class="release">
                        <a href="<?php echo get_permalink( $upcomingRow->post_id ); ?>">
                            <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $albumTitle[0]; ?>" />
                            <p class="caption">
                                <span class="album-title"><?php echo $albumTitle[0]; ?></span>
                                <span class="album-date"><?php echo date('F j, Y', strtotime($albumDate[0])); ?></span>
                                <span class="artist-name"><?php echo get_the_title( $upcomingRow->post_id ); ?></span>
                            </p>
                        </a>
                    </div>
    <?php
                endif;
                
            endforeach;
    ?>
            </div>
        </div>
      </section><!-- .section-inner -->
    </section>
    <?php
        endif;
    ?>


    <?php
        // get all rows from the postmeta table where the sub_field (type) equals 'type_3'
        // - http://codex.wordpress.org/Class_Reference/wpdb#SELECT_Generic_Results
        $recentRows = $wpdb->get_results($wpdb->prepare( 
            "
            SELECT * 
            FROM wp_postmeta
            WHERE meta_key LIKE %s
                AND meta_value BETWEEN %s AND %s ORDER BY meta_value DESC
            ",
            'artist_album_%_artist_album_date', // meta_name: $ParentName_$RowNumber_$ChildName
             date('Y-m-d',strtotime("-6 months")),
             $today
        ));
        
        if( $recentRows ) :
    ?>
    <section class="secondary">
      <section class="section-inner">
        <div class="new-releases">
            <h2>New Releases</h2>
            <div class="releases">
    <?php
            foreach( $recentRows as $recentRow ) :
                
                $post = get_post($recentRow->post_id);
                
                // Exclude password-protected posts
                if ( empty($post->post_password) || is_user_logged_in() === true ) :
                    
                    // for each result, find the 'repeater row number' and use it to load the image sub field!
                    preg_match('_([0-9]+)_', $recentRow->meta_key, $matches); // $matches[0] contains the row number!
                    $albumTitleKey = 'artist_album_' . $matches[0] . '_artist_album_title';
                    $albumDateKey = 'artist_album_' . $matches[0] . '_artist_album_date';
                    $albumImageKey = 'artist_album_' . $matches[0] . '_artist_album_image';
                    
                    //  use get_post_meta to load the image sub field
                    // - http://codex.wordpress.org/Function_Reference/get_post_meta
                    $albumTitle = get_post_meta( $recentRow->post_id, $albumTitleKey );
                    $albumDate = get_post_meta( $recentRow->post_id, $albumDateKey );
                    $imageID = get_post_meta( $recentRow->post_id, $albumImageKey, true );
                    
                    // load image src
                    // - http://www.advancedcustomfields.com/resources/field-types/image/
                    $image = wp_get_attachment_image_src( $imageID, 'thumbnail' );
    ?>
                    <div class="release">
                        <a href="<?php echo get_permalink( $recentRow->post_id ); ?>">
                            <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $albumTitle[0]; ?>" />
                            <p class="caption">
                                <span class="album-title"><?php echo $albumTitle[0]; ?></span>
                                <span class="album-date"><?php echo date('F j, Y', strtotime($albumDate[0])); ?></span>
                                <span class="artist-name"><?php echo get_the_title( $recentRow->post_id ); ?></span>
                            </p>
                        </a>
                    </div>
    <?php
                endif;
            endforeach;
    ?>
            </div>
        </div>
      </section><!-- .section-inner -->
    </section>
    <?php
        endif;
    ?>