<?php

namespace toubeelib\praticien\Domaine\Entity;

use Doctrine\Common\Collections\Collection;

class Praticien
{
    private string $id;
    private string $nom;
    private string $prenom;
    private string $ville;
    private string $email;
    private string $telephone;
    private Specialite $specialite;
    private ?Structure $structure = null;
    private Collection $motifs;
    private Collection $moyensPaiement;

    public function __construct(string $nom, string $prenom, string $ville, string $email, string $telephone)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->ville = $ville;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->motifs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->moyensPaiement = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getSpecialite(): Specialite
    {
        return $this->specialite;
    }

    public function setSpecialite(Specialite $specialite): void
    {
        $this->specialite = $specialite;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): void
    {
        $this->structure = $structure;
    }

    public function getMotifs(): Collection
    {
        return $this->motifs;
    }

    public function addMotif(MotifVisite $motif): void
    {
        $this->motifs->add($motif);
    }

    public function getMoyensPaiement(): Collection
    {
        return $this->moyensPaiement;
    }

    public function addMoyenPaiement(MoyenPaiement $moyenPaiement): void
    {
        $this->moyensPaiement->add($moyenPaiement);
    }
}

