<?php 
namespace App\service;
use App\Core\App;
use App\repository\TelephoneRepository;
use App\repository\UserRepository;

class InscriptionService {
    private static $instance = null;
    private UserRepository $userRepository;
    private TelephoneRepository $telephoneRepository;

    public function __construct() {
        $this->userRepository = App::getDependence('userRepository');
        $this->telephoneRepository = App::getDependence('telephoneRepository');
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function inscrireUtilisateur(array $userData, string $telephone, float $soldeInitial = 0.0): bool {
        try {
          
            $userId = $this->userRepository->insert($userData);
            
            if (!$userId) {
                throw new \Exception("Erreur lors de la création de l'utilisateur");
            }

            
            return $this->telephoneRepository->insertUser($telephone, $userId, $soldeInitial);
            
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de l'inscription : " . $e->getMessage());
        }
    }
}