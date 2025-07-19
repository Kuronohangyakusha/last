<?php
namespace App\Controller;

 
use App\Core\abstract\AbstractController;
use App\Core\App;
use App\Core\Session;
use App\Core\Validator;
use App\Entity\Transaction;
use App\repository\UserRepository;
use App\service\SecurityService;

class LoginController extends AbstractController{

    private Validator $validator;
     private SecurityService $securityService;
     public function __construct(){
        parent::__construct();
        $this->Layout = 'login';
        $this->securityService=App::getDependence('securityService');
        $this->validator=App::getDependence('validator');
     }
    public function login(){

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data=$_POST;
        $valider = $this->validator::getLoginRules();
        
           if($this->validator::validate($data,$valider)){
                $result = $this->securityService->seConnecter($data['login'], $data['password']);
         
                if($result){
               
             
                    $this->session->set('result',$result->toArray());
           
                header("Location:".APP_URL."/liste");
                exit;
            } 
           }
         
            $this->set('error', $this->validator::getError());

          
           
        
             
           
      
       
    }
    # 
            $this->render('login/connexion.php');
}
     public function index(){
      
        $this->render('login/connexion.php');
     }
     public function show(){}
     public function store(){}
     public function edit(){}
     public function create(){

     }
}