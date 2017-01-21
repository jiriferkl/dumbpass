<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Tests;

use JiriFerkl\DumbPass\PassList;
use PHPUnit\Framework\TestCase;

/**
 * Class PassListTest
 *
 * @package JiriFerkl\DumbPass\Tests
 */
final class PassListTest extends TestCase
{

	/**
	 *
	 */
	public function testVerify()
	{
		$ok = PassList::verify('@t3st2__F');

		$this->assertTrue($ok, 'This password has to be ok');
	}

	/**
	 *
	 */
	public function testVerifyBadPass()
	{
		$ok = PassList::verify('password');

		$this->assertFalse($ok, 'This password has not to be ok');
	}

}
