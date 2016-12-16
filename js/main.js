jQuery( document ).ready( function( $ ) {

	/*
	 * Dom cache for a more productive future
	 */
	var cache = {
		document			:$( document ),
		window				:$( window ),
		body				:$( 'body' ),
		header				:$( '.site-header' ),
		brandingNavHolder 	:$( '.site-branding-nav-holder' ),
		backtotop			:$( '.back-to-top' ),
		imageLinks			:$( 'a[href$=".gif"], a[href$=".jpg"], a[href$=".png"]' ),
		masonryView 		:$( '.theme-masonry .site-main .page-content' ),
		fixHeightView		:$( '.theme-fix-height .site-main .page-content' ),
		mediaPage			:$( '.single-format-group-media' ),
		mediaWrapper		:$( '.single-format-group-media .entry-content' ),
		mediaPostNavs		:$( '.single-format-group-media .post-navigation .nav-previous,.single-format-group-media .post-navigation .nav-next' ),
		mediaCatNav			:$( '.single-format-group-media .back-to-cat-navigation' )
	}
	
	/*
	 * Theme object stores all theme related interactions
	 */
	var rolio = {

		header: {

			init: function() {

				if ( cache.body.hasClass( 'has-header-image' ) ) {
					cache.brandingNavHolder.css('top',cache.header.height()/2);
					cache.brandingNavHolder.css('margin-top',-cache.brandingNavHolder.height()/2);
				}

			}

		},

		menu: {

			/*
			 * Builds menu and menu related things like menu toggling, dropdown
			 * buttons etc. Dropdown actions are taken from twentysixteen theme
			 */
			init: function( $themeLocation ) {

				$thisMenuContainer = $( '#site-navigation-' + $themeLocation );

				// If there is a menu on the given location
				if ( $thisMenuContainer.length ) {

					// Select menu items
					$thisToggleBtn = $thisMenuContainer.find( '.menu-toggle' );
					$thisMenu = $thisMenuContainer.find( '.menu' );
					$thisToggleBtn.data( 'this-menu-container',$thisMenuContainer );

					// Toggler click actions
					$thisToggleBtn.click(function(){

						var _this = $( this ),
							_thisExpanded = _this.attr( 'aria-expanded' );

						// Find the menu bond to this button
						$thisMenuContainer = _this.data( 'this-menu-container' );

						// Add the height so that no flickering occur
						if ( _thisExpanded === 'true' ) {
							$thisMenuContainer.removeAttr( 'style' )
						} else {
							$thisMenuContainer.height( $thisMenuContainer.height() );
						}
						
						// All the hassle toggle
						cache.body.toggleClass( 'menu-expanded' );
						$thisMenuContainer.toggleClass( 'active-menu' )
						_this.find( 'i' ).toggleClass( 'lnr-menu lnr-cross' );
						_this.attr( 'aria-expanded', _thisExpanded === 'false' ? 'true' : 'false' );
					});
	 
					// Add dropdown toggle that displays child menu items.
					// And append to every menu item with children
					var dropdownToggle = $( '<button />', {
						'class': 'dropdown-toggle',
						'aria-expanded': false
					} ).append( $( '<i />', {
						'class': 'lnr lnr-chevron-down'
					} ) ).append( $( '<span />', {
						'class': 'screen-reader-text',
						text: i18n.expand
					} ) );

					$thisMenu.find( '.menu-item-has-children > a' ).after( dropdownToggle );

					// Toggle buttons and submenu items with active children menu items.
					$thisMenu.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
					$thisMenu.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

					// Add menu items with submenus to aria-haspopup="true".
					$thisMenu.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

					// Dropdown button click interaction
					$thisMenu.find( '.dropdown-toggle' ).click( function( e ) {
						var _this = $( this ),
							screenReaderSpan = _this.find( '.screen-reader-text' );
						_this.toggleClass( 'toggled-on' ).find( 'i' ).toggleClass( 'lnr-chevron-down lnr-chevron-up' );
						_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
						_this.next( '.sub-menu' ).slideToggle();
						_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
						screenReaderSpan.text( screenReaderSpan.text() === i18n.expand ? i18n.collapse : i18n.expand );
						e.preventDefault();
					} );

				}

			},

			/*
			 * If window is resized remove the menu-expanded class from body and
			 * close the menu if already opened
			 */
			fixMenuExpandedClass: function() {

				if ( cache.window.width() > 880 && cache.body.hasClass( 'menu-expanded' ) ) {
					$( '.active-menu .menu-toggle' ).trigger( 'click' );
				}

			}

		},

		media: {

			/*
			 * Handles masonry view interaction
			 * @link http://masonry.desandro.com/
			 */
			initMasonryView: function() {

				var msnryOptions = {
					columnWidth: 		'.post-sizer',
					gutter: 			'.gutter-sizer',
					itemSelector: 		'.post',
					percentPosition: 	true
				};

				var $grid = cache.masonryView.imagesLoaded( function() {
					cache.masonryView.masonry( msnryOptions );
				});

			},

			/*
			 * Fix height of the posts inside the article row
			 * @link http://brm.io/jquery-match-height/
			 */
			initFixHeightView: function() {

				// After images have loaded
				cache.fixHeightView.imagesLoaded( function() {
					cache.fixHeightView.find( '.post' ).matchHeight();
				});

			},

			/*
			 * On single media pages set the top position of the page navigation
			 */
			fixMediaNavPos: function() {

				cache.mediaWrapper.imagesLoaded( function() {
					
					setTimeout( function() { 
						cache.mediaPostNavs.css({
							'top':cache.mediaCatNav.height() + ( cache.mediaWrapper.height()/2 ),
							'margin-top':'-24px'
						});
					}, 1000);
				
				});

			}

		},

		accessibility: {

			/*
			 * Keyboard support for prev/next navigation. (From Twenty Sixteen
			 * theme)
			 */
			keyboardNav: function() {

				cache.document.on( 'keydown.rolio', function( e ) {

					var url = false;

					// Left arrow key code.
					if ( 37 === e.which ) {
						url = $( '.nav-previous a' ).attr( 'href' );

					// Right arrow key code.
					} else if ( 39 === e.which ) {
						url = $( '.nav-next a' ).attr( 'href' );

					// Other key code.
					} else {
						return;
					}

					if ( url && ! $( 'textarea, input' ).is( ':focus' ) ) {
						window.location = url;
					}
				} );

			},

			/*
			 * Helps with accessibility for keyboard only users. (From
			 * underscore theme) Learn more: https://git.io/vWdr2
			 */
			skipLinkFocus: function() {
				
				var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
				    isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
				    isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

				if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
					window.addEventListener( 'hashchange', function() {
						var id = location.hash.substring( 1 ),
							element;

						if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
							return;
						}

						element = document.getElementById( id );

						if ( element ) {
							if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
								element.tabIndex = -1;
							}

							element.focus();
						}
					}, false );
				}

			},

			/*
			 * The back-to-top scroller button on the right bottom corner
			 */
			backtotop: function() {

				cache.window.scroll(function() {
					if (cache.window.scrollTop() > 1000) {
						cache.backtotop.fadeIn();
					} else {
						cache.backtotop.fadeOut();
					}
				});

				cache.backtotop.click(function() {
					$('body,html').animate({
						scrollTop: 0
					}, 300);
					return false;
				});

			}

		},

		init: function() {

			this.accessibility.keyboardNav();
			this.accessibility.skipLinkFocus();
			this.accessibility.backtotop();
			
			this.menu.init( 'header' );

			this.header.init();
			cache.window.on( 'resize.headerHeight' , debounce(rolio.header.init,250) );

			if ( ! cache.body.hasClass( 'theme-index-exhibit' ) ) {
				this.menu.init( 'footer' );
			}

			if ( cache.masonryView.length ) {
				this.media.initMasonryView();
			}
			
			if ( cache.fixHeightView.length ) {
				this.media.initFixHeightView();
			}

			if ( cache.mediaPage.length ) {
				this.media.fixMediaNavPos();
				cache.window.on( 'resize.fixMediaNavPos' , debounce(rolio.media.fixMediaNavPos,250) );
			}

			cache.window.on( 'resize.fixMenuExpandedClass' , debounce(rolio.menu.fixMenuExpandedClass,250) );
 
		}

	}

	// Start
	rolio.init();

});

