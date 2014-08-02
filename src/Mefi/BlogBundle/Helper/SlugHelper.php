<?php

namespace Mefi\BlogBundle\Helper;

class SlugHelper
{
    /**
     * Returns a text without accents and special characters.
     *
     * @param string $text
     *
     * @return  string
     */
    public static function slugify($text)
    {
        $text = trim(strtolower($text));

        $text = str_replace('  ', ' ', $text);

        $replace = array(
            'á' => 'a',
            'é' => 'e',
            'í' => 'i',
            'ó' => 'o',
            'ö' => 'o',
            'ő' => 'o',
            'ú' => 'u',
            'ü' => 'u',
            'ű' => 'u',
            ' ' => '-'
        );

        $text = str_replace(array_keys($replace), array_values($replace), $text);

        $text = str_replace('--', '-', $text);

        $text = preg_replace('/[^\-\da-z]/i', '', $text);

        return $text;
    }
}