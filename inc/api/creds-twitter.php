<?php
/**
 * Twitter API credentials
 * functions initialized in functions.php
 *
 * @package Earl
 */
	
	function get_twitter_creds() {
		$credentials = array(
			'consumer_key' => 'cVVxWKgDYVta7ue9UO1Whg',
			'consumer_secret' => '9Lef17edTiW4QqmWycMm9wrjo3n3Uhhk82cDGisg88'
		);
		return $credentials;
	}

	function get_twitter_avatar($author) {

		$credentials = get_twitter_creds();

		$twitter_name = $author;
				
		$twitter_api = new Wp_Twitter_Api( $credentials );

		$query = 'screen_name='.$twitter_name;
		$args = array(
		  'type' => 'users/show'
		);
		$twitter_result = $twitter_api->query( $query, $args ); 
		
		if ( $twitter_result ) {
			$twitter_img_url = str_replace( '_normal', '', $twitter_result->profile_image_url );
		}

		else {
			$twitter_img_url = get_bloginfo("stylesheet_directory").'/dist/img/unknownUser.png';
		}

		return $twitter_img_url;
	}
	
?>