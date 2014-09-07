<?php

//Check for image
//Add Caching
error_reporting(E_ALL);
ini_set('display_errors', 1);
print_r(provideDatanationalpublicradio());
function provideDatanationalpublicradio(){
	include('../config.php');
	if (file_exists($config['localnpr']) && date("d",filemtime($config['localnpr'] )) == date("d")){
		return json_decode(file_get_contents($config['localnpr']), true);
	}
	$downloadedData = downloadData($config['nprFeed']);
	$x = 0;
	foreach ($downloadedData['list']['story'] as $story) {
		$nprArray[$x]['title'] = $story['title']['$text'];
		$nprArray[$x]['teaser'] = $story['teaser']['$text'];
		if (array_key_exists('thumbnail', $story)){
			$nprArray[$x]['thumbnail'] = $story['thumbnail']['medium']['$text'];
		}
		$nprArray[$x]['date'] = $story['pubDate']['$text'];
		$x++;
	}
	file_put_contents($config['localnpr'], json_encode($nprArray));
	return $nprArray;
}
	
function downloadData($apiFile){
	    $json = file_get_contents($apiFile);
	    return json_decode($json, TRUE);
}
?>