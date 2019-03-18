<?php 

class AnonymousController extends Controller{
	
	public function __construct($request){
		parent::__construct($request);
		/*
		if(!empty($_POST['inscLogin'])&&!empty($_POST['inscPassword'])){
			echo "Inscription ok";
			$this->validateInscription($request);
		}*/
	}
	
	public function defaultAction($request) { 
		$view = new AnonymousView($this, null); 
		$view->render(); 
	}
	
	
	public function inscription($request){
		$view = new AnonymousView($this,'inscription');
		$view-> render();
	}
	
	public function home($request){
		
		if(isset($_SESSION['login'])){
			$view = new UserView($this,'home');
			$view->render();
		}
		else{
			$view = new AnonymousView($this,'home');
			$view-> render();
		}
	}

	public function login($request){
		$view = new AnonymousView($this,'login');
		$view->render();
	}
	
	
	public function validateInscription($request) { 
		$login = $request->read('inscLogin');

		if(User::isLoginUsed($login)) { 
			$view = new View($this,'inscription'); 
			$view->setArg('inscErrorText','This login is already used'); 
			$view->render(); 
		} else {
			$password = $request->read('inscPassword'); 
			$nom = $request->read('nom'); 
			$prenom = $request->read('prenom'); 
			$mail = $request->read('mail');
			$user = User::create($login, $password,$mail,$nom,$prenom);
			if(!isset($user)) { 
				$view = new View($this,'inscription'); 
				$view->setArg('inscErrorText', 'Cannot complete inscription'); 
				$view->render(); 
			} else { 
				$request->resetRequest();
				$newRequest = $request->getCurrentRequest();
				$newRequest->write('controller','user');
				$newRequest->write('user',$user->getLogin());
				$newRequest->writePost('loginLogin',$user->getLogin());
				$newRequest->writePost('loginPassword',$user->getPassword());
				$newController=Dispatcher::dispatch($newRequest); 
				$newController->tryLogin($newRequest);
			}
		}
	}



	public function tryLogin($request){
		$login = $request->read('loginLogin');
		$password = $request->read('loginPassword');
		$user = User::tryLogin($login,$password);
		if (isset($user)){
			if (!isset($_SESSION)){
				session_start();
			}
			$_SESSION['login'] = $login;
			$request->resetRequest();
			$newRequest = $request->getCurrentRequest();
			$newRequest->write('controller','user');
			$newRequest->write('user',$user->getLogin()); 
			$newRequest->write('action','validateConnexion');
			$newController = Dispatcher::dispatch($newRequest);
			$newController->validateConnexion($newRequest);
		}
		else{ 
			$view = new View($this,'login'); 
			$view->setArg('inscErrorText', 'Cannot complete connexion'); 
			$view->render(); 
		} 
		
	}



	/*
	if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['pseudo'])){
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$pdo = new PDO($dsn,$user,$password);
		$log = $_POST['login'];
		$pass = $_POST['password'];
		$pseudo = $_POST['pseudo'];
		//$sql = 'INSERT INTO users(login,password,pseudo) VALUES(' .$_POST['login'] .',' .$_POST['password'] .  ',' .$_POST['pseudo'] . ')';
		try{
			
		$request=$pdo->prepare("INSERT INTO `users`(`login`, `password`, `pseudo`) VALUES(?,?,?)");
        $request->execute(array($log, $pass, $pseudo));
        
		
		//$pdo->exec('INSERT INTO users(login,password,pseudo) VALUES ( ' .$_POST['login']. ',' . $_POST['password'] . ',' . $_POST['pseudo'] .')');
		
		
		//$request=$pdo->prepare("INSERT INTO `users`(`login`, `password`, `pseudo`) VALUES (?,?,?)");
        //$request->execute(array($_POST['login'], $_POST['password'], $_POST['pseudo']));
		}
		//$request = $pdo->query($sql);
	
	        catch(EXCEPTION $e)
        {  
            
            die('Erreur : '.$e->getMessage());
        }
	}
	*/
	
	
	public function validateConnexion($request){
		$view = new UserView($this,'connected');
		$view->render();
	}

	public function deconnexion($request){
		$_SESSION = array();
		$request->resetRequest();
		$newController = Dispatcher::dispatch($request);
		$newController->home($request);
	}

}


?>
