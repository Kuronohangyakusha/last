<?php
namespace App\repository;

use App\Core\abstract\AbstractRepository;
use App\Entity\User;

class UserRepository extends AbstractRepository {
    private string $table = 'users';
    private static ?UserRepository $instance = null;

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

    public function selectLoginAndPassword(string $login, string $password): User|null {
        $request = "SELECT * FROM $this->table WHERE login = :login";
        $prepa = $this->pdo->prepare($request);
        $prepa->execute(['login' => $login]);
        $resultat = $prepa->fetch();

        if ($resultat && password_verify($password, $resultat['password'])) {
            return User::toObject($resultat);
        }
        return null;
    }

    public function insert(array $userData): bool|int {
        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO $this->table (nom, prenom, login, password, adresse, numerocni, photorecto, photoverso, idprofil)
                VALUES (:nom, :prenom, :login, :password, :adresse, :numerocni, :photorecto, :photoverso, :idprofil)";

        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($userData);

        if ($result) {
            return $this->pdo->lastInsertId();
        }
        return false;
    }
}
