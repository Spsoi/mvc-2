<?php


class News{
	/* 
	* return sigle news item with specified id
	* @param integer $id
	* Используем один результат
	*
	*/
	public static function getNewsItemById($id){
		$id = intval($id);
		
		if($id){
			// $host = '192.168.0.158';
			// $dbname = 'polimorfizm';
			// $user = 'root';
			// $password ='';
			// $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
			// ## Создай пустой массив в который ты будешь складывать результаты
		$db = Db::getConnection();
		
		## цикл не нужен так как ищем одну новость
		$result = $db->query('SELECT * from publication WHERE id='. $id);
		
		/* $result->setFetchMode(PDO::FETCH_NUM); */
		
		## возвращает массив, индексированный именами столбцов результирующего набора
		$result->setFetchMode(PDO::FETCH_ASSOC);
		
		
		$newsItem = $result->fetch();
		
		return $newsItem;
		
		}
	}
	/*
	* returns an array of news items
	
	*/ 
	public static function getNewsList(){
		// $host = '192.168.0.158';
		// $dbname = 'polimorfizm';
		// $user = 'root';
		// $password ='';
		// $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
			
			$db = Db::getConnection();
			
		## Создай пустой массив в который ты будешь складывать результаты
		$newsList = array();
		
		## Выбрать 10 последних новостей из таблицы новости
		$result = $db->query('SELECT id, title, date, short_content'
				. ' FROM publication '
				. ' ORDER BY date DESC '
				. ' LIMIT 10 ');
	echo'<pre>';
	var_dump($result);
	echo'</pre>';
	$i=0;
	## обращаемся к методу(функции)fetch переменной $result
	while($row = $result->fetch()){
		$newsList[$i]['id']=$row['id'];
		$newsList[$i]['title']=$row['title'];
		$newsList[$i]['date']=$row['date'];
		$newsList[$i]['short_content']=$row['short_content'];
		$i++;
		}
		return $newsList;
	}
}



?>