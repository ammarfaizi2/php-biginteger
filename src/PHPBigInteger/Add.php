<?php

namespace PHPBigInteger;

use PHPBigInteger\Interfaces\PHPBigIntegerContract;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @package \PHPBigInteger
 * @license MIT
 */
class Add implements PHPBigIntegerContract
{
    /**
     * @var int
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

        $r = [];
        $carry = 0; 
        $num1 = str_split($num1);
        
        foreach ($num1 as $k => $v) {
            $r[$k] = (string) ($v + $num2[$k] + $carry);
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
     * @return string
     */
    public function get()
    {
        return $this->num;
    }
}
