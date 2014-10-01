<?php

namespace AndersonDarlingTest\Tests;

use AndersonDarlingTest\AndersonDarlingTest;

/**
 * Class AndersonDarlingTestTest
 *
 * @package AndersonDarlingTest\Tests
 *
 * @author  Semyon Velichko <semyon@velichko.net>
 */
class AndersonDarlingTestTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function getData()
    {
        return array(array(array(4.10, -3.39, 0.94, 0.32, 4.23, -0.54, -3.94, 3.90, 2.56, -1.96, 1.46,
            6.87, -2.94, 2.06, 4.89, 3.45, -0.8, 8.47, 1.54, -0.66, -2.55, 1.64,
            2.12, -7.13, 0.85, 2.40, -2.73, 8.80, -0.89, -0.52, -9.91, -5.25,
            -0.67, 5.82, 2.45, 4.07, 6.51, 2.2, 0.03, 3.79, -4.91, 4.39, 1.95, -1.93, 1.18, -4.49, 10.58
        )));
    }

    public function getNormalized()
    {
        $data = $this->getData();

        $normalized = array(0.7374933884112, -1.0611750162056, -0.021357367074677, -0.17024580644216,
            0.76871193214954, -0.3767684804035, -1.1932534704832, 0.68946485958298, 0.36767371643391, -0.71777103508387,
            0.1035168078787, 1.402688512682, -0.95311082634214, 0.24760239436336, 0.92720607728267, 0.58140066971948,
            -0.43920556788019, 1.7869167433078, 0.12272821940998, -0.40558559770044, -0.85945519512712, 0.14674248382409,
            0.26201095301182, -1.9593085052934, -0.042970205047375, 0.32925089337133, -0.90268087107251, 1.8661638158744,
            -0.46081840585289, -0.37196562752068, -2.6269050560056, -1.5078403343081, -0.40798702414185, 1.1505387363339,
            0.34125802557838, 0.73028910908697, 1.3162371607913, 0.28122236454311, -0.23988717324308, 0.66304916872746,
            -1.4261918353001, 0.80713475521212, 0.22118670350783, -0.71056675575963, 0.036276867519187, -1.3253319247608,
            2.2936177224455
        );
        $data[0][1] = $normalized;

        return $data;
    }

    const STANDARD_DEVIATION = 4.1641916768953;
    const P_VALUE = 0.9274411043;
    const MEAN = 1.0289361702128;

    /**
     * @param array $data
     *
     * @dataProvider getData
     */
    public function testStandardDeviation(array $data)
    {
        $validator = new AndersonDarlingTest();
        $deviation = $validator->standardDeviation($data);

        $this->assertEquals($deviation, self::STANDARD_DEVIATION);
    }

    /**
     * @param array $data
     *
     * @dataProvider getData
     */
    public function testPValue(array $data)
    {
        $validator = new AndersonDarlingTest();
        $pValue = $validator->pValue($data);

        $this->assertEquals(self::P_VALUE, round($pValue, 11));
    }

    /**
     * @param array $data
     *
     * @dataProvider getData
     */
    public function testTest(array $data)
    {
        $validator = new AndersonDarlingTest();
        $this->assertTrue($validator->test($data));
    }

    /**
     * @param array $data
     *
     * @dataProvider getData
     */
    public function testMean(array $data)
    {
        $validator = new AndersonDarlingTest();
        $mean = $validator->mean($data);

        $this->assertEquals(self::MEAN, $mean);
    }

    /**
     * @param array $data
     * @param array $result
     *
     * @dataProvider getNormalized
     */
    public function testNormalize(array $data, array $result)
    {
        $validator = new AndersonDarlingTest();
        $normalized = $validator->normalize($data);

        $this->assertEquals($result, $normalized);
    }

    /**
     * @expectedException \AndersonDarlingTest\TooLessDataException
     * @expectedExceptionMessage Sample array size needs to be more than five.
     */
    public function testTooLessData()
    {
        $data = array(1, 2, 3, 4);
        $validator = new AndersonDarlingTest();
        $validator->pValue($data);
    }

}
