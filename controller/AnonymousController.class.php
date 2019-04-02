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
	
	public function choixinscription($request){
		$view = new AnonymousView($this,'choixinscription');
		$view-> render();
	}

	public function inscription($request){
		$view = new AnonymousView($this,'inscription');
		$view-> render();
	}

	public function inscriptionprof($request){
		$view = new AnonymousView($this,'inscriptionprof');
		$view-> render();
	}
	
	public function home($request){
		$view = new View($this,'home');
		$view-> render();
	}

	public function login($request){
		$view = new AnonymousView($this,'login');
		$view->render();
	}
	
	public function generateInscError($text){
		$view = new View($this,'inscription');
		$view->setArg('inscErrorText',$text);
		$view->render();
	}
	
	
	public function validateInscription($request) { 
		$login = $request->read('inscLogin');
		$password = $request->read('inscPassword'); 
		if (trim($login)=='' || trim($password)==''){
			$this->generateInscError('Merci d\'insérer un login et un password valides');
		}
		else if(User::isLoginUsed($login)) { 
			AnonymousController::generateInscError('Ce login est déjà utilisé');
		} 
		else {
			if(strlen($login)>25){
				AnonymousController::generateInscError('Merci d\'utiliser un login de moins de 25 caractères');
			}
			elseif(strlen($password)>25){
				AnonymousController::generateInscError('Merci d\'utiliser un password de moins de 25 caractères');
			}
			else{
				$nom = $request->read('nom'); 
				$prenom = $request->read('prenom'); 
				$mail = $request->read('mail');
				$majeure = $request->read('majeure');
				$promotion = $request->read('promotion');
				if(strlen($mail)>70){
					AnonymousController::generateInscError('Merci d\'utiliser un mail de moins de 70 caractères');
				}
				else if(strlen($nom)>50){
					AnonymousController::generateInscError('Merci d\'utiliser un nom de moins de 50 caractères');
				}
				else if(strlen($prenom)>50){
					AnonymousController::generateInscError('Merci d\'utiliser un prenom de moins de 50 caractères');
				}
				else{
					User::create(User::nbUsers()+1,$login, $password,$promotion,$majeure ,$nom,$prenom,$mail);
					$id=User::getIdByLogin($login);
					$user = new User($id,$login, $password,$promotion,$majeure ,$nom,$prenom,$mail);
					if(!isset($user)) { 
						AnonymousController::generateInscError('Inscription invalide, merci de réessayer');
					} else { 
						$request->resetRequest();
						$newRequest = $request->getCurrentRequest();
						$newRequest->write('controller','user');
						$newRequest->write('user',$user->getLogin());
						$newRequest->writePost('loginLogin',$user->getLogin());
						$newRequest->writePost('loginPassword',$user->getPassword());
						$newRequest->writeSession('id',$user->getId());
						$newController=Dispatcher::dispatch($newRequest); 
						$newController->tryLogin($newRequest);
					}
				}
			}
		}
	}


	public function tryLogin($request){
		$login = $request->read('loginLogin');
		$password = $request->read('loginPassword');
		$user = User::tryLogin($login,$password);
		if (isset($user)){
			$_SESSION['id'] = $user->getId();
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
	
	


   // Bien que cette fonction n'ait pas à être dans AnonymousController, suite à la courte discussion que nous avons eu à 12h, je n'ai pas réussi à l'utiliser correctement depuis UserController
   //(Ceci affichait une page vide)


/*
	public function deconnexion($request){
		$_SESSION = array();
		$view = new AnonymousView($this,'home');
		$view-> render();
	}
*/

}
?>
