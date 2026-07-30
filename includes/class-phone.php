<?php
if (!defined('ABSPATH')) {
    exit;
}

class TAPF_Phone {

    public static function save($data) {

        global $wpdb;

        $table = $wpdb->prefix . 'tapf_phones';

        return $wpdb->insert(
            $table,
            [
                'brand'        => sanitize_text_field($data['brand']),
                'model'        => sanitize_text_field($data['model']),
                'slug'         => sanitize_title($data['brand'].'-'.$data['model']),
                'display'      => sanitize_text_field($data['display']),
                'processor'    => sanitize_text_field($data['processor']),
                'ram'          => sanitize_text_field($data['ram']),
                'storage'      => sanitize_text_field($data['storage']),
                'battery'      => sanitize_text_field($data['battery']),
                'charging'     => sanitize_text_field($data['charging']),
                'rear_camera'  => sanitize_text_field($data['rear_camera']),
                'front_camera' => sanitize_text_field($data['front_camera']),
                'os'           => sanitize_text_field($data['os']),
                'network'      => sanitize_text_field($data['network']),
                'price'        => floatval($data['price']),
                'image'        => esc_url_raw($data['image'])
            ]
        );

    }

    public static function get_all() {

        global $wpdb;

        return $wpdb->get_results(
            "SELECT * FROM {$wpdb->prefix}tapf_phones ORDER BY id DESC"
        );

    }

    public static function get($id) {

        global $wpdb;

        return $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}tapf_phones WHERE id=%d",
                $id
            )
        );

    }

    public static function delete($id) {

        global $wpdb;

        return $wpdb->delete(
            $wpdb->prefix.'tapf_phones',
            ['id'=>$id]
        );

    }

}
