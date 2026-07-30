<?php
if (!defined('ABSPATH')) {
    exit;
}

class TAPF_Admin {

    public function __construct() {

        add_action('admin_menu', array($this, 'register_menu'));

    }

    public function register_menu() {

        add_menu_page(
            'Tech Arabinda Phone Finder',
            'Phone Finder',
            'manage_options',
            'tapf-dashboard',
            array($this, 'dashboard_page'),
            'dashicons-smartphone',
            25
        );

        add_submenu_page(
            'tapf-dashboard',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'tapf-dashboard',
            array($this, 'dashboard_page')
        );

        add_submenu_page(
            'tapf-dashboard',
            'All Phones',
            'All Phones',
            'manage_options',
            'tapf-all-phones',
            array($this, 'phones_page')
        );

        add_submenu_page(
            'tapf-dashboard',
            'Add Phone',
            'Add Phone',
            'manage_options',
            'tapf-add-phone',
            array($this, 'add_phone_page')
        );

        add_submenu_page(
            'tapf-dashboard',
            'Reviews',
            'Reviews',
            'manage_options',
            'tapf-reviews',
            array($this, 'reviews_page')
        );

        add_submenu_page(
            'tapf-dashboard',
            'Settings',
            'Settings',
            'manage_options',
            'tapf-settings',
            array($this, 'settings_page')
        );

    }

    public function dashboard_page() {

        ?>
        <div class="wrap">
            <h1>📱 Tech Arabinda Phone Finder Pro</h1>

            <div style="display:flex;gap:20px;flex-wrap:wrap;margin-top:25px;">

                <div style="background:#fff;padding:20px;border-radius:12px;width:220px;">
                    <h2>Total Phones</h2>
                    <h1>0</h1>
                </div>

                <div style="background:#fff;padding:20px;border-radius:12px;width:220px;">
                    <h2>Total Reviews</h2>
                    <h1>0</h1>
                </div>

                <div style="background:#fff;padding:20px;border-radius:12px;width:220px;">
                    <h2>Users</h2>
                    <h1>0</h1>
                </div>

                <div style="background:#fff;padding:20px;border-radius:12px;width:220px;">
                    <h2>Brands</h2>
                    <h1>0</h1>
                </div>

            </div>

            <br>

            <h2>Welcome to Tech Arabinda Phone Finder Pro</h2>

            <p>
                Manage smartphones, reviews, users and settings from this dashboard.
            </p>

        </div>
        <?php

    }

    public function phones_page() {

        echo '<div class="wrap"><h1>All Phones</h1><p>Phone list will appear here.</p></div>';

    }

    public function add_phone_page() {

        echo '<div class="wrap"><h1>Add Phone</h1><p>Phone form will be added in next version.</p></div>';

    }

    public function reviews_page() {

        echo '<div class="wrap"><h1>Reviews</h1><p>User reviews will appear here.</p></div>';

    }

    public function settings_page() {

        echo '<div class="wrap"><h1>Settings</h1><p>Plugin settings will appear here.</p></div>';

    }

}

new TAPF_Admin();
