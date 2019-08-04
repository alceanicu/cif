<?php

use alcea\cif\Cif;

use PHPUnit\Framework\TestCase;

final class CnpTest extends TestCase
{

    /**
     * CIF valide:
     * RO159 - http://www.mfinante.gov.ro/infocodfiscal.html?cod=159
     * RO19 - http://www.mfinante.gov.ro/infocodfiscal.html?cod=19
     */
    public function cifDataProvider()
    {
        return [
            //[CIF, isValid]
            ['0000000', false],
            ['xxx', false],
            ['-1', false],
            [9010105, true], #ORANGE ROMANIA SA
            ['RO 9010105', false],
            [5888716, true], #RCS & RDS SA
            ['R5888716', false],
            [8971726, true], #VODAFONE ROMANIA SA
            ['89717 26', false],
            [159, true], #FRIGOTEHNICA SRL
            ['RO159', false],
            [19, true], #BUCUR OBOR S.A
            [' 19 ', true],
        ];
    }

    /**
     * @dataProvider cifDataProvider
     */
    public function testCIF($cif, $isValid)
    {
        $_cif = new Cif($cif);
        $this->assertEquals($_cif->isValid(), $isValid);
    }

}
