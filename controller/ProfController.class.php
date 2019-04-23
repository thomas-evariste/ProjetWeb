<?php 

class ProfController extends UserController{
    
    protected $currentUser;

    public function __construct($request) {
        parent::__construct($request);
        $this->currentUser = Prof::getById($_SESSION['id']);
    }

    
    public function defaultAction($request) { 
        $view = new ProfView($this, 'connected',array('user' =>$this->currentUser)); 
        $view->render(); 
    }

    public function home($request){
        $view = new ProfView($this, 'home',array('user' =>$this->currentUser)); 
        $view->render(); 
    }

    public function profil($request){
        $view = new ProfView($this, 'profilprof',array('user' =>$this->currentUser)); 
        $view->render(); 
    }

    public function deconnexion($request){
        $_SESSION = array();
        header("location: index.php?action=home");
    }

    public function validateConnexion($request){
        $view = new ProfView($this,'connected',array('user'=>$this->currentUser));
        $view->render();
    }

    public function modifier($request){
        $view = new ProfView($this,'modifyprof',array('user'=>$this->currentUser));
        $view->render();
    }

    public function validateModification($request){
        $password = $request->read('password');
        $passwordConf = $request->read('passwordConf'); 
        $interne = $request->read('interne');
        $description = $request->read('description'); 
        $mail = $request->read('mail');
        $nom = $request->read('nom'); 
        $prenom = $request->read('prenom');

        if ($password==$passwordConf && $password!=''){
            Prof::modify('PASSWORD',$password,$this->currentUser->getId());
        }

        if ($interne=='yes'){
            Prof::modify('INTERNE',1,$this->currentUser->getId());
        }

        if ($description!=''){
            Prof::modify('DESCRIPTION',$description,$this->currentUser->getId());
        }

        if ($mail!=''){
            Prof::modify('MAIL',$mail,$this->currentUser->getId());
        }

        if ($prenom!=''){
            Prof::modify('PRENOM',$prenom,$this->currentUser->getId());
        }

        if ($nom!=''){
            Prof::modify('NOM',$nom,$this->currentUser->getId());
        }

        $currentUser = Prof::getById($_SESSION['id']); 
        header("location: index.php?action=profil&controller=prof");
    }


    public function creerQuestion($request){
        $view = new ProfView($this,'creerquestion',array('user'=>$this->currentUser));
        $view->render();
    }

    public function insertionQuestion($request){
        $intitule=$request->read('intitule_question');
        $type=$request->read('type_question');
/*        if ($type!="QCM" && $type!="QCU" && $type!="QO"){
            echo "Type invalide lors de l'insertion";
        }
        else if(strlen($intitule)>100){
            echo "Intitule trop long";
        }
        else if($intitule==''){
            echo "Intitule vide";
        }
        else{
            $idQuestion= Question::createId();
            Question::create($idQuestion,$type,$intitule);
        }*/
        $nbReponses = $request->read('nbRep');
        $nbTag = $request->read('nbTag');
        $idQuestionnaire=$request->read('idQuestionnaire');
        $bareme=$request->read('bareme_question');
        print_r($_POST);
        if ($type=="QO"){
            echo "ON EST UN TYPE QO !";
            $idQuestion = Question::createId();
            Question::create($idQuestion,$type,$intitule);
            Questionnaire::ajouterQuestion($idQuestion,$idQuestionnaire,$bareme);
            for ($i=0;$i<$nbTag;$i++){
                $tag = $request->read('tag'.$i);
                if(!(Tag::tagExists($tag))){
                    Tag::create($tag,'red');
                }
                Tag::linkTagToQuestion($tag,$idQuestion);
            }
        }
        else{
            echo "ON EST UN TYPE QCM OU QCU !";
            $idQuestion = Question::createId();
            Question::create($idQuestion,$type,$intitule);

            Questionnaire::ajouterQuestion($idQuestion,$idQuestionnaire,$bareme);
            for ($i=0;$i<$nbReponses;$i++){
                $idRep=Reponse::createId();
                $rep = $request->read('rep'.$i);
                $repCorrecte = $request->read('repCorrecte'.$i);
                Reponse::create($idRep,NULL,NULL,NULL,$rep,$repCorrecte);
                Reponse::ajouterReponse($idRep,$idQuestion);
            }
            for ($i=0;$i<$nbTag;$i++){
                $tag = $request->read('tag'.$i);
                if(!(Tag::tagExists($tag))){
                    Tag::create($tag,'red');
                }
                Tag::linkTagToQuestion($tag,$idQuestion);
            }

            /*
            echo ($type);
            echo ($bareme);
            echo ($nbReponses);
            echo("reponse:");
            print_r($reponse);
            echo("valeurReponse:");
            print_r($valeurReponse);*/



        }
    }

