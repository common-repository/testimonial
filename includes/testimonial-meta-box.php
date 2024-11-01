<?php
if ( ! defined('ABSPATH')) exit;  // if direct access



/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function meta_boxes_testimonial(){

    $screens = array( 'testimonial' );
    global $post;
    $post_id = $post->ID;




    foreach ( $screens as $screen ){
        add_meta_box('testimonial_metabox',__('Testimonial Options', 'testimonial'),'meta_boxes_testimonial_input', $screen);
        //add_meta_box('testimonial_metabox_side',__('Post Grid Information', 'testimonial'),'meta_boxes_testimonial_side', $screen,'side');
        add_meta_box('testimonial_metabox_side',__('Testimonial Information', 'testimonial'),'meta_boxes_testimonial_side', $screen,'side');

    }



}
add_action( 'add_meta_boxes', 'meta_boxes_testimonial' );



function meta_boxes_testimonial_input( $post ) {

    global $post;
    wp_nonce_field( 'meta_boxes_testimonial_input', 'meta_boxes_testimonial_input_nonce' );

    $post_id = $post->ID;

    $testimonial_options = get_post_meta($post_id,'testimonial_options', true);
    $current_tab = isset($testimonial_options['current_tab']) ? $testimonial_options['current_tab'] : 'shortcode';
    //$slider_for = !empty($testimonial_options['slider_for']) ? $testimonial_options['slider_for'] : 'products';


    $testimonial_settings_tab = array();


    $testimonial_settings_tab[] = array(
        'id' => 'shortcode',
        'title' => __('<i class="fas fa-laptop-code"></i> Shortcode','testimonial'),
        'priority' => 1,
        'active' => ($current_tab == 'shortcode') ? true : false,

    );

    $testimonial_settings_tab[] = array(
        'id' => 'templates',
        'title' => __('<i class="fas fa-palette"></i> Templates','testimonial'),
        'priority' => 2,
        'active' => ($current_tab == 'templates') ? true : false,
    );

    $testimonial_settings_tab[] = array(
        'id' => 'testimonial',
        'title' => __('<i class="fas fa-qrcode"></i> Testimonials','testimonial'),
        'priority' => 2,
        'active' => ($current_tab == 'testimonial') ? true : false,
    );

    $testimonial_settings_tab[] = array(
        'id' => 'slider_settings',
        'title' => __('<i class="fas fa-map"></i> Slider Settings','testimonial'),
        'priority' => 3,
        'active' => ($current_tab == 'slider_settings') ? true : false,
    );

//    $testimonial_settings_tab[] = array(
//        'id' => 'grid_settings',
//        'title' => __('<i class="fas fa-th-large"></i> Grid Settings','testimonial'),
//        'priority' => 4,
//        'active' => false,
//    );



    $testimonial_settings_tab[] = array(
        'id' => 'custom_scripts',
        'title' => __('<i class="far fa-file-code"></i> Custom Scripts','testimonial'),
        'priority' => 6,
        'active' => false,
    );




    $testimonial_settings_tabs = apply_filters('testimonial_settings_tabs', $testimonial_settings_tab);


    $tabs_sorted = array();
    foreach ($testimonial_settings_tabs as $page_key => $tab) $tabs_sorted[$page_key] = isset( $tab['priority'] ) ? $tab['priority'] : 0;
    array_multisort($tabs_sorted, SORT_ASC, $testimonial_settings_tabs);







    ?>

    <div class="testimonial-meta-box">

        <!--        <div class="">-->
<!--            View type: <label><input type="radio" name="testimonial_options[grid_type]" value="grid">Grid</label> <label><input name="testimonial_options[grid_type]" type="radio" value="slider">Slider</label>-->
<!--        </div>-->

        <div class="settings-tabs vertical">
            <input class="current_tab" type="hidden" name="testimonial_options[current_tab]" value="<?php echo esc_attr($current_tab); ?>">

            <ul class="tab-navs">
                <?php
                foreach ($testimonial_settings_tabs as $tab){
                    $id = $tab['id'];
                    $title = $tab['title'];
                    $active = $tab['active'];
                    $data_visible = isset($tab['data_visible']) ? $tab['data_visible'] : '';
                    $hidden = isset($tab['hidden']) ? $tab['hidden'] : false;
                    ?>
                    <li <?php if(!empty($data_visible)):  ?> data_visible="<?php echo esc_attr($data_visible); ?>" <?php endif; ?> class="tab-nav <?php if($hidden) echo 'hidden';?> <?php if($active) echo 'active';?>" data-id="<?php echo esc_attr($id); ?>"><?php echo $title; ?></li>
                    <?php
                }
                ?>
            </ul>
            <?php
            foreach ($testimonial_settings_tabs as $tab){
                $id = $tab['id'];
                $title = $tab['title'];
                $active = $tab['active'];


                ?>

                <div class="tab-content <?php if($active) echo 'active';?>" id="<?php echo esc_attr($id); ?>">
                    <?php
                    do_action('testimonial_meta_tabs_content_'.$id, $tab, $post_id);
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="clear clearfix"></div>

    </div>










    <?php



}



function meta_boxes_testimonial_side( $post ) {

    ?>
    <div class="post-grid-meta-box">

        <ul>
            <li>Version: <?php echo testimonial_version; ?></li>
            <li>Tested WP: 5.4</li>

        </ul>

        <h3>Documentation</h3>
        <a class="button" href="https://www.pickplugins.com/documentation/testimonial/?ref=dashboard" target="_blank">Documentation</a><p class="description">Before asking, submitting reviews please take a look on our documentation, may help your issue fast.</p>

        <h3>Looking for support?</h3>
        <a class="button" href="https://www.pickplugins.com/forum/?ref=dashboard" target="_blank">Create Ticket</a><p class="description">Its free and you can ask any question about our plugins and get support fast.</p>


        <h3>Provide your feedback</h3>

        <a class="button" href="https://wordpress.org/support/plugin/testimonial/reviews/" target="_blank">Submit Reviews</a> <a class="button" href="https://wordpress.org/support/plugin/testimonial/#new-topic-0" target="_blank">Ask wordpress.org</a><p>We spent thousand+ hours to development on this plugin, please submit your reviews wisely.</p><p>If you have any issue with this plugin please submit our forums or contact our support first.</p><p class="description">Your feedback and reviews are most important things to keep our development on track. If you have time please submit us five star <a href="https://wordpress.org/support/plugin/testimonial/reviews/?filter=5"> <span style="color: orange"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></a> reviews.</p>


    </div>
    <?php

}





/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */



function meta_boxes_testimonial_save( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['meta_boxes_testimonial_input_nonce'] ) )
        return $post_id;

    $nonce = sanitize_text_field($_POST['meta_boxes_testimonial_input_nonce']);

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'meta_boxes_testimonial_input' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;



    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    //$testimonial_collapsible = sanitize_text_field( $_POST['testimonial_collapsible'] );





    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $testimonial_options = pickplugins_testimonial_sanitize_arr( $_POST['testimonial_options'] );


    // Update the meta field in the database.
    update_post_meta( $post_id, 'testimonial_options', $testimonial_options );



}
add_action( 'save_post', 'meta_boxes_testimonial_save' );




