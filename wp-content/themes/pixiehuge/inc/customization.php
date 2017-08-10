<?php
/*=======================*
*   CUSTOMIZATION PAGE 
*=======================*/
// Call customization
add_action( 'customize_register' , 'pixiehuge_customize_theme');

// Function for customization
function customizer_library_add_sections( $sections, $wp_customize ) {
    foreach ( $sections as $section ) {
        if ( ! isset( $section['description'] ) ) {
            $section['description'] = FALSE;
        }
        $wp_customize->add_section( $section['id'], $section );
    }
}
function pixiehuge_customize_theme( $wp_customize ){

    /***
    *   Sections
    ***/
  
    // General section
    $wp_customize->add_section( 'pixiehuge_general_customize' , array(
        'title'    => esc_html__( 'General', 'pixiehuge' ),
        'priority' => 31
    ));
    
    // Primary color
     $wp_customize->add_setting( 'pixiehuge_primary_color' , array(
        'default'   => '#39bffd',
        'type' => 'theme_mod',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
        'label'    => esc_html__( 'Primary Color', 'pixiehuge' ),
        'section'  => 'pixiehuge_general_customize',
        'settings' => 'pixiehuge_primary_color',
    )));

    // Logo type
    $wp_customize->add_setting( 'pixiehuge_logo_type' , array(
        'transport' => 'refresh',
        'default' => '1',
        'sanitize_callback' => 'esc_attr',
    ));

    $wp_customize->add_control('pixiehuge_logo_type_id', array(
            'label'    => esc_html__( 'Logo type', 'pixiehuge' ),
            'section'  => 'pixiehuge_general_customize',
            'settings' => 'pixiehuge_logo_type',
            'type'     => 'select',
            'choices'  => array(
                '0'     => esc_html__('Logo with base', 'pixiehuge'),
                '1'     => esc_html__('Regular Logo', 'pixiehuge'),
            ),
        )
    );

    // Logo
    $wp_customize->add_setting( 'pixiehuge_logo_customize' , array(
        'transport' => 'postMessage',
        'default' => get_template_directory_uri() . '/images/logo.png',
        'sanitize_callback'	=> 'esc_url_raw'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_control', array(
        'label' => esc_html__( 'Logo Image', 'pixiehuge' ),
        'section' => 'pixiehuge_general_customize',
        'settings' => 'pixiehuge_logo_customize',
        'description' => esc_html__('Main logo image.', 'pixiehuge'),
        'mime_type' => 'image',
    )));
}