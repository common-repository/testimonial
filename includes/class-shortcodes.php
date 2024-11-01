<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

class class_testimonial_shortcodes{
	
	
    public function __construct(){
		
		add_shortcode( 'testimonial', array( $this, 'testimonial_display' ) );
        add_shortcode( 'testimonial_form', array( $this, 'testimonial_form_display' ) );


    }
	
	
	
	
	public function testimonial_display($atts, $content = null ) {

        $atts = shortcode_atts(
            array(
                'id' => "",
            ),
            $atts
        );

        $testimonial_id = $atts['id'];

        $testimonial_options = get_post_meta( $testimonial_id, 'testimonial_options', true );
        $slider_navigation_position = isset($template_data['slider_navigation_position']) ? ($testimonial_options['slider_navigation_position']) : '';

        ob_start();
        ?>
        <div class="testimonial-container nav-<?php echo esc_attr($slider_navigation_position); ?>" id="testimonial-container-<?php echo esc_attr($testimonial_id); ?>">
            <?php
            do_action('testimonial_main', $atts);
            ?>
        </div>
        <?php
        return ob_get_clean();



	
	}

    public function testimonial_form_display($atts, $content = null ) {

        $atts = shortcode_atts(

            array(
                'id' => "",

            ),
            $atts);

        $html  = '';
        $post_id = $atts['id'];

        ob_start();



        //do_action('testimonial_body', $post_id);
        include testimonial_plugin_dir.'/templates/testimonial-form/testimonial-form.php';

        $html = ob_get_clean();


        return $html;


    }
	
	
	
	}

new class_testimonial_shortcodes();