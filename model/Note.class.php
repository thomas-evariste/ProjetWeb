<?php 

class Note extends Model{

    protected static $table_name='NOTE';
    protected $id_user; 
    protected $ens_id_user;
    protected $id_note; 
    protected $id_questionnaire;
    protected $valeur;


    public static function createId(){
        $sth = parent::query("SELECT COUNT(ID_NOTE) as nb FROM NOTE");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $compte = $data->nb;
        if ($compte>0){
            $sth = parent::query("SELECT MAX(ID_NOTE) as nb FROM NOTE");
            $data = $sth->fetch(PDO::FETCH_OBJ);
            $max = $data->nb;
            return $max+1;
        }
        else{
            return 1;
        }
    }
	
	public static function getResultats($id_questionnaire){
		$sql = "SELECT * FROM NOTE WHERE ID_QUESTIONNAIRE = '$id_questionnaire'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
		
        $resultats = array();
        while(!empty($data)){
			
			$sql2 = "SELECT * FROM PARTICIPANT WHERE ID_USER = '$data->ID_USER'";
			$sth2 = parent::query($sql2);
			$data2= $sth2->fetch(PDO::FETCH_OBJ);
			
            array_push($resultats,Array(
                    'id_user'=>$data->ID_USER,
                    'ens_id_user'=>$data->ENS_ID_USER,
                    'valeur'=>$data->VALEUR,
                    'login'=>$data2->LOGIN,
                    'nom'=>$data2->NOM,
                    'prenom'=>$data2->PRENOM
                )
            );
            $data = $sth->fetch(PDO::FETCH_OBJ);
        }
		return $resultats;
	}

}

?> 