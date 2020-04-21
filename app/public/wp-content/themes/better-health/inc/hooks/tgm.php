<?php
/**
 * Recommended plugins
 *
 * @package Better Health
 */
if ( ! function_exists( 'better_health_recommended_plugins' ) ) :
	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.0
	 */
	function better_health_recommended_plugins() {
		
		$plugins = array(

			array(
				'name'     => esc_html__( 'One Click Demo Import', 'better-health' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			),
			
			array(
				'name'     => esc_html__( 'Contact Us', 'better-health' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),

			array(
				'name'     => esc_html__( 'WooCommerce', 'better-health' ),
				'slug'     => 'woocommerce',
				'required' => false,
			),

            array(
				'name'     => esc_html__( 'Gutentor', 'better-health' ),
				'slug'     => 'gutentor',
				'required' => false,
			),

		);
		tgmpa( $plugins );
	}
endif;
add_action( 'tgmpa_register', 'better_health_recommended_plugins' );
