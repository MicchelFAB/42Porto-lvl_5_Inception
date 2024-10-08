<?php
function daizy_header_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
	/*=========================================
	Contact Info 2
	=========================================*/
	$wp_customize->add_section(
        'hdr_nav_contact_info2',
        array(
        	'priority'      => 4,
            'title' 		=> __('Contact Info 2','daizy'),
			'panel'  		=> 'header_section',
		)
    );
	
	// Contact Info Head
	$wp_customize->add_setting(
		'nav_contact_infos2_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_text',
			'priority'  => 11
		)
	);

	$wp_customize->add_control(
	'nav_contact_infos2_head',
		array(
			'type' => 'hidden',
			'label' => __('Contact Info 2','daizy'),
			'section' => 'hdr_nav_contact_info2',
		)
	);
	
	//  Hide/Show  // 
	$wp_customize->add_setting( 
		'hs_nav_contact_info2' , 
			array(
			'default' => '1',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_select',
			'priority'      => 12,
		) 
	);
	
	$wp_customize->add_control(
	'hs_nav_contact_info2', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'daizy' ),
			'section'     => 'hdr_nav_contact_info2',
			'type'        => 'radio',
			'choices'        => 
			array(
				'1' => 'Show',
				'0'  => 'Hide'
			) 
		) 
	);		
	
	// Icon
	$wp_customize->add_setting(
    	'hdr_nav_contact_icon2',
    	array(
	        'default'			=> 'fa-hourglass-end',
			'sanitize_callback' => 'specia_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority'      => 13,

		)
	);	
	
	$wp_customize->add_control(
		'hdr_nav_contact_icon2',
		array(
		    'label'   		=> __('Icon','daizy'),
			'type' => 'text',
		    'section' 		=> 'hdr_nav_contact_info2',
		)  
	);
	
	// Title
	$wp_customize->add_setting(
    	'hdr_nav_contact_ttl2',
    	array(
			'sanitize_callback' => 'specia_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority'      => 14,
		)
	);	

	$wp_customize->add_control( 
		'hdr_nav_contact_ttl2',
		array(
		    'label'   => __('Title','daizy'),
		    'section' => 'hdr_nav_contact_info2',
			'type' => 'text',
		)  
	);
	
	
	// Subtitle
	$wp_customize->add_setting(
    	'hdr_nav_contact_subttl2',
    	array(
			'sanitize_callback' => 'specia_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority'      => 15,
		)
	);	

	$wp_customize->add_control( 
		'hdr_nav_contact_subttl2',
		array(
		    'label'   => __('Subtitle','daizy'),
		    'section' => 'hdr_nav_contact_info2',
			'type' => 'text',
		)  
	);
	
	// Link
	$wp_customize->add_setting(
    	'hdr_nav_contact_link2',
    	array(
			'sanitize_callback' => 'specia_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority'      => 16,
		)
	);	

	$wp_customize->add_control( 
		'hdr_nav_contact_link2',
		array(
		    'label'   => __('Link','daizy'),
		    'section' => 'hdr_nav_contact_info2',
			'type' => 'text',
		)  
	);
	
	// Mobile Logo // 
    $wp_customize->add_setting( 
    	'mobile_logo' , 
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_url',	
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'mobile_logo' ,
		array(
			'label'        => 'Mobile Logo',
			'section'        => 'title_tagline',
			'settings'   	 => 'mobile_logo',
		) 
	));
	
	
}

add_action( 'customize_register', 'daizy_header_setting' );

// Header section selective refresh
function daizy_header_section_partials( $wp_customize ){
	
	//hdr_nav_contact_ttl2
	$wp_customize->selective_refresh->add_partial( 'hdr_nav_contact_ttl2', array(
		'selector'            => '.navigator-wrapper .menu-right .contact-area .text',
		'settings'            => 'hdr_nav_contact_ttl2',
		'render_callback'  => 'daizy_hdr_nav_contact_ttl2_render_callback',	
	) );
	
	//hdr_nav_contact_subttl2
	$wp_customize->selective_refresh->add_partial( 'hdr_nav_contact_subttl2', array(
		'selector'            => '.navigator-wrapper .menu-right .contact-area .title',
		'settings'            => 'hdr_nav_contact_subttl2',
		'render_callback'  => 'daizy_hdr_nav_contact_subttl2_render_callback',	
	) );
	}

add_action( 'customize_register', 'daizy_header_section_partials' );

// hdr_nav_contact_ttl2
function daizy_hdr_nav_contact_ttl2_render_callback() {
	return get_theme_mod( 'hdr_nav_contact_ttl2' );
}

// hdr_nav_contact_subttl2
function daizy_hdr_nav_contact_subttl2_render_callback() {
	return get_theme_mod( 'hdr_nav_contact_subttl2' );
}