    public function creerQuestionnaire($request){
        $view = new ProfView($this,'creerquestionnaire',array('user'=>$this->currentUser));
        $view->render();
    }

	public function generateCreationQuestionnaireError($text){
		$view = new View($this,'creerquestionnaire',array('user'=>$this->currentUser));
		$view->setArg('inscErrorText',$text);
		$view->render();
	}


    public function validateCreationQuestionnaire($request){
        $titre = $request->read('titre');
        $description = $request->read('description');
        $dateOuverture = $request->read('dateOuverture');
        $dateFermeture = $request->read('dateFermeture');
        $bonus = $request->read('bonus');
        $malus = $request->read('malus');
        $etat = $request->read('etat');
        $connexionRequise = $request->read('connexionRequise');
        if ($dateOuverture==''){
            $dateOuverture=NULL;
        }
        if ($dateFermeture==''){
            $dateFermeture=NULL;
        }
        if ($bonus==''){
            $bonus=1;
        }
        if ($malus==''){
            $malus=0;
        }

        if (trim($titre)=='' || strlen($titre)>50){
            ProfController::generateCreationQuestionnaireError('Merci d\'insérer un titre inférieur à 50 caractères');
        }
        else if (strlen($description)>200){
            ProfController::generateCreationQuestionnaireError('Votre description doit être inférieure à 200 caractères');
        }
        else{
            $idQuestionnaire = Questionnaire::createId();
            Questionnaire::create($idQuestionnaire,$titre,$description,$dateOuverture,$dateFermeture,$connexionRequise,$etat,NULL,$this->currentUser->getId());
			Regle::setRegle($idQuestionnaire,$bonus,$malus);
            $view = new View($this,'questionnairevalide',array('user'=>$this->currentUser));
            $view->render();
        }
    }
    
    public function voirMesQuestionnaires($request){
        $questionnaires = Prof::getQuestionnaire($this->currentUser->getId());
        $view = new ProfView($this,'visuquestionnaires',array('user'=>$this->currentUser,'questionnaires'=>$questionnaires));
        $view->render();
    }
/*
    public function modifierQuestionnaire($request){
        $idQuest = $request->read('questionnaireId');
        $questions = Prof::getQuestions($idQuest);
        $reponses = Array();
        foreach ($questions as $question){
            array_push($reponses,Question::getReponses($question['id']));
        }
        $view = new View($this,'modifQuestionnaire',array('user'=>$this->currentUser,'questionnaireId'=>$idQuest,'questions'=>$questions,'reponses'=>$reponses));
        $view->render();
    }
*/
    public function modifierQuestionnaire($request){
        $idQuest = $request->read('questionnaireId');
        $questionnaire = Questionnaire::getById($idQuest);
        $view = new View($this,'modifQuestionnaire',array('user'=>$this->currentUser,'questionnaire'=>$questionnaire));
        $view->render();
    }

    public function corrigerQuestionnaire($request){
        $idQuest = $request->read('questionnaireId');
        $questions = Prof::getQuestionsOuvertes($idQuest);
        $reponses = Array();
        foreach ($questions as $question){
            array_push($reponses,Question::getReponsesQO($question['id']));
        }
        $view = new View($this, 'correctionQuestionnaire',array('user'=>$this->currentUser,'questionnaireId'=>$idQuest,'questions'=>$questions,'reponses'=>$reponses));
        $view->render();
    }

    public function corrigerQuestion($request){
        $idReponse=$request->read('idReponse');
        $idUser=$request->read('idUser');
        $answerValue=$request->read('answerValue');
        Question::corriger($idReponse,$idUser,$answerValue);
    }

    public function suppressionQuestion($request){
        $idQuestion= $request->read('idQuestion');
        Question::supprimer($idQuestion);
    }

    public function suppressionReponse($request){
        $idReponse = $request->read('idReponse');
        Reponse::supprimerReponse($idReponse);
    }

    public function modifierQuestion($request){
        $idQuestion = $request->read('idQuestion');
        $intituleQuestion = $request->read('intituleQuestion');
        Question::modify("INTITULE_QUESTION", $intituleQuestion,$idQuestion);
    }

    public function modifierReponse($request){
        $idReponse=$request->read('idReponse');
        $intituleReponse=$request->read('intituleReponse');
        Reponse::modify("INTITULE_PROPOSITION",$intituleReponse,$idReponse);
    }
	
	
    public function voirQuestionnaires($request){
		$currentUser = Prof::getById($_SESSION['id']);
        $questionnaires = Prof::getQuestionnaireAFaire($currentUser->getId());
        $view = new UserView($this,'choixQuestionnairesProf',array('user'=>$this->currentUser,'questionnaires'=>$questionnaires));
        $view->render();
    }
	
