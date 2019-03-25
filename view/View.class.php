<?php 

class View{
	
	private $currentController;
	private $data;
	private $template; 

	
	
	function __construct($currentController, $template, $args = array()){
		$this->currentController = $currentController;
		$this->data = $args;
		$this->template = $template .'Template';

	}


	function render(){

		extract($this->data);
		require_once(__ROOT_DIR . '/templates/headTemplate.php');
		require_once(__ROOT_DIR . '/templates/topTemplate.php');
		require_once(__ROOT_DIR . '/templates/menuTemplate.php');
		if($this->template != 'Template')
		{
			require_once(__ROOT_DIR . '/templates/' . $this->template .'.php');
		}
		require_once(__ROOT_DIR . '/templates/footTemplate.php');
	}


	function setArg($keyName, $keyValue){
		//$this->data['\'' . $keyName .  '\'' ] = $keyValue;
		$this->data[$keyName] = $keyValue;
	}

}


?>