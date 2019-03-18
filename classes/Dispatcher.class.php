<?php 


class Dispatcher{
	
	public static function dispatch($request){
			/* A Revérifier 3/11 */
		$controller = $request->getControllerName().'Controller';
		
		return new $controller($request);	
			
	}
}

?>