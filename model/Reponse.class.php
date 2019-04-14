<?php 

class Reponse extends Model{

    protected static $table_name='REPONSE_DISPONIBLE';
    protected $id; //OBLIGATOIRE
    protected $proposition;
    protected $aCorriger; 
    protected $idUser;
    protected $intitule;
    protected $reponseCorrecte;


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


    public static function getList(){
        parent::query("SELECT * FROM REPONSE_DISPONIBLE");
    }

    public static function create($id,$proposition,$aCorriger,$idUser,$intitule,$reponseCorrecte){
        $sth = parent::prepare("INSERT INTO REPONSE_DISPONIBLE VALUES(:id,:proposition,:aCorriger,:idUser,:intitule,:reponseCorrecte)");
        $sth->bindParam(':id',$id);
        $sth->bindParam(':proposition',$proposition);  
        $sth->bindParam(':aCorriger',$aCorriger);
        $sth->bindParam(':idUser',$idUser);
        $sth->bindParam(':intitule',$intitule);
        $sth->bindParam(':reponseCorrecte',$reponseCorrecte);
        $sth->execute();
    }

    public static function addSqlQuery($name,$sqlRequest){
        
    }

    public static function modify($column, $data,$id){
        $sql = "UPDATE REPONSE_DISPONIBLE SET $column = '$data' WHERE ID_PROPOSITION='$id'";
        $sth = parent::query($sql);
    }

    public function __construct($id,$proposition,$aCorriger,$idUser,$intitule,$reponseCorrecte){
        $this->id = $id;  
        $this->proposition = $proposition;
        $this->aCorriger = $aCorriger;
        $this->idUser = $idUser;
        $this->intitule = $intitule;
        $this->reponseCorrecte = $reponseCorrecte;
    }

    public function getId(){
        return $this->id;
    }

    public function getProposition(){
        return $this->date_ouverture;
    }
    public function getACorriger(){
        return $this->aCorriger;
    }

    public function getIdUser(){
        return $this->idUser;
    }

    public function getIntitule(){
        return $this->intitule;
    }

    public function getReponseCorrecte(){
        return $this->reponseCorrecte;
    }


    public static function getById($id){
        $sql = "SELECT * FROM REPONSE_DISPONIBLE WHERE ID_PROPOSITION = '$id'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);

        if (!empty($data)){
            $reponse = new Reponse($data->ID_PROPOSITION,$data->REP_ID_PROPOSITION,$data->REP_ID_PROPOSITION2,
                                          $data->ID_USER,$data->INTITULE_PROPOSITION,$data->REPONSE_CORRECTE);
            return $reponse;
        }
        else{
            return null;
        }
    }

    
    public static function ajouterReponse($idReponse,$idQuestion){
        $sth = parent::prepare("INSERT INTO DISPOSER VALUES(:idQuestion,:idReponse)");
        $sth->bindParam(':idQuestion',$idQuestion);
        $sth->bindParam(':idReponse',$idReponse);
        $sth->execute();
    }

}

?> 