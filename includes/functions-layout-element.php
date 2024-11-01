<?php
if ( ! defined('ABSPATH')) exit;  // if direct access



add_action('testimonial_layout_element_custom_text', 'testimonial_layout_element_custom_text', 10);
function testimonial_layout_element_custom_text($args){

    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $testimonial = isset($args['testimonial']) ? $args['testimonial'] : array();

    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $content = isset($elementData['content']) ? $elementData['content'] : '';


    $element_class = !empty($element_index) ? 'element-custom_text element-'.$element_index : 'element-custom_text';


    //echo '<pre>'.var_export($args, true).'</pre>';

    $content = 'Hello text';

    ?>
    <div class="<?php echo esc_attr($element_class); ?>"><?php echo $content; ?></div>
    <?php

}


add_action('testimonial_layout_element_name', 'testimonial_layout_element_name', 10);
function testimonial_layout_element_name($args){

    //echo '<pre>'.var_export($args, true).'</pre>';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $element_index = isset($args['element_index']) ? $args['element_index'] : '';

    $testimonial = isset($args['testimonial']) ? $args['testimonial'] : array();



    $element_class = !empty($element_index) ? 'element name element-'.$element_index : 'element name';
    $name = isset($testimonial['name']) ? $testimonial['name'] : '';

    ?>
    <div class="<?php echo esc_attr($element_class); ?>"><?php echo esc_html($name); ?></div>
    <?php

}





add_action('testimonial_layout_element_thumbnail', 'testimonial_layout_element_thumbnail', 10);
function testimonial_layout_element_thumbnail($args){

    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $element_class = !empty($element_index) ? 'element thumbnail element-'.$element_index : 'element thumbnail';

    //echo '<pre>'.var_export($args, true).'</pre>';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $testimonial = isset($args['testimonial']) ? $args['testimonial'] : array();

    $thumb_size = isset($elementData['thumb_size']) ? $elementData['thumb_size'] : 'full';
    $default_thumb_src = isset($elementData['default_thumb_src']) ? $elementData['default_thumb_src'] : '';


    $thumbnail_id = isset($testimonial['thumbnail']) ? $testimonial['thumbnail'] : '';



    $testimonial_thumb = wp_get_attachment_image_src($thumbnail_id, $thumb_size);
    $member_image_url = isset($testimonial_thumb[0]) ? $testimonial_thumb[0] : '';
    $member_image_url = !empty($member_image_url) ? $member_image_url : $default_thumb_src;
    $member_image_url = apply_filters('testimonial_layout_element_thumbnail_src', $member_image_url, $args);

    ?>
    <div class=" <?php echo esc_attr($element_class); ?>"><img src="<?php echo $member_image_url; ?>" /></div>

    <?php

}



add_action('testimonial_layout_element_content', 'testimonial_layout_element_content', 10);
function testimonial_layout_element_content($args){

    $element_index = isset($args['element_index']) ? $args['element_index'] : '';

    //echo '<pre>'.var_export($args, true).'</pre>';

    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $testimonial = isset($args['testimonial']) ? $args['testimonial'] : array();
    $word_count = isset($elementData['word_count']) ? $elementData['word_count'] : 15;
    $arrow_position = isset($elementData['arrow_position']) ? $elementData['arrow_position'] : 15;

    $content = isset($testimonial['content']) ? $testimonial['content'] : '';


    $element_class = !empty($element_index) ? 'element arrow-'.$arrow_position.' content element-'.$element_index : 'element arrow-'.$arrow_position.' content';




    ?>
    <div class="<?php echo esc_attr($element_class); ?>"><?php echo $content; ?></div>
    <?php

}





