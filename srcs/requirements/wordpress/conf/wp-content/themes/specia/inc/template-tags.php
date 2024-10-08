<?php
if ( ! function_exists( 'specia_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function specia_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'specia' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'specia' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'specia_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function specia_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'specia' ) );
		if ( $categories_list && specia_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'specia' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'specia' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'specia' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'specia' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'specia' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function specia_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'specia_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'specia_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so specia_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so specia_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in specia_categorized_blog.
 */
function specia_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'specia_categories' );
}
add_action( 'edit_category', 'specia_category_transient_flusher' );
add_action( 'save_post',     'specia_category_transient_flusher' );

/**
 * This Function Check whether Sidebar active or Not
 */
if(!function_exists( 'specia_post_column' )) :
function specia_post_column(){
	if(is_active_sidebar('sidebar-primary'))
		{ echo 'col-md-8'; } 
	else 
		{ echo 'col-md-12'; }  
} endif; 


/**
 * Function that returns if the menu is sticky
 */
if (!function_exists('specia_sticky_menu')):
    function specia_sticky_menu()
    {
        $is_sticky = get_theme_mod('sticky_header_setting', 'on');

        if ($is_sticky == 'on'):
            return 'sticky-nav';
        else:
            return false;
        endif;
    }
endif;


/**
 * Register Google fonts for Specia.
 */
function specia_google_font() {
	
    $get_fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Open Sans:300,400,600,700,800', 'Raleway:400,700');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $get_fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return esc_url($get_fonts_url);
	
}

function specia_scripts_styles() {
    wp_enqueue_style( 'specia-fonts', specia_google_font(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'specia_scripts_styles' );

/**
 * Register Breadcrumb for Multiple Variation
 */
function specia_breadcrumbs_style() {
	get_template_part('./sections/specia','breadcrumb');	
}


if (!function_exists('specia_str_replace_assoc')) {

    /**
     * specia_str_replace_assoc
     * @param  array $replace
     * @param  array $subject
     * @return array
     */
    function specia_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}



if( ! function_exists( 'specia_dynamic_style' ) ):
    function specia_dynamic_style() {

		$output_css = '';
		
		
		/**
		 *  specia_btn_brdr_radius
		 */
		$specia_btn_brdr_radius = get_theme_mod('specia_btn_brdr_radius',100);
		if($specia_btn_brdr_radius !== '') { 
			$output_css .=".bt-primary,a.bt-primary,button.bt-primary,.more-link,a.more-link, .wpcf7-submit,input.wpcf7-submit,div.tagcloud a,.widget .woocommerce-product-search input[type='search'],.widget .search-form input[type='search'],input[type='submit'],button[type='submit'],.woo-sidebar .woocommerce-mini-cart__buttons.buttons .button,footer .woocommerce-mini-cart__buttons.buttons .button,.woocommerce ul.products li.product .button, .woocommerce nav.woocommerce-pagination ul li a,.woocommerce nav.woocommerce-pagination ul li span,.top-scroll,.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,.woocommerce table.cart td.actions .input-text,.woocommerce-page #content table.cart td.actions .input-text,.woocommerce-page table.cart td.actions .input-text,.wp-block-search .wp-block-search__input, .wp-block-loginout a, .woocommerce a.button, .woocommerce span.onsale {
					border-radius: " .esc_attr($specia_btn_brdr_radius). "px !important;
				}\n";
		}
		
		
		/**
		 *  hs_social_tooltip
		 */
		$hs_social_tooltip = get_theme_mod('hs_social_tooltip','1');
		if($hs_social_tooltip !== '1') { 
			$output_css .="li [class*=tool-]:hover:before, li [class*=tool-]:hover:after {
						opacity: 0;
				}\n";
		}
		 
		
        wp_add_inline_style( 'specia-style', $output_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'specia_dynamic_style' );




/*******************************************************************************
 *  Get Started Notice
 *******************************************************************************/

add_action( 'wp_ajax_specia_dismissed_notice_handler', 'specia_ajax_notice_handler' );

/**
 * AJAX handler to store the state of dismissible notices.
 */
function specia_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // Store it in the options table
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function specia_deprecated_hook_admin_notice() {
        // Check if it's been dismissed...
        if ( ! get_option('dismissed-get_started', FALSE ) ) {
            // Added the class "notice-get-started-class" so jQuery pick it up and pass via AJAX,
            // and added "data-notice" attribute in order to track multiple / different notices
            // multiple dismissible notice states ?>
            <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="specia-getting-started-notice clearfix">
                    <div class="specia-theme-screenshot">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.jpg" class="screenshot" alt="<?php esc_attr_e( 'Theme Screenshot', 'specia' ); ?>" />
                    </div><!-- /.specia-theme-screenshot -->
                    <div class="specia-theme-notice-content">
                        <h2 class="specia-notice-h2">
                            <?php
                        printf(
                        /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                            esc_html__( 'Welcome! Thank you for choosing %1$s!', 'specia' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>' );
                        ?>
                        </h2>

                        <p class="plugin-install-notice"><?php echo sprintf(__('Install and activate <strong>Specia Companion</strong> plugin for taking full advantage of all the features this theme has to offer.', 'specia')) ?></p>

                        <a class="specia-btn-get-started button button-primary button-hero specia-button-padding" href="#" data-name="" data-slug=""><?php esc_html_e( 'Get started with Specia', 'specia' ) ?></a><span class="specia-push-down">
                        <?php
                            /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                            printf(
                                'or %1$sCustomize theme%2$s</a></span>',
                                '<a target="_blank" href="' . esc_url( admin_url( 'customize.php' ) ) . '">',
                                '</a>'
                            );
                        ?>
                    </div><!-- /.specia-theme-notice-content -->
                </div>
            </div>
        <?php }
}

add_action( 'admin_notices', 'specia_deprecated_hook_admin_notice' );

/*******************************************************************************
 *  Plugin Installer
 *******************************************************************************/

add_action( 'wp_ajax_install_act_plugin', 'specia_admin_install_plugin' );

function specia_admin_install_plugin() {
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    if ( ! file_exists( WP_PLUGIN_DIR . '/specia-companion' ) ) {
        $api = plugins_api( 'plugin_information', array(
            'slug'   => sanitize_key( wp_unslash( 'specia-companion' ) ),
            'fields' => array(
                'sections' => false,
            ),
        ) );

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $result   = $upgrader->install( $api->download_link );
    }

    // Activate plugin.
    if ( current_user_can( 'activate_plugin' ) ) {
        $result = activate_plugin( 'specia-companion/specia-companion.php' );
    }
}		