<?php 

class Prof extends Users{

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

?>