add_action('testimonial_layout_element_rating', 'testimonial_layout_element_rating', 10);
function testimonial_layout_element_rating($args){

    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $element_class = !empty($element_index) ? 'element rating element-'.$element_index : 'element rating';

    //echo '<pre>'.var_export($args, true).'</pre>';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $testimonial = isset($args['testimonial']) ? $args['testimonial'] : array();


    $rating_type = isset($elementData['rating_type']) ? $elementData['rating_type'] : '';
    $wrapper_html = isset($elementData['wrapper_html']) ? $elementData['wrapper_html'] : '';
    $wrapper_html = !empty($wrapper_html) ? $wrapper_html : '%s';

    $rating = isset($testimonial['rating']) ? $testimonial['rating'] : '';


    $ratingHTML = '';
    $ratingCount = intval($rating);

    for($i=1; $i<= $ratingCount; $i++){
        $ratingHTML .= '<i class="fas fa-star"></i>';
    }

    $elementHTML = $ratingHTML;



        ?>
        <div class="<?php echo esc_attr($element_class); ?>"><?php echo sprintf($wrapper_html, $ratingHTML); ?></div>
        <?php



}





add_action('testimonial_layout_element_wrapper_start', 'testimonial_layout_element_wrapper_start', 10);
function testimonial_layout_element_wrapper_start($args){

    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $element_class = !empty($element_index) ? 'element-'.$element_index : '';

    //echo '<pre>'.var_export($args, true).'</pre>';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $testimonial = isset($args['testimonial']) ? $args['testimonial'] : array();


    $wrapper_class = isset($elementData['wrapper_class']) ? $elementData['wrapper_class'] : '';
    $wrapper_id = isset($elementData['wrapper_id']) ? $elementData['wrapper_id'] : '';



    ?>
    <div class="<?php echo esc_attr($wrapper_class); ?> <?php echo $element_class; ?>" id="<?php echo esc_attr($wrapper_id); ?>">
    <?php

}


add_action('testimonial_layout_element_wrapper_end', 'testimonial_layout_element_wrapper_end', 10);
function testimonial_layout_element_wrapper_end($args){


    ?>
    </div>
    <?php

}

add_action('testimonial_layout_element_company_name', 'testimonial_layout_element_company_name', 10);
function testimonial_layout_element_company_name($args){

    $term_id = isset($args['term_id']) ? (int)$args['term_id'] : 0;

    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $testimonial = isset($args['testimonial']) ? $args['testimonial'] : array();


    $element_index = isset($args['element_index']) ? $args['element_index'] : '';

    $element_class = !empty($element_index) ? 'element company_name element-'.$element_index : 'element company_name';

    $company_name = isset($testimonial['company_name']) ? $testimonial['company_name'] : '';

    //var_dump($term_link);

    ?>
    <div class="<?php echo esc_attr($element_class); ?>"><?php echo $company_name; ?></div>
    <?php

}

add_action('testimonial_layout_element_position', 'testimonial_layout_element_position', 10);
function testimonial_layout_element_position($args){

    $term_id = isset($args['term_id']) ? (int)$args['term_id'] : 0;

    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $testimonial = isset($args['testimonial']) ? $args['testimonial'] : array();


    $element_index = isset($args['element_index']) ? $args['element_index'] : '';

    $element_class = !empty($element_index) ? 'element position element-'.$element_index : 'element position';


    $position = isset($testimonial['position']) ? $testimonial['position'] : '';

    //var_dump($term_link);

    ?>
    <div class="<?php echo esc_attr($element_class); ?>"><?php echo $position; ?></div>
    <?php

}


add_action('testimonial_layout_element_css_custom_text', 'testimonial_layout_element_css_custom_text', 10);
function testimonial_layout_element_css_custom_text($args){


    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();

    $template_id = isset($args['template_id']) ? $args['template_id'] : '';

    $color = isset($elementData['color']) ? $elementData['color'] : '';
    $font_size = isset($elementData['font_size']) ? $elementData['font_size'] : '';
    $font_family = isset($elementData['font_family']) ? $elementData['font_family'] : '';
    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';
    $text_align = isset($elementData['text_align']) ? $elementData['text_align'] : '';

    ?>
    <style type="text/css">
        .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?>{
        <?php if(!empty($color)): ?>
            color: <?php echo esc_attr($color); ?>;
        <?php endif; ?>
        <?php if(!empty($font_size)): ?>
            font-size: <?php echo esc_attr($font_size); ?>;
        <?php endif; ?>
        <?php if(!empty($font_family)): ?>
            font-family: <?php echo esc_attr($font_family); ?>;
        <?php endif; ?>
        <?php if(!empty($margin)): ?>
            margin: <?php echo esc_attr($margin); ?>;
        <?php endif; ?>
        <?php if(!empty($text_align)): ?>
            text-align: <?php echo esc_attr($text_align); ?>;
        <?php endif; ?>
        }
    </style>
    <?php
}








