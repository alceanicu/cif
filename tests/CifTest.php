<?php

use alcea\cif\Cif;

class CifTest extends PHPUnit_Framework_TestCase
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
            [159, true],
            [19, true],
            [' 19 ', true],
            ['RO159', false],
            ['ro159', false],
            ['R159', false],
            ['0000000', false],
            ['xxx', false],
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
