<?php

namespace Mefi\BlogBundle\Twig;

class MefiExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('hundate', array($this, 'hundateFilter')),
        );
    }

    /**
     * Returns an array with the Hungarian month names.
     *
     * If $month given, returns the given month's name.
     *
     * @param   int           $month  (1-12)
     *
     * @throws Exception
     *
     * @return  array
     */
    public function getHungarianMonths($month = null)
    {
        $a = array(
            1 => 'január',
            2 => 'február',
            3 => 'március',
            4 => 'április',
            5 => 'május',
            6 => 'június',
            7 => 'július',
            8 => 'augusztus',
            9 => 'szeptember',
            10 => 'október',
            11 => 'november',
            12 => 'december'
        );

        if (!$month) {
            return $a;
        }

        if (!isset($a[$month])) {
            throw new Exception ('Invalid month.');
        }

        return $a[$month];
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

    public function getName()
    {
        return 'mefi_extension';
    }
}