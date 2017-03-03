<?php
/**
 * Dokan customizer
 *
 * @author WeDevs
 */
class Dokan_Customizer {

    function __construct() {
        add_action( 'customize_register', array($this, 'register_control') );
        add_action( 'wp_head', array($this, 'generate_styles'), 99 );
        add_action( 'customize_preview_init', array($this, 'customizer_scripts' ) );
    }

    function register_control( $wp_customize ) {

        // logo
        $wp_customize->add_section( 'dokan_logo_section', array(
            'title' => __( 'Theme Logo', 'dokan' ),
            'priority' => 9,
            'description' => __( 'Upload your logo to replace the default Logo (dimension : 180 X 50)', 'dokan' ),
        ) );

        $wp_customize->add_setting( 'dokan_logo' );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dokan_logo', array(
            'label' => __( 'Upload Logo', 'dokan' ),
            'section' => 'dokan_logo_section',
            'settings' => 'dokan_logo',
        ) ) );

        // link color
        $wp_customize->add_setting( 'dokan_link_color', array(
            'default' => '#f05025',
            'transport' => 'postMessage'
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_link_color', array(
            'label' => __( 'Link', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_link_color',
            'priority' => 20
        ) ) );


        // link hover color
        $wp_customize->add_setting( 'dokan_link_hover_color', array(
            'default' => '#aa0000',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_link_hover_color', array(
            'label' => __( 'Link hover', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_link_hover_color',
            'priority' => 25
        ) ) );

        // Header Background color
        $wp_customize->add_setting( 'dokan_header_bg', array(
            'default' => '#fff',
            'transport' => 'postMessage'
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_header_bg', array(
            'label' => __( 'Header Background', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_header_bg',
            'priority' => 30
        ) ) );

        // nav backgroung color
        $wp_customize->add_setting( 'dokan_nav_bg', array(
            'default' => '#fff',
            'transport' => 'postMessage'
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_nav_bg', array(
            'label' => __( 'Navigation Background', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_nav_bg',
            'priority' => 33
        ) ) );

        // nav color
        $wp_customize->add_setting( 'dokan_nav_color', array(
            'default' => '#777777',
            'transport' => 'postMessage'
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_nav_color', array(
            'label' => __( 'Navigation Link', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_nav_color',
            'priority' => 35
        ) ) );

        // nav hover color
        $wp_customize->add_setting( 'dokan_nav_hover', array(
            'default' => '#333',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_nav_hover', array(
            'label' => __( 'Navigation Link Hover', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_nav_hover',
            'priority' => 40
        ) ) );

        // Footer Background color
        $wp_customize->add_setting( 'dokan_footer_bg', array(
            'default' => '#393939',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_footer_bg', array(
            'label' => __( 'Footer Background', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_footer_bg',
            'priority' => 50
        ) ) );

        // Footer bottom bar Background color
        $wp_customize->add_setting( 'dokan_footer_bottom_bar_bg_color', array(
            'default' => '#242424',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_footer_bottom_bar_bg_color', array(
            'label' => __( 'Copy Container Background', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_footer_bottom_bar_bg_color',
            'priority' => 50
        ) ) );

        // footer text color
        $wp_customize->add_setting( 'dokan_footer_text', array(
            'default' => '#E8E8E8',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_footer_text', array(
            'label' => __( 'Footer text', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_footer_text',
            'priority' => 55
        ) ) );

        // Siebar widget header color
        $wp_customize->add_setting( 'sidebar_widget_header', array(
            'default' => '#222222',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_widget_header', array(
            'label' => __( 'Sidebar widget header', 'dokan' ),
            'section' => 'colors',
            'settings' => 'sidebar_widget_header',
            'priority' => 56
        ) ) );

        // widget header color
        $wp_customize->add_setting( 'footer_widget_header', array(
            'default' => '#E8E8E8',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_widget_header', array(
            'label' => __( 'Footer widget header', 'dokan' ),
            'section' => 'colors',
            'settings' => 'footer_widget_header',
            'priority' => 60
        ) ) );


        // widget text color
        $wp_customize->add_setting( 'dokan_footer_widget_link', array(
            'default' => '#AFAFAF',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_footer_widget_link', array(
            'label' => __( 'Footer Widget link', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_footer_widget_link',
            'priority' => 65
        ) ) );

        // widget text hover color
        $wp_customize->add_setting( 'dokan_footer_link_hover', array(
            'default' => '#E8E8E8',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dokan_footer_link_hover', array(
            'label' => __( 'Footer Widget link hover', 'dokan' ),
            'section' => 'colors',
            'settings' => 'dokan_footer_link_hover',
            'priority' => 70
        ) ) );
    }

    function generate_styles() {
        ?>
        
        <?php
    }

    function customizer_scripts() {
        $url = get_template_directory_uri() . '/assets/js/theme-customizer.js';
        wp_enqueue_script( 'dokan-theme-customizer', $url, array('jquery', 'customize-preview') );
    }

}

new Dokan_Customizer();