<?php
namespace App\Core;

use App\Core\abstract\AbstractController;
use App\Entity\Compte;
use App\Entity\NumeroTel;
use App\Entity\Profil;
use App\Entity\Transaction;
use App\repository\CompteRepository;
use App\repository\TelephoneRepository;
use App\repository\TransactionRepository;
use App\repository\UserRepository;
use App\service\CompteService;
use App\service\InscriptionService;
use App\service\SecurityService;
use App\service\TransactionService;
 
class App{

    private static array $dependences= [];

    public static function init(){
        self::$dependences=[
        'core'=>[
            'database'=>Database::class,
            'session'=>Session::class,
            'validator'=>Validator::class,
            'imageService'=>ImageService::class
        ],
        'abstract'=>[
            'abstractController'=>AbstractController::class,
        ],
        'repository'=>[
            'compteRepository'=>CompteRepository::class,
            'userRepository'=>UserRepository::class,
            'transactionRepository'=>TransactionRepository::class,
            'telephoneRepository'=>TelephoneRepository::class
        ],
        'service'=>[
            'compteService'=> CompteService::class,
            'securityService'=>SecurityService::class,
            'transactionService'=>TransactionService::class,
            'inscriptionService'=>InscriptionService::class
           
        ],
        'entity'=>[
            'compte'=>Compte::class,
            'numeroTel'=>NumeroTel::class,
            'profil'=>Profil::class,
            'transaction'=>Transaction::class,
        ]
    ];
    }
    public static function getDependence(string $KeyDependance){//fonction qui verifie la videte du tableau si oui on l'initialise puis on le parcours
      if (empty(self::$dependences)){
        self::init();
      }

      foreach (self::$dependences as $keysDossiers) { //on verifie si le dossier contient un tableau si oiui ca verifie si une des clef est dedans si oui on verifie 
        if( is_array($keysDossiers) && isset($keysDossiers[$KeyDependance])){
            $class = $keysDossiers[$KeyDependance];
            if(method_exists($class,'getInstance')){
                return $class::getInstance();
            }
            echo 'je suis ici';
            return new $class;
        }
      }
      return null;
    }
    

  
}