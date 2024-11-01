<?php
if ( ! defined('ABSPATH')) exit;  // if direct access


add_action('testimonial_main', 'testimonial_main_items');

function testimonial_main_items($args){

    $testimonial_id = isset($args['id']) ?  $args['id'] : 0;

    $testimonial_options = get_post_meta( $testimonial_id, 'testimonial_options', true );
    $testimonials = isset($testimonial_options['testimonials']) ? $testimonial_options['testimonials'] : array();
    $template_id = isset($testimonial_options['template_id']) ? $testimonial_options['template_id'] : testimonial_1st_template_id();

   //$args['options'] = $testimonial_options;

    ?>
    <div class="item-list owl-carousel owl-theme">
        <?php
        if(!empty($testimonials))
        foreach ($testimonials as $testimonial):

            $args['testimonial'] = $testimonial;
            $args['template_id'] = $template_id;

            do_action('testimonial_loop_item', $args);
        endforeach;


        ?>

    </div>
    <?php

}


add_action('testimonial_loop_item', 'testimonial_loop_item');

function testimonial_loop_item($args){

    $testimonial = isset($args['testimonial']) ?  $args['testimonial'] : array();
    $template_id = isset($args['template_id']) ? $args['template_id'] : testimonial_1st_template_id();
    $layout_elements_data = get_post_meta( $template_id, 'layout_elements_data', true );

    if(empty($layout_elements_data)) return;

    $testimonial_item_class = apply_filters('testimonial_slider_item_class', 'item ', $args);


    //echo '<pre>'.var_export($testimonial, true).'</pre>';


    ?>
    <div class="<?php echo esc_attr($testimonial_item_class); ?>">
        <div class="elements-wrapper layout-<?php echo esc_attr($template_id); ?>">
            <?php
            if(!empty($layout_elements_data))
                foreach ($layout_elements_data as $elementGroupIndex => $elementGroupData){

                    if(!empty($elementGroupData))
                        foreach ($elementGroupData as $elementIndex => $elementData){

                            $args['elementData'] = $elementData;
                            $args['element_index'] = $elementGroupIndex;

                            //echo '<pre>'.var_export($args, true).'</pre>';

                            //echo 'Hello';

                            do_action('testimonial_layout_element_'.$elementIndex, $args);
                        }
                }
            ?>
        </div>
    </div>
    <?php

}

add_action('testimonial_main', 'testimonial_main_schema');

function testimonial_main_schema($args){

    $testimonial_id = isset($args['id']) ?  $args['id'] : 0;

    $testimonial_options = get_post_meta( $testimonial_id, 'testimonial_options', true );
    $enable_schema = isset($testimonial_options['enable_schema']) ? $testimonial_options['enable_schema'] : '';

    if($enable_schema != 'true') return;

    $testimonials = isset($testimonial_options['testimonials']) ? $testimonial_options['testimonials'] : array();

    if(!empty($testimonials))
        foreach ($testimonials as $testimonial):
            ?>
            <script type="application/ld+json">
        {
            "@context": "http://schema.org/",
            "@type": "Review",
            "itemReviewed": {
                "name": "<?php echo $testimonial['name']; ?>"
            },
            "reviewRating": {
                "@type": "Rating",
                "bestRating": "5",
                "ratingValue": "<?php echo $testimonial['rating']; ?>",
                "worstRating": "1"
            },
            "name": "<?php echo !empty($testimonial['title']) ? $testimonial['title'] : 'Reviews'; ?>",
            "author": {
                "@type": "Person",
                "name": "<?php echo $testimonial['name']; ?>"
            },
            "reviewBody": "<?php echo $testimonial['content']; ?>"
        } </script>
        <?php

        endforeach;


}



















add_action('testimonial_loop_item', 'testimonial_loop_item_old');

