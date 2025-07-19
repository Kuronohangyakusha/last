<?php
 
namespace App\service;

use App\Core\App;
 
use App\repository\TransactionRepository;

class TransactionService {
     private static ?TransactionService $instance=null;
      public static function getInstance(){
    if(self::$instance===null){
        self::$instance=new static();
    }
    return self::$instance;   
}
    private TransactionRepository $transactionrepository;
    public function __construct()
    {
        $this->transactionrepository=App::getDependence('transactionRepository');
    }
    public function AfficherTransaction($id){
        $result=$this->transactionrepository->selectTransactionUser($id);
        return $result ? $result : null;
    }
}
 