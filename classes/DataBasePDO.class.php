<?php 

class DatabasePDO{

  protected static $pdo=null;

  public static function getCurrentPDO(){
		$mysql_adresse="mysql:host=localhost;dbname=table";

		$mysql_user="root";
		$mysql_password="root";
    $PDO = new PDO($mysql_adresse,$mysql_user,$mysql_password);
		if(is_null(self::$pdo)){
			self::$pdo = new PDO($mysql_adresse,$mysql_user,$mysql_password);
			self::$pdo-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		return self::$pdo;
	}  


	
}

?>
