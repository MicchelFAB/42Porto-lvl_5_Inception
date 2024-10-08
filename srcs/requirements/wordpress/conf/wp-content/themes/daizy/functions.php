<?php

define( 'DAIZY_THEME_VERSION', '9.6' );

function daizy_css() {
	$parent_style = 'specia-parent-style';		
	
	wp_enqueue_style('daizy-default',get_stylesheet_directory_uri() .'/css/colors/default.css');
	wp_dequeue_style('specia-default');
	
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'daizy-main', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('daizy-portfolio-effects',get_stylesheet_directory_uri() .'/css/portfolio-effects.css');
			
	wp_enqueue_script('daizy-custom',get_stylesheet_directory_uri() . '/js/custom.js');
		
}
add_action( 'wp_enqueue_scripts', 'daizy_css',999);

require_once( get_stylesheet_directory() . '/inc/customize/daizy-header-section.php');
require_once( get_stylesheet_directory() . '/inc/customize/daizy-premium.php');

function daizy_remove_parent_setting( $wp_customize ) {
	   $wp_customize->remove_control('cta_content_head');	
}
add_action( 'customize_register', 'daizy_remove_parent_setting',99 );
	
/**
* Import Options From Specia Theme
*
*/
function daizy_parent_theme_options() {
	$specia_mods = get_option( 'theme_mods_specia' );
	if ( ! empty( $specia_mods ) ) {
		foreach ( $specia_mods as $specia_mod_k => $specia_mod_v ) {
			set_theme_mod( $specia_mod_k, $specia_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'daizy_parent_theme_options' );
	

