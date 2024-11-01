<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access


$current_tab = isset($_REQUEST['tab']) ? sanitize_text_field($_REQUEST['tab']) : 'general';

$testimonial_settings_tab = array();

$testimonial_settings_tab[] = array(
    'id' => 'general',
    'title' => sprintf(__('%s General','testimonial'),'<i class="fas fa-list-ul"></i>'),
    'priority' => 1,
    'active' => ($current_tab == 'general') ? true : false,
);



$testimonial_settings_tab[] = array(
    'id' => 'help_support',
    'title' => sprintf(__('%s Help & support','testimonial'),'<i class="fas fa-hands-helping"></i>'),
    'priority' => 3,
    'active' => ($current_tab == 'help_support') ? true : false,
);

//$testimonial_settings_tab[] = array(
//    'id' => 'buy_pro',
//    'title' => sprintf(__('%s Buy Pro','testimonial'),'<i class="fas fa-store"></i>'),
//    'priority' => 9,
//    'active' => ($current_tab == 'buy_pro') ? true : false,
//);

$testimonial_settings_tab = apply_filters('testimonial_settings_tabs', $testimonial_settings_tab);

$tabs_sorted = array();

if(!empty($testimonial_settings_tab))
foreach ($testimonial_settings_tab as $page_key => $tab) $tabs_sorted[$page_key] = isset( $tab['priority'] ) ? $tab['priority'] : 0;
array_multisort($tabs_sorted, SORT_ASC, $testimonial_settings_tab);


wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-sortable');
wp_enqueue_script( 'jquery-ui-core' );
wp_enqueue_script('jquery-ui-accordion');
wp_enqueue_style( 'wp-color-picker' );
wp_enqueue_script('wp-color-picker');
wp_enqueue_style('font-awesome-5');
wp_enqueue_style('settings-tabs');
wp_enqueue_script('settings-tabs');

wp_enqueue_style('codemirror');
wp_enqueue_script('codemirror');

$testimonial_settings = get_option('testimonial_settings');

?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div><h2><?php echo sprintf(__('%s Settings', 'testimonial'), testimonial_plugin_name)?></h2>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', esc_url_raw($_SERVER['REQUEST_URI'])); ?>">
	        <input type="hidden" name="testimonial_hidden" value="Y">
            <input type="hidden" name="tab" value="<?php echo esc_attr($current_tab); ?>">
            <?php
            if(!empty($_POST['testimonial_hidden'])){
                $nonce = sanitize_text_field($_POST['_wpnonce']);
                if(wp_verify_nonce( $nonce, 'testimonial_nonce' ) && $_POST['testimonial_hidden'] == 'Y') {
                    do_action('testimonial_settings_save');
                    ?>
                    <div class="updated notice  is-dismissible"><p><strong><?php _e('Changes Saved.', 'testimonial' ); ?></strong></p></div>
                    <?php
                }
            }
            ?>
            <div class="settings-tabs-loading" style="">Loading...</div>
            <div class="settings-tabs vertical has-right-panel" style="display: none">
                <div class="settings-tabs-right-panel">
                    <?php
                    if(!empty($testimonial_settings_tab))
                    foreach ($testimonial_settings_tab as $tab) {
                        $id = $tab['id'];
                        $active = $tab['active'];
                        ?>
                        <div class="right-panel-content <?php if($active) echo 'active';?> right-panel-content-<?php echo esc_attr($id); ?>">
                            <?php
                            do_action('testimonial_settings_tabs_right_panel_'.$id);
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <ul class="tab-navs">
                    <?php
                    if(!empty($testimonial_settings_tab))
                    foreach ($testimonial_settings_tab as $tab){
                        $id = $tab['id'];
                        $title = $tab['title'];
                        $active = $tab['active'];
                        $data_visible = isset($tab['data_visible']) ? $tab['data_visible'] : '';
                        $hidden = isset($tab['hidden']) ? $tab['hidden'] : false;
                        $is_pro = isset($tab['is_pro']) ? $tab['is_pro'] : false;
                        $pro_text = isset($tab['pro_text']) ? $tab['pro_text'] : '';
                        ?>
                        <li <?php if(!empty($data_visible)): ?> data_visible="<?php echo esc_attr($data_visible); ?>" <?php endif; ?> class="tab-nav <?php if($hidden) echo 'hidden';?> <?php if($active) echo 'active';?>" data-id="<?php echo esc_attr($id); ?>">
                            <?php echo $title; ?>
                            <?php
                            if($is_pro):
                                ?><span class="pro-feature"><?php echo $pro_text; ?></span> <?php
                            endif;
                            ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
                if(!empty($testimonial_settings_tab))
                foreach ($testimonial_settings_tab as $tab){
                    $id = $tab['id'];
                    $title = $tab['title'];
                    $active = $tab['active'];
                    ?>
                    <div class="tab-content <?php if($active) echo 'active';?>" id="<?php echo esc_attr($id); ?>">
                        <?php
                        do_action('testimonial_settings_content_'.$id, $tab);
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="clear clearfix"></div>
                <p class="submit">
                    <?php wp_nonce_field( 'testimonial_nonce' ); ?>
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','testimonial' ); ?>" />
                </p>
            </div>
		</form>
</div>