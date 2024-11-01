<?php
if ( ! defined('ABSPATH')) exit;  // if direct access


add_action('testimonial_layout_metabox_content_custom_scripts','testimonial_layout_metabox_content_custom_scripts');

if(!function_exists('testimonial_layout_metabox_content_custom_scripts')){
    function testimonial_layout_metabox_content_custom_scripts($post_id){


        $pickp_settings_tabs_field = new pickp_settings_tabs_field();
        $custom_scripts = get_post_meta($post_id,'custom_scripts', true);
        $layout_options = get_post_meta($post_id,'layout_options', true);


        $custom_css = isset($custom_scripts['custom_css']) ? $custom_scripts['custom_css'] : '';
        $custom_js = isset($custom_scripts['custom_js']) ? $custom_scripts['custom_js'] : '';
        $layout_preview_img = isset($layout_options['layout_preview_img']) ? $layout_options['layout_preview_img'] : '';




        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Custom scripts', 'testimonial'); ?></div>
            <p class="description section-description"><?php echo __('Write custom scripts to override CSS and scripts.', 'testimonial'); ?></p>


            <?php
            $args = array(
                'id'		=> 'custom_css',
                'parent'		=> 'custom_scripts',
                'title'		=> __('Custom CSS','testimonial'),
                'details'	=> __('Write custom CSS to override default style, do not use <code>&lt;style>&lt;/style></code> tag. use <code>__ID__</code> to replace by layout id <code>layout-'.$post_id.'</code>.','testimonial'),
                'type'		=> 'scripts_css',
                'value'		=> $custom_css,
                'default'		=> '',
                'placeholder'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'custom_js',
                'parent'		=> 'custom_scripts',
                'title'		=> __('Custom JS','testimonial'),
                'details'	=> __('Write custom JS to override default style, do not use <code>&lt;script>&lt;/script></code> tag.','testimonial'),
                'type'		=> 'scripts_js',
                'value'		=> $custom_js,
                'default'		=> '',
                'placeholder'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'layout_preview_img',
                'parent'		=> 'layout_options',
                'title'		=> __('Preview image','testimonial'),
                'details'	=> __('Set layout preview image.','testimonial'),
                'type'		=> 'media_url',
                'value'		=> $layout_preview_img,
                'default'		=> '',
                'placeholder'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);





            ?>
        </div>
        <?php


    }

}








add_action('testimonial_layout_metabox_content_layout_builder','testimonial_layout_metabox_content_layout_builder');

