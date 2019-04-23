<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require (__ROOT_DIR .'\composer\vendor\autoload.php');

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
        $this->description = utf8_encode($description);
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

    public static function getQuestionnaire($idUser){
        $sql = "SELECT * FROM QUESTIONNAIRE WHERE ID_CREATEUR='$idUser'";
        $sth = parent::query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $questionnaires = array();
        while(!empty($data)){
            array_push($questionnaires,Array(
                    'id'=>$data->ID_QUESTIONNAIRE,
                    'titre'=>utf8_encode($data->TITRE),
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

    public static function getQuestions($idQuestionnaire){
        $sql = "SELECT QUESTION.* 
        FROM QUESTION, CONTENIR, QUESTIONNAIRE 
        WHERE QUESTION.ID_QUESTION = CONTENIR.ID_QUESTION
        AND CONTENIR.ID_QUESTIONNAIRE = QUESTIONNAIRE.ID_QUESTIONNAIRE
        AND QUESTIONNAIRE.ID_QUESTIONNAIRE = '$idQuestionnaire'";
        $sth = parent::query($sql);
        $data = $sth->fetch(PDO::FETCH_OBJ);
        $questions = array();
        while(!empty($data)){
            array_push($questions,Array(
                    'id'=>$data->ID_QUESTION,
                    'type'=>$data->TYPE,
                    'intitule'=>$data->INTITULE_QUESTION
                )
            );
            $data=$sth->fetch(PDO::FETCH_OBJ);
        }
        return $questions;
    }

    public static function getQuestionsOuvertes($idQuestionnaire){
        $sql = "SELECT * FROM QUESTION
                WHERE ID_QUESTION IN 
                    (SELECT ID_QUESTION 
                    FROM CONTENIR 
                    WHERE ID_QUESTIONNAIRE = '$idQuestionnaire' )
                AND TYPE='QO'";

        $sth = parent::query($sql);
        $data=$sth->fetch(PDO::FETCH_OBJ);
        $questions=array();
        while (!empty($data)){
            array_push($questions,Array(
                'id'=>$data->ID_QUESTION,
                'type'=>$data->TYPE,
                'intitule'=>$data->INTITULE_QUESTION,
            ));
            $data=$sth->fetch(PDO::FETCH_OBJ);
        }
        return $questions;
    }
	
	
	public static function smtpmailer($to,$sujet,$message,$from,$mdp){
		
				
		

		$mail = new PHPMailer(TRUE);

		/* Open the try/catch block. */
		try {
		   /* Set the mail sender. */
		   $mail->setFrom($from);

		   /* Add a recipient. */
		   $mail->addAddress($to);

		   /* Set the subject. */
		   $mail->Subject = $sujet;

		   /* Set the mail message body. */
		   $mail->Body = $message;



		   /* SMTP parameters. */
		   
		   /* Tells PHPMailer to use SMTP. */
		   $mail->isSMTP();
		   
		   /* SMTP server address. */
		   $mail->Host = 'smtp.gmail.com';

		   /* Use SMTP authentication. */
		   $mail->SMTPAuth = TRUE;
		   
		   /* Set the encryption system. */
		   $mail->SMTPSecure = 'tls';
		   
		   /* SMTP authentication username. */
		   $mail->Username = $from;
		   
		   /* SMTP authentication password. */
		   $mail->Password = $mdp;
		   
		   /* Set the SMTP port. */
		   $mail->Port = 587;
		   
		   /* Disable some SSL checks. */
		   $mail->SMTPOptions = array(
			  'ssl' => array(
			  'verify_peer' => false,
			  'verify_peer_name' => false,
			  'allow_self_signed' => true
			  )
		   );
		   
		   /* Finally send the mail. */
		   $mail->send();
		}
		catch (Exception $e)
		{
		   /* PHPMailer exception. */
		   echo $e->errorMessage();
		}
		catch (\Exception $e)
		{
		   /* PHP exception (note the backslash to select the global namespace Exception class). */
		   echo $e->getMessage();
		}
	}
	
	public static function getEmailInvite($idQuestionnaire){
		$sql = "SELECT EMAIL FROM EST_INVITE WHERE ID_QUESTIONNAIRE = '$idQuestionnaire' ";
        $sth = parent::query($sql);
        $data=$sth->fetch(PDO::FETCH_OBJ);
        $emailInvite=array();
        while (!empty($data)){
            $emailInvite[]=$data->EMAIL;
            $data=$sth->fetch(PDO::FETCH_OBJ);
        }
        return $emailInvite;
	}
	
	public static function getInviteByEmail($email){
		$invite= array( 'nom' => '', 'prenom' => '', 'idUser' => null, 'email' => $email);
		
		$sql = "SELECT NOM, PRENOM, ID_USER, MAIL FROM ENSEIGNANT WHERE MAIL = '$email'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        if (!empty($data)){
            $invite['nom']=$data->NOM;
            $invite['prenom']=$data->PRENOM;
            $invite['idUser']=$data->ID_USER;
        }
		
		$sql = "SELECT NOM, PRENOM, ID_USER, MAIL FROM PARTICIPANT WHERE MAIL = '$email'";
        $sth = parent::query($sql);
        $data= $sth->fetch(PDO::FETCH_OBJ);
        if (!empty($data)){
            $invite['nom']=$data->NOM;
            $invite['prenom']=$data->PRENOM;
            $invite['idUser']=$data->ID_USER;
        }
		
		return $invite;
	}
	
	
	public static function setEstInvite($emailUser,$id_questionnaire){
		$sth = parent::prepare("INSERT INTO EST_INVITE VALUES(:emailUser,:id_questionnaire,:aParticipe)");
		$zero=0;
		$sth->bindParam(':emailUser',$emailUser);
		$sth->bindParam(':id_questionnaire',$id_questionnaire);
		$sth->bindParam(':aParticipe',$zero);
		$sth->execute();
	}
}
?>