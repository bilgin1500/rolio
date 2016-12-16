<?php
/**
 * Rolio theme customizer.
 * @package rolio
 *
 * TOC
 * rolio_customize_register
 * rolio_customize_partial_blogname
 * rolio_customize_partial_blogdescription
 * rolio_customize_preview_js
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * Add color sheme settings and controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function rolio_customize_register( $wp_customize ) {
	
	// Postmessage support for site title and description
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Selective refresh support for site title and description
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'rolio_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'rolio_customize_partial_blogdescription',
		) );
	}

	// Add layout controls
	$wp_customize->add_section( 'rolio_theme_design' , array(
	    'title'       => __('Theme Design','rolio'),
	    'description' => __('This theme supports different layout, color and typography shemes. Feel free to customize.','rolio'),
	    'priority'    => 100
	) );

		$wp_customize->add_setting( 'rolio_theme_layout', array( 
			'default'			=> 'theme-classic',
			'transport' 		=> 'postMessage',
			'sanitize_callback' => 'esc_html'
		) );

			$wp_customize->add_control( 'rolio_theme_layout', array(
				'label'      => __( 'Layout', 'rolio' ),
				'section'    => 'rolio_theme_design',
				'type'		 => 'radio',
				'checked'	 => 'checked',
				'choices'    => array(
					'theme-classic'   => __('Classic Layout','rolio'),
					'theme-centered' => __('Centered Layout','rolio'),
					'theme-index-exhibit'   => __('Index + Exhibit Layout','rolio')
				)
			) );

		$wp_customize->add_setting( 'rolio_theme_color', array( 
			'default'			=> 'theme-light',
			'transport' 		=> 'postMessage',
			'sanitize_callback' => 'esc_html'
		) );

			$wp_customize->add_control( 'rolio_theme_color', array(
				'label'      => __( 'Color', 'rolio' ),
				'section'    => 'rolio_theme_design',
				'type'		 => 'radio',
				'checked'	 => 'checked',
				'choices'    => array(
					'theme-light'   => __('Light','rolio'),
					'theme-dark' => __('Dark','rolio')
				),
			) );

		// Image index view
		$wp_customize->add_setting( 'rolio_theme_image_index', array( 
			'default'			=> 'theme-standard',
			'transport' 		=> 'postMessage',
			'sanitize_callback' => 'esc_html'
		) );

			$wp_customize->add_control( 'rolio_theme_image_index', array(
				'label'      => __( 'Portfolio view', 'rolio' ),
				'section'    => 'rolio_theme_design',
				'type'		 => 'radio',
				'checked'	 => 'checked',
				'choices'    => array(
					'theme-standard'	=> __('Standard','rolio'),
					'theme-masonry'   	=> __('Masonry','rolio'),
					'theme-fix-height' 	=> __('Fix height','rolio')
				),
			) );

		// Copyright notice
		$wp_customize->add_setting( 'rolio_theme_copy_text', array( 
			'default'			=> rolio_tag_copy_text(),
			'transport' 		=> 'postMessage',
			'sanitize_callback' => 'esc_html'
		) );

			$wp_customize->add_control( 'rolio_theme_copy_text', array(
				'label'      => __( 'Copyright notice', 'rolio' ),
				'section'    => 'rolio_theme_design',
				'type'		 => 'text'
			) );

		$wp_customize->add_setting( 'rolio_theme_designed_by', array( 
			'default'			=> '1',
			'transport' 		=> 'postMessage',
			'sanitize_callback' => 'esc_html'
		) );

			$wp_customize->add_control( 'rolio_theme_designed_by', array(
				'label'      => __( 'Show &quot;designed by&quot; signature', 'rolio' ),
				'section'    => 'rolio_theme_design',
				'type'		 => 'checkbox'
			) );

		$wp_customize->add_setting( 'rolio_theme_powered_by', array( 
			'default'			=> '1',
			'transport' 		=> 'postMessage',
			'sanitize_callback' => 'esc_html'
		) );

			$wp_customize->add_control( 'rolio_theme_powered_by', array(
				'label'      => __( 'Show &quot;powered by&quot; signature', 'rolio' ),
				'section'    => 'rolio_theme_design',
				'type'		 => 'checkbox'
			) );

	// Add social media icon set
	$wp_customize->add_section( 'rolio_theme_sm_links', array(
		'title'    => __('Social Media Links', 'rolio'),
		'description' => __('You can add or remove your social media accounts here. The menu can be placed in header, footer or navigation menus. Choose "none" to disable the links.','rolio'),
		'priority' => 105,
	) );

		$wp_customize->add_setting( 'rolio_theme_sm_icon_pos', array( 
			'default'			=> 'sm-pos-none',
			'sanitize_callback' => 'esc_html'
		) );

			$wp_customize->add_control( 'rolio_theme_sm_icon_pos', array(
				'label'      => __( 'Position', 'rolio' ),
				'section'    => 'rolio_theme_sm_links',
				'type'		 => 'radio',
				'checked'	 => 'checked',
				'choices'    => array(
					'sm-pos-none'			=> __( 'None','rolio' ),
					'sm-pos-header-menu' 	=> __( 'Append to the header menu','rolio' ),
					'sm-pos-header'			=> __( 'Header','rolio' ),
					'sm-pos-footer-menu' 	=> __( 'Append to the footer menu','rolio' ),
					'sm-pos-footer'			=> __( 'Footer','rolio' )
				),
			) );
 
		$social_sites = rolio_list_social_media_sites();
	 
		foreach($social_sites as $social_site) {

			$social_site_safe = sanitize_title( $social_site );
	 
			$wp_customize->add_setting( $social_site_safe, array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			) );
	 
				$wp_customize->add_control( $social_site_safe, array(
					'label'    => sprintf( '%1$s ' . __( 'url','rolio' ), $social_site ),
					'section'  => 'rolio_theme_sm_links',
					'type'     => 'text'
				) );
				
		}

}
add_action( 'customize_register', 'rolio_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 */
function rolio_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function rolio_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function rolio_customize_preview_js() {
	wp_enqueue_script( 'rolio-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160412', true );
}
add_action( 'customize_preview_init', 'rolio_customize_preview_js' );
