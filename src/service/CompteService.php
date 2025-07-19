<?php
namespace App\service;

use App\Core\App;
use App\repository\CompteRepository;
 

class CompteService{
    private static $instance=null;
    private CompteRepository $compteRepository;
    public function __construct(){
        $this->compteRepository=App::getDependence('compteRepository');
    }
     
    public static function getInstance(){
    if(self::$instance===null){
        self::$instance=new static();
    }
    return self::$instance;  
}

   
public function Affichage($id){
    $result = $this->compteRepository->selectInfoUser($id);
    if($result){
        return $result;
    }
    return null;
}
}