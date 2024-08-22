<?php
/**
 * Plugin Name: Metabox_2
 * Plugin URI:  Plugin URL Link
 * Author:      Plugin Author Name
 * Author URI:  Plugin Author Link
 * Description: This plugin make for pratice wich is "Metabox_2".
 * Version:     0.1.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: mb_2
 */
// function plugin_loaded_function(){
//     load_plugin_textdomain('pluing_languages',false, dirname(__FILE__)."/languages");
// }
// add_action('plugin_loaded','plugin_loaded_function');



// function metabox_function(){
//     add_meta_box('meta_box_2_firt', __('Your identity','mb_2'),'meta_box2_function', 'post');
// }

// function mb_2_save($name_id){
    
// $name = isset($_POST['metabox_lebal_1'])?$_POST['metabox_lebal_1']:'';
// if($name==''){
//     return $name_id;
// }
// update_post_meta($name_id,'metabox_lebal_1', $name);
// }
// add_action('save_post','mb_2_save');




// function meta_box2_function($post){
//     $name = get_post_meta($post->ID, 'metabox_lebal_1', true);
//     $lebal = __("Your name",'mb_2');
//     $metabox_html = <<<EOD
//     <div>
//         <lebal for='metabox_lebal_1'>{$lebal}</lebal>
//         <input type='text' id='metabox_lebal_1' value={$name}/>
     
    
//     </div>
//     EOD;
//     echo $metabox_html;

// }

// add_action('admin_init', 'metabox_function');






// Load Plugin Textdomain
function plugin_loaded_function(){
    load_plugin_textdomain('pluing_languages', false, dirname(__FILE__) . "/languages");
}
add_action('plugins_loaded', 'plugin_loaded_function');

// Register Meta Box
function metabox_function(){
    add_meta_box('meta_box_2_firt', __('Your identity','mb_2'), 'meta_box2_function', 'post');
}
add_action('add_meta_boxes', 'metabox_function');

// Display Meta Box
function meta_box2_function($post) {
    $name = get_post_meta($post->ID, 'metabox_lebal_1', true);
    $lebal = __("Your name", 'mb_2');
    // Add nonce for security
    wp_nonce_field('save_meta_box2_data', 'mb_2_nonce');
    $metabox_html = <<<EOD
    <div>
        <label for='metabox_lebal_1'>{$lebal}</label>
        <input type='text' name='metabox_lebal_1' id='metabox_lebal_1' value='{$name}'/>
    </div>
    EOD;
    echo $metabox_html;
}

// Save Meta Box Data
function mb_2_save($post_id) {
    // Check if nonce is set
    if (!isset($_POST['mb_2_nonce'])) {
        return $post_id;
    }

    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['mb_2_nonce'], 'save_meta_box2_data')) {
        return $post_id;
    }

    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Sanitize and save the data
    $name = isset($_POST['metabox_lebal_1']) ? sanitize_text_field($_POST['metabox_lebal_1']) : '';
    update_post_meta($post_id, 'metabox_lebal_1', $name);
}

add_action('save_post', 'mb_2_save');











?>