add_action('testimonial_layout_element_css_name', 'testimonial_layout_element_css_name', 10);
function testimonial_layout_element_css_name($args){


    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $template_id = isset($args['template_id']) ? $args['template_id'] : '';

    $background_color = isset($elementData['background_color']) ? $elementData['background_color'] : '';
    $padding = isset($elementData['padding']) ? $elementData['padding'] : '';
    $float = isset($elementData['float']) ? $elementData['float'] : '';

    $color = isset($elementData['color']) ? $elementData['color'] : '';
    $font_size = isset($elementData['font_size']) ? $elementData['font_size'] : '';
    $font_family = isset($elementData['font_family']) ? $elementData['font_family'] : '';
    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';
    $text_align = isset($elementData['text_align']) ? $elementData['text_align'] : '';
    $clear = isset($elementData['clear']) ? $elementData['clear'] : '';


    //echo '<pre>'.var_export($template_id, true).'</pre>';

    ?>
    <style type="text/css">
        .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?>{
        <?php if(!empty($color)): ?>
            color: <?php echo esc_attr($color); ?>;
        <?php endif; ?>
        <?php if(!empty($background_color)): ?>
            background-color: <?php echo esc_attr($background_color); ?>;
        <?php endif; ?>

        <?php if(!empty($font_size)): ?>
            font-size: <?php echo esc_attr($font_size); ?>;
        <?php endif; ?>
        <?php if(!empty($font_family)): ?>
            font-family: <?php echo esc_attr($font_family); ?>;
        <?php endif; ?>
        <?php if(!empty($margin)): ?>
            margin: <?php echo esc_attr($margin); ?>;
        <?php endif; ?>
        <?php if(!empty($padding)): ?>
            padding: <?php echo esc_attr($padding); ?>;
        <?php endif; ?>
        <?php if(!empty($text_align)): ?>
            text-align: <?php echo esc_attr($text_align); ?>;
        <?php endif; ?>
        <?php if(!empty($float)): ?>
            float: <?php echo esc_attr($float); ?>;
        <?php endif; ?>
        <?php if(!empty($clear)): ?>
            clear: <?php echo esc_attr($clear); ?>;
        <?php endif; ?>
        }



    </style>
    <?php
}



add_action('testimonial_layout_element_css_company_name', 'testimonial_layout_element_css_company_name', 10);
function testimonial_layout_element_css_company_name($args){


    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $template_id = isset($args['template_id']) ? $args['template_id'] : '';

    $background_color = isset($elementData['background_color']) ? $elementData['background_color'] : '';
    $padding = isset($elementData['padding']) ? $elementData['padding'] : '';
    $float = isset($elementData['float']) ? $elementData['float'] : '';

    $color = isset($elementData['color']) ? $elementData['color'] : '';
    $font_size = isset($elementData['font_size']) ? $elementData['font_size'] : '';
    $font_family = isset($elementData['font_family']) ? $elementData['font_family'] : '';
    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';
    $text_align = isset($elementData['text_align']) ? $elementData['text_align'] : '';
    $clear = isset($elementData['clear']) ? $elementData['clear'] : '';

    ?>
    <style type="text/css">
        .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?>{
        <?php if(!empty($color)): ?>
            color: <?php echo esc_attr($color); ?>;
        <?php endif; ?>
        <?php if(!empty($background_color)): ?>
            background-color: <?php echo esc_attr($background_color); ?>;
        <?php endif; ?>

        <?php if(!empty($font_size)): ?>
            font-size: <?php echo esc_attr($font_size); ?>;
        <?php endif; ?>
        <?php if(!empty($font_family)): ?>
            font-family: <?php echo esc_attr($font_family); ?>;
        <?php endif; ?>
        <?php if(!empty($margin)): ?>
            margin: <?php echo esc_attr($margin); ?>;
        <?php endif; ?>
        <?php if(!empty($padding)): ?>
            padding: <?php echo esc_attr($padding); ?>;
        <?php endif; ?>
        <?php if(!empty($text_align)): ?>
            text-align: <?php echo esc_attr($text_align); ?>;
        <?php endif; ?>
        <?php if(!empty($float)): ?>
            float: <?php echo esc_attr($float); ?>;
        <?php endif; ?>
        <?php if(!empty($clear)): ?>
            clear: <?php echo esc_attr($clear); ?>;
        <?php endif; ?>
        }


    </style>
    <?php
}


