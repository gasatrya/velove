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
		var $wrapper = $( '.masonry-wrapper' ),
			windowWidth = $( window ).width(),
			gutter,
			columns;

		// Two columns
		if ( velove.isMasonryTwoColumns ) {

			gutter  = 30;
			columns = 2;

			// Re-set columns based on window width
			if ( windowWidth < 768 ) {
				columns = 1;
			}

		}

		// Three columns
		if ( velove.isArchivePage || velove.isMasonryThreeColumns ) {

			gutter  = 30;
			columns = 3;

			// Re-set columns based on window width
			if ( windowWidth < 768 ) {
				columns = 1;
			} else if ( windowWidth < 900 ) {
				columns = 2;
			}

		}

		// Four columns
		if ( velove.isMasonryFourColumns ) {

			gutter  = 30;
			columns = 4;

			// Re-set columns based on window width
			if ( windowWidth < 768 ) {
				columns = 1;
			} else if ( windowWidth < 900 ) {
				columns = 2;
			} else if ( windowWidth < 1110 ) {
				columns = 3;
			}

		}

		// calculate item width
		var itemWidth = ( $wrapper.width() - gutter * ( columns - 1 ) ) / columns;
		// Inject custom css
		$( '.masonry-wrapper .entry' ).css( {
			width: itemWidth,
			marginBottom: gutter
		} );

		// Initialize masonry
		$wrapper.imagesLoaded( function() {
			$wrapper.masonry( {
				itemSelector: '.entry',
				columnWidth: itemWidth,
				gutter: gutter,
				isFitWidth: true
			} );
		} );

	} );

}( jQuery ) );
