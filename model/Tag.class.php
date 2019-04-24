<?php 

class Tag extends Model{

    protected static $table_name='TAG';
    protected $libelle; //OBLIGATOIRE
    protected $couleur; //OBLIGATOIRE

/*
    public static function createId(){
        $sth = parent::query("SELECT COUNT(ID_PROPOSITION) as nb FROM REPONSE_DISPONIBLE");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $compte = $data->nb;
        if ($compte>0){
            $sth = parent::query("SELECT MAX(ID_PROPOSITION) as nb FROM REPONSE_DISPONIBLE");
            $data = $sth->fetch(PDO::FETCH_OBJ);
            $max = $data->nb;
            return $max+1;
        }
        else{
            return 1;
        }
    }
*/
    public static function tagExists($libelle){
        $sth = parent::query("SELECT COUNT(LIBELLE) as nb FROM TAG WHERE LIBELLE='$libelle'");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $compte = $data->nb;
        return ($compte>0);
    }

    public static function getList(){
        parent::query("SELECT * FROM TAG");
    }

    public static function create($libelle,$couleur){
        $sth = parent::prepare("INSERT INTO TAG VALUES(:libelle,:couleur)");
        $sth->bindParam(':libelle',$libelle);
        $sth->bindParam(':couleur',$couleur); 
        $sth->execute();
    }

    public static function addSqlQuery($name,$sqlRequest){
        
    }

    public static function modify($column, $data,$libelle){
        $sql = "UPDATE TAG SET $column = '$data' WHERE LIBELLE='$libelle'";
        $sth = parent::query($sql);
    }

    public function __construct($libelle,$couleur){
        $this->libelle = $libelle;  
        $this->couleur = $couleur;
    }

    public function getLibelle(){
        return $this->libelle;
    }

    public function getCouleur(){
        return $this->couleur;
    }
    /*
    public static function addTag($libelle){
        if (!tagExists($libelle)){
            create($libelle,'red');
        }
    }*/

    public static function linkTagToQuestion($libelle,$idQuestion){
        $sth = parent::prepare("INSERT INTO ASSOCIER VALUES(:libelle,:idQuestion)");
        $sth->bindParam(':libelle',$libelle);
        $sth->bindParam(':idQuestion',$idQuestion); 
        $sth->execute();
    }
}
?> 