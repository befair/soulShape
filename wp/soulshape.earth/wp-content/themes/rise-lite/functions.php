<?php
/**
 *	Setup
 */
if( !function_exists( 'rise_lite_setup' ) ) {
	// Customizer
	require_once( 'includes/customizer.php' );

	add_action( 'after_setup_theme', 'rise_lite_setup' );
	function rise_lite_setup() {
		// Custom Background
		add_theme_support( 'custom-background', apply_filters( 'rise_lite_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => get_stylesheet_directory_uri() . '/assets/images/bg.jpg',
		) ) );
	}
}

/**
 *	Enqueue Style
 */
if( !function_exists( 'rise_lite_styles' ) ) {
	add_action( 'wp_enqueue_scripts', 'rise_lite_styles', 11 );
	function rise_lite_styles() {
		// Enqueue Style
		wp_enqueue_style( 'zerif-lite-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'rise-lite-style', get_stylesheet_directory_uri() . '/style.css', array( 'zerif-lite-style' ), '1.0.11', 'all' );
		wp_enqueue_style( 'rise-lite-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array( 'rise-lite-style' ), '1.0.11', 'all' );
	}
}

/**
 *	Enqueue Scripts
 */
if( !function_exists( 'rise_lite_enqueue_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'rise_lite_enqueue_scripts' );
	function rise_lite_enqueue_scripts() {
		wp_enqueue_script( 'rise-lite-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array(), '1.0.11', true );
	}
}

/**
 *	Dequeue Scripts
 */
if( !function_exists( 'rise_lite_dequeue_scripts' ) ) {
	add_action( 'wp_print_scripts', 'rise_lite_dequeue_scripts', 11 );
	function rise_lite_dequeue_scripts() {
		wp_dequeue_script( 'zerif_script' );
	}
}

/**
 *	Customize Controls Enqueue Scripts
 */
if( !function_exists( 'rise_lite_customize_controls_enqueue_scripts' ) ) {
	add_action( 'customize_controls_enqueue_scripts', 'rise_lite_customize_controls_enqueue_scripts' );
	function rise_lite_customize_controls_enqueue_scripts() {
		wp_enqueue_script( 'rise-lite-customizer', get_stylesheet_directory_uri() . '/assets/js/rise-lite-customizer.js', array("jquery"), '20120206', true  );
	}
}

function rise_lite_remove_footer_sidebars(){
	unregister_sidebar( 'zerif-sidebar-footer' );
	unregister_sidebar( 'zerif-sidebar-footer-2' );
	unregister_sidebar( 'zerif-sidebar-footer-3' );
}
add_action( 'widgets_init', 'rise_lite_remove_footer_sidebars', 11 );