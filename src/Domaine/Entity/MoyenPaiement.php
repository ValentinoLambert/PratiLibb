<?php

namespace toubeelib\praticien\Domaine\Entity;

use Doctrine\Common\Collections\Collection;

class MoyenPaiement
{
    private int $id;
    private string $libelle;
    private Collection $praticiens;

    public function __construct(string $libelle)
    {
        $this->libelle = $libelle;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;
        return $this;
    }

    public function getPraticiens(): Collection
    {
        return $this->praticiens;
    }
}
