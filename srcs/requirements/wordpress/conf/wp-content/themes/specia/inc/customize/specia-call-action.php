<?php
function specia_call_action_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Call Action Section Panel
	=========================================*/
	$wp_customize->add_panel( 
		'call_panel', 
		array(
			'priority'      => 128,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Call To Action Section', 'specia'),
		) 
	);
	
	// Call to Action //
	$wp_customize->add_section(
        'call_action_setting',
        array(
        	'priority'      => 1,
            'title' 		=> __('Settings','specia'),
			'panel'  		=> 'call_panel',
		)
    );
	
	$wp_customize->add_setting( 
		'hide_show_call_actions' , 
			array(
			'default' => 'on',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_select',
			'transport'         => $selective_refresh,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_call_actions' , 
		array(
			'label'          => __( 'Hide / Show Section', 'specia' ),
			'section'        => 'call_action_setting',
			'type'           => 'radio',
			'choices'        => 
			array(
				'on' => __( 'Show', 'specia' ),
				'off'=> __( 'Hide', 'specia' )
			)  
		) 
	);
	
	// Call Action Settings Section // 
	$wp_customize->add_section(
        'call_action_content',
        array(
        	'priority'      => 2,
            'title' 		=> __('Content','specia'),
			'panel'  		=> 'call_panel',
		)
    );
	
	
	// Content options
	$wp_customize->add_setting(
		'cta_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'cta_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Contents','specia'),
			'section' => 'call_action_content',
			'priority'  => 3
		)
	);
	
	// Call Action Text// 
	
	$wp_customize->add_setting(
	'call_action_page',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'specia_sanitize_integer',
		)
	);
		
	$wp_customize->add_control(
	'call_action_page',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page','specia'),
			'section'	=> 'call_action_content',
			'priority'  => 4
		)
	);
	
	
	// Content options
	$wp_customize->add_setting(
		'cta_btn_first_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'cta_btn_first_head',
		array(
			'type' => 'hidden',
			'label' => __('Button First','specia'),
			'section' => 'call_action_content',
			'priority'  => 5
		)
	);
	
	// Call Button Label // 
	$wp_customize->add_setting(
    	'call_action_button_label',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_text',
			'transport'         => $selective_refresh,
		)
	);	
	
	$wp_customize->add_control( 
		'call_action_button_label',
		array(
		    'label'   => __('Button Text','specia'),
		    'section' => 'call_action_content',
			'type'           => 'text',
			'priority'  => 6
		)  
	);
	
	// Call Button link // 
	$wp_customize->add_setting(
    	'call_action_button_link',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_url',
		)
	);	
	
	$wp_customize->add_control( 
		'call_action_button_link',
		array(
		    'label'   => __('Button Link','specia'),
		    'section' => 'call_action_content',
			'type'           => 'text',
			'priority'  => 7
		)  
	);
	
	
	$wp_customize->add_setting(
		'call_action_button_target'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'call_action_button_target',
			array(
				'type' => 'checkbox',
				'label' => __('Open link in a new tab','specia'),
				'section' => 'call_action_content',
				'priority'  => 8
			)
	);
	
	// Content options
	$wp_customize->add_setting(
		'cta_btn_second_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'cta_btn_second_head',
		array(
			'type' => 'hidden',
			'label' => __('Button Second','specia'),
			'section' => 'call_action_content',
			'priority'  => 8
		)
	);
	
	// Button Middle Content // 
	$wp_customize->add_setting(
    	'call_action_btn_middle_text',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_html',
			'transport'         => $selective_refresh,
		)
	);	
	
	$wp_customize->add_control( 
		'call_action_btn_middle_text',
		array(
		    'label'   => __('Button Middle Content','specia'),
		    'section' => 'call_action_content',
			'type'           => 'text',
			'priority'  => 9
		)  
	);
	
	
	// Call Button Label // 
	$wp_customize->add_setting(
    	'call_action_button_label2',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_html',
			'transport'         => $selective_refresh,
		)
	);	
	
	$wp_customize->add_control( 
		'call_action_button_label2',
		array(
		    'label'   => __('Button Text 2','specia'),
		    'section' => 'call_action_content',
			'type'           => 'text',
			'priority'  => 9
		)  
	);
	
	// Call Button link // 
	$wp_customize->add_setting(
    	'call_action_button_link2',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_url',
		)
	);	
	
	$wp_customize->add_control( 
		'call_action_button_link2',
		array(
		    'label'   => __('Button Link 2','specia'),
		    'section' => 'call_action_content',
			'type'           => 'text',
			'priority'  => 10
		)  
	);
	
	// Background
	$wp_customize->add_setting(
		'cta_bg_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'cta_bg_head',
		array(
			'type' => 'hidden',
			'label' => __('Background Image','specia'),
			'section' => 'call_action_content',
			'priority'  => 16
		)
	);
	
	// Background Image // 
    $wp_customize->add_setting( 
    	'call_action_background_setting' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/images/cta.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_url',
			
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'call_action_background_setting' ,
		array(
			'label'          => __( 'Background Image', 'specia' ),
			'section'        => 'call_action_content',
			'settings'        => 'call_action_background_setting',
			'priority'  => 17
		) 
	));
	
}

add_action( 'customize_register', 'specia_call_action_setting' );

// Call to action selective refresh
function specia_home_cta_section_partials( $wp_customize ){

	// hide_show_call_actions
	$wp_customize->selective_refresh->add_partial(
		'hide_show_call_actions', array(
			'selector' => '.call-to-action',
			'container_inclusive' => true,
			'render_callback' => 'call_action_setting',
			'fallback_refresh' => true,
		)
	);
	
	// call_action_button_label
	$wp_customize->selective_refresh->add_partial( 'call_action_button_label', array(
		'selector'            => '.call-to-action a',
		'settings'            => 'call_action_button_label',
		'render_callback'  => 'specia_call_action_button_label_render_callback',
	) );
	
	// call_action_btn_middle_text
	$wp_customize->selective_refresh->add_partial( 'call_action_btn_middle_text', array(
		'selector'            => '#cta-unique span.cta-or',
		'settings'            => 'call_action_btn_middle_text',
		'render_callback'  => 'specia_call_action_btn_middle_text_render_callback',
	) );
	
	// call_action_button_label2
		$wp_customize->selective_refresh->add_partial( 'call_action_button_label2', array(
			'selector'            => '#cta-unique .cta-info .call-phone a',
			'settings'            => 'call_action_button_label2',
			'render_callback'  => 'specia_call_action_button_label2_render_callback',
		) );
		
	}

add_action( 'customize_register', 'specia_home_cta_section_partials' );

// call_action_button_label
function specia_call_action_button_label_render_callback() {
	return get_theme_mod( 'call_action_button_label' );
}

// call_action_btn_middle_text
function specia_call_action_btn_middle_text_render_callback() {
	return get_theme_mod( 'call_action_btn_middle_text' );
}

// call_action_button_label2
function specia_call_action_button_label2_render_callback() {
	return get_theme_mod( 'call_action_button_label2' );
}

?>