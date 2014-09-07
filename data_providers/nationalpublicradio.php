<?php

function provideDatanationalpublicradio(){
	$nprArray = array();
	include('config.php');
	if (file_exists($config['localnpr']) && date("d",filemtime($config['localnpr'] )) == date("d") && (date("H",filemtime($config['localnpr'])) > date("H") - 2)){
		return json_decode(file_get_contents($config['localnpr']), true);
	}
	$downloadedData = nprdownloadData($config['nprFeed']);
	$x = 0;
	foreach ($downloadedData['list']['story'] as $story) {
		$nprArray[$x]['title'] = $story['title']['$text'];
		$nprArray[$x]['teaser'] = $story['teaser']['$text'];
		if (array_key_exists('thumbnail', $story)){
			$nprArray[$x]['thumbnail'] = $story['thumbnail']['medium']['$text'];
		}
		$nprArray[$x]['date'] = date('n/j H:i' ,strtotime($story['pubDate']['$text']));
		$x++;
	}
	file_put_contents($config['localnpr'], json_encode($nprArray));
	return $nprArray;
}
	
function nprdownloadData($apiFile){
	    $json = file_get_contents($apiFile);
	    return json_decode($json, TRUE);
}
?>