	public function repondreQuiz($request){
		$currentUser = Prof::getById($_SESSION['id']);
        $idQuest = $request->read('questionnaireId');
		
		$questionnaire = $currentUser->getQuestionnaireById($idQuest);
		

		$questions = $questionnaire->getQuestionsInData($questionnaire->getId()); 
		$nbQuestion = sizeof($questions);
		
		//echo $nbQuestion;
		
		$view = new UserView($this, 'quizReponseInteractifDebutProf',array('user' =>$this->currentUser)); 
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
		$currentUser = Prof::getById($_SESSION['id']);
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
		
		$currentUser = Prof::getById($_SESSION['id']);
		$id_questionnaire = $questionnaire->getId();
		
		$note=0;
		$bonus=0;
		$malus=0;
		
		$regle = $currentUser->getRegle($id_questionnaire);
		
		print_r($args);
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
	
    public function voirResultatQuestionnaires($request){
		$currentUser = Prof::getById($_SESSION['id']);
        $questionnaires = Prof::getQuestionnaireFait($currentUser->getId());
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
				if($resultats[$i]['valeur']>$resultats[$i+1]['valeur']){
					$permut = true;
					$int = resultats[$i]['valeur'];
					$resultats[$i]['valeur']=$resultats[$i+1]['valeur'];
					$resultats[$i+1]['valeur'] = $int;
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
	
	public function envoiEmail($request){
		$to=$_POST['email'];
		$from='quiz.imt.lille.douai@gmail.com';
		$idQuestionnaire = $_POST['idQestionnaire'];
		$currentUser = Prof::getById($_SESSION['id']);
		$Questionnaire = Questionnaire::getById($idQuestionnaire);
		$prenomProf = $currentUser->getprenom();
		$nomProf = $currentUser->getNom();
		$titreQuestionnaire = $Questionnaire->getTitre();
		Prof::setEstInvite($to,$idQuestionnaire);
		
		$sujet = 'Invitation a un quiz';
		$message = $prenomProf.' '.$nomProf.' vous invite a vous connecter au site de quiz pour repondre au quiz: '.$titreQuestionnaire. ' click : http://localhost/ProjetWeb/index.php?action=loginToInvitation' ;
		$mdp = 'imtLilleDouai';
		
		
		Prof::smtpmailer($to,$sujet,$message,$from,$mdp);
		
		
		$view = new UserView($this, 'home',array('user' =>$this->currentUser)); 
		$view->render(); 
	}
	
	public function inviterQuiz($request){
		$idQestionnaire = $_POST['questionnaireId'];
		
		
		$view = new UserView($this, 'inviter',array('user' =>$this->currentUser , 'idQestionnaire' => $idQestionnaire)); 
		$view->render(); 
	}
    
    public function voirQuestionnairesInvite($request){
		$currentUser = Prof::getById($_SESSION['id']);
		$userEmail=$currentUser->getMail();
		echo ' cc: '.$userEmail.' :cc ';
		if( $userEmail==""){
			$view = new UserView($this,'ajoutEmailProf',array('user'=>$this->currentUser));
			$view->render();
		}
		else{
			$questionnaires = Prof::getQuestionnaireAFaireInvite($currentUser->getId(),$userEmail);
			$view = new UserView($this,'choixQuestionnaires',array('user'=>$this->currentUser,'questionnaires'=>$questionnaires));
			$view->render();
		}
    }
	
	public function ajoutEmail($request){
		$currentUser = Prof::getById($_SESSION['id']);
		$userEmail = $_POST['mail'];
		echo $userEmail;
		Prof::modify('MAIL',$userEmail,$_SESSION['id']);
		$questionnaires = Prof::getQuestionnaireAFaireInvite($currentUser->getId(),$userEmail);
		$view = new UserView($this,'choixQuestionnaires',array('user'=>$this->currentUser,'questionnaires'=>$questionnaires));
		$view->render();
	}
	
	public function voirInviterQuiz($request){
		$idQestionnaire = $_POST['questionnaireId'];
		
		$emailInvite=Prof::getEmailInvite($idQestionnaire);
		$invites=array();
		foreach($emailInvite as $email){
			$invites[]=Prof::getInviteByEmail($email);
		}
		
		$view = new UserView($this,'listeInvite',array('user'=>$this->currentUser,'invites'=>$invites));
		$view->render();
	}

} 
	

?> 