add_action('testimonial_layout_element_css_position', 'testimonial_layout_element_css_position', 10);
function testimonial_layout_element_css_position($args){


    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $template_id = isset($args['template_id']) ? $args['template_id'] : '';

    $background_color = isset($elementData['background_color']) ? $elementData['background_color'] : '';
    $padding = isset($elementData['padding']) ? $elementData['padding'] : '';
    $float = isset($elementData['float']) ? $elementData['float'] : '';

    $color = isset($elementData['color']) ? $elementData['color'] : '';
    $font_size = isset($elementData['font_size']) ? $elementData['font_size'] : '';
    $font_family = isset($elementData['font_family']) ? $elementData['font_family'] : '';
    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';
    $text_align = isset($elementData['text_align']) ? $elementData['text_align'] : '';
    $clear = isset($elementData['clear']) ? $elementData['clear'] : '';

    ?>
    <style type="text/css">
        .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?>{
        <?php if(!empty($color)): ?>
            color: <?php echo esc_attr($color); ?>;
        <?php endif; ?>
        <?php if(!empty($background_color)): ?>
            background-color: <?php echo esc_attr($background_color); ?>;
        <?php endif; ?>

        <?php if(!empty($font_size)): ?>
            font-size: <?php echo esc_attr($font_size); ?>;
        <?php endif; ?>
        <?php if(!empty($font_family)): ?>
            font-family: <?php echo esc_attr($font_family); ?>;
        <?php endif; ?>
        <?php if(!empty($margin)): ?>
            margin: <?php echo esc_attr($margin); ?>;
        <?php endif; ?>
        <?php if(!empty($padding)): ?>
            padding: <?php echo esc_attr($padding); ?>;
        <?php endif; ?>
        <?php if(!empty($text_align)): ?>
            text-align: <?php echo esc_attr($text_align); ?>;
        <?php endif; ?>
        <?php if(!empty($float)): ?>
            float: <?php echo esc_attr($float); ?>;
        <?php endif; ?>
        <?php if(!empty($clear)): ?>
            clear: <?php echo esc_attr($clear); ?>;
        <?php endif; ?>
        }


    </style>
    <?php
}



