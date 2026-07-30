<?php
if (!defined('ABSPATH')) {
    exit;
}

class TAPF_Loader {

    public static function init() {

        // Frontend
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_assets']);

        // Shortcode
        add_shortcode('tapf_phone_finder', [__CLASS__, 'render_shortcode']);

    }

    public static function enqueue_assets() {

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
                'ajax' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('tapf_nonce')
            ]
        );
    }

    public static function render_shortcode() {

        ob_start();

        include TAPF_PATH . 'templates/finder.php';

        return ob_get_clean();
    }

}
