<?php
namespace App\Entity;
use App\Core\abstract\AbstractEntity;

class Compte extends AbstractEntity {
    private int $idCompte;
    private string $numero;
    private string $dateCreation;
    private TypeCompte $type;
    private float $montant;
    private array $transactions = [];
    private NumeroTel $numerotel;

    public function __construct(int $idCompte = 0, string $numero = '', float $montant = 0.0, 
                              string $dateCreation = '', TypeCompte $type = TypeCompte::PRINCIPAL) {
        $this->idCompte = $idCompte;
        $this->numero = $numero;
        $this->montant = $montant;
        $this->type = $type;
        $this->dateCreation = $dateCreation;
        $this->numerotel = new NumeroTel();
    }

    // Getters
    public function getIdCompte(): int { return $this->idCompte; }
    public function getNumero(): string { return $this->numero; } // Corrigé le type de retour
    public function getDateCreation(): string { return $this->dateCreation; }
    public function getType(): TypeCompte { return $this->type; }
    public function getMontant(): float { return $this->montant; }
    public function getTransactions(): array { return $this->transactions; }
    public function getNumerotel(): NumeroTel { return $this->numerotel; }

    // Setters corrigés pour retourner self
    public function setIdCompte(int $idCompte): self { $this->idCompte = $idCompte; return $this; }
    public function setNumero(string $numero): self { $this->numero = $numero; return $this; } // Corrigé le type de paramètre
    public function setDateCreation(string $dateCreation): self { $this->dateCreation = $dateCreation; return $this; }
    public function setType(TypeCompte $type): self { $this->type = $type; return $this; }
    public function setMontant(float $montant): self { $this->montant = $montant; return $this; }
    public function setNumerotel(NumeroTel $numerotel): self { $this->numerotel = $numerotel; return $this; }

    public function addTransactions(Transaction $transaction): self {
        $this->transactions[] = $transaction;
        return $this;
    }

    public static function toObject(array $data): static {
        $compte = new static(
            $data['id'] ?? 0,
            $data['numero'] ?? '',
            (float)($data['solde'] ?? 0.0),
            $data['datecreation'] ?? '',
            $data['typecompte'] ?? TypeCompte::PRINCIPAL
        );

        if (isset($data['telephoneId'])) {
            $telephone = new NumeroTel();
            $telephone->setId($data['telephoneId']);
            $compte->setNumerotel($telephone);
        }

        return $compte;
    }

    public function toArray(): array {
        return [
            'id' => $this->idCompte,
            'numero' => $this->numero,
            'solde' => $this->montant,
            'datecreation' => $this->dateCreation,
            'typecompte' => $this->type->value
        ];
    }
}