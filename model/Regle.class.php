<?php 

class Regle extends Model{

    protected static $table_name='REGLE';
    protected $id_regle; 
    protected $bonus; 
    protected $malus; 


    public static function createId(){
        $sth = parent::query("SELECT COUNT(ID_REGLE) as nb FROM REGLE");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $compte = $data->nb;
        if ($compte>0){
            $sth = parent::query("SELECT MAX(ID_REGLE) as nb FROM REGLE");
            $data = $sth->fetch(PDO::FETCH_OBJ);
            $max = $data->nb;
            return $max+1;
        }
        else{
            return 1;
        }
    }


    public static function getList(){
        parent::query("SELECT * FROM REGLE");
    }

    public static function create($id_regle,$bonus,$malus){
        $sth = parent::prepare("INSERT INTO REGLE VALUES(:id_regle,:bonus,:malus)");
        $sth->bindParam(':id_regle',$id_regle);
        $sth->bindParam(':bonus',$bonus); 
        $sth->bindParam(':malus',$malus); 
        $sth->execute();
    }

    public static function addSqlQuery($name,$sqlRequest){
        
    }

    public function __construct($id_regle,$bonus,$malus){
        $this->id_regle = $id_regle;  
        $this->bonus = $bonus;
        $this->malus = $malus;
    }
	
	public static function getIdByBonusAndMalus($bonus,$malus){
		$sql = "SELECT ID_REGLE FROM REGLE WHERE BONUS = '$bonus' AND MALUS = '$malus'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);

        if (!empty($data)){
            return $data->ID_REGLE;
        }
        else{
            return null;
        }
	}
	
	public static function setRegle($idQuestionnaire,$bonus,$malus){
		$id_regle = Regle::getIdByBonusAndMalus($bonus,$malus);
		if(is_null($id_regle)){
			$id_regle = Regle::createId();
			Regle::create($id_regle,$bonus,$malus);
		}
		$sth = parent::prepare("INSERT INTO SPECIFIER VALUES(:idQuestionnaire,:id_regle)");
        $sth->bindParam(':idQuestionnaire',$idQuestionnaire);
        $sth->bindParam(':id_regle',$id_regle);
        $sth->execute();		
	}


}
?> 