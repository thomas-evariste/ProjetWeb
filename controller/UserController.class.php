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
				
					//recuperer les reponses possibles
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
		print_r($_POST);
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
		print_r($args);
		print_r($argsQO);
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
				$bareme = $currentUser->getBareme($tentative);
				if($justesse==1){
					$note=$note+$bonus*$bareme;
				}
				else{
					$note=$note+$malus*$bareme;
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
				$bareme = $currentUser->getBareme($argsTentative[0]);
				$justesse = $currentUser->verifiReponseQCM($argsTentative,$id_questionnaire);
				if($justesse==0){
					$note=$note+$malus*$bareme;
				}
				else{
					$note=$note+$bonus*$justesse*$bareme;
				}
			}
		}
		echo 'note : ' . $note;
		$currentUser->attribuNote($_SESSION['id'],$id_questionnaire,$note);
		
	}
	
    public function voirResultatQuestionnaires($request){
		$currentUser = User::getById($_SESSION['id']);
        $questionnaires = User::getQuestionnaireFait($currentUser->getId());
		foreach($questionnaires as $key => $questionnaire){
			$questionnaires[$key]['corrige']=Questionnaire::getCorrige($questionnaire['id']);
		}
        $view = new UserView($this,'resultatQuestionnaires',array('user'=>$this->currentUser,'questionnaires'=>$questionnaires));
        $view->render();
    }
	
	
	public function classementQuiz($request){
		$currentUser = Prof::getById($_SESSION['id']);
		$id_questionnaire = $_POST['questionnaireId'];
		$resultats = NOTE::getResultats($id_questionnaire);
		$nbResultats = count($resultats);
		
		$permut =true;
		while($permut){
			$permut =false;
			for($i=0;$i<$nbResultats-1;$i++){
				if($resultats[$i]['valeur']<$resultats[$i+1]['valeur']){
					$permut = true;
					$int = $resultats[$i];
					$resultats[$i]=$resultats[$i+1];
					$resultats[$i+1] = $int;
				}
			}
		}
		
		for($i=0;$i<$nbResultats;$i++){
			$resultats[$i]['classement']=$i+1;
			if(!array_key_exists ('nom',$resultats[$i])){
				$resultats[$i]['nom']="";
			}
			if(!array_key_exists ('prenom',$resultats[$i])){
				$resultats[$i]['prenom']="";
			}
		}
		
        $view = new UserView($this,'classementQuestionnaires',array('user'=>$this->currentUser, 'resultats'=>$resultats));
        $view->render();
    }
	
    
    public function voirQuestionnairesInvite($request){
		$currentUser = User::getById($_SESSION['id']);
		$userEmail=$currentUser->getEmail($_SESSION['id']);
		echo ' cc: '.$userEmail.' :cc ';
		if( $userEmail==""){
			$view = new UserView($this,'ajoutEmail',array('user'=>$this->currentUser));
			$view->render();
		}
		else{
			$questionnaires = User::getQuestionnaireAFaireInvite($currentUser->getId(),$userEmail);
			$view = new UserView($this,'choixQuestionnaires',array('user'=>$this->currentUser,'questionnaires'=>$questionnaires));
			$view->render();
		}
    }
	
	public function ajoutEmail($request){
		$currentUser = User::getById($_SESSION['id']);
		$userEmail = $_POST['mail'];
		echo $userEmail;
		User::modify('MAIL',$userEmail,$_SESSION['id']);
		$questionnaires = User::getQuestionnaireAFaireInvite($currentUser->getId(),$userEmail);
		$view = new UserView($this,'choixQuestionnaires',array('user'=>$this->currentUser,'questionnaires'=>$questionnaires));
		$view->render();
	}
	
	
}
?>