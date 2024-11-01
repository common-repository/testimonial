<?php
if ( ! defined('ABSPATH')) exit;  // if direct access






add_filter('the_content','pickplugins_testimonial_preview_content');

function pickplugins_testimonial_preview_content($content){

    if(is_singular('testimonial')){

        $post_id = get_the_id();

        $content .= do_shortcode('[testimonial id="'.$post_id.'"]');

    }

    return $content;

}



function pickplugins_testimonial_sanitize_arr($array) {

    foreach ( $array as $key => &$value ) {
        if ( is_array( $value ) ) {
            $value = pickplugins_testimonial_sanitize_arr($value);
        }
        else {
            $value = sanitize_text_field( $value );
        }
    }

    return $array;
}










function testimonial_parameter_html($elementHTML, $filterArgs){

    $elementKey = $filterArgs['elementKey'];
    $elementValue = $filterArgs['elementValue'];
    $testimonialId = $filterArgs['testimonialId'];
    $templateId = $filterArgs['templateId'];


    if($elementKey == 'rating'){
        $elementHTML = '';
    }


    return $elementHTML;

}

//add_filter('testimonial_parameter_html', 'testimonial_parameter_html', 90, 2);



function testimonial_custom_parameter($vars){

    $vars['{{hello}}'] = 'Hello Custom ###';

    return $vars;

}

//add_filter('testimonial_custom_parameter', 'testimonial_custom_parameter', 90, 2);



function testimonial_1st_template_id(){

    $args = array(
        'post_type'=>'testimonial_template',
        'post_status'=>'publish',
        'posts_per_page'=> 1,

    );



    $wp_query = new WP_Query($args);



    if ( $wp_query->have_posts() ) :
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $post_id = get_the_id();


        endwhile;
    endif;

    return $post_id;

}





function testimonial_1st_testimonial(){

    $args = array(
        'post_type'=>'testimonial',
        'post_status'=>'publish',
        'posts_per_page'=> 1,

    );



    $wp_query = new WP_Query($args);



    if ( $wp_query->have_posts() ) :
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $post_id = get_the_id();

            $testimonial_options = get_post_meta($post_id,'testimonial_options', true);

            $testimonials = isset($testimonial_options['testimonials']) ? $testimonial_options['testimonials'] : array();

            return reset($testimonials);


        endwhile;
    endif;


}






		
		
		
		

		
		