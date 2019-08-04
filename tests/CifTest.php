<?php

use alcea\cif\Cif;

use PHPUnit\Framework\TestCase;

final class CnpTest extends TestCase
{
    /**
     * @return array
     */
    public function cifDataProvider()
    {
        return [
            #CIF, isValid
            [null, false],
            [false, false],
            [true, false],
            [0, false],
            ['0', false],
            ['', false],
            ['   ', false],
            [-1, false],
            [1, false],
            [999999999999, false],
            ['10', false],
            ['xxx', false],
            ['-1a', false],
            ['-1', false],
            // some real CIF
            [9010105, true],    # ORANGE ROMANIA SA - http://www.mfinante.gov.ro/infocodfiscal.html?cod=9010105
            ['RO 9010105', false],
            [5888716, true],    # RCS & RDS SA - http://www.mfinante.gov.ro/infocodfiscal.html?cod=5888716
            ['R5888716', false],
            [8971726, true],    # VODAFONE ROMANIA SA - http://www.mfinante.gov.ro/infocodfiscal.html?cod=8971726
            ['89717 26', false],
            [159, true],        # FRIGOTEHNICA SRL - http://www.mfinante.gov.ro/infocodfiscal.html?cod=159
            ['RO159', false],
            [19, true],         # BUCUR OBOR S.A - http://www.mfinante.gov.ro/infocodfiscal.html?cod=19
            [' 19 ', true],
        ];
    }

    /**
     * @dataProvider cifDataProvider
     * @param string|int $cif
     * @param boolean $isValid
     */
    public function testCanValidateCif($cif, $isValid)
    {
        $this->assertEquals((new Cif($cif))->isValid(), $isValid);
    }

    /**
     * @dataProvider cifDataProvider
     * @param string|int $cif
     * @param boolean $isValid
     */
    public function testCanValidateCifByCallingStaticValidator($cif, $isValid)
    {
        $this->assertEquals(Cif::validate($cif), $isValid);
    }

}
