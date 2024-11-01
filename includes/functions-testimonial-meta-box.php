<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



add_action('testimonial_meta_tabs_content_custom_scripts', 'testimonial_meta_tabs_content_custom_scripts',10, 2);

if(!function_exists('testimonial_meta_tabs_content_custom_scripts')) {
    function testimonial_meta_tabs_content_custom_scripts($tab, $post_id){


        $pickp_settings_tabs_field = new pickp_settings_tabs_field();

        $testimonial_options = get_post_meta( $post_id, 'testimonial_options', true );

        ?>
        <pre><?php //echo var_export($testimonial_options, true); ?></pre>
        <?php



        $custom_css = isset($testimonial_options['custom_css']) ? $testimonial_options['custom_css'] : '';
        $enable_schema = isset($testimonial_options['enable_schema']) ? $testimonial_options['enable_schema'] : '';


        ?>
        <div class="section">
            <div class="section-title">Custom scripts</div>
            <p class="description section-description">Add your own scritps and style css.</p>

            <?php

            $args = array(
                'id'		=> 'custom_css',
                'parent' => 'testimonial_options',
                'title'		=> __('Custom CSS','testimonial'),
                'details'	=> __('Add your own CSS..','testimonial'),
                'type'		=> 'scripts_css',
                'value'		=> $custom_css,
                'default'		=> '.testimonial-container #testimonial-133{}&#10; ',
            );

            $pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'enable_schema',
                'parent' => 'testimonial_options',
                'title'		=> __('Enable schema','testimonial'),
                'details'	=> __('Enable or disable testimonial schema.','testimonial'),
                'type'		=> 'select',
                'value'		=> $enable_schema,
                'default'		=> 'false',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),



                ),
            );

            $pickp_settings_tabs_field->generate_field($args);





            ?>


        </div>
        <?php






	}

}









add_action('testimonial_meta_tabs_content_templates', 'testimonial_meta_tabs_content_templates',10, 2);

