<?php 

class Prof extends User{

    protected static $table_name='ENSEIGNANT';
    protected $id; //OBLIGATOIRE
    protected $login;  //OBLIGATOIRE
    protected $password; //OBLIGATOIRE
    protected $description;
    protected $interne;
    protected $nom;
    protected $prenom;
    protected $mail;

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

    public function getDescription(){
        return $this->description;
    }

    public function getInterne(){
        return $this->interne;
    }
    
    public function __construct($id,$login,$password,$interne,$description,$nom,$prenom,$mail){
        $this->id = $id;  
        $this->login = $login;
        $this->password = $password;
        $this->mail = $mail;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->interne = $interne;
        $this->description = $description;
    }

    public static function create($id,$login,$password,$interne,$description,$nom,$prenom,$mail){
        $sth = parent::prepare("INSERT INTO ENSEIGNANT VALUES(:id,:login,:password,:interne,:description,:nom,:prenom,:mail)");
        $sth->bindParam(':id',$id);
        $sth->bindParam(':login',$login);  
        $sth->bindParam(':password',$password);
        $sth->bindParam(':interne',$interne);
        $sth->bindParam(':description',$description);
        $sth->bindParam(':nom',$nom);
        $sth->bindParam(':prenom',$prenom);
        $sth->bindParam(':mail',$mail);
        $sth->execute();
    
    }

    public static function getIdByLogin($login){
        $sql = "SELECT ID_USER FROM ENSEIGNANT WHERE LOGIN = '$login'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        echo "data :".$data->ID_USER;
        return $data->ID_USER;
    }




    public static function getByLogin($login){
        $sql = "SELECT * FROM ENSEIGNANT WHERE LOGIN = '$login'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        if (!empty($data)){
            $prof = new Prof($data->ID_USER,$data->LOGIN,$data->PASSWORD,$data->INTERNE,$data->DESCRIPTION,$data->NOM,$data->PRENOM,$data->MAIL);
            return $prof;
        }
        else{
            return null;
        }
    }

    public static function tryLogin($login, $password){
        $sql = "SELECT * FROM ENSEIGNANT WHERE LOGIN = '$login' AND PASSWORD = '$password'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        if (!empty($data)){
            $prof = new User($data->ID_USER,$data->LOGIN,$data->PASSWORD,$data->INTERNE,$data->DESCRIPTION,$data->NOM,$data->PRENOM,$data->MAIL);
            return $prof;
        }
        else{
            return null;
        }
    }

    public static function modify($column, $data,$id){
        $sql = "UPDATE ENSEIGNANT SET $column = '$data' WHERE ID_USER='$id'";
        $sth = parent::query($sql);
    }

    public static function getQuestionnaire($idUser){
        $sql = "SELECT * FROM QUESTIONNAIRE WHERE ID_CREATEUR='$idUser'";
        $sth = parent::query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $questionnaires = array();
        while(!empty($data)){
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
            $data = $sth->fetch(PDO::FETCH_OBJ);
        }
        return $questionnaires;
    }

    public static function getQuestions($idQuestionnaire){
        $sql = "SELECT QUESTION.* 
        FROM QUESTION, CONTENIR, QUESTIONNAIRE 
        WHERE QUESTION.ID_QUESTION = CONTENIR.ID_QUESTION
        AND CONTENIR.ID_QUESTIONNAIRE = QUESTIONNAIRE.ID_QUESTIONNAIRE
        AND QUESTIONNAIRE.ID_QUESTIONNAIRE = '$idQuestionnaire'";
        $sth = parent::query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $questions = array();
        while(!empty($data)){
            array_push($questions,Array(
                    'id'=>$data->ID_QUESTION,
                    'type'=>$data->TYPE,
                    'intitule'=>$data->INTITULE_QUESTION
                )
            );
            $data=$sth->fetch(PDO::FETCH_OBJ);
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