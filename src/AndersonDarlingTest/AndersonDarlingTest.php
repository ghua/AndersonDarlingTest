<?php

namespace AndersonDarlingTest;

/**
 * Class AndersonDarlingTest
 *
 * @package AndersonDarlingTest
 *
 * @author  Semyon Velichko <semyon@velichko.net>
 */
class AndersonDarlingTest
{

    /**
     * @param array $list
     *
     * @return float
     */
    public function standardDeviation(array $list)
    {
        $mean = $this->mean($list);
        array_walk($list, function (&$x) use ($mean) {
            $x = pow($x - $mean, 2);
        });
        $sum = array_sum($list);

        $result = sqrt($sum / (count($list) - 1));

        return $result;
    }

    /**
     * @param array $list
     *
     * @return float
     */
    public function mean(array $list)
    {
        return array_sum($list) / count($list);
    }

    /**
     * @param array $data
     * @param float $criticality
     *
     * @return bool
     */
    public function test(array $data, $criticality = 0.75)
    {
        return $criticality <= $this->pValue($data);
    }

    /**
     * @param array $data
     *
     * @return int|void
     */
    public function pValue(array $data)
    {
        $n = count($data);
        if ($n < 5) {
            throw new TooLessDataException;
        }

        $data = $this->normalize($data);
        sort($data, SORT_NUMERIC);

        $nd = new NormalDistribution();
        $s = 0.0;

        foreach ($data as $i => $v) {
            $cdf = $nd->normalCdf($v);

            $i++;

            $s += (
                    ((2.0 * $i) - 1.0) * log($cdf)
                ) + (
                    ((2 * ($n - $i)) + 1) * log(1 - $cdf)
                );
        }

        $a2 = -$n - ((1 / $n) * $s);

        $a2 = $a2 * (1 + 0.75 / $n + 2.25 / pow($n, 2));

        if ($a2 >= 0.6) {
            return exp(1.2937 - 5.709 * $a2 + 0.0186 * pow($a2, 2));
        }

        if (0.34 < $a2 and $a2 < 0.6) {
            return exp(0.9177 - 4.279 * $a2 - 1.38 * pow($a2, 2));
        }

        if (0.2 < $a2 and $a2 < 0.34) {
            return 1 - exp(-8.318 + 42.796 * $a2 - 59.938 * pow($a2, 2));
        }

        if ($a2 <= 0.2) {
            return 1 - exp(-13.436 + (101.14 * $a2) - 223.73 * pow($a2, 2));
        }
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function normalize(array $data)
    {
        $mean = $this->mean($data);
        $deviation = $this->standardDeviation($data);
        $data = array_map(function ($x) use ($mean, $deviation) {
            return ($x - $mean) / $deviation;
        }, $data);

        return $data;
    }

}
