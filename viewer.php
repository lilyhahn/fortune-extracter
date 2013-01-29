<html>
	<head>
		<title>ThinkGeek Fortune Extracter</title>
	</head>
	<body>
		Here is every fortune that the system has extracted so far. Keep on refreshing, and don't forget to search for your quote!<br />
		<?php
			$store = new DOMDocument();
			$store->load('fortunes.xml');
			foreach ($store->getElementsByTagName('fortune') as $node) {
				echo $node->getAttribute('text'), "<br /> <hr /> <br />";
			}
		?>
		That's all, folks!
	</body>
</html>