<?php
/**
 * Zerif Lite Child Theme
 */

include_once('functions/general.php');

define( 'TAS_VERSION', '1.0.0' );

function tas_enqueue_scripts() {
	wp_enqueue_script( 'main_page', get_stylesheet_directory_uri() . "/js/main_page.js", array( 'jquery' ), TAS_VERSION );
}

add_action('wp_enqueue_scripts', 'tas_enqueue_scripts', 999);

function load_fonts() {
	wp_register_style('et-googleFonts', 'https://fonts.googleapis.com/css?family=Lato:400,700');
	wp_enqueue_style('et-googleFonts');
}

add_action('wp_print_styles', 'load_fonts');