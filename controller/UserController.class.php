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
        $questionnaires = User::getQuestionnaireAFaire($currentUser->getId());
        $view = new UserView($this,'choixQuestionnaires',array('user'=>$this->currentUser,'questionnaires'=>$questionnaires));
        $view->render();
    }
	
	public function repondreQuiz($request){
		$currentUser = User::getById($_SESSION['id']);
        $idQuest = $request->read('questionnaireId');
		
		$questionnaire = $currentUser->getQuestionnaireById($idQuest);
		

		$questions = $questionnaire->getQuestionsInData($questionnaire->getId()); 
		$nbQuestion = sizeof($questions);
		
		//echo $nbQuestion;
		
		$view = new UserView($this, 'quizReponseInteractifDebut',array('user' =>$this->currentUser)); 
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
			
			$view = new UserView($this, 'quizReponseInteractifDebutDUneQuestion',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i, 'type' => $question['type'])); 
			$view->renderMilieu(); 
			$view = new UserView($this, 'debutDeLigne',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i)); 
			$view->renderMilieu(); 
			
			if($type!='ouverte'){
				
				$reponses = Question::gerReponses($question['id']); 
				$nbReponse = sizeof($reponses);
				for($j = 0; $j < $nbReponse ;$j++){
					$reponse = $reponses[$j];
					$view = new UserView($this, 'quizReponseInteractifUneReponse',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i, 'reponse' => $reponse, 'numero_reponse' => $j, 'type' => $type)); 
					$view->renderMilieu(); 
				
					//recuperer les reponse possible
				}
			}
			
			else{
				$view = new UserView($this, 'quizReponseInteractifUneReponseOuverte',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i, 'type' => $type));
				$view->renderMilieu();
			}
			
			$view = new UserView($this, 'finDeLigne',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i)); 
			$view->renderMilieu(); 
			if($i<$nbQuestion-1){
				$view = new UserView($this, 'quizReponseInteractifFinDUneQuestion',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i, 'type' => $type)); 
			}
			else{
				$view = new UserView($this, 'quizReponseInteractifFin',array('user' =>$this->currentUser,'question' => $question, 'numero' => $i, 'type' => $type));
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
		
		$argsQCM = array();
		$numQestionQCM = array();
		foreach ($args as $key => $tentative) {
			if(strpos($key,"adio")){
				$justesse = $currentUser->verifiReponseQCU($tentative);
				if($justesse==1){
					$note=$note+$bonus;
				}
				else{
					$note=$note+$malus;
				}
			}
			else{
				$q = substr($key, -3, 1);
				$r = substr($key, -1, 1);
				$newKey = intval($q) * 1000 + intval($r);
				$argsQCM[$newKey]=$tentative;
				
				if(!in_array($q,$numQestionQCM)){
					$numQestionQCM[]=$q;
				}
			}
		}
		
		foreach ($numQestionQCM as $q) {
			$argsTentative = array();
			foreach ($argsQCM as $key => $tentative){
				if(intval($key/1000)==$q){
					$argsTentative[] = $tentative;
				}
			}
			$justesse =0;
			if(!empty($argsTentative)){
				$justesse = $currentUser->verifiReponseQCM($argsTentative,$id_questionnaire);
				echo 'justesse : ' . $justesse . '<br>';
				if($justesse==0){
					$note=$note+$malus;
				}
				else{
					echo 'pt :' . $bonus*$justesse . '<br>';
					$note=$note+$bonus*$justesse;
				}
			}
		}
		echo 'note : ' . $note;
		$currentUser->attribuNote($_SESSION['id'],$id_questionnaire,$note);
		
	}
	
}
?>