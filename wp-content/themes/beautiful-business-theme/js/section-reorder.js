( function( $, api ) {
    'use strict';

    api.controlConstructor['beautiful_business_reorder'] = api.Control.extend( {
        ready: function() {
            var control = this;

            // Make the list sortable
            this.container.find( '.beautiful-business-reorder-list' ).sortable({
                handle: '.handle',
                update: function() {
                    control.updateOrder();
                }
            });
        },

        updateOrder: function() {
            var control = this;
            var newOrder = [];
            this.container.find( '.beautiful-business-reorder-list .reorder-item' ).each( function() {
                newOrder.push( $( this ).data( 'section-id' ) );
            });
            control.setting.set( newOrder.join( ',' ) );
        }
    });

} )( jQuery, wp.customize );
