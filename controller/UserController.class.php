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
		
    
    public function voirQuestionnaires($request){
		$currentUser = User::getById($_SESSION['id']);
        $questionnaires = User::getQuestionnaire($currentUser->getId());
        $view = new UserView($this,'choixQuestionnaires',array('user'=>$this->currentUser,'questionnaires'=>$questionnaires));
        $view->render();
    }
	
	public function repondreQuiz($request){
		//pour l'instant je charge que le dernier;
		$currentUser = User::getById($_SESSION['id']);
        $idQuest = $request->read('questionnaireId');
		
		$questionnaire = $currentUser->getQuestionnaireById($idQuest);
		
		$allQuiz = $currentUser->getQuestionnaire($currentUser->getId()); 

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
			else{
				$type='ouverte';
			}
			
			$view = new UserView($this, 'quizReponseIneractifDebutDUneQuestion',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i)); 
			$view->renderMilieu(); 
			$view = new UserView($this, 'debutDeLigne',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i)); 
			$view->renderMilieu(); 
			$questionModel = new Question($question['id'],$question['type'],$question['intitule']);
			
			if($type!='ouverte'){
				
				$reponses = $questionModel->gerReponses($questionModel->getId()); 
				$nbReponse = sizeof($reponses);
				for($j = 0; $j < $nbReponse ;$j++){
					$reponse = $reponses[$j];
					$view = new UserView($this, 'quizReponseIneractifUneReponse',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i, 'reponse' => $reponse, 'numero_reponse' => $j, 'type' => $type)); 
					$view->renderMilieu(); 
				
					//recuperer les reponse possible
				}
			}
			
			else{
				$view = new UserView($this, 'quizReponseIneractifUneReponseOuverte',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i, 'type' => $type));
				$view->renderMilieu();
			}
			
			$view = new UserView($this, 'finDeLigne',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i)); 
			$view->renderMilieu(); 
			if($i<$nbQuestion-1){
				$view = new UserView($this, 'quizReponseIneractifFinDUneQuestion',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i, 'type' => $type)); 
			}
			else{
				$view = new UserView($this, 'quizReponseIneractifFin',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i, 'type' => $type));
			}
			$view->renderMilieu(); 
		}
		
		$view->renderFin(); 
	}
	
	public function tenter($request){
		$currentUser = User::getById($_SESSION['id']);
		$id_user = $currentUser->getId();
		$args = array();
		$argsQO = array();
		$id_reponse=1;
		foreach($_POST as $key => $value){
			if(strpos($key,"button")){
				$args[$key] = $value;
				$id_reponse=$value;
			}
			if(is_numeric($key)){
				$argsQO[$key] = $value;
				$id_reponse=$key;
			}
			
		}
		$currentUser->tenterQO($id_user,$argsQO);
		$currentUser->tenterQCM_QCU($id_user,$args);
		$view = new UserView($this, 'merci',array('user' =>$this->currentUser)); 
		$view->render(); 
		
		$questionnaire = $currentUser->getQuestionnaireByReponse($id_reponse);
		
		unset($_POST);
		$_POST["questionnaire"] = $questionnaire;
		$_POST["args"] = $args;
		
		$this->correctionAuto($request);
		
		
	}
	
	public function correctionAuto($request){
		$questionnaire = $_POST["questionnaire"];
		$args = $_POST["args"];		
		
		$currentUser = User::getById($_SESSION['id']);
		$id_questionnaire = $questionnaire->getId();
		
		$note=0;
		$bonus=0;
		$malus=0;
		
		$regle = $currentUser->getRegle($id_questionnaire);
		
		
		foreach ($regle as $nom => $valeur) {
			if($nom=='BONUS'){
				$bonus=$valeur;
			}
			if($nom=='MALUS'){
				$malus=$valeur;
			}
		}
		
				 echo "<br>";
		print_r($args);
				 echo "<br>";
		foreach ($args as $key => $tentative) {
			if(strpos($key,"adio")){
				$justesse = $currentUser->verifiReponse($tentative);
				if($justesse==1){
					$note=$note+$bonus;
				}
				else{
					$note=$note+$malus;
				}
			}
			else{
				 echo "key : " . $key ."  tentative : " . $tentative;
				 echo "<br>";
			}
		}
		$currentUser->attribuNote($_SESSION['id'],$id_questionnaire,$note);
		
	}
	
}
?>