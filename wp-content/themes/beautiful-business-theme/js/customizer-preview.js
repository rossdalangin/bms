/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

    // Site title and description.
    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a' ).text( to );
        } );
    } );
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.site-description' ).text( to );
        } );
    } );

    // Header CTA Button
    wp.customize( 'bbt_header_cta_text', function( value ) {
        value.bind( function( to ) {
            // Assume an element with class .header-cta-button exists in header.php
            var ctaButton = $( '.header-cta-button' );
            ctaButton.text( to );
            // Show/hide button based on if text is present
            if ( '' === to ) {
                ctaButton.hide();
            } else {
                ctaButton.show();
            }
        } );
    } );

    wp.customize( 'bbt_header_cta_url', function( value ) {
        value.bind( function( to ) {
            $( '.header-cta-button' ).attr( 'href', to );
        } );
    } );

    // Add more live previews here as settings are added.

    // Theme Colors
    wp.customize( 'bbt_primary_color', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--bbt-primary-color', newval );
        } );
    } );

    wp.customize( 'bbt_secondary_color', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--bbt-secondary-color', newval );
        } );
    } );

    // Footer Copyright Text
    wp.customize( 'bbt_copyright_text', function( value ) {
        value.bind( function( newval ) {
            var processedText = newval;
            var currentYear = new Date().getFullYear().toString(); // Ensure string for replace
            var siteName = wp.customize( 'blogname' ).get();

            processedText = processedText.replace( /\[year\]/g, currentYear );
            processedText = processedText.replace( /\[site_name\]/g, siteName );

            var copyrightElement = $( '.site-info .copyright-text' );
            if ( copyrightElement.length ) {
                copyrightElement.html( processedText ); // Use .html() as newval might contain &copy;
            } else {
                // Fallback: Attempt to find the last paragraph in .site-info if .copyright-text doesn't exist
                var siteInfoP = $( '.site-info p' );
                if (siteInfoP.length > 0) {
                    siteInfoP.last().html( processedText );
                }
            }
        } );
    } );

    // Also update copyright if site name changes
    var originalBlognameBind = wp.customize( 'blogname' )._value.bind; // Store original
    wp.customize( 'blogname', function( value ) {
        // Call original bind for site title
        originalBlognameBind.call(value, function( newSiteName ) {
            $( '.site-title a' ).text( newSiteName );
        });

        // Add our copyright update logic
        value.bind( function( newSiteName ) {
            var copyrightSetting = wp.customize( 'bbt_copyright_text' );
            if ( copyrightSetting ) {
                var currentCopyrightText = copyrightSetting.get();
                var currentYear = new Date().getFullYear().toString();
                var processedText = currentCopyrightText;

                processedText = processedText.replace( /\[year\]/g, currentYear );
                processedText = processedText.replace( /\[site_name\]/g, newSiteName );

                var copyrightElement = $( '.site-info .copyright-text' );
                if ( copyrightElement.length ) {
                    copyrightElement.html( processedText );
                } else {
                    var siteInfoP = $( '.site-info p' );
                    if (siteInfoP.length > 0) {
                        siteInfoP.last().html( processedText );
                    }
                }
            }
        } );
    } );

    // Homepage Hero Section
    wp.customize( 'bbt_hero_title', function( value ) {
        value.bind( function( to ) {
            $( '#hero-title' ).text( to ); // Assuming id="hero-title" in front-page.php
        } );
    } );

    wp.customize( 'bbt_hero_subtitle', function( value ) {
        value.bind( function( to ) {
            $( '#hero-subtitle' ).html( to ); // Assuming id="hero-subtitle", use .html() for wp_kses_post
        } );
    } );

    wp.customize( 'bbt_hero_button_text', function( value ) {
        value.bind( function( to ) {
            $( '#hero-button' ).text( to ); // Assuming id="hero-button"
        } );
    } );

    wp.customize( 'bbt_hero_button_url', function( value ) {
        value.bind( function( to ) {
            $( '#hero-button' ).attr( 'href', to ); // Assuming id="hero-button" is an <a> tag
        } );
    } );

    wp.customize( 'bbt_hero_background_image', function( value ) {
        value.bind( function( to ) {
            var heroSection = $( '#homepage-hero' ); // Assuming id="homepage-hero" for the section
            heroSection.css( 'background-image', to ? 'url(' + to + ')' : 'none' );
            if (to) {
                heroSection.addClass('has-background-image');
            } else {
                heroSection.removeClass('has-background-image');
            }
        } );
    } );

    // Homepage Sections Panel Titles
    wp.customize( 'bbt_services_section_title', function( value ) {
        value.bind( function( to ) {
            // Assumes an element like <h2 class="section-title" id="services-section-title"> on front-page.php
            // Or a more specific selector if the section structure is defined.
            $( '#services-section .section-title-text' ).text( to );
        } );
    } );

    wp.customize( 'bbt_testimonials_section_title', function( value ) {
        value.bind( function( to ) {
            // Assumes an element like <h2 class="section-title" id="testimonials-section-title">
            $( '#testimonials-section .section-title-text' ).text( to );
        } );
    } );

} )( jQuery );
