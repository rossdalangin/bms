( function( $, api ) {
    'use strict';

    api.controlConstructor['beautiful_business_section_order'] = api.Control.extend( {
        ready: function() {
            var control = this;

            // Make the list sortable and update the order on change.
            this.container.find( '.beautiful-business-section-order-list' ).sortable({
                handle: '.handle',
                update: function() {
                    control.updateOrder();
                }
            });

            // Handle clicking the visibility icon.
            this.container.on( 'click', '.visibility-icon', function() {
                // Find the checkbox and toggle its state
                var checkbox = $( this ).siblings( '.section-visibility-toggle' );
                checkbox.prop( 'checked', ! checkbox.prop( 'checked' ) ).trigger( 'change' );
            });

            // Handle the actual change event on the checkbox.
            this.container.on( 'change', '.section-visibility-toggle', function() {
                var sectionId = $( this ).closest( '.section-order-item' ).data( 'section-id' );
                var isVisible = $( this ).is( ':checked' );
                var visibilitySetting = api( 'bbt_show_section_' + sectionId );

                if ( visibilitySetting ) {
                    visibilitySetting.set( isVisible );
                }
            });

            // Listen for changes to each section's visibility setting and update the UI.
            this.container.find( '.section-order-item' ).each( function() {
                var item = $( this );
                var sectionId = item.data( 'section-id' );
                var visibilitySetting = api( 'bbt_show_section_' + sectionId );

                if ( visibilitySetting ) {
                    visibilitySetting.bind( function( isVisible ) {
                        item.toggleClass( 'is-hidden', ! isVisible );
                    });
                }
            });
        },

        updateOrder: function() {
            var control = this;
            var newOrder = [];
            this.container.find( '.beautiful-business-section-order-list .section-order-item' ).each( function() {
                newOrder.push( $( this ).data( 'section-id' ) );
            });
            control.setting.set( newOrder.join( ',' ) );
        }
    });

} )( jQuery, wp.customize );
