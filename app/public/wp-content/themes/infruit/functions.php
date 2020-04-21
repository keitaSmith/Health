<?php
/**
 * Infruit functions and definitions
 *
 * @package Infruit
 */

if ( ! function_exists( 'infruit_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function infruit_setup() {
	 global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain('infruit');
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('infruit-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'infruit' ),		
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( array( 'editor-style.css', infruit_font_url() ) );
}
endif; // infruit_setup
add_action( 'after_setup_theme', 'infruit_setup' );
 
/**
 * Check the logo if existing.
 */
function infruit_get_the_logo_url() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
	if ( $custom_logo_id ) {
		return $image[0];
	} else {
		return null;
	}
}

/**
 * Sidebar Register 
 */
function infruit_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'infruit' ),
		'description'   => __( 'Appears on blog page as sidebar. It will be displayed only in sidebar and single blog post.', 'infruit' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	

	//Footer widget areas
	$widget_areas = get_theme_mod('footer_widget_areas', '4');
	for ($i=1; $i<=$widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer ', 'infruit' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s widget-list widget_text">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}

}
add_action( 'widgets_init', 'infruit_widgets_init' );

function infruit_font_url(){
		$font_url = '';
		
		/* Translators: If there are any character that are
		* not supported by Playfair Display, translate this to off, do not
		* translate into your own language.
		*/
		$playd = _x('on', 'Playfair Display font:on or off','infruit');
		
		/* Translators: If there are any character that are
		* not supported by Roboto, translate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on', 'Roboto font:on or off','infruit');
		
		/* Translators: If there are any character that are
		* not supported by Oswald, translate this to off, do not
		* translate into your own language.
		*/
		$oswald = _x('on', 'Oswald font:on or off','infruit');
		
		if('off' !== $playd || 'off' !== $roboto || 'off' !== $oswald ){
			$font_family = array();
		
			if('off' !== $playd){
				$font_family[] = 'Playfair Display:400,700';
			}
			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:400,700';
			}
			
			if('off' !== $oswald){
				$font_family[]= 'Oswald:400,700';
			}

			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'https://fonts.googleapis.com/css');
		}
		
	return $font_url;
	}

/**
 * CSS And JS Enqueue 
 */		
	
function infruit_scripts() {
	wp_enqueue_style( 'infruit-font', infruit_font_url(), array() );
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/css/bootstrap.css' );
	
	
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri().'/css/font-awesome.css' );
	
	wp_enqueue_style( 'infruit-slider-style', get_template_directory_uri().'/css/bs-slider.css');
	wp_enqueue_style( 'infruit-multi-style', get_template_directory_uri().'/css/multi.css' );
	wp_enqueue_style( 'slicknav-style', get_template_directory_uri().'/css/slicknav.css' );
	wp_enqueue_style( 'infruit-color-style', get_template_directory_uri().'/css/color.css' );
	wp_enqueue_style( 'infruit-style', get_stylesheet_uri() );
	 wp_enqueue_style( 'infruit-editor-style', get_template_directory_uri().'/editor-style.css' );
	wp_enqueue_style( 'infruit-responsive-style', get_template_directory_uri().'/css/responsive.css' );



	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'slicknav-js', get_template_directory_uri() . '/js/jquery.slicknav.js', array('jquery') );
	wp_enqueue_script( 'infruit-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	wp_enqueue_script( 'infruit-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), true );

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'infruit_scripts' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function infruit_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'infruit_front_page_template' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Breadcrumb additions
 */

require get_template_directory(). '/breadcrumb.php';

require get_template_directory() . '/inc/breadcrumbs-trail.php';