if(!function_exists('testimonial_meta_tabs_content_templates')) {
    function testimonial_meta_tabs_content_templates($tab, $post_id){
        $pickp_settings_tabs_field = new pickp_settings_tabs_field();

        //$testimonial_items_thumb_size = get_post_meta( $post_id, 'testimonial_items_thumb_size', true );
        $testimonial_options = get_post_meta( $post_id, 'testimonial_options', true );
        $template = isset($testimonial_options['template']) ? $testimonial_options['template'] : '';
        $template_id = isset($testimonial_options['template_id']) ? $testimonial_options['template_id'] : '';

        $testimonial_plugin_info = get_option('testimonial_plugin_info');
        $import_layouts = !empty($testimonial_plugin_info['import_layouts']) ? $testimonial_plugin_info['import_layouts'] : '';

        //echo var_export($testimonial_plugin_info, true);

//        $testimonial_plugin_info['import_layouts'] = '';
//        update_option('testimonial_plugin_info', $testimonial_plugin_info);

        ?>
        <div class="section">
            <div class="section-title">Templates</div>
            <p class="description section-description">Choose your template.</p>

            <?php


            ob_start();

            ?>
            <p><a target="_blank" class="button" href="<?php echo admin_url().'post-new.php?post_type=testimonial_template'; ?>"><?php echo __('Create template','testimonial'); ?></a> </p>
            <p><a target="_blank" class="button" href="<?php echo admin_url().'edit.php?post_type=testimonial_template'; ?>"><?php echo __('Manage templates','testimonial'); ?></a> </p>

            <?php
            if($import_layouts != 'done'):

                $actionurl = admin_url().'post.php?post='.$post_id.'&action=edit';
                $actionurl = wp_nonce_url( $actionurl,  'testimonial_nonce' );


                ?>
                <p><a class="button" href="<?php echo esc_url_raw($actionurl); ?>"><?php echo __('Import templates','testimonial'); ?></a> </p>
                <?php
            elseif($import_layouts == 'running'):
                $url = admin_url().'post.php?post='.$post_id.'&action=edit';

                ?>
                <p>Importing templates on background running, please check back later <a class="button" href="<?php echo esc_url_raw($url); ?>">Refresh</a></p>

                <?php
            endif;

            $nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field($_REQUEST['_wpnonce']) : '';


            if ( wp_verify_nonce( $nonce, 'testimonial_nonce' )  ){
                $url = admin_url().'post.php?post='.$post_id.'&action=edit';

                testimonial_import_templates();

                ?>
                <p>Importing templates on background running, please check back later <a class="button" href="<?php echo esc_url_raw($url); ?>">Refresh</a></p>

                <?php

            }



            $html = ob_get_clean();

            $args = array(
                'id'		=> 'create_testimonial_layout',
                'parent'		=> 'testimonial_options[query]',
                'title'		=> __('Create template','testimonial'),
                'details'	=> __('Please follow the links to create templates or manage.','testimonial'),
                'type'		=> 'custom_html',
                'html'		=> $html,
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'posts_per_page'   => -1,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'post_type'        => 'testimonial_template',
                'post_status'      => 'publish',

            );

            $posts_array = get_posts( $args );

            $postData = array();

            foreach ($posts_array as $post):

                $layout_options = get_post_meta($post->ID,'layout_options', true);
                $layout_preview_img = isset($layout_options['layout_preview_img']) ? $layout_options['layout_preview_img'] : '';

                $postData[$post->ID]['name'] = $post->post_title;
                $postData[$post->ID]['thumb'] = $layout_preview_img;
                $postData[$post->ID]['link'] = get_edit_post_link($post->ID);
                $postData[$post->ID]['link_text'] = 'Edit';

                //$postData[$post_id] = array('name'=> $post->post_title, 'link_text'=>'Edit', 'link'=> get_edit_post_link($post_id), 'thumb'=> $layout_preview_img, );


            endforeach;


            $template_id = !empty($template_id) ? $template_id : key($postData);

            //var_dump(key($postData));



            $args = array(
                'id'		=> 'template_id',
                'parent' => 'testimonial_options',
                'title'		=> __('Template','testimonial'),
                'details'	=> __('Choose template.','testimonial'),
                'type'		=> 'radio_image',
                'width'		=> '180px',

                'value'		=> $template_id,

                'default'		=> '',
                'args'		=> $postData,
            );

            $pickp_settings_tabs_field->generate_field($args);


            ?>


        </div>
        <?php

    }
}




add_action('testimonial_meta_tabs_content_testimonial', 'testimonial_meta_tabs_content_testimonial',10, 2);

if(!function_exists('testimonial_meta_tabs_content_testimonial')) {
    function testimonial_meta_tabs_content_testimonial($tab, $post_id){
        $pickp_settings_tabs_field = new pickp_settings_tabs_field();

        $testimonial_options = get_post_meta( $post_id, 'testimonial_options', true );
        $testimonials = isset($testimonial_options['testimonials']) ? $testimonial_options['testimonials'] : array();



        ?>
        <div class="section">
            <div class="section-title">Create Testimonial</div>
            <p class="description section-description">Add your testimonial here.</p>



            <?php


            $testimonials_fields = array(

                array(
                    'id'		=> 'name',
                    'title'		=> __('Name','testimonial'),
                    'details'	=> __('Write name here.','testimonial'),
                    'type'		=> 'text',
                    'value'		=> '',
                    'default'		=> '',
                    'placeholder'		=> 'Mark Jhon',
                ),
                array(
                    'id'		=> 'content',
                    'title'		=> __('Content','testimonial'),
                    'details'	=> __('Write details text here.','testimonial'),
                    'type'		=> 'textarea',
                    'value'		=> '',
                    'default'		=> '',
                    'placeholder'		=> 'Testimonial content here...',
                ),
                array(
                    'id'		    => 'thumbnail',
                    'title'		    => __('Thumbnail ','text-domain'),
                    'details'	    => __('Add thumbnail','text-domain'),
                    'placeholder'	=> '',
                    'type'		=> 'media',
                ),
                array(
                    'id'		=> 'company_name',
                    'title'		=> __('Company Name','testimonial'),
                    'details'	=> __('Write company name here.','testimonial'),
                    'type'		=> 'text',
                    'value'		=> '',
                    'default'		=> '',
                    'placeholder'		=> 'My Company',
                ),

                array(
                    'id'		=> 'position',
                    'title'		=> __('Position','testimonial'),
                    'details'	=> __('Write position here.','testimonial'),
                    'type'		=> 'text',
                    'value'		=> '',
                    'default'		=> '',
                    'placeholder'		=> 'Lead Developer',
                ),
                array(
                    'id'		=> 'rating',
                    'title'		=> __('Rating','testimonial'),
                    'details'	=> __('Select star rating.','testimonial'),
                    'type'		=> 'select',
                    'value'		=> '',
                    'default'		=> '5',
                    'args'		=> array(
                        '5'=>__('5','testimonial'),
                        '4'=>__('4','testimonial'),
                        '3'=>__('3','testimonial'),
                        '2'=>__('2','testimonial'),
                        '1'=>__('1','testimonial'),





                    ),
                )



            );


            $testimonials_fields = apply_filters('testimonials_fields', $testimonials_fields);


            $args = array(
                'id'		=> 'testimonials',
                'parent'		=> 'testimonial_options',
                'title'		=> __('Testimonials','text-domain'),
                'details'	=> __('Put your testimonial here','text-domain'),
                'collapsible'=>true,
                'type'		=> 'repeatable',
                'limit'		=> 10,
                'title_field'		=> 'name',
                'value'		=> $testimonials,
                'fields'    => $testimonials_fields,
            );

            $pickp_settings_tabs_field->generate_field($args);







            ?>


        </div>
        <?php

    }
}






















