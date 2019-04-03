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
}
?>