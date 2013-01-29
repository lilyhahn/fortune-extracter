<html>
	<head>
		<title>ThinkGeek Fortune Extracter</title>
	</head>
	<body>
		<?php
			$isgood = true;
			$dom = new DOMDocument();
			$store = new DOMDocument();
			$store->load('fortunes.xml');
			$fortunearray = Array();
			@$dom->loadHTML(@file_get_contents("http://www.thinkgeek.com/brain/fortune.cgi?"));
			foreach ($dom->getElementsByTagName('blockquote') as $node) {
				echo $dom->saveHtml($node), "<hr>";
				$storenodetemp = $store->getElementsByTagName('fortunes');
				$storenode = $storenodetemp->item(0);
				foreach($store->getElementsByTagName('fortune') as $fortuneCache){
					$count= 0;
					array_push($fortunearray, $fortuneCache->getAttribute('text'));
					$count++;
				}
				for($i = 0; $i < sizeof($fortunearray); $i++){
					if($fortunearray[$i] != $dom->saveHtml($node)){
						continue;
					}
					else{
						$isgood = false;
						break;
					}
				}
				if($isgood){
					$fortune = $store->createElement("fortune");
					$fortunenode = $storenode->appendChild($fortune);
					$fortunenode->setAttribute("text", $dom->saveHtml($node));
					$store->save("fortunes.xml");
					echo "NEW FORTUNE W00T!";
					echo "<script type=\"text/javascript\">
						setTimeout(25);//avoid causing too many redirects
						window.location.href=window.location.href;
						</script>
						";
				}
				else{
					echo "This fortune has already been recorded...";
					echo "<script type=\"text/javascript\">
						setTimeout(25); //avoid causing too many redirects
						window.location.href=window.location.href;
						</script>
						";
				}
			}
			echo "<script type=\"text/javascript\">
						setTimeout(25); //avoid causing too many redirects
						window.location.href=window.location.href;
						</script>
						";// if it didn't get a fortune, reload
		?>
	</body>
</html>