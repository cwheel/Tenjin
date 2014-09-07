<?php
	function provideDataOit() {
		return json_decode(file_get_contents("http://www.oit.umass.edu/status/raw"));
	}
?>