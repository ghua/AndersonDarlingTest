<?php

namespace AndersonDarlingTest\Tests;

use AndersonDarlingTest\NormalDistribution;

/**
 * Class NormalDistributionTest
 *
 * @package AndersonDarlingTest\Tests
 *
 * @author  Semyon Velichko <semyon@velichko.net>
 */
class NormalDistributionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function getData()
    {
        return array(array(4.10, -3.39, 0.94, 0.32, 4.23, -0.54, -3.94, 3.90, 2.56, -1.96, 1.46,
            6.87, -2.94, 2.06, 4.89, 3.45, -0.8, 8.47, 1.54, -0.66, -2.55, 1.64,
            2.12, -7.13, 0.85, 2.40, -2.73, 8.80, -0.89, -0.52, -9.91, -5.25,
            -0.67, 5.82, 2.45, 4.07, 6.51, 2.2, 0.03, 3.79, -4.91, 4.39, 1.95, -1.93, 1.18, -4.49, 10.58
        ));
    }

    /**
     * @return array
     */
    public function getPdfTable()
    {
        return array(
            array(0.0, 0.398942),
            array(0.1, 0.396953),
            array(0.8, 0.289692),
            array(1.5, 0.129518),
        );
    }

    /**
     * @return array
     */
    public function getCdfTable()
    {
        return array(
            array(-1.1, 0.1356660609),
            array(0.0, 0.5),
            array(0.1, 0.5398278372),
            array(0.8, 0.7881446014),
            array(1.5, 0.9331927987),
        );
    }

    /**
     * @return array
     */
    public function getFactorial()
    {
        return array(
            array(0, 1),
            array(1, 1),
            array(2, 2),
            array(3, 6),
            array(4, 24),
            array(5, 120),
            array(6, 720),
            array(7, 5040),
            array(8, 40320),
            array(9, 362880),
            array(10, 3628800),
        );
    }

    /**
     * @return array
     */
    public function getErf()
    {
        return array(
            array(-1, -0.842701),
            array(0.11, 0.123623),
            array(0.3, 0.328627),
            array(0.9, 0.796908),
            array(1, 0.842701),
        );
    }

    /**
     * @param float $x
     * @param float $v
     *
     * @dataProvider getPdfTable
     */
    public function testNormalPdf($x, $v)
    {
        $snd = new NormalDistribution();
        $this->assertEquals(round($snd->normalPdf($x, 0, 1), 6), $v);
    }

    /**
     * @param int $x
     * @param int $f
     *
     * @return float
     *
     * @dataProvider getCdfTable
     */
    public function testNormalCdf($x, $f)
    {
        $snd = new NormalDistribution();
        $this->assertEquals(round($snd->normalCdf($x, 0, 1), 10), $f);
    }

    /**
     * @param int $x
     * @param int $f
     *
     * @dataProvider getFactorial
     */
    public function testFactorial($x, $f)
    {
        $snd = new NormalDistribution();
        $this->assertEquals($snd->factorial($x), $f);
    }

    /**
     * @param float $x
     * @param float $e
     *
     * @dataProvider getErf
     */
    public function testErf($x, $e)
    {
        $snd = new NormalDistribution();
        $this->assertEquals(round($snd->erf($x), 6), $e);
    }

}
 