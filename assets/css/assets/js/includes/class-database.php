<?php
if (!defined('ABSPATH')) {
    exit;
}

class TAPF_Database {

    public static function install() {

        global $wpdb;

        $charset = $wpdb->get_charset_collate();

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        // Phones Table
        $phones = $wpdb->prefix . 'tapf_phones';

        $sql = "CREATE TABLE $phones (

            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

            brand varchar(100) NOT NULL,

            model varchar(150) NOT NULL,

            slug varchar(180) NOT NULL,

            display varchar(100),

            processor varchar(150),

            ram varchar(50),

            storage varchar(50),

            battery varchar(50),

            charging varchar(50),

            rear_camera varchar(150),

            front_camera varchar(100),

            os varchar(100),

            network varchar(50),

            price decimal(12,2),

            image varchar(255),

            created_at datetime DEFAULT CURRENT_TIMESTAMP,

            PRIMARY KEY(id),

            KEY slug(slug),

            KEY brand(brand)

        ) $charset;";

        dbDelta($sql);

        // Reviews Table

        $reviews = $wpdb->prefix . 'tapf_reviews';

        $sql2 = "CREATE TABLE $reviews (

            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

            phone_id BIGINT UNSIGNED NOT NULL,

            user_name varchar(100),

            rating tinyint,

            review text,

            created_at datetime DEFAULT CURRENT_TIMESTAMP,

            PRIMARY KEY(id),

            KEY phone_id(phone_id)

        ) $charset;";

        dbDelta($sql2);

    }

}
