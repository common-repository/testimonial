<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

add_action('testimonial_layout_elements_option_custom_text','testimonial_layout_elements_option_custom_text');


function testimonial_layout_elements_option_custom_text($parameters){

    $pickp_settings_tabs_field = new pickp_settings_tabs_field();

    $input_name = isset($parameters['input_name']) ? $parameters['input_name'] : '{input_name}';
    $element_data = isset($parameters['element_data']) ? $parameters['element_data'] : array();
    $element_index = isset($parameters['index']) ? $parameters['index'] : '';

    $content = isset($element_data['content']) ? $element_data['content'] : '';

    $color = isset($element_data['color']) ? $element_data['color'] : '';
    $font_size = isset($element_data['font_size']) ? $element_data['font_size'] : '';
    $font_family = isset($element_data['font_family']) ? $element_data['font_family'] : '';
    $margin = isset($element_data['margin']) ? $element_data['margin'] : '';
    $text_align = isset($element_data['text_align']) ? $element_data['text_align'] : '';
    $padding = isset($element_data['padding']) ? $element_data['padding'] : '';
    $float = isset($element_data['float']) ? $element_data['float'] : '';
    $custom_css = isset($element_data['custom_css']) ? $element_data['custom_css'] : '';
    $custom_css_hover = isset($element_data['custom_css_hover']) ? $element_data['custom_css_hover'] : '';



    ?>
    <div class="item">
        <div class="element-title header ">
            <span class="remove" onclick="jQuery(this).parent().parent().remove()"><i class="fas fa-times"></i></span>
            <span class="sort"><i class="fas fa-sort"></i></span>

            <span class="expand"><?php echo __('Custom text','testimonial'); ?></span>
        </div>
        <div class="element-options options">

            <?php

            $args = array(
                'id'		=> 'content',
                'css_id'		=> $element_index.'_font_size',
                'parent' => $input_name.'[custom_text]',
                'title'		=> __('Custom text','testimonial'),
                'details'	=> __('Write custom text.','testimonial'),
                'type'		=> 'textarea',
                'value'		=> $content,
                'default'		=> '',
                'placeholder'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'color',
                'css_id'		=> $element_index.'_custom_text',
                'parent' => $input_name.'[custom_text]',
                'title'		=> __('Color','testimonial'),
                'details'	=> __('Title text color.','testimonial'),
                'type'		=> 'colorpicker',
                'value'		=> $color,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'font_size',
                'css_id'		=> $element_index.'_font_size',
                'parent' => $input_name.'[custom_text]',
                'title'		=> __('Font size','testimonial'),
                'details'	=> __('Set font size.','testimonial'),
                'type'		=> 'text',
                'value'		=> $font_size,
                'default'		=> '',
                'placeholder'		=> '14px',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'font_family',
                'css_id'		=> $element_index.'_font_family',
                'parent' => $input_name.'[custom_text]',
                'title'		=> __('Font family','testimonial'),
                'details'	=> __('Set font family.','testimonial'),
                'type'		=> 'text',
                'value'		=> $font_family,
                'default'		=> '',
                'placeholder'		=> 'Open Sans',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'margin',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[custom_text]',
                'title'		=> __('Margin','testimonial'),
                'details'	=> __('Set margin.','testimonial'),
                'type'		=> 'text',
                'value'		=> $margin,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'text_align',
                'css_id'		=> $element_index.'_text_align',
                'parent' => $input_name.'[custom_text]',
                'title'		=> __('Text align','testimonial'),
                'details'	=> __('Choose text align.','testimonial'),
                'type'		=> 'select',
                'value'		=> $text_align,
                'default'		=> 'left',
                'args'		=> array('left'=> __('Left', 'testimonial'),'right'=> __('Right', 'testimonial'),'center'=> __('Center', 'testimonial') ),
            );

            $pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'padding',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[custom_text]',
                'title'		=> __('Padding','testimonial'),
                'details'	=> __('Set padding.','testimonial'),
                'type'		=> 'text',
                'value'		=> $padding,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'float',
                'css_id'		=> $element_index.'_float',
                'parent' => $input_name.'[custom_text]',
                'title'		=> __('Float','testimonial'),
                'details'	=> __('Choose Float.','testimonial'),
                'type'		=> 'select',
                'value'		=> $float,
                'default'		=> 'none',
                'args'		=> array(
                    'none'=>__('None','testimonial'),
                    'left'=>__('Left','testimonial'),
                    'right'=>__('Right','testimonial'),
                    'inherit'=>__('Inherit','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);



            ob_start();
            ?>
            <textarea readonly type="text"  onclick="this.select();">.element-<?php echo esc_attr($element_index) ?>{}</textarea>
            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'use_css',
                'title'		=> __('Use of CSS','testimonial'),
                'details'	=> __('Use following class selector to add custom CSS for this element.','testimonial'),
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $pickp_settings_tabs_field->generate_field($args);

            ?>

        </div>
    </div>
    <?php

}


add_action('testimonial_layout_elements_option_name','testimonial_layout_elements_option_name');


function testimonial_layout_elements_option_name($parameters){

    $pickp_settings_tabs_field = new pickp_settings_tabs_field();

    $input_name = isset($parameters['input_name']) ? $parameters['input_name'] : '{input_name}';
    $element_data = isset($parameters['element_data']) ? $parameters['element_data'] : array();
    $element_index = isset($parameters['index']) ? $parameters['index'] : '';


    $color = isset($element_data['color']) ? $element_data['color'] : '';
    $font_size = isset($element_data['font_size']) ? $element_data['font_size'] : '';
    $font_family = isset($element_data['font_family']) ? $element_data['font_family'] : '';
    $margin = isset($element_data['margin']) ? $element_data['margin'] : '';
    $link_to = isset($element_data['link_to']) ? $element_data['link_to'] : '';
    $text_align = isset($element_data['text_align']) ? $element_data['text_align'] : '';
    $padding = isset($element_data['padding']) ? $element_data['padding'] : '';
    $float = isset($element_data['float']) ? $element_data['float'] : '';

    $custom_css = isset($element_data['custom_css']) ? $element_data['custom_css'] : '';
    $custom_css_hover = isset($element_data['custom_css_hover']) ? $element_data['custom_css_hover'] : '';



    ?>
    <div class="item">
        <div class="element-title header ">
            <span class="remove" onclick="jQuery(this).parent().parent().remove()"><i class="fas fa-times"></i></span>
            <span class="sort"><i class="fas fa-sort"></i></span>

            <span class="expand"><?php echo __('Name','testimonial'); ?></span>
        </div>
        <div class="element-options options">

            <?php

            $args = array(
                'id'		=> 'color',
                'css_id'		=> $element_index.'_name_color',
                'parent' => $input_name.'[name]',
                'title'		=> __('Color','testimonial'),
                'details'	=> __('Title text color.','testimonial'),
                'type'		=> 'colorpicker',
                'value'		=> $color,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'font_size',
                'css_id'		=> $element_index.'_font_size',
                'parent' => $input_name.'[name]',
                'title'		=> __('Font size','testimonial'),
                'details'	=> __('Set font size.','testimonial'),
                'type'		=> 'text',
                'value'		=> $font_size,
                'default'		=> '',
                'placeholder'		=> '14px',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'font_family',
                'css_id'		=> $element_index.'_font_family',
                'parent' => $input_name.'[name]',
                'title'		=> __('Font family','testimonial'),
                'details'	=> __('Set font family.','testimonial'),
                'type'		=> 'text',
                'value'		=> $font_family,
                'default'		=> '',
                'placeholder'		=> 'Open Sans',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'margin',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[name]',
                'title'		=> __('Margin','testimonial'),
                'details'	=> __('Set margin.','testimonial'),
                'type'		=> 'text',
                'value'		=> $margin,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'padding',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[name]',
                'title'		=> __('Padding','testimonial'),
                'details'	=> __('Set padding.','testimonial'),
                'type'		=> 'text',
                'value'		=> $padding,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'text_align',
                'css_id'		=> $element_index.'_float',
                'parent' => $input_name.'[name]',
                'title'		=> __('Text align','testimonial'),
                'details'	=> __('Choose text align.','testimonial'),
                'type'		=> 'select',
                'value'		=> $text_align,
                'default'		=> 'left',
                'args'		=> array(
                    'none'=>__('None','testimonial'),
                    'left'=>__('Left','testimonial'),
                    'right'=>__('Right','testimonial'),
                    'center'=>__('Center','testimonial'),

                ),
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'float',
                'css_id'		=> $element_index.'_float',
                'parent' => $input_name.'[name]',
                'title'		=> __('Float','testimonial'),
                'details'	=> __('Choose float.','testimonial'),
                'type'		=> 'select',
                'value'		=> $float,
                'default'		=> 'none',
                'args'		=> array(
                    'none'=>__('None','testimonial'),
                    'left'=>__('Left','testimonial'),
                    'right'=>__('Right','testimonial'),
                    'inherit'=>__('Inherit','testimonial'),
                    ),
            );

            $pickp_settings_tabs_field->generate_field($args);


            ob_start();
            ?>
            <textarea readonly type="text"  onclick="this.select();">.element-<?php echo $element_index?>{}</textarea>
            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'use_css',
                'title'		=> __('Use of CSS','testimonial'),
                'details'	=> __('Use following class selector to add custom CSS for this element.','testimonial'),
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $pickp_settings_tabs_field->generate_field($args);

            ?>

        </div>
    </div>
    <?php

}




add_action('testimonial_layout_elements_option_thumbnail','testimonial_layout_elements_option_thumbnail');


function testimonial_layout_elements_option_thumbnail($parameters){

    $pickp_settings_tabs_field = new pickp_settings_tabs_field();

    $input_name = isset($parameters['input_name']) ? $parameters['input_name'] : '{input_name}';
    $element_data = isset($parameters['element_data']) ? $parameters['element_data'] : array();
    $element_index = isset($parameters['index']) ? $parameters['index'] : '';

    $thumb_size = isset($element_data['thumb_size']) ? $element_data['thumb_size'] : '';
    $default_thumb_src = isset($element_data['default_thumb_src']) ? $element_data['default_thumb_src'] : '';
    $link_to_meta_key = isset($element_data['link_to_meta_key']) ? $element_data['link_to_meta_key'] : '';

    $margin = isset($element_data['margin']) ? $element_data['margin'] : '';
    $padding = isset($element_data['padding']) ? $element_data['padding'] : '';
    $float = isset($element_data['float']) ? $element_data['float'] : '';
    $border_radius = isset($element_data['border_radius']) ? $element_data['border_radius'] : '';

    $thumb_height = isset($element_data['thumb_height']) ? $element_data['thumb_height'] : '';
    $thumb_height_large = isset($thumb_height['large']) ? $thumb_height['large'] : '';
    $thumb_height_medium = isset($thumb_height['medium']) ? $thumb_height['medium'] : '';
    $thumb_height_small = isset($thumb_height['small']) ? $thumb_height['small'] : '';

    $thumb_width = isset($element_data['thumb_width']) ? $element_data['thumb_width'] : '';
    $thumb_width_large = isset($thumb_width['large']) ? $thumb_width['large'] : '';
    $thumb_width_medium = isset($thumb_width['medium']) ? $thumb_width['medium'] : '';
    $thumb_width_small = isset($thumb_width['small']) ? $thumb_width['small'] : '';




    ?>
    <div class="item">
        <div class="element-title header ">
            <span class="remove" onclick="jQuery(this).parent().parent().remove()"><i class="fas fa-times"></i></span>
            <span class="sort"><i class="fas fa-sort"></i></span>

            <span class="expand"><?php echo __('Thumbnail','testimonial'); ?></span>
        </div>
        <div class="element-options options">

            <?php

            $thumbnail_sizes = array();
            $thumbnail_sizes['full'] = __('Full', '');
            $get_intermediate_image_sizes =  get_intermediate_image_sizes();

            if(!empty($get_intermediate_image_sizes))
            foreach($get_intermediate_image_sizes as $size_key){
                $size_name = str_replace('_', ' ',$size_key);
                $size_name = str_replace('-', ' ',$size_name);

                $thumbnail_sizes[$size_key] = ucfirst($size_name);
            }
            //echo '<pre>'.var_export($thumbnail_sizes, true).'</pre>';

            $args = array(
                'id'		=> 'thumb_size',
                'parent' => $input_name.'[thumbnail]',
                'title'		=> __('Thumbnail size','testimonial'),
                'details'	=> __('Choose thumbnail size.','testimonial'),
                'type'		=> 'select',
                'value'		=> $thumb_size,
                'default'		=> 'large',
                'args'		=> $thumbnail_sizes,
            );

            $pickp_settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'thumb_width',
                'title'		=> __('Thumbnail width','testimonial'),
                'details'	=> __('Set thumbnail width.','testimonial'),
                'type'		=> 'option_group',
                'options'		=> array(
                    array(
                        'id'		=> 'large',
                        'parent'		=> $input_name.'[thumbnail][thumb_width]',
                        'title'		=> __('In desktop','testimonial'),
                        'details'	=> __('min-width: 1200px, ex: 280px','testimonial'),
                        'type'		=> 'text',
                        'value'		=> $thumb_width_large,
                        'default'		=> '',
                        'placeholder'   => '280px',
                    ),
                    array(
                        'id'		=> 'medium',
                        'parent'		=> $input_name.'[thumbnail][thumb_width]',
                        'title'		=> __('In tablet & small desktop','testimonial'),
                        'details'	=> __('min-width: 992px, ex: 280px','testimonial'),
                        'type'		=> 'text',
                        'value'		=> $thumb_width_medium,
                        'default'		=> '',
                        'placeholder'   => '280px',
                    ),
                    array(
                        'id'		=> 'small',
                        'parent'		=> $input_name.'[thumbnail][thumb_width]',
                        'title'		=> __('In mobile','testimonial'),
                        'details'	=> __('max-width: 768px, ex: 280px','testimonial'),
                        'type'		=> 'text',
                        'value'		=> $thumb_width_small,
                        'default'		=> '',
                        'placeholder'   => '280px',
                    ),
                ),

            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'thumb_height',
                'title'		=> __('Thumbnail height','testimonial'),
                'details'	=> __('Set thumbnail height.','testimonial'),
                'type'		=> 'option_group',
                'options'		=> array(
                    array(
                        'id'		=> 'large',
                        'parent'		=> $input_name.'[thumbnail][thumb_height]',
                        'title'		=> __('In desktop','testimonial'),
                        'details'	=> __('min-width: 1200px, ex: 280px','testimonial'),
                        'type'		=> 'text',
                        'value'		=> $thumb_height_large,
                        'default'		=> '',
                        'placeholder'   => '280px',
                    ),
                    array(
                        'id'		=> 'medium',
                        'parent'		=> $input_name.'[thumbnail][thumb_height]',
                        'title'		=> __('In tablet & small desktop','testimonial'),
                        'details'	=> __('min-width: 992px, ex: 280px','testimonial'),
                        'type'		=> 'text',
                        'value'		=> $thumb_height_medium,
                        'default'		=> '',
                        'placeholder'   => '280px',
                    ),
                    array(
                        'id'		=> 'small',
                        'parent'		=> $input_name.'[thumbnail][thumb_height]',
                        'title'		=> __('In mobile','testimonial'),
                        'details'	=> __('max-width: 768px, ex: 280px','testimonial'),
                        'type'		=> 'text',
                        'value'		=> $thumb_height_small,
                        'default'		=> '',
                        'placeholder'   => '280px',
                    ),
                ),

            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'default_thumb_src',
                'parent' => $input_name.'[thumbnail]',
                'title'		=> __('Default thumbnail','testimonial'),
                'details'	=> __('Choose default thumbnail.','testimonial'),
                'type'		=> 'media_url',
                'value'		=> $default_thumb_src,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'margin',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[thumbnail]',
                'title'		=> __('Margin','testimonial'),
                'details'	=> __('Set margin.','testimonial'),
                'type'		=> 'text',
                'value'		=> $margin,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'border_radius',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[thumbnail]',
                'title'		=> __('Border radius','testimonial'),
                'details'	=> __('Set border radius.','testimonial'),
                'type'		=> 'text',
                'value'		=> $border_radius,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'padding',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[thumbnail]',
                'title'		=> __('Padding','testimonial'),
                'details'	=> __('Set padding.','testimonial'),
                'type'		=> 'text',
                'value'		=> $padding,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'float',
                'css_id'		=> $element_index.'_float',
                'parent' => $input_name.'[thumbnail]',
                'title'		=> __('Float','testimonial'),
                'details'	=> __('Choose float.','testimonial'),
                'type'		=> 'select',
                'value'		=> $float,
                'default'		=> 'none',
                'args'		=> array(
                    'none'=>__('None','testimonial'),
                    'left'=>__('Left','testimonial'),
                    'right'=>__('Right','testimonial'),
                    'inherit'=>__('Inherit','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);


            ob_start();
            ?>
            <code onclick="this.select()">
                .element-<?php echo $element_index?>{}

            </code>
            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'use_css',
                'title'		=> __('Use of CSS','testimonial'),
                'details'	=> __('Use following class selector to add custom CSS for this element.','testimonial'),
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $pickp_settings_tabs_field->generate_field($args);

            ?>

        </div>
    </div>
    <?php

}




add_action('testimonial_layout_elements_option_content','testimonial_layout_elements_option_content');


function testimonial_layout_elements_option_content($parameters){

    $pickp_settings_tabs_field = new pickp_settings_tabs_field();

    $input_name = isset($parameters['input_name']) ? $parameters['input_name'] : '{input_name}';
    $element_data = isset($parameters['element_data']) ? $parameters['element_data'] : array();
    $element_index = isset($parameters['index']) ? $parameters['index'] : '';

    $content_source = isset($element_data['content_source']) ? $element_data['content_source'] : '';
    $word_count = isset($element_data['word_count']) ? $element_data['word_count'] : 15;
    $read_more_text = isset($element_data['read_more_text']) ? $element_data['read_more_text'] : __('Read more','testimonial');
    $read_more_color = isset($element_data['read_more_color']) ? $element_data['read_more_color'] : '';
    $background_color = isset($element_data['background_color']) ? $element_data['background_color'] : '';

    $color = isset($element_data['color']) ? $element_data['color'] : '';
    $font_size = isset($element_data['font_size']) ? $element_data['font_size'] : '';
    $font_family = isset($element_data['font_family']) ? $element_data['font_family'] : '';
    $margin = isset($element_data['margin']) ? $element_data['margin'] : '';
    $link_to = isset($element_data['link_to']) ? $element_data['link_to'] : '';
    $text_align = isset($element_data['text_align']) ? $element_data['text_align'] : '';
    $padding = isset($element_data['padding']) ? $element_data['padding'] : '';
    $float = isset($element_data['float']) ? $element_data['float'] : '';
    $custom_css = isset($element_data['custom_css']) ? $element_data['custom_css'] : '';
    $custom_css_hover = isset($element_data['custom_css_hover']) ? $element_data['custom_css_hover'] : '';
    $arrow_position = isset($element_data['arrow_position']) ? $element_data['arrow_position'] : '';

    $clear = isset($element_data['clear']) ? $element_data['clear'] : '';

    ?>
    <div class="item">
        <div class="element-title header ">
            <span class="remove" onclick="jQuery(this).parent().parent().remove()"><i class="fas fa-times"></i></span>
            <span class="sort"><i class="fas fa-sort"></i></span>

            <span class="expand"><?php echo __('Content','testimonial'); ?></span>
        </div>
        <div class="element-options options">

            <?php


            $args = array(
                'id'		=> 'word_count',
                'css_id'		=> $element_index.'_word_count',
                'parent' => $input_name.'[content]',
                'title'		=> __('Word count','testimonial'),
                'details'	=> __('Set word count.','testimonial'),
                'type'		=> 'text',
                'value'		=> $word_count,
                'default'		=> '',
                'placeholder'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'color',
                'css_id'		=> $element_index.'_content_color',
                'parent' => $input_name.'[content]',
                'title'		=> __('Color','testimonial'),
                'details'	=> __('Title text color.','testimonial'),
                'type'		=> 'colorpicker',
                'value'		=> $color,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'background_color',
                'css_id'		=> $element_index.'_content_color',
                'parent' => $input_name.'[content]',
                'title'		=> __('Background color','testimonial'),
                'details'	=> __('Set background color.','testimonial'),
                'type'		=> 'colorpicker',
                'value'		=> $background_color,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'font_size',
                'css_id'		=> $element_index.'_font_size',
                'parent' => $input_name.'[content]',
                'title'		=> __('Font size','testimonial'),
                'details'	=> __('Set font size.','testimonial'),
                'type'		=> 'text',
                'value'		=> $font_size,
                'default'		=> '',
                'placeholder'		=> '14px',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'font_family',
                'css_id'		=> $element_index.'_font_family',
                'parent' => $input_name.'[content]',
                'title'		=> __('Font family','testimonial'),
                'details'	=> __('Set font family.','testimonial'),
                'type'		=> 'text',
                'value'		=> $font_family,
                'default'		=> '',
                'placeholder'		=> 'Open Sans',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'text_align',
                'css_id'		=> $element_index.'_text_align',
                'parent' => $input_name.'[content]',
                'title'		=> __('Text align','testimonial'),
                'details'	=> __('Choose text align.','testimonial'),
                'type'		=> 'select',
                'value'		=> $text_align,
                'default'		=> 'left',
                'args'		=> array('left'=> __('Left', 'testimonial'),'right'=> __('Right', 'testimonial'),'center'=> __('Center', 'testimonial') ),
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'margin',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[content]',
                'title'		=> __('Margin','testimonial'),
                'details'	=> __('Set margin.','testimonial'),
                'type'		=> 'text',
                'value'		=> $margin,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'padding',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[content]',
                'title'		=> __('Padding','testimonial'),
                'details'	=> __('Set padding.','testimonial'),
                'type'		=> 'text',
                'value'		=> $padding,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'float',
                'css_id'		=> $element_index.'_float',
                'parent' => $input_name.'[content]',
                'title'		=> __('Float','testimonial'),
                'details'	=> __('Choose float.','testimonial'),
                'type'		=> 'select',
                'value'		=> $float,
                'default'		=> 'none',
                'args'		=> array(
                    'none'=>__('None','testimonial'),
                    'left'=>__('Left','testimonial'),
                    'right'=>__('Right','testimonial'),
                    'inherit'=>__('Inherit','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'clear',
                'css_id'		=> $element_index.'_float',
                'parent' => $input_name.'[content]',
                'title'		=> __('clear','testimonial'),
                'details'	=> __('Choose clear.','testimonial'),
                'type'		=> 'select',
                'value'		=> $clear,
                'default'		=> 'none',
                'args'		=> array(
                    'none'=>__('None','testimonial'),
                    'left'=>__('Left','testimonial'),
                    'right'=>__('Right','testimonial'),
                    'inherit'=>__('Inherit','testimonial'),
                    'both'=>__('Both','testimonial'),

                ),
            );

            $pickp_settings_tabs_field->generate_field($args);




            ob_start();
            ?>
            <code onclick="this.select()">
                .element-<?php echo esc_attr($element_index); ?>{}

            </code>
            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'use_css',
                'title'		=> __('Use of CSS','testimonial'),
                'details'	=> __('Use following class selector to add custom CSS for this element.','testimonial'),
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'arrow_position',
                'css_id'		=> $element_index.'_arrow_position',
                'parent' => $input_name.'[content]',
                'title'		=> __('Arrow position','testimonial'),
                'details'	=> __('Choose arrow position.','testimonial'),
                'type'		=> 'select',
                'value'		=> $arrow_position,
                'default'		=> 'none',
                'args'		=> array(
                    'top-left'=> __('top-left', 'testimonial'),
                    'top-right'=> __('top-right', 'testimonial'),
                    'top-middle'=> __('top-middle', 'testimonial'),
                    'bottom-right'=> __('bottom-right', 'testimonial'),
                    'bottom-left'=> __('bottom-left', 'testimonial'),
                    'bottom-middle'=> __('bottom-middle', 'testimonial'),
                    'right-top'=> __('right-top', 'testimonial'),
                    'right-bottom'=> __('right-bottom', 'testimonial'),
                    'left-top'=> __('left-top', 'testimonial'),
                    'left-bottom'=> __('left-bottom', 'testimonial'),
                    'none'=> __('None', 'testimonial'),


                ),
            );

            $pickp_settings_tabs_field->generate_field($args);



            ?>

        </div>
    </div>
    <?php

}








add_action('testimonial_layout_elements_option_wrapper_start','testimonial_layout_elements_option_wrapper_start');


function testimonial_layout_elements_option_wrapper_start($parameters){

    $pickp_settings_tabs_field = new pickp_settings_tabs_field();

    $input_name = isset($parameters['input_name']) ? $parameters['input_name'] : '{input_name}';
    $element_data = isset($parameters['element_data']) ? $parameters['element_data'] : array();
    $element_index = isset($parameters['index']) ? $parameters['index'] : '';

    $wrapper_id = isset($element_data['wrapper_id']) ? $element_data['wrapper_id'] : '';
    $wrapper_class = isset($element_data['wrapper_class']) ? $element_data['wrapper_class'] : '';
    $css_idle = isset($element_data['css_idle']) ? $element_data['css_idle'] : '';
    $margin = isset($element_data['margin']) ? $element_data['margin'] : '';
    $padding = isset($element_data['padding']) ? $element_data['padding'] : '';
    $float = isset($element_data['float']) ? $element_data['float'] : '';
    ?>
    <div class="item">
        <div class="element-title header ">
            <span class="remove" onclick="jQuery(this).parent().parent().remove()"><i class="fas fa-times"></i></span>
            <span class="sort"><i class="fas fa-sort"></i></span>

            <span class="expand"><?php echo __('Wrapper start','testimonial'); ?></span>

            <span class="handle-start"><i class="fas fa-level-up-alt"></i></span>

        </div>
        <div class="element-options options">

            <?php

            $args = array(
                'id'		=> 'wrapper_id',
                'parent' => $input_name.'[wrapper_start]',
                'title'		=> __('Wrapper id','testimonial'),
                'details'	=> __('Write wrapper id, ex: my-unique-id.','testimonial'),
                'type'		=> 'text',
                'value'		=> $wrapper_id,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'wrapper_class',
                'parent' => $input_name.'[wrapper_start]',
                'title'		=> __('Wrapper class','testimonial'),
                'details'	=> __('Write wrapper class, ex: layer-thumbnail','testimonial'),
                'type'		=> 'text',
                'value'		=> $wrapper_class,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'css_idle',
                'css_id'		=> 'css_idle_'.preg_replace('/\D/', '', $input_name) ,
                'parent' => $input_name.'[wrapper_start]',
                'title'		=> __('Custom CSS','testimonial'),
                'details'	=> __('Write custom CSS. do not use <code>&lt;style>&lt;/style></code>','testimonial'),
                'type'		=> 'scripts_css',
                'value'		=> $css_idle,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'margin',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[wrapper_start]',
                'title'		=> __('Margin','testimonial'),
                'details'	=> __('Set margin.','testimonial'),
                'type'		=> 'text',
                'value'		=> $margin,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'padding',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[wrapper_start]',
                'title'		=> __('Padding','testimonial'),
                'details'	=> __('Set padding.','testimonial'),
                'type'		=> 'text',
                'value'		=> $padding,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $pickp_settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'float',
                'css_id'		=> $element_index.'_float',
                'parent' => $input_name.'[wrapper_start]',
                'title'		=> __('Float','testimonial'),
                'details'	=> __('Choose float.','testimonial'),
                'type'		=> 'select',
                'value'		=> $float,
                'default'		=> 'none',
                'args'		=> array(
                    'none'=>__('None','testimonial'),
                    'left'=>__('Left','testimonial'),
                    'right'=>__('Right','testimonial'),
                    'inherit'=>__('Inherit','testimonial'),
                ),
            );

            $pickp_settings_tabs_field->generate_field($args);







            ob_start();
            ?>
            <code onclick="this.select()">
                .element-<?php echo $element_index?>{}

            </code>
            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'use_css',
                'title'		=> __('Use of CSS','testimonial'),
                'details'	=> __('Use following class selector to add custom CSS for this element.','testimonial'),
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $pickp_settings_tabs_field->generate_field($args);

            ?>

        </div>
    </div>
    <?php

}




add_action('testimonial_layout_elements_option_wrapper_end','testimonial_layout_elements_option_wrapper_end');


function testimonial_layout_elements_option_wrapper_end($parameters){

    $pickp_settings_tabs_field = new pickp_settings_tabs_field();

    $input_name = isset($parameters['input_name']) ? $parameters['input_name'] : '{input_name}';
    $element_data = isset($parameters['element_data']) ? $parameters['element_data'] : array();

    $meta_key = isset($element_data['meta_key']) ? $element_data['meta_key'] : '';
    $font_size = isset($element_data['font_size']) ? $element_data['font_size'] : '';
    $font_family = isset($element_data['font_family']) ? $element_data['font_family'] : '';

    ?>
    <div class="item">
        <div class="element-title header ">
            <span class="remove" onclick="jQuery(this).parent().parent().remove()"><i class="fas fa-times"></i></span>
            <span class="sort"><i class="fas fa-sort"></i></span>

            <span class="expand"><?php echo __('Wrapper end','testimonial'); ?></span>
            <span class="handle-end"><i class="fas fa-level-down-alt"></i></span>
        </div>
        <div class="element-options options">

            <?php

            $args = array(
                'id'		=> 'wrapper_id',
                'parent' => $input_name.'[wrapper_end]',
                'title'		=> __('Wrapper id','testimonial'),
                'details'	=> __('Write wrapper id, ex: div, p, span.','testimonial'),
                'type'		=> 'text',
                'value'		=> $meta_key,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);





            ?>

        </div>
    </div>
    <?php

}







add_action('testimonial_layout_elements_option_rating','testimonial_layout_elements_option_rating');
function testimonial_layout_elements_option_rating($parameters){

    $settings_tabs_field = new pickp_settings_tabs_field();

    $input_name = isset($parameters['input_name']) ? $parameters['input_name'] : '{input_name}';
    $element_data = isset($parameters['element_data']) ? $parameters['element_data'] : array();
    $element_index = isset($parameters['index']) ? $parameters['index'] : '';

    $rating_type = isset($element_data['rating_type']) ? $element_data['rating_type'] : 'five_star';
    $font_size = isset($element_data['font_size']) ? $element_data['font_size'] : '';
    $font_family = isset($element_data['font_family']) ? $element_data['font_family'] : '';
    $wrapper_html = isset($element_data['wrapper_html']) ? $element_data['wrapper_html'] : '';
    $margin = isset($element_data['margin']) ? $element_data['margin'] : '';
    $color = isset($element_data['color']) ? $element_data['color'] : '';
    $text_align = isset($element_data['text_align']) ? $element_data['text_align'] : '';
    $padding = isset($element_data['padding']) ? $element_data['padding'] : '';
    $float = isset($element_data['float']) ? $element_data['float'] : '';

    ?>
    <div class="item">
        <div class="element-title header ">
            <span class="remove" onclick="jQuery(this).parent().parent().remove()"><i class="fas fa-times"></i></span>
            <span class="sort"><i class="fas fa-sort"></i></span>

            <span class="expand"><?php echo __('Rating','testimonial'); ?></span>
        </div>
        <div class="element-options options">

            <?php

            $args = array(
                'id'		=> 'rating_type',
                'parent' => $input_name.'[rating]',
                'title'		=> __('Rating type','testimonial'),
                'details'	=> __('Choose rating type.','testimonial'),
                'type'		=> 'select',
                'value'		=> $rating_type,
                'args'		=> array('text'=> 'Text', 'five_star'=>'Star'),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'wrapper_html',
                'css_id'		=> $element_index.'_wrapper_html',
                'parent' => $input_name.'[rating]',
                'title'		=> __('Wrapper html','testimonial'),
                'details'	=> __('Write wrapper html, use <code>%s</code> to replace rating output.','testimonial'),
                'type'		=> 'text',
                'value'		=> $wrapper_html,
                'default'		=> '',
                'placeholder'		=> 'Rating: %s',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'margin',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[rating]',
                'title'		=> __('Margin','testimonial'),
                'details'	=> __('Set margin.','testimonial'),
                'type'		=> 'text',
                'value'		=> $margin,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'color',
                'css_id'		=> $element_index.'_color',
                'parent' => $input_name.'[rating]',
                'title'		=> __('Text Color','testimonial'),
                'details'	=> __('Choose text color.','testimonial'),
                'type'		=> 'colorpicker',
                'value'		=> $color,
                'default'		=> '',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'text_align',
                'css_id'		=> $element_index.'_text_align',
                'parent' => $input_name.'[rating]',
                'title'		=> __('Text align','testimonial'),
                'details'	=> __('Choose text align.','testimonial'),
                'type'		=> 'select',
                'value'		=> $text_align,
                'default'		=> 'left',
                'args'		=> array('left'=> __('Left', 'testimonial'),'right'=> __('Right', 'testimonial'),'center'=> __('Center', 'testimonial') ),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'font_size',
                'css_id'		=> $element_index.'_font_size',
                'parent' => $input_name.'[rating]',
                'title'		=> __('Font size','testimonial'),
                'details'	=> __('Set font size.','testimonial'),
                'type'		=> 'text',
                'value'		=> $font_size,
                'default'		=> '',
                'placeholder'		=> '14px',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'padding',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[rating]',
                'title'		=> __('Padding','testimonial'),
                'details'	=> __('Set padding.','testimonial'),
                'type'		=> 'text',
                'value'		=> $padding,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'float',
                'css_id'		=> $element_index.'_float',
                'parent' => $input_name.'[rating]',
                'title'		=> __('Float','testimonial'),
                'details'	=> __('Choose float.','testimonial'),
                'type'		=> 'select',
                'value'		=> $float,
                'default'		=> 'none',
                'args'		=> array(
                    'none'=>__('None','testimonial'),
                    'left'=>__('Left','testimonial'),
                    'right'=>__('Right','testimonial'),
                    'inherit'=>__('Inherit','testimonial'),
                ),
            );

            $settings_tabs_field->generate_field($args);



            ?>

        </div>
    </div>
    <?php

}





add_action('testimonial_layout_elements_option_company_name','testimonial_layout_elements_option_company_name');
function testimonial_layout_elements_option_company_name($parameters){

    $settings_tabs_field = new pickp_settings_tabs_field();

    $input_name = isset($parameters['input_name']) ? $parameters['input_name'] : '{input_name}';
    $element_data = isset($parameters['element_data']) ? $parameters['element_data'] : array();
    $element_index = isset($parameters['index']) ? $parameters['index'] : '';

    $wrapper_html = isset($element_data['wrapper_html']) ? $element_data['wrapper_html'] : '';
    $color = isset($element_data['color']) ? $element_data['color'] : '';

    $font_size = isset($element_data['font_size']) ? $element_data['font_size'] : '';
    $font_family = isset($element_data['font_family']) ? $element_data['font_family'] : '';
    $margin = isset($element_data['margin']) ? $element_data['margin'] : '';
    $text_align = isset($element_data['text_align']) ? $element_data['text_align'] : '';
    $padding = isset($element_data['padding']) ? $element_data['padding'] : '';
    $float = isset($element_data['float']) ? $element_data['float'] : '';
    ?>
    <div class="item">
        <div class="element-title header ">
            <span class="remove" onclick="jQuery(this).parent().parent().remove()"><i class="fas fa-times"></i></span>
            <span class="sort"><i class="fas fa-sort"></i></span>

            <span class="expand"><?php echo __('Company name','testimonial'); ?></span>
        </div>
        <div class="element-options options">

            <?php



            $args = array(
                'id'		=> 'wrapper_html',
                'css_id'		=> $element_index.'_wrapper_html',
                'parent' => $input_name.'[company_name]',
                'title'		=> __('Wrapper html','testimonial'),
                'details'	=> __('Write wrapper html, use <code>%s</code> to replace price output.','testimonial'),
                'type'		=> 'text',
                'value'		=> $wrapper_html,
                'default'		=> '',
                'placeholder'		=> 'Company: %s',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'color',
                'css_id'		=> $element_index.'_color',
                'parent' => $input_name.'[company_name]',
                'title'		=> __('Text Color','testimonial'),
                'details'	=> __('Choose text color.','testimonial'),
                'type'		=> 'colorpicker',
                'value'		=> $color,
                'default'		=> '',
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'margin',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[company_name]',
                'title'		=> __('Margin','testimonial'),
                'details'	=> __('Set margin.','testimonial'),
                'type'		=> 'text',
                'value'		=> $margin,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'font_size',
                'css_id'		=> $element_index.'_font_size',
                'parent' => $input_name.'[company_name]',
                'title'		=> __('Font size','testimonial'),
                'details'	=> __('Set font size.','testimonial'),
                'type'		=> 'text',
                'value'		=> $font_size,
                'default'		=> '',
                'placeholder'		=> '16px',
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'text_align',
                'css_id'		=> $element_index.'_text_align',
                'parent' => $input_name.'[company_name]',
                'title'		=> __('Text align','testimonial'),
                'details'	=> __('Choose text align.','testimonial'),
                'type'		=> 'select',
                'value'		=> $text_align,
                'default'		=> 'left',
                'args'		=> array('left'=> __('Left', 'testimonial'),'right'=> __('Right', 'testimonial'),'center'=> __('Center', 'testimonial') ),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'padding',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[company_name]',
                'title'		=> __('Padding','testimonial'),
                'details'	=> __('Set padding.','testimonial'),
                'type'		=> 'text',
                'value'		=> $padding,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'float',
                'css_id'		=> $element_index.'_float',
                'parent' => $input_name.'[company_name]',
                'title'		=> __('Float','testimonial'),
                'details'	=> __('Choose float.','testimonial'),
                'type'		=> 'select',
                'value'		=> $float,
                'default'		=> 'none',
                'args'		=> array(
                    'none'=>__('None','testimonial'),
                    'left'=>__('Left','testimonial'),
                    'right'=>__('Right','testimonial'),
                    'inherit'=>__('Inherit','testimonial'),
                ),
            );

            $settings_tabs_field->generate_field($args);



            ?>

        </div>
    </div>
    <?php

}



add_action('testimonial_layout_elements_option_position','testimonial_layout_elements_option_position');


function testimonial_layout_elements_option_position($parameters){

    $settings_tabs_field = new pickp_settings_tabs_field();

    $input_name = isset($parameters['input_name']) ? $parameters['input_name'] : '{input_name}';
    $element_data = isset($parameters['element_data']) ? $parameters['element_data'] : array();
    $element_index = isset($parameters['index']) ? $parameters['index'] : '';


    $color = isset($element_data['color']) ? $element_data['color'] : '';
    $font_size = isset($element_data['font_size']) ? $element_data['font_size'] : '';
    $font_family = isset($element_data['font_family']) ? $element_data['font_family'] : '';
    $margin = isset($element_data['margin']) ? $element_data['margin'] : '';
    $text_align = isset($element_data['text_align']) ? $element_data['text_align'] : '';
    $padding = isset($element_data['padding']) ? $element_data['padding'] : '';
    $float = isset($element_data['float']) ? $element_data['float'] : '';
    $custom_css = isset($element_data['custom_css']) ? $element_data['custom_css'] : '';
    $custom_css_hover = isset($element_data['custom_css_hover']) ? $element_data['custom_css_hover'] : '';



    ?>
    <div class="item">
        <div class="element-title header ">
            <span class="remove" onclick="jQuery(this).parent().parent().remove()"><i class="fas fa-times"></i></span>
            <span class="sort"><i class="fas fa-sort"></i></span>

            <span class="expand"><?php echo __('Position','testimonial'); ?></span>
        </div>
        <div class="element-options options">

            <?php

            $args = array(
                'id'		=> 'color',
                'css_id'		=> $element_index.'_position',
                'parent' => $input_name.'[position]',
                'title'		=> __('Color','testimonial'),
                'details'	=> __('Title text color.','testimonial'),
                'type'		=> 'colorpicker',
                'value'		=> $color,
                'default'		=> '',
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'font_size',
                'css_id'		=> $element_index.'_font_size',
                'parent' => $input_name.'[position]',
                'title'		=> __('Font size','testimonial'),
                'details'	=> __('Set font size.','testimonial'),
                'type'		=> 'text',
                'value'		=> $font_size,
                'default'		=> '',
                'placeholder'		=> '14px',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'font_family',
                'css_id'		=> $element_index.'_font_family',
                'parent' => $input_name.'[position]',
                'title'		=> __('Font family','testimonial'),
                'details'	=> __('Set font family.','testimonial'),
                'type'		=> 'text',
                'value'		=> $font_family,
                'default'		=> '',
                'placeholder'		=> 'Open Sans',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'margin',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[position]',
                'title'		=> __('Margin','testimonial'),
                'details'	=> __('Set margin.','testimonial'),
                'type'		=> 'text',
                'value'		=> $margin,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'text_align',
                'css_id'		=> $element_index.'_text_align',
                'parent' => $input_name.'[position]',
                'title'		=> __('Text align','testimonial'),
                'details'	=> __('Choose text align.','testimonial'),
                'type'		=> 'select',
                'value'		=> $text_align,
                'default'		=> 'left',
                'args'		=> array('left'=> __('Left', 'testimonial'),'right'=> __('Right', 'testimonial'),'center'=> __('Center', 'testimonial') ),
            );

            $settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'padding',
                'css_id'		=> $element_index.'_margin',
                'parent' => $input_name.'[position]',
                'title'		=> __('Padding','testimonial'),
                'details'	=> __('Set padding.','testimonial'),
                'type'		=> 'text',
                'value'		=> $padding,
                'default'		=> '',
                'placeholder'		=> '5px 0',
            );

            $settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'float',
                'css_id'		=> $element_index.'_float',
                'parent' => $input_name.'[position]',
                'title'		=> __('Float','testimonial'),
                'details'	=> __('Choose float.','testimonial'),
                'type'		=> 'select',
                'value'		=> $float,
                'default'		=> 'none',
                'args'		=> array(
                    'none'=>__('None','testimonial'),
                    'left'=>__('Left','testimonial'),
                    'right'=>__('Right','testimonial'),
                    'inherit'=>__('Inherit','testimonial'),
                ),
            );

            $settings_tabs_field->generate_field($args);



            ob_start();
            ?>
            <textarea readonly type="text"  onclick="this.select();">.element-<?php echo esc_attr($element_index); ?>{}</textarea>
            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'use_css',
                'title'		=> __('Use of CSS','testimonial'),
                'details'	=> __('Use following class selector to add custom CSS for this element.','testimonial'),
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);

            ?>

        </div>
    </div>
    <?php

}








