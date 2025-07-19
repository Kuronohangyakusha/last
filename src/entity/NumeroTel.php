<?php

namespace App\Entity;

class NumeroTel {
    private int $id;
    private string $telephone;
    private User $user;
    private Compte $compte;

    public function __construct(int $id = 0, string $telephone = '') {
        $this->id = $id;
        $this->telephone = $telephone;
        $this->compte = new Compte();
        $this->user = new User();
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getTelephone(): string { return $this->telephone; }
    public function getUser(): User { return $this->user; }
    public function getCompte(): Compte { return $this->compte; }

    // Setters
    public function setId(int $id): self { $this->id = $id; return $this; }
    public function setTelephone(string $telephone): self { $this->telephone = $telephone; return $this; }
    public function setUser(User $user): self { $this->user = $user; return $this; }
    public function setCompte(Compte $compte): self { $this->compte = $compte; return $this; }

    public static function toObject(array $data): static {
        $numeroTel = new static(
            $data['id'] ?? 0,
            $data['telephone'] ?? ''
        );

        if (isset($data['user_id'])) {
            $user = new User();
            $user->setId($data['user_id']);
            $numeroTel->setUser($user);
        }

        if (isset($data['compte_id'])) {
            $compte = new Compte();
            $compte->setIdCompte($data['compte_id']);
            $numeroTel->setCompte($compte);
        }

        return $numeroTel;
    }
}
