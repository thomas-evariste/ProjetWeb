<?php 

class ProfController extends UserController{
    
    protected $currentUser;

    public function __construct($request) {
        parent::__construct($request);
        $this->currentUser = Prof::getById($_SESSION['id']);
    }

    
    public function defaultAction($request) { 
        $view = new ProfView($this, 'connected',array('user' =>$this->currentUser)); 
        $view->render(); 
    }

    public function home($request){
        $view = new ProfView($this, 'home',array('user' =>$this->currentUser)); 
        $view->render(); 
    }

    public function profil($request){
        $view = new ProfView($this, 'profilprof',array('user' =>$this->currentUser)); 
        $view->render(); 
    }

    public function deconnexion($request){
        $_SESSION = array();
        header("location: index.php?action=home");
    }

    public function validateConnexion($request){
        $view = new ProfView($this,'connected',array('user'=>$this->currentUser));
        $view->render();
    }

    public function modifier($request){
        $view = new ProfView($this,'modifyprof',array('user'=>$this->currentUser));
        $view->render();
    }

    public function validateModification($request){
        $password = $request->read('password');
        $passwordConf = $request->read('passwordConf'); 
        $interne = $request->read('interne');
        $description = $request->read('description'); 
        $mail = $request->read('mail');
        $nom = $request->read('nom'); 
        $prenom = $request->read('prenom');

        if ($password==$passwordConf && $password!=''){
            Prof::modify('PASSWORD',$password,$this->currentUser->getId());
        }

        if ($interne=='yes'){
            Prof::modify('INTERNE',1,$this->currentUser->getId());
        }

        if ($description!=''){
            Prof::modify('DESCRIPTION',$description,$this->currentUser->getId());
        }

        if ($mail!=''){
            Prof::modify('MAIL',$mail,$this->currentUser->getId());
        }

        if ($prenom!=''){
            Prof::modify('PRENOM',$prenom,$this->currentUser->getId());
        }

        if ($nom!=''){
            Prof::modify('NOM',$nom,$this->currentUser->getId());
        }

        $currentUser = Prof::getById($_SESSION['id']); 
        header("location: index.php?action=profil&controller=prof");
    }


}
?> 