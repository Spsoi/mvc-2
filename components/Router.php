<!doctype html>
<html lang="ru">
<html>
	<head>
	<meta charset="utf-8">
		<title>
			classes
		</title>
	</head>
	<body>
<?php
class Router{
	## Храни маршруты в $routes
	private $routes;
	
	public function __construct(){
		## Укажи путь к роутам
		## ROOT. - путь к базовой дериктории
		## 'config/routes.php' - путь к созданному файлу
		## Покдлючаем КОНСТАНЦИЮ ROOT
		$routesPath = ROOT.'/config/routes.php';
		## $routesPath вбирает массив из файла 'config/routes.php'
		## Запихнём его в include()
		$this->routes = include($routesPath);
	}
	
	/* 
	*	Return request string
	*	@return string
	*/
	private function getURI(){
		## !empty проверяем !не пуста ли переменная REQUEST_URI 
		if (!empty($_SERVER['REQUEST_URI'])){
			## Если нет, удаляем пробелы с переди и сзади слова
			## так же задаём в маске символ для удаления '/'
			return trim($_SERVER['REQUEST_URI'], '/');
			## Возвращаем из запроса например имясайта/news - news
			## Возвращаем из запроса например имясайта/products - products
		}
	}
	
	
	public function run(){
		// Получить строку запроса
		## вынесем его в отдельный метод private function getURI()
		$uri = $this->getURI();
		## запишем в переменную $uri
	
		// Проверить наличие такого запроса в routes.php
		foreach ($this->routes as $uriPattern => $path){
			
			//Сравниваем $uriPattern и $uri
			if(preg_match("~$uriPattern~", $uri)){
				
				echo '<br>Где ищем (запрос, который набрал пользователь): '.$uri;
				echo '<br>Что ищем (совпадение из правила): '.$uriPattern;
				echo '<br>Кто обрабатывает: '.$path;
				
				// Получаем внутренний путь из внешнего согласно правилу
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				
				echo '<br>';
				echo '<br> Нужно сформировать: '.$internalRoute;
				
			//Определяем контроллер и action параметры
				## разделим строку на две части
				## создай массив из двух частей
				$segments = explode('/', $internalRoute);
		
				## Запиши в $controllerName первую строку 
				## Удали её из переменной $segments
				$controllerName = array_shift($segments).'Controller';
				## Сделай первую букву большой
				$controllerName = ucfirst($controllerName);
				
				$actionName = array_shift($segments);
				$actionName = 'action'.ucfirst($actionName);
				
			/* 	echo '<br>Класс '.$controllerName;
				echo '<br>Метод '.$actionName; */
				echo'<br>controller name: '.$controllerName;
				echo'<br>action name: '.$actionName;
				
				$parameters = $segments;
				
				echo'<pre>';
				print_r($parameters);
	
			
				//Если есть совпадение, определить какоей контроллер
		
				//Подключить файл класса-контроллера
				## создай папку 'controllers'
				## создай файл 'ProductController.php'
				$controllerFile = ROOT .'/controllers/'.
				$controllerName . '.php';
				
				## проверь существует ли такой файл.php
				if (file_exists($controllerFile)){
					include_once($controllerFile);
				}
				
				//и action обрабатывают запрос 
## ШАГ №3 вызвать экшен с параметрами

				//Создать объект, вызвать метод(функцию) т.е action
				$controllerObject = new $controllerName;
				
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				
				if($result != null){
					break;
				}
			}
		}
	}
}
?>
	</body>
</html>