<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Infruit
 */ ?>
 
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body  data-offset="50" data-spy="scroll" data-target=".navbar" <?php body_class(); ?>>
<?php
		if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
                do_action( 'wp_body_open' );
        }
	} ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content">
<?php _e( 'Skip to content', 'infruit' ); ?></a>    
  <div class="preloader">
        <div class="spinner">
        </div>
    </div>

    <!-- top top btn  -->
    <a href="<?php esc_url('#','infruit'); ?>" id="to-top" data-toggle="tooltip" data-placement="top" title="<?php esc_attr__('Go to top','infruit'); ?> ">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- top top btn ends -->

<!-- header  -->
    <header>
        <div class="menubar navbar-fixed-top " data-offset="50" data-spy="affix">
            <div class="container">
                <nav class="navbar">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#big-dreams-navbar"
                            data-toggle="collapse" type="button">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div class="brand-logo">
                                <?php   
                            if (has_custom_logo() ) :
                                  the_custom_logo(); 
                            else : 
                                if (display_header_text()==true){ ?>
                                <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                   <p><?php echo esc_html($description); ?></p>
                                <?php endif; ?>
                            <?php } endif; ?>
                            </div>
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse " id="big-dreams-navbar">
                        <nav id="site-navigation" class="main-navigation" role="navigation">
                                <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu_id'        => 'primary-menu',
                                ));
                                ?>
                            </nav>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
    </header>