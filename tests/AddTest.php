<?php

namespace tests;

use PHPBigInteger\Add;
use PHPUnit\Framework\TestCase;
use PHPBigInteger\Exception\InvalidNumericException;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @license MIT
 */
class AddTest extends TestCase
{
	public function test1()
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

	public function test2()
	{
		$a = new Add(
			"10000000000000000000000000000000000000000000000000000000000000000000000009", 
			"00000000000000000000000000000000000000000000000000000000000000000000000000000000000000001"
		);
		$this->assertEquals($a->get(), "10000000000000000000000000000000000000000000000000000000000000000000000010");

		$a = new Add(
			199999999, 
			1
		);
		$this->assertEquals($a->get(), "200000000");

		$a = new Add(
			100, 
			1
		);
		$this->assertEquals($a->get(), "101");

		$a = new Add(
			9999, 
			"01"
		);
		$this->assertEquals($a->get(), "10000");
	}

	public function test3()
	{
		$a = new Add("0.1", "0.2");
		$this->assertEquals($a->get(), "0.3");
	}

	public function testException()
	{
		$this->expectException(InvalidNumericException::class);

		$a = new Add("abc", "def");

		$this->expectException(InvalidNumericException::class);

		$a = new Add("1010a", "1000");

		$this->expectException(InvalidNumericException::class);

		$a = new Add("a1919", 999);
	}
}
