<?php
/**
 * Modified from ZillaLikes
 * http://www.themezilla.com/plugins/zillalikes/
 */

/**
 * add post meta '_velove_likes'
 */
function velove_setup_likes( $post_id ) {
	if ( ! is_numeric( $post_id ) ) {
		return;
	}

	add_post_meta( $post_id, '_velove_likes', '0', true );
}
add_action( 'publish_post', 'velove_setup_likes' );

/**
 * AJAX callback, to get the refreshed like count
 */
function velove_ajax_callback( $post_id ) {

	if ( isset( $_POST['likes_id'] ) ) {
		// Click event. Get and Update Count
		$post_id = str_replace( 'velove-likes-', '', $_POST['likes_id'] );
		echo velove_like_this( $post_id, 'update' );
	} else {
		// AJAXing data in. Get Count
		$post_id = str_replace( 'velove-likes-', '', $_POST['post_id'] );
		echo velove_like_this( $post_id, 'get' );
	}

	exit;
}
add_action( 'wp_ajax_velove-likes', 'velove_ajax_callback' );
add_action( 'wp_ajax_nopriv_velove-likes', 'velove_ajax_callback' );

/**
 * get the like count
 */
function velove_like_this( $post_id, $action = 'get' ) {

	if ( ! is_numeric( $post_id ) ) {
		return;
	}

	switch( $action ) {

		case 'get':
			$likes = get_post_meta( $post_id, '_velove_likes', true );
			if( ! $likes ){
				$likes = 0;
				add_post_meta( $post_id, '_velove_likes', $likes, true );
			}

			return sprintf( '<i class="icon-heart-empty"></i> <span class="like-number">%s</span>',
					esc_html( $likes )
				);
		break;

		case 'update':
			$likes = get_post_meta( $post_id, '_velove_likes', true );
			if( isset( $_COOKIE['velove_likes_'. $post_id] ) ) return $likes;

			$likes++;
			update_post_meta( $post_id, '_velove_likes', $likes );
			setcookie( 'velove_likes_'. $post_id, $post_id, time()*20, '/' );

			return sprintf( '<i class="icon-heart-empty"></i> <span class="like-number">%s</span>',
					esc_html( $likes )
				);
		break;

	}
}

/**
 * Template Tag for Like counter
 */
function velove_do_likes() {

	// get the like count
	$output = velove_like_this( get_the_ID() );

	$class = 'entry-like';
	$active_class = 'none';
	$title = esc_html__( 'Like this', 'velove' );

	// check cookie, if user already like
	if ( isset( $_COOKIE['velove_likes_'. get_the_ID()] ) ) {
		$active_class = 'active';
		$title = esc_html__( 'You already like this', 'velove' );
	}

	return '<span class="' . esc_attr( $class ) .'"><a href="#" class="' . esc_attr( $active_class ) . '" id="velove-likes-'. get_the_ID() .'" title="'. esc_attr( $title ) . '">' . $output . '</a></span>';
}
