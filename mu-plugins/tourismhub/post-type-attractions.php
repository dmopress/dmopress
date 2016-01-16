<?php

// Attraction Categories
function tourismpress_register_attractions_categories() {

    $labels = array(
        'name'                  => _x( 'Attraction Categories', 'Attraction Categories', 'tourismpress_textdomain' ),
        'singular_name'         => _x( 'Attraction Category', 'Attraction Category', 'tourismpress_textdomain' ),
        'search_items'          => __( 'Search Attraction Categories', 'tourismpress_textdomain' ),
        'popular_items'         => __( 'Popular Attraction Categories', 'tourismpress_textdomain' ),
        'all_items'             => __( 'All Attraction Categories', 'tourismpress_textdomain' ),
        'parent_item'           => __( 'Parent Attraction Category', 'tourismpress_textdomain' ),
        'parent_item_colon'     => __( 'Parent Attraction Category', 'tourismpress_textdomain' ),
        'edit_item'             => __( 'Edit Attraction Category', 'tourismpress_textdomain' ),
        'update_item'           => __( 'Update Attraction Category', 'tourismpress_textdomain' ),
        'add_new_item'          => __( 'Add New Attraction Category', 'tourismpress_textdomain' ),
        'new_item_name'         => __( 'New Attraction Category Name', 'tourismpress_textdomain' ),
        'add_or_remove_items'   => __( 'Add or remove Attraction Categories', 'tourismpress_textdomain' ),
        'choose_from_most_used' => __( 'Choose from most used categories', 'tourismpress_textdomain' ),
        'menu_name'             => __( 'Attraction Categories', 'tourismpress_textdomain' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => false,
        'hierarchical'      => false,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );

    register_taxonomy( 'attractions-category', array( 'attractions' ), $args );
}

////FIX
$option = get_option('tourismpress_option');
if(isValidGoogleAnalyticsID($option['google_analytics'])){
    
}

add_action( 'init', 'tourismpress_register_attractions_categories' );

// Attractions Post Type
function register_attractions_post_type() {

	$labels = array(
		'name'                => __( 'Attractions', 'tourismpress_textdomain' ),
		'singular_name'       => __( 'Attraction', 'tourismpress_textdomain' ),
		'add_new'             => __( 'Add New Attraction', 'tourismpress_textdomain', 'tourismpress_textdomain' ),
		'add_new_item'        => __( 'Add New Attraction', 'tourismpress_textdomain' ),
		'edit_item'           => __( 'Edit Attraction', 'tourismpress_textdomain' ),
		'new_item'            => __( 'New Attraction', 'tourismpress_textdomain' ),
		'view_item'           => __( 'View Attraction', 'tourismpress_textdomain' ),
		'search_items'        => __( 'Search Attractions', 'tourismpress_textdomain' ),
		'not_found'           => __( 'No Attractions found', 'tourismpress_textdomain' ),
		'not_found_in_trash'  => __( 'No Attractions found in Trash', 'tourismpress_textdomain' ),
		'parent_item_colon'   => __( 'Parent Attraction:', 'tourismpress_textdomain' ),
		'menu_name'           => __( 'Attractions', 'tourismpress_textdomain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array('attractions-category','post_tag'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-location',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array(
			'slug' => 'do'
			),
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'thumbnail'),
	);

	register_post_type( 'attractions', $args );
}

////FIX
$option = get_option('tourismpress_option');
if(isValidGoogleAnalyticsID($option['google_analytics'])){
    
}

add_action( 'init', 'register_attractions_post_type' );


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function tourismpress_attraction_add_meta_box() {
    add_meta_box(
        'attraction_details_section',
        __('Attraction Details', 'tourismpress_textdomain'),
        'tourismpress_attraction_meta_box_callback',
        'attractions',
        'location',
        'high'
    );
}
add_action( 'add_meta_boxes_attractions', 'tourismpress_attraction_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function tourismpress_attraction_meta_box_callback($post) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'tourismpress_attraction_save_meta_box_data', 'tourismpress_attraction_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    

   ?>

   <div class="row">
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
           <?php

           $address_var = get_post_meta( $post->ID, 'address', true );

            echo '<p><label for="address">';
            _e( 'Address: ', 'tourismpress_textdomain' );
            echo '</label><br />';
            echo '<input type="text" style="width: 100%" id="address" name="address" value="' . esc_attr( $address_var ) . '" size="25" /></p>';

            ?>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <?php
                    $city_var = get_post_meta( $post->ID, 'city', true );

                    echo '<p><label for="city">';
                    _e( 'City:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input type="text" style="width: 100%" id="city" name="city" value="' . esc_attr( $city_var ) . '" size="25" /></p>';
                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <?php

                    $stateprov_var = get_post_meta( $post->ID, 'stateprov', true );

                    echo '<p><label for="stateprov">';
                    _e( 'Province / State:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input type="text" style="width: 100%" id="stateprov" name="stateprov" value="' . esc_attr( $stateprov_var ) . '" size="25" /></p>';

                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <?php

                    $zip_var = get_post_meta( $post->ID, 'zip', true );

                    echo '<p><label for="zip">';
                    _e( 'Postal Code / ZIP:', 'tourismpress_textdomain' );
                    echo '</label><br /> ';
                    echo '<input type="text" style="width: 100%" id="zip" name="zip" value="' . esc_attr( $zip_var ) . '" size="25" /></p>';

                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

                </div>
            </div>
            
       </div>
       
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <?php

            $website_url_var = get_post_meta( $post->ID, 'website_url', true );

            echo '<p><label for="website_url">';
            _e( 'Website URL:', 'tourismpress_textdomain' );
            echo '</label><br /> ';
            echo '<input type="text" placeholder="http://" style="width: 100%" id="website_url" name="website_url" value="' . esc_attr( $website_url_var ) . '" size="25" /></p>';

            ?>
            <?php

            $facebook_url_var = get_post_meta( $post->ID, 'facebook_url', true );

            echo '<p><label for="facebook_url">';
            _e( 'Facebook Page URL:', 'tourismpress_textdomain' );
            echo '</label><br /> ';
            echo '<input type="text" placeholder="http://" style="width: 100%" id="facebook_url" name="facebook_url" value="' . esc_attr( $facebook_url_var ) . '" size="25" /></p>';

            ?>

            <?php

            $twitter_url = get_post_meta( $post->ID, 'twitter_url', true );

            echo '<p><label for="twitter_url">';
            _e( 'Twitter Profile URL:', 'tourismpress_textdomain' );
            echo '</label><br /> ';
            echo '<input type="text" placeholder="http://" style="width: 100%" id="twitter_url" name="twitter_url" value="' . esc_attr( $twitter_url ) . '" size="25" /></p>';

            ?>
            <?php

            $instagram_url_var = get_post_meta( $post->ID, 'instagram_url', true );

            echo '<p><label for="instagram_url">';
            _e( 'Instagram URL:', 'tourismpress_textdomain' );
            echo '</label><br /> ';
            echo '<input type="text" placeholder="http://" style="width: 100%" id="instagram_url" name="instagram_url" value="' . esc_attr( $instagram_url_var ) . '" size="25" /></p>';

            ?>

            <?php 
                $option = get_option('tourismpress_option');
                if($option['google_maps_api_key'] != ''){
                    $mapsapikey = $option['google_maps_api_key'];
                } else {
                    $mapsapikey = 'EMPTY API KEY';
                }
            ?>
       </div>
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
           <label>Map:</label>
           <div class="tourismpress-map">
               <iframe
                 width="100%"
                 height="200"
                 frameborder="0" style="border:0"
                 src="https://www.google.com/maps/embed/v1/place?key=<?php echo $mapsapikey ?>&q=<?php echo $address_var.','.$city_var.','.$stateprov_var.','.$zip_var ?>" allowfullscreen>
               </iframe>
           </div>
       </div>
       
   </div>


    <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function tourismpress_attraction_save_meta_box_data($post_id) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['tourismpress_attraction_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['tourismpress_attraction_meta_box_nonce'], 'tourismpress_attraction_save_meta_box_data' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if (isset( $_POST['post_type'] ) && 'page' == $_POST['post_type']) {
        if (!current_user_can( 'edit_page', $post_id )) {
            return;
        }
    } else {
        if (!current_user_can( 'edit_post', $post_id )) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */
    
    // Make sure that it is set.
    if (!isset( $_POST['address'])) {
        return;
    }
    if (!isset( $_POST['city'])) {
        return;
    }
    if (!isset( $_POST['stateprov'])) {
        return;
    }
    if (!isset( $_POST['zip'])) {
        return;
    }
    if (!isset( $_POST['website_url'])) {
        return;
    }
    if (!isset( $_POST['facebook_url'])) {
        return;
    }
    if (!isset( $_POST['twitter_url'])) {
        return;
    }
    if (!isset( $_POST['instagram_url'])) {
        return;
    }

    // Sanitize user input.
    $address = sanitize_text_field($_POST['address']);
    $city = sanitize_text_field($_POST['city']);
    $stateprov = sanitize_text_field($_POST['stateprov']);
    $zip = sanitize_text_field($_POST['zip']);
    $website_url = sanitize_text_field($_POST['website_url']);
    $facebook_url = sanitize_text_field($_POST['facebook_url']);
    $twitter_url = sanitize_text_field($_POST['twitter_url']);
    $instagram_url = sanitize_text_field($_POST['instagram_url']);

    // Update the meta field in the database.
    update_post_meta($post_id, 'address', $address);
    update_post_meta($post_id, 'city', $city);
    update_post_meta($post_id, 'stateprov', $stateprov);
    update_post_meta($post_id, 'zip', $zip);
    update_post_meta($post_id, 'website_url', $website_url);
    update_post_meta($post_id, 'facebook_url', $facebook_url);
    update_post_meta($post_id, 'twitter_url', $twitter_url);
    update_post_meta($post_id, 'instagram_url', $instagram_url);
}

add_action('save_post', 'tourismpress_attraction_save_meta_box_data');

// Move all "location" metabox above the default editor
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'location', $post);
    unset($wp_meta_boxes[get_post_type($post)]['location']);
});