
( function( $ ) {

	wp.customize( 'demo_setup', function( value ) {
		value.bind( function( to ) {

			if ( 'version_2' == to ) {
				$( '#customize-control-demo_setup_extra' ).attr( 'style', 'display: block !important' );
			} else {
				$( '#customize-control-demo_setup_extra').attr('style', 'display: none !important' );
			}

		} );
	} );
	
} )( jQuery );
