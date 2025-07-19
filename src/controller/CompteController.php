<?php
namespace App\Controller;

 
use App\Core\abstract\AbstractController;
use App\Core\App;
 
use App\service\CompteService;
use App\service\TransactionService;

class CompteController extends AbstractController{
     private CompteService $compteservice;
      public $user;
     private TransactionService $transaction;
     public function __construct()
     {
      parent::__construct();
      $this->compteservice=App::getDependence('compteService'); 
      $this->transaction=App::getDependence('transactionService');
     }
     
 
   
  
     public function index(){
      $info=$this->session->get('result');

       $user= $this->compteservice->Affichage($info['id']);
       $userInfo = $this->transaction->AfficherTransaction($info['id']);
       
      if($user){

         $this->render('transaction/listetransaction.php',[
         "user" => $user,
           "userInfo"=> $userInfo
       ]);
      }
      
     }
     public function show(){}
     public function store(){}
     public function edit(){}
     public function create(){

     }
     

}