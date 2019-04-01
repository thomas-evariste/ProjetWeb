<?php 

class Request{

	protected static $instance=null; // Contiendra l'instance de notre classe.

	public static function getCurrentRequest() {
		if (!isset(static::$instance)) // Si on n'a pas encore instancié notre classe.
		{
		  static::$instance = new static; // On s'instancie nous-mêmes
		}
		return static::$instance; //Sinon on se renvoie soi-même
	}  


	public function getControllerName() { 
	
	/* A revérifier 11/3 */
		if(isset($_GET['controller'])){
			return ucfirst(strtolower($_GET['controller']));
		}
		else{
			return 'Anonymous';
		}
	}

	public function getActionName() { 
	
	/* A revérifier 11/3 */
		if(isset($_GET['action'])){
			return strtolower($_GET['action']);
		}
		else{
			return 'defaultAction';
		}
	}
	
	public function read($key){
		
		return $_POST[$key];
		
	}

	public static function write($aGet, $aValue){
		$_GET[$aGet]=$aValue;
	}

	public static function writePost($aPost,$aValue){
		$_POST[$aPost]=$aValue;
	}

	public static function writeSession($aSession,$aValue){
		$_SESSION[$aSession]=$aValue;
	}
	
	public function __construct() {}

	public static function resetRequest(){
		/*foreach ($_REQUEST as $key => $value) {
			$_REQUEST[$key] = NULL;
		}*/
		unset($instance);
	}

}


?>