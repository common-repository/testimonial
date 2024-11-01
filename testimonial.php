<?php
/*
Plugin Name: Testimonial
Plugin URI: http://pickplugins.com
Description: Display testimonial and reviews in a carousel slider.
Version: 2.0.12
Author: pickplugins
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined('ABSPATH')) exit;  // if direct access 


class testimonialPickplugins
{


    public function __construct()
    {

        define('testimonial_plugin_url', plugins_url('/', __FILE__));
        define('testimonial_plugin_dir', plugin_dir_path(__FILE__));
        define('testimonial_plugin_name', 'Testimonial');
        define('testimonial_version', '2.0.12');


        include('includes/class-shortcodes.php');
        include('includes/class-settings.php');
        include('includes/testimonial-meta-box.php');
        include('includes/functions.php');
        include('includes/functions-testimonial-meta-box.php');

        include('includes/class-metabox-testimonial-layout.php');
        include('includes/class-metabox-testimonial-layout-hook.php');
        include('includes/functions-layout-hook.php');
        include('includes/functions-layout-element.php');
        include('includes/functions-settings-hook.php');

        require_once(testimonial_plugin_dir . 'templates/testimonial.php');

        include('includes/class-post-types.php');

        include('includes/class-settings-tabs.php');


        include('includes/functions-data-upgrade.php');


        add_action('wp_enqueue_scripts', array($this, '_front_scripts'));
        add_action('admin_enqueue_scripts', array($this, '_admin_scripts'));
        add_action('admin_enqueue_scripts', 'wp_enqueue_media');

        add_action('plugins_loaded', array($this, '_load_textdomain'));

        register_activation_hook(__FILE__, array($this, '_activation'));
        register_deactivation_hook(__FILE__, array($this, '_deactivation'));
        //register_uninstall_hook( __FILE__, array( $this, '_uninstall' ) );
    }

    public function _load_textdomain()
    {

        $locale = apply_filters('plugin_locale', get_locale(), 'testimonial');
        load_textdomain('testimonial', WP_LANG_DIR . '/testimonial/testimonial-' . $locale . '.mo');

        load_plugin_textdomain('testimonial', false, plugin_basename(dirname(__FILE__)) . '/languages/');
    }

    public function _activation()
    {


        do_action('testimonial_activation');
    }

    public function _uninstall()
    {

        do_action('testimonial_uninstall');
    }

    public function _deactivation()
    {

        do_action('testimonial_deactivation');
    }



    public function _front_scripts()
    {

        wp_register_style('testimonial-style', testimonial_plugin_url . 'assets/frontend/css/style.css');
        wp_register_style('owl-carousel', testimonial_plugin_url . 'assets/frontend/css/owl.carousel.min.css');
        wp_register_style('owl-theme', testimonial_plugin_url . 'assets/frontend/css/owl.theme.default.css');

        wp_register_script('owl-carousel', testimonial_plugin_url . 'assets/frontend/js/owl.carousel.min.js', array('jquery'));


        wp_register_style('settings-tabs', testimonial_plugin_url . 'assets/settings-tabs/settings-tabs.css');
        wp_register_script('settings-tabs', testimonial_plugin_url . 'assets/settings-tabs/settings-tabs.js', array('jquery'));

        wp_register_style('font-awesome-4', testimonial_plugin_url . 'assets/global/css/font-awesome-4.css');
        wp_register_style('font-awesome-5', testimonial_plugin_url . 'assets/global/css/font-awesome-5.css');
    }


    public function _admin_scripts()
    {

        wp_enqueue_script('jquery');
        wp_register_style('testimonial-style', testimonial_plugin_url . 'assets/frontend/css/style.css');




        wp_register_style('settings-tabs', testimonial_plugin_url . 'assets/settings-tabs/settings-tabs.css');
        wp_register_script('settings-tabs', testimonial_plugin_url . 'assets/settings-tabs/settings-tabs.js', array('jquery'));

        wp_register_style('font-awesome-4', testimonial_plugin_url . 'assets/global/css/font-awesome-4.css');
        wp_register_style('font-awesome-5', testimonial_plugin_url . 'assets/global/css/font-awesome-5.css');

        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style('wp-color-picker');

        $pickp_settings_tabs_field = new pickp_settings_tabs_field();
        $pickp_settings_tabs_field->admin_scripts();
    }
}

new testimonialPickplugins();
