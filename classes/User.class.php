<?php 

class User extends Model{

    protected static $table_name='USER';
    protected $login;
    protected $password;
    protected $mail;
    protected $nom;
    protected $prenom;

/*    public static function __construct(){



    }
*/


    public static function isLoginUsed($login){
        
        $sth = parent::query("SELECT USER_LOGIN FROM USER WHERE USER_LOGIN='$login'");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        if(!empty($data)){
            return true;
        }
        return false;
    }

    public static function getList(){
        parent::query('SELECT * FROM USER');
        
    }

    public static function create($login,$password,$mail,$nom,$prenom){
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
        $sth = parent::prepare("INSERT INTO USER VALUES(:login,:password,:mail,:nom,:prenom)");
        $sth->bindParam(':login',$login);  
        $sth->bindParam(':password',$password);
        $sth->bindParam(':mail',$mail);
        $sth->bindParam(':nom',$nom);
        $sth->bindParam(':prenom',$prenom);
        $sth->execute();
        return new User($login,$password,$mail,$nom,$prenom);
    }

    public static function addSqlQuery($name,$sqlRequest){
        
    }

    public static function tryLogin($login, $password){
        $sql = "SELECT * FROM USER WHERE USER_LOGIN = '$login' AND USER_PASSWORD = '$password'";
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

    public function __construct($login,$password,$mail,$nom,$prenom){  
        $this->login = $login;
        $this->password = $password;
        $this->mail = $mail;
        $this->nom = $nom;
        $this->prenom = $prenom;

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



}

?> 