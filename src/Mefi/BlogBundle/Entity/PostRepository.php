<?php

namespace Mefi\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PostRepository
 */
class PostRepository extends EntityRepository
{
    /**
     * Get published and visible posts.
     *
     * @param int $fromId       Only posts, where id is greater than $fromId.
     * @param int $maxResults
     *
     * @return array
     */
    public function findAllVisibleAndPublshed($fromId = 0, $maxResults = 25)
    {
        $query = $this->createQueryBuilder('p')
            ->leftJoin('MefiBlogBundle:Category', 'c')
            ->where('p.is_visible = 1')
            ->andWhere('p.published_at >= :time')
            ->andWhere('p.id > :id')
            ->setParameter('id', $fromId)
            ->setParameter('time', date('Y-m-d H:i:s'))
            ->orderBy('p.id', 'DESC')
            ->setMaxResults($maxResults)
            ->getQuery();

        return $query->getResult();
    }
}
