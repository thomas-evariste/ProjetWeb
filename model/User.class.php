<?php 

class User extends Model{

    protected static $table_name='PARTICIPANT';
    protected $id; //OBLIGATOIRE
    protected $login;  //OBLIGATOIRE
    protected $password; //OBLIGATOIRE
    protected $promotion;
    protected $majeure;
    protected $nom;
    protected $prenom;
    protected $mail;

/*    public static function __construct(){



    }
*/


    public static function createId(){
        $sth = parent::query("SELECT MAX(ID_USER) as nb FROM PARTICIPANT");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $sth2 = parent::query("SELECT MAX(ID_USER) as nb FROM ENSEIGNANT");
        $data2 = $sth2->fetch(PDO::FETCH_OBJ);
        $max = max($data->nb,$data2->nb);
        return $max+1;
    }

    public static function isLoginUsed($login){
        
        $sth = parent::query("SELECT LOGIN FROM PARTICIPANT WHERE LOGIN='$login'");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $sth2 = parent::query("SELECT LOGIN FROM ENSEIGNANT WHERE LOGIN='$login'");
        $data2 = $sth->fetch(PDO::FETCH_OBJ);
        if(!empty($data) || !empty($data2)){
            return true;
        }
        return false;
    }

    public static function getList(){
        parent::query("SELECT * FROM PARTICIPANT");
    }

    public static function create($id,$login,$password,$promotion,$majeure,$nom,$prenom,$mail){
/*
        $sth = parent::exec("INSERT INTO USER VALUES(:login,:password,:mail,:nom,:prenom)", 
            array(':login'=>$login,
            ':mail'=>$mail,
            ':role'=>1,
            ':password'=>$password,
            ':nom'=>$nom,
            ':prenom'=>$prenom));
*/      

/*
        $sth = parent::exec("INSERT INTO USER VALUES(:login,:password,:mail,:nom,:prenom)", 
            array(':login'=>$login,
            ':mail'=>$mail,
            ':role'=>1,
            ':password'=>$password,
            ':nom'=>$nom,
            ':prenom'=>$prenom));
*/ 
        $sth = parent::prepare("INSERT INTO PARTICIPANT VALUES(:id,:login,:password,:promotion,:majeure,:nom,:prenom,:mail)");
        $sth->bindParam(':id',$id);
        $sth->bindParam(':login',$login);  
        $sth->bindParam(':password',$password);
        $sth->bindParam(':promotion',$promotion);
        $sth->bindParam(':majeure',$majeure);
        $sth->bindParam(':nom',$nom);
        $sth->bindParam(':prenom',$prenom);
        $sth->bindParam(':mail',$mail);
        $sth->execute();
        //return new User($id,$login,$password,$promotion,$majeure,$nom,$prenom,$mail);
    }

    public static function addSqlQuery($name,$sqlRequest){
        
    }

