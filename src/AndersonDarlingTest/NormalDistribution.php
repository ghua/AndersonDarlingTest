<?php

namespace AndersonDarlingTest;

/**
 * Class NormalDistribution
 *
 * @package AndersonDarlingTest
 *
 * @author  Semyon Velichko <semyon@velichko.net>
 */
class NormalDistribution
{

    /**
     * @param float $x
     * @param float $u
     * @param float $variance
     *
     * @return float
     *
     * Probability density function
     */
    public function pdf($x, $u, $variance)
    {
        return (1 / ($variance * sqrt(2 * M_PI))) * exp(-(pow($x - $u, 2) / (2 * pow($variance, 2))));
    }

    /**
     * @param float $x
     * @param float $u
     * @param float $variance
     *
     * @return float
     *
     * Cumulative distribution function
     */
    public function cdf($x, $u, $variance)
    {
        $d = ($x - $u) / sqrt(2 * pow($variance, 2));
        $e = $this->erf($d);

        return 0.5 * (1 + $e);
    }

    /**
     * @param float $x
     *
     * @return float
     */
    public function normalCdf($x)
    {
        return $this->cdf($x, 0, 1);
    }

    /**
     * @param float $x
     *
     * @return float
     */
    public function normalPdf($x)
    {
        return $this->pdf($x, 0, 1);
    }

    /**
     * @param float $x
     *
     * @return float
     */
    public function erf($x)
    {
        $oX = $x;
        for ($n = 1; $n < 100; $n++) {
            $d = (2 * $n) + 1;
            $p = pow($oX, $d) / ($this->factorial($n) * $d);
            if ($n % 2 === 1) {
                $x -= $p;
            } else {
                $x += $p;
            }
        }

        return (2 / sqrt(M_PI)) * $x;
    }

    /**
     * @param int $x
     *
     * @return int
     */
    public function factorial($x)
    {
//        $x = abs($x);

        if ($x === 0 || $x === 1) {
            return 1;
        }

        $r = 1;
        for ($n = 1; $n <= $x; $n++) {
            $r *= $n;
        }

        return $r;
    }
}
