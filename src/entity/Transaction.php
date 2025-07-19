<?php
namespace App\Entity;
Class Transaction{
    private int $id;
    private string $date;
    private TypeTransaction $type;
    private float $montant ;
    private Compte $compte;
    public function __construct(int $id = 0,string $date='',TypeTransaction $type=TypeTransaction::DEPOT, float $montant=0.0){
        $this->id=$id;
        $this->date=$date;
        $this->type=$type;
        $this->montant= $montant;
        $this->compte= new Compte();
    }

    

    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

  
    public function getDate()
    {
        return $this->date;
    }

  
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

 
    public function getType()
    {
        return $this->type;
    }
 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
 
    public function getMontant()
    {
        return $this->montant;
    }

 
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

   
    public function getCompte()
    {
        return $this->compte;
    }
 
    public function setCompte($compte)
    {
        $this->compte = $compte;

        return $this;
    }
}