<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

class class_metabox_testimonial_layout{
	
	public function __construct(){

		//meta box action for "testimonial"
		add_action('add_meta_boxes', array($this, 'metabox_testimonial_layout'));
		add_action('save_post', array($this, 'metabox_testimonial_layout_save'));



		}


	public function metabox_testimonial_layout($post_type){

            add_meta_box('metabox-testimonial-layout',__('Layout data', 'testimonial'), array($this, 'meta_box_testimonial_layout_data'), 'testimonial_template', 'normal', 'high');

		}






	public function meta_box_testimonial_layout_data($post) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field('testimonial_nonce_check', 'testimonial_nonce_check_value');
 
        // Use get_post_meta to retrieve an existing value from the database.
       // $testimonial_data = get_post_meta($post -> ID, 'testimonial_data', true);

        $post_id = $post->ID;


        $pickp_settings_tabs_field = new pickp_settings_tabs_field();

        $testimonial_settings_tab = array();

        $testimonial_settings_tab[] = array(
            'id' => 'layout_builder',
            'title' => sprintf(__('%s Layout builder','testimonial'),'<i class="fas fa-qrcode"></i>'),
            'priority' => 4,
            'active' => true,
        );


        $testimonial_settings_tab[] = array(
            'id' => 'custom_scripts',
            'title' => sprintf(__('%s Custom scripts','testimonial'),'<i class="far fa-building"></i>'),
            'priority' => 5,
            'active' => false,
        );



        $testimonial_settings_tab = apply_filters('testimonial_layout_metabox_navs', $testimonial_settings_tab);

        $tabs_sorted = array();
        foreach ($testimonial_settings_tab as $page_key => $tab) $tabs_sorted[$page_key] = isset( $tab['priority'] ) ? $tab['priority'] : 0;
        array_multisort($tabs_sorted, SORT_ASC, $testimonial_settings_tab);


        wp_enqueue_style('testimonial-style');

		?>


        <div class="settings-tabs vertical">
            <ul class="tab-navs">
                <?php
                foreach ($testimonial_settings_tab as $tab){
                    $id = $tab['id'];
                    $title = $tab['title'];
                    $active = $tab['active'];
                    $data_visible = isset($tab['data_visible']) ? $tab['data_visible'] : '';
                    $hidden = isset($tab['hidden']) ? $tab['hidden'] : false;
                    ?>
                    <li <?php if(!empty($data_visible)):  ?> data_visible="<?php echo $data_visible; ?>" <?php endif; ?> class="tab-nav <?php if($hidden) echo 'hidden';?> <?php if($active) echo 'active';?>" data-id="<?php echo esc_attr($id); ?>"><?php echo $title; ?></li>
                    <?php
                }
                ?>
            </ul>
            <?php
            foreach ($testimonial_settings_tab as $tab){
                $id = $tab['id'];
                $title = $tab['title'];
                $active = $tab['active'];
                ?>

                <div class="tab-content <?php if($active) echo 'active';?>" id="<?php echo esc_attr($id); ?>">
                    <?php
                    do_action('testimonial_layout_metabox_content_'.$id, $post_id);
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="clear clearfix"></div>

        <?php

   		}




	public function metabox_testimonial_layout_save($post_id){

        /*
         * We need to verify this came from the our screen and with
         * proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['testimonial_nonce_check_value']))
            return $post_id;

        $nonce = sanitize_text_field($_POST['testimonial_nonce_check_value']);

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'testimonial_nonce_check'))
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        // Check the user's permissions.
        if ('page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id))
                return $post_id;

        } else {

            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }

        /* OK, its safe for us to save the data now. */

        // Sanitize the user input.
        //$grid_item_layout = pickplugins_testimonial_sanitize_arr($_POST['grid_item_layout']);


        // Update the meta field.
        //update_post_meta($post_id, 'grid_item_layout', $grid_item_layout);

        do_action('testimonial_layout_metabox_save', $post_id);


					
		}
	
	}


new class_metabox_testimonial_layout();