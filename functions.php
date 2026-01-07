<?php
function dougiewougie_theme_setup() {
    add_theme_support( 'html5', array( 'search-form' ) );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'dougiewougie_theme_setup' );

function dougiewougie_theme_scripts() {
    wp_enqueue_style( 'dougiewougie-theme-style', get_stylesheet_uri() );
    wp_enqueue_script( 'dougiewougie-theme-dark-mode', get_template_directory_uri() . '/js/dark-mode.js', array(), '1.0', true );
    wp_enqueue_script( 'dougiewougie-theme-animations', get_template_directory_uri() . '/js/animations.js', array(), '1.0', true );
    wp_enqueue_script( 'dougiewougie-theme-explosion', get_template_directory_uri() . '/js/explosion.js', array(), '1.0', true );
    wp_enqueue_script( 'dougiewougie-theme-back-to-top', get_template_directory_uri() . '/js/back-to-top.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'dougiewougie_theme_scripts' );

function dougiewougie_dark_mode_toggle() {
    echo '<div class="dark-mode-switch">
            <input type="checkbox" id="dark-mode-toggle" class="dark-mode-checkbox">
            <label for="dark-mode-toggle" class="dark-mode-label">
                <span class="toggle-ball"></span>
                <svg class="sun" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                <svg class="moon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
            </label>
        </div>';
}
add_action( 'wp_body_open', 'dougiewougie_dark_mode_toggle' );

/**
 * Extend search to include categories and tags.
 */
function dougiewougie_advanced_search_join( $join ) {
    global $wpdb;
    if ( is_search() && ! is_admin() ) {
        $join .=" LEFT JOIN {$wpdb->term_relationships} ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id ";
        $join .=" LEFT JOIN {$wpdb->term_taxonomy} ON {$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id ";
        $join .=" LEFT JOIN {$wpdb->terms} ON {$wpdb->term_taxonomy}.term_id = {$wpdb->terms}.term_id ";
    }
    return $join;
}
add_filter('posts_join', 'dougiewougie_advanced_search_join');

function dougiewougie_advanced_search_where( $where ) {
    global $wpdb;
    if ( is_search() && ! is_admin() ) {
        $where = preg_replace(
            "/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "({$wpdb->posts}.post_title LIKE $1) OR ({$wpdb->terms}.name LIKE $1)",
            $where
        );
    }
    return $where;
}
add_filter('posts_where', 'dougiewougie_advanced_search_where');

function dougiewougie_advanced_search_distinct( $where ) {
    if ( is_search() && ! is_admin() ) {
        return "DISTINCT";
    }
    return $where;
}
add_filter('posts_distinct', 'dougiewougie_advanced_search_distinct');