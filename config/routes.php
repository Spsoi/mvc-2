<!doctype html>
<html lang="ru">
<html>
	<head>
	<meta charset="utf-8">
		<title>
			routes
		</title>
	</head>
	<body>
<?php
return array(
	
	## Расположить эти правила выше так как считается сверху вниз
/* 	'news/77'=>'news/view', 
	'news/15'=>'news/view', */ 
	## Заменим это регулярным выражением
	## ([0-9]+) - означает
	## В строке может содержатся от 1 и > цифр
	'news/([0-9]+)'=> 'news/view/$1',
	/* 'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',	 */
	
	'news'=>'news/index',## Вызови метод(функцию) actionIndex в контроллере NewsController
);
?>
	</body>
</html>