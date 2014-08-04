<?php
function provideDatanakedsecurity() {
	include('../config.php');
	if (file_exists($config['localNakedFeed']) && date("d",filemtime($config['localNakedFeed'] )) == date("d")){
		return json_decode(file_get_contents($config['localNakedFeed']), true);
	}else{
		$downloadarray = json_decode(json_encode(simplexml_load_string(implode(file($config['nakedFeed'])))),TRUE);
		$naked = array();
		$naked = $downloadarray['channel']['item'];
		file_put_contents($config['localNakedFeed'], json_encode($naked));
		return $naked;
	}
}
?>