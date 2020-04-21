<?php
/**
 * Infruit Theme Customizer
 *
 * @package Infruit
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function infruit_customize_register( $wp_customize ) {
 

    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
        
    $wp_customize->add_setting('color_scheme', array(
        'default' => '#1dbe6f',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
            'label' => __('Color Scheme','infruit'),
            'description'   =>__('Select color from here.','infruit'),
            'section' => 'colors',
            'settings' => 'color_scheme'
        ))
    );
        
    $wp_customize->add_setting('menu_color', array(
        'default' => '#1dbe6f',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control($wp_customize,'menu_color',array(
            'description'   => __('Select hover color for menu.','infruit'),
            'section' => 'colors',
            'settings' => 'menu_color'
        ))
    );
    
    $wp_customize->add_setting('footer_color', array(
        'default' => '#282a2b',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control($wp_customize,'footer_color',array(
            'description'   => __('Select background color for footer.','infruit'),
            'section' => 'colors',
            'settings' => 'footer_color'
        ))
    );
     /** Front Page Section Settings starts **/     

        $wp_customize->add_panel('frontpage', 
            array(
                'title' => __('Theme Settings','infruit'),        
                'description' => '',                                        
                'priority' => 3,
            )
        );
    
    
    // Slider Section Start     
    $wp_customize->add_section(
        'infruit_slider_section',
        array(
            'title' => __('Slider Settings','infruit'),
            'priority' => null,
            'description'   => __('Recommended image size (1420x567). Slider will be visible only when you select static front page.','infruit'),   
            'panel' => 'frontpage',
        )
    );
    

        $infruit_slider_no = 3;
        for( $i = 1; $i <= $infruit_slider_no; $i++ ) {
            $infruit_slider_page   = 'infruit_slider_page_' .$i;


    $wp_customize->add_setting( $infruit_slider_page,
        array(
            'default'           => 1,
            'sanitize_callback' => 'infruit_sanitize_dropdown_pages',
        )
    );

    $wp_customize->add_control( $infruit_slider_page,
        array(
            'label'     => __( 'Slider Page ', 'infruit' ) .$i,
            'section'   => 'infruit_slider_section',
            'type'      => 'dropdown-pages',
            'priority'  => 100,
        )
    );

                
    }


    $wp_customize->add_setting( 'infruit_slider_btntxt1',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( 'infruit_slider_btntxt1',
        array(
            'label'        => __( 'Add Slider Button Text 1','infruit' ),
            'section'      => 'infruit_slider_section',
            'type'         => 'text',
            'priority'     => 120,
        )
    );
        
    $wp_customize->add_setting( 'infruit_slider_btnurl1',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control('infruit_slider_btnurl1',
        array(
            'label'       => __( 'Add Slider Button Text URL', 'infruit' ),
            'section'     => 'infruit_slider_section',
            'type'        => 'url',
            'priority'    => 130,
        )
    );


    $wp_customize->add_setting( 'infruit_slider_btntxt2',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( 'infruit_slider_btntxt2',
        array(
            'label'        => __( 'Add Slider Button Text 2','infruit' ),
            'section'      => 'infruit_slider_section',
            'type'         => 'text',
            'priority'     => 140,
        )
    );
        
    $wp_customize->add_setting( 'infruit_slider_btnurl2',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control('infruit_slider_btnurl2',
        array(
            'label'       => __( 'Add Slider Button Text URL 2', 'infruit' ),
            'section'     => 'infruit_slider_section',
            'type'        => 'url',
            'priority'    => 150,
        )
    );

    $wp_customize->add_setting('hide_slider',array(
            'default' => true,
            'sanitize_callback' => 'infruit_sanitize_checkbox',
            'capability' => 'edit_theme_options',
    ));  

    $wp_customize->add_control( 'hide_slider', array(
           'section'   => 'infruit_slider_section',
           'label'     => __('Check this to hide slider','infruit'),
           'type'      => 'checkbox'
     ));    
    
    // Slider Section End   
    
    // About Info       
    $wp_customize->add_section(
        'infruit_about_section',
        array(
            'title' => __('About Info','infruit'),
            'priority' => null,
            'description'   => __('Add content for About section','infruit'),   
            'panel' => 'frontpage',
        )
    );

  

    $wp_customize->add_setting('infruit_about_page',array(
            'default' => '',
            'capability' => 'edit_theme_options',   
            'sanitize_callback' => 'absint'
    ));
    
    $wp_customize->add_control('infruit_about_page',array(
            'type'  => 'dropdown-pages',
            'label' => __('Select page for about section:','infruit'),
            'section'   => 'infruit_about_section'
    )); 

    $wp_customize->add_setting('about_text',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('about_text',array(
        'label' => __('Add About link button text.','infruit'),
        'section'   => 'infruit_about_section',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('about_read_link', 
        array(
            'default'   =>  '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('about_read_link', 
        array(
            'label'   => __('Read More Button URL','infruit'),
            'section' => 'infruit_about_section',
        )
    );
    
    $wp_customize->add_setting('hide_about',array(
            'default' => false,
            'sanitize_callback' => 'infruit_sanitize_checkbox',
            'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control( 'hide_about', array(
           'section'   => 'infruit_about_section',
           'label'     => __('Check this to hide about section','infruit'),
           'type'      => 'checkbox'
     ));


    // Service Info     
    $wp_customize->add_section(
        'infruit_service_section',
        array(
            'title' => __('Service Info','infruit'),
            'priority' => null,
            'description'   => __('Add content for Service section','infruit'), 
            'panel' => 'frontpage',
        )
    );

    $wp_customize->add_setting('service_title',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('service_title',array(
        'label' => __('Add service title text.','infruit'),
        'section'   => 'infruit_service_section',
        'type'  => 'text'
    ));

    
        $infruit_service_no = 6;
        for( $i = 1; $i <= $infruit_service_no; $i++ ) {
            $infruit_service_page   = 'infruit_service_page_' .$i;
            $infruit_service_page_icon = 'infruit_service_page_icon_'.$i;

    $wp_customize->add_setting( $infruit_service_page,
        array(
            'default'           => 1,
            'sanitize_callback' => 'infruit_sanitize_dropdown_pages',
        )
    );

    $wp_customize->add_control( $infruit_service_page,
        array(
            'label'     => __( 'Service Page ', 'infruit' ) .$i,
            'section'   => 'infruit_service_section',
            'type'      => 'dropdown-pages',
            
        )
    );


$wp_customize->add_setting($infruit_service_page_icon,
    array(
            'default' => 'fa-facebook',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control($infruit_service_page_icon ,
        array(
            'type'  => 'text',
            'label' => __('Service Icon','infruit').$i,
            'description' => sprintf('Use Font Awesome Icon Eg.fa-facebook'
                ),
            'section'   => 'infruit_service_section'
    ));
                
    }



    $wp_customize->add_setting('hide_service',array(
            'default' => false,
            'sanitize_callback' => 'infruit_sanitize_checkbox',
            'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control( 'hide_service', array(
           'section'   => 'infruit_service_section',
           'label'     => __('Check this to hide service section','infruit'),
           'type'      => 'checkbox'
     ));


      
    // Callout Info

    $wp_customize->add_section(
        'infruit_callout_section',
        array(
            'title' => __('Callout Info','infruit'),
            'priority' => null,
            'description'   => __('Add content for callout section','infruit'), 
            'panel' => 'frontpage',
        )
    );

    $wp_customize->add_setting('callout_title',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('callout_title',array(
        'label' => __('add callout title','infruit'),
        'section'   => 'infruit_callout_section',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('callout_text',array(
        'default'   =>'',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('callout_text',array(
        'label' => __('Add callout link button text.','infruit'),
        'section'   => 'infruit_callout_section',
        'type'  => 'text'
    ));
    
    $wp_customize->add_setting('callout_btn_link', 
        array(
            'default'   =>  '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('callout_btn_link', 
        array(
            'label'   => __('Button URL','infruit'),
            'section' => 'infruit_callout_section',
        )
    );


    $wp_customize->add_setting('hide_callout',array(
            'default' => false,
            'sanitize_callback' => 'infruit_sanitize_checkbox',
            'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control( 'hide_callout', array(
           'section'   => 'infruit_callout_section',
           'label'     => __('Check this to hide callout section','infruit'),
           'type'      => 'checkbox'
     ));
    

    // Blog Info

    $wp_customize->add_section(
        'infruit_blog_section',
        array(
            'title' => __('Blog Info','infruit'),
            'priority' => null,
            'description'   => __('Add content for Blog section','infruit'),
            'panel' => 'frontpage', 
        )
    );

    $wp_customize->add_setting('blog_title',array(
        'default'   => 'Recent Blog Post',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('blog_title',array(
        'label' => __('Add blog title text.','infruit'),
        'section'   => 'infruit_blog_section',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('hide_blog',array(
            'default' => false,
            'sanitize_callback' => 'infruit_sanitize_checkbox',
            'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control( 'hide_blog', array(
           'section'   => 'infruit_blog_section',
           'label'     => __('Check this to hide blog section','infruit'),
           'type'      => 'checkbox'
     ));
    

    // Footer Info

$wp_customize->add_section(
        'infruit_footer_section',
        array(
            'title' => __('Footer Info','infruit'),
            'priority' => null,
            'description'   => __('Add content for Footer section','infruit'),  
            'panel' => 'frontpage', 
        )
    );

    //Front page
    $wp_customize->add_setting(
        'footer_widget_areas',
        array(
            'default'           => '3',
            'sanitize_callback' => 'infruit_sanitize_fw',
        )
    );
    $wp_customize->add_control(
        'footer_widget_areas',
        array(
            'type'        => 'radio',
            'label'       => __('Footer widget area','infruit'),
            'section'     => 'infruit_footer_section',
            'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.','infruit'),
            'choices' => array(
                '1'     => __('One', 'infruit'),
                '2'     => __('Two', 'infruit'),
                '3'     => __('Three', 'infruit'),
                '4'     => __('Four', 'infruit')
            ),
        )
    );

    $wp_customize->add_setting('hide_footer',array(
            'default' => false,
            'sanitize_callback' => 'infruit_sanitize_checkbox',
            'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control( 'hide_footer', array(
           'section'   => 'infruit_footer_section',
           'label'     => __('Check this to hide footer section','infruit'),
           'type'      => 'checkbox'
     ));
    
}
    
    
add_action( 'customize_register', 'infruit_customize_register' );
    
function infruit_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

//Footer widget areas
function infruit_sanitize_fw( $input ) {
    $valid = array(
        '1'     => __('One', 'infruit'),
        '2'     => __('Two', 'infruit'),
        '3'     => __('Three', 'infruit'),
        '4'     => __('Four', 'infruit')
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

    function infruit_sanitize_dropdown_pages( $page_id, $setting ) {
        // Ensure $input is an absolute integer.
        $page_id = absint( $page_id );
    
        // If $page_id is an ID of a published page, return it; otherwise, return the default.
        return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
    }