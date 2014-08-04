<?php
	function provideDataredditHeadliner(){
		include('config.php');

	    if (file_exists($config['localRedditData'])){
			if (date("d",filemtime($config['localRedditData'])) != date("d")){
				return makeArray($config['reddit'], $config['redditArticleNum']);
			}else if (date("H",filemtime($config['localRedditData'])) <= date("H") - 1){
				return makeArray($config['reddit'], $config['redditArticleNum']);
			}else{
				return json_decode(file_get_contents($config['localRedditData'], true));
			}
		}else{
			return makeArray($config['reddit'], $config['redditArticleNum']);
			}
	}

	function makeArray($array, $num){
		include('config.php');
		$redditArray = array();
		$downloadedRedditData = null;
		foreach ($array as $ra){
			$i = 0;
			$downloadedRedditData = downloadData('http://www.reddit.com/r/' . $ra . "/top.json?limit=5");
			for ($i=0; $i < $num; $i++) { 
				//print_r($downloadedRedditData['data']['children'][$i]['data']);
				if (array_key_exists("is_self", $downloadedRedditData['data']['children'][$i]['data'])){
					$redditArray[$ra][] = $downloadedRedditData['data']['children'][$i]['data']['title'];		 
			 		$redditArray[$ra][$downloadedRedditData['data']['children'][$i]['data']['title']][] = $downloadedRedditData['data']['children'][$i]['data']['score'];
				}
			}
		}
			file_put_contents($config['localRedditData'], json_encode($redditArray));
			return $redditArray;
	}

	function downloadData($apiFile){
	    $json = file_get_contents($apiFile);
	    return json_decode($json, TRUE);
	}

?>