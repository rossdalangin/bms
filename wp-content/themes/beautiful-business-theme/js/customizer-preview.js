/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $, api ) {
    'use strict';

    // Site title and description.
    api( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a' ).text( to );
        } );
    } );
    api( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.site-description' ).text( to );
        } );
    } );

    // Header CTA Button
    api( 'bbt_header_cta_text', function( value ) {
        value.bind( function( to ) {
            var ctaButton = $( '.header-cta-button' );
            ctaButton.text( to );
            if ( '' === to ) {
                ctaButton.hide();
            } else {
                ctaButton.show();
            }
        } );
    } );
    api( 'bbt_header_cta_url', function( value ) {
        value.bind( function( to ) {
            $( '.header-cta-button' ).attr( 'href', to );
        } );
    } );

    // Theme Colors (uses dynamic-css.php, but this provides instant preview)
    api( 'bbt_primary_color', function( value ) { value.bind( function( to ) { document.documentElement.style.setProperty('--bbt-primary-color', to ); } ); } );
    api( 'bbt_secondary_color', function( value ) { value.bind( function( to ) { document.documentElement.style.setProperty('--bbt-secondary-color', to ); } ); } );
    api( 'bbt_body_text_color', function( value ) { value.bind( function( to ) { $('body').css('color', to); } ); } );
    api( 'bbt_heading_color', function( value ) { value.bind( function( to ) { $('h1, h2, h3, h4, h5, h6').css('color', to); } ); } );
    api( 'bbt_link_hover_color', function( value ) { value.bind( function( to ) { document.documentElement.style.setProperty('--bbt-link-hover-color', to ); } ); } );
    api( 'bbt_background_color', function( value ) { value.bind( function( to ) { $('body').css('background-color', to); } ); } );

    // Footer Copyright Text
    var updateCopyright = function() {
        var text = api( 'bbt_copyright_text' ).get();
        var siteName = api( 'blogname' ).get();
        var year = new Date().getFullYear();
        text = text.replace( '[year]', year );
        text = text.replace( '[site_name]', siteName );
        $( '.site-info .copyright-text' ).html( text );
    };
    api( 'bbt_copyright_text', function( value ) { value.bind( updateCopyright ); } );
    api( 'blogname', function( value ) { value.bind( updateCopyright ); } );

    // Homepage Hero Section
    api( 'bbt_hero_title', function( value ) { value.bind( function( to ) { $( '.hero-main-title' ).text( to ); } ); } );
    api( 'bbt_hero_subtitle', function( value ) { value.bind( function( to ) { $( '.hero-main-subtitle' ).html( to ); } ); } );
    api( 'bbt_hero_button_text', function( value ) { value.bind( function( to ) { $( '.hero-main-button' ).text( to ); } ); } );
    api( 'bbt_hero_button_url', function( value ) { value.bind( function( to ) { $( '.hero-main-button' ).attr( 'href', to ); } ); } );
    api( 'bbt_hero_background_image', function( value ) {
        value.bind( function( to ) {
            var heroSection = $( '#homepage-hero' );
            heroSection.css( 'background-image', to ? 'url(' + to + ')' : 'none' );
            heroSection.toggleClass('has-background-image', !!to);
        } );
    } );
    api( 'bbt_hero_text_align', function( value ) {
        value.bind( function( to ) {
            $( '#homepage-hero .hero-content-container' ).css( 'text-align', to );
        } );
    } );

    // --- Section Order and Visibility Preview (Simplified & Robust) ---
    (function() {
        var parentContainer = $( '#main.site-main' );
        if ( !parentContainer.length ) {
            return;
        }

        var sectionKeys = ['hero', 'features', 'services', 'projects', 'cta', 'clients', 'testimonials', 'news'];

        // The single, simple function to handle all layout updates
        var updateLayout = function() {
            var orderSetting = api( 'bbt_homepage_section_order' ).get();
            if (!orderSetting) { return; } // Bail if setting not ready

            var order = orderSetting.split(',');
            var detached = {};

            // Detach all known sections
            $.each(sectionKeys, function(i, id) {
                var section = $('#homepage-' + id);
                if (section.length) {
                    detached[id] = section.detach();
                }
            });

            // Re-append in the correct order and set visibility
            $.each(order, function(i, id) {
                if (detached[id]) {
                    var section = detached[id];
                    var isVisible = api('bbt_show_section_' + id) ? api('bbt_show_section_' + id).get() : true;

                    parentContainer.append(section); // Append it to the DOM

                    if (isVisible) {
                        section.show();
                    } else {
                        section.hide();
                    }
                }
            });
        };

        // Listen to all relevant settings
        api('bbt_homepage_section_order', function(setting) {
            setting.bind(updateLayout);
        });

        $.each(sectionKeys, function(i, id) {
            api('bbt_show_section_' + id, function(setting) {
                setting.bind(updateLayout);
            });
        });

        // Also run on first load, but with a slight delay to ensure settings are available
        api.bind('preview-ready', function() {
             setTimeout(updateLayout, 100);
        });

    })();

    // --- Live Preview for Section Order ---
    api('bbt_homepage_section_order', function(setting) {
        setting.bind(function(newOrder) {
            var order = newOrder.split(',');
            var parentContainer = $('#main.site-main');
            if (!parentContainer.length) { return; }

            var detached = {};
            // Detach all known sections
            $.each(order, function(i, id) {
                var section = $('#homepage-' + id);
                if (section.length) {
                    detached[id] = section.detach();
                }
            });

            // Re-append in the correct order
            $.each(order, function(i, id) {
                if (detached[id]) {
                    parentContainer.append(detached[id]);
                }
            });
        });
    });

    // --- Live Preview for Section Visibility ---
    var homepageSections = ['hero', 'features', 'services', 'projects', 'cta', 'clients', 'testimonials', 'news'];
    $.each(homepageSections, function(index, id) {
        api('bbt_show_section_' + id, function(setting) {
            setting.bind(function(isVisible) {
                var section = $('#homepage-' + id);
                if (isVisible) {
                    section.slideDown(200);
                } else {
                    section.slideUp(200);
                }
            });
        });
    });

} )( jQuery );
