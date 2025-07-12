( function( $, api ) {
    'use strict';

    api.controlConstructor['beautiful_business_section_order'] = api.Control.extend( {
        ready: function() {
            var control = this;

            // Make the list sortable
            $( '.beautiful-business-section-order-list' ).sortable({
                handle: '.handle',
                update: function() {
                    control.updateOrder();
                }
            });

            // Handle checkbox toggling using event delegation
            this.container.on( 'change', '.section-visibility-toggle', function() {
                var sectionId = $( this ).closest( '.section-order-item' ).data( 'section-id' );
                var isVisible = $( this ).is( ':checked' );
                var visibilitySetting = api( 'bbt_show_section_' + sectionId );

                if ( visibilitySetting ) {
                    visibilitySetting.set( isVisible );
                }

                // Also update the visual state
                $(this).closest('.section-order-item').toggleClass('is-hidden', !isVisible);
            });

            // Initial state
            $('.section-order-item').each(function() {
                var isVisible = $(this).find('.section-visibility-toggle').is(':checked');
                $(this).toggleClass('is-hidden', !isVisible);
            });
        },

        updateOrder: function() {
            var control = this;
            var newOrder = [];
            $( '.beautiful-business-section-order-list .section-order-item' ).each( function() {
                newOrder.push( $( this ).data( 'section-id' ) );
            });
            control.setting.set( newOrder.join( ',' ) );
        }
    });

} )( jQuery, wp.customize );
