<?php

namespace PHPBigInteger\Interfaces;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @package \PHPBigInteger\Interfaces
 * @license MIT
 */
interface PHPBigIntegerContract
{
	/**
	 * @param string|int $num1
	 * @param string|int $num2
	 * @return void
	 *
	 * Constructor.
	 */
	public function __construct($num1, $num2);

	/**
	 * @return string
	 */
	public function get();
}
