<?php

namespace alcea\cif;

/**
 * Class Cif - Validation for Romanian VAT code (CIF)
 *
 * Valid format:
 * |XXXXXXXXX|C| - max length 10 - min length 2
 * |X|  - from 1 to 9 characters
 * |C|  - check Digit
 * 
 * ```php
 * use alcea\cif\Cif;
 *
 * $cifToBeValidated = '159'; // without prefix digit (RO|R)
 * $cif = new Cif($cifToBeValidated);
 * echo "CIF {$cifToBeValidated} is " . ( $cif->isValid() ? 'valid' : 'invalid' ) . PHP_EOL;
 *
 * // or
 *
 * echo "CIF {$cifToBeValidated} is " . ( Cif::validate($cifToBeValidated) ? 'valid' : 'invalid' ) . PHP_EOL;
 * ```
 * 
 * @property string $_cif - CIF without prefix digit (RO|R)  - $cif = preg_replace("/[^0-9]/", "", $cif);
 * @property boolean $_isValid
 * @see https://ro.wikipedia.org/wiki/Cod_de_Identificare_Fiscal%C4%83
 * @author Alcea Nicolae <nicu(dotta)alcea(atta)gmail(dotta)com>
 */
class Cif
{

    private static $controlKey = [7, 5, 3, 2, 1, 7, 5, 3, 2];
    private $_cif;
    private $_isValid;

    /**
     * CIF constructor.
     * @param string|integer $cif - without prefix digit (RO|R)
     */
    public function __construct($cif)
    {
        $this->_cif = trim($cif);
        $this->_isValid = false;
        $this->validateCIF();
    }

    /**
     * @param string|int $cif
     * @return bool
     */
    public static function validate($cif)
    {
        return (new static($cif))->isValid();
    }

    /**
     * 
     * @return boolean
     */
    public function isValid()
    {
        return $this->_isValid;
    }

    /**
     * Validate CIF
     * @return boolean
     */
    private function validateCIF()
    {
        $cif = $this->_cif;
        if (!is_numeric($cif)) {
            return false;
        }
        if ((int) $cif <= 0) {
            return false;
        }
        $cifLength = strlen($cif);
        if ($cifLength > 10) {
            return false;
        }
        if ($cifLength < 2) {
            return false;
        }

        $controlKey = (int) substr($cif, -1);
        $cif = substr($cif, 0, -1);
        $cif = str_pad($cif, 9, '0', STR_PAD_LEFT);
        $suma = 0;
        foreach (self::$controlKey as $i => $key) {
            $suma += $cif[$i] * $key;
        }
        $suma = $suma * 10;
        $rest = (int) ($suma % 11);
        $rest = ($rest == 10) ? 0 : $rest;

        if ($rest === $controlKey) {
            $this->_isValid = true;
        }
    }

}