add_action('testimonial_layout_element_css_rating', 'testimonial_layout_element_css_rating', 10);
function testimonial_layout_element_css_rating($args){

    //echo '<pre>'.var_export($args, true).'</pre>';
    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $template_id = isset($args['template_id']) ? $args['template_id'] : '';

    $background_color = isset($elementData['background_color']) ? $elementData['background_color'] : '';
    $padding = isset($elementData['padding']) ? $elementData['padding'] : '';
    $float = isset($elementData['float']) ? $elementData['float'] : '';

    $color = isset($elementData['color']) ? $elementData['color'] : '';
    $font_size = isset($elementData['font_size']) ? $elementData['font_size'] : '';
    $font_family = isset($elementData['font_family']) ? $elementData['font_family'] : '';
    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';
    $text_align = isset($elementData['text_align']) ? $elementData['text_align'] : '';
    $clear = isset($elementData['clear']) ? $elementData['clear'] : '';


    ?>
    <style type="text/css">

        .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?>{
        <?php if(!empty($color)): ?>
            color: <?php echo esc_attr($color); ?>;
        <?php endif; ?>
        <?php if(!empty($background_color)): ?>
            background-color: <?php echo esc_attr($background_color); ?>;
        <?php endif; ?>

        <?php if(!empty($font_size)): ?>
            font-size: <?php echo esc_attr($font_size); ?>;
        <?php endif; ?>
        <?php if(!empty($font_family)): ?>
            font-family: <?php echo esc_attr($font_family); ?>;
        <?php endif; ?>
        <?php if(!empty($margin)): ?>
            margin: <?php echo esc_attr($margin); ?>;
        <?php endif; ?>
        <?php if(!empty($padding)): ?>
            padding: <?php echo esc_attr($padding); ?>;
        <?php endif; ?>
        <?php if(!empty($text_align)): ?>
            text-align: <?php echo esc_attr($text_align); ?>;
        <?php endif; ?>
        <?php if(!empty($float)): ?>
            float: <?php echo esc_attr($float); ?>;
        <?php endif; ?>
        <?php if(!empty($clear)): ?>
            clear: <?php echo esc_attr($clear); ?>;
        <?php endif; ?>
        }
        .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?> .star-rating{
            float: none;

        }

    </style>
    <?php
}






add_action('testimonial_layout_element_css_content', 'testimonial_layout_element_css_content', 10);
function testimonial_layout_element_css_content($args){

    //echo '<pre>'.var_export($args, true).'</pre>';
    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $template_id = isset($args['template_id']) ? $args['template_id'] : '';

    $read_more_color = isset($elementData['read_more_color']) ? $elementData['read_more_color'] : '';
    $background_color = isset($elementData['background_color']) ? $elementData['background_color'] : '';
    $padding = isset($elementData['padding']) ? $elementData['padding'] : '';
    $float = isset($elementData['float']) ? $elementData['float'] : '';

    $color = isset($elementData['color']) ? $elementData['color'] : '';
    $font_size = isset($elementData['font_size']) ? $elementData['font_size'] : '';
    $font_family = isset($elementData['font_family']) ? $elementData['font_family'] : '';
    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';
    $text_align = isset($elementData['text_align']) ? $elementData['text_align'] : '';
    $clear = isset($elementData['clear']) ? $elementData['clear'] : '';


    ?>
    <style type="text/css">
        .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?>{
            position: relative;
        <?php if(!empty($background_color)): ?>
            background-color: <?php echo esc_attr($background_color); ?>;
        <?php endif; ?>
        <?php if(!empty($color)): ?>
            color: <?php echo esc_attr($color); ?>;
        <?php endif; ?>
        <?php if(!empty($font_size)): ?>
            font-size: <?php echo esc_attr($font_size); ?>;
        <?php endif; ?>
        <?php if(!empty($font_family)): ?>
            font-family: <?php echo esc_attr($font_family); ?>;
        <?php endif; ?>
        <?php if(!empty($margin)): ?>
            margin: <?php echo esc_attr($margin); ?>;
        <?php endif; ?>
        <?php if(!empty($padding)): ?>
            padding: <?php echo esc_attr($padding); ?>;
        <?php endif; ?>
        <?php if(!empty($text_align)): ?>
            text-align: <?php echo esc_attr($text_align); ?>;
        <?php endif; ?>
        <?php if(!empty($float)): ?>
            float: <?php echo esc_attr($float); ?>;
        <?php endif; ?>
        <?php if(!empty($clear)): ?>
            clear: <?php echo esc_attr($clear); ?>;
        <?php endif; ?>
        }


        .arrow-top-left:after,
        .arrow-top-right:after,
        .arrow-top-middle:after{
            border-bottom-color: <?php echo esc_attr($background_color); ?> !important;
        }
        .arrow-bottom-right:after,
        .arrow-bottom-left:after,
        .arrow-bottom-middle:after{
            border-top-color: <?php echo esc_attr($background_color); ?> !important;
        }
        .arrow-right-top:after,
        .arrow-right-bottom:after{
            border-left-color: <?php echo esc_attr($background_color); ?> !important;
        }
        .arrow-left-top:after,
        .arrow-left-bottom:after{
            border-right-color: <?php echo esc_attr($background_color); ?> !important;
        }

    </style>
    <?php
}



