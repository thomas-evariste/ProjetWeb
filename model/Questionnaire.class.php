<?php 

class Questionnaire extends Model{

    protected static $table_name='QUESTIONNAIRE';
    protected $id; //OBLIGATOIRE
    protected $titre; //OBLIGATOIRE
    protected $description;  //OBLIGATOIRE
    protected $date_ouverture;
    protected $date_fermeture;
    protected $connexion_requise;
    protected $etat;
    protected $url;
    protected $createur;
    protected $questions=Array();

    public static function createId(){
        $sth = parent::query("SELECT COUNT(ID_QUESTIONNAIRE) as nb FROM QUESTIONNAIRE");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $compte = $data->nb;
        if ($compte>0){
            $sth = parent::query("SELECT MAX(ID_QUESTIONNAIRE) as nb FROM QUESTIONNAIRE");
            $data = $sth->fetch(PDO::FETCH_OBJ);
            $max = $data->nb;
            return $max+1;
        }
        else{
            return 1;
        }
    }


    public static function getList(){
        parent::query("SELECT * FROM QUESTIONNAIRE");
    }

    public static function create($id,$titre,$description,$date_ouverture,$date_fermeture,$connexion_requise,$etat,$url,$createur){
        $sth = parent::prepare("INSERT INTO QUESTIONNAIRE VALUES(:id,:titre,:description,:date_ouverture,:date_fermeture,:connexion_requise,:etat,:url,:createur)");
        $sth->bindParam(':id',$id);
        $sth->bindParam(':titre',$titre);  
        $sth->bindParam(':description',$description);
        $sth->bindParam(':date_ouverture',$date_ouverture);
        $sth->bindParam(':date_fermeture',$date_fermeture);
        $sth->bindParam(':connexion_requise',$connexion_requise);
        $sth->bindParam(':etat',$etat);
        $sth->bindParam(':url',$url);
        $sth->bindParam(':createur',$createur);
        $sth->execute();
        //return new User($id,$login,$password,$promotion,$majeure,$nom,$prenom,$mail);
    }

    public static function addSqlQuery($name,$sqlRequest){
        
    }

    public static function modify($column, $data,$id){
        $sql = "UPDATE QUESTIONNAIRE SET $column = '$data' WHERE ID_QUESTIONNAIRE='$id'";
        $sth = parent::query($sql);
    }

    public function __construct($id,$titre,$description,$date_ouverture,$date_fermeture,$connexion_requise,$etat,$url,$createur){
        $this->id = $id;  
        $this->titre = $titre;
        $this->description = $description;
        $this->date_ouverture = $date_ouverture;
        $this->date_fermeture = $date_fermeture;
        $this->connexion_requise = $connexion_requise;
        $this->etat = $etat;
        $this->url = $url;
        $this->createur=$createur;
        $this->questions=Questionnaire::obtainQuestions($id);
    }

    public function getTitre(){
        return $this->titre;
    }
    public function getDescription(){
        return $this->description;
    }

    public function getId(){
        return $this->id;
    }

    public function getDate_Ouverture(){
        return $this->date_ouverture;
    }
    public function getDate_Fermeture(){
        return $this->date_fermeture;
    }

    public function getConnexion_Requise(){
        return $this->connexion_requise;
    }

    public function getEtat(){
        return $this->etat;
    }

    public function getUrl(){
        return $this->url;
    }

    public function getCreateur(){
        return $this->createur;
    }

    public function getQuestions(){
        return $this->questions;
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

/* --- > TRANSFORMER EN GET INTITULE BY ID ?

    public static function getIdByLogin($login){
        $sql = "SELECT ID_USER FROM PARTICIPANT WHERE LOGIN = '$login'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        echo "data :".$data->ID_USER;
        return $data->ID_USER;
    }

    */


/*
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
    }*/
    
    public static function ajouterQuestion($idQuestion,$idQuestionnaire,$bareme){
        $sth = parent::prepare("INSERT INTO CONTENIR VALUES(:idQuestion,:idQuestionnaire,:bareme)");
        $sth->bindParam(':idQuestion',$idQuestion);
        $sth->bindParam(':idQuestionnaire',$idQuestionnaire);
        $sth->bindParam(':bareme',$bareme);
        $sth->execute();
    }
	
	public static function obtainQuestions($idQuestionnaire){
        $sql = "SELECT * FROM QUESTION WHERE ID_QUESTION IN (SELECT ID_QUESTION FROM CONTENIR WHERE ID_QUESTIONNAIRE = '$idQuestionnaire' )";
        $sth = parent::query($sql);
        $data= $sth->fetchAll(PDO::FETCH_CLASS,'Question');
        foreach($data as $question){
            $question->setReponses(Question::obtainReponses($question->getId()));
        }
        /*while(!empty($data)){
            array_push($questions,Array(
                    'id'=>$data->ID_QUESTION,
                    'type'=>$data->TYPE,
                    'intitule'=>$data->INTITULE_QUESTION,
                )
            );
            $data = $sth->fetch(PDO::FETCH_OBJ);
        }*/
		return $data;
    }
	
	public static function getQuestionsInData($idQuestionnaire){
        $sql = "SELECT * FROM QUESTION WHERE ID_QUESTION IN (SELECT ID_QUESTION FROM CONTENIR WHERE ID_QUESTIONNAIRE = '$idQuestionnaire' )";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
		$questions = array();
        while(!empty($data)){
            array_push($questions,Array(
                    'id'=>$data->ID_QUESTION,
                    'type'=>$data->TYPE,
                    'intitule'=>$data->INTITULE_QUESTION,
                )
            );
            $data = $sth->fetch(PDO::FETCH_OBJ);
        }
		return $questions;
        
    }
    
    public static function getQuestionsOuvertes($idQuestionnaire){
        $sql = "SELECT * FROM QUESTION 
                WHERE ID_QUESTION IN (SELECT ID_QUESTION FROM CONTENIR WHERE ID_QUESTIONNAIRE = '$idQuestionnaire' )
                AND TYPE='QO'";

        $sth = parent::query($sql);
        $data=$sth->fetch(PDO::FETCH_OBJ);
        $questions=array();
        while (!empty($data)){
            array_push($questions,Array(
                'id'=>$data->ID_QUESTION,
                'type'=>$data->TYPE,
                'intitule'=>$data->INTITULE_QUESTION,
            ));
            $data=$sth->fetch(PDO::FETCH_OBJ);
        }
        return $questions;
    }
}

?> 