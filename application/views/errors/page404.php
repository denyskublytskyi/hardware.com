<!DOCTYPE html>
<html>
	<head>
		<title>Page not found!</title>
		<link href = <? echo "http://" . $_SERVER['SERVER_NAME'] . "/templates/css/page404.css" ?> rel = "stylesheet" type = "text/css">
		<link href = <? echo "http://" . $_SERVER['SERVER_NAME'] . "/templates/css/fonts.css" ?> rel = "stylesheet" type = "text/css">
	</head>
	<body>
		<div id = "content">
			<div id = "image">
				<img src = <? echo "http://" . $_SERVER['SERVER_NAME'] . "/templates/images/errors/404_1.png" ?>>
				<div id = "rotate">
					<img src = <? echo "http://" . $_SERVER['SERVER_NAME'] . "/templates/images/errors/404_2.png" ?>>
				</div>
			</div>
			<div>
				Page not found!
			</div>
		</div>
	</body>
</html>