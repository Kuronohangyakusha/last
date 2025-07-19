<?php
namespace App\service;

use App\Core\App;
use App\Core\Singleton;
 
use App\Entity\User;
use App\repository\UserRepository;

class SecurityService {
    private  static $instance = null;
    private UserRepository $useRepository;
    public function __construct()
    {
        $this->useRepository=App::getDependence('userRepository');
    }
  public static function getInstance(){
    if(self::$instance===null){
        self::$instance=new static();
    }
    return self::$instance;  
}
    public function seConnecter(string $login,string $password):User|null{
            $user=$this->useRepository->selectLoginAndPassword($login,$password);
        if($user){
            return $user;
        }
       return null;
    }
}