<?php

namespace Jevisla\AlerteBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Jevisla\AlerteBundle\Entity\Alerte;

/**
 * ReponseRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReponseRepository extends EntityRepository
{
    public function getReponsesWithAlerte($limit)
    {
        $qb = $this->createQueryBuilder('a');

        // On fait une jointure avec l'entité Alerte avec pour alias « adv »
        $qb
            ->innerJoin('a.alerte', 'alerte')
            ->addSelect('alerte');

        // Puis on ne retourne que $limit résultats
        $qb->setMaxResults($limit);

        // Enfin, on retourne le résultat
        return $qb
            ->getQuery()
            ->getResult();
    }

    public function xReponseAlerte(Alerte $alerte)
    {
        $qb = $this->createQueryBuilder('a');
        $qb
            ->where('a.alerte = :alerte')
            ->setParameter('alerte', $alerte)
            ->orderBy('a.date', 'DESC');

        return $qb
            ->getQuery()
            ->getResult();
    }
}
