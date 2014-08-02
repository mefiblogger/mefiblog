<?php

namespace Mefi\BlogBundle\Helper;

use Exception;

class HungarianHelper
{
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
    public static function getHungarianMonths($month = null)
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
     * Returns the Hungarian "a" or "az" article
     *
     * @param string    $text           The text to format.
     * @param bool      $uppercaseFirst Whether the article starts with capital letter or not.
     *
     * @return string
     */
    public static function getHungarianArticle($text, $uppercaseFirst = false)
    {
        $article = ($uppercaseFirst ? 'A' : 'a');

        $az = array('a', 'á', 'e', 'é', 'i', 'í', 'o', 'ó', 'ö', 'ő', 'u', 'ú', 'ü', 'ű');

        if (!empty($text) && in_array(mb_strtolower($text[0]), $az)) {
            $article .= 'z';
        }

        return $article;
    }
}