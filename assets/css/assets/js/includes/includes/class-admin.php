<?php
if (!defined('ABSPATH')) {
    exit;
}

class TAPF_Admin {

    public function __construct() {
        add_action('admin_menu', array($this, 'register_menu'));
        add_action('admin_post_tapf_save_phone', array($this, 'save_phone'));
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
            'Add Phone',
            'Add Phone',
            'manage_options',
            'tapf-add-phone',
            array($this, 'add_phone_page')
        );
    }

    public function dashboard_page() {

        echo '<div class="wrap">';
        echo '<h1>📱 Tech Arabinda Phone Finder Pro</h1>';
        echo '<p>Welcome to your Phone Finder Dashboard.</p>';
        echo '</div>';

    }

    public function add_phone_page() {

?>

<div class="wrap">

<h1>Add Smartphone</h1>

<form method="post" action="<?php echo admin_url('admin-post.php'); ?>">

<input type="hidden" name="action" value="tapf_save_phone">

<?php wp_nonce_field('tapf_save_phone'); ?>

<table class="form-table">

<tr>
<th>Brand</th>
<td><input type="text" name="brand" class="regular-text" required></td>
</tr>

<tr>
<th>Model</th>
<td><input type="text" name="model" class="regular-text" required></td>
</tr>

<tr>
<th>Display</th>
<td><input type="text" name="display" class="regular-text"></td>
</tr>

<tr>
<th>Processor</th>
<td><input type="text" name="processor" class="regular-text"></td>
</tr>

<tr>
<th>RAM</th>
<td><input type="text" name="ram" class="regular-text"></td>
</tr>

<tr>
<th>Storage</th>
<td><input type="text" name="storage" class="regular-text"></td>
</tr>

<tr>
<th>Battery</th>
<td><input type="text" name="battery" class="regular-text"></td>
</tr>

<tr>
<th>Charging</th>
<td><input type="text" name="charging" class="regular-text"></td>
</tr>

<tr>
<th>Rear Camera</th>
<td><input type="text" name="rear_camera" class="regular-text"></td>
</tr>

<tr>
<th>Front Camera</th>
<td><input type="text" name="front_camera" class="regular-text"></td>
</tr>

<tr>
<th>Operating System</th>
<td><input type="text" name="os" class="regular-text"></td>
</tr>

<tr>
<th>Network</th>
<td><input type="text" name="network" class="regular-text"></td>
</tr>

<tr>
<th>Price</th>
<td><input type="number" step="0.01" name="price" class="regular-text"></td>
</tr>

<tr>
<th>Image URL</th>
<td><input type="url" name="image" class="regular-text"></td>
</tr>

</table>

<?php submit_button('Save Phone'); ?>

</form>

</div>

<?php

    }

    public function save_phone() {

        if (!current_user_can('manage_options')) {
            wp_die('Permission denied');
        }

        check_admin_referer('tapf_save_phone');

        TAPF_Phone::save($_POST);

        wp_redirect(admin_url('admin.php?page=tapf-dashboard&saved=1'));

        exit;

    }

}

new TAPF_Admin();
