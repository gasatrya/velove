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

		// Detect if drop down menu go off screen
		$( '.main-navigation li' ).on( 'mouseenter mouseleave', function() {
			if ( $( 'ul', this ).length ) {
				var elm = $( 'ul:first', this ),
					off = elm.offset(),
					l = off.left,
					w = elm.width(),
					docH = $( '.site-navigation' ).height(),
					docW = $( '.site-navigation' ).width();

				var isEntirelyVisible = ( l + w <= docW );

				if ( !isEntirelyVisible ) {
					$( this ).addClass( 'edge' );
				} else {
					$( this ).removeClass( 'edge' );
				}
			}
		});

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
