<?php

class Specia_Customizer_Notify {

	private $recommended_actions;

	
	private $recommended_plugins;

	
	private static $instance;

	
	private $recommended_actions_title;

	
	private $recommended_plugins_title;

	
	private $dismiss_button;

	
	private $install_button_label;

	
	private $activate_button_label;

	
	private $specia_deactivate_button_label;
	
	
	private $config;

	
	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Specia_Customizer_Notify ) ) {
			self::$instance = new Specia_Customizer_Notify;
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}

	
	public function setup_config() {

		global $specia_customizer_notify_recommended_plugins;
		global $specia_customizer_notify_recommended_actions;

		global $install_button_label;
		global $activate_button_label;
		global $specia_deactivate_button_label;

		$this->recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();

		$this->recommended_actions_title = isset( $this->config['recommended_actions_title'] ) ? $this->config['recommended_actions_title'] : '';
		$this->recommended_plugins_title = isset( $this->config['recommended_plugins_title'] ) ? $this->config['recommended_plugins_title'] : '';
		$this->dismiss_button            = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$specia_customizer_notify_recommended_plugins = array();
		$specia_customizer_notify_recommended_actions = array();

		if ( isset( $this->recommended_plugins ) ) {
			$specia_customizer_notify_recommended_plugins = $this->recommended_plugins;
		}

		if ( isset( $this->recommended_actions ) ) {
			$specia_customizer_notify_recommended_actions = $this->recommended_actions;
		}

		$install_button_label    = isset( $this->config['install_button_label'] ) ? $this->config['install_button_label'] : '';
		$activate_button_label   = isset( $this->config['activate_button_label'] ) ? $this->config['activate_button_label'] : '';
		$specia_deactivate_button_label = isset( $this->config['specia_deactivate_button_label'] ) ? $this->config['specia_deactivate_button_label'] : '';

	}

	
	public function setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'specia_plugin_notification_customize_register' ) );

		// Enqueue scripts and styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'specia_customizer_notify_scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended actions */
		add_action( 'wp_ajax_quality_customizer_notify_dismiss_action', array( $this, 'specia_customizer_notify_dismiss_recommended_action_callback' ) );

		add_action( 'wp_ajax_ti_customizer_notify_dismiss_recommended_plugins', array( $this, 'specia_customizer_notify_dismiss_recommended_plugins_callback' ) );

	}

	
	public function specia_customizer_notify_scripts_for_customizer() {

		wp_enqueue_style( 'specia-customizer-notify-css', get_template_directory_uri() . '/inc/customizer-notify/css/specia-customizer-notify.css', array());

		wp_enqueue_style( 'specia-plugin-install' );
		wp_enqueue_script( 'specia-plugin-install' );
		wp_add_inline_script( 'specia-plugin-install', 'var pagenow = "customizer";' );

		wp_enqueue_script( 'specia-updates' );

		wp_enqueue_script( 'specia-customizer-notify-js', get_template_directory_uri() . '/inc/customizer-notify/js/specia-customizer-notify.js', array( 'customize-controls' ));
		wp_localize_script(
			'specia-customizer-notify-js', 'SpeciaCustomizercompanionObject', array(
				'specia_ajaxurl'            => esc_url(admin_url( 'admin-ajax.php' )),
				'specia_template_directory' => esc_url(get_template_directory_uri()),
				'specia_base_path'          => esc_url(admin_url()),
				'specia_activating_string'  => __( 'Activating', 'specia' ),
			)
		);

	}

	
	public function specia_plugin_notification_customize_register( $wp_customize ) {

		
		require_once get_template_directory() . '/inc/customizer-notify/specia-customizer-notify-section.php';

		$wp_customize->register_section_type( 'Specia_Customizer_Notify_Section' );

		$wp_customize->add_section(
			new Specia_Customizer_Notify_Section(
				$wp_customize,
				'Specia-customizer-notify-section',
				array(
					'title'          => $this->recommended_actions_title,
					'plugin_text'    => $this->recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}

	
	public function specia_customizer_notify_dismiss_recommended_action_callback() {

		global $specia_customizer_notify_recommended_actions;

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html($action_id); 

		if ( ! empty( $action_id ) ) {

			
			if ( get_theme_mod( 'specia_customizer_notify_show' ) ) {

				$specia_customizer_notify_show_recommended_actions = get_theme_mod( 'specia_customizer_notify_show' );
				switch ( $_GET['todo'] ) {
					case 'add':
						$specia_customizer_notify_show_recommended_actions[ $action_id ] = true;
						break;
					case 'dismiss':
						$specia_customizer_notify_show_recommended_actions[ $action_id ] = false;
						break;
				}
				echo esc_html($specia_customizer_notify_show_recommended_actions);
				
			} else {
				$specia_customizer_notify_show_recommended_actions = array();
				if ( ! empty( $specia_customizer_notify_recommended_actions ) ) {
					foreach ( $specia_customizer_notify_recommended_actions as $specia_lite_customizer_notify_recommended_action ) {
						if ( $specia_lite_customizer_notify_recommended_action['id'] == $action_id ) {
							$specia_customizer_notify_show_recommended_actions[ $specia_lite_customizer_notify_recommended_action['id'] ] = false;
						} else {
							$specia_customizer_notify_show_recommended_actions[ $specia_lite_customizer_notify_recommended_action['id'] ] = true;
						}
					}
					echo esc_html($specia_customizer_notify_show_recommended_actions);
				}
			}
		}
		die(); 
	}

	
	public function specia_customizer_notify_dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html($action_id); 

		if ( ! empty( $action_id ) ) {

		if ( get_theme_mod( 'specia_customizer_notify_show_recommended_plugins' ) ) {
			$specia_lite_customizer_notify_show_recommended_plugins = get_theme_mod( 'specia_customizer_notify_show_recommended_plugins' );

			switch ( $_GET['todo'] ) {
				case 'add':
					$specia_lite_customizer_notify_show_recommended_plugins[ $action_id ] = false;
					break;
				case 'dismiss':
					$specia_lite_customizer_notify_show_recommended_plugins[ $action_id ] = true;
					break;
			}
			echo esc_html($specia_lite_customizer_notify_show_recommended_plugins);
			
		} else {
				$specia_lite_customizer_notify_show_recommended_plugins = array();
				if ( ! empty( $specia_customizer_notify_recommended_plugins ) ) {
					foreach ( $specia_customizer_notify_recommended_plugins as $specia_lite_customizer_notify_recommended_plugin ) {
						if ( $specia_lite_customizer_notify_recommended_plugin['id'] == $action_id ) {
							$specia_lite_customizer_notify_show_recommended_plugins[ $specia_lite_customizer_notify_recommended_plugin['id'] ] = true;
						} else {
							$specia_lite_customizer_notify_show_recommended_plugins[ $specia_lite_customizer_notify_recommended_plugin['id'] ] = false;
						}
					}
					echo esc_html($specia_lite_customizer_notify_show_recommended_plugins);
				}
			}
		}
		die(); 
	}

}
