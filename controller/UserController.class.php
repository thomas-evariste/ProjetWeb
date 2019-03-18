<?php 

class UserController extends AnonymousController{
	
    public function defaultAction($request) { 
		$view = new UserView($this, 'connected'); 
		$view->render(); 
	}
	


}
?>