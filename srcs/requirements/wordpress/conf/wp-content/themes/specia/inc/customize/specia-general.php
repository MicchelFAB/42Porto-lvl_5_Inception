<?php
function specia_general_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'specia_general', array(
			'priority' => 127,
			'title' => esc_html__( 'General', 'specia' ),
		)
	);
	
	/*=========================================
	Button
	=========================================*/
	$wp_customize->add_section(
        'specia_button_settings',
        array(
        	'priority'      => 1,
            'title' 		=> __('Buttons','specia'),
			'panel' => 'specia_general',
		)
    );
	
	// Border Radius
	$wp_customize->add_setting( 
		'specia_btn_brdr_radius' , 
			array(
			'default' => '100',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'specia_sanitize_integer',
		) 
	);

	$wp_customize->add_control( 
	'specia_btn_brdr_radius', 
		array(
			'section'  => 'specia_button_settings',
			'label'    => __( 'Border Radius (px)','specia' ),
			'type'	   => 'number',
			'input_attrs' => array(
				'min'    => 1,
				'max'    => 100,
				'step'   => 1,
				//'suffix' => 'px', //optional suffix
			),
		 ) 
	);
}

add_action( 'customize_register', 'specia_general_setting' );