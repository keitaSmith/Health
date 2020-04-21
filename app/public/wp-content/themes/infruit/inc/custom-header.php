<?php
/**
 * @package Infruit
 * Setup the WordPress core custom header feature.
 *
 * @uses infruit_header_style()

 */
function infruit_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'infruit_custom_header_args', array(
		'default-image'     => get_template_directory_uri() .'/images/header.jpg',
		'default-text-color'     => 'fff',
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'infruit_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'infruit_custom_header_setup' );

if ( ! function_exists( 'infruit_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see infruit_custom_header_setup().
 */
function infruit_header_style() {
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if (get_header_textcolor() ) :
	?>
		.brand-logo h1 a , .brand-logo p{ color:#<?php echo esc_attr(get_header_textcolor()); ?>;}
	<?php endif; 
	if (get_header_image() ) : ?>
     .page-title{
			background: url(<?php echo esc_url(get_header_image()); ?>) no-repeat center center;
			background-size:cover ;
		}
     <?php endif;
		?>
	</style>
	<?php
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
    <style type="text/css">
		.logo {
			margin: 0 auto 0 0;
		}

		.logo h1,
		.logo p{
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
    </style>
	
    <?php
	
}
endif; // infruit_header_style