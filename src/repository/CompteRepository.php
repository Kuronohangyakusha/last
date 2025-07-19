<?php
namespace App\repository;

use App\Core\abstract\AbstractRepository;

class CompteRepository extends AbstractRepository {
    private string $tableUser = 'users';
    private string $tableCompte = 'compte';
    private string $tableNumerotel = 'numerotelephone';
    private static ?CompteRepository $instance = null;

    public function __construct() {
        parent::__construct();
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function selectAll() {}
    public function update() {}
    public function delete() {}
    public function selectById($id) {}
    public function selectBy(array $filter) {}

    public function selectInfoUser(int $id): array|null {
        $request = "SELECT u.prenom, u.nom, c.solde 
                   FROM $this->tableCompte c 
                   INNER JOIN $this->tableNumerotel n ON c.id = n.compte_id 
                   INNER JOIN $this->tableUser u ON u.id = n.user_id 
                   WHERE u.id = :id";
        
        $prepar = $this->pdo->prepare($request);
        $prepar->execute(['id' => $id]);
        $resultat = $prepar->fetch();
        
        return $resultat ?: null;
    }

    public function insert(array $data): bool|int {
        $query = "INSERT INTO $this->tableCompte (solde, numero, datecreation, typecompte) 
                 VALUES (:solde, :numero, :datecreation, :typecompte)";
        
        $stmt = $this->pdo->prepare($query);
        if ($stmt->execute($data)) {
            return $this->pdo->lastInsertId();
        }
        return false;
    }
}
