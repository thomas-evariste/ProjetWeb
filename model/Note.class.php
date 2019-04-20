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

}

?> 