function testimonial_loop_item_old($args){

    $template_id = isset($args['template_id']) ? $args['template_id'] : testimonial_1st_template_id();
    $layout_elements_data = get_post_meta( $template_id, 'layout_elements_data', true );

    $testimonial = isset($args['testimonial']) ? $args['testimonial'] : array();
    $testimonial_id = isset($args['id']) ?  $args['id'] : 0;


    if(!empty($layout_elements_data)) return;


    $template_id = isset($args['template_id']) ? $args['template_id'] : testimonial_1st_template_id();

    $vars = array();
    $template_data = get_post_meta($template_id, 'testimonial_options', true);

    $template_html = isset($template_data['template_html']) ? ($template_data['template_html']) : '';
    $template_css = isset($template_data['template_css']) ? ($template_data['template_css']) : '';


    //echo '<pre>'.var_export($testimonial, true).'</pre>';

    $vars = apply_filters('testimonial_custom_parameter', $vars);
    ?>

    <div class="item">

        <?php

        if(!empty($testimonial))
            foreach ($testimonial as $element_key => $elementValue):

                if($element_key == 'thumbnail'){
                    $media_url	= wp_get_attachment_url( $elementValue );
                    $elementHTML = '<img alt="'.esc_attr($element_key).'" src="'.esc_url_raw($media_url).'">';

                }
                elseif($element_key == 'rating'){
                    $ratingHTML = '';
                    $ratingCount = intval($elementValue);

                    for($i=1; $i<= $ratingCount; $i++){
                        $ratingHTML .= '<i class="fas fa-star"></i>';
                    }

                    $elementHTML = $ratingHTML;

                }

                else{
                    $elementHTML = $elementValue;
                }

                $filterArgs= array('elementValue'=>$elementValue,'elementKey'=>$element_key, 'testimonialId'=>$testimonial_id, 'templateId'=>$template_id);

                if(empty($elementHTML)) $elementHTML = '';


                $vars['{{'.$element_key.'}}'] = apply_filters('testimonial_parameter_html', $elementHTML, $filterArgs);

            endforeach;

        echo strtr($template_html,$vars);



        ?>

    </div>
    <?php



}

add_action('testimonial_main', 'testimonial_loop_item_old_scripts');

function testimonial_loop_item_old_scripts($args){

    $testimonial_id = isset($args['id']) ?  $args['id'] : 0;

    $testimonial_options = get_post_meta( $testimonial_id, 'testimonial_options', true );
    $testimonials = isset($testimonial_options['testimonials']) ? $testimonial_options['testimonials'] : array();
    $template_id = isset($testimonial_options['template_id']) ? $testimonial_options['template_id'] : testimonial_1st_template_id();
    $layout_elements_data = get_post_meta( $template_id, 'layout_elements_data', true );

    if(!empty($layout_elements_data)) return;

    ?>

    <style type="text/css">
        <?php
        $testimonial_options = get_post_meta( $template_id, 'testimonial_options', true );

        $template_layout_items = isset($testimonial_options['layout_items']) ? $testimonial_options['layout_items'] : array();


        foreach ($template_layout_items as $layout_item_key=>$layoutData):

            $layoutStyle = $layoutData['style'];

            if($layout_item_key == 'thumbnail'){
                echo '#testimonial-container-'.esc_attr($testimonial_id).' .'.esc_attr($layout_item_key).' img, #testimonial-container-'.esc_attr($testimonial_id).' .'.esc_attr($layout_item_key).'{';
            }else{
                echo '#testimonial-container-'.esc_attr($testimonial_id).' .'.esc_attr($layout_item_key).'{';
            }



            foreach ($layoutStyle as $styleId=>$styleVal){

                if(!empty($styleVal))
                echo $styleId.':'.$styleVal.';';



            }

            echo '}';
            echo "\r\n";
        endforeach;


        ?>
    </style>
    <?php

}


add_action('testimonial_main', 'testimonial_main_scripts');

