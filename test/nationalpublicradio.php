<?php

//Check for image
//Add Caching
error_reporting(E_ALL);
ini_set('display_errors', 1);
$downloadedData = downloadData();
print_r(provideDatanationalpublicradio());
//print_r($nprArray);
function provideDatanationalpublicradio(){
	$downloadedData = downloadData("");
	$x = 0;
	foreach ($downloadedData['list']['story'] as $story) {
		$nprArray[$x]['title'] = $story['title']['$text'];
		$nprArray[$x]['teaser'] = $story['teaser']['$text'];
		$nprArray[$x]['thumbnail'] = $story['thumbnail']['medium']['$text'];
		$nprArray[$x]['date'] = $story['pubDate']['$text'];
		$x++;
	};
	return $nprArray;

}
	
function downloadData($apiFile){
	    $json = file_get_contents($apiFile);
	    return json_decode($json, TRUE);
}

?>