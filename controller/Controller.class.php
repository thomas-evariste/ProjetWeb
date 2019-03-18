<?php

abstract class Controller{
	
	private $request;
	
	
	function __construct($request){
		$this->request = $request;
	}


	abstract public function defaultAction($request);

	function execute(){
		$action = $this->request->getActionName();
		$this->$action($this->request);
	}
	


}





?>