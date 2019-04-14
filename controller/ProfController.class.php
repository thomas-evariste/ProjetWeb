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
        $idQuestionnaire=$request->read('idQuestionnaire');
        $bareme=$request->read('bareme_question');
        print_r($_POST);
        if ($type=="QO"){
            echo "ON EST UN TYPE QO !";
            $idQuestion = Question::createId();
            Question::create($idQuestion,$type,$intitule);
            Questionnaire::ajouterQuestion($idQuestion,$idQuestionnaire,$bareme);
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
        $etat = $request->read('etat');
        $connexionRequise = $request->read('connexionRequise');
        if ($dateOuverture==''){
            $dateOuverture=NULL;
        }
        if ($dateFermeture==''){
            $dateFermeture=NULL;
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
            $view = new View($this,'questionnairevalide',array('user'=>$this->currentUser));
            $view->render();
        }
    }
    
    public function voirQuestionnaires($request){
        $questionnaires = Prof::getQuestionnaire($this->currentUser->getId());
        $view = new ProfView($this,'visuquestionnaires',array('user'=>$this->currentUser,'questionnaires'=>$questionnaires));
        $view->render();
    }

    public function modifierQuestionnaire($request){
        $idQuest = $request->read('questionnaireId');
        $questions = Prof::getQuestions($idQuest);
        $view = new View($this,'modifQuestionnaire',array('user'=>$this->currentUser,'questionnaireId'=>$idQuest,'questions'=>$questions));
        $view->render();
    }
}
?> 