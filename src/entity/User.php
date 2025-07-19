<?php
// ============= ENTITÉS CORRIGÉES =============

namespace App\Entity;
use App\Core\abstract\AbstractEntity as AbstractAbstractEntity;

class User extends AbstractAbstractEntity {
    private int $id;
    private string $login;
    private string $password;
    private string $nom;
    private string $prenom;
    private string $adress;
    private string $numeroCNI;
    private string $photoVerso;
    private string $photoRecto;
    private array $numerotels = [];
    private Profil $profil;

    public function __construct(int $id = 0, string $login = '', string $password = '', 
                              string $nom = '', string $prenom = '', string $adress = '', 
                              string $numeroCNI = '', string $photoRecto = '', string $photoVerso = '') {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->login = $login;
        $this->password = $password;
        $this->adress = $adress;
        $this->numeroCNI = $numeroCNI;
        $this->photoRecto = $photoRecto;
        $this->photoVerso = $photoVerso;
        $this->numerotels = [];
        $this->profil = new Profil();
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getLogin(): string { return $this->login; }
    public function getPassword(): string { return $this->password; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getAdress(): string { return $this->adress; }
    public function getNumeroCNI(): string { return $this->numeroCNI; }
    public function getPhotoVerso(): string { return $this->photoVerso; }
    public function getPhotoRecto(): string { return $this->photoRecto; }
    public function getNumerotels(): array { return $this->numerotels; }
    public function getProfil(): Profil { return $this->profil; }

    // Setters
    public function setId(int $id): self { $this->id = $id; return $this; }
    public function setLogin(string $login): self { $this->login = $login; return $this; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }
    public function setPrenom(string $prenom): self { $this->prenom = $prenom; return $this; }
    public function setAdress(string $adress): self { $this->adress = $adress; return $this; }
    public function setNumeroCNI(string $numeroCNI): self { $this->numeroCNI = $numeroCNI; return $this; }
    public function setPhotoVerso(string $photoVerso): self { $this->photoVerso = $photoVerso; return $this; }
    public function setPhotoRecto(string $photoRecto): self { $this->photoRecto = $photoRecto; return $this; }
    public function setProfil(Profil $profil): self { $this->profil = $profil; return $this; }

    public function addNumerotels(NumeroTel $numerotel): self {
        $this->numerotels[] = $numerotel;
        return $this;
    }

    public static function toObject(array $data): static {
        $user = new static(
            $data['id'] ?? 0,
            $data['login'] ?? '',
            $data['password'] ?? '',
            $data['nom'] ?? '',
            $data['prenom'] ?? '',
            $data['adresse'] ?? '',
            $data['numerocni'] ?? '',
            $data['photorecto'] ?? '',
            $data['photoverso'] ?? ''
        );
        
        if (isset($data['idProfil'])) {
            $profil = new Profil();
            $profil->setId($data['idProfil']);
            $user->setProfil($profil);
        }
        
        return $user;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'login' => $this->login,
            'password' => $this->password,
            'adresse' => $this->adress,
            'numerocni' => $this->numeroCNI,
            'photorecto' => $this->photoRecto,
            'photoverso' => $this->photoVerso,
            'profil_id' => $this->profil->getId()
        ];
    }
}
