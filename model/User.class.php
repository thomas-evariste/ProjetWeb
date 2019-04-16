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


    public static function createId(){
        $sth = parent::query("SELECT MAX(ID_USER) as nb FROM PARTICIPANT");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $sth2 = parent::query("SELECT MAX(ID_USER) as nb FROM ENSEIGNANT");
        $data2 = $sth2->fetch(PDO::FETCH_OBJ);
        $max = max($data->nb,$data2->nb);
        return $max+1;
    }

    public static function isLoginUsed($login){
        
        $sth = parent::query("SELECT LOGIN FROM PARTICIPANT WHERE LOGIN='$login'");
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $sth2 = parent::query("SELECT LOGIN FROM ENSEIGNANT WHERE LOGIN='$login'");
        $data2 = $sth->fetch(PDO::FETCH_OBJ);
        if(!empty($data) || !empty($data2)){
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
        $sql2 = "SELECT * FROM ENSEIGNANT WHERE ID_USER = '$id'";
        $sth2 = parent::query($sql2);
        $data2 = $sth2->fetch(PDO::FETCH_OBJ);

        if (!empty($data)){
            $user = new User($data->ID_USER,$data->LOGIN,$data->PASSWORD,$data->PROMOTION,$data->MAJEURE,$data->NOM,$data->PRENOM,$data->MAIL);
            return $user;
        }
        if (!empty($data2)){
            $prof = new Prof($data2->ID_USER,$data2->LOGIN,$data2->PASSWORD,$data2->INTERNE,$data2->DESCRIPTION,$data2->NOM,$data2->PRENOM,$data2->MAIL);
            return $prof;
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
	
	
    public static function getQuestionnaire($idUser){
        $sql = "SELECT * FROM QUESTIONNAIRE";
        $sth = static::query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $questionnaires = array();
        while(!empty($data)){
            array_push($questionnaires,Array(
                    'id'=>$data->ID_QUESTIONNAIRE,
                    'titre'=>$data->TITRE,
                    'description'=>$data->DESCRIPTION_QUESTIONNAIRE,
                    'dateOuverture'=>$data->DATE_OUVERTURE,
                    'dateFermeture'=>$data->DATE_FERMETURE,
                    'connexionRequise'=>$data->CONNEXION_REQUISE,
                    'etat'=>$data->ETAT,
                    'url'=>$data->URL,
                    'createur'=>$data->ID_CREATEUR
                )
            );
            $data = $sth->fetch(PDO::FETCH_OBJ);
        }
        return $questionnaires;
    }
	
	
    public static function getQuestionnaireById($id){
        $sql = "SELECT * FROM QUESTIONNAIRE WHERE ID_QUESTIONNAIRE = '$id'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);

        if (!empty($data)){
            $questionnaire = new Questionnaire($data->ID_QUESTIONNAIRE,$data->TITRE,$data->DESCRIPTION_QUESTIONNAIRE,
                                          $data->DATE_OUVERTURE,$data->DATE_FERMETURE,$data->CONNEXION_REQUISE,$data->ETAT,$data->URL,$data->ID_CREATEUR);
            return $questionnaire;
        }
        else{
            return null;
        }
    }
	
	public static function tenterQCM_QCU($id_user,$args = array()){
		foreach ($args as $tentative) {
			$zero =0;
			$sth = parent::prepare("INSERT INTO TENTER VALUES(:id_user,:id_proposition,:a_corriger,:juste)");
			$sth->bindParam(':id_user',$id_user);
			$sth->bindParam(':id_proposition',$tentative);
			$sth->bindParam(':a_corriger',$zero);  
			
			
			$sql2 = "SELECT REPONSE_CORRECTE FROM REPONSE_DISPONIBLE WHERE ID_PROPOSITION = '$tentative'";
			$sth2 = parent::query($sql2);
			$data2= $sth2->fetch(PDO::FETCH_OBJ);
			
			$sth->bindParam(':juste',$data2->REPONSE_CORRECTE);  
			$sth->execute();
			
		}
	}
	
	public static function tenterQO($id_user,$args = array()){
		$argsRep = array();
		echo ' args: ';
		print_r($args);
		foreach ($args as $key => $tentative) {
			$zero =0;
			$id_reponse = REPONSE::createId();
			$sth = parent::prepare("INSERT INTO TENTER VALUES(:id_reponse,:rep_id_reponse,:rep_id_reponse2,:id_user,:intitule_reponse,:reponse_correcte)");
			$sth->bindParam(':id_reponse',$id_reponse);
			$sth->bindParam(':id_user',$id_user);
			$sth->bindParam(':intitule_reponse',$tentative);
			$sth->bindParam(':reponse_correcte',$zero);
			echo '<br>';
			echo $id_reponse;
			echo '<br>';
			echo $id_user;
			echo '<br>';
			echo $tentative;
			echo '<br>';
			echo $zero;
			echo '<br>';
			$sth->execute();
			echo'coucou';
			$argsRep[$key]=$id_reponse;
		}
		echo ' argsRep: ';
		print_r($argsRep);
		foreach ($argsRep as $id_question => $id_reponse) {
			$sth = parent::prepare("INSERT INTO TENTER VALUES(:id_question,:id_reponse)");
			$sth->bindParam(':id_question',$id_question);
			$sth->bindParam(':id_reponse',$id_reponse);
			$sth->execute();
		}
		foreach ($argsRep as $id_reponse) {
			$zero =0;
			$un =0;
			$sth = parent::prepare("INSERT INTO TENTER VALUES(:id_user,:id_proposition,:a_corriger,:juste)");
			$sth->bindParam(':id_user',$id_user);
			$sth->bindParam(':id_proposition',$id_reponse);
			$sth->bindParam(':a_corriger',$un);  
			
			$sth->bindParam(':juste',$zero);  
			$sth->execute();
			
		}
	}
	
	
	
}

?> 