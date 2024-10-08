<?php
class specia_import_dummy_data {

	private static $instance;

	public static function init( ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof specia_import_dummy_data ) ) {
			self::$instance = new specia_import_dummy_data;
			self::$instance->specia_setup_actions();
		}

	}

	/**
	 * Setup the class props based on the config array.
	 */
	

	/**
	 * Setup the actions used for this class.
	 */
	public function specia_setup_actions() {

		// Enqueue scripts
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'specia_import_customize_scripts' ), 0 );

	}
	
	

	public function specia_import_customize_scripts() {

	wp_enqueue_script( 'specia-import-customizer-js', get_template_directory_uri() . '/js/specia-import-customizer.js', array( 'customize-controls' ) );
	}
}

$specia_import_customizers = array(

		'import_data' => array(
			'recommended' => true,
			
		),
);
specia_import_dummy_data::init( apply_filters( 'specia_import_customizer', $specia_import_customizers ) );