<?php

	header("Access-Control-Allow-Origin: *");

	$gfyName = null;
	$clip = null;

	if ( isset( $_GET['gfyName'] ) ) {
		$gfyName = $_GET['gfyName'];
	}

	if ( isset( $_GET['clip'] ) ) {
		$clip = $_GET['clip'];
	}


	$ch = curl_init('http://gfycat.com/ajax/publish/'.$gfyName);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$json = '';
	if( ($json = curl_exec($ch) ) === false) {
    	echo 'Curl error: ' . curl_error($ch);
	}
	else {
    	
    	echo '&lt;iframe width=&quot;675&quot; height=&quot;550&quot; src=&quot;http://www.draftbreakdown.com/gif-embed/?clip='.$clip.'&gif='.$gfyName.'&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot;&gt;&lt;&#47;iframe&gt;';
	}

	// Close handle
	curl_close($ch);

	
?>