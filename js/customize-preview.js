/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 * @link https://codex.wordpress.org/Theme_Customization_API#Part_3:_Configure_Live_Preview_.28Optional.29
 */

( function( $ ) {

	var api 			= wp.customize,
		$body 			= $( 'body' ),
		$head 			= $( 'head' ),
		$siteDesc 		= $( '.site-description' ),
		$siteTitle 		= $( '.site-title a' ),
		$copyNotice 	= $( '.copyright-notice' ),
		$copyText 		= $( '.copyright-notice .copy-text' ),
		$copyDesigner 	= $( '.copyright-notice .copy-designer' ),
		$copyPowered 	= $( '.copyright-notice .copy-powered' );

	// Site title.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$siteTitle.text( to );
		} );
	} );

	// Site tagline.
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$siteDesc.text( to );
		} );
	} );

	// Layout sheme options
	api( 'rolio_theme_layout', function( value ) {
		value.bind( function( to ) {
			$body.removeClass('theme-classic theme-centered theme-index-exhibit').addClass( to );
		} );
	} );

	// Color sheme options
	api( 'rolio_theme_color', function( value ) {
		value.bind( function( to ) {
			$body.removeClass('theme-light theme-dark').addClass( to );
		} );
	} );

	// Copyright notice
	api( 'rolio_theme_copy_text', function( value ) {
		value.bind( function( to ) {
			$copyText.html( to );
		} );
	} );

	api( 'rolio_theme_designed_by', function( value ) {
		value.bind( function( to ) {
			console.log(to);
			if ( to ) {
				$copyDesigner.insertAfter( $copyText );
			} else {
				$copyDesigner.remove();
			}
		} );
	} );

	api( 'rolio_theme_powered_by', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$copyPowered.appendTo( $copyNotice );
			} else {
				$copyPowered.remove();
			}
		} );
	} );


} )( jQuery );
