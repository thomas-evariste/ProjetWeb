<?php 

class Reponse extends Model{

    protected static $table_name='REPONSE_DISPONIBLE';
    protected $ID_PROPOSITION; //OBLIGATOIRE
    protected $REP_ID_PROPOSITION;
    protected $REP_ID_PROPOSITION2; 
    protected $ID_USER;
    protected $INTITULE_PROPOSITION;
    protected $REPONSE_CORRECTE;


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

    public static function create($id,$proposition,$proposition2,$idUser,$intitule,$reponseCorrecte){
        $sth = parent::prepare("INSERT INTO REPONSE_DISPONIBLE VALUES(:id,:proposition,:proposition2,:idUser,:intitule,:reponseCorrecte)");
        $sth->bindParam(':id',$id);
        $sth->bindParam(':proposition',$proposition);  
        $sth->bindParam(':proposition2',$proposition2);
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

    public function __construct(){

    }
/*
    public function __construct($id,$proposition,$aCorriger,$idUser,$intitule,$reponseCorrecte){
        $this->id = $id;  
        $this->proposition = $proposition;
        $this->aCorriger = $aCorriger;
        $this->idUser = $idUser;
        $this->intitule = $intitule;
        $this->reponseCorrecte = $reponseCorrecte;
    }
*/
    public function getId(){
        return $this->ID_PROPOSITION;
    }

    public function getProposition(){
        return $this->REP_ID_PROPOSITION;
    }
    public function getProposition2(){
        return $this->REP_ID_PROPOSITION2;
    }

    public function getIdUser(){
        return $this->ID_USER;
    }

    public function getIntitule(){
        return $this->INTITULE_PROPOSITION;
    }

    public function getReponseCorrecte(){
        return $this->REPONSE_CORRECTE;
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

    public static function supprimerReponse($idReponse){
        $sth = parent::prepare("DELETE FROM DISPOSER WHERE ID_PROPOSITION=:idReponse");
        $sth->bindParam(':idReponse',$idReponse);
        $sth->execute();
        
        $sth = parent::prepare("DELETE FROM REPONSE_DISPONIBLE WHERE ID_PROPOSITION=:idReponse");
        $sth->bindParam(':idReponse',$idReponse);
        $sth->execute();
    }

    

}

?> 