<?php
/**
 * Plugin Name: Tech Arabinda Phone Finder Pro
 * Plugin URI: https://www.techarabinda.in/
 * Description: Professional Smartphone Finder, Compare, Reviews & AI Advisor.
 * Version: 1.0.0
 * Author: Tech Arabinda
 * License: GPL v2 or later
 * Text Domain: tapf-pro
 */

if (!defined('ABSPATH')) {
    exit;
}

define('TAPF_VERSION', '1.0.0');
define('TAPF_PATH', plugin_dir_path(__FILE__));
define('TAPF_URL', plugin_dir_url(__FILE__));

require_once TAPF_PATH . 'includes/class-database.php';
require_once TAPF_PATH . 'includes/class-admin.php';

register_activation_hook(__FILE__, 'tapf_activate');
register_deactivation_hook(__FILE__, 'tapf_deactivate');

function tapf_activate() {
    TAPF_Database::install();
}

function tapf_deactivate() {

}

function tapf_assets() {

    wp_enqueue_style(
        'tapf-style',
        TAPF_URL . 'assets/css/frontend.css',
        [],
        TAPF_VERSION
    );

    wp_enqueue_script(
        'tapf-search',
        TAPF_URL . 'assets/js/search.js',
        ['jquery'],
        TAPF_VERSION,
        true
    );

    wp_localize_script(
        'tapf-search',
        'tapf',
        [
            'ajax' => admin_url('admin-ajax.php')
        ]
    );

}

add_action('wp_enqueue_scripts', 'tapf_assets');

function tapf_shortcode() {

ob_start();

?>

<div class="tapf-container">

<h2>Tech Arabinda Phone Finder Pro</h2>

<input
type="text"
id="tapf-search"
placeholder="Search Smartphone...">

<div id="tapf-result"></div>

</div>

<?php

return ob_get_clean();

}

add_shortcode('tapf_phone_finder','tapf_shortcode');

function tapf_search_ajax(){

global $wpdb;

$table=$wpdb->prefix."tapf_phones";

$q=sanitize_text_field($_POST['q']);

$data=$wpdb->get_results(

$wpdb->prepare(

"SELECT * FROM $table
WHERE brand LIKE %s
OR model LIKE %s
LIMIT 10",

"%$q%",

"%$q%"

)

);

wp_send_json($data);

}

add_action('wp_ajax_tapf_search','tapf_search_ajax');
add_action('wp_ajax_nopriv_tapf_search','tapf_search_ajax');
