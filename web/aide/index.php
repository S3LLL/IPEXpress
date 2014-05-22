<?php

	$file = "home.md";

	if (isset($_GET["f"]) && file_exists("fiche/" . $_GET["f"])) {
		$file = $_GET["f"];
	}

	require_once "markdown.php";

	$md   = file_get_contents("fiche/" . $file);
	$html = Markdown($md);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>IPEXpress Aide</title>
		<link rel='stylesheet' type='text/css' href='Clearness.css' />
		<style type="text/css">
			body, html {
				margin: 0;
				padding: 0;
			}
			div#md {
				width: 40%;
				margin-right: auto;
				margin-left: auto;
				margin-top: 25px;
				text-align: justify;
			}
			div#nav {
				width: 27%;
				position: fixed;
				right: 1%;
				top: 150px;
				text-align: left;
			}
			div#nav span.titre {
				display: block;
				color: #333;
				font-size: 2em;
				margin-bottom: 20px;
			}
			div#nav span.about {
				display: block;
				margin-top: 20px;
				color: #737373;
				font-style: italic;
				font-size: .9em;
			}
			div#nav span.about a {
				display: inline;
				color: #737373;
			}
			div#nav span.about a:hover {
				text-decoration: underline;
			}
			div#nav a {
				display: list-item;
				list-style: none;
				text-decoration: none;
			}
		</style>	
	</head>
	<body>
		<div id="md"><?php echo $html; ?></div>
		<div id="nav">
			<span class="titre">IPEXpress <i>Aide</i></span>
			<a href="?f=home.md">Acceuille</a>
			<a href="?f=install.md">Installer IPEXpress</a>
			<span class="about" >IPEXpress: <a href="http://ipxe.org/" target="_blank">iPXE</a> pour <a target="_blank" href="http://expressos.org">ExpressOs</a>.</span>
		</div>
		<a target="_blank" href="https://github.com/S3LLL/IPEXpress"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://camo.githubusercontent.com/567c3a48d796e2fc06ea80409cc9dd82bf714434/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png"></a>
	</body>
</html>
