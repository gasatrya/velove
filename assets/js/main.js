( function( $ ) {

	// Document ready
	$( function() {

		// Responsive video
		$( '.entry, .widget' ).fitVids();

		// Reading time
		$( '.entry' ).each( function() {

			$( this ).readingTime( {
				readingTimeTarget: $( this ).find( '.reading-time' ),
				remotePath: $( this ).attr( 'data-file' ),
				remoteTarget: $( this ).attr( 'data-target' ),
			} );

		} );

		// Post like
		$( '.entry-like a' ).on( 'click',
			function() {
				var link = $( this );
				if ( link.hasClass( 'active' ) ) return false;

				var id = $( this ).attr( 'id' );

				$.post( velove.ajaxurl, {
					action: 'velove-likes',
					likes_id: id
				}, function( data ) {
					link.html( data ).addClass( 'active' ).attr( 'title', velove.rated );
				} );

				return false;
			} );

		// Masonry layout
		$( '.grid' ).masonry( {
			itemSelector: '.entry',
			columnWidth: 350,
			gutter: 30
		} );


	} );

}( jQuery ) );
