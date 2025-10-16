<?php
/**
 * Plugin Name: DM Mega Menu
 * Description: A simple custom mega menu plugin.
 * Version: 1.0
 * Author: Dan
 * Text Domain: dm-mega-menu
 */

if (!defined('ABSPATH')) exit;

define('DM_MM_PATH', plugin_dir_path(__FILE__));
define('DM_MM_URL', plugin_dir_url(__FILE__));

// Include main class
require_once DM_MM_PATH . 'includes/class-dm-mega-menu.php';

// Init
function dm_mm_init() {
    if ( class_exists('DM_Mega_Menu')) {
        new DM_Mega_Menu(); 
    }
}
add_action('plugins_loaded', 'dm_mm_init');