if(!function_exists('testimonial_layout_metabox_content_layout_builder')){

    function testimonial_layout_metabox_content_layout_builder($post_id){


        $pickp_settings_tabs_field = new pickp_settings_tabs_field();

        $layout_elements_data = get_post_meta($post_id,'layout_elements_data', true);

        //echo '<pre>'.var_export(($layout_elements_data), true).'</pre>';


        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Layout builder', 'testimonial'); ?></div>
            <p class="description section-description"><?php echo __('Customize layout settings.', 'testimonial'); ?></p>

            <?php
            $layout_elements['wrapper_start'] = array('name' =>__('Wrapper start','testimonial'));
            $layout_elements['wrapper_end'] = array('name' =>__('Wrapper end','testimonial'));
            $layout_elements['custom_text'] = array('name' =>__('Custom text','testimonial'));


            $layout_elements['name'] = array('name' =>__('Name','testimonial'));
            $layout_elements['rating'] = array('name' =>__('Rating','testimonial'));
            $layout_elements['content'] = array('name' =>__('Content','testimonial'));
            $layout_elements['thumbnail'] = array('name' =>__('Thumbnail','testimonial'));
            $layout_elements['company_name'] = array('name' =>__('Company name','testimonial'));
            $layout_elements['position'] = array('name' =>__('Position','testimonial'));


            $layout_elements = apply_filters('testimonial_layout_elements', $layout_elements);


            $layout_elements_option = array();

            if(!empty($layout_elements))
            foreach ($layout_elements as $elementIndex => $element):

                ob_start();

                do_action('testimonial_layout_elements_option_'.$elementIndex);

                $layout_elements_option[$elementIndex] = ob_get_clean();

            endforeach;

            ob_start();

            ?>

            <script>
                jQuery(document).ready(function($){
                    layout_elements_option = <?php echo json_encode($layout_elements_option); ?>;

                    $(document).on('click','.layout-tags span',function(){
                        tag_id = $(this).attr('tag_id');
                        input_name = $(this).attr('input_name');
                        id = $.now();

                        console.log(id);

                        tag_options_html = layout_elements_option[tag_id];
                        var res = tag_options_html.replace("{input_name}", input_name+'['+id+']');

                        $(this).parent().parent().children('.elements').append(res);

                    })
                })
            </script>

            <div class="layout-builder">
                <div class="layout-tags">
                    <?php

                    if(!empty($layout_elements))
                    foreach ($layout_elements as $elementIndex => $element):
                        $element_name = isset($element['name']) ? $element['name'] : '';
                        ?>
                        <span input_name="<?php echo 'layout_elements_data'; ?>"  tag_id="<?php echo esc_attr($elementIndex); ?>"><?php echo $element_name; ?></span>
                    <?php

                    endforeach;

                    ?>
                </div>

                <div class="elements expandable sortable">

                    <?php

                    if(!empty($layout_elements_data)):
                        foreach ($layout_elements_data as $index => $item_data){
                            foreach ($item_data as $elementIndex => $element_data){

                                $args = array('input_name'=> 'layout_elements_data['.$index.']', 'element_data'=> $element_data, 'index'=>$index);
                                do_action('testimonial_layout_elements_option_'.$elementIndex, $args);
                            }


                        }
                    else:
                        ?>
                        <div class="empty-element">
                            <?php echo sprintf(__('%s Click to add tags.','testimonial'), '<i class="far fa-hand-point-up"></i>') ?>
                        </div>
                    <?php
                    endif;

                    ?>

                </div>


            </div>

            <style type="text/css">
                .layout-builder{}
                .layout-tags{
                    margin-bottom: 20px;
                    position: sticky;
                    top: 32px;
                    z-index: 999;
                    background: #fff;
                    padding: 5px 5px;
                    border-bottom: 1px solid #ddd;
                    overflow-y: scroll;
                }
                .layout-tags span{
                    background: #ddd;
                    padding: 4px 10px;
                    display: inline-block;
                    margin: 2px 2px;
                    border-radius: 3px;
                    border: 1px solid #b9b9b9;
                    cursor: pointer;
                }

                .layout-tags span:hover{
                    background: #b9b9b9;

                }

            </style>

            <?php

            $html = ob_get_clean();


            $args = array(
                'id'		=> 'layout_builder',
                //'parent'		=> '',
                'title'		=> __('Layout elements','testimonial'),
                'details'	=> __('Customize layout elements.','testimonial'),
                'type'		=> 'custom_html',
                'html'		=> $html,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);


            ob_start();



            $item_layout_id = get_the_id();
            $args['template_id'] = $item_layout_id;

            $testimonial_1st_testimonial = testimonial_1st_testimonial();


            //echo '<pre>'.var_export($testimonial_1st_testimonial, true).'</pre>';

            ?>
            <div class="layout-preview">

                <div class="elements-wrapper layout-<?php echo $item_layout_id; ?>">
                    <?php
                    if(!empty($layout_elements_data))
                    foreach ($layout_elements_data as $elementGroupIndex => $elementGroupData){
                        foreach ($elementGroupData as $elementIndex => $elementData){

                            //$args['post_id'] = $post_id;
                            $args['elementData'] = $elementData;
                            $args['element_index'] = $elementGroupIndex;
                            $args['testimonial'] = $testimonial_1st_testimonial;




                            do_action('testimonial_layout_element_'.$elementIndex, $args);
                        }
                    }

                    //echo '<pre>'.var_export($args, true).'</pre>';

                    ?>
                </div>







            </div>

            <?php

            if(!empty($layout_elements_data))
            foreach ($layout_elements_data as $elementGroupIndex => $elementGroupData){
                foreach ($elementGroupData as $elementIndex => $elementData){


                    $args['elementData'] = $elementData;
                    $args['element_index'] = $elementGroupIndex;

                    //echo $elementIndex;
                    do_action('testimonial_layout_element_css_'.$elementIndex, $args);
                }
            }

            $custom_scripts = get_post_meta($item_layout_id,'custom_scripts', true);
            $custom_css = isset($custom_scripts['custom_css']) ? $custom_scripts['custom_css'] : '';

            ?>
            <style type="text/css">
                .layout-preview{
                    background: url(<?php echo testimonial_plugin_url; ?>assets/admin/images/tile.png);
                    padding: 20px;
                }
                .layout-preview .elements-wrapper{
                    width: 400px;
                    overflow: hidden;
                    margin: 0 auto;
                }
                .layout-preview img{
                    width: 100%;
                    height: auto;
                }
                <?php
                echo str_replace('__ID__', 'layout-'.$item_layout_id, $custom_css);
                ?>
            </style>
            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'layout_preview',
                //'parent'		=> '',
                'title'		=> __('Layout preview','testimonial'),
                'details'	=> __('Layout preview','testimonial'),
                'type'		=> 'custom_html',
                'html'		=> $html,
                'default'		=> '',
            );

            $pickp_settings_tabs_field->generate_field($args);



            ?>
        </div>
        <?php


    }



}











add_action('testimonial_layout_metabox_save','testimonial_layout_metabox_save');

function testimonial_layout_metabox_save($job_id){

    $layout_options = isset($_POST['layout_options']) ? pickplugins_testimonial_sanitize_arr($_POST['layout_options']) : '';
    update_post_meta($job_id, 'layout_options', $layout_options);

    $layout_elements_data = isset($_POST['layout_elements_data']) ? pickplugins_testimonial_sanitize_arr($_POST['layout_elements_data']) : '';
    update_post_meta($job_id, 'layout_elements_data', $layout_elements_data);

    $custom_scripts = isset($_POST['custom_scripts']) ? pickplugins_testimonial_sanitize_arr($_POST['custom_scripts']) : '';
    update_post_meta($job_id, 'custom_scripts', $custom_scripts);

}

