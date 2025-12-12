<?php

namespace toubeelib\praticien\Domaine\Entity;

use Doctrine\Common\Collections\Collection;

class Structure
{
    private string $id;
    private string $nom;
    private string $adresse;
    private ?string $ville = null;
    private ?string $code_postal = null;
    private ?string $telephone = null;
    private Collection $praticiens;

    public function getId(): string
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function getPraticiens(): Collection
    {
        return $this->praticiens;
    }
}
