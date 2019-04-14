<?php 

class Question extends Model{

    protected static $table_name='QUESTION';
    protected $id; //OBLIGATOIRE
    protected $type; //OBLIGATOIRE
    protected $intitule;  //OBLIGATOIRE




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

    public function __construct($id,$type,$intitule){
        $this->id = $id;  
        $this->type = $type;
        $this->intitule = $intitule;
    }

    public function getType(){
        return $this->type;
    }
    public function getIntitule(){
        return $this->intitule;
    }

    public function getId(){
        return $this->id;
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
    
}

?> 