add_action('testimonial_meta_tabs_content_slider_settings', 'testimonial_meta_tabs_content_slider_settings',10, 2);

if(!function_exists('testimonial_meta_tabs_content_slider_settings')) {
    function testimonial_meta_tabs_content_slider_settings($tab, $post_id){

        $pickp_settings_tabs_field = new pickp_settings_tabs_field();
        $testimonial_options = get_post_meta( $post_id, 'testimonial_options', true );

        ?>
        <pre><?php //echo var_export($testimonial_options, true); ?></pre>
        <?php



        $slider_column_desktop = isset($testimonial_options['slider_column_desktop']) ? $testimonial_options['slider_column_desktop'] : '2';
        $slider_column_tablet = isset($testimonial_options['slider_column_tablet']) ? $testimonial_options['slider_column_tablet'] : '2';
        $slider_column_mobile = isset($testimonial_options['slider_column_mobile']) ? $testimonial_options['slider_column_mobile'] : '1';

        $slider_rows_enable = isset($testimonial_options['slider_rows_enable']) ? $testimonial_options['slider_rows_enable'] : 'false';
        $slider_rows_desktop = isset($testimonial_options['slider_rows_desktop']) ? $testimonial_options['slider_rows_desktop'] : '2';
        $slider_rows_tablet = isset($testimonial_options['slider_rows_tablet']) ? $testimonial_options['slider_rows_tablet'] : '2';
        $slider_rows_mobile = isset($testimonial_options['slider_rows_mobile']) ? $testimonial_options['slider_rows_mobile'] : '2';

        $slider_auto_play = isset($testimonial_options['slider_auto_play']) ? $testimonial_options['slider_auto_play'] : 'true';
        $slider_auto_play_speed = isset($testimonial_options['slider_auto_play_speed']) ? $testimonial_options['slider_auto_play_speed'] : '1200';
        $slider_auto_play_timeout = isset($testimonial_options['slider_auto_play_timeout']) ? $testimonial_options['slider_auto_play_timeout'] : '1000';

        $slider_slide_speed = isset($testimonial_options['slider_slide_speed']) ? $testimonial_options['slider_slide_speed'] : '1000';
        $slider_pagination_slide_speed = isset($testimonial_options['slider_pagination_slide_speed']) ? $testimonial_options['slider_pagination_slide_speed'] : '1000';
        $slider_slideBy = isset($testimonial_options['slider_slideBy']) ? $testimonial_options['slider_slideBy'] : '4';


        $slider_rewind = isset($testimonial_options['slider_rewind']) ? $testimonial_options['slider_rewind'] : 'false';
        $slider_loop = isset($testimonial_options['slider_loop']) ? $testimonial_options['slider_loop'] : 'false';
        $slider_center = isset($testimonial_options['slider_center']) ? $testimonial_options['slider_center'] : 'false';
        $slider_stop_on_hover = isset($testimonial_options['slider_stop_on_hover']) ? $testimonial_options['slider_stop_on_hover'] : 'true';
        $slider_navigation = isset($testimonial_options['slider_navigation']) ? $testimonial_options['slider_navigation'] : 'false';
        $slider_navigation_position = isset($testimonial_options['slider_navigation_position']) ? $testimonial_options['slider_navigation_position'] : 'top-right';
        $slider_nav_theme = isset($testimonial_options['slider_nav_theme']) ? $testimonial_options['slider_nav_theme'] : 'navThemes1';


        $slider_pagination = isset($testimonial_options['slider_pagination']) ? $testimonial_options['slider_pagination'] : 'false';
        $slider_pagination_bg = isset($testimonial_options['slider_pagination_bg']) ? $testimonial_options['slider_pagination_bg'] : '';
        $slider_pagination_bg_active = isset($testimonial_options['slider_pagination_bg_active']) ? $testimonial_options['slider_pagination_bg_active'] : '';
        $slider_pagination_theme = isset($testimonial_options['slider_pagination_theme']) ? $testimonial_options['slider_pagination_theme'] : '';


        $slider_pagination_text_color = isset($testimonial_options['slider_pagination_text_color']) ? $testimonial_options['slider_pagination_text_color'] : '';
        $slider_pagination_count = isset($testimonial_options['slider_pagination_count']) ? $testimonial_options['slider_pagination_count'] : 'false';

        $slider_touch_drag = isset($testimonial_options['slider_touch_drag']) ? $testimonial_options['slider_touch_drag'] : 'true';
        $slider_mouse_drag = isset($testimonial_options['slider_mouse_drag']) ? $testimonial_options['slider_mouse_drag'] : 'true';
        $slider_rtl = isset($testimonial_options['slider_rtl']) ? $testimonial_options['slider_rtl'] : 'false';

        $slider_animateout = isset($testimonial_options['slider_animateout']) ? $testimonial_options['slider_animateout'] : '';
        $slider_animateIn = isset($testimonial_options['slider_animateIn']) ? $testimonial_options['slider_animateIn'] : '';




        ?>
        <div class="section">
        <div class="section-title">Slider Options</div>
        <p class="description section-description">Customize slider options here.</p>
            <?php


            ob_start();

            ?>
            <div><?php _e('In Destop: (min:1000px and max)', 'testimonial');?></div>
            <input type="text" placeholder="4"   name="testimonial_options[slider_column_desktop]" value="<?php echo esc_attr($slider_column_desktop);  ?>" />

            <div><?php _e('In Tablet & Small Desktop: (900px max width)', 'testimonial');?></div>
            <input type="text" placeholder="2"  name="testimonial_options[slider_column_tablet]" value="<?php echo esc_attr($slider_column_tablet);  ?>" />

            <div><?php _e('In Mobile: (479px max width)', 'testimonial');?></div>
            <input type="text" placeholder="1"  name="testimonial_options[slider_column_mobile]" value="<?php echo esc_attr($slider_column_mobile);  ?>" />
            <?php


            $html = ob_get_clean();
            $args = array(
                'id' => 'slider_columns',
                'parent' => 'testimonial_options',
                'title' => __('Slider column number', 'testimonial'),
                'details' => '',
                'type' => 'custom_html',
                'html' => $html,
            );
            $pickp_settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'slider_rows_enable',
                'parent' => 'testimonial_options',
                'title'		=> __('Enable slider row','testimonial'),
                'details'	=> __('Enable or disable slider rows.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_rows_enable,
                'default'		=> 'false',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),



                ),
            );

            //$pickp_settings_tabs_field->generate_field($args);





            ob_start();

            ?>
            <div><?php _e('In Desktop: (min:1000px and max)', 'testimonial');?></div>
            <input type="text" placeholder="2"   name="testimonial_options[slider_rows_desktop]" value="<?php echo esc_attr($slider_rows_desktop);  ?>" />

            <div><?php _e('In Tablet & Small Desktop: (900px max width)', 'testimonial');?></div>
            <input type="text" placeholder="1"  name="testimonial_options[slider_rows_tablet]" value="<?php echo esc_attr($slider_rows_tablet);  ?>" />

            <div><?php _e('In Mobile: (479px max width)', 'testimonial');?></div>
            <input type="text" placeholder="1"  name="testimonial_options[slider_rows_mobile]" value="<?php echo esc_attr($slider_rows_mobile);  ?>" />
            <?php


            $html = ob_get_clean();
            $args = array(
                'id' => 'slider_rows',
                'parent' => 'testimonial_options',
                'title' => __('Slider row number', 'testimonial'),
                'details' => '',
                'type' => 'custom_html',
                'html' => $html,
            );
            //$pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'slider_auto_play',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider auto play','testimonial'),
                'details'	=> __('Enable or disable slider autoplay.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_auto_play,
                'default'		=> 'true',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),



                ),
            );

            $pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'slider_auto_play_speed',
                'parent'		=> 'testimonial_options',
                'title'		=> __('Auto play speed','testimonial'),
                'details'	=> __('Set auto play speed, ex: 1500, 1000 = 1 second','testimonial'),
                'type'		=> 'text',
                'value'		=> $slider_auto_play_speed,
                'default'		=> 1500,
                'placeholder'   => '1500',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'slider_auto_play_timeout',
                'parent'		=> 'testimonial_options',
                'title'		=> __('Auto play timeout','testimonial'),
                'details'	=> __('Set auto play timeout, ex: 2000, 1000 = 1 second','testimonial'),
                'type'		=> 'text',
                'value'		=> $slider_auto_play_timeout,
                'default'		=> 2000,
                'placeholder'   => '2000',
                'is_error'   => ($slider_auto_play_speed > $slider_auto_play_timeout)? true : false,
                'error_details'   => __('Value should larger than <b>Auto play speed</b>'),
            );

            $pickp_settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'slider_slide_speed',
                'parent' => 'testimonial_options',
                'title'		=> __('Slide speed','testimonial'),
                'details'	=> __('Custom value for slide speed, 1000 = 1 second','testimonial'),
                'type'		=> 'text',
                'value'		=> $slider_slide_speed,
                'default'		=> '600',
                'placeholder'		=> '600',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_pagination_slide_speed',
                'parent' => 'testimonial_options',
                'title'		=> __('Pagination Slide Speed','testimonial'),
                'details'	=> __('Custom value for pagination slide speed, 1000 = 1 second','testimonial'),
                'type'		=> 'text',
                'value'		=> $slider_pagination_slide_speed,
                'default'		=> '600',
                'placeholder'		=> '600',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'slider_slideBy',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider slideby count','testimonial'),
                'details'	=> __('Custom value for slideby','testimonial'),
                'type'		=> 'text',
                'value'		=> $slider_slideBy,
                'default'		=> '1',
                'placeholder'		=> '1',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_rewind',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider rewind','testimonial'),
                'details'	=> __('Enable or disable slider rewind.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_rewind,
                'default'		=> 'true',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'slider_loop',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider loop','testimonial'),
                'details'	=> __('Enable or disable slider loop.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_loop,
                'default'		=> 'true',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_center',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider center','testimonial'),
                'details'	=> __('Enable or disable slider center. please set odd number of slider column to work slider center.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_center,
                'default'		=> 'false',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_stop_on_hover',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider stop on hover','testimonial'),
                'details'	=> __('Enable or disable slider stop on hover.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_stop_on_hover,
                'default'		=> 'true',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'slider_navigation',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider navigation at top','testimonial'),
                'details'	=> __('Enable or disable slider navigation at Top.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_navigation,
                'default'		=> 'true',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_navigation_position',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider navigation position','testimonial'),
                'details'	=> __('Choose slider navigation position.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_navigation_position,
                'default'		=> 'true',
                'args'		=> array(
                    'top-right'=>__('Top Right','testimonial'),
                    'top-left'=>__('Top Left','testimonial'),
                    'middle'=>__('Middle','testimonial'),
                    'bottom-right'=>__('Bottom Right','testimonial'),
                    'bottom-left'=>__('Bottom Left','testimonial'),


                ),
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_nav_theme',
                'parent' => 'testimonial_options',
                'title'		=> __('Dots style','testimonial'),
                'details'	=> __('Choose dots template.','testimonial'),
                'type'		=> 'radio_image',
                'value'		=> $slider_nav_theme,
                'default'		=> 'navThemes1',
                'width'		=> '50px',
                'args'		=> array(
                    'navThemes1'=>array('name'=>'navThemes1','thumb'=>testimonial_plugin_url.'assets/admin/images/navThemes1.png'),
                    'navThemes2'=>array('name'=>'navThemes2','thumb'=>testimonial_plugin_url.'assets/admin/images/navThemes2.png'),
                    'navThemes3'=>array('name'=>'navThemes3','thumb'=>testimonial_plugin_url.'assets/admin/images/navThemes3.png'),
                    'navThemes4'=>array('name'=>'navThemes4','thumb'=>testimonial_plugin_url.'assets/admin/images/navThemes4.png'),
                    'navThemes5'=>array('name'=>'navThemes5','thumb'=>testimonial_plugin_url.'assets/admin/images/navThemes5.png'),
                    'navThemes6'=>array('name'=>'navThemes6','thumb'=>testimonial_plugin_url.'assets/admin/images/navThemes6.png'),
                    'navThemes7'=>array('name'=>'navThemes7','thumb'=>testimonial_plugin_url.'assets/admin/images/navThemes7.png'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_pagination',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider Pagination at bottom','testimonial'),
                'details'	=> __('Enable or disable slider Pagination at bottom.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_pagination,
                'default'		=> 'true',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);





            $args = array(
                'id'		=> 'slider_pagination_bg',
                'parent' => 'testimonial_options',
                'title'		=> __('Pagination background color','testimonial'),
                'details'	=> __('Choose custom pagination background color','testimonial'),
                'type'		=> 'colorpicker',
                'value'		=> $slider_pagination_bg,
                'default'		=> '#ddd',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_pagination_bg_active',
                'parent' => 'testimonial_options',
                'title'		=> __('Pagination active background color','testimonial'),
                'details'	=> __('Choose custom pagination background color','testimonial'),
                'type'		=> 'colorpicker',
                'value'		=> $slider_pagination_bg_active,
                'default'		=> '#ddd',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_pagination_text_color',
                'parent' => 'testimonial_options',
                'title'		=> __('Pagination text color','testimonial'),
                'details'	=> __('Choose custom pagination text color','testimonial'),
                'type'		=> 'colorpicker',
                'value'		=> $slider_pagination_text_color,
                'default'		=> '#999',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_pagination_theme',
                'parent' => 'testimonial_options',
                'title'		=> __('Dots style','testimonial'),
                'details'	=> __('Choose dots template.','testimonial'),
                'type'		=> 'radio_image',
                'value'		=> $slider_pagination_theme,
                'default'		=> 'dotsThemes1',
                'width'		=> '100px',
                'args'		=> array(

                    'dotsThemes1'=>array('name'=>'dotsThemes1','thumb'=>testimonial_plugin_url.'assets/admin/images/dotsThemes1.png'),
                    'dotsThemes2'=>array('name'=>'dotsThemes2','thumb'=>testimonial_plugin_url.'assets/admin/images/dotsThemes2.png'),

                    'dotsThemes3'=>array('name'=>'dotsThemes3','thumb'=>testimonial_plugin_url.'assets/admin/images/dotsThemes3.png'),
                    'dotsThemes4'=>array('name'=>'dotsThemes4','thumb'=>testimonial_plugin_url.'assets/admin/images/dotsThemes4.png'),

                    'dotsThemes5'=>array('name'=>'dotsThemes5','thumb'=>testimonial_plugin_url.'assets/admin/images/dotsThemes5.png'),
                    'dotsThemes6'=>array('name'=>'dotsThemes6','thumb'=>testimonial_plugin_url.'assets/admin/images/dotsThemes6.png'),

                    'dotsThemes7'=>array('name'=>'dotsThemes7','thumb'=>testimonial_plugin_url.'assets/admin/images/dotsThemes7.png'),
                    'dotsThemes8'=>array('name'=>'dotsThemes8','thumb'=>testimonial_plugin_url.'assets/admin/images/dotsThemes8.png'),

//                    'dotsThemes9'=>array('name'=>'dotsThemes9','thumb'=>testimonial_plugin_url.'assets/admin/images/dotsThemes9.png'),
//                    'dotsThemes10'=>array('name'=>'dotsThemes10','thumb'=>testimonial_plugin_url.'assets/admin/images/dotsThemes10.png'),



                ),
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_pagination_count',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider pagination number counting','testimonial'),
                'details'	=> __('Enable or disable slider pagination number counting.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_pagination_count,
                'default'		=> 'true',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'slider_touch_drag',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider touch drag enable','testimonial'),
                'details'	=> __('Enable or disable slider touch drag.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_touch_drag,
                'default'		=> 'true',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'slider_mouse_drag',
                'parent' => 'testimonial_options',
                'title'		=> __('Slider mouse drag enable','testimonial'),
                'details'	=> __('Enable or disable slider mouse drag.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_mouse_drag,
                'default'		=> 'true',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_rtl',
                'parent' => 'testimonial_options',
                'title'		=> __('RTL enable','testimonial'),
                'details'	=> __('Enable or disable slider RTL.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_rtl,
                'default'		=> 'false',
                'args'		=> array(
                    'true'=>__('True','testimonial'),
                    'false'=>__('False','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'slider_animateout',
                'parent' => 'testimonial_options',
                'title'		=> __('Animate Out','testimonial'),
                'details'	=> __('Choose animation on out.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_animateout,
                'default'		=> 'false',
                'args'		=> array(
                    'fadeOut'=>__('fadeOut','testimonial'),
                    'bounce'=>__('bounce','testimonial'),
                    'flash'=>__('flash','testimonial'),
                    'pulse'=>__('pulse','testimonial'),
                    'shake'=>__('shake','testimonial'),
                    'swing'=>__('swing','testimonial'),
                    'tada'=>__('tada','testimonial'),
                    'wobble'=>__('wobble','testimonial'),
                    'flip'=>__('flip','testimonial'),
                    'flipInX'=>__('flipInX','testimonial'),
                    'flipInY'=>__('flipInY','testimonial'),
                    'fadeIn'=>__('fadeIn','testimonial'),
                    'fadeInDown'=>__('fadeInDown','testimonial'),
                    'fadeInUp'=>__('fadeInUp','testimonial'),
                    'bounceIn'=>__('bounceIn','testimonial'),
                    'bounceInDown'=>__('bounceInDown','testimonial'),
                    'bounceInUp'=>__('bounceInUp','testimonial'),


                ),
            );

            //$pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'slider_animateIn',
                'parent' => 'testimonial_options',
                'title'		=> __('Animate In','testimonial'),
                'details'	=> __('Choose animation on in.','testimonial'),
                'type'		=> 'select',
                'value'		=> $slider_animateIn,
                'default'		=> 'false',
                'args'		=> array(
                    'fadeOut'=>__('fadeOut','testimonial'),
                    'bounce'=>__('bounce','testimonial'),
                    'flash'=>__('flash','testimonial'),
                    'pulse'=>__('pulse','testimonial'),
                    'shake'=>__('shake','testimonial'),
                    'swing'=>__('swing','testimonial'),
                    'tada'=>__('tada','testimonial'),
                    'wobble'=>__('wobble','testimonial'),
                    'flip'=>__('flip','testimonial'),
                    'flipInX'=>__('flipInX','testimonial'),
                    'flipInY'=>__('flipInY','testimonial'),
                    'fadeIn'=>__('fadeIn','testimonial'),
                    'fadeInDown'=>__('fadeInDown','testimonial'),
                    'fadeInUp'=>__('fadeInUp','testimonial'),
                    'bounceIn'=>__('bounceIn','testimonial'),
                    'bounceInDown'=>__('bounceInDown','testimonial'),
                    'bounceInUp'=>__('bounceInUp','testimonial'),


                ),
            );

            //$pickp_settings_tabs_field->generate_field($args);











            ?>
        </div>
        <?php
    }
}


add_action('testimonial_meta_tabs_content_shortcode', 'testimonial_meta_tabs_content_shortcode',10, 2);

if(!function_exists('testimonial_meta_tabs_content_shortcode')) {
    function testimonial_meta_tabs_content_shortcode($tab, $post_id){

        $pickp_settings_tabs_field = new pickp_settings_tabs_field();


        ?>
        <div class="section">
            <div class="section-title">Shortcodes</div>
            <p class="description section-description">Simply copy these shortcode and user under post or page content</p>


            <?php
            ob_start();
            ?>

            <div class="copy-to-clipboard">
                <input type="text" value="[testimonial id='<?php echo esc_attr($post_id); ?>']"> <span class="copied">Copied</span>
                <p class="description">You can use this shortcode under post content</p>
            </div>

            <div class="copy-to-clipboard">
                To avoid conflict:<br>
                <input type="text" value="[testimonial_pickplugins id='<?php echo esc_attr($post_id); ?>']"> <span
                    class="copied">Copied</span>
                <p class="description">To avoid conflict with 3rd party shortcode also used same <code>[testimonial]</code>You can use this shortcode under post content</p>
            </div>

            <div class="copy-to-clipboard">
                <textarea cols="50" rows="2" style="background:#bfefff" onClick="this.select();"><?php echo '<?php echo do_shortcode("[testimonial id='; echo "'" . esc_attr($post_id) . "']"; echo '"); ?>'; ?></textarea> <span class="copied">Copied</span>
                <p class="description">PHP Code, you can use under theme .php files.</p>
            </div>

            <div class="copy-to-clipboard">
                <textarea cols="50" rows="2" style="background:#bfefff"
                          onClick="this.select();"><?php echo '<?php echo do_shortcode("[testimonial_pickplugins id=';
                    echo "'" . esc_attr($post_id) . "']";
                    echo '"); ?>'; ?></textarea> <span class="copied">Copied</span>
                <p class="description">To avoid conflict, PHP code you can use under theme .php files.</p>
            </div>

            <style type="text/css">
                .testimonial-meta-box .copy-to-clipboard {
                }

                .testimonial-meta-box .copy-to-clipboard .copied {
                    display: none;
                    background: #e5e5e5;
                    padding: 4px 10px;
                    line-height: normal;
                }
            </style>

            <script>
                jQuery(document).ready(function ($) {
                    $(document).on('click', '.testimonial-meta-box .copy-to-clipboard input, .testimonial-meta-box .copy-to-clipboard textarea', function () {
                        $(this).focus();
                        $(this).select();
                        document.execCommand('copy');
                        $(this).parent().children('.copied').fadeIn().fadeOut(2000);
                    })
                })
            </script>
            <?php
            $html = ob_get_clean();
            $args = array(
                'id' => 'testimonial_shortcodes',
                'title' => __('Get shortcode', 'testimonial'),
                'details' => '',
                'type' => 'custom_html',
                'html' => $html,
            );
            $pickp_settings_tabs_field->generate_field($args);



            ob_start();
            ?>

            <div class="copy-to-clipboard">
                <input type="text" value="[testimonial_form id='<?php echo esc_attr($post_id); ?>']"> <span class="copied">Copied</span>
                <p class="description">You can use this shortcode under post content</p>
            </div>



            <div class="copy-to-clipboard">
                <textarea cols="50" rows="2" style="background:#bfefff" onClick="this.select();"><?php echo '<?php echo do_shortcode("[testimonial_form id='; echo "'" . esc_attr($post_id) . "']"; echo '"); ?>'; ?></textarea> <span class="copied">Copied</span>
                <p class="description">PHP Code, you can use under theme .php files.</p>
            </div>

            <?php
            $html = ob_get_clean();
            $args = array(
                'id' => 'testimonial_form',
                'title' => __('Submit form', 'testimonial'),
                'details' => '',
                'type' => 'custom_html',
                'html' => $html,
            );
            $pickp_settings_tabs_field->generate_field($args);














            ?>
        </div>
        <?php
    }
}