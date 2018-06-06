<?php

namespace PHPBigInteger;

use PHPBigInteger\Interfaces\PHPBigIntegerContract;
use PHPBigInteger\Exception\InvalidNumericException;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @package \PHPBigInteger
 * @license MIT
 */
final class Add implements PHPBigIntegerContract
{

    const NORMAL_INTEGER = 1;

    const HAS_DECIMAL = -2;

    /**
     * @var string
     */
    private $num;

    /**
     * @param string|int $num1
     * @param string|int $num2
     * @return void
     *
     * Constructor.
     */
    public function __construct($num1, $num2)
    {
        $this->check($num1);
        $this->check($num2);

        switch ($this->normalize($num1, $num2)) {
            case self::HAS_DECIMAL:
                $this->calculateFloat($num1, $num2);
                break;
            
            case self::NORMAL_INTEGER:
                $this->calculateInteger($num1, $num2);
                break;

            default:
                break;
        }
    }

    /**
     * @param string $num1
     * @param string $num2
     * @return void
     */
    private function calculateFloat($num1, $num2)
    {
        
    }

    /**
     * @param string $num1
     * @param string $num2
     * @return void
     */
    private function calculateInteger($num1, $num2)
    {
        $r = [];
        $carry = 0;
        $num1 = str_split($num1);
        
        foreach ($num1 as $k => $v) {
            $r[$k] = "".($v + $num2[$k] + $carry);
            if ($r[$k] > 9 && isset($num1[$k+1])) {
                $carry = $r[$k][0];
                $r[$k] = $r[$k][1];
            } else {
                $carry = 0;
            }
        }

        $this->num = ltrim(implode("", array_reverse($r)), "0");
    }

    /**
     * @param string|int $a
     * @throws \PHPBigInteger\Exception\InvalidNumericException
     * @return void
     */
    private function check($a)
    {
        if (is_numeric($a))
            return;
        throw new InvalidNumericException("Invalid data {$a}");
    }

    /**
     * @param string|int &$num1
     * @param string|int &$num2
     * @return int
     */
    private function normalize(&$num1, &$num2)
    {

        $num1 = strrev("".$num1); $num2 = strrev("".$num2);

        /**
         * Fix the different string length.
         */
        $c = strlen($num1); $d = strlen($num2);
        if ($c > $d) {
            $num2 = $num2.str_repeat("0", $c-$d);
            $num1 = $num1;
        } elseif ($c < $d) {
            $num1 = $num1.str_repeat("0", $d-$c);
            $num2 = $num2;
        }

        if (preg_match("/\./", $num1) || preg_match("/\./", $num2))
            return self::HAS_DECIMAL;
        return self::NORMAL_INTEGER;
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->num;
    }
}