    public static function tryLogin($login, $password){
        $sql = "SELECT * FROM PARTICIPANT WHERE LOGIN = '$login' AND PASSWORD = '$password'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        if (!empty($data)){
            $user = new User($data->ID_USER,$data->LOGIN,$data->PASSWORD,$data->PROMOTION,$data->MAJEURE,$data->NOM,$data->PRENOM,$data->MAIL);
            return $user;
        }
        else{
            return null;
        }
    }

    public static function modify($column, $data,$id){
        $sql = "UPDATE PARTICIPANT SET $column = '$data' WHERE ID_USER='$id'";
        $sth = parent::query($sql);
    }
    
    public function __construct($id,$login,$password,$promotion,$majeure,$nom,$prenom,$mail){
        $this->id = $id;  
        $this->login = $login;
        $this->password = $password;
        $this->mail = $mail;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->majeure = $majeure;
        $this->promotion = $promotion;
    }

    public function getLogin(){
        return $this->login;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getMail(){
        return $this->mail;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }

    public function getId(){
        return $this->id;
    }

    public function getMajeure(){
        return $this->majeure;
    }

    public function getPromotion(){
        return $this->promotion;
    }
/*
    public static function logLenght($login){
        return strlen($login)<=25;
    }
  */  /*
    public static function getByLogin($login) {
        $sql = "SELECT * FROM USER WHERE USER_LOGIN = '$login'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        if (!empty($data)){
            $user = new User($data->USER_LOGIN,$data->USER_PASSWORD,$data->USER_MAIL,$data->USER_NOM,$data->USER_PRENOM);
            return $user;
        }
        else{
            return null;
        }
    }
    */

    public static function getById($id){
        $sql = "SELECT * FROM PARTICIPANT WHERE ID_USER = '$id'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        $sql2 = "SELECT * FROM ENSEIGNANT WHERE ID_USER = '$id'";
        $sth2 = parent::query($sql2);
        $data2 = $sth2->fetch(PDO::FETCH_OBJ);

        if (!empty($data)){
            $user = new User($data->ID_USER,$data->LOGIN,$data->PASSWORD,$data->PROMOTION,$data->MAJEURE,$data->NOM,$data->PRENOM,$data->MAIL);
            return $user;
        }
        if (!empty($data2)){
            $prof = new Prof($data2->ID_USER,$data2->LOGIN,$data2->PASSWORD,$data2->INTERNE,$data2->DESCRIPTION,$data2->NOM,$data2->PRENOM,$data2->MAIL);
            return $prof;
        }
        else{
            return null;
        }
    }


    public static function getIdByLogin($login){
        $sql = "SELECT ID_USER FROM PARTICIPANT WHERE LOGIN = '$login'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        echo "data :".$data->ID_USER;
        return $data->ID_USER;
    }




    public static function getByLogin($login){
        $sql = "SELECT * FROM PARTICIPANT WHERE LOGIN = '$login'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        if (!empty($data)){
            $user = new User($data->ID_USER,$data->LOGIN,$data->PASSWORD,$data->PROMOTION,$data->MAJEURE,$data->NOM,$data->PRENOM,$data->MAIL);
            return $user;
        }
        else{
            return null;
        }
    }
	
	
    public static function getQuestionnaireAFaire($idUser){
		date_default_timezone_set('Europe/Paris');
		
        $sql = "SELECT * FROM QUESTIONNAIRE WHERE (ETAT = 'Public') AND (ID_QUESTIONNAIRE NOT IN (SELECT ID_QUESTIONNAIRE FROM NOTE WHERE ID_USER = '$idUser')) ";
        $sth = static::query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $questionnaires = array();
        while(!empty($data)){
			$add=true;
			if(!is_null($data->DATE_OUVERTURE)){
				$dateString=substr($data->DATE_OUVERTURE,-2,2).'-'.substr($data->DATE_OUVERTURE,5,2).'-'.substr($data->DATE_OUVERTURE,2,2);
				if(strtotime($dateString) > strtotime(date("d-m-y"))){
					$add=false;
				}
			}
			if(!is_null($data->DATE_FERMETURE)){
				$dateString=substr($data->DATE_FERMETURE,-2,2).'-'.substr($data->DATE_FERMETURE,5,2).'-'.substr($data->DATE_FERMETURE,2,2);
				if(strtotime($dateString) < strtotime(date("d-m-y"))){
					$add=false;
				}
			}
			if($add){
				array_push($questionnaires,Array(
                    'id'=>$data->ID_QUESTIONNAIRE,
                    'titre'=>$data->TITRE,
                    'description'=>$data->DESCRIPTION_QUESTIONNAIRE,
                    'dateOuverture'=>$data->DATE_OUVERTURE,
                    'dateFermeture'=>$data->DATE_FERMETURE,
                    'connexionRequise'=>$data->CONNEXION_REQUISE,
                    'etat'=>$data->ETAT,
                    'url'=>$data->URL,
                    'createur'=>$data->ID_CREATEUR
                )
				);
			}
            $data = $sth->fetch(PDO::FETCH_OBJ);
        }
        return $questionnaires;
    }
	
	
    public static function getQuestionnaireById($id){
        $sql = "SELECT * FROM QUESTIONNAIRE WHERE ID_QUESTIONNAIRE = '$id'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);

        if (!empty($data)){
            $questionnaire = new Questionnaire($data->ID_QUESTIONNAIRE,$data->TITRE,$data->DESCRIPTION_QUESTIONNAIRE,
                                          $data->DATE_OUVERTURE,$data->DATE_FERMETURE,$data->CONNEXION_REQUISE,$data->ETAT,$data->URL,$data->ID_CREATEUR);
            return $questionnaire;
        }
        else{
            return null;
        }
    }
	
	public static function tenterQCM_QCU($id_user,$args = array()){
		foreach ($args as $tentative) {
			$zero =0;
			$sth = parent::prepare("INSERT INTO TENTER VALUES(:id_user,:id_proposition,:a_corriger,:juste)");
			$sth->bindParam(':id_user',$id_user);
			$sth->bindParam(':id_proposition',$tentative);
			$sth->bindParam(':a_corriger',$zero);  
			
			
			$sql2 = "SELECT REPONSE_CORRECTE FROM REPONSE_DISPONIBLE WHERE ID_PROPOSITION = '$tentative'";
			$sth2 = parent::query($sql2);
			$data2= $sth2->fetch(PDO::FETCH_OBJ);
			
			$sth->bindParam(':juste',$data2->REPONSE_CORRECTE);  
			$sth->execute();
			
		}
	}
	
	public static function tenterQO($id_user,$args = array()){
		$argsRep = array();
		foreach ($args as $key => $tentative) {
			$zero =0;
			$null = null;
			$id_reponse = REPONSE::createId();
			$sth = parent::prepare("INSERT INTO REPONSE_DISPONIBLE VALUES(:id_reponse,:rep_id_reponse,:rep_id_reponse2,:id_user,:intitule_reponse,:reponse_correcte)");
			$sth->bindParam(':id_reponse',$id_reponse);
			$sth->bindParam(':rep_id_reponse',$null);
			$sth->bindParam(':rep_id_reponse2',$null);
			$sth->bindParam(':id_user',$id_user);
			$sth->bindParam(':intitule_reponse',$tentative);
			$sth->bindParam(':reponse_correcte',$zero);
			$sth->execute();
			$argsRep[$key]=$id_reponse;
		}
		foreach ($argsRep as $id_question => $id_reponse) {
			$sth = parent::prepare("INSERT INTO DISPOSER VALUES(:id_question,:id_reponse)");
			$sth->bindParam(':id_question',$id_question);
			$sth->bindParam(':id_reponse',$id_reponse);
			$sth->execute();
		}
		foreach ($argsRep as $id_reponse) {
			$zero =0;
			$un =1;
			$sth = parent::prepare("INSERT INTO TENTER VALUES(:id_user,:id_proposition,:a_corriger,:juste)");
			$sth->bindParam(':id_user',$id_user);
			$sth->bindParam(':id_proposition',$id_reponse);
			$sth->bindParam(':a_corriger',$un);  
			$sth->bindParam(':juste',$zero);  
			$sth->execute();
			
		}
	}
	
	public static function getQuestionnaireByReponse($id_reponse){
        $sql = "SELECT * FROM QUESTIONNAIRE WHERE ID_QUESTIONNAIRE = (SELECT ID_QUESTIONNAIRE FROM CONTENIR WHERE ID_QUESTION in (SELECT ID_QUESTION FROM DISPOSER WHERE ID_PROPOSITION = '$id_reponse') )";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);

        if (!empty($data)){
            $questionnaire = new Questionnaire($data->ID_QUESTIONNAIRE,$data->TITRE,$data->DESCRIPTION_QUESTIONNAIRE,
                                          $data->DATE_OUVERTURE,$data->DATE_FERMETURE,$data->CONNEXION_REQUISE,$data->ETAT,$data->URL,$data->ID_CREATEUR);
            return $questionnaire;
        }
        else{
            return null;
        }		
	}
	
	public static function getRegle($id_questionnaire){
        $sql = "SELECT * FROM REGLE WHERE ID_REGLE in (SELECT ID_REGLE FROM SPECIFIER WHERE ID_QUESTIONNAIRE = '$id_questionnaire' )";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        if (!empty($data)){
			return $data;
		}
		else{
			$sql = "SELECT * FROM REGLE WHERE ID_REGLE = 1";
			$sth = parent::query($sql);
			$data= $sth->fetch(PDO::FETCH_OBJ);
			return $data;
		}
	}
	
	public static function verifiReponseQCU($tentative){
        $sql = "SELECT REPONSE_CORRECTE FROM REPONSE_DISPONIBLE WHERE ID_PROPOSITION = '$tentative' ";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        if (!empty($data)){
			return $data->REPONSE_CORRECTE;
		}
		else{
			return 0 ;
		}
	}
	
	public static function verifiReponseQCM($argsTentative){
		$id_reponse = $argsTentative[0];
		
		$sql0 = "SELECT ID_QUESTION FROM DISPOSER WHERE ID_PROPOSITION = '$id_reponse'";
        $sth0 = parent::query($sql0);
        $data0= $sth0->fetch(PDO::FETCH_OBJ);
		$id_question = $data0->ID_QUESTION;
		
        $sql = "SELECT ID_PROPOSITION FROM REPONSE_DISPONIBLE WHERE (REPONSE_CORRECTE = 1) AND (ID_PROPOSITION IN (SELECT ID_PROPOSITION FROM DISPOSER WHERE ID_QUESTION = '$id_question')) ";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
		$bonneReponce=array();
        while (!empty($data)){
			$bonneReponce[] = $data->ID_PROPOSITION;
			$data= $sth->fetch(PDO::FETCH_OBJ);
		}
		foreach($argsTentative as $tentative){
			if(!in_array($tentative,$bonneReponce)){
				print_r($bonneReponce);
				echo '<br> $tentative : '. $tentative . '<br>';
				return 0;
			}
		}
		$nbBonneReponse = floatval(count($bonneReponce));
		$nbTentative = floatval(count($argsTentative));
		return $nbTentative/$nbBonneReponse;
	}
	
	public static function attribuNote($id_user,$id_questionnaire,$note){
		$sth = parent::prepare("INSERT INTO NOTE VALUES(:id_user,:ens_id_user,:id_note,:id_questionnaire,:valeur)");
		$sth->bindParam(':id_user',$id_user);
		$id_note=Note::createId();
		$sth->bindParam(':id_note',$id_note);
		$sth->bindParam(':id_questionnaire',$id_questionnaire);
		$sth->bindParam(':valeur',$note); 
			
		$sql2 = "SELECT ID_CREATEUR FROM QUESTIONNAIRE WHERE ID_QUESTIONNAIRE = '$id_questionnaire'";
		$sth2 = parent::query($sql2);
		$data2= $sth2->fetch(PDO::FETCH_OBJ);
		$sth->bindParam(':ens_id_user',$data2->ID_CREATEUR);  
			
		$sth->execute();
	}
	
	public static function getQuestionnaireFait($idUser){
        $sql = "SELECT * FROM QUESTIONNAIRE WHERE (ID_QUESTIONNAIRE IN (SELECT ID_QUESTIONNAIRE FROM NOTE WHERE ID_USER = '$idUser')) ";
        $sth = static::query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $questionnaires = array();
        while(!empty($data)){		
			$sql2 = "SELECT VALEUR FROM NOTE WHERE (ID_QUESTIONNAIRE ='$data->ID_QUESTIONNAIRE') AND (ID_USER = '$idUser') ";
			$sth2 = static::query($sql2);
			$data2 = $sth2->fetch(PDO::FETCH_OBJ);
			
            array_push($questionnaires,Array(
                    'id'=>$data->ID_QUESTIONNAIRE,
                    'titre'=>$data->TITRE,
                    'description'=>$data->DESCRIPTION_QUESTIONNAIRE,
                    'etat'=>$data->ETAT,
                    'createur'=>$data->ID_CREATEUR,
                    'note'=>$data2->VALEUR
                )
            );
            $data = $sth->fetch(PDO::FETCH_OBJ);
        }
        return $questionnaires;
    }
	
	
    public static function getQuestionnaireAFaireInvite($idUser,$emailUser){
		date_default_timezone_set('Europe/Paris');
		
        $sql = "SELECT * FROM QUESTIONNAIRE WHERE (ETAT = 'Prive') AND (ID_QUESTIONNAIRE NOT IN (SELECT ID_QUESTIONNAIRE FROM NOTE WHERE ID_USER = '$idUser')) 
		AND (ID_QUESTIONNAIRE in (SELECT ID_QUESTIONNAIRE FROM EST_INVITE WHERE EMAIL = '$emailUser')) ";
        $sth = static::query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $questionnaires = array();
        while(!empty($data)){
			$add=true;
			if(!is_null($data->DATE_OUVERTURE)){
				$dateString=substr($data->DATE_OUVERTURE,-2,2).'-'.substr($data->DATE_OUVERTURE,5,2).'-'.substr($data->DATE_OUVERTURE,2,2);
				if(strtotime($dateString) > strtotime(date("d-m-y"))){
					$add=false;
				}
			}
			if(!is_null($data->DATE_FERMETURE)){
				$dateString=substr($data->DATE_FERMETURE,-2,2).'-'.substr($data->DATE_FERMETURE,5,2).'-'.substr($data->DATE_FERMETURE,2,2);
				if(strtotime($dateString) < strtotime(date("d-m-y"))){
					$add=false;
				}
			}
			if($add){
				array_push($questionnaires,Array(
                    'id'=>$data->ID_QUESTIONNAIRE,
                    'titre'=>$data->TITRE,
                    'description'=>$data->DESCRIPTION_QUESTIONNAIRE,
                    'dateOuverture'=>$data->DATE_OUVERTURE,
                    'dateFermeture'=>$data->DATE_FERMETURE,
                    'connexionRequise'=>$data->CONNEXION_REQUISE,
                    'etat'=>$data->ETAT,
                    'url'=>$data->URL,
                    'createur'=>$data->ID_CREATEUR
                )
				);
			}
            $data = $sth->fetch(PDO::FETCH_OBJ);
        }
        return $questionnaires;
    }
}

?> 