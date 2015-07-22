<?php

	header("Access-Control-Allow-Origin: *");


	function generateRandomString($length) {
    	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	}
 
	$myRandomString = generateRandomString(9);

	
	if ( isset( $_GET['vidId'] ) ) {
		$vidId = $_GET['vidId'];
	}

	if ( isset( $_GET['vidHost'] ) ) {
		$vidHost = $_GET['vidHost'];
		if ( $vidHost == 'youtube' ) {
			$fetchUrl = 'https://www.youtube.com/watch?v='.$vidId;
		}

		if ( $vidHost == 'vimeo' ) {
			$fetchUrl = 'vimeo.com/'.$vidId;
		}
	}

	else {
		$vidHost = 'youtube';
		$fetchUrl = 'https://www.youtube.com/watch?v='.$vidId;
	}

	if ( isset( $_GET['gfyMin'] ) ) {
		$fetchMinutes = '&fetchMinutes='.$_GET['gfyMin'];
	}

	if ( isset( $_GET['gfySec'] ) ) {
		$fetchSeconds = '&fetchSeconds='.$_GET['gfySec'];
	}

	if ( isset( $_GET['gfyLength'] ) ) {
		$fetchLength = '&fetchLength='.$_GET['gfyLength'];
	}

	// if ( isset( $_GET['clip'] ) ) {
	// 	$clip = $_GET['clip'];
	// }

	//$encodedFetchUrl = urlencode($fetchUrl.$fetchMinutes.$fetchSeconds.$fetchLength);

	function gfyStatusCheck($requestString) {
		$status_connect = curl_init('http://upload.gfycat.com/status/'.$requestString);
		curl_setopt($status_connect, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($status_connect, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($status_connect, CURLOPT_TIMEOUT, 180);
		$status_json = '';
		if ( ($status_json = curl_exec($status_connect) ) === false) {

	    	//echo 'Curl error: ' . curl_error($status_connect);
	    	echo 'error';
		}

		else {
			$status = json_decode($status_json);
			return $status;
			curl_close($status_connect);
		}
	}

	/* Check to see if URL has been previously fetched */

	$ch1 = curl_init('http://gfycat.com/cajax/checkUrl/'.$fetchUrl.$fetchMinutes.$fetchSeconds.$fetchLength);

	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch1, CURLOPT_FRESH_CONNECT, true);
	curl_setopt($ch1, CURLOPT_TIMEOUT, 180);
	$json1 = '';
	if ( ($json1 = curl_exec($ch1) ) === false) {
    	//echo 'Curl error: ' . curl_error($ch1);
    	echo 'error';
	}
	else {
    	$gfy1 = json_decode($json1);

		if ( $gfy1->{'urlKnown'} == true ) {
			echo $gfy1->{'gfyName'};
			curl_close($ch1);
		}

		else {
			curl_close($ch1);

			$ch = curl_init('http://upload.gfycat.com/transcode/'.$myRandomString.'?fetchUrl='.$fetchUrl.$fetchMinutes.$fetchSeconds.$fetchLength);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 180);
			$json = '';
			if ( ($json = curl_exec($ch) ) === false) {

		    	//echo 'Curl error: ' . curl_error($ch);
		    	echo 'error';
			}
			else {	

				$gfy = json_decode($json);

				if ( $gfy->{'gfyName'} == NULL ) {
		    		echo 'encoding';
		    		curl_close($ch);
		    		//$current_status = gfyStatusCheck($myRandomString);
		    		//print_r($current_status);
		    		
		    		// while ( $current_status->{'task'} != 'complete' ) {
		    		// 	sleep(5);
		    		// 	$current_status = gfyStatusCheck($myRandomString);
		    		// 	if ( $current_status->{'task'} == 'complete' ) {
		    		// 		echo $current_status->{'gfyname'};
		    		// 	}
		    		// }
		    	}

		    	else {

					$gfyName = $gfy->{'gfyname'};

					echo $gfyName;
					
					curl_close($ch);
		    	}
				
		    	
			}
		
		}
	}

	

?>