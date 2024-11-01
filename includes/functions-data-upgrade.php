<?php
if ( ! defined('ABSPATH')) exit;  // if direct access


//add_action('testimonial_install', 'testimonial_install_data_update');

add_shortcode('testimonial_data_update', 'testimonial_data_update');


function testimonial_data_update(){

    $testimonial_options = array();

    $testimonial_data_update = get_option('testimonial_data_update');


    if($testimonial_data_update == 'yes'){
        //return;

    }


    $args = array(
        'post_type'=>'testimonial_template',
        'post_status'=>'publish',
        'posts_per_page'=> 10,

    );

    $layout_array = array();


    $wp_query = new WP_Query($args);

    $testimonialData = array();

    if ( $wp_query->have_posts() ) :
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $post_id = get_the_id();
            $custom_scripts = array();
            $layout_elements_data = array();


            //echo '<pre>'.var_export($post_id, true).'</pre>';
            $layout_options = get_post_meta($post_id,'layout_options', true);
            $layout_preview_img = isset($layout_options['layout_preview_img']) ? $layout_options['layout_preview_img'] : '';


            $testimonial_options = get_post_meta($post_id,'testimonial_options', true);

            $layout_items = isset($testimonial_options['layout_items']) ? $testimonial_options['layout_items'] : array();
            $template_css = isset($testimonial_options['template_css']) ? $testimonial_options['template_css'] : '';
            $template_html = isset($testimonial_options['template_html']) ? $testimonial_options['template_html'] : '';

            $layout_elements_data[0]['wrapper_start']['wrapper_id'] = '';
            $layout_elements_data[0]['wrapper_start']['wrapper_class'] = 'item-wrap';


            $i = 1;

            foreach ($layout_items as $itemIndex => $item):
                //echo '<pre>'.var_export($itemIndex, true).'</pre>';
                //echo '<pre>'.var_export($item, true).'</pre>';

                $layout_elements_data[$i][$itemIndex]['font_size'] = isset($item['style']['font-size']) ? $item['style']['font-size'] : '';
                $layout_elements_data[$i][$itemIndex]['color'] = isset($item['style']['color']) ? $item['style']['color'] : '';
                $layout_elements_data[$i][$itemIndex]['text_align'] = isset($item['style']['text-align']) ? $item['style']['text-align'] : '';

                $layout_elements_data[$i][$itemIndex]['margin'] = isset($item['style']['margin']) ? $item['style']['margin'] : '';
                $layout_elements_data[$i][$itemIndex]['padding'] = isset($item['style']['padding']) ? $item['style']['padding'] : '';
                $layout_elements_data[$i][$itemIndex]['float'] = isset($item['style']['float']) ? $item['style']['float'] : '';
                $layout_elements_data[$i][$itemIndex]['background_color'] = isset($item['style']['background-color']) ? $item['style']['background-color'] : '';
                $layout_elements_data[$i][$itemIndex]['border_radius'] = isset($item['style']['border-radius']) ? $item['style']['border-radius'] : '';

                if($itemIndex == 'thumbnail'){

                    $layout_elements_data[$i][$itemIndex]['thumb_size']['large'] =  'large';



                    $layout_elements_data[$i][$itemIndex]['thumb_width']['large'] = isset($item['style']['width']) ? $item['style']['width'] : '';
                    $layout_elements_data[$i][$itemIndex]['thumb_width']['medium'] = isset($item['style']['width']) ? $item['style']['width'] : '';
                    $layout_elements_data[$i][$itemIndex]['thumb_width']['small'] = isset($item['style']['width']) ? $item['style']['width'] : '';

                    $layout_elements_data[$i][$itemIndex]['thumb_height']['large'] = isset($item['style']['height']) ? $item['style']['height'] : '';
                    $layout_elements_data[$i][$itemIndex]['thumb_height']['medium'] = isset($item['style']['height']) ? $item['style']['height'] : '';
                    $layout_elements_data[$i][$itemIndex]['thumb_height']['small'] = isset($item['style']['height']) ? $item['style']['height'] : '';

                }





                $i++;

            endforeach;

            $layout_elements_data[$i+1]['wrapper_end']['wrapper_id'] = '';


            $custom_scripts['custom_css'] = $template_css;

            $layout_array[$post_id]['custom_scripts']['custom_css'] = $template_css;
            $layout_array[$post_id]['custom_scripts']['custom_js'] = '';

            $layout_array[$post_id]['layout_elements_data'] = $layout_elements_data;
            $layout_array[$post_id]['layout_options']['layout_preview_img'] = $layout_preview_img;

            echo '<pre>'.var_export($layout_elements_data, true).'</pre>';




            //update_post_meta($post_id,'layout_elements_data', $layout_elements_data);
            //update_post_meta($post_id,'layout_options', $layout_options);
            //update_post_meta($post_id,'custom_scripts', $custom_scripts);


        endwhile;
    endif;



    //echo '<pre>'.var_export(($layout_array), true).'</pre>';



    //update_option('testimonial_data_update', 'yes');

}