add_action('testimonial_layout_element_css_thumbnail', 'testimonial_layout_element_css_thumbnail', 10);
function testimonial_layout_element_css_thumbnail($args){

    //echo '<pre>'.var_export($args, true).'</pre>';
    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $template_id = isset($args['template_id']) ? $args['template_id'] : '';

    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';
    $padding = isset($elementData['padding']) ? $elementData['padding'] : '';
    $float = isset($elementData['float']) ? $elementData['float'] : '';
    $border_radius = isset($elementData['border_radius']) ? $elementData['border_radius'] : '';


    $thumb_height = isset($elementData['thumb_height']) ? $elementData['thumb_height'] : '';
    $thumb_height_large = isset($thumb_height['large']) ? $thumb_height['large'] : '';
    $thumb_height_medium = isset($thumb_height['medium']) ? $thumb_height['medium'] : '';
    $thumb_height_small = isset($thumb_height['small']) ? $thumb_height['small'] : '';

    $thumb_width = isset($elementData['thumb_width']) ? $elementData['thumb_width'] : '';
    $thumb_width_large = isset($thumb_width['large']) ? $thumb_width['large'] : '';
    $thumb_width_medium = isset($thumb_width['medium']) ? $thumb_width['medium'] : '';
    $thumb_width_small = isset($thumb_width['small']) ? $thumb_width['small'] : '';


    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';


    ?>
    <style type="text/css">

        .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?>{
            overflow: hidden;
        <?php if(!empty($margin)): ?>
            margin: <?php echo esc_attr($margin); ?>;
        <?php endif; ?>
        <?php if(!empty($float)): ?>
            float: <?php echo esc_attr($float); ?>;
        <?php endif; ?>
        <?php if(!empty($padding)): ?>
            padding: <?php echo esc_attr($padding); ?>;
        <?php endif; ?>
        <?php if(!empty($border_radius)): ?>
            border-radius: <?php echo esc_attr($border_radius); ?>;
        <?php endif; ?>

        }

        @media only screen and (min-width: 1024px ){
            .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?>{
            <?php if(!empty($thumb_height_large)): ?>
                max-height: <?php echo esc_attr($thumb_height_large); ?>;
            <?php endif; ?>
            <?php if(!empty($thumb_width_large)): ?>
                max-width: <?php echo esc_attr($thumb_width_large); ?>;
            <?php endif; ?>

            }
        }

        @media only screen and ( min-width: 768px ) and ( max-width: 1023px ) {
            .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?>{
            <?php if(!empty($thumb_height_medium)): ?>
                max-height: <?php echo esc_attr($thumb_height_medium); ?>;
            <?php endif; ?>
            <?php if(!empty($thumb_width_medium)): ?>
                max-width: <?php echo esc_attr($thumb_width_medium); ?>;
            <?php endif; ?>

            }
        }

        @media only screen and ( min-width: 0px ) and ( max-width: 767px ){
            .layout-<?php echo esc_attr($template_id); ?> .element-<?php echo esc_attr($element_index); ?>{
            <?php if(!empty($thumb_height_small)): ?>
                max-height: <?php echo esc_attr($thumb_height_small); ?>;
            <?php endif; ?>
            <?php if(!empty($thumb_width_small)): ?>
                max-width: <?php echo esc_attr($thumb_width_small); ?>;
            <?php endif; ?>

            }
        }



    </style>
    <?php
}


