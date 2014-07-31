<?php

namespace Mefi\BlogBundle\Tests\Twig;

use Mefi\BlogBundle\Twig\MefiExtension;
use Symfony\Component\Validator\Constraints\DateTime;

class MefiExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MefiExtension
     */
    private $object;

    public function setUp()
    {
        $this->object = new MefiExtension();
    }

    public function testToday()
    {
        $date = new \DateTime(date("Y-m-d ") . "23:00:00");

        $this->assertEquals("ma, 23:00:00-kor", $this->object->hundateFilter($date));
    }

    public function testYesterday()
    {
        $date = new \DateTime(date("Y-m-d ", time() - 24 * 3600) . "23:00:00");

        $this->assertEquals("tegnap, 23:00:00-kor", $this->object->hundateFilter($date));
    }

    public function testBeforeYesterday()
    {
        $date = new \DateTime(date("Y-m-d ", time() - 48 * 3600) . "23:00:00");

        $this->assertEquals("tegnapelőtt, 23:00:00-kor", $this->object->hundateFilter($date));
    }

    public function testOther()
    {
        $date = new \DateTime("2005-11-05 23:00:00");

        $this->assertEquals("2005. november 05. napján, 23:00:00-kor", $this->object->hundateFilter($date));
    }

    public function testMonths()
    {
        $months = array(
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

        foreach ($months as $i => $month) {
            $this->assertEquals($month, $this->object->getHungarianMonths($i));
        }

        $this->assertEquals($months, $this->object->getHungarianMonths());
    }
}