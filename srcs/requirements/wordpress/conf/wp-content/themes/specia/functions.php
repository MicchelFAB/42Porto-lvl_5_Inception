<?php
if ( ! function_exists( 'specia_setup' ) ) :
function specia_setup() {
	
	/*
	 * Define Theme Version
	 */
	define( 'SPECIA_THEME_VERSION', '12.3' );
	
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'specia', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'specia' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	//Add custom logo support
	add_theme_support('custom-logo');
	
	remove_theme_support( 'widgets-block-editor' );
	
	/*
	 * WooCommerce Plugin Support
	 */
	add_theme_support( 'woocommerce' );
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', specia_google_font() ) );
	
}
endif;
add_action( 'after_setup_theme', 'specia_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function specia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'specia_content_width', 1170 );
}
add_action( 'after_setup_theme', 'specia_content_width', 0 );

/**
 * All Styles & Scripts.
 */
require_once get_template_directory() . '/inc/enqueue.php';

/**
 * Bootstrap Nav Walker.
 */
if( ! class_exists( 'specia_nav_walker' ) ) {
	require_once get_template_directory() . '/inc/specia-nav-walker.php';
}
	
/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Called Breadcrumb
 */
require_once get_template_directory() . '/inc/breadcrumb/breadcrumb.php';

/**
 * Sidebar.
 */
require_once get_template_directory() . '/inc/sidebar/sidebar.php';

/**
 * Widgets.
 */
require_once get_template_directory() . '/inc/widget/widget_feature.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Load Jetpack compatibility file.
 */
require_once get_template_directory() . '/inc/jetpack.php';

/**
 * Load Sanitization file.
 */
require_once get_template_directory() . '/inc/sanitization.php';

/**
 * Called all the Customize file.
 */
require_once( get_template_directory() . '/inc/customize/specia-customizer.php');
require_once( get_template_directory() . '/inc/customize/specia-general.php');
require_once( get_template_directory() . '/inc/customize/specia-header-section.php');
require_once( get_template_directory() . '/inc/customize/specia-slider-section.php');
require_once( get_template_directory() . '/inc/customize/specia-call-action.php');
require_once( get_template_directory() . '/inc/customize/specia-service.php');
require_once( get_template_directory() . '/inc/customize/specia-features.php');
require_once( get_template_directory() . '/inc/customize/specia-portfolio.php');
require_once( get_template_directory() . '/inc/customize/specia-blog.php');
require_once( get_template_directory() . '/inc/customize/specia-footer-section.php');
require_once( get_template_directory() . '/inc/customize/specia-premium.php');
require_once( get_template_directory() . '/inc/customize/customizer_recommended_plugin.php');
require_once( get_template_directory() . '/inc/customize/customizer_import_data.php');


add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['class'] )  && 'custom-logo' === $attr['class'] )
        $attr['class'] = 'custom-logo navbar-brand';

    return $attr;
} );


/**
 * Add WooCommerce Cart Icon With Cart Count
 */
function specia_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->cart_contents_count;
    ?><a id="cart" href="<?php echo esc_url ( wc_get_cart_url() ); ?>"><i class='fa fa-shopping-bag'></i><?php
    if ( $count > 0 ) { 
	?>
        <span><?php echo esc_html( $count ); ?></span>
	<?php            
    } else {
	?>	
		<span><?php echo esc_html_e('0','specia'); ?></span>
	<?php
	}
    ?></a><?php
 
    $fragments['a#cart'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'specia_add_to_cart_fragment' );