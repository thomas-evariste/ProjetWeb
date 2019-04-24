<?php 

class Question extends Model{

    protected static $table_name='QUESTION';
    protected $ID_QUESTION; //OBLIGATOIRE
    protected $TYPE; //OBLIGATOIRE
    protected $INTITULE_QUESTION;  //OBLIGATOIRE
    protected $reponses=Array();




    public static function createId(){
        $sth = parent::query("SELECT COUNT(ID_QUESTION) as nb FROM QUESTION");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $compte = $data->nb;
        if ($compte>0){
            $sth = parent::query("SELECT MAX(ID_QUESTION) as nb FROM QUESTION");
            $data = $sth->fetch(PDO::FETCH_OBJ);
            $max = $data->nb;
            return $max+1;
        }
        else{
            return 1;
        }
    }
/*
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
*/
    public function __construct(){

    }

    public static function getList(){
        parent::query("SELECT * FROM QUESTION");
    }

    public static function create($id,$type,$intitule){

        $sth = parent::prepare("INSERT INTO QUESTION VALUES(:id,:type,:intitule)");
        $sth->bindParam(':id',$id);
        $sth->bindParam(':type',$type);  
        $sth->bindParam(':intitule',$intitule);
        $sth->execute();
        //return new User($id,$login,$password,$promotion,$majeure,$nom,$prenom,$mail);
    }

    public static function addSqlQuery($name,$sqlRequest){
        
    }

    public static function modify($column, $data,$id){
        $sql = "UPDATE QUESTION SET $column = '$data' WHERE ID_QUESTION='$id'";
        $sth = parent::query($sql);
    }
    /*
    public function __construct($id,$type,$intitule){
        $this->id = $id;  
        $this->type = $type;
        $this->intitule = $intitule;
    }*/

    public function getType(){
        return $this->TYPE;
    }
    public function getIntitule(){
        return $this->INTITULE_QUESTION;
    }

    public function getId(){
        return $this->ID_QUESTION;
    }

    public function getReponses(){
        return $this->reponses;
    }

    public function setReponses($reponses){
        $this->reponses=$reponses;
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
        $sql = "SELECT * FROM QUESTION WHERE ID_QUESTION = '$id'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);

        if (!empty($data)){
            $question = new Question($data->ID_QUESTION,$data->TYPE,$data->INTITULE);
            return $question;
        }
        else{
            return null;
        }
    }
	
