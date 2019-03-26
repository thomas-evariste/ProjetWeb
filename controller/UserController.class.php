<?php 

class UserController extends AnonymousController{
	
	protected $currentUser;
    public function __construct($request) {
			parent::__construct($request);
			$this->currentUser = User::getById($_SESSION['id']);
	}

  public function defaultAction($request) { 
		$view = new UserView($this, 'connected',array('user' =>$this->currentUser)); 
		$view->render(); 
	}

	public function home($request){
		echo 'UserController';
		$view = new UserView($this, 'home',array('user' =>$this->currentUser)); 
		$view->render(); 
	}
	public function profil($request){
		$view = new UserView($this, 'profil',array('user' =>$this->currentUser)); 
		$view->render(); 
	}

	public function deconnexion($request){
		$_SESSION = array();
		/*$request->resetRequest();
	   $newController = Dispatcher::dispatch($request);
	   $newController->home($request);
	   */
		$request->resetRequest();
		$newController = Dispatcher::dispatch($request);
		$request->write('action', 'home');
		$newController->home($request);
	 }

	 public function validateConnexion($request){
		$view = new UserView($this,'connected',array('user'=>$this->currentUser));
		$view->render();
	}
	

}
?>