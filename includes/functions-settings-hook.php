<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

add_action('testimonial_settings_content_general', 'testimonial_settings_content_general');

function testimonial_settings_content_general(){
    $settings_tabs_field = new pickp_settings_tabs_field();

    $testimonial_settings = get_option('testimonial_settings');

    $font_aw_version = isset($testimonial_settings['font_aw_version']) ? $testimonial_settings['font_aw_version'] : 'none';
    $testimonial_preview = isset($testimonial_settings['testimonial_preview']) ? $testimonial_settings['testimonial_preview'] : 'yes';

    //echo '<pre>'.var_export($testimonial_settings, true).'</pre>';

    ?>
    <div class="section">
        <div class="section-title"><?php echo __('General', 'testimonial'); ?></div>
        <p class="description section-description"><?php echo __('Choose some general options.', 'testimonial'); ?></p>

        <?php



        $args = array(
            'id'		=> 'font_aw_version',
            'parent'		=> 'testimonial_settings',
            'title'		=> __('Font-awesome version','testimonial'),
            'details'	=> __('Choose font awesome version you want to load.','testimonial'),
            'type'		=> 'select',
            'value'		=> $font_aw_version,
            'default'		=> '',
            'args'		=> array('v_5'=>__('Version 5+','testimonial'), 'v_4'=>__('Version 4+','testimonial'), 'none'=>__('None','testimonial')  ),
        );

        $settings_tabs_field->generate_field($args);

        $args = array(
            'id'		=> 'testimonial_preview',
            'parent'		=> 'testimonial_settings',
            'title'		=> __('Enable testimonial preview','testimonial'),
            'details'	=> __('You can enable preview testimonial.','testimonial'),
            'type'		=> 'select',
            'value'		=> $testimonial_preview,
            'default'		=> 'yes',
            'args'		=> array('yes'=>__('Yes','testimonial'), 'no'=>__('No','testimonial')  ),
        );

        $settings_tabs_field->generate_field($args);





        ?>

    </div>

    <?php





}


add_action('testimonial_settings_content_help_support', 'testimonial_settings_content_help_support');

if(!function_exists('testimonial_settings_content_help_support')) {
    function testimonial_settings_content_help_support($tab){

        $settings_tabs_field = new pickp_settings_tabs_field();

        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Get support', 'testimonial'); ?></div>
            <p class="description section-description"><?php echo __('Use following to get help and support from our expert team.', 'testimonial'); ?></p>

            <?php


            ob_start();
            ?>

            <p><?php echo __('Ask question for free on our forum and get quick reply from our expert team members.', 'testimonial'); ?></p>
            <a class="button" href="https://www.pickplugins.com/create-support-ticket/"><?php echo __('Create support ticket', 'testimonial'); ?></a>

            <p><?php echo __('Read our documentation before asking your question.', 'testimonial'); ?></p>
            <a class="button" href="http://pickplugins.com/documentation/testimonial"><?php echo __('Documentation', 'testimonial'); ?></a>

            <p><?php echo __('Watch video tutorials.', 'testimonial'); ?></p>
            <a class="button" href="https://www.youtube.com/playlist?list=PL0QP7T2SN94ZTgoALFf2SCotqoGWCNF2y"><i class="fab fa-youtube"></i> <?php echo __('All tutorials', 'testimonial'); ?></a>

            <ul>
<!--                <li><i class="far fa-dot-circle"></i> <a href="https://www.youtube.com/watch?v=kn3skEwh5t4&list=PL0QP7T2SN94bgierw1J8Qn3sf4mZo7F9f&index=2">Data migration</a></li>-->

            </ul>



            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'get_support',
                //'parent'		=> '',
                'title'		=> __('Ask question','testimonial'),
                'details'	=> '',
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);


            ob_start();
            ?>

            <p class="">We wish your 2 minutes to write your feedback about the <b>PickPlugins Product Slider</b> plugin. give us <span style="color: #ffae19"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></p>

            <a target="_blank" href="https://wordpress.org/plugins/testimonial/#reviews" class="button"><i class="fab fa-wordpress"></i> Write a review</a>


            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'reviews',
                //'parent'		=> '',
                'title'		=> __('Submit reviews','testimonial'),
                'details'	=> '',
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);


            ?>


        </div>
        <?php


    }
}






