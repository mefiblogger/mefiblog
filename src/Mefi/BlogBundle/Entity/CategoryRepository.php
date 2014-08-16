<?php

namespace Mefi\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 */
class CategoryRepository extends EntityRepository
{

    /**
     * Get all categories with post count.
     *
     * @return array
     */
    public function findAllForCategoryListing()
    {
        $q = $this->createQueryBuilder('c')
            ->select('c, COUNT(p) AS post_count')
            ->innerJoin('c.posts', 'p')
            ->groupBy('c.id')
            ->orderBy('post_count', 'DESC');

        return $q->getQuery()->getResult();
    }
}
