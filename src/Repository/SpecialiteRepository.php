<?php

namespace toubeelib\praticien\Repository;

use Doctrine\ORM\EntityRepository;

class SpecialiteRepository extends EntityRepository
{
    public function getSpecialitesByKeyword(string $keyword): array
    {
        $dql = "SELECT s FROM toubeelib\\praticien\\Domaine\\Entity\\Specialite s
                WHERE s.libelle LIKE :keyword OR s.description LIKE :keyword
                ORDER BY s.libelle ASC";
        
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('keyword', '%' . $keyword . '%');
        
        return $query->getResult();
    }
}