function infruit_css(){

$primary_color = get_theme_mod( 'color_scheme', '#1dbe6f' );
$menu_color = get_theme_mod('menu_color','#1dbe6f');
$footer_color = get_theme_mod('footer_color','#282a2b');
$header_color = get_theme_mod('header_color','#ffffff');


	$css      = '';
    $css      .= '
				.d-tags li a:hover,.slide-effect:hover,.slide-text a.btn-default.active,.blog a.read-more:hover,.work-section .work-btns li a:hover,.work-section .work-btns li a.active.pagination>.active>a , .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover , .page-numbers.current, .page-numbers.current>a:focus, .page-numbers.current>a:hover , .slide-text a.btn-default.active,.page-numbers:hover{
                     border-color: ' . esc_attr( $primary_color) . ';
                }';

	 $css      .='
	 			.h1 a,.h2 a,.h3 a,.h4 a,.h5 a,.h6 a,h1 a,h2 a,h3 a,h5 a:hover,h6 a,a:focus,a:hover,.icon i,.color-common,.nav>li>a:focus,.nav>li>a:hover,.nav>li.active > a,.dark-colaud .colud-content .tag-line> span,.blog h4:hover,.page-title .breadcrumb a:hover,.blog-title a:hover,.page-title h3,.comment-section h4,.comments ul li a,.slide-text a:hover,.iTyped-preview,.iTyped,footer .widget_text .footer_social span a:hover,footer .widget-list ul li a:hover,footer .wid_contact .wid-con-list li a:hover,.theme-color,.btn-custom:hover,.slide-text a:active.widget_recent_entries  a:hover , .widget_recent_comments a:hover , .calendar_wrap td a , .widget_pages li a:hover , .widget_nav_menu li a:hover , .widget_recent_comments li a:hover, .widget_meta li a:hover , .comment-reply-link , .slicknav_nav a:hover,.slicknav_nav .slicknav_row:hover  a,.slicknav_nav .slicknav_row:hover ,
					.widget_recent_entries a:hover, .widget_recent_comments a:hover,.copyright.pTB-30 span a,
	 			 .cheak-list li> i ,.error-box h2 > span{
					color:' . esc_attr( $primary_color) . ';
				}';

				 $css      .='
				 	.bg-dark,.navbar-nav>li>a:before,.faq-box a:after,.skill-panel,.faq-box a,.blogs a.read-more:hover,.contact-area .btn-submit,.work-section .work-btns li a:hover,.work-section .work-btns li a.active,.blog:hover .date,.blog a.read-more:hover,.team ul.social li a:hover,.slider-main .indicators-line>.carousel-indicators .active,.carousel-indicators .active,.slide-text a:hover,.slide-text a:active,.dark-colaud  .colaud-btn .default-btn,.blog-sidebar .tag-cloud li a:hover,.featured-pic:hover .date,.slide-effect:hover,.preloader .spinner,.testi-panel .carousel-indicators li.active,.slide-text a.btn-default.active,.search-form .btn:focus,.blog-page a.read-more:hover,.pagination>.active>a,.pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover,.comment-form .btn-submit,.d-tags li a:hover,.contact-area ul.social li a:hover.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover , .tagcloud a:hover , .page-numbers.current,
					 	.comment-respond .form-submit input,
					 	 .page-numbers.current>a:focus, .page-numbers.current>a:hover,.page-numbers:hover ,.abt-read-btn:hover{
					background-color:' . esc_attr( $primary_color) . ';
				}';
				
 $css      .='
				.main-nav ul li a:hover,
				.sitenav ul li a:hover, 
				.sitenav ul li.current_page_item a, 
				.sitenav ul li:hover a.parent,
				.sitenav ul li ul.sub-menu li a:hover, 
				.sitenav ul li.current_page_item ul.sub-menu li a:hover, 
				.sitenav ul li ul.sub-menu li.current_page_item a{
					color:' . esc_attr( $menu_color) . ';
				}';
 $css      .='
				.copyright , footer{
					background-color:' . esc_attr( $footer_color) . ';
				}';

$css      .='
				#header{
					background-color:' . esc_attr( $header_color) . ';
				}';
$css      .='			
			    .main-navigation #primary-menu>li.menu-item-has-children> a:hover , .menu-item a:hover {
					color:' . esc_attr( $menu_color) . '; !important;
				}';	
                 
$css      .='
 	               .main-navigation #primary-menu>li>a:before{
					background-color:' . esc_attr( $menu_color) . ' !important;
				}';			

	wp_add_inline_style( 'infruit-style', $css );
}
add_action( 'wp_enqueue_scripts', 'infruit_css' );


/**
 * Load Upsell Button In Customizer
 * 2016 &copy; [Justin Tadlock](http://justintadlock.com).
 */


require_once( trailingslashit( get_template_directory() ) . '/inc/upgrade/class-customize.php' );

// Include infruit Upgrade page
require get_template_directory() . '/upgrade/upgrade.php';

/**
 * Admin notice to enter a purchase license
 */
function infruit_add_license_notice() {
	global $current_user;
	$infruit_user_id = $current_user->ID;

	if ( !get_user_meta( $infruit_user_id, 'infruit_license_dismiss_count' ) ) : ?>
		<div class="notice notice-info infruit-admin-notice infruit-notice-add">
			<h4><?php esc_html_e( 'Thank you for trying out infruit !', 'infruit' ); ?></h4>
			<?php
			/* translators: 1: 'giving us a review'. */
			printf( esc_html__( 'We\'re here to help... %1$s and get help on how to easily build a professional website... And feel free to %2$s on using infruit.', 'infruit' ), wp_kses( '<a href="' . admin_url( 'themes.php?page=theme_info' ) . '" class="infruit-admin-notice-a">' . __( 'Read More on Using the infruit Theme', 'infruit' ) . '</a>', array( 'a' => array( 'href' => array(), 'class' => array() ) ) ), wp_kses( '<a href="' . admin_url( 'themes.php?page=theme_info' ) . '" class="infruit-admin-notice-a">' . __( 'Contact Us for Support', 'infruit' ) . '</a>', array( 'a' => array( 'href' => array(), 'class' => array() ) ) ) ); ?>
			<a href="?infruit_add_license_notice_ignore=" class="infruit-notice-close"><?php esc_html_e( 'Dismiss Notice', 'infruit' ); ?></a>
		</div><?php
	endif;
}
add_action( 'admin_notices', 'infruit_add_license_notice' );

/**
 * Enqueue admin styling.
 */
function infruit_admin_scripts() {
	// global $pagenow;
	// if ( $pagenow == 'widgets.php' ) {
		wp_enqueue_style( 'infruit-admin-css', get_template_directory_uri() . '/inc/admin/admin.css', array(), '');
	// }
}
add_action( 'admin_enqueue_scripts', 'infruit_admin_scripts' );