add_shortcode('testimonial_layout_json', 'testimonial_layout_json');


function testimonial_layout_json(){

    $testimonial_options = array();


    $args = array(
        'post_type'=>'testimonial_template',
        'post_status'=>'publish',
        'posts_per_page'=> 10,

    );

    $layout_array = array();


    $wp_query = new WP_Query($args);

    $testimonialData = array();

    if ( $wp_query->have_posts() ) :
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $post_id = get_the_id();
            $custom_scripts = array();
            $layout_elements_data = array();


            //echo '<pre>'.var_export($post_id, true).'</pre>';
            $layout_elements_data = get_post_meta($post_id,'layout_elements_data', true);
            $layout_options = get_post_meta($post_id,'layout_options', true);
            $custom_scripts = get_post_meta($post_id,'custom_scripts', true);




            $layout_array[$post_id]['custom_scripts'] = $custom_scripts;

            $layout_array[$post_id]['layout_elements_data'] = $layout_elements_data;
            $layout_array[$post_id]['layout_options'] = $layout_options;


        endwhile;

        ?>
        <?php echo '<pre>'.var_export(json_encode($layout_array), true).'</pre>'; ?>
        <?php


    endif;


}

//add_shortcode('testimonial_import_templates', 'testimonial_import_templates');
add_action('testimonial_activation', 'testimonial_import_templates');

