<?php
if ( ! defined('ABSPATH')) exit;  // if direct access




$testimonials_fields = array(

    array(
        'id'		=> 'name',
        'parent'		=> 'testimonial_data',
        'title'		=> __('Name','testimonial'),
        'details'	=> __('Write name here.','testimonial'),
        'type'		=> 'text',
        'value'		=> '',
        'default'		=> '',
        'placeholder'		=> 'Mark Jhon',
    ),
    array(
        'id'		=> 'content',
        'parent'		=> 'testimonial_data',
        'title'		=> __('Content','testimonial'),
        'details'	=> __('Write details text here.','testimonial'),
        'type'		=> 'textarea',
        'value'		=> '',
        'default'		=> '',
        'placeholder'		=> 'Testimonial content here...',
    ),
    array(
        'id'		    => 'thumbnail',
        'parent'		=> 'testimonial_data',
        'title'		    => __('Thumbnail ','text-domain'),
        'details'	    => __('Add thumbnail','text-domain'),
        'placeholder'	=> '',
        'type'		=> 'media',
    ),
    array(
        'id'		=> 'company_name',
        'parent'		=> 'testimonial_data',
        'title'		=> __('Company Name','testimonial'),
        'details'	=> __('Write company name here.','testimonial'),
        'type'		=> 'text',
        'value'		=> '',
        'default'		=> '',
        'placeholder'		=> 'My Company',
    ),

    array(
        'id'		=> 'position',
        'parent'		=> 'testimonial_data',
        'title'		=> __('Position','testimonial'),
        'details'	=> __('Write position here.','testimonial'),
        'type'		=> 'text',
        'value'		=> '',
        'default'		=> '',
        'placeholder'		=> 'Lead Developer',
    ),
    array(
        'id'		=> 'rating',
        'parent'		=> 'testimonial_data',
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


$testimonials_fields = apply_filters('testimonials_form_fields', $testimonials_fields);


$testimonials = array();
$update_status = false;

$pickp_settings_tabs_field = new pickp_settings_tabs_field();



$nonce = isset($_POST['_wpnonce']) ? sanitize_text_field($_POST['_wpnonce']) : '';

if(wp_verify_nonce( $nonce, 'nonce_layout_content' )) {


    $testimonial_options = get_post_meta($post_id, 'testimonial_options', true);
    $testimonials = isset($testimonial_options['testimonials']) ? $testimonial_options['testimonials'] : array();

    $testimonial_data = isset($_POST['testimonial_data']) ? pickplugins_testimonial_sanitize_arr($_POST['testimonial_data']) : '';

    $testimonial_data_new = array();
    $allowed_html = array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
    );

    foreach ($testimonial_data as $data_key => $dataVal):

        $testimonial_data_new[$data_key] = esc_html($dataVal);

    endforeach;



    $testimonials[time()] =  $testimonial_data_new;


    $testimonial_options['testimonials'] = $testimonials;


    //echo '<pre>'.var_export($testimonial_options, true).'</pre>';

    update_post_meta($post_id, 'testimonial_options', $testimonial_options);

    $update_status = true;
    ?>


    <?php




}


?>



<div class="testimonial-form-wrap settings-tabs" id="testimonial-form-wrap">

    <p>
        <?php
        if($update_status):
            ?>
            Thanks for your reviews.
            <?php



        endif;
        ?>
    </p>


    <form method="post" action="">

        <input type="hidden" value="<?php echo esc_attr($post_id); ?>">
        <?php

        foreach ($testimonials_fields as $fieldArgs){
            $pickp_settings_tabs_field->generate_field($fieldArgs);
        }

        ?>
        <p>
            <input type="submit" name="Submit">
            <?php wp_nonce_field( 'nonce_layout_content' ); ?>
        </p>
    </form>



</div>
<?php

wp_enqueue_style( 'settings-tabs' );
wp_enqueue_script( 'settings-tabs' );

$pickp_settings_tabs_field = new pickp_settings_tabs_field();
$pickp_settings_tabs_field->admin_scripts();

//include testimonial_plugin_dir.'/templates/scripts.php';