add_action('testimonial_settings_content_buy_pro', 'testimonial_settings_content_buy_pro');

if(!function_exists('testimonial_settings_content_buy_pro')) {
    function testimonial_settings_content_buy_pro($tab){

        $settings_tabs_field = new pickp_settings_tabs_field();


        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Get Premium', 'testimonial'); ?></div>
            <p class="description section-description"><?php echo __('Thanks for using our plugin, if you looking for some advance feature please buy premium version.', 'testimonial'); ?></p>

            <?php


            ob_start();
            ?>

            <p><?php echo __('If you love our plugin and want more feature please consider to buy pro version.', 'testimonial'); ?></p>
            <a class="button" href="https://www.pickplugins.com/item/testimonial-for-wordpress/?ref=dashobard"><?php echo __('Buy premium', 'testimonial'); ?></a>
            <a class="button" href="http://www.pickplugins.com/demo/testimonial/?ref=dashobard"><?php echo __('See all demo', 'testimonial'); ?></a>

            <h2><?php echo __('See the differences','testimonial'); ?></h2>

            <table class="pro-features">
                <thead>
                <tr>
                    <th class="col-features"><?php echo __('Features','testimonial'); ?></th>
                    <th class="col-free"><?php echo __('Free','testimonial'); ?></th>
                    <th class="col-pro"><?php echo __('Premium','testimonial'); ?></th>
                </tr>
                </thead>

                <tr>
                    <td class="col-features"><?php echo __('Query by product taxonomies','testimonial'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>

                <tr>
                    <td class="col-features"><?php echo __('Query by recently viewed products','testimonial'); ?> </td>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>



                <tr>
                    <th class="col-features"><?php echo __('Features','testimonial'); ?></th>
                    <th class="col-free"><?php echo __('Free','testimonial'); ?></th>
                    <th class="col-pro"><?php echo __('Premium','testimonial'); ?></th>
                </tr>
                <tr>
                    <td class="col-features"><?php echo __('Buy now','testimonial'); ?></td>
                    <td> </td>
                    <td><a class="button" href="https://www.pickplugins.com/item/woocommerce-products-slider-for-wordpress/?ref=dashobard"><?php echo __('Buy premium', 'testimonial'); ?></a></td>
                </tr>

            </table>



            <?php

            $html = ob_get_clean();

            $args = array(
                'id'		=> 'get_pro',
                'title'		=> __('Get pro version','testimonial'),
                'details'	=> '',
                'type'		=> 'custom_html',
                'html'		=> $html,

            );

            $settings_tabs_field->generate_field($args);


            ?>


        </div>

        <style type="text/css">
            .pro-features{
                margin: 30px 0;
                border-collapse: collapse;
                border: 1px solid #ddd;
            }
            .pro-features th{
                width: 120px;
                background: #ddd;
                padding: 10px;
            }
            .pro-features tr{
            }
            .pro-features td{
                border-bottom: 1px solid #ddd;
                padding: 10px 10px;
                text-align: center;
            }
            .pro-features .col-features{
                width: 230px;
                text-align: left;
            }

            .pro-features .col-free{
            }
            .pro-features .col-pro{
            }

            .pro-features i.fas.fa-check {
                color: #139e3e;
                font-size: 16px;
            }
            .pro-features i.fas.fa-times {
                color: #f00;
                font-size: 17px;
            }
        </style>
        <?php


    }
}









add_action('testimonial_settings_save', 'testimonial_settings_save');

function testimonial_settings_save(){

    $testimonial_settings = isset($_POST['testimonial_settings']) ?  pickplugins_testimonial_sanitize_arr($_POST['testimonial_settings']) : array();
    update_option('testimonial_settings', $testimonial_settings);
}
