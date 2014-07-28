<?php

namespace Mefi\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PostRepository
 */
class PostRepository extends EntityRepository
{

    /**
     * Returns the base query for all posts.
     *
     * @param int $fromId       Only posts, where id is greater than $fromId.
     * @param int $maxResults
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getBaseQuery($fromId = 0, $maxResults = 25)
    {
        return $this->createQueryBuilder('p')
            ->where('p.is_visible = 1')
            ->andWhere('p.id > :fromId')
            ->setParameter('fromId', $fromId)
            ->setMaxResults($maxResults)
            ->andWhere('p.published_at <= :time')
            ->setParameter('time', date('Y-m-d H:i:s'))
            ->orderBy('p.id', 'DESC');
    }

    /**
     * Get all published and visible posts.
     *
     * @param int $fromId       Only posts, where id is greater than $fromId.
     * @param int $maxResults
     *
     * @return array
     */
    public function findAllVisibleAndPublshed($fromId = 0, $maxResults = 25)
    {
        $query = $this->getBaseQuery($fromId, $maxResults);

        return $query->getQuery()->getResult();
    }

    /**
     * Get published and visible posts with the given category id.
     *
     * @param int $categoryId
     * @param int $fromId       Only posts, where id is greater than $fromId.
     * @param int $maxResults
     *
     * @return array
     */
    public function findAllVisibleAndPublshedByCategory($categoryId, $fromId = 0, $maxResults = 25)
    {
        $query = $this->getBaseQuery($fromId, $maxResults)
            ->andWhere('p.category_id = :category_id')
            ->setParameter('category_id', $categoryId)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Get published and visible posts created at the given year and month.
     *
     * @param int $year
     * @param int $month
     * @param int $fromId       Only posts, where id is greater than $fromId.
     * @param int $maxResults
     *
     * @return array
     */
    public function findAllVisibleAndPublshedByYearAndMonth($year, $month, $fromId = 0, $maxResults = 25)
    {
        $query = $this->getBaseQuery($fromId, $maxResults)
            ->andWhere('YEAR(p.created_at) = :year')
            ->setParameter('year', $year)
            ->andWhere('MONTH(p.created_at) = :month')
            ->setParameter('month', $month)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Get published and visible posts created at the given year and month.
     *
     * @param int $id
     *
     * @return Post
     */
    public function findOneVisibleAndPublshedById($id)
    {
        $query = $this->getBaseQuery(0, 1)
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getSingleResult();
    }
}
