<?php
/* Notifications in customizer */


require get_template_directory() . '/inc/customizer-notify/specia-customizer-notify.php';
$specia_config_customizer = array(
	'recommended_plugins'       => array(
		'specia-companion' => array(
			'recommended' => true,
			'description' => sprintf(__('Install and activate <strong>Specia Companion</strong> plugin for taking full advantage of all the features this theme has to offer.', 'specia')),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'specia' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'specia' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'specia' ),
	'activate_button_label'     => esc_html__( 'Activate', 'specia' ),
	'specia_deactivate_button_label'   => esc_html__( 'Deactivate', 'specia' ),
);
Specia_Customizer_Notify::init( apply_filters( 'specia_customizer_notify_array', $specia_config_customizer ) );
?>