	public static function gerReponses($idQuestion){
        $sql = "SELECT * FROM REPONSE_DISPONIBLE WHERE ID_PROPOSITION IN (SELECT ID_PROPOSITION FROM DISPOSER WHERE ID_QUESTION = '$idQuestion' )";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
		
        $reponses = array();
        while(!empty($data)){
            array_push($reponses,Array(
                    'id_proposition'=>$data->ID_PROPOSITION,
                    'rep_id_proposition'=>$data->REP_ID_PROPOSITION,
                    'rep_id_proposition2'=>$data->REP_ID_PROPOSITION2,
                    'id_user'=>$data->ID_USER,
                    'intitule_proposition'=>utf8_encode($data->INTITULE_PROPOSITION),
                    'reponse_correcte'=>$data->REPONSE_CORRECTE,
                )
            );
            $data = $sth->fetch(PDO::FETCH_OBJ);
        }
		return $reponses;
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

    /*
    public static function getReponses($idQuestion){
        $sql = "SELECT REPONSE_DISPONIBLE.* 
                FROM QUESTION, DISPOSER, REPONSE_DISPONIBLE 
                WHERE QUESTION.ID_QUESTION = '$idQuestion'
                AND QUESTION.ID_QUESTION = DISPOSER.ID_QUESTION
                AND DISPOSER.ID_PROPOSITION = REPONSE_DISPONIBLE.ID_PROPOSITION";
        $sth = parent::query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $reponses = Array();
        while(!empty($data)){
            array_push($reponses,Array(
                    'id'=>$data->ID_PROPOSITION,
                    'rep_id_prop'=>$data->REP_ID_PROPOSITION,
                    'rep_id_prop2'=>$data->REP_ID_PROPOSITION2,
                    'idUser'=>$data->ID_USER,
                    'intitule'=>$data->INTITULE_PROPOSITION,
                    'reponseCorrecte'=>$data->REPONSE_CORRECTE
                )
            );
            $data=$sth->fetch(PDO::FETCH_OBJ);
        }
        return $reponses;
    }*/

    public static function obtainReponses($idQuestion){
        $sql = "SELECT REPONSE_DISPONIBLE.* 
                FROM QUESTION, DISPOSER, REPONSE_DISPONIBLE 
                WHERE QUESTION.ID_QUESTION = :id_question
                AND QUESTION.ID_QUESTION = DISPOSER.ID_QUESTION
                AND DISPOSER.ID_PROPOSITION = REPONSE_DISPONIBLE.ID_PROPOSITION";
        $sth = parent::prepare($sql);
        $sth->bindParam(":id_question",$idQuestion);
        $sth->execute();
        $reponses = $sth->fetchAll(PDO::FETCH_CLASS,'Reponse');
        return $reponses;
    }

    public static function obtainReponsesACorriger($idQuestion){
        $sql = "SELECT REPONSE_DISPONIBLE.* 
                FROM QUESTION, DISPOSER, REPONSE_DISPONIBLE 
                WHERE QUESTION.ID_QUESTION = :id_question
                AND QUESTION.ID_QUESTION = DISPOSER.ID_QUESTION
                AND DISPOSER.ID_PROPOSITION = REPONSE_DISPONIBLE.ID_PROPOSITION";
        $sth = parent::prepare($sql);
        $sth->bindParam(":id_question",$idQuestion);
        $sth->execute();
        $reponses = $sth->fetchAll(PDO::FETCH_CLASS,'Reponse');
        return $reponses;
    }

    public static function obtainReponsesQO($idQuestion){
        $sql = "SELECT rep.* 
                FROM REPONSE_DISPONIBLE as rep, TENTER, QUESTION, PARTICIPANT, DISPOSER
                WHERE QUESTION.ID_QUESTION = :id_question
                AND QUESTION.ID_QUESTION = DISPOSER.ID_QUESTION
                AND DISPOSER.ID_PROPOSITION = rep.ID_PROPOSITION
                AND PARTICIPANT.ID_USER = TENTER.ID_USER
                AND TENTER.ID_PROPOSITION = rep.ID_PROPOSITION
                AND TENTER.A_CORRIGER=1";
        $sth = parent::prepare($sql);
        $sth->bindParam(":id_question",$idQuestion);
        $sth->execute();
        $reponses = $sth->fetchAll(PDO::FETCH_CLASS,'Reponse');
        return $reponses;
    }

    public static function corriger($idReponse,$idUser,$answerValue){

        $sql = "UPDATE TENTER
                SET A_CORRIGER=0, JUSTE=$answerValue
                WHERE ID_PROPOSITION = $idReponse
                ";
        $sth=parent::query($sql);
        //$bonus=Questionnaire::getBonus();
        //$malus=Questionnaire::getMalus();
        /*
        if($answerValue==1){

        }*/


    }

    public static function supprimer($idQuestion){
        $sql = "SELECT ID_PROPOSITION FROM DISPOSER WHERE ID_QUESTION=:idQuestion";
        $sth=parent::prepare($sql);
        $sth->bindParam('idQuestion',$idQuestion);
        $sth->execute();
        $datas= $sth->fetchAll(PDO::FETCH_OBJ);

        $sql = "DELETE FROM CONTENIR WHERE ID_QUESTION=:idQuestion";
        $sth=parent::prepare($sql);
        $sth->bindParam('idQuestion',$idQuestion);
        $sth->execute();

        $sql = "DELETE FROM DISPOSER WHERE ID_QUESTION=:idQuestion";
        $sth=parent::prepare($sql);
        $sth->bindParam('idQuestion',$idQuestion);
        $sth->execute();

        $sql = "DELETE FROM ASSOCIER WHERE ID_QUESTION=:idQuestion";
        $sth=parent::prepare($sql);
        $sth->bindParam('idQuestion',$idQuestion);
        $sth->execute();

        foreach($datas as $data){
            $sql = "DELETE FROM REPONSE_DISPONIBLE WHERE ID_PROPOSITION=:idReponse";
            $sth=parent::prepare($sql);
            $sth->bindParam('idReponse',$data->ID_PROPOSITION);
            $sth->execute();
        }


        
        $sql = "DELETE FROM QUESTION WHERE ID_QUESTION=:idQuestion";
        $sth=parent::prepare($sql);
        $sth->bindParam('idQuestion',$idQuestion);
        $sth->execute();
    }
}

?> 