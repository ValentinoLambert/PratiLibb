<?php

namespace toubeelib\praticien\Repository;

use Doctrine\ORM\EntityRepository;

class PraticienRepository extends EntityRepository
{
    public function getPraticiensBySpecialiteKeyword(string $keyword): array
    {
        $dql = "SELECT p, s FROM toubeelib\\praticien\\Domaine\\Entity\\Praticien p
                JOIN p.specialite s
                WHERE s.libelle LIKE :keyword OR s.description LIKE :keyword
                ORDER BY p.nom ASC";
        
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('keyword', '%' . $keyword . '%');
        
        return $query->getResult();
    }
}
