<?php

namespace tests;

use PHPBigInteger\Add;
use PHPUnit\Framework\TestCase;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @license MIT
 */
class AddTest extends TestCase
{
	public function testX()
	{
		$v = [
			[1, 1, "2"],
			[9, 1, "10"],
			["999", "999", "1998"],
			["99999999999999999999999", 1, "100000000000000000000000"],
			["12345678901234567890", "9876543210", "12345678911111111100"],
			["99999999999999999999999999999999999999999999999999999999999999999", "9999999999999999999999999999999999999999999999999999999999999", "100009999999999999999999999999999999999999999999999999999999999998"]
		];
		foreach ($v as $v) {
			$a = new Add($v[0], $v[1]);
			$this->assertEquals($a->get(), $v[2]);	
		}
	}
}
