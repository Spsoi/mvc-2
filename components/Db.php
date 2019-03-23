<?php
class Db{
	public static function getConnection(){
		## параметры соединения выносим в отдельный файл db_params.php
		$paramsPath = ROOT . '/config/db_params.php';
		$params = include($paramsPath);
		
		$dsn = "mysql:host={$params['host']};
				dbname={$params['dbname']}";
				
		## создаём объект класса PDO
		$db = new PDO($dsn, $params['user'], $params['password']);
		
		return $db;
	}
}
?>
