<?php
namespace App\repository;
use App\Core\abstract\AbstractRepository;
use App\Core\App;
use App\repository\CompteRepository;

class TelephoneRepository extends AbstractRepository {
    private string $table = 'numerotelephone';
    private static ?TelephoneRepository $instance = null;
    private CompteRepository $compteRepository;

    public function __construct() {
        parent::__construct();
        $this->compteRepository = App::getDependence('compteRepository');
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function selectAll() {}
    public function insert(array $data) {}
    public function update() {}
    public function delete() {}
    public function selectById($id) {}
    public function selectBy(array $filter) {}

    public function insertUser(string $telephone, int $user_id, float $solde): bool {
    try {
        $this->pdo->beginTransaction();
        
        // Créer le compte d'abord
        $compteData = [
            'solde' => $solde,
            'numero' => $this->generateNumeroCompte(),
            'datecreation' => date('Y-m-d H:i:s'),
            'typecompte' => 'PRINCIPAL'
        ];
        
        $compte_id = $this->compteRepository->insert($compteData);
        
        if (!$compte_id) {
            throw new \Exception("Erreur lors de la création du compte");
        }
        
        // Insérer le numéro de téléphone
        $stmt = $this->pdo->prepare("INSERT INTO $this->table (telephone, user_id, compte_id) 
                                     VALUES(:telephone, :user_id, :compte_id)");
        $result = $stmt->execute([
            'telephone' => $telephone,
            'user_id' => $user_id,
            'compte_id' => $compte_id
        ]);
        
        if (!$result) {
            throw new \Exception("Erreur lors de l'insertion du numéro de téléphone");
        }
        
        $this->pdo->commit();
        return true;
    } catch (\Exception $e) {
        $this->pdo->rollBack();
        throw new \Exception("Erreur lors de l'inscription : " . $e->getMessage());
    }
}


    private function generateNumeroCompte(): string {
        return 'CPT' . date('Ymd') . rand(1000, 9999);
    }
}

