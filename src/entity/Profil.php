<?php
namespace App\Entity;
class Profil{
    private int $id;
    private string $libelle;
    private array $users=[];
    public function __construct(int $id=0, string $libelle=''){
        $this->id=$id;
        $this->libelle=$libelle;
        
    }
    


	public function getId(): int
    {
        return $this->id;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;
        return $this;
    }

    public function addUsers(User $user):void
    {
        $this->users[] = $user;
        
    }
}