function testimonial_import_templates(){

    $testimonial_plugin_info = get_option('testimonial_plugin_info');
    $import_layouts = !empty($testimonial_plugin_info['import_layouts']) ? $testimonial_plugin_info['import_layouts'] : '';

    if($import_layouts == 'done') return;

    $testimonial_plugin_info['import_layouts'] = 'running';
    update_option('testimonial_plugin_info', $testimonial_plugin_info);

    $json = '{"51372":{"custom_scripts":{"custom_css":"","custom_js":""},"layout_elements_data":{"1586678037748":{"wrapper_start":{"wrapper_id":"","wrapper_class":"","css_idle":"","margin":"","padding":"","float":"left"}},"1586678040531":{"name":{"color":"","font_size":"18px","font_family":"","margin":"","padding":"","text_align":"center","float":"none"}},"1586678043641":{"position":{"color":"","font_size":"14px","font_family":"","margin":"","text_align":"center","padding":"","float":"none"}},"1586678044082":{"company_name":{"wrapper_html":"","color":"","margin":"","font_size":"14px","text_align":"center","padding":"","float":"none"}},"1586678044930":{"rating":{"rating_type":"five_star","wrapper_html":"","margin":"","color":"#f4bc22","text_align":"center","font_size":"","padding":"","float":"none"}},"1586678039554":{"thumbnail":{"thumb_size":"large","thumb_width":{"large":"90px","medium":"90px","small":"90px"},"thumb_height":{"large":"90px","medium":"90px","small":"90px"},"default_thumb_src":"","margin":"0 auto","border_radius":"50%","padding":"","float":"none"}},"1586678048313":{"content":{"word_count":"15","color":"#ffffff","background_color":"#1e73be","font_size":"","font_family":"","text_align":"left","margin":"15px 0 0  0 ","padding":"10px","float":"none","clear":"none","arrow_position":"top-middle"}},"1586678049083":{"wrapper_end":{"wrapper_id":""}}},"layout_options":{"layout_preview_img":""}},"51370":{"custom_scripts":{"custom_css":"","custom_js":""},"layout_elements_data":{"1586678037748":{"wrapper_start":{"wrapper_id":"","wrapper_class":"","css_idle":"","margin":"","padding":"","float":"left"}},"1586678048313":{"content":{"word_count":"15","color":"#ffffff","background_color":"#1e73be","font_size":"","font_family":"","text_align":"left","margin":"0 0 15px 0 ","padding":"10px","float":"none","clear":"none","arrow_position":"bottom-middle"}},"1586678039554":{"thumbnail":{"thumb_size":"large","thumb_width":{"large":"90px","medium":"90px","small":"90px"},"thumb_height":{"large":"90px","medium":"90px","small":"90px"},"default_thumb_src":"","margin":"0 auto","border_radius":"50%","padding":"","float":"none"}},"1586678040531":{"name":{"color":"","font_size":"18px","font_family":"","margin":"","padding":"","text_align":"center","float":"none"}},"1586678043641":{"position":{"color":"","font_size":"14px","font_family":"","margin":"","text_align":"center","padding":"","float":"none"}},"1586678044082":{"company_name":{"wrapper_html":"","color":"","margin":"","font_size":"14px","text_align":"center","padding":"","float":"none"}},"1586678044930":{"rating":{"rating_type":"five_star","wrapper_html":"","margin":"","color":"#f4bc22","text_align":"center","font_size":"","padding":"","float":"none"}},"1586678049083":{"wrapper_end":{"wrapper_id":""}}},"layout_options":{"layout_preview_img":""}},"51368":{"custom_scripts":{"custom_css":"","custom_js":""},"layout_elements_data":{"1586678037748":{"wrapper_start":{"wrapper_id":"","wrapper_class":"","css_idle":"","margin":"","padding":"","float":"left"}},"1586678039554":{"thumbnail":{"thumb_size":"large","thumb_width":{"large":"90px","medium":"90px","small":"90px"},"thumb_height":{"large":"90px","medium":"90px","small":"90px"},"default_thumb_src":"","margin":"","border_radius":"50%","padding":"","float":"right"}},"1586678048313":{"content":{"word_count":"15","color":"#ffffff","background_color":"#1e73be","font_size":"","font_family":"","text_align":"left","margin":"0 110px 0px 0","padding":"10px","float":"none","clear":"none","arrow_position":"right-top"}},"1586678040531":{"name":{"color":"","font_size":"18px","font_family":"","margin":"0 110px 0px 0px ","padding":"","text_align":"right","float":"none"}},"1586678043641":{"position":{"color":"","font_size":"14px","font_family":"","margin":"0 110px 0px 0px ","text_align":"right","padding":"","float":"none"}},"1586678044082":{"company_name":{"wrapper_html":"","color":"","margin":"0 110px 0px 0px ","font_size":"14px","text_align":"right","padding":"","float":"none"}},"1586678044930":{"rating":{"rating_type":"five_star","wrapper_html":"","margin":"0 110px 0px 0px ","color":"#f4bc22","text_align":"right","font_size":"","padding":"","float":"none"}},"1586678049083":{"wrapper_end":{"wrapper_id":""}}},"layout_options":{"layout_preview_img":""}},"51367":{"custom_scripts":{"custom_css":"","custom_js":""},"layout_elements_data":{"1586678037748":{"wrapper_start":{"wrapper_id":"","wrapper_class":"","css_idle":"","margin":"","padding":"","float":"left"}},"1586678039554":{"thumbnail":{"thumb_size":"large","thumb_width":{"large":"90px","medium":"90px","small":"90px"},"thumb_height":{"large":"90px","medium":"90px","small":"90px"},"default_thumb_src":"","margin":"0 15px 0 0","border_radius":"50%","padding":"","float":"left"}},"1586678048313":{"content":{"word_count":"15","color":"#ffffff","background_color":"#1e73be","font_size":"","font_family":"","text_align":"left","margin":"0 0px 0px 110px","padding":"10px","float":"none","clear":"none","arrow_position":"left-top"}},"1586678040531":{"name":{"color":"","font_size":"18px","font_family":"","margin":"0 0px 0px 110px","padding":"","text_align":"left","float":"none"}},"1586678043641":{"position":{"color":"","font_size":"14px","font_family":"","margin":"0 0px 0px 110px","text_align":"left","padding":"","float":"none"}},"1586678044082":{"company_name":{"wrapper_html":"","color":"","margin":"0 0px 0px 110px","font_size":"14px","text_align":"left","padding":"","float":"none"}},"1586678044930":{"rating":{"rating_type":"five_star","wrapper_html":"","margin":"0 0px 0px 110px","color":"#f4bc22","text_align":"left","font_size":"","padding":"","float":"none"}},"1586678049083":{"wrapper_end":{"wrapper_id":""}}},"layout_options":{"layout_preview_img":""}},"51362":{"custom_scripts":{"custom_css":"","custom_js":""},"layout_elements_data":{"1586678037748":{"wrapper_start":{"wrapper_id":"","wrapper_class":"","css_idle":"","margin":"","padding":"","float":"left"}},"1586678048313":{"content":{"word_count":"15","color":"#ffffff","background_color":"#1e73be","font_size":"","font_family":"","text_align":"left","margin":" 0 0 15px 0  ","padding":"10px","float":"left","clear":"left","arrow_position":"bottom-right"}},"1586678039554":{"thumbnail":{"thumb_size":"large","thumb_width":{"large":"90px","medium":"90px","small":"90px"},"thumb_height":{"large":"90px","medium":"90px","small":"90px"},"default_thumb_src":"","margin":"0  0  0 15px","border_radius":"50%","padding":"","float":"right"}},"1586678040531":{"name":{"color":"","font_size":"18px","font_family":"","margin":"","padding":"","text_align":"right","float":"none"}},"1586678043641":{"position":{"color":"","font_size":"14px","font_family":"","margin":"","text_align":"right","padding":"","float":"none"}},"1586678044082":{"company_name":{"wrapper_html":"","color":"","margin":"","font_size":"14px","text_align":"right","padding":"","float":"none"}},"1586678044930":{"rating":{"rating_type":"five_star","wrapper_html":"","margin":"","color":"#f4bc22","text_align":"right","font_size":"","padding":"","float":"none"}},"1586678049083":{"wrapper_end":{"wrapper_id":""}}},"layout_options":{"layout_preview_img":""}},"51363":{"custom_scripts":{"custom_css":"","custom_js":""},"layout_elements_data":{"1586678037748":{"wrapper_start":{"wrapper_id":"","wrapper_class":"","css_idle":"","margin":"","padding":"","float":"left"}},"1586678048313":{"content":{"word_count":"15","color":"#ffffff","background_color":"#1e73be","font_size":"","font_family":"","text_align":"left","margin":"0 0 15px 0 ","padding":"10px","float":"left","clear":"left","arrow_position":"bottom-left"}},"1586678039554":{"thumbnail":{"thumb_size":"large","thumb_width":{"large":"90px","medium":"90px","small":"90px"},"thumb_height":{"large":"90px","medium":"90px","small":"90px"},"default_thumb_src":"","margin":"0 15px 0 0","border_radius":"50%","padding":"","float":"left"}},"1586678040531":{"name":{"color":"","font_size":"18px","font_family":"","margin":"","padding":"","text_align":"left","float":"none"}},"1586678043641":{"position":{"color":"","font_size":"14px","font_family":"","margin":"","text_align":"left","padding":"","float":"none"}},"1586678044082":{"company_name":{"wrapper_html":"","color":"","margin":"","font_size":"14px","text_align":"left","padding":"","float":"none"}},"1586678044930":{"rating":{"rating_type":"five_star","wrapper_html":"","margin":"","color":"#f4bc22","text_align":"left","font_size":"","padding":"","float":"none"}},"1586678049083":{"wrapper_end":{"wrapper_id":""}}},"layout_options":{"layout_preview_img":""}},"51361":{"custom_scripts":{"custom_css":"","custom_js":""},"layout_elements_data":{"1586678037748":{"wrapper_start":{"wrapper_id":"","wrapper_class":"","css_idle":"","margin":"","padding":"","float":"left"}},"1586678039554":{"thumbnail":{"thumb_size":"large","thumb_width":{"large":"90px","medium":"90px","small":"90px"},"thumb_height":{"large":"90px","medium":"90px","small":"90px"},"default_thumb_src":"","margin":"0  0  0 15px","border_radius":"50%","padding":"","float":"right"}},"1586678040531":{"name":{"color":"","font_size":"18px","font_family":"","margin":"","padding":"","text_align":"right","float":"none"}},"1586678043641":{"position":{"color":"","font_size":"14px","font_family":"","margin":"","text_align":"right","padding":"","float":"none"}},"1586678044082":{"company_name":{"wrapper_html":"","color":"","margin":"","font_size":"14px","text_align":"right","padding":"","float":"none"}},"1586678044930":{"rating":{"rating_type":"five_star","wrapper_html":"","margin":"","color":"#f4bc22","text_align":"right","font_size":"","padding":"","float":"none"}},"1586678048313":{"content":{"word_count":"15","color":"#ffffff","background_color":"#1e73be","font_size":"","font_family":"","text_align":"left","margin":"15px 0 0 0 ","padding":"10px","float":"left","clear":"left","arrow_position":"top-right"}},"1586678049083":{"wrapper_end":{"wrapper_id":""}}},"layout_options":{"layout_preview_img":""}},"47430":{"custom_scripts":{"custom_css":"","custom_js":""},"layout_elements_data":{"1586678037748":{"wrapper_start":{"wrapper_id":"","wrapper_class":"","css_idle":"","margin":"","padding":"","float":"left"}},"1586678039554":{"thumbnail":{"thumb_size":"large","thumb_width":{"large":"90px","medium":"90px","small":"90px"},"thumb_height":{"large":"90px","medium":"90px","small":"90px"},"default_thumb_src":"","margin":"0 15px 0 0","border_radius":"50%","padding":"","float":"left"}},"1586678040531":{"name":{"color":"","font_size":"18px","font_family":"","margin":"","padding":"","text_align":"left","float":"none"}},"1586678043641":{"position":{"color":"","font_size":"14px","font_family":"","margin":"","text_align":"left","padding":"","float":"none"}},"1586678044082":{"company_name":{"wrapper_html":"","color":"","margin":"","font_size":"14px","text_align":"left","padding":"","float":"none"}},"1586678044930":{"rating":{"rating_type":"five_star","wrapper_html":"","margin":"","color":"#f4bc22","text_align":"left","font_size":"","padding":"","float":"none"}},"1586678048313":{"content":{"word_count":"15","color":"#ffffff","background_color":"#1e73be","font_size":"","font_family":"","text_align":"left","margin":"15px 0 0 0 ","padding":"10px","float":"left","clear":"left","arrow_position":"top-left"}},"1586678049083":{"wrapper_end":{"wrapper_id":""}}},"layout_options":{"layout_preview_img":""}}}';


    $json_array = json_decode($json);


    foreach ($json_array as $post_id=>$post){


        $custom_scripts = $post->custom_scripts;
        $layout_elements_data = $post->layout_elements_data;
        $layout_options = $post->layout_options;


        $post_data = array();


        $template_id = wp_insert_post(
            array(
                'post_title'    => 'Template '.$post_id,
                'post_content'  => '',
                'post_status'   => 'publish',
                'post_type'   	=> 'testimonial_template',
                'post_author'   => 1,
            )
        );

        $array = json_decode(json_encode($layout_elements_data), true);

        //echo '<pre>'.var_export(($array), true).'</pre>';

        $custom_scripts_new['custom_js'] = $custom_scripts->custom_js;
        $custom_scripts_new['custom_css'] = $custom_scripts->custom_css;
        $layout_options_new['layout_preview_img'] = $layout_options->layout_preview_img;

        update_post_meta($template_id, 'layout_elements_data', $array);

        update_post_meta($template_id, 'custom_scripts', $custom_scripts_new);
        update_post_meta($template_id, 'layout_options', $layout_options_new);




        //return;

    }

    $testimonial_plugin_info['import_layouts'] = 'done';
    update_option('testimonial_plugin_info', $testimonial_plugin_info);

}
		

		
		