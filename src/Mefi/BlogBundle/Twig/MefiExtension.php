<?php

namespace Mefi\BlogBundle\Twig;

use Mefi\BlogBundle\Helper\HungarianHelper;

class MefiExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('hundate', array($this, 'hundateFilter')),
            new \Twig_SimpleFilter('hundate_collection', array($this, 'hundateCollectionFilter')),
            new \Twig_SimpleFilter('hunarticle', array($this, 'hunarticleFilter'))
        );
    }

    /**
     * Returns an array with the Hungarian month names.
     *
     * If $month given, returns the given month's name.
     *
     * @param int $month  (1-12)
     *
     * @throws Exception
     *
     * @return  array
     */
    public function getHungarianMonths($month = null)
    {
        return HungarianHelper::getHungarianMonths($month);
    }

    /**
     * Formats a DateTime object to the following format:
     *
     * ma, 15:00:00-kor
     * tegnap, 15:00:00-kor
     * tegnapelőtt, 15:00:00-kor
     * 2005. november 11. napján, 15:00:00-kor
     *
     * @param \DateTime $datetime
     *
     * @return string
     */
    public function hundateFilter(\DateTime $datetime)
    {
        $timestamp = $datetime->getTimestamp();

        $date = date('Y-m-d', $timestamp);

        $text = null;

        switch ($date) {
            case date('Y-m-d') :
                $text = 'ma';
                break;

            case date('Y-m-d', time() - 24 * 3600) :
                $text = 'tegnap';
                break;

            case date('Y-m-d', time() - 48 * 3600) :
                $text = 'tegnapelőtt';
                break;
        }

        if (is_null($text)) {
            $date = date('Y. _ d.', $timestamp);
            $month = self::getHungarianMonths(date('n', $timestamp));
            $text = str_replace('_', $month, $date);
            $text .= ' napján';
        }

        $text .= ', ' . date('H:i:s', $timestamp) . '-kor';

        return $text;
    }

    /**
     * Formats a DateTime object to the following format:
     *
     * 2014. január
     *
     * @param \DateTime $datetime
     *
     * @return string
     */
    public function hundateCollectionFilter(\DateTime $datetime)
    {
        $timestamp = $datetime->getTimestamp();

        $year = date('Y. ', $timestamp);
        $month = $this->getHungarianMonths(date('n', $timestamp));

        return $year . $month;
    }

    /**
     * Returns the Hungarian "a" or "az" article
     *
     * @see HungarianHelper::
     *
     * @param string $text
     * @param boolean $uppercaseFirst
     *
     * @return string
     */
    public function hunarticleFilter($text, $uppercaseFirst = false)
    {
        return HungarianHelper::getHungarianArticle($text, $uppercaseFirst);
    }

    public function getName()
    {
        return 'mefi_extension';
    }
}