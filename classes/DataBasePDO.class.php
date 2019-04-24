<?php 

class DatabasePDO{

  protected static $pdo=null;

  public static function getCurrentPDO(){
		$mysql_adresse="mysql:host=localhost:3306;dbname=quentin_coquerel;charset=utf8";
		//$mysql_adresse="mysql:host=localhost;dbname=table;charset=utf8";
		$mysql_user="quentin.coquerel";
		$mysql_password="UBQovgbj";
		
		//$mysql_user="root";
		//$mysql_password="root";
		
	$PDO = new PDO($mysql_adresse,$mysql_user,$mysql_password);
	$PDO->query('set character_set_client=utf-8');
	$PDO->query('set character_set_connection=utf-8');
	$PDO->query('set character_set_results=utf-8');
		$PDO->query('set character_set_server=utf-8');
		$PDO->exec("SET CHARACTER SET utf-8"); 
		if(is_null(self::$pdo)){
			self::$pdo = new PDO($mysql_adresse,$mysql_user,$mysql_password);
			self::$pdo->query('set character_set_client=utf-8');
			self::$pdo->query('set character_set_connection=utf-8');
			self::$pdo->query('set character_set_results=utf-8');
			self::$pdo->query('set character_set_server=utf-8');
			self::$pdo-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		return self::$pdo;
	}  


	
}

?>
