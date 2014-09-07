<?php
function provideDatanakedsecurity() {
	include('config.php');
	if (file_exists($config['localNakedFeed']) && date("d",filemtime($config['localNakedFeed'] )) == date("d") && (date("H",filemtime($config['localnpr'])) > date("H") - 2)){
		return json_decode(file_get_contents($config['localNakedFeed']), true);
	}else{
		$downloadarray = json_decode(json_encode(simplexml_load_string(implode(file($config['nakedFeed'])))),TRUE);
		$naked = array();
		for ($i=0; $i < 5; $i++) { 
			$naked[$i]['title'] = $downloadarray['channel']['item'][$i]['title'];
			$naked[$i]['description'] = $downloadarray['channel']['item'][$i]['description'];
			$naked[$i]['date'] = date('n/j H:i',strtotime($downloadarray['channel']['item'][$i]['pubDate']));
		}
		$nakedjson = json_encode($naked);
		file_put_contents($config['localNakedFeed'], json_encode($naked));
		return $naked;
	}
}
?>