function testimonial_main_scripts($args){

    $testimonial_id = isset($args['id']) ?  $args['id'] : 0;
    $testimonial_options = get_post_meta( $testimonial_id, 'testimonial_options', true );


    $template_id = isset($testimonial_options['template_id']) ? $testimonial_options['template_id'] : testimonial_1st_template_id();
    $layout_elements_data = get_post_meta( $template_id, 'layout_elements_data', true );

    $args['template_id'] = $template_id;
    $template_data = get_post_meta($template_id, 'testimonial_options', true);

    $template_html = isset($template_data['template_html']) ? ($template_data['template_html']) : '';
    $template_css = isset($template_data['template_css']) ? ($template_data['template_css']) : '';



    $slider_column_desktop = isset($testimonial_options['slider_column_desktop']) ? $testimonial_options['slider_column_desktop'] : '2';
    $slider_column_tablet = isset($testimonial_options['slider_column_tablet']) ? $testimonial_options['slider_column_tablet'] : '1';
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


    $slider_rewind = isset($testimonial_options['slider_rewind']) ? $testimonial_options['slider_rewind'] : 'true';
    $slider_loop = isset($testimonial_options['slider_loop']) ? $testimonial_options['slider_loop'] : 'true';
    $slider_center = isset($testimonial_options['slider_center']) ? $testimonial_options['slider_center'] : 'false';
    $slider_stop_on_hover = isset($testimonial_options['slider_stop_on_hover']) ? $testimonial_options['slider_stop_on_hover'] : 'true';
    $slider_navigation = isset($testimonial_options['slider_navigation']) ? $testimonial_options['slider_navigation'] : 'false';
    $slider_navigation_position = isset($testimonial_options['slider_navigation_position']) ? $testimonial_options['slider_navigation_position'] : 'top-right';
    $slider_nav_theme = isset($testimonial_options['slider_nav_theme']) ? $testimonial_options['slider_nav_theme'] : 'navThemes1';



    $slider_pagination = isset($testimonial_options['slider_pagination']) ? $testimonial_options['slider_pagination'] : 'false';
    $slider_pagination_bg = isset($testimonial_options['slider_pagination_bg']) ? $testimonial_options['slider_pagination_bg'] : '';
    $slider_pagination_bg_active = isset($testimonial_options['slider_pagination_bg_active']) ? $testimonial_options['slider_pagination_bg_active'] : '';
    $slider_pagination_theme = isset($testimonial_options['slider_pagination_theme']) ? $testimonial_options['slider_pagination_theme'] : 'dotsThemes7';


    $slider_pagination_text_color = isset($testimonial_options['slider_pagination_text_color']) ? $testimonial_options['slider_pagination_text_color'] : '';
    $slider_pagination_count = isset($testimonial_options['slider_pagination_count']) ? $testimonial_options['slider_pagination_count'] : 'false';

    $slider_touch_drag = isset($testimonial_options['slider_touch_drag']) ? $testimonial_options['slider_touch_drag'] : 'true';
    $slider_mouse_drag = isset($testimonial_options['slider_mouse_drag']) ? $testimonial_options['slider_mouse_drag'] : 'true';
    $slider_rtl = isset($testimonial_options['slider_rtl']) ? $testimonial_options['slider_rtl'] : 'false';

    $slider_animateout = isset($testimonial_options['slider_animateout']) ? $testimonial_options['slider_animateout'] : '';
    $slider_animateIn = isset($testimonial_options['slider_animateIn']) ? $testimonial_options['slider_animateIn'] : '';


    $wcps_settings = get_option( 'wcps_settings' );
    $font_aw_version = isset($wcps_settings['font_aw_version']) ? $wcps_settings['font_aw_version'] : 'none';

    if($font_aw_version == 'v_5'){
        $navigation_text_prev = '<i class="fas fa-chevron-left"></i>';
        $navigation_text_next = '<i class="fas fa-chevron-right"></i>';
    }elseif ($font_aw_version == 'v_4'){
        $navigation_text_prev = '<i class="fa fa-chevron-left"></i>';
        $navigation_text_next = '<i class="fa fa-chevron-right"></i>';
    }else{
        $navigation_text_prev = '<i class="fas fa-chevron-left"></i>';
        $navigation_text_next = '<i class="fas fa-chevron-right"></i>';
    }


    $navigation_text_prev = !empty($slider_option['navigation_text']['prev']) ? $slider_option['navigation_text']['prev'] : $navigation_text_prev;
    $navigation_text_next = !empty($slider_option['navigation_text']['next']) ? $slider_option['navigation_text']['next'] : $navigation_text_next;


    ?>


    <script>
        jQuery(document).ready(function($){
            $("#testimonial-container-<?php echo esc_attr($testimonial_id); ?> .item-list").owlCarousel({
                items : 3,
                responsiveClass:true,
                responsive:{
                    320:{
                        items:<?php echo esc_attr($slider_column_mobile); ?>,
                    },
                    768:{
                        items:<?php echo esc_attr($slider_column_tablet); ?>,
                    },
                    1024:{
                        items:<?php echo esc_attr($slider_column_desktop); ?>,
                    }
                },
                loop: <?php echo esc_attr($slider_loop); ?>,
                rewind: <?php echo esc_attr($slider_rewind); ?>,
                center: <?php echo esc_attr($slider_center); ?>,
                autoplay: <?php echo esc_attr($slider_auto_play); ?>,
                autoplaySpeed: <?php echo esc_attr($slider_auto_play_speed); ?>,
                autoplayTimeout: <?php echo esc_attr($slider_auto_play_timeout); ?>,
                autoplayHoverPause: <?php echo esc_attr($slider_stop_on_hover); ?>,
                nav: <?php echo esc_attr($slider_navigation); ?>,
                navText : ['<?php echo esc_attr($navigation_text_prev); ?>','<?php echo esc_attr($navigation_text_next); ?>'],
                dots: <?php echo esc_attr($slider_pagination); ?>,
                navSpeed: <?php echo esc_attr($slider_slide_speed); ?>,
                dotsSpeed: <?php echo esc_attr($slider_pagination_slide_speed); ?>,
                touchDrag : <?php echo esc_attr($slider_touch_drag); ?>,
                mouseDrag  : <?php echo esc_attr($slider_mouse_drag); ?>,
                autoHeight: true,
            });
            $("#testimonial-container-<?php echo esc_attr($testimonial_id); ?> .owl-dots").addClass('<?php echo esc_attr($slider_pagination_theme); ?>');
            $("#testimonial-container-<?php echo esc_attr($testimonial_id); ?> .owl-nav").addClass('<?php echo esc_attr($slider_navigation_position); ?>');
            $("#testimonial-container-<?php echo esc_attr($testimonial_id); ?> .owl-nav").addClass('<?php echo esc_attr($slider_nav_theme); ?>');
        });
    </script>


    <?php
    wp_enqueue_style('testimonial-style');
    wp_enqueue_style('owl-carousel');
    wp_enqueue_style('owl-theme');

    wp_enqueue_script('owl-carousel');

    if($font_aw_version == 'v_5'){
        wp_enqueue_style('font-awesome-5');
    }elseif ($font_aw_version == 'v_4'){
        wp_enqueue_style('font-awesome-4');
    }

    ?>



    <style type="text/css">
        <?php


        ?>

        .owl-nav .owl-prev,.owl-nav .owl-next{
            background: <?php echo esc_attr($slider_pagination_bg); ?> !important;
            color: <?php echo esc_attr($slider_pagination_text_color); ?> !important;
        }

        .owl-theme .owl-dots .owl-dot{
            outline: none;
        }

        .owl-theme .owl-dots .owl-dot span{
            background: <?php echo esc_attr($slider_pagination_bg); ?> !important;
            color: <?php echo esc_attr($slider_pagination_text_color); ?> !important;
        }




        .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span{
            background: <?php echo esc_attr($slider_pagination_bg_active); ?> !important;


        }

    </style>


    <style type="text/css"><?php echo esc_attr($template_css); ?></style>




    <?php




    if(!empty($layout_elements_data))
        foreach ($layout_elements_data as $elementGroupIndex => $elementGroupData){

            if(!empty($elementGroupData))
                foreach ($elementGroupData as $elementIndex => $elementData){
                    $args['elementData'] = $elementData;
                    $args['element_index'] = $elementGroupIndex;
                    do_action('testimonial_layout_element_css_'.$elementIndex, $args);
                }
        }





}





