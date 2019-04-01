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


    public static function isLoginUsed($login){
        
        $sth = parent::query("SELECT LOGIN FROM PARTICIPANT WHERE LOGIN='$login'");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        if(!empty($data)){
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
        if (!empty($data)){
            $user = new User($data->ID_USER,$data->LOGIN,$data->PASSWORD,$data->PROMOTION,$data->MAJEURE,$data->NOM,$data->PRENOM,$data->MAIL);
            return $user;
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
}

?> 