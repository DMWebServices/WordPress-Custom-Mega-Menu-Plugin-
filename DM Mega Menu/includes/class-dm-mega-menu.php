<?php

if ( ! defined( 'ABSPATH' ) ) exit;

require_once plugin_dir_path(__FILE__) . 'class-dm-mega-menu-walker.php';

Class DM_Mega_Menu {
    public function __construct() { 
        $this->register_hooks();
    }

    // Hook everything into WordPress
    private function register_hooks() {
        add_action('init', [$this, 'register_menu_location']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_filter('wp_nav_menu_args', [$this, 'custom_menu_args']);
    }

    // Register the custom menu location
    public function register_menu_location() {
        register_nav_menus([
            'dm_mega_menu' => __('DM Mega Menu', 'dm-mega-menu')
        ]);
    }

    // Enqueue styles and scripts
    public function enqueue_assets() {
    wp_enqueue_style('dm-mega-menu', plugin_dir_url(__DIR__) . 'assets/style.css', [], '1.0.0');
    wp_enqueue_script('dm-mega-menu', plugin_dir_url(__DIR__) . 'assets/app.js', ['jquery'], null, true);
    }

    // Inject our custom walker into nav menu arguments
    public function custom_menu_args($args) {
        if ($args['theme_location'] === 'dm_mega_menu') {
            $args = $this->apply_menu_classes($args);
            $args['walker'] = new DMMegaMenu_Walker();   
        }
        return $args;
    }

    // Private Helper - adds default classes to the menu container
    private function apply_menu_classes($args) {
        $args['container'] = 'nav';
        $args['container_class'] = 'dm-mega-menu';
        $args['menu_class'] = 'dm-mega-menu-list';
        return $args;
    }

    // Private Helper - useful later for checking if menu has mega items
    Private function has_mega_menu() {
        foreach ( $menu_item as $item) {
            if ( in_array('mega-parent', $item->classes)) {
                return true;
            }
        }
        return false;
    }
}

new DM_Mega_Menu();