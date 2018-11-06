<?php

namespace Jevisla\AlerteBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * CategoryRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    public function getLikeQueryBuilder($pattern)
    {
        return $this
            ->createQueryBuilder('c')
            ->where('c.name LIKE :pattern')
            ->setParameter('pattern', $pattern);
    }

    public function getCategories($page, $nbPerPage)
    {
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->getQuery();

        $query
        // On définit l'annonce à partir de laquelle commencer la liste
            ->setFirstResult(($page - 1) * $nbPerPage)
        // Ainsi que le nombre d'annonce à afficher sur une page
            ->setMaxResults($nbPerPage);

        // Enfin, on retourne l'objet Paginator correspondant à la requête construite
        return new Paginator($query, true);
    }

    public function getAllIdCategory()
    {
        return $this
            ->createQueryBuilder('c')
            ->select('partial c.{id, name}')
            ->getQuery()
            ->getArrayResult();
    }
}