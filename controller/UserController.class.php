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
		$view = new UserView($this, 'home',array('user' =>$this->currentUser)); 
		$view->render(); 
	}
	public function profil($request){
		$view = new UserView($this, 'profiluser',array('user' =>$this->currentUser)); 
		$view->render(); 
	}

	public function deconnexion($request){
		$_SESSION = array();
		header("location: index.php?action=home");
		}

	public function validateConnexion($request){
		$view = new UserView($this,'connected',array('user'=>$this->currentUser));
		$view->render();
	}
	
	public function modifier($request){
		$view = new UserView($this,'modifyuser',array('user'=>$this->currentUser));
		$view->render();
	}

	public function validateModification($request){
		$password = $request->read('password');
		$passwordConf = $request->read('passwordConf'); 
		$majeure = $request->read('majeure');
		$promotion = $request->read('promotion'); 
		$mail = $request->read('mail');
		$nom = $request->read('nom'); 
		$prenom = $request->read('prenom');

		if ($password==$passwordConf && $password!=''){
			User::modify('PASSWORD',$password,$this->currentUser->getId());
		}

		if ($majeure!=''){
			User::modify('MAJEURE',$majeure,$this->currentUser->getId());
		}

		if ($promotion!=''){
			User::modify('PROMOTION',$promotion,$this->currentUser->getId());
		}

		if ($mail!=''){
			User::modify('MAIL',$mail,$this->currentUser->getId());
		}
	
		if ($prenom!=''){
			User::modify('PRENOM',$prenom,$this->currentUser->getId());
		}

		if ($nom!=''){
			User::modify('NOM',$nom,$this->currentUser->getId());
		}

		$currentUser = User::getById($_SESSION['id']); 
		header("location: index.php?action=profil&controller=user");
	}
	
	public function repondreQuiz($request){
		$view = new UserView($this, 'quizReponse',array('user' =>$this->currentUser)); 
		$view->render(); 
	}
	
	public function choixQuiz($request){
		$view = new UserView($this, 'choixQuiz',array('user' =>$this->currentUser)); 
		$view->render(); 
	}
	
	public function arriveeQuiz($request){
		//pour l'instant je charge que le dernier;
		$currentUser = User::getById($_SESSION['id']);
		
		$allQuiz = $currentUser->getQuestionnaire($currentUser->getId()); 

		$max = sizeof($allQuiz);
		for($i = 0; $i < $max;$i++){
			$quiz = $allQuiz[$i];
		}
		
		$questionnaire = new Questionnaire($quiz['id'],$quiz['titre'],$quiz['description'],$quiz['dateOuverture'],$quiz['dateFermeture'],$quiz['connexionRequise'],$quiz['etat'],$quiz['url'],$quiz['createur']);
		
		
		$questions = $questionnaire->getQuestions($questionnaire->getId()); 
		$nbQuestion = sizeof($questions);
		
		//echo $nbQuestion;
		
		$view = new UserView($this, 'quizReponseIneractifDebut',array('user' =>$this->currentUser)); 
		$view->renderDebut(); 
		$view->renderMilieu(); 
		for($i = 0; $i < $nbQuestion  ;$i++){
			$question = $questions[$i];
			if($question['type']=='QCU'){
				$type='radio';
			}
			else if($question['type']=='QCM'){
				$type='checkbox';
			}
			$view = new UserView($this, 'quizReponseIneractifDebutDUneQuestion',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i)); 
			$view->renderMilieu(); 
			$view = new UserView($this, 'debutDeLigne',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i)); 
			$view->renderMilieu(); 
			
			
			$questionModel = new Question($question['id'],$question['type'],$question['intitule']);
			$reponses = $questionModel->gerReponses($questionModel->getId()); 
			$nbReponse = sizeof($reponses);
			for($j = 0; $j < $nbReponse ;$j++){
				$reponse = $reponses[$j];
				$view = new UserView($this, 'quizReponseIneractifUneReponse',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i, 'reponse' => $reponse, 'numero_reponse' => $j, 'type' => $type)); 
				$view->renderMilieu(); 
				
				//recuperer les reponse possible
			}
			
			$view = new UserView($this, 'finDeLigne',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i)); 
			$view->renderMilieu(); 
			if($i<$nbQuestion-1){
				$view = new UserView($this, 'quizReponseIneractifFinDUneQuestion',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i)); 
			}
			else{
				$view = new UserView($this, 'quizReponseIneractifFin',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i));
			}
			$view->renderMilieu(); 
		}
		
		$view->renderFin(); 
	}
	
}
?>