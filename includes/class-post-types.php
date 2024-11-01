<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

class class_testimonial_post_types{
	
	
	public function __construct(){
		add_action( 'init', array( $this, '_posttype_testimonial' ), 0 );
        add_action( 'init', array( $this, '_posttype_testimonial_template' ), 0 );

    }
	
	
	public function _posttype_testimonial(){
			
		if ( post_type_exists( "testimonial" ) )
		return;
	 
		$singular  = __( 'Testimonial', 'testimonial' );
		$plural    = __( 'Testimonial', 'testimonial' );
        $testimonial_settings = get_option('testimonial_settings');
        $testimonial_preview = isset($testimonial_settings['testimonial_preview']) ? $testimonial_settings['testimonial_preview'] : 'yes';


        register_post_type( "testimonial",
			apply_filters( "testimonial_posttype_testimonial", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => $singular,
					'all_items'             => sprintf( __( 'All %s', 'testimonial' ), $plural ),
					'add_new' 				=> __( 'Add New', 'testimonial' ),
					'add_new_item' 			=> sprintf( __( 'Add %s', 'testimonial' ), $singular ),
					'edit' 					=> __( 'Edit', 'testimonial' ),
					'edit_item' 			=> sprintf( __( 'Edit %s', 'testimonial' ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', 'testimonial' ), $singular ),
					'view' 					=> sprintf( __( 'View %s', 'testimonial' ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', 'testimonial' ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', 'testimonial' ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', 'testimonial' ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', 'testimonial' ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', 'testimonial' ), $singular )
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', 'testimonial' ), $plural ),
				'public' 				=> false,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'map_meta_cap'          => true,
				'publicly_queryable' 	=> ($testimonial_preview =='yes') ?true : false,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'query_var' 			=> true,
				'supports' 				=> array( 'title' ),
				'show_in_nav_menus' 	=> false,
				'menu_icon' => 'dashicons-star-half',

			) )
		); 

	}




    public function _posttype_testimonial_template(){

        if ( post_type_exists( "testimonial_template" ) )
            return;

        $singular  = __( 'Template', 'testimonial' );
        $plural    = __( 'Templates', 'testimonial' );


        register_post_type( "testimonial_template",
            apply_filters( "testimonial_posttype_testimonial_template", array(
                'labels' => array(
                    'name' 					=> $plural,
                    'singular_name' 		=> $singular,
                    'menu_name'             => $singular,
                    'all_items'             => sprintf( __( 'All %s', 'testimonial' ), $plural ),
                    'add_new' 				=> __( 'Add New', 'testimonial' ),
                    'add_new_item' 			=> sprintf( __( 'Add %s', 'testimonial' ), $singular ),
                    'edit' 					=> __( 'Edit', 'testimonial' ),
                    'edit_item' 			=> sprintf( __( 'Edit %s', 'testimonial' ), $singular ),
                    'new_item' 				=> sprintf( __( 'New %s', 'testimonial' ), $singular ),
                    'view' 					=> sprintf( __( 'View %s', 'testimonial' ), $singular ),
                    'view_item' 			=> sprintf( __( 'View %s', 'testimonial' ), $singular ),
                    'search_items' 			=> sprintf( __( 'Search %s', 'testimonial' ), $plural ),
                    'not_found' 			=> sprintf( __( 'No %s found', 'testimonial' ), $plural ),
                    'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', 'testimonial' ), $plural ),
                    'parent' 				=> sprintf( __( 'Parent %s', 'testimonial' ), $singular )
                ),
                'description' => sprintf( __( 'This is where you can create and manage %s.', 'testimonial' ), $plural ),
                'public' 				=> false,
                'show_ui' 				=> true,
                'capability_type' 		=> 'post',
                'map_meta_cap'          => true,
                'publicly_queryable' 	=> false,
                'exclude_from_search' 	=> false,
                'hierarchical' 			=> false,
                'query_var' 			=> true,
                'supports' 				=> array( 'title' ),
                'show_in_nav_menus' 	=> false,
                'show_in_menu' 	=> 'edit.php?post_type=testimonial',
                'menu_icon' => 'dashicons-businessman',

            ) )
        );

    }







}
	

new class_testimonial_post_types();