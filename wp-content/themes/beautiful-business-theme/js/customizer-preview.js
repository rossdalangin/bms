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
            var ctaButton = $( '.header-cta-button' );
            ctaButton.text( to );
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
    wp.customize( 'bbt_body_text_color', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--bbt-body-text-color', newval );
            $( 'body' ).css( 'color', newval );
        } );
    } );
    wp.customize( 'bbt_heading_color', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--bbt-heading-color', newval );
            $( 'h1, h2, h3, h4, h5, h6' ).css( 'color', newval );
        } );
    } );
    wp.customize( 'bbt_link_hover_color', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--bbt-link-hover-color', newval );
        } );
    } );
    wp.customize( 'bbt_background_color', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--bbt-background-color', newval );
            $( 'body' ).css( 'background-color', newval );
        } );
    } );

    // Footer Copyright Text
    wp.customize( 'bbt_copyright_text', function( value ) {
        value.bind( function( newval ) {
            var processedText = newval;
            var currentYear = new Date().getFullYear().toString();
            var siteName = wp.customize( 'blogname' ).get();
            processedText = processedText.replace( /\[year\]/g, currentYear );
            processedText = processedText.replace( /\[site_name\]/g, siteName );
            $( '.site-info .copyright-text' ).html( processedText );
        } );
    } );

    // Also update copyright if site name changes
    wp.customize( 'blogname', function( value ) {
        value.bind( function( newSiteName ) {
            $( '.site-title a' ).text( newSiteName );
            var copyrightSetting = wp.customize( 'bbt_copyright_text' );
            if ( copyrightSetting ) {
                var currentCopyrightText = copyrightSetting.get();
                var currentYear = new Date().getFullYear().toString();
                var processedText = currentCopyrightText;
                processedText = processedText.replace( /\[year\]/g, currentYear );
                processedText = processedText.replace( /\[site_name\]/g, newSiteName );
                $( '.site-info .copyright-text' ).html( processedText );
            }
        } );
    } );

    // Homepage Hero Section
    wp.customize( 'bbt_hero_title', function( value ) { value.bind( function( to ) { $( '#hero-title' ).text( to ); } ); } );
    wp.customize( 'bbt_hero_subtitle', function( value ) { value.bind( function( to ) { $( '#hero-subtitle' ).html( to ); } ); } );
    wp.customize( 'bbt_hero_button_text', function( value ) { value.bind( function( to ) { $( '#hero-button' ).text( to ); } ); } );
    wp.customize( 'bbt_hero_button_url', function( value ) { value.bind( function( to ) { $( '#hero-button' ).attr( 'href', to ); } ); } );
    wp.customize( 'bbt_hero_background_image', function( value ) {
        value.bind( function( to ) {
            var heroSection = $( '#homepage-hero' );
            heroSection.css( 'background-image', to ? 'url(' + to + ')' : 'none' );
            if (to) { heroSection.addClass('has-background-image'); } else { heroSection.removeClass('has-background-image'); }
        } );
    } );

    // Homepage Sections Panel Titles
    wp.customize( 'bbt_services_section_title', function( value ) { value.bind( function( to ) { $( '#services-section .section-title-text' ).text( to ); } ); } );
    wp.customize( 'bbt_testimonials_section_title', function( value ) { value.bind( function( to ) { $( '#testimonials-section .section-title-text' ).text( to ); } ); } );

    // --- Section Order and Visibility Preview (Robust Version) ---

    (function() {
        var parentContainer = $( '#main' );
        if ( ! parentContainer.length ) {
            return;
        }

        var sectionKeys = ['hero', 'features', 'services', 'projects', 'cta', 'clients', 'testimonials', 'news'];
        var initialLoad = true;

        // The single function to update the entire homepage layout
        function updateHomepageLayout() {
            var order = wp.customize( 'bbt_homepage_section_order' ).get().split( ',' );

            // Detach all sections and store them
            var detachedSections = {};
            $.each( sectionKeys, function( i, id ) {
                var sectionEl = $( '#homepage-' + id ).detach();
                if ( sectionEl.length ) {
                    detachedSections[id] = sectionEl;
                }
            });

            // Loop through the new order and append sections
            $.each( order, function( i, id ) {
                if ( detachedSections[id] ) {
                    var section = detachedSections[id];
                    var isVisible = wp.customize( 'bbt_show_section_' + id ).get();

                    // Append to the container first
                    parentContainer.append( section );

                    // Then handle visibility
                    if ( isVisible ) {
                        if (!initialLoad) {
                            section.slideDown(250);
                        } else {
                            section.show();
                        }
                    } else {
                        if (!initialLoad) {
                            section.slideUp(250);
                        } else {
                            section.hide();
                        }
                    }
                }
            });

            if (initialLoad) {
                initialLoad = false;
            }
        }

        // Listen to all relevant settings
        wp.customize( 'bbt_homepage_section_order', function( setting ) {
            setting.bind( updateHomepageLayout );
        });

        $.each( sectionKeys, function( index, sectionId ) {
            wp.customize( 'bbt_show_section_' + sectionId, function( setting ) {
                setting.bind( updateHomepageLayout );
            });
        });
    })();

} )( jQuery );
