<?php

	header("Access-Control-Allow-Origin: *");

	$gfyName = null;
	
	$ch = curl_init('http://upload.gfycat.com/status/'.$gfyName);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$json = '';
	if( ($json = curl_exec($ch) ) === false) {
    	echo 'Curl error: ' . curl_error($ch);
	}
	else {
    	
    	$gfy = json_decode($json);
    	print_r($gfy);
	}

	// Close handle
	curl_close($ch);

	
?>