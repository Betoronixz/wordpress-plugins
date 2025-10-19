<?php
/*
 * Plugin Name:       WP User ID Card
 * Author:            Traffic Tail
 * Version:            1.0.0 
 * Author URI:        https://traffictail.com/
 * Plugin URI:        https://traffictail.com/
 * Description:       The WP User ID Card plugin is a solution for creating ID cards for journalists in WordPress. It allows journalists to fill out a form with their personal information, such as name, father's name, email, mobile number, date of birth, state, district, pincode, and address. They can also upload their profile picture, payment screenshot, and Aadhar card picture.

The plugin includes CSS and JS files for styling and functionality, including Bootstrap, jQuery DataTables, and jQuery Validation. It also registers an activation hook to create a custom database table to store the user information.

The plugin adds a custom menu to the WordPress admin dashboard with options for a shortcode form and a user table. The shortcode [mynews_form] can be used to display the form for journalists to fill out, and [user_card] can be used to display the ID card for the user with their submitted information.

The plugin is created by Traffic Tail and the plugin's author URI is set to https://traffictail.com/. The plugin's description is "ID card solution for Journalists..
 */
if (!defined("ABSPATH")) {
    die("can't access");
}
define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

//  include css and js
if (!defined("MY_NEWS_PLUGIN_PATH")) {
    define("MY_NEWS_PLUGIN_PATH", plugin_dir_path(__FILE__));
}

if (!defined("MY_NEWS_PLUGIN_URL")) {
    define("MY_NEWS_PLUGIN_URL", plugin_dir_url(__FILE__));
}


function my_news_include_assets()
{
    wp_enqueue_style("my-news2-style", plugin_dir_url(__FILE__) . "assets/css/style.css", array(), '1.0.0');
    wp_enqueue_style("my-news2-boost", "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css", array(), '4.0.0');
    wp_enqueue_script('my-news2-boost-script', "https://code.jquery.com/jquery-3.2.1.slim.min.js", array('jquery'), '3.2.1', true);
    wp_enqueue_script('my-news2-boost-script2', "https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js", array('jquery'), '1.12.9', true);
    wp_enqueue_script('my-news2-boost-script3', "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js", array('jquery'), '4.0.0', true);
    wp_enqueue_style("my-news2-style", MY_NEWS_PLUGIN_URL . "assets/css/style.css", "");
}
add_action('wp_enqueue_scripts', "my_news_include_assets");

function idadmin()
{
    if (isset($_GET['page']) && ($_GET['page'] == 'cs-table' || $_GET['page'] == 'cs-setting')) {
        wp_enqueue_style("my-news2-bootstrap.min", MY_NEWS_PLUGIN_URL . "/assets/css/bootstrap.min.css", "", '');
        wp_enqueue_style("my-news2-2bootstrap.min", MY_NEWS_PLUGIN_URL . "/assets/css/2bootstrap.min.css", "", '');
        wp_enqueue_style("my-news2-datatable", MY_NEWS_PLUGIN_URL . "/assets/css/jquery.dataTables.min.css", "", '');
        wp_enqueue_style("my-news2-notifybarcs", MY_NEWS_PLUGIN_URL . "/assets/css/jquery.notifyBar.css", "", '');
        wp_enqueue_script('my-news2-bootstrap-min', MY_NEWS_PLUGIN_URL . '/assets/js/bootstrap.min.js', "", '', true);
        wp_enqueue_script('my-news2-validation-min', MY_NEWS_PLUGIN_URL . '/assets/js/jquery.validate.min.js', "", '', true);
        wp_enqueue_script('my-news2-datatable-min', MY_NEWS_PLUGIN_URL . '/assets/js/jquery.dataTables.min.js', "", '', true);
        wp_enqueue_script('my-news2-notifybar', MY_NEWS_PLUGIN_URL . '/assets/js/jquery.notifyBar.js', "", '', true);
        wp_enqueue_script('my-news2-script', MY_NEWS_PLUGIN_URL . '/assets/js/script.js', "", '1.0.0', true);
    }
}
add_action("admin_enqueue_scripts", "idadmin");



// Register activation hook
register_activation_hook(__FILE__, 'myplugin_create_table');

function myplugin_create_table()
{
    // Get global $wpdb object
    global $wpdb;

    // Set table name and create SQL query
    $table_name = $wpdb->prefix . 'news_user';
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE $table_name (
         id INT(11) NOT NULL AUTO_INCREMENT,
         name VARCHAR(50) NOT NULL,
         father_name VARCHAR(50) NOT NULL,
         email VARCHAR(100) NOT NULL,
         mobile_number VARCHAR(20) NOT NULL,
         unique_number VARCHAR(20) NOT NULL,
         date_of_birth DATE NOT NULL,
         state VARCHAR(50) NOT NULL,
         district VARCHAR(50) NOT NULL,
         status VARCHAR(50) NOT NULL,
         pincode VARCHAR(10) NOT NULL,
         address VARCHAR(255) NOT NULL,
         post VARCHAR(255) NOT NULL,
         work_area VARCHAR(255) NOT NULL,
         aadhaar_number VARCHAR(255) NOT NULL,
         profile_picture VARCHAR(255),
         payment_ss_picture VARCHAR(255),
         adhar_card_picture VARCHAR(255),     
         PRIMARY KEY (id)
       ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    }
    // Execute query and check for errors
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    $table_name2 = $wpdb->prefix . 'my_news_admin';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name2'") != $table_name2) {
        $sql2 = "CREATE TABLE $table_name2 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_card_image  VARCHAR(255)
    );
    ";
        dbDelta($sql2);
    }


    $table_name3 = $wpdb->prefix . 'id_user_qr';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name3'") != $table_name3) {
        $sql3 = "CREATE TABLE $table_name3 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_card_image  VARCHAR(255)
    );
    ";
        dbDelta($sql3);
    }
}


// addn=ing on menu
// adding on menu
add_action("admin_menu", "add_m_custom_menu");
function add_m_custom_menu()
{
    add_menu_page(
        "My Page",
        "WP User ID Card",
        "manage_options",
        "cs",
        "form",
        "dashicons-index-card",
        6
    );
    add_submenu_page(
        "cs",
        "Shortcode",
        "Shortcode",
        "manage_options",
        "cs",
        "form"
    );
    add_submenu_page(
        "cs",
        "User table",
        "User table",
        "manage_options",
        "cs-table", // Update menu slug to a valid string, e.g., "cs-table"
        "table"
    );
    add_submenu_page(
        "cs", // Update menu slug to a valid string, e.g., "settings"
        "Setting",
        "Setting",
        "manage_options",
        "cs-setting", // Update menu slug to a valid string, e.g., "cs-setting"
        "setting"
    );
}

function setting()
{
    include plugin_dir_path(__FILE__) . 'setting.php';
}

function form()
{
    echo "<h3>Use this shotcode for form [mynews_form] </h3><br>";
    echo "<h3>Use this shotcode for user card [user_card]</h3>";
}
function table()
{
    include plugin_dir_path(__FILE__) . 'user_table.php';
}


include plugin_dir_path(__FILE__) . 'form.php';
include plugin_dir_path(__FILE__) . 'user_card.php';
